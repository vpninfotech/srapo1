<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Attributes Groups
* @Auther       : Mitesh
* @Date         : 10-11-2016
* @Description  : Attributes Groups Controller 
*
*/

class Attributes_groups extends CI_Controller {

	private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('catalog/attributes_groups_model','attributes_groups');
		
		$this->lang->load('catalog/attributes_groups_lang', 'english');
		
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
		$this->output->set_common_meta('Attributes Groups','sarpo','This is srapo Attributes Groups page');
		

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load attribute group view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'attribute_group_name', $sort_order = 'ASC', $offset = 0)	
	{
		// breadcrumbs
		$this->data['add'] 			 = base_url('catalog/attributes_groups/add');
		if($this->session->userdata('Drole_id')== 1)
		{
			$this->data['delete'] 		= base_url('catalog/attributes_groups/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('catalog/attributes_groups/softDelete');
		}
		//$this->data['refresh'] 			= base_url('catalog/attributes_groups/refresh');
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		  
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Attribute Groups',
		   'href' => base_url('catalog/attributes_groups'),
		 
		  );
		  
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("catalog/attributes_groups/index/$sort_by/$sort_order");
		$total_records = $this->attributes_groups->getTotalAttributesGroups();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->attributes_groups->getAttributesGroups($data);
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
			$url .= '/attribute_group_name';
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
				'attribute_group_id'   => $result['attribute_group_id'],
				'attribute_group_name' => $result['attribute_group_name'],
				'sort_order'       => $result['sort_order'],			
				'status'           => $result['status'],
				'date_modified'    => date($this->common->config('config_date_format'), strtotime($result['date_modified'])),
				'edit'             =>base_url('catalog/attributes_groups/edit'.$url.'/'.$this->commons->encode($result['attribute_group_id']))
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
		
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/catalog/attributes_groups_list";
		$this->load->view($content_page,$this->data);

	}
	
	/**
	* 
	* @function name : add()
	* @description   : load Attributes Groups Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	
	public function add()	{
		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
			
				$this->attributes_groups->addAttributesGroups();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/attribute_group_name';
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
				redirect('catalog/attributes_groups/index'.$url);
	     }
		$this->getForm();
	}
	
	/**
	* 
	* @function name : edit()
	* @description   : edit attribute group records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'attribute_group_name', $sort_order = 'ASC', $offset = 0)
	{		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				
				$this->attributes_groups->editAttributesGroups();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/attribute_group_name';
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
				
				redirect('catalog/attributes_groups/index'.$url);
				
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
			foreach ($this->input->post('selected') as $attribute_group_id) 
			{
				$this->attributes_groups->deleteAttributesGroups($attribute_group_id);
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
			foreach ($this->input->post('selected') as $attribute_group_id) 
			{
				$this->attributes_groups->softDeleteAttributesGroups($attribute_group_id);
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
			$url .= '/attribute_group_name';
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
		   'text' => 'Attribute Groups',
		   'href' => base_url('catalog/attributes_groups'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{			
			//$this->data['form_title'] = 'Add';
			$this->data['text_form'] 		= $this->lang->line('text_add');
			$this->data['form_action'] = base_url('catalog/attributes_groups/add'.$url);
			$this->data['attribute_group_id'] = '';
		} 
		else 
		{			
			$this->data['text_form'] 		= $this->lang->line('text_edit');
			$this->data['form_action'] = base_url('catalog/attributes_groups/edit'.$url.'/'.$this->uri->segment($count));
			
			$this->data['attribute_group_id'] = $this->commons->decode($this->uri->segment($count));
		}
		//$this->data['refresh'] 		= base_url('catalog/attributes_groups/refresh');
		$this->data['cancel'] 		= base_url('catalog/attributes_groups/index'.$url);
		
		// Set Value Back
		if (1) 
		{
			$attributes_groups_info = $this->attributes_groups->getAttributeGroup($this->commons->decode($this->uri->segment($count)));
		}		
				
		if ($this->input->post('attribute_group_name')!==NULL) {
			$this->data['attribute_group_name'] = $this->input->post('attribute_group_name');
		} elseif (!empty($attributes_groups_info)) {
			
			$this->data['attribute_group_name'] = $attributes_groups_info['attribute_group_name'];
		} else {
			$this->data['attribute_group_name'] = '';
		}	
	
		if ($this->input->post('sort_order')!==NULL) {
			$this->data['sort_order'] = $this->input->post('sort_order');
		} elseif (!empty($attributes_groups_info)) {
			$this->data['sort_order'] = $attributes_groups_info['sort_order'];
		} else {
			$this->data['sort_order'] = '';
		}
		
                if ($this->input->post('status')!==NULL)
                {
			$this->data['status'] = $this->input->post('status');
		} elseif (!empty($attributes_groups_info)) {
			$this->data['status'] = $attributes_groups_info['status'];
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
		} elseif (!empty($attributes_groups_info)) {
			$this->data['is_deleted'] = $attributes_groups_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
		
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/catalog/attributes_groups";
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
					        'field' => 'attribute_group_name',
					        'label' => 'Attribute Groups Name', 
					        'rules' => 'trim|required|min_length[3]|max_length[64]|xss_clean|callback_attributeGroup_check', 
					        'errors' => array('required' => '%s must be between 3 and 64 characters!','min_length'=>'%s must be between 3 and 64 characters!','max_length'=>'%s must be between 3 and 64 characters!','attributeGroup_check'=>'%s is already in use!')
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
	* @function name : attributeGroup_check()
	* @description   : Check atrribute group id already exists or not
	* @param         : void
	* @return        : void
	*
	*/
        public function attributeGroup_check($str)
        {  
            $this->db->from('attribute_group');
            $this->db->where('LOWER(attribute_group_name)',strtolower($str));
            $this->db->where('is_deleted=0');
            if($this->input->post('attribute_group_id') !="")
            {
                $this->db->where('attribute_group_id !=',$this->input->post('attribute_group_id'));
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
	
	/**
	* 
	* @function name : validateDelete()
	* @description   : Check attribute group relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{	
            $this->load->model('catalog/attributes_model');
            
            foreach ($this->input->post('selected') as $attribute_group_id) 
            {
		$attributes_total = $this->attributes_model->getTotalAttributesByAttributeGroupId($attribute_group_id);
			
                    if ($attributes_total) 
                    {	
                        $this->error['warning'] = $this->lang->line('error_attribute').'('.$attributes_total.')!';
                    }
		}
		return !$this->error;
	}
	
}
