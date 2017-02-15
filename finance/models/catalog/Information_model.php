<?php

/**
 * Information Model Class
 * Collection of various common function related to information database operation.
 *
 * @author    Mitesh
 * @license   http://www.vpninfotech.com/
 */
class Information_model extends CI_Model 
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
	* @function name 	: getInformation()
	* @description   	: get Information record by information_id
	* @access 		 	: public
	* @param   		 	: int $information_id The information id that you want
	* @return       	: array The selected information array
	*
	*/
	public function getInformation($information_id)
    {
		$this->db->from('information');
		$this->db->where('information_id',(int)$information_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	
	/**
	* 
	* @function name 	: addInformation()
	* @description   	: add information record in database
	* @access 		 	: public
	* @return       	: int last inserted information record id
	*
	*/
	public function addInformation()
	{
		$bottom = $this->input->post('bottom');
		if(isset($bottom))
		{
   			$bottom = 1;
		}
		else
		{
   			$bottom = 0;
		}
		
		
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
		$this->db->set('description',$this->input->post('description'));
		$this->db->set('meta_title',$this->input->post('meta_title'));
		$this->db->set('meta_description',$this->input->post('meta_description'));
		$this->db->set('meta_keyword',$this->input->post('meta_keyword'));
		$this->db->set('bottom',$bottom);
		$this->db->set('sort_order',$this->input->post('sort_order'));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('Duser_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
                $this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('Duser_id'));
        $this->db->set('modified_by', $this->session->userdata('Duser_id'));
		$this->db->insert('information');
		return $this->db->insert_id();
	}
	
	/**
	* 
	* @function name 	: editInformation()
	* @description   	: edit information record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editInformation()
	{
		$bottom = $this->input->post('bottom');
		if(isset($bottom))
		{
   			$bottom = 1;
		}
		else
		{
   			$bottom = 0;
		}
		
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
		$this->db->set('description',$this->input->post('description'));
		$this->db->set('meta_title',$this->input->post('meta_title'));
		$this->db->set('meta_description',$this->input->post('meta_description'));
		$this->db->set('meta_keyword',$this->input->post('meta_keyword'));
		$this->db->set('bottom',$bottom);
		$this->db->set('sort_order',$this->input->post('sort_order'));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('Duser_id'));
		$this->db->where('information_id',(int)$this->input->post('information_id'));
		return $this->db->update('information');	
	}
	
	
	/**
	* 
	* @function name 	: softDeleteInformation()
	* @description   	: only status change not actual delete information from database
	* @access 		 	: public
	* @param   		 	: int $information_id The information id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteInformation($information_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('information_id',(int)$information_id);
		return $this->db->update('information');
	}
	
	/**
	* 
	* @function name 	: deleteInformation()
	* @description   	: delete information record from database
	* @access 		 	: public
	* @param   		 	: int $information_id The information id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteInformation($information_id) 
	{	
		$this->db->where('information_id',(int)$information_id);
		return $this->db->delete('information');
	} 
	
	/**
        * 
        * @function name : getInformationByName()
        * @description   : get information record by name
        * @access        : public
        * @param   	     : int $information_name The information name that you want
        * @return        : array The selected information array
        *
        */
        public function getInformationByName($information_name) 
        {
            $this->db->from('information');
            $this->db->where('title',$information_name);
            $query=$this->db->get();
            return $query->row_array();
        }
	
	/**
	* 
	* @function name 	: getInformations()
	* @description   	: get all information from database
	* @access 		 	: public
	* @param   		 	: string $information The information code that you want to get
	* @return       	: array The selected information array
	*
	*/
	public function getInformations($data = array())
	{
		$sql = "SELECT * FROM information";

		$sort_data = array(
                    'title',
                    'meta_title',
                    'bottom',
                    'status',
                    'sort_order'
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

		$query = $this->db->query($sql);
		$query->result_array();
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalInformation()
	* @description   	: get total no of information from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalInformations() 
	{
		$sql = "SELECT COUNT(*) AS total FROM information";
		if($this->session->userdata('Drole_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	
	
	
	
}