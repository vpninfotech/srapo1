<?php
/**
* 
* @file name   : pick_pay_model
* @Auther      : Nitin
* @Date        : 2-2-2017
* @Description : Collection of various common function related to cart coupons operation.
*
*/
class Pick_pay_model extends CI_Model 
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
        
        $this->lang->load('payment/pick_pay_model_lang', 'english');
    }
	
	public function getpick_payCountries($filter=array())
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
	
	public function getMethod($address, $total) 
	{
		if ($total <= 0.00) {
			$status = true;
		} else {
			$status = false;
		}
		$status = true;
		$method_data = array();

		if ($status) {
			$method_data = array(
				'code'       => 'pick_pay',
				'title'      => 'Pick and Pay',
				'terms'      => '',
				'sort_order' => 1
			);
		}

		return $method_data;
	}
}