<?php

/**
 * Zone Model Class
 * Collection of various common function related to state database operation.
 *
 * @author    Mitesh
 * @license   http://www.vpninfotech.com/
 */
class Zone_model extends CI_Model 
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
	* @function name 	: getZone()
	* @description   	: get Zone record by zone_id
	* @access 		 	: public
	* @param   		 	: int $zone_id The zone id that you want
	* @return       	: array The selected zone array
	*
	*/
	public function getZone($state_id)
    {
		$this->db->from('state');
		$this->db->where('state_id',(int)$state_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	
	/**
	* 
	* @function name 	: addZone()
	* @description   	: add zone record in database
	* @access 		 	: public
	* @return       	: int last inserted zone record id
	*
	*/
	public function addZone()
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
		// echo "<pre>";
		// print_r($this->input->post());
		// exit;
		$this->db->set('state_name',ucfirst($this->input->post('zone_name')));
		$this->db->set('state_code',strtoupper($this->input->post('zone_code')));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('country_id',$this->input->post('country_id'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('user_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('user_id'));
		$this->db->insert('state');
		return $this->db->insert_id();
	}
	
	/**
	* 
	* @function name 	: editZone()
	* @description   	: edit zone record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editZone()
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

		$this->db->set('state_name',ucfirst($this->input->post('zone_name')));
		$this->db->set('state_code',strtoupper($this->input->post('zone_code')));
		$this->db->set('status',$this->input->post('status'));		
		$this->db->set('country_id',$this->input->post('country_id'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));
		$this->db->where('state_id',(int)$this->input->post('state_id'));
		return $this->db->update('state');	
	}
	
	
	/**
	* 
	* @function name 	: softDeleteZone()
	* @description   	: only status change not actual delete state from database
	* @access 		 	: public
	* @param   		 	: int $state_id The state id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteZone($state_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('state_id',(int)$state_id);
		return $this->db->update('state');
	}
	
	/**
	* 
	* @function name 	: deleteCountry()
	* @description   	: delete state record from database
	* @access 		 	: public
	* @param   		 	: int $state_id The state id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteZone($state_id) 
	{	
		$this->db->where('state_id',(int)$state_id);
		return $this->db->delete('state');
	} 
	
	/**
	* 
	* @function name 	: getZoneByCountryId()
	* @description   	: get state records by country Id
	* @access 		 	: public
	* @param   		 	: string $country_id The country_id that you want to get
	* @return       	: array The selected state array
	*
	*/
	public function getZoneByCountryId($country_id) 
	{
		$this->db->from('state');
		$this->db->where('country_id',$country_id);
		$query=$this->db->get();
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getZones()
	* @description   	: get all zones from database
	* @access 		 	: public
	* @param   		 	: string $state The state code that you want to get
	* @return       	: array The selected state array
	*
	*/
	public function getZones($data = array())
	{
		if($data)
		{
			$sql = "SELECT s.*,c.*,s.is_deleted as is_deleted FROM state s join country c on s.country_id=c.country_id";

			$sort_data = array(
				'state_name',
				'state_code',
                                'country_name'
			);
			if($this->session->userdata('role_id')!=1)
			{
				$sql .= " WHERE s.is_deleted = 0";
			}
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY s.state_name";
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
			$sql = "SELECT s.*,c.* FROM state s join country c on s.country_id=c.country_id WHERE s.is_deleted = 0 ORDER BY state_name ASC";
		}

		$query = $this->db->query($sql);
		$query->result_array();
                //echo $this->db->last_query();
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalZones()
	* @description   	: get total no of countries from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalZones() 
	{
		$sql = "SELECT COUNT(*) AS total FROM state";
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	
	
	
	/**
    * 
    * @function name : getTotalZonesByCountryId()
    * @description   : get zone record by $country_id
    * @access        : public
    * @param   	     : int $country_id
    * @return        : int total no of records
    *
    */
    public function getTotalZonesByCountryId($country_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM state WHERE country_id = '" . (int)$country_id . "'");
        return $query->row('total');
    }
	
}