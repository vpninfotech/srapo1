<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Payment_methods
* @Auther       : Vinay
* @Date         : 19-01-2017
* @Description  : Payment methods Related Collection of functions
*
*/

class Shipping extends CI_Controller {

	private $data=array();
    private $error = array();
    function __construct()
    {
        parent::__construct();

        $this->rbac->CheckAuthentication();

        $this->_init();

        $this->load->model('shipping/Shipping_model','shipping');

        $this->lang->load('shipping/shipping_lang', 'english');

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
           'text' => 'Shipping Methods',
           'href' => base_url('shipping/shipping'),
        );

        //	pagination
        $limit = $this->common->config('config_limit_admin');
        $data = array(
        'sort' => $sort_by,
        'order'=> $sort_order,
        'start'=> $offset,
        'limit'=> $limit
        );

        $url = base_url("shipping/shipping/index/$sort_by/$sort_order");
        $total_records = $this->shipping->getTotalShippingMethods();
        $config =$this->commons->pagination($url,$total_records,$limit);
        $this->pagination->initialize($config);
        $config['uri_segment'] = 6;
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['sort_by'] = $sort_by;
        $this->data['sort_order'] = $sort_order;
        $results = $this->shipping->getShippingMethods($data);		
        $this->data['pages'] = ceil($total_records/$limit);
        $this->data['totals'] = ceil($total_records);
        $this->data['range'] = ceil($offset+1);

        
        foreach ($results as $result) {
           
            $this->data['records'][] = array(
                'shipping_method_id'        => $result['shipping_method_id'],
                'shipping_method_name'      => $result['shipping_method_name'],
				'shipping_code'      	   	=> $result['shipping_code'],         
                'edit'                     => base_url('shipping/'.strtolower($result['shipping_code']))
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
        $content_page="themes/".$admin_theme."/shipping/shipping_list";
        $this->load->view($content_page,$this->data);

	}
}


