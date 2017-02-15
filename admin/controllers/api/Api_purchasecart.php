<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Api_purchasecart
* @Auther       : Mitesh
* @Date         : 26-12-2016
* @Description  : Api purchase cart Operation
*
*/

class Api_purchasecart extends CI_Controller 
{
	private $data=array();
	private $error = array();
	
	function __construct()
	{
            parent::__construct();

            $this->_init();

            $this->rbac->CheckAuthentication();

            $this->load->model('purchase/purchase_model','purchase');
			
			$this->load->model('catalog/manufacturer_model','manufacturers');

            $this->lang->load('api/api_purchasecart_lang', 'english');

            $this->load->model('common');

            $this->load->library('commons');

            $this->load->library('pagination');

            $this->load->library('purchasecart');
			
			$this->load->library('manufacturer');
			
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
		
	//add
	public function add() {
		$json = array();

		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{			
			$manufacturer_id=$this->input->post('select_manufacturers');
			
			if ($this->input->post('product')) {
				$this->purchasecart->clear();
				
				foreach ($this->input->post('product') as $product) {
					
					if (isset($product['option'])) {
						$option = $product['option'];						
					} else {
						$option = array();
					}
					
					
					$this->purchasecart->add($product['product_id'], $manufacturer_id, $product['quantity'], $option);						
				}


				$json['success'] = $this->lang->line('text_success_purchase');
				
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
												
						$this->purchasecart->add($this->input->post('product_id'), $manufacturer_id, $quantity, $option);

						$json['success'] = $this->lang->line('text_success_purchase');

						
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


		echo json_encode($json);
	}
	
	
	
	//add quantity
	public function addQuantity() {
		$json = array();
		
		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{
			
			$product_data=$this->input->post('product');
			
			if ($this->input->post('product')) {
				$this->purchasecart->clear();

				foreach ($this->input->post('product') as $product) {
					
					if (isset($product['option'])) {
						$option = $product['option'];
					} else {
						$option = array();
					}

		
					$this->purchasecart->addQty($product['product_id'], $product['quantity'], $option);
				}

				$json['success'] = $this->lang->line('text_success_purchase');
				
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

						$json['success'] = $this->lang->line('text_success_purchase');

						
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

		echo json_encode($json);
	}

	public function edit() 
	{
		$json = array();

		if (($this->input->server('REQUEST_METHOD') == 'POST')) 
		{
			$this->purchasecart->update($this->input->post('key'), $this->input->post('quantity'));

			$json['success'] = $this->lang->line('text_success');

			$this->session->unset_userdata('shipping_method');
			$this->session->unset_userdata('shipping_methods');
			$this->session->unset_userdata('payment_method');
			$this->session->unset_userdata('payment_methods');
		}

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
				
				$this->purchasecart->remove($this->input->post('key'));
			
				$json['success'] = $this->lang->line('text_success_purchase');
				
				
			}
		}
		

		echo json_encode($json);
	}

	public function products() 
	{
		$json = array();
		
		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{			
			// Products
			$json['products'] = array();
			
			$products = $this->purchasecart->getProducts();
						 
			//calculate total	
			$json['totals']=$this->purchasecart->getPurchaseTotal();
			
			if(count($products) > 0)
			{ 
				foreach ($products as $product) {
					$product_total = 0;
	
					foreach ($products as $product_2) {
						if ($product_2['product_id'] == $product['product_id']) {
							$product_total += $product_2['quantity'];
						}
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
						'purchase_cart_id'    => $product['purchase_cart_id'],
						'product_id' => $product['product_id'],
						'name'       => $product['name'],
						'model'      => $product['model'],
						'option'     => $option_data,
						'quantity'   => $product['quantity'],					
						'price'      => $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->common->config('config_tax'))),
						'total'      => $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->common->config('config_tax')) * $product['quantity']),					
					);
				}	
			}
			else
			{
				// Products
				$json['products'] = array();
			}
		}
		
		echo json_encode($json);
	}
	
	//get total 
	public function getTotal()
	{
		$json=$this->purchasecart->getPurchaseTotal();
		return $json;
	}
	
	//get details view of purchase product
	public function getViewPurchaseProduct()
	{
		$manufacturer_id=$this->input->post('manufacturer_id');
		$purchase_id=$this->input->post('purchase_id');
		
		$json=$this->purchasecart->getPurchaseProductsData($manufacturer_id,$purchase_id);
		//return $json;
		echo json_encode($json);
	}
	
}
