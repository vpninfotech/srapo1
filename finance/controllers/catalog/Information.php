<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Information
* @Auther       : Mitesh
* @Date         : 09-11-2016
* @Description  : Collection of Information Module related Functions
*
*/

class Information extends CI_Controller {


	private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('catalog/information_model','information');
		
		$this->lang->load('catalog/information_lang', 'english');
		
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
		$this->output->set_common_meta('Information','sarpo','This is srapo Informations page');
		

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load information view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'title', $sort_order = 'ASC', $offset = 0)	
	{
		// breadcrumbs
		$this->data['add'] 			 = base_url('catalog/information/add');
		if($this->session->userdata('Drole_id')== 1)
		{
			$this->data['delete'] 		= base_url('catalog/information/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('catalog/information/softDelete');
		}
		//$this->data['refresh'] 			= base_url('catalog/information/refresh');
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		  
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Information',
		   'href' => base_url('catalog/information'),
		 
		  );
		  
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("catalog/information/index/$sort_by/$sort_order");
		$total_records = $this->information->getTotalInformations();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->information->getInformations($data);
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
				'information_id'   => $result['information_id'],
				'title'            => $result['title'] . (($result['meta_title'] == $this->common->config('config_information')) ? $this->lang->line('text_default_b') : null),
				'meta_title'       => $result['meta_title'],
				'bottom'           => ($result['bottom'] ? $this->lang->line('text_bottom_yes') : $this->lang->line('text_bottom_no')),
				'sort_order'       => $result['sort_order'],
				'status'           => ($result['status'] ? $this->lang->line('text_enabled') : $this->lang->line('text_disabled')),
				'date_modified'    => date($this->common->config('config_date_format'), strtotime($result['date_modified'])),
				'edit'             =>base_url('catalog/information/edit'.$url.'/'.$this->commons->encode($result['information_id']))
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
		$content_page="themes/".$admin_theme."/catalog/information_list";
		$this->load->view($content_page,$this->data);

	}
	
	/**
	* 
	* @function name : add()
	* @description   : load information Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	
	public function add()	{
		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
			
				$this->information->addInformation();
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
				redirect('catalog/information/index'.$url);
	     }
		$this->getForm();
	}
	
	/**
	* 
	* @function name : edit()
	* @description   : edit information records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'title', $sort_order = 'ASC', $offset = 0)
	{		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				
				$this->information->editInformation();
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
				
				redirect('catalog/information/index'.$url);
				
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
			foreach ($this->input->post('selected') as $information_id) 
			{
				$this->information->deleteInformation($information_id);
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
			foreach ($this->input->post('selected') as $information_id) 
			{
				$this->information->softDeleteInformation($information_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success'));
			//redirect('catalog/information');
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
		   'text' => 'Information',
		   'href' => base_url('catalog/information'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{			
			//$this->data['form_title'] = 'Add';
			$this->data['text_form'] 		= $this->lang->line('text_add');
			$this->data['form_action'] = base_url('catalog/information/add'.$url);
			$this->data['information_id'] = '';
		} 
		else 
		{			
			$this->data['text_form'] 		= $this->lang->line('text_edit');
			$this->data['form_action'] = base_url('catalog/information/edit'.$url.'/'.$this->uri->segment($count));
			
			$this->data['information_id'] = $this->commons->decode($this->uri->segment($count));
		}
		//$this->data['refresh'] 		= base_url('catalog/information/refresh');
		$this->data['cancel'] 		= base_url('catalog/information/index'.$url);
		
		// Set Value Back
		if (1) 
		{
			$information_info = $this->information->getInformation($this->commons->decode($this->uri->segment($count)));
		}		
				
		if ($this->input->post('title')!==NULL) {
			$this->data['title'] = $this->input->post('title');
		} elseif (!empty($information_info)) {
			
			$this->data['title'] = $information_info['title'];
		} else {
			$this->data['title'] = '';
		}
		
		if ($this->input->post('description')!==NULL) {
			$this->data['description'] = $this->input->post('description');
		} elseif (!empty($information_info)) {
			$this->data['description'] = $information_info['description'];
		} else {
			$this->data['description'] = '';
		}
		
		if ($this->input->post('meta_title')!==NULL) {
			$this->data['meta_title'] = $this->input->post('meta_title');
		} elseif (!empty($information_info)) {
			$this->data['meta_title'] = $information_info['meta_title'];
		} else {
			$this->data['meta_title'] = '';
		}
				
		if ($this->input->post('meta_description')!==NULL) {
			$this->data['meta_description'] = $this->input->post('meta_description');
		} elseif (!empty($information_info)) {
			$this->data['meta_description'] = $information_info['meta_description'];
		} else {
			$this->data['meta_description'] = '';
		}
		
		if ($this->input->post('meta_keyword')!==NULL) {
			$this->data['meta_keyword'] = $this->input->post('meta_keyword');
		} elseif (!empty($information_info)) {
			$this->data['meta_keyword'] = $information_info['meta_keyword'];
		} else {
			$this->data['meta_keyword'] = '';
		}
		
		if ($this->input->server('REQUEST_METHOD') == 'POST')
                {
                    if($this->input->post('bottom')==1)
                    {
                       $this->data['bottom'] = $this->input->post('bottom'); 
                    }else {
                         $this->data['bottom'] = 0;
                    }
		} elseif (!empty($information_info)) {
			$this->data['bottom'] = $information_info['bottom'];
		} else {
			$this->data['bottom'] = 0;
		}
		
		if ($this->input->post('sort_order')!==NULL) {
			$this->data['sort_order'] = $this->input->post('sort_order');
		} elseif (!empty($information_info)) {
			$this->data['sort_order'] = $information_info['sort_order'];
		} else {
			$this->data['sort_order'] = '';
		}
		
		if ($this->input->post('status')!==NULL)
                {
			$this->data['status'] = $this->input->post('status');
		} elseif (!empty($information_info)) {
			$this->data['status'] = $information_info['status'];
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
		} elseif (!empty($information_info)) {
			$this->data['is_deleted'] = $information_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
		
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/catalog/information";
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
					        'field' => 'title',
					        'label' => 'Information Title', 
					        'rules' => 'trim|required|min_length[3]|max_length[64]|xss_clean|callback_information_check', 
					        'errors' => array('required' => '%s must be between 3 and 64 characters!','min_length'=>'%s must be between 3 and 64 characters!','max_length'=>'%s must be between 3 and 64 characters!','information_check' => '%s is already in use!')
					    ),
					    array(
					        'field' => 'meta_title',
					        'label' => 'Meta Tag Title', 
					        'rules' => 'trim|required|min_length[3]|max_length[255]|xss_clean', 
					        'errors' => array('required' => '%s must be greater than 3 and less than 255 characters!','min_length'=>'%s must be greater than 3 and less than 255 characters!','max_length'=>'%s must be greater than 3 and less than 255 characters!')
					    ),
                                            array(
                                            'field' => 'description',
                                            'label' => 'Description', 
                                            'rules' => 'trim|required|min_length[12]|xss_clean', 
                                            'errors' => array('required' => '%s is required! characters!','min_length'=>'%s is required!')
					    
					)
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
	* @function name : information_check()
	* @description   : Check information page name already exists or not
	* @param         : void
	* @return        : void
	*
	*/
        public function information_check($str)
        {  
            $this->db->from('information');
            $this->db->where('LOWER(title)',strtolower($str));
            $this->db->where('is_deleted=0');
            if($this->input->post('information_id') !="")
            {
                $this->db->where('information_id !=',$this->input->post('information_id'));
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
	* @description   : Check information relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{
           
            foreach ($this->input->post('selected') as $information_id) 
            {
                              
                if($this->common->config('config_account_id') == $information_id) {
                    $this->error['warning'] = $this->lang->line('error_account');
                }
                
                if($this->common->config('config_checkout_id') == $information_id) {
                    $this->error['warning'] = $this->lang->line('error_checkout');                   
                }
                
                if($this->common->config('config_return_id') == $information_id) {
                    $this->error['warning'] = $this->lang->line('error_return');
                }
            }
            return !$this->error;
	}
	
}