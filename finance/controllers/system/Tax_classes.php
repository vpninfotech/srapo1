<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Tax_classes
* @Auther       : Mitesh
* @Date         : 19-12-2016
* @Description  : Tax_classes Related Collection of functions
*
*/

class Tax_classes extends CI_Controller {
	
	private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->_init();
		
		$this->load->model('system/Tax_classes_model','tax_classes');
		
		$this->lang->load('system/tax_classes_lang', 'english');
		
		//get tax rates data
		$this->load->model('system/Tax_rates_model','tax_rates');
		
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
		$this->output->set_common_meta('Tax Classes','sarpo','This is srapo Tax Classes page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load tax classes view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'title', $sort_order = 'ASC', $offset = 0)
	{
		
		// breadcrumbs
		$this->data['add'] 			 = base_url('system/tax_classes/add');
		if($this->session->userdata('role_id')== 1)
		{
			$this->data['delete'] 		= base_url('system/tax_classes/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('system/tax_classes/softDelete');
		}
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Tax Classes', // Order Status 
		   'href' => base_url('system/tax_classes'),
		 
		  );
		  
		// pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("system/tax_classes/index/$sort_by/$sort_order");
		$total_records = $this->tax_classes->getTotalTaxClasses();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->tax_classes->getTaxClasses($data);
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
			$url .= '/title';
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
				'tax_class_id'   => $result['tax_class_id'],
				'title' => $result['title'],
				'date_modified'      => date($this->common->config('config_date_format'), strtotime($result['date_modified'])),
				'edit'               =>base_url('system/tax_classes/edit'.$url.'/'.$this->commons->encode($result['tax_class_id']))
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
		$content_page="themes/".$admin_theme."/system/tax_classes_list";
		$this->load->view($content_page,$this->data);
		
	}
	
	/**
	* 
	* @function name : add()
	* @description   : load tax classes Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function add()	{
		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				$this->tax_classes->addTaxClasses();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/title';
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
				redirect('system/tax_classes');
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
	public function edit($sort_by = 'title', $sort_order = 'ASC', $offset = 0)
	{
		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				 
				/*$get_tax_rules=$this->input->post('tax_rule');
		
				echo "<pre>";
				print_r($get_tax_rules);
				echo "</pre>";
				exit;*/
		
				$this->tax_classes->editTaxClasses();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/title';
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
				
				redirect('system/tax_classes/index'.$url);
				
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
			foreach ($this->input->post('selected') as $tax_class_id) 
			{
				$this->tax_classes->deleteTaxClasses($tax_class_id);
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
			foreach ($this->input->post('selected') as $tax_class_id) 
			{
				$this->tax_classes->softDeleteTaxClasses($tax_class_id);
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
			$url .= '/title';
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
		   'text' => 'Tax Classes',
		   'href' => base_url('system/tax_classes'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{
			$this->data['form_action'] = base_url('system/tax_classes/add'.$url);
			$this->data['tax_class_id'] = '';
			$this->data['text_form'] 		= $this->lang->line('text_add');
		} 
		else 
		{
			$this->data['form_action'] = base_url('system/tax_classes/edit'.$url.'/'.$this->uri->segment($count));
			
			$this->data['tax_class_id'] = $this->commons->decode($this->uri->segment($count));
			$this->data['text_form'] 		= $this->lang->line('text_edit');
		}
		//$this->data['refresh'] 		= base_url('system/return_status/refresh');
		$this->data['cancel'] 		= base_url('system/tax_classes/index'.$url);
		
		// Set Value Back
		if (1) 
		{
			$tax_classes_info = $this->tax_classes->getTaxClassesById($this->commons->decode($this->uri->segment($count)));
		}
			
		if ($this->input->post('tax_class_title')!==NULL) {
			$this->data['tax_class_title'] = $this->input->post('tax_class_title');
		} elseif (!empty($tax_classes_info)) {
			
			$this->data['tax_class_title'] = $tax_classes_info['title'];
		} else {
			$this->data['tax_class_title'] = '';
		}
		
		if ($this->input->post('description')!==NULL) {
			$this->data['description'] = $this->input->post('description');
		} elseif (!empty($tax_classes_info)) {
			$this->data['description'] = $tax_classes_info['description'];
		} else {
			$this->data['description'] = '';
		}
		
		$this->data['tax_rates'] = $this->tax_rates->getTaxRates();
		
		$this->data['tax_rules']=array();
		if ($this->input->post('tax_rule')!==NULL) {
			$this->data['tax_rules'] = $this->input->post('tax_rule');
		} elseif (!empty($tax_classes_info)) {
			
			$this->data['tax_rules']= $this->tax_classes->getTaxRules($tax_classes_info['tax_class_id']);					
		} else {
			$this->data['tax_rules'] = array();
		}
			
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			if($this->input->post('is_deleted')==1)
			{
				$this->data['is_deleted'] = $this->input->post('is_deleted'); 
			}else {
				$this->data['is_deleted'] = 0;
			}
		} elseif (!empty($tax_classes_info)) {
			$this->data['is_deleted'] = $tax_classes_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
	
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/system/tax_classes";
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
					        'field' => 'tax_class_title',
					        'label' => 'Tax Class Title', 
					        'rules' => 'trim|required|min_length[3]|max_length[128]|xss_clean|callback_check_exists_tax_class_title', 
					        'errors' => array('required' => '%s must be between 3 and 128 characters!','min_length'=>'%s must be between 3 and 128 characters!','max_length'=>'%s must be between 3 and 128 characters!','check_exists_tax_class_title'=>'%s already exists!')
					    ),
						
						 array(
					        'field' => 'description',
					        'label' => 'Tax Class Description', 
					        'rules' => 'trim|required|min_length[3]|max_length[128]|xss_clean', 
					        'errors' => array('required' => '%s must be between 3 and 128 characters!','min_length'=>'%s must be between 3 and 128 characters!','max_length'=>'%s must be between 3 and 128 characters!')
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
		foreach ($this->input->post('selected') as $tax_class_id) 
		{
			
			$tax_rule_total=$this->tax_classes->getTotalTaxRulesByTaxClassId($tax_class_id);
			if ($tax_rule_total) {
				$this->error['warning'] = $this->lang->line('error_default');
			}
			
			$tax_classes_info = $this->tax_classes->getTaxClassesById($tax_class_id);
			
			if ($tax_classes_info) 
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
    * @function name    : check_exists_return_status_name()
    * @description      : Validate for return status name existing or not
    * @access           : public
    * @param            : void
    * @return           : boolean
    *
    */
    function check_exists_tax_class_title($str)
    {
        $this->db->from('tax_class');
        $this->db->where('title',strtolower($str));
        if($this->input->post('tax_class_id') !="")
        {
            $this->db->where('tax_class_id !=',$this->input->post('tax_class_id'));
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