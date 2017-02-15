<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Length
* @Auther       : Nitin Sabhadiya
* @Date         : 09-11-2016
* @Description  : Length Related Collection of functions
*
*/

class Length extends CI_Controller {

	private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('system/length_model','length');
		
		$this->lang->load('system/length_lang', 'english');
		
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
		$this->output->set_common_meta('LengthClasses','sarpo','This is srapo LengthClasses page');
		

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load length view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'title', $sort_order = 'ASC', $offset = 0)	
	{
	

		// breadcrumbs
		$this->data['add'] 			 = base_url('system/length/add');
		if($this->session->userdata('role_id')== 1)
		{
			$this->data['delete'] 		= base_url('system/length/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('system/length/softDelete');
		}
		
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		  
		$this->data['breadcrumbs'][] = array(
		   'text' => 'LengthClasses',
		   'href' => base_url('system/length'),
		 
		  );
		  
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("system/length/index/$sort_by/$sort_order");
		$total_records = $this->length->getTotalLengthClasses();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->length->getLengthClasses($data);
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
				'length_id'   => $result['length_id'],
				'title'         => $result['title'] . (($result['length_id'] == $this->common->config('config_length_class_id')) ? $this->lang->line('text_default_b') : null),
				'unit'          => $result['unit'],
				'value'         => $result['value'],
                                'is_deleted'    => $result['is_deleted'],
				'date_modified' => date($this->common->config('config_date_format'), strtotime($result['date_modified'])),
				'edit'          =>base_url('system/length/edit'.$url.'/'.$this->commons->encode($result['length_id']))
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
		$content_page="themes/".$admin_theme."/system/length_list";
		$this->load->view($content_page,$this->data);

	}
	
	/**
	* 
	* @function name : add()
	* @description   : load length Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	
	public function add()	{
	
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				$this->length->addLength();
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
				redirect('system/length');
	     }
		$this->getForm();
	}
	
	/**
	* 
	* @function name : edit()
	* @description   : edit length records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'title', $sort_order = 'ASC', $offset = 0)
	{
		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				 
								
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
                    
                    if ($this->input->post('is_deleted') == 1) {
                        $res = $this->validateSoftDelete($this->input->post('length_id'));
                        if($res==0)
                        {
                            $this->session->set_userdata('error',$this->error['warning']);
                            redirect('system/length/edit'.$url.'/'.$this->commons->encode($this->input->post('length_id')));  
                        }
                    }   
                    
                    $this->length->editLength();
                    $this->session->set_userdata('success',$this->lang->line('text_success'));
                    redirect('system/length/index'.$url);
				
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
			foreach ($this->input->post('selected') as $length_id) 
			{
				$this->length->deleteLength($length_id);
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
			foreach ($this->input->post('selected') as $length_id) 
			{
				$this->length->softDeleteLength($length_id);
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
		if (isset($this->error['warning']) || $this->session->userdata('error')!==NULL) {
			if ($this->session->userdata('error')!==NULL)
                        { 
                            //echo "Error".$this->session->userdata('error'); exit;
                            $this->error['warning'] = $this->session->userdata('error');
                        }
			$this->data['error'] = $this->error['warning'];
                        $this->session->set_userdata('error','');
		} else {
			$this->data['error'] = '';
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
		   'text' => 'LengthClasses',
		   'href' => base_url('system/length'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{
			$this->data['form_action'] = base_url('system/length/add'.$url);
			$this->data['length_id'] = '';
			$this->data['text_form'] 		= $this->lang->line('text_add');
		} 
		else 
		{
			$this->data['form_action'] = base_url('system/length/edit'.$url.'/'.$this->uri->segment($count));
			$this->data['text_form'] 		= $this->lang->line('text_edit');
			
			$this->data['length_id'] = $this->commons->decode($this->uri->segment($count));
		}
		
		$this->data['cancel'] 		= base_url('system/length/index'.$url);
		
		
		// Set Value Back
		if (1) 
		{
			$length_info = $this->length->getLength($this->commons->decode($this->uri->segment($count)));
		}
		//echo '<pre>';print_r($length_info);
		
		if ($this->input->post('title')!==NULL) {
			$this->data['title'] = $this->input->post('title');
		} elseif (!empty($length_info)) {
			
			$this->data['title'] = $length_info['title'];
		} else {
			$this->data['title'] = '';
		}
		
		if ($this->input->post('unit')!==NULL) {
			$this->data['unit'] = $this->input->post('unit');
		} elseif (!empty($length_info)) {
			$this->data['unit'] = $length_info['unit'];
		} else {
			$this->data['unit'] = '';
		}
		
		
		
		if ($this->input->post('value')!==NULL) {
			$this->data['value'] = $this->input->post('value');
		} elseif (!empty($length_info)) {
			$this->data['value'] = $length_info['value'];
		} else {
			$this->data['value'] = '';
		}
		
		if ($this->input->post('status')!==NULL)
                {
			$this->data['status'] = $this->input->post('status');
		} elseif (!empty($length_info)) {
			$this->data['status'] = $length_info['status'];
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
		} elseif (!empty($length_info)) {
			$this->data['is_deleted'] = $length_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
		//echo '<pre>'.$count;print_r($this->data);die;
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/system/length";
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
					        'label' => 'Length Title', 
					        'rules' => 'trim|required|min_length[3]|max_length[128]|xss_clean|callback_check_exists_title', 
					        'errors' => array('required' => '%s must be between 3 and 128 characters!','min_length'=>'%s must be between 3 and 128 characters!','max_length'=>'%s must be between 3 and 128 characters!','check_exists_title'=>'%s already exists!')
					    ),
					    array(
					        'field' => 'unit',
					        'label' => 'Length Code', 
					        'rules' => 'trim|required|min_length[1]|xss_clean|callback_check_exists_unit', 
					        'errors' => array('required' => '%s must contain 1 characters!!','check_exists_unit'=>'%s already exists!')
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
	* @function name : validateDelete()
	* @description   : Check length relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{
            $this->load->model('catalog/product_model');
            
            
            
            foreach ($this->input->post('selected') as $length_class_id) {
                if ($this->common->config('config_length_class_id') == $length_class_id) {
                        $this->error['warning'] = $this->lang->line('error_default');
                }

                $product_total = $this->product_model->getTotalProductsByLengthClassId($length_class_id);

                if ($product_total) {
                        $this->error['warning'] = sprintf($this->lang->line('error_product'), $product_total);
                }
            }            
            return !$this->error;
	}
        /**
	* 
	* @function name : validateSoftDelete()
	* @description   : Check length relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateSoftDelete($length_class_id) 
	{
            $this->load->model('catalog/product_model');
            
            if ($this->common->config('config_length_class_id') == $length_class_id) {
                    $this->error['warning'] = $this->lang->line('error_default');
            }

            $product_total = $this->product_model->getTotalProductsByLengthClassId($length_class_id);

            if ($product_total) {
                    $this->error['warning'] = sprintf($this->lang->line('error_product'), $product_total);
            }
           
            return !$this->error;
	}
        
	/**
	* 
	* @function name 	: check_exists_title()
	* @description   	: Validate for length title existing or not
	* @access 		: public
	* @param   		: void
	* @return        	: boolean
	*
	*/
    function check_exists_title($str)
	{
		$this->db->from('length');
		$this->db->where('LOWER(title)',strtolower($str));
                $this->db->where('is_deleted=0');
		if($this->input->post('length_id') !="")
		{
			$this->db->where('length_id !=',$this->input->post('length_id'));
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
	* @function name 	: check_exists_unit()
	* @description   	: Validate for length unit existing or not
	* @access 		: public
	* @param   		: void
	* @return        	: boolean
	*
	*/
    function check_exists_unit($str)
	{
	  	$this->db->from('length');
		$this->db->where('LOWER(unit)',strtolower($str));
                $this->db->where('is_deleted=0');
		if($this->input->post('length_id') !="")
		{
			$this->db->where('length_id !=',$this->input->post('length_id'));
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
