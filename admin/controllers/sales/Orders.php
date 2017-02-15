<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Orders
* @Auther       : Indrajit
* @Date         : 19-12-2016
* @Description  : Admin Orders Operation
*
*/

class Orders extends CI_Controller {

 private $data=array();
 private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->_init();
        
         $this->rbac->CheckAuthentication();

        $this->lang->load('sales/orders_lang', 'english');

        $this->load->model('system/currency_model','currency_model');

        $this->load->model('sales/orders_model','sales');

        $this->load->model('system/order_status_model','order_status');

        $this->load->model('customers/customers_model','customers');

        $this->load->model('customers/Customer_groups_model','customers_group');

        $this->load->model('common');

        $this->load->library('commons');

        $this->load->library('mycart');

        $this->load->library('customer');

         $this->load->library('currency');

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
		$this->output->set_template('admin_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Orders','sarpo','This is srapo Orders page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Orders view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'order_id', $sort_order = 'ASC', $offset = 0)	{
       //echo session_id();exit;     
		$this->data['add'] 			 = base_url('sales/orders/add');
		 if ($this->session->userdata('role_id') == 1) {
            $this->data['delete'] = base_url('catalog/product/delete');
        } else {
            $this->data['delete'] = base_url('catalog/product/softDelete');
        }
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Orders',
		   'href' => base_url('sales/orders'),
		 
		  );
		$filter_array            = $this->session->userdata('order_filter_array');
        $filter_order_id         = "";
        $filter_customer         = "";
        $filter_order_status     = "*";
        $filter_total            = "";
        $filter_date_added       = "";
        $filter_date_modified    = "";
       
        if(isset($filter_array['filter_order_id']))
        {
          $filter_order_id =   $filter_array['filter_order_id'];
        }
        if(isset($filter_array['filter_customer']))
        {
          $filter_customer =   $filter_array['filter_customer'];
        }
        if(isset($filter_array['filter_order_status']))
        {
          $filter_order_status =   $filter_array['filter_order_status'];
        }
        if(isset($filter_array['filter_total']))
        {
          $filter_total =   $filter_array['filter_total'];
        }
        if(isset($filter_array['filter_date_added']))
        {
          $filter_date_added =   $filter_array['filter_date_added'];
        }
        if(isset($filter_array['filter_date_modified']))
        {
          $filter_date_modified =   $filter_array['filter_date_modified'];
        }
       

        $this->data['filter_order_id'] = $filter_order_id;
        $this->data['filter_customer'] = $filter_customer;
        $this->data['filter_order_status'] = $filter_order_status;
        $this->data['filter_total'] = $filter_total;
        $this->data['filter_date_added'] = $filter_date_added;
        $this->data['filter_date_modified'] = $filter_date_modified;
        // pagination
        $limit = $this->common->config('config_limit_admin');
        $data = array(
            'filter_order_id' => $filter_order_id,
            'filter_customer' => $filter_customer,
            'filter_order_status' => $filter_order_status,
            'filter_total' => $filter_total,
            'filter_date_added' => $filter_date_added,
            'filter_date_modified' => $filter_date_modified,
            'sort' => $sort_by,
            'order' => $sort_order,
            'start' => $offset,
            'limit' => $limit
        );

        $url = base_url("sales/orders/index/$sort_by/$sort_order");
        $total_records = $this->sales->getTotalOrders();
        $config = $this->commons->pagination($url, $total_records, $limit);
        $this->pagination->initialize($config);
        $config['uri_segment'] = 6;
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['sort_by'] = $sort_by;
        $this->data['sort_order'] = $sort_order;
        $results = $this->sales->getOrders($data);

        $this->data['pages'] = ceil($total_records / $limit);
        $this->data['totals'] = ceil($total_records);
        $this->data['range'] = ceil($offset + 1);

        // URL creation
        $url = '';
        if ($this->uri->segment(4) !== NULL) {
            $url .= '/' . $this->uri->segment(4);
        } else {
            $url .= '/order_id';
        }

        if ($this->uri->segment(5) !== NULL) {
            $url .= '/' . $this->uri->segment(5);
        } else {
            $url .= '/ASC';
        }
        if ($this->uri->segment(6) !== NULL) {
            $url .= '/' . $this->uri->segment(6);
        } else {
            $url .= '/0';
        }
        
        $this->load->model('tool/image');
        foreach ($results as $result) {
            $this->data['records'][] = array(
                'order_id' => $result['order_id'],
                'customer' => $result['customer'],
                'status' => $result['status'],
                'total'         => $this->currency->format($result['total'], $result['currency_code'], $result['currency_value']),
                'date_added' => date($this->common->config('config_date_format'), strtotime($result['date_added'])),
                'date_modified' => date($this->common->config('config_date_format'), strtotime($result['date_modified'])),
                'view' => base_url('sales/orders/info/' . $this->commons->encode($result['order_id'])),
                'edit' => base_url('sales/orders/edit' . $url . '/' . $this->commons->encode($result['order_id'])),
                'delete' => base_url('sales/orders/edit' . $url . '/' . $this->commons->encode($result['order_id']))
            );
        }

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if ($this->session->userdata('success') !== NULL) {
            $this->data['success'] = $this->session->userdata('success');
            $this->session->set_userdata('success', '');
        } else {
            $this->data['success'] = '';
        }
        if ($this->input->post('selected') !== NULL) {
            $this->data['selected'] = (array) $this->input->post('selected');
        } else {
            $this->data['selected'] = array();
        }

