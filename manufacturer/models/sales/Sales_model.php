<?php
/**
* 
* @file name   : Sales_model
* @Auther      : Mitesh
* @Date        : 6-01-2017
* @Description : Collection of various common function related to sales database operation.
*
*/
class Sales_model extends CI_Model 
{
    /**
    * 
    * @function name 	: __construct()
    * @description   	: initialize variables
    * @param   		    : void
    * @return        	: void
    *
    */
    public function __construct() 
    {
        parent::__construct();
    }
	
	/**
	* 
	* @function name 	: getSale()
	* @description   	: get sales group record by purchase_id
	* @access 		 	: public
	* @param   		 	: int $purchase_id The purchase id that you want
	* @return       	: array The selected purchase array
	*
	*/
	public function getSale($purchase_id)
	{
		$this->db->from('purchase');
		$this->db->where('purchase_id',(int)$purchase_id);
		$query=$this->db->get();
		return $query->row_array();
	}
	
	/**
	* 
	* @function name 	: getSales()
	* @description   	: get all purchases from database
	* @access 		 	: public
	* @param   		 	: string $information The attributes that you want to get
	* @return       	: array The selected attributes array
	*
	*/
	public function getSales($data = array())
	{
                
		$sql = "SELECT * FROM purchase WHERE 1=1";
                
		$sort_data = array(
			'purchase_id',
			'order_id',
			'sort_order'			
		);
                
		
		$sql .= " AND is_deleted = 0 and manufacturer_id = ".(int)$this->session->userdata('manufacturer_user_id');
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) 
		{
			$sql .= " ORDER BY " . $data['sort'];
		} 
		else 
		{
			$sql .= " ORDER BY purchase_id";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) 
		{
			$sql .= " DESC";
		} 
		else 
		{
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) 
		{
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);
		
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: addPurchase()
	* @description   	: add purchase record in database
	* @access 		 	: public
	* @return       	: int last inserted purchase record id
	*
	*/
	public function addPurchase($data)
	{
		$order_id=$this->input->post('select_order');		
		$manufacturer_id=$this->input->post('select_manufacturers');
		
		//get Total
		$purchase_total=0;
		$get_total_data=$this->purchasecart->getPurchaseTotal();
		foreach($get_total_data as $get_total)
		{
			$purchase_total=$get_total['value'];
		}
				
		//get currency data
		$currency_data=$this->getCurrencyData(); 
		$currency_id=$currency_data['currency_id'];
		$currency_code=$currency_data['code'];
		$currency_value=$currency_data['value'];
		
		//get invoice_no
		$invoice_no=0;
		$query_invoice_no=$this->db->query("SELECT max(`invoice_no`) as last_invoice_no FROM `purchase`");
		$get_invoice_no=$query_invoice_no->row_array();
		$invoice_no=(int)$get_invoice_no['last_invoice_no'];
		
		if($invoice_no == "" || $invoice_no == 0)
		{
			$invoice_no+=1;
		}
		else
		{
			$invoice_no+=1;
		}
		
		//get invoice prfix value from setting table
		$config_invoiceprefix=$this->common->config('config_invoice_prefix');
		
		//manufactureraddress
		$manufacturer_address=$this->getManufacturerAddress($manufacturer_id);
		if($manufacturer_address)
		{
			$payment_firstname	= $manufacturer_address['firstname'];
			$payment_lastname	= $manufacturer_address['lastname'];		
			$payment_address_1	= $manufacturer_address['address_1'];
				
			$payment_city		= $manufacturer_address['city'];
			$payment_postcode	= $manufacturer_address['postcode'];
			$payment_country_id	= $manufacturer_address['country_id'];
			//get country name 	
			$get_country_data	= $this->country->getCountry($payment_country_id);		
			$payment_country    = $get_country_data['country_name'];
			
			$state_id 			= $manufacturer_address['state_id'];
			//get payment State
			$get_zone_data  	= $this->zone->getZone($state_id);
			$payment_zone 		= $get_zone_data['state_name'];
		}
		else
		{
			$payment_firstname  = "";
			$payment_lastname   = "";
			$payment_address_1  = "";
			
			$payment_city       = "";
			$payment_postcode   = "";
			$payment_country_id = "";
			//get country name 	
			$get_country_data   = "";
			$payment_country    = "";
			
			$state_id           = "";
			//get payment State
			$get_zone_data      = "";
			$payment_zone       = "";
		}
		
		
		$payment_method_code=$this->input->post('payment_method');		
		
		//get payment method data
		$get_payment_method_data=$this->getPaymentMethodByCode($payment_method_code);
		$payment_method_name=$get_payment_method_data['payment_method_name'];
		
		$fileInput=$this->input->post('fileInput');
		
		$description=$this->input->post('description');
		
		$payment_status=$this->input->post('payment_status');
		$received=$this->input->post('received');
		
		//attachment upload
		$imagearr='';
		$fail=0;$success=0;
		$path="../uploads/purcahse_order_attachments/";		
		if(isset($_FILES['Attachments']['name']))
		{			
			$reports=$this->filestorage->FileInsert_NoType($path,'Attachments',5242880);	
			if($reports['status'] == 0)
			{
				$fail+=1;	
			}
			else
			{
				$success+=1;
				if($imagearr == NULL)
				{
					$imagearr=$reports['msg'];
				}
				else
				{
					$imagearr.="|".$reports['msg'];
				}
			}
		}	
		
		$is_deleted = $this->input->post('is_deleted');
		if(isset($is_deleted))
		{
   			$is_deleted = 1;
		}
		else
		{
   			$is_deleted = 0;
		}
		
		$this->db->set('order_id',$order_id);		
		$this->db->set('invoice_no',$invoice_no);
		$this->db->set('invoice_prefix',$config_invoiceprefix);
		$this->db->set('manufacturer_id',$manufacturer_id);
		$this->db->set('total',$purchase_total);
		$this->db->set('currency_id',$currency_id);
		$this->db->set('currency_code',$currency_code);
		$this->db->set('currency_value',$currency_value);
		$this->db->set('order_status_id',$received);
		$this->db->set('payment_firstname',$payment_firstname);
		$this->db->set('payment_lastname',$payment_lastname);
		$this->db->set('payment_address_1',$payment_address_1);
		$this->db->set('payment_city',$payment_city);
		$this->db->set('payment_postcode',$payment_postcode);
		$this->db->set('payment_country',$payment_country);
		$this->db->set('payment_country_id',$payment_country_id);
		$this->db->set('payment_zone',$payment_zone);
		$this->db->set('state_id',$state_id);
		$this->db->set('payment_method',$payment_method_name);
		$this->db->set('payment_code',$payment_method_code);
		$this->db->set('payment_status',$payment_status);
		$this->db->set('attachment',$imagearr);
		$this->db->set('note',$description);		
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('user_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));      
		$this->db->insert('purchase');
		
		$purchase_id=$this->db->insert_id();
		
		if($purchase_id)
		{
			// Products
			if (isset($data['products'])) {
				foreach ($data['products'] as $product) {
					
					$this->db->query("INSERT INTO purchase_product SET purchase_id = '" . (int)$purchase_id . "', product_id = '" . (int)$product['product_id'] . "', name = '" . $product['name'] . "', model = '" . $product['model'] . "', quantity = '" . (int)$product['quantity'] . "', price = '" . (float)$product['price'] . "', total = '" . (float)$product['total'] . "'");
	
					$purchase_product_id = $this->db->insert_id();
					
					if(isset($product['option']))
					{
						foreach ($product['option'] as $option) {
							$this->db->query("INSERT INTO purchase_option SET purchase_id = '" . (int)$purchase_id . "', purchase_product_id = '" . (int)$purchase_product_id . "', product_option_id = '" . (int)$option['product_option_id'] . "', product_option_value_id = '" . (int)$option['product_option_value_id'] . "', name = '" . $option['name'] . "', `value` = '" . $option['value'] . "', `type` = '" . $option['type'] . "'");
						}
					}
				}
			}
			
		}
		
		$this->addPurchaseHistory($purchase_id, $received);
		
		return $purchase_id;
	}
	
	/**
	* 
	* @function name 	: editPurchase()
	* @description   	: edit purchase record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editPurchase($data)
	{
		$purchase_id=$this->input->post('purchase_id');
		
		$order_id=$this->input->post('select_order');		
		$manufacturer_id=$this->input->post('select_manufacturers');
		/*echo $manufacturer_id;
		exit;*/
		//get Total
		$purchase_total=0;
		$get_total_data=$this->purchasecart->getPurchaseTotal();
		//foreach($get_total_data['totals'] as $get_total)
		foreach($get_total_data as $get_total)
		{
			$purchase_total=$get_total['value'];
		}
				
		//get currency data
		$currency_data=$this->getCurrencyData(); 
		$currency_id=$currency_data['currency_id'];
		$currency_code=$currency_data['code'];
		$currency_value=$currency_data['value'];
		
		//get invoice_no
		$invoice_no=0;
		$query_invoice_no=$this->db->query("SELECT max(`invoice_no`) as last_invoice_no FROM `purchase`");
		$get_invoice_no=$query_invoice_no->row_array();
		$invoice_no=(int)$get_invoice_no['last_invoice_no'];
		
		if($invoice_no == "" || $invoice_no == 0)
		{
			$invoice_no+=1;
		}
		else
		{
			$invoice_no+=1;
		}
		
		//get invoice prfix value from setting table
		$get_config_invoiceprefix=$this->settings->getInvoicePrefix();
		$config_invoiceprefix=$get_config_invoiceprefix['val'];
		
		//manufactureraddress
		$manufacturer_address=$this->getManufacturerAddress($manufacturer_id);
		$payment_firstname=$manufacturer_address['firstname'];
		$payment_lastname=$manufacturer_address['lastname'];		
		$payment_address_1=$manufacturer_address['address_1'];
		$payment_address_2=$manufacturer_address['address_2'];
		$payment_city=$manufacturer_address['city'];
		$payment_postcode=$manufacturer_address['postcode'];
		$payment_country_id=$manufacturer_address['country_id'];
		//get country name 	
		$get_country_data=$this->country->getCountry($payment_country_id);		
		$payment_country=$get_country_data['country_name'];
		
		$state_id=$manufacturer_address['state_id'];
		//get payment State
		$get_zone_data=$this->zone->getZone($state_id);
		$payment_zone=$get_zone_data['state_name'];
		
		$payment_method_code=$this->input->post('payment_method');		
		
		//get payment method data
		$get_payment_method_data=$this->getPaymentMethodByCode($payment_method_code);
		$payment_method_name=$get_payment_method_data['payment_method_name'];
		
		$fileInput=$this->input->post('fileInput');
		
		$description=$this->input->post('description');
		
		$payment_status=$this->input->post('payment_status');
		$received=$this->input->post('received');
		
		$order_status_id=$this->input->post('received');
		
		
		//image delete and upload
		$imagearr='';
		$fail=0;$success=0;
		$path="../uploads/purcahse_order_attachments/";
		//if(isset($_FILES['Attachments']['name']) && $_FILES['Attachments']['name'][0] != NULL)
		if(isset($_FILES['Attachments']['name']))
		{
			/* delete file */
			$file=$path.$this->input->post('HAttachments');
			
			if(file_exists($file))
			{
				if(is_file($file))
				{
					unlink($file); //delete file
				}
			}
			/* //delete file */
			
			$imagedata=explode("|",$this->input->post('HAttachments'));
			foreach($imagedata as $image)
			{
				$this->filestorage->DeleteImage($path,$image);	
			}
			// foreach($_FILES['Attachments']['name'] as $key=>$val)
			// {
				$reports=$this->filestorage->FileInsert_NoType($path,'Attachments',5242880);	
				if($reports['status'] == 0)
				{
					$fail+=1;	
				}
				else
				{
					$success+=1;
					if($imagearr == NULL)
					{
						$imagearr=$reports['msg'];
					}
					else
					{
						$imagearr.="|".$reports['msg'];
					}
				}
			//}		
		}
		else
		{
			$imagearr=	$this->input->post('HAttachments');
		}
		
		
		$is_deleted = $this->input->post('is_deleted');
		if(isset($is_deleted))
		{
   			$is_deleted = 1;
		}
		else
		{
   			$is_deleted = 0;
		}
		
		$this->db->set('order_id',$order_id);		
		$this->db->set('invoice_no',$invoice_no);
		$this->db->set('invoice_prefix',$config_invoiceprefix);
		$this->db->set('manufacturer_id',$manufacturer_id);
		$this->db->set('total',$purchase_total);
		$this->db->set('currency_id',$currency_id);
		$this->db->set('currency_code',$currency_code);
		$this->db->set('currency_value',$currency_value);
		$this->db->set('order_status_id',$received);
		$this->db->set('payment_firstname',$payment_firstname);
		$this->db->set('payment_lastname',$payment_lastname);
		$this->db->set('payment_address_1',$payment_address_1);
		//$this->db->set('payment_address_2',$payment_address_2);
		$this->db->set('payment_city',$payment_city);
		$this->db->set('payment_postcode',$payment_postcode);
		$this->db->set('payment_country',$payment_country);
		$this->db->set('payment_country_id',$payment_country_id);
		$this->db->set('payment_zone',$payment_zone);
		$this->db->set('state_id',$state_id);
		$this->db->set('payment_method',$payment_method_name);
		$this->db->set('payment_code',$payment_method_code);
		$this->db->set('payment_status',$payment_status);
		$this->db->set('attachment',$imagearr);
		$this->db->set('note',$description);
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('user_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));  
		$this->db->where('purchase_id',(int)$this->input->post('purchase_id'));
		//return $this->db->update('purchase');	
		$update_purchase_data=$this->db->update('purchase');	
		
		$this->db->query("DELETE FROM purchase_product WHERE purchase_id = '" . (int)$purchase_id . "'");
		$this->db->query("DELETE FROM purchase_option WHERE purchase_id = '" . (int)$purchase_id . "'");
		
		if($update_purchase_data)
		{			

			// Products
			if (isset($data['products'])) {
				foreach ($data['products'] as $product) {
					
					$this->db->query("INSERT INTO purchase_product SET purchase_id = '" . (int)$purchase_id . "', product_id = '" . (int)$product['product_id'] . "', name = '" . $product['name'] . "', model = '" . $product['model'] . "', quantity = '" . (int)$product['quantity'] . "', price = '" . (float)$product['price'] . "', total = '" . (float)$product['total'] . "'");
	
					$purchase_product_id = $this->db->insert_id();
					
					if(isset($product['option']))
					{
						foreach ($product['option'] as $option) {
							$this->db->query("INSERT INTO purchase_option SET purchase_id = '" . (int)$purchase_id . "', purchase_product_id = '" . (int)$purchase_product_id . "', product_option_id = '" . (int)$option['product_option_id'] . "', product_option_value_id = '" . (int)$option['product_option_value_id'] . "', name = '" . $option['name'] . "', `value` = '" . $option['value'] . "', `type` = '" . $option['type'] . "'");
						}
					}
				}
			}			
		}
		
		// Void the order first
		$this->addPurchaseHistory($purchase_id, $received);	
		
	}
	
	public function getPurchaseData($purchase_id) {
		$query_purchase = $this->db->query("SELECT * FROM `purchase` WHERE purchase_id = '" . (int)$purchase_id . "'");
		$purchase_query=$query_purchase->row_array();
		/*echo $purchase_query['payment_country_id'];
		exit;*/
		/*echo "<pre>";
		print_r($purchase_query);
		echo "</pre>";
		exit;*/
		if ($query_purchase->num_rows() > 0) {
			$query_country = $this->db->query("SELECT * FROM `country` WHERE country_id = '" . (int)$purchase_query['payment_country_id'] . "'");
			$country_query=$query_country->row_array();
			if ($query_country->num_rows() > 0) {
				$payment_iso_code = $country_query['iso_code'];
				$payment_iso_code_2 = $country_query['iso_code_2'];				
			} else {
				$payment_iso_code = '';
				$payment_iso_code_2 = '';				
			}

			$query_zone = $this->db->query("SELECT * FROM `state` WHERE state_id = '" . (int)$purchase_query['state_id'] . "'");
			$zone_query=$query_zone->row_array();
			if ($query_zone->num_rows() > 0) {
				$payment_zone_code = $zone_query['state_code'];
			} else {
				$payment_zone_code = '';
			}
			
			return array(
				'purchase_id'             => $purchase_query['purchase_id'],
				'order_id'                => $purchase_query['order_id'],
				'invoice_no'              => $purchase_query['invoice_no'],
				'invoice_prefix'          => $purchase_query['invoice_prefix'],
				'manufacturer_id'         => $purchase_query['manufacturer_id'],
				'total'             	  => $purchase_query['total'],
				'currency_id'             => $purchase_query['currency_id'],
				'currency_code'           => $purchase_query['currency_code'],
				'currency_value'          => $purchase_query['currency_value'],
				'order_status_id'         => $purchase_query['order_status_id'],
				'payment_firstname'       => $purchase_query['payment_firstname'],
				'payment_lastname'        => $purchase_query['payment_lastname'],
				'payment_address_1'       => $purchase_query['payment_address_1'],
				//'payment_address_2'       => $purchase_query['payment_address_2'],
				'payment_city'            => $purchase_query['payment_city'],
				'payment_postcode'        => $purchase_query['payment_postcode'],
				'payment_country_id'      => $purchase_query['payment_country_id'],
				'payment_country'         => $purchase_query['payment_country'],
				'state_id'         		  => $purchase_query['state_id'],
				'payment_zone'            => $purchase_query['payment_zone'],
				'payment_method'       	  => $purchase_query['payment_method'],
				'payment_code'            => $purchase_query['payment_code'],
				'payment_status'          => $purchase_query['payment_status'],
				'attachment'              => $purchase_query['attachment'],
				'note'  				  => $purchase_query['note'],				
				'date_modified'           => $purchase_query['date_modified'],
				'date_added'              => $purchase_query['date_added'],
				'added_by'                => $purchase_query['added_by'],
				'modified_by'             => $purchase_query['modified_by']
				
			);
		} else {
			return false;
		}
	}
	
	/*
	* addPurchaseHistory
	*/
	public function addPurchaseHistory($purchase_id, $order_status_id, $comment = '', $notify = false, $override = false) {
		$event_data = array(
			'purchase_id'	  => $purchase_id,
			'order_status_id' => $order_status_id,
			'comment'		  => $comment,
			'notify'		  => $notify
		);
		
		$purchase_info = $this->getPurchaseData($purchase_id);
		
		if ($purchase_info) {
			$this->db->query("INSERT INTO purchase_history SET purchase_id = '" . (int)$purchase_id . "', order_status_id = '" . (int)$order_status_id . "', notify = '" . (int)$notify . "', comment = '" . $this->db->escape($comment) . "', date_added = '".date('Y-m-d h:i:sa')."', added_by = '".$this->session->userdata('user_id')."', date_modified = '".date('Y-m-d h:i:sa')."', modified_by = '".$this->session->userdata('user_id')."'");			
		}
	}
	
	//get list of products
	public function getProducts($data = array())
	{			
		$sql = "SELECT distinct p.*,op.* FROM `product` p left join `order_product` op on p.product_id = op.product_id where 1=1";
		//$sql = "SELECT distinct * FROM `order_product` where 1=1";
		
		$implode = array();
		
		if (!empty($data['filter_name'])) {
			$implode[] = " p.name LIKE '%" . $data['filter_name'] . "%'";
		}
		
		if(isset($data['filter_manufacturer_id']) && $data['filter_manufacturer_id']!='')
		{
			$implode[] = " p.manufacturer_id = " . $data['filter_manufacturer_id'];
		}
		
		if (isset($data['filter_order_id']) && $data['filter_order_id']!='') {
			$implode[] = " op.order_id = " . $data['filter_order_id'];
		}	
		
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		$sql .= " group by op.product_id";
		
		
		
		$query = $this->db->query($sql);
  //      	echo $this->db->last_query();
		// exit;
		return $query->result_array();
	}
	
	//get product opttions
	public function getProductOptions($product_id) {
		$product_option_data = array();

		$query_product_option = $this->db->query("SELECT * FROM `product_option` po LEFT JOIN `option` o ON (po.option_id = o.option_id) WHERE po.product_id = '" . (int)$product_id . "'");
		$product_option_query=$query_product_option->result_array();
		foreach ($product_option_query as $product_option) {
			$product_option_value_data = array();

			$query_product_option_value = $this->db->query("SELECT * FROM product_option_value WHERE product_option_id = '" . (int)$product_option['product_option_id'] . "'");
			$product_option_value_query=$query_product_option_value->result_array();
			foreach ($product_option_value_query as $product_option_value) {
				$product_option_value_data[] = array(
					'product_option_value_id' => $product_option_value['product_option_value_id'],
					'option_value_id'         => $product_option_value['option_value_id'],
					'quantity'                => $product_option_value['quantity'],
					'subtract'                => $product_option_value['subtract'],
					'price'                   => $product_option_value['price'],
					'price_prefix'            => $product_option_value['price_prefix'],
					'points'                  => $product_option_value['points'],
					'points_prefix'           => $product_option_value['points_prefix'],
					'weight'                  => $product_option_value['weight'],
					'weight_prefix'           => $product_option_value['weight_prefix']
				);
			}

			$product_option_data[] = array(
				'product_option_id'    => $product_option['product_option_id'],
				'product_option_value' => $product_option_value_data,
				'option_id'            => $product_option['option_id'],
				'name'                 => $product_option['name'],
				'type'                 => $product_option['type'],
				'value'                => $product_option['value'],
				'required'             => $product_option['required']
			);
		}

		return $product_option_data;
	}

	//get options
	public function getOption($option_id) {
		$query = $this->db->query("SELECT * FROM `option` WHERE option_id = '" . (int)$option_id . "'");

		return $query->row_array();
	}
	
	//get option value
	public function getOptionValue($option_value_id) {
		$query = $this->db->query("SELECT * FROM option_value WHERE option_value_id = '" . (int)$option_value_id . "'");

		return $query->row_array();
	}
	
	//get purchase products list
	public function getSalesProducts($purchase_id) {
		$query = $this->db->query("SELECT * FROM purchase_product WHERE purchase_id = '" . (int)$purchase_id . "'");

		return $query->result_array();
	}
	
	//get purchase product options
	public function getSalesProductOptions($purchase_id, $purchase_product_id) {
		$query = $this->db->query("SELECT * FROM purchase_option WHERE purchase_id = '" . (int)$purchase_id . "' AND purchase_product_id = '" . (int)$purchase_product_id . "'");

		return $query->result_array();
	}
	
	//get Currency data
	public function getCurrencyData()
	{
		$config_currency=$this->common->config('config_currency');
		
		$get_currency_data=$this->currency_data->getCurrencyByCode($config_currency); 
		return $get_currency_data;
	}
	
    //get manufacturer address
	public function getManufacturerAddress($manufacturer_id)
	{
		$query=$this->db->query("select m.*,m_address.* from manufacturer_address m_address left join manufacturer m on m_address.manufacturer_id=m.manufacturer_id where m.manufacturer_id={$manufacturer_id}");
		
		$get_manufacturer_address=$query->row_array();
	
		return $get_manufacturer_address;
	}
	
	//get payment methodes
	public function getPaymentMethodes()
	{
		$query=$this->db->query("select * from payment_method");
		
		return $query->result_array();
	}
	
	//get payment methodbycode
	public function getPaymentMethodByCode($payment_method_code)
	{
		$query=$this->db->query("select * from payment_method where `payment_code` = '".$payment_method_code."'");
		
		return $query->row_array();
	}
	
	/**
	* 
	* @function name 	: getTotalSales()
	* @description   	: get total no of purchase from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalSales() 
	{
		$sql = "SELECT COUNT(*) AS total FROM purchase";
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	
	/**
	* 
	* @function name 	: softDeletePurchase()
	* @description   	: only status change not actual delete Purchase from database
	* @access 		 	: public
	* @param   		 	: int $purchase_id The purchase id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeletePurchase($purchase_id)	{	
		$this->db->set('is_deleted',1);
		$this->db->where('purchase_id',(int)$purchase_id);
		return $this->db->update('purchase');
	}
	
	/**
	* 
	* @function name 	: deletePurchase()
	* @description   	: delete purchase record from database
	* @access 		 	: public
	* @param   		 	: int $purchase_id The purchase id that you want to delete
	* @return       	: void
	*
	*/
		
	public function deletePurchase($purchase_id) {
		
		// Void the order first
		$this->addPurchaseHistory($purchase_id, 0);
		$purchase_info=$this->getSale($purchase_id);
		
		/* delete file */
		$file="../uploads/purcahse_order_attachments/". $purchase_info['attachment'];
		if(file_exists($file))
		{
			if(is_file($file))
			{
				unlink($file); //delete file
			}
		}
		/* //delete file */

		$this->db->query("DELETE FROM `purchase` WHERE purchase_id = '" . (int)$purchase_id . "'");
		$this->db->query("DELETE FROM `purchase_product` WHERE purchase_id = '" . (int)$purchase_id . "'");
		$this->db->query("DELETE FROM `purchase_option` WHERE purchase_id = '" . (int)$purchase_id . "'");
		$this->db->query("DELETE FROM `purchase_history` WHERE purchase_id = '" . (int)$purchase_id . "'");
	
	}
	
	/**
	* 
	* @function name 	: viewSalesProduct()
	* @description   	: Detail view of sales from database
	* @access 		 	: public
	* @param   		 	: int $purchase_id The purchase id that you want to delete
	* @return       	: void
	*
	*/
	public function viewSalesProduct($purchase_id) 
	{			
		$get_expense=$this->db->query("select * from `purchase` where purchase_id='".(int)$purchase_id."'");
		return $get_expense->row_array();
	}
	
	
	/**
	* 
	* @function name 	: manufacturerByOrderid()
	* @description   	: Detail view of expense from database
	* @access 		 	: public
	* @param   		 	: int $purchase_id The purchase id that you want to delete
	* @return       	: void
	*
	*/
	public function manufacturerByOrderid($order_id)
	{
		$order_product_list=$this->db->query("select * from order_product where order_id='".(int)$order_id."'");
		
		$manufacturer=array();
		
		foreach($order_product_list->result_array() as $order_product)
		{
			//$manufacturer_list=$this->db->query("select * from product where product_id='".(int)$order_product['product_id']."'");
			$manufacturer_list=$this->db->query("select distinct m.* from product p left join manufacturer m on p.manufacturer_id = m.manufacturer_id left join order_product op on op.product_id=p.product_id where p.product_id='".(int)$order_product['product_id']."' group by op.product_id");
			foreach($manufacturer_list->result_array() as $manufacturer_data)
			{ 
				$manufacturer_name=$manufacturer_data['firstname'].' '.$manufacturer_data['lastname'];
				$manufacturer_id=$manufacturer_data['manufacturer_id'];
				$manufacturer[]=array(
					'manufacturer_id'=>$manufacturer_id,
					'manufacturer_name'=>$manufacturer_name
				);
			}
		}
		//$manufacturer_array=array();
		$manufacturer_array= array_map("unserialize", array_unique(array_map("serialize", $manufacturer)));
		return $manufacturer_array;
		//return array_unique($manufacturer);
	}
	 /**
	* 
	* @function name 	: getTotalAmountPurchase()
	* @description   	: get total no of purchase from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalAmountPurchase($data=array()) 
	{
            $sql = "SELECT SUM(total) AS Amount FROM `purchase` WHERE manufacturer_id=".$this->session->userdata('manufacturer_user_id')." and order_status_id > '0'";

            if (!empty($data['filter_date_added'])) {
                    $sql .= " AND DATE(date_added) = DATE('" . $data['filter_date_added'] . "')";
            }

            $query = $this->db->query($sql);
            
            return $query->row('Amount');
            
            
	} 
	 /**
	* 
	* @function name 	: getTotalDueAmount()
	* @description   	: get total no of due purchase amount from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalDueAmount($data=array()) 
	{
            $sql = "SELECT (SUM(case when payment_status = 0 then total else 0 end) - SUM(case when payment_status = 1 then total else 0 end)) As Amount FROM `purchase` WHERE manufacturer_id=".$this->session->userdata('manufacturer_user_id')." and order_status_id > '0'";

            if (!empty($data['filter_date_added'])) 
            {
                    $sql .= " AND DATE(date_added) = DATE('" . $data['filter_date_added'] . "')";
            }

            $query = $this->db->query($sql);
            
            return $query->row('Amount');
            
            
	} 
        public function getTotalPurchaseByDay() {
		$implode = array();
                
		$purchase_data = array();

		for ($i = 0; $i < 24; $i++) {
			$purchase_data[$i] = array(
				'hour'  => $i,
				'total' => 0
			);
		}
		/*$complete_status = json_decode($this->common->config('config_complete_status'),true);

		foreach ($complete_status as $order_status_id) 
		{
					$implode[] = "'" . (int)$order_status_id . "'";
		}*/

		$query = $this->db->query("SELECT COUNT(*) AS total, HOUR(date_added) AS hour FROM `purchase` WHERE manufacturer_id=".$this->session->userdata('manufacturer_user_id')." and DATE(date_added) = DATE(NOW()) GROUP BY HOUR(date_added) ORDER BY date_added ASC");

		foreach ($query->result_array() as $result) {
			$purchase_data[$result['hour']] = array(
				'hour'  => $result['hour'],
				'total' => $result['total']
			);
		}
		
		return $purchase_data;
	}

