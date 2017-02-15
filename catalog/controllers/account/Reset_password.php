<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
* @file name    : Reset Password
* @Auther       : Vinay
* @Date         : 06-12-2017
* @Description  : Reset Password Related Operation
*
*/
class Reset_password extends CI_Controller {
	function __construct()
	{
            parent::__construct();
                
            $this->_init();
            
            //$this->lang->load('common/login_lang', 'english');
            $this->load->model('account/login_model','login');
            $this->load->model('common');
	}
	
	private function _init() {
            //--Set Template
            $this->output->set_template('site_template');
            $site_theme = $this->common->config('catalog_theme');
            $this->output->set_common_meta('Reset Password','sarpo','Reset Password Page');
	}
        
	public function index($user_id = "", $verify_code = "")
	{
            $this->document->setTitle('title');
            $this->document->setDescription('description');
            $this->document->setKeywords('keyword');
	    $data['header'] = $this->headers->getHeaders();
            
            $data['form_action']     = base_url('account/reset_password');
            $data['customer_id'] = $user_id;
            $data['code'] = $verify_code;
            
            if($verify_code != "")
            {
                $check_code = $this->login->verify_code($user_id,$this->commons->decode($verify_code));
                if($check_code)
                {
                    $this->session->set_flashdata('success','The activation link verified successfully!');
                    //$data['success']="Success: The activation link verified successfully!";
                    
                }
                else
                {
                    $this->session->set_flashdata('warning','Activation link is either invalid or expired.');
                    redirect('account/account/success');
                }
            }
            
            $msg = "";
            if(($this->input->server('REQUEST_METHOD') == 'POST'))
            {
                if($this->input->post('customer_id') !== "")
                {
                    $result = $this->login->resetPassword();
                    if($result)
                    {
                        
                        $getCustomer = $this->common->getCustomer($this->input->post('customer_id'));
                
                        $name  = $getCustomer['firstname']." ".$getCustomer['lastname'];                 
                        $email = $getCustomer['email'];
                
                        //=== Send Email ====
                        $Template = $this->mailer->Tpl_Email('password_changed',$this->commons->encode($email));
                        $Recipient = $email;
                        $Filter = array(
                            '{{NAME}}' =>$name,
                        );
                        $this->mailer->Send_Singal_Html_Email($Recipient,$Template,$Filter);
                        //===================
                        $this->session->unset_userdata('success');
                        $this->session->set_flashdata('success','Your Password reset successfully!');
                        redirect('account/reset_password');
                    }
                    else
                    {
                        $this->session->set_flashdata('warning','You do not have permission to reset password!');
                        //$data['error']="Warning: You do not have permission to reset password!";
                        redirect('account/account/success');
                    }   
                }
                else
                {
                    $this->session->set_flashdata('warning','You do not have permission to reset password!');
                    //$data['error']="Warning: You do not have permission to reset password!";
                    redirect('account/account/success');
                }
            }
            
            
            
            $site_theme = $this->common->config('catalog_theme');
            $this->load->section('content', "themes/".$site_theme."/account/reset_password",$data);
            $this->load->view("themes/".$site_theme."/common/success_msg",$data);
	}
}
