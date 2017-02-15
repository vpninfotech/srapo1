<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Payment_methods
* @Auther       : Nitin Sabhadiya
* @Date         : 19-01-2017
* @Description  : Payment methods Related Collection of functions
*
*/

class Pick_pay extends CI_Controller {

    private $data=array();
    private $error = array();

    function __construct()
    {
        parent::__construct();

        $this->rbac->CheckAuthentication();

        $this->_init();

        $this->lang->load('payment/pick_pay_lang', 'english');
		
		$this->load->model('system/settings_model','setting');
		
		$this->load->model('system/country_model','country');
		
        $this->load->model('common');
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
     
    }
	
    /**
    * 
    * @function name : index()
    * @description   : load zone view
    * @param   		 : void
    * @return        : void
    *
    */
    public function index()	
    {
		
		if(($this->input->server('REQUEST_METHOD') == 'POST')) {
			echo 'hi';
			$this->setting->save();
			
                        $this->common->updatePaymentMethodStatus('pick_pay',$this->input->post('pick_pay_status'));
			$this->session->set_userdata('success',$this->lang->line('text_success'));

			redirect(base_url('payment/payments'));
		}
		
		$data['heading_title'] = $this->lang->line('heading_title');

		$data['text_enabled'] = $this->lang->line('text_enabled');
		$data['text_disabled'] = $this->lang->line('text_disabled');
		$data['text_all_zones'] = $this->lang->line('text_all_zones');
		$data['text_yes'] = $this->lang->line('text_yes');
		$data['text_no'] = $this->lang->line('text_no');
		$data['text_redirect'] = $this->lang->line('text_redirect');
		$data['text_iframe'] = $this->lang->line('text_iframe');
		$data['text_edit'] = $this->lang->line('text_edit');
		

		
		$data['entry_completed_status'] = $this->lang->line('entry_completed_status');
		$data['entry_failed_status'] = $this->lang->line('entry_failed_status');
		$data['entry_pending_status'] = $this->lang->line('entry_pending_status');
		$data['entry_geo_zone'] = $this->lang->line('entry_geo_zone');
		$data['entry_status'] = $this->lang->line('entry_status');
		$data['entry_sort_order'] = $this->lang->line('entry_sort_order');
		$data['entry_checkout_method'] = $this->lang->line('entry_checkout_method');
		
		$data['help_checkout_method'] = $this->lang->line('help_checkout_method');
		$data['help_total'] = $this->lang->line('help_total');
		$data['help_workingkey'] = $this->lang->line('help_workingkey');

		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}


		
        // breadcrumbs
        $data['breadcrumbs']   	= array();
        $data['breadcrumbs'][] 	= array(
           'text' => '<i class="fa fa-dashboard"></i> Home',
           'href' => base_url('dashboard/dashboard'),

        );
        
        $data['breadcrumbs'][] = array(
           'text' => 'Payment Methods',
           'href' => base_url('payment/payments'),
        );
		
		$data['breadcrumbs'][] = array(
           'text' => $this->lang->line('heading_title'),
           'href' => base_url('payment/pick_pay'),
        );

		$data['action'] = base_url('payment/pick_pay');

		$data['cancel'] = base_url('payment/payments');

	
		
		
		

		
		if ($this->input->post('pick_pay_order_status')!==NULL) {
			$data['pick_pay_order_status'] = $this->input->post('pick_pay_order_status');
		} else {
			$data['pick_pay_order_status'] = $this->common->config('pick_pay_order_status');
		}	
		

		$this->load->model('system/order_status_model','order_status');

		$data['order_statuses'] = $this->order_status->getOrderStatuses();
		$this->load->model('payment/pick_pay_model','pick_pay');
		if ($this->input->post('pick_pay_payment_country_id')!==NULL) {
			$data['pick_pay_payment_country_id'] = $this->input->post('pick_pay_payment_country_id');
		} else {
			$data['pick_pay_payment_country_id'] = $this->pick_pay->getpick_payCountries($this->common->config('pick_pay_payment_country_id'));
		}

		

		if ($this->input->post('pick_pay_checkout_method')!==NULL) {
			$data['pick_pay_checkout_method'] = $this->input->post('pick_pay_checkout_method');
		} else {
			$data['pick_pay_checkout_method'] = $this->common->config('pick_pay_checkout_method');
		}

		if ($this->input->post('pick_pay_status')!==NULL) {
			$data['pick_pay_status'] = $this->input->post('pick_pay_status');
		} else {
			$data['pick_pay_status'] = $this->common->config('pick_pay_status');
		}
		
		if ($this->input->post('pick_pay_sort_order')!==NULL) {
			$data['pick_pay_sort_order'] = $this->input->post('pick_pay_sort_order');
		} else {
			$data['pick_pay_sort_order'] = $this->common->config('pick_pay_sort_order');
		}
		//echo '<pre>';print_r($data);die;
		$admin_theme = $this->common->config('admin_theme');
        $content_page="themes/".$admin_theme."/payment/pick_pay";
        $this->load->view($content_page,$data);
	}
    
	
	public function autocomplete() {
        $this->output->unset_template();
        $json = array();
			
        if ($this->input->post('payment_country')!==NULL) {
            $filter_name = $this->input->post('payment_country');
        } else {
            $filter_name = '';
        }
        
        $filter_data = array(
            'filter_name'  => $filter_name,
            'start'        => 0,
            'limit'        => 5
        );

        $results = $this->country->getCountries($filter_data);                       

        foreach ($results as $result) {
            $json[] = array(
                'country_id'    => $result['country_id'],
                'country_name'  => $result['country_name'],
            );
        }
		
        $sort_order = array();

        foreach ($json as $key => $value) {
                $sort_order[$key] = $value['country_name'];
        }

        array_multisort($sort_order, SORT_ASC, $json);
                
        echo json_encode($json);
    }
}


