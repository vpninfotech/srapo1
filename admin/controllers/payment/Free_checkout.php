<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Payment_methods
* @Auther       : Nitin Sabhadiya
* @Date         : 19-01-2017
* @Description  : Payment methods Related Collection of functions
*
*/

class Free_checkout extends CI_Controller {

    private $data=array();
    private $error = array();

    function __construct()
    {
        parent::__construct();

        $this->rbac->CheckAuthentication();

        $this->_init();

        $this->lang->load('payment/free_checkout_lang', 'english');
		
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
			
                        $this->common->updatePaymentMethodStatus('free_checkout',$this->input->post('free_checkout_status'));
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
		

		$data['entry_Merchant_Id'] = $this->lang->line('entry_Merchant_Id');
		$data['entry_action'] = $this->lang->line('entry_action');
		$data['entry_total'] = $this->lang->line('entry_total');
		$data['entry_workingkey'] = $this->lang->line('entry_workingkey');
		$data['entry_access_code'] = $this->lang->line('entry_access_code');
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

 		if (isset($this->error['Merchant_Id'])) {
			$data['error_Merchant_Id'] = $this->error['Merchant_Id'];
		} else {
			$data['error_Merchant_Id'] = '';
		}
		if (isset($this->error['access_code'])) {
			$data['error_access_code'] = $this->error['access_code'];
		} else {
			$data['error_access_code'] = '';
		}
		if (isset($this->error['total'])) {
			$data['error_total'] = $this->error['total'];
		} else {
			$data['error_total'] = '';
		}
		if (isset($this->error['workingkey'])) {
			$data['error_workingkey'] = $this->error['workingkey'];
		} else {
			$data['error_workingkey'] = '';
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
           'href' => base_url('payment/free_checkout'),
        );

		$data['action'] = base_url('payment/free_checkout');

		$data['cancel'] = base_url('payment/payments');


		if ($this->input->post('free_checkout_Merchant_Id')!==NULL) {
			$data['free_checkout_Merchant_Id'] = $this->input->post('free_checkout_Merchant_Id');
		} else {
			$data['free_checkout_Merchant_Id'] = $this->common->config('free_checkout_Merchant_Id');
		}

			
		if ($this->input->post('free_checkout_total')!==NULL) {
			$data['free_checkout_total'] = $this->input->post('free_checkout_total');
		} else {
			$data['free_checkout_total'] = $this->common->config('free_checkout_total'); 
		} 
	
		if ($this->input->post('free_checkout_action')!==NULL) {
			$data['free_checkout_action'] = $this->input->post('free_checkout_action');
		} else {
			$data['free_checkout_action'] = $this->common->config('free_checkout_action'); 
		} 
		if ($this->input->post('free_checkout_access_code')!==NULL) {
			$data['free_checkout_access_code'] = $this->input->post('free_checkout_access_code');
		} else {
			$data['free_checkout_access_code'] = $this->common->config('free_checkout_access_code'); 
		} 
		
		if ($this->input->post('free_checkout_workingkey')!==NULL) {
			$data['free_checkout_workingkey'] = $this->input->post('free_checkout_workingkey');
		} else {
			$data['free_checkout_workingkey'] = $this->common->config('free_checkout_workingkey'); 
		} 

		
		if ($this->input->post('free_checkout_order_status')!==NULL) {
			$data['free_checkout_order_status'] = $this->input->post('free_checkout_order_status');
		} else {
			$data['free_checkout_order_status'] = $this->common->config('free_checkout_order_status');
		}	
		
			
		if ($this->input->post('free_checkout_failed_status_id')!==NULL) {
			$data['free_checkout_failed_status_id'] = $this->input->post('free_checkout_failed_status_id');
		} else {
			$data['free_checkout_failed_status_id'] = $this->common->config('free_checkout_failed_status_id');
		}	
								
		if ($this->input->post('free_checkout_pending_status_id')!==NULL) {
			$data['free_checkout_pending_status_id'] = $this->input->post('free_checkout_pending_status_id');
		} else {
			$data['free_checkout_pending_status_id'] = $this->common->config('free_checkout_pending_status_id');
		}
									
		

		if ($this->input->post('free_checkout_voided_status_id')!==NULL) {
			$data['free_checkout_voided_status_id'] = $this->input->post('free_checkout_voided_status_id');
		} else {
			$data['free_checkout_voided_status_id'] = $this->common->config('free_checkout_voided_status_id');
		}

		$this->load->model('system/order_status_model','order_status');

		$data['order_statuses'] = $this->order_status->getOrderStatuses();
		$this->load->model('payment/free_checkout_model','free_checkout');
		if ($this->input->post('free_checkout_payment_country_id')!==NULL) {
			$data['free_checkout_payment_country_id'] = $this->input->post('free_checkout_payment_country_id');
		} else {
			$data['free_checkout_payment_country_id'] = $this->free_checkout->getfree_checkoutCountries($this->common->config('free_checkout_payment_country_id'));
		}

		

		if ($this->input->post('free_checkout_checkout_method')!==NULL) {
			$data['free_checkout_checkout_method'] = $this->input->post('free_checkout_checkout_method');
		} else {
			$data['free_checkout_checkout_method'] = $this->common->config('free_checkout_checkout_method');
		}

		if ($this->input->post('free_checkout_status')!==NULL) {
			$data['free_checkout_status'] = $this->input->post('free_checkout_status');
		} else {
			$data['free_checkout_status'] = $this->common->config('free_checkout_status');
		}
		
		if ($this->input->post('free_checkout_sort_order')!==NULL) {
			$data['free_checkout_sort_order'] = $this->input->post('free_checkout_sort_order');
		} else {
			$data['free_checkout_sort_order'] = $this->common->config('free_checkout_sort_order');
		}
		//echo '<pre>';print_r($data);die;
		$admin_theme = $this->common->config('admin_theme');
        $content_page="themes/".$admin_theme."/payment/free_checkout";
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


