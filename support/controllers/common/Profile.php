<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Profile
* @Auther       : Vinay
* @Date         : 16-12-2016
* @Description  : Profile Related Collection of functions
*
*/

class Profile extends CI_Controller {

        private $data=array();
	private $error = array();

	function __construct()
	{
            parent::__construct();

            $this->_init();

            $this->rbac->CheckAuthentication();
			
            $this->load->model('common/profile_model','profile');
            
            $this->lang->load('common/profile_lang', 'english');

            $this->load->model('common');

            $this->load->library('commons');

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
            $this->output->set_template('support_template');
            $admin_theme = $this->common->config('admin_theme');
            $this->output->set_common_meta('Profile','sarpo','This is srapo Profile page');
	}
	
        /**
	* 
	* @function name : edit()
	* @description   : edit profile records
	* @param         : void
	* @return        : void
	*
	*/
	public function index()
        {	
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) 
            {

                $res = $this->profile->editUser();
                if($res){
                   $this->session->set_userdata('success',$this->lang->line('text_success')); 
                }             
                
                redirect('common/profile');
            }
            $this->getForm();
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
            
            // breadcrumbs
            $this->data['breadcrumbs']          = array();
            $this->data['breadcrumbs'][]        = array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),

            );
            $this->data['breadcrumbs'][] = array(
              'text' => 'Profile',
              'href' => base_url('common/profile'),

            );
		 
            
           
                $this->data['form_action']      = base_url('common/profile');
                $this->data['text_form'] = $this->lang->line('text_edit');
		
            // Set Value Back
            if (1) 
            {
                $user_info = $this->profile->getUser($this->session->userdata('support_user_id'));
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
            
            if  (($this->input->post('image')) !== NULL)
            { 
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
            $this->data['admin_id'] = $this->session->userdata('support_user_id');
            //echo '<pre>'.$count;print_r($this->data);die;
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/common/profile";
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
                    'rules' => 'trim|required|matches[password]', 
                    'errors' => array('required' => '%s must be between 3 and 32 characters!','matches'=>'Password and password confirmation do not match!')
                );
            }
            $validation = array(
                            array(
                                'field' => 'firstname',
                                'label' => 'First Name', 
                                'rules' => 'trim|required|min_length[1]|max_length[32]|xss_clean', 
                                'errors' => array('required' => '%s must be between 1 and 32 characters!','min_length'=>'%s must be between 1 and 32 characters!','max_length'=>'%s must be between 1 and 32 characters!')
                            ),
                            array(
                                'field' => 'middlename',
                                'label' => 'Middle Name', 
                                'rules' => 'trim|required|min_length[1]|max_length[32]|xss_clean', 
                                'errors' => array('required' => '%s must be between 1 and 32 characters!','min_length'=>'%s must be between 1 and 32 characters!','max_length'=>'%s must be between 1 and 32 characters!')
                            ),
                            array(
                                'field' => 'lastname',
                                'label' => 'Last Name', 
                                'rules' => 'trim|required|min_length[1]|max_length[32]|xss_clean', 
                                'errors' => array('required' => '%s must be between 1 and 32 characters!','min_length'=>'%s must be between 1 and 32 characters!','max_length'=>'%s must be between 1 and 32 characters!')
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
                                'rules' => 'trim|required|min_length[3]|max_length[32]|numeric|xss_clean', 
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
            $user_info = $this->profile->getUserByEmail($this->input->post('email'));
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
                if ($user_info && ($this->input->post('admin_id') != $this->session->userdata('support_user_id'))) 
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

}
