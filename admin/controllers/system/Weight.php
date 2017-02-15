<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Weight
* @Auther       : Nitin Sabhadiya
* @Date         : 09-11-2016
* @Description  : Weight Related Collection of functions
*
*/

class Weight extends CI_Controller {

	private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('system/weight_model','weight');
		
		$this->lang->load('system/weight_lang', 'english');
		
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
		$this->output->set_common_meta('WeightClasses','sarpo','This is srapo WeightClasses page');
		

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load weight view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'title', $sort_order = 'ASC', $offset = 0)	
	{
	

		// breadcrumbs
		$this->data['add'] 			 = base_url('system/weight/add');
		if($this->session->userdata('role_id')== 1)
		{
			$this->data['delete'] 		= base_url('system/weight/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('system/weight/softDelete');
		}
		
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		  
		$this->data['breadcrumbs'][] = array(
		   'text' => 'WeightClasses',
		   'href' => base_url('system/weight'),
		 
		  );
		  
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("system/weight/index/$sort_by/$sort_order");
		$total_records = $this->weight->getTotalWeightClasses();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->weight->getWeightClasses($data);
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
				'weight_id'   => $result['weight_id'],
				'title'         => $result['title'] . (($result['weight_id'] == $this->common->config('config_weight_class_id')) ? $this->lang->line('text_default_b') : null),
				'unit'          => $result['unit'],
				'value'         => $result['value'],
                                'is_deleted'    => $result['is_deleted'],
				'date_modified' => date($this->common->config('config_date_format'), strtotime($result['date_modified'])),
				'edit'          =>base_url('system/weight/edit'.$url.'/'.$this->commons->encode($result['weight_id']))
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
		$content_page="themes/".$admin_theme."/system/weight_list";
		$this->load->view($content_page,$this->data);

	}
	
	/**
	* 
	* @function name : add()
	* @description   : load weight Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	
	public function add()	{
	
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				$this->weight->addWeight();
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
				redirect('system/weight');
	     }
		$this->getForm();
	}
	
	/**
	* 
	* @function name : edit()
	* @description   : edit weight records
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
                        $res = $this->validateSoftDelete($this->input->post('weight_id'));
                        if($res==0)
                        {
                            $this->session->set_userdata('error',$this->error['warning']);
                            redirect('system/weight/edit'.$url.'/'.$this->commons->encode($this->input->post('weight_id')));  
                        }
                    }   
                    
                    $this->weight->editWeight();
                    $this->session->set_userdata('success',$this->lang->line('text_success'));
                    redirect('system/weight/index'.$url);
				
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
			foreach ($this->input->post('selected') as $weight_id) 
			{
				$this->weight->deleteWeight($weight_id);
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
			foreach ($this->input->post('selected') as $weight_id) 
			{
				$this->weight->softDeleteWeight($weight_id);
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
		   'text' => 'WeightClasses',
		   'href' => base_url('system/weight'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{
			$this->data['form_action'] = base_url('system/weight/add'.$url);
			$this->data['weight_id'] = '';
			$this->data['text_form'] 		= $this->lang->line('text_add');
		} 
		else 
		{
			$this->data['form_action'] = base_url('system/weight/edit'.$url.'/'.$this->uri->segment($count));
			$this->data['text_form'] 		= $this->lang->line('text_edit');
			
			$this->data['weight_id'] = $this->commons->decode($this->uri->segment($count));
		}
		
		$this->data['cancel'] 		= base_url('system/weight/index'.$url);
		
		
		// Set Value Back
		if (1) 
		{
			$weight_info = $this->weight->getWeight($this->commons->decode($this->uri->segment($count)));
		}
		//echo '<pre>';print_r($weight_info);
		
		if ($this->input->post('title')!==NULL) {
			$this->data['title'] = $this->input->post('title');
		} elseif (!empty($weight_info)) {
			
			$this->data['title'] = $weight_info['title'];
		} else {
			$this->data['title'] = '';
		}
		
		if ($this->input->post('unit')!==NULL) {
			$this->data['unit'] = $this->input->post('unit');
		} elseif (!empty($weight_info)) {
			$this->data['unit'] = $weight_info['unit'];
		} else {
			$this->data['unit'] = '';
		}
		
		
		
		if ($this->input->post('value')!==NULL) {
			$this->data['value'] = $this->input->post('value');
		} elseif (!empty($weight_info)) {
			$this->data['value'] = $weight_info['value'];
		} else {
			$this->data['value'] = '';
		}
		
		if ($this->input->post('status')!==NULL)
                {
			$this->data['status'] = $this->input->post('status');
		} elseif (!empty($weight_info)) {
			$this->data['status'] = $weight_info['status'];
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
		} elseif (!empty($weight_info)) {
			$this->data['is_deleted'] = $weight_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
		//echo '<pre>'.$count;print_r($this->data);die;
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/system/weight";
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
					        'label' => 'Weight Title', 
					        'rules' => 'trim|required|min_length[3]|max_length[128]|xss_clean|callback_check_exists_title', 
					        'errors' => array('required' => '%s must be between 3 and 128 characters!','min_length'=>'%s must be between 3 and 128 characters!','max_length'=>'%s must be between 3 and 128 characters!','check_exists_title'=>'%s already exists!')
					    ),
					    array(
					        'field' => 'unit',
					        'label' => 'Weight Unit', 
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
            
            
            
            foreach ($this->input->post('selected') as $weight_class_id) {
                if ($this->common->config('config_weight_class_id') == $weight_class_id) {
                        $this->error['warning'] = $this->lang->line('error_default');
                }

                $product_total = $this->product_model->getTotalProductsByWeightClassId($weight_class_id);

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
	public function validateSoftDelete($weight_class_id) 
	{
            $this->load->model('catalog/product_model');
            
            if ($this->common->config('config_weight_class_id') == $weight_class_id) {
                    $this->error['warning'] = $this->lang->line('error_default');
            }

            $product_total = $this->product_model->getTotalProductsByWeightClassId($weight_class_id);

            if ($product_total) {
                    $this->error['warning'] = sprintf($this->lang->line('error_product'), $product_total);
            }
           
            return !$this->error;
	}
        
	/**
	* 
	* @function name 	: check_exists_title()
	* @description   	: Validate for weight title existing or not
	* @access 		: public
	* @param   		: void
	* @return        	: boolean
	*
	*/
    function check_exists_title($str)
	{
		$this->db->from('weight');
		$this->db->where('LOWER(title)',strtolower($str));
                $this->db->where('is_deleted=0');
		if($this->input->post('weight_id') !="")
		{
			$this->db->where('weight_id !=',$this->input->post('weight_id'));
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
	* @description   	: Validate for weight unit existing or not
	* @access 		: public
	* @param   		: void
	* @return        	: boolean
	*
	*/
    function check_exists_unit($str)
	{
	  	$this->db->from('weight');
		$this->db->where('LOWER(unit)',strtolower($str));
                $this->db->where('is_deleted=0');
		if($this->input->post('weight_id') !="")
		{
			$this->db->where('weight_id !=',$this->input->post('weight_id'));
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
