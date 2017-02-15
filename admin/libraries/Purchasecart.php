<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Purchasecart class
 * Collection of various common function related to Purchase Cart.
 *
 * @author    Mitesh
 * @license   http://www.vpninfotech.com/
 */
class Purchasecart {
	private $data = array();

	public function __construct()
	{
		 // Get the CodeIgniter reference
         $this->_CI =& get_instance();

         $this->_CI->load->library('manufacturer');
		 $this->_CI->load->library('currency');

         $this->session_id = session_id();
		
		if ($this->_CI->manufacturer->getId()) 
		{
			
			// We want to change the session ID on all the old items in the manufacturers cart
			$this->_CI->db->query("UPDATE purchase_cart SET session_id = '" . $this->session_id . "' WHERE manufacturer_id = '" . (int)$this->_CI->manufacturer->getId() . "'");

			
		}
	}
	
	public function getPurchaseProducts($manufacturer_id) 
	{		
		$product_data = array();

		$cart_query = $this->_CI->db->query("SELECT * FROM purchase_cart WHERE manufacturer_id = '" . (int)$manufacturer_id . "' AND session_id = '" .$this->session_id . "'");
		
		foreach ($cart_query->result_array() as $cart) 
		{
			
			$product_query = $this->_CI->db->query("SELECT * FROM product p where p.product_id = '" . (int)$cart['product_id'] . "' AND p.date_available <= NOW() AND p.status = '1'");
			$query =$product_query->result_array();
			
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
								
								

								$option_data[] = array(
									'product_option_id'       => $product_option_id,
									'product_option_value_id' => $value,
									'option_id'               => $option_query->row('option_id'),
									'option_value_id'         => $option_value_query->row('option_value_id'),
									'name'                    => $option_query->row('name'),
									'value'                   => $option_value_query->row('name'),
									'type'                    => $option_query->row('type'),
									'quantity'                => $option_value_query->row('quantity'),
									
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
									

									$option_data[] = array(
										'product_option_id'       => $product_option_id,
										'product_option_value_id' => $product_option_value_id,
										'option_id'               => $option_query->row('option_id'),
										'option_value_id'         => $option_value_query->row('option_value_id'),
										'name'                    => $option_query->row('name'),
										'value'                   => $option_value_query->row('name'),
										'type'                    => $option_query->row('type'),
										'quantity'                => $option_value_query->row('quantity'),
										
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
								
							);
						}
					}
				}

				$price = $product_query->row('price');

				// Product Discounts
				$discount_quantity = 0;

				$cart_2_query = $this->_CI->db->query("SELECT * FROM purchase_cart WHERE manufacturer_id = '" . (int)$this->_CI->manufacturer->getId() . "' AND session_id = '" . $this->session_id . "'");

				foreach ($cart_2_query->result_array() as $cart_2) 
				{
					if ($cart_2['product_id'] == $cart['product_id']) 
					{
						$discount_quantity += $cart_2['quantity'];
					}
				}

				$product_discount_query = $this->_CI->db->query("SELECT price FROM product_discount WHERE product_id = '" . (int)$cart['product_id'] . "' AND quantity <= '" . (int)$discount_quantity . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity DESC, priority ASC, price ASC LIMIT 1");

				if ($product_discount_query->num_rows) {
					$price = $product_discount_query->row['price'];
				}

				// Product Specials
				$product_special_query = $this->_CI->db->query("SELECT price FROM product_special WHERE product_id = '" . (int)$cart['product_id'] . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY priority ASC, price ASC LIMIT 1");

				if ($product_special_query->num_rows) {
					$price = $product_special_query->row['price'];
				}


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


				

				$product_data[] = array(
					'purchase_cart_id'         => $cart['purchase_cart_id'],
					'product_id'      => $product_query->row('product_id'),
					'name'            => $product_query->row('product_name'),
					'model'           => $product_query->row('model'),
					'shipping'        => $product_query->row('shipping'),
					'image'           => $product_query->row('image'),
					'option'          => $option_data,
					'download'        => $download_data,
					'quantity'        => $cart['quantity'],									
					'price'           => ($price),
					'total'           => ($price) * $cart['quantity'],					
				);
			} else {
				$this->remove($cart['purchase_cart_id']);
			}
		}

