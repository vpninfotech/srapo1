<?php

/**
 * Payment Methods Model Class
 * Collection of various common function related to state database operation.
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Weight_model extends CI_Model 
{
    /**
    * 
    * @function name 	: __construct()
    * @description   	: initialize variables
    * @param   		 	: void
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
	
	public function getWeightCountry()
	{
		$query = $this->db->query("SELECT * FROM `setting` WHERE `key` LIKE 'Weight_%_rate'");
		
		$records = $query->result_array();
		$data = array();
		foreach($records as $record)
		{
			$val = explode('weight_',$record['key']);
			
			$val = explode('_rate',$val[1]);
			$data[] = $val[0];
		}
		
		return $data;
	}
	public function getWeightRelatedCountry($countries=array())
	{
		if(count($countries)>0)
		{
			$this->db->select('country_id,country_name');
			$this->db->where_in('country_id', $countries);
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
		else
		{
			return array();
		}
	}
	public function getQuote($country_id='') {
		$quote_data = array();

		$query = $this->db->query("SELECT * FROM country ORDER BY country_name");

		foreach ($query->result_array() as $result) {
			if ($this->common->config('weight_' . $country_id . '_status')) 
			{
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