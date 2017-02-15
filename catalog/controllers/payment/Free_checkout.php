<?php

class Free_checkout extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		$this->load->library('tax');
		$this->load->library('mycart');
		$this->load->library('customer');
		
		$this->load->model('account/address_model','address');

		$this->load->model('system/country_model','country');

		$this->load->model('system/zone_model','zone');

		$this->load->model('account/customer_model','customers');
	}
	public function index() {
		
		$data['action']=site_url('checkout/success');
		$site_theme = $this->common->config('catalog_theme');
		$this->load->view("themes/".$site_theme."/payment/free_checkout",$data);
			
			
		}
	}
	
	
	

 
?>