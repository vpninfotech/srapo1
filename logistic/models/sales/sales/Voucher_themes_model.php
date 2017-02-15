 <?php

/**
 * VoucherThemes Model Class
 * Collection of various common function related to VoucherThemes database operation.
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Voucher_themes_model extends CI_Model 
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
	* @function name 	: VoucherThemes()
	* @description   	: get VoucherThemes record by voucher_theme_id	
	* @access 		 	: public
	* @param   		 	: int $voucher_theme_id	 The voucher_theme_id that you want
	* @return       	: array The selected voucher_theme_id array
	*
	*/
	public function getVoucherThemesById($voucher_theme_id)
    {
		$this->db->from('voucher_theme');
		$this->db->where('voucher_theme_id',(int)$voucher_theme_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	
	/**
	* 
	* @function name 	: addVoucherThemes()
	* @description   	: add VoucherThemes record in database
	* @access 		 	: public
	* @return       	: int last inserted VoucherThemes record id
	*
	*/
	public function addVoucherThemes()
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
		  
		$this->db->set('name',$this->input->post('name')); 
		$this->db->set('image', $this->input->post('image'));
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('user_id'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->insert('voucher_theme');
		return $this->db->insert_id();
		 
	}
	
	/**
	* 
	* @function name 	: editVoucherThemes()
	* @description   	: edit VoucherThemes record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editVoucherThemes()
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
		
		$this->db->set('name',$this->input->post('name'));  
		$this->db->set('image', $this->input->post('image'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));
		$this->db->where('voucher_theme_id',(int)$this->input->post('voucher_theme_id'));
		return $this->db->update('voucher_theme');	
	}
	
	
	/**
	* 
	* @function name 	: softVoucherThemes()
	* @description   	: only status change not actual delete VoucherThemes from database
	* @access 		 	: public
	* @param   		 	: int $voucher_theme_id The voucher_theme_id that you want to delete
	* @return       	: void
	*
	*/
	public function softDelete($voucher_theme_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('voucher_theme_id',(int)$voucher_theme_id);
		return $this->db->update('voucher_theme');
	}
	
	/**
	* 
	* @function name 	: deleteVoucherThemes()
	* @description   	: delete VoucherThemes record from database
	* @access 		 	: public
	* @param   		 	: int $voucher_theme_id The voucher_theme_id that you want to delete
	* @return       	: void
	*
	*/
	public function delete($voucher_theme_id) 
	{	
		$this->db->where('voucher_theme_id',(int)$voucher_theme_id);
		 
		return $this->db->delete('voucher_theme');
		
	} 
	
	
	/**
	* 
	* @function name 	: getVoucherThemes()
	* @description   	: get all VoucherThemes from database
	* @access 		 	: public
	* @param   		 	: string $VoucherThemes The VoucherThemes code that you want to get
	* @return       	: array The selected VoucherThemes array
	*
	*/
	public function getVoucherThemes($data = array())
	{
		if($data)
		{
			$sql = "SELECT * FROM voucher_theme";

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
			$sql = "SELECT * FROM voucher_theme WHERE is_deleted = 0 ORDER BY name";	
		}

		$query = $this->db->query($sql);
		$query->result_array();
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getVoucherThemes()
	* @description   	: get total no of VoucherThemes from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalVoucherThemes() 
	{
		$sql = "SELECT COUNT(*) AS total FROM  voucher_theme";
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	
	/**
	* 
	* @function name 	: getallThemesName()
	* @description   	: get total no of VoucherThemesNames from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	
	public function getallThemesName()
	{
		$this->db->select('voucher_theme_id,name');
		$this->db->from('voucher_theme');
                $this->db->where('is_deleted=0');
                
		$query=$this->db->get();
		return $query->result_array();
    }
	
	
	 
    
}

?>