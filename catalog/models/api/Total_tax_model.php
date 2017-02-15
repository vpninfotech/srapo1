<?php
/**
* 
* @file name   : Total_tax_model
* @Auther      : Indrajit
* @Date        : 22-12-2016
* @Description : Collection of various common function related to Cart tax total.
*
*/
class Total_tax_model extends CI_Model 
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
        
        $this->load->library('mycart');
        
        $this->load->library('tax');

    }
	public function getTotal(&$total_data, &$total, &$taxes) {
		foreach ($taxes as $key => $value) {
			if ($value > 0) {
				$total_data[] = array(
					'code'       => 'tax',
					'title'      => $this->tax->getRateName($key),
					'value'      => $value,
					'sort_order' => 1
				);

				$total += $value;
			}
		}
	}
}