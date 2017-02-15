<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Tax_rates
* @Auther       : Mitesh
* @Date         : 19-12-2016
* @Description  : Tax_rates Related Collection of functions
*
*/

class Tax_rates extends CI_Controller {
	
	private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->_init();
		
		$this->load->model('system/Tax_rates_model','tax_rates');
		
		$this->lang->load('system/tax_rates_lang', 'english');
		
		//get customer group
		$this->load->model('customers/customer_groups_model','customer_groups');
		
		//get country list		
		$this->load->model('system/country_model','country');
		
		//get tax class data
		$this->load->model('system/Tax_classes_model','tax_classes');
		
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
		$this->output->set_common_meta('Tax Rates','sarpo','This is srapo Tax Rates page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Return_status view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'name', $sort_order = 'ASC', $offset = 0)
	{
		
		// breadcrumbs
		$this->data['add'] 			 = base_url('system/tax_rates/add');
		if($this->session->userdata('role_id')== 1)
		{
			$this->data['delete'] 		= base_url('system/tax_rates/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('system/tax_rates/softDelete');
		}
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Tax Rates', 
		   'href' => base_url('system/tax_rates'),
		 
		  );
		  
		// pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("system/tax_rates/index/$sort_by/$sort_order");
		$total_records = $this->tax_rates->getTotalTaxRates();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->tax_rates->getTaxRates($data);
		
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
			$url .= '/name';
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
			//get country name
			$country_info = $this->country->getCountry($result['country_id']);
			$country_name = $country_info['country_name'];
			
			//displat type
			if($result['type'] == 'P')
			{
				$type = "Percentage";
			}
			if($result['type'] == 'F')
			{
				$type = "Fixed Amount";
			}
			
			$this->data['records'][] = array(
				'tax_rate_id'   => $result['tax_rate_id'],				
				'name' => $result['name'],
				'rate' => $result['rate'],				
				'type' => $type,
				'country_name' => $country_name,		
				'date_added'      => date($this->common->config('config_date_format'), strtotime($result['date_added'])),	
				'date_modified'      => date($this->common->config('config_date_format'), strtotime($result['date_modified'])),
				'edit'               =>base_url('system/tax_rates/edit'.$url.'/'.$this->commons->encode($result['tax_rate_id']))
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
		$content_page="themes/".$admin_theme."/system/tax_rates_list";
		$this->load->view($content_page,$this->data);
		
	}
	
	/**
	* 
	* @function name : add()
	* @description   : load Return_status Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function add()	{
		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				$this->tax_rates->addTaxRates();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/name';
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
				redirect('system/tax_rates');
	     }
		$this->getForm();
	}
	
	/**
	* 
	* @function name : edit()
	* @description   : edit Return_status records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'name', $sort_order = 'ASC', $offset = 0)
	{
		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				 
				$this->tax_rates->editTaxRates();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/name';
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
				
				redirect('system/tax_rates/index'.$url);
				
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
			foreach ($this->input->post('selected') as $tax_rates_id) 
			{
				$this->tax_rates->deleteTaxRates($tax_rates_id);
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
			foreach ($this->input->post('selected') as $tax_rates_id) 
			{
				$this->tax_rates->softDeleteTaxRates($tax_rates_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success'));
			$this->index();
		}
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
			$url .= '/name';
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
		   'text' => 'Tax Rates',
		   'href' => base_url('system/tax_rates'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{
			$this->data['form_action'] = base_url('system/tax_rates/add'.$url);
			$this->data['tax_rate_id'] = '';
			$this->data['text_form'] 		= $this->lang->line('text_add');
		} 
		else 
		{
			$this->data['form_action'] = base_url('system/tax_rates/edit'.$url.'/'.$this->uri->segment($count));
			
			$this->data['tax_rate_id'] = $this->commons->decode($this->uri->segment($count));
			$this->data['text_form'] 		= $this->lang->line('text_edit');
		}
		//$this->data['refresh'] 		= base_url('system/return_status/refresh');
		$this->data['cancel'] 		= base_url('system/tax_rates/index'.$url);
		
		// Set Value Back
		if (1) 
		{
			$tax_rates_info = $this->tax_rates->getTaxRatesById($this->commons->decode($this->uri->segment($count)));
		}
		//echo '<pre>';print_r($ReturnStatus_info);
		
		if ($this->input->post('tax_name')!==NULL) {
			$this->data['tax_name'] = $this->input->post('tax_name');
		} elseif (!empty($tax_rates_info)) {
			
			$this->data['tax_name'] = $tax_rates_info['name'];
		} else {
			$this->data['tax_name'] = '';
		}
		
		if ($this->input->post('tax_rate')!==NULL) {
			$this->data['tax_rate'] = $this->input->post('tax_rate');
		} elseif (!empty($tax_rates_info)) {
			$this->data['tax_rate'] = $tax_rates_info['rate'];
		} else {
			$this->data['tax_rate'] = '';
		}
		
		if ($this->input->post('type')!==NULL) {
			$this->data['type'] = $this->input->post('type');
		} elseif (!empty($tax_rates_info)) {
			$this->data['type'] = $tax_rates_info['type'];
		} else {
			$this->data['type'] = '';
		}		
		
		if ($this->input->post('country')!==NULL) {
			$this->data['country_id'] = $this->input->post('country');
		} elseif (!empty($tax_rates_info)) {
			$this->data['country_id'] = $tax_rates_info['country_id'];
		} else {
			$this->data['country_id'] = '';
		}
		
		/*if ($this->input->post('customer_group')!==NULL) {
			$this->data['customer_group'] = $this->input->post('customer_group');
		} elseif (!empty($tax_rates_info)) {
			$this->data['customer_group'] = $tax_rates_info['customer_group'];
		} else {
			$this->data['customer_group'] = '';
		}*/
		
		/*if ($this->input->post('customer_group')!==NULL) {
			$data['tax_rate_customer_group'] = $this->input->post('customer_group');
		} elseif (isset($this->request->get['tax_rate_id'])) {
			$data['tax_rate_customer_group'] = $this->tax_rates->getTaxRateCustomerGroups($this->input->post('customer_group'));
		} else {
			$data['tax_rate_customer_group'] = array($this->config->get('config_customer_group_id'));
		}*/
		
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			if($this->input->post('is_deleted')==1)
			{
				$this->data['is_deleted'] = $this->input->post('is_deleted'); 
			}else {
				$this->data['is_deleted'] = 0;
			}
		} elseif (!empty($tax_rates_info)) {
			$this->data['is_deleted'] = $tax_rates_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
	
		//$this->data['customer_groups'] = $this->customer_groups->getCustomerGroups();
		$this->data['country_list'] = $this->country->getCountries();
		
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/system/tax_rates";
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
	public function validateForm()
	{
		$validation = array(
					   
					    array(
					        'field' => 'tax_name',
					        'label' => 'Tax Name', 
					        'rules' => 'trim|required|min_length[3]|max_length[128]|xss_clean|callback_check_exists_tax_name', 
					        'errors' => array('required' => '%s must be between 3 and 128 characters!','min_length'=>'%s must be between 3 and 128 characters!','max_length'=>'%s must be between 3 and 128 characters!','check_exists_tax_name'=>'%s already exists!')
					    ),
						
						array(
					        'field' => 'tax_rate',
					        'label' => 'Tax Rate', 
					        'rules' => 'trim|required|numeric|xss_clean', 
					        'errors' => array('required' => '%s must be required!','numeric' => '%s must be digits')
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
	* @function name : validateDelete()
	* @description   : Check currency relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{
		foreach ($this->input->post('selected') as $tax_rates_id) 
		{			
			$tax_rule_total=$this->tax_classes->getTotalTaxRulesByTaxRateId($tax_rates_id);			
	
			if ($tax_rule_total) {
				$this->error['warning'] = $this->lang->line('error_default');
			}	
			
			$tax_rates_info = $this->tax_rates->getTaxRatesById($tax_rates_id);
			
			if ($tax_rates_info) 
			{
				if (0) 
				{
					$this->error['warning'] = $this->lang->line('error_default');
				}
			}
		}
		return !$this->error;
	}
	
	/**
    * 
    * @function name    : check_exists_tax_name()
    * @description      : Validate for tax name existing or not
    * @access           : public
    * @param            : void
    * @return           : boolean
    *
    */
    function check_exists_tax_name($str)
    {
        $this->db->from('tax_rate');
        $this->db->where('name',strtolower($str));
        if($this->input->post('tax_rate_id') !="")
        {
            $this->db->where('tax_rate_id !=',$this->input->post('tax_rate_id'));
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