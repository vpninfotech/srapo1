<?php

/**
 * Sales Return Report Model Model Class
 * Collection of various common function related to return database operation.
 *
 * @author    Vinay Ghael
 * @license   http://www.vpninfotech.com/
 */
class Sales_return_report_model extends CI_Model 
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
	
        public function getReturns($data = array()) {
            $sql = "SELECT MIN(r.date_added) AS date_start, MAX(r.date_added) AS date_end, COUNT(r.return_id) AS `returns` FROM `return` r";
            
            $implode = array();
            
            if (!empty($data['filter_return_status_id'])) {
                $implode[] = "r.return_status_id = '" . (int)$data['filter_return_status_id'] . "'";
            } else {
                $implode[] = " r.return_status_id > '0'";
            }
            
            if (!empty($data['filter_date_start'])) {
                    $implode[] = "DATE(r.date_added) >= '" . $data['filter_date_start'] . "'";
            }

            if (!empty($data['filter_date_end'])) {
                    $implode[] = "DATE(r.date_added) <= '" . $data['filter_date_end'] . "'";
            }          
            
            if (isset($data['filter_group'])) {
                $group = $data['filter_group'];
            } else {
                $group = 'week';
            }
            
            if ($implode) {
                $sql .= " WHERE " . implode(" AND ", $implode);
            }   
            switch($group) {
                case 'day';
                    $sql .= " GROUP BY YEAR(r.date_added), MONTH(r.date_added), DAY(r.date_added)";
                    break;
                default:
                case 'week':
                    $sql .= " GROUP BY YEAR(r.date_added), WEEK(r.date_added)";
                    break;
                case 'month':
                    $sql .= " GROUP BY YEAR(r.date_added), MONTH(r.date_added)";
                    break;
                case 'year':
                    $sql .= " GROUP BY YEAR(r.date_added)";
                    break;
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
            //echo $this->db->last_query();
            return $query->result_array();
        }
        
        public function getTotalReturns($data = array()) {
            if (!empty($data['filter_group'])) {
                $group = $data['filter_group'];
            } else {
                $group = 'week';
            }

            switch($group) {
                case 'day';
                    $sql = "SELECT COUNT(DISTINCT YEAR(date_added), MONTH(date_added), DAY(date_added)) AS total FROM `return`";
                    break;
                    default:
                case 'week':
                    $sql = "SELECT COUNT(DISTINCT YEAR(date_added), WEEK(date_added)) AS total FROM `return`";
                    break;
                case 'month':
                    $sql = "SELECT COUNT(DISTINCT YEAR(date_added), MONTH(date_added)) AS total FROM `return`";
                    break;
                case 'year':
                    $sql = "SELECT COUNT(DISTINCT YEAR(date_added)) AS total FROM `return`";
                    break;
            }

            if (!empty($data['filter_return_status_id'])) {
                    $sql .= " WHERE return_status_id = '" . (int)$data['filter_return_status_id'] . "'";
            } else {
                    $sql .= " WHERE return_status_id > '0'";
            }

            if (!empty($data['filter_date_start'])) {
                    $sql .= " AND DATE(date_added) >= '" . $data['filter_date_start'] . "'";
            }

            if (!empty($data['filter_date_end'])) {
                    $sql .= " AND DATE(date_added) <= '" . $data['filter_date_end'] . "'";
            }

            $query = $this->db->query($sql);

            return $query->row('total');
    }
}

?>