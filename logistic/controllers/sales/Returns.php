<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Returns
* @Auther       : Indrajit,Mitesh
* @Date         : 10-10-2016,16-11-2016
* @Description  : Admin Product Operation
*
*/

class Returns extends CI_Controller {

	private $data=array();
	private $error = array();
	function __construct()
	{
		parent::__construct();
		
		$this->_init();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('sales/returns_model','returns');
		
		//get product name in autocomplete
		$this->load->model('catalog/product_model','products');  
		
		//get return reason in dropdown menu
		$this->load->model('system/return_reason_model','return_reason');
		
		//get return actions in dropdown menu
		$this->load->model('system/return_actions_model','action');
		
		//get return status in dropdownmenu
		$this->load->model('system/Return_status_model','return_status');
		
		//get customer name form customers model
		$this->load->model('customers/customers_model','customers');
		
		//get return status from Return status model
		$this->load->model('system/Return_status_model','Return_status');
		
		$this->lang->load('sales/returns_lang', 'english');
		
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
		$this->output->set_template('logistic_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Product Returns','sarpo','This is srapo Returns page');
		
	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Returns view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'return_id', $sort_order = 'ASC', $offset = 0)	
	{
		
                // breadcrumbs
		$this->data['add'] 			 = base_url('sales/returns/add');
		if($this->session->userdata('role_id')== 1)
		{
			$this->data['delete'] 		= base_url('sales/returns/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('sales/returns/softDelete');
		}
                
		
		//$this->data['refresh'] 			= base_url('sales/returns/refresh');
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		  
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Product Returns',
		   'href' => base_url('sales/returns'),
		 
		  );
		 
		
		//get list of return status
		$get_return_status=$this->return_status->getReturnStatuses();	
		$this->data['status'] = $get_return_status;	
		 $filter_array             = $this->session->userdata('order_return_filter_array');
               
        $return_id              = "";
        $customer_id             = "";
        $customer             = "";
        $model            = "";
        $date_added          = "";
        $order_id          = "";
        $product          = "";
        $product_id          = "";
        $return_status_id          = "";
        $date_modified          = "";
       
        if(isset($filter_array['return_id']))
        {
          $return_id =   $filter_array['return_id'];
        }
        if(isset($filter_array['customer_id']))
        {
          $customer_id =   $filter_array['customer_id'];
        }
        if(isset($filter_array['customer']))
        {
          $customer =   $filter_array['customer'];
        }
        if(isset($filter_array['model']))
        {
          $model =   $filter_array['model'];
        }
        if(isset($filter_array['date_added']))
        {
          $date_added =   $filter_array['date_added'];
        }	
        if(isset($filter_array['order_id']))
        {
          $order_id =   $filter_array['order_id'];
        }	
        if(isset($filter_array['product']))
        {
          $product =   $filter_array['product'];
        }	
         if(isset($filter_array['product_id']))
        {
          $product_id =   $filter_array['product_id'];
        }	
        if(isset($filter_array['return_status_id']))
        {
          $return_status_id =   $filter_array['return_status_id'];
        }	
        if(isset($filter_array['date_modified']))
        {
          $date_modified =   $filter_array['date_modified'];
        }	
		
		  
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'return_id'=> $return_id,
		'customer_id'=>$customer_id,
		'customer'=>$customer,
		'model'=>$model,
		'date_added'=>$date_added,
		'order_id'=>$order_id,
		'product'=>$product,
		'return_status_id'=>$return_status_id,
		'date_modified'=>$date_modified,
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/
		$this->data['return_id'] = $return_id;
        $this->data['customer_id'] = $customer_id;
        $this->data['model'] = $model;
        $this->data['date_added'] = $date_added;
        $this->data['customer'] = $customer;
        $this->data['order_id'] = $order_id;
        $this->data['product'] = $product;
        $this->data['product_id'] = $product_id;
        $this->data['return_status_id'] = $return_status_id;
        $this->data['date_modified'] = $date_modified;
		
		$url = base_url("sales/returns/index/$sort_by/$sort_order");
		$total_records = $this->returns->getTotalReturns();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->returns->getReturns($data);
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
			$url .= '/return_id';
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
			
			//get cutomer name
			$customer_name=$this->customers->getCustomerById($result['customer_id']);
			
			//get status name
			$return_status=$this->return_status->getReturnStatusById($result['return_status_id']);
			
			$this->data['records'][] = array(
				'return_id'   		=> $result['return_id'],
				'order_id' 			=> $result['order_id'],							
				'customer' 		=> $result['firstname'].' '.$result['lastname'],
				'product'    		=> $result['product'],			
				'model'        		=> $result['model'],	
				'return_status_id'  => $return_status['return_status_name'],
                                'is_deleted'        => $result['is_deleted'],
				'date_added'        => date($this->common->config('config_date_format'),strtotime($result['date_added'])),
				'date_modified'     => $result['date_modified'],
				'date_modified' 	=> date($this->common->config('config_date_format'), strtotime($result['date_modified'])),
				'edit'          	=> base_url('sales/returns/edit'.$url.'/'.$this->commons->encode($result['return_id']))
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
		$content_page="themes/".$admin_theme."/sales/returns_list";
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
            	
              //get data for filter		
				if($this->input->post('return_id') !== NULL) 
				{
					$return_id = $this->input->post('return_id');
				} 
				else 
				{
					$return_id = '';
				}
				
				if($this->input->post('customer_id') !== NULL) 
				{			
					$customer_id = $this->input->post('customer_id');
				} 
				else 
				{
					$customer_id = '';
				}
				
				if($this->input->post('customer') !== NULL) 
				{			
					$customer = $this->input->post('customer');
				} 
				else 
				{
					$customer = '';
				}
				
				if($this->input->post('model') !== NULL) 
				{			
					$model = $this->input->post('model');
				} 
				else 
				{
					$model = '';
				}
				
				if($this->input->post('date_added') !== NULL) 
				{			
					$date_added = $this->input->post('date_added');
				} 
				else 
				{
					$date_added = '';
				}
				
				if($this->input->post('order_id') !== NULL) 
				{			
					$order_id = $this->input->post('order_id');
				} 
				else 
				{
					$order_id = '';
				}
				
				if($this->input->post('product') !== NULL) 
				{			
					$product = $this->input->post('product');
				} 
				else 
				{
					$product = '';
				}
				if($this->input->post('product_id') !== NULL) 
				{			
					$product_id = $this->input->post('product_id');
				} 
				else 
				{
					$product_id = '';
				}
				
				if($this->input->post('return_status_id') !== NULL) 
				{			
					$return_status_id = $this->input->post('return_status_id');
				} 
				else 
				{
					$return_status_id = '';
				}
						
				if($this->input->post('date_modified') !== NULL) 
				{			
					$date_modified = $this->input->post('date_modified');
				} 
				else 
				{
					$date_modified = '';
				}
                $filter['return_id'] = $return_id;
                $filter['customer_id'] = $customer_id;
                $filter['customer'] = $customer;
                $filter['model'] = $model;
                $filter['date_added'] = $date_added;
                $filter['order_id'] = $order_id;
                $filter['product'] = $product;
                $filter['product_id'] = $product_id;
                $filter['return_status_id'] = $return_status_id;
                $filter['date_modified'] = $date_modified;

                // echo "<pre>";
                // print_r($filter);exit;
                $this->session->set_userdata('order_return_filter_array', $filter);
            }
            if ($this->input->post('button_all') !== NULL) 
            {
               $this->session->set_userdata('order_return_filter_array', array());
            }

            $this->index();
           
    }
		
