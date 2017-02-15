<?php

/**
 * Customer Order Report Model Model Class
 * Collection of various common function related to order database operation.
 *
 * @author    Vinay Ghael
 * @license   http://www.vpninfotech.com/
 */
class Customer_order_report_model extends CI_Model 
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
	
	public function getTotalCustomersByDay() {
            $customer_data = array();

            for ($i = 0; $i < 24; $i++) {
                $customer_data[$i] = array(
                    'hour'  => $i,
                    'total' => 0
                );
            }

            $query = $this->db->query("SELECT COUNT(*) AS total, HOUR(date_added) AS hour FROM `customer` WHERE DATE(date_added) = DATE(NOW()) GROUP BY HOUR(date_added) ORDER BY date_added ASC");

            foreach ($query->result_array() as $result) {
                $customer_data[$result['hour']] = array(
                    'hour'  => $result['hour'],
                    'total' => $result['total']
                );
            }
			
            return $customer_data;
	}
        
        public function getTotalCustomersByWeek() {
            $customer_data = array();

            $date_start = strtotime('-' . date('w') . ' days');

            for ($i = 0; $i < 7; $i++) {
                $date = date('Y-m-d', $date_start + ($i * 86400));

                $order_data[date('w', strtotime($date))] = array(
                    'day'   => date('D', strtotime($date)),
                    'total' => 0
                );
            }

            $query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM `customer` WHERE DATE(date_added) >= DATE('" . date('Y-m-d', $date_start) . "') GROUP BY DAYNAME(date_added)");

            foreach ($query->result_array() as $result) {
                $customer_data[date('w', strtotime($result['date_added']))] = array(
                    'day'   => date('D', strtotime($result['date_added'])),
                    'total' => $result['total']
                );
            }

            return $customer_data;
	}

	public function getTotalCustomersByMonth() {
            $customer_data = array();

            for ($i = 1; $i <= date('t'); $i++) {
                $date = date('Y') . '-' . date('m') . '-' . $i;

                $customer_data[date('j', strtotime($date))] = array(
                    'day'   => date('d', strtotime($date)),
                    'total' => 0
                );
            }

            $query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM `customer` WHERE DATE(date_added) >= '" . date('Y') . '-' . date('m') . '-1' . "' GROUP BY DATE(date_added)");

            foreach ($query->result_array() as $result) {
                $customer_data[date('j', strtotime($result['date_added']))] = array(
                    'day'   => date('d', strtotime($result['date_added'])),
                    'total' => $result['total']
                );
            }

            return $customer_data;
	}
        
        public function getTotalCustomersByYear() {
            $customer_data = array();

            for ($i = 1; $i <= 12; $i++) {
                    $customer_data[$i] = array(
                            'month' => date('M', mktime(0, 0, 0, $i)),
                            'total' => 0
                    );
            }

            $query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM `customer` WHERE YEAR(date_added) = YEAR(NOW()) GROUP BY MONTH(date_added)");

            foreach ($query->result_array() as $result) {
                $customer_data[date('n', strtotime($result['date_added']))] = array(
                    'month' => date('M', strtotime($result['date_added'])),
                    'total' => $result['total']
                );
            }

            return $customer_data;
	}
        
        public function getOrders($data = array()) {
            $sql = "SELECT c.customer_id, CONCAT(c.firstname, ' ', c.lastname) AS customer, c.email, cg.group_name AS customer_group, c.status, o.order_id, SUM(op.quantity) as products, SUM(DISTINCT o.total) AS total FROM `order` o LEFT JOIN `order_product` op ON (o.order_id = op.order_id)LEFT JOIN `customer` c ON (o.customer_id = c.customer_id) LEFT JOIN `customer_group` cg ON (c.group_id = cg.customer_group_id) WHERE o.customer_id > 0 ";
            
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
                    $sql .= " AND " . implode(" AND ", $implode);
            }
            
            $sql .= " GROUP BY o.order_id";
           
            if (isset($data['start']) || isset($data['limit'])) {
                if ($data['start'] < 0) {
                    $data['start'] = 0;
                }

                if ($data['limit'] < 1) {
                    $data['limit'] = 20;
                }

                $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
            }
            
            $sql = "SELECT t.customer_id, t.customer, t.email, t.customer_group, t.status, COUNT(t.order_id) AS orders, SUM(t.products) AS products, SUM(t.total) AS total FROM (" . $sql . ") AS t GROUP BY t.customer_id ORDER BY total DESC";
            
            $query = $this->db->query($sql);
            //echo $this->db->last_query();
            return $query->result_array();
        }
        
        public function getTotalOrders($data = array()) {
            $sql = "SELECT COUNT(DISTINCT o.customer_id) AS total FROM `order` o WHERE o.customer_id > '0'";

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