<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Expense
* @Auther       : Indrajit,Mitesh
* @Date         : 10-10-2016,20-12-2016
* @Description  : Admin Orders Operation
*
*/

class Expense extends CI_Controller {

	private $data=array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();
		
		$this->load->model('expense/expense_model','expense');
		
		//get expense Category
		$this->load->model('expense/expense_category_model','expense_category');
		
		// Load settings_model
        $this->load->model('system/settings_model','settings');
		
		//get Tax Rates list
		$this->load->model('system/Tax_rates_model','tax_rates');
		
		//get User Type
		$this->load->model('support/ticket_model', 'ticket');
		
		//get currency data
		$this->load->model('system/currency_model','currency');

		$this->lang->load('expense/expense_lang', 'english');

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
		$this->output->set_common_meta('Expense','sarpo','This is srapo Expense page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Orders view
	* @param   		 : void
	* @return        : void
	*
	*/
	/*public function index()	{
		$this->data['add'] 			 = base_url('expense/expense/add');
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Expense',
		   'href' => base_url('expense/expense'),
		 
		  );
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/expense/list_expense";
		$this->load->view($content_page,$this->data);
	}*/
	
	/**
	* 
	* @function name : index()
	* @description   : load purchase view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'expense', $sort_order = 'ASC', $offset = 0)	
	{
		
		// breadcrumbs
		$this->data['add'] 			 = base_url('expense/expense/add');
		$this->data['view'] 			 = base_url('expense/expense/view');
		if($this->session->userdata('finance_role_id')== 3)
		{
			$this->data['delete'] 		= base_url('expense/expense/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('expense/expense/softDelete');
		}
		//$this->data['refresh'] 			= base_url('catalog/information/refresh');
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		  
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Expense',
		   'href' => base_url('expense/expense'),
		 
		  );
		  
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("expense/expense/index/$sort_by/$sort_order");
		$total_records = $this->expense->getTotalExpense();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->expense->getExpenses($data);
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
			$url .= '/expense_name';
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
			//get User data
			$expense_user_id=$result['user_id'];
			$expense_user_type_id=$result['user_type_id'];
			$get_user_data=$this->expense->getUserDataByUserId($expense_user_id,$expense_user_type_id);
			$expense_user_name=$get_user_data['user_name'];	
				
			$this->data['records'][] = array(				
				'expense_id'   	 => $result['expense_id'],
				'expense_date' 	 => date($this->common->config('config_date_format'), strtotime($result['expense_date'])),
				'reference'      => $result['reference'],
				'expense_amount' => $result['expense_amount'],
				'note'           => $result['note'],
				'user_name'	 => $expense_user_name,
				'view'           => base_url('expense/expense/view'.$url.'/'.$this->commons->encode($result['expense_id'])),			
				'edit'           => base_url('expense/expense/edit'.$url.'/'.$this->commons->encode($result['expense_id']))
				
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
		$content_page="themes/".$admin_theme."/expense/expense_list";
		$this->load->view($content_page,$this->data);
	}
	
	/**
	* 
	* @function name : add()
	* @description   : load expense Add view
	* @param   		 : void
	* @return        : void
	*
	*/	
	public function add()	{
			
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				
				$this->expense->addExpense();
								
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
								
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/expense_name';
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
				redirect('expense/expense/index'.$url);
	     }
		$this->getForm();
	}
	
	/**
	* 
	* @function name : edit()
	* @description   : edit expense records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'expense_name', $sort_order = 'ASC', $offset = 0)
	{		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/expense_name';
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
				
				/*if ($this->input->post('is_deleted') == 1) {
					$res = $this->validateSoftDelete($this->input->post('expense_id'));
					if($res==0)
					{
						$this->session->set_userdata('error',$this->error['warning']);
						redirect('expense/expense/edit'.$url.'/'.$this->commons->encode($this->input->post('expense_id')));  
					}
				} */
				$this->expense->editExpense();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				redirect('expense/expense/index'.$url);
				
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
			
		/*if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				
				$this->expense->viewExpense();
								
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
								
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/expense_name';
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
				redirect('expense/expense/index'.$url);
	     }*/
		
