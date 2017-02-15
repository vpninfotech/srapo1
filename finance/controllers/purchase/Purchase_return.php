<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Purchase return
* @Auther       : Mitesh
* @Date         : 7-01-2017
* @Description  : Finance Purchase return Operation
*
*/

class Purchase_return extends CI_Controller {

	private $data=array();
	private $error = array();
	
	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();	
		
		$this->load->model('purchase/purchase_return_model','purchase_return');
		
		//get list of purchase id
		$this->load->model('purchase/purchase_model','purchase');
		
		//get Reason list
		$this->load->model('system/return_reason_model','return_reason');
		
		//get Return Status List
		$this->load->model('system/return_status_model','return_status');
		
		//get Return Action List
		$this->load->model('system/return_actions_model','return_action');
		
		//get list of products
		$this->load->model('catalog/product_model', 'product');
		
		//get list of manufacturer
		$this->load->model('catalog/manufacturer_model','manufacturers');		
		
		//get Order data
		$this->load->model('sales/orders_model','orders');
		
		// Load settings_model
        $this->load->model('system/settings_model','settings');
		
		//get currency data
		$this->load->model('system/currency_model', 'currency_data');
		
		//get country data
		$this->load->model('system/country_model','country');
		
		//get zone(state) data
		$this->load->model('system/zone_model','zone');
		
		//get tax list
		$this->load->model('system/Tax_rates_model','tax_rates');
		
		$this->load->model('common');
		
		$this->lang->load('purchase/purchase_return_lang', 'english');
		
		$this->load->library('commons');
		
		$this->load->library('currency');	
		
		$this->load->library('purchasecart');
		
