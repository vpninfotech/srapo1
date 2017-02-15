<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Product Purchased Report
* @Auther       : Vinay Ghael
* @Date         : 13-12-2016
* @Description  : Product Purchased Report Controller 
*
*/

class Product_purchased_report extends CI_Controller {

	private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('reports/product_purchased_report_model','product_purchased_report');		
				
		$this->lang->load('reports/product_purchased_report_lang', 'english');
		
		$this->load->model('common');
		
		$this->load->library('commons');
                
                $this->load->library('currency');
		
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
		$this->output->set_template('finance_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Product Purchased Report','sarpo','This is srapo product purchased report page');
	}
	
	/**
	* 
	* @function name : index()
	* @description   : load attribute group view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'firstname', $sort_order = 'ASC', $offset = 0)	
	{   
            // breadcrumbs		
            $this->data['breadcrumbs']   	= array();
            $this->data['breadcrumbs'][] 	= array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),

            );

            $this->data['breadcrumbs'][] = array(
               'text' => 'Product Purchased Report',
               'href' => base_url('reports/product_purchased_report'),		 
            );
            
            $this->load->model('system/order_status_model');
            $this->data['order_statuses']  = $this->order_status_model->getOrderStatuses();
            
            $filter_array             = $this->session->userdata('product_purchased_filter_array');
            $filter_date_start        = "";
            $filter_date_end          = "";
            $filter_order_status_id   = "";
            
            if(isset($filter_array['filter_date_start']))
            {
              $filter_date_start =   $filter_array['filter_date_start'];
            }
            if(isset($filter_array['filter_date_end']))
            {
              $filter_date_end =   $filter_array['filter_date_end'];
            }
            if(isset($filter_array['filter_order_status_id']))
            {
              $filter_order_status_id =   $filter_array['filter_order_status_id'];
            }
            
            $this->data['filter_date_start'] = $filter_date_start;
            $this->data['filter_date_end'] = $filter_date_end;
            $this->data['filter_order_status_id'] = $filter_order_status_id;
            $this->data['customer_order_report'] = array();
		  
            //	pagination
            $limit = $this->common->config('config_limit_admin');
            $data = array(
                'filter_date_start' => $filter_date_start,
                'filter_date_end' => $filter_date_end ,
                'filter_order_status_id' => $filter_order_status_id,
                'sort' => $sort_by,
                'order'=> $sort_order,
                'start'=> $offset,
                'limit'=> $limit
            );
            
            
            
		
            $url = base_url("reports/product_purchased_report/index/$sort_by/$sort_order");
            $total_records = $this->product_purchased_report->getTotalPurchased($data);
            
            $config =$this->commons->pagination($url,$total_records,$limit);
            $this->pagination->initialize($config);
            $config['uri_segment'] = 6;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['sort_by'] = $sort_by;
            $this->data['sort_order'] = $sort_order;
            $results = $this->product_purchased_report->getPurchased($data);
           
            $this->data['pages'] = ceil($total_records/$limit);
            $this->data['totals'] = ceil($total_records);
            $this->data['range'] = ceil($offset+1);
		
            // URL creation
            $url='';
            if ($this->uri->segment(4)!==NULL) {
                    $url .= '/'.$this->uri->segment(4);
            }
            else
            {
                    $url .= '/firstname';
            }

            if ($this->uri->segment(5)!==NULL) {
                    $url .= '/'.$this->uri->segment(5);
            }
            else
            {
                    $url .= '/ASC';
            }
            if ($this->uri->segment(6)!==NULL) {
                    $url .= '/'.$this->uri->segment(6);
            }
            else
            {
                    $url .= '/0';
            }

            foreach ($results as $result) {
               
                $this->data['records'][] = array(
                    'product_name'      => $result['name'],
                    'model'             => $result['model'],
                    'quantity'          => $result['quantity'],				
                    'total'             => $this->currency->format($result['total'],$this->common->config('config_currency')) 
                );
            }
		
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
		
            if ($this->input->post('selected')!==NULL) {
                    $this->data['selected'] = (array)$this->input->post('selected');
            } else {
                    $this->data['selected'] = array();
            }
			
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/reports/product_purchased_report_list";
            $this->load->view($content_page,$this->data);
	}
        
    /**
    * 
    * @function name : search()
    * @description   : set session data by filter paramater
    * @param         : void
    * @return        : void
    *
    */
    public function search()
    {
        if ($this->input->post('button_filter') !== NULL) 
        {
           if ($this->input->post('filter_date_start') !== NULL) {
                $filter_date_start = $this->input->post('filter_date_start');
            } else {
                $filter_date_start = '';
            }

            if ($this->input->post('filter_date_end') !== NULL) {
                $filter_date_end = $this->input->post('filter_date_end');
            } else {
                $filter_date_end = '';
            }
            
            if ($this->input->post('filter_order_status_id')!==NULL) 
            {
                if ($this->input->post('filter_order_status_id')!= 0) 
                {
                    $filter_order_status_id = $this->input->post('filter_order_status_id');
                } 
                else 
                {
                    $filter_order_status_id = 0;
                }
            }
            else
            {
                $filter_order_status_id = '';
            }
            $filter['filter_date_start'] = $filter_date_start;
            $filter['filter_date_end'] = $filter_date_end;
            $filter['filter_order_status_id'] = $filter_order_status_id;
            
            $this->session->set_userdata('product_purchased_filter_array', $filter);
        }
        if ($this->input->post('button_all') !== NULL) 
        {
           $this->session->set_userdata('product_purchased_filter_array', array());
        }
        $this->index();           
    }
		
}