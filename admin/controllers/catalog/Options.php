<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Options
* @Auther       : Indrajit
* @Date         : 11-11-2016
* @Description  : Options Related Collection of functions
*
*/

class Options extends CI_Controller {

private $data  = array();
private $error = array();

	function __construct()
	{
		parent::__construct();

		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('catalog/option_model','option');
		
		$this->lang->load('catalog/options_lang', 'english');
		
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
		$this->output->set_common_meta('Options','sarpo','This is srapo Options page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Options view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'name', $sort_order = 'ASC', $offset = 0)
	{
		$this->data['add'] 			 = base_url('catalog/options/add');
		if($this->session->userdata('role_id')== 1)
		{
			$this->data['delete'] 		= base_url('catalog/options/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('catalog/options/softDelete');
		}
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Options',
		   'href' => base_url('catalog/options'),
		 
		  );
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);

		$url = base_url("catalog/options/index/$sort_by/$sort_order");
		$total_records = $this->option->getTotalOptions();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->option->getOptions($data);
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
				'option_id'   => $result['option_id'],
				'name'         => $result['name'],
				'sort_order'          => $result['sort_order'],
                                'is_deleted'    => $result['is_deleted'],
				'date_modified' => date($this->common->config('config_date_format'), strtotime($result['date_added'])),
				'edit'          =>base_url('catalog/options/edit'.$url.'/'.$this->commons->encode($result['option_id']))
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
		$content_page="themes/".$admin_theme."/catalog/options_list";
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
				$this->option->addOption();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
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
				if ($this->uri->segment(7)!==NULL) {
					$url .= '/'.$this->uri->segment(7);
				}
				redirect('catalog/options');
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
                    
                    if ($this->input->post('is_deleted') == 1) {
                        $res = $this->validateSoftDelete($this->input->post('option_id'));
                        if($res==0)
                        {
                            $this->session->set_userdata('error',$this->error['warning']);
                            redirect('catalog/options/edit'.$url.'/'.$this->commons->encode($this->input->post('option_id')));  
                        }
                    }   
                    
                    $this->option->editOption();
                    $this->session->set_userdata('success',$this->lang->line('text_success'));

                    redirect('catalog/options/index'.$url);
				
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
			foreach ($this->input->post('selected') as $option_id) 
			{
				$this->option->deleteOption($option_id);
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
			foreach ($this->input->post('selected') as $option_id) 
			{
				$this->option->softDeleteOption($option_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success'));
			
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
		
		
		
		// breadcrumbs
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		 $this->data['breadcrumbs'][] = array(
		   'text' => 'Options',
		   'href' => base_url('catalog/filter'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{
			$this->data['form_action'] = base_url('catalog/options/add'.$url);
			$this->data['option_id'] = '';
			$this->data['text_form'] 		= $this->lang->line('text_add');
		} 
		else 
		{
			$this->data['form_action'] = base_url('catalog/options/edit'.$url.'/'.$this->uri->segment($count));
			$this->data['text_form'] 		= $this->lang->line('text_edit');
			
			$this->data['option_id'] = $this->commons->decode($this->uri->segment($count));
		}
		$this->data['cancel'] 		= base_url('catalog/options/index'.$url);
		
		
		// Set Value Back
		if (1) 
		{
			$option_info = $this->option->getOption($this->commons->decode($this->uri->segment($count)));
		}
		

		if ($this->input->post('option_name')!==NULL) {
			$this->data['option_name'] = $this->input->post('option_name');
		} elseif (!empty($option_info)) {
			
			$this->data['option_name'] = $option_info['name'];
		} else {
			$this->data['option_name'] = '';
		}
		if ($this->input->post('type')!==NULL) {
			$this->data['type'] = $this->input->post('type');
		} elseif (!empty($option_info)) {
			$this->data['type'] = $option_info['type'];
		} else {
			$this->data['type'] = '';
		}
		if ($this->input->post('sort_order')!==NULL) {
			$this->data['sort_order'] = $this->input->post('sort_order');
		} elseif (!empty($option_info)) {
			$this->data['sort_order'] = $option_info['sort_order'];
		} else {
			$this->data['sort_order'] = '';
		}
		//====Start Code: Call image model for resize the image
           $this->load->model('tool/image');
		$option_value = array();
		
		if  (($this->input->post('option_value')) !== NULL)
		{
			$option_value_list = $this->input->post('option_value');
			// echo "<pre>";
			// print_r($option_value_list);
			foreach ($option_value_list as $key => $value) {
				if(is_file(DIR_IMAGE . $value['image']))
				{
					$option_value[$key]['src'] = $this->image->resize($value['image'], 100, 100);
				}
				else
				{
					$option_value[$key]['src'] = $this->image->resize('no_image-100x100.png', 100, 100);
				} 
				$option_value[$key]['image'] = $value['image'];
				$option_value[$key]['option_id'] = $value['option_id'];
				$option_value[$key]['name'] = $value['name'];
				$option_value[$key]['placeholder'] = $this->image->resize('no_image-100x100.png', 100, 100);
				$option_value[$key]['sort_order'] = $value['sort_order'];
			}
                
            }
        elseif(!empty($option_info))
		{
			$option_list=$this->option->getOptionValueList($this->commons->decode($this->uri->segment($count)));

			foreach ($option_list as $key => $value)
			{
				if(is_file(DIR_IMAGE . $value['image']))
				{
					$option_value[$key]['src'] = $this->image->resize($value['image'], 100, 100);
				}
				else
				{
					$option_value[$key]['src'] = $this->image->resize('no_image-100x100.png', 100, 100);
				} 
				$option_value[$key]['image'] = $value['image'];
				$option_value[$key]['option_id']	= $value['option_id'];
				$option_value[$key]['name'] 		= $value['name'];
				$option_value[$key]['placeholder'] 	= $this->image->resize('no_image-100x100.png', 100, 100);;
				$option_value[$key]['sort_order'] 	= $value['sort_order'];
			}
			
			
		}
		else
		{
				$option_value = array();
			 
		}
                $this->data['option_value1'] = $option_value;
                
		 //====End Code: Call image model for resize the image 
		           
		if ($this->input->server('REQUEST_METHOD') == 'POST')
                {
                    if($this->input->post('is_deleted')==1)
                    {
                       $this->data['is_deleted'] = $this->input->post('is_deleted'); 
                    }else {
                         $this->data['is_deleted'] = 0;
                    }
		} elseif (!empty($option_info)) {
			$this->data['is_deleted'] = $option_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
		//echo '<pre>'.$count;print_r($this->data);
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/catalog/options";
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
                          
            
            if (($this->input->post('type') == 'select' || $this->input->post('type') == 'radio' || $this->input->post('type') == 'checkbox' || $this->input->post('type') == 'image') && $this->input->post('option_value')!==NULL) {
                foreach ($this->input->post('option_value') as $option_value_id => $option_value) {
                    $option_value_validate = array(
                        array(
                            'field' => 'option_value['.$option_value_id.'][name]',
                            'label' => 'Option Value Name',
                            'rules' => 'trim|required|min_length[1]|max_length[128]|xss_clean',
                            'errors' => array('required' => '%s must be between  1 and 128 characters!','min_length'=>'%s must be between  1 and 128 characters!','max_length'=>'%s must be between  1 and 128 characters!')
                        ),
                    );
                    $this->form_validation->set_rules($option_value_validate);
                }
            }
            
            $validation = array(
                            array(
                                'field' => 'option_name',
                                'label' => 'Option Name', 
                                'rules' => 'trim|required|min_length[1]|max_length[128]|xss_clean|callback_check_exists_option_name', 
                                'errors' => array('required' => '%s must be between 1 and 128 characters!','min_length'=>'%s must be between 1 and 128 characters!','max_length'=>'%s must be between 1 and 128 characters!','check_exists_option_name'=>'%s is already in use!')
                            )
                        );
			
            
            
            $this->form_validation->set_rules($validation);
            if ($this->form_validation->run() == FALSE) {
                $this->error['abc'] = "ANDN";
            }
            
            if (($this->input->post('type') == 'select' || $this->input->post('type') == 'radio' || $this->input->post('type') == 'checkbox' || $this->input->post('type') == 'image') && ($this->input->post('option_value')==NULL)) {
                $this->error['warning'] = $this->session->set_userdata('error',$this->lang->line('error_type'));
                //return !$this->error;
            } 
            return !$this->error;
	}
	/**
	* 
	* @function name 	: check_exists_option_name()
	* @description   	: Validate for option title existing or not
	* @access 		: public
	* @param   		: void
	* @return        	: boolean
	*
	*/
    function check_exists_option_name($str)
	{
		$this->db->from('option');
		$this->db->where('LOWER(name)',strtolower($str));
                $this->db->where('is_deleted=0');
		if($this->input->post('option_id') !="")
		{
			$this->db->where('option_id !=',$this->input->post('option_id'));
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
            $this->load->model('catalog/product_model');
            foreach ($this->input->post('selected') as $option_id) 
            {
                $product_total = $this->product_model->getTotalProductsByOptionId($option_id);
                    if($product_total) {
                        $this->error['warning'] = $this->lang->line('error_product').'('.$product_total.')!';
                    }
            }
		return !$this->error;
                
	}
        
        /**
	* 
	* @function name : validateSoftDelete()
	* @description   : Check filter relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateSoftDelete($option_id) 
	{
            $this->load->model('catalog/product_model');
		
            $product_total = $this->product_model->getTotalProductsByOptionId($option_id);
            if($product_total) {
                $this->error['warning'] = $this->lang->line('error_product').'('.$product_total.')!';
            }		
            return !$this->error;                
	}
        
        public function autocomplete() {
            $this->output->unset_template();
            $json = array();
		if ($this->input->post('option')!==NULL) {
                    $attribute_name = $this->input->post('option');
                } else {
                    $attribute_name = '';
                }
                
                $filter_data = array (
                    'filter_name' => $attribute_name,
                    'start'        => 0,
                    'limit'        => 5
                );
                
                $options = $this->option->getOptions($filter_data);
                $this->load->model('tool/image');
                foreach($options as $option) {
                    $option_value_data = array();
                    
                    if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') {
                        $option_values = $this->option->getOptionValues($option['option_id']);

                        foreach ($option_values as $option_value) {
                            if (is_file(DIR_IMAGE . $option_value['image'])) {
                                $image = $this->image->resize($option_value['image'], 50, 50);
                            } else {
                                $image = $this->image->resize('no_image.png', 50, 50);
                            }

                            $option_value_data[] = array(
                                'option_value_id' => $option_value['option_value_id'],
                                'name'            => $option_value['name'],
                                'image'           => $image
                            );
                        }
                        
                        $sort_order = array();
                        
                        foreach ($option_value_data as $key => $value) {
                            $sort_order[$key] = $value['name'];
                        }
                        array_multisort($sort_order, SORT_ASC, $option_value_data);
                    }
                    
                    $type = '';
                    
                    if ($option['type'] === 'select' || $option['type'] === 'radio' || $option['type'] === 'checkbox' || $option['type'] === 'image') {
                            $type = 'Choose';
                    }

                    if ($option['type'] === 'text' || $option['type'] === 'textarea') {
                            $type = 'Input';
                    }

                    if ($option['type'] === 'file') {
                            $type = 'File';
                    }

                    if ($option['type'] === 'date' || $option['type'] === 'datetime' || $option['type'] === 'time') {
                            $type = 'Date';
                    }
                    
                    $json[] = array(
                        'option_id'    => $option['option_id'],
                        'name'         => $option['name'],
                        'category'     => $type,
                        'type'         => $option['type'],
                        'option_value' => $option_value_data
                    );
                }
                $sort_order = array();
                
                foreach ($json as $key => $value) {
                    $sort_order[$key] = $value['name'];
		}
                
                array_multisort($sort_order, SORT_ASC, $json);
                
                echo json_encode($json);
	}
}
