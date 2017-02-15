<?php

/**
 * Payment Methods Model Class
 * Collection of various common function related to state database operation.
 *
 * @author    Vinay
 * @license   http://www.vpninfotech.com/
 */
class Payments_model extends CI_Model 
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
       
    /**
    * 
    * @function name 	: getWeightShippings()
    * @description   	: get all WeightShipping from database
    * @access 		 	: public
    * @param   		 	: array $data
    * @return       	: array The selected state array
    *
    */
    public function getPaymentMethods($data = array())
    {
        if($data)
        {
            $sql = "SELECT * FROM payment_method WHERE 1=1";
            //$sql = "SELECT sm.*,sc.*,sm.is_deleted as is_deleted FROM shipping_method sm join shipping_method_country sc on sm.shipping_method_id=sc.shipping_method_id WHERE 1=1";

            $sort_data = array(
                'payment_method_name',
                'status'
            );
                
            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY " . $data['sort'];
            } else {
                $sql .= " ORDER BY payment_method_name";
            }

            if (isset($data['order']) && ($data['order'] == 'DESC')) {
                $sql .= " DESC";
            } else {
                $sql .= " ASC";
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
        }
        else
        {
            $sql = "SELECT * FROM payment_method ORDER BY payment_method_name ASC";
        }

        $query = $this->db->query($sql);
        $query->result_array();
        //echo $this->db->last_query();
        return $query->result_array();
    }
	
    /**
    * 
    * @function name 	: getTotalPaymentMethods()
    * @description   	: get total no of weight shipping from database
    * @access 		: public
    * @return       	: int total no of records
    *
    */
    public function getTotalPaymentMethods() 
    {
        $sql = "SELECT COUNT(*) AS total FROM payment_method";
        
        $query = $this->db->query($sql);

        return $query->row('total');
    }
	
   
}