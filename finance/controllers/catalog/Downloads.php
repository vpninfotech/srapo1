<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Downloads
* @Auther       : Vinay
* @Date         : 30-11-2016
* @Description  : Downloads Controller 
*
*/

class Downloads extends CI_Controller {

	private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('catalog/downloads_model','download');		
		
		$this->lang->load('catalog/download_lang', 'english');
		
		$this->load->model('common');
		
		$this->load->library('commons');
		
		$this->load->library('pagination');
		 
	}
	
	/**
	* 
	* @function name : _init()
	* @description   : initialize required resources in this view
	* @param         : void
	* @return        : void
	*
	*/
	
	private function _init() {
		
		//--Set Template
		$this->output->set_template('dataoperator_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Downloads','sarpo','This is srapo Download page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load attribute group view
	* @param   	 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'name', $sort_order = 'ASC', $offset = 0)	
	{
		// breadcrumbs
		$this->data['add'] 			 = base_url('catalog/downloads/add');
		if($this->session->userdata('Drole_id')== 1)
		{
			$this->data['delete'] 		= base_url('catalog/downloads/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('catalog/downloads/softDelete');
		}
		
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		  
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Downloads',
		   'href' => base_url('catalog/downloads'),
		 
		  );
		  
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("catalog/downloads/index/$sort_by/$sort_order");
		$total_records = $this->download->getTotalDownload();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->download->getDownloads($data);
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
				'download_id'       => $result['download_id'],
				'name'              => $result['name'],
				'date_added'     => date($this->common->config('config_date_format'), strtotime($result['date_added'])),
				'edit'              =>base_url('catalog/downloads/edit'.$url.'/'.$this->commons->encode($result['download_id']))
			);
		}
		
		
		
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if ($this->session->userdata('success')!==NULL) {
			$this->data['success'] = $this->session->userdata('success');
		} else {
			$this->data['success'] = '';
		}
		
		if ($this->input->post('selected') !==NULL) {
			$this->data['selected'] = (array)$this->input->post('selected');
		} else {
			$this->data['selected'] = array();
		}
				
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/catalog/downloads_list";
		$this->load->view($content_page,$this->data);

	}
	
	/**
	* 
	* @function name : add()
	* @description   : load Downloads Add view
	* @param   	 : void
	* @return        : void
	*
	*/
	
	public function add()	{
			
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				
				$this->download->addDownload();
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
				redirect('catalog/downloads/index'.$url);
	     }
		$this->getForm();
	}
	
	/**
	* 
	* @function name : edit()
	* @description   : edit Downloads records
	* @param   	 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'name', $sort_order = 'ASC', $offset = 0)
	{		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				
				$this->download->editDownload();
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
				
				redirect('catalog/downloads/index'.$url);				
	     }
	   
		$this->getForm();
	}
	
	/**
	* 
	* @function name : delete()
	* @description   : perminant delete records
	* @param   	 : void
	* @return        : void
	*
	*/
	public function delete()
	{
		if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
		{
			foreach ($this->input->post('selected') as $download_id) 
			{
				$this->download->deleteDownload($download_id);
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
	* @param   	 : void
	* @return        : void
	*
	*/
	public function softDelete()
	{		
		if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
		{
			foreach ($this->input->post('selected') as $download_id) 
			{
				$this->download->softDeleteDownload($download_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success'));
			
		}
		$this->index();
	}
	
	/**
	* 
	* @function name : getForm()
	* @description   : Generate Form for Add and Edit Records
	* @param   	 : void
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
		   'text' => 'Downloads',
		   'href' => base_url('catalog/downloads'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{													
                    $this->data['text_form'] 		= $this->lang->line('text_add');
                    $this->data['form_action'] = base_url('catalog/downloads/add'.$url);
                    $this->data['download_id'] = '';
		} 
		else 
                {	
                    $this->data['text_form'] 		= $this->lang->line('text_edit');
                    $this->data['form_action'] = base_url('catalog/downloads/edit'.$url.'/'.$this->uri->segment($count));

                    $this->data['download_id'] = $this->commons->decode($this->uri->segment($count));
		}
		
		$this->data['cancel'] 		= base_url('catalog/downloads/index'.$url);
		
		// Set Value Back
		if (1) 
		{
                    $download_info = $this->download->getDownload($this->commons->decode($this->uri->segment($count)));
		}		
			
		if ($this->input->post('download_name')!==NULL) {
			$this->data['download_name'] = $this->input->post('download_name');
		} elseif (!empty($download_info)) {
			$this->data['download_name'] = $download_info['name'];
		} else {
			$this->data['download_name'] = '';
		}	
		
		if ($this->input->post('filename')!==NULL) {
			$this->data['filename'] = $this->input->post('filename');
		} elseif (!empty($download_info)) {
			$this->data['filename'] = $download_info['filename'];
		} else {
			$this->data['filename'] = '';
		}	
		
			
		if ($this->input->post('mask')!==NULL) {
			$this->data['mask'] = $this->input->post('mask');
		} elseif (!empty($download_info)) {
			$this->data['mask'] = $download_info['mask'];
		} else {
			$this->data['mask'] = '';
		}		
				
                if ($this->input->server('REQUEST_METHOD') == 'POST')
                {
                    if($this->input->post('is_deleted')==1)
                    {
                       $this->data['is_deleted'] = $this->input->post('is_deleted'); 
                    }else {
                         $this->data['is_deleted'] = 0;
                    }
		} elseif (!empty($download_info)) {
			$this->data['is_deleted'] = $download_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
			
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/catalog/downloads";
		$this->load->view($content_page,$this->data);
	}
	
	/**
	* 
	* @function name : validateForm()
	* @description   : Validate Entered Form data
	* @param   	 : void
	* @return        : void
	*
	*/
	public function validateForm()
	{		
				
		$validation = array(   
                                array(
                                        'field' => 'download_name',
                                        'label' => 'Download Name', 
                                        'rules' => 'trim|required|min_length[3]|max_length[64]|xss_clean', 
                                        'errors' => array('required' => '%s must be between 3 and 64 characters!','min_length'=>'%s must be between 3 and 64 characters!','max_length'=>'%s must be between 3 and 64 characters!')
                                ),
                    
                                array(
                                        'field' => 'filename',
                                        'label' => 'File', 
                                        'rules' => 'trim|required|min_length[3]|max_length[64]|xss_clean|callback_file_exists', 
                                        'errors' => array('required' => '%s dose not exist!')
                                ),
                    
                                array(
                                        'field' => 'mask',
                                        'label' => 'Mask', 
                                        'rules' => 'trim|required|min_length[3]|max_length[128]|xss_clean', 
                                        'errors' => array('required' => '%s must be between 3 and 128 characters!','min_length'=>'%s must be between 3 and 128 characters!','max_length'=>'%s must be between 3 and 128 characters!')
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
	* @function name : file_exists()
	* @description   : Check file name exists or not
	* @param         : void
	* @return        : void
	*
	*/
        public function file_exists()
        {  
            if(!is_file(DIR_DOWNLOAD . $this->input->post('filename'))) {
                $this->form_validation->set_message('file_exists', 'File dose not exist!');
                return FALSE;
            } else {
                return TRUE;
            }
        }
        
	/**
	* 
	* @function name : validateDelete()
	* @description   : Check Downloads relation for delete
	* @param   	 : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{		
	
            $this->load->model('catalog/product_model');
            
            foreach ($this->input->post('selected') as $download_id) 
		{
                    $product_total = $this->product_model->getTotalProductsByDownloadId($download_id);
                    if ($product_total) 
                    {
                        $this->error['warning'] = $this->lang->line('error_product').'('.$product_total.')';                        
                    }
		}
		return !$this->error;
	}
        
        public function upload() {
            $this->output->unset_template();
            $json = array();
          
            if (!$json) {
                if (!empty($_FILES['file']['name']) && is_file($_FILES['file']['tmp_name'])) {
                    // Sanitize the filename
                   $filename = basename(html_entity_decode($_FILES['file']['name']));                    
                    
                    // Allowed file extension types
                    $allowed = array();

                    $extension_allowed = preg_replace('~\r?\n~', "\n", $this->common->config('config_file_ext_allowed'));

                    $filetypes = explode("\n", $extension_allowed);
                    
                    foreach ($filetypes as $filetype) {
                        $allowed[] = trim($filetype);
                    }
                    
                    if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
                        $json['error'] = $this->lang->line('error_filetype');
                    }

                    // Allowed file mime types
                    $allowed = array();

                    $mime_allowed = preg_replace('~\r?\n~', "\n", $this->common->config('config_file_mime_allowed'));

                    $filetypes = explode("\n", $mime_allowed);

                    foreach ($filetypes as $filetype) {
                        $allowed[] = trim($filetype);
                    }

                    if (!in_array($_FILES['file']['type'], $allowed)) {
                        $json['error'] = $this->lang->line('error_filetype');
                    }

                    // Check to see if any PHP files are trying to be uploaded
                    $content = file_get_contents($_FILES['file']['tmp_name']);

                    if (preg_match('/\<\?php/i', $content)) {
                        $json['error'] = $this->lang->line('error_filetype');
                    }

                    // Return any upload error
                    if ($_FILES['file']['error'] != UPLOAD_ERR_OK) {                      
                        $json['error'] = $this->lang->line('error_upload_' . $_FILES['file']['error']);
                    }
                } else {
                    $json['error'] = $this->lang->line('error_upload');
            }
        }

        if (!$json) {
            $file = $filename . '.' . $this->commons->token(32);
            
            move_uploaded_file($_FILES['file']['tmp_name'], DIR_DOWNLOAD . $file);
                   
            $json = array (
                'filename' => $file,
                'mask' => $filename,
                'success' => $this->lang->line('text_upload')
            );
            
        }
        echo json_encode($json);
            
	}
        
        public function autocomplete() {
            $this->output->unset_template();
            $json = array();
		if ($this->input->post('download_name')!==NULL) {
                    $attribute_name = $this->input->post('download_name');
                } else {
                    $attribute_name = '';
                }
                
                $filter_data = array (
                    'download_name' => $attribute_name,
                    'start'        => 0,
                    'limit'        => 5
                );
                
                $results = $this->download->getDownloads($filter_data);
               
                foreach($results as $result) {
                    $json[] = array (
                        'download_id' => $result['download_id'],
                        'name' => $result['name'],                        
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
