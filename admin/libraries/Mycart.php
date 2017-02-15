<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Mycart class
 * Collection of various common function related to Cart.
 *
 * @author    Indrajit
 * @license   http://www.vpninfotech.com/
 */
class Mycart {
	private $data = array();

	public function __construct()
	{
		 // Get the CodeIgniter reference
         $this->_CI =& get_instance();

         $this->_CI->load->library('customer');
          $this->_CI->load->library('weight');

         $this->session_id = session_id();

		// Remove all the expired carts with no customer ID
		$this->_CI->db->query("DELETE FROM cart WHERE customer_id = '0' AND date_added < DATE_SUB(NOW(), INTERVAL 1 HOUR)");

		if ($this->_CI->customer->getId()) 
		{
			// We want to change the session ID on all the old items in the customers cart
			$this->_CI->db->query("UPDATE cart SET session_id = '" . $this->session_id . "' WHERE customer_id = '" . (int)$this->_CI->customer->getId() . "'");

			// Once the customer is logged in we want to update the customer ID on all items he has
			$cart_query = $this->_CI->db->query("SELECT * FROM cart WHERE customer_id = '0' AND session_id = '" . $this->session_id . "'");

			foreach ($cart_query->result_array() as $cart) {
				$this->_CI->db->query("DELETE FROM cart WHERE cart_id = '" . (int)$cart['cart_id'] . "'");

				// The advantage of using $this->add is that it will check if the products already exist and increaser the quantity if necessary.
				$this->add($cart['product_id'], $cart['quantity'], json_decode($cart['option']));
			}
		}
	}

