<?php

/**
 * Tzx_classes Model Class
 * Collection of various common function related to Return_Status database operation.
 *
 * @author    Mitesh
 * @license   http://www.vpninfotech.com/
 */
class Tax_classes_model extends CI_Model 
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
	public function getTaxClassesById($tax_class_id)
    {
		$this->db->from('tax_class');
		$this->db->where('tax_class_id',(int)$tax_class_id);
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
	public function addTaxClasses()
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
		
		$this->db->set('title',$this->input->post('tax_class_title'));
		$this->db->set('description',$this->input->post('description'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('user_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('user_id'));
		$this->db->insert('tax_class');
		//return $this->db->insert_id();
		$tax_class_id = $this->db->insert_id();
		
		$get_tax_rules=$this->input->post('tax_rule');
		$count_tax_rules=($get_tax_rules);
		
		if ($count_tax_rules > 0) {
			foreach ($this->input->post('tax_rule') as $tax_rule) {
				$this->db->query("INSERT INTO tax_rule SET tax_class_id = '" . (int)$tax_class_id . "', tax_rate_id = '" . (int)$tax_rule['tax_rate_id'] . "', based = '" . $tax_rule['based'] . "', priority = '" . (int)$tax_rule['priority'] . "', date_added = '".date('Y-m-d h:i:sa')."', added_by = '".$this->session->userdata('user_id')."', date_modified = '".date('Y-m-d h:i:sa')."', modified_by = '".$this->session->userdata('user_id')."'");
			}
		}
		
	}
	
	/**
	* 
	* @function name 	: editTaxClasses()
	* @description   	: edit ReturnStatus record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editTaxClasses()
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
		$tax_class_id = $this->input->post('tax_class_id');
		
		$this->db->set('title',$this->input->post('tax_class_title'));
		$this->db->set('description',$this->input->post('description'));
		$this->db->set('is_deleted',$is_deleted);		
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by', $this->session->userdata('user_id'));
		$this->db->where('tax_class_id',(int)$this->input->post('tax_class_id'));
		//return $this->db->update('tax_class');			
		$edit_tax_ack = $this->db->update('tax_class');
		
		$this->db->query("DELETE FROM tax_rule WHERE tax_class_id = '" . (int)$tax_class_id . "'");
		
		$get_tax_rules=$this->input->post('tax_rule');		
		$count_tax_rules=($get_tax_rules);
		
		if ($count_tax_rules > 0) {
			foreach ($get_tax_rules as $tax_rule) {
				$this->db->query("INSERT INTO tax_rule SET tax_class_id = '" . (int)$tax_class_id . "', tax_rate_id = '" . (int)$tax_rule['tax_rate_id'] . "', based = '" . $tax_rule['based'] . "', priority = '" . (int)$tax_rule['priority'] . "'");
			}
		}
		
		return $edit_tax_ack;
	}
	
	
	/**
	* 
	* @function name 	: softDeleteTaxClasses()
	* @description   	: only status change not actual delete ReturnStatus from database
	* @access 		 	: public
	* @param   		 	: int $return_status_id The return_status_id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteTaxClasses($tax_class_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('tax_class_id',(int)$tax_class_id);
		return $this->db->update('tax_class');
	}
	
	/**
	* 
	* @function name 	: deleteTaxClasses()
	* @description   	: delete TaxClasses record from database
	* @access 		 	: public
	* @param   		 	: int $tax_class_id The tax_class_id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteTaxClasses($tax_class_id) 
	{	
		$this->db->query("DELETE FROM tax_rule WHERE tax_class_id = '" . (int)$tax_class_id . "'");
		
		$this->db->where('tax_class_id',(int)$tax_class_id);
		return $this->db->delete('tax_class');
	} 
	
	
	/**
	* 
	* @function name 	: getTaxClasses()
	* @description   	: get all ReturnStatus from database
	* @access 		 	: public
	* @param   		 	: string $ReturnStatus The ReturnStatus code that you want to get
	* @return       	: array The selected ReturnStatus array
	*
	*/
	public function getTaxClasses($data = array())
	{
		if($data)
		{
			$sql = "SELECT * FROM tax_class";

			$sort_data = array(
				'title'
			);
			if($this->session->userdata('role_id')!=1)
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
			$sql = "SELECT * FROM tax_class WHERE is_deleted = 0 ORDER BY title";	
		}

		$query = $this->db->query($sql);
		$query->result_array();
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalTaxClasses()
	* @description   	: get total no of Tax Classes from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalTaxClasses() 
	{
		$sql = "SELECT COUNT(*) AS total FROM tax_class";
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0 ";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}	
	
	
	/**
	* 
	* @function name 	: getTaxRules()
	* @description   	: get all TaxRules from database
	* @access 		 	: public
	* @return       	: get all Tax Rules of records
	*
	*/
	public function getTaxRules($tax_class_id) {
		$query = $this->db->query("SELECT * FROM tax_rule WHERE tax_class_id = '" . (int)$tax_class_id . "'");

		return $query->result_array();
	}
	
	
	/**
	* 
	* @function name 	: getUsedTaxClasses()
	* @description   	: get total no of Tax Classes used in Product from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getUsedTaxClasses($tax_class_id) 
	{
		$sql = "SELECT COUNT(*) AS total FROM product where tax_class_id = '".$tax_class_id."'";
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0 ";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	
	/**
	* 
	* @function name 	: getTotalTaxRulesByTaxRateId()
	* @description   	: get total no of Tax RulesByTaxRateId used in Product from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalTaxRulesByTaxRateId($tax_rate_id) {
		$query = $this->db->query("SELECT COUNT(DISTINCT tax_class_id) AS total FROM tax_rule WHERE tax_rate_id = '" . (int)$tax_rate_id . "'");
		$count=$query->row_array();
		return $count['total'];
	}
	
	/**
	* 
	* @function name 	: getTotalTaxClassByTaxClassId()
	* @description   	: get total no of Tax RulesByTaxRateId used in Product from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalTaxRulesByTaxClassId($tax_class_id) {
		$query = $this->db->query("SELECT COUNT(DISTINCT tax_class_id) AS total FROM  product WHERE tax_class_id = '" . (int)$tax_class_id . "'");
		$count=$query->row_array();
		return $count['total'];
	}
}