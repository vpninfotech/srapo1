<?php

/**
 * Payment Methods Model Class
 * Collection of various common function related to state database operation.
 *
 * @author    Vinay
 * @license   http://www.vpninfotech.com/
 */
class Ccavenue_model extends CI_Model 
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
            $this->lang->load('payment/ccavenue_model_lang', 'english');
    }
       
	public function getCcavenueCountries($filter=array())
	{
		$filter = str_replace('"','',$filter);
		$filter = str_replace('[','',$filter);
		$filter = str_replace(']','',$filter);
		$filter = explode(',', $filter);
		$this->db->select('country_id,country_name');
		$this->db->where_in('country_id', $filter);
		$query = $this->db->get('country');
		
		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	}
	public function getMethod($country_id, $total) {
		
		$country_list = json_decode($this->common->config('ccavenue_payment_country_id'),TRUE);
		
		if ($this->common->config('ccavenue_total') > $total) {
			$status = false;
		} elseif (!$this->common->config('ccavenue_payment_country_id')) {
			$status = true;
		} elseif (in_array($country_id,$country_list)) {
			$status = true;
		} else {
			$status = false;
		}	
			
					
		$method_data = array();
	
		if ($status) {  
      		$method_data = array( 
        		'code'       => 'ccavenue',
        		'title'      => $this->lang->line('text_title'),
				'terms'      => '',
				'sort_order' => $this->common->config('ccavenue_sort_order')
      		);
    	}
   
    	return $method_data;
  	}
	
   
}