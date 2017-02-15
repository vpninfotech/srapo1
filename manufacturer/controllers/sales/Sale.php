<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : sale
* @Auther       : Indrajit,Mitesh
* @Date         : 04-01-2017,7-01-2017
* @Description  : Manufacturer Sale Operation
*
*/

class Sale extends CI_Controller {

	private $data=array();
	private $error = array();
	
	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();	
		
		$this->load->model('sales/sales_model','sales');
		
		//get list of products
		$this->load->model('catalog/product_model', 'product');
		
		//get list of manufacturer
		$this->load->model('catalog/manufacturer_model','manufacturers');		
		
		//get purchase cart data
		$this->load->model('sales/orders_model','orders');

		//get order id
		$this->load->model('purchase/purchase_cart_model','purchase_cart');
		
		// Load settings_model
        $this->load->model('system/settings_model','settings');
		
		//get currency data
		$this->load->model('system/currency_model', 'currency_data');
		
		//get country data
		$this->load->model('system/country_model','country');
		
		//get zone(state) data
		$this->load->model('system/zone_model','zone');
		
		//get tax list
		$this->load->model('system/Tax_rates_model','tax_rates');
		
		$this->load->model('common');
		
		$this->lang->load('sales/sales_lang', 'english');
		
		$this->lang->load('api/api_option_lang', 'english');
		
		$this->load->library('commons');
		
		$this->load->library('currency');	
		
		$this->load->library('purchasecart');
		
		$this->load->library('manufacturer');

