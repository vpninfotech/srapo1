<?php

/**
 * Product Purchased Report Model Model Class
 * Collection of various common function related to order database operation.
 *
 * @author    Vinay Ghael
 * @license   http://www.vpninfotech.com/
 */
class Product_purchased_report_model extends CI_Model 
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
	
        public function getPurchased($data = array()) {
            $sql = "SELECT op.name, op.model, SUM(op.quantity) AS quantity, SUM((op.total + op.tax) * op.quantity) AS total FROM order_product op LEFT JOIN `order` o ON (op.order_id = o.order_id)";
            
            $implode = array();
            
            if (!empty($data['filter_order_status_id'])) {
                $implode[] = "o.order_status_id = '" . (int)$data['filter_order_status_id'] . "'";
            } else {
                $implode[] = " o.order_status_id > '0'";
            }
            
            if (!empty($data['filter_date_start'])) {
                    $implode[] = "DATE(o.date_added) >= '" . $data['filter_date_start'] . "'";
            }

            if (!empty($data['filter_date_end'])) {
                    $implode[] = "DATE(o.date_added) <= '" . $data['filter_date_end'] . "'";
            }          
            
            if ($implode) {
                    $sql .= " WHERE " . implode(" AND ", $implode);
            }
            
            $sql .= " GROUP BY op.product_id ORDER BY total DESC";
           
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
        
        public function getTotalPurchased($data = array()) {
            $sql = "SELECT COUNT(DISTINCT op.product_id) AS total FROM `order_product` op LEFT JOIN `order` o ON (op.order_id = o.order_id)";

            if (!empty($data['filter_order_status_id'])) {
                    $sql .= " AND o.order_status_id = '" . (int)$data['filter_order_status_id'] . "'";
            } else {
                    $sql .= " AND o.order_status_id > '0'";
            }

            if (!empty($data['filter_date_start'])) {
                    $sql .= " AND DATE(o.date_added) >= '" . $data['filter_date_start'] . "'";
            }

            if (!empty($data['filter_date_end'])) {
                    $sql .= " AND DATE(o.date_added) <= '" . $data['filter_date_end'] . "'";
            }

            $query = $this->db->query($sql);

            return $query->row('total');
    }
}

?>