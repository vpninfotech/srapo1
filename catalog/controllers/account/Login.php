<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Login
* @Auther       : Vinay
* @Date         : 05-01-2017
* @Description  : Customer login Operation
*
*/

class Login extends CI_Controller   {

    private $data=array();

    function __construct() {
		
        parent::__construct();
        
        //$this->_init();

        $this->lang->load('account/login_lang', 'english');

        $this->load->model('account/login_model','login');
        
        //$this->load->model('common');
        
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
            $check_auth = $this->login->login();
            $msg = "";
            $json=array();
            if ($check_auth == "invalid") {
               $json['msg'] = "invalid";
            } else if($check_auth == "inactive") {
               $json['msg'] = "inactive"; 
            }
            else {
                $customerData = $this->common->getCustomerByEmail($this->input->post('email'));
                
                $name = $customerData['firstname']." ".$customerData['lastname'];
                $email = $customerData['email'];
                $message = $_SERVER['HTTP_USER_AGENT'];
                
                //=== Send Email ====
                $Template = $this->mailer->Tpl_Email('general_message_format',$this->commons->encode($email));
                    $Recipient = $email;
                    $Filter = array(
                        '{{NAME}}' =>$name,
                        '{{MESSAGE}}' => "Your Srapo Account <a><u><b>" . $email . "</b></u></a> was just used to sign in from " . $message,
                    );
                $this->mailer->Send_Singal_Html_Email($Recipient,$Template,$Filter);
                //===================
                
                $json['msg'] = "active";
            }
            $json['url'] =BASE_URL.str_replace("/srapo_CI/","",$this->input->post('request_url'));

            echo json_encode($json);
        }	 
    }
    
    /**
    * 
    * @function name : forgotPassword()
    * @description   : load login view
    * @param   	     : void
    * @return        : void
    *
    */
    public function forgotPassword()	
    {
        if(($this->input->server('REQUEST_METHOD') == 'POST'))
        {            
            $check_email = $this->login->forgotPassword();
            $msg = "";
            if($check_email == 1) {                
                $msg = 1;
            } else {
                $msg = 0;
            }
            echo $msg;
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
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('success1');
        $this->login->LogOut();
        redirect('common/home');
    }
    /*
     * Newsletter Subscribe
     */
    public function subscribe() {
        $res = $this->login->subscribe();
        if ($res) {
            echo 1;
        } else {
            echo 0; 
        }      
    }
    
    /*
     * Newsletter Unsubscribe
     */
    public function unsubscribe($email='')
    {
		if($email!='')
		{
			$this->db->set('newsletter', 0);
			$this->db->where('email', $this->commons->decode($email));
			$this->db->update('customer'); 
			
			$this->db->set('newsletter_status', 0);
			$this->db->where('email', $this->commons->decode($email));
			$this->db->update('newsletter'); 
			$this->load->view('unsubscribe_message');
		}
   }
}