	public function getProducts() 
	{
		$product_data = array();

		$cart_query = $this->_CI->db->query("SELECT * FROM cart WHERE customer_id = '" . (int)$this->_CI->customer->getId() . "' AND session_id = '" .$this->session_id . "'");
		// echo "<pre>";
		// print_r($cart_query->result_array());
		foreach ($cart_query->result_array() as $cart) 
		{
			// echo "<pre>cart";
			// print_r($cart);
			$stock = true;

			$product_query = $this->_CI->db->query("SELECT * FROM product p where p.product_id = '" . (int)$cart['product_id'] . "' AND p.date_available <= NOW() AND p.status = '1'");
			
			if ($product_query->num_rows() && ($cart['quantity'] > 0)) 
			{
				$option_price = 0;
				$option_points = 0;
				$option_weight = 0;

				$option_data = array();

				foreach (json_decode($cart['option']) as $product_option_id => $value) 
				{
					$option_query = $this->_CI->db->query("SELECT po.product_option_id, po.option_id, o.name, o.type FROM product_option po 
						LEFT JOIN `option` o ON (po.option_id = o.option_id) 
						WHERE po.product_option_id = '" . (int)$product_option_id . "' AND po.product_id = '" . (int)$cart['product_id'] . "'");
					
					if ($option_query->num_rows())
					{

						if ($option_query->row('type') == 'select' || $option_query->row('type') == 'radio' || $option_query->row('type') == 'image')
						{
							$option_value_query = $this->_CI->db->query("SELECT pov.option_value_id, ov.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM product_option_value pov 
								LEFT JOIN option_value ov ON (pov.option_value_id = ov.option_value_id) 
								WHERE pov.product_option_value_id = '" . (int)$value . "' AND pov.product_option_id = '" . (int)$product_option_id . "'");
							
							if ($option_value_query->num_rows())
							{
								if ($option_value_query->row('price_prefix') == '+') {
									$option_price += $option_value_query->row('price');
								} 
								elseif ($option_value_query->row('price_prefix') == '-') 
								{
									$option_price -= $option_value_query->row('price');
								}

								if ($option_value_query->row('points_prefix') == '+')
								{
									$option_points += $option_value_query->row('points');
								} 
								elseif ($option_value_query->row('points_prefix') == '-') {
									$option_points -= $option_value_query->row('points');
								}

								if ($option_value_query->row('weight_prefix') == '+')
								{
									$option_weight += $option_value_query->row('weight');
								} 
								elseif ($option_value_query->row('weight_prefix') == '-')
								{
									$option_weight -= $option_value_query->row('weight');
								}

								if ($option_value_query->row('subtract') && (!$option_value_query->row('quantity') || ($option_value_query->row('quantity') < $cart['quantity']))) {
									$stock = false;
								}

								$option_data[] = array(
									'product_option_id'       => $product_option_id,
									'product_option_value_id' => $value,
									'option_id'               => $option_query->row('option_id'),
									'option_value_id'         => $option_value_query->row('option_value_id'),
									'name'                    => $option_query->row('name'),
									'value'                   => $option_value_query->row('name'),
									'type'                    => $option_query->row('type'),
									'quantity'                => $option_value_query->row('quantity'),
									'subtract'                => $option_value_query->row('subtract'),
									'price'                   => $option_value_query->row('price'),
									'price_prefix'            => $option_value_query->row('price_prefix'),
									'points'                  => $option_value_query->row('points'),
									'points_prefix'           => $option_value_query->row('points_prefix'),
									'weight'                  => $option_value_query->row('weight'),
									'weight_prefix'           => $option_value_query->row('weight_prefix')
								);
							}
						} 
						else if ($option_query->row('type') == 'checkbox' && is_array($value)) 
						{
							foreach ($value as $product_option_value_id) 
							{
								$option_value_query = $this->_CI->db->query("SELECT pov.option_value_id, ov.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix 
									FROM product_option_value pov 
									LEFT JOIN option_value ov ON (pov.option_value_id = ov.option_value_id) 
									WHERE pov.product_option_value_id = '" . (int)$product_option_value_id . "' AND pov.product_option_id = '" . (int)$product_option_id . "'");
								

								if ($option_value_query->num_rows())
								{
									if ($option_value_query->row('price_prefix') == '+') {
										$option_price += $option_value_query->row('price');
									} elseif ($option_value_query->row('price_prefix') == '-') {
										$option_price -= $option_value_query->row('price');
									}

									if ($option_value_query->row('points_prefix') == '+') {
										$option_points += $option_value_query->row('points');
									} elseif ($option_value_query->row('points_prefix') == '-')
									 {
										$option_points -= $option_value_query->row('points');
									}

									if ($option_value_query->row('weight_prefix') == '+') {
										$option_weight += $option_value_query->row('weight');
									} 
									elseif ($option_value_query->row('weight_prefix') == '-') 
									{
										$option_weight -= $option_value_query->row('weight');
									}

									if ($option_value_query->row('subtract') && (!$option_value_query->row('quantity') || ($option_value_query->row('quantity') < $cart['quantity']))) {
										$stock = false;
									}

									$option_data[] = array(
										'product_option_id'       => $product_option_id,
										'product_option_value_id' => $product_option_value_id,
										'option_id'               => $option_query->row('option_id'),
										'option_value_id'         => $option_value_query->row('option_value_id'),
										'name'                    => $option_query->row('name'),
										'value'                   => $option_value_query->row('name'),
										'type'                    => $option_query->row('type'),
										'quantity'                => $option_value_query->row('quantity'),
										'subtract'                => $option_value_query->row('subtract'),
										'price'                   => $option_value_query->row('price'),
										'price_prefix'            => $option_value_query->row('price_prefix'),
										'points'                  => $option_value_query->row('points'),
										'points_prefix'           => $option_value_query->row('points_prefix'),
										'weight'                  => $option_value_query->row('weight'),
										'weight_prefix'           => $option_value_query->row('weight_prefix')
									);
								}
							}
						} 
						else if ($option_query->row('type') == 'text' || $option_query->row('type') == 'textarea' || $option_query->row('type') == 'file' || $option_query->row('type') == 'date' || $option_query->row('type') == 'datetime' || $option_query->row('type') == 'time') 
						{
							$option_data[] = array(
								'product_option_id'       => $product_option_id,
								'product_option_value_id' => '',
								'option_id'               => $option_query->row('option_id'),
								'option_value_id'         => '',
								'name'                    => $option_query->row('name'),
								'value'                   => $value,
								'type'                    => $option_query->row('type'),
								'quantity'                => '',
								'subtract'                => '',
								'price'                   => '',
								'price_prefix'            => '',
								'points'                  => '',
								'points_prefix'           => '',
								'weight'                  => '',
								'weight_prefix'           => ''
							);
						}
					}
				}

				$price = $product_query->row('price');

				// Product Discounts
				$discount_quantity = 0;

				$cart_2_query = $this->_CI->db->query("SELECT * FROM cart WHERE customer_id = '" . (int)$this->_CI->customer->getId() . "' AND session_id = '" . $this->session_id . "'");

				foreach ($cart_2_query->result_array() as $cart_2) 
				{
					if ($cart_2['product_id'] == $cart['product_id']) 
					{
						$discount_quantity += $cart_2['quantity'];
					}
				}

				$product_discount_query = $this->_CI->db->query("SELECT price FROM product_discount WHERE product_id = '" . (int)$cart['product_id'] . "' AND customer_group_id = '" . (int)$this->_CI->common->config('config_customer_group_id') . "' AND quantity <= '" . (int)$discount_quantity . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity DESC, priority ASC, price ASC LIMIT 1");

				if ($product_discount_query->num_rows) {
					$price = $product_discount_query->row['price'];
				}

				// Product Specials
				$product_special_query = $this->_CI->db->query("SELECT price FROM product_special WHERE product_id = '" . (int)$cart['product_id'] . "' AND customer_group_id = '" . (int)$this->_CI->common->config('config_customer_group_id') . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY priority ASC, price ASC LIMIT 1");

				if ($product_special_query->num_rows) {
					$price = $product_special_query->row['price'];
				}

				// // Reward Points
				// $product_reward_query = $this->db->query("SELECT points FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$cart['product_id'] . "' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "'");

				// if ($product_reward_query->num_rows) {
				// 	$reward = $product_reward_query->row['points'];
				// } else {
				// 	$reward = 0;
				// }

				// Downloads
				$download_data = array();

				$download_query = $this->_CI->db->query("SELECT * FROM product_download p2d LEFT JOIN download d ON (p2d.download_id = d.download_id)  WHERE p2d.product_id = '" . (int)$cart['product_id'] . "'");

				foreach ($download_query->result_array() as $download) {
					$download_data[] = array(
						'download_id' => $download['download_id'],
						'name'        => $download['name'],
						'filename'    => $download['filename'],
						'mask'        => $download['mask']
					);
				}

				// Stock
				if (!$product_query->row('quantity') || ($product_query->row('quantity') < $cart['quantity'])) {
					$stock = false;
				}

				// $recurring_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "recurring r LEFT JOIN " . DB_PREFIX . "product_recurring pr ON (r.recurring_id = pr.recurring_id) LEFT JOIN " . DB_PREFIX . "recurring_description rd ON (r.recurring_id = rd.recurring_id) WHERE r.recurring_id = '" . (int)$cart['recurring_id'] . "' AND pr.product_id = '" . (int)$cart['product_id'] . "' AND rd.language_id = " . (int)$this->config->get('config_language_id') . " AND r.status = 1 AND pr.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "'");

				// if ($recurring_query->num_rows) {
				// 	$recurring = array(
				// 		'recurring_id'    => $cart['recurring_id'],
				// 		'name'            => $recurring_query->row['name'],
				// 		'frequency'       => $recurring_query->row['frequency'],
				// 		'price'           => $recurring_query->row['price'],
				// 		'cycle'           => $recurring_query->row['cycle'],
				// 		'duration'        => $recurring_query->row['duration'],
				// 		'trial'           => $recurring_query->row['trial_status'],
				// 		'trial_frequency' => $recurring_query->row['trial_frequency'],
				// 		'trial_price'     => $recurring_query->row['trial_price'],
				// 		'trial_cycle'     => $recurring_query->row['trial_cycle'],
				// 		'trial_duration'  => $recurring_query->row['trial_duration']
				// 	);
				// } else {
				// 	$recurring = false;
				// }

				$product_data[] = array(
					'cart_id'         => $cart['cart_id'],
					'product_id'      => $product_query->row('product_id'),
					'name'            => $product_query->row('product_name'),
					'model'           => $product_query->row('model'),
					'shipping'        => $product_query->row('shipping'),
					'image'           => $product_query->row('image'),
					'option'          => $option_data,
					'download'        => $download_data,
					'quantity'        => $cart['quantity'],
					'minimum'         => $product_query->row('minimum'),
					'subtract'        => $product_query->row('subtract'),
					'stock'           => $stock,
					'price'           => ($price + $option_price),
					'total'           => ($price + $option_price) * $cart['quantity'],
					'points'          => ($product_query->row('points') ? ($product_query->row('points') + $option_points) * $cart['quantity'] : 0),
					'tax_class_id'    => $product_query->row('tax_class_id'),
					'weight'          => ($product_query->row('weight') + $option_weight) * $cart['quantity'],
					'weight_class' => $product_query->row('weight_class'),
					'length'          => $product_query->row('length'),
					'width'           => $product_query->row('width'),
					'height'          => $product_query->row('height'),
					'length_class' => $product_query->row('length_class'),
					
				);
			} else {
				$this->remove($cart['cart_id']);
			}
		}

		return $product_data;
	}

	public function add($product_id, $quantity = 1, $option = array())
	{
		$query = $this->_CI->db->query("SELECT COUNT(*) AS total FROM cart WHERE customer_id = '" . (int)$this->_CI->customer->getId() . "' AND session_id = '" . $this->session_id . "' AND product_id = '" . (int)$product_id . "' AND `option` = '" . json_encode($option) . "'");
		if (!$query->row('total'))
		{
			$this->_CI->db->query("INSERT cart SET customer_id = '" . (int)$this->_CI->customer->getId() . "', session_id = '" . $this->session_id . "', product_id = '" . (int)$product_id . "',`option` = '" . json_encode($option) . "', quantity = '" . (int)$quantity . "', date_added = NOW()");
		}
		else
		 {
			$this->_CI->db->query("UPDATE cart SET quantity = (quantity + " . (int)$quantity . ") WHERE customer_id = '" . (int)$this->_CI->customer->getId() . "' AND session_id = '" . $this->session_id . "' AND product_id = '" . (int)$product_id . "' AND `option` = '" . json_encode($option) . "'");
		}
		
	}

	public function update($cart_id, $quantity) {
		$this->_CI->db->query("UPDATE cart SET quantity = '" . (int)$quantity . "' WHERE cart_id = '" . (int)$cart_id . "' AND customer_id = '" . (int)$this->_CI->customer->getId() . "' AND session_id = '" . $this->session_id . "'");
	}

	public function remove($cart_id) 
	{
		//echo $cart_id;exit;
		$this->_CI->db->query("DELETE FROM cart WHERE cart_id = '" . (int)$cart_id . "' AND customer_id = '" . (int)$this->_CI->customer->getId() . "' AND session_id = '" . $this->session_id . "'");
	}

	public function clear()
	{
		$this->_CI->db->query("DELETE FROM cart WHERE customer_id = '" . (int)$this->_CI->customer->getId() . "' AND session_id = '" . $this->session_id . "'");
	}

	public function getRecurringProducts() {
		$product_data = array();

		foreach ($this->getProducts() as $value) {
			if ($value['recurring']) {
				$product_data[] = $value;
			}
		}

		return $product_data;
	}

	public function getWeight() {
		$weight = 0;

		foreach ($this->getProducts() as $product) 
		{
			if ($product['shipping']) {
				$weight += $this->_CI->weight->convert($product['weight'], $product['weight_class'], $this->_CI->common->config('config_weight_class_id'));
			}
		}

		return $weight;
	}

	public function getSubTotal() 
	{
		$total = 0;

		foreach ($this->getProducts() as $product) {
			$total += $product['total'];
		}

		return $total;
	}

	public function getTaxes() {
		$tax_data = array();

		foreach ($this->getProducts() as $product) {
			if ($product['tax_class_id']) {
				$tax_rates = $this->_CI->tax->getRates($product['price'], $product['tax_class_id']);

				foreach ($tax_rates as $tax_rate) {
					if (!isset($tax_data[$tax_rate['tax_rate_id']])) {
						$tax_data[$tax_rate['tax_rate_id']] = ($tax_rate['amount'] * $product['quantity']);
					} else {
						$tax_data[$tax_rate['tax_rate_id']] += ($tax_rate['amount'] * $product['quantity']);
					}
				}
			}
		}

		return $tax_data;
	}

	public function getTotal() {
		$total = 0;

		foreach ($this->getProducts() as $product) {
			$total += $this->_CI->tax->calculate($product['price'], $product['tax_class_id'], $this->common->config('config_tax')) * $product['quantity'];
		}

		return $total;
	}

	public function countProducts() {
		$product_total = 0;

		$products = $this->getProducts();

		foreach ($products as $product) {
			$product_total += $product['quantity'];
		}

		return $product_total;
	}

	public function hasProducts() {
		return count($this->getProducts());
	}

	public function hasRecurringProducts() {
		return count($this->getRecurringProducts());
	}

	public function hasStock() {
		$stock = true;

		foreach ($this->getProducts() as $product) {
			if (!$product['stock']) {
				$stock = false;
			}
		}

		return $stock;
	}

	public function hasShipping() {
		$shipping = false;

		foreach ($this->getProducts() as $product) {
			if ($product['shipping']) {
				$shipping = true;

				break;
			}
		}

		return $shipping;
	}

	public function hasDownload() {
		$download = false;

		foreach ($this->getProducts() as $product) {
			if ($product['download']) {
				$download = true;

				break;
			}
		}

		return $download;
	}
}
