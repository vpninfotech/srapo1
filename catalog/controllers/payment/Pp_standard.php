<?php
class Pp_standard extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		$this->load->library('tax');
		$this->load->library('mycart');
		$this->load->library('customer');
		$this->lang->load('payment/pp_standard_lang','english');
		
		$this->load->model('account/address_model','address');

		$this->load->model('system/country_model','country');

		$this->load->model('system/zone_model','zone');

		$this->load->model('account/customer_model','customers');
	}
	public function index() {
		$data['text_testmode'] = $this->lang->line('text_testmode');
		$data['button_confirm'] = $this->lang->line('button_confirm');

		$data['testmode'] = $this->common->config('pp_standard_test');

		if (!$this->common->config('pp_standard_test')) {
			$data['action'] = 'https://www.paypal.com/cgi-bin/webscr';
		} else {
			$data['action'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		}

		$this->load->model('checkout/order_model','order');

		$order_info = $this->order->getOrder($this->session->userdata('order_id'));

		if ($order_info) {
			$data['business'] = $this->common->config('pp_standard_email');
			$data['item_name'] = html_entity_decode($this->common->config('config_name'), ENT_QUOTES, 'UTF-8');

			$data['products'] = array();

			foreach ($this->mycart->getProducts() as $product) {
				$option_data = array();

				foreach ($product['option'] as $option) {
					if ($option['type'] != 'file') {
						$value = $option['value'];
					}

					$option_data[] = array(
						'name'  => $option['name'],
						'value' => (strlen($value) > 20 ? substr($value, 0, 20) . '..' : $value)
					);
				}

				$data['products'][] = array(
					'name'     => htmlspecialchars($product['name']),
					'model'    => htmlspecialchars($product['model']),
					'price'    => $this->currency->format($product['price'], $order_info['currency_code'], false, false),
					'quantity' => $product['quantity'],
					'option'   => $option_data,
					'weight'   => $product['weight']
				);
			}

			$data['discount_amount_cart'] = 0;

			$total = $this->currency->format($order_info['total'] - $this->mycart->getSubTotal(), $order_info['currency_code'], false, false);

			if ($total > 0) {
				$data['products'][] = array(
					'name'     => $this->lang->line('text_total'),
					'model'    => '',
					'price'    => $total,
					'quantity' => 1,
					'option'   => array(),
					'weight'   => 0
				);
			} else {
				$data['discount_amount_cart'] -= $total;
			}

			$data['currency_code'] = $order_info['currency_code'];
			$data['first_name'] = html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8');
			$data['last_name'] = html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');
			$data['address1'] = html_entity_decode($order_info['payment_address_1'], ENT_QUOTES, 'UTF-8');
			$data['address2'] = html_entity_decode($order_info['payment_address_2'], ENT_QUOTES, 'UTF-8');
			$data['city'] = html_entity_decode($order_info['payment_city'], ENT_QUOTES, 'UTF-8');
			$data['zip'] = html_entity_decode($order_info['payment_postcode'], ENT_QUOTES, 'UTF-8');
			$data['country'] = $order_info['payment_iso_code_2'];
			$data['email'] = $order_info['email'];
			$data['invoice'] = $this->session->data['order_id'] . ' - ' . html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8') . ' ' . html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');
			$data['lc'] = $this->session->data['language'];
			$data['return'] = site_url('checkout/success');
			$data['notify_url'] = site_url('payment/pp_standard/callback');
			$data['cancel_return'] = site_url('checkout/checkout');

			if (!$this->common->config('pp_standard_transaction')) {
				$data['paymentaction'] = 'authorization';
			} else {
				$data['paymentaction'] = 'sale';
			}

			$data['custom'] = $this->session->data['order_id'];

			$site_theme = $this->common->config('catalog_theme');
			$this->load->view("themes/".$site_theme."/payment/pp_standard",$data);
		}
	}

	public function callback() {
		if ($this->input->post('custom') !== NULL) {
			$order_id = $this->input->post('custom');
		} else {
			$order_id = 0;
		}

		$this->load->model('checkout/order_model','order');

		$order_info = $this->order->getOrder($order_id);

		if ($order_info) {
			$request = 'cmd=_notify-validate';

			foreach ($this->input->post() as $key => $value) {
				$request .= '&' . $key . '=' . urlencode(html_entity_decode($value, ENT_QUOTES, 'UTF-8'));
			}

			if (!$this->common->config('pp_standard_test')) {
				$curl = curl_init('https://www.paypal.com/cgi-bin/webscr');
			} else {
				$curl = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');
			}

			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_TIMEOUT, 30);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

			$response = curl_exec($curl);

			if ((strcmp($response, 'VERIFIED') == 0 || strcmp($response, 'UNVERIFIED') == 0) && isset($this->request->post['payment_status'])) {
				$order_status_id = $this->common->config('config_order_status_id');

				switch($this->request->post['payment_status']) {
					case 'Canceled_Reversal':
						$order_status_id = $this->common->config('pp_standard_canceled_reversal_status_id');
						break;
					case 'Completed':
						$receiver_match = (strtolower($this->request->post['receiver_email']) == strtolower($this->common->config('pp_standard_email')));

						$total_paid_match = ((float)$this->request->post['mc_gross'] == $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false));

						if ($receiver_match && $total_paid_match) {
							$order_status_id = $this->common->config('pp_standard_completed_status_id');
						}
						
						if (!$receiver_match) {
							$this->log->write('PP_STANDARD :: RECEIVER EMAIL MISMATCH! ' . strtolower($this->request->post['receiver_email']));
						}
						
						if (!$total_paid_match) {
							$this->log->write('PP_STANDARD :: TOTAL PAID MISMATCH! ' . $this->request->post['mc_gross']);
						}
						break;
					case 'Denied':
						$order_status_id = $this->common->config('pp_standard_denied_status_id');
						break;
					case 'Expired':
						$order_status_id = $this->common->config('pp_standard_expired_status_id');
						break;
					case 'Failed':
						$order_status_id = $this->common->config('pp_standard_failed_status_id');
						break;
					case 'Pending':
						$order_status_id = $this->common->config('pp_standard_pending_status_id');
						break;
					case 'Processed':
						$order_status_id = $this->common->config('pp_standard_processed_status_id');
						break;
					case 'Refunded':
						$order_status_id = $this->common->config('pp_standard_refunded_status_id');
						break;
					case 'Reversed':
						$order_status_id = $this->common->config('pp_standard_reversed_status_id');
						break;
					case 'Voided':
						$order_status_id = $this->common->config('pp_standard_voided_status_id');
						break;
				}

				$this->order->addOrderHistory($order_id, $order_status_id);
			} else {
				$this->order->addOrderHistory($order_id, $this->common->config('config_order_status_id'));
			}

			curl_close($curl);
			redirect('checkout/success');
		}
		else
		{
			redirect('checkout/checkout');
		}
	}
}