		$this->load->library('manufacturer');

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
		$this->output->set_common_meta('Purchase','sarpo','This is srapo Purchase page');

	}
		
	
	/**
	* 
	* @function name : index()
	* @description   : load purchase view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'purchase_return_id', $sort_order = 'ASC', $offset = 0)	
	{
		// breadcrumbs
		$this->data['add'] 			 = base_url('purchase/purchase_return/add');
		if($this->session->userdata('role_id')== 1)
		{
			$this->data['delete'] 		= base_url('purchase/purchase_return/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('purchase/purchase_return/softDelete');
		}
		//$this->data['refresh'] 			= base_url('catalog/attributes/refresh');
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Purchase Return',
		   'href' => base_url('purchase/purchase_return'),
		 
		  );
		  

		//pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("purchase/purchase_return/index/$sort_by/$sort_order");
		$total_records = $this->purchase_return->getTotalPurchaseReturn();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->purchase_return->getPurchaseReturns($data);
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
			$url .= '/purchase_return_id';
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
			
			//get manufacturer name 
			$get_manufacturer_data=$this->manufacturers->getManufacturerById($result['manufacturer_id']);
			$manufacturer_name=$get_manufacturer_data['firstname'].' '.$get_manufacturer_data['lastname'];
			
			//get reason text
			$return_action_data=$this->return_action->getReturnActionsById($result['return_action_id']);
			$return_action=$return_action_data['return_action_name'];
			
			//get return reason
			$return_reason_data=$this->return_reason->getReturnReason($result['return_reason_id']) ;
			$return_reason=$return_reason_data['return_reason_name'];
			
			//get return status
			$return_status_data=$this->return_status->getReturnStatusById($result['return_status_id']) ;
			$return_status=$return_status_data['return_status_name'];
			
			//set product opened or not as yes/no
			if($result['opened'] == 1)
			{
				$opened='Yes';
			}
			else
			{
				$opened='No';
			}
			
			$this->data['records'][] = array(
				'purchase_return_id'   	=> $result['purchase_return_id'],
				'purchase_id'   		=> $result['purchase_id'],					
				'purchase_order_id'   	=> $result['purchase_order_id'],
				'manufacturer_id' 		=> $result['manufacturer_id'],
				'manufacturer_name' 	=> $manufacturer_name,
				'product_id'       		=> $result['product_id'],			
				'product_name'   		=> $result['product_name'],
				'model'    			    => $result['model'],
				'opened'				=> $opened,
				'return_reason_id'		=> $result['return_reason_id'],
				'return_reason_name'    => $return_reason,
				'return_action_id'		=> $result['return_action_id'],
				'return_action_name'	=> $return_action,
				'return_status_id'		=> $result['return_status_id'],
				'return_status_name'	=> $return_status,
				'comment'				=> $result['comment'],
				'date_ordered'			=> date($this->common->config('config_date_format'), strtotime($result['date_ordered'])),				
                'is_deleted'    		=> $result['is_deleted'],
				'date_modified'    		=> date($this->common->config('config_date_format'), strtotime($result['date_modified'])),
				'view'           		=> base_url('purchase/purchase_return/view'.$url.'/'.$this->commons->encode($result['purchase_return_id'])),	
				'edit'             		=>base_url('purchase/purchase_return/edit'.$url.'/'.$this->commons->encode($result['purchase_return_id']))
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
		
		if ($this->input->post('selected') !==NULL) {
			$this->data['selected'] = (array)$this->input->post('selected');
		} else {
			$this->data['selected'] = array();
		}
				
		
		$admin_theme = $this->common->config('admin_theme');		
		$content_page="themes/".$admin_theme."/purchase/purchase_return_list";		
		$this->load->view($content_page,$this->data);
	}
	
	/**
	* 
	* @function name : add()
	* @description   : load purchase_return Add view
	* @param   		 : void
	* @return        : void
	*
	*/	
	public function add()	{
		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				
				$this->purchase_return->addPurchaseReturn();
				$this->session->set_userdata('success',$this->lang->line('text_success_purchase_return'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/purchase_return_id';
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
				redirect('purchase/purchase_return/index'.$url);
	     }
		 $this->getForm();
	}
	
	/**
	* 
	* @function name : edit()
	* @description   : edit attribute group records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'purchase_return_id', $sort_order = 'ASC', $offset = 0)
	{			
		//$this->purchase_returncart->remove();
				
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
								
				$this->purchase_return->editPurchaseReturn();
				$this->session->set_userdata('success',$this->lang->line('text_success_purchase_return'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/purchase_return_id';
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
				
				redirect('purchase/purchase_return/index'.$url);
	     }
	   
		$this->getForm();
	}
	
	/**
	* 
	* @function name : view()
	* @description   : load expense detail view
	* @param   		 : void
	* @return        : void
	*
	*/	
	public function view()	{
		
		$this->viewForm();
	}
	
	/**
	* 
	* @function name : viewForm()
	* @description   : Generate Form for Add and Edit Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function viewForm()
	{
		// Generate back url
		$url = '';

		if ($this->uri->segment(4)!==NULL) {
			$url .= '/'.$this->uri->segment(4);
		}
		else
		{
			$url .= '/purchase_return_id';
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
		   'text' => 'Purchase Return',
		   'href' => base_url('purchase/purchase_return'),
		 
		 );
		  
		$this->data['cancel'] 		= base_url('purchase/purchase_return/index'.$url);
		
		// Add or Edit Transaction

		$count = $this->uri->total_segments();
		
		$method = $this->uri->segment(3);
		
		$this->data['text_purchase_return_detail'] 	= $this->lang->line('text_purchase_return_detail');		
		$this->data['text_telephone'] 	= $this->lang->line('text_telephone');
		$this->data['text_email'] 	= $this->lang->line('text_email');
		$this->data['text_manufacturer'] 	= $this->lang->line('text_manufacturer');
		$this->data['text_invoice'] 	= $this->lang->line('text_invoice');
		$this->data['text_date_added'] 	= $this->lang->line('text_date_added');
		$this->data['text_no_results']	= $this->lang->line('text_no_results');	
		$this->data['text_form']  = $this->lang->line('text_view');
		$this->data['form_action'] = base_url('purchase/purchase_return/view');		
		$this->data['purchase_return_id'] = $this->commons->decode($this->uri->segment($count));
		$this->data['purchase_data'] = $this->purchase_return->viewPurchaseReturnProduct($this->data['purchase_return_id']);
		$this->data['view_keyword']=1;
		$purchase_return_data = $this->purchase_return->getPurchaseReturn($this->data['purchase_return_id']);
		$this->data['edit']  = base_url('purchase/purchase_return/edit'.$url.'/'.$this->commons->encode($this->data['purchase_return_id']));
		$this->data['invoice'] = base_url('purchase/purchase_return/invoice/').$this->commons->encode($this->data['purchase_return_id']);
		
	
		$purchase_return_id = $this->commons->decode($this->uri->segment($count));
		$purchase_id=$purchase_return_data['purchase_id'];
		$purchase_order_id=$purchase_return_data['purchase_order_id'];
		$purchase_product_id=$purchase_return_data['purchase_product_id'];
		$product_id=$purchase_return_data['product_id'];
		$return_reason_id=$purchase_return_data['return_reason_id'];		
		$return_action_id=$purchase_return_data['return_action_id'];
		$return_status_id=$purchase_return_data['return_status_id'];
		$total=$purchase_return_data['total'];
		
		//get invoice number from "purchase table"		
		$purchase_data = $this->purchase->viewPurchaseProduct($purchase_id);		
		$invoice_no=$purchase_data['invoice_no'];
		$invoice_prefix=$purchase_data['invoice_prefix'];
			
		if(isset($invoice_prefix) || $invoice_prefix != NULL)
		{
			$this->data['invoice_prefix']=$invoice_prefix;
		}
		else
		{
			$this->data['invoice_prefix']='';
		}
		
		if(isset($invoice_no) || $invoice_no != NULL)
		{
			$this->data['invoice_no']=$invoice_no;
		}
		else
		{
			$this->data['invoice_no']='';
		}
		
		$get_currency_data=$this->currency_data->getCurrencyByCode($this->common->config('config_currency')); 
		$this->data['currency_symbol']=$get_currency_data['symbol_left'];
		
		if(isset($total) || $total != NULL)
		{
			$this->data['total']=$total;
		}
		else
		{
			$this->data['total']='';
		}
		
		//get return reason
		$return_reason_data=$this->return_reason->getReturnReason($return_reason_id);
		$return_reason=$return_reason_data['return_reason_name'];
		
		if(isset($return_reason) || $return_reason != NULL)
		{
			$this->data['return_reason']=$return_reason;
		}
		else
		{
			$this->data['return_reason']='';
		}
		
		//get reason action
		$return_action_data=$this->return_action->getReturnActionsById($return_action_id);
		$return_action=$return_action_data['return_action_name'];
		
		if(isset($return_action) || $return_action != NULL)
		{
			$this->data['return_action']=$return_action;
		}
		else
		{
			$this->data['return_action']='';
		}
		
		//get return status
		$return_status_data=$this->return_status->getReturnStatusById($return_status_id);
		$return_status=$return_status_data['return_status_name'];
		
		if(isset($return_status) || $return_status != NULL)
		{
			$this->data['return_status']=$return_status;
		}
		else
		{
			$this->data['return_status']='';
		}	
		
		//get invoice details from "purchase id" according to purchase_id
		$purchase_data = $this->purchase->getPurchase($purchase_id);
		$invoice_no=$purchase_data['invoice_no'];
		$invoice_prefix=$purchase_data['invoice_prefix'];
				
		$manufacturer_id=$purchase_return_data['manufacturer_id'];		
		$comment=$purchase_return_data['comment'];
		
						
		//convert date
		$date = new DateTime($purchase_return_data['date_added']);
		$purchase_return_date=$date->format("D d M Y"); 
        
		$purchase_return_date1=$date->format("d/m/Y");  
			               
		if(isset($purchase_return_date) || $purchase_return_date != NULL)
		{
			$this->data['purchase_return_date']=$purchase_return_date;
		}
		else
		{
			$this->data['purchase_return_date']='';
		}
				
		if(isset($purchase_return_date1) || $purchase_return_date1 != NULL)
		{
			$this->data['purchase_return_date1']=$purchase_return_date1;
		}
		else
		{
			$this->data['purchase_return_date1']='';
		} 
			     
		//get Manufacturer data
		$manufacturer_data=$this->manufacturers->getManufacturerById($manufacturer_id);
		$manufacturer_name=$manufacturer_data['firstname'].' '.$manufacturer_data['lastname'];
		$manufacturer_email=$manufacturer_data['email'];
		$manufacturer_telephone=$manufacturer_data['telephone'];
		$manufacturer_mobile=$manufacturer_data['mobile'];
		$manufacturer_firstname=$manufacturer_data['firstname'];
		$manufacturer_lastname=$manufacturer_data['lastname'];
		//get manufacturer address
		$manufacturer_address_data=$this->manufacturers->getManufacturerAddressById($manufacturer_id);
		
		$manufacturer_address=$manufacturer_address_data['address_1'].', '.$manufacturer_address_data['city'];
			
		if(isset($purchase_id) || $purchase_id != NULL)
		{
			$this->data['purchase_id']=$purchase_id;
		}
		else
		{
			$this->data['purchase_id']='';
		}
		
		if(isset($purchase_return_id) || $purchase_return_id != NULL)
		{
			$this->data['purchase_return_id']=$purchase_return_id;
		}
		else
		{
			$this->data['purchase_return_id']='';
		}
		
		if(isset($purchase_order_id) || $purchase_order_id != NULL)
		{
			$this->data['purchase_order_id']=$purchase_order_id;
		}
		else
		{
			$this->data['purchase_order_id']='';
		}
		
		if(isset($purchase_product_id) || $purchase_product_id != NULL)
		{
			$this->data['purchase_product_id']=$purchase_product_id;
		}
		else
		{
			$this->data['purchase_product_id']='';
		}
				
		if(isset($product_id) || $product_id != NULL)
		{
			$this->data['product_id']=$product_id;
		}
		else
		{
			$this->data['product_id']='';
		}
		
		
		
		if(isset($manufacturer_address) || $manufacturer_address != NULL)
		{
			$this->data['manufacturer_address']=$manufacturer_address;
		}
		else
		{
			$this->data['manufacturer_address']='';
		}
		
		if(isset($manufacturer_id) || $manufacturer_id != NULL)
		{
			$this->data['manufacturer_id']=$manufacturer_id;
		}
		else
		{
			$this->data['manufacturer_id']='';
		}
		
		if(isset($comment) || $comment != NULL)
		{
			$this->data['comment']=$comment;
		}
		else
		{
			$this->data['comment']='';
		}
		
		
		if(isset($manufacturer_name) || $manufacturer_name != NULL)
		{
			$this->data['manufacturer_name']=$manufacturer_name;
		}
		else
		{
			$this->data['manufacturer_name']='';
		}
		
		if(isset($manufacturer_firstname) || $manufacturer_firstname != NULL)
		{
			$this->data['firstname']=$manufacturer_firstname;
		}
		else
		{
			$this->data['firstname']='';
		}
		
		if(isset($manufacturer_lastname) || $manufacturer_lastname != NULL)
		{
			$this->data['lastname']=$manufacturer_lastname;
		}
		else
		{
			$this->data['lastname']='';
		}
		
		if(isset($manufacturer_email) || $manufacturer_email != NULL)
		{
			$this->data['manufacturer_email']=$manufacturer_email;
		}
		else
		{
			$this->data['manufacturer_email']='';
		}
		
		if(isset($manufacturer_mobile) || $manufacturer_mobile != NULL)
		{
			$this->data['manufacturer_mobile']=$manufacturer_mobile;
		}
		else
		{
			$this->data['manufacturer_mobile']='';
		}
		
		if(isset($manufacturer_telephone) || $manufacturer_telephone != NULL)
		{
			$this->data['manufacturer_telephone']=$manufacturer_telephone;
		}
		else
		{
			$this->data['manufacturer_telephone']='';
		}
		
		if((isset($manufacturer_mobile) || $manufacturer_mobile != NULL) && (isset($manufacturer_telephone) || $manufacturer_telephone != NULL))
		{
			$this->data['manufacturer_contact']=$manufacturer_telephone.', '.$manufacturer_mobile;
		}
		else
		{
			if(isset($manufacturer_mobile) || $manufacturer_mobile != NULL)
			{
				$this->data['manufacturer_contact']=$manufacturer_mobile;
			}
			if(isset($manufacturer_telephone) || $manufacturer_telephone != NULL)
			{
				$this->data['manufacturer_contact']=$manufacturer_telephone;
			}
		}		
		
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/purchase/purchase_return_detail_list";
		$this->load->view($content_page,$this->data);
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
		if (isset($this->error['warning']) || $this->session->userdata('error')!==NULL) {
			if ($this->session->userdata('error')!==NULL)
			{
				$this->error['warning'] = $this->session->userdata('error');
			} 
			$this->data['error'] = $this->error['warning'];
			$this->session->set_userdata('error','');
		} else {
			$this->data['error'] = '';
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
			$url .= '/purchase_return_id';
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
		   'text' => 'Purchase Return',
		   'href' => base_url('purchase/purchase_return'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{					
			$this->data['edit_keyword']='';							
			$this->data['text_form'] 			= $this->lang->line('text_add_purchase_return');
			$this->data['form_action'] 			= base_url('purchase/purchase_return/add'.$url);
			$this->data['purchase_product_id']  = '';
			
			$this->data['cancel'] 		= base_url('purchase/purchase_return/index'.$url);
			
		} 
		else 
		{		
			$this->data['edit_keyword']='1';	
			$this->data['text_form'] 		 	= $this->lang->line('text_edit_purchase_return');
			$this->data['form_action'] 		    = base_url('purchase/purchase_return/edit'.$url.'/'.$this->uri->segment($count));
			$this->data['purchase_id']          = $this->commons->decode($this->uri->segment($count));
		}
		
		$this->data['cancel'] 		= base_url('purchase/purchase_return/index'.$url);
		
		// Set Value Back
		if (1) 
		{
			$purchase_return_info = $this->purchase_return->getPurchaseReturn($this->commons->decode($this->uri->segment($count)));
		}	
		
		if ($this->input->post('purchase_return_id')!==NULL) {
			$this->data['purchase_return_id'] = $this->input->post('purchase_return_id');
		} elseif (!empty($purchase_return_info)) {
			
			$this->data['purchase_return_id'] = $purchase_return_info['purchase_return_id'];
		} else {
			$this->data['purchase_return_id'] = '';
		}
		
		/*if ($this->input->post('select_purchase_id')!==NULL) {
			$this->data['select_purchase_id'] = $this->input->post('select_purchase_id');
		} elseif (!empty($purchase_return_info)) {
			
			$this->data['select_purchase_id'] = $purchase_return_info['purchase_id'];
		} else {
			$this->data['select_purchase_id'] = '';
		}*/
		
		if ($this->input->post('order_id')!==NULL) {
			$this->data['order_id'] = $this->input->post('order_id');
		} elseif (!empty($purchase_return_info)) {
			
			$this->data['order_id'] = $purchase_return_info['purchase_order_id'];
		} else {
			$this->data['order_id'] = '';
		}
		
		if ($this->input->post('purchase_id')!==NULL) {
			$this->data['purchase_id'] = $this->input->post('purchase_id');
		} elseif (!empty($purchase_return_info)) {
			
			$this->data['purchase_id'] = $purchase_return_info['purchase_id'];
		} else {
			$this->data['purchase_id'] = '';
		}
		
		if ($this->input->post('purchase_product_id')!==NULL) {
			$this->data['purchase_product_id'] = $this->input->post('purchase_product_id');
		} elseif (!empty($purchase_return_info)) {
			
			$this->data['purchase_product_id'] = $purchase_return_info['purchase_product_id'];
		} else {
			$this->data['purchase_product_id'] = '';
		}
		
		if ($this->input->post('purchase_order_id')!==NULL) {
			$this->data['purchase_order_id'] = $this->input->post('purchase_order_id');
		} elseif (!empty($purchase_return_info)) {
			
			$this->data['purchase_order_id'] = $purchase_return_info['purchase_order_id'];
		} else {
			$this->data['purchase_order_id'] = '';
		}
		
		if ($this->input->post('manufacturer_id')!==NULL) {
			$this->data['manufacturer_id'] = $this->input->post('manufacturer_id');
		} elseif (!empty($purchase_return_info)) {
			
			$this->data['manufacturer_id'] = $purchase_return_info['manufacturer_id'];
		} else {
			$this->data['manufacturer_id'] = '';
		}
		
		//get manufacturer data
		$manufacturer_info=$this->manufacturers->getManufacturerById($purchase_return_info['manufacturer_id']);	
		
		if ($this->input->post('manufacturer')!==NULL) {
			$this->data['manufacturer'] = $this->input->post('manufacturer');
		} elseif (!empty($manufacturer_info)) {
			
			$this->data['manufacturer'] = $manufacturer_info['firstname'].' '.$manufacturer_info['lastname'];
		} else {
			$this->data['manufacturer'] = '';
		}

		if ($this->input->post('purchase_date')!==NULL) {
			$this->data['purchase_date'] = $this->input->post('purchase_date');
		} elseif (!empty($purchase_return_info)) {
			
			$this->data['purchase_date'] = date($this->common->config('config_date_format'), strtotime($purchase_return_info['date_ordered']));
		} else {
			$this->data['purchase_date'] = '';
		}
		
		
		if ($this->input->post('manufacturer_email')!==NULL) {
			$this->data['manufacturer_email'] = $this->input->post('manufacturer_email');
		} elseif (!empty($manufacturer_info)) {
			$this->data['manufacturer_email'] = $manufacturer_info['email'];
		} else {
			$this->data['manufacturer_email'] = '';
		}
		
		if ($this->input->post('manufacturer_telephone')!==NULL) {
			$this->data['manufacturer_telephone'] = $this->input->post('manufacturer_telephone');
		} elseif (!empty($manufacturer_info)) {
			$this->data['manufacturer_telephone'] = $manufacturer_info['telephone'];
		} else {
			$this->data['manufacturer_telephone'] = '';
		}
		
		if ($this->input->post('manufacturer_mobile')!==NULL) {
			$this->data['manufacturer_mobile'] = $this->input->post('manufacturer_mobile');
		} elseif (!empty($manufacturer_info)) {
			$this->data['manufacturer_mobile'] = $manufacturer_info['mobile'];
		} else {
			$this->data['manufacturer_mobile'] = '';
		}
		
		if ($this->input->post('select_product_name')!==NULL) {
			$this->data['select_product_name'] = $this->input->post('select_product_name');
		} elseif (!empty($purchase_return_info)) {
			$this->data['select_product_name'] = $purchase_return_info['product_id'];
		} else {
			$this->data['select_product_name'] = '';
		}
		
		if ($this->input->post('product_id')!==NULL) {
			$this->data['product_id'] = $this->input->post('product_id');
		} elseif (!empty($purchase_return_info)) {
			$this->data['product_id'] = $purchase_return_info['product_id'];
		} else {
			$this->data['product_id'] = '';
		}
		
		if ($this->input->post('product_model_name')!==NULL) {
			$this->data['product_model_name'] = $this->input->post('product_model_name');
		} elseif (!empty($purchase_return_info)) {
			$this->data['product_model_name'] = $purchase_return_info['model'];
		} else {
			$this->data['product_model_name'] = '';
		}
		
		if ($this->input->post('product_quantity')!==NULL) {
			$this->data['product_quantity'] = $this->input->post('product_quantity');
		} elseif (!empty($purchase_return_info)) {
			$this->data['product_quantity'] = $purchase_return_info['quantity'];
		} else {
			$this->data['product_quantity'] = '';
		}
		
		
		if ($this->input->post('reason_for_return')!==NULL) {
			$this->data['reason_for_return'] = $this->input->post('reason_for_return');
		} elseif (!empty($purchase_return_info)) {
			$this->data['reason_for_return'] = $purchase_return_info['return_reason_id'];
		} else {
			$this->data['reason_for_return'] = '';
		}
		
		if ($this->input->post('return_status')!==NULL) {
			$this->data['return_status'] = $this->input->post('return_status');
		} elseif (!empty($purchase_return_info)) {
			$this->data['return_status'] = $purchase_return_info['return_status_id'];
		} else {
			$this->data['return_status'] = '';
		}		
		
		if ($this->input->post('return_action')!==NULL) {
			$this->data['return_action'] = $this->input->post('return_action');
		} elseif (!empty($purchase_return_info)) {
			$this->data['return_action'] = $purchase_return_info['return_action_id'];
		} else {
			$this->data['return_action'] = '';
		}
		
		if ($this->input->post('product_is_opened')!==NULL) {
			$this->data['product_is_opened'] = $this->input->post('product_is_opened');
		} elseif (!empty($purchase_return_info)) {
			$this->data['product_is_opened'] = $purchase_return_info['opened'];
		} else {
			$this->data['product_is_opened'] = '';
		}
		
		if ($this->input->post('faulty_or_other_details')!==NULL) {
			$this->data['faulty_or_other_details'] = $this->input->post('faulty_or_other_details');
		} elseif (!empty($purchase_return_info)) {
			$this->data['faulty_or_other_details'] = $purchase_return_info['comment'];
		} else {
			$this->data['faulty_or_other_details'] = '';
		}
		
		if ($this->input->post('status')!==NULL) {
			$this->data['status'] = $this->input->post('status');
		} elseif (!empty($purchase_return_info)) {
			$this->data['status'] = $purchase_return_info['status'];
		} else {
			$this->data['status'] = '';
		}		
		
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			if($this->input->post('is_deleted')==1)
			{
			   $this->data['is_deleted'] = $this->input->post('is_deleted'); 
			}else {
				 $this->data['is_deleted'] = 0;
			}
		} elseif (!empty($purchase_return_info)) {
			$this->data['is_deleted'] = $purchase_return_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
		
		//get currency symbol				
		$get_currency_data=$this->currency_data->getCurrencyByCode($this->common->config('config_currency')); 
		$this->data['currency_symbol']=$get_currency_data['symbol_left'];
		$this->data['currency_code']=$this->common->config('config_currency');
		$this->data['currency_value']=$get_currency_data['value'];
		$this->data['currency_id']=$get_currency_data['currency_id'];
		//get list of purchase id
		$this->data['list_purchase_id']=$this->purchase->getPurchases();
		
		//get manufacturer List
		$this->data['manufacturers']=$this->manufacturers->getManufacturer();
		
		//get reason list
		$this->data['list_reason']=$this->return_reason->getReturnReasons();
		
		//get return status list
		$this->data['list_return_status']=$this->return_status->getReturnStatuses();
		
		//get return action list
		$this->data['list_return_action']=$this->return_action->getReturnActions();
		
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/purchase/purchase_return";
		$this->load->view($content_page,$this->data);
	}
	
	/**
	* 
	* @function name : getOrderIdList()
	* @description   : Generate Order id Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function getOrderIdList()
	{
		$this->output->unset_template();
		
		$order_id=$this->input->post('keyword');
		$orders_data=array();
		$data=array();
		$data=array(
				'filter_order_id' => $order_id
			);
		$orders_data=$this->orders->getOrders($data);
				
		echo json_encode($orders_data);
	}
	
	
	/**
	* 
	* @function name : getOrderProductListByOrderId()
	* @description   : get Order Product List By OrderId
	* @param   		 : void
	* @return        : void
	*
	*/
	public function getOrderProductListByOrderId()
	{
		$this->output->unset_template();
		
		$order_id=$this->input->post('order_id');
		if($order_id == "")
		{
			$order_id = 1;
		}
		$orders_data=array();
		$data=array();
		$data=array(
				'filter_order_id' => $order_id
			);
		$orders_data=$this->orders->getOrderProduct($data);
		
		if($this->session->userdata('manufacturer_id'))
		{
			$this->session->unset_userdata('manufacturer_id');
		}
		$this->session->set_userdata('manufacturer_id',$orders_data[0]['manufacturer_id']);
						
		echo json_encode($orders_data);
	}
	
	/**
	* 
	* @function name : getProductListByManufacturerId()
	* @description   : get Order Product List By OrderId
	* @param   		 : void
	* @return        : void
	*
	*/
	public function getProductListByManufacturerId()
	{
		$this->output->unset_template();
		
		$manufacturer_id=$this->input->post('manufacturer_id');
		$orders_data=array();
		$data=array();
		$data=array(
				'filter_order_id' => $manufacturer_id
			);
		$orders_data=$this->orders->getOrderProduct($data);
				
		echo json_encode($orders_data);
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
			
			foreach ($this->input->post('selected') as $purchase_return_id) 
			{				
				$this->purchase_return->deletePurchaseReturn($purchase_return_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success_purchase_return'));
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
			foreach ($this->input->post('selected') as $purchase_return_id) 
			{
				$this->purchase_return->softDeletePurchaseReturn($purchase_return_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success_purchase_return'));
		}
        $this->index();
	}
	
	/**
	* 
	* @function name : validateDelete()
	* @description   : Check attribute group relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{	
         
            return !$this->error;
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
					/*array(
						'field' => 'select_purchase_id',
						'label' => 'Purchase id', 
						'rules' => 'trim|required|xss_clean', 
						'errors' => array('required' => '%s must be fill!')
					),*/
					array(
						'field' => 'select_product_name',
						'label' => 'Product Name', 
						'rules' => 'trim|required|xss_clean', 
						'errors' => array('required' => '%s must be fill!')
					),
					array(
						'field' => 'reason_for_return',
						'label' => 'Reason for return', 
						'rules' => 'trim|required|xss_clean', 
						'errors' => array('required' => '%s must be fill!')
					),
					array(
						'field' => 'return_status',
						'label' => 'Return Status', 
						'rules' => 'trim|required|xss_clean', 
						'errors' => array('required' => '%s must be fill!')
					),
					array(
						'field' => 'return_action',
						'label' => 'Return Action', 
						'rules' => 'trim|required|xss_clean', 
						'errors' => array('required' => '%s must be fill!')
					),
					array(
						'field' => 'product_is_opened',
						'label' => 'product is opened', 
						'rules' => 'trim|required|xss_clean', 
						'errors' => array('required' => '%s must be fill!')
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
	* @function name : checkQauntity()
	* @description   : check quantity in purchase_product table 
	* @param   		 : void
	* @return        : purchase record in json format
	*
	*/
	public function checkQauntity()
	{
		$purchase_id=$this->input->post('purchase');
		$purchase_id=$this->purchase->getPurchaseProducts($purchase_id);
	}
	
	/**
	* 
	* @function name : getManufactuereInfo()
	* @description   : get manufcaturer data from manufcaturer and manufacturer_address table by id
	* @param   		 : void
	* @return        : manufcaturer record in json format
	*
	*/
	public function getManufactuereInfo()
	{
		$this->output->unset_template();
		$manufcaturer_id=(int)$this->input->post('manufacturer_id');
		
		$manufcaturer_info = $this->purchase_return->getManufactuereInfo($manufcaturer_id) ;
		
		$manufcaturer=array();
		if(sizeof($manufcaturer_info) > 0)
		{
			for($i=0;$i<sizeof($manufcaturer_info);$i++)
			{
				$manufcaturer=array(
					'manufacturer_id' => $manufcaturer_info['manufacturer_id'],
					'firstname' => $manufcaturer_info['firstname'],
					'lastname' => $manufcaturer_info['lastname'],
					'email' => $manufcaturer_info['email'],
					'telephone' => $manufcaturer_info['telephone'],	
					'mobile' => $manufcaturer_info['mobile'],
					'date_added' => date($this->common->config('config_date_format'), strtotime($manufcaturer_info['date_added']))			
				);
			}
		}
		
		echo json_encode($manufcaturer);
	}
	
	
	/**
	* 
	* @function name : getProductListAutocomplete()
	* @description   : get Product List Autocomplete
	* @param   		 : void
	* @return        : void
	*
	*/	
	public function getProductListAutocomplete()
	{
		$this->output->unset_template();
        $json = array();
				
        if ($this->input->post('product') !== NULL) {
            $filter_name = $this->input->post('product');
        } else {
            $filter_name = '';
        }

		if ($this->input->post('manufacturer_id') !== NULL) {
            $filter_manufacturer_id = $this->input->post('manufacturer_id');
			
			if($this->session->userdata('manufacturer_id'))
			{
				$this->session->unset_userdata('manufacturer_id');
			}
			$this->session->set_userdata('manufacturer_id',$this->input->post('manufacturer_id'));
			
        } else {
            $filter_manufacturer_id = '';
        }
		
        if ($this->input->post('purchase_id') !== NULL) {
            $filter_purchase_id = $this->input->post('purchase_id');
        } else {
            $filter_purchase_id = '';
        }

        $filter_data = array(
            'filter_name' => $filter_name,
            'filter_purchase_id' => $filter_purchase_id,
			'filter_manufacturer_id' => $filter_manufacturer_id,
            'start' => 0,
            'limit' => 5
        );

		$config_currency=$this->settings->getConfigCurrency();
		$config_currency_code=$config_currency['val'];
		
        $results = $this->purchase_return->getProducts($filter_data);
		
		foreach ($results as $result) {
				$option_data = array();

				$product_options = $this->purchase->getProductOptions($result['product_id']);

				foreach ($product_options as $product_option) {
					$option_info = $this->purchase->getOption($product_option['option_id']);

					if ($option_info) {
						$product_option_value_data = array();

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$option_value_info = $this->purchase->getOptionValue($product_option_value['option_value_id']);

							if ($option_value_info) {
								$product_option_value_data[] = array(
									'product_option_value_id' => $product_option_value['product_option_value_id'],
									'option_value_id'         => $product_option_value['option_value_id'],
									'name'                    => $option_value_info['name'],
									'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $config_currency_code) : false,
									'price_prefix'            => $product_option_value['price_prefix']
								);
							}
						}

						$option_data[] = array(
							'product_option_id'    => $product_option['product_option_id'],
							'product_option_value' => $product_option_value_data,
							'option_id'            => $product_option['option_id'],
							'name'                 => $option_info['name'],
							'type'                 => $option_info['type'],
							'value'                => $product_option['value'],
							'required'             => $product_option['required']
						);
					}
				}

				$json[] = array(
					'product_id' 	=> $result['product_id'],
					'name'       	=> strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),			
					'purchase_product_id' => $result['purchase_product_id'],	
					//'product_name' => $result['product_name'],
					'product_model' => $result['model'],
					'option'     	=> $option_data,
					'price'      	=> $this->currency->format($result['price']),
					'quantity'   	=> $result['quantity'],
		
				);
			}				
		

        $sort_order = array();

        foreach ($json as $key => $value) {
            //$sort_order[$key] = $value['product_name'];
			$sort_order[$key] = $value['name'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

		
        echo json_encode($json);
	}
	
	/**
	* 
	* @function name : getProductList()
	* @description   : get Product List Autocomplete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function getProductList()
	{		
		$this->output->unset_template();
		$data=array(
			'filter_purchase_id' => (int)$this->input->post('purchase_id'),
			'filter_manufacturer_id' => (int)$this->input->post('manufacturer_id')
		);
		$products_info=$this->purchase_return->getProducts($data);
		$products=array_map("unserialize", array_unique(array_map("serialize", $products_info)));
		
		echo json_encode($products);
	}
	
	
	/**
	* 
	* @function name : productOptions()
	* @description   : get Product Options List Autocomplete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function productOptions()
	{		
		$this->output->unset_template();
	
		$productoptions_info=$this->purchase_return->getProductOptions();
		
		echo json_encode($productoptions_info);
	}
	
	/*
	* 
	* @function name : invoice()
	* @description   : invoice generate by $purchase id
	* @param   		 : purchase_id
	* @return        : invoice data
	*
	*/
	public function invoice($purchase_return_id = "") {
        $this->output->unset_template();
		
		$purchase_return_id=$this->commons->decode($purchase_return_id);
		
        $data['title'] = $this->lang->line('text_invoice');
		$data['text_purchase_detail'] = $this->lang->line('text_purchase_detail');
        $data['text_invoice'] = $this->lang->line('text_invoice');
        $data['text_order_detail'] = $this->lang->line('text_order_detail');
        $data['text_order_id'] = $this->lang->line('text_order_id');
        $data['text_invoice_no'] = $this->lang->line('text_invoice_no');
        $data['text_invoice_date'] = $this->lang->line('text_invoice_date');
        $data['text_date_added'] = $this->lang->line('text_date_added');
        $data['text_telephone'] = $this->lang->line('text_telephone');
        $data['text_email'] = $this->lang->line('text_email');
		$data['text_fax'] = $this->lang->line('text_fax');
        $data['text_website'] = $this->lang->line('text_website');      
        $data['text_comment'] = $this->lang->line('text_comment');
		$data['text_order_id'] = $this->lang->line('text_order_id');
		$lang['text_invoice_no'] = $this->lang->line('text_invoice_no');
        $data['column_product'] = $this->lang->line('column_product');
        $data['column_model'] = $this->lang->line('column_model');
        $data['column_quantity'] = $this->lang->line('column_quantity');
        $data['column_price'] = $this->lang->line('column_price');
        $data['column_total'] = $this->lang->line('column_total');

        $data['purchases'] = array();

        $purchases = array();

     		$purchase_return_data = $this->purchase_return->getPurchaseReturn($purchase_return_id);
			
			//currency format
			$currency_code=$purchase_return_data['currency_code'];
			$get_currency_data=$this->currency_data->getCurrencyByCode($currency_code);
			$currency_symbol=$get_currency_data['symbol_left'];
			$currency_decimal_place=$get_currency_data['decimal_place'];
			$currency_value=$get_currency_data['value'];
			
			$purchase_id = $purchase_return_data['purchase_id'];
			$purchase_order_id = $purchase_return_data['purchase_order_id'];
			$purchase_product_id = $purchase_return_data['purchase_product_id'];
			$product_id = $purchase_return_data['product_id'];
			$product_name = $purchase_return_data['product_name'];
			$product_model = $purchase_return_data['model'];
			$product_quantity = $purchase_return_data['quantity'];
			$product_total = $currency_symbol.' '.number_format((float)$purchase_return_data['total'],$currency_decimal_place, '.', '');			
			$comment = $purchase_return_data['comment'];
			$return_reason_id = $purchase_return_data['return_reason_id'];
			$return_action_id = $purchase_return_data['return_action_id'];
			$return_status_id = $purchase_return_data['return_status_id'];
			
			
			if(isset($product_name) || $product_name != NULL)
			{
				$data['product_name']=$product_name;
			}
			else
			{
				$data['product_name']='';
			}
			
			if(isset($product_model) || $product_model != NULL)
			{
				$data['product_model']=$product_model;
			}
			else
			{
				$data['product_model']='';
			}
			
			if(isset($product_quantity) || $product_quantity != NULL)
			{
				$data['product_quantity']=$product_quantity;
			}
			else
			{
				$data['product_quantity']='';
			}
			
			if(isset($product_total) || $product_total != NULL)
			{
				$data['total']=$product_total;
			}
			else
			{
				$data['total']='';
			}
			
			//get return reason
			$return_reason_data=$this->return_reason->getReturnReason($return_reason_id);
			$return_reason=$return_reason_data['return_reason_name'];
			
			if(isset($return_reason) || $return_reason != NULL)
			{
				$data['return_reason']=$return_reason;
			}
			else
			{
				$data['return_reason']='';
			}
			
			//get reason action
			$return_action_data=$this->return_action->getReturnActionsById($return_action_id);
			$return_action=$return_action_data['return_action_name'];
			
			if(isset($return_action) || $return_action != NULL)
			{
				$data['return_action']=$return_action;
			}
			else
			{
				$data['return_action']='';
			}
			
			//get return status
			$return_status_data=$this->return_status->getReturnStatusById($return_status_id);
			$return_status=$return_status_data['return_status_name'];
			
			if(isset($return_status) || $return_status != NULL)
			{
				$data['return_status']=$return_status;
			}
			else
			{
				$data['return_status']='';
			}	
			
			
			//convert date
			$date = new DateTime($purchase_return_data['date_added']);
			$purchase_return_date=$date->format("D d M Y"); 
			
			$purchase_return_date1=$date->format("d/m/Y");  			
								
			if(isset($purchase_return_date) || $purchase_return_date != NULL)
			{
				$data['purchase_return_date']=$purchase_return_date;
			}
			else
			{
				$data['purchase_return_date']='';
			}
			
			if(isset($purchase_return_date1) || $purchase_return_date1 != NULL)
			{
				$data['purchase_return_date1']=$purchase_return_date1;
			}
			else
			{
				$data['purchase_return_date1']='';
			}
			
			if(isset($comment) || $comment != NULL)
			{
				$data['comment']=$comment;
			}
			else
			{
				$data['comment']='';
			}
			
			$purchase_info = $this->purchase->getPurchase($purchase_id);
			/*echo "<pre>";
			print_r($purchase_info);
			echo "</pre>";
			exit;*/
			
			if($purchase_info)
			{
				if ($purchase_info['invoice_no']) {
                    $invoice_no = $purchase_info['invoice_prefix'] . $purchase_info['invoice_no'];
                } else {
                    $invoice_no = '';
                }
			}
			
			$manufacturer_id = $purchase_return_data['manufacturer_id'];
			$manufacturer_info = $this->purchase->manufacturerData($manufacturer_id);
			
			$manufacturer_name=$manufacturer_info['firstname'].' '.$manufacturer_info['lastname'];
			$firstname=$manufacturer_info['firstname'];
			$lastname=$manufacturer_info['lastname'];
			$manufacturer_email=$manufacturer_info['email'];
			$manufacturer_telephone=$manufacturer_info['telephone'];
			$manufacturer_mobile=$manufacturer_info['mobile'];
			$manufacturer_address=$manufacturer_info['address_1'];
			
			$country_data=$this->country->getCountry($manufacturer_info['country_id']);
			$country_name=$country_data['country_name'];
			$state_data=$this->zone->getZone($manufacturer_info['state_id']);
			$state_name=$state_data['state_name'];
			
			if(isset($manufacturer_id) || $manufacturer_id != NULL)
			{
				$data['manufacturer_id']=$manufacturer_id;
			}
			else
			{
				$data['manufacturer_id']='';
			}
			
			if(isset($manufacturer_name) || $manufacturer_name != NULL)
			{
				$data['manufacturer_name']=$manufacturer_name;
			}
			else
			{
				$data['manufacturer_name']='';
			}
			
			if(isset($manufacturer_address) || $manufacturer_address != NULL)
			{
				$data['manufacturer_address']=$manufacturer_address;
			}
			else
			{
				$data['manufacturer_address']='';
			}
			
			if(isset($manufacturer_email) || $manufacturer_email != NULL)
			{
				$data['manufacturer_email']=$manufacturer_email;
			}
			else
			{
				$data['manufacturer_email']='';
			}
			
			if(isset($manufacturer_mobile) || $manufacturer_mobile != NULL)
			{
				$data['manufacturer_mobile']=$manufacturer_mobile;
			}
			else
			{
				$data['manufacturer_mobile']='';
			}
			
			if(isset($manufacturer_telephone) || $manufacturer_telephone != NULL)
			{
				$data['manufacturer_telephone']=$manufacturer_telephone;
			}
			else
			{
				$data['manufacturer_telephone']='';
			}
			
			if((isset($manufacturer_mobile) || $manufacturer_mobile != NULL) && (isset($manufacturer_telephone) || $manufacturer_telephone != NULL))
			{
				$data['manufacturer_contact']=$manufacturer_telephone.', '.$manufacturer_mobile;
			}
			else
			{
				if(isset($manufacturer_mobile) || $manufacturer_mobile != NULL)
				{
					$data['manufacturer_contact']=$manufacturer_mobile;
				}
				if(isset($manufacturer_telephone) || $manufacturer_telephone != NULL)
				{
					$data['manufacturer_contact']=$manufacturer_telephone;
				}
			}	
						
			
			if(isset($purchase_id) || $purchase_id != NULL)
			{
				$data['purchase_id']=$purchase_id;
			}
			else
			{
				$data['purchase_id']='';
			}
			
			if(isset($purchase_return_id) || $purchase_return_id != NULL)
			{
				$data['purchase_return_id']=$purchase_return_id;
			}
			else
			{
				$data['purchase_return_id']='';
			}
			
			if(isset($purchase_order_id) || $purchase_order_id != NULL)
			{
				$data['purchase_order_id']=$purchase_order_id;
			}
			else
			{
				$data['purchase_order_id']='';
			}
			
			if(isset($purchase_product_id) || $purchase_product_id != NULL)
			{
				$data['purchase_product_id']=$purchase_product_id;
			}
			else
			{
				$data['purchase_product_id']='';
			}
					
			if(isset($product_id) || $product_id != NULL)
			{
				$data['product_id']=$product_id;
			}
			else
			{
				$data['product_id']='';
			}						
		
            if ($purchase_return_data) {
                $store_name = $this->common->config('config_store_name');
                $store_address = $this->common->config('config_address');
                $store_email = $this->common->config('config_email');
                $store_telephone = $this->common->config('config_telephone');
                $store_fax = $this->common->config('config_fax');

                if ($purchase_info['invoice_no']) {
                    $invoice_no = $purchase_info['invoice_prefix'] . $purchase_info['invoice_no'];
                } else {
                    $invoice_no = '';
                }
				
				if ($purchase_info['order_id']) {
                    $order_id = $purchase_info['order_id'];
                } else {
                    $order_id = '';
                }
				
				$product_data = array();
				
                $products = $this->purchase->getPurchaseProducts($purchase_id);
				
                /*$product_data = array();
				
                $products = $this->purchase->getPurchaseProducts($purchase_id);

                foreach ($products as $product) {
                    $option_data = array();

                    $options = $this->purchase->getPurchaseProductOptions($purchase_id, $product['purchase_product_id']);

                    foreach ($options as $option) {
                        if ($option['type'] != 'file') {
                            $value = $option['value'];
                        } 
                        else 
                        {
                            
                                $value = '';
                            
                        }

                        $option_data[] = array(
                            'name'  => $option['name'],
                            'value' => $value
                        );
                    }

                    $product_data[] = array(
                        'name'     => $product['name'],
                        'model'    => $product['model'],
                        'option'   => $option_data,
                        'quantity' => $product['quantity'],                       
						'price'    =>$currency_symbol.' '.number_format((float)$product['price'],$currency_decimal_place, '.', ''),
						'total'    => $currency_symbol.' '.number_format((float)$product['total'],$currency_decimal_place, '.', '')
                    );
                }*/

              /* $total_data = array();

                $totals = $this->purchase->getPurchaseTotals($purchase_id);
			
				
				$total_data[] = array(
					'title' => 'Total',											
					'text'    => $currency_symbol.' '.number_format((float)$totals['total'],$currency_decimal_place, '.', '')				
				);*/
					
               
				
                $data['purchases'][] = array(
					'purchase_id'        => $purchase_id,
                    'order_id'           => $order_id,
                    'invoice_no'         => $invoice_no,
					'manufacturer_name'	 => $manufacturer_name,
					'manufacturer_email' => $manufacturer_email,
					'manufacturer_mobile'=> $manufacturer_mobile,
					'manufacturer_address'=>$manufacturer_address,
                    //'date_added'         => date($this->lang->line('date_format_short'), strtotime($purchase_info['date_added'])),
					'date_added'         => $purchase_return_date1,
                    'store_name'         => $store_name,
                    'store_address'      => nl2br($store_address),
                    'store_email'        => $store_email,
                    'store_telephone'    => $store_telephone,
                    'store_fax'          => $store_fax,
                    'email'              => $manufacturer_info['email'],
                    'telephone'          => $manufacturer_info['telephone'],                    
                    'product'            => $product_data,                    
                    //'total'              => $total_data,
                    'comment'            => nl2br($purchase_info['note'])
                );
            }
 		
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/purchase/purchase_return_invoice";
            $this->load->view($content_page,$data);
    }
		
}