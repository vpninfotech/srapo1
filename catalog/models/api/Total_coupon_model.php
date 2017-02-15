<?php
/**
* 
* @file name   : Total_coupon_model
* @Auther      : Indrajit
* @Date        : 21-12-2016
* @Description : Collection of various common function related to cart coupons operation.
*
*/
class Total_coupon_model extends CI_Model 
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
    /**
    * 
    * @function name : getCoupon()
    * @description   : get coupon record by coupons_id
    * @access        : public
    * @param   	     : int $coupons_id The coupons id that you want
    * @return        : array The selected coupons array
    *
    */
	public function getCoupon($code) 
	{
		$status = true;

		$coupon_query = $this->db->query("SELECT * FROM `coupon` WHERE coupon_code = '" . $code . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) AND status = '1'");
		if($coupon_query)
		{

			if ($coupon_query->row('total') > $this->mycart->getSubTotal())
			{

				$status = false;
			}

			$coupon_history_query = $this->db->query("SELECT COUNT(*) AS total FROM `coupon_history` ch WHERE ch.coupon_id = '" . (int)$coupon_query->row('coupon_id') . "'");
			if ($coupon_query->row('uses_total') > 0 && ($coupon_history_query->row('total') >= $coupon_query->row('uses_total'))) 
			{

				$status = false;
			}

			if ($coupon_query->row('logged') && !$this->customer->getId()) {

				$status = false;
			}

			if ($this->customer->getId()) {
				$coupon_history_query = $this->db->query("SELECT COUNT(*) AS total FROM `coupon_history` ch WHERE ch.coupon_id = '" . (int)$coupon_query->row('coupon_id') . "' AND ch.customer_id = '" . (int)$this->customer->getId() . "'");

				if ($coupon_query->row('uses_customer') > 0 && ($coupon_history_query->row('total') >= $coupon_query->row('uses_customer')))
				{

					$status = false;
				}
			}

			// Products
			$coupon_product_data = array();

			$coupon_product_query = $this->db->query("SELECT * FROM `coupon_product` WHERE coupon_id = '" . (int)$coupon_query->row('coupon_id') ."'");

			foreach ($coupon_product_query->result_array() as $product) 
			{
				$coupon_product_data[] = $product['product_id'];

			}

			// Categories
			$coupon_category_data = array();

			$coupon_category_query = $this->db->query("SELECT * FROM `coupon_category` cc LEFT JOIN `category_path` cp ON (cc.category_id = cp.path_id) WHERE cc.coupon_id = '" . (int)$coupon_query->row('coupon_id') . "'");

			foreach ($coupon_category_query->result_array() as $category) 
			{
				$coupon_category_data[] = $category['category_id'];

			}

			$product_data = array();

			if ($coupon_product_data || $coupon_category_data) 
			{
				foreach ($this->mycart->getProducts() as $product) {
					if (in_array($product['product_id'], $coupon_product_data)) {
						$product_data[] = $product['product_id'];

						continue;
					}

					foreach ($coupon_category_data as $category_id) {
						$coupon_category_query = $this->db->query("SELECT COUNT(*) AS total FROM `product_category` WHERE `product_id` = '" . (int)$product['product_id'] . "' AND category_id = '" . (int)$category_id . "'");
						if ($coupon_category_query->row('total'))
						{

							$product_data[] = $product['product_id'];

							continue;
						}
					}
				}

				if (!$product_data) {
					$status = false;
				}
			}
		} 
		else 
		{

			$status = false;
		}

		if ($status) 
		{
			return array(
				'coupon_id'     => $coupon_query->row('coupon_id'),
				'code'          => $coupon_query->row('coupon_code'),
				'name'          => $coupon_query->row('coupon_name'),
				'type'          => $coupon_query->row('coupon_type'),
				'discount'      => $coupon_query->row('discount'),
				'shipping'      => $coupon_query->row('shipping'),
				'total'         => $coupon_query->row('total'),
				'product'       => $product_data,
				'date_start'    => $coupon_query->row('date_start'),
				'date_end'      => $coupon_query->row('date_end'),
				'uses_total'    => $coupon_query->row('uses_total'),
				'uses_customer' => $coupon_query->row('uses_customer'),
				'status'        => $coupon_query->row('status'),
				'date_added'    => $coupon_query->row('date_added')
			);
		}
		
		
	}

	public function getTotal(&$total_data, &$total, &$taxes) 
	{
		if ($this->session->userdata('coupon') != NULL) 
		{
			$coupon_info = $this->getCoupon($this->session->userdata('coupon'));
			// echo "<pre>";
			// print_r($coupon_info);exit;
			if ($coupon_info)
			{
				$discount_total = 0;

				if (!$coupon_info['product'])
				{
					$sub_total = $this->mycart->getSubTotal();
				} 
				else
				{
					$sub_total = 0;

					foreach ($this->mycart->getProducts() as $product) {
						if (in_array($product['product_id'], $coupon_info['product'])) {
							$sub_total += $product['total'];
						}
					}
				}

				if ($coupon_info['type'] == 'F') {
					$coupon_info['discount'] = min($coupon_info['discount'], $sub_total);
				}

				foreach ($this->mycart->getProducts() as $product) {
					$discount = 0;

					if (!$coupon_info['product']) {
						$status = true;
					} else {
						if (in_array($product['product_id'], $coupon_info['product'])) {
							$status = true;
						} else {
							$status = false;
						}
					}

					if ($status) {
						if ($coupon_info['type'] == 'F') {
							$discount = $coupon_info['discount'] * ($product['total'] / $sub_total);
						} elseif ($coupon_info['type'] == 'P') {
							$discount = $product['total'] / 100 * $coupon_info['discount'];
						}

						if ($product['tax_class_id']) {
							$tax_rates = $this->tax->getRates($product['total'] - ($product['total'] - $discount), $product['tax_class_id']);

							foreach ($tax_rates as $tax_rate) {
								if ($tax_rate['type'] == 'percentage') {
									$taxes[$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
								}
							}
						}
					}

					$discount_total += $discount;
				}

				if ($coupon_info['shipping'] && $this->session->userdata('shipping_method') !=NULL) 
				{
					$shipping_method = $this->session->userdata('shipping_method');
					if (isset($shipping_method['tax_class_id']) && $shipping_method['tax_class_id'] !== "")
					{
						$tax_rates = $this->tax->getRates($shipping_method['cost'], $shipping_method['tax_class_id']);

						foreach ($tax_rates as $tax_rate) {
							if ($tax_rate['type'] == 'P') {
								$taxes[$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
							}
						}
					}

					$discount_total += $shipping_method['cost'];
				}

				// If discount greater than total
				if ($discount_total > $total) {
					$discount_total = $total;
				}

				if ($discount_total > 0) {
					$total_data[] = array(
						'code'       => 'coupon',
						'title'      => sprintf(' Coupan (%s) ', $this->session->userdata('coupon')),
						'value'      => -$discount_total,
						'sort_order' => 1
					);

					$total -= $discount_total;
				} else {
					$this->session->unset_userdata('coupon');
				}
			} else {
				$this->session->unset_userdata('coupon');
			}
		}
	}

	public function confirm($order_info, $order_total) 
	{
		$code = '';

		$start = strpos($order_total['title'], '(') + 1;
		$end = strrpos($order_total['title'], ')');

		if ($start && $end) {
			$code = substr($order_total['title'], $start, $end - $start);
		}

		if ($code) {
			$coupon_info = $this->getCoupon($code);

			if ($coupon_info) {
				$this->db->query("INSERT INTO `coupon_history` SET coupon_id = '" . (int)$coupon_info['coupon_id'] . "', order_id = '" . (int)$order_info['order_id'] . "', customer_id = '" . (int)$order_info['customer_id'] . "', amount = '" . (float)$order_total['value'] . "', date_added = NOW()");
			} else {
				return $this->common->config('config_fraud_status_id');
			}
		}
	}

	public function unconfirm($order_id) {
		$this->db->query("DELETE FROM `coupon_history` WHERE order_id = '" . (int)$order_id . "'");
	}
}
