<?php
/**
* 
* @file name   : User_groups_model
* @Auther      : Vinay
* @Date        : 08-11-2016
* @Description : Collection of various common function related to role database operation.
*
*/
class User_groups_model extends CI_Model 
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
    * @function name : getUserGroup()
    * @description   : get role record by user_group_id
    * @access        : public
    * @param   	     : int $user_group_id The role id that you want
    * @return        : array The selected role array
    *
    */
    public function getUserGroup($user_group_id) 
    {
        $this->db->from('role');
        $this->db->where('role_id',(int)$user_group_id);
        $query=$this->db->get();
        return $query->row_array();
    }
        
    /**
    * 
    * @function name : addUserGroup()
    * @description   : add role record in database
    * @access        : public
    * @return        : int last inserted role record id
    *
    */
    public function addUserGroup() 
    {
        $is_deleted = $this->input->post('is_deleted');
        if(isset($is_deleted))
        {
                $is_deleted = 1;
        }
        else
        {
                $is_deleted = 0;
        }
        $this->db->set('role_name', $this->input->post('user_group_name'));
        $this->db->set('date_added',date('Y-m-d h:i:sa'));
        $this->db->set('added_by', $this->session->userdata('user_id'));
	$this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('user_id'));
        $this->db->set('is_deleted', $is_deleted);
        $this->db->insert('role');
        return $this->db->insert_id();
    }
    
    /**
    * 
    * @function name : editUserGroup()
    * @description   : edit role record in database
    * @access        : public
    * @return        : void
    *
    */
    public function editUserGroup() 
    {
        $is_deleted = $this->input->post('is_deleted');
        if(isset($is_deleted))
        {
                $is_deleted = 1;
        }
        else
        {
                $is_deleted = 0;
        }
        $this->db->set('role_name', $this->input->post('user_group_name'));
        $this->db->set('is_deleted', $is_deleted);
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('user_id'));
        $this->db->where('role_id',(int)$this->input->post('user_group_id'));
        return $this->db->update('role');	
    }
	
    /**
    * 
    * @function name 	: softDeleteUserGroup()
    * @description   	: only status change not actual delete role from database
    * @access 		: public
    * @param   		: int $user_group_id The role id that you want to delete
    * @return       	: void
    *
    */
    public function softDeleteUserGroup($user_group_id) 
    {	
        $this->db->set('is_deleted',1);
        $this->db->where('role_id',(int)$user_group_id);
        return $this->db->update('role');
    }
    
    /**
    * 
    * @function name 	: deleteUserGroup()
    * @description   	: delete role record from database
    * @access 		: public
    * @param   		: int $user_group_id The role id that you want to delete
    * @return       	: void
    *
    */
    public function deleteUserGroup($user_group_id) 
    {	
        $this->db->where('role_id',(int)$user_group_id);
        return $this->db->delete('role');
    }
    
    /**
    * 
    * @function name 	: getUserGroups()
    * @description   	: get all role from database
    * @access 		: public
    * @param   		: string $user_group_id The role name that you want to get
    * @return       	: array The selected role array
    *
    */
    public function getUserGroups($data = array()) 
    {
        $sql = "SELECT * FROM role WHERE 1=1";

        if($this->session->userdata('role_id')!=1) 
        {
            $sql .= " AND is_deleted = 0";
            $sql .= " AND role_id != 1";
        }

        $sql .= " ORDER BY role_name";

        if (isset($data['order']) && ($data['order'] == 'DESC')) 
        {
            $sql .= " DESC";
        } 
        else 
        {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) 
        {
            if ($data['start'] < 0) 
            {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) 
            {
                    $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }
        $query = $this->db->query($sql);
        $query->result_array();
        return $query->result_array();
    }
    
    /**
    * 
    * @function name 	: getTotalUserGroup()
    * @description   	: get total no of role from database
    * @access 		: public
    * @return       	: int total no of records
    *
    */
    public function getTotalUserGroup() 
    {
        $sql = "SELECT COUNT(*) AS total FROM role";
        if($this->session->userdata('role_id')!=1) 
        {
            $sql .= " WHERE is_deleted = 0";
        }
        $query = $this->db->query($sql);
        return $query->row('total');
    }

    
}