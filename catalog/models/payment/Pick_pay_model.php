<?php
/**
* 
* @file name   : Total_coupon_model
* @Auther      : Indrajit
* @Date        : 21-12-2016
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
        
    }
	public function getMethod($country_id, $total) 
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
				'title'      => 'Pick & Pay',
				'terms'      => '',
				'sort_order' => 1
			);
		}

		return $method_data;
	}
}