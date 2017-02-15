<?php

/**
 * Filter Model Class
 * Collection of various common function related to option database operation.
 *
 * @author    Indrajit Kaplatiya
 * @license   http://www.vpninfotech.com/
 */
class Option_model extends CI_Model 
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
	* @function name 	: getOption()
	* @description   	: get option record by option_id
	* @access 		 	: public
	* @param   		 	: int $option_id The option id that you want
	* @return       	: array The selected option array
	*
	*/
	public function getOption($option_id)
    {
		$this->db->select('o.*');
		$this->db->from('option o');
		$this->db->join('option_value ov','o.option_id=ov.option_id','left');
		$this->db->where('o.option_id',(int)$option_id);
		$query=$this->db->get();
		$res=$query->row_array();
		//echo $this->db->last_query();exit;
		return  $res;
    }
	/**
	* 
	* @function name 	: getOptionList()
	* @description   	: get option list record by option_id
	* @access 		 	: public
	* @param   		 	: int $option_id The option id that you want
	* @return       	: array The selected option array
	*
	*/
	public function getOptionList($option_id)
    {
		$this->db->from('option');
		$this->db->where('option_id',(int)$option_id);
		$query=$this->db->get();
		return $query->result_array();
    }
    /**
	* 
	* @function name 	: getOptionValueList()
	* @description   	: get option Value list record by option_id
	* @access 		 	: public
	* @param   		 	: int $option_id The option id that you want
	* @return       	: array The selected option array
	*
	*/
	public function getOptionValueList($option_id)
    {
		$this->db->from('option_value');
		$this->db->where('option_id',(int)$option_id);
		$query=$this->db->get();
		return $query->result_array();
    }
    
	/**
	* 
	* @function name 	: addOption()
	* @description   	: add Option record in database
	* @access 		 	: public
	* @return       	: int last inserted option record id
	*
	*/
	public function addOption()
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
		$this->db->set('type',$this->input->post('type'));
		$this->db->set('name',$this->input->post('option_name'));
		$this->db->set('sort_order',$this->input->post('sort_order'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('Duser_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('Duser_id'));
		$this->db->insert('option');
		$option_id = $this->db->insert_id();
		$option_list=$this->input->post('option_value');
		if(count($option_list)>0)
		{
			foreach ($option_list as $key => $value) {
				$this->db->set('option_id',$option_id);
				$this->db->set('name',$value['name']);
				$this->db->set('image',$value['image']);
				$this->db->set('sort_order',$value['sort_order']);
				$this->db->set('is_deleted',$is_deleted);
				$this->db->set('date_added',date('Y-m-d h:i:sa'));
				$this->db->set('added_by',$this->session->userdata('Duser_id'));
				$this->db->set('date_modified',date('Y-m-d h:i:sa'));
				$this->db->set('modified_by',$this->session->userdata('Duser_id'));
				$this->db->insert('option_value');
			}
		}
		return $option_id;
		
	}
	
	/**
	* 
	* @function name 	: editOption()
	* @description   	: edit option record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editOption()
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
		$option_id = $this->input->post('option_id');
		$this->db->set('type',$this->input->post('type'));
		$this->db->set('name',$this->input->post('option_name'));
		$this->db->set('sort_order',$this->input->post('sort_order'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('Duser_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('Duser_id'));
		$this->db->where('option_id',$option_id);
		$this->db->update('option');
		
		if ($this->db->affected_rows() > 0)
		{
			$option_list=$this->input->post('option_value');
			if(count($option_list)>0)
			{
				// Record deleted in filter table by filter_group_id
				$this->db->where('option_id',(int)$option_id);
				$this->db->delete('option_value');
				foreach ($option_list as $key => $value) {
				$this->db->set('option_id',$option_id);
				$this->db->set('name',$value['name']);
				$this->db->set('image',$value['image']);
				if($value['sort_order'] === "")
				{
					$this->db->set('sort_order',0);
				}
				else
				{
					$this->db->set('sort_order',$value['sort_order']);	
				}
				$this->db->set('is_deleted',$is_deleted);
				$this->db->set('date_added',date('Y-m-d h:i:sa'));
				$this->db->set('added_by',$this->session->userdata('Duser_id'));
				$this->db->set('date_modified',date('Y-m-d h:i:sa'));
				$this->db->set('modified_by',$this->session->userdata('Duser_id'));
				$this->db->insert('option_value');
			}
				
			}
		}
		return $option_id;
		
		
	}
	
	
	/**
	* 
	* @function name 	: softDeleteOption()
	* @description   	: only status change not actual delete filter from database
	* @access 		 	: public
	* @param   		 	: int $filter_group_id The filter group id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteOption($option_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('option_id',(int)$option_id);
		$this->db->update('option_value');

		$this->db->set('is_deleted',1);
		$this->db->where('option_id',(int)$option_id);
		return $this->db->update('option');
	}
	
	/**
	* 
	* @function name 	: deleteOption()
	* @description   	: delete option record from database
	* @access 		 	: public
	* @param   		 	: int $option_id The option id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteOption($option_id) 
	{	
		// Record deleted in option_value table by option_id
		$this->db->where('option_id',(int)$option_id);
		$this->db->delete('option_value');

		// Record deleted in option table by option_id
		$this->db->where('option_id',(int)$option_id);
		return $this->db->delete('option');
	} 
	
	
	/**
	* 
	* @function name 	: getOptions()
	* @description   	: get all option from database
	* @access 		 	: public
	* @param   		 	: string $data The option data that you want to get
	* @return       	: array The selected option array
	*
	*/
	public function getOptions($data = array())
	{
            $sql = "SELECT * FROM `option`";
            
            $implode = array();
            
            if(!empty($data['filter_name'])) {
                $implode[] = "name LIKE '%".$data['filter_name']."%'";
            }
            
            if ($implode) {
                $sql .= " WHERE " . implode(" AND ", $implode);
            }
            
            $sort_data = array(
                'name',
                'type',
                'sort_order'
            );
            
            if($this->session->userdata('Drole_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name ";
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
                //echo $this->db->last_query();exit;
		return $query->result_array();

	}
	
	/**
	* 
	* @function name 	: getTotalFilters()
	* @description   	: get total no of filter from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalFilters() 
	{
		$sql = "SELECT COUNT(*) AS total FROM `option` ";
		$where = " WHERE 1=1 ";
		if($this->session->userdata('Drole_id')!=1)
			{
				$where .= " and is_deleted = 0";
			}
			if($this->input->post('option_name') != "")
			{

				$where .= " and name like '%".$this->input->post('option_name')."%'";
			}
			$sql.=$where;
		$query = $this->db->query($sql);

		return $query->row('total');
	}
        
        public function getOptionValues($option_id) {
            $option_value_data = array();
            
            $option_value_query = $this->db->query("SELECT * FROM option_value WHERE option_id = '".(int)$option_id."' ORDER BY sort_order, name");
            
            foreach($option_value_query->result_array() as $option_value) {
                $option_value_data[] = array(
                    'option_value_id' => $option_value['option_value_id'],
                    'name'            => $option_value['name'],
                    'image'           => $option_value['image'],
                    'sort_order'      => $option_value['sort_order']
                );
            }
            return $option_value_data;
        }
	
	
	
	
}