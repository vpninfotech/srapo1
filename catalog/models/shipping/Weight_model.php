<?php
/**
* 
* @file name   : Weight_model
* @Auther      : Indrajit
* @Date        : 21-01-2016
* @Description : Collection of various common function related to cart weight shipping operation.
*
*/
class Weight_model extends CI_Model 
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
        
        $this->lang->load('shipping/weight_model_lang', 'english');

        $this->load->library('tax');

        $this->load->library('currency');

        $this->load->library('mycart');

        $this->load->library('weight');
    }
	public function getQuote($country_id='') {
		$quote_data = array();

		$query = $this->db->query("SELECT * FROM country ORDER BY country_name");

		foreach ($query->result_array() as $result) {
			if ($this->common->config('weight_' . $country_id . '_status')) {
				$query = $this->db->query("SELECT * FROM country WHERE country_id = '" . (int)$country_id . "'");

				if ($query->num_rows() && $country_id === $result['country_id']) {
					$status = true;
				} else {
					$status = false;
				}
			} else {
				$status = false;
			}

			if ($status) {
				$cost = '';
				$weight = $this->mycart->getWeight();

				$rates = explode(',', $this->common->config('weight_' . $result['country_id'] . '_rate'));

				foreach ($rates as $rate) {
					$data = explode(':', $rate);

					if ($data[0] >= $weight) {
						if (isset($data[1])) {
							$cost = $data[1];
						}

						break;
					}
				}

				if ((string)$cost != '') {
					$quote_data['weight_' . $result['country_id']] = array(
						'code'         => 'weight.weight_' . $result['country_id'],
						'title'        => $result['country_name'] . '  (' . $this->lang->line('text_weight') . ' ' . $this->weight->format($weight, $this->common->config('config_weight_class_id')) . ')',
						'cost'         => $cost,
						'tax_class_id' => $this->common->config('weight_tax_class_id'),
						'text'         => $this->currency->format($this->tax->calculate($cost, $this->common->config('weight_tax_class_id'), $this->common->config('config_tax')))
					);
				}
			}
		}

		$method_data = array();

		if ($quote_data) {
			$method_data = array(
				'code'       => 'weight',
				'title'      => $this->lang->line('text_title'),
				'quote'      => $quote_data,
				'sort_order' => $this->common->config('weight_sort_order'),
				'error'      => false
			);
		}

		return $method_data;
	}
}