<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Length class
 * Collection of various common function related to currency.
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Length 
{
    private $unit;
    private $lengths = array();
	
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

        $query = $this->_CI->db->query("SELECT * FROM length");

        foreach ($query->result_array() as $result) {
            $this->lengths[$result['length_id']] = array(
                'length_id'     => $result['length_id'],
                'title'         => $result['title'], 
                'unit'          => $result['unit'], 
                'value'         => $result['value']
            );
        }
    }
    
    /**
    * 
    * @function name 	: convert()
    * @description   	: convert length from one unit to other unit
    * @access 		: public
    * @param   		: double $value The product length
    * @param   		: string $from The current length unit
    * @param   		: string $to The length unit that you want
    * @return       	: double $value The converted length
    *
    */
    public function convert($value, $from, $to)	
    {
        if ($from == $to) {
            return $value;
        }

        if (isset($this->lengths[$from])) {
            $from = $this->lengths[$from]['value'];
        } else {
            $from = 1;
        }

        if (isset($this->lengths[$to])) {
            $to = $this->lengths[$to]['value'];
        } else {
            $to = 1;
        }

        return $value * ($to / $from);
    }

    public function format($value, $length_class_id, $decimal_point = '.', $thousand_point = ',') {
        if (isset($this->lengths[$length_class_id])) {
            return number_format($value, 2, $decimal_point, $thousand_point) . $this->lengths[$length_class_id]['unit'];
        } else {
            return number_format($value, 2, $decimal_point, $thousand_point);
        }
    }

    public function getUnit($length_class_id) {
        if (isset($this->lengths[$length_class_id])) {
            return $this->lengths[$length_class_id]['unit'];
        } else {
            return '';
        }
    }
}