<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Api_cart
* @Auther       : Indrajit
* @Date         : 20-12-2016
* @Description  : Api customers Operation
*
*/

class Api_cart extends CI_Controller 
{
	private $data=array();
	private $error = array();
	function __construct()
	{
            parent::__construct();

            $this->_init();

            $this->rbac->CheckAuthentication();

            $this->load->model('customers/Customer_groups_model','customers_group');
			
			$this->load->model('customers/customers_model','customers');

            $this->lang->load('api/api_cart_lang', 'english');

            $this->load->model('common');

            $this->load->library('commons');

            $this->load->library('pagination');

            $this->load->library('mycart');

            $this->load->library('currency');

            $this->load->library('tax');
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
	public function add() {
		$json = array();

		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{
			if ($this->input->post('product')) 
			{
				$this->mycart->clear();

				foreach ($this->input->post('product') as $product) {
					if (isset($product['option'])) {
						$option = $product['option'];
					} else {
						$option = array();
					}

					$this->mycart->add($product['product_id'], $product['quantity'], $option);
				}

				$json['success'] = $this->lang->line('text_success');
				$this->session->unset_userdata('shipping_method');
				$this->session->unset_userdata('shipping_methods');
				$this->session->unset_userdata('payment_method');
				$this->session->unset_userdata('payment_methods');
			}
			elseif ($this->input->post('product_id'))
			{
				$this->load->model('catalog/product_model','product');

				$product_info = $this->product->getProduct($this->input->post('product_id'));

				if ($product_info)
				{
					if ($this->input->post('quantity'))
					{
						$quantity = $this->input->post('quantity');
					} 
					else {
						$quantity = 1;
					}

					if ($this->input->post('option'))
					{
						$option = array_filter($this->input->post('option'));
					} 
					else
					{
						$option = array();
					}

					$product_options = $this->product->getProductOptions($this->input->post('product_id'));

					foreach ($product_options as $product_option) 
					{
						if ($product_option['required'] && empty($option[$product_option['product_option_id']])) {
							$json['error']['option'][$product_option['product_option_id']] = sprintf($this->lang->line('error_required'), $product_option['name']);
						}
					}

					if (!isset($json['error']['option'])) {
						$this->mycart->add($this->input->post('product_id'), $quantity, $option);

						$json['success'] = $this->lang->line('text_success');

						$this->session->unset_userdata('shipping_method');
						$this->session->unset_userdata('shipping_methods');
						$this->session->unset_userdata('payment_method');
						$this->session->unset_userdata('payment_methods');
					}
				} else {
					$json['error']['store'] = $this->lang->line('error_store');
				}
			}
		}
		else
		{
			$json['warning'] = $this->lang->line('error_required');
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
		$json = array();

		if (($this->input->server('REQUEST_METHOD') == 'POST')) 
		{
			$this->mycart->update($this->input->post('key'), $this->input->post('quantity'));

			$json['success'] = $this->lang->line('text_success');

			$this->session->unset_userdata('shipping_method');
			$this->session->unset_userdata('shipping_methods');
			$this->session->unset_userdata('payment_method');
			$this->session->unset_userdata('payment_methods');
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

	public function remove() 
	{
		

		$json = array();

		if (($this->input->server('REQUEST_METHOD') == 'POST'))  
		{
			// Remove
			if ($this->input->post('key')) 
			{
				$this->mycart->remove($this->input->post('key'));
				if($this->session->userdata('vouchers') !== NULL)
				{
					$vouchers = $this->session->userdata('vouchers');
					unset($vouchers[$this->input->post('key')]);
					$this->session->set_userdata('vouchers', $vouchers);	
				}
				
				


				$json['success'] = $this->lang->line('text_success');
				
				$this->session->unset_userdata('shipping_method');
				$this->session->unset_userdata('shipping_methods');
				$this->session->unset_userdata('payment_method');
				$this->session->unset_userdata('payment_methods');
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

	public function products() 
	{
		$json = array();
		$products = $this->mycart->getProducts();
			 // echo "<pre>";
			 // print_r($products);exit;
		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{
			// Stock
			if (!$this->mycart->hasStock() && (!$this->common->config('config_stock_checkout') || $this->common->config('config_stock_warning'))) {
				$json['error']['stock'] = $this->lang->line('error_stock');
			}

			// Products
			$json['products'] = array();

			$products = $this->mycart->getProducts();
			 // echo "<pre>";
			 // print_r($products);
			foreach ($products as $product) {
				$product_total = 0;

				foreach ($products as $product_2) {
					if ($product_2['product_id'] == $product['product_id']) {
						$product_total += $product_2['quantity'];
					}
				}

				if ($product['minimum'] > $product_total) {
					$json['error']['minimum'][] = sprintf($this->lang->line('error_minimum'), $product['name'], $product['minimum']);
				}

				$option_data = array();

				foreach ($product['option'] as $option) {
					$option_data[] = array(
						'product_option_id'       => $option['product_option_id'],
						'product_option_value_id' => $option['product_option_value_id'],
						'name'                    => $option['name'],
						'value'                   => $option['value'],
						'type'                    => $option['type']
					);
				}

				$json['products'][] = array(
					'cart_id'    => $product['cart_id'],
					'product_id' => $product['product_id'],
					'name'       => $product['name'],
					'model'      => $product['model'],
					'option'     => $option_data,
					'quantity'   => $product['quantity'],
					'stock'      => $product['stock'] ? true : !(!$this->common->config('config_stock_checkout') || $this->common->config('config_stock_warning')),
					'shipping'   => $product['shipping'],
					'price'      => $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->common->config('config_tax'))),
					'total'      => $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->common->config('config_tax')) * $product['quantity']),
					
				);
			}

			// Voucher
			$json['vouchers'] = array();

			if ($this->session->userdata('vouchers') !== NULL)
			{
				foreach ($this->session->userdata('vouchers') as $key => $voucher) {
					$json['vouchers'][] = array(
						'code'             => $voucher['code'],
						'description'      => $voucher['description'],
						'from_name'        => $voucher['from_name'],
						'from_email'       => $voucher['from_email'],
						'to_name'          => $voucher['to_name'],
						'to_email'         => $voucher['to_email'],
						'voucher_theme_id' => $voucher['voucher_theme_id'],
						'message'          => $voucher['message'],
						'amount'           => $this->currency->format($voucher['amount'])
					);
				}
			}

			// Totals
			//$this->load->model('extension/extension');

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
			
			foreach ($results as $result) {
				
					$this->load->model('api/Total_'.$result['code'].'_model',$result['code'].'_model');
					$model = $result['code'].'_model';
					$this->$model->getTotal($total_data, $total, $taxes);
				
			}

			// $sort_order = array();

			// foreach ($total_data as $key => $value) {
			// 	$sort_order[$key] = $value['sort_order'];
			// }

			// array_multisort($sort_order, SORT_ASC, $total_data);

			$json['totals'] = array();

			foreach ($total_data as $total) {
				$json['totals'][] = array(
					'title' => $total['title'],
					'text'  => $this->currency->format($total['value'])
				);
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