<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends CI_Controller {
	function __construct()
	{
            parent::__construct();

            $this->_init();
            
            $this->rbac->CheckAuthentication();
            
            $this->lang->load('account/newsletter_lang', 'english');
            
            $this->load->model('account/customer_model', 'customers');
	}
	
	private function _init() {
		
            //--Set Template
            $this->output->set_template('site_template');
            $site_theme = $this->common->config('catalog_theme');
            $this->output->set_common_meta('Newsletter','sarpo','Newsletter Page');		

	}
        
        public function index()
	{
            if(($this->input->server('REQUEST_METHOD') == 'POST')) 
            {
                $res = $this->customers->editNewsletter();
                if($res){
                   $this->session->set_userdata('success',$this->lang->line('text_success')); 
                   redirect('account/account');
                }
            }
            $this->getForm();
	}
        
        /**
	* 
	* @function name : getForm()
	* @description   : Generate Form for Add and Edit Records
	* @param   	 : void
	* @return        : void
	*
	*/
	public function getForm()
	{
            // Transaction Status
            if (isset($this->error['warning'])) 
            {
                $data['error_warning'] = $this->error['warning'];
            } 
            else 
            {
                $data['error_warning'] = '';
            }
		
            if ($this->session->userdata('success')!==NULL) 
            {
                $data['success'] = $this->session->userdata('success');

                $this->session->unset_userdata('success');
            } 
            else 
            {
                $data['success'] = '';
            }
            
            // breadcrumbs
            $data['breadcrumbs']   = array();
            $data['breadcrumbs'][] = array(
               'text' => '<i class="glyphicon glyphicon-home"></i> Home',
               'href' => site_url('common/home'),

            );
            $data['breadcrumbs'][] = array(
               'text' => 'Account',  
               'href' => site_url('account/account'),

            );
            $data['breadcrumbs'][] = array(
               'text' => 'Newsletter',  
               'href' => site_url('account/newsletter'),

            );
           
            $data['form_action'] = site_url('account/newsletter');
            
		
            // Set Value Back
            if (1) 
            {
                $user_info = $this->customers->getCustomerById($this->session->userdata('customer_id'));
            }            
                       
            
            if ($this->input->post('newsletter')!==NULL) {
                    $data['newsletter'] = $this->input->post('newsletter');
            } elseif (!empty($user_info)) {

                    $data['newsletter'] = $user_info['newsletter'];
            } else {
                    $data['newsletter'] = '';
            }
            
            
            $data['customer_id'] = $this->session->userdata('customer_id');
            
            $this->document->setTitle('title');
            $this->document->setDescription('description');
            $this->document->setKeywords('keyword');
	    $data['header'] = $this->headers->getHeaders();
            $site_theme = $this->common->config('catalog_theme');
            $this->load->section('content', "themes/".$site_theme."/account/newsletter",$data);
            $this->load->view("themes/".$site_theme."/account/account",$data);
	}
}
