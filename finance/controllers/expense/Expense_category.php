<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Expense Category
* @Auther       : Mitesh
* @Date         : 20-12-2016
* @Description  : Expense Category Related Collection of functions
*
*/

class Expense_category extends CI_Controller {

	private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('expense/expense_category_model','expense_category');
		
		$this->lang->load('expense/expense_category_lang', 'english');
		
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
		$this->output->set_template('finance_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Expense Category','sarpo','This is srapo Expense Category page');
		

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load currency view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'expense_category_name', $sort_order = 'ASC', $offset = 0)	
	{	
		// breadcrumbs
		$this->data['add'] 			 = base_url('expense/expense_category/add');
		if($this->session->userdata('role_id')== 1)
		{
			$this->data['delete'] 		= base_url('expense/expense_category/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('expense/expense_category/softDelete');
		}
		//$this->data['refresh'] 			= base_url('expense/expense_category/refresh');
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		  
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Expense Categories',
		   'href' => base_url('expense/expense_category'),
		 
		  );
		  
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("expense/expense_category/index/$sort_by/$sort_order");
		$total_records = $this->expense_category->getTotalExpenseCategory();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->expense_category->getExpenseCategories($data);
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
			$url .= '/expense_category_name';
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
				'expense_category_id'   => $result['expense_category_id'],				
				'expense_category_name' => $result['expense_category_name'],
				'status'        		=> $result['status'],                			
				'edit'          		=>base_url('expense/expense_category/edit'.$url.'/'.$this->commons->encode($result['expense_category_id']))
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
		//print_r($this->data);
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/expense/expense_category_list";
		$this->load->view($content_page,$this->data);

	}
	
	/**
	* 
	* @function name : add()
	* @description   : load currency Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	
	public function add()	{
	
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				$this->expense_category->addExpenseCategory();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/title';
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
				redirect('expense/expense_category');
	     }
		$this->getForm();
	}
	
	/**
	* 
	* @function name : edit()
	* @description   : edit currency records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'expense_category_name', $sort_order = 'ASC', $offset = 0)
	{
		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				 
				 	$this->expense_category->editExpenseCategory();
					$this->session->set_userdata('success',$this->lang->line('text_success'));
								
                    // Generate back url
                    $url = '';

                    if ($this->uri->segment(4)!==NULL) {
                            $url .= '/'.$this->uri->segment(4);
                    }
                    else
                    {
                            $url .= '/expense_category_name';
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
                    
                   
                    redirect('expense/expense_category/index'.$url);
				
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
			foreach ($this->input->post('selected') as $expense_category_id) 
			{
				$this->expense_category->deleteExpenseCategory($expense_category_id);
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
			foreach ($this->input->post('selected') as $expense_category_id) 
			{
				$this->expense_category->softDeleteExpenseCategory($expense_category_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success'));
			
		}
                $this->index();
	}
	
	/**
	* 
	* @function name : refresh()
	* @description   : soft Delete Records
	* @param   		 : void
	* @return        : void
	*
	*/
	/*public function refresh()
	{
		$this->currency->refresh(true);

		
		$this->session->set_userdata('success',$this->lang->line('text_success'));
		//redirect('system/currency/index');
		$this->index();
	}*/
	
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
                            //echo "Error".$this->session->userdata('error'); exit;
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
			$url .= '/expense_category_name';
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
		   'text' => 'Expense Categories',
		   'href' => base_url('expense/expense_category'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{
			$this->data['form_action'] = base_url('expense/expense_category/add'.$url);
			$this->data['expense_category_id'] = '';
			$this->data['text_form'] 		= $this->lang->line('text_add');
		} 
		else 
		{
			$this->data['form_action'] = base_url('expense/expense_category/edit'.$url.'/'.$this->uri->segment($count));
			$this->data['text_form'] 		= $this->lang->line('text_edit');
			
			$this->data['currency_id'] = $this->commons->decode($this->uri->segment($count));
		}
		//$this->data['refresh'] 		= base_url('expense/expense_category/refresh');
		$this->data['cancel'] 		= base_url('expense/expense_category/index'.$url);
		
		
		// Set Value Back
		if (1) 
		{
			$expense_category_info = $this->expense_category->getExpenseCategory($this->commons->decode($this->uri->segment($count)));
		}
		
		if ($this->input->post('expense_category_id')!==NULL) {
			$this->data['expense_category_id'] = $this->input->post('expense_category_id');
		} elseif (!empty($expense_category_info)) {
			
			$this->data['expense_category_id'] = $expense_category_info['expense_category_id'];
		} else {
			$this->data['expense_category_id'] = '';
		}
		
		if ($this->input->post('expense_category_name')!==NULL) {
			$this->data['expense_category_name'] = $this->input->post('expense_category_name');
		} elseif (!empty($expense_category_info)) {
			
			$this->data['expense_category_name'] = $expense_category_info['expense_category_name'];
		} else {
			$this->data['expense_category_name'] = '';
		}

		if ($this->input->post('transaction')!==NULL) {
			$this->data['transaction'] = $this->input->post('transaction');
		} elseif (!empty($expense_category_info)) {
			
			$this->data['transaction'] = $expense_category_info['transaction'];
		} else {
			$this->data['transaction'] = '';
		}
		if ($this->input->post('status')!==NULL)
        {
			$this->data['status'] = $this->input->post('status');
		} elseif (!empty($expense_category_info)) {
			$this->data['status'] = $expense_category_info['status'];
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
		} elseif (!empty($expense_category_info)) {
			$this->data['is_deleted'] = $expense_category_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
		
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/expense/expense_category";
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
					        'field' => 'expense_category_name',
					        'label' => 'Expense Category Name', 
					        'rules' => 'trim|required|min_length[3]|max_length[128]|xss_clean|callback_check_exists_expense_category_name', 
					        'errors' => array('required' => '%s must be between 3 and 128 characters!','min_length'=>'%s must be between 3 and 128 characters!','max_length'=>'%s must be between 3 and 128 characters!','check_exists_title'=>'%s already exists!')
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
	* @description   : Check currency relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{           
		foreach ($this->input->post('selected') as $currency_id) 
		{
			$expense_category_info = $this->expense_category->getUsedExpenseCategory($currency_id);
			if ($expense_category_info > 0) 
			{
				$this->error['warning'] = $this->lang->line('error_default');
			}                
		   
		}
		return !$this->error;
	}
        
        /**
	* 
	* @function name : validateSoftDelete()
	* @description   : Check currency relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateSoftDelete($currency_id) 
	{           
          	$expense_category_info = $this->expense_category->getUsedExpenseCategory($currency_id);
			if ($expense_category_info > 0) 
			{
				$this->error['warning'] = $this->lang->line('error_default');
			}   
           
            return !$this->error;
	}
        
	/**
	* 
	* @function name 	: check_exists_title()
	* @description   	: Validate for currency title existing or not
	* @access 		: public
	* @param   		: void
	* @return        	: boolean
	*
	*/
    function check_exists_title($str)
	{
		$this->db->from('currency');
		$this->db->where('LOWER(title)',strtolower($str));
                $this->db->where('is_deleted=0');
		if($this->input->post('currency_id') !="")
		{
			$this->db->where('currency_id !=',$this->input->post('currency_id'));
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
	}
	 
	/**
	* 
	* @function name 	: check_exists_expense_category_name()
	* @description   	: Validate for expense category name existing or not
	* @access 			: public
	* @param   			: void
	* @return        	: boolean
	*
	*/
    function check_exists_expense_category_name($str)
	{
	  	$this->db->from('expense_category');
		$this->db->where('expense_category_name',$str);
        $this->db->where('is_deleted=0');
		if($this->input->post('expense_category_id') != "")
		{
			$this->db->where('expense_category_id !=',$this->input->post('expense_category_id'));
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
	}    
	
}
