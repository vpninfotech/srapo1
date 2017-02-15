<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Payment_methods
* @Auther       : Nitin Sabhadiya
* @Date         : 19-01-2017
* @Description  : Payment methods Related Collection of functions
*
*/

class Ccavenue extends CI_Controller {

    private $data=array();
    private $error = array();

    function __construct()
    {
        parent::__construct();

        $this->rbac->CheckAuthentication();

        $this->_init();

        $this->lang->load('payment/ccavenue_lang', 'english');
		
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
                        $this->common->updatePaymentMethodStatus('ccavenue',$this->input->post('ccavenue_status'));
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
           'href' => base_url('payment/ccavenue'),
        );

		$data['action'] = base_url('payment/ccavenue');

		$data['cancel'] = base_url('payment/payments');


		if ($this->input->post('ccavenue_Merchant_Id')!==NULL) {
			$data['ccavenue_Merchant_Id'] = $this->input->post('ccavenue_Merchant_Id');
		} else {
			$data['ccavenue_Merchant_Id'] = $this->common->config('ccavenue_Merchant_Id');
		}

			
		if ($this->input->post('ccavenue_total')!==NULL) {
			$data['ccavenue_total'] = $this->input->post('ccavenue_total');
		} else {
			$data['ccavenue_total'] = $this->common->config('ccavenue_total'); 
		} 
	
		if ($this->input->post('ccavenue_action')!==NULL) {
			$data['ccavenue_action'] = $this->input->post('ccavenue_action');
		} else {
			$data['ccavenue_action'] = $this->common->config('ccavenue_action'); 
		} 
		if ($this->input->post('ccavenue_access_code')!==NULL) {
			$data['ccavenue_access_code'] = $this->input->post('ccavenue_access_code');
		} else {
			$data['ccavenue_access_code'] = $this->common->config('ccavenue_access_code'); 
		} 
		
		if ($this->input->post('ccavenue_workingkey')!==NULL) {
			$data['ccavenue_workingkey'] = $this->input->post('ccavenue_workingkey');
		} else {
			$data['ccavenue_workingkey'] = $this->common->config('ccavenue_workingkey'); 
		} 

		
		if ($this->input->post('ccavenue_completed_status_id')!==NULL) {
			$data['ccavenue_completed_status_id'] = $this->input->post('ccavenue_completed_status_id');
		} else {
			$data['ccavenue_completed_status_id'] = $this->common->config('ccavenue_completed_status_id');
		}	
		
			
		if ($this->input->post('ccavenue_failed_status_id')!==NULL) {
			$data['ccavenue_failed_status_id'] = $this->input->post('ccavenue_failed_status_id');
		} else {
			$data['ccavenue_failed_status_id'] = $this->common->config('ccavenue_failed_status_id');
		}	
								
		if ($this->input->post('ccavenue_pending_status_id')!==NULL) {
			$data['ccavenue_pending_status_id'] = $this->input->post('ccavenue_pending_status_id');
		} else {
			$data['ccavenue_pending_status_id'] = $this->common->config('ccavenue_pending_status_id');
		}
									
		

		if ($this->input->post('ccavenue_voided_status_id')!==NULL) {
			$data['ccavenue_voided_status_id'] = $this->input->post('ccavenue_voided_status_id');
		} else {
			$data['ccavenue_voided_status_id'] = $this->common->config('ccavenue_voided_status_id');
		}

		$this->load->model('system/order_status_model','order_status');

		$data['order_statuses'] = $this->order_status->getOrderStatuses();
		$this->load->model('payment/Ccavenue_model','ccavenue');
		if ($this->input->post('ccavenue_payment_country_id')!==NULL) {
			$data['ccavenue_payment_country_id'] = $this->input->post('ccavenue_payment_country_id');
		} else {
			$data['ccavenue_payment_country_id'] = $this->ccavenue->getCcavenueCountries($this->common->config('ccavenue_payment_country_id'));
		}

		

		if ($this->input->post('ccavenue_checkout_method')!==NULL) {
			$data['ccavenue_checkout_method'] = $this->input->post('ccavenue_checkout_method');
		} else {
			$data['ccavenue_checkout_method'] = $this->common->config('ccavenue_checkout_method');
		}

		if ($this->input->post('ccavenue_status')!==NULL) {
			$data['ccavenue_status'] = $this->input->post('ccavenue_status');
		} else {
			$data['ccavenue_status'] = $this->common->config('ccavenue_status');
		}
		
		if ($this->input->post('ccavenue_sort_order')!==NULL) {
			$data['ccavenue_sort_order'] = $this->input->post('ccavenue_sort_order');
		} else {
			$data['ccavenue_sort_order'] = $this->common->config('ccavenue_sort_order');
		}
		//echo '<pre>';print_r($data);die;
		$admin_theme = $this->common->config('admin_theme');
        $content_page="themes/".$admin_theme."/payment/ccavenue";
        $this->load->view($content_page,$data);
	}
    
	/**
    * 
    * @function name : validateForm()
    * @description   : Validate Entered Form data
    * @param   		 : void
    * @return        : void
    *
    */
    private function validateForm() {
		if ($this->input->post('ccavenue_Merchant_Id')=='') {
			$this->error['Merchant_Id'] = $this->lang->line('error_Merchant_Id');
		}
		if ($this->input->post('ccavenue_Merchant_Id')=='') {
			$this->error['Merchant_Id'] = $this->lang->line('error_Merchant_Id');
		}
		if ($this->input->post('ccavenue_total')=='') {
			$this->error['total'] = $this->lang->line('error_total');
		}		
		if ($this->input->post('ccavenue_access_code')=='') {
			$this->error['access_code'] = $this->lang->line('error_access_code');
		}
		if ($this->input->post('ccavenue_workingkey')=='') {
			$this->error['workingkey'] = $this->lang->line('error_workingkey');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
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


