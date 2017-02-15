<?php

/**
 * Download Model Class
 * Collection of various common function related to downloads database operation.
 *
 * @author    Vinay
 * @license   http://www.vpninfotech.com/
 */
class Downloads_model extends CI_Model 
{
	/**
	* 
	* @function name 	: __construct()
	* @description   	: initialize variables
	* @param   		: void
	* @return        	: void
	*
	*/
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	* 
	* @function name 	: getDownload()
	* @description   	: get download record by download_id
	* @access 		: public
	* @param   		: int $download_id The download id that you want
	* @return       	: array The selected download array
	*
	*/
	public function getDownload($download_id)
        {
            $this->db->from('download');
            $this->db->where('download_id',(int)$download_id);
            $query=$this->db->get();
            return $query->row_array();
        }
        
        /**
        * 
        * @function name : getDownloadByName()
        * @description   : get download record by name
        * @access        : public
        * @param   	     : $download_name The download name that you want
        * @return        : array The selected download name array
        *
        */
        public function getDownloadByName($download_name) 
        {
            $this->db->from('download');
            $this->db->where('name',$download_name);
            $query=$this->db->get();
            return $query->result_array();
        }  
        
	
	/**
	* 
	* @function name 	: addDownload()
	* @description   	: add Download record in database
	* @access 		    : public
	* @return       	: int last inserted Download record id
	*
	*/
	public function addDownload()
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
		
            $this->db->set('name',$this->input->post('download_name'));
            $this->db->set('filename',$this->input->post('filename'));
            $this->db->set('mask',$this->input->post('mask')); 
            $this->db->set('is_deleted',$is_deleted);
            $this->db->set('date_added',date('Y-m-d h:i:sa'));
            $this->db->set('added_by',$this->session->userdata('Muser_id'));
            $this->db->set('date_modified',date('Y-m-d h:i:sa'));
            $this->db->set('modified_by',$this->session->userdata('Muser_id'));
            $this->db->insert('download');
            return $this->db->insert_id();		
	}
	
	/**
	* 
	* @function name 	: editDownload()
	* @description   	: edit downloads record in database
	* @access 		    : public
	* @return       	: void
	*
	*/
	public function editDownload()
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
		
            $this->db->set('name',$this->input->post('download_name'));
            $this->db->set('filename',$this->input->post('filename'));
            $this->db->set('mask',$this->input->post('mask')); 
            $this->db->set('is_deleted',$is_deleted);
            $this->db->set('date_added',date('Y-m-d h:i:sa'));
            $this->db->set('added_by',$this->session->userdata('Muser_id'));
            $this->db->set('date_modified',date('Y-m-d h:i:sa'));
            $this->db->set('modified_by',$this->session->userdata('Muser_id'));
            $this->db->where('download_id',(int)$this->input->post('download_id'));
            return $this->db->update('download');	
	}
	
	
	/**
	* 
	* @function name 	: softDeleteDownload()
	* @description   	: only status change not actual delete downloads from database
	* @access 		    : public
	* @param   		    : int $download_id The download id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteDownload($download_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('download_id',(int)$download_id);
		return $this->db->update('download');
	}
	
	/**
	* 
	* @function name 	: deleteDownload()
	* @description   	: delete download record from database
	* @access 		    : public
	* @param   		    : int $download_id The download id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteDownload($download_id) 
	{	
            $this->db->where('download_id',(int)$download_id);
            return $this->db->delete('download');
	} 
	
	/**
	* 
	* @function name 	: getDownload()
	* @description   	: get all downloads from database
	* @access 		    : public
	* @param   	 	    : string $download The downloads that you want to get
	* @return       	: array The selected downloads array
	*
	*/
	public function getDownloads($data = array())
	{
		$sql = "SELECT * FROM download";
                
                $implode = array();
                
                if (!empty($data['download_name'])) {
			$implode[] = " name LIKE '%" .$data['download_name']. "%'";
		}
                
                if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}
                
		$sort_data = array(
			'name',	
		);
                
		if($this->session->userdata('Mrole_id')!=1)
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

		$query = $this->db->query($sql);
		$query->result_array();
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalDownload()
	* @description   	: get total no of download from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalDownload() 
	{
		$sql = "SELECT COUNT(*) AS total FROM download";
		if($this->session->userdata('Mrole_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
        
        public function getDownloadById($download_id) {
            $query = $this->db->query("SELECT * FROM download WHERE download_id = '".$download_id."'");
            return $query->result_array();
        }
        
        public function getProductDownload($download_id) {
                $download_product = array();
                
		$query = $this->db->query("SELECT * FROM download WHERE download_id = '" . (int)$download_id . "'");
                
                $download_product = $query->result_array();
                
		return $download_product;
	}
    
    
}