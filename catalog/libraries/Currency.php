<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Currency class
 * Collection of various common function related to currency.
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Currency 
{
	private $code;
	private $currencies = array();
	
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
            
            $this->_CI->load->language('currency_lang');
            
            $query = $this->_CI->db->query("SELECT * FROM currency");
            
            foreach ($query->result_array() as $result) {
                $this->currencies[$result['code']] = array(
                    'currency_id'   => $result['currency_id'],
                    'title'         => $result['title'],
                    'symbol_left'   => $result['symbol_left'],
                    'symbol_right'  => $result['symbol_right'],
                    'decimal_place' => $result['decimal_place'],
                    'value'         => $result['value']
                );
            }
            //print_r($result);
            if (($this->_CI->session->userdata('currency') !== NULL) && (array_key_exists($this->_CI->session->userdata('currency'), $this->currencies))) {
            $this->set($this->_CI->session->userdata('currency'));
            } 
            else
            {
                $this->set($this->_CI->common->config('config_currency'));
            }
	}
    public function set($currency) {
        $this->code = $currency;

        if ($this->_CI->session->userdata('currency') == NULL || ($this->_CI->session->userdata('currency') != $currency)) {
            $this->_CI->session->set_userdata('currency', $currency);
        }
        return $this->code;
        
    }
        
        public function format ($number, $currency='', $value = '', $format = true) 
        {
		
            if ($currency && $this->has($currency)) 
            {
                $symbol_left   = $this->currencies[$currency]['symbol_left'];
                $symbol_right  = $this->currencies[$currency]['symbol_right'];
                $decimal_place = $this->currencies[$currency]['decimal_place'];
            } 
            else 
            {
            $symbol_left   = $this->currencies[$this->code]['symbol_left'];
            $symbol_right  = $this->currencies[$this->code]['symbol_right'];
            $decimal_place = $this->currencies[$this->code]['decimal_place'];

            $currency = $this->code;
            }
            
            if (!$value) {
                $value = $this->currencies[$currency]['value'];
            }
            
            $amount = $value ? (float)$number * $value : (float)$number;
            
            $amount = round($amount, (int)$decimal_place);
            
            if (!$format) {
                return $amount;
            }
            
            $string = '';

            if ($symbol_left) {
                $string .= $symbol_left;
            }
            
            $string .= number_format($amount, (int)$decimal_place, $this->_CI->lang->line('decimal_point'), $this->_CI->lang->line('thousand_point'));

            if ($symbol_right) {
                    $string .= $symbol_right;
            }
			
            return $string;
        }
	 public function getCurrencySymbol($currency='') 
        {
            
            if ($currency && $this->has($currency)) 
            {
                $symbol_left   = $this->currencies[$currency]['symbol_left'];
                $symbol_right  = $this->currencies[$currency]['symbol_right'];
                $decimal_place = $this->currencies[$currency]['decimal_place'];
            } 
            else 
            {
                $symbol_left   = $this->currencies[$this->code]['symbol_left'];
                $symbol_right  = $this->currencies[$this->code]['symbol_right'];
                $decimal_place = $this->currencies[$this->code]['decimal_place'];

                $currency = $this->code;
            }
            
            $string = '';

            if ($symbol_left) {
                 $string .= $symbol_left;
             }
            
             if ($symbol_right) {
                     $string .= $symbol_right;
             }
            
            return $string;
        }
	/**
	* 
	* @function name 	: convert_currency()
	* @description   	: convert one currency to other currency
	* @access 		 		: public
	* @param   		 		: double $value The product amount
	* @param   		 		: string $from The current currency
	* @param   		 		: string $to The currency that you want
	* @return       	: double $value The converted amount
	*
	*/
	public function convert($value, $from, $to)	
	{
            if (isset($this->currencies[$from])) 
            {
                $from = $this->currencies[$from]['value'];
            } else 
            {
                $from = 1;
            }

            if (isset($this->currencies[$to])) 
            {
                $to = $this->currencies[$to]['value'];
            } 
            else 
            {
                $to = 1;
            }
            return $value * ($to / $from);
	}
        
 //        public function getId($currency) 
 //        {
 //            if (isset($this->currencies[$currency])) {
 //                return $this->currencies[$currency]['currency_id'];
 //            } else {
 //                return 0;
 //            }
	// }
        public function getId($currency = '') {
            if (!$currency) {
                return $this->currencies[$this->code]['currency_id'];
            } elseif ($currency && isset($this->currencies[$currency])) {
                return $this->currencies[$currency]['currency_id'];
            } else {
                return 0;
            }
        }
        
        public function getSymbolLeft($currency) {
            if (isset($this->currencies[$currency])) {
                return $this->currencies[$currency]['symbol_left'];
            } else {
                return '';
            }
	}
        
        public function getSymbolRight($currency) {
            if (isset($this->currencies[$currency])) {
                return $this->currencies[$currency]['symbol_right'];
            } else {
                return '';
            }
	}

	public function getDecimalPlace($currency) {
            if (isset($this->currencies[$currency])) {
                return $this->currencies[$currency]['decimal_place'];
            } else {
                return 0;
            }
	}
        
        public function getValue($currency) {
            if (isset($this->currencies[$currency])) {
                return $this->currencies[$currency]['value'];
            } else {
                return 0;
            }
	}

	public function has($currency) {
            return isset($this->currencies[$currency]);
	}

    public function getCode() {
        return $this->code;
    }
        
	
	
}