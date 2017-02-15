<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Dashboard
* @Auther       : Indrajit
* @Date         : 07-10-2016
* @Description  : Admin Dashboard Operation
*
*/

class Dashboard extends CI_Controller {

private $data=array();

	function __construct()
	{
		parent::__construct();

		$this->rbac->CheckAuthentication();
		$this->load->model('reports/Sales_report_model','sales_report');
		$this->load->model('reports/Customer_order_report_model','customer_report');
		$this->_init();
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
		$this->output->set_template('logistic_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Dashboard','sarpo','This is srapo Dashboard page');
	}


	/**
	* 
	* @function name : index()
	* @description   : load Dashboard view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index()	
	{
                        
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Dashboard',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['order']=$this->totalOrders();
		$this->data['sales']=$this->totalSales();
		$this->data['customers']=$this->totalCustomers();
		$this->data['purchase']=$this->totalPurchase();
		$this->data['tickets']=$this->totalTickets();
		$this->data['orders']=$this->recentOrders();
			
		// Run currency update
		if ($this->common->config('config_currency_auto')) {
			$this->load->model('system/currency_model','currency');
			$this->currency->refresh();
		}

		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/dashboard/dashboard";
		$this->load->view($content_page,$this->data);
	}
	
	
	/**
	* 
	* @function name : map()
	* @description   : view Map from where order is placed
	* @param   		 : void
	* @return        : Josn array
	*
	*/
	public function map()
	{
		$this->output->unset_template();
		$json = array();
		
		$this->load->library('currency');
		$results = $this->sales_report->getTotalOrdersByCountry();
		
		foreach ($results as $result) {
			$json[strtolower($result['iso_code_2'])] = array(
				'total'  => $result['total'],
				'amount' => $this->currency->format($result['amount'], $this->common->config('config_currency'))
			);
		}

		
		echo json_encode($json);
	}
	
	/**
	* 
	* @function name : chart()
	* @description   : generate chart datewise
	* @param   		 : void
	* @return        : Josn array
	*
	*/
	public function chart()
	{
		//unset template
		$this->output->unset_template();
		$json['order']['label'] = 'Orders';
		$json['customer']['label'] = 'Customers';
		$json['order']['data'] = array();
		$json['customer']['data'] = array();
		//get range selection
		if ($this->input->post('range')!=NULL) {
			$range = $this->input->post('range');
		} else {
			$range = 'day';
		}
		
		// match condition
		switch ($range) {
			default:
			case 'day':
				$results = $this->sales_report->getTotalOrdersByDay();

				foreach ($results as $key => $value) {
					$json['order']['data'][] = array($key, $value['total']);
				}

				$results = $this->customer_report->getTotalCustomersByDay();

				foreach ($results as $key => $value) {
					$json['customer']['data'][] = array($key, $value['total']);
				}

				for ($i = 0; $i < 24; $i++) {
					$json['xaxis'][] = array($i, $i);
				}
				break;
			case 'week':
				$results = $this->sales_report->getTotalOrdersByWeek();

				foreach ($results as $key => $value) {
					$json['order']['data'][] = array($key, $value['total']);
				}

				$results = $this->customer_report->getTotalCustomersByWeek();

				foreach ($results as $key => $value) {
					$json['customer']['data'][] = array($key, $value['total']);
				}

				$date_start = strtotime('-' . date('w') . ' days');

				for ($i = 0; $i < 7; $i++) {
					$date = date('Y-m-d', $date_start + ($i * 86400));

					$json['xaxis'][] = array(date('w', strtotime($date)), date('D', strtotime($date)));
				}
				break;
			case 'month':
				$results = $this->sales_report->getTotalOrdersByMonth();

				foreach ($results as $key => $value) {
					$json['order']['data'][] = array($key, $value['total']);
				}

				$results = $this->customer_report->getTotalCustomersByMonth();

				foreach ($results as $key => $value) {
					$json['customer']['data'][] = array($key, $value['total']);
				}

				for ($i = 1; $i <= date('t'); $i++) {
					$date = date('Y') . '-' . date('m') . '-' . $i;

					$json['xaxis'][] = array(date('j', strtotime($date)), date('d', strtotime($date)));
				}
				break;
			case 'year':
				$results = $this->sales_report->getTotalOrdersByYear();

				foreach ($results as $key => $value) {
					$json['order']['data'][] = array($key, $value['total']);
				}

				$results = $this->customer_report->getTotalCustomersByYear();

				foreach ($results as $key => $value) {
					$json['customer']['data'][] = array($key, $value['total']);
				}

				for ($i = 1; $i <= 12; $i++) {
					$json['xaxis'][] = array($i, date('M', mktime(0, 0, 0, $i)));
				}
				break;
		}
		echo json_encode($json);
	}
	
