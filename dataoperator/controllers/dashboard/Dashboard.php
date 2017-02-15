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
                
		$this->_init();
                
                 $this->load->model('reports/Product_upload_report_model','product_upload');
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
		$this->output->set_template('dataoperator_template');
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
	public function index()	{

		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Dashboard',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		
		$this->data['totalProduct']=$this->totalProduct();
		$this->data['totalActiveProduct']=$this->totalActiveProduct();	
                $this->data['totalInactiveProduct']=$this->totalInactiveProduct();
                $this->data['tickets']=$this->totalTickets();
                $this->data['products']=$this->recentProducts();
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
		$json['product']['label'] = 'Products';
		//$json['customer']['label'] = 'Customers';
		$json['product']['data'] = array();
		//$json['customer']['data'] = array();
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
				$results = $this->product_upload->getTotalProductsByDay();

				foreach ($results as $key => $value) {
					$json['product']['data'][] = array($key, $value['total']);
				}
                                for ($i = 0; $i < 24; $i++) {
					$json['xaxis'][] = array($i, $i);
				}
				break;
			case 'week':
				$results = $this->product_upload->getTotalProductsByWeek();

				foreach ($results as $key => $value) {
					$json['product']['data'][] = array($key, $value['total']);
				}

				$date_start = strtotime('-' . date('w') . ' days');

				for ($i = 0; $i < 7; $i++) {
					$date = date('Y-m-d', $date_start + ($i * 86400));

					$json['xaxis'][] = array(date('w', strtotime($date)), date('D', strtotime($date)));
				}
				break;
			case 'month':
				$results = $this->product_upload->getTotalProductsByMonth();

				foreach ($results as $key => $value) {
					$json['product']['data'][] = array($key, $value['total']);
				}

				for ($i = 1; $i <= date('t'); $i++) {
					$date = date('Y') . '-' . date('m') . '-' . $i;

					$json['xaxis'][] = array(date('j', strtotime($date)), date('d', strtotime($date)));
				}
				break;
			case 'year':
				$results = $this->product_upload->getTotalProductsByYear();

				foreach ($results as $key => $value) {
					$json['product']['data'][] = array($key, $value['total']);
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
	* @function name : totalProduct()
	* @description   : Get total product
	* @param   		 : void
	* @return        : Json array
	*
	*/
	
	public function totalProduct()
	{
            // Total Product
            //$this->load->model('reports/Product_upload_report_model','product_upload');

            $today = $this->product_upload->getTotalProduct(array('filter_date_added' => date('Y-m-d', strtotime('-1 day'))));

            $yesterday = $this->product_upload->getTotalProduct(array('filter_date_added' => date('Y-m-d', strtotime('-2 day'))));

            $difference = $today - $yesterday;

            if ($difference && $today) {
                    $data['percentage'] = round(($difference / $today) * 100);
            } else {
                    $data['percentage'] = 0;
            }

            $product_total = $this->product_upload->getTotalProduct();

            if ($product_total > 1000000000000) {
                    $data['total'] = round($product_total / 1000000000000, 1) . 'T';
            } elseif ($product_total > 1000000000) {
                    $data['total'] = round($product_total / 1000000000, 1) . 'B';
            } elseif ($product_total > 1000000) {
                    $data['total'] = round($product_total / 1000000, 1) . 'M';
            } elseif ($product_total > 1000) {
                    $data['total'] = round($product_total / 1000, 1) . 'K';
            } else {
                    $data['total'] = $product_total;
            }

            return $data;
	}
        
        /**
	* 
	* @function name : totalActiveProduct()
	* @description   : Get total active product
	* @param   		 : void
	* @return        : Json array
	*
	*/
	
	public function totalActiveProduct()
	{
            // Total Active Product
            //$this->load->model('reports/Product_upload_report_model','product_upload');

            $today = $this->product_upload->totalActiveProduct(array('filter_date_added' => date('Y-m-d', strtotime('-1 day'))));

            $yesterday = $this->product_upload->totalActiveProduct(array('filter_date_added' => date('Y-m-d', strtotime('-2 day'))));

            $difference = $today - $yesterday;

            if ($difference && $today) {
                    $data['percentage'] = round(($difference / $today) * 100);
            } else {
                    $data['percentage'] = 0;
            }

            $active_product_total = $this->product_upload->totalActiveProduct();
            
            if ($active_product_total > 1000000000000) {
                    $data['total'] = round($active_product_total / 1000000000000, 1) . 'T';
            } elseif ($active_product_total > 1000000000) {
                    $data['total'] = round($active_product_total / 1000000000, 1) . 'B';
            } elseif ($active_product_total > 1000000) {
                    $data['total'] = round($active_product_total / 1000000, 1) . 'M';
            } elseif ($active_product_total > 1000) {
                    $data['total'] = round($active_product_total / 1000, 1) . 'K';
            } else {
                    $data['total'] = $active_product_total;
            }

            return $data;
	}
        
        /**
	* 
	* @function name : totalInactiveProduct()
	* @description   : Get total inactive product
	* @param   		 : void
	* @return        : Json array
	*
	*/
	
	public function totalInactiveProduct()
	{
            // Total Active Product
            //$this->load->model('reports/Product_upload_report_model','product_upload');

            $today = $this->product_upload->totalInactiveProduct(array('filter_date_added' => date('Y-m-d', strtotime('-1 day'))));

            $yesterday = $this->product_upload->totalInactiveProduct(array('filter_date_added' => date('Y-m-d', strtotime('-2 day'))));

            $difference = $today - $yesterday;

            if ($difference && $today) {
                    $data['percentage'] = round(($difference / $today) * 100);
            } else {
                    $data['percentage'] = 0;
            }

            $inactive_product_total = $this->product_upload->totalInactiveProduct();
            
            if ($inactive_product_total > 1000000000000) {
                    $data['total'] = round($inactive_product_total / 1000000000000, 1) . 'T';
            } elseif ($inactive_product_total > 1000000000) {
                    $data['total'] = round($inactive_product_total / 1000000000, 1) . 'B';
            } elseif ($inactive_product_total > 1000000) {
                    $data['total'] = round($inactive_product_total / 1000000, 1) . 'M';
            } elseif ($inactive_product_total > 1000) {
                    $data['total'] = round($inactive_product_total / 1000, 1) . 'K';
            } else {
                    $data['total'] = $inactive_product_total;
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

		$ticket_total = $this->support->getTotalTickets();

		if ($ticket_total > 1000000000000) {
			$data['total'] = round($ticket_total / 1000000000000, 1) . 'T';
		} elseif ($ticket_total > 1000000000) {
			$data['total'] = round($ticket_total / 1000000000, 1) . 'B';
		} elseif ($ticket_total > 1000000) {
			$data['total'] = round($ticket_total / 1000000, 1) . 'M';
		} elseif ($ticket_total > 1000) {
			$data['total'] = round($ticket_total / 1000, 1) . 'K';
		} else {
			$data['total'] = $ticket_total;
		}

		

		return $data;
	}
        
        /**
	* 
	* @function name : recentProducts()
	* @description   : get Recent 5 orders
	* @param   		 : void
	* @return        : array
	*
	*/
	public function recentProducts()
	{
		// Last 5 Orders
		$data['products'] = array();

		$filter_data = array(
			'sort'  => 'p.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => 10
		);
		
		$this->load->model('catalog/Product_model','product_model');
		//$this->load->library('currency');
                $this->load->library('commons');
                $this->load->model('tool/image');
		$results = $this->product_model->getProducts($filter_data);
		
                
		foreach ($results as $result) {
                    if (is_file(DIR_IMAGE . $result['image'])) {                
                        $image = $this->image->resize($result['image'], 500, 500);
                    } else {
                        $image = $this->image->resize('no_image.png', 500, 500);
                    }
			$data['products'][] = array(
				'product_id'        => $result['product_id'],
                                'image'             => $image,
				'model'             => $result['model'],
                                'product_name'      => $result['product_name'],
                                'price'             => $result['price'],
				'status'            => $result['status'],
				'date_added'        => date($this->common->config('config_date_format'), strtotime($result['date_added'])),	
				'view'              => base_url('catalog/product/edit' . '/' . $this->commons->encode($result['product_id'])),
			);
		}

		return $data;
	}
	
	
}
