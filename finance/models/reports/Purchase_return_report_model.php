<?php
/**
 * Purchase Return Report Model Class
 * Collection of various common function related to purchase return database operation.
 *
 * @author    Mitesh
 * @license   http://www.vpninfotech.com/
 */
class Purchase_return_report_model extends CI_Model 
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
	
        public function getPurchaseReturn($data = array()) {
               
		  $sql = "SELECT * FROM purchase_return";
		   	
           $implode = array();
            
            if (!empty($data['filter_date_start'])) {
                    $implode[] = "DATE(date_added) >= '" . $data['filter_date_start'] . "'";
            }

            if (!empty($data['filter_date_end'])) {
                    $implode[] = "DATE(date_added) <= '" . $data['filter_date_end'] . "'";
            }          
            
            if ($implode) {
                    $sql .= " WHERE " . implode(" AND ", $implode);
            }
            
            //$sql .= " GROUP BY pp.product_id ORDER BY total DESC";
           
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
            //echo $this->db->last_query();
            return $query->result_array();
        }
        
        public function getTotalPurchaseReturn($data = array()) {
           			
			$sql = "SELECT COUNT(DISTINCT purchase_return_id) AS total FROM purchase_return";		
			
			$implode = array();
			
            if (!empty($data['filter_date_start'])) {
                    $implode[] = "DATE(date_added) >= '" . $data['filter_date_start'] . "'";
            }

            if (!empty($data['filter_date_end'])) {
                     $implode[] = "DATE(date_added) <= '" . $data['filter_date_end'] . "'";
            }

			if ($implode) {
                    $sql .= " WHERE " . implode(" AND ", $implode);
            }
            
            $query = $this->db->query($sql);
			
            return $query->row('total');
    }
}

?>