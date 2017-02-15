<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Register
* @Auther       : Vinay
* @Date         : 05-12-2017
* @Description  : User Registration Operation
*
*/

class Register extends CI_Controller   {
    
    private $data=array();
    private $error = array();

    function __construct()  {
        
        parent::__construct();
        
        $this->load->model('account/register_model','register');
        $this->load->library('commons');
        $this->load->model('common');
        
    }
   
    /**
    * 
    * @function name : registration()
    * @description   : insert register user data into database and send mail to register user
    * @param         : void
    * @return        : void
    *
    */
    public function registration() {
        if(($this->input->server('REQUEST_METHOD') == 'POST')) {
            
            echo $this->register->addRegisterData();
            
        }
    }
    
    /**
    * 
    * @function name : active_user()
    * @description   : check user activation link
    * @param         : $user_id for activation link check
    * @param         : $activation_code for activation link validate activation code
    * @return        : void
    *
    */
    public function active_user($user_id = '',$activation_code = '')  
    {
        if($user_id !== "" && $activation_code !== "")
        {
            $res = $this->register->checkActivationCode($this->commons->decode($user_id),$this->commons->decode($activation_code));
            if($res)
            {
                $getCustomer = $this->common->getCustomer($this->commons->decode($user_id));
                
                $name  = $getCustomer['firstname']." ".$getCustomer['lastname'];                 
                $email = $getCustomer['email'];
                
                //=== Send Email ====
                $Template = $this->mailer->Tpl_Email('account_activated',$this->commons->encode($email));
                $Recipient = $email;
                $Filter = array(
                    '{{NAME}}' =>$name,
                );
                $this->mailer->Send_Singal_Html_Email($Recipient,$Template,$Filter);
                //===================
                
                $this->session->set_flashdata('success','Your Account have been activated successfully');
                //redirect('common/login');
                redirect('account/account/success');
            }
            else
            {
                $this->session->set_flashdata('warning','Activation link is either invalid or expired.');
                redirect('account/account/success');
                //$this->data['error'] = "Activation link is either invalid or expired.";
            }
        }
        else
        {
            $this->session->set_flashdata('warning','Activation link is either invalid or expired.');
            redirect('account/account/success');
            $this->data['error'] = "Activation link is either invalid or expired.";  
        }
        redirect('common/home');
        
    }
    
    /**
    * 
    * @function name : Check_Email_Exist()
    * @description   : check email already exists or not
    * @param         : void
    * @return        : true/false
    *
    */
    function Check_Email_Exist()
    {
        //echo "HI";exit;
        $this->db->from('customer');
        $this->db->where('email',$this->input->post('email'));
        $query=$this->db->get();
        if($query->num_rows() >0)
            echo 'false';
        else 
            echo 'true';
    }
    
    
	
	
	
	
	
}
