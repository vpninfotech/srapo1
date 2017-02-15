<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : customers
* @Auther       : Indrajit
* @Date         : 10-10-2016
* @Description  : Admin customers Operation
*
*/

class Customer extends CI_Controller {

    private $data=array();
	private $error = array();

	function __construct()
	{
            parent::__construct();

            $this->_init();

            $this->rbac->CheckAuthentication();

            $this->load->model('customers/Customer_groups_model','customers_group');
			
			$this->load->model('customers/customers_model','customers');

            $this->lang->load('customers/customers_lang', 'english');

            $this->load->model('common');

            $this->load->library('commons');

            $this->load->library('pagination');
	}
        
	/**
	* 
	* @function name : _init()
	* @description   : initialize required resources in this view
	* @param   		 : void
	* @return        : void
	*
	*/
	private function _init() {
		
            //--Set Template
            $this->output->set_template('admin_template');
            $admin_theme = $this->common->config('admin_theme');
            $this->output->set_common_meta('customers','sarpo','This is srapo customers page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load customers view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'firstname', $sort_order = 'ASC', $offset = 0)
	{
            // breadcrumbs
            $this->data['add']             = base_url('customers/customer/add');
            if($this->session->userdata('role_id')== 1)
            {
                    $this->data['delete']  = base_url('customers/customer/delete');
            }
            else
            {
                    $this->data['delete']  = base_url('customers/customer/softDelete');
            }
            $this->data['breadcrumbs']   = array();
            $this->data['breadcrumbs'][] = array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),

            );
            $this->data['breadcrumbs'][] = array(
               'text' => 'Customers',  
               'href' => base_url('customers/customers'),

            );
		  	$filter_array             = $this->session->userdata('filter_array');
            $filter_name              = "";
            $filter_email             = "";
            $filter_customer_group_id = "";
            $filter_status            = "";
            $filter_date_added        = "";
            $filter_ip                = "";

            if(isset($filter_array['filter_name']))
            {
              $filter_name =   $filter_array['filter_name'];
            }
            if(isset($filter_array['filter_email']))
            {
              $filter_email =   $filter_array['filter_email'];
            }
            if(isset($filter_array['filter_customer_group_id']))
            {
              $filter_customer_group_id =   $filter_array['filter_customer_group_id'];
            }
            if(isset($filter_array['filter_status']))
            {
              $filter_status =   $filter_array['filter_status'];
            }
            if(isset($filter_array['filter_date_added']))
            {
              $filter_date_added =   $filter_array['filter_date_added'];
            }
            if(isset($filter_array['filter_ip']))
            {
              $filter_ip =   $filter_array['filter_ip'];
            }

			$this->data['filter_name'] = $filter_name;
			$this->data['filter_email'] = $filter_email;
			$this->data['filter_customer_group_id'] = $filter_customer_group_id;
			$this->data['filter_status'] = $filter_status;
			$this->data['filter_date_added'] = $filter_date_added;
			$this->data['filter_ip'] = $filter_ip;
			$this->data['customer_group'] = $this->customers_group->getCustomerGroups();
            // pagination
            $limit = $this->common->config('config_limit_admin');
            $data = array(
			    'filter_name'  => $filter_name,
				'filter_email' => $filter_email,
				'filter_customer_group_id'  => $filter_customer_group_id,
				'filter_status' => $filter_status,
				'filter_date_added'  => $filter_date_added,
				'filter_ip' => $filter_ip,
                'sort' => $sort_by,
                'order'=> $sort_order,
                'start'=> $offset,
                'limit'=> $limit
            );
		    $url = base_url("customers/customer/index/$sort_by/$sort_order");
            $total_records = $this->customers->getTotalCustomer($data);
            
            $config =$this->commons->pagination($url,$total_records,$limit);
            $this->pagination->initialize($config);
            $config['uri_segment'] = 6;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['sort_by'] = $sort_by;
            $this->data['sort_order'] = $sort_order;
            $results = $this->customers->getCustomer($data);
			
            $this->data['pages'] = ceil($total_records/$limit);
            $this->data['totals'] = ceil($total_records);
            $this->data['range'] = ceil($offset+1);
		
            // URL creation
            $url='';
            if ($this->uri->segment(4)!==NULL) {
                    $url .= '/'.$this->uri->segment(4);
            }
            else
            {
                    $url .= '/firstname';
            }

            if ($this->uri->segment(5)!==NULL) {
                    $url .= '/'.$this->uri->segment(5);
            }
            else
            {
                    $url .= '/ASC';
            }
            if ($this->uri->segment(6)!==NULL) {
                    $url .= '/'.$this->uri->segment(6);
            }
            else
            {
                    $url .= '/0';
            }
		
            foreach ($results as $result) { 
                    $this->data['records'][] = array(
                            'customer_id'        => $result['customer_id'],
                            'firstname' 		 => $result['firstname'],
                            'lastname' 		     => $result['lastname'],
                            'email' 		     => $result['email'],
                            'user_status' 		 =>($result['status'] ? $this->lang->line('text_enabled') : $this->lang->line('text_disabled')),
                            'ip' 		         => $result['ip'],
                            'is_deleted'    => $result['is_deleted'],
                            'date_added'         => date($this->common->config('config_date_format'), strtotime($result['date_added'])),
                            'edit'               =>base_url('customers/customer/edit'.$url.'/'.$this->commons->encode($result['customer_id']))
                    );
            }
		
            if (isset($this->error['warning'])) {
                    $this->data['error_warning'] = $this->error['warning'];
            } else {
                    $this->data['error_warning'] = '';
            }

            if ($this->session->userdata('success')!==NULL) {
                    $this->data['success'] = $this->session->userdata('success');

                    $this->session->set_userdata('success','');
            } else {
                    $this->data['success'] = '';
            }
		
            if ($this->input->post('selected') !==NULL) {
                    $this->data['selected'] = (array)$this->input->post('selected');
            } else {
                    $this->data['selected'] = array();
            }
            //print_r($this->data);
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/customers/customers_list";
            $this->load->view($content_page,$this->data);
		
	}
	/**
    * 
    * @function name : search()
    * @description   : set session data by filter paramater
    * @param         : void
    * @return        : void
    *
    */
    public function search()
    {
            if ($this->input->post('button_filter') !== NULL) 
            {
                if ($this->input->post('filter_name')!==NULL) {
                    $filter_name = $this->input->post('filter_name');
                } else {
                    $filter_name = '';
                }
                
                if ($this->input->post('filter_email')!==NULL) {
                    $filter_email = $this->input->post('filter_email');
                } else {
                    $filter_email = '';
                }
                
                if ($this->input->post('filter_customer_group_id')!==NULL) 
                {
                    if ($this->input->post('filter_customer_group_id')!= '*') 
                    {
                        $filter_customer_group_id = $this->input->post('filter_customer_group_id');
                    } 
                    else 
                    {
                        $filter_customer_group_id = '';
                    }
                }
                else
                {
                    $filter_customer_group_id = '';
                }
                
                if ($this->input->post('filter_status')!==NULL) 
                {
                    if ($this->input->post('filter_status')!= '*') 
                    {
                        $filter_status = $this->input->post('filter_status');
                    } 
                    else 
                    {
                        $filter_status = '*';
                    }
                }
                else
                {
                    $filter_status = '';
                }
                
                if ($this->input->post('filter_date_added')!==NULL) 
                {
                    $filter_date_added = $this->input->post('filter_date_added');
                } 
                else 
                {
                    $filter_date_added = '';
                }
                
                if ($this->input->post('filter_ip')!==NULL) {
                    $filter_ip = $this->input->post('filter_ip');
                } else {
                    $filter_ip = '';
                }
                $filter['filter_name'] = $filter_name;
                $filter['filter_email'] = $filter_email;
                $filter['filter_customer_group_id'] = $filter_customer_group_id;
                $filter['filter_status'] = $filter_status;
                $filter['filter_date_added'] = $filter_date_added;
                $filter['filter_ip'] = $filter_ip;
                $this->session->set_userdata('filter_array', $filter);
            }
            if ($this->input->post('button_all') !== NULL) 
            {
               $this->session->set_userdata('filter_array', array());
            }
            $this->index();
           
    }
	/**
	* 
	* @function name : add()
	* @description   : load customers Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function add()	
        {	
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {                
                
                $this->customers->addCustomer();
                $this->session->set_userdata('success',$this->lang->line('text_success'));

                // Generate back url
                $url = '';

                if ($this->uri->segment(4)!==NULL) {
                    $url .= '/'.$this->uri->segment(4);
                }
                else
                {
                    $url .= '/firstname';
                }
				
                if ($this->uri->segment(5)!==NULL) {
                    $url .= '/'.$this->uri->segment(5);
                }
                else
                {
                    $url .= '/ASC';
                }
                if ($this->uri->segment(6)!==NULL) {
                    $url .= '/'.$this->uri->segment(6);
                }
                else
                {
                    $url .= '/0';
                }
                if ($this->uri->segment(7)!==NULL) {
                    $url .= '/'.$this->uri->segment(7);
                }
                redirect('customers/customer/index'.$url);
            }
            $this->getForm();
	}
	
	/**
	* 
	* @function name : edit()
	* @description   : edit customers records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'firstname', $sort_order = 'ASC', $offset = 0)
	{	
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				 
                $this->customers->editCustomer();
                $this->session->set_userdata('success',$this->lang->line('text_success'));

                // Generate back url
                $url = '';
		
                if ($this->uri->segment(4)!==NULL) {
                    $url .= '/'.$this->uri->segment(4);
                }
                else
                {
                    $url .= '/firstname';
                }
				
                if ($this->uri->segment(5)!==NULL) {
                    $url .= '/'.$this->uri->segment(5);
                }
                else
                {
                    $url .= '/ASC';
                }
                if ($this->uri->segment(6)!==NULL) {
                    $url .= '/'.$this->uri->segment(6);
                }
                else
                {
                    $url .= '/0';
                }
				
                redirect('customers/customer/index'.$url);
	    }
            $this->getForm();
	}
	
    
	/**
	* 
	* @function name : delete()
	* @description   : perminant delete records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function delete()
	{
            //if (($this->input->post('selected')!==NULL) && $this->validateDelete())
			if (($this->input->post('selected')!==NULL)) 
            {
                foreach ($this->input->post('selected') as $customer_id) 
                {
                    $this->customers->deleteCustomer($customer_id);
                }

                $this->session->set_userdata('success',$this->lang->line('text_success'));
                $this->index();
            }
            else
            {
                $this->index();
            }
	}
	
	/**
	* 
	* @function name : softDeleteCustomer()
	* @description   : soft Delete Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function softDelete()
	{
           // if (($this->input->post('selected')!==NULL) && $this->validateDelete())
			if (($this->input->post('selected')!==NULL)) 
            {
                foreach ($this->input->post('selected') as $customer_id) 
                {
                    $this->customers->softDeleteCustomer($customer_id);
                }

                $this->session->set_userdata('success',$this->lang->line('text_success'));
                
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
            // Transaction Status
            if (isset($this->error['warning'])) {
                $this->data['error_warning'] = $this->error['warning'];
            } else {
                $this->data['error_warning'] = '';
            }

            if ($this->session->userdata('success')!==NULL) {
                $this->data['success'] = $this->session->userdata('success');

                $this->session->set_userdata('success','');
            } else {
                $this->data['success'] = '';
            }
		
            // Generate back url
            $url = '';

            if ($this->uri->segment(4)!==NULL) {
                $url .= '/'.$this->uri->segment(4);
            }
            else
            {
                $url .= '/firstname';
            }
		
            if ($this->uri->segment(5)!==NULL) {
                $url .= '/'.$this->uri->segment(5);
            }
            else
            {
                $url .= '/ASC';
            }
            if ($this->uri->segment(6)!==NULL) {
                $url .= '/'.$this->uri->segment(6);
            }
            else
            {
                $url .= '/0';
            }
            
            // breadcrumbs
            $this->data['breadcrumbs']   	= array();
            $this->data['breadcrumbs'][] 	= array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),

            );
            $this->data['breadcrumbs'][] = array(
              'text' => 'Customers',
              'href' => base_url('customers/customer'),

            );
		 
            // Add or Edit Transaction
            $count = $this->uri->total_segments();
            $method = $this->uri->segment(3);
            if ($method=='add') 
            {
                $this->data['form_action'] = base_url('customers/customer/add'.$url);
                $this->data['customer_id'] = '';
                $this->data['text_form'] = $this->lang->line('text_add');
                //echo "1";
            } 
            else 
            {
                $this->data['form_action'] = base_url('customers/customer/edit'.$url.'/'.$this->uri->segment($count));

                $this->data['customer_id'] = $this->commons->decode($this->uri->segment($count));
                $this->data['text_form'] = $this->lang->line('text_edit');
            }
            //$this->data['refresh'] 		= base_url('customers/customer/refresh');
            $this->data['cancel'] 		= base_url('customers/customer/index'.$url);
			$this->data['customer_group'] = $this->customers_group->getCustomerGroups();
            // Set Value Back
            if (1) 
            {
                $customers_info = $this->customers->getCustomerById($this->commons->decode($this->uri->segment($count)));
            }
            //echo '<pre>';print_r($ReturnStatus_info);
			
            if ($this->input->post('group_id')!==NULL) {
                $this->data['group_id'] = $this->input->post('group_id');
            } elseif (!empty($customers_info)) {

                $this->data['group_id'] = $customers_info['group_id'];
            } else {
                $this->data['group_id'] = '';
            }
			
            if ($this->input->post('first_name')!==NULL) {
                $this->data['firstname'] = $this->input->post('first_name');
            } elseif (!empty($customers_info)) {

                $this->data['firstname'] = $customers_info['firstname'];
            } else {
                $this->data['firstname'] = '';
            }

            if ($this->input->post('middlename')!==NULL) {
                $this->data['middlename'] = $this->input->post('middlename');
            } elseif (!empty($customers_info)) {

                $this->data['middlename'] = $customers_info['middlename'];
            } else {
                $this->data['middlename'] = '';
            }
		
            if ($this->input->post('last_name')!==NULL) {
                $this->data['lastname'] = $this->input->post('last_name');
            } elseif (!empty($customers_info)) {

                $this->data['lastname'] = $customers_info['lastname'];
            } else {
                $this->data['lastname'] = '';
            }

            if ($this->input->post('telephone')!==NULL) {
                $this->data['telephone'] = $this->input->post('telephone');
            } elseif (!empty($customers_info)) {

                $this->data['telephone'] = $customers_info['telephone'];
            } else {
                $this->data['telephone'] = '';
            }
            if ($this->input->post('email')!==NULL) {
                $this->data['email'] = $this->input->post('email');
            } elseif (!empty($customers_info)) {

                $this->data['email'] = $customers_info['email'];
            } else {
                $this->data['email'] = '';
            }

            if ($this->input->post('password')!==NULL) {
                $this->data['password'] = $this->input->post('password');
            } else {
                $this->data['password'] = '';
            }
            if ($this->input->post('c_password')!==NULL) {
                $this->data['c_password'] = $this->input->post('c_password');

            } else {
                $this->data['c_password'] = '';
            }
            if ($this->input->post('dob')!==NULL) {
                $this->data['dob'] = $this->input->post('dob');
            } elseif (!empty($customers_info)) {

                $this->data['dob'] = $customers_info['dob'];
            } else {
                $this->data['dob'] = '';
            }
		
            if ($this->input->post('gender')!==NULL) {
                $this->data['gender'] = $this->input->post('gender');
            } elseif (!empty($customers_info)) {

                $this->data['gender'] = $customers_info['gender'];
            } else {
                $this->data['gender'] = '';
            }
		
            if ($this->input->server('REQUEST_METHOD') == 'POST')
            {
                if($this->input->post('newsletter')==1)
                {
                    $this->data['newsletter'] = $this->input->post('newsletter'); 
                }else {
                    $this->data['newsletter'] = 0;
                }
            } elseif (!empty($customers_info)) {
		$this->data['newsletter'] = $customers_info['newsletter'];
            } else {
		$this->data['newsletter'] = 0;
            }

            if ($this->input->post('status')!==NULL)
            {
                    $this->data['status'] = $this->input->post('status');
            } elseif (!empty($customers_info)) {
                    $this->data['status'] = $customers_info['status'];
            } else {
                    $this->data['status'] = 0;
            }
            
            if ($this->input->post('approve')!==NULL)
            {
                    $this->data['approve'] = $this->input->post('approve');
            } elseif (!empty($customers_info)) {
                    $this->data['approve'] = $customers_info['approve'];
            } else {
                    $this->data['approve'] = 0;
            }
		
            if ($this->input->server('REQUEST_METHOD') == 'POST')
            {
                if($this->input->post('is_deleted')==1)
                {
                    $this->data['is_deleted'] = $this->input->post('is_deleted'); 
                }else {
                    $this->data['is_deleted'] = 0;
                }
            } elseif (!empty($customers_info)) {
		$this->data['is_deleted'] = $customers_info['is_deleted'];
            } else {
		$this->data['is_deleted'] = 0;
            }
            
            $this->load->model('system/country_model');
            
            $this->data['countries'] = $this->country_model->getCountries();
            //echo "<pre>"; print_r($this->input->post('address'));
            if($this->input->post('address') !== NULL) {
                $this->data['addresses'] = $this->input->post('address');
            } elseif(($this->commons->decode($this->uri->segment(7)))) {
                $this->data['addresses'] = $this->customers->getAddresses($this->commons->decode($this->uri->segment(7)));
            } else {
                $this->data['addresses'] = array();
            }
           
            
            if($this->input->post('address_id') !== NULL) {
                $this->data['address_id'] = $this->input->post('address_id');
            } elseif(!empty($customers_info)) {
                $this->data['address_id'] = $customers_info['address_id'];
            } else {
                $this->data['address_id'] = '';
            }
            
            
            //echo '<pre>'.$count;print_r($this->data);die;
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/customers/customers";
            $this->load->view($content_page,$this->data);
	}
	
	/**
	* 
	* @function name : validateForm()
	* @description   : Validate Entered Form data
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateForm() {
            
            $method = $this->uri->segment(3);
            $password = array();
            $c_password = array();
            if($method == "add" || $this->input->post('password')) {
                $password = array(
                    'field' => 'password',
                    'label' => 'Password', 
                    'rules' => 'required|min_length[4]|max_length[20]', 
                    'errors' => array('required' => '%s must be between 4 and 20 characters!','min_length'=>'%s must be between 4 and 20 characters!','max_length'=>'%s must be between 4 and 20 characters!')
                );
                
                $c_password = array(
                    'field' => 'c_password',
                    'label' => 'Confirm Password', 
                    'rules' => 'trim|matches[password]', 
                    'errors' => array('required' => 'Password and password confirmation do not match!','matches'=>'Password and password confirmation do not match!')
                );
            }
            $validation = array(
                array(
                    'field' => 'first_name',
                    'label' => 'First Name', 
                    'rules' => 'trim|required|min_length[1]|max_length[32]|xss_clean', 
                    'errors' => array('required' => '%s must be between  1 and 32 characters!','min_length'=>'%s must be between  1 and 32 characters!','max_length'=>'%s must be between  1 and 32 characters!')
                ),
                
                array(
                    'field' => 'middlename',
                    'label' => 'Middle Name', 
                    'rules' => 'trim|required|min_length[1]|max_length[32]|xss_clean', 
                    'errors' => array('required' => '%s must be between  1 and 32 characters!','min_length'=>'%s must be between  1 and 32 characters!','max_length'=>'%s must be between  1 and 32 characters!')
                ),
                
                array(
                    'field' => 'last_name',
                    'label' => 'Last Name', 
                    'rules' => 'trim|required|min_length[1]|max_length[32]|xss_clean', 
                    'errors' => array('required' => '%s must be between  1 and 32 characters!','min_length'=>'%s must be between  1 and 32 characters!','max_length'=>'%s must be between  1 and 32 characters!')
                ),
                
                array(
                    'field' => 'gender',
                    'label' => 'gender', 
                    'rules' => 'trim|required|xss_clean', 
                    'errors' => array('required' => 'Please select %s !','valid_gender'=>'Please select %s !')
                ),
                
                array(
                    'field' => 'email',
                    'label' => 'E-Mail Address', 
                    'rules' => 'trim|required|xss_clean|valid_email|callback_email_check', 
                    'errors' => array('required' => '%s  does not appear to be valid!','valid_email'=>'%s  does not appear to be valid!')
                ),
                
                array(
                    'field' => 'telephone',
                    'label' => 'Telephone', 
                    'rules' => 'trim|required|min_length[3]|max_length[32]|numeric|xss_clean', 
                    'errors' => array('required' => '%s must be between 3 and 32 characters!','min_length'=>'%s must be between 3 and 32 characters!','max_length'=>'%s must be between 3 and 32 characters!')
                ),
                
                $password,
                $c_password
            ); 
            
            if($this->input->post('address') !== NULL) {
                foreach($this->input->post('address') as $key=>$value) {
                    $address_validate = array(
                        array(
                            'field' => 'address['.$key.'][firstname]',
                            'label' => 'First Name',
                            'rules' => 'trim|required|min_length[1]|max_length[32]|xss_clean',
                            'errors' => array('required' => '%s must be between  1 and 32 characters!','min_length'=>'%s must be between  1 and 32 characters!','max_length'=>'%s must be between  1 and 32 characters!')
                        ),
                        array(
                            'field' => 'address['.$key.'][lastname]',
                            'label' => 'Last Name', 
                            'rules' => 'trim|required|min_length[1]|max_length[32]|xss_clean', 
                            'errors' => array('required' => '%s must be between  1 and 32 characters!','min_length'=>'%s must be between  1 and 32 characters!','max_length'=>'%s must be between  1 and 32 characters!') 
                        ),
                        array(
                            'field' => 'address['.$key.'][address_1]',
                            'label' => 'Address 1', 
                            'rules' => 'trim|required|min_length[3]|max_length[128]|xss_clean', 
                            'errors' => array('required' => '%s must be between  3 and 128 characters!','min_length'=>'%s must be between  3 and 128 characters!','max_length'=>'%s must be between  3 and 128 characters!') 
                        ),
                        array(
                            'field' => 'address['.$key.'][city]',
                            'label' => 'City', 
                            'rules' => 'trim|required|min_length[2]|max_length[128]|xss_clean', 
                            'errors' => array('required' => '%s must be between  2 and 128 characters!','min_length'=>'%s must be between  2 and 128 characters!','max_length'=>'%s must be between  2 and 128 characters!') 
                        ),
                        array(
                            'field' => 'address['.$key.'][country_id]',
                            'label' => 'country', 
                            'rules' => 'trim|required|xss_clean', 
                            'errors' => array('required' => 'Please select a %s!') 
                        ),
                        array(
                            'field' => 'address['.$key.'][state_id]',
                            'label' => 'region/state', 
                            'rules' => 'trim|required|xss_clean', 
                            'errors' => array('required' => 'Please select a %s!') 
                        ),
                    );
                    $this->form_validation->set_rules($address_validate);
                }
            }
            
            $this->form_validation->set_rules($validation);
            if ($this->form_validation->run() == FALSE) {
                $this->error['warning'] = $this->session->set_userdata('warning', $this->lang->line('error_warning'));
                $this->data['error'] = $this->session->userdata('warning', $this->lang->line('error_warning'));
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
        public function email_check()
        {  
            $customers_info = $this->customers->getUserByEmail($this->input->post('email'));
            if($this->input->post('customer_id') !=="")
            {
                if ($customers_info && ($this->input->post('customer_id') != $customers_info['customer_id'])) 
                { 
                    $this->form_validation->set_message('email_check', 'Email ID is already in use!');
                    return FALSE;
		}
                else
                {                
                    return TRUE;
                }
            }
            else 
            {
                if ($customers_info && ($this->input->post('customer_id') != $this->session->userdata('user_id'))) 
                { 
                    $this->form_validation->set_message('email_check', 'Email ID is already in use!');
                    return FALSE;
                }
                else 
                {
                    return TRUE;
                }
            }
        }
	
	/**
	* 
	* @function name : validateDelete()
	* @description   : Check customers relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	/*public function validateDelete() 
	{
		foreach ($this->input->post('selected') as $customer_id) 
		{
			$customers_info = $this->customers->getCustomerById($customer_id);
			
			if ($customers_info) 
			{
				if (0) 
				{
					$this->error['warning'] = $this->lang->line('error_default');
				}
			}
		}
		return !$this->error;
	}*/
        
