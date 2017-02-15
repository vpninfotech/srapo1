<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_password extends CI_Controller {
	function __construct()
	{
            parent::__construct();

            $this->_init();
            
            $this->rbac->CheckAuthentication();
            
            $this->lang->load('account/password_lang', 'english');
            
            $this->load->model('account/customer_model', 'customers');
	}
	
	private function _init() {
            //--Set Template
            $this->output->set_template('site_template');
            $site_theme = $this->common->config('catalog_theme');
            $this->output->set_common_meta('Product','sarpo','Home Page');
	}
        
	public function index()
	{
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) 
            {
                $res = $this->customers->editPassword();
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
               'text' => 'Change Password',  
               'href' => site_url('account/change_password'),

            );
           
            $data['form_action'] = site_url('account/change_password');
            
		
            // Set Value Back
            if ($this->input->post('password')!==NULL) {
                $data['password'] = $this->input->post('password');
            } else {
                $data['password'] = '';
            }

            if ($this->input->post('confirm_password')!==NULL) {
                $data['confirm_password'] = $this->input->post('confirm_password');
            } else {
                $data['confirm_password'] = '';
            }
            
            $this->document->setTitle('title');
            $this->document->setDescription('description');
            $this->document->setKeywords('keyword');
	    $data['header'] = $this->headers->getHeaders();
            $site_theme = $this->common->config('catalog_theme');
            $this->load->section('content', "themes/".$site_theme."/account/change_password",$data);
            $this->load->view("themes/".$site_theme."/account/account",$data);
	}
        
        /**
	* 
	* @function name 	: validateForm()
	* @description   	: Validate form data
	* @access 		: public
	* @param   		: void
	* @return        	: boolean
	*
	*/
	public function validateForm() {
            // Add or Edit Transaction
            
            $validation = array(
                            array(
                                'field' => 'password',
                                'label' => 'Password', 
                                'rules' => 'required|min_length[6]|max_length[32]', 
                                'errors' => array('required' => '%s must be between 6 and 32 characters!','min_length'=>'%s must be between 6 and 32 characters!','max_length'=>'%s must be between 6 and 32 characters!')
                            ),
					   
                            array(
                                'field' => 'confirm_password',
                                'label' => 'Confirm Password', 
                                'rules' => 'trim|matches[password]', 
                                'errors' => array('matches'=>'New Password and password confirmation do not match!')
                            )
                        );
                        $this->form_validation->set_rules($validation);
                        if ($this->form_validation->run() == FALSE) {
                            return FALSE;
                        }else{
                            return TRUE;
                        }
	}
}
