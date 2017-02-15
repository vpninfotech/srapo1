<?php

/**
 * Coupon Report Model Model Class
 * Collection of various common function related to coupon database operation.
 *
 * @author    Vinay Ghael
 * @license   http://www.vpninfotech.com/
 */
class Coupons_report_model extends CI_Model 
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
	
        public function getCoupons($data = array()) {
            $sql = "SELECT ch.coupon_id, c.coupon_name, c.coupon_code, COUNT(DISTINCT ch.order_id) AS `orders`, SUM(ch.amount) AS total FROM `coupon_history` ch LEFT JOIN `coupon` c ON (ch.coupon_id = c.coupon_id)";
            
            $implode = array();
            
            if (!empty($data['filter_date_start'])) {
                    $implode[] = "DATE(ch.date_added) >= '" . $data['filter_date_start'] . "'";
            }

            if (!empty($data['filter_date_end'])) {
                    $implode[] = "DATE(ch.date_added) <= '" . $data['filter_date_end'] . "'";
            }          
            
            if ($implode) {
                    $sql .= " WHERE " . implode(" AND ", $implode);
            }
            
            $sql .= " GROUP BY ch.coupon_id ORDER BY total DESC";
           
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
        
        public function getTotalCoupons($data = array()) {
            $sql = "SELECT COUNT(DISTINCT coupon_id) AS total FROM `coupon_history`";
            
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