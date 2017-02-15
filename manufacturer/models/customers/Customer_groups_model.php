<?php
/**
* 
* @file name   : Customer_groups_model
* @Auther      : Vinay
* @Date        : 10-11-2016
* @Description : Collection of various common function related to customer_group database operation.
*
*/
class Customer_groups_model extends CI_Model 
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
    * @function name : getCustomerGroup()
    * @description   : get customer_group record by customer_group_id
    * @access        : public
    * @param   	     : int $customer_group_id The customer_group id that you want
    * @return        : array The selected customer_group array
    *
    */
    public function getCustomerGroup($customer_group_id) 
    {
        $this->db->from('customer_group');
        $this->db->where('customer_group_id',(int)$customer_group_id);
        $query=$this->db->get();
        return $query->row_array();
    }
        
    /**
    * 
    * @function name : addCustomerGroup()
    * @description   : add customer_group record in database
    * @access        : public
    * @return        : int last inserted customer_group record id
    *
    */
    public function addCustomerGroup() 
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
        $this->db->set('group_name', $this->input->post('group_name'));
        $this->db->set('group_description', $this->input->post('group_description'));
        $this->db->set('approval', $this->input->post('approve_customer'));
        $this->db->set('sort_order', $this->input->post('sort_order'));
        $this->db->set('date_added',date('Y-m-d h:i:sa'));
        $this->db->set('added_by', $this->session->userdata('Muser_id'));
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('Muser_id'));
        $this->db->set('is_deleted', $is_deleted);
        $this->db->insert('customer_group');
        return $this->db->insert_id();
    }
    
    /**
    * 
    * @function name : editCustomerGroup()
    * @description   : edit customer_group record in database
    * @access        : public
    * @return        : void
    *
    */
    public function editCustomerGroup() 
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
        $this->db->set('group_name', $this->input->post('group_name'));
        $this->db->set('group_description', $this->input->post('group_description'));
        $this->db->set('approval', $this->input->post('approve_customer'));
        $this->db->set('sort_order', $this->input->post('sort_order'));
        $this->db->set('is_deleted', $is_deleted);
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('Muser_id'));
        $this->db->where('customer_group_id',(int)$this->input->post('customer_group_id'));
        return $this->db->update('customer_group');	
    }
	
    /**
    * 
    * @function name 	: softDeleteCustomerGroup()
    * @description   	: only status change not actual delete customer_group from database
    * @access 		: public
    * @param   		: int $customer_group_id The customer_group id that you want to delete
    * @return       	: void
    *
    */
    public function softDeleteCustomerGroup($customer_group_id) 
    {	
        $this->db->set('is_deleted',1);
        $this->db->where('customer_group_id',(int)$customer_group_id);
        return $this->db->update('customer_group');
    }
    
    /**
    * 
    * @function name 	: deleteCustomerGroup()
    * @description   	: delete customer_group record from database
    * @access 		: public
    * @param   		: int $customer_group_id The customer_group id that you want to delete
    * @return       	: void
    *
    */
    public function deleteCustomerGroup($customer_group_id) 
    {	
        $this->db->where('customer_group_id',(int)$customer_group_id);
        return $this->db->delete('customer_group');
    }
    
    /**
    * 
    * @function name 	: getCustomerGroups()
    * @description   	: get all customer_group from database
    * @access 		: public
    * @param   		: string $customer_group_id The customer_group name that you want to get
    * @return       	: array The selected customer_group array
    *
    */
    public function getCustomerGroups($data = array()) 
    {
		
        $sql = "SELECT * FROM customer_group";

        if($this->session->userdata('Mrole_id')!=1) 
        {
            $sql .= " WHERE is_deleted = 0";
        }

        $sql .= " ORDER BY group_name";

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
    * @function name 	: getTotalCustomerGroup()
    * @description   	: get total no of customer_group from database
    * @access 		: public
    * @return       	: int total no of records
    *
    */
    public function getTotalCustomerGroup() 
    {
        $sql = "SELECT COUNT(*) AS total FROM customer_group";
        if($this->session->userdata('Mrole_id')!=1) 
        {
            $sql .= " WHERE is_deleted = 0";
        }
        $query = $this->db->query($sql);
        return $query->row('total');
    }

    
}