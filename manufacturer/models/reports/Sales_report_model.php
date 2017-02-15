<?php

/**
 * Sales Report Model Class
 * Collection of various common function related to order database operation.
 *
 * @author    Mitesh
 * @license   http://www.vpninfotech.com/
 */
class Sales_report_model extends CI_Model 
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
	
        public function getSales($data = array()) {
               
		   $sql = "SELECT p.purchase_id,p.date_added,pp.name,pp.model,pp.quantity,pp.total FROM purchase p LEFT JOIN `purchase_product` pp ON (p.purchase_id = pp.purchase_id) where manufacturer_id = '".(int)$this->session->userdata('manufacturer_user_id')."' ";
		   	
			if (!empty($data['filter_date_start'])) {
                    $sql .= " AND DATE(p.date_added) >= '" . $data['filter_date_start'] . "'";
            }

            if (!empty($data['filter_date_end'])) {
                    $sql .= " AND DATE(p.date_added) <= '" . $data['filter_date_end'] . "'";
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
           // echo $this->db->last_query();
            return $query->result_array();
        }
        
        public function getTotalSales($data = array()) {
          
			//$sql = "SELECT COUNT(purchase_id) AS total FROM `purchase`";
			
			$sql = "SELECT COUNT(DISTINCT pp.product_id) AS total FROM purchase p LEFT JOIN `purchase_product` pp ON (p.purchase_id = pp.purchase_id) where manufacturer_id = '".(int)$this->session->userdata('manufacturer_user_id')."' ";
		
			
            if (!empty($data['filter_date_start'])) {
                    $sql .= " AND DATE(p.date_added) >= '" . $data['filter_date_start'] . "'";
            }

            if (!empty($data['filter_date_end'])) {
                    $sql .= " AND DATE(p.date_added) <= '" . $data['filter_date_end'] . "'";
            }

            $query = $this->db->query($sql);
			
            return $query->row('total');
    }
	
	public function getTotalOrdersByDay() {
		$implode = array();

		$order_data = array();

		for ($i = 0; $i < 24; $i++) {
			$order_data[$i] = array(
				'hour'  => $i,
				'total' => 0
			);
		}
		
		
		$complete_status = 1;
		$query = $this->db->query("SELECT COUNT(*) AS total, HOUR(date_added) AS hour FROM `purchase` WHERE order_status_id ='".(int)$complete_status."' AND manufacturer_id = '".(int)$this->session->userdata('manufacturer_user_id')."' AND DATE(date_added) = DATE(NOW()) GROUP BY HOUR(date_added) ORDER BY date_added ASC");

		foreach ($query->result_array() as $result) {
			$order_data[$result['hour']] = array(
				'hour'  => $result['hour'],
				'total' => $result['total']
			);
		}
		
		return $order_data;
	}

	public function getTotalOrdersByWeek() {
		$implode = array();

		$order_data = array();

		$date_start = strtotime('-' . date('w') . ' days');

		for ($i = 0; $i < 7; $i++) {
			$date = date('Y-m-d', $date_start + ($i * 86400));

			$order_data[date('w', strtotime($date))] = array(
				'day'   => date('D', strtotime($date)),
				'total' => 0
			);
		}
		
		
		$complete_status = 1;
		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM `purchase` WHERE  order_status_id ='".(int)$complete_status."' AND manufacturer_id = '".(int)$this->session->userdata('manufacturer_user_id')."' AND DATE(date_added) >= DATE(" . $this->db->escape(date('Y-m-d', $date_start)) . ") GROUP BY DAYNAME(date_added)");

		foreach ($query->result_array() as $result) {
			$order_data[date('w', strtotime($result['date_added']))] = array(
				'day'   => date('D', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}

		return $order_data;
	}

	public function getTotalOrdersByMonth() {
		$implode = array();

		$order_data = array();

		for ($i = 1; $i <= date('t'); $i++) {
			$date = date('Y') . '-' . date('m') . '-' . $i;

			$order_data[date('j', strtotime($date))] = array(
				'day'   => date('d', strtotime($date)),
				'total' => 0
			);
		}
		

		$complete_status = 1;
		
		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM `purchase` WHERE order_status_id ='".(int)$complete_status."' AND manufacturer_id = '".(int)$this->session->userdata('manufacturer_user_id')."' AND DATE(date_added) >= " . $this->db->escape(date('Y') . '-' . date('m') . '-1') . " GROUP BY DATE(date_added)");

		foreach ($query->result_array() as $result) {
			$order_data[date('j', strtotime($result['date_added']))] = array(
				'day'   => date('d', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}

		return $order_data;
	}

	public function getTotalOrdersByYear() {
		$implode = array();

		$order_data = array();

		for ($i = 1; $i <= 12; $i++) {
			$order_data[$i] = array(
				'month' => date('M', mktime(0, 0, 0, $i)),
				'total' => 0
			);
		}
				
		$complete_status = 1;

		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM `purchase` WHERE order_status_id ='".(int)$complete_status."' AND manufacturer_id = '".(int)$this->session->userdata('manufacturer_user_id')."' AND YEAR(date_added) = YEAR(NOW()) GROUP BY MONTH(date_added)");
		
		foreach ($query->result_array() as $result) {
			$order_data[date('n', strtotime($result['date_added']))] = array(
				'month' => date('M', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}

		return $order_data;
	}
        public function getTotalOrdersByCountry() {
            $query = $this->db->query("SELECT COUNT(*) AS total, SUM(o.total) AS amount, c.iso_code_2 FROM `order` o LEFT JOIN `country` c ON (o.payment_country_id = c.country_id) WHERE o.order_status_id > '0' GROUP BY o.payment_country_id");

            return $query->result_array();
	}
	
	
}

?>