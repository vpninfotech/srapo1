<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Filter
* @Auther       : Indrajit
* @Date         : 10-11-2016
* @Description  : Filter Related Collection of functions
*
*/

class Filter extends CI_Controller {

private $data=array();
private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('catalog/filter_model','filter');
		
		$this->lang->load('catalog/filter_lang', 'english');
		
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
		$this->output->set_template('dataoperator_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Filter','sarpo','This is srapo Filter page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Filter view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'filter_group_name', $sort_order = 'ASC', $offset = 0)
	{

		$this->data['add'] = base_url('catalog/filter/add');
		if($this->session->userdata('Drole_id')== 1)
		{
			$this->data['delete'] 		= base_url('catalog/filter/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('catalog/filter/softDelete');
		}
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Filters',
		   'href' => base_url('catalog/filter'),
		 
		  );
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);

		$url = base_url("catalog/filter/index/$sort_by/$sort_order");
		$total_records = $this->filter->getTotalFilters();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->filter->getFilters($data);
		$this->data['pages'] = ceil($total_records/$limit);
		$this->data['totals'] = ceil($total_records);
		$this->data['range'] = ceil($offset+1);
		// echo "<pre>";
		// print_r($results);exit;
		// URL creation
		$url='';
		if ($this->uri->segment(4)!==NULL) {
			$url .= '/'.$this->uri->segment(4);
		}
		else
		{
			$url .= '/filter_group_name';
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
				'filter_group_id'   => $result['filter_group_id'],
				'filter_group_name'         => $result['filter_group_name'],
				'sort_order'          => $result['sort_order'],
				'date_modified' => date($this->common->config('config_date_format'), strtotime($result['date_added'])),
				'edit'          =>base_url('catalog/filter/edit'.$url.'/'.$this->commons->encode($result['filter_group_id']))
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
		$content_page="themes/".$admin_theme."/catalog/filter_list";
		$this->load->view($content_page,$this->data);
	}
	
	/**
	* 
	* @function name : add()
	* @description   : load Filter Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function add()	{
		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				$this->filter->addFilter();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/filter_group_name';
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
				redirect('catalog/filter');
	     }
		$this->getForm();
	}
	/**
	* 
	* @function name : edit()
	* @description   : edit filter records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'title', $sort_order = 'ASC', $offset = 0)
	{
		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				 
				$this->filter->editFilter();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/filter_group_name';
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
				
				redirect('catalog/filter/index'.$url,'refresh');
				
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
			foreach ($this->input->post('selected') as $filter_group_id) 
			{
				$this->filter->deleteFilter($filter_group_id);
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
			foreach ($this->input->post('selected') as $filter_group_id) 
			{
				$this->filter->softDeleteFilter($filter_group_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success'));
			//redirect('catalog/category/filter');
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
			$url .= '/filter_group_name';
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
		   'text' => 'Filters',
		   'href' => base_url('catalog/filter'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{
			$this->data['form_action'] = base_url('catalog/filter/add'.$url);
			$this->data['filter_group_id'] = '';
			$this->data['text_form'] 		= $this->lang->line('text_add');
		} 
		else 
		{
			$this->data['form_action'] = base_url('catalog/filter/edit'.$url.'/'.$this->uri->segment($count));
			$this->data['text_form'] 		= $this->lang->line('text_edit');
			
			$this->data['filter_group_id'] = $this->commons->decode($this->uri->segment($count));
		}
		$this->data['cancel'] 		= base_url('catalog/filter/index'.$url);
		
		
		// Set Value Back
		if (1) 
		{
			$currency_info = $this->filter->getFilter($this->commons->decode($this->uri->segment($count)));
		}
		
		
		if ($this->input->post('filter_group_name')!==NULL) {
			$this->data['filter_group_name'] = $this->input->post('filter_group_name');
		} elseif (!empty($currency_info)) {
			
			$this->data['filter_group_name'] = $currency_info['filter_group_name'];
		} else {
			$this->data['filter_group_name'] = '';
		}
		if ($this->input->post('sort_order')!==NULL) {
			$this->data['sort_order'] = $this->input->post('sort_order');
		} elseif (!empty($currency_info)) {
			$this->data['sort_order'] = $currency_info['sort_order'];
		} else {
			$this->data['sort_order'] = '';
		}
		$this->data['filter']=array();
		if ($this->input->post('filter_name')!==NULL) 
		{
			$filter_name = $this->input->post('filter_name');
		}
		elseif(!empty($currency_info))
		{
			$filter_list=$this->filter->getFilterList($this->commons->decode($this->uri->segment($count)));
                        
                       
			$temp_filter_name = array();
			$temp_filter_sort_order = array();
			foreach ($filter_list as $key => $value)
			{
				$temp_filter_name[$key]['name']        = $value['filter_name'];
				$temp_filter_name[$key]['sort_order']  = $value['sort_order'];
			}
			$filter_name       = $temp_filter_name ;
			
		}
		else
		{
				$filter_name = array();
			 
		}
                
                $this->data['filter'] = $filter_name;
                
		if ($this->input->server('REQUEST_METHOD') == 'POST')
                {
                    if($this->input->post('is_deleted')==1)
                    {
                       $this->data['is_deleted'] = $this->input->post('is_deleted'); 
                    }else {
                         $this->data['is_deleted'] = 0;
                    }
                } elseif (!empty($currency_info)) {
                        $this->data['is_deleted'] = $currency_info['is_deleted'];
                } else {
                        $this->data['is_deleted'] = 0;
                }
		//echo '<pre>'.$count;print_r($this->data);
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/catalog/filter";
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
					        'field' => 'filter_group_name',
					        'label' => 'Filter Group Name', 
					        'rules' => 'trim|required|xss_clean|min_length[1]|max_length[64]|callback_check_exists_filter_group_name', 
					        'errors' => array('required' => '%s  must be between 1 and 64 characters!','min_length'=>'%s must be between 1 and 64 characters!','max_length'=>'%s must be between 1 and 64 characters!','check_exists_filter_group_name'=>'%s is already exists!')
					    ),
					    
					    
					    
					);
			$filter=$this->input->post('filter_name');
			if(count($filter)>0)
			{
				foreach($filter as $key=>$val) 
				{
					$this->form_validation->set_rules("filter_name[".$key."][name]", "Filter Name", "trim|required|xss_clean|min_length[1]|max_length[64]", array('required' => '%s  must be between 1 and 64 characters!','min_length'=>'%s must be between 1 and 64 characters!','max_length'=>'%s must be between 1 and 64 characters!'));
				    
				}
			}
			$this->form_validation->set_rules($validation);
			if ($this->form_validation->run() == FALSE){
				
				return FALSE;
	        }
	        else{
	        	
	        	return TRUE;
	        }
	}
	/**
	* 
	* @function name 	: check_exists_filter_group_name()
	* @description   	: Validate for currency title existing or not
	* @access 		: public
	* @param   		: void
	* @return        	: boolean
	*
	*/
    function check_exists_filter_group_name($str)
	{
		$this->db->from('filter_group');
		$this->db->where('LOWER(filter_group_name)',strtolower($str));
                $this->db->where('is_deleted=0');
		if($this->input->post('filter_group_id') !="")
		{
			$this->db->where('filter_group_id !=',$this->input->post('filter_group_id'));
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
	* @function name : validateDelete()
	* @description   : Check filter relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{
		$this->load->model('catalog/category_model');
		$this->load->model('catalog/product_model');
		foreach ($this->input->post('selected') as $filter_id) 
		{                    
			$category_total = $this->category_model->getTotalCategoryByFilterId($filter_id);
			if($category_total)
			{
			   $this->error['warning'] = $this->lang->line('error_category').'('.$category_total.')'; 
			} 
			
			$product_total = $this->product_model->getTotalProductByFilterId($filter_id);
			if ($product_total) 
			{
				$this->error['warning'] = $this->lang->line('error_product').'('.$product_total.')'; 
			}                   
		}
		return !$this->error;
	}
        
	/**
	* 
	* @function name : filter_autocomplete()
	* @description   : Check category relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function filter_autocomplete()
	{  
		$this->output->unset_template();
		$json = array();
			
			if ($this->input->post('filter_name')!==NULL) {
				$filter_name = $this->input->post('filter_name');
			} else {
				$filter_name = '';
			}		
			
			
			$filter_data = array(
				'filter_name'  => $filter_name,				
				'start'        => 0,
				'limit'        => 5
			);
			
			
			$results = $this->filter->getFilterByName($filter_data);
			
			foreach ($results as $result) {
								
				if(isset($result['filter_group_id']) || !empty($result['filter_group_id']))
				{
					$get_filter_group_name=$this->filter->getFilterGroupName($result['filter_group_id']);
					foreach($get_filter_group_name as $filter_group_names)
					{
						$filter_group_name = $filter_group_names['filter_group_name'];
					}
					$category_name = $filter_group_name.'>'.$result['filter_name'];
				}				
				
				
				$json[] = array(
					'filter_id'       => $result['filter_id'],					
					'filter_name'     => $category_name,							
				);
			}
		
		
		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['filter_name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);		
                
       echo json_encode($json);
  	}
}
