<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Sales Shipping Report
* @Auther       : Vinay Ghael
* @Date         : 19-12-2016
* @Description  : Sale Shipping Report Controller 
*
*/

class Sale_shipping_report extends CI_Controller {

	private $data=array();
	private $error = array();

	function __construct()
	{
            parent::__construct();

            $this->rbac->CheckAuthentication();

            $this->_init();

            $this->load->model('reports/sales_report_model','sale_shipping_report');		

            $this->lang->load('reports/sale_shipping_report_lang', 'english');

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
            $this->output->set_common_meta('Sales Shipping Report','sarpo','This is srapo sale shipping report page');
	}
	
	/**
	* 
	* @function name : index()
	* @description   : load attribute group view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($offset = 0)	
	{   
            // breadcrumbs		
            $this->data['breadcrumbs']   	= array();
            $this->data['breadcrumbs'][] 	= array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),

            );

            $this->data['breadcrumbs'][] = array(
               'text' => 'Shipping Report',
               'href' => base_url('reports/sale_shipping_report'),		 
            );
            
            $this->load->model('system/order_status_model');
            $this->data['order_statuses']  = $this->order_status_model->getOrderStatuses();
            
            $this->data['groups'] = array();
            
            $this->data['groups'][] = array(
                'text'  => $this->lang->line('text_year'),
                'value' => 'year',
            );
            
            $this->data['groups'][] = array(
                'text'  => $this->lang->line('text_month'),
                'value' => 'month',
            );
             
            $this->data['groups'][] = array(
                'text'  => $this->lang->line('text_week'),
                'value' => 'week',
            );
              
            $this->data['groups'][] = array(
                'text'  => $this->lang->line('text_day'),
                'value' => 'day',
            );
            
            $filter_array              = $this->session->userdata('shipping_report_filter_array');
            $filter_date_start         = "";
            $filter_date_end           = "";
            $filter_group              = "";
            $filter_order_status_id   = "";
            
            if(isset($filter_array['filter_date_start']))
            {
              $filter_date_start =   $filter_array['filter_date_start'];
            }
            if(isset($filter_array['filter_date_end']))
            {
              $filter_date_end =   $filter_array['filter_date_end'];
            }
            if(isset($filter_array['filter_group']))
            {
               $filter_group =   $filter_array['filter_group'];
            } 
            else 
            {
                $filter_group = "week";
            }
            if(isset($filter_array['filter_order_status_id']))
            {
              $filter_order_status_id =   $filter_array['filter_order_status_id'];
            }
            
            $this->data['filter_date_start'] = $filter_date_start;
            $this->data['filter_date_end'] = $filter_date_end;
            $this->data['filter_group'] = $filter_group;
            $this->data['filter_order_status_id'] = $filter_order_status_id;
            $this->data['shipping_report_order_report'] = array();
		  
            //	pagination
            $limit = $this->common->config('config_limit_admin');
            $data = array(
                'filter_date_start' => $filter_date_start,
                'filter_date_end' => $filter_date_end ,
                'filter_group' => $filter_group,
                'filter_order_status_id' => $filter_order_status_id,
                //'sort' => $sort_by,
                //'order'=> $sort_order,
                'start'=> $offset,
                'limit'=> $limit
            );
            
            
            
		
            $url = base_url("reports/sale_shipping_report/index/");
            $total_records = $this->sale_shipping_report->getTotalShipping($data);
            
            $config =$this->commons->pagination($url,$total_records,$limit);
            $this->pagination->initialize($config);
            $config['uri_segment'] = 6;
            $this->data['pagination'] = $this->pagination->create_links();
            //$this->data['sort_by'] = $sort_by;
            //$this->data['sort_order'] = $sort_order;
            $results = $this->sale_shipping_report->getShipping($data);
           
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
                    'date_start'  => date($this->common->config('config_date_format'), strtotime($result['date_start'])),
                    'date_end'    => date($this->common->config('config_date_format'), strtotime($result['date_end'])),
                    'title'       => $result['title'],
                    'orders'      => $result['orders'],
                    'total'       => $this->currency->format($result['total'],$this->common->config('config_currency'))
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
            $content_page="themes/".$admin_theme."/reports/sale_shipping_report_list";
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
            
            if ($this->input->post('filter_group') !== NULL) {
                $filter_group = $this->input->post('filter_group');
            } else {
                $filter_group = 'week';
            }
            
            if ($this->input->post('filter_order_status_id')!==NULL) 
            {
                
                $filter_order_status_id = $this->input->post('filter_order_status_id');
                
            }
            else
            {
                $filter_order_status_id = 0;
            }
            $filter['filter_date_start'] = $filter_date_start;
            $filter['filter_date_end'] = $filter_date_end;
            $filter['filter_group'] = $filter_group;
            $filter['filter_order_status_id'] = $filter_order_status_id;
            
            $this->session->set_userdata('shipping_report_filter_array', $filter);
        }
        if ($this->input->post('button_all') !== NULL) 
        {
           $this->session->set_userdata('shipping_report_filter_array', array());
        }
        $this->index();           
    }
		
}