		//$this->session->set_userdata('success',$this->lang->line('text_success'));
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
			$url .= '/expense_name';
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
		   'text' => 'Expense',
		   'href' => base_url('expense/expense'),
		 
		 );
		  
		$this->data['cancel'] 		= base_url('expense/expense/index'.$url); 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		
		$method = $this->uri->segment(3);
		
		$this->data['text_form']  = $this->lang->line('text_view');
		$this->data['form_action'] = base_url('expense/expense/view');		
		$this->data['expense_id'] = $this->commons->decode($this->uri->segment($count));
		$this->data['expense_data'] = $this->expense->viewExpense($this->data['expense_id']);
		
		$expense_data = $this->expense->viewExpense($this->data['expense_id']);
		$expense_reference=$expense_data['reference'];
		$expense_user_id=$expense_data['user_id'];
		$expense_user_type_id=$expense_data['user_type_id'];
		$get_expense_amount=$expense_data['expense_amount'];
		$expense_note=$expense_data['note'];
		$expense_tax_id=$expense_data['tax_id'];
		$expense_name=$expense_data['expense_name'];
		
		//currency format
		$currency_code=$expense_data['currency_code'];
		$get_currency_data=$this->currency->getCurrencyByCode($currency_code);
		$currency_symbol=$get_currency_data['symbol_left'];
		$currency_decimal_place=$get_currency_data['decimal_place'];
		$currency_value=$get_currency_data['value'];		
		$expense_amount=$currency_symbol.' '.number_format((float)$get_expense_amount, 2, '.', ''); 
				
				
		//get tax rate
		$tax_data=$this->tax_rates->getTaxRatesById($expense_tax_id);
		$tax_name=$tax_data['name'];
		$tax_rate=$tax_data['rate'];
		$tax_type=$tax_data['type'];
		
		if($tax_type == 'F')
		{
			$tax_symbol = $currency_symbol;
			$tax_payable_amount=$tax_rate;
			$payable_amount=(float)$get_expense_amount+(float)$tax_rate;
		}
		else
		{
			//$tax_symbol = '%';
			$tax_symbol = $currency_symbol;
			$tax_payable_amount=((float)$get_expense_amount*(float)$tax_rate)/100;
			$payable_amount=(float)$get_expense_amount+(float)$tax_payable_amount;
		}
				
		//convert date
		$date = new DateTime($expense_data['expense_date']);
		$expense_date=$date->format("D d M Y"); 
                            
		if(isset($expense_date) || $expense_date != NULL)
		{
			$this->data['expense_date']=$expense_date;
		}
		else
		{
			$this->data['expense_date']='';
		}
		
		if(isset($expense_name) || $expense_name != NULL)
		{
			$this->data['expense_name']=$expense_name;
		}
		else
		{
			$this->data['expense_name']='';
		}
		
		//get User data
		$get_user_data=$this->expense->getUserDataByUserId($expense_user_id,$expense_user_type_id);
		$expense_user_name=$get_user_data['user_name'];
		/*echo "<pre>";
		print_r($get_user_data);
		echo "<pre>";
		exit;*/
		
		if(isset($expense_reference) || $expense_reference != NULL)
		{
			$this->data['expense_reference']=$expense_reference;
		}
		else
		{
			$this->data['expense_reference']='';
		}
		
		if(isset($currency_symbol) || $currency_symbol != NULL)
		{
			$this->data['currency_symbol']=$currency_symbol;
		}
		else
		{
			$this->data['currency_symbol']='';
		}
		
		if(isset($tax_symbol) || $tax_symbol != NULL)
		{
			$this->data['tax_symbol']=$tax_symbol;
		}
		else
		{
			$this->data['tax_symbol']='';
		}
		
		if(isset($tax_type) || $tax_type != NULL)
		{
			$this->data['tax_type']=$tax_type;
		}
		else
		{
			$this->data['tax_type']='';
		}
		
		if(isset($expense_amount) || $expense_amount != NULL)
		{
			$this->data['expense_amount']=$expense_amount;
		}
		else
		{
			$this->data['expense_amount']='';
		}
		
		if(isset($expense_note) || $expense_note != NULL)
		{
			$this->data['expense_note']=$expense_note;
		}
		else
		{
			$this->data['expense_note']='';
		}
		
		if(isset($expense_user_name) || $expense_user_name != NULL)
		{
			$this->data['expense_user_name']=$expense_user_name;
		}
		else
		{
			$this->data['expense_user_name']='';
		}
		
		if(isset($tax_name) || $tax_name != NULL)
		{
			$this->data['expense_tax_name']=$tax_name;
		}
		else
		{
			$this->data['expense_tax_name']='';
		}
		
		if(isset($tax_payable_amount) || $tax_payable_amount != NULL)
		{
			$this->data['tax_payable_amount']=$tax_payable_amount;
		}
		else
		{
			$this->data['tax_payable_amount']='';
		}
		
		if(isset($payable_amount) || $payable_amount != NULL)
		{
			$this->data['payable_amount']=$payable_amount;
		}
		else
		{
			$this->data['payable_amount']='';
		}
		
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/expense/expense_detail";
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
			$url .= '/expense_name';
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
		   'text' => 'Expense',
		   'href' => base_url('expense/expense'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		
		$method = $this->uri->segment(3);
		
		if ($method=='add') 
		{										
			$this->data['text_form'] 		= $this->lang->line('text_add');
			$this->data['form_action'] = base_url('expense/expense/add'.$url);
			$this->data['expense_id'] = '';
		} 
		/*else if($method == 'view')
		{
			//echo "View";
			$this->data['text_form'] 		= $this->lang->line('text_view');
			$this->data['form_action'] = base_url('expense/expense/view'.$url);
			
			$this->data['expense_id'] = $this->commons->decode($this->uri->segment($count));
		}*/
		else 
		{		
			//echo "Edit";
			$this->data['text_form'] 		= $this->lang->line('text_edit');
			$this->data['form_action'] = base_url('expense/expense/edit'.$url.'/'.$this->uri->segment($count));
			
			$this->data['expense_id'] = $this->commons->decode($this->uri->segment($count));
		}
		//$this->data['refresh'] 		= base_url('expense/expense/refresh');
		$this->data['cancel'] 		= base_url('expense/expense/index'.$url);
		
		// Set Value Back
		if (1) 
		{
			$expense_info = $this->expense->getExpense($this->commons->decode($this->uri->segment($count)));
		}	
		
			
		if ($this->input->post('user_type')!==NULL) {
			$this->data['user_type_id'] = $this->input->post('user_type');
		} elseif (!empty($expense_info)) {
			$this->data['user_type_id'] = $expense_info['user_type_id'];
		} else {
			$this->data['user_type_id'] = '';
		}		
		
		if ($this->input->post('user_id')!==NULL) {
			$this->data['user_id'] = $this->input->post('user_id');
		} elseif (!empty($expense_info)) {
			
			$this->data['user_id'] = $expense_info['user_id'];
		} else {
			$this->data['user_id'] = '';
		}		
		
		if ($this->input->post('expense_date')!==NULL) {
			$this->data['expense_date'] = $this->input->post('expense_date');
		} elseif (!empty($expense_info)) {			
			$this->data['expense_date'] = date("d-m-Y", strtotime($expense_info['expense_date']));					
		} else {
			$this->data['expense_date'] = '';
		}		
		
		if ($this->input->post('reference')!==NULL) {
			$this->data['reference'] = $this->input->post('reference');
		} elseif (!empty($expense_info)) {			
			$this->data['reference'] = $expense_info['reference'];					
		} else {
			$this->data['reference'] = '';
		}	
		
		if ($this->input->post('expense_category')!==NULL) {
			$this->data['expense_category_id'] = $this->input->post('expense_category');
		} elseif (!empty($expense_info)) {			
			$this->data['expense_category_id'] = $expense_info['expense_category_id'];					
		} else {
			$this->data['expense_category_id'] = '';
		}
		
		if ($this->input->post('amount')!==NULL) {
			$this->data['expense_amount'] = $this->input->post('amount');
		} elseif (!empty($expense_info)) {			
			$this->data['expense_amount'] = $expense_info['expense_amount'];					
		} else {
			$this->data['expense_amount'] = '';
		}
		
		if ($this->input->post('description')!==NULL) {
			$this->data['note'] = $this->input->post('description');
		} elseif (!empty($expense_info)) {			
			$this->data['note'] = $expense_info['note'];					
		} else {
			$this->data['note'] = '';
		}
		
		if ($this->input->post('payment_method')!==NULL) {
			$this->data['payment_method_id'] = $this->input->post('payment_method');
		} elseif (!empty($expense_info)) {			
			$this->data['payment_method_id'] = $expense_info['payment_method'];					
		} else {
			$this->data['payment_method_id'] = '';
		}
		
		if ($this->input->post('expense_name')!==NULL) {
			$this->data['expense_name'] = $this->input->post('expense_name');
		} elseif (!empty($expense_info)) {
			
			$this->data['expense_name'] = $expense_info['expense_name'];
		} else {
			$this->data['expense_name'] = '';
		}	
		
		if ($this->input->post('tax')!==NULL) {
			$this->data['tax_id'] = $this->input->post('tax');
		} elseif (!empty($expense_info)) {			
			$this->data['tax_id'] = $expense_info['tax_id'];					
		} else {
			$this->data['tax_id'] = '';
		}
		
		if ($this->input->post('HAttachments')!==NULL) {
			$this->data['attachment'] = $this->input->post('HAttachments');
		} elseif (!empty($expense_info)) {			
			$this->data['attachment'] = $expense_info['attachment'];					
		} else {
			$this->data['attachment'] = '';
		}
		
		if ($this->input->post('status')!==NULL)
                {
			$this->data['status'] = $this->input->post('status');
		} elseif (!empty($expense_info)) {
			$this->data['status'] = $expense_info['status'];
		} else {
			$this->data['status'] = 0;
		}
		

		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			if($this->input->post('is_deleted')==1)
			{
			   $this->data['is_deleted'] = $this->input->post('is_deleted'); 
			}else {
				 $this->data['is_deleted'] = 0;
			}
		} elseif (!empty($expense_info)) {
			$this->data['is_deleted'] = $expense_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
		
			
		//get expense category
		$this->data['expense_categories']=$this->expense_category->getExpenseCategories();
		//get setting config currrency
		$this->data['config_currency']=$this->common->config('config_currency');		
		//get payment methods
		$this->data['payment_methods']=$this->expense->getPaymentMethods();
		//get Tax Rates
		$this->data['tax_rates']=$this->tax_rates->getTaxRates();
		//get user type
		$this->data['user_groups'] = $this->ticket->getUserGroups();
		//get currencydetail
		$this->data['currency_data']=$this->currency->getCurrencyByCode($this->common->config('config_currency')); 
		
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/expense/expense";
		$this->load->view($content_page,$this->data);
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
					        'field' => 'expense_name',
					        'label' => 'Expense Name', 
					        'rules' => 'trim|required|xss_clean', 
					        'errors' => array('required' => '%s must be fill!')
					    ),
					    array(
					        'field' => 'amount',
					        'label' => 'Expense Amount', 
					        'rules' => 'trim|required|numeric|xss_clean', 
					        'errors' => array('required' => '%s must be fill!','numeric' => '%s must be digits')
					    ),
						array(
					        'field' => 'user_type',
					        'label' => 'User Type', 
					        'rules' => 'trim|required|xss_clean', 
					        'errors' => array('required' => '%s must be fill!')
					    ),
					    array(
					        'field' => 'user_list',
					        'label' => 'User List', 
					        'rules' => 'trim|required|xss_clean', 
					        'errors' => array('required' => '%s must be fill!')
					    ),
						array(
					        'field' => 'expense_date',
					        'label' => 'Expense Date', 
					        'rules' => 'trim|required|xss_clean', 
					        'errors' => array('required' => '%s must be fill!')
					    ),
						array(
					        'field' => 'expense_category',
					        'label' => 'Expense Category', 
					        'rules' => 'trim|required|xss_clean', 
					        'errors' => array('required' => '%s must be fill!')
					    ),
						
					   
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
			foreach ($this->input->post('selected') as $expense_id) 
			{
				$this->expense->deleteExpense($expense_id);
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
	* @function name : validateDelete()
	* @description   : Check expense relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{           
			$this->error=array();
            foreach ($this->input->post('selected') as $expense_id) 
            {                              
                //$expense_info = $this->expense->getExpense($expense_id);
				/*echo "<pre>";
				print_r( $expense_info );
				echo "</pre>";
				exit;*/
				/*if ($expense_info > 0) 
				{
					
					//$this->error['warning'] = $this->lang->line('error_default');					
				}  */            
                
            }
            return !$this->error;
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
			foreach ($this->input->post('selected') as $expense_id) 
			{
				$this->expense->softDeleteExpense($expense_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success'));
			$this->index();
		}
	}
	
	/**
	* 
	* @function name : view()
	* @description   : view detail Record
	* @param   		 : void
	* @return        : void
	*
	*/
	/*public function view()
	{
		if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
		{
			foreach ($this->input->post('selected') as $expense_id) 
			{
				$this->expense->softDeleteExpense($expense_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success'));
			$this->index();
		}
	}*/
	
	/**
	* 
	* @function name 	: check_exists_expense_category_name()
	* @description   	: Validate for expense category name existing or not
	* @access 			: public
	* @param   			: void
	* @return        	: boolean
	*
	*/
   /* function check_exists_expense_name($str)
	{
	  	$this->db->from('expense');
		$this->db->where('expense_name',$str);
        $this->db->where('is_deleted=0');
		if($this->input->post('expense_id') != "")
		{
			$this->db->where('expense_id !=',$this->input->post('expense_id'));
		}
		$query=$this->db->get();
		$row = $query->num_rows();
		if($row > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		} 
	} */   
	
}
