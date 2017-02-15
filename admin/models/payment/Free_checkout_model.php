<?php
/**
* 
* @file name   : Free_checkout_model
* @Auther      : Indrajit
* @Date        : 21-12-2016
* @Description : Collection of various common function related to cart coupons operation.
*
*/
class Free_checkout_model extends CI_Model 
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
        
        $this->lang->load('payment/free_checkout_model_lang', 'english');
    }
	
	public function getfree_checkoutCountries($filter=array())
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
				'code'       => 'free_checkout',
				'title'      => 'Free Checkout',
				'terms'      => '',
				'sort_order' => 1
			);
		}

		return $method_data;
	}
}