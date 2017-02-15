<?php
/**
* 
* @file name   : Total_tax_model
* @Auther      : Indrajit
* @Date        : 22-12-2016
* @Description : Collection of various common function related to Cart tax total.
*
*/
class Total_total_model extends CI_Model 
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

        $this->lang->load('api/total_total_model_lang', 'english');

    }
	public function getTotal(&$total_data, &$total, &$taxes) 
	{
		$total_data[] = array(
			'code'       => 'total',
			'title'      => $this->lang->line('text_total'),
			'value'      => max(0, $total),
			'sort_order' => 1
		);
	}
}