 <?php

/**
 * VoucherThemes Model Class
 * Collection of various common function related to VoucherThemes database operation.
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Orders_model extends CI_Model 
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
	}
	 /**
	* 
	* @function name 	: getOrder()
	* @description   	: get order record by order_id
	* @access 		 	: public
	* @param   		 	: int $order_id The order_id  that you want
	* @return       	: array The selected order_id array
	*
	*/
    public function getOrder($order_id) {
		$order_query = $this->db->query("SELECT *, (SELECT CONCAT(c.firstname, ' ', c.lastname) FROM customer c WHERE c.customer_id = o.customer_id) AS customer FROM `order` o WHERE o.order_id = '" . (int)$order_id . "'");

		if ($order_query->num_rows()) {
			$reward = 0;

			$order_product_query = $this->db->query("SELECT * FROM order_product WHERE order_id = '" . (int)$order_id . "'");

			foreach ($order_product_query->result_array() as $product) {
				$reward += $product['reward'];
			}
                        $order_query = $order_query->row_array();
                       
			$country_query = $this->db->query("SELECT * FROM `country` WHERE country_id = '" . (int)$order_query['payment_country_id'] . "'");

			if ($country_query->num_rows()) {
                             $country_query = $country_query->row_array();
				$payment_iso_code_2 = $country_query['iso_code_2'];
				$payment_iso_code = $country_query['iso_code'];
			} else {
				$payment_iso_code_2 = '';
				$payment_iso_code = '';
			}

			/*$zone_query = $this->db->query("SELECT * FROM `state` WHERE state_id = '" . (int)$order_query['payment_state_id'] . "'");

			if ($zone_query->num_rows()) {
				$payment_zone_code = $zone_query['code'];
			} else {
				$payment_zone_code = '';
			}*/

			$country_query = $this->db->query("SELECT * FROM `country` WHERE country_id = '" . (int)$order_query['shipping_country_id'] . "'");

			if ($country_query->num_rows) {
				$shipping_iso_code_2 = $country_query['iso_code_2'];
				$shipping_iso_code = $country_query['iso_code'];
			} else {
				$shipping_iso_code_2 = '';
				$shipping_iso_code = '';
			}

			/*$zone_query = $this->db->query("SELECT * FROM `state` WHERE state_id = '"  . (int)$order_query['shipping_zone_id'] . "'");

			if ($zone_query->num_rows()) {
				$shipping_zone_code = $zone_query['code'];
			} else {
				$shipping_zone_code = '';
			}*/

			return array(
				'order_id'                => $order_query['order_id'],
				'invoice_no'              => $order_query['invoice_no'],
				'invoice_prefix'          => $order_query['invoice_prefix'],
				//'store_id'                => $order_query['store_id'],
				//'store_name'              => $order_query['store_name'],
				//'store_url'               => $order_query['store_url'],
				'customer_id'             => $order_query['customer_id'],
				'customer'                => $order_query['customer'],
				'customer_group_id'       => $order_query['customer_group_id'],
				'firstname'               => $order_query['firstname'],
				'lastname'                => $order_query['lastname'],
				'email'                   => $order_query['email'],
				'telephone'               => $order_query['telephone'],
				//'fax'                     => $order_query['fax'],
				//'custom_field'            => json_decode($order_query['custom_field'], true),
				'payment_firstname'       => $order_query['payment_firstname'],
				'payment_lastname'        => $order_query['payment_lastname'],
				'payment_company'         => $order_query['payment_company'],
				'payment_address_1'       => $order_query['payment_address_1'],
				'payment_address_2'       => $order_query['payment_address_2'],
				'payment_postcode'        => $order_query['payment_postcode'],
				'payment_city'            => $order_query['payment_city'],
				'payment_state_id'         => $order_query['payment_state_id'],
				'payment_zone'            => $order_query['payment_zone'],
				//'payment_zone_code'       => $payment_zone_code,
				'payment_country_id'      => $order_query['payment_country_id'],
				'payment_country'         => $order_query['payment_country'],
				'payment_iso_code_2'      => $payment_iso_code_2,
				'payment_iso_code'        => $payment_iso_code,
				//'payment_address_format'  => $order_query['payment_address_format'],
				//'payment_custom_field'    => json_decode($order_query['payment_custom_field'], true),
				'payment_method'          => $order_query['payment_method'],
				'payment_code'            => $order_query['payment_code'],
				'shipping_firstname'      => $order_query['shipping_firstname'],
				'shipping_lastname'       => $order_query['shipping_lastname'],
				'shipping_company'        => $order_query['shipping_company'],
				'shipping_address_1'      => $order_query['shipping_address_1'],
				'shipping_address_2'      => $order_query['shipping_address_2'],
				'shipping_postcode'       => $order_query['shipping_postcode'],
				'shipping_city'           => $order_query['shipping_city'],
				'shipping_state_id'        => $order_query['shipping_state_id'],
				'shipping_zone'           => $order_query['shipping_zone'],
				//'shipping_zone_code'      => $shipping_zone_code,
				'shipping_country_id'     => $order_query['shipping_country_id'],
				'shipping_country'        => $order_query['shipping_country'],
				'shipping_iso_code_2'     => $shipping_iso_code_2,
				'shipping_iso_code'       => $shipping_iso_code,
				//'shipping_address_format' => $order_query['shipping_address_format'],
				//'shipping_custom_field'   => json_decode($order_query['shipping_custom_field'], true),
				'shipping_method'         => $order_query['shipping_method'],
				'shipping_code'           => $order_query['shipping_code'],
				'comment'                 => $order_query['comment'],
				'total'                   => $order_query['total'],
				'order_status_id'         => $order_query['order_status_id'],
				'currency_id'             => $order_query['currency_id'],
				'currency_code'           => $order_query['currency_code'],
				'currency_value'          => $order_query['currency_value'],
				'date_added'              => $order_query['date_added'],
				'date_modified'           => $order_query['date_modified']
			);
		} else {
			return;
		}
	}
	/**
	* 
	* @function name 	: getOrders()
	* @description   	: get all Orders from database
	* @access 		: public
	* @param   		: string $data The Order that you want to get
	* @return       	: array The selected Order array
	*
	*/
	public function getOrders($data = array()) {
		$sql = "SELECT o.order_id, CONCAT(o.firstname, ' ', o.lastname) AS customer, (SELECT os.order_status_name FROM order_status os WHERE os.order_status_id = o.order_status_id ) AS status, o.shipping_code, o.total, o.currency_code, o.currency_value,o.date_added, o.date_modified FROM `order` o";
		if (isset($data['filter_order_status']) && $data['filter_order_status'] !== "*") 
		{
			$implode = array();

			$order_statuses = explode(',', $data['filter_order_status']);

			foreach ($order_statuses as $order_status_id) {
				$implode[] = "o.order_status_id = '" . (int)$order_status_id . "'";
			}

			if ($implode) {
				$sql .= " WHERE (" . implode(" OR ", $implode) . ")";
			}
		} else {
			$sql .= " WHERE o.order_status_id > '0'";
		}

		if (!empty($data['filter_order_id'])) {
			$sql .= " AND o.order_id = '" . (int)$data['filter_order_id'] . "'";
		}

		if (!empty($data['filter_customer'])) {
			$sql .= " AND CONCAT(o.firstname, ' ', o.lastname) LIKE '%" .$data['filter_customer']. "%'";
		}

		if (!empty($data['filter_date_added'])) {
			$filter_date_added = date('Y-m-d',strtotime($data['filter_date_added']));
			$sql .= " AND DATE(o.date_added) = DATE('" .$filter_date_added. "')";
			//$sql .= " AND DATE(o.date_added) = DATE('" .$data['filter_date_added']. "')";
		}

		if (!empty($data['filter_date_modified'])) {
			$filter_date_modified = date('Y-m-d',strtotime($data['filter_date_modified']));
			$sql .= " AND DATE(date_modified) = DATE('" .$filter_date_modified. "')";
			
		}

		if (!empty($data['filter_total'])) {
			$sql .= " AND o.total = '" . (float)$data['filter_total'] . "'";
		}

		$sort_data = array(
			'o.order_id',
			'customer',
			'status',
			'o.date_added',
			'o.date_modified',
			'o.total'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY o.order_id";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		//echo $sql;
		$query = $this->db->query($sql);

		return $query->result_array();
	}  
	/**
	* 
	* @function name 	: getTotalOrders()
	* @description   	: get total no of orders from database
	* @access 		: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalOrders($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM `order`";

		if (isset($data['filter_order_status'])) {
			$implode = array();

			$order_statuses = explode(',', $data['filter_order_status']);

			foreach ($order_statuses as $order_status_id) {
				$implode[] = "order_status_id = '" . (int)$order_status_id . "'";
			}

			if ($implode) {
				$sql .= " WHERE (" . implode(" OR ", $implode) . ")";
			}
		} else {
			$sql .= " WHERE order_status_id > '0'";
		}

		if (!empty($data['filter_order_id'])) {
			$sql .= " AND order_id = '" . (int)$data['filter_order_id'] . "'";
		}

		if (!empty($data['filter_customer'])) {
			$sql .= " AND CONCAT(firstname, ' ', lastname) LIKE '%" .$data['filter_customer']. "%'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(date_added) = DATE('" .$data['filter_date_added']. "')";
		}

		if (!empty($data['filter_date_modified'])) {
			$filter_date_modified = date('Y-m-d',strtotime($data['filter_date_modified']));
			$sql .= " AND DATE(date_modified) = DATE('" .$filter_date_modified. "')";
		}

		if (!empty($data['filter_total'])) {
			$sql .= " AND total = '" . (float)$data['filter_total'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row('total');
	}

	public function getOrderProducts($order_id) {
		$query = $this->db->query("SELECT * FROM order_product WHERE order_id = '" . (int)$order_id . "'");

		return $query->result_array();
	}  

	public function getOrderOptions($order_id, $order_product_id) {
		$query = $this->db->query("SELECT * FROM order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . (int)$order_product_id . "'");

		return $query->result_array();
	}

	public function getOrderVouchers($order_id) {
		$query = $this->db->query("SELECT * FROM order_voucher WHERE order_id = '" . (int)$order_id . "'");

		return $query->result_array();
	}

	

	public function getOrderTotals($order_id) {
		$query = $this->db->query("SELECT * FROM order_total WHERE order_id = '" . (int)$order_id . "'");

		return $query->result_array();
	}
    /**
	* 
	* @function name : getTotalOrdersByCurrencyId()
	* @description   : get order record by $currency_id
	* @access        : public
	* @param   	 : int $currency_id
	* @return        : int total no of records
	*
	*/
        public function getTotalOrdersByCurrencyId($currency_id) {
            $query = $this->db->query("SELECT COUNT(*) AS total FROM `order` WHERE currency_id = '" . (int)$currency_id . "' AND order_status_id > '0'");
            return $query->row('total');
	}
	
        /**
	* 
	* @function name : getTotalOrderHistoriesByOrderStatusId()
	* @description   : get order record by $currency_id
	* @access        : public
	* @param   	 : int $currency_id
	* @return        : int total no of records
	*
	*/
        public function getTotalOrderHistoriesByOrderStatusId($order_status_id) {
            $query = $this->db->query("SELECT COUNT(*) AS total FROM order_history WHERE order_status_id = '" . (int)$order_status_id . "'");
            return $query('total');
	}
        
        /**
	* 
	* @function name : getOrderVoucherByVoucherId()
	* @description   : get order record by $voucher_id
	* @access        : public
	* @param   	 : int $voucher_id
	* @return        : int total no of records
	*
	*/
        public function getOrderVoucherByVoucherId($voucher_id) {
            $query = $this->db->query("SELECT * FROM `order_voucher` WHERE voucher_id = '" . (int)$voucher_id . "'");            
            return $query_array();
	}
	
	public function createInvoiceNo($order_id) 
	{
		$order_info = $this->getOrder($order_id);

		if ($order_info && !$order_info['invoice_no']) 
		{
			$query = $this->db->query("SELECT MAX(invoice_no) AS invoice_no FROM `order` WHERE invoice_prefix = '" . $order_info['invoice_prefix'] . "'");

			if ($query->row('invoice_no')) 
			{
				$invoice_no = $query->row('invoice_no') + 1;
			} else {
				$invoice_no = 1;
			}

			$this->db->query("UPDATE `order` SET invoice_no = '" . (int)$invoice_no . "', invoice_prefix = '" . $order_info['invoice_prefix'] . "' WHERE order_id = '" . (int)$order_id . "'");

			return $order_info['invoice_prefix'] . $invoice_no;
		}
	}

	public function getOrderHistories($order_id, $start = 0, $limit = 10) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}

		$query = $this->db->query("SELECT oh.date_added, os.order_status_name AS status, oh.comment, oh.notify FROM order_history oh LEFT JOIN order_status os ON oh.order_status_id = os.order_status_id WHERE oh.order_id = '" . (int)$order_id . "' ORDER BY oh.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->result_array();
	}

	public function getTotalOrderHistories($order_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM order_history WHERE order_id = '" . (int)$order_id . "'");

		return $query->row('total');
	}

//get order_product table data
	public function getOrderProduct($data=array())
	{
		$sql="select distinct op.*,m.firstname,op.manufacturer_id from order_product op left join manufacturer m on op.manufacturer_id = m.manufacturer_id";
		//echo $data['filter_order_id'];exit;
		if (isset($data['filter_order_id'])) {
			$sql .= " WHERE op.order_id = '".(int)$data['filter_order_id']."'";
		}	
		$sql .= " group by(op.manufacturer_id)";
			
		
		$query = $this->db->query($sql);

		return $query->result_array();
	}
	
	
	
	
	
	 
    
}

?>