        public function autocomplete() {
		$this->output->unset_template();
		$json = array();
			
			if ($this->input->post('filter_name')!==NULL) {
				$filter_name = $this->input->post('filter_name');
			} else {
				$filter_name = '';
			}
			
			if ($this->input->post('filter_email')!==NULL) {
				$filter_email = $this->input->post('filter_email');
			} else {
				$filter_email = '';
			}
			
			$filter_data = array(
				'filter_name'  => $filter_name,
				'filter_email' => $filter_email,
				'start'        => 0,
				'limit'        => 5
			);

			$results = $this->customers->getCustomer($filter_data);
                        

			foreach ($results as $result) {
				$json[] = array(
                    'customer_id'       => $result['customer_id'],
                    'customer_group_id' => $result['group_id'],
                    'name'              => $result['firstname']." ".$result['lastname'],
                    'firstname'         => $result['firstname'],
                    'lastname'          => $result['lastname'],
                    'email'             => $result['email'],
                    'telephone'         => $result['telephone'],
                    'address'           => $this->customers->getAddresses($result['customer_id']),
                );
			}
		
		
		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);
                
        echo json_encode($json);
	}
        
        /**
	* 
	* @function name : getdata()
	* @description   : get data from country
	* @param   		 : void
	* @return        : void
	*
	*/
        public function getdata()
        {
               $this->output->unset_template();
               $country_id = $this->input->post('country_id');
               echo $country_id;
               $data = $this->customers->getState($country_id);
               echo json_encode($data);
        }

        public function address() 
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
