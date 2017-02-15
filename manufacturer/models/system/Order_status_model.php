<?php
/**
* 
* @file name   : Order_status_model
* @Auther      : Vinay
* @Date        : 07-11-2016
* @Description : Collection of various common function related to order_status database operation.
*
*/
class Order_status_model extends CI_Model 
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
    * @function name : getOrderStatus()
    * @description   : get order_status record by order_status_id
    * @access        : public
    * @param   	     : int $order_status_id The order_status id that you want
    * @return        : array The selected order_status array
    *
    */
    public function getOrderStatus($order_status_id) 
	{
        $this->db->from('order_status');
        $this->db->where('order_status_id',(int)$order_status_id);
        $query=$this->db->get();
        return $query->row_array();
    }
        
    /**
    * 
    * @function name : addOrderStatus()
    * @description   : add order_status record in database
    * @access        : public
    * @return        : int last inserted order_status record id
    *
    */
    public function addOrderStatus() 
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
        $this->db->set('order_status_name', $this->input->post('order_status_name'));
		$this->db->set('is_deleted', $is_deleted);
        $this->db->set('date_added',date('Y-m-d h:i:sa'));
        $this->db->set('added_by', $this->session->userdata('user_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('user_id'));
        $this->db->insert('order_status');
        return $this->db->insert_id();
    }
    
    /**
    * 
    * @function name : editOrderStatus()
    * @description   : edit order_status record in database
    * @access        : public
    * @return        : void
    *
    */
    public function editOrderStatus() 
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
        $this->db->set('order_status_name', $this->input->post('order_status_name'));
        $this->db->set('is_deleted', $is_deleted);
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('user_id'));
        $this->db->where('order_status_id',(int)$this->input->post('order_status_id'));
        return $this->db->update('order_status');	
    }
	
    /**
    * 
    * @function name 	: softDeleteOrderStatus()
    * @description   	: only status change not actual delete order_status from database
    * @access 		: public
    * @param   		: int $order_status_id The order_status id that you want to delete
    * @return       	: void
    *
    */
    public function softDeleteOrderStatus($order_status_id) 
    {	
        $this->db->set('is_deleted',1);
        $this->db->where('order_status_id',(int)$order_status_id);
        return $this->db->update('order_status');
    }
    
    /**
    * 
    * @function name 	: deleteOrderStatus()
    * @description   	: delete order_status record from database
    * @access 		: public
    * @param   		: int $order_status_id The order_status id that you want to delete
    * @return       	: void
    *
    */
    public function deleteOrderStatus($order_status_id) 
    {	
        $this->db->where('order_status_id',(int)$order_status_id);
        return $this->db->delete('order_status');
    }
    
    /**
    * 
    * @function name 	: getOrderStatuses()
    * @description   	: get all order_status from database
    * @access 		: public
    * @param   		: string $order_status_id The order_status name that you want to get
    * @return       	: array The selected order_status array
    *
    */
    public function getOrderStatuses($data = array()) 
    {
        if($data)
        {
            $sql = "SELECT * FROM order_status";

            if($this->session->userdata('role_id')!=1) 
                    {
                $sql .= " WHERE is_deleted = 0";
            }

            $sql .= " ORDER BY order_status_name";

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
        }
        else
        {
             $sql = "SELECT * FROM order_status WHERE is_deleted = 0 ORDER BY order_status_name";    
        }
        $query = $this->db->query($sql);
        $query->result_array();
        return $query->result_array();
    }
    
    /**
    * 
    * @function name 	: getTotalOrderStatus()
    * @description   	: get total no of order_status from database
    * @access 		: public
    * @return       	: int total no of records
    *
    */
    public function getTotalOrderStatus() 
    {
    $sql = "SELECT COUNT(*) AS total FROM order_status";
    if($this->session->userdata('role_id')!=1) 
            {
        $sql .= " WHERE is_deleted = 0";
    }
    $query = $this->db->query($sql);
    return $query->row('total');
    }    
}