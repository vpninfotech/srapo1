<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Common class
 * Collection of various common function that help to reduce code in projects.
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Commons 
{

	/**
	* 
	* @function name 	: __construct()
	* @description   	: initialize variables
	* @param   		 		: void
	* @return        	: void
	*
	*/
	public function __construct()	
	{
		// Get the CodeIgniter reference
    $this->_CI = &get_instance();
	}
	
	/**
	* 
	* @function name 	: token()
	* @description   	: generate 32 character token for login
	* @access 		 		: public
	* @param   		 		: int|32 $length The token length
	* @return        	: void
	*
	*/
	function token($length = 32)	
	{
		// Create token to login with
		$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		
		$token 	= '';
		
		for ($i = 0; $i < $length; $i++) 
		{
			$token .= $string[mt_rand(0, strlen($string) - 1)];
		}	
		
		return $token;
	}
	
	/**
	* 
	* @function name 	: encode()
	* @description   	: encode value in non readable format
	* @access 		 		: public
	* @param   		 		: string $value The value for encode
	* @return        	: string encoded value
	*
	*/
	function encode($value) 
	{
		return urlencode(base64_encode($value));
	}
	
	/**
	* 
	* @function name 	: decode()
	* @description   	: decode value in readable format
	* @access 		 		: public
	* @param   		 		: string $value The value for decode
	* @return        	: string decoded value
	*
	*/
	function decode($value) 
	{
		return base64_decode(urldecode($value));
	}
	
	/**
	* 
	* @function name 	: pagination()
	* @description   	: generate pagination link
	* @access 		 		: public
	* @param   		 		: string $url return url
	* @param   		 		: int $record_total The total no of records
	* @param   		 		: int $limit The per per page
	* @return        	: array $config The Pagination link
	*
	*/
	public function pagination($url,$record_total,$limit) 
	{
		$config = array();
		$config["base_url"] 		= $url;
		$config["total_rows"]           = $record_total;
		$config["per_page"] 		= $limit;
		$config['full_tag_open']	= '<ul class="pagination pagination-split pagination-sm pagination-contact">';
		$config['full_tag_close'] 	= '</ul>';
		$config['prev_link'] 		= '&lt;';
		$config['prev_tag_open'] 	= '<li>';
		$config['prev_tag_close'] 	= '</li>';
		$config['next_link'] 		= '&gt;';
		$config['next_tag_open'] 	= '<li>';
		$config['next_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li class="active"><a href="#">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';

		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';

		$config['first_link'] 		= '&lt;&lt;';
		$config['last_link'] 		= '&gt;&gt;';
                
		return $config;
	}
        
        /**
	* 
	* @function name 	: generate_randomnumber()
	* @description   	: generate random digit string
	* @access 		 		: public
	* @param   		 		: $len - lenght for generate digit string
	* @return        	: string
	*
	*/
    function generate_randomnumber($len)
	{
		$r_str = "";
			$chars = "0123456789";
			for($i=0; $i<$len; $i++) 
				$r_str .= substr($chars,rand(0,strlen($chars)),1);
			return $r_str;
	}
	
	function dateFormat($date='')
	{
		return date('Y-m-d',strtotime($date));
	}
        /**
	* 
	* @function name 	: time_ago()
	* @description   	: return time defference for given date
	* @access 		 		: public
	* @param   		 		: $date - date for generate time
	* @return        	: string
	*
	*/
	
	public function time_ago($date)
	{

        if(empty($date)) {
            return "No date provided";
        }

        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60","60","24","7","4.35","12","10");
        $now = time();
        $unix_date = strtotime($date);

        // check validity of date

        if(empty($unix_date)) {
            return "";
        }

        // is it future date or past date
        if($now > $unix_date) {
            $difference = $now - $unix_date;
            $tense = "ago";
        } else {
            $difference = $unix_date - $now;
            $tense = "from now";
        }
        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
            $difference /= $lengths[$j];
        }
        $difference = round($difference);
        if($difference != 1) {
            $periods[$j].= "s";
        }

        return "$difference $periods[$j] {$tense}";
    }
	
	
	 /**
	* 
	* @function name 	: neat_trim()
	* @description   	: return triming string for given string
	* @access 		 		: public
	* @param   		 		: $str - string for triming
	* @param   		 		: $n - total number of characte which you want
	* @param   		 		: $delim - delimeter for add behind string
	* @return        	: string
	*
	*/
	public function neat_trim($str, $n, $delim='...') 
	{
	   $len = strlen($str);
	   if ($len > $n) 
	   {
		   return substr($str, 0, $n). $delim;
	   }
	   else 
	   {
		   return $str;
	   }
	}
	
}