<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Return_status
* @Auther       : Indrajit
* @Date         : 09-11-2016
* @Description  : Return_status Related Collection of functions
*
*/

class Return_status extends CI_Controller {
	
	private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->_init();
		
		$this->load->model('system/return_status_model','return_status');
		
		$this->lang->load('system/return_status_lang', 'english');
		
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
		$this->output->set_common_meta('Return Statuses','sarpo','This is srapo Return Statuses page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Return_status view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'return_status_name', $sort_order = 'ASC', $offset = 0)
	{
		
		// breadcrumbs
		$this->data['add'] 			 = base_url('system/return_status/add');
		if($this->session->userdata('role_id')== 1)
		{
			$this->data['delete'] 		= base_url('system/return_status/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('system/return_status/softDelete');
		}
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Return Statuses', // Order Status 
		   'href' => base_url('system/return_status'),
		 
		  );
		  
		// pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("system/return_status/index/$sort_by/$sort_order");
		$total_records = $this->return_status->getTotalReturnStatus();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->return_status->getReturnStatuses($data);
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
			$url .= '/return_status_name';
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
				'return_status_id'   => $result['return_status_id'],
				'return_status_name' => $result['return_status_name'] . (($result['return_status_id'] == $this->common->config('config_return_status_id')) ? $this->lang->line('text_default_b') : null),
				'date_modified'      => date($this->common->config('config_date_format'), strtotime($result['date_modified'])),
				'is_deleted'         => $result['is_deleted'],
                                'edit'               =>base_url('system/return_status/edit'.$url.'/'.$this->commons->encode($result['return_status_id']))
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
		$content_page="themes/".$admin_theme."/system/return_status_list";
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
				$this->return_status->addReturnStatus();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/return_status_name';
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
				redirect('system/return_status');
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
	public function edit($sort_by = 'return_status_name', $sort_order = 'ASC', $offset = 0)
	{
		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				 
								
                    // Generate back url
                    $url = '';

                    if ($this->uri->segment(4)!==NULL) {
                            $url .= '/'.$this->uri->segment(4);
                    }
                    else
                    {
                            $url .= '/return_status_name';
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
                        $res = $this->validateSoftDelete($this->input->post('return_status_id'));
                        if($res==0)
                        {
                            $this->session->set_userdata('error',$this->error['warning']);
                            redirect('system/return_status/edit'.$url.'/'.$this->commons->encode($this->input->post('return_status_id')));  
                        }
                    }
                    $this->return_status->editReturnStatus();
                    $this->session->set_userdata('success',$this->lang->line('text_success'));
                    redirect('system/return_status/index'.$url);
				
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
			foreach ($this->input->post('selected') as $return_status_id) 
			{
				$this->return_status->deleteReturnStatus($return_status_id);
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
			foreach ($this->input->post('selected') as $return_status_id) 
			{
				$this->return_status->softDeleteReturnStatus($return_status_id);
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
			$url .= '/return_status_name';
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
		   'text' => 'Return Statuses',
		   'href' => base_url('system/return_status'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{
			$this->data['form_action'] = base_url('system/return_status/add'.$url);
			$this->data['return_status_id'] = '';
			$this->data['text_form'] 		= $this->lang->line('text_add');
		} 
		else 
		{
			$this->data['form_action'] = base_url('system/return_status/edit'.$url.'/'.$this->uri->segment($count));
			
			$this->data['return_status_id'] = $this->commons->decode($this->uri->segment($count));
			$this->data['text_form'] 		= $this->lang->line('text_edit');
		}
		//$this->data['refresh'] 		= base_url('system/return_status/refresh');
		$this->data['cancel'] 		= base_url('system/return_status/index'.$url);
		
		// Set Value Back
		if (1) 
		{
			$ReturnStatus_info = $this->return_status->getReturnStatusById($this->commons->decode($this->uri->segment($count)));
		}
		//echo '<pre>';print_r($ReturnStatus_info);
		
		if ($this->input->post('return_status_name')!==NULL) {
			$this->data['return_status_name'] = $this->input->post('return_status_name');
		} elseif (!empty($ReturnStatus_info)) {
			
			$this->data['return_status_name'] = $ReturnStatus_info['return_status_name'];
		} else {
			$this->data['return_status_name'] = '';
		}
		
		if ($this->input->post('status')!==NULL) {
			$this->data['status'] = $this->input->post('value');
		} elseif (!empty($ReturnStatus_info)) {
			$this->data['status'] = $ReturnStatus_info['status'];
		} else {
			$this->data['status'] = '';
		}
		
		if ($this->input->server('REQUEST_METHOD') == 'POST')
                {
                    if($this->input->post('is_deleted')==1)
                    {
                        $this->data['is_deleted'] = $this->input->post('is_deleted'); 
                    }else {
                        $this->data['is_deleted'] = 0;
                    }
                } elseif (!empty($ReturnStatus_info)) {
                    $this->data['is_deleted'] = $ReturnStatus_info['is_deleted'];
                } else {
                    $this->data['is_deleted'] = 0;
                }
		//echo '<pre>'.$count;print_r($this->data);die;
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/system/return_status";
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
					        'field' => 'return_status_name',
					        'label' => 'Return Status Name', 
					        'rules' => 'trim|required|min_length[3]|max_length[128]|xss_clean|callback_check_exists_return_status_name', 
					        'errors' => array('required' => '%s must be between 3 and 128 characters!','min_length'=>'%s must be between 3 and 128 characters!','max_length'=>'%s must be between 3 and 128 characters!','check_exists_return_status_name'=>'%s already exists!')
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
            $this->load->model('sales/returns_model');
            
            foreach ($this->input->post('selected') as $return_status_id) 
            {
                if ($this->common->config('config_return_status_id') == $return_status_id) 
                {
                    $this->error['warning'] = $this->lang->line('error_default');
                }
                
                $return_total = $this->returns_model->getTotalReturnsByReturnStatusId($return_status_id);
                if ($return_total) {
                    $this->error['warning'] = $this->lang->line('error_return').'('.$return_total.')';
                }

            }
		return !$this->error;
	}
        
        /**
	* 
	* @function name : validateSoftDelete()
	* @description   : Check currency relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateSoftDelete($return_status_id) 
	{
            $this->load->model('sales/returns_model');           
            
            if ($this->common->config('config_return_status_id') == $return_status_id) 
            {
                $this->error['warning'] = $this->lang->line('error_default');
            }

            $return_total = $this->returns_model->getTotalReturnsByReturnStatusId($return_status_id);
            if ($return_total) {
                $this->error['warning'] = $this->lang->line('error_return').'('.$return_total.')';
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
    function check_exists_return_status_name($str)
    {
        $this->db->from('return_status');
        $this->db->where('LOWER(return_status_name)',strtolower($str));
        $this->db->where('is_deleted=0');
        if($this->input->post('return_status_id') !="")
        {
            $this->db->where('return_status_id !=',$this->input->post('return_status_id'));
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