	/**
	* 
	* @function name : getForm()
	* @description   : Generate Form for Add and Edit Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function getForm()
	{
		// Transaction Status
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
		
		// Generate back url
		$url = '';

		if ($this->uri->segment(4)!==NULL) {
			$url .= '/'.$this->uri->segment(4);
		}
		else
		{
			$url .= '/return_id';
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
			
		
		// breadcrumbs
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		 $this->data['breadcrumbs'][] = array(
		   'text' => 'Product Returns',
		   'href' => base_url('sales/returns'),
		 
		  );
		
			//get list of return reasons		
			$get_reasons=$this->return_reason->getReturnReasons();
			$this->data['reasons'] = $get_reasons;
			
			//get list of return action
			$get_return_actions=$this->action->getReturnActions();	
		    $this->data['actions'] = $get_return_actions;
										
			//get list of return status
			$get_return_status=$this->return_status->getReturnStatuses();	
		    $this->data['status'] = $get_return_status;	
				
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{											
			$this->data['text_form']   = $this->lang->line('text_add');
			$this->data['form_action'] = base_url('sales/returns/add'.$url);
			$this->data['return_id'] = '';
		} 
		else 
		{									
			$this->data['text_form']   = $this->lang->line('text_edit');
			$this->data['form_action'] = base_url('sales/returns/edit'.$url.'/'.$this->uri->segment($count));
			
			$this->data['return_id'] = $this->commons->decode($this->uri->segment($count));
		}

		$this->data['cancel'] 		= base_url('sales/returns/index'.$url);
		
		// Set Value Back
		if (1) 
		{
			$returns_info = $this->returns->getReturn($this->commons->decode($this->uri->segment($count)));
		}		
			
		if ($this->input->post('product_id')!==NULL) {
			$this->data['product_id'] = $this->input->post('product_id');
		} elseif (!empty($returns_info)) {
			
			$this->data['product_id'] = $returns_info['product_id'];
		} else {
			$this->data['product_id'] = '';
		}	
		
		if ($this->input->post('return_id')!==NULL) {
			$this->data['return_id'] = $this->input->post('return_id');
		} elseif (!empty($returns_info)) {
			
			$this->data['return_id'] = $returns_info['return_id'];
		} else {
			$this->data['return_id'] = '';
		}	
			
		if ($this->input->post('order_id')!==NULL) {
			$this->data['order_id'] = $this->input->post('order_id');
		} elseif (!empty($returns_info)) {
			
			$this->data['order_id'] = $returns_info['order_id'];
		} else {
			$this->data['order_id'] = '';
		}
		
		//get order date		
		$order_date=date('m/d/Y', strtotime($returns_info['date_ordered']));
		
		if ($this->input->post('date_ordered')!==NULL) {
			$this->data['date_ordered'] = $this->input->post('date_ordered');
		} elseif (!empty($returns_info)) {
			
			$this->data['date_ordered'] = $order_date; 
		} else {
			$this->data['date_ordered'] = '';
		}
		
		//get cutomer name
		$customer_name=$this->customers->getCustomerById($returns_info['customer_id']);
		if ($this->input->post('customer')!==NULL) {
			$this->data['customer'] = $this->input->post('customer');
		} elseif (!empty($customer_name)) {
			
			$this->data['customer'] = $customer_name['firstname']; 
		} else {
			$this->data['customer'] = '';
		}
		
		//get cutomer id
		$customer_name=$this->customers->getCustomerById($returns_info['customer_id']);
		if ($this->input->post('customer_id')!==NULL) {
			$this->data['customer_id'] = $this->input->post('customer_id');
		} elseif (!empty($customer_name)) {
			
			$this->data['customer_id'] = $customer_name['customer_id']; 
		} else {
			$this->data['customer_id'] = '';
		}
				
		if ($this->input->post('firstname')!==NULL) {
			$this->data['firstname'] = $this->input->post('firstname');
		} elseif (!empty($returns_info)) {
			
			$this->data['firstname'] = $returns_info['firstname'];
		} else {
			$this->data['firstname'] = '';
		}
		
		if ($this->input->post('lastname')!==NULL) {
			$this->data['lastname'] = $this->input->post('lastname');
		} elseif (!empty($returns_info)) {
			
			$this->data['lastname'] = $returns_info['lastname'];
		} else {
			$this->data['lastname'] = '';
		}
				
		if ($this->input->post('email')!==NULL) {
			$this->data['email'] = $this->input->post('email');
		} elseif (!empty($returns_info)) {
			
			$this->data['email'] = $returns_info['email'];
		} else {
			$this->data['email'] = '';
		}
		
		if ($this->input->post('telephone')!==NULL) {
			$this->data['telephone'] = $this->input->post('telephone');
		} elseif (!empty($returns_info)) {
			
			$this->data['telephone'] = $returns_info['telephone'];
		} else {
			$this->data['telephone'] = '';
		}
		
		if ($this->input->post('product')!==NULL) {
			$this->data['product'] = $this->input->post('product');
		} elseif (!empty($returns_info)) {
			
			$this->data['product'] = $returns_info['product']; 
		} else {
			$this->data['product'] = '';
		}
		
		if ($this->input->post('model')!==NULL) {
			$this->data['model'] = $this->input->post('model');
		} elseif (!empty($returns_info)) {
			
			$this->data['model'] = $returns_info['model']; 
		} else {
			$this->data['model'] = '';
		}
		
		if ($this->input->post('quantity')!==NULL) {
			$this->data['quantity'] = $this->input->post('quantity');
		} elseif (!empty($returns_info)) {
			
			$this->data['quantity'] = $returns_info['quantity']; 
		} else {
			$this->data['quantity'] = '';
		}
			
		if ($this->input->post('return_reason_id')!==NULL) {
			$this->data['return_reason_id'] = $this->input->post('return_reason_id');
		} elseif (!empty($returns_info)) {
			
			$this->data['return_reason_id'] = $returns_info['return_reason_id']; 
		} else {
			$this->data['return_reason_id'] = '';
		}
				
		if ($this->input->post('opened')!==NULL) {
			$this->data['opened'] = $this->input->post('opened');
		} elseif (!empty($returns_info)) {
			
			$this->data['opened'] = $returns_info['opened']; 
		} else {
			$this->data['opened'] = '';
		}
		
		if ($this->input->post('comment')!==NULL) {
			$this->data['comment'] = $this->input->post('comment');
		} elseif (!empty($returns_info)) {
			
			$this->data['comment'] = $returns_info['comment']; 
		} else {
			$this->data['comment'] = '';
		}
		
		if ($this->input->post('return_action_id')!==NULL) {
			$this->data['return_action_id'] = $this->input->post('return_action_id');
		} elseif (!empty($returns_info)) {
			
			$this->data['return_action_id'] = $returns_info['return_action_id']; 
		} else {
			$this->data['return_action_id'] = '';
		}
		
		if ($this->input->post('return_status_id')!==NULL) {
			$this->data['comment'] = $this->input->post('return_status_id');
		} elseif (!empty($returns_info)) {
			
			$this->data['return_status_id'] = $returns_info['return_status_id']; 
		} else {
			$this->data['return_status_id'] = '';
		}
		
		/*if ($this->input->post('meta_description')!==NULL) {
			$this->data['meta_description'] = $this->input->post('meta_description');
		} elseif (!empty($category_info)) {
			
			$this->data['meta_description'] = $category_info['meta_description'];
		} else {
			$this->data['meta_description'] = '';
		}
		
		if ($this->input->post('parent_id')!==NULL) {
			$this->data['parent_id'] = $this->input->post('parent_id');
		} elseif (!empty($category_info)) {
			
			$this->data['parent_id'] = $category_info['parent_id'];
		} else {
			$this->data['parent_id'] = '';
		}
		
		//get category_name according to parent id
		if(isset($category_info['parent_id']))
		{
			//$category_name=$this->category->getCategory($category_info['parent_id']);
			$category_name=$this->category->getPath($category_info['parent_id']);			
		}
		if ($this->input->post('parent')!==NULL) {
			$this->data['parent'] = $this->input->post('parent');
		} elseif (!empty($category_info)) {			
			//$this->data['parent'] = $category_name['category_name'];
			$this->data['parent'] = $category_name;
		} else {
			$this->data['parent'] = array();
		}
				
		if(!empty($category_info['category_id']))
		{
			$this->data['filters_name']=$this->filter->getFiltersData($category_info['category_id']);
		}
		else
		{
			$this->data['filters_name']=array();
		}*/
		
		
		/*if ($this->input->post('is_deleted')!==NULL) {
			$this->data['is_deleted'] = $this->input->post('is_deleted');
		} elseif (!empty($category_info)) {
			$this->data['is_deleted'] = $category_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = '';
		}*/
	
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/sales/returns";
		$this->load->view($content_page,$this->data);
	}
	
	
	/**
	* 
	* @function name : add()
	* @description   : load Returns Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function add()	{
		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
			
				$this->returns->addReturns();
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/return_id';
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
				if ($this->uri->segment(7)!==NULL) {
					$url .= '/'.$this->uri->segment(7);
				}
				redirect('sales/returns/index'.$url);
	     }
		$this->getForm();
		
	}
	
	
	/**
	* 
	* @function name : edit()
	* @description   : edit product return records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'return_id', $sort_order = 'ASC', $offset = 0)
	{		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				
				$this->returns->editReturns();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/return_id';
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
				
				redirect('sales/returns/index'.$url);
				
	     }
	   
		$this->getForm();
	}
	
	/**
	* 
	* @function name : delete()
	* @description   : perminant delete records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function delete()
	{
		if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
		{			
			foreach ($this->input->post('selected') as $return_id) 
			{
				$this->returns->deleteReturns($return_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success'));
			
			$this->index();
		}
		else
		{
			
			$this->index();
		}
		
	}
	
        /**
	* 
	* @function name : softDelete()
	* @description   : soft Delete Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function softDelete()
	{		
		if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
		{
			foreach ($this->input->post('selected') as $returns_id) 
			{
                            $this->returns->softDeleteReturns($returns_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success'));
			
		}
                $this->index();
	}
        
        
	/**
	* 
	* @function name : validateForm()
	* @description   : Validate Entered Form data
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateForm()
	{		
			$validation = array(
			 			array(
					        'field' => 'order_id',
					        'label' => 'Order ID', 
					        'rules' => 'trim|required|xss_clean|callback_check_exists_order_id', 
					        'errors' => array('required' => '%s must be between 3 and 128 characters!','check_exists_order_id'=>'%s already exists!')
					    ),					   
					    array(
					        'field' => 'firstname',
					        'label' => 'First Name', 
					        'rules' => 'trim|required|min_length[1]|max_length[32]|xss_clean', 
					        'errors' => array('required' => '%s must be between 1 and 32 characters!','min_length'=>'%s must be between 1 and 32 characters!','max_length'=>'%s must be between 1 and 32 characters!')
					    ),
					    array(
					        'field' => 'lastname',
					        'label' => 'Last Name', 
					        'rules' => 'trim|required|min_length[1]|max_length[32]|xss_clean', 
					        'errors' => array('required' => '%s must be between 1 and 32 characters!','min_length'=>'%s must be between 1 and 32 characters!','max_length'=>'%s must be between 1 and 32 characters!')
					    ),
					      array(
					        'field' => 'email',
					        'label' => 'E-Mail Address', 
					        'rules' => 'trim|required|xss_clean|valid_email', 
					        'errors' => array('required' => '%s  does not appear to be valid!','valid_email'=>'%s  does not appear to be valid!')
					    ),
					    array(
					        'field' => 'telephone',
					        'label' => 'Telephone', 
					        'rules' => 'trim|required|min_length[3]|max_length[32]|numeric|xss_clean', 
					        'errors' => array('required' => '%s must be between 3 and 32 characters!','min_length'=>'%s must be between 3 and 32 characters!','max_length'=>'%s must be between 3 and 32 characters!')
					    ),
					    array(
					        'field' => 'product',
					        'label' => 'Product Name', 
					        'rules' => 'trim|required|min_length[3]|max_length[255]|xss_clean', 
					        'errors' => array('required' => '%s must be between 3 and 255 characters!','min_length'=>'%s must be between 3 and 255 characters!','max_length'=>'%s must be between 3 and 255 characters!')
					    ),
                                            array(
					        'field' => 'comment',
					        'label' => 'Comment', 
					        'rules' => 'trim|xss_clean' 
					    )
					    

			);
			
			$this->form_validation->set_rules($validation);
			if ($this->form_validation->run() == FALSE) {
				
				return FALSE;
			}else{
							
				return TRUE;
			}
	}
		
	/**
	* 
	* @function name : validateDelete()
	* @description   : Check information relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{		
		foreach ($this->input->post('selected') as $return_id) 
		{
			$return_info = $this->returns->getReturn($return_id);
			
			if ($return_info) 
			{
				if ($this->common->config('config_return') == $return_info['return_id']) 
				{
					$this->error['warning'] = $this->lang->line('error_default');
				}
			}
		}
		return !$this->error;
	}
	
	/**
    * 
    * @function name    : check_exists_return_status_name()
    * @description      : Validate for return status name existing or not
    * @access           : public
    * @param            : void
    * @return           : boolean
    *
    */
    function check_exists_order_id($order_id)
    {		
        $exists=$this->returns->existsOrderId($order_id);
        if($exists > 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        } 
    } 
	
}
