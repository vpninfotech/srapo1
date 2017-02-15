<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Return_actions
* @Auther       : Jinal
* @Date         : 7-11-2016
* @Description  : Return Status Related All functions
*
*/

class Return_actions extends CI_Controller {

    private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('system/return_actions_model','action');
		
		$this->lang->load('system/return_action_lang', 'english');
		
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
		$this->output->set_common_meta('Return Actions','sarpo','This is srapo Return Actions page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Return_actions view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'return_action_name', $sort_order = 'ASC', $offset = 0)
	{
		
		// breadcrumbs
		$this->data['add'] 			    = base_url('system/return_actions/add');
	    if($this->session->userdata('role_id')== 1)
		{
			$this->data['delete'] 		= base_url('system/return_actions/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('system/return_actions/softDelete');
		}
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		  
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Actions',
		   'href' => base_url('system/return_actions'),
		 
		  );
		  
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("system/return_actions/index/$sort_by/$sort_order");
		$total_records = $this->action->getTotalActions();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->action->getReturnActions($data);
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
				'return_action_id'   => $result['return_action_id'],
				'return_action_name' => $result['return_action_name'],
				'modified_by'        => date($this->common->config('config_date_format'), strtotime($result['modified_by'])),
				'is_deleted'         => $result['is_deleted'],
                                'edit'               =>base_url('system/return_actions/edit'.$url.'/'.$this->commons->encode($result['return_action_id']))
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
		$content_page="themes/".$admin_theme."/system/return_actions_list";
		$this->load->view($content_page,$this->data);

	}
	
	
	/**
	* 
	* @function name : add()
	* @description   : Add Return Action in 
	* @param   		 : void
	* @return        : void
	*
	*/
	public function add()	{
        
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				$this->action->addReturnActions();
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
				redirect('system/return_actions/index');
	     }
		 
		$this->getForm();
	}
	
    /**
	* 
	* @function name : edit()
	* @description   : edit return_actions records
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
                        $res = $this->validateSoftDelete($this->input->post('return_action_id'));
                        if($res==0)
                        {
                            $this->session->set_userdata('error',$this->error['warning']);
                            redirect('system/return_actions/edit'.$url.'/'.$this->commons->encode($this->input->post('return_action_id')));  
                        }
                    }  
                    $this->action->editReturnActions();
                    $this->session->set_userdata('success',$this->lang->line('text_success'));
                    redirect('system/return_actions/index'.$url);
				
	     }
	   
		$this->getForm();
	}
	
	/**
	* 
	* @function name : delete()
	* @description   : permanent delete records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function delete()
	{
		if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
		{
			foreach ($this->input->post('selected') as $return_action_id) 
			{
				$this->action->deleteReturnActions($return_action_id);
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
			foreach ($this->input->post('selected') as $return_action_id) 
			{
				$this->action->softDeleteReturnActions($return_action_id);
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
		   'text' => 'Currencies',
		   'href' => base_url('system/return_actions'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{
			$this->data['form_action'] = base_url('system/return_actions/add'.$url);
			$this->data['return_action_id'] = '';
			$this->data['text_form'] 		= $this->lang->line('text_add');
		} 
		else 
		{
			$this->data['form_action'] = base_url('system/return_actions/edit'.$url.'/'.$this->uri->segment($count));
			
			$this->data['return_action_id'] = $this->commons->decode($this->uri->segment($count));
			$this->data['text_form'] 		= $this->lang->line('text_edit');
		}
		$this->data['cancel'] 		= base_url('system/return_actions/index'.$url);
		
		// Set Value Back
		if (1) 
		{
			$actions_info = $this->action->getReturnActionsById($this->commons->decode($this->uri->segment($count)));
		}
		
		if ($this->input->post('return_action_name')!==NULL) {
			$this->data['return_action_name'] = $this->input->post('return_action_name');
		} elseif (!empty($actions_info)) {
			
			$this->data['return_action_name'] = $actions_info['return_action_name'];
		} else {
			$this->data['return_action_name'] = '';
		}
		if ($this->input->post('status')!==NULL) {
			$this->data['status'] = $this->input->post('status');
		} elseif (!empty($actions_info)) {
			$this->data['status'] = $actions_info['status'];
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
                } elseif (!empty($actions_info)) {
                    $this->data['is_deleted'] = $actions_info['is_deleted'];
                } else {
                    $this->data['is_deleted'] = 0;
                }
		
		
		//echo '<pre>'.$count;print_r($this->data);die;
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/system/return_actions";
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
					        'field' => 'return_action_name',
					        'label' => 'Return Action Name', 
					        'rules' => 'trim|required|min_length[3]|max_length[128]|xss_clean|callback_check_exists_return_action_name', 
					        'errors' => array('required' => '%s must be between 3 and 128 characters!','min_length'=>'%s must be between 3 and 128 characters!','max_length'=>'%s must be between 3 and 128 characters!','check_exists_return_action_name'=>'%s already exists!')
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
	* @description   : Check return_actions relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{
            $this->load->model('sales/returns_model');
            
            foreach ($this->input->post('selected') as $return_action_id) 
            {
                $return_total = $this->returns_model->getTotalReturnsByReturnActionId($return_action_id);
                if ($return_total) 
                {                   
                    $this->error['warning'] = $this->lang->line('error_return').'('.$return_total.')';                    
                }
            }
		return !$this->error;
	}
        
        /**
	* 
	* @function name : validateDelete()
	* @description   : Check return_actions relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateSoftDelete($return_action_id) 
	{
            $this->load->model('sales/returns_model');
            
            
            $return_total = $this->returns_model->getTotalReturnsByReturnActionId($return_action_id);
            if ($return_total) 
            {                   
                $this->error['warning'] = $this->lang->line('error_return').'('.$return_total.')';                    
            }
            
            return !$this->error;
	}
	
	  /**
    * 
    * @function name    : check_exists_return_action_name()
    * @description      : Validate for return action name existing or not
    * @access           : public
    * @param            : void
    * @return           : boolean
    *
    */
    function check_exists_return_action_name($str)
    {
        $this->db->from('return_action');
        $this->db->where('LOWER(return_action_name)',strtolower($str));
        $this->db->where('is_deleted=0');
        if($this->input->post('return_action_id') !="")
        {
            $this->db->where('return_action_id !=',$this->input->post('return_action_id'));
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
