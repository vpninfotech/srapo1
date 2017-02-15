<?php
/**
* 
* @file name   : Total_coupon_model
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
				'code'       => 'free_checkout',
				'title'      => 'Free Checkout',
				'terms'      => '',
				'sort_order' => 1
			);
		}

		return $method_data;
	}
}