	/**
	* 
	* @function name : totalOrder()
	* @description   : Get total order
	* @param   		 : void
	* @return        : Josn array
	*
	*/
	
	public function totalOrders()
	{
		// Total Orders
		$this->load->model('sales/Orders_model','order');

		$today = $this->order->getTotalOrders(array('filter_date_added' => date('Y-m-d', strtotime('-1 day'))));

		$yesterday = $this->order->getTotalOrders(array('filter_date_added' => date('Y-m-d', strtotime('-2 day'))));

		$difference = $today - $yesterday;

		if ($difference && $today) {
			$data['percentage'] = round(($difference / $today) * 100);
		} else {
			$data['percentage'] = 0;
		}

		$order_total = $this->order->getTotalOrders();

		if ($order_total > 1000000000000) {
			$data['total'] = round($order_total / 1000000000000, 1) . 'T';
		} elseif ($order_total > 1000000000) {
			$data['total'] = round($order_total / 1000000000, 1) . 'B';
		} elseif ($order_total > 1000000) {
			$data['total'] = round($order_total / 1000000, 1) . 'M';
		} elseif ($order_total > 1000) {
			$data['total'] = round($order_total / 1000, 1) . 'K';
		} else {
			$data['total'] = $order_total;
		}

		return $data;
	}
	
	/**
	* 
	* @function name : totalSales()
	* @description   : get total sales
	* @param   		 : void
	* @return        : Josn array
	*
	*/
	public function totalSales()
	{
		$this->load->model('reports/Sales_report_model','sales');

		$today = $this->sales->getTotalSales(array('filter_date_added' => date('Y-m-d', strtotime('-1 day'))));

		$yesterday = $this->sales->getTotalSales(array('filter_date_added' => date('Y-m-d', strtotime('-2 day'))));

		$difference = $today - $yesterday;

		if ($difference && $today) {
			$data['percentage'] = round(($difference / $today) * 100);
		} else {
			$data['percentage'] = 0;
		}

		$sale_total = $this->sales->getTotalSales();

		if ($sale_total > 1000000000000) {
			$data['total'] = round($sale_total / 1000000000000, 1) . 'T';
		} elseif ($sale_total > 1000000000) {
			$data['total'] = round($sale_total / 1000000000, 1) . 'B';
		} elseif ($sale_total > 1000000) {
			$data['total'] = round($sale_total / 1000000, 1) . 'M';
		} elseif ($sale_total > 1000) {
			$data['total'] = round($sale_total / 1000, 1) . 'K';
		} else {
			$data['total'] = round($sale_total);
		}

		return $data;
	}
	
	/**
	* 
	* @function name : totalPurchase()
	* @description   : get total Purchase
	* @param   		 : void
	* @return        : Josn array
	*
	*/
	public function totalPurchase()
	{
		$this->load->model('purchase/purchase_model','purchase');

		$today = $this->purchase->getTotalPurchaseAmount(array('filter_date_added' => date('Y-m-d', strtotime('-1 day'))));

		$yesterday = $this->purchase->getTotalPurchaseAmount(array('filter_date_added' => date('Y-m-d', strtotime('-2 day'))));

		$difference = $today - $yesterday;

		if ($difference && $today) {
			$data['percentage'] = round(($difference / $today) * 100);
		} else {
			$data['percentage'] = 0;
		}

		$purchase_total = $this->purchase->getTotalPurchaseAmount();

		if ($purchase_total > 1000000000000) {
			$data['total'] = round($purchase_total / 1000000000000, 1) . 'T';
		} elseif ($purchase_total > 1000000000) {
			$data['total'] = round($purchase_total / 1000000000, 1) . 'B';
		} elseif ($purchase_total > 1000000) {
			$data['total'] = round($purchase_total / 1000000, 1) . 'M';
		} elseif ($purchase_total > 1000) {
			$data['total'] = round($purchase_total / 1000, 1) . 'K';
		} else {
			$data['total'] = round($purchase_total);
		}

		return $data;
	}
	
