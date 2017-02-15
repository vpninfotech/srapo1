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

private $data=[];

	function __construct()
	{
		parent::__construct();

		$this->rbac->CheckAuthentication();

		$this->_init();
                
                $this->load->model('reports/Ticket_report_model','ticket_report');
                
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
		$this->output->set_template('support_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Dashboard','sarpo','This is srapo Dashboard page');

	}

	function send_email() {

    $this->load->library('email');

    $this->email->set_newline("\r\n");

    $config['protocol'] = "smtp";
    $config['smtp_host'] = "ssl://smtp.googlemail.com";
    $config['smtp_port'] = 465;
    $config['smtp_user'] = "pmvpnweb@gmail.com";
    $config['smtp_from_name'] = "Nitin Sabhadiya";
    $config['smtp_pass'] = "nearvillage";
    $config['smtp_timeout'] = 5;
    $config['wordwrap'] = TRUE;
    $config['newline'] = "\r\n";
    $config['mailtype'] = "html";                       

    $this->email->initialize($config);

    $this->email->from($config['smtp_user'], $config['smtp_from_name']);
    $this->email->to('nc@vpninfotech.com');
   // $this->email->cc($attributes['cc']);
    //$this->email->bcc($attributes['cc']);
    $this->email->subject('test');

    $this->email->message('wel done');

    if($this->email->send()) {
        return true;        
    } else {
        return false;
    }       
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
                        
                 //$this->send_email();

		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Dashboard',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
                
                $this->data['ticket']=$this->totalTickets();
                $this->data['operator_ticket']=$this->totalOperatorTickets();
                $this->data['manufacturer_ticket']=$this->totalManufacturerTickets();
                $this->data['finance_ticket']=$this->totalFinanceTickets();
                $this->data['logistic_ticket']=$this->totalLogisticTickets();
                $this->data['customer_ticket']=$this->totalCustomerTickets();
                $this->data['marketor_ticket']=$this->totalMarketorTickets();
		$this->data['tickets']=$this->recentTickets();
		 
			
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
		$json['ticket']['label'] = 'Tickets';
		//$json['customer']['label'] = 'Customers';
		$json['ticket']['data'] = array();
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
				$results = $this->ticket_report->getTotalTicketsByDay();

				foreach ($results as $key => $value) {
					$json['ticket']['data'][] = array($key, $value['total']);
				}

				for ($i = 0; $i < 24; $i++) {
					$json['xaxis'][] = array($i, $i);
				}
				break;
			case 'week':
				$results = $this->ticket_report->getTotalTicketsByWeek();

				foreach ($results as $key => $value) {
					$json['ticket']['data'][] = array($key, $value['total']);
				}
				
				$date_start = strtotime('-' . date('w') . ' days');

				for ($i = 0; $i < 7; $i++) {
					$date = date('Y-m-d', $date_start + ($i * 86400));

					$json['xaxis'][] = array(date('w', strtotime($date)), date('D', strtotime($date)));
				}
				break;
			case 'month':
				$results = $this->ticket_report->getTotalTicketsByMonth();

				foreach ($results as $key => $value) {
					$json['ticket']['data'][] = array($key, $value['total']);
				}

				for ($i = 1; $i <= date('t'); $i++) {
					$date = date('Y') . '-' . date('m') . '-' . $i;

					$json['xaxis'][] = array(date('j', strtotime($date)), date('d', strtotime($date)));
				}
				break;
			case 'year':
				$results = $this->ticket_report->getTotalTicketsByYear();

				foreach ($results as $key => $value) {
					$json['ticket']['data'][] = array($key, $value['total']);
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
	* @function name : totalTickets()
	* @description   : Get total ticket
	* @param   		 : void
	* @return        : Json array
	*
	*/
        public function totalTickets()
	{
		$ticket_total = $this->ticket_report->getTotalTicket();

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
	* @function name : totalOperatorTickets()
	* @description   : Get total Operator Tickets
	* @param   		 : void
	* @return        : Json array
	*
	*/
        public function totalOperatorTickets()
	{
		$operator_ticket_total = $this->ticket_report->getTotalOperatorTickets();

		if ($operator_ticket_total > 1000000000000) {
			$data['total'] = round($operator_ticket_total / 1000000000000, 1) . 'T';
		} elseif ($operator_ticket_total > 1000000000) {
			$data['total'] = round($operator_ticket_total / 1000000000, 1) . 'B';
		} elseif ($operator_ticket_total > 1000000) {
			$data['total'] = round($operator_ticket_total / 1000000, 1) . 'M';
		} elseif ($operator_ticket_total > 1000) {
			$data['total'] = round($operator_ticket_total / 1000, 1) . 'K';
		} else {
			$data['total'] = $operator_ticket_total;
		}

		return $data;
	}
	
	/**
	* 
	* @function name : totalManufacturerTickets()
	* @description   : Get total Manufacturer Tickets
	* @param   		 : void
	* @return        : Json array
	*
	*/
        public function totalManufacturerTickets()
	{
		$manufacturer_ticket_total = $this->ticket_report->getTotalManufacturerTickets();

		if ($manufacturer_ticket_total > 1000000000000) {
			$data['total'] = round($manufacturer_ticket_total / 1000000000000, 1) . 'T';
		} elseif ($manufacturer_ticket_total > 1000000000) {
			$data['total'] = round($manufacturer_ticket_total / 1000000000, 1) . 'B';
		} elseif ($manufacturer_ticket_total > 1000000) {
			$data['total'] = round($manufacturer_ticket_total / 1000000, 1) . 'M';
		} elseif ($manufacturer_ticket_total > 1000) {
			$data['total'] = round($manufacturer_ticket_total / 1000, 1) . 'K';
		} else {
			$data['total'] = $manufacturer_ticket_total;
		}

		return $data;
	}
        
        /**
	* 
	* @function name : totalFinanceTickets()
	* @description   : Get total Manufacturer Tickets
	* @param   		 : void
	* @return        : Json array
	*
	*/
        public function totalFinanceTickets()
	{
		$finance_ticket_total = $this->ticket_report->getTotalFinanceTickets();

		if ($finance_ticket_total > 1000000000000) {
			$data['total'] = round($finance_ticket_total / 1000000000000, 1) . 'T';
		} elseif ($finance_ticket_total > 1000000000) {
			$data['total'] = round($finance_ticket_total / 1000000000, 1) . 'B';
		} elseif ($finance_ticket_total > 1000000) {
			$data['total'] = round($finance_ticket_total / 1000000, 1) . 'M';
		} elseif ($finance_ticket_total > 1000) {
			$data['total'] = round($finance_ticket_total / 1000, 1) . 'K';
		} else {
			$data['total'] = $finance_ticket_total;
		}

		return $data;
	}
        
        /**
	* 
	* @function name : totalLogisticTickets()
	* @description   : Get total Logistic Tickets
	* @param   		 : void
	* @return        : Json array
	*
	*/
        public function totalLogisticTickets()
	{
		$logistic_ticket_total = $this->ticket_report->getTotalLogisticTickets();

		if ($logistic_ticket_total > 1000000000000) {
			$data['total'] = round($logistic_ticket_total / 1000000000000, 1) . 'T';
		} elseif ($logistic_ticket_total > 1000000000) {
			$data['total'] = round($logistic_ticket_total / 1000000000, 1) . 'B';
		} elseif ($logistic_ticket_total > 1000000) {
			$data['total'] = round($logistic_ticket_total / 1000000, 1) . 'M';
		} elseif ($logistic_ticket_total > 1000) {
			$data['total'] = round($logistic_ticket_total / 1000, 1) . 'K';
		} else {
			$data['total'] = $logistic_ticket_total;
		}

		return $data;
	}
        
        /**
	* 
	* @function name : totalCustomerTickets()
	* @description   : Get total Customer Tickets
	* @param   		 : void
	* @return        : Json array
	*
	*/
        public function totalCustomerTickets()
	{
		$customer_ticket_total = $this->ticket_report->getTotalCustomerTickets();

		if ($customer_ticket_total > 1000000000000) {
			$data['total'] = round($customer_ticket_total / 1000000000000, 1) . 'T';
		} elseif ($customer_ticket_total > 1000000000) {
			$data['total'] = round($customer_ticket_total / 1000000000, 1) . 'B';
		} elseif ($customer_ticket_total > 1000000) {
			$data['total'] = round($customer_ticket_total / 1000000, 1) . 'M';
		} elseif ($customer_ticket_total > 1000) {
			$data['total'] = round($customer_ticket_total / 1000, 1) . 'K';
		} else {
			$data['total'] = $customer_ticket_total;
		}

		return $data;
	}
        
        /**
	* 
	* @function name : totalMarketorTickets()
	* @description   : Get total Marketor Tickets
	* @param   		 : void
	* @return        : Json array
	*
	*/
        public function totalMarketorTickets()
	{
		$marketor_ticket_total = $this->ticket_report->getTotalMarketorTickets();

		if ($marketor_ticket_total > 1000000000000) {
			$data['total'] = round($marketor_ticket_total / 1000000000000, 1) . 'T';
		} elseif ($marketor_ticket_total > 1000000000) {
			$data['total'] = round($marketor_ticket_total / 1000000000, 1) . 'B';
		} elseif ($marketor_ticket_total > 1000000) {
			$data['total'] = round($marketor_ticket_total / 1000000, 1) . 'M';
		} elseif ($marketor_ticket_total > 1000) {
			$data['total'] = round($marketor_ticket_total / 1000, 1) . 'K';
		} else {
			$data['total'] = $marketor_ticket_total;
		}

		return $data;
	}
        
        /**
	* 
	* @function name : recentTickets()
	* @description   : get Recent 5 orders
	* @param   		 : void
	* @return        : array
	*
	*/
	public function recentTickets()
	{
		// Last 5 Orders
		$data['tickets'] = array();

		$filter_data = array(
			'sort'  => 't.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => 5
		);
		
		//$this->load->model('support/Ticket_model','ticket_model');
		//$this->load->library('currency');
                $this->load->library('commons');
                
		$results = $this->ticket_report->getAllTicket();
		
                
		foreach ($results as $result) {
			$data['ticket'][] = array(
				'ticket_id'         => $result['ticket_code'],
				'department'        => $result['RoleName'],
                                'title'             => $result['title'],
				'date_added'        => date($this->common->config('config_date_format'), strtotime($result['date_added'])),	
				'view'              => base_url('support/tickets/ticketdetail/'.$this->commons->encode($result['ticket_id'])),
			);
		}

		return $data;
	}
}