		$this->load->library('pagination');
	}
	
	/**
	* 
	* @function name : _init()
	* @description   : initialize required resources in this view
	* @param   		 : void
	* @return        : void
	*
	*/
	
	private function _init() {
		
		//--Set Template
		$this->output->set_template('manufacturer_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Sale','sarpo','This is srapo Sale page');

	}
		
	
	/**
	* 
	* @function name : index()
	* @description   : load purchase view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'purchase_id', $sort_order = 'ASC', $offset = 0)	
	{
		// breadcrumbs
		$this->data['add'] 			 = base_url('sales/sale/add');
		if($this->session->userdata('role_id')== 1)
		{
			$this->data['delete'] 		= base_url('sales/sale/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('sales/sale/softDelete');
		}
		//$this->data['refresh'] 			= base_url('catalog/attributes/refresh');
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Sales',
		   'href' => base_url('sales/sale'),
		 
		  );
		  
		

		//pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("sales/sale/index/$sort_by/$sort_order");
		$total_records = $this->sales->getTotalSales();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->sales->getSales($data);
		$this->data['pages'] = ceil($total_records/$limit);
		$this->data['totals'] = ceil($total_records);
		$this->data['range'] = ceil($offset+1);
		/*echo "<pre>";
		print_r($_SESSION);
		echo "</pre>";
		exit;*/
		// URL creation
		$url='';
		if ($this->uri->segment(4)!==NULL) {
			$url .= '/'.$this->uri->segment(4);
		}
		else
		{
			$url .= '/purchase_id';
		}
		
		if ($this->uri->segment(5)!==NULL) {
			$url .= '/'.$this->uri->segment(5);
		}
		else
		{
			$url .= '/ASC';
		}
		if ($this->uri->segment(6)!==NULL) {
			$url .= '/'.$this->uri->segment(6);
		}
		else
		{
			$url .= '/0';
		}
		
		foreach ($results as $result) {
			//get currency symbol			
			$get_currency_data=$this->currency_data->getCurrencyByCode($result['currency_code']); 
			$currency_symbol=$get_currency_data['symbol_left'];
			
			//get manufacturer name 
			$get_manufacturer_data=$this->manufacturers->getManufacturerById($result['manufacturer_id']);
			$manufacturer_name=$get_manufacturer_data['firstname'].' '.$get_manufacturer_data['lastname'];
			
			$this->data['records'][] = array(
				'purchase_id'   	=> $result['purchase_id'],				
				'order_id'   		=> $result['order_id'],
				'manufacturer_id' 	=> $result['manufacturer_id'],
				'manufacturer_name' => $manufacturer_name,
				'total'       		=> $currency_symbol.$result['total'],			
				'payment_status'    => $result['payment_status'],
				'note'    			=> $result['note'],
                'is_deleted'    	=> $result['is_deleted'],
				'date_modified'    	=> date($this->common->config('config_date_format'), strtotime($result['date_modified'])),
				'view'           => base_url('sales/sale/view'.$url.'/'.$this->commons->encode($result['purchase_id'])),	
				'edit'             	=>base_url('sales/sale/edit'.$url.'/'.$this->commons->encode($result['purchase_id']))
			);
		}		
		
		
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if ($this->session->userdata('success')!==NULL) {
			$this->data['success'] = $this->session->userdata('success');

			$this->session->set_userdata('success','');
		} else {
			$this->data['success'] = '';
		}
		
		if ($this->input->post('selected') !==NULL) {
			$this->data['selected'] = (array)$this->input->post('selected');
		} else {
			$this->data['selected'] = array();
		}
				
		
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/sales/sales_list";
		$this->load->view($content_page,$this->data);
	}
	
	/**
	* 
	* @function name : add()
	* @description   : load purchase Add view
	* @param   		 : void
	* @return        : void
	*
	*/	
	public function add()	{
		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				
				// Products
				$order_data['products'] = array();

				foreach ($this->purchasecart->getProducts() as $product) {
					$option_data = array();

					foreach ($product['option'] as $option) {
						$option_data[] = array(
							'product_option_id'       => $option['product_option_id'],
							'product_option_value_id' => $option['product_option_value_id'],
							'option_id'               => $option['option_id'],
							'option_value_id'         => $option['option_value_id'],
							'name'                    => $option['name'],
							'value'                   => $option['value'],
							'type'                    => $option['type']
						);
					}

					$order_data['products'][] = array(
						'product_id' => $product['product_id'],
						'name'       => $product['name'],
						'model'      => $product['model'],
						'option'     => $option_data,					
						'quantity'   => $product['quantity'],						
						'price'      => $product['price'],
						'total'      => $product['total'],
						//'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id'])
					);
				}
				
				$this->purchase->addPurchase($order_data);
				
				//clear cart
				$this->purchasecart->clear();	
				
				$this->session->set_userdata('success',$this->lang->line('text_success_purchase'));
				/*echo $this->session->userdata('success');									
				exit;*/
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/date_added';
				}
				
				if ($this->uri->segment(5)!==NULL) {
					$url .= '/'.$this->uri->segment(5);
				}
				else
				{
					$url .= '/ASC';
				}
				if ($this->uri->segment(6)!==NULL) {
					$url .= '/'.$this->uri->segment(6);
				}
				else
				{
					$url .= '/0';
				}
				if ($this->uri->segment(7)!==NULL) {
					$url .= '/'.$this->uri->segment(7);
				}
				redirect('purchase/purchase/index'.$url);
	     }
		 $this->getForm();
	}
	
	/**
	* 
	* @function name : edit()
	* @description   : edit attribute group records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'purchase_id', $sort_order = 'ASC', $offset = 0)
	{			
		//$this->purchasecart->remove();
				
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				 
				// Products
				$purchase_data['products'] = array();

				foreach ($this->purchasecart->getProducts() as $product) {
					$option_data = array();

					foreach ($product['option'] as $option) {
						$option_data[] = array(
							'product_option_id'       => $option['product_option_id'],
							'product_option_value_id' => $option['product_option_value_id'],
							'option_id'               => $option['option_id'],
							'option_value_id'         => $option['option_value_id'],
							'name'                    => $option['name'],
							'value'                   => $option['value'],
							'type'                    => $option['type']
						);
					}

					$purchase_data['products'][] = array(
						'product_id' => $product['product_id'],
						'name'       => $product['name'],
						'model'      => $product['model'],
						'option'     => $option_data,					
						'quantity'   => $product['quantity'],						
						'price'      => $product['price'],
						'total'      => $product['total'],
						//'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id'])
					);
				}
				
				/*echo "<pre>";
				print_r($purchase_data);
				echo "</pre>";
				exit;*/
				$this->purchase->editPurchase($purchase_data);
				//clear cart
				$this->purchasecart->clear();
				
				$this->session->set_userdata('success',$this->lang->line('text_success_purchase'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/purchase_id';
				}
				
				if ($this->uri->segment(5)!==NULL) {
					$url .= '/'.$this->uri->segment(5);
				}
				else
				{
					$url .= '/ASC';
				}
				if ($this->uri->segment(6)!==NULL) {
					$url .= '/'.$this->uri->segment(6);
				}
				else
				{
					$url .= '/0';
				}     				
				
				redirect('purchase/purchase/index'.$url);
	     }
	   
		$this->getForm();
	}
	
	/**
	* 
	* @function name : view()
	* @description   : load expense detail view
	* @param   		 : void
	* @return        : void
	*
	*/	
	public function view()	{
		
		$this->viewForm();
	}
	
	/**
	* 
	* @function name : viewForm()
	* @description   : Generate Form for Add and Edit Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function viewForm()
	{
		// Generate back url
		$url = '';

		if ($this->uri->segment(4)!==NULL) {
			$url .= '/'.$this->uri->segment(4);
		}
		else
		{
			$url .= '/purchase_id';
		}
		
		if ($this->uri->segment(5)!==NULL) {
			$url .= '/'.$this->uri->segment(5);
		}
		else
		{
			$url .= '/ASC';
		}
		if ($this->uri->segment(6)!==NULL) {
			$url .= '/'.$this->uri->segment(6);
		}
		else
		{
			$url .= '/0';
		}
		
		// breadcrumbs
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		 );
		 $this->data['breadcrumbs'][] = array(
		   'text' => 'Sales',
		   'href' => base_url('sales/sale'),
		 
		 );
		 
		$this->data['cancel'] 		= base_url('sales/sale/index'.$url);
		
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		
		$method = $this->uri->segment(3);
		$this->data['text_no_results']		= $this->lang->line('text_no_results');	
		$this->data['text_form']  = $this->lang->line('text_view');
		$this->data['text_purchase_detail']  = $this->lang->line('text_purchase_detail');
		$this->data['text_date_added'] = $this->lang->line('text_date_added');
		$this->data['text_manufacturer'] = $this->lang->line('text_manufacturer');
		$this->data['text_email'] = $this->lang->line('text_email');
 		$this->data['text_telephone'] = $this->lang->line('text_telephone');
		$this->data['text_invoice'] = $this->lang->line('text_invoice');
		
		$this->data['column_product'] = $this->lang->line('column_product');
        $this->data['column_model'] = $this->lang->line('column_model');
        $this->data['column_quantity'] = $this->lang->line('column_quantity');
        $this->data['column_price'] = $this->lang->line('column_price');
        $this->data['column_total'] = $this->lang->line('column_total');
		
		$this->data['form_action'] = base_url('sales/sale/view');		
		$this->data['purchase_id'] = $this->commons->decode($this->uri->segment($count));
		$this->data['purchase_data'] = $this->sales->viewSalesProduct($this->data['purchase_id']);		
		
		$purchase_data = $this->sales->viewSalesProduct($this->data['purchase_id']);
		$purchase_id=$purchase_data['purchase_id'];
		$order_id=$purchase_data['order_id'];
		$invoice_no=$purchase_data['invoice_no'];
		$invoice_prefix=$purchase_data['invoice_prefix'];
		$manufacturer_id=$purchase_data['manufacturer_id'];
		$total=$purchase_data['total'];
		$note=$purchase_data['note'];
		$invoice_prefix=$purchase_data['invoice_prefix'];
		
		$this->data['invoice'] = base_url('sales/sale/invoice/').$this->commons->encode($purchase_id);				
		
		//currency format
		$currency_code=$purchase_data['currency_code'];
		$get_currency_data=$this->currency_data->getCurrencyByCode($currency_code);
		$currency_symbol=$get_currency_data['symbol_left'];
		$currency_decimal_place=$get_currency_data['decimal_place'];
		$currency_value=$get_currency_data['value'];		
		$purchase_product_amount=$currency_symbol.' '.number_format((float)$total,$currency_decimal_place, '.', ''); 
						
		//convert date
		$date = new DateTime($purchase_data['date_added']);
		$purchase_date=$date->format("D d M Y"); 
                            
		if(isset($purchase_date) || $purchase_date != NULL)
		{
			$this->data['purchase_date']=$purchase_date;
		}
		else
		{
			$this->data['purchase_date']='';
		}	
		
		$purchase_date2=date($this->common->config('config_date_format'), strtotime($purchase_data['date_added']));
		
		if(isset($purchase_date2) || $purchase_date2 != NULL)
		{
			$this->data['purchase_date2']=$purchase_date2;
		}
		else
		{
			$this->data['purchase_date2']='';
		}
		
		//get Manufacturer data
		$manufacturer_data=$this->manufacturers->getManufacturerById($manufacturer_id);
		$manufacturer_name=$manufacturer_data['firstname'].' '.$manufacturer_data['lastname'];
		$firstname=$manufacturer_data['firstname'];
		$lastname=$manufacturer_data['lastname'];
		$manufacturer_email=$manufacturer_data['email'];
		$manufacturer_telephone=$manufacturer_data['telephone'];
		$manufacturer_mobile=$manufacturer_data['mobile'];
				
		//products and total
		$store_name = $this->common->config('config_store_name');
		$store_address = $this->common->config('config_address');
		$store_email = $this->common->config('config_email');
		$store_telephone = $this->common->config('config_telephone');
		$store_fax = $this->common->config('config_fax');
		
		$product_data = array();
				
                $products = $this->sales->getSalesProducts($purchase_id);

                foreach ($products as $product) {
                    $option_data = array();

                    $options = $this->sales->getSalesProductOptions($purchase_id, $product['purchase_product_id']);

                    foreach ($options as $option) {
                        if ($option['type'] != 'file') {
                            $value = $option['value'];
                        } 
                        else 
                        {
                            
                                $value = '';
                            
                        }

                        $option_data[] = array(
                            'name'  => $option['name'],
                            'value' => $value
                        );
                    }

                    $product_data[] = array(
                        'name'     => $product['name'],
                        'model'    => $product['model'],
                        'option'   => $option_data,
                        'quantity' => $product['quantity'],
                        //'price'    => $currency_symbol.$product['price'],
                        //'total'    => $currency_symbol.$product['total']
						'price'    =>$currency_symbol.' '.number_format((float)$product['price'],$currency_decimal_place, '.', ''),
						'total'    => $currency_symbol.' '.number_format((float)$product['total'],$currency_decimal_place, '.', '')
                    );
                }

               $total_data = array();

                $totals = $this->sales-> getSalesTotals($purchase_id);
				
				
				$total_data[] = array(
					'title' => 'Total',
					//'text'  => $currency_symbol.$totals['total'],
					'text'  => $currency_symbol.' '.number_format((float)$total,$currency_decimal_place, '.', '')
				);
				
                $this->data['purchases'][] = array(
					'purchase_id'        => $purchase_id,
                    'order_id'           => $order_id,
                    'invoice_no'         => $invoice_no,
                    'date_added'         => date($this->lang->line('date_format_short'), strtotime($purchase_data['date_added'])),
                    'store_name'         => $store_name,
                    'store_address'      => nl2br($store_address),
                    'store_email'        => $store_email,
                    'store_telephone'    => $store_telephone,
                    'store_fax'          => $store_fax,
                    'email'              => $manufacturer_data['email'],
                    'telephone'          => $manufacturer_data['telephone'],                    
                    'product'            => $product_data,                    
                    'total'              => $total_data,
                    'comment'            => nl2br($purchase_data['note'])
                );
				
		////////////
		
		//get Total
		$this->data['total']=$purchase_data['total'];
		
		//currency Symbol
		$this->data['currency_symbol']=$currency_symbol;
		
		if(isset($purchase_id) || $purchase_id != NULL)
		{
			$this->data['purchase_id']=$purchase_id;
		}
		else
		{
			$this->data['purchase_id']='';
		}
		
		if(isset($invoice_prefix) || $invoice_prefix != NULL)
		{
			$this->data['invoice_prefix']=$invoice_prefix;
		}
		else
		{
			$this->data['invoice_prefix']='';
		}
		
		if(isset($invoice_no) || $invoice_no != NULL)
		{
			$this->data['invoice_no']=$invoice_no;
		}
		else
		{
			$this->data['invoice_no']='';
		}
		
		if(isset($manufacturer_id) || $manufacturer_id != NULL)
		{
			$this->data['manufacturer_id']=$manufacturer_id;
		}
		else
		{
			$this->data['manufacturer_id']='';
		}
		
		if(isset($note) || $note != NULL)
		{
			$this->data['note']=$note;
		}
		else
		{
			$this->data['note']='';
		}
		
		if(isset($currency_symbol) || $currency_symbol != NULL)
		{
			$this->data['currency_symbol']=$currency_symbol;
		}
		else
		{
			$this->data['currency_symbol']='';
		}
		
		
		if(isset($purchase_product_amount) || $purchase_product_amount != NULL)
		{
			$this->data['purchase_product_amount']=$purchase_product_amount;
		}
		else
		{
			$this->data['purchase_product_amount']='';
		}
		
		if(isset($firstname) || $firstname != NULL)
		{
			$this->data['firstname']=$firstname;
		}
		else
		{
			$this->data['firstname']='';
		}
		
		if(isset($lastname) || $lastname != NULL)
		{
			$this->data['lastname']=$lastname;
		}
		else
		{
			$this->data['lastname']='';
		}
		
		
		if(isset($manufacturer_name) || $manufacturer_name != NULL)
		{
			$this->data['manufacturer_name']=$manufacturer_name;
		}
		else
		{
			$this->data['manufacturer_name']='';
		}
		
		if(isset($manufacturer_email) || $manufacturer_email != NULL)
		{
			$this->data['manufacturer_email']=$manufacturer_email;
		}
		else
		{
			$this->data['manufacturer_email']='';
		}
		
		if(isset($manufacturer_mobile) || $manufacturer_mobile != NULL)
		{
			$this->data['manufacturer_mobile']=$manufacturer_mobile;
		}
		else
		{
			$this->data['manufacturer_mobile']='';
		}
		
		if(isset($manufacturer_telephone) || $manufacturer_telephone != NULL)
		{
			$this->data['manufacturer_telephone']=$manufacturer_telephone;
		}
		else
		{
			$this->data['manufacturer_telephone']='';
		}
		
		if((isset($manufacturer_mobile) || $manufacturer_mobile != NULL) && (isset($manufacturer_telephone) || $manufacturer_telephone != NULL))
		{
			$this->data['manufacturer_contact']=$manufacturer_telephone.', '.$manufacturer_mobile;
		}
		else
		{
			if(isset($manufacturer_mobile) || $manufacturer_mobile != NULL)
			{
				$this->data['manufacturer_contact']=$manufacturer_mobile;
			}
			if(isset($manufacturer_telephone) || $manufacturer_telephone != NULL)
			{
				$this->data['manufacturer_contact']=$manufacturer_telephone;
			}
		}		
		
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/sales/sales_detail_list";
		$this->load->view($content_page,$this->data);
	}
	
	/**
	* 
	* @function name : getForm()
	* @description   : Generate Form for Add and Edit Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function getForm()
	{
		
		// Transaction Status
		if (isset($this->error['warning']) || $this->session->userdata('error')!==NULL) {
			if ($this->session->userdata('error')!==NULL)
			{
				$this->error['warning'] = $this->session->userdata('error');
			} 
			$this->data['error'] = $this->error['warning'];
			$this->session->set_userdata('error','');
		} else {
			$this->data['error'] = '';
		}
		
		if ($this->session->userdata('success')!==NULL) {
			$this->data['success'] = $this->session->userdata('success');

			$this->session->set_userdata('success','');
		} else {
			$this->data['success'] = '';
		}
		
		// Generate back url
		$url = '';

		if ($this->uri->segment(4)!==NULL) {
			$url .= '/'.$this->uri->segment(4);
		}
		else
		{
			$url .= '/purchase_id';
		}
		
		if ($this->uri->segment(5)!==NULL) {
			$url .= '/'.$this->uri->segment(5);
		}
		else
		{
			$url .= '/ASC';
		}
		if ($this->uri->segment(6)!==NULL) {
			$url .= '/'.$this->uri->segment(6);
		}
		else
		{
			$url .= '/0';
		}
			
		
		// breadcrumbs
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		 $this->data['breadcrumbs'][] = array(
		   'text' => 'Purchase',
		   'href' => base_url('purchase/purchase'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{			
			$this->data['button_refresh']		= $this->lang->line('button_refresh');
			$this->data['text_loading']			= $this->lang->line('text_loading');
			$this->data['button_remove']		= $this->lang->line('button_remove');
			$this->data['text_no_results']		= $this->lang->line('text_no_results');						
			$this->data['button_upload'] 		= $this->lang->line('button_upload');
			$this->data['text_loading'] 		= $this->lang->line('text_loading');
			$this->data['text_select'] 			= $this->lang->line('text_select');
			$this->data['entry_option'] 		= $this->lang->line('entry_option');									
			$this->data['text_form'] 			= $this->lang->line('text_add_purchase');
			$this->data['form_action'] 			= base_url('purchase/purchase/add'.$url);
			$this->data['purchase_product_id']  = '';
			$this->data['edit_keyword']='';
			//clear cart
			$this->purchasecart->clear();
				
			$this->data['cancel'] 		= base_url('purchase/purchase/index'.$url);
			
		} 
		else 
		{		
			//get Product data	
			//$this->data['purchase_cart_data'] = $this->purchase_cart->get_purchase_product();
			$this->data['button_refresh']		= $this->lang->line('button_refresh');
			$this->data['text_loading']			= $this->lang->line('text_loading');
			$this->data['button_remove']		= $this->lang->line('button_remove');
			$this->data['text_no_results']		= $this->lang->line('text_no_results');						
			$this->data['button_upload'] 		= $this->lang->line('button_upload');
			$this->data['text_loading'] 		= $this->lang->line('text_loading');
			$this->data['text_select'] 			= $this->lang->line('text_select');
			$this->data['entry_option'] 		= $this->lang->line('entry_option');	
			$this->data['text_form'] 		 	= $this->lang->line('text_edit_purchase');
			$this->data['form_action'] 		    = base_url('purchase/purchase/edit'.$url.'/'.$this->uri->segment($count));
			$this->data['edit_keyword']='1';
			$this->data['purchase_id']       = $this->commons->decode($this->uri->segment($count));
		}
		//$this->data['refresh'] 		= base_url('catalog/attributes/refresh');
		$this->data['cancel'] 		= base_url('purchase/purchase/index'.$url);
		
		// Set Value Back
		if (1) 
		{
			$purchase_info = $this->purchase->getPurchase($this->commons->decode($this->uri->segment($count)));
		}		
		
		if ($this->input->post('purchase_id')!==NULL) {
			$this->data['purchase_id'] = $this->input->post('purchase_id');
		} elseif (!empty($purchase_info)) {
			
			$this->data['purchase_id'] = $purchase_info['purchase_id'];
		} else {
			$this->data['purchase_id'] = '';
		}
		
		if ($this->input->post('select_order')!==NULL) {
			$this->data['order_id'] = $this->input->post('select_order');
		} elseif (!empty($purchase_info)) {
			
			$this->data['order_id'] = $purchase_info['order_id'];
		} else {
			$this->data['order_id'] = '';
		}	
		
		if ($this->input->post('select_manufacturers')!==NULL) {
			$this->data['manufacturer_id'] = $this->input->post('select_manufacturers');
		} elseif (!empty($purchase_info)) {
			
			$this->data['manufacturer_id'] = $purchase_info['manufacturer_id'];
		} else {
			$this->data['manufacturer_id'] = '';
		}
			
		if ($this->input->post('received')!==NULL) {
			$this->data['received'] = $this->input->post('received');
		} elseif (!empty($purchase_info)) {
			$this->data['received'] = $purchase_info['order_status_id'];
		} else {
			$this->data['received'] = '';
		}
		
		if ($this->input->post('payment_method')!==NULL) {
			$this->data['payment_method'] = $this->input->post('payment_method');
		} elseif (!empty($purchase_info)) {
			$this->data['payment_method'] = $purchase_info['payment_method'];
		} else {
			$this->data['payment_method'] = '';
		}
		
		if ($this->input->post('payment_status')!==NULL) {
			$this->data['payment_status'] = $this->input->post('payment_status');
		} elseif (!empty($purchase_info)) {
			$this->data['payment_status'] = $purchase_info['payment_status'];
		} else {
			$this->data['payment_status'] = '';
		}
		
		if ($this->input->post('payment_method')!==NULL) {
			$this->data['payment_code'] = $this->input->post('payment_method');
		} elseif (!empty($purchase_info)) {
			$this->data['payment_code'] = $purchase_info['payment_code'];
		} else {
			$this->data['payment_code'] = '';
		}
		
		if ($this->input->post('description')!==NULL) {
			$this->data['note'] = $this->input->post('description');
		} elseif (!empty($purchase_info)) {
			$this->data['note'] = $purchase_info['note'];
		} else {
			$this->data['note'] = '';
		}
		
		if ($this->input->post('attachment')!==NULL) {
			$this->data['attachment'] = $this->input->post('attachment');
		} elseif (!empty($purchase_info)) {
			$this->data['attachment'] = $purchase_info['attachment'];
		} else {
			$this->data['attachment'] = '';
		}
		
		
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			if($this->input->post('is_deleted')==1)
			{
			   $this->data['is_deleted'] = $this->input->post('is_deleted'); 
			}else {
				 $this->data['is_deleted'] = 0;
			}
		} elseif (!empty($purchase_info)) {
			$this->data['is_deleted'] = $purchase_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
		
		// Products
		$this->data['purchase_order_products'] = array();
		//$manufacturer_id=$this->session->userdata('manufacturer_id');
		$manufacturer_id=(int)$this->manufacturer->getId();
		
		//get products
		// Products
		$this->data['purchase_products'] = array();

		$products = $this->purchase->getPurchaseProducts($this->commons->decode($this->uri->segment($count)));
		
		foreach ($products as $product) {
			$this->data['purchase_products'][] = array(
				'product_id' => $product['product_id'],
				'name'       => $product['name'],
				'model'      => $product['model'],
				'option'     => $this->purchase->getPurchaseProductOptions($this->commons->decode($this->uri->segment($count)), $product['purchase_product_id']),
				'quantity'   => $product['quantity'],
				'price'      => $product['price'],
				'total'      => $product['total'],
				'manufacturer_id' => $manufacturer_id
				//'tax'     => $product['tax']
			);
		}
		//get manufacturer List
		$this->data['manufacturers']=$this->manufacturers->getManufacturer();
		
		//get payment method records
		$this->data['payment_methods']=$this->purchase->getPaymentMethodes();
		
		//get tax list
		$this->data['taxes']=$this->tax_rates->getTaxRates();
		
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/purchase/purchase_product";
		$this->load->view($content_page,$this->data);
	}
	
	/**
	* 
	* @function name : getOrderIdList()
	* @description   : Generate Order id Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function getOrderIdList()
	{
		$this->output->unset_template();
		
		$order_id=$this->input->post('keyword');
		$orders_data=array();
		$data=array();
		$data=array(
				'filter_order_id' => $order_id
			);
		$orders_data=$this->orders->getOrders($data);
		echo json_encode($orders_data);
	}
	
	
	/**
	* 
	* @function name : getOrderProductListByOrderId()
	* @description   : get Order Product List By OrderId
	* @param   		 : void
	* @return        : void
	*
	*/
	public function getOrderProductListByOrderId()
	{
		$this->output->unset_template();
		
		$order_id=$this->input->post('order_id');
		if($order_id == "")
		{
			$order_id = 1;
		}
		$orders_data=array();
		$data=array();
		$data=array(
				'filter_order_id' => $order_id
			);
		$orders_data=$this->orders->getOrderProduct($data);
		
		echo json_encode($orders_data);
	}
	
	/**
	* 
	* @function name : getProductListByManufacturerId()
	* @description   : get Order Product List By OrderId
	* @param   		 : void
	* @return        : void
	*
	*/
	public function getProductListByManufacturerId()
	{
		$this->output->unset_template();
		
		$manufacturer_id=$this->input->post('manufacturer_id');
		$orders_data=array();
		$data=array();
		$data=array(
				'filter_order_id' => $manufacturer_id
			);
		$orders_data=$this->orders->getOrderProduct($data);
				
		echo json_encode($orders_data);
	}
	
	/**
	* 
	* @function name : getProductListAutocomplete()
	* @description   : get Product List Autocomplete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function getProductListAutocomplete()
	{
		$this->output->unset_template();
        $json = array();
				
        if ($this->input->post('product') !== NULL) {
            $filter_name = $this->input->post('product');
        } else {
            $filter_name = '';
        }

		if ($this->input->post('manufacturer_id') !== NULL) {
            $filter_manufacturer_id = $this->input->post('manufacturer_id');
			
			if($this->session->userdata('manufacturer_id'))
			{
				$this->session->unset_userdata('manufacturer_id');
			}
			$this->session->set_userdata('manufacturer_id',$this->input->post('manufacturer_id'));
			
        } else {
            $filter_manufacturer_id = '';
        }
		
        if ($this->input->post('order_id') !== NULL) {
            $filter_order_id = $this->input->post('order_id');
        } else {
            $filter_order_id = '';
        }

        $filter_data = array(
            'filter_name' => $filter_name,
            'filter_order_id' => $filter_order_id,
			'filter_manufacturer_id' => $filter_manufacturer_id,
            'start' => 0,
            'limit' => 5
        );

		$config_currency_code=$this->common->config('config_currency');
		
        $results = $this->purchase->getProducts($filter_data);
		foreach ($results as $result) {
				$option_data = array();

				$product_options = $this->purchase->getProductOptions($result['product_id']);

				foreach ($product_options as $product_option) {
					$option_info = $this->purchase->getOption($product_option['option_id']);

					if ($option_info) {
						$product_option_value_data = array();

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$option_value_info = $this->purchase->getOptionValue($product_option_value['option_value_id']);

							if ($option_value_info) {
								$product_option_value_data[] = array(
									'product_option_value_id' => $product_option_value['product_option_value_id'],
									'option_value_id'         => $product_option_value['option_value_id'],
									'name'                    => $option_value_info['name'],
									'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $config_currency_code) : false,
									'price_prefix'            => $product_option_value['price_prefix']
								);
							}
						}

						$option_data[] = array(
							'product_option_id'    => $product_option['product_option_id'],
							'product_option_value' => $product_option_value_data,
							'option_id'            => $product_option['option_id'],
							'name'                 => $option_info['name'],
							'type'                 => $option_info['type'],
							'value'                => $product_option['value'],
							'required'             => $product_option['required']
						);
					}
				}

				$json[] = array(
					'product_id' => $result['product_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),				
					//'product_name' => $result['product_name'],
					'product_model'      => $result['model'],
					'option'     => $option_data,
					'price'      => $result['price']
				);
			}				
		

        $sort_order = array();

        foreach ($json as $key => $value) {
            //$sort_order[$key] = $value['product_name'];
			$sort_order[$key] = $value['name'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

        echo json_encode($json);
	}
	
	/**
	* 
	* @function name : delete()
	* @description   : perminant delete records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function delete()
	{
		if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
		{
			
			foreach ($this->input->post('selected') as $purchase_id) 
			{				
				$this->purchase->deletePurchase($purchase_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success_purchase'));
			$this->index();
		}
		else
		{
			$this->index();
		}
		
	}
	
	/**
	* 
	* @function name : softDelete()
	* @description   : soft Delete Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function softDelete()
	{		
		if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
		{
			foreach ($this->input->post('selected') as $purchase_id) 
			{
				$this->purchase->softDeletePurchase($purchase_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success_purchase'));
		}
        $this->index();
	}
	
	/**
	* 
	* @function name : validateDelete()
	* @description   : Check attribute group relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{	
           /* foreach ($this->input->post('selected') as $purchase_id) 
            {
                    $product_total = $this->product_model->getTotalProductsByAttributeId($attribute_id);

                    if ($product_total) 
                    {				
                        $this->error['warning'] = $this->lang->line('error_product').'('.$product_total.')!';
                    }
            } */
            return !$this->error;
	}
	
	/**
	* 
	* @function name : validateForm()
	* @description   : Validate Entered Form data
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateForm()
	{		
		$validation = array(						   
					array(
						'field' => 'select_order',
						'label' => 'Order id', 
						'rules' => 'trim|required|xss_clean', 
						'errors' => array('required' => '%s must be fill!')
					),
					array(
						'field' => 'select_manufacturers',
						'label' => 'Manufacturer Name', 
						'rules' => 'trim|required|xss_clean', 
						'errors' => array('required' => '%s must be fill!')
					)				
			);
			$this->form_validation->set_rules($validation);
			if ($this->form_validation->run() == FALSE) {
				
				return FALSE;
			}else{
							
				return TRUE;
			}
	}
	
	/**
	* 
	* @function name : getPurchaseDataById()
	* @description   : get purchase data from purchase table by id
	* @param   		 : void
	* @return        : purchase record in json format
	*
	*/
	public function getPurchaseDataById()
	{
		$this->output->unset_template();
		$purchase_id=(int)$this->input->post('purchase_id');
		
		$purchase_info = $this->purchase->getPurchase($purchase_id);
		$purchase=array();
		if(sizeof($purchase_info) > 0)
		{
			for($i=0;$i<sizeof($purchase_info);$i++)
			{
				$purchase=array(
					'purchase_id' => $purchase_info['purchase_id'],
					'manufacturer_id' => $purchase_info['manufacturer_id'],
					'payment_firstname' => $purchase_info['payment_firstname'],
					'payment_lastname' => $purchase_info['payment_lastname'],
					'date_added' => date($this->common->config('config_date_format'), strtotime($purchase_info['date_added']))					
				);
			}
		}
		
		echo json_encode($purchase);
	}
	
	//get purchase product list
	public function purchasedProductsAutocomplete()
	{
		$purchase_data = $this->purchase->viewPurchaseProduct($purchase_id);
	}
	
	
	/**
	* 
	* @function name : getManufacturerList()
	* @description   : get Manufacturer data by order id
	* @param   		 : void
	* @return        : purchase record in json format
	*
	*/
	public function getManufacturerList()
	{
		$this->output->unset_template();
		$order_id=$this->input->post('order_id');
		
		$manufacturer_info=$this->purchase->manufacturerByOrderid($order_id);
		
		echo json_encode($manufacturer_info);
	}
	
	/*
	* 
	* @function name : invoice()
	* @description   : invoice generate by $purchase id
	* @param   		 : purchase_id
	* @return        : invoice data
	*
	*/
	public function invoice($purchase_id = "") {
        $this->output->unset_template();
		
		$purchase_id=$this->commons->decode($purchase_id);
				 
        $data['title'] = $this->lang->line('text_invoice');
		$data['text_purchase_detail'] = $this->lang->line('text_purchase_detail');
        $data['text_invoice'] = $this->lang->line('text_invoice');
        $data['text_order_detail'] = $this->lang->line('text_order_detail');
        $data['text_order_id'] = $this->lang->line('text_order_id');
        $data['text_invoice_no'] = $this->lang->line('text_invoice_no');
        $data['text_invoice_date'] = $this->lang->line('text_invoice_date');
        $data['text_date_added'] = $this->lang->line('text_date_added');
        $data['text_telephone'] = $this->lang->line('text_telephone');
        $data['text_email'] = $this->lang->line('text_email');
		$data['text_fax'] = $this->lang->line('text_fax');
        $data['text_website'] = $this->lang->line('text_website');      
        $data['text_comment'] = $this->lang->line('text_comment');
		$data['text_order_id'] = $this->lang->line('text_order_id');
		$lang['text_invoice_no'] = $this->lang->line('text_invoice_no');
        $data['column_product'] = $this->lang->line('column_product');
        $data['column_model'] = $this->lang->line('column_model');
        $data['column_quantity'] = $this->lang->line('column_quantity');
        $data['column_price'] = $this->lang->line('column_price');
        $data['column_total'] = $this->lang->line('column_total');

        $data['purchases'] = array();

        $purchases = array();

            $purchase_info = $this->sales->viewSalesProduct($purchase_id);
			$order_id=$purchase_info['order_id'];
			
			$manufacturer_id = $purchase_info['manufacturer_id'];
			$manufacturer_info = $this->sales->manufacturerData($manufacturer_id);
			
			$manufacturer_name=$manufacturer_info['firstname'].' '.$manufacturer_info['lastname'];
			$firstname=$manufacturer_info['firstname'];
			$lastname=$manufacturer_info['lastname'];
			$manufacturer_email=$manufacturer_info['email'];
			$manufacturer_telephone=$manufacturer_info['telephone'];
			$manufacturer_mobile=$manufacturer_info['mobile'];
			$manufacturer_address=$manufacturer_info['address_1'];
			
			$country_data=$this->country->getCountry($manufacturer_info['country_id']);
			$country_name=$country_data['country_name'];
			$state_data=$this->zone->getZone($manufacturer_info['state_id']);
			$state_name=$state_data['state_name'];
			
			$date = new DateTime($purchase_info['date_added']);
			$purchase_return_date1=$date->format("d/m/Y");  
			
			if(isset($purchase_return_date1) || $purchase_return_date1 != NULL)
			{
				$this->data['purchase_return_date1']=$purchase_return_date1;
			}
			else
			{
				$this->data['purchase_return_date1']='';
			} 
			
			if(isset($manufacturer_name) || $manufacturer_name != NULL)
			{
				$this->data['manufacturer_name']=$manufacturer_name;
			}
			else
			{
				$this->data['manufacturer_name']='';
			}
			
			if(isset($manufacturer_address) || $manufacturer_address != NULL)
			{
				$this->data['manufacturer_address']=$manufacturer_address;
			}
			else
			{
				$this->data['manufacturer_address']='';
			}
			
			if(isset($manufacturer_email) || $manufacturer_email != NULL)
			{
				$this->data['manufacturer_email']=$manufacturer_email;
			}
			else
			{
				$this->data['manufacturer_email']='';
			}
			
			if(isset($manufacturer_mobile) || $manufacturer_mobile != NULL)
			{
				$this->data['manufacturer_mobile']=$manufacturer_mobile;
			}
			else
			{
				$this->data['manufacturer_mobile']='';
			}
			
			if(isset($manufacturer_telephone) || $manufacturer_telephone != NULL)
			{
				$this->data['manufacturer_telephone']=$manufacturer_telephone;
			}
			else
			{
				$this->data['manufacturer_telephone']='';
			}
			
			//currency format
			$currency_code=$purchase_info['currency_code'];
			$get_currency_data=$this->currency_data->getCurrencyByCode($currency_code);
			$currency_symbol=$get_currency_data['symbol_left'];
			$currency_decimal_place=$get_currency_data['decimal_place'];
			$currency_value=$get_currency_data['value'];
		
            if ($purchase_info) {
                $store_name = $this->common->config('config_store_name');
                $store_address = $this->common->config('config_address');
                $store_email = $this->common->config('config_email');
                $store_telephone = $this->common->config('config_telephone');
                $store_fax = $this->common->config('config_fax');

                if ($purchase_info['invoice_no']) {
                    $invoice_no = $purchase_info['invoice_prefix'] . $purchase_info['invoice_no'];
                } else {
                    $invoice_no = '';
                }

                $format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' .  "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
                $find = array(
                    '{firstname}',
                    '{lastname}',
                    '{company}',
                    '{address_1}',                   
                    '{city}',
                    '{postcode}',
                    '{zone}',
                    '{zone_code}',
                    '{country}'
                );

                $replace = array(
                    'firstname' => $manufacturer_info['firstname'],
                    'lastname'  => $manufacturer_info['lastname'],
                    'company'   => $manufacturer_info['company_name'],
                    'address_1' => $manufacturer_info['address_1'],                   
                    'city'      => $manufacturer_info['city'],
                    'postcode'  => $manufacturer_info['postcode'],
                    'zone'      => $state_name,
                    'country'   => $country_name
                );

                $payment_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

                $format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
               
			   
				
                $product_data = array();
				
                $products = $this->sales->getSalesProducts($purchase_id);

                foreach ($products as $product) {
                    $option_data = array();

                    $options = $this->sales->getSalesProductOptions($purchase_id, $product['purchase_product_id']);

                    foreach ($options as $option) {
                        if ($option['type'] != 'file') {
                            $value = $option['value'];
                        } 
                        else 
                        {
                            
                                $value = '';
                            
                        }

                        $option_data[] = array(
                            'name'  => $option['name'],
                            'value' => $value
                        );
                    }

                    $product_data[] = array(
                        'name'     => $product['name'],
                        'model'    => $product['model'],
                        'option'   => $option_data,
                        'quantity' => $product['quantity'],                       
						'price'    =>$currency_symbol.' '.number_format((float)$product['price'],$currency_decimal_place, '.', ''),
						'total'    => $currency_symbol.' '.number_format((float)$product['total'],$currency_decimal_place, '.', '')
                    );
                }

               $total_data = array();

                $totals = $this->sales->getSalesTotals($purchase_id);
							
				$total_data[] = array(
					'title' => 'Total',										
					'text'    => $currency_symbol.' '.number_format((float)$totals['total'],$currency_decimal_place, '.', '')				
				);
					
               
				
                $data['purchases'][] = array(
					'purchase_id'        => $purchase_id,
                    'order_id'           => $order_id,
                    'invoice_no'         => $invoice_no,
					'manufacturer_name'	 => $manufacturer_name,
					'manufacturer_email' => $manufacturer_email,
					'manufacturer_mobile'=> $manufacturer_mobile,
					'manufacturer_address'=>$manufacturer_address,
                    'date_added'         => date($this->lang->line('date_format_short'), strtotime($purchase_info['date_added'])),
					'date_added'         => $purchase_return_date1,
                    'store_name'         => $store_name,
                    'store_address'      => nl2br($store_address),
                    'store_email'        => $store_email,
                    'store_telephone'    => $store_telephone,
                    'store_fax'          => $store_fax,
                    'email'              => $manufacturer_info['email'],
                    'telephone'          => $manufacturer_info['telephone'],                    
                    'product'            => $product_data,                    
                    'total'              => $total_data,
                    'comment'            => nl2br($purchase_info['note'])
                );
            }
        //}
		
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/sales/sales_invoice";
            $this->load->view($content_page,$data);
    }
	
}