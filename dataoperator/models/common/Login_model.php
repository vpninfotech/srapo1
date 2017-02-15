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
	public function __construct()	{
            parent::__construct();
            $this->load->helper('cookie');
            $this->load->library('commons');
            $this->load->library('mailer');
            $this->load->library('session'); 
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

	 
		$this->db->from('admin_user');
		$this->db->where_in('role_id',array(5));
		$this->db->where('email',($this->input->post('email')));
		$this->db->where("password",md5($this->input->post('password')));
                $this->db->where("is_deleted=0");
		$query=$this->db->get();
			
		 
                
        //echo $this->db->last_query();
 
		if ($query->num_rows() == 0)  return 'invalid'; // invalid id or password
		$result = $query->row_array();
		if ($result['status'] != 1)  return 'inactive'; // Inactive Account
                
                $get_token  = $this->commons->token();
                $email      = $this->input->post('email');
                $password   = $this->input->post('password');
                $remember   = $this->input->post('remember');
                if ($remember!=NULL)
                {
                    set_cookie("email",$email,time()+(60*60*1));
                    set_cookie("password",$password,time()+(60*60*1));
                }
				 
				 

		// Set session data
		
		
		$this->session->set_userdata(array(
			'Duser_id'        => $result['admin_id'],
			'Dname'           => $result['firstname'].' '.$result['lastname'],
			'Drole_id'        => $result['role_id'],
			'Dimage'          => $result['image'],
            'Demail'          => $result['email'],
            'Dtoken'          => $get_token,
			'Dlogin_status'   => TRUE
		));
                
                //Modify Lass_Access Field in Database
                $this->db->set('last_access',date('Y-m-d h:i:sa'))->where('admin_id',$this->session->userdata('Duser_id'))->update('admin_user');
				
		
    }
		 
		  
	

	/** 
	* @function name 	: changePassword()
	* @description   	: Change admin user password
	* @access 		    : public
	* @param   		    : void
	* @return        	: boolean  
	*/
	public function changePassword()	
	{
		$this->db->from('admin_user');
		$this->db->where("user_id",$this->session->userdata('Duser_id'));
		$this->db->where('password', md5($this->input->post('password')));
		$query=$this->db->get();
		
        if ($query->num_rows() == 0)  return false; // Email not found
		
		$this->db->set('password',md5($this->input->post('password')));
		$this->db->where("user_id",$this->session->userdata('Duser_id'));
		
		if($this->db->update('admin_user'))	
		{	
			return TRUE;   
		}	
		else 	
		{	
			return FALSE;  
		}
	}
	
	/** 
	* @function name 	: resetPassword()
	* @description   	: Change admin user password
	* @access 		: public
	* @param   		: void
	* @return        	: array  
	*/
	public function resetPassword()
	{
		$this->db->set('activation_code','');
		$this->db->set('password', md5($this->input->post('pwd')));
		$this->db->where('admin_id',$this->input->post('user_id',true));
		$result = $this->db->update('admin_user');
		
		return $result;
	}
    /** 
	* @function name 	: verify_code()
	* @description   	: check admin user forgor password verification code
	* @access 		: public
	* @param   		: void
	* @return        	: array  
	*/
	public function verify_code($verify_code)
	{
		$this->db->from('admin_user');
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
	* @function name 	: checkActivationCode()
	* @description   	: check activation code    
	* @access 		    : public
	* @param   		    : string $code The code is activation code
	* @return        	: boolean  
	*/
	public function checkActivationCode($code)
	{
		$this->db->where('activation_code',$code);
		$query = $this->db->get('admin_user');	
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
	* @function name 	: LogOut()
	* @description   	: Make Session clear    
	* @access 		    : public
	* @param   		    : void
	* @return        	: void  
	*/
        public function LogOut()
        {	
		  
  
            $this->session->set_userdata(array(
                    'Duser_id'        => NULL,
                    'Dname'           => NULL,
                    'Drole_id'        => NULL,
                    'Dimage'          => NULL,
                    'Demail'          => NULL,
                    'Dtoken'          => NULL,                               
                    'Dadmin_status'   => FALSE,
                    'Dlogin_status'   => FALSE
 
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
           
            $this->db->from('admin_user');
            $this->db->where('email',$this->input->post('email'));
            $this->db->where('role_id = 5');
            $query=$this->db->get();
            if($query->num_rows()>0) {
                
        $res = $query->row_array();
		$RandNo = $this->commons->generate_randomnumber(4);
		$acc_code = $RandNo.$res['admin_id'];
                
                $this->db->set('activation_code', $acc_code);
                $this->db->where('admin_id',$res['admin_id']);
                $this->db->update('admin_user');
                
              //=== Send Email ====
                    $Template = $this->mailer->Tpl_Email('forgot_password',$this->commons->encode($this->input->post('email')));
                        $Recipient = $res['email'];
                        $Filter = array(
                            '{{NAME}}' =>$res['firstname'].' '.$res['lastname'],
                            '{{RESET_CODE}}' =>$acc_code,
                            '{{RESET_LINK}}' =>base_url('common/reset_password/index/'.$res['admin_id'].'/'.$this->commons->encode($acc_code))
                        );
                    $this->mailer->Send_Singal_Html_Email($Recipient,$Template,$Filter);
                //===================
                return TRUE; 
                
            } else {
                
                return FALSE;
                
            }
            
       }
	
		 
    
}
