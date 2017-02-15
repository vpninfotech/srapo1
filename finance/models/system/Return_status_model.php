
<?php

/**
 * Return_Status Model Class
 * Collection of various common function related to Return_Status database operation.
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Return_status_model extends CI_Model 
{
	/**
	* 
	* @function name 	: __construct()
	* @description   	: initialize variables
	* @param   		 	: void
	* @return        	: void
	*
	*/
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	* 
	* @function name 	: ReturnStatus()
	* @description   	: get Return_Status record by return_status_id
	* @access 		 	: public
	* @param   		 	: int $return_status_id The return_status_id  that you want
	* @return       	: array The selected Return_Status array
	*
	*/
	public function getReturnStatusById($return_status_id)
    {
		$this->db->from('return_status');
		$this->db->where('return_status_id',(int)$return_status_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	
	/**
	* 
	* @function name 	: addReturnStatus()
	* @description   	: add ReturnStatus record in database
	* @access 		 	: public
	* @return       	: int last inserted ReturnStatus record id
	*
	*/
	public function addReturnStatus()
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
		$this->db->set('return_status_name',$this->input->post('return_status_name'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('user_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('user_id'));
		$this->db->insert('return_status');
		return $this->db->insert_id();
	}
	
	/**
	* 
	* @function name 	: editReturnStatus()
	* @description   	: edit ReturnStatus record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editReturnStatus()
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
		$this->db->set('return_status_name',$this->input->post('return_status_name'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));
		$this->db->where('return_status_id',(int)$this->input->post('return_status_id'));
		return $this->db->update('return_status');	
	}
	
	
	/**
	* 
	* @function name 	: softDeleteReturnStatus()
	* @description   	: only status change not actual delete ReturnStatus from database
	* @access 		 	: public
	* @param   		 	: int $return_status_id The return_status_id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteReturnStatus($return_status_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('return_status_id',(int)$return_status_id);
		return $this->db->update('return_status');
	}
	
	/**
	* 
	* @function name 	: deleteReturnStatus()
	* @description   	: delete ReturnStatus record from database
	* @access 		 	: public
	* @param   		 	: int $return_status_id The return_status_id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteReturnStatus($return_status_id) 
	{	
		$this->db->where('return_status_id',(int)$return_status_id);
		return $this->db->delete('return_status');
	} 
	
	/**
	* 
	* @function name 	: getReturnStatus()
	* @description   	: get all ReturnStatus from database
	* @access 		 	: public
	* @param   		 	: string $ReturnStatus The ReturnStatus code that you want to get
	* @return       	: array The selected ReturnStatus array
	*
	*/
	public function getReturnStatuses($data = array())
	{
		if($data)
		{
			$sql = "SELECT * FROM return_status";

			$sort_data = array(
				'return_status_name'
			);
			if($this->session->userdata('role_id')!=1)
			{
				$sql .= " WHERE is_deleted = 0";
			}
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY return_status_name";
			}

			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}

			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}

				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}	
		}
		else
		{
			$sql = "SELECT * FROM return_status WHERE is_deleted = 0 ORDER BY return_status_name";	
		}

		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalReturnStatus()
	* @description   	: get total no of ReturnStatus from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalReturnStatus() 
	{
		$sql = "SELECT COUNT(*) AS total FROM return_status";
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0 ";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	
}