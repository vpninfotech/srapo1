<?php
/**
* 
* @file name   : Customer_model
* @Auther      : Vinay
* @Date        : 06-12-2017
* @Description : Collection of various common function related to cuatomer database operation.
*
*/
class Customer_model extends CI_Model 
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
    }
    
    /**
    * 
    * @function name : getCustomerById()
    * @description   : get customer record by user_id
    * @access        : public
    * @param   	     : int $user_id The user id that you want
    * @return        : array The selected users array
    *
    */
    public function getCustomerById($user_id) 
    {
        $this->db->from('customer');
        $this->db->where('customer_id',(int)$user_id);
        $query=$this->db->get();
        return $query->row_array();
    }
    
    /**
    * 
    * @function name : getUserByEmail()
    * @description   : get user record by email_id
    * @access        : public
    * @param   	     : int $email The user email that you want
    * @return        : array The selected users array
    *
    */
    public function getUserByEmail($email) 
    {
        $this->db->from('customer');
        $this->db->where('email',$email);
        $query=$this->db->get();
        return $query->row_array();
    }
    
    /**
    * 
    * @function name : editCustomer()
    * @description   : edit customer record in database
    * @access        : public
    * @return        : void
    *
    */
    public function editCustomer() 
    {
        $this->db->set('firstname', $this->input->post('firstname'));
        $this->db->set('lastname', $this->input->post('lastname'));
        $this->db->set('email', $this->input->post('email'));
        $this->db->set('telephone', $this->input->post('telephone'));
        $this->db->set('ip', $_SERVER['REMOTE_ADDR']);
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', (int)$this->input->post('customer_id'));
        $this->db->where('customer_id',(int)$this->input->post('customer_id'));
        return $this->db->update('customer');	
    }
    
    /**
    * 
    * @function name : editPassword()
    * @description   : edit customer password record in database
    * @access        : public
    * @return        : void
    *
    */
    public function editPassword() 
    {
        $this->db->set('password', md5($this->input->post('password')));
        $this->db->set('ip', $_SERVER['REMOTE_ADDR']);
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', (int)$this->session->userdata('customer_id'));
        $this->db->where('customer_id',(int)$this->session->userdata('customer_id'));
        return $this->db->update('customer');	
    }
    
    /**
    * 
    * @function name : editNewsletter()
    * @description   : edit customer newsletter subscription record in database
    * @access        : public
    * @return        : void
    *
    */
    public function editNewsletter() 
    {
        $this->db->set('newsletter',$this->input->post('newsletter'));
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', (int)$this->session->userdata('customer_id'));
        $this->db->where('customer_id',(int)$this->session->userdata('customer_id'));
        return $this->db->update('customer');	
    }
    
    
}