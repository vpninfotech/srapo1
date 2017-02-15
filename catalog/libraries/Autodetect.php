<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Currency class
 * Collection of various common function related to Currency Auto detect.
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Autodetect 
{

	public function __construct()	
	{
     
            $this->_CI =& get_instance();
			$this->detect();
            
	}
	
	public function detect() 
	{
		$resp = array();
	
		if (!isset($_SERVER['REMOTE_ADDR'])) {
			$res = array('error'=>'true');
			return $res;

		}

		if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];	            
        } else if(!empty($_SERVER['REMOTE_ADDR'])) {
        			$ip = $_SERVER['REMOTE_ADDR'];	
        } else {
        			$ip = "";
        }   

        if(!preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/', $ip)){
        	$ip = '';
        }
		
	 	$this->_CI->load->library('Currency');
	 	//$json = file_get_contents("http://ipinfo.io/{$ip}");
	  	//$details = json_decode($json);
		//$query = $this->_CI->db->query("SELECT * FROM currency_country where country_code='".$dataArray->geoplugin_countryCode."'");
		
		//if($query->num_rows()>0)
		//{
		//	$this->_CI->currency->set($query->row()->currency_code); 
		//}
		//else
		//{
		//	$this->_CI->currency->set('INR'); 
		//}
                //echo $this->_CI->session->userdata('currency');
	 	
		$response = @file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip);
		if ($response) {
		 
		    $dataArray = json_decode($response);
			$dataArray = (array)$dataArray;
			if(is_array($dataArray) and isset($dataArray) and isset($dataArray['geoplugin_currencyCode']) and $dataArray['geoplugin_currencyCode']!==NULL)
			{
				$this->_CI->currency->set($dataArray['geoplugin_currencyCode']); 	
                                $this->_CI->session->set_userdata('country_name',$dataArray['geoplugin_countryName']); 
			}
			else
			{
				$this->_CI->currency->set('INR'); 
                                $this->_CI->session->set_userdata('country_name','India'); 
			}
		} else {
		   
		   $this->_CI->currency->set('INR'); 
                    $this->_CI->session->set_userdata('country_name','India'); 
		}
                //echo $this->_CI->session->userdata('currency');
	}
	
}