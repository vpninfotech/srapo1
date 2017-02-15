<?php
/**
* 
* @file name   : Stock_status_model
* @Auther      : RITESH
* @Date        : 05-12-2016
* @Description : Collection of various common function related to stock_status database operation.
*
*/
class Stock_status_model extends CI_Model 
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
    * @function name : getStockStatus()
    * @description   : get stock_status record by stock_status_id
    * @access        : public
    * @param   	     : int $stock_status_id The stock_status id that you want
    * @return        : array The selected stock_status array
    *
    */
    public function getStockStatus($stock_status_id) 
	{
        $this->db->from('stock_status');
        $this->db->where('stock_status_id',(int)$stock_status_id);
        $query=$this->db->get();
        return $query->row_array();
    }
        
    /**
    * 
    * @function name : addStockStatus()
    * @description   : add stock_status record in database
    * @access        : public
    * @return        : int last inserted stock_status record id
    *
    */
    public function addStockStatus() 
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
        $this->db->set('stock_status_name', $this->input->post('stock_status_name'));
		$this->db->set('is_deleted', $is_deleted);
        $this->db->set('date_added',date('Y-m-d h:i:sa'));
        $this->db->set('added_by', $this->session->userdata('Muser_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('Muser_id'));
        $this->db->insert('stock_status');
        return $this->db->insert_id();
    }
    
    /**
    * 
    * @function name : editStockStatus()
    * @description   : edit stock_status record in database
    * @access        : public
    * @return        : void
    *
    */
    public function editStockStatus() 
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
        $this->db->set('stock_status_name', $this->input->post('stock_status_name'));
		$this->db->set('is_deleted', $is_deleted);
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('Muser_id'));
        $this->db->where('stock_status_id',(int)$this->input->post('stock_status_id'));
        return $this->db->update('stock_status');	
    }
	
    /**
    * 
    * @function name 	: softDeleteStockStatus()
    * @description   	: only status change not actual delete stock_status from database
    * @access 			: public
    * @param   			: int $stock_status_id The stock_status id that you want to delete
    * @return       	: void
    *
    */
    public function softDeleteStockStatus($stock_status_id) 
	{	
        $this->db->set('is_deleted',1);
        $this->db->where('stock_status_id',(int)$stock_status_id);
        return $this->db->update('stock_status');
    }
    
    /**
    * 
    * @function name 	: deleteStockStatus()
    * @description   	: delete stock_status record from database
    * @access 			: public
    * @param   			: int $stock_status_id The stock_status id that you want to   	delete
    * @return       	: void
    *
    */
    public function deleteStockStatus($stock_status_id) 
	{	
        $this->db->where('stock_status_id',(int)$stock_status_id);
        return $this->db->delete('stock_status');
    }
    
    /**
    * 
    * @function name 	: getStockStatuses()
    * @description   	: get all stock_status from database
    * @access 			: public
    * @param   			: string $stock_status_id The stock_status name that you want to get
    * @return       	: array The selected stock_status array
    *
    */
    public function getStockStatuses($data = array()) 
	{
        $sql = "SELECT * FROM stock_status";
        
        if($this->session->userdata('Mrole_id')!=1) 
		{
            $sql .= " WHERE is_deleted = 0";
        }
        
        $sql .= " ORDER BY stock_status_name";

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
    * @function name 	: getTotalStockStatus()
    * @description   	: get total no of stock_status from database
    * @access 		: public
    * @return       	: int total no of records
    *
    */
    public function getTotalStockStatus() 
	{
        $sql = "SELECT COUNT(*) AS total FROM stock_status";
        if($this->session->userdata('Mrole_id')!=1) 
		{
            $sql .= " WHERE is_deleted = 0";
        }
        $query = $this->db->query($sql);
        return $query->row('total');
    }

    
}