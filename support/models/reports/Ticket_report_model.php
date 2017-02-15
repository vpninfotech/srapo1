<?php

/**
 * Sales Report Model Model Class
 * Collection of various common function related to order database operation.
 *
 * @author    Vinay Ghael
 * @license   http://www.vpninfotech.com/
 */
class Ticket_report_model extends CI_Model 
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
	
        public function getTotalTicket($data = array()) {
            $sql = "SELECT COUNT(ticket_id) AS TotalTicket FROM ticket WHERE status > '0'";
            
            if (!empty($data['filter_date_added'])) {
                $sql .= " AND DATE(date_added) = DATE('" . $data['filter_date_added'] . "')";
            }
            
            $query = $this->db->query($sql);
            return $query->row('TotalTicket');
        }
        
        public function getTotalOperatorTickets($data = array()) {
            $sql = "SELECT COUNT(ticket_id) AS TotalOperatorTicket FROM ticket WHERE department_id = '5'";
            
            if (!empty($data['filter_date_added'])) {
                $sql .= " AND DATE(date_added) = DATE('" . $data['filter_date_added'] . "')";
            }
            
            $query = $this->db->query($sql);
            return $query->row('TotalOperatorTicket');
        }
        
        public function getTotalManufacturerTickets($data = array()) {
            $sql = "SELECT COUNT(ticket_id) AS TotalManufacturerTicket FROM ticket WHERE department_id = '6'";
            
            if (!empty($data['filter_date_added'])) {
                $sql .= " AND DATE(date_added) = DATE('" . $data['filter_date_added'] . "')";
            }
            
            $query = $this->db->query($sql);
            return $query->row('TotalManufacturerTicket');
        }
        
        public function getTotalFinanceTickets($data = array()) {
            $sql = "SELECT COUNT(ticket_id) AS TotalFinanceTicket FROM ticket WHERE department_id = '3'";
            
            if (!empty($data['filter_date_added'])) {
                $sql .= " AND DATE(date_added) = DATE('" . $data['filter_date_added'] . "')";
            }
            
            $query = $this->db->query($sql);
            return $query->row('TotalFinanceTicket');
        }
        
        public function getTotalLogisticTickets($data = array()) {
            $sql = "SELECT COUNT(ticket_id) AS TotalLogisticTicket FROM ticket WHERE department_id = '4'";
            
            if (!empty($data['filter_date_added'])) {
                $sql .= " AND DATE(date_added) = DATE('" . $data['filter_date_added'] . "')";
            }
            
            $query = $this->db->query($sql);
            return $query->row('TotalLogisticTicket');
        }
        
        public function getTotalCustomerTickets($data = array()) {
            $sql = "SELECT COUNT(ticket_id) AS TotalCustomerTicket FROM ticket WHERE department_id = '8'";
            
            if (!empty($data['filter_date_added'])) {
                $sql .= " AND DATE(date_added) = DATE('" . $data['filter_date_added'] . "')";
            }
            
            $query = $this->db->query($sql);
            return $query->row('TotalCustomerTicket');
        }
        
        public function getTotalMarketorTickets($data = array()) {
            $sql = "SELECT COUNT(ticket_id) AS TotalMarketorTicket FROM ticket WHERE department_id = '9'";
            
            if (!empty($data['filter_date_added'])) {
                $sql .= " AND DATE(date_added) = DATE('" . $data['filter_date_added'] . "')";
            }
            
            $query = $this->db->query($sql);
            return $query->row('TotalMarketorTicket');
        }
	
	public function getTotalTicketsByDay() {
		$implode = array();
                
		$ticket_data = array();

		for ($i = 0; $i < 24; $i++) {
			$ticket_data[$i] = array(
				'hour'  => $i,
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, HOUR(date_added) AS hour FROM `ticket` WHERE DATE(date_added) = DATE(NOW()) GROUP BY HOUR(date_added) ORDER BY date_added ASC");

		foreach ($query->result_array() as $result) {
			$ticket_data[$result['hour']] = array(
				'hour'  => $result['hour'],
				'total' => $result['total']
			);
		}
		
		return $ticket_data;
	}

	public function getTotalTicketsByWeek() {
		$implode = array();

		$ticket_data = array();

		$date_start = strtotime('-' . date('w') . ' days');

		for ($i = 0; $i < 7; $i++) {
			$date = date('Y-m-d', $date_start + ($i * 86400));

			$ticket_data[date('w', strtotime($date))] = array(
				'day'   => date('D', strtotime($date)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM `ticket` WHERE DATE(date_added) >= DATE('" . date('Y-m-d', $date_start) . "') GROUP BY DAYNAME(date_added)");

		foreach ($query->result_array() as $result) {
			$ticket_data[date('w', strtotime($result['date_added']))] = array(
				'day'   => date('D', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}
               
		return $ticket_data;
	}

	public function getTotalTicketsByMonth() {
		$implode = array();

		$ticket_data = array();

		for ($i = 1; $i <= date('t'); $i++) {
			$date = date('Y') . '-' . date('m') . '-' . $i;

			$ticket_data[date('j', strtotime($date))] = array(
				'day'   => date('d', strtotime($date)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM `ticket` WHERE DATE(date_added) >= " . date('Y') . '-' . date('m') . '-1' . " GROUP BY DATE(date_added)");

		foreach ($query->result_array() as $result) {
			$ticket_data[date('j', strtotime($result['date_added']))] = array(
				'day'   => date('d', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}

		return $ticket_data;
	}

	public function getTotalTicketsByYear() {
		$implode = array();

		$ticket_data = array();

		for ($i = 1; $i <= 12; $i++) {
			$ticket_data[$i] = array(
				'month' => date('M', mktime(0, 0, 0, $i)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM `ticket` WHERE YEAR(date_added) = YEAR(NOW()) GROUP BY MONTH(date_added)");

		foreach ($query->result_array() as $result) {
			$ticket_data[date('n', strtotime($result['date_added']))] = array(
				'month' => date('M', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}

		return $ticket_data;
	}
        
    /**
    * 
    * @function name : GetAll()
    * @description   : get All tickets records
    * @access        : public
    * @param   	     : void
    * @return        : array The all tickets
    *
    */
    public function getAllTicket($data = array())
    {
        $this->db->select('ticket.*,role.role_name as RoleName');
        $this->db->from('ticket');
        $this->db->join('role','ticket.department_id=role.role_id');
        $this->db->order_by('ticket_id','desc');
        $this->db->limit(5);
        $query=$this->db->get();
        return $query->result_array();
    }
        
}

?>