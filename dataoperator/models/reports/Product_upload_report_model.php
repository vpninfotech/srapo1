<?php

/**
 * Sales Report Model Model Class
 * Collection of various common function related to order database operation.
 *
 * @author    Vinay Ghael
 * @license   http://www.vpninfotech.com/
 */
class Product_upload_report_model extends CI_Model 
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
	
        public function getTotalProduct($data = array()) {
            $sql = "SELECT COUNT(product_id) AS TotalProduct FROM product WHERE status > '0'";
            
            if (!empty($data['filter_date_added'])) {
                $sql .= " AND DATE(date_added) = DATE('" . $data['filter_date_added'] . "')";
            }
            
            $query = $this->db->query($sql);
            return $query->row('TotalProduct');
        }
        
        public function totalActiveProduct($data = array()) {
            $sql = "SELECT COUNT(product_id) AS TotalActiveProduct FROM product WHERE status = '1'";
            
            if (!empty($data['filter_date_added'])) {
                $sql .= " AND DATE(date_added) = DATE('" . $data['filter_date_added'] . "')";
            }
            
            $query = $this->db->query($sql);
            return $query->row('TotalActiveProduct');
        }
        
        public function totalInactiveProduct($data = array()) {
            $sql = "SELECT COUNT(product_id) AS TotalInactiveProduct FROM product WHERE status = '0'";
            
            if (!empty($data['filter_date_added'])) {
                $sql .= " AND DATE(date_added) = DATE('" . $data['filter_date_added'] . "')";
            }
            
            $query = $this->db->query($sql);
            return $query->row('TotalInactiveProduct');
        }
	
	public function getTotalProductsByDay() {
		$implode = array();

	

		$product_data = array();

		for ($i = 0; $i < 24; $i++) {
			$product_data[$i] = array(
				'hour'  => $i,
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, HOUR(date_added) AS hour FROM `product` WHERE DATE(date_added) = DATE(NOW()) GROUP BY HOUR(date_added) ORDER BY date_added ASC");

		foreach ($query->result_array() as $result) {
			$product_data[$result['hour']] = array(
				'hour'  => $result['hour'],
				'total' => $result['total']
			);
		}
		
		return $product_data;
	}

	public function getTotalProductsByWeek() {
		$implode = array();

		$product_data = array();

		$date_start = strtotime('-' . date('w') . ' days');

		for ($i = 0; $i < 7; $i++) {
			$date = date('Y-m-d', $date_start + ($i * 86400));

			$product_data[date('w', strtotime($date))] = array(
				'day'   => date('D', strtotime($date)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM `product` WHERE DATE(date_added) >= DATE('" . date('Y-m-d', $date_start) . "') GROUP BY DAYNAME(date_added)");

		foreach ($query->result_array() as $result) {
			$product_data[date('w', strtotime($result['date_added']))] = array(
				'day'   => date('D', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}
               
		return $product_data;
	}

	public function getTotalProductsByMonth() {
		$implode = array();

		$product_data = array();

		for ($i = 1; $i <= date('t'); $i++) {
			$date = date('Y') . '-' . date('m') . '-' . $i;

			$product_data[date('j', strtotime($date))] = array(
				'day'   => date('d', strtotime($date)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM `product` WHERE DATE(date_added) >= " . date('Y') . '-' . date('m') . '-1' . " GROUP BY DATE(date_added)");

		foreach ($query->result_array() as $result) {
			$product_data[date('j', strtotime($result['date_added']))] = array(
				'day'   => date('d', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}

		return $product_data;
	}

	public function getTotalProductsByYear() {
		$implode = array();

		$product_data = array();

		for ($i = 1; $i <= 12; $i++) {
			$product_data[$i] = array(
				'month' => date('M', mktime(0, 0, 0, $i)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM `product` WHERE YEAR(date_added) = YEAR(NOW()) GROUP BY MONTH(date_added)");

		foreach ($query->result_array() as $result) {
			$product_data[date('n', strtotime($result['date_added']))] = array(
				'month' => date('M', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}

		return $product_data;
	}
        
}

?>