<?php
/**
 * Information Model Class
 * Collection of various common function related to Information database operation.
 *
 * @author    Nitin Sabhadiya
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
	function __construct()
	{
		parent::__construct();
		
	}
	
	/**
	* 
	* @function name 	: getInformation()
	* @description   	: get Information record by information_id
	* @access 		 	: public
	* @param   		 	: int $information_id The information id that you want
	* @return       	: array The selected information
	*
	*/
	public function getInformation($information_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM information WHERE information_id = '" . (int)$information_id . "' AND status = '1'");

		return $query->row_array();
	}
	
	/**
	* 
	* @function name 	: getInformation()
	* @description   	: get Information record by information_id
	* @access 		 	: public
	* @param   		 	: int $information_id The information id that you want
	* @return       	: array The selected information
	*
	*/
	public function getInformations() {
		$query = $this->db->query("SELECT * FROM information WHERE status = '1' ORDER BY sort_order, LCASE(title) ASC");

		return $query->result_array();
	} 

}