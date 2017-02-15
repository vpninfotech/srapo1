<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Shipping_address extends CI_Controller {
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
		$this->load->language('checkout/checkout');

		$data['text_address_existing'] = $this->language->get('text_address_existing');
		$data['text_address_new'] = $this->language->get('text_address_new');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_loading'] = $this->language->get('text_loading');

		$data['entry_firstname'] = $this->language->get('entry_firstname');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_company'] = $this->language->get('entry_company');
		$data['entry_address_1'] = $this->language->get('entry_address_1');
		$data['entry_address_2'] = $this->language->get('entry_address_2');
		$data['entry_postcode'] = $this->language->get('entry_postcode');
		$data['entry_city'] = $this->language->get('entry_city');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['entry_zone'] = $this->language->get('entry_zone');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_upload'] = $this->language->get('button_upload');

		if (isset($this->session->data['shipping_address']['address_id'])) {
			$data['address_id'] = $this->session->data['shipping_address']['address_id'];
		} else {
			$data['address_id'] = $this->customer->getAddressId();
		}

		$this->load->model('account/address');

		$data['addresses'] = $this->model_account_address->getAddresses();

		if (isset($this->session->data['shipping_address']['postcode'])) {
			$data['postcode'] = $this->session->data['shipping_address']['postcode'];
		} else {
			$data['postcode'] = '';
		}

		if (isset($this->session->data['shipping_address']['country_id'])) {
			$data['country_id'] = $this->session->data['shipping_address']['country_id'];
		} else {
			$data['country_id'] = $this->config->get('config_country_id');
		}

		if (isset($this->session->data['shipping_address']['zone_id'])) {
			$data['zone_id'] = $this->session->data['shipping_address']['zone_id'];
		} else {
			$data['zone_id'] = '';
		}

		$this->load->model('localisation/country');

		$data['countries'] = $this->model_localisation_country->getCountries();

		// Custom Fields
		$this->load->model('account/custom_field');

		$data['custom_fields'] = $this->model_account_custom_field->getCustomFields($this->config->get('config_customer_group_id'));

		if (isset($this->session->data['shipping_address']['custom_field'])) {
			$data['shipping_address_custom_field'] = $this->session->data['shipping_address']['custom_field'];
		} else {
			$data['shipping_address_custom_field'] = array();
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/shipping_address.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/checkout/shipping_address.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/checkout/shipping_address.tpl', $data));
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


			if ($this->input->post('shipping_address_exists') && $this->input->post('shipping_address_exists') == 'existing') {
				
				if ($this->input->post('address_id')=="") {
					$json['error']['warning'] = $this->lang->line('error_address');
				} elseif (!in_array($this->input->post('address_id'), array_keys($this->address->getAddresses()))) {
					$json['error']['warning'] = $this->lang->line('error_address');
				}

				if (!$json) {
					$this->session->set_userdata('shipping_address',$this->address->getAddress($this->input->post('address_id')));

					$this->session->unset_userdata('shipping_method');
					$this->session->unset_userdata('shipping_methods');
				}
			} 
			else {
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

					$this->session->userdata('shipping_address',$this->address->getAddress($address_id));

					$this->session->unset_userdata('shipping_method');
					$this->session->unset_userdata('shipping_methods');

					$json['success'] ="Your Shipping Address is set Successfully!";

				}
			}
		}

		echo json_encode($json);
	}
}