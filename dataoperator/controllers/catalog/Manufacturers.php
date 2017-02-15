<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Manufacturers
* @Auther       : Jinal Patel
* @Date         : 10-11-2016
* @Description  : Admin Manufacturers Operation
*
*/

class Manufacturers extends CI_Controller {

    private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('catalog/manufacturer_model','manufacturer');
		
                $this->lang->load('catalog/manufacturers_lang', 'english');
		
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
		$this->output->set_template('dataoperator_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Manufacturers','sarpo','This is srapo Manufacturers page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Manufacturers view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'firstname', $sort_order = 'ASC', $offset = 0)
	{
		
		// breadcrumbs
		$this->data['add'] 			    = base_url('catalog/manufacturers/add');
	    if($this->session->userdata('Drole_id')== 1)
		{
			$this->data['delete'] 		= base_url('catalog/manufacturers/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('catalog/manufacturers/softDelete');
		}
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		  
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Manufacturers',
		   'href' => base_url('catalog/manufacturers'),
		 
		  );
		  
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("catalog/manufacturers/index/$sort_by/$sort_order");
		$total_records = $this->manufacturer->getTotalManufacturer();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->manufacturer->getManufacturer($data);
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
			$this->data['records'][] =  array(
				'manufacturer_id'    => $result['manufacturer_id'],
				'firstname'          => $result['firstname'],
				'lastname'           => $result['lastname'],
			    'email'              => $result['email'],
				'telephone'          => $result['telephone'],
				'membership_fee'     => $result['membership_fee'],
				'wallet_balance'     => $result['wallet_balance'],
				'edit'               => base_url('catalog/manufacturers/edit'.$url.'/'.$this->commons->encode($result['manufacturer_id']))
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
		$content_page="themes/".$admin_theme."/catalog/manufacturers_list";
		$this->load->view($content_page,$this->data);
        	
	}
	
	/**
	* 
	* @function name : add()
	* @description   : load Manufacturers Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function add()	{

		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) 
		{
			
				$this->manufacturer->addManufacturer();
				echo 
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
				redirect('catalog/manufacturers');
	     }
		$this->getForm();
	}
	
	/**
	* 
	* @function name : edit()
	* @description   : edit Manufacturers records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'title', $sort_order = 'ASC', $offset = 0)
	{

		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				 		
				$this->manufacturer->editManufacturer();
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
				
				redirect('catalog/manufacturers/index'.$url);
				
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
		if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
		{
			foreach ($this->input->post('selected') as $manufacturer_id) 
			{
				$this->manufacturer->deleteManufacturer($manufacturer_id);
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
	* @function name : softDelete()
	* @description   : soft Delete Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function softDelete()
	{
		if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
		{
			foreach ($this->input->post('selected') as $manufacturer_id) 
			{
				$this->manufacturer->softDeleteManufacturer($manufacturer_id);
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
		   'text' => 'Manufacturers',
		   'href' => base_url('catalog/manufacturers'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{
			$this->data['text_form']   = $this->lang->line('text_add');
			$this->data['form_action'] = base_url('catalog/manufacturers/add'.$url);
			$this->data['manufacturer_id'] = '';
		} 
		else 
		{
			$this->data['text_form']   = $this->lang->line('text_edit');
			$this->data['form_action'] = base_url('catalog/manufacturers/edit'.$url.'/'.$this->uri->segment($count));
			
			$this->data['manufacturer_id'] = $this->commons->decode($this->uri->segment($count));
		}
		$this->data['cancel'] 		= base_url('catalog/manufacturers/index'.$url);
		
		// Set Value Back
		if (1) 
		{
			$manufacturer_info = $this->manufacturer->getManufacturerById($this->commons->decode($this->uri->segment($count)));
		}
		// '<pre>';print_r($manufacturer_info);die;
		
		if ($this->input->post('firstname')!==NULL) {
			$this->data['firstname'] = $this->input->post('firstname');
		} elseif (!empty($manufacturer_info)) {
			
			$this->data['firstname'] = $manufacturer_info['firstname'];
		} else {
			$this->data['firstname'] = '';
		}
		
		if ($this->input->post('middlename')!==NULL) {
			$this->data['middlename'] = $this->input->post('middlename');
		} elseif (!empty($manufacturer_info)) {
			
			$this->data['middlename'] = $manufacturer_info['middlename'];
		} else {
			$this->data['middlename'] = '';
		}
		
		if ($this->input->post('lastname')!==NULL) {
			$this->data['lastname'] = $this->input->post('lastname');
		} elseif (!empty($manufacturer_info)) {
			$this->data['lastname'] = $manufacturer_info['lastname'];
		} else {
			$this->data['lastname'] = '';
		}
		
		if ($this->input->post('email')!==NULL) {
			$this->data['email'] = $this->input->post('email');
		} elseif (!empty($manufacturer_info)) {
			$this->data['email'] = $manufacturer_info['email'];
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
		
		if ($this->input->post('telephone')!==NULL) {
			$this->data['telephone'] = $this->input->post('telephone');
		} elseif (!empty($manufacturer_info)) {
			$this->data['telephone'] = $manufacturer_info['telephone'];
		} else {
			$this->data['telephone'] = '';
		}
		
	    if ($this->input->post('mobile')!==NULL) {
			$this->data['mobile'] = $this->input->post('mobile');
		} elseif (!empty($manufacturer_info)) {
			$this->data['mobile'] = $manufacturer_info['mobile'];
		} else {
			$this->data['mobile'] = '';
		}
		
		if ($this->input->post('gender')!==NULL) {
			$this->data['gender'] = $this->input->post('gender');
		} elseif (!empty($manufacturer_info)) {
			$this->data['gender'] = $manufacturer_info['gender'];
		} else {
			$this->data['gender'] = 'male';
		}
		
	    if ($this->input->post('dob')!==NULL) {
			$this->data['dob'] = $this->input->post('dob');
		} elseif (!empty($manufacturer_info)) {
			$this->data['dob'] = $manufacturer_info['dob'];
		} else {
			$this->data['dob'] = '';
		}
		
		if ($this->input->post('bank_name')!==NULL) {
			$this->data['bank_name'] = $this->input->post('bank_name');
		} elseif (!empty($manufacturer_info)) {
			$this->data['bank_name'] = $manufacturer_info['bank_name'];
		} else {
			$this->data['bank_name'] = '';
		}
		
	    if ($this->input->post('bank_address')!==NULL) {
			$this->data['bank_address'] = $this->input->post('bank_address');
		} elseif (!empty($manufacturer_info)) {
			$this->data['bank_address'] = $manufacturer_info['bank_address'];
		} else {
			$this->data['bank_address'] = '';
		}
		
		if ($this->input->post('bank_ifsc_code')!==NULL) {
			$this->data['bank_ifsc_code'] = $this->input->post('bank_ifsc_code');
		} elseif (!empty($manufacturer_info)) {
			$this->data['bank_ifsc_code'] = $manufacturer_info['bank_ifsc_code'];
		} else {
			$this->data['bank_ifsc_code'] = '';
		}
			
		if ($this->input->post('account_no')!==NULL) {
			$this->data['account_no'] = $this->input->post('account_no');
		} elseif (!empty($manufacturer_info)) {
			$this->data['account_no'] = $manufacturer_info['account_no'];
		} else {
			$this->data['account_no'] = '';
		}
		
	    if ($this->input->post('account_name')!==NULL) {
			$this->data['account_name'] = $this->input->post('account_name');
		} elseif (!empty($manufacturer_info)) {
			$this->data['account_name'] = $manufacturer_info['account_name'];
		} else {
			$this->data['account_name'] = '';
		}
		
	   if ($this->input->post('membership_fee')!==NULL) {
			$this->data['membership_fee'] = $this->input->post('membership_fee');
		} elseif (!empty($manufacturer_info)) {
			$this->data['membership_fee'] = $manufacturer_info['membership_fee'];
		} else {
			$this->data['membership_fee'] = '';
		}
		
		if ($this->input->post('wallet_balance')!==NULL) {
			$this->data['wallet_balance'] = $this->input->post('wallet_balance');
		} elseif (!empty($manufacturer_info)) {
			$this->data['wallet_balance'] = $manufacturer_info['wallet_balance'];
		} else {
			$this->data['wallet_balance'] = '';
		}
		
		if ($this->input->post('upload_register_no')!==NULL) {
			$this->data['upload_register_no'] = $this->input->post('upload_register_no');
		} elseif (!empty($manufacturer_info)) {
			$this->data['upload_register_no'] = $manufacturer_info['upload_register_no'];
		} else {
			$this->data['upload_register_no'] = '';
		}
		
		if ($this->input->post('company_name')!==NULL) {
			$this->data['company_name'] = $this->input->post('company_name');
		} elseif (!empty($manufacturer_info)) {
			$this->data['company_name'] = $manufacturer_info['company_name'];
		} else {
			$this->data['company_name'] = '';
		}
	
		if ($this->input->post('status')!==NULL)
                {
			$this->data['status'] = $this->input->post('status');
		} elseif (!empty($manufacturer_info)) {
			$this->data['status'] = $manufacturer_info['status'];
		} else {
			$this->data['status'] = 0;
		}
		
                if ($this->input->server('REQUEST_METHOD') == 'POST')
                {
                    if($this->input->post('is_deleted')==1)
                    {
                       $this->data['is_deleted'] = $this->input->post('is_deleted'); 
                    }else {
                         $this->data['is_deleted'] = 0;
                    }
		} elseif (!empty($manufacturer_info)) {
			$this->data['is_deleted'] = $manufacturer_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
		$this->data['bank_list'] = $this->manufacturer->getBankList();
		//echo '<pre>'.$count;print_r($this->data);die;
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/catalog/manufacturers";
		$this->load->view($content_page,$this->data);
	}
	public function validateForm()
	{
		$password = array();
        $c_password = array();
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add'|| $this->input->post('password') ) 
		{
			$password =array(
				'field'  => 'password',
				'label'  => 'Password', 
				'rules'  => 'required|min_length[6]|max_length[32]|xss_clean', 
				'errors' => array('required' => '%s must be between 6 and 32 characters!','min_length'=>'%s must be between 6 and 32 characters!!','max_length'=>'%s must be between 6 and 32 characters!')
			);
		    $c_password=array(
		       'field'  => 'c_password',
		       'label'  => 'Confirm Password', 
		       'rules'  => 'xss_clean|matches[password]', 
		       'errors' => array('required' => '%s must be greater than 3 and less than 32 characters!','matches'=>'Password and password confirmation do not match!')
	       );
		}
		$validation = array(
					   
					    array(
					        'field'  => 'firstname',
					        'label'  => 'First Name', 
					        'rules'  => 'trim|required|xss_clean|min_length[2]|max_length[64]', 
					        'errors' =>  array('required' => '%s must be between 2 and 64 characters!','min_length'=>'%s must be between 2 and 64 characters!','max_length'=>'%s must be between 2 and 64 characters!')
					    ),
					      array(
					        'field'  => 'middlename',
					        'label'  => 'Middle Name', 
					        'rules'  => 'trim|required|xss_clean|min_length[2]|max_length[64]', 
					        'errors' =>  array('required' => '%s must be between 2 and 64 characters!','min_length'=>'%s must be between 2 and 64 characters!','max_length'=>'%s must be between 2 and 64 characters!')
					    ),
						    array(
					        'field'  => 'lastname',
					        'label'  => 'Last Name', 
					        'rules'  => 'trim|required|xss_clean|min_length[2]|max_length[64]', 
					        'errors' =>  array('required' => '%s  must be between 2 and 64 characters!','min_length'=>'%s must be between 2 and 64 characters!','max_length'=>'%s must be between 2 and 64 characters!')
					    ),
				            array(
					        'field' => 'email',
					        'label' => 'E-Mail Address', 
					        'rules' => 'trim|required|xss_clean|valid_email|callback_email_check', 
					        'errors' => array('required' => '%s  does not appear to be valid!','valid_email'=>'%s  does not appear to be valid!')
					    ),
					   
						   array(
					        'field'  => 'telephone',
					        'label'  => 'Telephone', 
					        'rules'  => 'trim|xss_clean|numeric|min_length[1]|max_length[15]', 
					        'errors' =>  array('required' => '%s  must be between 1 and 10 characters!','min_length'=>'%s must be between 1 and 10 characters!','max_length'=>'%s must be between 1 and 10 characters!')
					    ),
						   array(
					        'field'  => 'mobile',
					        'label'  => 'Mobile', 
					        'rules'  => 'trim|xss_clean|numeric|max_length[10]', 
					        'errors' =>  array('required' => '%s  must be between 1 and 10 characters!','min_length'=>'%s must be between 1 and 10 characters!','max_length'=>'%s must be between 1 and 10 characters!')
					    ),
						    array(
					        'field'  => 'bank_address',
					        'label'  => 'Bank Address', 
					        'rules'  => 'trim|xss_clean|min_length[6]|max_length[64]', 
					        'errors' =>  array('required' => '%s  must be between 6 and 64 characters!','min_length'=>'%s must be between 6 and 64 characters!','max_length'=>'%s must be between 6 and 64 characters!')
					    ),
    					   array(
					        'field'  => 'bank_ifsc_code',
					        'label'  => 'Bank IFSC Code', 
					        'rules'  => 'trim|xss_clean|alpha_dash|min_length[6]|max_length[11]',  
					        'errors' => array('required' => '%s  must be between 6 and 11 characters!','min_length'=>'%s must be between 6 and 11 characters!','max_length'=>'%s must be between 6 and 11 characters!')
					    ),
     					   array(
					        'field'  => 'account_no',
					        'label'  => 'Account No', 
					        'rules'  => 'trim|xss_clean|alpha_numeric|min_length[6]|max_length[64]', 
					        'errors' => array('required' => '%s  must be between 6 and 64 characters!','min_length'=>'%s must be between 6 and 64 characters!','max_length'=>'%s must be between 6 and 64 characters!')
					    ),
						   array(
					        'field'  => 'account_name',
					        'label'  => 'Account Name', 
					        'rules'  => 'trim|xss_clean|min_length[6]|max_length[64]', 
                            'errors' => array('required' => '%s  must be between 6 and 64 characters!','min_length'=>'%s must be between 6 and 64 characters!','max_length'=>'%s must be between 6 and 64 characters!')
					    ),
						   array(
					        'field'  => 'membership_fee',
					        'label'  => 'Membership Fee', 
					        'rules'  => 'trim|xss_clean|integer',
					        'errors' => array('required' => '%s  must be digit!','min_length'=>'%s must be digit!','max_length'=>'%s must be digit!')
					    ),
						   array(
					        'field'  => 'wallet_balance',
					        'label'  => 'Wallet Balance', 
					        'rules'  => 'trim|xss_clean|integer', 
					        'errors' => array('required' => '%s  must be digit!','min_length'=>'%s must be digit!','max_length'=>'%s must be digit!')
					    ),
						   array(
					        'field'  => 'upload_register_no',
					        'label'  => 'Upload Register No', 
					        'rules'  => 'trim|xss_clean|min_length[6]|max_length[64]', 
					        'errors' => array('required' => '%s  must be between 6 and 64 characters!','min_length'=>'%s must be between 6 and 64 characters!','max_length'=>'%s must be between 6 and 64 characters!')
					    ),
						
						    array(
					        'field'  => 'company_name',
					        'label'  => 'Company Name', 
					        'rules'  => 'trim|xss_clean|min_length[6]|max_length[64]', 
					        'errors' => array('required' => '%s  must be between 6 and 64 characters!','min_length'=>'%s must be between 6 and 64 characters!','max_length'=>'%s must be between 6 and 64 characters!')
					    ),
						    array(
					        'field'  => 'gender',
					        'label'  => 'Gender', 
					        'rules'  => 'trim|xss_clean|required', 
					        'errors' => array('required' => 'Please select %s !')
					    ),
						$password,
						$c_password,
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
    public function email_check()
    {  
        $manufacturer_info = $this->manufacturer->getUserByEmail($this->input->post('email'));
            if($this->input->post('manufacturer_id') !=="")
            {
                if ($manufacturer_info && ($this->input->post('manufacturer_id') != $manufacturer_info['manufacturer_id'])) 
                { 
                    $this->form_validation->set_message('email_check', 'Email ID is already exists!');
                    return FALSE;
		        }
                else
                {                
                    return TRUE;
                }
            }
            else 
            {
                if ($manufacturer_info && ($this->input->post('manufacturer_id') != $this->session->userdata('user_id'))) 
                { 
                    $this->form_validation->set_message('email_check', 'Email ID is already exists!');
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
	* @description   : Check manufacturers relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{
		$this->load->model('catalog/product_model');
		
		foreach ($this->input->post('selected') as $manufacturer_id) 
		{
			$product_total = $this->product_model->getTotalProductsByManufacturerId($manufacturer_id);

			if ($product_total) 
			{				
				$this->error['warning'] = $this->lang->line('error_product').'('.$product_total.')!';
			}
		}
		return !$this->error;
	}
        
        public function autocomplete() {
		$this->output->unset_template();
		$json = array();
			
			if ($this->input->post('manufacturer')!==NULL) {
				$filter_name = $this->input->post('manufacturer');
			} else {
				$filter_name = '';
			}
			
			
			$filter_data = array(
				'filter_name'  => $filter_name,
				'start'        => 0,
				'limit'        => 5
			);

			$results = $this->manufacturer->getManufacturer($filter_data);                       

			foreach ($results as $result) {
				$json[] = array(
                                        'name' => $result['name'],
					'manufacturer_id'   => $result['manufacturer_id'],
					'firstname'  => $result['firstname'],
                                        'lastname' => $result['lastname']
				);
			}
		
		
		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);
                
        echo json_encode($json);
	}
	
}
