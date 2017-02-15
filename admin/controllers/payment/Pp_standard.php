<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Payment_methods
* @Auther       : Nitin Sabhadiya
* @Date         : 19-01-2017
* @Description  : Payment methods Related Collection of functions
*
*/

class Pp_standard extends CI_Controller {


    function __construct()
    {
        parent::__construct();

        $this->rbac->CheckAuthentication();

        $this->_init();

        $this->lang->load('payment/pp_standard_lang', 'english');
		
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
		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
			
			$this->setting->save();
                      
                         $this->common->updatePaymentMethodStatus('pp_standard',$this->input->post('pp_standard_status'));
 
			$this->session->set_userdata('success',$this->lang->line('text_success'));

			redirect(base_url('payment/payments'));
		}
		
		$data['heading_title'] = $this->lang->line('heading_title');

		$data['text_edit'] = $this->lang->line('text_edit');
		$data['text_enabled'] = $this->lang->line('text_enabled');
		$data['text_disabled'] = $this->lang->line('text_disabled');
		$data['text_all_zones'] = $this->lang->line('text_all_zones');
		$data['text_yes'] = $this->lang->line('text_yes');
		$data['text_no'] = $this->lang->line('text_no');
		$data['text_authorization'] = $this->lang->line('text_authorization');
		$data['text_sale'] = $this->lang->line('text_sale');

		$data['entry_email'] = $this->lang->line('entry_email');
		$data['entry_test'] = $this->lang->line('entry_test');
		$data['entry_transaction'] = $this->lang->line('entry_transaction');
		$data['entry_debug'] = $this->lang->line('entry_debug');
		$data['entry_total'] = $this->lang->line('entry_total');
		$data['entry_canceled_reversal_status'] = $this->lang->line('entry_canceled_reversal_status');
		$data['entry_completed_status'] = $this->lang->line('entry_completed_status');
		$data['entry_denied_status'] = $this->lang->line('entry_denied_status');
		$data['entry_expired_status'] = $this->lang->line('entry_expired_status');
		$data['entry_failed_status'] = $this->lang->line('entry_failed_status');
		$data['entry_pending_status'] = $this->lang->line('entry_pending_status');
		$data['entry_processed_status'] = $this->lang->line('entry_processed_status');
		$data['entry_refunded_status'] = $this->lang->line('entry_refunded_status');
		$data['entry_reversed_status'] = $this->lang->line('entry_reversed_status');
		$data['entry_voided_status'] = $this->lang->line('entry_voided_status');
		$data['entry_geo_zone'] = $this->lang->line('entry_geo_zone');
		$data['entry_status'] = $this->lang->line('entry_status');
		$data['entry_sort_order'] = $this->lang->line('entry_sort_order');

		$data['help_test'] = $this->lang->line('help_test');
		$data['help_debug'] = $this->lang->line('help_debug');
		$data['help_total'] = $this->lang->line('help_total');

		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');

