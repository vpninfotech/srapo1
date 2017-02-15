<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Login_model class
 * Collection of various common function related to system authantication.
 *
 * @author    RITESH
 * @license   http://www.vpninfotech.com/
 */

class Login_model extends CI_Model	
{
	
    /**
    * 
    * @function name 	: __construct()
    * @description   	: Initialize variables
    * @access 		    : private
    * @param   		    : void
    * @return        	: void
    *
    */
    public function __construct()	
    {
        parent::__construct();
        $this->load->library('commons');
        $this->load->library('mailer'); 
    }
	
    /**
    * 
    * @function name 	: Login()
    * @description   	: Check UserName and Password for Aithantication
    * @access 		    : public
    * @param   		    : void
    * @return        	: void
    *
    */
    public function Login()	
    { 
        $this->db->from('customer');
        $this->db->where('email',($this->input->post('email')));
        $this->db->where("password",md5($this->input->post('password')));
        $query=$this->db->get();
               
        //echo $this->db->last_query();
        if ($query->num_rows() == 0)  return 'invalid'; // invalid id or password
        $result = $query->row_array();
        
        if ($result['status'] == 0)  return 'inactive'; // Inactive Account
        
        //$get_token  = $this->commons->token();

        // Set session data
        $this->session->set_userdata(array(
            'customer_id'        => $result['customer_id'],
            'customer_name'           => $result['firstname'].' '.$result['lastname'],
            'customer_email'          => $result['email'],
            'customer_status'          => $result['status'],
            //'token'          => $get_token,
            'customer_login_status'   => TRUE,
            'session_id'     => session_id()
        ));
               
        //Modify Lass_Access Field in Database
        $this->db->set('last_access',date('Y-m-d h:i:sa'))->where('customer_id',$this->session->userdata('customer_id'))->update('customer');
                
    }

    /** 
    * @function name 	: changePassword()
    * @description   	: Change manufacturer password
    * @access 		    : public
    * @param   		    : void
    * @return        	: boolean  
    */
    public function changePassword()	
    {
        $this->db->from('customer');
        $this->db->where("customer_id",$this->session->userdata('customer_id'));
        $this->db->where('password', md5($this->input->post('password')));
        $query=$this->db->get();
		
        if ($query->num_rows() == 0)  return false; // Email not found
		
            $this->db->set('password',md5($this->input->post('password')));
            $this->db->where("user_id",$this->session->userdata('customer_id'));

            if($this->db->update('customer'))	
            {	
                return TRUE;   
            }	
            else 	
            {	
                return FALSE;  
            }
    }
	 /** 
    * @function name    : verify_code()
    * @description      : check admin user forgor password verification code
    * @access       : public
    * @param        : void
    * @return           : array  
    */
    public function verify_code($customer_id,$verify_code)
    {
        $this->db->from('customer');
        $this->db->where('customer_id',(int)$customer_id);
        $this->db->where('activation_code',$verify_code);
        $query=$this->db->get();
        if ($query->num_rows() > 0)
        {   
            return TRUE;
        }
        else
        { 
            return FALSE;
        }
    }
   /** 
    * @function name    : resetPassword()
    * @description      : reset user password
    * @access       : public
    * @param        : void
    * @return           : array  
    */
    public function resetPassword()
    {
        $this->db->set('activation_code','');
        $this->db->set('password', md5($this->input->post('password')));
        $this->db->where('customer_id',$this->input->post('customer_id',true));
        $result = $this->db->update('customer');
        return $result;
    }
        
    /** 
    * @function name 	: checkActivationCode()
    * @description   	: check activation code    
    * @access 		    : public
    * @param            : string $manufacturer_id The manufacture id is activation code
    * @param   		    : string $code The code is activation code
    * @return        	: boolean  
    */
    public function checkActivationCode($customer_id,$code)
    {
        $this->db->where('activation_code',$code);
        $this->db->where('customer_id',(int)$customer_id);
        $query = $this->db->get('customer');	
        if ($query->num_rows() > 0)
        { 
            $this->db->set('activation_code', '');
            $this->db->set('status', 2);
            $this->db->where('customer_id',$customer_id);
            $this->db->update('customer');
            return TRUE;
        }
        else
        { 
            return FALSE;
        }
    }
	
    /** 
    * @function name 	: LogOut()
    * @description   	: Make Session clear    
    * @access 		    : public
    * @param   		    : void
    * @return        	: void  
    */
    public function LogOut()
    {
        $this->session->set_userdata(array(
            'customer_id'               => NULL,
            'customer_name'             => NULL,
            'customer_email'            => NULL,
            'customer_status'           => FALSE, 
            'customer_login_status'     => FALSE,
            'shipping_address'          => NULL,
            'payment_address'           => NULL
        )); 
        // unset($_SESSION['token']);
    }
        
    /** 
    * @function name 	: forgotPassword()
    * @description   	: send password reset link or code on mail    
    * @access 		    : public
    * @param   		    : void
    * @return        	: void  
    */
    public function forgotPassword() {

        $this->db->from('customer');
        $this->db->where('email',$this->input->post('email'));
        $query=$this->db->get();
        if($query->num_rows()>0) {
            $res = $query->row_array();
            $RandNo = $this->commons->generate_randomnumber(4);
            $acc_code = $RandNo.$res['customer_id'];
                
            $this->db->set('activation_code', $acc_code);
            $this->db->where('customer_id',$res['customer_id']);
            $this->db->update('customer');
           
           //=== Send Email ====
                $Template = $this->mailer->Tpl_Email('forgot_password',$this->commons->encode($this->input->post('email')));
                    $Recipient = $res['email'];
                    $Filter = array(
                        '{{NAME}}' =>$res['firstname'].' '.$res['lastname'],
                        '{{RESET_CODE}}' =>$acc_code,
                        '{{RESET_LINK}}' =>base_url('account/reset_password/index/'.$res['customer_id'].'/'.$this->commons->encode($acc_code))
                    );
                $this->mailer->Send_Singal_Html_Email($Recipient,$Template,$Filter);
            //===================
            return TRUE; 
        } else {
            return FALSE;
        }
            
    }
}
