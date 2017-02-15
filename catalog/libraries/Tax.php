<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Tax class
 * Collection of various common function related to Tax.
 *
 * @author    Indrajit
 * @license   http://www.vpninfotech.com/
 */
final class Tax 
{
	private $tax_rates = array();

	public function __construct()
	{
		 // Get the CodeIgniter reference
         $this->_CI =& get_instance();

		if ($this->_CI->session->userdata('shipping_address') !=NULL)
		{
			$shipping_address = $this->_CI->session->userdata('shipping_address');
			$this->setShippingAddress($shipping_address['country_id']);
		} 

		if ($this->_CI->session->userdata('payment_address') != NULL)
		{
			$payment_address = $this->_CI->session->userdata('payment_address');
			$this->setPaymentAddress($payment_address['country_id']);
		} 
                $this->setStoreAddress($this->_CI->common->config('config_country_id'), $this->_CI->common->config('config_zone_id'));

	}

	public function setShippingAddress($country_id)
	{
		$tax_query = $this->_CI->db->query("SELECT tr1.tax_class_id, tr2.tax_rate_id, tr2.name, tr2.rate, tr2.type, tr1.priority FROM tax_rule tr1 
			LEFT JOIN tax_rate tr2 ON (tr1.tax_rate_id = tr2.tax_rate_id)
			LEFT JOIN country c ON (tr2.country_id = c.country_id)
			WHERE tr1.based = 'shipping'  AND tr2.country_id = '" . (int)$country_id . "' ORDER BY tr1.priority ASC");

		foreach ($tax_query->result_array() as $result) {
			$this->tax_rates[$result['tax_class_id']][$result['tax_rate_id']] = array(
				'tax_rate_id' => $result['tax_rate_id'],
				'name'        => $result['name'],
				'rate'        => $result['rate'],
				'type'        => $result['type'],
				'priority'    => $result['priority']
			);
		}
	}

	public function setPaymentAddress($country_id)
	{
		$tax_query = $this->_CI->db->query("SELECT tr1.tax_class_id, tr2.tax_rate_id, tr2.name, tr2.rate, tr2.type, tr1.priority 
			FROM tax_rule tr1 
			LEFT JOIN tax_rate tr2 ON (tr1.tax_rate_id = tr2.tax_rate_id) 
			LEFT JOIN country c ON (tr2.country_id = c.country_id)
			 WHERE tr1.based = 'payment' AND tr2.country_id = '" . (int)$country_id . "' ORDER BY tr1.priority ASC");

		foreach ($tax_query->result_array() as $result) {
			$this->tax_rates[$result['tax_class_id']][$result['tax_rate_id']] = array(
				'tax_rate_id' => $result['tax_rate_id'],
				'name'        => $result['name'],
				'rate'        => $result['rate'],
				'type'        => $result['type'],
				'priority'    => $result['priority']
			);
		}
	}
        
        public function setStoreAddress($country_id, $zone_id) {
		$tax_query = $this->_CI->db->query("SELECT tr1.tax_class_id, tr2.tax_rate_id, tr2.name, tr2.rate, tr2.type, tr1.priority FROM tax_rule tr1 LEFT JOIN tax_rate tr2 ON (tr1.tax_rate_id = tr2.tax_rate_id) LEFT JOIN country c ON (tr2.country_id = c.country_id) WHERE tr1.based = 'store' AND tr2.country_id = '" . (int)$country_id . "' ORDER BY tr1.priority ASC");

		foreach ($tax_query->result_array() as $result) {
			$this->tax_rates[$result['tax_class_id']][$result['tax_rate_id']] = array(
				'tax_rate_id' => $result['tax_rate_id'],
				'name'        => $result['name'],
				'rate'        => $result['rate'],
				'type'        => $result['type'],
				'priority'    => $result['priority']
			);
		}
	}
	
	public function calculate($value, $tax_class_id, $calculate = true) 
	{
		if ($tax_class_id && $calculate) {
			$amount = 0;

			$tax_rates = $this->getRates($value, $tax_class_id);

			foreach ($tax_rates as $tax_rate) {
				if ($calculate != 'P' && $calculate != 'F') {
					$amount += $tax_rate['amount'];
				} elseif ($tax_rate['type'] == $calculate) {
					$amount += $tax_rate['amount'];
				}
			}

			return $value + $amount;
		} else {
			return $value;
		}
	}

	public function getTax($value, $tax_class_id) 
	{
		$amount = 0;

		$tax_rates = $this->getRates($value, $tax_class_id);

		foreach ($tax_rates as $tax_rate) {
			$amount += $tax_rate['amount'];
		}

		return $amount;
	}

	public function getRateName($tax_rate_id) 
	{
		$tax_query = $this->_CI->db->query("SELECT name FROM tax_rate WHERE tax_rate_id = '" . (int)$tax_rate_id . "'");

		if ($tax_query->num_rows()) 
		{
			return $tax_query->row('name');
		} else {
			return false;
		}
	}

	public function getRates($value, $tax_class_id) 
	{
		$tax_rate_data = array();

		if (isset($this->tax_rates[$tax_class_id])) {
			foreach ($this->tax_rates[$tax_class_id] as $tax_rate) {
				if (isset($tax_rate_data[$tax_rate['tax_rate_id']])) {
					$amount = $tax_rate_data[$tax_rate['tax_rate_id']]['amount'];
				} else {
					$amount = 0;
				}

				if ($tax_rate['type'] == 'F') {
					$amount += $tax_rate['rate'];
				} elseif ($tax_rate['type'] == 'P') {
					$amount += ($value / 100 * $tax_rate['rate']);
				}

				$tax_rate_data[$tax_rate['tax_rate_id']] = array(
					'tax_rate_id' => $tax_rate['tax_rate_id'],
					'name'        => $tax_rate['name'],
					'rate'        => $tax_rate['rate'],
					'type'        => $tax_rate['type'],
					'amount'      => $amount
				);
			}
		}

		return $tax_rate_data;
	}

	public function has($tax_class_id) {
		return isset($this->taxes[$tax_class_id]);
	}
}