		$data['tab_general'] = $this->lang->line('tab_general');
		$data['tab_order_status'] = $this->lang->line('tab_order_status');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
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
           'href' => base_url('payment/pp_standard'),
        );
		
		$data['action'] = base_url('payment/pp_standard');

		$data['cancel'] = base_url('payment/payments');
		
		if ($this->input->post('pp_standard_email')!==NULL) {
			$data['pp_standard_email'] = $this->input->post('pp_standard_email');
		} else {
			$data['pp_standard_email'] = $this->common->config('pp_standard_email');
		}

		if ($this->input->post('pp_standard_test')!==NULL) {
			$data['pp_standard_test'] = $this->input->post('pp_standard_test');
		} else {
			$data['pp_standard_test'] = $this->common->config('pp_standard_test');
		}

		if ($this->input->post('pp_standard_transaction')!==NULL) {
			$data['pp_standard_transaction'] = $this->input->post('pp_standard_transaction');
		} else {
			$data['pp_standard_transaction'] = $this->common->config('pp_standard_transaction');
		}

		if ($this->input->post('pp_standard_debug')!==NULL) {
			$data['pp_standard_debug'] = $this->input->post('pp_standard_debug');
		} else {
			$data['pp_standard_debug'] = $this->common->config('pp_standard_debug');
		}

		if ($this->input->post('pp_standard_total')!==NULL) {
			$data['pp_standard_total'] = $this->input->post('pp_standard_total');
		} else {
			$data['pp_standard_total'] = $this->common->config('pp_standard_total');
		}

		if ($this->input->post('pp_standard_canceled_reversal_status_id')!==NULL) {
			$data['pp_standard_canceled_reversal_status_id'] = $this->input->post('pp_standard_canceled_reversal_status_id');
		} else {
			$data['pp_standard_canceled_reversal_status_id'] = $this->common->config('pp_standard_canceled_reversal_status_id');
		}

		if ($this->input->post('pp_standard_completed_status_id')!==NULL) {
			$data['pp_standard_completed_status_id'] = $this->input->post('pp_standard_completed_status_id');
		} else {
			$data['pp_standard_completed_status_id'] = $this->common->config('pp_standard_completed_status_id');
		}

		if ($this->input->post('pp_standard_denied_status_id')!==NULL) {
			$data['pp_standard_denied_status_id'] = $this->input->post('pp_standard_denied_status_id');
		} else {
			$data['pp_standard_denied_status_id'] = $this->common->config('pp_standard_denied_status_id');
		}

		if ($this->input->post('pp_standard_expired_status_id')!==NULL) {
			$data['pp_standard_expired_status_id'] = $this->input->post('pp_standard_expired_status_id');
		} else {
			$data['pp_standard_expired_status_id'] = $this->common->config('pp_standard_expired_status_id');
		}

		if ($this->input->post('pp_standard_failed_status_id')!==NULL) {
			$data['pp_standard_failed_status_id'] = $this->input->post('pp_standard_failed_status_id');
		} else {
			$data['pp_standard_failed_status_id'] = $this->common->config('pp_standard_failed_status_id');
		}

		if ($this->input->post('pp_standard_pending_status_id')!==NULL) {
			$data['pp_standard_pending_status_id'] = $this->input->post('pp_standard_pending_status_id');
		} else {
			$data['pp_standard_pending_status_id'] = $this->common->config('pp_standard_pending_status_id');
		}

		if ($this->input->post('pp_standard_processed_status_id')!==NULL) {
			$data['pp_standard_processed_status_id'] = $this->input->post('pp_standard_processed_status_id');
		} else {
			$data['pp_standard_processed_status_id'] = $this->common->config('pp_standard_processed_status_id');
		}

		if ($this->input->post('pp_standard_refunded_status_id')!==NULL) {
			$data['pp_standard_refunded_status_id'] = $this->input->post('pp_standard_refunded_status_id');
		} else {
			$data['pp_standard_refunded_status_id'] = $this->common->config('pp_standard_refunded_status_id');
		}

		if ($this->input->post('pp_standard_reversed_status_id')!==NULL) {
			$data['pp_standard_reversed_status_id'] = $this->input->post('pp_standard_reversed_status_id');
		} else {
			$data['pp_standard_reversed_status_id'] = $this->common->config('pp_standard_reversed_status_id');
		}

		if ($this->input->post('pp_standard_voided_status_id')!==NULL) {
			$data['pp_standard_voided_status_id'] = $this->input->post('pp_standard_voided_status_id');
		} else {
			$data['pp_standard_voided_status_id'] = $this->common->config('pp_standard_voided_status_id');
		}

		$this->load->model('system/order_status_model','order_status');

		$data['order_statuses'] = $this->order_status->getOrderStatuses();
		
        $this->load->model('payment/Pp_standard_model','pp_standard');
		
		if ($this->input->post('pp_standard_payment_country_id')!==NULL) {
			$data['pp_standard_payment_country_id'] = $this->input->post('pp_standard_payment_country_id');
		} else {
			$data['pp_standard_payment_country_id'] = $this->pp_standard->getPP_StandardCountries($this->common->config('pp_standard_payment_country_id'));
		}

		

		if ($this->input->post('pp_standard_status')!==NULL) {
			$data['pp_standard_status'] = $this->input->post('pp_standard_status');
		} else {
			$data['pp_standard_status'] = $this->common->config('pp_standard_status');
		}

		if ($this->input->post('pp_standard_sort_order')!==NULL) {
			$data['pp_standard_sort_order'] = $this->input->post('pp_standard_sort_order');
		} else {
			$data['pp_standard_sort_order'] = $this->common->config('pp_standard_sort_order');
		}
		
		//echo '<pre>';print_r($data);die;
		$admin_theme = $this->common->config('admin_theme');
        $content_page="themes/".$admin_theme."/payment/pp_standard";
        $this->load->view($content_page,$data);
		
	}
	
	private function validateForm() {

		if (!$this->input->post('pp_standard_email')) {
			$this->error['email'] = $this->lang->line('error_email');
		}

		return !$this->error;
	}
	
	public function autocomplete() {
        $this->output->unset_template();
        $json = array();
			
        if ($this->input->post('pp_standard_country')!==NULL) {
            $filter_name = $this->input->post('pp_standard_country');
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


