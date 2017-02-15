<?php

/**
 * Information Model Class
 * Collection of various common function related to information database operation.
 *
 * @author    Mitesh
 * @license   http://www.vpninfotech.com/
 */
class Attributes_groups_model extends CI_Model 
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
	* @function name 	: getAttributeGroup()
	* @description   	: get attribute group record by information_id
	* @access 		 	: public
	* @param   		 	: int $attribute_group_id The attribute group id that you want
	* @return       	: array The selected attribute group array
	*
	*/
	public function getAttributeGroup($attribute_group_id)
        {
		$this->db->from('attribute_group');
		$this->db->where('attribute_group_id',(int)$attribute_group_id);
		$query=$this->db->get();
		return $query->row_array();
        }
        
        /**
        * 
        * @function name : getAttributrGroupByName()
        * @description   : get attribute group record by email_id
        * @access        : public
        * @param   	 : $attribute_group_name The attribute group name that you want
        * @return        : array The selected ttribute group name array
        *
        */
        public function getAttributrGroupByName($attribute_group_name) 
        {
            $this->db->from('attribute_group');
            $this->db->where('attribute_group_name',$attribute_group_name);
            $query=$this->db->get();
            return $query->row_array();
        }
	
	/**
	* 
	* @function name 	: addAttributesGroups()
	* @description   	: add Attributes Groups record in database
	* @access 		 	: public
	* @return       	: int last inserted Attributes Groups record id
	*
	*/
	public function addAttributesGroups()
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
		
		
		$this->db->set('attribute_group_name',$this->input->post('attribute_group_name'));	
		$this->db->set('sort_order',$this->input->post('sort_order'));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('user_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));
		$this->db->insert('attribute_group');
		return $this->db->insert_id();
	}
	
	/**
	* 
	* @function name 	: editAttributesGroups()
	* @description   	: edit attributes groups record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editAttributesGroups()
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
		
		$this->db->set('attribute_group_name',$this->input->post('attribute_group_name'));	
		$this->db->set('sort_order',$this->input->post('sort_order'));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));
		$this->db->where('attribute_group_id',(int)$this->input->post('attribute_group_id'));
		return $this->db->update('attribute_group');	
	}
	
	
	/**
	* 
	* @function name 	: softDeleteAttributesGroups()
	* @description   	: only status change not actual delete attributes groups from database
	* @access 		 	: public
	* @param   		 	: int $attribute_group_id The attribute group id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteAttributesGroups($attribute_group_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('attribute_group_id',(int)$attribute_group_id);
		return $this->db->update('attribute_group');
	}
	
	/**
	* 
	* @function name 	: deleteAttributesGroups()
	* @description   	: delete attribute group record from database
	* @access 		 	: public
	* @param   		 	: int $attribute_group_id The attribute group id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteAttributesGroups($attribute_group) 
	{	
		$this->db->where('attribute_group_id',(int)$attribute_group);
		return $this->db->delete('attribute_group');
	} 
	
	/**
	* 
	* @function name 	: getAttributesGroupsByCode()
	* @description   	: get attribute group record by attribute group code
	* @access 		 	: public
	* @param   		 	: string $attribute_group The attribute group code that you want to get
	* @return       	: array The selected attribute group array
	*
	*/
	public function getAttributesGroupsByCode($attribute_group) 
	{
		$this->db->where('code',$attribute_group);
		$query=$this->db->get();
		return $query->row_array();
	}
	
	/**
	* 
	* @function name 	: getAttributesGroups()
	* @description   	: get all attributes groups from database
	* @access 		 	: public
	* @param   		 	: string $information The attributes groups that you want to get
	* @return       	: array The selected information array
	*
	*/
	public function getAttributesGroups($data = array())
	{
		$sql = "SELECT * FROM attribute_group";

		$sort_data = array(
			'attribute_group_name',
			'sort_order'			
		);
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY attribute_group_name";
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
	
	/**
	* 
	* @function name 	: getTotalAttributesGroups()
	* @description   	: get total no of attribute group from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalAttributesGroups() 
	{
		$sql = "SELECT COUNT(*) AS total FROM attribute_group";
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	
	/**
	* 
	* @function name 	: getAttributeGroupbyid()
	* @description   	: get attribute group record by attribute_group_id
	* @access 		 	: public
	* @param   		 	: int $attribute_group_id The attribute group id that you want
	* @return       	: array The selected attribute group array
	*
	*/
	public function getAttributeGroupbyid($attribute_group_id)
    {
		$this->db->select('attribute_group_name');
		$this->db->from('attribute_group');
		$this->db->where('attribute_group_id',(int)$attribute_group_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	
	/**
	* 
	* @function name 	: getAllAttributeGroup()
	* @description   	: get list of attribute group name and attribute group id
	* @access 		 	: public	* 
	* @return       	: array The selected attribute group name array
	*
	*/
	public function getAllAttributeGroup()
        {
            $this->db->select('attribute_group_id,attribute_group_name');
            $this->db->from('attribute_group');	
            $this->db->where('is_deleted=0');
            $query=$this->db->get();
            return $query->result_array();
        }
	
}