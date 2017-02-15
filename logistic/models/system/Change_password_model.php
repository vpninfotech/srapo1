<?php
/**
* 
* @file name   : Change_password_model
* @Auther      : Vinay	
* @Date        : 29-12-2016
* @Description : Collection of various common function related to Change Password database operation.
*
*/
class Change_password_model extends CI_Model 
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
    * @function name : updatePassword()
    * @description   : edit user passwordin database
    * @access        : public
    * @return        : void
    *
    */
    public function updatePassword() 
    {
        $this->db->set('password', md5($this->input->post('new_password')));
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('logistic_user_id'));
        $this->db->where('admin_id',$this->session->userdata('logistic_user_id'));
        return $this->db->update('admin_user');	
    }
	
    
    
    /**
    * 
    * @function name 	: getTotalOrderStatus()
    * @description   	: get total no of order_status from database
    * @param            : string $old_password The password that you check
    * @access 		    : public
    * @return       	: int total no of records
    *
    */
    public function getOldPassword($old_password) 
    {
    
        $this->db->from('admin_user');
        $this->db->where('admin_id',$this->session->userdata('logistic_user_id'));
        $this->db->where('password',md5($old_password));
        $query=$this->db->get();
        if($query->num_rows()!==0){
           return TRUE;
        }else{
           return FALSE;
        }
    }    
}