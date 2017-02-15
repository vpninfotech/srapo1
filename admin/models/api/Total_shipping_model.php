<?php
/**
* 
* @file name   : Total_shipping_model
* @Auther      : Indrajit
* @Date        : 22-12-2016
* @Description : Collection of various common function related to cart shipping total.
*
*/
class Total_shipping_model  extends CI_Model 
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
        
        $this->load->library('customer');

        $this->load->library('tax');
    }
	public function getTotal(&$total_data, &$total, &$taxes) 
	{
		if ($this->mycart->hasShipping() && $this->session->userdata('shipping_method') !== NULL) 
		{
			$shipping_method = $this->session->userdata('shipping_method');
			$total_data[] = array(
				'code'       => 'shipping',
				'title'      => $shipping_method['title'],
				'value'      => $shipping_method['cost'],
				'sort_order' => 1
			);

			if (isset($shipping_method['tax_class_id'])) 
			{
				$tax_rates = $this->tax->getRates($shipping_method['cost'], $shipping_method['tax_class_id']);

				foreach ($tax_rates as $tax_rate) {
					if (!isset($taxes[$tax_rate['tax_rate_id']])) {
						$taxes[$tax_rate['tax_rate_id']] = $tax_rate['amount'];
					} else {
						$taxes[$tax_rate['tax_rate_id']] += $tax_rate['amount'];
					}
				}
			}

			$total += $shipping_method['cost'];
		}
	}
}