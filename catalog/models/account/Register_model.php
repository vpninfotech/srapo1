<?php
/**
* 
* @file name   : Register_model
* @Auther      : Vinay
* @Date        : 05-01-2017
* @Description : Collection of various register function related to user database operation.
*
*/
class Register_model extends CI_Model 
{
    /**
    * 
    * @function name 	: __construct()
    * @description   	: initialize variables
    * @param   		: void
    * @return        	: void
    *
    */
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('mailer');
    }
    
    
    /**
    * 
    * @function name : addRegisterData()
    * @description   : add Register User record in database
    * @access        : public
    * @return        : int last inserted User record id
    *
    */
    public function addRegisterData() 
    {
        $activation_code = $this->commons->generate_randomnumber(6);
        //$this->db->set('role_id', 8);
        $this->db->set('firstname', $this->input->post('firstname'));
        $this->db->set('lastname', $this->input->post('lastname'));
        $this->db->set('email', $this->input->post('email'));
        $this->db->set('ip', $_SERVER['REMOTE_ADDR']);
        $this->db->set('activation_code',$activation_code);
        $this->db->set('password', md5($this->input->post('password')));
        $this->db->set('status', 0);
        $this->db->set('date_added',date('Y-m-d h:i:sa'));
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->insert('customer');
        $user_id = $this->db->insert_id();
        
        if($user_id > 0) 
        {
            $name = $this->input->post('firstname')." ".$this->input->post('lastname');
            $email = $this->input->post('email');
            $activation_link = base_url('account/register/active_user/').$this->commons->encode($user_id).'/'.$this->commons->encode($activation_code);
            
            //=== Send Email ====
            $Template = $this->mailer->Tpl_Email('user_signup',$this->commons->encode($email));
                $Recipient = $email;
                $Filter = array(
                    '{{NAME}}' =>$name,
                    '{{ACTIVATION_LINK}}' => $activation_link,
                );
            $this->mailer->Send_Singal_Html_Email($Recipient,$Template,$Filter);
            //===================
        } 
        return $user_id;
    }
    
    /** 
    * @function name 	: checkActivationCode()
    * @description   	: check activation code    
    * @access 		    : public
    * @param            : string $user_id The user id is activation code
    * @param   		    : string $code The code is activation code
    * @return        	: boolean  
    */
    public function checkActivationCode($user_id,$code)
    {
        $this->db->where('activation_code',$code);
        $this->db->where('customer_id',(int)$user_id);
        $query = $this->db->get('customer');	
        if ($query->num_rows() > 0)
        { 
            $this->db->set('activation_code', '');
            $this->db->set('status', 1);
            $this->db->set('approve', 1);
            $this->db->where('customer_id',$user_id);
            $this->db->update('customer');
            return TRUE;
        }
        else
        { 
            return FALSE;
        }
    }
	
    
    /**
    * 
    * @function name 	: getTotalUser()
    * @description   	: get total no of stock_status from database
    * @access 		: public
    * @return       	: int total no of records
    *
    */
    public function getTotalUser() 
    {
        $sql = "SELECT COUNT(*) AS total FROM admin_user";
        if($this->session->userdata('role_id')!=1) 
        {
            $sql .= " WHERE is_deleted = 0";
        }
        $query = $this->db->query($sql);
        return $query->row('total');
    }

    
}