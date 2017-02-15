<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address_book extends CI_Controller {
	function __construct()
	{
            parent::__construct();

            $this->_init();
            
            $this->lang->load('account/address_lang','english');
            
            $this->load->model('account/address_model','address');
            
            $this->load->model('common');

            $this->load->library('commons');
            
            $this->load->library('customer');
	}
	
	private function _init() {
            //--Set Template
            $this->output->set_template('site_template');
            $site_theme = $this->common->config('catalog_theme');
            $this->output->set_common_meta('Product','sarpo','Home Page');
        }
        
	public function index()
	{
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
               'text' => 'Address Book',  
               'href' => site_url('account/address_book'),

            );
            
            $results = $this->address->getAddressesById($this->session->userdata('customer_id'));
           
            foreach ($results as $result) {               
                $data['records'][] = array (
                    'address_id' => $result['address_id'],
                    'customer_id' => $result['customer_id'],
                    'name' => $result['firstname']." ".$result['lastname'],
                    'company' => $result['company'],
                    'address_1' => $result['address_1'],
                    'address_2' => $result['address_2'],
                    'city' => $result['city'],
                    'postcode' => $result['postcode'],
                    'state_id' => $result['state_id'],
                    'country_id' => $result['country_id'],
                    
                    'edit' => site_url('account/address_book/edit'.'/'.$this->commons->encode($result['address_id'])),
                    'delete' => site_url('account/address_book/delete'.'/'.$this->commons->encode($result['address_id']))
                );
            }
            
            if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
                $this->session->unset_userdata('success1');
            } else {
                $data['error_warning'] = '';
                
            }
            $this->session->unset_userdata('success');
            if ($this->session->userdata('success1')!==NULL) {                
                $data['success1'] = $this->session->userdata('success1'); 
            } else {
                $data['success1'] = '';
            }
            
            $this->document->setTitle('title');
            $this->document->setDescription('description');
            $this->document->setKeywords('keyword');
	    $data['header'] = $this->headers->getHeaders();
            $site_theme = $this->common->config('catalog_theme');
            $this->load->section('content', "themes/".$site_theme."/account/address_list",$data);
            $this->load->view("themes/".$site_theme."/account/account",$data);
	}
	
	public function add()
	{
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
                $this->address->addAddress($this->input->post());
                $this->session->set_userdata('success1',$this->lang->line('text_add'));
                redirect('account/address_book');
            }
            $this->getForm();
	}
        
        public function edit()
	{
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
                $this->address->editAddress($this->input->post());
                $this->session->set_userdata('success1',$this->lang->line('text_edit'));
                
                redirect('account/address_book');
            }
            $this->getForm();
	}
        
        public function delete($id='')
	{
             $count = $this->uri->total_segments();
             $method = $this->commons->decode($this->uri->segment($count));
            
            if(((int)$method  && $this->validateDelete())) {
                $this->address->deleteAddress($method);
                $this->session->set_userdata('success1',$this->lang->line('text_delete'));
                redirect('account/address_book');
            }
            $this->index();
	}
        
        /**
	* 
	* @function name : getForm()
	* @description   : Generate Form for Add and Edit Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function getForm()
	{         
            if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
            } else {
                $data['error_warning'] = '';
            }

            if ($this->session->userdata('success')!==NULL) {
                $data['success'] = $this->session->userdata('success');

                $this->session->unset_userdata('success','');
            } else {
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
               'text' => 'Address Book',  
               'href' => site_url('account/address_book'),
            );            
		 
            // Add or Edit Transaction
            $count = $this->uri->total_segments();
            $method = $this->uri->segment(3);
            if ($method=='add') 
            {
                $data['form_action'] = site_url('account/address_book/add');
                $data['customer_id'] = '';
                $data['text_form'] = $this->lang->line('text_edit_address');
                //echo "1";
            } 
            else 
            {
                $data['form_action'] = site_url('account/address_book/edit'.'/'.$this->uri->segment($count));
                $data['customer_id'] = $this->commons->decode($this->uri->segment($count));
                $data['text_form'] = $this->lang->line('text_edit_address');
            }
            //$this->data['refresh'] 		= site_url('customers/customer/refresh');
            $data['cancel'] 		= site_url('account/address_book');
            
            // Set Value Back
            if (1) 
            {
                $address_info = $this->address->getAddressById($this->commons->decode($this->uri->segment($count)));
            }
            //echo '<pre>';print_r($ReturnStatus_info);
            if ($this->input->post('address_id')!==NULL) {
                $data['address_id'] = $this->input->post('address_id');
            } elseif (!empty($address_info)) {
                $data['address_id'] = $address_info['address_id'];
            } else {
                $data['address_id'] = '';
            }
            
            if ($this->input->post('firstname')!==NULL) {
                $data['firstname'] = $this->input->post('firstname');
            } elseif (!empty($address_info)) {
                $data['firstname'] = $address_info['firstname'];
            } else {
                $data['firstname'] = '';
            }
		
             
            if ($this->input->post('lastname')!==NULL) {
                $data['lastname'] = $this->input->post('lastname');
            } elseif (!empty($address_info)) {
                $data['lastname'] = $address_info['lastname'];
            } else {
                $data['lastname'] = '';
            }     
            
            if ($this->input->post('company')!==NULL) {
                $data['company'] = $this->input->post('company');
            } elseif (!empty($address_info)) {
                $data['company'] = $address_info['company'];
            } else {
                $data['company'] = '';
            }
            
            if ($this->input->post('address_1')!==NULL) {
                $data['address_1'] = $this->input->post('address_1');
            } elseif (!empty($address_info)) {
                $data['address_1'] = $address_info['address_1'];
            } else {
                $data['address_1'] = '';
            }
            
            if ($this->input->post('address_2')!==NULL) {
                $data['address_2'] = $this->input->post('address_2');
            } elseif (!empty($address_info)) {
                $data['address_2'] = $address_info['address_2'];
            } else {
                $data['address_2'] = '';
            }
            
            if ($this->input->post('city')!==NULL) {
                $data['city'] = $this->input->post('city');
            } elseif (!empty($address_info)) {
                $data['city'] = $address_info['city'];
            } else {
                $data['city'] = '';
            }
            
            if ($this->input->post('postcode')!==NULL) {
                $data['postcode'] = $this->input->post('postcode');
            } elseif (!empty($address_info)) {
                $data['postcode'] = $address_info['postcode'];
            } else {
                $data['postcode'] = '';
            }
            
           
                 
                        
            if ($this->input->post('country_id')!==NULL) {
                $data['country_id'] = $this->input->post('country_id');
            } elseif (!empty($address_info)) {
                $data['country_id'] = $address_info['country_id'];
            } else {
                $data['country_id'] = '';
            }
            
            if ($this->input->post('state_id')!==NULL) {
                $data['state_id'] = $this->input->post('state_id');
            } elseif (!empty($address_info)) {
                $data['state_id'] = $address_info['state_id'];
            } else {
                $data['state_id'] = '';
            }
            
            $count = $this->uri->total_segments();
            $method = $this->commons->decode($this->uri->segment($count));
            if ($this->input->post('default_address')!==NULL) {
                $data['default'] = $this->input->post('default_address');
            } elseif ($method!==NULL) {
                $data['default'] = $this->customer->getAddressId() == $method;
            } else {
                $data['default'] = false;
            } 
            
            $this->load->model('system/country_model');
            $data['countries'] = $this->country_model->getCountries();
           
            
            $this->document->setTitle('title');
            $this->document->setDescription('description');
            $this->document->setKeywords('keyword');
	    $data['header'] = $this->headers->getHeaders();
            //echo '<pre>'.$count;print_r($this->data);die;
            $site_theme = $this->common->config('catalog_theme');
            $this->load->section('content', "themes/".$site_theme."/account/add_address",$data);		
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
                                'field' => 'address_1',
                                'label' => 'Address 1', 
                                'rules' => 'trim|required|min_length[3]|max_length[128]|xss_clean', 
                                'errors' => array('required' => '%s must be between 3 and 128 characters!','min_length'=>'%s must be between 3 and 128 characters!','max_length'=>'%s must be between 3 and 128 characters!')
                            ),
                            array(
                                'field' => 'city',
                                'label' => 'City', 
                                'rules' => 'trim|required|min_length[2]|max_length[128]|xss_clean', 
                                'errors' => array('required' => '%s must be between 2 and 128 characters!','min_length'=>'%s must be between 2 and 128 characters!','max_length'=>'%s must be between 2 and 128 characters!')
                            ),
                            array(
                                'field' => 'postcode',
                                'label' => 'Postcode', 
                                'rules' => 'trim|required|min_length[2]|max_length[10]|xss_clean', 
                                'errors' => array('required' => '%s must be between 2 and 10 characters!','min_length'=>'%s must be between 2 and 10 characters!','max_length'=>'%s must be between 2 and 10 characters!')
                            ),
                            array(
                                'field' => 'country_id',
                                'label' => 'country', 
                                'rules' => 'trim|required|xss_clean', 
                                'errors' => array('required' => 'Please Select %s !')
                            ),
                            array(
                                'field' => 'state_id',
                                'label' => 'region / state', 
                                'rules' => 'trim|required|xss_clean', 
                                'errors' => array('required' => 'Please Select %s !')
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
    * @function name    : get_zone_by_country_id()
    * @description      : get zone list by country Id 
    * @access           : public
    * @param            : void
    * @return           : json
    *
    */
    public function get_zone_by_country_id() {
        $this->output->unset_template();
        $json = array();
         $this->load->model('system/country_model');
        $country_info = $this->country_model->getCountry($this->input->post('country_id'));
        
        if($country_info) {
            $this->load->model('system/zone_model');
            
            $json = array(
                'country_id'        => $country_info['country_id'],
                'country_name'      => $country_info['country_name'],
                'iso_code_2'        => $country_info['iso_code_2'],
                'iso_code'          => $country_info['iso_code'],
                'zone'              => $this->zone_model->getZoneByCountryId($this->input->post('country_id')),
                'status'            => $country_info['status']  
            );
        }
        
        $sort_order = array();

        echo json_encode($json);
    }
    
    /**
	* 
	* @function name : validateDelete()
	* @description   : Check customers relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{
           $totalAddress  = $this->address->getTotalAddresses();
            
            if ($totalAddress['total'] == 1) {
                $this->error['warning'] = $this->lang->line('error_delete');
            }
            $count = $this->uri->total_segments();
            $method = $this->commons->decode($this->uri->segment($count));
            if ($this->customer->getAddressId() == (int)$method) {
                $this->error['warning'] = $this->lang->line('error_default');
            }               
            return !$this->error;
	}
    	
	
}
