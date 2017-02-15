<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Payment_methods
* @Auther       : Vinay
* @Date         : 19-01-2017
* @Description  : Payment methods Related Collection of functions
*
*/

class Payments extends CI_Controller {

    private $data=array();
    private $error = array();

    function __construct()
    {
        parent::__construct();

        $this->rbac->CheckAuthentication();

        $this->_init();

        $this->load->model('payment/payments_model','payment_methods');

        $this->lang->load('payment/payments_lang', 'english');

        $this->load->model('common');

        $this->load->library('commons');

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
        $this->output->set_common_meta('Payment Methods','sarpo','This is srapo payment methods page');
    }
	
    /**
    * 
    * @function name : index()
    * @description   : load zone view
    * @param   		 : void
    * @return        : void
    *
    */
    public function index($sort_by = 'payment_method_name', $sort_order = 'ASC', $offset = 0)	
    {
        // breadcrumbs
        $this->data['breadcrumbs']   	= array();
        $this->data['breadcrumbs'][] 	= array(
           'text' => '<i class="fa fa-dashboard"></i> Home',
           'href' => base_url('dashboard/dashboard'),

        );
        
        $this->data['breadcrumbs'][] = array(
           'text' => 'Payment Methods',
           'href' => base_url('payment/payment_methods'),
        );

        //	pagination
        $limit = $this->common->config('config_limit_admin');
        $data = array(
        'sort' => $sort_by,
        'order'=> $sort_order,
        'start'=> $offset,
        'limit'=> $limit
        );

        $url = base_url("payment/payments/index/$sort_by/$sort_order");
        $total_records = $this->payment_methods->getTotalPaymentMethods();
        $config =$this->commons->pagination($url,$total_records,$limit);
        $this->pagination->initialize($config);
        $config['uri_segment'] = 6;
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['sort_by'] = $sort_by;
        $this->data['sort_order'] = $sort_order;
        $results = $this->payment_methods->getPaymentMethods($data);		
        $this->data['pages'] = ceil($total_records/$limit);
        $this->data['totals'] = ceil($total_records);
        $this->data['range'] = ceil($offset+1);

        
        foreach ($results as $result) {
           
			if($result['status']==1){ $status = 'Enabled';}else {$status = 'Disabled';}
            $this->data['records'][] = array(
                'payment_method_id'        => $result['payment_method_id'],
                'payment_method_name'      => $result['payment_method_name'],
				'payment_code'      	   => $result['payment_code'],
                'icon'                     => $result['icon'],
                'status'                   => $status,                
                'edit'                     => base_url('payment/'.strtolower($result['payment_code']))
            );
        }	
		//print_r($this->data['records']);die;
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
        //print_r($this->data);

        $admin_theme = $this->common->config('admin_theme');
        $content_page="themes/".$admin_theme."/payment/payments_list";
        $this->load->view($content_page,$this->data);

	}
}


