<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Users
* @Auther       : Indrajit
* @Date         : 10-10-2016
* @Description  : Users Related Collection of functions
*
*/

class Users extends CI_Controller {

    private $data=array();
	private $error = array();

	function __construct()
	{
            parent::__construct();

            $this->_init();

            $this->rbac->CheckAuthentication();
			
            $this->load->model('system/users_model','users');
            
            $this->lang->load('system/user_lang', 'english');

            $this->load->model('common');

            $this->load->library('commons');

            $this->load->library('pagination');
	}
	
	/**
	* 
	* @function name : _init()
	* @description   : initialize required resources in this view
	* @param         : void
	* @return        : void
	*
	*/
	
	private function _init() {
		
		//--Set Template
		$this->output->set_template('admin_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Users','sarpo','This is srapo Users page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Users view
	* @param         : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'firstname', $sort_order = 'ASC', $offset = 0) 
        {
            
            // breadcrumbs
            $this->data['add']              = base_url('system/users/add');
            
            if($this->session->userdata('role_id')== 1) 
            {
                $this->data['delete']       = base_url('system/users/delete');
            } 
            else
            {
                $this->data['delete']       = base_url('system/users/softDelete');
            }
            
            $this->data['breadcrumbs']      = array();
            $this->data['breadcrumbs'][]    = array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),
            );

            $this->data['breadcrumbs'][] = array(
               'text' => 'Users',
               'href' => base_url('system/users'),
            );
                
            //	pagination
            $limit = $this->common->config('config_limit_admin');
            //echo "Limit=".$limit;exit;
            $data = array(
                'sort' => $sort_by,
                'order'=> $sort_order,
                'start'=> $offset,
                'limit'=> $limit
            );
		
