<?php
class Confirm extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		$this->load->library('tax');
		$this->load->library('mycart');
		$this->load->library('customer');
		$this->lang->load('checkout/checkout','english');
		
		$this->load->model('account/address_model','address');

		$this->load->model('checkout/order_model','order');

		$this->load->model('system/country_model','country');

		$this->load->model('system/zone_model','zone');

		$this->load->model('account/customer_model','customers');
		
	}

	public function index() {

		// echo "<pre>";
		// print_r($this->session->all_userdata());exit;
		$this->output->unset_template();
		$json="";
		$json['redirect'] = '';
		if($this->input->post('agree') === NULL)
		{
			$json['error']['warning'] = 'Warning: You must agree to the Terms & Conditions!' ;
		}
		if($this->input->post('payment_method') === NULL)
		{
			$json['error']['warning'] = 'Warning: No Payment options are available!';
		}
		if($this->input->post('shipping_method') === NULL)
		{
			$json['error']['warning'] = 'Warning: No Shipping options are available!';
		}
		
		if ($this->mycart->hasShipping()) {
			// Validate if shipping address has been set.
			if ($this->session->userdata('shipping_address') === NULL) 
			{
				$json['redirect'] = site_url('checkout/checkout');
				$json['error'] = "Warning: Shipping method required!";
			}

			// Validate if shipping method has been set.
			if ($this->session->userdata('shipping_method') === NULL) {
				$json['redirect'] = site_url('checkout/checkout');
				$json['error'] = "Warning: Shipping address required!";
			}
		} else {
			$this->session->unser_userdata('shipping_address');
			$this->session->unser_userdata('shipping_method');
			$this->session->unser_userdata('shipping_methods');
		}

		// Validate if payment address has been set.
		if ($this->session->userdata('payment_address') === NULL) 
		{
			$json['error'] = 'Warning: Payment address required!';
		}

		// Validate if payment method has been set.
		if ($this->session->userdata('payment_method')  === NULL) 
		{
			$json['error'] = 'Warning: Payment method required!';
		}

		// Validate cart has products and has stock.
		if ((!$this->mycart->hasProducts() && $this->session->userdata('vouchers') || (!$this->mycart->hasStock() && !$this->common->config('config_stock_checkout')))) {
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

		if (!isset($json['error']) &&  $json['redirect'] =='') {
			$json['success'] = "Success";
			$order_data = array();

			$order_data['totals'] = array();
			$total = 0;
			$taxes = $this->mycart->getTaxes();

			$results[]=array('code'=>'sub_total');
			$results[]=array('code'=>'shipping');
			$results[]=array('code'=>'tax');
			$results[]=array('code'=>'coupon');
			$results[]=array('code'=>'voucher');
			$results[]=array('code'=>'total');
			
			foreach ($results as $result) {
			
				$this->load->model('api/Total_'.$result['code'].'_model',$result['code'].'_model');
				$model = $result['code'].'_model';
				$this->$model->getTotal($order_data['totals'], $total, $taxes);
			
			}
				
			$order_data['invoice_prefix'] = $this->common->config('config_invoice_prefix');
			$order_data['store_id'] = $this->common->config('config_store_id');
			$order_data['store_name'] = $this->common->config('config_name');

			

			if ($this->customer->isLogged()) {
				$this->load->model('account/customer_model','customers');

				$customer_info = $this->customers->getCustomerById($this->session->userdata('customer_id'));

				$order_data['customer_id'] = $this->session->userdata('customer_id');
				$order_data['customer_group_id'] = $customer_info['group_id'];
				$order_data['firstname'] = $customer_info['firstname'];
				$order_data['lastname'] = $customer_info['lastname'];
				$order_data['email'] = $customer_info['email'];
				$order_data['telephone'] = $customer_info['telephone'];
				
			} 

			$payment_address = $this->session->userdata('payment_address');
			$order_data['payment_firstname'] = $payment_address['firstname'];
			$order_data['payment_lastname'] = $payment_address['lastname'];
			$order_data['payment_company'] = $payment_address['company'];
			$order_data['payment_address_1'] = $payment_address['address_1'];
			$order_data['payment_address_2'] = $payment_address['address_2'];
			$order_data['payment_city'] = $payment_address['city'];
			$order_data['payment_postcode'] = $payment_address['postcode'];
			$order_data['payment_zone'] = $payment_address['zone'];
			$order_data['payment_state_id'] = $payment_address['zone_id'];
			$order_data['payment_country'] = $payment_address['country'];
			$order_data['payment_country_id'] = $payment_address['country_id'];
			
			$payment_method = $this->session->userdata('payment_method');
			if (isset($payment_method['title'])) 
			{
				$order_data['payment_method'] = $payment_method['title'];
			} else {
				$order_data['payment_method'] = '';
			}

			if (isset($payment_method['code'])) {
				$order_data['payment_code'] = $payment_method['code'];
			} else {
				$order_data['payment_code'] = '';
			}

			if ($this->mycart->hasShipping()) 
			{
				$shipping_address = $this->session->userdata('shipping_address');
				$order_data['shipping_firstname'] = $shipping_address['firstname'];
				$order_data['shipping_lastname'] = $shipping_address['lastname'];
				$order_data['shipping_company'] = $shipping_address['company'];
				$order_data['shipping_address_1'] = $shipping_address['address_1'];
				$order_data['shipping_address_2'] = $shipping_address['address_2'];
				$order_data['shipping_city'] = $shipping_address['city'];
				$order_data['shipping_postcode'] = $shipping_address['postcode'];
				$order_data['shipping_zone'] = $shipping_address['zone'];
				$order_data['shipping_state_id'] = $shipping_address['zone_id'];
				$order_data['shipping_country'] = $shipping_address['country'];
				$order_data['shipping_country_id'] = $shipping_address['country_id'];
				
				$shipping_method = $this->session->userdata('shipping_method');
				if (isset($shipping_method['title'])) {
					$order_data['shipping_method'] = $shipping_method['title'];
				} else {
					$order_data['shipping_method'] = '';
				}

				if (isset($shipping_method['code'])) {
					$order_data['shipping_code'] = $shipping_method['code'];
				} else {
					$order_data['shipping_code'] = '';
				}
			} else {
				$order_data['shipping_firstname'] = '';
				$order_data['shipping_lastname'] = '';
				$order_data['shipping_company'] = '';
				$order_data['shipping_address_1'] = '';
				$order_data['shipping_address_2'] = '';
				$order_data['shipping_city'] = '';
				$order_data['shipping_postcode'] = '';
				$order_data['shipping_zone'] = '';
				$order_data['shipping_zone_id'] = '';
				$order_data['shipping_country'] = '';
				$order_data['shipping_country_id'] = '';
				$order_data['shipping_address_format'] = '';
				$order_data['shipping_custom_field'] = array();
				$order_data['shipping_method'] = '';
				$order_data['shipping_code'] = '';
			}

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

			$order_data['comment'] = $this->input->post('comment');
			$order_data['total'] = $total;
			$order_data['tracking'] = "";

			$order_data['currency_id'] = $this->currency->getId();
			$order_data['currency_code'] = $this->currency->getCode();
			$order_data['currency_value'] = $this->currency->getValue($this->currency->getCode());
			

			$this->session->set_userdata('order_id',$this->order->addOrder($order_data));
			$payment_method = $this->session->userdata('payment_method');
			if($payment_method['code'] =='free_checkout')
			{
				$this->order->addOrderHistory($this->session->userdata('order_id'), $this->common->config('config_order_status_id'));
			}
						
		} 
		echo json_encode($json);
	}
}
