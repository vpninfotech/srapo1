<?php
/**
* 
* @file name   : Total_subtotal_model
* @Auther      : Indrajit
* @Date        : 22-12-2016
* @Description : Collection of various common function related to Cart sub total.
*
*/
class Total_sub_total_model extends CI_Model 
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

         $this->lang->load('api/total_subtotal_model_lang', 'english');
    }
	public function getTotal(&$total_data, &$total, &$taxes) 
	{
		$sub_total = $this->mycart->getSubTotal();

		if ($this->session->userdata('vouchers') !== NULL) 
		{
			foreach ($this->session->userdata('vouchers') as $voucher) 
			{
				$sub_total += $voucher['amount'];
			}
		}

		$total_data[] = array(
			'code'       => 'sub_total',
			'title'      => 'Sub-Total',
			'value'      => $sub_total,
			'sort_order' => 1
		);

		$total += $sub_total;
	}
}