            $url = base_url("system/users/index/$sort_by/$sort_order");
            $total_records = $this->users->getTotalUser();
            $config =$this->commons->pagination($url,$total_records,$limit);
            $this->pagination->initialize($config);
            $config['uri_segment'] = 6;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['sort_by'] = $sort_by;
            $this->data['sort_order'] = $sort_order;
            $results = $this->users->getUsers($data);
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
                $url .= '/firstname';
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
                    'user_id'               => $result['admin_id'],
                    'firstname'             => $result['firstname'],
                    'lastname'              => $result['lastname'],
                    'is_deleted'            => $result['is_deleted'],
                    'status'                => ($result['status'] ? $this->lang->line('text_enabled') : $this->lang->line('text_disabled')),
                    'date_added'            => date($this->common->config('config_date_format'), strtotime($result['date_added'])),
                    'edit'                  =>base_url('system/users/edit'.$url.'/'.$this->commons->encode($result['admin_id']))
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
            $content_page="themes/".$admin_theme."/system/users_list";
            $this->load->view($content_page,$this->data);
	}
        
        /**
	* 
	* @function name : add()
	* @description   : load users Add view
	* @param   	 : void
	* @return        : void
	*
	*/
	public function add() 
        {
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) 
            {
                $this->users->addUser();
                $this->session->set_userdata('success',$this->lang->line('text_success'));
                

                // Generate back url
                $url = '';

                if ($this->uri->segment(4)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(4);
                } 
                else 
                {
                    $url .= '/firstname';
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
                redirect('system/users');
            } 
            $this->getForm();
	}
        
        /**
	* 
	* @function name : edit()
	* @description   : edit users records
	* @param         : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'firstname', $sort_order = 'ASC', $offset = 0)
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
                    $url .= '/firstname';
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
                    $res = $this->validateSoftDelete($this->input->post('admin_id'));
                    if($res==0)
                    {
                        $this->session->set_userdata('error',$this->error['warning']);
                        redirect('system/users/edit'.$url.'/'.$this->commons->encode($this->input->post('admin_id')));  
                    }
                }
                    
                $this->users->editUser();
                $this->session->set_userdata('success',$this->lang->line('text_success'));
                redirect('system/users/index'.$url);
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
                foreach ($this->input->post('selected') as $user_id) 
                {
                    $this->users->deleteUser($user_id);
                }

                $this->session->set_userdata('success',$this->lang->line('text_success'));
                redirect('system/users/index');
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
                foreach ($this->input->post('selected') as $user_id)
                {
                    $this->users->softDeleteUser($user_id);
                }

                $this->session->set_userdata('success',$this->lang->line('text_success'));
                
            }
            $this->index();
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
                $url .= '/firstname';
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
              'text' => 'Users',
              'href' => base_url('system/users'),

            );
		 
            // Add or Edit Transaction
            $count = $this->uri->total_segments();
            $method = $this->uri->segment(3);
            
            if ($method=='add') 
            {
                $this->data['form_action']      = base_url('system/users/add'.$url);
                $this->data['admin_id']  = '';
                $this->data['text_form'] = $this->lang->line('text_add');
            } 
            else 
            {
                $this->data['form_action']      = base_url('system/users/edit'.$url.'/'.$this->uri->segment($count));
                $this->data['admin_id']  = $this->commons->decode($this->uri->segment($count));
                $this->data['text_form'] = $this->lang->line('text_edit');
            }
            
            //$this->data['refresh'] 		= base_url('system/stock_status/refresh');
            $this->data['cancel'] 		= base_url('system/users/index'.$url);
            
            // Get User Group Name
            $this->load->model('system/user_groups_model');
            $this->data['user_groups'] = $this->user_groups_model->getUserGroups();
		
            // Set Value Back
            if (1) 
            {
                $user_info = $this->users->getUser($this->commons->decode($this->uri->segment($count)));
            }
		
            if ($this->input->post('user_group_id')!==NULL) {
                    $this->data['user_group_id'] = $this->input->post('user_group_id');
            } elseif (!empty($user_info)) {

                    $this->data['user_group_id'] = $user_info['role_id'];
            } else {
                    $this->data['user_group_id'] = '';
            }
            
            if ($this->input->post('firstname')!==NULL) {
                    $this->data['firstname'] = $this->input->post('firstname');
            } elseif (!empty($user_info)) {

                    $this->data['firstname'] = $user_info['firstname'];
            } else {
                    $this->data['firstname'] = '';
            }
            
            if ($this->input->post('middlename')!==NULL) {
                    $this->data['middlename'] = $this->input->post('middlename');
            } elseif (!empty($user_info)) {

                    $this->data['middlename'] = $user_info['middlename'];
            } else {
                    $this->data['middlename'] = '';
            }
            
            if ($this->input->post('lastname')!==NULL) {
                    $this->data['lastname'] = $this->input->post('lastname');
            } elseif (!empty($user_info)) {

                    $this->data['lastname'] = $user_info['lastname'];
            } else {
                    $this->data['lastname'] = '';
            }
            
            if ($this->input->post('email')!==NULL) {
                    $this->data['email'] = $this->input->post('email');
            } elseif (!empty($user_info)) {

                    $this->data['email'] = $user_info['email'];
            } else {
                    $this->data['email'] = '';
            }
            
            if ($this->input->post('telephone')!==NULL) {
                    $this->data['telephone'] = $this->input->post('telephone');
            } elseif (!empty($user_info)) {

                    $this->data['telephone'] = $user_info['telephone'];
            } else {
                    $this->data['telephone'] = '';
            }
            
            if  (($this->input->post('image')) !== NULL) {
                $this->data['config_image'] = $this->input->post('image');
            } else {
                $this->data['config_image'] = $user_info['image'];
            }
            
            //====Start Code: Call image model for resize the image
            $this->load->model('tool/image');
            
            if (($this->input->post('image') !== NULL) && is_file(DIR_IMAGE . $this->input->post('image'))) {
                  $this->data['thumb'] = $this->image->resize($this->input->post('image'), 100, 100);
            } elseif ($user_info['image'] && is_file(DIR_IMAGE . $user_info['image'])) {
                  $this->data['thumb'] = $this->image->resize($user_info['image'], 100, 100);
            } else {
                  $this->data['thumb'] = $this->image->resize('no_image-100x100.png', 100, 100);
            }

            $this->data['placeholder'] = $this->image->resize('no_image-100x100.png', 100, 100);
            //====End Code: Call image model for resize the image
            
            if ($this->input->post('password')!==NULL) {
                    $this->data['password'] = $this->input->post('password');
            } else {
                    $this->data['password'] = '';
            }
            
            if ($this->input->post('confirm_pwd')!==NULL) {
                    $this->data['confirm_pwd'] = $this->input->post('confirm_pwd');
            } else {
                    $this->data['confirm_pwd'] = '';
            }
            
            if ($this->input->post('status')!==NULL)
            {
                    $this->data['status'] = $this->input->post('status');
            } elseif (!empty($user_info)) {
                    $this->data['status'] = $user_info['status'];
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
            } elseif (!empty($user_info)) {
                    $this->data['is_deleted'] = $user_info['is_deleted'];
            } else {
                    $this->data['is_deleted'] = 0;
            }

            //echo '<pre>'.$count;print_r($this->data);die;
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/system/users";
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
            // Add or Edit Transaction
            $count = $this->uri->total_segments();
            $method = $this->uri->segment(3);
            $password = array();
            $c_password = array();
            if ($method=='add' || $this->input->post('password')) 
            {
                $password = array(
                    'field' => 'password',
                    'label' => 'Password', 
                    'rules' => 'required|min_length[4]|max_length[20]', 
                    'errors' => array('required' => '%s must be between 4 and 20 characters!','min_length'=>'%s must be between 4 and 20 characters!','max_length'=>'%s must be between 4 and 20 characters!')
                );	   
                $c_password = array(
                    'field' => 'confirm_pwd',
                    'label' => 'Confirm Password', 
                    'rules' => 'trim|matches[password]', 
                    'errors' => array('required' => 'Password and password confirmation do not match!','matches'=>'Password and password confirmation do not match!')
                );
            }
            $validation = array(
                            array(
                                'field' => 'firstname',
                                'label' => 'First Name', 
                                'rules' => 'trim|required|min_length[1]|max_length[32]|xss_clean', 
                                'errors' => array('required' => '%s must be between  1 and 32 characters!','min_length'=>'%s must be between  1 and 32 characters!','max_length'=>'%s must be between  1 and 32 characters!')
                            ),
                            array(
                                'field' => 'middlename',
                                'label' => 'Middle Name', 
                                'rules' => 'trim|required|min_length[1]|max_length[32]|xss_clean', 
                                'errors' => array('required' => '%s must be between  1 and 32 characters!','min_length'=>'%s must be between  1 and 32 characters!','max_length'=>'%s must be between  1 and 32 characters!')
                            ),
                            array(
                                'field' => 'lastname',
                                'label' => 'Last Name', 
                                'rules' => 'trim|required|min_length[1]|max_length[32]|xss_clean', 
                                'errors' => array('required' => '%s must be between  1 and 32 characters!','min_length'=>'%s must be between  1 and 32 characters!','max_length'=>'%s must be between  1 and 32 characters!')
                            ),
                            array(
                                'field' => 'email',
                                'label' => 'E-Mail Address', 
                                'rules' => 'trim|required|xss_clean|valid_email|callback_email_check', 
                                'errors' => array('required' => '%s  does not appear to be valid!','valid_email'=>'%s  does not appear to be valid!')
                            ),
                            array(
                                'field' => 'telephone',
                                'label' => 'Telephone', 
                                'rules' => 'trim|required|min_length[3]|max_length[32]|xss_clean|numeric', 
                                'errors' => array('required' => '%s must be between 3 and 32 characters!','min_length'=>'%s must be between 3 and 32 characters!','max_length'=>'%s must be between 3 and 32 characters!')
                            ),
                            
                            $password,
                            $c_password,
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
	* @function name : email_check()
	* @description   : Check email id already exists or not
	* @param         : void
	* @return        : void
	*
	*/
        public function email_check()
        {  
            $user_info = $this->users->getUserByEmail($this->input->post('email'));
            if($this->input->post('admin_id') !=="")
            {
                if ($user_info && ($this->input->post('admin_id') != $user_info['admin_id'])) 
                { 
                    $this->form_validation->set_message('email_check', 'Email ID is already in use!');
                    return FALSE;
		}
                else
                {                
                    return TRUE;
                }
            }
            else 
            {
                if ($user_info && ($this->input->post('admin_id') != $this->session->userdata('user_id'))) 
                { 
                    $this->form_validation->set_message('email_check', 'Email ID is already in use!');
                    return FALSE;
                }
                else 
                {
                    return TRUE;
                }
            }
        }
        
        /**
	* 
	* @function name : validateDelete()
	* @description   : Check users relation for delete
	* @param         : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{    
            //$user_info = $this->users->getUser($user_id);
                foreach ($this->input->post('selected') as $user_id) 
                {
                    if ($this->session->userdata['user_id'] == $user_id) 
                    {                   
                        $this->error['warning'] = $this->lang->line('error_account');
                    }
                }
		return !$this->error;
	}
        
        /**
	* 
	* @function name : validateSoftDelete()
	* @description   : Check users relation for delete
	* @param         : void
	* @return        : void
	*
	*/
	public function validateSoftDelete($user_id) 
	{   
            if ($this->session->userdata['user_id'] == $user_id) 
            {                   
                $this->error['warning'] = $this->lang->line('error_account');
            }               
            return !$this->error;
	}

}
