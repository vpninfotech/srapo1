<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Account extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		
		$this->_init();
                //$this->load->library('document');
                //$this->load->library('headers');
	}
	
	private function _init() {
		
		//--Set Template
		$this->output->set_template('site_template');
		$site_theme = $this->common->config('catalog_theme');
		$this->output->set_common_meta('Product','sarpo','Home Page');
		

	}
	public function index()
	{
            $data['breadcrumbs']   = array();
            $data['breadcrumbs'][] = array(
               'text' => '<i class="glyphicon glyphicon-home"></i> Home',
               'href' => site_url('common/home'),

            );
            $data['breadcrumbs'][] = array(
               'text' => 'Account',  
               'href' => site_url('account/account'),

            );
            $this->session->unset_userdata('success1');
            //$data['success'] = $this->session->unset_userdata('success');
            $this->document->setTitle('title');
            $this->document->setDescription('description');
            $this->document->setKeywords('keyword');
	    $data['header'] = $this->headers->getHeaders();
            $site_theme = $this->common->config('catalog_theme');
            //$this->load->section('colom_right', "themes/".$site_theme."/common/colom_right");
            $this->load->view("themes/".$site_theme."/account/account",$data);
	}
        
        public function success()
        {
            $this->document->setTitle('title');
            $this->document->setDescription('description');
            $this->document->setKeywords('keyword');
            $data['header'] = $this->headers->getHeaders();
            $site_theme = $this->common->config('catalog_theme');
            $this->load->section('content', "themes/".$site_theme."/common/account_active_msg");
            $this->load->view("themes/".$site_theme."/common/success_msg",$data);
        }
        
    
	
}
