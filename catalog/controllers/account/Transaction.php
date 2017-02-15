<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		
		$this->_init();
	}
	
	private function _init() {
		
		//--Set Template
		$this->output->set_template('site_template');
		$site_theme = $this->common->config('catalog_theme');
		$this->output->set_common_meta('Product','sarpo','Home Page');
		

	}
	public function index()
	{
		$site_theme = $this->common->config('catalog_theme');
		
		$this->load->view("themes/".$site_theme."/account/transaction");
	}

}
