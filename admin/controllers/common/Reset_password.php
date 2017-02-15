<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
* @file name    : Reset_password
* @Auther       : Indrajit
* @Date         : 07-10-2016
* @Description  : Admin Reset Password Operation
*
*/
class Reset_password extends CI_Controller {

private $data=array();
private $error=array();

	function __construct()
	{
		parent::__construct();
		
		$this->_init();

		$this->load->model('common/login_model','login');
	}
	
	/**
	* 
	* @function name : _init()
	* @description   : initialize required resources in this view
	* @param   	 : void
	* @return        : void
	*
	*/
	
	private function _init() {
		
		//--Set Template
		$this->output->set_template('common/login_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Admin Reset Password','sarpo','This is srapo Admin Reset Password page');

		$this->load->css(ADMIN_PATH.$admin_theme.'/plugins/bootstrap/css/bootstrap.min.css');
		$this->load->css(ADMIN_PATH.$admin_theme.'/fonts/ionicons/css/ionicons.min.css');
		$this->load->css(ADMIN_PATH.$admin_theme.'/plugins/iCheck/all.css');
		$this->load->css(ADMIN_PATH.$admin_theme.'/css/AdminLTE.css');
		$this->load->css(ADMIN_PATH.$admin_theme.'/plugins/iCheck/square/blue.png');
		$this->load->css(ADMIN_PATH.$admin_theme.'/css/custom.css');
		
		$this->load->js(ADMIN_PATH.$admin_theme.'/plugins/jQuery/jquery-2.2.3.min.js');
		$this->load->js(ADMIN_PATH.$admin_theme.'/plugins/bootstrap/js/bootstrap.min.js');
		$this->load->js(ADMIN_PATH.$admin_theme.'/plugins/backstretch/jquery.backstretch.min.js');
	}
	
	/**
	* 
	* @function name : index()
	* @description   : load login view
	* @param         : void
	* @return        : void
	*
	*/
	public function index($user_id = "",$verify_code = "")	{

		$this->data['form_action']     = base_url('common/reset_password');

		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validate())
		{
			if($this->input->post('user_id') !== "")
			{
				$result = $this->login->resetPassword();
	            if($result)
	            {
	                redirect('common/login');
	            }
	            else
	            {
	                $this->data['error']="Warning: You do not have permission to reset password!";
	            }	
			}
			else
			{
				$this->data['error']="Warning: You do not have permission to reset password!";
			}
			
		}
		if($verify_code != "")
		{
			 $check_code = $this->login->verify_code($this->commons->decode($verify_code));
			 if($check_code)
			 {
                  $this->data['success']="Success: The activation link verified successfully!";
			 }
			 else
			 {
			 	 redirect('common/login');
			 }
		}
		  if (($this->input->post('pwd')) !== NULL) {
			$this->data['pwd'] = $this->input->post('pwd');
		} else {
			$this->data['pwd'] = '';
		}
		  if (($this->input->post('cnfpwd')) !== NULL) {
			$this->data['cnfpwd'] = $this->input->post('cnfpwd');
		} else {
			$this->data['cnfpwd'] = '';
		}
		if (($this->input->post('user_id')) !== NULL) {
			$this->data['user_id'] = $this->input->post('user_id');
		} else {
			$this->data['user_id'] = $user_id;
		}
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/common/reset_password";
		$this->load->view($content_page,$this->data);
	}
	
        /**
	* 
	* @function name : validation()
	* @description   : generate validation when input data incorrect
	* @param   	 : void
	* @return        : TRUE/FALSE
	*
	*/
	public function validate() {
           $validation = array(
					    array(
					        'field' => 'pwd',
					        'label' => 'Password', 
					        'rules' => 'required|min_length[4]|max_length[20]|xss_clean', 
					        'errors' => array('required' => 'Please Provide %s.','min_length'=>'Password must be between 4 and 20 characters!','max_length'=>'Password must be between 4 and 20 characters!')
					    ),
					     array(
					        'field' => 'cnfpwd',
					        'label' => 'Confirm Password', 
					        'rules' => 'matches[pwd]|xss_clean', 
					        'errors' => array('matches' => 'Password and Confirm Password do not match!')
					    ),
					);
            $this->form_validation->set_rules($validation);
            if ($this->form_validation->run() == FALSE){

                return FALSE;
            }
            else{
                //$this->data['success']="Success: You have modified Settings!";
                return TRUE;
            }
        }
	
	
}
