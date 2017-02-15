<?php

/**
 * Return_actions Model Class
 * Collection of various common function related to Return_actions database operation.
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Return_actions_model extends CI_Model 
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
	* @function name 	: getReturnActions()
	* @description   	: get return_action record by return_action_id
	* @access 		 	: public
	* @param   		 	: int $return_action_id The Return_actions id that you want
	* @return       	: array The selected Return_actions array
	*
	*/
	public function getReturnActionsById($return_action_id)
    {
		$this->db->from('return_action');
		$this->db->where('return_action_id',(int)$return_action_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	
	/**
	* 
	* @function name 	: addReturnActions()
	* @description   	: add return_action record in database
	* @access 		 	: public
	* @return       	: int last inserted return_action record id
	*
	*/
	public function addReturnActions()
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
		$this->db->set('return_action_name',$this->input->post('return_action_name'));
		$this->db->set('is_deleted', $is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('user_id'));
	  	$this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('user_id'));
		$this->db->insert('return_action');
		return $this->db->insert_id();
	}
	
	/**
	* 
	* @function name 	: editReturnActions()
	* @description   	: edit return_action record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editReturnActions()
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
		$this->db->set('return_action_name',$this->input->post('return_action_name'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->where('return_action_id',(int)$this->input->post('return_action_id'));
		return $this->db->update('return_action');	
	}
	
	
	/**
	* 
	* @function name 	: softDeleteReturnActions()
	* @description   	: only status change not actual delete return_action from database
	* @access 		 	: public
	* @param   		 	: int $return_action_id The return_action id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteReturnActions($return_action_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('return_action_id',(int)$return_action_id);
		return $this->db->update('return_action');
	}
	
	/**
	* 
	* @function name 	: deleteReturnActions()
	* @description   	: delete return_action record from database
	* @access 		 	: public
	* @param   		 	: int $return_action_id The return_action id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteReturnActions($return_action_id) 
	{	
		$this->db->where('return_action_id',(int)$return_action_id);
		return $this->db->delete('return_action');
	} 

	/**
	* 
	* @function name 	: getReturnActions()
	* @description   	: get all return_action from database
	* @access 		 	: public
	* @param   		 	: string $return_status The return_action name that you want to get
	* @return       	: array The selected return_action array
	*
	*/
	public function getReturnActions($data = array())
	{
		if($data)
		{
		$sql = "SELECT * FROM return_action";

		$sort_data = array(
			'return_action_name',	
		);
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY return_action_name";
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
			$sql = "SELECT * FROM return_action WHERE is_deleted = 0 ORDER BY return_action_name";
		}
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalActions()
	* @description   	: get total no of actions from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalActions() 
	{
		$sql = "SELECT COUNT(*) AS total FROM return_action";
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
}