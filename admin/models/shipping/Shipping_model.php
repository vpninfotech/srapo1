<?php

/**
 * Payment Methods Model Class
 * Collection of various common function related to state database operation.
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Shipping_model extends CI_Model 
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
    * @function name 	: getShippingMethods()
    * @description   	: get all Shipping method from database
    * @access 		 	: public
    * @param   		 	: array $data
    * @return       	: array The selected state array
    *
    */
    public function getShippingMethods($data = array())
    {
        if($data)
        {
            $sql = "SELECT * FROM shipping_method WHERE 1=1";
           
            $sort_data = array(
                'shipping_method_name',
                'status'
            );
                
            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY " . $data['sort'];
            } else {
                $sql .= " ORDER BY shipping_method_name";
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
            $sql = "SELECT * FROM shipping_method ORDER BY shipping_method_name ASC";
        }

        $query = $this->db->query($sql);
        $query->result_array();
        return $query->result_array();
    }
	
    /**
    * 
    * @function name 	: getTotalShippingMethods()
    * @description   	: get total no of shipping from database
    * @access 			: public
    * @return       	: int total no of records
    *
    */
    public function getTotalShippingMethods() 
    {
        $sql = "SELECT COUNT(*) AS total FROM shipping_method";
        
        $query = $this->db->query($sql);

        return $query->row('total');
    }
}