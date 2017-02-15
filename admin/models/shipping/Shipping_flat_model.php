<?php
/**
* 
* @file name   : Total_coupon_model
* @Auther      : Indrajit
* @Date        : 21-12-2016
* @Description : Collection of various common function related to cart coupons operation.
*
*/
class Shipping_flat_model extends CI_Model 
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
        
        $this->lang->load('shipping/shipping_flat_model_lang', 'english');

        $this->load->library('tax');

        $this->load->library('currency');
    }
	function getQuote($address) 
	{
		$query = $this->db->query("SELECT * FROM shipping_method where shipping_code = 'flat' limit 1 ");

		if ($query->num_rows()) 
		{
			$status = true;
		}
		else 
		{
			$status = false;
		}

		$method_data = array();

		if ($status) 
		{

			$quote_data = array();

			$quote_data['flat'] = array(
				'code'         => 'flat.flat',
				'title'        => $this->lang->line('text_description'),
				'cost'         => $query->row('rate'),
				'tax_class_id' => $query->row('tax_class_id'),
				'text'         => $this->currency->format($this->tax->calculate($query->row('rate'), $query->row('tax_class_id')))
			);

			$method_data = array(
				'code'       => 'flat',
				'title'      => $this->lang->line('text_title'),
				'quote'      => $quote_data,
				'sort_order' => 1,
				'error'      => false
			);
		}

		return $method_data;
	}
}