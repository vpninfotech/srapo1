<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Login
* @Auther       : RITESH
* @Date         : 05-12-2016
* @Description  : Manufacturer login Operation
*
*/

class Login extends CI_Controller   {

    private $data=array();

    function __construct() {
		
        parent::__construct();
        
        $this->_init();

        $this->lang->load('common/login_lang', 'english');

        $this->load->model('common/login_model','login');	
      if ($this->session->flashdata('success')!==NULL) 
        {
            $this->data['success'] = $this->session->flashdata('success');

           
        }
        if ($this->session->flashdata('error')!==NULL) 
        {
            $this->data['error'] = $this->session->flashdata('error');

           
        }	
    }
	
    /**
    * 
    * @function name : _init()
    * @description   : initialize required resources in this view
    * @param   	     : void
    * @return        : void
    *
    */
    private function _init() 
    {
        
    }
	
    /**
    * 
    * @function name : index()
    * @description   : load login view
    * @param   	     : void
    * @return        : void
    *
    */
    public function index($Back_To='')	
    {
        if(($this->input->server('REQUEST_METHOD') == 'POST'))
        {
            //Check Username or Password
            //$this->load->model('common/login_model');
            $check_auth = $this->login->login();

            if($check_auth === 'invalid')
            {
                $this->data['error']="No match for Email and/or Password.";
            }
            else if($check_auth === 'inactive')
            {
                $this->data['error']="Your account is inactive, Please contact support team.";
            }
            else
            {
                if($this->session->userdata('manufacturer_status') == 2)
                {
                   redirect('common/register/verify'); 
                }
                //--------------------------------------------------------
                if($Back_To!='')
                {
                    redirect($this->commons->decode($Back_To));
                }
                else
                {
                    redirect('dashboard/dashboard');
                }
            }
        }
        
        $admin_theme = $this->common->config('admin_theme');
        $content_page="themes/".$admin_theme."/common/login";
        $this->load->view($content_page,$this->data);
		 
    }
	
    /**
    * 
    * @function name 	: validate()
    * @description   	: Validate form data
    * @access 		    : public
    * @param   		    : void
    * @return        	: boolean
    *
    */
    public function validate()	
    {
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
    * @access 		    : public
    * @param   		    : void
    * @return        	: void  
    */
    public function LogOut() 
    { 
        $this->login->LogOut();
        redirect('common/login');
    }
}
