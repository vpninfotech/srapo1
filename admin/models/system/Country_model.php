<?php

/**
 * Country Model Class
 * Collection of various common function related to country database operation.
 *
 * @author    Mitesh
 * @license   http://www.vpninfotech.com/
 */
class Country_model extends CI_Model 
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
	* @function name 	: getCountry()
	* @description   	: get country record by currency_id
	* @access 		 	: public
	* @param   		 	: int $country_id The country id that you want
	* @return       	: array The selected country array
	*
	*/
	public function getCountry($country_id)
    {
		$this->db->from('country');
		$this->db->where('country_id',(int)$country_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	
	/**
	* 
	* @function name 	: addCountry()
	* @description   	: add country record in database
	* @access 		 	: public
	* @return       	: int last inserted country record id
	*
	*/
	public function addCountry()
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
		$this->db->set('country_name',ucfirst($this->input->post('country_name')));
                $this->db->set('iso_code_2',strtoupper($this->input->post('iso_code_2')));
		$this->db->set('iso_code',strtoupper($this->input->post('iso_code')));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('user_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
                $this->db->set('modified_by', $this->session->userdata('user_id'));
		$this->db->insert('country');
		return $this->db->insert_id();
	}
	
	/**
	* 
	* @function name 	: editCountry()
	* @description   	: edit country record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editCountry()
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
		
		$this->db->set('country_name',$this->input->post('country_name'));
                $this->db->set('iso_code_2',strtoupper($this->input->post('iso_code_2')));
		$this->db->set('iso_code',$this->input->post('iso_code'));		
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));
		$this->db->where('country_id',(int)$this->input->post('country_id'));
		return $this->db->update('country');	
	}
	
	
	/**
	* 
	* @function name 	: softDeleteCountry()
	* @description   	: only status change not actual delete country from database
	* @access 		 	: public
	* @param   		 	: int $country_id The country id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteCountry($country_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('country_id',(int)$country_id);
		return $this->db->update('country');
	}
	
	/**
	* 
	* @function name 	: deleteCountry()
	* @description   	: delete country record from database
	* @access 		 	: public
	* @param   		 	: int $country_id The country id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteCountry($country_id) 
	{	
		$this->db->where('country_id',(int)$country_id);
		return $this->db->delete('country');
	} 
	
	/**
	* 
	* @function name 	: getCountries()
	* @description   	: get all countries from database
	* @access 		 	: public
	* @param   		 	: string $country The country code that you want to get
	* @return       	: array The selected country array
	*
	*/
	public function getCountries($data = array())
	{
		if($data) {
			$sql = "SELECT * FROM country WHERE 1=1";
	
			$sort_data = array(
				'country_name',
                                'iso_code_2',
				'iso_code'			
			);
			if($this->session->userdata('role_id')!=1)
			{
				$sql .= " AND is_deleted = 0";
			}
                        if (isset($data['filter_name'])) {
				$sql .= " AND country_name like '%" . $data['filter_name']."%'";
			} 
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY country_name";
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
	
			$query = $this->db->query($sql);
			$query->result_array();
			return $query->result_array();
		}
		else
		{
			$sql = "SELECT * FROM country WHERE is_deleted = 0 ORDER BY country_name ASC";
			$query = $this->db->query($sql);
			$query->result_array();
			return $query->result_array();
		}
	}
	
	/**
	* 
	* @function name 	: getTotalCountries()
	* @description   	: get total no of countries from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalCountries() 
	{
		$sql = "SELECT COUNT(*) AS total FROM country";
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	
	
	
}