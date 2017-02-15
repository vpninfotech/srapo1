<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Attributes
* @Auther       : Mitesh
* @Date         : 10-11-2016
* @Description  : Attributes Controller 
*
*/

class Attributes extends CI_Controller {

	private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('catalog/attributes_model','attributes');
		
		$this->load->model('catalog/attributes_groups_model','attributes_groups');
		
		$this->lang->load('catalog/attributes_lang', 'english');
		
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
		$this->output->set_template('finance_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Attributes','sarpo','This is srapo Attributes page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load attribute group view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'attribute_name', $sort_order = 'ASC', $offset = 0)	
	{
		// breadcrumbs
		$this->data['add'] 			 = base_url('catalog/attributes/add');
		if($this->session->userdata('Drole_id')== 1)
		{
			$this->data['delete'] 		= base_url('catalog/attributes/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('catalog/attributes/softDelete');
		}
		//$this->data['refresh'] 			= base_url('catalog/attributes/refresh');
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		  
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Attributes',
		   'href' => base_url('catalog/attributes'),
		 
		  );
		  
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("catalog/attributes/index/$sort_by/$sort_order");
		$total_records = $this->attributes->getTotalAttributes();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->attributes->getAttributes($data);
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
			$url .= '/attribute_name';
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
			$get_attribute_group_name=$this->attributes_groups->getAttributeGroupbyid($result['attribute_group_id']);
			
			$this->data['records'][] = array(
				'attribute_id'   => $result['attribute_id'],
				'attribute_name'   => $result['attribute_name'],
				'attribute_group_name' => $get_attribute_group_name['attribute_group_name'],
				'sort_order'       => $result['sort_order'],			
				'status'           => $result['status'],
				'date_modified'    => date($this->common->config('config_date_format'), strtotime($result['date_modified'])),
				'edit'             =>base_url('catalog/attributes/edit'.$url.'/'.$this->commons->encode($result['attribute_id']))
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
		$content_page="themes/".$admin_theme."/catalog/attributes_list";
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
				
				//check if attribute exists message set in session if exists then destroy it.				
				if($this->session->userdata('exists_attribute'))
				{
					$this->session->unset_userdata('exists_attribute');
				}
				
				$this->attributes->addAttributes();
								
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
								
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/attribute_name';
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
				redirect('catalog/attributes/index'.$url);
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
	public function edit($sort_by = 'attribute_name', $sort_order = 'ASC', $offset = 0)
	{		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				
				$this->attributes->editAttributes();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/attribute_name';
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
				
				redirect('catalog/attributes/index'.$url);
				
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
			foreach ($this->input->post('selected') as $attribute_id) 
			{
				$this->attributes->deleteAttributes($attribute_id);
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
			foreach ($this->input->post('selected') as $attribute_id) 
			{
				$this->attributes->softDeleteAttributes($attribute_id);
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
			$url .= '/attribute_name';
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
		   'text' => 'Attributes',
		   'href' => base_url('catalog/attributes'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{						
			//all attribute groups name display in dropdown menu list 
			$this->data['get_attribute_group_name']=$this->attributes_groups->getAllAttributeGroup();
													
			$this->data['text_form'] 		= $this->lang->line('text_add');
			$this->data['form_action'] = base_url('catalog/attributes/add'.$url);
			$this->data['attribute_id'] = '';
		} 
		else 
		{			
			//all attribute groups name display in dropdown menu list 
			$this->data['get_attribute_group_name']=$this->attributes_groups->getAllAttributeGroup();
			
			$this->data['text_form'] 		= $this->lang->line('text_edit');
			$this->data['form_action'] = base_url('catalog/attributes/edit'.$url.'/'.$this->uri->segment($count));
			
			$this->data['attribute_id'] = $this->commons->decode($this->uri->segment($count));
		}
		//$this->data['refresh'] 		= base_url('catalog/attributes/refresh');
		$this->data['cancel'] 		= base_url('catalog/attributes/index'.$url);
		
		// Set Value Back
		if (1) 
		{
			$attributes_info = $this->attributes->getAttribute($this->commons->decode($this->uri->segment($count)));
		}		
			
		if ($this->input->post('attribute_name')!==NULL) {
			$this->data['attribute_name'] = $this->input->post('attribute_name');
		} elseif (!empty($attributes_info)) {
			
			$this->data['attribute_name'] = $attributes_info['attribute_name'];
		} else {
			$this->data['attribute_name'] = '';
		}	
		
		if ($this->input->post('attribute_group_id')!==NULL) {
			$this->data['attribute_group_id'] = $this->input->post('attribute_group_id');
		} elseif (!empty($attributes_info)) {
			
			$this->data['attribute_group_id'] = $attributes_info['attribute_group_id'];
		} else {
			$this->data['attribute_group_id'] = '';
		}	
		
			
		if ($this->input->post('sort_order')!==NULL) {
			$this->data['sort_order'] = $this->input->post('sort_order');
		} elseif (!empty($attributes_info)) {
			$this->data['sort_order'] = $attributes_info['sort_order'];
		} else {
			$this->data['sort_order'] = '';
		}
		
		if ($this->input->post('status')!==NULL)
                {
			$this->data['status'] = $this->input->post('status');
		} elseif (!empty($attributes_info)) {
			$this->data['status'] = $attributes_info['status'];
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
		} elseif (!empty($attributes_info)) {
			$this->data['is_deleted'] = $attributes_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
			
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/catalog/attributes";
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
					        'field' => 'attribute_name',
					        'label' => 'Attribute Name', 
					        'rules' => 'trim|required|min_length[3]|max_length[64]|xss_clean|callback_attribute_check', 
					        'errors' => array('required' => '%s must be between 3 and 64 characters!','min_length'=>'%s must be between 3 and 64 characters!','max_length'=>'%s must be between 3 and 64 characters!','attribute_check'=>'%s is already in use!')
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
        public function attribute_check($str)
        {  
            $this->db->from('attribute');
            $this->db->where('LOWER(attribute_name)',strtolower($str));
            $this->db->where('is_deleted=0');
            if($this->input->post('attribute_id') !="")
            {
                $this->db->where('attribute_id !=',$this->input->post('attribute_id'));
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
            $this->load->model('catalog/product_model');
            
            foreach ($this->input->post('selected') as $attribute_id) 
            {
                    $product_total = $this->product_model->getTotalProductsByAttributeId($attribute_id);

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
		if ($this->input->post('attribute_name')!==NULL) {
                    $attribute_name = $this->input->post('attribute_name');
                } else {
                    $attribute_name = '';
                }
                
                $filter_data = array (
                    'attribute_name' => $attribute_name,
                    'start'        => 0,
                    'limit'        => 5
                );
                
                $results = $this->attributes->getAttributes($filter_data);
               
                foreach($results as $result) {
                    $json[] = array (
                        'attribute_id' => $result['attribute_id'],
                        'attribute_name' => $result['attribute_name'],
                        'attribute_group' => $result['attribute_group']
                    );
                    
                }
                
                $sort_order = array();
                
                foreach ($json as $key => $value) {
                    $sort_order[$key] = $value['attribute_name'];
		}
                
                array_multisort($sort_order, SORT_ASC, $json);
                
                echo json_encode($json);
	}
}
