<?php

/**
 * Filter Model Class
 * Collection of various common function related to filter database operation.
 *
 * @author    Indrajit Kaplatiya
 * @license   http://www.vpninfotech.com/
 */
class Filter_model extends CI_Model 
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
	* @function name 	: getFilter()
	* @description   	: get filter record by filter_id
	* @access 		 	: public
	* @param   		 	: int $filter_group_id The filter group id that you want
	* @return       	: array The selected filter array
	*
	*/
	public function getFilter($filter_group_id)
    {
		$this->db->select('fg.*,f.filter_name as filter_name');
		$this->db->from('filter_group fg');
		$this->db->join('filter f','fg.filter_group_id=f.filter_group_id','left');
		$this->db->where('fg.filter_group_id',(int)$filter_group_id);
		$query=$this->db->get();
		$res=$query->row_array();
		//echo $this->db->last_query();exit;
		return  $res;
    }
	/**
	* 
	* @function name 	: getFilterList()
	* @description   	: get filter list record by filter_group_id
	* @access 		 	: public
	* @param   		 	: int $filter_group_id The filter group id that you want
	* @return       	: array The selected filter array
	*
	*/
	public function getFilterList($filter_group_id)
    {
		$this->db->from('filter');
		$this->db->where('filter_group_id',(int)$filter_group_id);
		$query=$this->db->get();
		return $query->result_array();
    }
    
	/**
	* 
	* @function name 	: addFilter()
	* @description   	: add Filter record in database
	* @access 		 	: public
	* @return       	: int last inserted filter record id
	*
	*/
	public function addFilter()
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
		$this->db->set('filter_group_name',$this->input->post('filter_group_name'));
		$this->db->set('sort_order',$this->input->post('sort_order'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('Muser_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('Muser_id'));
		$this->db->insert('filter_group');
		$filter_group_id = $this->db->insert_id();
		$filter_list=$this->input->post('filter_name');
		if(count($filter_list)>0)
		{
			foreach ($filter_list as $key => $value) {
				$this->db->set('filter_group_id',$filter_group_id);
				$this->db->set('filter_name',$value['name']);
				$this->db->set('sort_order',$value['sort_order']);
				$this->db->set('is_deleted',$is_deleted);
				$this->db->set('date_added',date('Y-m-d h:i:sa'));
				$this->db->set('added_by',$this->session->userdata('Muser_id'));
				$this->db->set('date_modified',date('Y-m-d h:i:sa'));
				$this->db->set('modified_by',$this->session->userdata('Muser_id'));
				$this->db->insert('filter');
			}
		}
		return $filter_group_id;
		
	}
	
	/**
	* 
	* @function name 	: editFilter()
	* @description   	: edit filter record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editFilter()
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
		$filter_group_id = $this->input->post('filter_group_id');
		$this->db->set('filter_group_name',$this->input->post('filter_group_name'));
		$this->db->set('sort_order',$this->input->post('sort_order'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('Muser_id'));
		$this->db->where('filter_group_id',$filter_group_id);
		$this->db->update('filter_group');
		
		if ($this->db->affected_rows() > 0)
		{
                    // Record deleted in filter table by filter_group_id
                $this->db->where('filter_group_id',(int)$filter_group_id);
                $this->db->delete('filter');
			$filter_list=$this->input->post('filter_name');
			if(count($filter_list)>0)
			{
				

				foreach ($filter_list as $key => $value) {
					$this->db->set('filter_group_id',$filter_group_id);
					$this->db->set('filter_name',$value['name']);
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
					$this->db->set('added_by',$this->session->userdata('Muser_id'));
					$this->db->set('date_modified',date('Y-m-d h:i:sa'));
					$this->db->set('modified_by',$this->session->userdata('Muser_id'));
					$this->db->insert('filter');
				}
			}
		}
		
		return $filter_group_id;
		
	}
	
	
	/**
	* 
	* @function name 	: softDeleteFilter()
	* @description   	: only status change not actual delete filter from database
	* @access 		 	: public
	* @param   		 	: int $filter_group_id The filter group id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteFilter($filter_group_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('filter_group_id',(int)$filter_group_id);
		$this->db->update('filter');

		$this->db->set('is_deleted',1);
		$this->db->where('filter_group_id',(int)$filter_group_id);
		return $this->db->update('filter_group');
	}
	
	/**
	* 
	* @function name 	: deleteFilter()
	* @description   	: delete filter record from database
	* @access 		 	: public
	* @param   		 	: int $filter_group_id The filter group id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteFilter($filter_group_id) 
	{	
		// Record deleted in filter table by filter_group_id
		$this->db->where('filter_group_id',(int)$filter_group_id);
		$this->db->delete('filter');

		// Record deleted in filter_group table by filter_group_id
		$this->db->where('filter_group_id',(int)$filter_group_id);
		return $this->db->delete('filter_group');
	} 
	
	
	/**
	* 
	* @function name 	: getFilters()
	* @description   	: get all filters from database
	* @access 		 	: public
	* @param   		 	: string $filter The filter data that you want to get
	* @return       	: array The selected coupons array
	*
	*/
	public function getFilters($data = array())
	{
		if($data)
		{

			$sql = "SELECT fg.* FROM filter_group fg";
			$where = " where 1=1 ";
			$sort_data = array(
				'filter_group_name',
				'sort_order',
				'date_modified'
			);
			if($this->session->userdata('Mrole_id')!=1)
			{
				$where .= " and fg.is_deleted = 0";
			}
			if($this->input->post('filter_name') != "")
			{

				$where .= " and fg.filter_group_name like '%".$this->input->post('filter_name')."%'";
			}
			$sql.=$where;
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY fg." . $data['sort'];
			} else {
				$sql .= " ORDER BY filter_group_name";
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
			$sql = "SELECT * FROM filter_group WHERE fg.is_deleted = 0 ORDER BY filter_group_name ASC";
		}
		$query = $this->db->query($sql);
		$query->result_array();
		// if($this->input->post('filter_name') != "")
		// 	{

		// 		echo $this->db->last_query();exit;
		// 	}
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
		$sql = "SELECT COUNT(*) AS total FROM filter_group fg";
		$where = " where 1=1 ";
		if($this->session->userdata('Mrole_id')!=1)
			{
				$where .= " and fg.is_deleted = 0";
			}
			if($this->input->post('filter_name') != "")
			{

				$where .= " and fg.filter_group_name like '%".$this->input->post('filter_name')."%'";
			}
			$sql.=$where;
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	
	/**
	* 
	* @function name 	: getFiltersData()
	* @description   	: get filter data from database
	* @access 		 	: public
	* @return       	: Filters Data of records
	*
	*/
	public function getFiltersData($category_id)
        {		
		$query=$this->db->query("select f.filter_name,fg.filter_group_name,cf.filter_id from filter f join filter_group fg on f.filter_group_id=fg.filter_group_id join category_filter cf on cf.filter_id=f.filter_id where cf.category_id ='".$category_id."'");
				
		return $query->result_array();			
	}
	/**
	* 
	* @function name 	: getFilterByName()
	* @description   	: get Filter by name record by filter_name(parent category or category which has parent = 0)
	* @access 		 	: public
	* @param   		 	: int $filter_name The filter name that you want
	* @return       	: array The selected filter name array
	*
	*/
	public function getFilterByName($data)
    {
		//SELECT * FROM `category` where category_id=4 group by parent_id;
		$this->db->select('*');
		$this->db->from('filter');
		$this->db->like('filter_name',$data['filter_name'],'after');		
		$query=$this->db->get();
		
		return $query->result_array();			
	}
	/**
	* 
	* @function name 	: getFilterGroupName()
	* @description   	: get filter group name record by filter group id
	* @access 		 	: public
	* @param   		 	: int $filter_group_id The filter group name that you want
	* @return       	: array The selected filter group name array
	*
	*/
	public function getFilterGroupName($filter_group_id)
    {
		$this->db->select('*');
		$this->db->from('filter_group');
		$this->db->where('filter_group_id=',$filter_group_id);
		$this->db->group_by('filter_group_id'); 
		$query=$this->db->get();
		
		return $query->result_array();
	}
        
        /*GET FILTER DATA CODE || Vinay || D. 18-11-2016  */
        public function getFilterNameById($filter_group_id)
        {
            $query = $this->db->query("SELECT *, (SELECT filter_group_name FROM filter_group fg WHERE f.filter_group_id = fg.filter_group_id) AS `group` FROM filter f WHERE f.filter_id = '" . (int)$filter_group_id . "'");

            return $query->result_array();
        }
	
}