<?php

/**
 * Weight Model Class
 * Collection of various common function related to weight database operation.
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Weight_model extends CI_Model 
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
	* @function name 	: getWeight()
	* @description   	: get weight record by weight_id
	* @access 		 	: public
	* @param   		 	: int $weight_id The weight id that you want
	* @return       	: array The selected weight array
	*
	*/
	public function getWeight($weight_id)
    {
		$this->db->from('weight');
		$this->db->where('weight_id',(int)$weight_id);
		$query=$this->db->get();
		return $query->row_array();
    }
    
	/**
	* 
	* @function name 	: addWeight()
	* @description   	: add weight record in database
	* @access 		 	: public
	* @return       	: int last inserted weight record id
	*
	*/
	public function addWeight()
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
		$this->db->insert('weight');
		
		
		// Run weight update
		if ($this->common->config('config_weight_auto')) {
			$this->refresh(true);
		}
		return $this->db->insert_id();
	}
	
	/**
	* 
	* @function name 	: editWeight()
	* @description   	: edit weight record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editWeight()
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
		$this->db->where('weight_id',(int)$this->input->post('weight_id'));
		return $this->db->update('weight');	
	}
	
	
	/**
	* 
	* @function name 	: softDeleteWeight()
	* @description   	: only status change not actual delete weight from database
	* @access 		 	: public
	* @param   		 	: int $weight_id The weight id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteWeight($weight_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('weight_id',(int)$weight_id);
		return $this->db->update('weight');
	}
	
	/**
	* 
	* @function name 	: deleteWeight()
	* @description   	: delete weight record from database
	* @access 		 	: public
	* @param   		 	: int $weight_id The weight id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteWeight($weight_id) 
	{	
		$this->db->where('weight_id',(int)$weight_id);
		return $this->db->delete('weight');
	} 
	
	/**
	* 
	* @function name 	: getWeightByCode()
	* @description   	: get weight record by weightunit
	* @access 		 	: public
	* @param   		 	: string $weight The weight unit that you want to get
	* @return       	: array The selected weight array
	*
	*/
	public function getWeightByCode($weight) 
	{
		$this->db->where('unit',$weight);
		$this->db->from('weight');
		$query=$this->db->get();
		return $query->row_array();
	}
	
	/**
	* 
	* @function name 	: getWeightClasses()
	* @description   	: get all currencies from database
	* @access 		 	: public
	* @param   		 	: string $weight The weight unit that you want to get
	* @return       	: array The selected weight array
	*
	*/
	public function getWeightClasses($data = array())
	{
		if($data)
		{

			$sql = "SELECT * FROM weight";

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
			$sql = "SELECT * FROM weight WHERE is_deleted = 0 ORDER BY title ASC";
		}
		$query = $this->db->query($sql);
		$query->result_array();
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalWeightClasses()
	* @description   	: get total no of currencies from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalWeightClasses() 
	{
		$sql = "SELECT COUNT(*) AS total FROM weight";
		if($this->session->userdata('Drole_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
}