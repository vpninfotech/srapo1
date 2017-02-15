<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {
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
	public function index()
	{
		// echo "<pre>";
		// print_r($this->session->all_userdata());

		if(!$this->customer->isLogged())
		{
			redirect('checkout/cart');
		}
		$this->document->setTitle($this->lang->line('heading_title'));
		
		$this->document->setDescription($this->common->config('config_meta_description'));
		
		$this->document->setKeywords($this->common->config('config_meta_keyword'));
		
		$data['header'] = $this->headers->getHeaders();

	
		// Validate cart has products and has stock.
		if ((!$this->mycart->hasProducts() && $this->session->userdata('vouchers') == NULL) || (!$this->mycart->hasStock() && !$this->common->config('config_stock_checkout'))) {
			redirect('checkout/cart');
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
				redirect('checkout/cart');
			}
		}

		$this->document->setTitle($this->lang->line('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => 'Home',
			'href' => site_url('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('text_cart'),
			'href' => site_url('checkout/cart')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('heading_title'),
			'href' => site_url('checkout/checkout')
		);

		$data['heading_title'] = $this->lang->line('heading_title');

		$data['text_checkout_option'] = $this->lang->line('text_checkout_option');
		$data['text_checkout_account'] = $this->lang->line('text_checkout_account');
		$data['text_checkout_payment_address'] = $this->lang->line('text_checkout_payment_address');
		$data['text_checkout_shipping_address'] = $this->lang->line('text_checkout_shipping_address');
		$data['text_checkout_shipping_method'] = $this->lang->line('text_checkout_shipping_method');
		$data['text_checkout_payment_method'] = $this->lang->line('text_checkout_payment_method');
		$data['text_checkout_confirm'] = $this->lang->line('text_checkout_confirm');

		if ($this->session->userdata('error') !== NULL) 
		{
			$data['error_warning'] = $this->session->userdata('error');
			$this->session->unset_userdata('error');
		} else {
			$data['error_warning'] = '';
		}

		$data['logged'] = $this->customer->isLogged();

		if ($this->session->userdata('account') !== NULL) {
			$data['account'] = $this->session->userdata('account');
		} else {
			$data['account'] = '';
		}

		$data['shipping_required'] = $this->mycart->hasShipping();
		$data['addresses'] = $this->address->getAddresses();
		$data['country_id'] = $this->common->getCountryIdByName($this->session->userdata('country_name'));
		$data['countries'] = $this->country->getCountries();

		$site_theme = $this->common->config('catalog_theme');
		$this->load->view("themes/".$site_theme."/checkout/checkout",$data);
	}
	
	public function success()
	{
		$this->document->setTitle($this->lang->line('heading_title'));
		
		$this->document->setDescription($this->common->config('config_meta_description'));
		
		$this->document->setKeywords($this->common->config('config_meta_keyword'));
		
		$data['header'] = $this->headers->getHeaders();

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => 'Home',
			'href' => site_url('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('text_cart'),
			'href' => site_url('checkout/cart')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('heading_title'),
			'href' => site_url('checkout/checkout')
		);


		$site_theme = $this->common->config('catalog_theme');
		$this->load->view("themes/".$site_theme."/common/success",$data);
	}
	public function country() {
		$this->output->unset_template();
		$json = array();

		$country_info = $this->country->getCountry($this->input->post('country_id'));

		if ($country_info) {
			$json = array(
				'country_id'        => $country_info['country_id'],
				'country_name'      => $country_info['country_name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code'       	=> $country_info['iso_code'],
				'postcode_required' => 1,
				'zone'              => $this->zone->getZoneByCountryId($this->input->post('country_id')),
				'status'            => $country_info['status']
			);
		}

		echo json_encode($json);
	}

	 public function getAddress() 
    {
        $this->output->unset_template();
        $json = array();

        if ($this->input->post('address_id'))
        {

            $json = $this->customers->getAddress($this->input->post('address_id'));
        }

        echo json_encode($json);
    }
}
