<?php

/**
 * Length Model Class
 * Collection of various common function related to length database operation.
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Length_model extends CI_Model 
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
	* @function name 	: getLength()
	* @description   	: get length record by length_id
	* @access 		 	: public
	* @param   		 	: int $length_id The length id that you want
	* @return       	: array The selected length array
	*
	*/
	public function getLength($length_id)
    {
		$this->db->from('length');
		$this->db->where('length_id',(int)$length_id);
		$query=$this->db->get();
		return $query->row_array();
    }
    
	/**
	* 
	* @function name 	: addLength()
	* @description   	: add length record in database
	* @access 		 	: public
	* @return       	: int last inserted length record id
	*
	*/
	public function addLength()
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
		$this->db->set('title',$this->input->post('title'));
		$this->db->set('unit',strtoupper($this->input->post('unit')));
		$this->db->set('value',$this->input->post('value'));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('Duser_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
                $this->db->set('modified_by', $this->session->userdata('Duser_id'));
		$this->db->insert('length');
		
		
		// Run length update
		if ($this->common->config('config_length_auto')) {
			$this->refresh(true);
		}
		return $this->db->insert_id();
	}
	
	/**
	* 
	* @function name 	: editLength()
	* @description   	: edit length record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editLength()
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
		$this->db->set('title',$this->input->post('title'));
		$this->db->set('unit',strtoupper($this->input->post('unit')));
		$this->db->set('value',$this->input->post('value'));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('Duser_id'));
		$this->db->where('length_id',(int)$this->input->post('length_id'));
		return $this->db->update('length');	
	}
	
	
	/**
	* 
	* @function name 	: softDeleteLength()
	* @description   	: only status change not actual delete length from database
	* @access 		 	: public
	* @param   		 	: int $length_id The length id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteLength($length_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('length_id',(int)$length_id);
		return $this->db->update('length');
	}
	
	/**
	* 
	* @function name 	: deleteLength()
	* @description   	: delete length record from database
	* @access 		 	: public
	* @param   		 	: int $length_id The length id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteLength($length_id) 
	{	
		$this->db->where('length_id',(int)$length_id);
		return $this->db->delete('length');
	} 
	
	/**
	* 
	* @function name 	: getLengthByCode()
	* @description   	: get length record by lengthunit
	* @access 		 	: public
	* @param   		 	: string $length The length unit that you want to get
	* @return       	: array The selected length array
	*
	*/
	public function getLengthByCode($length) 
	{
		$this->db->where('unit',$length);
		$this->db->from('length');
		$query=$this->db->get();
		return $query->row_array();
	}
	
	/**
	* 
	* @function name 	: getLengthClasses()
	* @description   	: get all currencies from database
	* @access 		 	: public
	* @param   		 	: string $length The length unit that you want to get
	* @return       	: array The selected length array
	*
	*/
	public function getLengthClasses($data = array())
	{
		if($data)
		{

			$sql = "SELECT * FROM length";

			$sort_data = array(
				'title',
				'unit',
				'value',
				'date_modified'
			);
			if($this->session->userdata('Drole_id')!=1)
			{
				$sql .= " WHERE is_deleted = 0";
			}
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY title";
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
			$sql = "SELECT * FROM length WHERE is_deleted = 0 ORDER BY title ASC";
		}
		$query = $this->db->query($sql);
		$query->result_array();
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalLengthClasses()
	* @description   	: get total no of currencies from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalLengthClasses() 
	{
		$sql = "SELECT COUNT(*) AS total FROM length";
		if($this->session->userdata('Drole_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
}