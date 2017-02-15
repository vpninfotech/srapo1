<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_account extends CI_Controller {
	function __construct()
	{
            parent::__construct();

            $this->_init();

            $this->rbac->CheckAuthentication();
            
            $this->lang->load('account/edit_lang', 'english');
            
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
                $res = $this->customers->editCustomer();
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
               'text' => 'Edit Information',  
               'href' => site_url('account/edit_account'),

            );
           
            $data['form_action'] = site_url('account/edit_account');
            
		
            // Set Value Back
            if (1) 
            {
                $user_info = $this->customers->getCustomerById($this->session->userdata('customer_id'));
            }            
            
            if ($this->input->post('firstname')!==NULL) {
                    $data['firstname'] = $this->input->post('firstname');
            } elseif (!empty($user_info)) {

                    $data['firstname'] = $user_info['firstname'];
            } else {
                    $data['firstname'] = '';
            }
            
            if ($this->input->post('lastname')!==NULL) {
                    $data['lastname'] = $this->input->post('lastname');
            } elseif (!empty($user_info)) {

                    $data['lastname'] = $user_info['lastname'];
            } else {
                    $data['lastname'] = '';
            }
            
            if ($this->input->post('email')!==NULL) {
                    $data['email'] = $this->input->post('email');
            } elseif (!empty($user_info)) {

                    $data['email'] = $user_info['email'];
            } else {
                    $data['email'] = '';
            }
            
            if ($this->input->post('telephone')!==NULL) {
                    $data['telephone'] = $this->input->post('telephone');
            } elseif (!empty($user_info)) {

                    $data['telephone'] = $user_info['telephone'];
            } else {
                    $data['telephone'] = '';
            }
            
            
            $data['customer_id'] = $this->session->userdata('customer_id');
            
            $this->document->setTitle('title');
            $this->document->setDescription('description');
            $this->document->setKeywords('keyword');
	    $data['header'] = $this->headers->getHeaders();
            $site_theme = $this->common->config('catalog_theme');
            $this->load->section('content', "themes/".$site_theme."/account/edit_account",$data);
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
                                'field' => 'firstname',
                                'label' => 'First Name', 
                                'rules' => 'trim|required|min_length[1]|max_length[32]|xss_clean', 
                                'errors' => array('required' => '%s must be between 1 and 32 characters!','min_length'=>'%s must be between 1 and 32 characters!','max_length'=>'%s must be between 1 and 32 characters!')
                            ),
                            
                            array(
                                'field' => 'lastname',
                                'label' => 'Last Name', 
                                'rules' => 'trim|required|min_length[1]|max_length[32]|xss_clean', 
                                'errors' => array('required' => '%s must be between 1 and 32 characters!','min_length'=>'%s must be between 1 and 32 characters!','max_length'=>'%s must be between 1 and 32 characters!')
                            ),
                
                            array(
                                'field' => 'email',
                                'label' => 'E-Mail Address', 
                                'rules' => 'trim|required|xss_clean|valid_email|callback_email_check', 
                                'errors' => array('required' => '%s  does not appear to be valid!','valid_email'=>'%s  does not appear to be valid!','email_check'=>'%s already exists!')
                            ),
                            array(
                                'field' => 'telephone',
                                'label' => 'Telephone', 
                                'rules' => 'trim|required|min_length[3]|max_length[32]|numeric|xss_clean', 
                                'errors' => array('required' => '%s must be between 3 and 32 characters!','min_length'=>'%s must be between 3 and 32 characters!','max_length'=>'%s must be between 3 and 32 characters!')
                            ),
                            
                        );
                        $this->form_validation->set_rules($validation);
                        if ($this->form_validation->run() == FALSE) {
                            return FALSE;
                        }else{
                            return TRUE;
                        }
	}
        
        /**
	* 
	* @function name : email_check()
	* @description   : Check email id already exists or not
	* @param         : void
	* @return        : void
	*
	*/
        public function email_check($str)
        {  
            
            $this->db->from('customer');
            $this->db->where('LOWER(email)',strtolower($str));
            if($this->input->post('customer_id') !="")
            {
                $this->db->where('customer_id !=',$this->input->post('customer_id'));
            }
            $query=$this->db->get();
            $row = $query->num_rows();
            if($row > 0)
            {
                return FALSE;
            }
            else
            {
                return TRUE;
            } 
        }
	
}
