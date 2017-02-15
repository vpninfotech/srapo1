<?php

/**
 * Information Model Class
 * Collection of various common function related to information database operation.
 *
 * @author    Mitesh
 * @license   http://www.vpninfotech.com/
 */
class Attributes_model extends CI_Model 
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
	* @function name 	: getAttribute()
	* @description   	: get attribute group record by attribute_id
	* @access 		 	: public
	* @param   		 	: int $attribute_id The attribute id that you want
	* @return       	: array The selected attribute array
	*
	*/
	public function getAttribute($attribute_id)
        {
		$this->db->from('attribute');
		$this->db->where('attribute_id',(int)$attribute_id);
		$query=$this->db->get();
		return $query->row_array();
        }
        
        /**
        * 
        * @function name : getAttributrByName()
        * @description   : get attribute record by name
        * @access        : public
        * @param   	 : $attribute_name The attribute name that you want
        * @return        : array The selected attribute name array
        *
        */
        public function getAttributrByName($attribute_name) 
        {
            $this->db->from('attribute');
            $this->db->where('attribute_name',$attribute_name);
            $query=$this->db->get();
            return $query->row_array();
        }
        
	
	
	/**
	* 
	* @function name 	: addAttributes()
	* @description   	: add Attributes record in database
	* @access 		 	: public
	* @return       	: int last inserted Attributes record id
	*
	*/
	public function addAttributes()
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
		
		
                $this->db->set('attribute_name',$this->input->post('attribute_name'));
                $this->db->set('attribute_group_id',$this->input->post('attribute_group_id'));	
                $this->db->set('sort_order',$this->input->post('sort_order'));
                $this->db->set('status',$this->input->post('status'));
                $this->db->set('is_deleted',$is_deleted);
                $this->db->set('date_added',date('Y-m-d h:i:sa'));
                $this->db->set('added_by',$this->session->userdata('user_id'));
                $this->db->set('date_modified',date('Y-m-d h:i:sa'));
                $this->db->set('modified_by',$this->session->userdata('user_id'));
                $this->db->insert('attribute');
                return $this->db->insert_id();
			
		
	}
	
	/**
	* 
	* @function name 	: editAttributes()
	* @description   	: edit attributes record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editAttributes()
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
		
		$this->db->set('attribute_name',$this->input->post('attribute_name'));
		$this->db->set('attribute_group_id',$this->input->post('attribute_group_id'));	
		$this->db->set('sort_order',$this->input->post('sort_order'));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));
		$this->db->where('attribute_id',(int)$this->input->post('attribute_id'));
		return $this->db->update('attribute');	
	}
	
	
	/**
	* 
	* @function name 	: softDeleteAttributes()
	* @description   	: only status change not actual delete attributes from database
	* @access 		 	: public
	* @param   		 	: int $attribute_id The attribute id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteAttributes($attribute_id)	{	
		$this->db->set('is_deleted',1);
		$this->db->where('attribute_id',(int)$attribute_id);
		return $this->db->update('attribute');
	}
	
	/**
	* 
	* @function name 	: deleteAttributes()
	* @description   	: delete attribute record from database
	* @access 		 	: public
	* @param   		 	: int $attribute_id The attribute id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteAttributes($attribute_id) 
	{	
		$this->db->where('attribute_id',(int)$attribute_id);
		return $this->db->delete('attribute');
	} 
	
	/**
	* 
	* @function name 	: getAttributes()
	* @description   	: get all attributes from database
	* @access 		 	: public
	* @param   		 	: string $information The attributes that you want to get
	* @return       	: array The selected attributes array
	*
	*/
	public function getAttributes($data = array())
	{
                
		$sql = "SELECT *, (SELECT ag.attribute_group_name FROM attribute_group ag WHERE ag.attribute_group_id = a.attribute_group_id) AS attribute_group FROM attribute a WHERE 1=1";
                
                $implode = array();
                
                if (!empty($data['attribute_name'])) {
			$implode[] = " a.attribute_name LIKE '%" .$data['attribute_name']. "%'";
		}
                
                if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
                
		$sort_data = array(
			'attribute_name',
			'attribute_group',
			'sort_order'			
		);
                
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " AND is_deleted = 0";
		}
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY a.attribute_name";
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
                //echo $this->db->last_query();
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalAttributes()
	* @description   	: get total no of attribute from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalAttributes() 
	{
		$sql = "SELECT COUNT(*) AS total FROM attribute";
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
        
    /**
    * 
    * @function name : getTotalAttributesByAttributeGroupId()
    * @description   : get Total Attributes by $attribute_group_id
    * @access        : public
    * @param   	     : int $attribute_group_id
    * @return        : int total no of attributes
    *
    */
    public function getTotalAttributesByAttributeGroupId($attribute_group_id) 
    {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM attribute WHERE attribute_group_id = '" . (int)$attribute_group_id . "'");
        return $query->row('total');
    }
	
	
}