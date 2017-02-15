<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Api_order
* @Auther       : Indrajit
* @Date         : 24-12-2016
* @Description  : Api order Operation
*
*/
class Api_order extends CI_Controller 
{
	private $data=array();
	private $error = array();
	function __construct()
	{
            parent::__construct();

            $this->_init();

            $this->rbac->CheckAuthentication();

            $this->lang->load('api/api_order_lang', 'english');

            $this->load->model('common');

            $this->load->library('commons');

            $this->load->library('pagination');

            $this->load->library('mycart');

            $this->load->library('tax');

             $this->load->library('currency');
	}
	/**
	* 
	* @function name : _init()
	* @description   : initialize required resources in this view
	* @param   		 : void
	* @return        : void
	*
	*/
	private function _init() {
		
            
	}
	public function add() 
	{
		

		$json = array();

		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{
			// Customer
			if ($this->session->userdata('customer') === NULL) 
			{
				$json['error'] = $this->lang->line('error_customer');
			}

			// Payment Address
			if ($this->session->userdata('payment_address') === NULL) 
			{
				$json['error'] = $this->lang->line('error_payment_address');
			}

			// Payment Method
			if (!$json && $this->input->post('payment_method') !== NULL) 
			{
				$payment_method = $this->session->userdata('payment_methods');
				if ($this->session->userdata('payment_methods') === NUll) 
				{
					$json['error'] = $this->lang->line('error_no_payment');
				} 
				elseif (!isset($payment_method[$this->input->post('payment_method')])) 
				{
					$json['error'] = $this->lang->line('error_payment_method');
				}

				if (!$json) 
				{
					$this->session->set_userdata('payment_method',$payment_method[$this->input->post('payment_method')]);
				}
			}

			if ($this->session->userdata('payment_method') === NULL) 
			{
				$json['error'] = $this->lang->line('error_payment_method');
			}

			// Shipping
			if ($this->mycart->hasShipping()) {
				// Shipping Address
				if ($this->session->userdata('shipping_address') === NULL) 
				{
					$json['error'] = $this->lang->line('error_shipping_address');
				}

				// Shipping Method
				if (!$json && $this->input->post('shipping_method') !== "") 
				{
					if ($this->session->userdata('shipping_methods') === NULL) 
					{
						$json['error'] = $this->lang->line('error_no_shipping');
					} 
					else 
					{
						$shipping = explode('.', $this->input->post('shipping_method'));
						$shipping_methods = $this->session->userdata('shipping_methods');
						if (!isset($shipping[0]) || !isset($shipping[1]) || !isset($shipping_methods[$shipping[0]]['quote'][$shipping[1]])) 
						{
							$json['error'] = $this->lang->line('error_shipping_method');
						}
					}

					if (!$json) {
						$this->session->set_userdata('shipping_method',$shipping_methods[$shipping[0]]['quote'][$shipping[1]]) ;
					}
				}

				// Shipping Method
				if ($this->session->userdata('shipping_method') === NULL) 
				{
					$json['error'] = $this->lang->line('error_shipping_method');
				}
			} else {
				$this->session->unset_userdata('shipping_address');
				$this->session->unset_userdata('shipping_method');
				$this->session->unset_userdata('shipping_methods');
			}

			// Cart
			if ((!$this->mycart->hasProducts() && $this->session->userdata('vouchers') === NULL) || (!$this->mycart->hasStock() )) 
			{
				$json['error'] = $this->lang->line('error_stock');
			}

			// Validate minimum quantity requirements.
			$products = $this->mycart->getProducts();

			foreach ($products as $product) {
				$product_total = 0;

				foreach ($products as $product_2) 
				{
					if ($product_2['product_id'] == $product['product_id']) {
						$product_total += $product_2['quantity'];
					}
				}

				if ($product['minimum'] > $product_total) 
				{
					$json['error'] = sprintf($this->lang->line('error_minimum'), $product['name'], $product['minimum']);

					break;
				}
			}

			if (!$json) 
			{
				$order_data = array();

				// Store Details
				$order_data['invoice_prefix'] = $this->common->config('config_invoice_prefix');
				
				$customer_details = $this->session->userdata('customer');
				// Customer Details
				$order_data['customer_id'] = $customer_details['customer_id'];
				$order_data['customer_group_id'] = $customer_details['customer_group_id'];
				$order_data['firstname'] = $customer_details['firstname'];
				$order_data['lastname'] = $customer_details['lastname'];
				$order_data['email'] = $customer_details['email'];
				$order_data['telephone'] = $customer_details['telephone'];
				
				$payment_details = $this->session->userdata('payment_address');
				// Payment Details
				$order_data['payment_firstname'] = $payment_details['firstname'];
				$order_data['payment_lastname'] = $payment_details['lastname'];
				$order_data['payment_company'] =$payment_details['company'];
				$order_data['payment_address_1'] = $payment_details['address_1'];
				$order_data['payment_address_2'] = $payment_details['address_2'];
				$order_data['payment_city'] = $payment_details['city'];
				$order_data['payment_postcode'] = $payment_details['postcode'];
				$order_data['payment_zone'] = $payment_details['zone'];
				$order_data['payment_state_id'] = $payment_details['zone_id'];
				$order_data['payment_country'] = $payment_details['country'];
				$order_data['payment_country_id'] = $payment_details['country_id'];
				
				$payment_method_details = $this->session->userdata('payment_method');
				if (isset($payment_method_details['title'])) 
				{
					$order_data['payment_method'] = $payment_method_details['title'];
				} else {
					$order_data['payment_method'] = '';
				}

				if (isset($payment_method_details['code'])) {
					$order_data['payment_code'] = $payment_method_details['code'];
				} else {
					$order_data['payment_code'] = '';
				}

				// Shipping Details
				if ($this->mycart->hasShipping()) 
				{
					$shipping_details = $this->session->userdata('shipping_address');
					$order_data['shipping_firstname'] = $shipping_details['firstname'];
					$order_data['shipping_lastname'] = $shipping_details['lastname'];
					$order_data['shipping_company'] = $shipping_details['company'];
					$order_data['shipping_address_1'] = $shipping_details['address_1'];
					$order_data['shipping_address_2'] = $shipping_details['address_2'];
					$order_data['shipping_city'] = $shipping_details['city'];
					$order_data['shipping_postcode'] = $shipping_details['postcode'];
					$order_data['shipping_zone'] = $shipping_details['zone'];
					$order_data['shipping_state_id'] = $shipping_details['zone_id'];
					$order_data['shipping_country'] = $shipping_details['country'];
					$order_data['shipping_country_id'] = $shipping_details['country_id'];
					
					$shipping_method = $this->session->userdata('shipping_method');
					if (isset($shipping_method['title'])) 
					{
						$order_data['shipping_method'] = $shipping_method['title'];
					} 
					else 
					{
						$order_data['shipping_method'] = '';
					}

					if (isset($shipping_method['code'])) 
					{
						$order_data['shipping_code'] = $shipping_method['code'];
					} 
					else 
					{
						$order_data['shipping_code'] = '';
					}
				} 
				else 
				{
					$order_data['shipping_firstname'] = '';
					$order_data['shipping_lastname'] = '';
					$order_data['shipping_company'] = '';
					$order_data['shipping_address_1'] = '';
					$order_data['shipping_address_2'] = '';
					$order_data['shipping_city'] = '';
					$order_data['shipping_postcode'] = '';
					$order_data['shipping_zone'] = '';
					$order_data['shipping_state_id'] = '';
					$order_data['shipping_country'] = '';
					$order_data['shipping_country_id'] = '';
					$order_data['shipping_method'] = '';
					$order_data['shipping_code'] = '';
				}

				// Products
				$order_data['products'] = array();

				foreach ($this->mycart->getProducts() as $product) 
				{
					$option_data = array();

					foreach ($product['option'] as $option) 
					{
						$option_data[] = array(
							'product_option_id'       => $option['product_option_id'],
							'product_option_value_id' => $option['product_option_value_id'],
							'option_id'               => $option['option_id'],
							'option_value_id'         => $option['option_value_id'],
							'name'                    => $option['name'],
							'value'                   => $option['value'],
							'type'                    => $option['type']
						);
					}

					$order_data['products'][] = array(
						'product_id' => $product['product_id'],
						'name'       => $product['name'],
						'model'      => $product['model'],
						'option'     => $option_data,
						'download'   => $product['download'],
						'quantity'   => $product['quantity'],
						'subtract'   => $product['subtract'],
						'price'      => $product['price'],
						'total'      => $product['total'],
						'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id']),
						
					);
				}

				// Gift Voucher
				$order_data['vouchers'] = array();

				if ($this->session->userdata('vouchers') !== NULL) 
				{
					foreach ($this->session->userdata('vouchers') as $voucher) 
					{
						$order_data['vouchers'][] = array(
							'description'      => $voucher['description'],
							'code'             => substr($this->commons->token(32), 0, 10),
							'to_name'          => $voucher['to_name'],
							'to_email'         => $voucher['to_email'],
							'from_name'        => $voucher['from_name'],
							'from_email'       => $voucher['from_email'],
							'voucher_theme_id' => $voucher['voucher_theme_id'],
							'message'          => $voucher['message'],
							'amount'           => $voucher['amount']
						);
					}
				}

				$order_data['totals'] = array();
				$total_data = array();
				$total = 0;
				$taxes = $this->mycart->getTaxes();

				$sort_order = array();

				
				$results[]=array('code'=>'sub_total');
				$results[]=array('code'=>'shipping');
				$results[]=array('code'=>'tax');
				$results[]=array('code'=>'coupon');
				$results[]=array('code'=>'voucher');
				$results[]=array('code'=>'total');
				
				foreach ($results as $result) 
				{
					
						$this->load->model('api/Total_'.$result['code'].'_model',$result['code'].'_model');
						$model = $result['code'].'_model';
						$this->$model->getTotal($order_data['totals'], $total, $taxes);
					
				}

				if ($this->input->post('comment'))
				{
					$order_data['comment'] = $this->input->post('comment');
				} 
				else 
				{
					$order_data['comment'] = '';
				}

				$order_data['total'] = $total;

				$order_data['tracking'] = '';
				$order_data['currency_id'] = $this->currency->getId();
				$order_data['currency_code'] = $this->currency->getCode();
				$order_data['currency_value'] = $this->currency->getValue($this->currency->getCode());
				
				$this->load->model('api/api_order_model','api_order_model');

				$json['order_id'] = $this->api_order_model->addOrder($order_data);

				// Set the order history
				if ($this->input->post('order_status_id')!=="") 
				{
					$order_status_id = $this->input->post('order_status_id');
				} 
				else 
				{
					$order_status_id = $this->common->config('config_order_status_id');
				}

				$this->api_order_model->addOrderHistory($json['order_id'], $order_status_id);

                                $json['success'] = ' Success: You have modified orders! ';;
			}
		}

		// if (isset($this->request->server['HTTP_ORIGIN'])) {
		// 	$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
		// 	$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		// 	$this->response->addHeader('Access-Control-Max-Age: 1000');
		// 	$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		// }

		// $this->response->addHeader('Content-Type: application/json');
		// $this->response->setOutput(json_encode($json));

		echo json_encode($json);
	}

	public function edit() 
	{
		$this->load->model('api/api_order_model','api_order_model');
		$json = array();

		if (!($this->input->server('REQUEST_METHOD') == 'POST')) {
			$json['error'] = $this->language->get('error_permission');
		} 
		else 
		{
			

			if ($this->input->post('order_id') !== "" ) 
			{
				$order_id = $this->input->post('order_id');
			} else {
				$order_id = 0;
			}

			$order_info = $this->api_order_model->getOrder($order_id);

			if ($order_info) {
				// Customer
				if ($this->session->userdata('customer') === NULL) 
				{
					$json['error'] = $this->lang->line('error_customer');
				}

				// Payment Address
				if ($this->session->userdata('payment_address') === NULL) 
				{
					$json['error'] = $this->lang->line('error_payment_address');
				}

				// Payment Method
				if (!$json && ($this->input->post('payment_method') !== "")) 
				{
					$payment_methods = $this->session->userdata('payment_methods');
					if ($this->session->userdata('payment_methods') === NULL) 
					{
						$json['error'] = $this->lang->line('error_no_payment');
					} elseif (!isset($payment_methods[$this->input->post('payment_method')])) 
					{
						$json['error'] = $this->lang->line('error_payment_method');
					}

					if (!$json) {
						$this->session->set_userdata('payment_method',$payment_methods[$this->input->post('payment_method')]);
					}
				}

				if ($this->session->userdata('payment_method') === NULL) 
				{
					$json['error'] = $this->lang->line('error_payment_method');
				}

				// Shipping
				if ($this->mycart->hasShipping()) 
				{
					// Shipping Address
					if ($this->session->userdata('shipping_address') === NULL) 
					{
						$json['error'] = $this->lang->line('error_shipping_address');
					}

					// Shipping Method
					if (!$json && $this->input->post('shipping_method') !== "") 
					{
						if ($this->session->userdata('shipping_methods') === NULL) 
						{
							$json['error'] = $this->lang->line('error_no_shipping');
						} 
						else 
						{
							$shipping_methods = $this->session->userdata('shipping_methods');
							$shipping = explode('.', $this->input->post('shipping_method'));

							if (!isset($shipping[0]) || !isset($shipping[1]) || !isset($shipping_methods[$shipping[0]]['quote'][$shipping[1]])) {
								$json['error'] = $this->lang->line('error_shipping_method');
							}
						}

						if (!$json) {
							$this->session->set_userdata('shipping_method',$shipping_methods[$shipping[0]]['quote'][$shipping[1]]);
						}
					}

					if ($this->session->userdata('shipping_method') === NULL) 
					{
						$json['error'] = $this->lang->line('error_shipping_method');
					}
				} 
				else 
				{
					$this->session->unset_userdata('shipping_address');
					$this->session->unset_userdata('shipping_method');
					$this->session->unset_userdata('shipping_methods');
				}

				// Cart
				if ((!$this->mycart->hasProducts() && $this->session->userdata('vouchers') === NULL) || (!$this->mycart->hasStock() && !$this->common->config('config_stock_checkout'))) {
					$json['error'] = $this->lang->line('error_stock');
				}

				// Validate minimum quantity requirements.
				$products = $this->mycart->getProducts();

				foreach ($products as $product) 
				{
					$product_total = 0;

					foreach ($products as $product_2) {
						if ($product_2['product_id'] == $product['product_id']) {
							$product_total += $product_2['quantity'];
						}
					}

					if ($product['minimum'] > $product_total) {
						$json['error'] = sprintf($this->lang->line('error_minimum'), $product['name'], $product['minimum']);

						break;
					}
				}

				if (!$json) {
					$order_data = array();

				// Store Details
				$order_data['invoice_prefix'] = $this->common->config('config_invoice_prefix');
				
				$customer_details = $this->session->userdata('customer');
				// Customer Details
				$order_data['customer_id'] = $customer_details['customer_id'];
				$order_data['customer_group_id'] = $customer_details['customer_group_id'];
				$order_data['firstname'] = $customer_details['firstname'];
				$order_data['lastname'] = $customer_details['lastname'];
				$order_data['email'] = $customer_details['email'];
				$order_data['telephone'] = $customer_details['telephone'];
				
				$payment_details = $this->session->userdata('payment_address');
				// Payment Details
				$order_data['payment_firstname'] = $payment_details['firstname'];
				$order_data['payment_lastname'] = $payment_details['lastname'];
				$order_data['payment_company'] =$payment_details['company'];
				$order_data['payment_address_1'] = $payment_details['address_1'];
				$order_data['payment_address_2'] = $payment_details['address_2'];
				$order_data['payment_city'] = $payment_details['city'];
				$order_data['payment_postcode'] = $payment_details['postcode'];
				$order_data['payment_zone'] = $payment_details['zone'];
				$order_data['payment_state_id'] = $payment_details['zone_id'];
				$order_data['payment_country'] = $payment_details['country'];
				$order_data['payment_country_id'] = $payment_details['country_id'];
				
				$payment_method_details = $this->session->userdata('payment_method');
				if (isset($payment_method_details['title'])) 
				{
					$order_data['payment_method'] = $payment_method_details['title'];
				} else {
					$order_data['payment_method'] = '';
				}

				if (isset($payment_method_details['code'])) {
					$order_data['payment_code'] = $payment_method_details['code'];
				} else {
					$order_data['payment_code'] = '';
				}

					// Shipping Details
				if ($this->mycart->hasShipping()) 
				{
					$shipping_details = $this->session->userdata('shipping_address');
					$order_data['shipping_firstname'] = $shipping_details['firstname'];
					$order_data['shipping_lastname'] = $shipping_details['lastname'];
					$order_data['shipping_company'] = $shipping_details['company'];
					$order_data['shipping_address_1'] = $shipping_details['address_1'];
					$order_data['shipping_address_2'] = $shipping_details['address_2'];
					$order_data['shipping_city'] = $shipping_details['city'];
					$order_data['shipping_postcode'] = $shipping_details['postcode'];
					$order_data['shipping_zone'] = $shipping_details['zone'];
					$order_data['shipping_state_id'] = $shipping_details['zone_id'];
					$order_data['shipping_country'] = $shipping_details['country'];
					$order_data['shipping_country_id'] = $shipping_details['country_id'];
					
					$shipping_method = $this->session->userdata('shipping_method');
					if (isset($shipping_method['title'])) 
					{
						$order_data['shipping_method'] = $shipping_method['title'];
					} 
					else 
					{
						$order_data['shipping_method'] = '';
					}

					if (isset($shipping_method['code'])) 
					{
						$order_data['shipping_code'] = $shipping_method['code'];
					} 
					else 
					{
						$order_data['shipping_code'] = '';
					}
				} 
				else 
				{
					$order_data['shipping_firstname'] = '';
					$order_data['shipping_lastname'] = '';
					$order_data['shipping_company'] = '';
					$order_data['shipping_address_1'] = '';
					$order_data['shipping_address_2'] = '';
					$order_data['shipping_city'] = '';
					$order_data['shipping_postcode'] = '';
					$order_data['shipping_zone'] = '';
					$order_data['shipping_state_id'] = '';
					$order_data['shipping_country'] = '';
					$order_data['shipping_country_id'] = '';
					$order_data['shipping_method'] = '';
					$order_data['shipping_code'] = '';
				}
					// Products
					$order_data['products'] = array();

					foreach ($this->mycart->getProducts() as $product) {
						$option_data = array();

						foreach ($product['option'] as $option) {
							$option_data[] = array(
								'product_option_id'       => $option['product_option_id'],
								'product_option_value_id' => $option['product_option_value_id'],
								'option_id'               => $option['option_id'],
								'option_value_id'         => $option['option_value_id'],
								'name'                    => $option['name'],
								'value'                   => $option['value'],
								'type'                    => $option['type']
							);
						}

						$order_data['products'][] = array(
							'product_id' => $product['product_id'],
							'name'       => $product['name'],
							'model'      => $product['model'],
							'option'     => $option_data,
							'download'   => $product['download'],
							'quantity'   => $product['quantity'],
							'subtract'   => $product['subtract'],
							'price'      => $product['price'],
							'total'      => $product['total'],
							'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id']),
							
						);
					}

					// Gift Voucher
					$order_data['vouchers'] = array();

					if ($this->session->userdata('vouchers') !== NULL) 
					{
						foreach ($this->session->userdata('vouchers') as $voucher) 
						{
							$order_data['vouchers'][] = array(
								'description'      => $voucher['description'],
								'code'             => $this->commons->token(10),
								'to_name'          => $voucher['to_name'],
								'to_email'         => $voucher['to_email'],
								'from_name'        => $voucher['from_name'],
								'from_email'       => $voucher['from_email'],
								'voucher_theme_id' => $voucher['voucher_theme_id'],
								'message'          => $voucher['message'],
								'amount'           => $voucher['amount']
							);
						}
					}

					$order_data['totals'] = array();
				$total_data = array();
				$total = 0;
				$taxes = $this->mycart->getTaxes();

				$sort_order = array();

				
				$results[]=array('code'=>'sub_total');
				$results[]=array('code'=>'shipping');
				$results[]=array('code'=>'tax');
				$results[]=array('code'=>'coupon');
				$results[]=array('code'=>'voucher');
				$results[]=array('code'=>'total');
				
				foreach ($results as $result) 
				{
					
						$this->load->model('api/Total_'.$result['code'].'_model',$result['code'].'_model');
						$model = $result['code'].'_model';
						$this->$model->getTotal($total_data, $total, $taxes);
					
				}

				if ($this->input->post('comment'))
				{
					$order_data['comment'] = $this->input->post('comment');
				} 
				else 
				{
					$order_data['comment'] = '';
				}

				$order_data['total'] = $total;

				$order_data['tracking'] = '';

					$this->api_order_model->editOrder($order_id, $order_data);

					// Set the order history
					if ($this->input->post('order_status_id') !=="") 
					{
						$order_status_id = $this->input->post('order_status_id');
					} 
					else 
					{
						$order_status_id = $this->common->config('config_order_status_id');
					}

					$this->api_order_model->addOrderHistory($order_id, $order_status_id);

					$json['success'] = ' Success: You have modified orders! ';
				}
			}
			 else
			  {
				$json['error'] = $this->lang->line('error_not_found');
			}
		}

		// if (isset($this->request->server['HTTP_ORIGIN'])) {
		// 	$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
		// 	$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		// 	$this->response->addHeader('Access-Control-Max-Age: 1000');
		// 	$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		// }

		// $this->response->addHeader('Content-Type: application/json');
		// $this->response->setOutput(json_encode($json));

		echo json_encode($json);
	}

	public function delete() {
		$json = array();
		$this->load->model('api/api_order_model','api_order_model');
		if (!($this->input->server('REQUEST_METHOD') == 'POST')) {
			$json['error'] = $this->lang->line('error_permission');
		} else {
			

			if ($this->input->post('order_id') !== "") 
			{
				$order_id = $this->input->post('order_id');
			} 
			else 
			{
				$order_id = 0;
			}

			$order_info = $this->api_order_model->getOrder($order_id);

			if ($order_info) 
			{
				$this->api_order_model->deleteOrder($order_id);

				$json['success'] = $this->lang->line('text_success');
			} 
			else 
			{
				$json['error'] = $this->lang->line('error_not_found');
			}
		}

		// if (isset($this->request->server['HTTP_ORIGIN'])) {
		// 	$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
		// 	$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		// 	$this->response->addHeader('Access-Control-Max-Age: 1000');
		// 	$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		// }

		// $this->response->addHeader('Content-Type: application/json');
		// $this->response->setOutput(json_encode($json));

		echo json_encode($json);

	}

	public function history() {
		$json = array();

		if (!($this->input->server('REQUEST_METHOD') == 'POST')) {
			$json['error'] = $this->lang->line('error_permission');
		} 
		else 
		{
			$this->load->model('api/api_order_model','api_order_model');

			if ($this->input->post('order_id') !== "") 
			{
				$order_id = $this->input->post('order_id');
			} else {
				$order_id = 0;
			}

			$order_info = $this->api_order_model->getOrder($order_id);

			if ($order_info) 
			{
				$this->api_order_model->addOrderHistory($order_id, $this->input->post('order_status_id'), $this->input->post('comment'), $this->input->post('notify'));

				$json['success'] = "Success: You have modified orders!";
			} else {
				$json['error'] = $this->lang->line('error_not_found');
			}
		}

		// if (isset($this->request->server['HTTP_ORIGIN'])) {
		// 	$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
		// 	$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		// 	$this->response->addHeader('Access-Control-Max-Age: 1000');
		// 	$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		// }

		// $this->response->addHeader('Content-Type: application/json');
		// $this->response->setOutput(json_encode($json));

		echo json_encode($json);
	}
}