        $this->data['order_status_list'] = $this->order_status->getOrderStatuses();


		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/sales/orders_list";
		$this->load->view($content_page,$this->data);
	}
	/**
    * 
    * @function name : search()
    * @description   : set session data by filter paramater
    * @param         : void
    * @return        : void
    *
    */
    public function search()
    {
            if ($this->input->post('button_filter') !== NULL) 
            {
            	if ($this->input->post('filter_order_id') !== NULL) {
                    $filter_order_id = $this->input->post('filter_order_id');
                } else {
                    $filter_order_id = '';
                }

                if ($this->input->post('filter_customer') !== NULL) {
                    $filter_customer = $this->input->post('filter_customer');
                } else {
                    $filter_customer = '';
                }

                if ($this->input->post('filter_total') !== NULL) {
                    $filter_total = $this->input->post('filter_total');
                } else {
                    $filter_total = '';
                }

                if ($this->input->post('filter_order_status')!==NULL) 
                {
                    if ($this->input->post('filter_order_status')!= '*') 
                    {
                        $filter_order_status = $this->input->post('filter_order_status');
                    } 
                    else 
                    {
                        $filter_order_status = '*';
                    }
                }
                else
                {
                    $filter_order_status = '';
                }
                 if ($this->input->post('filter_date_added') !== NULL) {
                    $filter_date_added = $this->input->post('filter_date_added');
                } else {
                    $filter_date_added = '';
                }
                 if ($this->input->post('filter_date_modified') !== NULL) {
                    $filter_date_modified = $this->input->post('filter_date_modified');
                } else {
                    $filter_date_modified = '';
                }
                $filter['filter_order_id'] = $filter_order_id;
                $filter['filter_customer'] = $filter_customer;
                $filter['filter_order_status'] = $filter_order_status;
                $filter['filter_total'] = $filter_total;
                $filter['filter_date_added'] = $filter_date_added;
                $filter['filter_date_modified'] = $filter_date_modified;
                $this->session->set_userdata('order_filter_array', $filter);
            }
            if ($this->input->post('button_all') !== NULL) 
            {
               $this->session->set_userdata('order_filter_array', array());
            }
            $this->index();
           
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
    
        // Generate back url
        $url = '';

        if ($this->uri->segment(4)!==NULL) {
            $url .= '/'.$this->uri->segment(4);
        }
        else
        {
            $url .= '/order_id';
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
        $this->data['breadcrumbs']      = array();
        $this->data['breadcrumbs'][]    = array(
           'text' => '<i class="fa fa-dashboard"></i> Home',
           'href' => base_url('dashboard/dashboard'),

        );
        $this->data['breadcrumbs'][] = array(
          'text' => 'Orders',
          'href' => base_url('sales/orders'),

        );
     
        // Add or Edit Transaction
        $count = $this->uri->total_segments();
        $method = $this->uri->segment(3);
        if ($method=='add') 
        {
            $this->data['form_action'] = base_url('sales/orders/add'.$url);
            $this->data['customer_id'] = '';
            $this->data['text_form'] = $this->lang->line('text_add');
            //echo "1";
        } 
        else 
        {
            $this->data['form_action'] = base_url('sales/orders/edit'.$url.'/'.$this->uri->segment($count));

            $this->data['customer_id'] = $this->commons->decode($this->uri->segment($count));
            $this->data['text_form'] = $this->lang->line('text_edit');
        }
        //$this->data['refresh']        = base_url('customers/customer/refresh');
        $this->data['cancel']       = base_url('sales/orders/index'.$url);
        if (1) 
        {
            $order_info = $this->sales->getOrder($this->commons->decode($this->uri->segment($count)));
        }

        if ($order_info) 
        {
            $this->data['order_id'] = $order_info['order_id'];
            $this->data['customer'] = $order_info['customer'];
            $this->data['customer_id'] = $order_info['customer_id'];
            $this->data['customer_group_id'] = $order_info['customer_group_id'];
            $this->data['firstname'] = $order_info['firstname'];
            $this->data['lastname'] = $order_info['lastname'];
            $this->data['email'] = $order_info['email'];
            $this->data['telephone'] = $order_info['telephone'];
            
            $this->data['addresses'] = $this->customers->getAddresses($order_info['customer_id']);

            $this->data['payment_firstname'] = $order_info['payment_firstname'];
            $this->data['payment_lastname'] = $order_info['payment_lastname'];
            $this->data['payment_company'] = $order_info['payment_company'];
            $this->data['payment_address_1'] = $order_info['payment_address_1'];
            $this->data['payment_address_2'] = $order_info['payment_address_2'];
            $this->data['payment_city'] = $order_info['payment_city'];
            $this->data['payment_postcode'] = $order_info['payment_postcode'];
            $this->data['payment_country_id'] = $order_info['payment_country_id'];
            $this->data['payment_zone_id'] = $order_info['payment_state_id'];
            $this->data['payment_method'] = $order_info['payment_method'];
            $this->data['payment_code'] = $order_info['payment_code'];

            $this->data['shipping_firstname'] = $order_info['shipping_firstname'];
            $this->data['shipping_lastname'] = $order_info['shipping_lastname'];
            $this->data['shipping_company'] = $order_info['shipping_company'];
            $this->data['shipping_address_1'] = $order_info['shipping_address_1'];
            $this->data['shipping_address_2'] = $order_info['shipping_address_2'];
            $this->data['shipping_city'] = $order_info['shipping_city'];
            $this->data['shipping_postcode'] = $order_info['shipping_postcode'];
            $this->data['shipping_country_id'] = $order_info['shipping_country_id'];
            $this->data['shipping_zone_id'] = $order_info['shipping_state_id'];
            $this->data['shipping_method'] = $order_info['shipping_method'];
            $this->data['shipping_code'] = $order_info['shipping_code'];

            // Products
            $this->data['order_products'] = array();

            $products = $this->sales->getOrderProducts($order_info['order_id']);
            foreach ($products as $product) {
                $this->data['order_products'][] = array(
                    'product_id' => $product['product_id'],
                    'name'       => $product['name'],
                    'model'      => $product['model'],
                    'option'     => $this->sales->getOrderOptions($order_info['order_id'], $product['order_product_id']),
                    'quantity'   => $product['quantity'],
                    'price'      => $product['price'],
                    'total'      => $product['total'],
                    
                );
            }

            // Vouchers
            $this->data['order_vouchers'] = $this->sales->getOrderVouchers($order_info['order_id']);

            $this->data['coupon'] = '';
            $this->data['voucher'] = '';
            $this->data['order_totals'] = array();

            $order_totals = $this->sales->getOrderTotals($order_info['order_id']);

            foreach ($order_totals as $order_total) {
                // If coupon, voucher or reward points
                $start = strpos($order_total['title'], '(') + 1;
                $end = strrpos($order_total['title'], ')');

                if ($start && $end) {
                    $data[$order_total['code']] = substr($order_total['title'], $start, $end - $start);
                }
            }

            $this->data['order_status_id'] = $order_info['order_status_id'];
            $this->data['comment'] = $order_info['comment'];
            $this->data['currency_code'] = $order_info['currency_code'];
        } else {
            $this->data['order_id'] = 0;
            $this->data['store_id'] = '';
            $this->data['customer'] = '';
            $this->data['customer_id'] = '';
            $this->data['customer_group_id'] = $this->common->config('config_customer_group_id');
            $this->data['firstname'] = '';
            $this->data['lastname'] = '';
            $this->data['email'] = '';
            $this->data['telephone'] = '';
           

            $this->data['addresses'] = array();

            $this->data['payment_firstname'] = '';
            $this->data['payment_lastname'] = '';
            $this->data['payment_company'] = '';
            $this->data['payment_address_1'] = '';
            $this->data['payment_address_2'] = '';
            $this->data['payment_city'] = '';
            $this->data['payment_postcode'] = '';
            $this->data['payment_country_id'] = '';
            $this->data['payment_zone_id'] = '';
            $this->data['payment_method'] = '';
            $this->data['payment_code'] = '';

            $this->data['shipping_firstname'] = '';
            $this->data['shipping_lastname'] = '';
            $this->data['shipping_company'] = '';
            $this->data['shipping_address_1'] = '';
            $this->data['shipping_address_2'] = '';
            $this->data['shipping_city'] = '';
            $this->data['shipping_postcode'] = '';
            $this->data['shipping_country_id'] = '';
            $this->data['shipping_zone_id'] = '';
            $this->data['shipping_method'] = '';
            $this->data['shipping_code'] = '';

            $this->data['order_products'] = array();
            $this->data['order_vouchers'] = array();
            $this->data['order_totals'] = array();

            $this->data['order_status_id'] = $this->common->config('config_order_status_id');
            $this->data['comment'] = '';
            $this->data['currency_code'] = $this->common->config('config_currency');

            $this->data['coupon'] = '';
            $this->data['voucher'] = '';
            
        }
    	
        $this->data['currency_list'] = $this->currency_model->getCurrencies();
    	$this->data['customer_group'] = $this->customers_group->getCustomerGroups();

        $this->load->model('system/country_model','country');

        $this->data['countries'] = $this->country->getCountries();

        $this->load->model('system/order_status_model','order_status');

        $this->data['order_statuses'] = $this->order_status->getOrderStatuses();
       
        $this->load->model('sales/Voucher_themes_model','voucher_themes');
        $this->data['voucher_themes'] = $this->voucher_themes->getVoucherThemes();

        $this->data['voucher_min'] = $this->common->config('config_voucher_min');
        // echo "<pre>";
        // print_r($this->data);
    	$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/sales/orders";
		$this->load->view($content_page,$this->data);	
    }
	/**
	* 
	* @function name : add()
	* @description   : load Orders Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function add()	{

		$this->data['form_action']   = base_url('sales/orders/add');
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Orders',
		   'href' => base_url('sales/orders'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Add Orders',
		   'href' => base_url('sales/orders/add'),
		 
		  );

		$this->getForm();
	}
    /**
    * 
    * @function name : edit()
    * @description   : load Orders Add view
    * @param         : void
    * @return        : void
    *
    */
    public function edit()   {

        $this->data['form_action']   = base_url('sales/orders/edit');
        $this->data['breadcrumbs']   = array();
        $this->data['breadcrumbs'][] = array(
           'text' => '<i class="fa fa-dashboard"></i> Home',
           'href' => base_url('dashboard/dashboard'),
         
          );
        $this->data['breadcrumbs'][] = array(
           'text' => 'Orders',
           'href' => base_url('sales/orders'),
         
          );
        $this->data['breadcrumbs'][] = array(
           'text' => 'Add Orders',
           'href' => base_url('sales/orders/add'),
         
          );

        $this->getForm();
    }
	/**
	* 
	* @function name : details()
	* @description   : load Orders detail view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function details()	{

		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Orders',
		   'href' => base_url('sales/orders'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'View Orders',
		   'href' => '#',
		 
		  );
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/sales/orders_view";
		$this->load->view($content_page,$this->data);
	}
    /**
    * 
    * @function name : info()
    * @description   : load Orders detail view
    * @param         : void
    * @return        : void
    *
    */
    public function info($order_id = "") 
    {

        if ($order_id !== "") 
        {
            $order_id = $this->commons->decode($order_id);
        } else {
            $order_id = 0;
        }
        $this->data['breadcrumbs']   = array();
        $this->data['breadcrumbs'][] = array(
           'text' => '<i class="fa fa-dashboard"></i> Home',
           'href' => base_url('dashboard/dashboard'),
         
          );
        $this->data['breadcrumbs'][] = array(
           'text' => 'Orders',
           'href' => base_url('sales/orders'),
         
          );
        $this->data['breadcrumbs'][] = array(
           'text' => 'View Orders',
           'href' => base_url('sales/orders/info/').$this->commons->encode($order_id),
         
          );
        $order_info = $this->sales->getOrder($order_id);
        // echo "<pre>";

        // print_r($order_info);
        if ($order_info) {
            
            $this->data['heading_title'] = $this->lang->line('heading_title');

            $this->data['text_order_detail'] = $this->lang->line('text_order_detail');
            $this->data['text_customer_detail'] = $this->lang->line('text_customer_detail');
            $this->data['text_option'] = $this->lang->line('text_option');
            $this->data['text_date_added'] = $this->lang->line('text_date_added');
            $this->data['text_payment_method'] = $this->lang->line('text_payment_method');
            $this->data['text_shipping_method'] = $this->lang->line('text_shipping_method');
            $this->data['text_customer'] = $this->lang->line('text_customer');
            $this->data['text_customer_group'] = $this->lang->line('text_customer_group');
            $this->data['text_email'] = $this->lang->line('text_email');
            $this->data['text_telephone'] = $this->lang->line('text_telephone');
            $this->data['text_invoice'] = $this->lang->line('text_invoice');
            $this->data['text_reward'] = $this->lang->line('text_reward');
            $this->data['text_affiliate'] = $this->lang->line('text_affiliate');
            $this->data['text_order'] = sprintf($this->lang->line('text_order'), $order_id);
            $this->data['text_payment_address'] = $this->lang->line('text_payment_address');
            $this->data['text_shipping_address'] = $this->lang->line('text_shipping_address');
            $this->data['text_comment'] = $this->lang->line('text_comment');

            $this->data['text_account_custom_field'] = $this->lang->line('text_account_custom_field');
            $this->data['text_payment_custom_field'] = $this->lang->line('text_payment_custom_field');
            $this->data['text_shipping_custom_field'] = $this->lang->line('text_shipping_custom_field');
            $this->data['text_browser'] = $this->lang->line('text_browser');
            $this->data['text_ip'] = $this->lang->line('text_ip');
            $this->data['text_forwarded_ip'] = $this->lang->line('text_forwarded_ip');
            $this->data['text_user_agent'] = $this->lang->line('text_user_agent');
            $this->data['text_accept_language'] = $this->lang->line('text_accept_language');
            $this->data['text_history'] = $this->lang->line('text_history');
            $this->data['text_history_add'] = $this->lang->line('text_history_add');
            $this->data['text_loading'] = $this->lang->line('text_loading');

            $this->data['column_product'] = $this->lang->line('column_product');
            $this->data['column_model'] = $this->lang->line('column_model');
            $this->data['column_quantity'] = $this->lang->line('column_quantity');
            $this->data['column_price'] = $this->lang->line('column_price');
            $this->data['column_total'] = $this->lang->line('column_total');
            $this->data['text_srapo_cat_no'] = $this->lang->line('text_srapo_cat_no');
            $this->data['text_m_name'] = $this->lang->line('text_m_name');
            $this->data['text_m_cat_no'] = $this->lang->line('text_m_cat_no');
            $this->data['text_m_cat_name'] = $this->lang->line('text_m_cat_name');
            $this->data['text_m_pro_code'] = $this->lang->line('text_m_pro_code');
            $this->data['entry_order_status'] = $this->lang->line('entry_order_status');
            $this->data['entry_notify'] = $this->lang->line('entry_notify');
            $this->data['entry_override'] = $this->lang->line('entry_override');
            $this->data['entry_comment'] = $this->lang->line('entry_comment');

            $this->data['help_override'] = $this->lang->line('help_override');

            $this->data['button_invoice_print'] = $this->lang->line('button_invoice_print');
            $this->data['button_shipping_print'] = $this->lang->line('button_shipping_print');
            $this->data['button_edit'] = $this->lang->line('button_edit');
            $this->data['button_cancel'] = $this->lang->line('button_cancel');
            $this->data['button_generate'] = $this->lang->line('button_generate');
            $this->data['button_reward_add'] = $this->lang->line('button_reward_add');
            $this->data['button_reward_remove'] = $this->lang->line('button_reward_remove');
            $this->data['button_commission_add'] = $this->lang->line('button_commission_add');
            $this->data['button_commission_remove'] = $this->lang->line('button_commission_remove');
            $this->data['button_history_add'] = $this->lang->line('button_history_add');
            $this->data['button_ip_add'] = $this->lang->line('button_ip_add');

            $this->data['tab_history'] = $this->lang->line('tab_history');
            $this->data['tab_additional'] = $this->lang->line('tab_additional');

            // Generate back url
            $url = '';

            if ($this->uri->segment(4)!==NULL) {
                $url .= '/'.$this->uri->segment(4);
            }
            else
            {
                $url .= '/order_id';
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

          

            // $this->data['shipping'] = $this->url->link('sale/order/shipping', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
            // $this->data['invoice'] = $this->url->link('sale/order/invoice', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
            // $this->data['edit'] = $this->url->link('sale/order/edit', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
            // $this->data['cancel'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL');

             $this->data['shipping'] = base_url('sales/orders/shipping/').$this->commons->encode($order_id);
            $this->data['invoice'] = base_url('sales/orders/invoice/').$this->commons->encode($order_id);
            $this->data['edit'] = base_url('sales/orders/edit/').$this->commons->encode($order_id);
            $this->data['cancel'] = base_url('sales/orders');

            $this->data['order_id'] = $order_id;

            if ($order_info['invoice_no']) {
                $this->data['invoice_no'] = $order_info['invoice_prefix'] . $order_info['invoice_no'];
            } else {
                $this->data['invoice_no'] = '';
            }

            $this->data['date_added'] = date($this->common->config('config_date_format'), strtotime($order_info['date_added']));

            $this->data['firstname'] = $order_info['firstname'];
            $this->data['lastname'] = $order_info['lastname'];

            if ($order_info['customer_id']) {
                $this->data['customer'] = base_url('customers/customer/edit/').$this->commons->encode($order_info['customer_id']);
            } else {
                $this->data['customer'] = '';
            }

            $customer_group_info = $this->customers_group->getCustomerGroup($order_info['customer_group_id']);

            if ($customer_group_info) {
                $this->data['customer_group'] = $customer_group_info['group_name'];
            } else {
                $this->data['customer_group'] = '';
            }

            $this->data['email'] = $order_info['email'];
            $this->data['telephone'] = $order_info['telephone'];

            $this->data['shipping_method'] = $order_info['shipping_method'];
            $this->data['payment_method'] = $order_info['payment_method'];

            // Payment Address
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
                'country'   => $order_info['payment_country']
            );

            $this->data['payment_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

            // Shipping Address
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
                'country'   => $order_info['shipping_country']
            );

            $this->data['shipping_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

            $this->data['products'] = array();


            $products = $this->sales->getOrderProducts($order_id);

            foreach ($products as $product) {
                $option_data = array();

                $options = $this->sales->getOrderOptions($order_id, $product['order_product_id']);

                foreach ($options as $option) {
                    if ($option['type'] != 'file') {
                        $option_data[] = array(
                            'name'  => $option['name'],
                            'value' => $option['value'],
                            'type'  => $option['type']
                        );
                    } 
                    else 
                    {
                        
                            $option_data[] = array(
                                'name'  => $option['name'],
                                'value' => $upload_info['name'],
                                'type'  => $option['type'],
                                'href'  => ''
                            );
                        
                    }
                }
                $this->load->model('catalog/product_model');
                $catalog_data = $this->product_model->getProductById($product['product_id']);
                
                $this->load->model('catalog/manufacturer_model');
                $m_data = $this->manufacturer_model->getManufacturerById($catalog_data['manufacturer_id']);

                $this->data['products'][] = array(
                    'order_product_id' => $product['order_product_id'],
                    'product_id'       => $product['product_id'],
                    'name'             => $product['name'],
                    'model'            => $product['model'],
                    'catalog_no'       => $catalog_data['catalog_no'],
                    'manufacturer_name'=> $m_data['firstname']." ".$m_data['lastname'],
                    'm_cat_no'         => $catalog_data['manufacture_catalog_no'],
                    'm_cat_name'       => $catalog_data['manufacture_catalog_name'],
                    'm_pro_code'       => $catalog_data['manufacture_product_code'],
                    'option'           => $option_data,
                    'quantity'         => $product['quantity'],
                    'price'            => $this->currency->format($product['price'] + ($this->common->config('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']),
                    'total'            => $this->currency->format($product['total'] + ($this->common->config('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']),
                    'href'             => base_url('catalog/product/edit/').$this->commons->encode($product['product_id']),
                );
            }

            $this->data['vouchers'] = array();

            $vouchers = $this->sales->getOrderVouchers($order_id);
            foreach ($vouchers as $voucher) {
                $this->data['vouchers'][] = array(
                    'description' => $voucher['description'],
                    'amount'      => $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value']),
                    'href'        => base_url('sales/gift_vouchers/edit/').$this->commons->encode($voucher['voucher_id']),
                );
            }

            $this->data['totals'] = array();

            $totals = $this->sales->getOrderTotals($order_id);

            foreach ($totals as $total) {
                $this->data['totals'][] = array(
                    'title' => $total['title'],
                    'text'  => $this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value']),
                );
            }

            $this->data['comment'] = nl2br($order_info['comment']);

            $order_status_info = $this->order_status->getOrderStatus($order_info['order_status_id']);

            if ($order_status_info) {
                $this->data['order_status'] = $order_status_info['order_status_name'];
            } else {
                $this->data['order_status'] = '';
            }

            $this->data['order_statuses'] = $this->order_status->getOrderStatuses();

            $this->data['order_status_id'] = $order_info['order_status_id'];

            // Additional Tabs
            $this->data['tabs'] = array();

            // echo "<pre>";
            // print_r($this->data);exit;
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/sales/order_info";
            $this->load->view($content_page,$this->data);
        } else {
            // $this->load->language('error/not_found');

            // $this->document->setTitle($this->lang->line('heading_title'));

            // $this->data['heading_title'] = $this->lang->line('heading_title');

            // $this->data['text_not_found'] = $this->lang->line('text_not_found');

            // $this->data['breadcrumbs'] = array();

            // $this->data['breadcrumbs'][] = array(
            //     'text' => $this->lang->line('text_home'),
            //     'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
            // );

            // $this->data['breadcrumbs'][] = array(
            //     'text' => $this->lang->line('heading_title'),
            //     'href' => $this->url->link('error/not_found', 'token=' . $this->session->data['token'], 'SSL')
            // );

            // $this->data['header'] = $this->load->controller('common/header');
            // $this->data['column_left'] = $this->load->controller('common/column_left');
            // $this->data['footer'] = $this->load->controller('common/footer');

            // $this->response->setOutput($this->load->view('error/not_found.tpl', $this->data));
        }
    }
	/**
	* 
	* @function name : order_print()
	* @description   : load Orders Invoice view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function order_print()	{

		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Orders',
		   'href' => base_url('sales/orders'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'View Orders',
		   'href' => '#',
		 
		  );
		$this->output->unset_template();
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/sales/order_print_view";
		$this->load->view($content_page,$this->data);
	}
	/**
	* 
	* @function name : createInvoiceNo()
	* @description   : create invoice no for given order id
	* @param   		 : void
	* @return        : json
	*
	*/
	public function createInvoiceNo() 
    {
        $this->output->unset_template();
        $json = array();

        if ($this->input->post('order_id')) 
        {
            if ($this->input->post('order_id') !== "") {
                $order_id = $this->input->post('order_id');
            } else {
                $order_id = 0;
            }

            $invoice_no = $this->sales->createInvoiceNo($order_id);

            if ($invoice_no) {
                $json['invoice_no'] = $invoice_no;
            } else {
                $json['error'] = $this->lang->line('error_action');
            }
        }

        // $this->response->addHeader('Content-Type: application/json');
        // $this->response->setOutput(json_encode($json));
        echo json_encode($json);
    }

    public function history($order_id) 
    {
        $this->output->unset_template();
     //  echo " here";exit;

        $this->data['text_no_results'] = "No results!";

        $this->data['column_date_added'] = "Date Added";
        $this->data['column_status'] = "Status";
        $this->data['column_notify'] = "Customer Notified";
        $this->data['column_comment'] = "Comment";

        if ($this->input->post('page')!=="") {
            $page = $this->input->post('page');
        } else {
            $page = 1;
        }

        $this->data['histories'] = array();

        $results = $this->sales->getOrderHistories($order_id, ($page - 1) * 10, 10);

        foreach ($results as $result) {
            $this->data['histories'][] = array(
                'notify'     => $result['notify'] ? "Yes" : "No",
                'status'     => $result['status'],
                'comment'    => nl2br($result['comment']),
                'date_added' => date($this->common->config('config_date_format'), strtotime($result['date_added']))
            );
        }

        $history_total = $this->sales->getTotalOrderHistories($order_id);

        // $pagination = new Pagination();
        // $pagination->total = $history_total;
        // $pagination->page = $page;
        // $pagination->limit = 10;
        // $pagination->url = $this->url->link('sale/order/history', 'token=' . $this->session->data['token'] . '&order_id=' . $this->request->get['order_id'] . '&page={page}', 'SSL');

        // $data['pagination'] = $pagination->render();

        // $data['results'] = sprintf($this->lang->line('text_pagination'), ($history_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($history_total - 10)) ? $history_total : ((($page - 1) * 10) + 10), $history_total, ceil($history_total / 10));

        $this->data['pagination'] = "";

        $this->data['results'] = "";
         $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/sales/order_history";
            $this->load->view($content_page,$this->data);
    }

    public function invoice($order_id = "") {
         $this->output->unset_template();
        $data['title'] = $this->lang->line('text_invoice');

        $data['direction'] = $this->lang->line('direction');
        $data['lang'] = $this->lang->line('code');

        $data['text_invoice'] = $this->lang->line('text_invoice');
        $data['text_order_detail'] = $this->lang->line('text_order_detail');
        $data['text_order_id'] = $this->lang->line('text_order_id');
        $data['text_invoice_no'] = $this->lang->line('text_invoice_no');
        $data['text_invoice_date'] = $this->lang->line('text_invoice_date');
        $data['text_date_added'] = $this->lang->line('text_date_added');
        $data['text_telephone'] = $this->lang->line('text_telephone');
        $data['text_fax'] = $this->lang->line('text_fax');
        $data['text_email'] = $this->lang->line('text_email');
        $data['text_website'] = $this->lang->line('text_website');
        $data['text_payment_address'] = $this->lang->line('text_payment_address');
        $data['text_shipping_address'] = $this->lang->line('text_shipping_address');
        $data['text_payment_method'] = $this->lang->line('text_payment_method');
        $data['text_shipping_method'] = $this->lang->line('text_shipping_method');
        $data['text_comment'] = $this->lang->line('text_comment');

        $data['column_product'] = $this->lang->line('column_product');
        $data['column_model'] = $this->lang->line('column_model');
        $data['column_quantity'] = $this->lang->line('column_quantity');
        $data['column_price'] = $this->lang->line('column_price');
        $data['column_total'] = $this->lang->line('column_total');

        $data['orders'] = array();

        $orders = array();

        if ($this->input->post('selected')) 
        {
            $orders = $this->input->post('selected');
        }
        else
        {
            $orders[] = $this->commons->decode($order_id);
        }

        foreach ($orders as $order_id) {
            $order_info = $this->sales->getOrder($order_id);

            if ($order_info) {
                $store_name = $this->common->config('config_store_name');
                $store_address = $this->common->config('config_address');
                $store_email = $this->common->config('config_email');
                $store_telephone = $this->common->config('config_telephone');
                $store_fax = $this->common->config('config_fax');

                if ($order_info['invoice_no']) {
                    $invoice_no = $order_info['invoice_prefix'] . $order_info['invoice_no'];
                } else {
                    $invoice_no = '';
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
                    'country'   => $order_info['payment_country']
                );

                $payment_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

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
                    'country'   => $order_info['shipping_country']
                );

                $shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

                $product_data = array();

                $products = $this->sales->getOrderProducts($order_id);

                foreach ($products as $product) {
                    $option_data = array();

                    $options = $this->sales->getOrderOptions($order_id, $product['order_product_id']);

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
                        'price'    => $this->currency->format($product['price'] + ($this->common->config('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']),
                        'total'    => $this->currency->format($product['total'] + ($this->common->config('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value'])
                    );
                }

                $voucher_data = array();

                $vouchers = $this->sales->getOrderVouchers($order_id);

                foreach ($vouchers as $voucher) {
                    $voucher_data[] = array(
                        'description' => $voucher['description'],
                        'amount'      => $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value'])
                    );
                }

                $total_data = array();

                $totals = $this->sales->getOrderTotals($order_id);
                foreach ($totals as $total) 
                {
                    $total_data[] = array(
                        'title' => $total['title'],
                        'text'  => $this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value']),
                    );
                }

                $data['orders'][] = array(
                    'order_id'           => $order_id,
                    'invoice_no'         => $invoice_no,
                    'date_added'         => date($this->lang->line('date_format_short'), strtotime($order_info['date_added'])),
                    'store_name'         => $store_name,
                    'store_address'      => nl2br($store_address),
                    'store_email'        => $store_email,
                    'store_telephone'    => $store_telephone,
                    'store_fax'          => $store_fax,
                    'email'              => $order_info['email'],
                    'telephone'          => $order_info['telephone'],
                    'shipping_address'   => $shipping_address,
                    'shipping_method'    => $order_info['shipping_method'],
                    'payment_address'    => $payment_address,
                    'payment_method'     => $order_info['payment_method'],
                    'product'            => $product_data,
                    'voucher'            => $voucher_data,
                    'total'              => $total_data,
                    'comment'            => nl2br($order_info['comment'])
                );
            }
        }

            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/sales/order_invoice";
            $this->load->view($content_page,$data);
    }

    public function shipping($order_id ="") 
    {
         $this->output->unset_template();
        $data['title'] = $this->lang->line('text_shipping');

        $data['text_shipping'] = $this->lang->line('text_shipping');
        $data['text_picklist'] = $this->lang->line('text_picklist');
        $data['text_order_detail'] = $this->lang->line('text_order_detail');
        $data['text_order_id'] = $this->lang->line('text_order_id');
        $data['text_invoice_no'] = $this->lang->line('text_invoice_no');
        $data['text_invoice_date'] = $this->lang->line('text_invoice_date');
        $data['text_date_added'] = $this->lang->line('text_date_added');
        $data['text_telephone'] = $this->lang->line('text_telephone');
        $data['text_fax'] = $this->lang->line('text_fax');
        $data['text_email'] = $this->lang->line('text_email');
        $data['text_website'] = $this->lang->line('text_website');
        $data['text_contact'] = $this->lang->line('text_contact');
        $data['text_payment_address'] = $this->lang->line('text_payment_address');
        $data['text_shipping_method'] = $this->lang->line('text_shipping_method');
        $data['text_sku'] = $this->lang->line('text_sku');
        $data['text_upc'] = $this->lang->line('text_upc');
        $data['text_ean'] = $this->lang->line('text_ean');
        $data['text_jan'] = $this->lang->line('text_jan');
        $data['text_isbn'] = $this->lang->line('text_isbn');
        $data['text_mpn'] = $this->lang->line('text_mpn');
        $data['text_comment'] = $this->lang->line('text_comment');

        $data['column_location'] = $this->lang->line('column_location');
        $data['column_reference'] = $this->lang->line('column_reference');
        $data['column_product'] = $this->lang->line('column_product');
        $data['column_weight'] = $this->lang->line('column_weight');
        $data['column_model'] = $this->lang->line('column_model');
        $data['column_quantity'] = $this->lang->line('column_quantity');

        $data['orders'] = array();

        $orders = array();

        if ($this->input->post('selected')) 
        {
            $orders = $this->input->post('selected');
        }
        else
        {
            $orders[] = $this->commons->decode($order_id);
        }

        foreach ($orders as $order_id) {
            $order_info = $this->sales->getOrder($order_id);

            // Make sure there is a shipping method
            if ($order_info && $order_info['shipping_code']) {
                 $store_name = $this->common->config('config_store_name');
                $store_address = $this->common->config('config_address');
                $store_email = $this->common->config('config_email');
                $store_telephone = $this->common->config('config_telephone');
                $store_fax = $this->common->config('config_fax');

                if ($order_info['invoice_no']) {
                    $invoice_no = $order_info['invoice_prefix'] . $order_info['invoice_no'];
                } else {
                    $invoice_no = '';
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
                    'firstname' => $order_info['shipping_firstname'],
                    'lastname'  => $order_info['shipping_lastname'],
                    'company'   => $order_info['shipping_company'],
                    'address_1' => $order_info['shipping_address_1'],
                    'address_2' => $order_info['shipping_address_2'],
                    'city'      => $order_info['shipping_city'],
                    'postcode'  => $order_info['shipping_postcode'],
                    'zone'      => $order_info['shipping_zone'],
                    'country'   => $order_info['shipping_country']
                );

                $shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

                $product_data = array();

                $products = $this->sales->getOrderProducts($order_id);

                foreach ($products as $product) {
                    $option_weight = '';
                     $this->load->model('catalog/product_model', 'catalog_product');
                    $product_info = $this->catalog_product->getProduct($product['product_id']);
                    if ($product_info) {
                        $option_data = array();

                        $options = $this->sales->getOrderOptions($order_id, $product['order_product_id']);

                        foreach ($options as $option) {
                            $option_value_info = $this->catalog_product->getProductOptionValue($order_id, $product['order_product_id']);

                            if ($option['type'] != 'file') {
                                $value = $option['value'];
                            } else {
                                
                                    $value = '';
                                
                            }

                            $option_data[] = array(
                                'name'  => $option['name'],
                                'value' => $value
                            );

                            $product_option_value_info = $this->catalog_product->getProductOptionValue($product['product_id'], $option['product_option_value_id']);
                            if ($product_option_value_info) {
                                if ($product_option_value_info['weight_prefix'] == '+') {
                                    $option_weight += $product_option_value_info['weight'];
                                } elseif ($product_option_value_info['weight_prefix'] == '-') {
                                    $option_weight -= $product_option_value_info['weight'];
                                }
                            }
                        }

                        $product_data[] = array(
                            'name'     => $product_info['product_name'],
                            'model'    => $product_info['model'],
                            'option'   => $option_data,
                            'quantity' => $product['quantity'],
                            'location' => $product_info['location'],
                            'sku'      => $product_info['sku'],
                            'upc'      => $product_info['upc'],
                            'ean'      => $product_info['ean'],
                            'jan'      => $product_info['jan'],
                            'isbn'     => $product_info['isbn'],
                            'mpn'      => $product_info['mpn'],
                            'weight'   => $product_info['weight']." ".$product_info['weight_class']
                        );
                    }
                }

                $data['orders'][] = array(
                    'order_id'         => $order_id,
                    'invoice_no'       => $invoice_no,
                    'date_added'       => date($this->lang->line('date_format_short'), strtotime($order_info['date_added'])),
                    'store_name'       => $store_name,
                    'store_address'    => nl2br($store_address),
                    'store_email'      => $store_email,
                    'store_telephone'  => $store_telephone,
                    'store_fax'        => $store_fax,
                    'email'            => $order_info['email'],
                    'telephone'        => $order_info['telephone'],
                    'shipping_address' => $shipping_address,
                    'shipping_method'  => $order_info['shipping_method'],
                    'product'          => $product_data,
                    'comment'          => nl2br($order_info['comment'])
                );
            }
        }

        $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/sales/order_shipping";
            $this->load->view($content_page,$data);
    }
}