	/**
	* 
	* @function name : totalCustomers()
	* @description   : get total Customers
	* @param   		 : void
	* @return        : array
	*
	*/
	public function totalCustomers()
	{
	// Total Orders
		$this->load->model('customers/Customers_model','customer');

		$today = $this->customer->getTotalCustomer(array('filter_date_added' => date('Y-m-d', strtotime('-1 day'))));

		$yesterday = $this->customer->getTotalCustomer(array('filter_date_added' => date('Y-m-d', strtotime('-2 day'))));

		$difference = $today - $yesterday;

		if ($difference && $today) {
			$data['percentage'] = round(($difference / $today) * 100);
		} else {
			$data['percentage'] = 0;
		}

		$customer_total = $this->customer->getTotalCustomer();

		if ($customer_total > 1000000000000) {
			$data['total'] = round($customer_total / 1000000000000, 1) . 'T';
		} elseif ($customer_total > 1000000000) {
			$data['total'] = round($customer_total / 1000000000, 1) . 'B';
		} elseif ($customer_total > 1000000) {
			$data['total'] = round($customer_total / 1000000, 1) . 'M';
		} elseif ($customer_total > 1000) {
			$data['total'] = round($customer_total / 1000, 1) . 'K';
		} else {
			$data['total'] = $customer_total;
		}

		

		return $data;
	}
	
	/**
	* 
	* @function name : totalTickets()
	* @description   : get total Tickets
	* @param   		 : void
	* @return        : array
	*
	*/
	public function totalTickets()
	{
	// Total Orders
		$this->load->model('support/Ticket_model','support');

		$today = $this->support->getTotalTickets(array('filter_date_added' => date('Y-m-d', strtotime('-1 day'))));

		$yesterday = $this->support->getTotalTickets(array('filter_date_added' => date('Y-m-d', strtotime('-2 day'))));

		$difference = $today - $yesterday;

		if ($difference && $today) {
			$data['percentage'] = round(($difference / $today) * 100);
		} else {
			$data['percentage'] = 0;
		}

		$customer_total = $this->support->getTotalTickets();

		if ($customer_total > 1000000000000) {
			$data['total'] = round($customer_total / 1000000000000, 1) . 'T';
		} elseif ($customer_total > 1000000000) {
			$data['total'] = round($customer_total / 1000000000, 1) . 'B';
		} elseif ($customer_total > 1000000) {
			$data['total'] = round($customer_total / 1000000, 1) . 'M';
		} elseif ($customer_total > 1000) {
			$data['total'] = round($customer_total / 1000, 1) . 'K';
		} else {
			$data['total'] = $customer_total;
		}

		

		return $data;
	}
	
	/**
	* 
	* @function name : recentOrders()
	* @description   : get Recent 5 orders
	* @param   		 : void
	* @return        : array
	*
	*/
	public function recentOrders()
	{
		// Last 5 Orders
		$data['orders'] = array();

		$filter_data = array(
			'sort'  => 'o.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => 5
		);
		
		$this->load->model('sales/Orders_model','Orders_model');
		$this->load->library('currency');
		$results = $this->Orders_model->getOrders($filter_data);
		
		foreach ($results as $result) {
			$data['orders'][] = array(
				'order_id'   => $result['order_id'],
				'customer'   => $result['customer'],
				'status'     => $result['status'],
				'date_added' => date($this->common->config('config_date_format'), strtotime($result['date_added'])),
				'total'      => $this->currency->format($result['total'], $result['currency_code'], $result['currency_value']),
				'view'       => base_url('sales/orders/info/' . $this->commons->encode($result['order_id'])),
			);
		}

		return $data;
	}
	
	/*public function test()
	{
		echo "<pre>";
		print_r($_SESSION);
		echo "</pre>";
	}*/

	
}
