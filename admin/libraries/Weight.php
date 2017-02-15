<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Weight class
 * Collection of various common function related to currency.
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Weight 
{
    private $unit;
    private $weights = array();
	
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
        // Get the CodeIgniter reference
        $this->_CI =& get_instance();

        $this->_CI->load->model('common');

        //$this->_CI->load->language('length_lang');

        $query = $this->_CI->db->query("SELECT * FROM weight");

        foreach ($query->result_array() as $result) {
            $this->weights[$result['weight_id']] = array(
                'weight_id'     => $result['weight_id'],
                'title'         => $result['title'], 
                'unit'          => $result['unit'], 
                'value'         => $result['value']
            );
        }
    }
    
    /**
    * 
    * @function name 	: convert()
    * @description   	: convert weight from one unit to other unit
    * @access 		: public
    * @param   		: double $value The product weight
    * @param   		: string $from The current weight unit
    * @param   		: string $to The weight unit that you want
    * @return       	: double $value The converted weight
    *
    */
    public function convert($value, $from, $to)	
    {
        if ($from == $to) {
            return $value;
        }

        if (isset($this->weights[$from])) {
            $from = $this->weights[$from]['value'];
        } else {
            $from = 1;
        }

        if (isset($this->weights[$to])) {
            $to = $this->weights[$to]['value'];
        } else {
            $to = 1;
        }

        return $value * ($to / $from);
    }

    public function format($value, $weight_class_id, $decimal_point = '.', $thousand_point = ',') {
        if (isset($this->weights[$weight_class_id])) {
            return number_format($value, 2, $decimal_point, $thousand_point) . $this->weights[$weight_class_id]['unit'];
        } else {
            return number_format($value, 2, $decimal_point, $thousand_point);
        }
    }

    public function getUnit($weight_class_id) {
        if (isset($this->weights[$weight_class_id])) {
            return $this->weights[$weight_class_id]['unit'];
        } else {
            return '';
        }
    }
}