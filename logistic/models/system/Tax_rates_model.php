<?php

/**
 * Tzx_classes Model Class
 * Collection of various common function related to Return_Status database operation.
 *
 * @author    Mitesh
 * @license   http://www.vpninfotech.com/
 */
class Tax_rates_model extends CI_Model 
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
	public function getTaxRatesById($tax_class_id)
    {
		$this->db->from('tax_rate');
		$this->db->where('tax_rate_id',(int)$tax_class_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	
	/**
	* 
	* @function name 	: addTaxClasses()
	* @description   	: add TaxClasses record in database
	* @access 		 	: public
	* @return       	: int last inserted TaxClasses record id
	*
	*/
	public function addTaxRates()
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
		
		$this->db->set('name',$this->input->post('tax_name'));
		$this->db->set('rate',$this->input->post('tax_rate'));
		$this->db->set('type',$this->input->post('type'));
		$this->db->set('country_id',$this->input->post('country'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('user_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('user_id'));
		$this->db->insert('tax_rate');
		return $this->db->insert_id();
		
		/*if (isset($data['tax_rate_customer_group'])) {
			foreach ($data['tax_rate_customer_group'] as $customer_group_id) {
				$this->db->query("INSERT INTO tax_rate_to_customer_group SET tax_rate_id = '" . (int)$tax_rate_id . "', customer_group_id = '" . (int)$customer_group_id . "'");				
			}
		}*/
		
	}
	
	/**
	* 
	* @function name 	: editTaxRates()
	* @description   	: edit TaxRates record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editTaxRates()
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
		
		$this->db->set('name',$this->input->post('tax_name'));
		$this->db->set('rate',$this->input->post('tax_rate'));
		$this->db->set('type',$this->input->post('type'));
		$this->db->set('country_id',$this->input->post('country'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('user_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('user_id'));
		$this->db->where('tax_rate_id',(int)$this->input->post('tax_rate_id'));
		return $this->db->update('tax_rate');
		
	}
	
	
	/**
	* 
	* @function name 	: softDeleteTaxRates()
	* @description   	: only status change not actual delete TaxRates from database
	* @access 		 	: public
	* @param   		 	: int $tax_rate_id The tax_rate_id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteTaxRates($tax_rate_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('tax_rate_id',(int)$tax_rate_id);
		return $this->db->update('tax_rate');
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
	public function deleteTaxRates($tax_rate_id) 
	{	
		$this->db->where('tax_rate_id',(int)$tax_rate_id);
		return $this->db->delete('tax_rate');
	} 
	
	/**
	* 
	* @function name 	: getTaxRates()
	* @description   	: get all TaxRates from database
	* @access 		 	: public
	* @param   		 	: string $TaxRates The TaxRates code that you want to get
	* @return       	: array The selected TaxRates array
	*
	*/
	public function getTaxRates($data = array())
	{
		/*echo "<pre>";
		print_r($data);
		echo "</pre>";
		exit;*/
		if($data)
		{
			$sql = "SELECT * FROM tax_rate";

			$sort_data = array(
				'name'
			);
			if($this->session->userdata('role_id')!=1)
			{
				$sql .= " WHERE is_deleted = 0";
			}
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY name";
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
			$sql = "SELECT * FROM tax_rate WHERE is_deleted = 0 ORDER BY name";	
		}

		$query = $this->db->query($sql);
		/*echo $this->db->last_query();
		exit;*/
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalTaxRates()
	* @description   	: get total no of Tax Rates from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalTaxRates() 
	{
		$sql = "SELECT COUNT(*) AS total FROM tax_rate";
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0 ";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	
	/**
	* 
	* @function name 	: getUsedTaxRates()
	* @description   	: get total no of Tax Rates used in Tax Classes from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getUsedTaxRates($tax_rate_id) 
	{
		$sql = "SELECT COUNT(*) AS total FROM tax_rule";
		if($this->session->userdata('role_id')!=1 && $tax_rate_id > 0)
		{
			$sql .= " WHERE is_deleted = 0 and tax_rate_id = $tax_rate_id";
		}
		else
		{
			$sql .= " WHERE is_deleted = 0 ";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	
	/**
	* get value from tax_rate_to_customer_group table
	*/
	/*public function getTaxRateCustomerGroups($tax_rate_id) {
		$tax_customer_group_data = array();

		$query = $this->db->query("SELECT * FROM tax_rate_to_customer_group WHERE tax_rate_id = '" . (int)$tax_rate_id . "'");

		foreach ($query->rows as $result) {
			$tax_customer_group_data[] = $result['customer_group_id'];
		}

		return $tax_customer_group_data;
	}*/
	
}