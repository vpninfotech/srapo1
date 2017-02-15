<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Change_password
* @Auther       : Indrajit
* @Date         : 12-10-2016
* @Description  : Admin Product Operation
*
*/

class Change_password extends CI_Controller {

private $data=array();

	function __construct()
	{
		parent::__construct();
		
		$this->_init();

		  //$this->rbac->CheckAuthentication();

            $this->load->model('system/change_password_model','change_password');
            
            $this->lang->load('system/change_password_lang', 'english');

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
		$this->output->set_template('support_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Change Password','sarpo','This is srapo Change Password page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Change_password view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index()	{
		$this->data['form_action']   = base_url('system/Change_password');
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Change Password',
		   'href' => base_url('system/change_password'),
		 
		  );
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm())
		{
                    $this->change_password->updatePassword();
                    $this->session->set_userdata('success',$this->lang->line('text_success'));
                    if ($this->session->userdata('success')!==NULL) 
                    {
                        $this->data['success'] = $this->session->userdata('success');
                        $this->session->set_userdata('success','');
                        
                    } 
                    else 
                    {
                        $this->data['success'] = '';
                    }
		}
                
                if ($this->input->post('old_password')!==NULL) {
                    $this->data['old_password'] = $this->input->post('old_password');
                } else {
                    $this->data['old_password'] = '';
                }
                
                if ($this->input->post('new_password')!==NULL) {
                    $this->data['new_password'] = $this->input->post('new_password');
                } else {
                    $this->data['new_password'] = '';
                }
                
                if ($this->input->post('confirm_password')!==NULL) {
                    $this->data['confirm_password'] = $this->input->post('confirm_password');
                } else {
                    $this->data['confirm_password'] = '';
                }
            
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/system/change_password";
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
	public function validateForm() 
        {
            $validation = array(
					   
					    array(
					        'field' => 'old_password',
					        'label' => 'Old Password', 
					        'rules' => 'trim|required|xss_clean|callback_validate_password', 
					        'errors' => array('required' => '%s required!','validate_password' => 'Wrong %s!')
					    ),
					    array(
					        'field' => 'new_password',
					        'label' => 'New Password', 
					        'rules' => 'required|min_length[6]|max_length[32]', 
					        'errors' => array('required' => '%s must be greater than 6 and less than 32 characters!','min_length'=>'%s must be between 6 and 32 characters!','max_length'=>'%s must be between 6 and 32 characters!')
					    ),
					   
					    array(
					        'field' => 'confirm_password',
					        'label' => 'Confirm Password', 
					        'rules' => 'trim|matches[new_password]', 
					        'errors' => array('matches'=>'New Password and password confirmation do not match!')
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
	* @function name 	: validateForm()
	* @description   	: Validate form data
	* @access 		: public
	* @param   		: void
	* @return        	: boolean
	*
	*/
    function validate_password($str)
	{
	   $field_value = $str; //this is redundant, but it's to show you how
	   //the content of the fields gets automatically passed to the method

	   if($this->change_password->getOldPassword($field_value))
	   {
	     return TRUE;
	   }
	   else
	   {
	     return FALSE;
	   }
	}    
	
}
