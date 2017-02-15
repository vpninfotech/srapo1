<?php
/**
* 
* @file name   : Total_coupon_model
* @Auther      : Indrajit
* @Date        : 21-12-2016
* @Description : Collection of various common function related to cart coupons operation.
*
*/
class Api_order_model extends CI_Model 
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

        $this->lang->load('api/api_order_lang', 'english');

        $this->load->library('tax');
    }
	public function addOrder($data) 
	{
		

		$this->db->query("INSERT INTO `order` SET invoice_prefix = '" . $data['invoice_prefix'] . "', customer_id = '" . (int)$data['customer_id'] . "', customer_group_id = '" . (int)$data['customer_group_id'] . "', firstname = '" . $data['firstname'] . "', lastname = '" . $data['lastname'] . "', email = '" . $data['email'] . "', telephone = '" . $data['telephone'] . "', payment_firstname = '" . $data['payment_firstname'] . "', payment_lastname = '" . $data['payment_lastname'] . "', payment_company = '" . $data['payment_company'] . "', payment_address_1 = '" .$data['payment_address_1'] . "', payment_address_2 = '" . $data['payment_address_2'] . "', payment_city = '" . $data['payment_city'] . "', payment_postcode = '" . $data['payment_postcode'] . "', payment_country = '" . $data['payment_country'] . "', payment_country_id = '" . (int)$data['payment_country_id'] . "', payment_zone = '" . $data['payment_zone'] . "', payment_state_id = '" . (int)$data['payment_state_id'] . "', payment_method = '" . $data['payment_method'] . "', payment_code = '" . $data['payment_code'] . "', shipping_firstname = '" . $data['shipping_firstname'] . "', shipping_lastname = '" . $data['shipping_lastname'] . "', shipping_company = '" . $data['shipping_company'] . "', shipping_address_1 = '" . $data['shipping_address_1'] . "', shipping_address_2 = '" . $data['shipping_address_2'] . "', shipping_city = '" . $data['shipping_city'] . "', shipping_postcode = '" . $data['shipping_postcode'] . "', shipping_country = '" . $data['shipping_country'] . "', shipping_country_id = '" . (int)$data['shipping_country_id'] . "', shipping_zone = '" . $data['shipping_zone'] . "', shipping_state_id = '" . (int)$data['shipping_state_id'] . "', shipping_method = '" . $data['shipping_method'] . "', shipping_code = '" . $data['shipping_code'] . "', comment = '" . $data['comment'] . "', total = '" . (float)$data['total'] . "', tracking = '" . $data['tracking'] . "', currency_id = '" . (int)$data['currency_id'] . "', currency_code = '" . $data['currency_code'] . "', currency_value = '" . (float)$data['currency_value'] . "', date_added = NOW(), date_modified = NOW()");

		$order_id = $this->db->insert_id();

		// Products
		if (isset($data['products'])) 
		{
			foreach ($data['products'] as $product) {
				$this->db->query("INSERT INTO order_product SET order_id = '" . (int)$order_id . "', product_id = '" . (int)$product['product_id'] . "', name = '" . $product['name'] . "', model = '" . $product['model'] . "', quantity = '" . (int)$product['quantity'] . "', price = '" . (float)$product['price'] . "', total = '" . (float)$product['total'] . "', tax = '" . (float)$product['tax'] . "'");

				$order_product_id = $this->db->insert_id();

				foreach ($product['option'] as $option) {
					$this->db->query("INSERT INTO order_option SET order_id = '" . (int)$order_id . "', order_product_id = '" . (int)$order_product_id . "', product_option_id = '" . (int)$option['product_option_id'] . "', product_option_value_id = '" . (int)$option['product_option_value_id'] . "', name = '" . $option['name'] . "', `value` = '" . $option['value'] . "', `type` = '" . $option['type'] . "'");
				}
			}
		}

		// Gift Voucher
		$this->load->model('api/total_voucher_model','voucher');

		// Vouchers
		if (isset($data['vouchers'])) {
			foreach ($data['vouchers'] as $voucher) {
				$this->db->query("INSERT INTO order_voucher SET order_id = '" . (int)$order_id . "', description = '" . $voucher['description'] . "', code = '" . $voucher['code'] . "', from_name = '" . $voucher['from_name'] . "', from_email = '" . $voucher['from_email'] . "', to_name = '" . $voucher['to_name'] . "', to_email = '" . $voucher['to_email'] . "', voucher_theme_id = '" . (int)$voucher['voucher_theme_id'] . "', message = '" . $voucher['message'] . "', amount = '" . (float)$voucher['amount'] . "'");

				$order_voucher_id = $this->db->insert_id();

				$voucher_id = $this->voucher->addVoucher($order_id, $voucher);

				$this->db->query("UPDATE order_voucher SET voucher_id = '" . (int)$voucher_id . "' WHERE order_voucher_id = '" . (int)$order_voucher_id . "'");
			}
		}

		// Totals
		if (isset($data['totals'])) {
			foreach ($data['totals'] as $total) {
				$this->db->query("INSERT INTO order_total SET order_id = '" . (int)$order_id . "', code = '" . $total['code'] . "', title = '" . $total['title'] . "', `value` = '" . (float)$total['value'] . "'");
			}
		}
		// echo "<pre>";
		// print_r($data['totals']);

		return $order_id;
	}

	public function editOrder($order_id, $data) 
	{
		

		// Void the order first
		$this->addOrderHistory($order_id, 0);

		$this->db->query("UPDATE `order` SET invoice_prefix = '" . $data['invoice_prefix'] . "', customer_id = '" . (int)$data['customer_id'] . "', customer_group_id = '" . (int)$data['customer_group_id'] . "', firstname = '" . $data['firstname'] . "', lastname = '" . $data['lastname'] . "', email = '" . $data['email'] . "', telephone = '" . $data['telephone'] . "', payment_firstname = '" . $data['payment_firstname'] . "', payment_lastname = '" . $data['payment_lastname'] . "', payment_company = '" . $data['payment_company'] . "', payment_address_1 = '" . $data['payment_address_1'] . "', payment_address_2 = '" . $data['payment_address_2'] . "', payment_city = '" . $data['payment_city'] . "', payment_postcode = '" . $data['payment_postcode'] . "', payment_country = '" . $data['payment_country'] . "', payment_country_id = '" . (int)$data['payment_country_id'] . "', payment_zone = '" . $data['payment_zone'] . "', payment_state_id = '" . (int)$data['payment_state_id'] . "', payment_method = '" . $data['payment_method'] . "', payment_code = '" . $data['payment_code'] . "', shipping_firstname = '" . $data['shipping_firstname'] . "', shipping_lastname = '" . $data['shipping_lastname'] . "', shipping_company = '" . $data['shipping_company'] . "', shipping_address_1 = '" . $data['shipping_address_1'] . "', shipping_address_2 = '" . $data['shipping_address_2'] . "', shipping_city = '" . $data['shipping_city'] . "', shipping_postcode = '" . $data['shipping_postcode'] . "', shipping_country = '" . $data['shipping_country'] . "', shipping_country_id = '" . (int)$data['shipping_country_id'] . "', shipping_zone = '" . $data['shipping_zone'] . "', shipping_state_id = '" . (int)$data['shipping_state_id'] . "', shipping_method = '" . $data['shipping_method'] . "', shipping_code = '" . $data['shipping_code'] . "', comment = '" . $data['comment'] . "', total = '" . (float)$data['total'] . "', date_modified = NOW() WHERE order_id = '" . (int)$order_id . "'");

		$this->db->query("DELETE FROM order_product WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM order_option WHERE order_id = '" . (int)$order_id . "'");

		// Products
		if (isset($data['products'])) 
		{
			foreach ($data['products'] as $product) 
			{
				$this->db->query("INSERT INTO order_product SET order_id = '" . (int)$order_id . "', product_id = '" . (int)$product['product_id'] . "', name = '" . $product['name'] . "', model = '" . $product['model'] . "', quantity = '" . (int)$product['quantity'] . "', price = '" . (float)$product['price'] . "', total = '" . (float)$product['total'] . "', tax = '" . (float)$product['tax'] . "'");

				$order_product_id = $this->db->insert_id();

				foreach ($product['option'] as $option) 
				{
					$this->db->query("INSERT INTO order_option SET order_id = '" . (int)$order_id . "', order_product_id = '" . (int)$order_product_id . "', product_option_id = '" . (int)$option['product_option_id'] . "', product_option_value_id = '" . (int)$option['product_option_value_id'] . "', name = '" . $option['name'] . "', `value` = '" . $option['value'] . "', `type` = '" . $option['type'] . "'");
				}
			}
		}

		// Gift Voucher
		$this->load->model('api/total_voucher_model','voucher');

		$this->voucher->disableVoucher($order_id);

		// Vouchers
		$this->db->query("DELETE FROM order_voucher WHERE order_id = '" . (int)$order_id . "'");

		if (isset($data['vouchers'])) 
		{
			foreach ($data['vouchers'] as $voucher) 
			{
				$this->db->query("INSERT INTO order_voucher SET order_id = '" . (int)$order_id . "', description = '" . $voucher['description'] . "', code = '" . $voucher['code'] . "', from_name = '" . $voucher['from_name'] . "', from_email = '" . $voucher['from_email'] . "', to_name = '" . $voucher['to_name'] . "', to_email = '" . $voucher['to_email'] . "', voucher_theme_id = '" . (int)$voucher['voucher_theme_id'] . "', message = '" . $voucher['message'] . "', amount = '" . (float)$voucher['amount'] . "'");

				$order_voucher_id = $this->db->insert_id();

				$voucher_id = $this->voucher->addVoucher($order_id, $voucher);

				$this->db->query("UPDATE order_voucher SET voucher_id = '" . (int)$voucher_id . "' WHERE order_voucher_id = '" . (int)$order_voucher_id . "'");
			}
		}

		// Totals
		$this->db->query("DELETE FROM order_total WHERE order_id = '" . (int)$order_id . "'");

		if (isset($data['totals'])) 
		{
			foreach ($data['totals'] as $total) {
				$this->db->query("INSERT INTO order_total SET order_id = '" . (int)$order_id . "', code = '" . $total['code'] . "', title = '" . $total['title'] . "', `value` = '" . (float)$total['value'] . "', sort_order = '" . (int)$total['sort_order'] . "'");
			}
		}

	}

	public function deleteOrder($order_id) 
	{
		// Void the order first
		$this->addOrderHistory($order_id, 0);

		$this->db->query("DELETE FROM `order` WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM `order_product` WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM `order_option` WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM `order_voucher` WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM `order_total` WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM `order_history` WHERE order_id = '" . (int)$order_id . "'");
		
		// Gift Voucher
		$this->load->model('api/total_voucher_model','voucher');

		$this->voucher->disableVoucher($order_id);

	}

	public function getOrder($order_id) 
	{
		$order_query = $this->db->query("SELECT *, (SELECT os.order_status_name FROM `order_status` os WHERE os.order_status_id = o.order_status_id ) AS order_status FROM `order` o WHERE o.order_id = '" . (int)$order_id . "'");

		if ($order_query->num_rows() > 0) 
		{
			$country_query = $this->db->query("SELECT * FROM `country` WHERE country_id = '" . (int)$order_query->row('payment_country_id') . "'");

			if ($country_query->num_rows) 
			{
				$payment_iso_code_2 = $country_query->row('iso_code_2');
				$payment_iso_code = $country_query->row('iso_code');
			} 
			else 
			{
				$payment_iso_code_2 = '';
				$payment_iso_code = '';
			}

			$zone_query = $this->db->query("SELECT * FROM `state` WHERE state_id = '" . (int)$order_query->row('payment_state_id') . "'");

			if ($zone_query->num_rows() > 0) 
			{
				$payment_zone_code = $zone_query->row('code');
			} 
			else 
			{
				$payment_zone_code = '';
			}

			$country_query = $this->db->query("SELECT * FROM `country` WHERE country_id = '" . (int)$order_query->row('shipping_country_id') . "'");

			if ($country_query->num_rows() > 0) 
			{
				$shipping_iso_code_2 = $country_query->row('iso_code_2');
				$shipping_iso_code = $country_query->row('iso_code');
			} 
			else 
			{
				$shipping_iso_code_2 = '';
				$shipping_iso_code   = '';
			}

			$zone_query = $this->db->query("SELECT * FROM `state` WHERE state_id = '" . (int)$order_query->row('shipping_state_id') . "'");

			if ($zone_query->num_rows() > 0) 
			{
				$shipping_zone_code = $zone_query->row('code');
			} 
			else 
			{
				$shipping_zone_code = '';
			}

			return array(
				'order_id'                => $order_query->row('order_id'),
				'invoice_no'              => $order_query->row('invoice_no'),
				'invoice_prefix'          => $order_query->row('invoice_prefix'),
				'customer_id'             => $order_query->row('customer_id'),
				'firstname'               => $order_query->row('firstname'),
				'lastname'                => $order_query->row('lastname'),
				'email'                   => $order_query->row('email'),
				'telephone'               => $order_query->row('telephone'),
				'payment_firstname'       => $order_query->row('payment_firstname'),
				'payment_lastname'        => $order_query->row('payment_lastname'),
				'payment_company'         => $order_query->row('payment_company'),
				'payment_address_1'       => $order_query->row('payment_address_1'),
				'payment_address_2'       => $order_query->row('payment_address_2'),
				'payment_postcode'        => $order_query->row('payment_postcode'),
				'payment_city'            => $order_query->row('payment_city'),
				'payment_state_id'        => $order_query->row('payment_state_id'),
				'payment_zone'            => $order_query->row('payment_zone'),
				'payment_zone_code'       => $payment_zone_code,
				'payment_country_id'      => $order_query->row('payment_country_id'),
				'payment_country'         => $order_query->row('payment_country'),
				'payment_iso_code_2'      => $payment_iso_code_2,
				'payment_iso_code'        => $payment_iso_code,
				'payment_method'          => $order_query->row('payment_method'),
				'payment_code'            => $order_query->row('payment_code'),
				'shipping_firstname'      => $order_query->row('shipping_firstname'),
				'shipping_lastname'       => $order_query->row('shipping_lastname'),
				'shipping_company'        => $order_query->row('shipping_company'),
				'shipping_address_1'      => $order_query->row('shipping_address_1'),
				'shipping_address_2'      => $order_query->row('shipping_address_2'),
				'shipping_postcode'       => $order_query->row('shipping_postcode'),
				'shipping_city'           => $order_query->row('shipping_city'),
				'shipping_state_id'       => $order_query->row('shipping_state_id'),
				'shipping_zone'           => $order_query->row('shipping_zone'),
				'shipping_zone_code'      => $shipping_zone_code,
				'shipping_country_id'     => $order_query->row('shipping_country_id'),
				'shipping_country'        => $order_query->row('shipping_country'),
				'shipping_iso_code_2'     => $shipping_iso_code_2,
				'shipping_iso_code'       => $shipping_iso_code,
				'shipping_method'         => $order_query->row('shipping_method'),
				'shipping_code'           => $order_query->row('shipping_code'),
				'comment'                 => $order_query->row('comment'),
				'total'                   => $order_query->row('total'),
				'order_status_id'         => $order_query->row('order_status_id'),
				'order_status'            => $order_query->row('order_status'),
				'currency_id'             => $order_query->row('currency_id'),
				'currency_code'           => $order_query->row('currency_code'),
				'currency_value'          => $order_query->row('currency_value'),
				'date_modified'           => $order_query->row('date_modified'),
				'date_added'              => $order_query->row('date_added')
			);
		} else {
			return false;
		}
	}

	public function addOrderHistory($order_id, $order_status_id, $comment = '', $notify = false, $override = false) 
	{
		//echo $order_id;exit;
		$event_data = array(
			'order_id'		  => $order_id,
			'order_status_id' => $order_status_id,
			'comment'		  => $comment,
			'notify'		  => $notify
		);

		$order_info = $this->getOrder($order_id);

		if ($order_info) 
		{
			// Fraud Detection
			$this->load->model('customers/customers_model','customers');

			$customer_info = $this->customers->getCustomer($order_info['customer_id']);

			// Update the DB with the new statuses
			$this->db->query("UPDATE `order` SET order_status_id = '" . (int)$order_status_id . "', date_modified = NOW() WHERE order_id = '" . (int)$order_id . "'");

			$this->db->query("INSERT INTO order_history SET order_id = '" . (int)$order_id . "', order_status_id = '" . (int)$order_status_id . "', notify = '" . (int)$notify . "', comment = '" . $comment . "', date_added = NOW()");

			// If old order status is the processing or complete status but new status is not then commence restock, and remove coupon, voucher and reward history
			$config_processing_status = json_decode($this->common->config('config_processing_status'),true);
			$config_complete_status = json_decode($this->common->config('config_complete_status'),true);

			if (!in_array($order_info['order_status_id'], array_merge($config_processing_status, $config_complete_status)) && !in_array($order_status_id, array_merge($config_processing_status, $config_complete_status))) 
			{
				// Restock
				$product_query = $this->db->query("SELECT * FROM   order_product WHERE order_id = '" . (int)$order_id . "'");

				foreach($product_query->result_array() as $product) {
					$this->db->query("UPDATE `product` SET quantity = (quantity + " . (int)$product['quantity'] . ") WHERE product_id = '" . (int)$product['product_id'] . "' AND subtract_stock = '1'");

					$option_query = $this->db->query("SELECT * FROM order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . (int)$product['order_product_id'] . "'");

					foreach ($option_query->result_array() as $option) {
						$this->db->query("UPDATE product_option_value SET quantity = (quantity + " . (int)$product['quantity'] . ") WHERE product_option_value_id = '" . (int)$option['product_option_value_id'] . "' AND subtract = '1'");
					}
				}

				// Remove coupon, vouchers and reward points history
				//$this->load->model('account/order');

				$order_total_query = $this->db->query("SELECT * FROM `order_total` WHERE order_id = '" . (int)$order_id . "'");
				foreach ($order_total_query->result_array() as $order_total) {

					$model = 'total_' . $order_total['code'].'_model';
					$this->load->model('api/'.$model,$model);

					if (method_exists($this->$model, 'unconfirm')) {
						$this->$model->unconfirm($order_id);
					}
				}

				
			}

		
			// If order status is 0 then becomes greater than 0 send main html email
			if (!$order_info['order_status_id'] && $order_status_id) 
			{
				// Check for any downloadable products
				 $download_status = false;

				 $order_product_query = $this->db->query("SELECT * FROM order_product WHERE order_id = '" . (int)$order_id . "'");
				 	// echo "<pre>";
				 	// //echo $order_product['product_id'];
				 	// print_r($order_product_query->row_array());
				 foreach ($order_product_query->result_array() as $order_product) 
				 {

				 	// Check if there are any linked downloads
				 	$product_download_query = $this->db->query("SELECT COUNT(*) AS total FROM `product_download` WHERE product_id = '" . (int)$order_product['product_id'] . "'");

					if ($product_download_query->row('total')) 
				 	{
				 		$download_status = true;
				 	}
				 }

				 $order_status_query = $this->db->query("SELECT * FROM order_status WHERE order_status_id = '" . (int)$order_status_id . "'");

				if ($order_status_query->num_rows() > 0) 
				{
					$order_status = $order_status_query->row('order_status_name');
				} 
				else 
				{
					$order_status = '';
				}

				$subject = sprintf($this->lang->line('text_new_subject'), $this->common->config('config_store_name'),$order_id);

				// // HTML Mail
				$data = array();

				$data['title'] = sprintf($this->lang->line('text_new_subject'), $this->common->config('config_store_name'), $order_id);

				$data['text_greeting'] = sprintf($this->lang->line('text_new_greeting'), $this->common->config('config_store_name'));
				$data['text_link'] = $this->lang->line('text_new_link');
				$data['text_download'] = $this->lang->line('text_new_download');
				$data['text_order_detail'] = $this->lang->line('text_new_order_detail');
				$data['text_instruction'] = $this->lang->line('text_new_instruction');
				$data['text_order_id'] = $this->lang->line('text_new_order_id');
				$data['text_date_added'] = $this->lang->line('text_new_date_added');
				$data['text_payment_method'] = $this->lang->line('text_new_payment_method');
				$data['text_shipping_method'] = $this->lang->line('text_new_shipping_method');
				$data['text_email'] = $this->lang->line('text_new_email');
				$data['text_telephone'] = $this->lang->line('text_new_telephone');
				$data['text_ip'] = $this->lang->line('text_new_ip');
				$data['text_order_status'] = $this->lang->line('text_new_order_status');
				$data['text_payment_address'] = $this->lang->line('text_new_payment_address');
				$data['text_shipping_address'] = $this->lang->line('text_new_shipping_address');
				$data['text_product'] = $this->lang->line('text_new_product');
				$data['text_model'] = $this->lang->line('text_new_model');
				$data['text_quantity'] = $this->lang->line('text_new_quantity');
				$data['text_price'] = $this->lang->line('text_new_price');
				$data['text_total'] = $this->lang->line('text_new_total');
				$data['text_footer'] = $this->lang->line('text_new_footer');

				$data['logo'] = HTTP_CATALOG.'image/'.$this->common->config('config_logo');
				$data['store_name'] = $this->common->config('config_store_name');
				$data['customer_id'] = $order_info['customer_id'];
				$data['link'] = HTTP_CATALOG;

				if ($download_status) {
					$data['download'] = '';
				} else {
					$data['download'] = '';
				}

				$data['order_id'] = $order_id;
				$data['date_added'] = date($this->common->config('config_date_format'), strtotime($order_info['date_added']));
				$data['payment_method'] = $order_info['payment_method'];
				$data['shipping_method'] = $order_info['shipping_method'];
				$data['email'] = $order_info['email'];
				$data['telephone'] = $order_info['telephone'];
				$data['order_status'] = $order_status;

				if ($comment && $notify) {
					$data['comment'] = nl2br($comment);
				} else {
					$data['comment'] = '';
				}

				$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
				$find = array(
					'{firstname}',
					'{lastname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{zone_code}',
					'{country}'
				);

				$replace = array(
					'firstname' => $order_info['payment_firstname'],
					'lastname'  => $order_info['payment_lastname'],
					'company'   => $order_info['payment_company'],
					'address_1' => $order_info['payment_address_1'],
					'address_2' => $order_info['payment_address_2'],
					'city'      => $order_info['payment_city'],
					'postcode'  => $order_info['payment_postcode'],
					'zone'      => $order_info['payment_zone'],
					'zone_code' => $order_info['payment_zone_code'],
					'country'   => $order_info['payment_country']
				);

				$data['payment_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

				$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
				$find = array(
					'{firstname}',
					'{lastname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{zone_code}',
					'{country}'
				);

				$replace = array(
					'firstname' => $order_info['shipping_firstname'],
					'lastname'  => $order_info['shipping_lastname'],
					'company'   => $order_info['shipping_company'],
					'address_1' => $order_info['shipping_address_1'],
					'address_2' => $order_info['shipping_address_2'],
					'city'      => $order_info['shipping_city'],
					'postcode'  => $order_info['shipping_postcode'],
					'zone'      => $order_info['shipping_zone'],
					'zone_code' => $order_info['shipping_zone_code'],
					'country'   => $order_info['shipping_country']
				);

				$data['shipping_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

				//Products
				$data['products'] = array();

				foreach ($order_product_query->result_array() as $product) {
					$option_data = array();

					$order_option_query = $this->db->query("SELECT * FROM order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . (int)$product['order_product_id'] . "'");

					foreach ($order_option_query->result_array() as $option) {
						if ($option['type'] != 'file') {
							$value = $option['value'];
						} else {
							// $upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

							// if ($upload_info) {
							// 	$value = $upload_info['name'];
							// } else {
								$value = '';
							// }
						}

						$option_data[] = array(
							'name'  => $option['name'],
							'value' => (strlen($value) > 20 ? substr($value, 0, 20) . '..' : $value)
						);
					}

					$data['products'][] = array(
						'name'     => $product['name'],
						'model'    => $product['model'],
						'option'   => $option_data,
						'quantity' => $product['quantity'],
						'price'    => $this->currency->format($product['price'] + ($this->common->config('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']),
						'total'    => $this->currency->format($product['total'] + ($this->common->config('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value'])
					);
				}

				// Vouchers
				$data['vouchers'] = array();

				$order_voucher_query = $this->db->query("SELECT * FROM order_voucher WHERE order_id = '" . (int)$order_id . "'");

				foreach ($order_voucher_query->result_array() as $voucher) {
					$data['vouchers'][] = array(
						'description' => $voucher['description'],
						'amount'      => $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value']),
					);
				}

				// Order Totals
				$data['totals'] = array();
				$order_total_query = $this->db->query("SELECT * FROM `order_total` WHERE order_id = '" . (int)$order_id . "'");
				// echo "<pre>";
				// echo $order_id;
				// print_r($order_total_query->result_array());exit;
				foreach ($order_total_query->result_array() as $total) 
				{
					$data['totals'][] = array(
						'title' => $total['title'],
						'text'  => $this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value']),
					);
				}
				// echo "<pre>";
				// print_r($data['totals']);exit;
				// if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/mail/order.tpl')) {
				// 	$html = $this->load->view($this->config->get('config_template') . '/template/mail/order.tpl', $data);
				// } else {
				// 	
				// }
				$admin_theme = $this->common->config('admin_theme');
				$content_page="themes/".$admin_theme."/common/order_mail";
				$html =$this->load->view($content_page,$data,true);
				
				//Text Mail
				$text  = sprintf($this->lang->line('text_new_greeting'), $this->common->config('config_store_name')) . "\n\n";
				$text .= $this->lang->line('text_new_order_id') . ' ' . $order_id . "\n";
				$text .= $this->lang->line('text_new_date_added') . ' ' . date($this->common->config('config_date_format'), strtotime($order_info['date_added'])) . "\n";
				$text .= $this->lang->line('text_new_order_status') . ' ' . $order_status . "\n\n";

				if ($comment && $notify) {
					$text .= $this->lang->line('text_new_instruction') . "\n\n";
					$text .= $comment . "\n\n";
				}

				// Products
				$text .= $this->lang->line('text_new_products') . "\n";

				foreach ($order_product_query->result_array() as $product) {
					$text .= $product['quantity'] . 'x ' . $product['name'] . ' (' . $product['model'] . ') ' . html_entity_decode($this->currency->format($product['total'] + ($this->common->config('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']), ENT_NOQUOTES, 'UTF-8') . "\n";

					$order_option_query = $this->db->query("SELECT * FROM order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . $product['order_product_id'] . "'");

					foreach ($order_option_query->result_array() as $option) {
						if ($option['type'] != 'file') {
							$value = $option['value'];
						} else {
							$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

							if ($upload_info) {
								$value = $upload_info['name'];
							} else {
								$value = '';
							}
						}

						$text .= chr(9) . '-' . $option['name'] . ' ' . (strlen($value) > 20 ? substr($value, 0, 20) . '..' : $value) . "\n";
					}
				}

				foreach ($order_voucher_query->result_array() as $voucher) {
					$text .= '1x ' . $voucher['description'] . ' ' . $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value']);
				}

				$text .= "\n";

				$text .= $this->lang->line('text_new_order_total') . "\n";

				foreach ($order_total_query->result_array() as $total) {
					$text .= $total['title'] . ': ' . $this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value']). "\n";
				}

				$text .= "\n";

				if ($order_info['customer_id']) {
					$text .= $this->lang->line('text_new_link') . "\n";
					$text .= "";
				}

				if ($download_status) {
					$text .= $this->lang->line('text_new_download') . "\n";
					$text .= "";
				}

				// Comment
				if ($order_info['comment']) {
					$text .= $this->lang->line('text_new_comment') . "\n\n";
					$text .= $order_info['comment'] . "\n\n";
				}

				$text .= $this->lang->line('text_new_footer') . "\n\n";
				$this->mailer->Send_contact_mail($order_info['email'],$subject,$html);
				// $mail = new Mail();
				// $mail->protocol = $this->config->get('config_mail_protocol');
				// $mail->parameter = $this->config->get('config_mail_parameter');
				// $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
				// $mail->smtp_username = $this->config->get('config_mail_smtp_username');
				// $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
				// $mail->smtp_port = $this->config->get('config_mail_smtp_port');
				// $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

				// $mail->setTo($order_info['email']);
				// $mail->setFrom($this->config->get('config_email'));
				// $mail->setSender(html_entity_decode($this->common->config('config_store_name'), ENT_QUOTES, 'UTF-8'));
				// $mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
				// $mail->setHtml($html);
				// $mail->setText($text);
				// $mail->send();

				// Admin Alert Mail
				 if ($this->common->config('config_email')) 
				{
					$subject = sprintf($this->lang->line('text_new_subject'), $this->common->config('config_name'), $order_id);

					// HTML Mail
					$data['text_greeting'] = $this->lang->line('text_new_received');

					if ($comment) {
						if ($order_info['comment']) {
							$data['comment'] = nl2br($comment) . '<br/><br/>' . $order_info['comment'];
						} else {
							$data['comment'] = nl2br($comment);
						}
					} else {
						if ($order_info['comment']) {
							$data['comment'] = $order_info['comment'];
						} else {
							$data['comment'] = '';
						}
					}

					$data['text_download'] = '';

					$data['text_footer'] = '';

					$data['text_link'] = '';
					$data['link'] = '';
					$data['download'] = '';

					$admin_theme = $this->common->config('admin_theme');
					$content_page="themes/".$admin_theme."/common/order_mail";
					$html =$this->load->view($content_page,$data,true);

					//Text
					$text  = $this->lang->line('text_new_received') . "\n\n";
					$text .= $this->lang->line('text_new_order_id') . ' ' . $order_id . "\n";
					$text .= $this->lang->line('text_new_date_added') . ' ' . date($this->common->config('config_date_format'), strtotime($order_info['date_added'])) . "\n";
					$text .= $this->lang->line('text_new_order_status') . ' ' . $order_status . "\n\n";
					$text .= $this->lang->line('text_new_products') . "\n";

					foreach ($order_product_query->result_array() as $product) {
						$text .= $product['quantity'] . 'x ' . $product['name'] . ' (' . $product['model'] . ') ' . html_entity_decode($this->currency->format($product['total'] + ($this->common->config('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']), ENT_NOQUOTES, 'UTF-8') . "\n";

						$order_option_query = $this->db->query("SELECT * FROM order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . $product['order_product_id'] . "'");

						foreach ($order_option_query->result_array() as $option) {
							if ($option['type'] != 'file') {
								$value = $option['value'];
							} else {
								$value = substr($option['value'], 0, strrpos($option['value'], '.'));
							}

							$text .= chr(9) . '-' . $option['name'] . ' ' . (strlen($value) > 20 ? substr($value, 0, 20) . '..' : $value) . "\n";
						}
					}

					foreach ($order_voucher_query->result_array() as $voucher) {
						$text .= '1x ' . $voucher['description'] . ' ' . $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value']);
					}

					$text .= "\n";

					$text .= $this->lang->line('text_new_order_total') . "\n";

					foreach ($order_total_query->result_array() as $total) {
						$text .= $total['title'] . ': ' . $this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value']). "\n";
					}

					$text .= "\n";

					if ($order_info['comment']) {
						$text .= $this->lang->line('text_new_comment') . "\n\n";
						$text .= $order_info['comment'] . "\n\n";
					}

					// $mail = new Mail();
					// $mail->protocol = $this->config->get('config_mail_protocol');
					// $mail->parameter = $this->config->get('config_mail_parameter');
					// $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
					// $mail->smtp_username = $this->config->get('config_mail_smtp_username');
					// $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
					// $mail->smtp_port = $this->config->get('config_mail_smtp_port');
					// $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

					// $mail->setTo($this->config->get('config_email'));
					// $mail->setFrom($this->config->get('config_email'));
					// $mail->setSender(html_entity_decode($this->common->config('config_store_name'), ENT_QUOTES, 'UTF-8'));
					// $mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
					// $mail->setHtml($html);
					// $mail->setText($text);
					// $mail->send();
					//echo $html;
					$this->mailer->Send_contact_mail($this->common->config('config_mail'),$subject,$html);
					// Send to additional alert emails
					$emails = explode(',', $this->common->config('config_mail_alert'));

					// foreach ($emails as $email) {
					// 	if ($email && preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
					// 		$mail->setTo($email);
					// 		$mail->send();
					// 	}
					// }
				}
			}

			// If order status is not 0 then send update text email
			if ($order_info['order_status_id'] && $order_status_id && $notify) {
				
				$subject = sprintf($this->lang->line('text_update_subject'), $this->common->config('config_store_name'), $order_id);

				$message  = $this->lang->line('text_update_order') . ' ' . $order_id . "\n";
				$message .= $this->lang->line('text_update_date_added') . ' ' . date($this->common->config('config_date_format'), strtotime($order_info['date_added'])) . "\n\n";

				$order_status_query = $this->db->query("SELECT * FROM order_status WHERE order_status_id = '" . (int)$order_status_id . "'");

				if ($order_status_query->num_rows()>0) {
					$message .= $this->lang->line('text_update_order_status') . "\n\n";
					$message .= $order_status_query->row('order_status_name') . "\n\n";
				}

				if ($order_info['customer_id']) {
					$message .= $this->lang->line('text_update_link') . "\n";
					$message .= "\n\n";
				}

				if ($comment) {
					$message .= $this->lang->line('text_update_comment') . "\n\n";
					$message .= strip_tags($comment) . "\n\n";
				}

				$message .= $this->lang->line('text_update_footer');
				$this->mailer->Send_contact_mail($order_info['email'],$subject,$message);
				
			}
		}

		
	}
}