	public function getTotalPurchaseByWeek() {
		$implode = array();
                
		$purchase_data = array();

		$date_start = strtotime('-' . date('w') . ' days');

		for ($i = 0; $i < 7; $i++) {
			$date = date('Y-m-d', $date_start + ($i * 86400));

			$purchase_data[date('w', strtotime($date))] = array(
				'day'   => date('D', strtotime($date)),
				'total' => 0
			);
		}

		/*$complete_status = json_decode($this->common->config('config_complete_status'),true);

		foreach ($complete_status as $order_status_id) 
		{
					$implode[] = "'" . (int)$order_status_id . "'";
		}*/
		
		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM `purchase` WHERE manufacturer_id=".$this->session->userdata('manufacturer_user_id')." and DATE(date_added) >= DATE(" . $this->db->escape(date('Y-m-d', $date_start)) . ") GROUP BY DAYNAME(date_added)");

		foreach ($query->result_array() as $result) {
			$purchase_data[date('w', strtotime($result['date_added']))] = array(
				'day'   => date('D', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}

		return $purchase_data;
	}

	public function getTotalPurchaseByMonth() {
		$implode = array();

		$purchase_data = array();

		for ($i = 1; $i <= date('t'); $i++) {
			$date = date('Y') . '-' . date('m') . '-' . $i;

			$purchase_data[date('j', strtotime($date))] = array(
				'day'   => date('d', strtotime($date)),
				'total' => 0
			);
		}

		/*$complete_status = json_decode($this->common->config('config_complete_status'),true);

		foreach ($complete_status as $order_status_id) 
		{
					$implode[] = "'" . (int)$order_status_id . "'";
		}*/
		
		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM `purchase` WHERE manufacturer_id=".$this->session->userdata('manufacturer_user_id')." and DATE(date_added) >= " . $this->db->escape(date('Y') . '-' . date('m') . '-1') . " GROUP BY DATE(date_added)");

		foreach ($query->result_array() as $result) {
			$purchase_data[date('j', strtotime($result['date_added']))] = array(
				'day'   => date('d', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}

		return $purchase_data;
	}

	public function getTotalPurchaseByYear() {
		$implode = array();

		$purchase_data = array();

		for ($i = 1; $i <= 12; $i++) {
			$purchase_data[$i] = array(
				'month' => date('M', mktime(0, 0, 0, $i)),
				'total' => 0
			);
		}

		/*$complete_status = json_decode($this->common->config('config_complete_status'),true);

		foreach ($complete_status as $order_status_id) 
		{
					$implode[] = "'" . (int)$order_status_id . "'";
		}*/
		
		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM `purchase` WHERE manufacturer_id=".$this->session->userdata('manufacturer_user_id')." and YEAR(date_added) = YEAR(NOW()) GROUP BY MONTH(date_added)");

		foreach ($query->result_array() as $result) {
			$purchase_data[date('n', strtotime($result['date_added']))] = array(
				'month' => date('M', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}

		return $purchase_data;
	}
	
	/**
	* 
	* @function name 	: getSalesTotals()
	* @description   	: Detail view of manufacturer and manufacturer_address from database
	* @access 			: public
	* @param   			: int $manufacturer_id The manufacturer id that you want to delete
	* @return       	: void
	*
	*/
	public function getSalesTotals($purchase_id) {
		$query = $this->db->query("SELECT sum(total) as total FROM `purchase_product` where purchase_id= '" . (int)$purchase_id . "'");

		return $query->row_array();
	}
	
	/**
	* 
	* @function name 	: manufacturerData()
	* @description   	: Detail view of manufacturer and manufacturer_address from database
	* @access 			: public
	* @param   			: int $manufacturer_id The manufacturer id that you want to delete
	* @return       	: void
	*
	*/
	public function manufacturerData($manufacturer_id)
	{
		//check the parent id is used by child record		
		$query=$this->db->query("select m.firstname,m.lastname,m.email,m.telephone,m.mobile,m.company_name,m.company_address,m_address.address_1,m_address.city,m_address.postcode,m_address.country_id,m_address.state_id from manufacturer m join manufacturer_address m_address on m.manufacturer_id = m_address.manufacturer_id where m.manufacturer_id = '".(int)$manufacturer_id."' and m.status=1");
				
		return	$query->row_array();
	}
	
	
	
}