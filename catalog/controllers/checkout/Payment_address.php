<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_address extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		
		$this->_init();
		$this->load->library('tax');
		$this->load->library('mycart');
		$this->load->library('customer');
		$this->lang->load('checkout/checkout_lang','english');
		
		$this->load->model('account/address_model','address');

		$this->load->model('system/country_model','country');

		$this->load->model('system/zone_model','zone');

		$this->load->model('account/customer_model','customers');
	}
	
	private function _init() {
		
		//--Set Template
		$this->output->set_template('site_template');
		$site_theme = $this->common->config('catalog_theme');
		$this->output->set_common_meta('Cart','sarpo','Cart Page');
		

	}
	public function index() {
		
		$data['text_address_existing'] = $this->lang->line('text_address_existing');
		$data['text_address_new'] = $this->lang->line('text_address_new');
		$data['text_select'] = $this->lang->line('text_select');
		$data['text_none'] = $this->lang->line('text_none');
		$data['text_loading'] = $this->lang->line('text_loading');

		$data['entry_firstname'] = $this->lang->line('entry_firstname');
		$data['entry_lastname'] = $this->lang->line('entry_lastname');
		$data['entry_company'] = $this->lang->line('entry_company');
		$data['entry_address_1'] = $this->lang->line('entry_address_1');
		$data['entry_address_2'] = $this->lang->line('entry_address_2');
		$data['entry_postcode'] = $this->lang->line('entry_postcode');
		$data['entry_city'] = $this->lang->line('entry_city');
		$data['entry_country'] = $this->lang->line('entry_country');
		$data['entry_zone'] = $this->lang->line('entry_zone');

		$data['button_continue'] = $this->lang->line('button_continue');
		$data['button_upload'] = $this->lang->line('button_upload');

		$payment_address = $this->session->userdata('payment_address');
		if (isset($payment_address['address_id'])) {
			$data['address_id'] = $payment_address['address_id'];
		} else {
			$data['address_id'] = $this->customer->getAddressId();
		}

		$data['addresses'] = $this->address->getAddresses();

		if (isset($payment_address['country_id'])) {
			$data['country_id'] = $payment_address['country_id'];
		} else {
			$data['country_id'] = $this->common->config('config_country_id');
		}

		if (isset($payment_address['zone_id'])) {
			$data['zone_id'] = $payment_address['zone_id'];
		} else {
			$data['zone_id'] = '';
		}

		$data['countries'] = $this->country->getCountries();

		if (file_exists(DIR_TEMPLATE . $this->common->config('config_template') . '/template/checkout/payment_address.tpl')) {
			$this->response->setOutput($this->load->view($this->common->config('config_template') . '/template/checkout/payment_address.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/checkout/payment_address.tpl', $data));
		}
	}

	public function save() {
		$this->output->unset_template();
		$json = array();
		// Validate if customer is logged in.
		if (!$this->customer->isLogged()) {
			$json['redirect'] = site_url('checkout/cart');
		}

		// Validate cart has products and has stock.
		if ((!$this->mycart->hasProducts() && $this->session->userdata('vouchers') ===NULL) || (!$this->mycart->hasStock() && !$this->common->config('config_stock_checkout'))) {
			$json['redirect'] = site_url('checkout/cart');
		}

		// Validate minimum quantity requirements.
		$products = $this->mycart->getProducts();

		foreach ($products as $product) {
			$product_total = 0;

			foreach ($products as $product_2) {
				if ($product_2['product_id'] == $product['product_id']) {
					$product_total += $product_2['quantity'];
				}
			}

			if ($product['minimum'] > $product_total) {
				$json['redirect'] = site_url('checkout/cart');

				break;
			}
		}

		if (!$json) {
			if ($this->input->post('payment_address_exists') && $this->input->post('payment_address_exists') == 'existing') {
				
				if ($this->input->post('address_id')=="") {
					$json['error']['warning'] = $this->lang->line('error_address');
				} elseif (!in_array($this->input->post('address_id'), array_keys($this->address->getAddresses()))) {
					$json['error']['warning'] = $this->lang->line('error_address');
				}

				if (!$json) {
					$this->session->set_userdata('payment_address',$this->address->getAddress($this->input->post('address_id')));

					$this->session->unset_userdata('payment_method');
					$this->session->unset_userdata('payment_methods');
				}
			} else {
				if ((strlen(trim($this->input->post('firstname'))) < 1) || (strlen(trim($this->input->post('firstname'))) > 32)) {
					$json['error']['firstname'] = $this->lang->line('error_firstname');
				}

				if ((strlen(trim($this->input->post('lastname'))) < 1) || (strlen(trim($this->input->post('lastname'))) > 32)) {
					$json['error']['lastname'] = $this->lang->line('error_lastname');
				}

				if ((strlen(trim($this->input->post('address_1'))) < 3) || (strlen(trim($this->input->post('address_1'))) > 128)) {
					$json['error']['address_1'] = $this->lang->line('error_address_1');
				}

				if ((strlen($this->input->post('city')) < 2) || (strlen($this->input->post('city')) > 32)) {
					$json['error']['city'] = $this->lang->line('error_city');
				}

				if ((strlen(trim($this->input->post('postcode'))) < 2 || strlen(trim($this->input->post('postcode'))) > 10)) {
					$json['error']['postcode'] = $this->lang->line('error_postcode');
				}

				if ($this->input->post('country_id') == '') {
					$json['error']['country'] = $this->lang->line('error_country');
				}

				if (!$this->input->post('state_id') || $this->input->post('state_id') == '' || !is_numeric($this->input->post('state_id'))) {
					$json['error']['zone'] = $this->lang->line('error_zone');
				}

				if (!$json) {
					// Default Payment Address
					$address_id = $this->address->addAddress($this->input->post());

					$this->session->set_userdata('payment_address',$this->address->getAddress($address_id));

					$this->session->unset_userdata('payment_method');
					$this->session->unset_userdata('payment_methods');
					$json['success'] ="Your Payment Address is set Successfully!";

					if($this->input->post('payment_address_delivery') == 1)
					{

						$this->session->set_userdata('shipping_address',$this->address->getAddress($address_id));
						$this->session->unset_userdata('shipping_method');
						$this->session->unset_userdata('shipping_methods');

						$json['success'] ="Your Payment Address and Shipping Address are set Successfully!";

					}

				}
			}
		}
		echo json_encode($json);
	}
}