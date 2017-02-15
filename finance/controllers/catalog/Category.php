<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Category
* @Auther       : Mitesh
* @Date         : 11-11-2016
* @Description  : Category Controller 
*
*/

class Category extends CI_Controller {

	private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('catalog/category_model','category');
		
		$this->load->model('catalog/filter_model','filter');
				
		$this->lang->load('catalog/category_lang', 'english');
		
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
		$this->output->set_common_meta('Category','sarpo','This is srapo category page');
		

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load attribute group view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'category_name', $sort_order = 'ASC', $offset = 0)	
	{
		// breadcrumbs
		$this->data['add'] 			 = base_url('catalog/category/add');
		//$this->data['delete'] 		 = base_url('catalog/category/delete');
		if($this->session->userdata('Drole_id')== 1)
		{
                    $this->data['delete'] 		= base_url('catalog/category/delete');
		}
		else
		{
                    $this->data['delete'] 		= base_url('catalog/category/softDelete');
		}
		//$this->data['refresh'] 			= base_url('catalog/category/refresh');
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		  
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Categories',
		   'href' => base_url('catalog/category'),
		 
		  );
		  
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("catalog/category/index/$sort_by/$sort_order");
		$total_records = $this->category->getTotalCategories();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->category->getCategories($data);
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
			$url .= '/category_name';
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
			
			//display path insted of category
			$category_path=$this->category->getPath($result['category_id']);
			
			$this->data['records'][] = array(
				'category_id'   => $result['category_id'],
				'category_name' => $result['category_name'],				
				'parent_id' 	=> $result['parent_id'],
				'sort_order'    => $result['sort_order'],			
				'is_deleted'    => $result['is_deleted'],
				'edit'          => base_url('catalog/category/edit'.$url.'/'.$this->commons->encode($result['category_id']))
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
		$content_page="themes/".$admin_theme."/catalog/category_list";
		$this->load->view($content_page,$this->data);

	}
	
		
	/**
	* 
	* @function name : add()
	* @description   : load Attributes Groups Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	
	public function add()	{
			
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				
				//check if attribute exists message set in session if exists then destroy it.				
				if($this->session->userdata('exists_parent'))
				{
					$this->session->unset_userdata('exists_parent');
				}
				
				$this->category->addcategory();
								
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
								
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/category_name';
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
				redirect('catalog/category/index'.$url);
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
	public function edit($sort_by = 'category_name', $sort_order = 'ASC', $offset = 0)
	{		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				
				$this->category->editCategories();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/category_name';
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
				
				redirect('catalog/category/index'.$url);
				
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
			foreach ($this->input->post('selected') as $category_id) 
			{
                            $this->category->deletecategories($category_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success'));
			//redirect('catalog/category');
			$this->index();
		}
		else
		{
			//redirect('catalog/category');
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
			foreach ($this->input->post('selected') as $category_id) 
			{
				$this->category->softDeleteCategories($category_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success'));
			//$this->index();
			//redirect('catalog/category/index');
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
			$url .= '/category_name';
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
		   'text' => 'Categories',
		   'href' => base_url('catalog/category'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{						
							
			$this->data['text_form']   = $this->lang->line('text_add');
			$this->data['form_action'] = base_url('catalog/category/add'.$url);
			$this->data['category_id'] = '';
		} 
		else 
		{									
			$this->data['text_form']   = $this->lang->line('text_edit');
			$this->data['form_action'] = base_url('catalog/category/edit'.$url.'/'.$this->uri->segment($count));
			
			$this->data['category_id'] = $this->commons->decode($this->uri->segment($count));
		}
		//$this->data['refresh'] 		= base_url('catalog/category/refresh');
		$this->data['cancel'] 		= base_url('catalog/category/index'.$url);
		
		// Set Value Back
		if (1) 
		{
			$category_info = $this->category->getCategory($this->commons->decode($this->uri->segment($count)));
		}		
		/*echo "<pre>";
		print_r($category_info);
		echo "</pre>";	*/
		if ($this->input->post('category_name')!==NULL) {
			$this->data['category_name'] = $this->input->post('category_name');
		} elseif (!empty($category_info)) {
			
			$this->data['category_name'] = $category_info['category_name'];
		} else {
			$this->data['category_name'] = '';
		}	
			
		if ($this->input->post('description')!==NULL) {
			$this->data['description'] = $this->input->post('description');
		} elseif (!empty($category_info)) {
			
			$this->data['description'] = $category_info['description'];
		} else {
			$this->data['description'] = '';
		}
			
		if ($this->input->post('meta_title')!==NULL) {
			$this->data['meta_title'] = $this->input->post('meta_title');
		} elseif (!empty($category_info)) {
			
			$this->data['meta_title'] = $category_info['meta_title'];
		} else {
			$this->data['meta_title'] = '';
		}
		
		if ($this->input->post('meta_description')!==NULL) {
			$this->data['meta_description'] = $this->input->post('meta_description');
		} elseif (!empty($category_info)) {
			
			$this->data['meta_description'] = $category_info['meta_description'];
		} else {
			$this->data['meta_description'] = '';
		}
		
		if ($this->input->post('meta_keyword')!==NULL) {
			$this->data['meta_keyword'] = $this->input->post('meta_keyword');
		} elseif (!empty($category_info)) {
			
			$this->data['meta_keyword'] = $category_info['meta_keyword'];
		} else {
			$this->data['meta_keyword'] = '';
		}
		
		if ($this->input->post('parent_id') !== NULL) {
                    $this->data['parent_id'] = $this->input->post('parent_id');
                } elseif (!empty($category_info)) {
                    $this->data['parent_id'] = $category_info['parent_id'];
                } else {
                    $this->data['parent_id'] = "";
                }
               
                if ($this->input->post('parent') !== NULL) {
                    $this->data['parent'] = $this->input->post('parent');
                } elseif (!empty($category_info)) {
                    $parent_info = $this->category->getPath($category_info['parent_id']);
                    
                    if ($parent_info) {
                        $this->data['parent'] = $parent_info[0]['category_name'];
                    } else {
                        $this->data['parent'] = "";
                    }
                } else {
                    $this->data['parent'] = "";
                }               
		
		
		//====== Filter ======            
                if (($this->input->post('product_filter') !== NULL)) {
                    $filters = $this->input->post('product_filter');
                } elseif (($this->commons->decode($this->uri->segment(7)))) {
                    $filters = $this->category->getProductFilters($this->commons->decode($this->uri->segment(7)));
                } else {
                    $filters = array();
                }

                $this->load->model('catalog/filter_model');

                $this->data['product_filters'] = array();
                foreach ($filters as $filter_id) {
                    $filter_info = $this->filter_model->getFilterNameById($filter_id);

                    if ($filter_info) {
                        $this->data['product_filters'][] = array(
                            'filter_id' => $filter_info[0]['filter_id'],
                            'filter_name' => $filter_info[0]['group'] . ' &gt; ' . $filter_info[0]['filter_name']
                        );
                    }
                }
				
		
		if ($this->input->post('seo_keywords')!==NULL) {
			$this->data['seo_keywords'] = $this->input->post('seo_keywords');
		} elseif (!empty($category_info)) {
			
			$this->data['seo_keywords'] = $category_info['seo_keywords'];
		} else {
			$this->data['seo_keywords'] = '';
		}	
		
		if  (($this->input->post('image')) !== NULL) {
			$this->data['image'] = $this->input->post('image');
		} else {
			$this->data['image'] = $category_info['image'];
		}
		
		 //====Start Code: Call image model for resize the image
		$this->load->model('tool/image');
		
		if (($this->input->post('image') !== NULL) && is_file(DIR_IMAGE . $this->input->post('image'))) {
			  $this->data['thumb'] = $this->image->resize($this->input->post('image'), 100, 100);
		} elseif ($category_info['image'] && is_file(DIR_IMAGE . $category_info['image'])) {
			  $this->data['thumb'] = $this->image->resize($category_info['image'], 100, 100);
		} else {
			  $this->data['thumb'] = $this->image->resize('no_image-100x100.png', 100, 100);
		}

		$this->data['placeholder'] = $this->image->resize('no_image-100x100.png', 100, 100);
		//====End Code: Call image model for resize the image
		
		if ($this->input->post('columns')!==NULL) {
			$this->data['columns'] = $this->input->post('columns');
		} elseif (!empty($category_info)) {
			
			$this->data['columns'] = $category_info['columns'];
		} else {
			$this->data['columns'] = '';
		}
					
		if ($this->input->post('sort_order')!==NULL) {
			$this->data['sort_order'] = $this->input->post('sort_order');
		} elseif (!empty($category_info)) {
			$this->data['sort_order'] = $category_info['sort_order'];
		} else {
			$this->data['sort_order'] = '';
		}
		
		if ($this->input->post('status') !== NULL) {
                    $this->data['status'] = $this->input->post('status');
                } elseif (!empty($category_info)) {
                    $this->data['status'] = $category_info['status'];
                } else {
                    $this->data['status'] = 1;
                }
		
		if ($this->input->server('REQUEST_METHOD') == 'POST')
                {
                    if($this->input->post('is_deleted')==1)
                    {
                       $this->data['is_deleted'] = $this->input->post('is_deleted'); 
                    }else {
                         $this->data['is_deleted'] = 0;
                    }
                } elseif (!empty($category_info)) {
                        $this->data['is_deleted'] = $category_info['is_deleted'];
                } else {
                        $this->data['is_deleted'] = 0;
                }
	
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/catalog/category";
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
					        'field' => 'category_name',
					        'label' => 'Category Name', 
					        'rules' => 'trim|required|min_length[2]|max_length[255]|xss_clean|callback_category_name_check', 
					        'errors' => array('required' => '%s must be between 2 and 255 characters!','min_length'=>'%s must be between 2 and 255 characters!','max_length'=>'%s must be between 2 and 255 characters!','category_name_check'=>'Category Name is already exists')
					    ),
                                    array(
                                        'field' => 'meta_title',
                                        'label' => 'Meta Title', 
                                        'rules' => 'trim|required|min_length[3]|max_length[255]|xss_clean', 
                                        'errors' => array('required' => '%s must be greater than 3 and less than 255 characters!','min_length'=>'%s must be between 3 and 255 characters!','max_length'=>'%s must be between 3 and 255 characters!')
                                    ),
                                    array(
                                         'field' => 'parent',
                                         'label' => 'Parent Category Name', 
                                         'rules' => 'trim|min_length[1]|max_length[255]|xss_clean', 
                                         'errors' => array('required' => '%s must be greater than 2 and less than 255 characters!','min_length'=>'%s must be between 2 and 255 characters!','max_length'=>'%s must be between 2 and 255 characters!')
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
	* @description   : Check category id relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{	
		
		foreach ($this->input->post('selected') as $category_id) 
		{
			$parent_category_exists = $this->category->parent_category_exists($category_id);
			if($parent_category_exists == 1) 
			{
				$this->error['warning'] = $this->lang->line('error_default');
				
			}                        
                        
			//D.07-12-2016 || VINAY
			$this->load->model('catalog/product_model');
			$product_total = $this->product_model->getTotalProductByCategoryId($category_id);
			if ($product_total) 
			{
				$this->error['warning'] = $this->lang->line('error_product').'('.$product_total.')';                            
			}
                       //D.12-12-2016  || VINAY
                        $this->load->model('design/banner_model');
                        $banner_total = $this->banner_model->getTotalBannerByCategoryId($category_id);
			if ($banner_total) 
			{
				$this->error['warning'] = $this->lang->line('error_banner').'('.$banner_total.')';                            
			}
			
		}
		return !$this->error;
	}
	
	 /**
	* 
	* @function name : category_name_check()
	* @description   : Check category name already exists or not
	* @param         : void
	* @return        : void
	*
	*/
	public function category_name_check($str)
	{  
            $this->db->from('category');
            $this->db->where('LOWER(category_name)',strtolower($str));
			$this->db->where('is_deleted=0');
            if($this->input->post('category_id') !="")
            {
                $this->db->where('category_id !=',$this->input->post('category_id'));
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
	* @function name : autocomplete()
	* @description   : Check category relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function autocomplete()
	{  
		$this->output->unset_template();
		$json = array();
			
			if ($this->input->post('category_name')!==NULL) {
				$filter_name = $this->input->post('category_name');
			} else {
				$filter_name = '';
			}		
			
			
			$filter_data = array(
				'category_name'  => $filter_name,				
				'start'        => 0,
				'limit'        => 5
			);

			$results = $this->category->getCategories($filter_data);
                        
			//print_r($results);
			
			foreach ($results as $result) {
				$json[] = array(
					'category_id'       => $result['category_id'],
					'category_name'     => $result['category_name']									
				);
			}
		
		
		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['category_name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);
                
        echo json_encode($json);		
  	}
		
}