<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Banners
* @Auther       : Indrajit
* @Date         : 10-10-2016
* @Description  : Admin Banners Operation
*
*/

class Banners extends CI_Controller {

private $data=array();
private $error=array();

	function __construct()
	{
		parent::__construct();
		
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('design/banner_model','banner');
		
		$this->lang->load('design/banners_lang', 'english');

		$this->load->model('catalog/category_model','category');
		
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
		$this->output->set_common_meta('Banner','sarpo','This is srapo Banner page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Banners view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'banner_name', $sort_order = 'ASC', $offset = 0)
	{
		$this->data['add'] 			 = base_url('design/banners/add');
		if($this->session->userdata('Drole_id')== 1)
		{
			$this->data['delete'] 		= base_url('design/banners/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('design/banners/softDelete');
		}
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Banners',
		   'href' => base_url('design/banners'),
		 
		  );
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);

		$url = base_url("design/banners/index/$sort_by/$sort_order");
		$total_records = $this->banner->getTotalBanners();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->banner->getBanners($data);
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
			$url .= '/banner_name';
		}
		
		if ($this->uri->segment(5)!==NULL) {
			$url .= '/'.$this->uri->segment(5);
		}
		else
		{
			$url .= '/1';
		}
		if ($this->uri->segment(6)!==NULL) {
			$url .= '/'.$this->uri->segment(6);
		}
		else
		{
			$url .= '/ASC';
		}
		foreach ($results as $result) {
			$this->data['records'][] = array(
				'banner_id'   => $result['banner_id'],
				'banner_name'         => $result['banner_name'],
				'status'          => $result['status'],
				'date_modified' => date($this->common->config('config_date_format'), strtotime($result['date_added'])),
				'edit'          =>base_url('design/banners/edit'.$url.'/'.$this->commons->encode($result['banner_id']))
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
		$content_page="themes/".$admin_theme."/design/banners_list";
		$this->load->view($content_page,$this->data);
	}
	
	
	/**
	* 
	* @function name : add()
	* @description   : load Options Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function add()	{

		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				$this->banner->addBanner();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/banner_name';
				}
				
				if ($this->uri->segment(5)!==NULL) {
					$url .= '/'.$this->uri->segment(5);
				}
				else
				{
					$url .= '/0';
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
				redirect('design/banners');
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
				 
				$this->banner->editBanner();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/banner_name';
				}
				
				if ($this->uri->segment(5)!==NULL) {
					$url .= '/'.$this->uri->segment(5);
				}
				else
				{
					$url .= '/0';
				}
				if ($this->uri->segment(6)!==NULL) {
					$url .= '/'.$this->uri->segment(6);
				}
				else
				{
					$url .= '/0';
				}
				
				redirect('design/banners/index'.$url,'refresh');
				
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
		//if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
		if (($this->input->post('selected')!==NULL))
		{
			foreach ($this->input->post('selected') as $banner_id) 
			{
				$this->banner->deleteBanner($banner_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success'));
			redirect('design/banners');
		}
		else
		{
			redirect('design/banners');
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
		//if (($this->input->post('selected')!==NULL) && $this->validateDelete())
		if (($this->input->post('selected')!==NULL)) 
		{
			foreach ($this->input->post('selected') as $banner_id) 
			{
				$this->banner->softDeleteBanner($banner_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success'));
			//redirect('design/banners');
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
			$url .= '/banner_name';
		}
		
		if ($this->uri->segment(5)!==NULL) {
			$url .= '/'.$this->uri->segment(5);
		}
		else
		{
			$url .= '/0';
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
		   'text' => 'Banners',
		   'href' => base_url('design/banners'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{
			$this->data['form_action'] = base_url('design/banners/add'.$url);
			$this->data['banner_id'] = '';
			$this->data['text_form'] 		= $this->lang->line('text_add');
		} 
		else 
		{
			$this->data['form_action'] = base_url('design/banners/edit'.$url.'/'.$this->uri->segment($count));
			$this->data['text_form'] 		= $this->lang->line('text_edit');
			
			$this->data['banner_id'] = $this->commons->decode($this->uri->segment($count));
		}
		$this->data['cancel'] 		= base_url('design/banners/index'.$url);
		
		
		// Set Value Back
		if (1) 
		{
			$banner_info = $this->banner->getBanner($this->commons->decode($this->uri->segment($count)));
		}
		
		if ($this->input->post('select_page')!==NULL) {
			$this->data['select_page'] = $this->input->post('select_page');
		} elseif (!empty($banner_info)) {
			
			$this->data['select_page'] = $banner_info['select_page'];
		} else {
			$this->data['select_page'] = '';
		}

		if ($this->input->post('select_layout')!==NULL) {
			$this->data['select_layout'] = $this->input->post('select_layout');
		} elseif (!empty($banner_info)) {
			
			$this->data['select_layout'] = $banner_info['layout'];
		} else {
			$this->data['select_layout'] = '';
		}

		if ($this->input->post('select_category')!==NULL) {
			$this->data['select_category'] = $this->input->post('select_category');
		} elseif (!empty($banner_info)) {
			
			$this->data['select_category'] = $banner_info['select_category'];
		} else {
			$this->data['select_category'] = '';
		}

		if ($this->input->post('select_position')!==NULL) {
			$this->data['select_position'] = $this->input->post('select_position');
		} elseif (!empty($banner_info)) {
			
			$this->data['select_position'] = $banner_info['position'];
		} else {
			$this->data['select_position'] = '';
		}

		if ($this->input->post('banner_name')!==NULL) {
			$this->data['banner_name'] = $this->input->post('banner_name');
		} elseif (!empty($banner_info)) {
			
			$this->data['banner_name'] = $banner_info['banner_name'];
		} else {
			$this->data['banner_name'] = '';
		}
		if ($this->input->post('status')!==NULL) {
			$this->data['status'] = $this->input->post('status');
		} elseif (!empty($banner_info)) {
			$this->data['status'] = $banner_info['status'];
		} else {
			$this->data['status'] = 0;
		}
		//====Start Code: Call image model for resize the image
           $this->load->model('tool/image');
		$banner_value = array();
		
		if  (($this->input->post('banner_value')) !== NULL)
		{
			$banner_value_list = $this->input->post('banner_value');
			// echo "<pre>";
			// print_r($option_value_list);
			foreach ($banner_value_list as $key => $value) {
				if(is_file(DIR_IMAGE . $value['image']))
				{
					$banner_value[$key]['src'] = $this->image->resize($value['image'], 100, 100);
				}
				else
				{
					$banner_value[$key]['src'] = $this->image->resize('no_image-100x100.png', 100, 100);
				} 
				$banner_value[$key]['image'] = $value['image'];
				$banner_value[$key]['banner_id'] = $value['banner_id'];
				$banner_value[$key]['title'] = $value['title'];
				$banner_value[$key]['link'] = $value['link'];
				$banner_value[$key]['placeholder'] = $this->image->resize('no_image-100x100.png', 100, 100);
				$banner_value[$key]['sort_order'] = $value['sort_order'];
			}
                
        }
        elseif(!empty($banner_info))
		{
			$banner_value_list=$this->banner->getBannerImageList($this->commons->decode($this->uri->segment($count)));
			// echo "<pre>";
			// print_r($banner_value_list);exit;
			foreach ($banner_value_list as $key => $value)
			{
				if(is_file(DIR_IMAGE . $value['image']))
				{
					$banner_value[$key]['src'] = $this->image->resize($value['image'], 100, 100);
				}
				else
				{
					$banner_value[$key]['src'] = $this->image->resize('no_image-100x100.png', 100, 100);
				} 
				$banner_value[$key]['image'] = $value['image'];
				$banner_value[$key]['banner_id'] = $value['banner_id'];
				$banner_value[$key]['title'] = $value['title'];
				$banner_value[$key]['link'] = $value['link'];
				$banner_value[$key]['placeholder'] = $this->image->resize('no_image-100x100.png', 100, 100);
				$banner_value[$key]['sort_order'] = $value['sort_order'];
			}
			
			
		}
		else
		{
				$banner_value = array();
			 
		}

		 //====End Code: Call image model for resize the image 
		$this->data['banner_value'] = $banner_value;           
		if ($this->input->post('is_deleted')!==NULL) {
			$this->data['is_deleted'] = $this->input->post('is_deleted');
		} elseif (!empty($currency_info)) {
			$this->data['is_deleted'] = $currency_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = '';
		}
		$this->data['category'] = $this->category->getCategoryByName();
		//echo '<pre>'.$count;print_r($this->data);
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/design/banners";
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
					        'field' => 'banner_name',
					        'label' => 'Banner Name', 
					        'rules' => 'trim|required|min_length[3]|max_length[64]|xss_clean', 
					        'errors' => array('required' => '%s must be greater than 3 and less than 64 characters!','min_length'=>'%s must be between 3 and 64 characters!','max_length'=>'%s must be between 3 and 64 characters!')
					    ),
					    array(
					        'field' => 'select_page',
					        'label' => 'Select Page', 
					        'rules' => 'required', 
					        'errors' => array('required' => 'Please select %s' )
					    ),
					    array(
					        'field' => 'select_layout',
					        'label' => 'Select Layout', 
					        'rules' => 'required', 
					        'errors' => array('required' => 'Please select %s')
					    )

					);
				if($this->input->post('select_layout') === 'category')
				{
					 $this->form_validation->set_rules("select_category", "Select Category", "required", array('required' => 'Please select %s!'));
					 $this->form_validation->set_rules("select_position", "Select Position", "required", array('required' => 'Please select %s!'));
				}
			$banners=$this->input->post('banner_value');
			if(count($banners)>0)
			{
				
				foreach($banners as $key=>$val) 
				{
				    $this->form_validation->set_rules("banner_value[".$key."][title]", "Banner Title", "trim|required|xss_clean|min_length[2]|max_length[64]", array('required' => '%s  must be between 2 and 64 characters!','min_length'=>'%s must be between 2 and 64 characters!','max_length'=>'%s must be between 2 and 64 characters!'));
				    $this->form_validation->set_rules("banner_value[".$key."][sort_order]", "Sort Order", "trim|xss_clean|numeric", array('numeric' => '%s  must be Digits only!'));
				    
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
	* @function name : validateDelete()
	* @description   : Check banner relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	/*public function validateDelete() 
	{
		$flag = 1;
		foreach ($this->input->post('selected') as $banner_id) 
		{
			// $currency_info = $this->currency->getCurrency($currency_id);
			
			// if ($currency_info) 
			// {
			// 	if ($this->common->config('config_currency') == $currency_info['code']) 
			// 	{
			// 		$this->error['warning'] = $this->lang->line('error_default');
			// 	}
			// }
		}
		return $flag;
	}*/
}
