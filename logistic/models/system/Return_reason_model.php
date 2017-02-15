<?php
/**
* 
* @file name   : Return_reason_model
* @Auther      : Vinay
* @Date        : 07-11-2016
* @Description : Collection of various common function related to return_reason database operation.
*
*/
class Return_reason_model extends CI_Model 
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
    * @function name : getReturnReason()
    * @description   : get return_reason record by return_reason_id
    * @access        : public
    * @param   	     : int $return_reason_id The return_reason id that you want
    * @return        : array The selected return_reason array
    *
    */
    public function getReturnReason($return_reason_id) 
	{
        $this->db->from('return_reason');
        $this->db->where('return_reason_id',(int)$return_reason_id);
        $query=$this->db->get();
        return $query->row_array();
    }
        
    /**
    * 
    * @function name : addReturnReason()
    * @description   : add return_reason record in database
    * @access        : public
    * @return        : int last inserted return_reason record id
    *
    */
    public function addReturnReason() 
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
        $this->db->set('return_reason_name', $this->input->post('return_reason_name'));
		$this->db->set('is_deleted', $is_deleted);
        $this->db->set('date_added',date('Y-m-d h:i:sa'));
        $this->db->set('added_by', $this->session->userdata('user_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('user_id'));
        $this->db->insert('return_reason');
        return $this->db->insert_id();
    }
    
    /**
    * 
    * @function name : editReturnReason()
    * @description   : edit return_reason record in database
    * @access        : public
    * @return        : void
    *
    */
    public function editReturnReason() 
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
        $this->db->set('return_reason_name', $this->input->post('return_reason_name'));
        $this->db->set('is_deleted', $is_deleted);
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('user_id'));
        $this->db->where('return_reason_id',(int)$this->input->post('return_reason_id'));
        return $this->db->update('return_reason');	
    }
	
    /**
    * 
    * @function name 	: softDeleteReturnReason()
    * @description   	: only status change not actual delete return_reason from database
    * @access 		: public
    * @param   		: int $return_reason_id The return_reason id that you want to delete
    * @return       	: void
    *
    */
    public function softDeleteReturnReason($return_reason_id) 
    {	
        $this->db->set('is_deleted',1);
        $this->db->where('return_reason_id',(int)$return_reason_id);
        return $this->db->update('return_reason');
    }
    
    /**
    * 
    * @function name 	: deleteReturnReason()
    * @description   	: delete return_reason record from database
    * @access 		: public
    * @param   		: int $return_reason_id The return_reason id that you want to delete
    * @return       	: void
    *
    */
    public function deleteReturnReason($return_reason_id) 
    {	
        $this->db->where('return_reason_id',(int)$return_reason_id);
        return $this->db->delete('return_reason');
    }
    
    /**
    * 
    * @function name 	: getReturnReasons()
    * @description   	: get all return_reason from database
    * @access 		: public
    * @param   		: string $return_reason_id The return_reason name that you want to get
    * @return       	: array The selected return_reason array
    *
    */
    public function getReturnReasons($data = array()) 
    {
	if($data)
	{
    $sql = "SELECT * FROM return_reason";

    if($this->session->userdata('role_id')!=1) 
            {
        $sql .= " WHERE is_deleted = 0";
    }

    $sql .= " ORDER BY return_reason_name";

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
		$sql = "SELECT * FROM return_reason WHERE is_deleted = 0 ORDER BY return_reason_name";
	}
    $query = $this->db->query($sql);
    return $query->result_array();
    }
    
    /**
    * 
    * @function name 	: getTotalReturnReason()
    * @description   	: get total no of return_reason from database
    * @access 		: public
    * @return       	: int total no of records
    *
    */
    public function getTotalReturnReason() 
    {
    $sql = "SELECT COUNT(*) AS total FROM return_reason";
    if($this->session->userdata('role_id')!=1) 
            {
        $sql .= " WHERE is_deleted = 0";
    }
    $query = $this->db->query($sql);
    return $query->row('total');
    }    
}