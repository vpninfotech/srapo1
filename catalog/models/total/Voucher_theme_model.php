<?php

/**
 * Country Model Class
 * Collection of various common function related to country database operation.
 *
 * @author    Mitesh
 * @license   http://www.vpninfotech.com/
 */
class Voucher_theme_model extends CI_Model 
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
	
	public function getVoucherTheme($voucher_theme_id) {
		$query = $this->db->query("SELECT * FROM voucher_theme vt WHERE vt.voucher_theme_id = '" . (int)$voucher_theme_id . "'");

		return $query->result_array();
	}

	public function getVoucherThemes($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM voucher_theme vt ORDER BY vt.name";

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

			return $query->result_array();
		} else {

			
				$query = $this->db->query("SELECT * FROM voucher_theme vt ORDER BY vt.name");

				$voucher_theme_data = $query->result_array();

				
			

			return $voucher_theme_data;
		}
	}
	
	
	
}