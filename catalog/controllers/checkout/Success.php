<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Success extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		
		$this->_init();
		$this->load->library('tax');
		$this->load->library('mycart');
		$this->load->library('customer');
		$this->lang->load('checkout/success_lang','english');
		
	}
	
	private function _init() {
		
		//--Set Template
		$this->output->set_template('site_template');
		$site_theme = $this->common->config('catalog_theme');
		

	}
	public function index() {
		$this->document->setTitle($this->lang->line('heading_title'));
		
		$this->document->setDescription($this->common->config('config_meta_description'));
		
		$this->document->setKeywords($this->common->config('config_meta_keyword'));
		
		$data['header'] = $this->headers->getHeaders();


		if ($this->session->userdata('order_id') !== NULL) {
			$this->mycart->clear();

			$this->session->unset_userdata('shipping_method');
			$this->session->unset_userdata('shipping_methods');
			$this->session->unset_userdata('payment_method');
			$this->session->unset_userdata('payment_methods');
			$this->session->unset_userdata('guest');
			$this->session->unset_userdata('comment');
			$this->session->unset_userdata('order_id');
			$this->session->unset_userdata('coupon');
			$this->session->unset_userdata('reward');
			$this->session->unset_userdata('voucher');
			$this->session->unset_userdata('vouchers');
			$this->session->unset_userdata('totals');
		}

		$this->document->setTitle($this->lang->line('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => 'Home',
			'href' => site_url('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('text_basket'),
			'href' => site_url('checkout/cart')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('text_checkout'),
			'href' => site_url('checkout/checkout')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('text_success'),
			'href' => site_url('checkout/success')
		);

		$data['heading_title'] = $this->lang->line('heading_title');

		if ($this->customer->isLogged()) {
			$data['text_message'] = sprintf($this->lang->line('text_customer'), site_url('account/account'), site_url('account/order'), site_url('account/download'));
		} else {
			$data['text_message'] = sprintf($this->lang->line('text_guest'), site_url('information/contact'));
		}

		$data['button_continue'] = $this->lang->line('button_continue');

		$data['continue'] = site_url('common/home');


		$site_theme = $this->common->config('catalog_theme');
		$this->load->view("themes/".$site_theme."/checkout/success",$data);
	}
}