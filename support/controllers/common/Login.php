<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Login
* @Auther       : Vinay
* @Date         : 16-12-2016
* @Description  : Support login Operation
*
*/

class Login extends CI_Controller	{

	private $data=array();

	function __construct()	{
            parent::__construct();

            $this->_init();
            $this->lang->load('common/login_lang', 'english');
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
            // Set Template
            $this->output->set_template('common/login_template');
            $admin_theme = $this->common->config('admin_theme');
            $this->output->set_common_meta('Support Login','sarpo','This is srapo login page');

            $this->load->css(ADMIN_PATH.$admin_theme.'/plugins/bootstrap/css/bootstrap.min.css');
            $this->load->css(ADMIN_PATH.$admin_theme.'/fonts/font-awesome/css/font-awesome.min.css');
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
	* @param   	 : void
	* @return        : void
	*
	*/
	public function index($Back_To='')	{
            $this->data['form_action']     = base_url('common/login/index/'.$Back_To);
            $this->data['forgot_password'] = base_url('common/forgot_password');

            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validate())
            {
                //Check Username or Password
                //$this->load->model('common/login_model');
                $check_auth = $this->login->login();

                if($check_auth !== 'invalid') {

                    //--------------------------------------------------------
                    if($Back_To!='')
                    {
                        redirect($this->commons->decode($Back_To));
                    }
                    else
                    {
                        redirect('dashboard/dashboard');
                    }

                } else {
                    $this->data['error']="No match for Username and/or Password.";
                }
            }

            if (($this->input->post('email')) !== NULL) {
                    $this->data['email'] = $this->input->post('email');
            } else {
                    $this->data['email'] = '';
            }

            if (($this->input->post('password')) !== NULL) {
                    $this->data['password'] = $this->input->post('password');
            } else {
                    $this->data['password'] = '';
            }

            if(($this->session->flashdata('flashError')) !== NULL) {
                $this->data['flashError'] = $this->session->flashdata('flashError');
            } else {
                $this->data['flashError'] = '';
            }
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/common/login";
            $this->load->view($content_page,$this->data);
	}
	
	/**
	* 
	* @function name 	: validate()
	* @description   	: Validate form data
	* @access 		: public
	* @param   		: void
	* @return        	: boolean
	*
	*/
	public function validate() {
            $validation = array(
                            array(
                                'field' 	=> 'email',
                                'label' 	=> 'Email', 
                                'rules' 	=> 'trim|required|valid_email|xss_clean', 
                                'errors' 	=> array('required' => 'Please Provide %s.','valid_email'=>'Please Provide Valid %s')
                            ),
                            array(
                                'field' 	=> 'password',
                                'label' 	=> 'Password', 
                                'rules' 	=> 'required|xss_clean', 
                                'errors' 	=> array('required' => 'Please Provide %s.')
                            )
                        );
                        $this->form_validation->set_rules($validation);
                        if ($this->form_validation->run() == FALSE){
                            //$this->data['error']="No match for Username and/or Password.";
                            return FALSE;
                        }else{
                            return TRUE;
                        }
	}
        
        /** 
	* @function name 	: LogOut()
	* @description   	: load LogOut function from Login_model    
	* @access 		: public
	* @param   		: void
	* @return        	: void  
	*/
        public function LogOut() {
           $this->login->LogOut();
           redirect('common/login');
        }
	
}
