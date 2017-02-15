<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Payment_methods
* @Auther       : NItin Sabhadiya
* @Date         : 19-01-2017
* @Description  : Payment methods Related Collection of functions
*
*/

class Weight extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->rbac->CheckAuthentication();

        $this->_init();

        $this->load->model('shipping/weight_model','weight');

        $this->lang->load('shipping/weight_lang', 'english');
		
		$this->load->model('system/country_model','country');
		
		$this->load->model('system/settings_model','setting');

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
        $this->output->set_common_meta('Shipping Methods','sarpo','This is srapo Shipping methods page');
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
			
			$this->setting->editSetting($this->input->post());

			$this->session->set_userdata('success',$this->lang->line('text_success'));

			redirect(base_url('shipping/shipping'));
		}
		
		$data['heading_title'] = $this->lang->line('heading_title');
		
		$data['text_edit'] = $this->lang->line('text_edit');
		$data['text_none'] = $this->lang->line('text_none');
		$data['text_enabled'] = $this->lang->line('text_enabled');
		$data['text_disabled'] = $this->lang->line('text_disabled');

		$data['entry_rate'] = $this->lang->line('entry_rate');
		$data['entry_tax_class'] = $this->lang->line('entry_tax_class');
		$data['entry_status'] = $this->lang->line('entry_status');
		$data['entry_sort_order'] = $this->lang->line('entry_sort_order');

		$data['help_rate'] = $this->lang->line('help_rate');

		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');

		$data['tab_general'] = $this->lang->line('tab_general');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

        $data['breadcrumbs'][] 	= array(
           'text' => '<i class="fa fa-dashboard"></i> Home',
           'href' => base_url('dashboard/dashboard'),

        );
        
        $data['breadcrumbs'][] = array(
           'text' => 'Shipping Methods',
           'href' => base_url('shipping/shipping'),
        );
		
		$data['breadcrumbs'][] = array(
           'text' => 'Weight Based',
           'href' => base_url('shipping/weight'),
        );

		$data['action'] = base_url('shipping/weight');

		$data['cancel'] = base_url('shipping/shipping');
		$countries = $this->weight->getWeightCountry();
		
		foreach ($countries as $country) {
			if ($this->input->post('weight_' . $country . '_rate')!==NULL) {
				$data['weight_' . $country . '_rate'] = $this->input->post('weight_' . $country . '_rate');
			} else {
				$data['weight_' . $country . '_rate'] = $this->common->config('weight_' . $country . '_rate');
			}

			if ($this->input->post('weight_' . $country . '_status')!==NULL) {
				$data['weight_' . $country . '_status'] = $this->input->post('weight_' . $country . '_status');
			} else {
				$data['weight_' . $country . '_status'] = $this->common->config('weight_' . $country . '_status');
			}
		}
		$data['countries'] = $this->weight->getWeightRelatedCountry($countries);
		
		if ($this->input->post('weight_tax_class_id')!==NULL) {
			$data['weight_tax_class_id'] = $this->input->post('weight_tax_class_id');
		} else {
			$data['weight_tax_class_id'] = $this->common->config('weight_tax_class_id');
		}
		
		$this->load->model('system/tax_classes_model','tax_class');

		$data['tax_classes'] = $this->tax_class->getTaxClasses();

		if ($this->input->post('weight_status')!==NULL) {
			$data['weight_status'] = $this->input->post('weight_status');
		} else {
			$data['weight_status'] = $this->common->config('weight_status');
		}

		if ($this->input->post('weight_sort_order')!==NULL) {
			$data['weight_sort_order'] = $this->input->post('weight_sort_order');
		} else {
			$data['weight_sort_order'] = $this->common->config('weight_sort_order');
		}

        $admin_theme = $this->common->config('admin_theme');
        $content_page="themes/".$admin_theme."/shipping/weight";
        $this->load->view($content_page,$data);
	}
	
	public function autocomplete() {
        $this->output->unset_template();
        $json = array();
			
        if ($this->input->post('country')!==NULL) {
            $filter_name = $this->input->post('country');
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


