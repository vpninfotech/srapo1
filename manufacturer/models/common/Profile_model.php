<?php
/**
* 
* @file name   : Profile_model
* @Auther      : ritesh
* @Date        : 05-12-2016
* @Description : Collection of various common function related to profile database operation.
*
*/
class Profile_model extends CI_Model 
{
    /**
    * 
    * @function name 	: __construct()
    * @description   	: initialize variables
    * @param   		    : void
    * @return        	: void 
    *
    */
    public function __construct() 
    {
        parent::__construct();
    }
    
    /**
    * 
    * @function name : getUser()
    * @description   : get user record by user_id
    * @access        : public
    * @param   	     : int $user_id The user id that you want
    * @return        : array The selected users array
    *
    */
    public function getUser($user_id) 
    {
        $this->db->from('manufacturer');
        $this->db->where('manufacturer_id',(int)$user_id);
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
        $this->db->from('manufacturer');
        $this->db->where('email',$email);
		if($this->input->post('manufacturer_id') != "")
		{
			$this->db->where('manufacturer_id !=',$this->input->post('manufacturer_id'));
		}
        $query=$this->db->get();
        return $query->row_array();
    }
    
    /**
    * 
    * @function name : editUser()
    * @description   : edit user record in database
    * @access        : public
    * @return        : void
    *
    */
    public function editUser() 
    {
        
        
        $this->db->set('firstname', $this->input->post('firstname'));
        $this->db->set('middlename', $this->input->post('middlename'));
        $this->db->set('lastname', $this->input->post('lastname'));
        //$this->db->set('email', $this->input->post('email'));
        $this->db->set('telephone', $this->input->post('telephone'));
        $this->db->set('image', $this->input->post('image'));
        $this->db->set('ip', $_SERVER['REMOTE_ADDR']);
        
        if($this->input->post('password')!=="")
        {
          $this->db->set('password', md5($this->input->post('password')));  
        }
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('Muser_id'));
        $this->db->where('manufacturer_id',(int)$this->input->post('manufacturer_id'));
        return $this->db->update('manufacturer');	
    }
}