		return $product_data;
		
	}
	
	public function getProducts() 
	{
		$product_data = array();
		//echo $this->_CI->manufacturer->getId();
		$cart_query = $this->_CI->db->query("SELECT * FROM purchase_cart WHERE manufacturer_id = '" . (int)$this->_CI->manufacturer->getId() . "' AND session_id = '" .$this->session_id . "'");
	
		foreach ($cart_query->result_array() as $cart) 
		{
			
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

								$option_data[] = array(
									'product_option_id'       => $product_option_id,
									'product_option_value_id' => $value,
									'option_id'               => $option_query->row('option_id'),
									'option_value_id'         => $option_value_query->row('option_value_id'),
									'name'                    => $option_query->row('name'),
									'value'                   => $option_value_query->row('name'),
									'type'                    => $option_query->row('type'),
									'quantity'                => $option_value_query->row('quantity'),									
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
									
									$option_data[] = array(
										'product_option_id'       => $product_option_id,
										'product_option_value_id' => $product_option_value_id,
										'option_id'               => $option_query->row('option_id'),
										'option_value_id'         => $option_value_query->row('option_value_id'),
										'name'                    => $option_query->row('name'),
										'value'                   => $option_value_query->row('name'),
										'type'                    => $option_query->row('type'),
										'quantity'                => $option_value_query->row('quantity'),
										
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
								
							);
						}
					}
				}

				//$price = $product_query->row('price');
				$price = $product_query->row('manufacturer_price');

				// Product Discounts
				$discount_quantity = 0;

				$cart_2_query = $this->_CI->db->query("SELECT * FROM purchase_cart WHERE manufacturer_id = '" . (int)$this->_CI->manufacturer->getId() . "' AND session_id = '" . $this->session_id . "'");

				foreach ($cart_2_query->result_array() as $cart_2) 
				{
					if ($cart_2['product_id'] == $cart['product_id']) 
					{
						$discount_quantity += $cart_2['quantity'];
					}
				}

				$product_discount_query = $this->_CI->db->query("SELECT price FROM product_discount WHERE product_id = '" . (int)$cart['product_id'] . "' AND quantity <= '" . (int)$discount_quantity . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity DESC, priority ASC, price ASC LIMIT 1");

				if ($product_discount_query->num_rows) {
					$price = $product_discount_query->row['price'];
				}

				// Product Specials
				$product_special_query = $this->_CI->db->query("SELECT price FROM product_special WHERE product_id = '" . (int)$cart['product_id'] . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY priority ASC, price ASC LIMIT 1");

				if ($product_special_query->num_rows) {
					$price = $product_special_query->row['price'];
				}

				// // Reward Points
				// $product_reward_query = $this->db->query("SELECT points FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$cart['product_id'] . "' AND manufacturer_group_id = '" . (int)$this->config->get('config_manufacturer_group_id') . "'");

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

				

				$product_data[] = array(
					'purchase_cart_id'         => $cart['purchase_cart_id'],
					'product_id'      => $product_query->row('product_id'),
					'name'            => $product_query->row('product_name'),
					'model'           => $product_query->row('model'),
					'shipping'        => $product_query->row('shipping'),
					'image'           => $product_query->row('image'),
					'option'          => $option_data,
					'download'        => $download_data,
					'quantity'        => $cart['quantity'],
					'price'           => ($price),
					'total'           => ($price) * $cart['quantity'],
					'tax_class_id'    => $product_query->row('tax_class_id'),
					
				);
			} else {
				$this->remove($cart['purchase_cart_id']);
			}
		}

		return $product_data;
	}

	public function add($product_id, $manufacturer_id, $quantity = 1, $option = array())
	{				
		$manufacturer_id = (int)$this->_CI->manufacturer->getId();
		$query = $this->_CI->db->query("SELECT COUNT(*) AS total FROM purchase_cart WHERE manufacturer_id = '" . (int)$manufacturer_id . "' AND session_id = '" . $this->session_id . "' AND product_id = '" . (int)$product_id . "' AND `option` = '" . json_encode($option) . "'");
		
		if ($query->row('total') <= 0){
		//if (!$query->row['total']) {
			
			$this->_CI->db->query("INSERT purchase_cart SET manufacturer_id = '" . (int)$manufacturer_id . "', session_id = '" . $this->session_id . "', product_id = '" . (int)$product_id . "',`option` = '" . json_encode($option) . "', quantity = '" . (int)$quantity . "', date_added = NOW()");
		}
		else
		 {
			
			$this->_CI->db->query("UPDATE purchase_cart SET quantity = (quantity + " . (int)$quantity . ") WHERE manufacturer_id = '" . (int)$manufacturer_id . "' AND session_id = '" . $this->session_id . "' AND product_id = '" . (int)$product_id . "' AND `option` = '" . json_encode($option) . "'");
		}
		
	}
	//update quantity
	public function addQty($product_id, $quantity = 1, $option = array())
	{
		$manufacturer_id = (int)$this->_CI->manufacturer->getId();
		
		$query = $this->_CI->db->query("SELECT COUNT(*) AS total FROM purchase_cart WHERE manufacturer_id = '" . (int)$manufacturer_id . "' AND session_id = '" . $this->session_id . "' AND product_id = '" . (int)$product_id . "' AND `option` = '" . json_encode($option) . "'");
		$res=$query->row_array();
		
		if($res['total'] > 0)
		{
			$this->_CI->db->query("UPDATE purchase_cart SET quantity = (quantity + " . (int)$quantity . ") WHERE manufacturer_id = '" . (int)$manufacturer_id . "' AND session_id = '" . $this->session_id . "' AND product_id = '" . (int)$product_id . "' AND `option` = '" . json_encode($option) . "'");
		}
		else
		{
			$this->_CI->db->query("INSERT purchase_cart SET manufacturer_id = '" . (int)$manufacturer_id . "', session_id = '" . $this->session_id . "', product_id = '" . (int)$product_id . "',`option` = '" . json_encode($option) . "', quantity = '" . (int)$quantity . "', date_added = NOW()");
		}
	}
	
	public function update($purchase_cart_id, $quantity) {
		$this->_CI->db->query("UPDATE purchase_cart SET quantity = '" . (int)$quantity . "' WHERE purchase_cart_id = '" . (int)$purchase_cart_id . "' AND manufacturer_id = '" . (int)$this->_CI->manufacturer->getId() . "' AND session_id = '" . $this->session_id . "'");
	}

	public function remove($purchase_cart_id) 
	{
		
		$this->_CI->db->query("DELETE FROM purchase_cart WHERE purchase_cart_id = '" . (int)$purchase_cart_id . "' AND manufacturer_id = '" . (int)$this->_CI->manufacturer->getId() . "' AND session_id = '" . $this->session_id . "'");
	}

	public function clear()
	{		
		$this->_CI->db->query("DELETE FROM purchase_cart WHERE manufacturer_id = '" . (int)$this->_CI->manufacturer->getId() . "' AND session_id = '" . $this->session_id . "'");
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
				$weight += $this->weight->convert($product['weight'], $product['weight_class_id'], $this->config->get('config_weight_class_id'));
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
		
		$manufacturer_id = $this->_CI->session->userdata('manufacturer_id');
			
		//foreach ($this->getProducts() as $product) {
		foreach ($this->getPurchaseProducts($manufacturer_id) as $product) {
			
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
		$manufacturer_id = $this->_CI->session->userdata('manufacturer_id');
		
		$purchase_data=$this->getPurchaseProducts($manufacturer_id);
		
		
		foreach ($this->getPurchaseProducts($manufacturer_id) as $product) {
			$total += $this->_CI->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity'];
		}
		//echo $total;
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
	
	
	//get total 
	public function getPurchaseTotal()
	{
		$products = $this->getProducts();
			
		//calculate total
		$purchase_total=0;
		foreach($products as $cal_total)
		{ 
			$purchase_total+=$cal_total['total'];
		}
		//$json['totals'][]=array(
		$json[]=array(
			'title' => 'Total',
			'text'  => $this->_CI->currency->format($purchase_total),
			'value' => $purchase_total				
		);
		return $json;
	}
	
	//get Purchase Product data
	public function getPurchaseProductsData($manufacturer_id,$purchase_id) 
	{		
		$product_data = array();
		
		$purchase_product_data=array();
		
		$product_option=array();

		$purchase_query = $this->_CI->db->query("SELECT * FROM purchase WHERE manufacturer_id = '" . (int)$manufacturer_id . "' AND purchase_id = '" .$purchase_id . "'");
		$puchase=$purchase_query->num_rows();
		$get_purchase=$purchase_query->row_array();
				
		if($puchase > 0)
		{
		//foreach($get_purchase as $purchase){
			$purchase_product_query = $this->_CI->db->query("SELECT * FROM purchase_product WHERE purchase_id = '" .$purchase_id . "'");
			
			$purchase_products=$purchase_product_query->result_array();
			
			foreach($purchase_products as $purchase_product)
			{
				$purchase_option_query=$this->_CI->db->query("SELECT * FROM purchase_option WHERE purchase_id = '" .$purchase_id . "' AND purchase_product_id = '".$purchase_product['purchase_product_id']."'");
				
				$purchase_product_options=$purchase_option_query->result_array();
				
				if($purchase_option_query->num_rows() > 0)
				{
					foreach($purchase_product_options as $purchase_product_option)
					{
						$product_option['options'][]=array(
						//$product_option[]=array(
							'option_name' =>$purchase_product_option['name'],
							'option_value' =>$purchase_product_option['value']
						);
					}
				}
				else
				{
					$product_option['options']=array();
				}
				
				$product_data['purchase_product'][]=array(
				//$product_data[]=array(
					'product_id' => $purchase_product['product_id'],
					'product_option'=>$product_option,
					'product_name' => $purchase_product['name'],
					'product_model' => $purchase_product['model'],
					'product_quantity' => $purchase_product['quantity'],
					'product_price' => $purchase_product['price'],
					'product_total' => $purchase_product['total']
				);
				
			}
			
		}
		
		return $product_data;
	}
	
	
	
}
