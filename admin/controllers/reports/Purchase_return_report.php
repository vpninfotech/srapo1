<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Purchased Return Report
* @Auther       : Mitesh
* @Date         : 6-1-2017
* @Description  : Purchase Return Report Controller 
*
*/

class Purchase_return_report extends CI_Controller {

	private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('reports/purchase_return_report_model','purchase_return_report');		
				
		$this->lang->load('reports/purchase_return_report_lang', 'english');
		
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
		$this->output->set_template('admin_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Purchase Return Report','sarpo','This is srapo purchase return report page');
	}
	
	/**
	* 
	* @function name : index()
	* @description   : load purchase return view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'name', $sort_order = 'ASC', $offset = 0)	
	{   
            // breadcrumbs		
            $this->data['breadcrumbs']   	= array();
            $this->data['breadcrumbs'][] 	= array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),

            );

            $this->data['breadcrumbs'][] = array(
               'text' => 'Purchase Return Report',
               'href' => base_url('reports/purchase_return_report'),		 
            );
                        
            $filter_array             = $this->session->userdata('purchase_return_filter_array');
            $filter_date_start        = "";
            $filter_date_end          = "";
           			
            if(isset($filter_array['filter_date_start']))
            {
              $filter_date_start =   $filter_array['filter_date_start'];
            }
            if(isset($filter_array['filter_date_end']))
            {
              $filter_date_end =   $filter_array['filter_date_end'];
            }
           
            
            $this->data['filter_date_start'] = $filter_date_start;
            $this->data['filter_date_end'] = $filter_date_end;
		  	
            //	pagination
            $limit = $this->common->config('config_limit_admin');
            $data = array(
                'filter_date_start' => $filter_date_start,
                'filter_date_end' => $filter_date_end ,               
                'sort' => $sort_by,
                'order'=> $sort_order,
                'start'=> $offset,
                'limit'=> $limit
            );
            			
			
            $url = base_url("reports/purchase_report/index/$sort_by/$sort_order");
            $total_records = $this->purchase_return_report->getTotalPurchaseReturn($data);
           
            $config =$this->commons->pagination($url,$total_records,$limit);
            $this->pagination->initialize($config);
            $config['uri_segment'] = 6;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['sort_by'] = $sort_by;
            $this->data['sort_order'] = $sort_order;
            $results = $this->purchase_return_report->getPurchaseReturn($data);
           
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
                    $url .= '/name';
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
                    'product_name'      => $result['product_name'],
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
            $content_page="themes/".$admin_theme."/reports/purchase_return_report_list";
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
            
            $filter['filter_date_start'] = $filter_date_start;
            $filter['filter_date_end'] = $filter_date_end;
            
            $this->session->set_userdata('purchase_return_filter_array', $filter);
        }
        if ($this->input->post('button_all') !== NULL) 
        {
           $this->session->set_userdata('purchase_return_filter_array', array());
        }
        $this->index();           
    }
		
}