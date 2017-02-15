<?php

/**
 * Purchase Report Model Class
 * Collection of various common function related to order database operation.
 *
 * @author    Mitesh
 * @license   http://www.vpninfotech.com/
 */
class Purchase_report_model extends CI_Model 
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
	
        public function getPurchase($data = array()) {
               
		   $sql = "SELECT p.purchase_id,p.date_added,pp.name,pp.model,pp.quantity,pp.total FROM purchase p LEFT JOIN `purchase_product` pp ON (p.purchase_id = pp.purchase_id)";
		   		  
			
           $implode = array();
            
            if (!empty($data['filter_date_start'])) {
                    $implode[] = "DATE(p.date_added) >= '" . $data['filter_date_start'] . "'";
            }

            if (!empty($data['filter_date_end'])) {
                    $implode[] = "DATE(p.date_added) <= '" . $data['filter_date_end'] . "'";
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
        
        public function getTotalPurchase($data = array()) {
           // $sql = "SELECT COUNT(DISTINCT op.product_id) AS total FROM `order_product` op LEFT JOIN `order` o ON (op.order_id = o.order_id)";
		   
			//$sql = "SELECT COUNT(purchase_id) AS total FROM `purchase`";
			
			$sql = "SELECT COUNT(DISTINCT pp.product_id) AS total FROM purchase p LEFT JOIN `purchase_product` pp ON (p.purchase_id = pp.purchase_id)";
		
			
            if (!empty($data['filter_date_start'])) {
                    $sql .= " AND DATE(p.date_added) >= '" . $data['filter_date_start'] . "'";
            }

            if (!empty($data['filter_date_end'])) {
                    $sql .= " AND DATE(p.date_added) <= '" . $data['filter_date_end'] . "'";
            }

            $query = $this->db->query($sql);
			
            return $query->row('total');
    }
}

?>