<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : User_groups
* @Auther       : Vinay
* @Date         : 08-11-2016
* @Description  : User Groups Related Collection of functions
*
*/

class User_groups extends CI_Controller {

	private $data=array();
	private $error = array();

	function __construct()
	{
            parent::__construct();

            $this->_init();
			
            $this->rbac->CheckAuthentication();
			
            $this->load->model('system/user_groups_model','user_groups');
            
            $this->lang->load('system/user_group_lang', 'english');

            $this->load->model('common');

            $this->load->library('commons');

            $this->load->library('pagination');
	}
	
	/**
	* 
	* @function name : _init()
	* @description   : initialize required resources in this view
	* @param   	 : void
	* @return        : void
	*
	*/
	private function _init() 
        {
            //--Set Template
            $this->output->set_template('admin_template');
            $admin_theme = $this->common->config('admin_theme');
            $this->output->set_common_meta('User Groups','sarpo','This is srapo User Groups page');
	}
	
	/**
	* 
	* @function name : index()
	* @description   : load User_groups view
	* @param         : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'role_name', $sort_order = 'ASC', $offset = 0) 
        {
            
            // breadcrumbs
            $this->data['add']              = base_url('system/user_groups/add');
            
            if($this->session->userdata('role_id')== 1) 
            {
                $this->data['delete']       = base_url('system/user_groups/delete');
            } 
            else
            {
                $this->data['delete']       = base_url('system/user_groups/softDelete');
            }
            
            $this->data['breadcrumbs']      = array();
            $this->data['breadcrumbs'][]    = array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),
            );

            $this->data['breadcrumbs'][] = array(
               'text' => 'User Groups',
               'href' => base_url('system/user_groups'),
            );
                
            //	pagination
            $limit = $this->common->config('config_limit_admin');
            $data = array(
                'sort' => $sort_by,
                'order'=> $sort_order,
                'start'=> $offset,
                'limit'=> $limit
            );
		
            $url = base_url("system/user_groups/index/$sort_by/$sort_order");
            $total_records = $this->user_groups->getTotalUserGroup();
            $config =$this->commons->pagination($url,$total_records,$limit);
            $this->pagination->initialize($config);
            $config['uri_segment'] = 6;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['sort_by'] = $sort_by;
            $this->data['sort_order'] = $sort_order;
            $results = $this->user_groups->getUserGroups($data);
            $this->data['pages'] = ceil($total_records/$limit);
            $this->data['totals'] = ceil($total_records);
            $this->data['range'] = ceil($offset+1);
		
            $url='';
            if ($this->uri->segment(4)!==NULL) 
            {
                $url .= '/'.$this->uri->segment(4);
            } 
            else 
            {
                $url .= '/role_name';
            }

            if ($this->uri->segment(5)!==NULL)
            {
                $url .= '/'.$this->uri->segment(5);
            }
            else
            {
                $url .= '/ASC';
            }
            if ($this->uri->segment(6)!==NULL)
            {
                $url .= '/'.$this->uri->segment(6);
            } 
            else
            {
                $url .= '/0';
            }
		
            foreach ($results as $result) 
            {
                $this->data['records'][] = array(
                    'role_id'               => $result['role_id'],
                    'role_name'             => $result['role_name'],
                    'is_deleted'            => $result['is_deleted'],
                    'date_added'            => date($this->common->config('config_date_format'), strtotime($result['date_added'])),
                    'edit'                  =>base_url('system/user_groups/edit'.$url.'/'.$this->commons->encode($result['role_id']))
                );
            }
		
            if (isset($this->error['warning'])) 
            {
                $this->data['error_warning'] = $this->error['warning'];
            }
            else 
            {
                $this->data['error_warning'] = '';
            }

            if ($this->session->userdata('success')!==NULL) 
            {
                $this->data['success'] = $this->session->userdata('success');

                $this->session->set_userdata('success','');
            } 
            else 
            {
                $this->data['success'] = '';
            }
		
            if ($this->input->post('selected') !==NULL) 
            {
                $this->data['selected'] = (array)$this->input->post('selected');
            }
            else 
            {
                $this->data['selected'] = array();
            }
            //print_r($this->data);
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/system/user_groups_list";
            $this->load->view($content_page,$this->data);
	}
        
	/**
	* 
	* @function name : add()
	* @description   : load user_groups Add view
	* @param   	 : void
	* @return        : void
	*
	*/
	public function add() 
        {
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) 
            {
                $this->user_groups->addUserGroup();
                $this->session->set_userdata('success',$this->lang->line('text_success'));
                

                // Generate back url
                $url = '';

                if ($this->uri->segment(4)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(4);
                } 
                else 
                {
                    $url .= '/role_name';
                }

                if ($this->uri->segment(5)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(5);
                } 
                else 
                {
                    $url .= '/ASC';
                }
                if ($this->uri->segment(6)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(6);
                } else 
                {
                    $url .= '/0';
                }
                if ($this->uri->segment(7)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(7);
                }
                redirect('system/user_groups');
            } 
            $this->getForm();
	}
        
        /**
	* 
	* @function name : edit()
	* @description   : edit user_groups records
	* @param         : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'role_name', $sort_order = 'ASC', $offset = 0)
        {
		
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) 
            {
                // Generate back url
                $url = '';

                if ($this->uri->segment(4)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(4);
                } 
                else 
                {
                    $url .= '/role_name';
                }

                if ($this->uri->segment(5)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(5);
                } 
                else 
                {
                    $url .= '/ASC';
                }
                if ($this->uri->segment(6)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(6);
                } 
                else 
                {
                    $url .= '/0';
                }
                if ($this->input->post('is_deleted') == 1) {
                    $res = $this->validateSoftDelete($this->input->post('user_group_id'));
                    if($res==0)
                    {
                        $this->session->set_userdata('error',$this->error['warning']);
                        redirect('system/user_groups/edit'.$url.'/'.$this->commons->encode($this->input->post('user_group_id')));  
                    }
                } 
                
                $this->user_groups->editUserGroup();
                $this->session->set_userdata('success',$this->lang->line('text_success'));
                redirect('system/user_groups/index'.$url);
            }
            $this->getForm();
	}
        
        /**
	* 
	* @function name : delete()
	* @description   : permanent delete records
	* @param         : void
	* @return        : void
	*
	*/
	public function delete() 
        {
            if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
            {
                foreach ($this->input->post('selected') as $user_group_id) 
                {
                    $this->user_groups->deleteUserGroup($user_group_id);
                }

                $this->session->set_userdata('success',$this->lang->line('text_success'));
                redirect('system/user_groups/index');
            } 
               $this->index(); 
	}
        
        /**
	* 
	* @function name : softDelete()
	* @description   : soft Delete Records
	* @param   	 : void
	* @return        : void
	*
	*/
	public function softDelete()
	{
            if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
            {
                foreach ($this->input->post('selected') as $user_group_id)
                {
                    $this->stock_status->softDeleteUserGroup($user_group_id);
                }

                $this->session->set_userdata('success',$this->lang->line('text_success'));
                $this->index();
            }
	}
        
        
        /**
	* 
	* @function name : getForm()
	* @description   : Generate Form for Add and Edit Records
	* @param   	 : void
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
		
            if ($this->session->userdata('success')!==NULL) 
            {
                $this->data['success'] = $this->session->userdata('success');

                $this->session->set_userdata('success','');
            } 
            else 
            {
                $this->data['success'] = '';
            }
		
            // Generate back url
            $url = '';

            if ($this->uri->segment(4)!==NULL)
            {
                $url .= '/'.$this->uri->segment(4);
            } 
            else 
            {
                $url .= '/role_name';
            }

            if ($this->uri->segment(5)!==NULL)
            {
                $url .= '/'.$this->uri->segment(5);
            } 
            else 
            {
                $url .= '/ASC';
            }
            if ($this->uri->segment(6)!==NULL) 
            {
                $url .= '/'.$this->uri->segment(6);
            } 
            else 
            {
                $url .= '/0';
            }
		
            // breadcrumbs
            $this->data['breadcrumbs']          = array();
            $this->data['breadcrumbs'][]        = array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),

            );
            $this->data['breadcrumbs'][] = array(
              'text' => 'User Groups',
              'href' => base_url('system/user_groups'),

            );
		 
            // Add or Edit Transaction
            $count = $this->uri->total_segments();
            $method = $this->uri->segment(3);
            
            if ($method=='add') 
            {
                $this->data['form_action']      = base_url('system/user_groups/add'.$url);
                $this->data['user_group_id']  = '';
                $this->data['text_form'] = $this->lang->line('text_add');
            } 
            else 
            {
                $this->data['form_action']      = base_url('system/user_groups/edit'.$url.'/'.$this->uri->segment($count));
                $this->data['user_group_id']  = $this->commons->decode($this->uri->segment($count));
                $this->data['text_form'] = $this->lang->line('text_edit');
            }
            
            //$this->data['refresh'] 		= base_url('system/stock_status/refresh');
            $this->data['cancel'] 		= base_url('system/user_groups/index'.$url);
		
            // Set Value Back
            if (1) 
            {
                $user_group_info = $this->user_groups->getUserGroup($this->commons->decode($this->uri->segment($count)));
            }
		
            if ($this->input->post('user_group_name')!==NULL) {
                    $this->data['user_group_name'] = $this->input->post('user_group_name');
            } elseif (!empty($user_group_info)) {

                    $this->data['user_group_name'] = $user_group_info['role_name'];
            } else {
                    $this->data['user_group_name'] = '';
            }
		
            if ($this->input->server('REQUEST_METHOD') == 'POST')
            {
                if($this->input->post('is_deleted')==1)
                {
                   $this->data['is_deleted'] = $this->input->post('is_deleted'); 
                }else {
                     $this->data['is_deleted'] = 0;
                }
            } elseif (!empty($user_group_info)) {
                    $this->data['is_deleted'] = $user_group_info['is_deleted'];
            } else {
                    $this->data['is_deleted'] = 0;
            }
            //echo '<pre>'.$count;print_r($this->data);die;
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/system/user_groups";
            $this->load->view($content_page,$this->data);
	}
        
        /**
	* 
	* @function name 	: validateForm()
	* @description   	: Validate form data
	* @access 		: public
	* @param   		: void
	* @return        	: boolean
	*
	*/
	public function validateForm() {
            $validation = array(
                            array(
                                'field'     => 'user_group_name',
                                'label'     => 'User Group Name', 
                                'rules'     => 'trim|required|min_length[3]|max_length[64]|xss_clean|callback_check_exists_userGroup_name', 
                                'errors'    => array('required' => '%s must be between 3 and 64 characters!','min_length'=>'%s must be between 3 and 64 characters!','max_length'=>'%s must be between 3 and 64 characters!','check_exists_userGroup_name'=>'%s already exists!')
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
        * @function name    : check_exists_userGroup_name()
        * @description      : Validate for user group name existing or not
        * @access           : public
        * @param            : void
        * @return           : boolean
        *
        */
        function check_exists_userGroup_name($str)
        {
            $this->db->from('role');
            $this->db->where('LOWER(role_name)',strtolower($str));
            if($this->input->post('user_group_id') !="")
            {
                $this->db->where('role_id !=',$this->input->post('user_group_id'));
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
	* @description   : Check user_groups relation for delete
	* @param         : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{
            $this->load->model('system/users_model');
            
            foreach ($this->input->post('selected') as $user_group_id) 
            {
                $user_total = $this->users_model->getTotalUsersByGroupId($user_group_id);

                if ($user_total) 
                {
                    $this->error['warning'] = $this->lang->line('error_user').'('.$user_total.')';
                }
            }
		return !$this->error;
	}
        
        /**
	* 
	* @function name : validateSoftDelete()
	* @description   : Check user_groups relation for delete
	* @param         : void
	* @return        : void
	*
	*/
	public function validateSoftDelete($user_group_id) 
	{
            $this->load->model('system/users_model');
            
            
            $user_total = $this->users_model->getTotalUsersByGroupId($user_group_id);

            if ($user_total) 
            {
                $this->error['warning'] = $this->lang->line('error_user').'('.$user_total.')';
            }
            return !$this->error;
	}
}
