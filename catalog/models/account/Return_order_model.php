 <?php

/**
 * Return Order Model Class
 * Collection of various common function related to Order database operation.
 *
 * @author    Vinay Ghael
 * @license   http://www.vpninfotech.com/
 */
class Return_order_model extends CI_Model 
{
    /**
    * 
    * @function name 	: __construct()
    * @description   	: initialize variables
    * @param   		: void
    * @return        	: void
    *
    */
    public function __construct()
    {
        parent::__construct();
    }
    
    
    /**
    * 
    * @function name : addReturn()
    * @description   : add return_product record in database
    * @access        : public
    * @return        : int last inserted return_product record id
    *
    */
    public function addReturn($data) 
    {	
        $this->db->set('order_id',(int)$data['order_id']);
        $this->db->set('customer_id',(int)$this->session->userdata('customer_id'));
        $this->db->set('firstname',$data['firstname']);
        $this->db->set('lastname',$data['lastname']);
        $this->db->set('email',$data['email']);
        $this->db->set('telephone',$data['telephone']);
        $this->db->set('product',$data['product']);
        $this->db->set('model',$data['model']);
        $this->db->set('quantity',$data['quantity']);
        $this->db->set('opened',(int)$data['opened']);
        $this->db->set('return_reason_id',(int)$data['return_reason_id']);
        $this->db->set('return_status_id',(int)$this->common->config('config_return_status_id'));
        $this->db->set('comment',$data['comment']);
        $this->db->set('date_ordered',$data['date_ordered']);
        $this->db->set('date_added',date('Y-m-d h:i:sa'));
        $this->db->set('added_by', $this->session->userdata('customer_id'));
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('customer_id'));
        $this->db->insert('return');
        return $this->db->insert_id();
    }
        
    /**
    * 
    * @function name 	: getTotalReturns()
    * @description   	: get total no of order returns from database
    * @access 		: public
    * @return       	: int total no of records
    *
    */
    public function getTotalReturns() {
        $sql = "SELECT COUNT(*) AS total FROM `return` WHERE customer_id = '".$this->session->userdata('customer_id')."'";
        $query = $this->db->query($sql);
        return $query->row('total');
    }
    
    public function getReturn($return_id) {
        $query = $this->db->query("SELECT r.return_id, r.order_id, r.firstname, r.lastname, r.email, r.telephone, r.product, r.model, r.quantity, r.opened, (SELECT rr.return_reason_name FROM return_reason rr WHERE rr.return_reason_id = r.return_reason_id) AS reason, (SELECT ra.return_action_name FROM return_action ra WHERE ra.return_action_id = r.return_action_id) AS action, (SELECT rs.return_status_name FROM return_status rs WHERE rs.return_status_id = r.return_status_id) AS status, r.comment, r.date_ordered, r.date_added, r.date_modified FROM `return` r WHERE r.return_id = '" . (int)$return_id . "' AND r.customer_id = '" . $this->customer->getId() . "'");

        return $query->row_array();
    }
        
    /**
    * 
    * @function name 	: getReturns()
    * @description   	: get all Order Returns from database
    * @access 		: public
    * @param   		: string $data The Order that you want to get
    * @return       	: array The selected Order array
    *
    */
    public function getReturns($data = array()) {
        //print_r($data);
        $sql = "SELECT r.return_id, r.order_id, r.firstname, r.lastname, rs.return_status_name as status, r.date_added FROM `return` r LEFT JOIN return_status rs ON (r.return_status_id = rs.return_status_id) WHERE r.customer_id = '" . $this->customer->getId() . "'";
        
        $sql .= " ORDER BY r.return_id ";
        
        $sql .= " DESC";
        

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }
        //echo $sql;
        $query = $this->db->query($sql);
        return $query->result_array();
    } 
    
    public function getReturnHistories($return_id) {
        $query = $this->db->query("SELECT rh.date_added, rs.return_status_name AS status, rh.comment FROM return_history rh LEFT JOIN return_status rs ON rh.return_status_id = rs.return_status_id WHERE rh.return_id = '" . (int)$return_id . "' ORDER BY rh.date_added ASC");

        return $query->result_array();
    }
}

?>