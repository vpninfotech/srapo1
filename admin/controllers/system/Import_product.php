<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Import Product
* @Auther       : Mitesh
* @Date         : 10-1-2017
* @Description  : Import Product Related Collection of functions
*
*/

class Import_product extends CI_Controller {

	private $data=array();
	private $error = array();
	private $params= array();
	private $tmp_dir;
	
	function __construct()
	{
		parent::__construct();
		
		$this->_init();

		$this->rbac->CheckAuthentication();
		
		$this->load->model('system/ImportProduct_model','import_product');
		
		$this->load->model('system/Import_image_model','import_image_product');			
		
		$this->load->model('catalog/product_model', 'product');
		
		$this->load->model('common');
		
		//attributes model
		$this->load->model('catalog/attributes_model','attributes');
		
		//attributes_groups
		$this->load->model('catalog/attributes_groups_model','attributes_groups');
		
		//filter model
		$this->load->model('catalog/filter_model','filter');
		
		//option
		$this->load->model('catalog/option_model','option');
		
		//filter
		$this->load->model('catalog/filter_model','filter');
		
		$this->lang->load('system/import_product_lang', 'english');

		$this->load->library('commons');
		
		//$this->load->library('cache/file');
		$this->load->library('kadb');
		$this->load->library('kafileutf8');
		$this->load->library('kaformat');	
		$this->load->library('kaelements');	
		//$this->load->library('Benchmark');	
		//$this->load->library('kalog');
		//$this->kalog = new Kalog('ka_product_import.log');	
		$this->load->helper('utf8');		
		
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
		$this->output->set_common_meta('Tools','sarpo','This is srapo Tools page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load product import view
	* @param   		 : void
	* @return        : void
	*
	*/	
	public function index()	{
		$this->tmp_dir          = DIR_CACHE;
		$this->data['form_action']   = base_url('system/import_product');
		$this->data['upload_file_size']   = ini_get('upload_max_filesize');			
		//$this->data['upload_file_size']   = $this->import_product->getUploadMaxFilesize();			
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'CSV Product Import',
		   'href' => base_url('system/import_product'),		 
		  );
		 		 
		
		if (empty($this->params) || ($this->input->server('REQUEST_METHOD') == 'GET' && empty($this->session->userdata('save_params')))) {
		//if (empty($this->params)) {
			$this->params = array(
				'file'                => '',
				'import_mode'         => 'add',
				'cat_separator'       => '///',				
				'field_delimiter'     => ',',
				'step'                => 1,
				'images_dir'          => '',
				'delimiter_option'    => 'predefined',
				'price_multiplier'    => '',
				'download_source_dir' => 'files',
				'file_name_postfix'   => 'generate',
				'opt_enable_macfix'   => '',
				'mode'				  => '',	
				'price_multiplier'    => '',
				/*'profile_name'        => '', // for the second step
				'profile_id'          => '', // for the first step	
				'rename_file'         => true,
				'disable_not_imported_products' => false,
				'skip_new_products'   => false,				
				'tpl_product_id' => 0,*/
			); 
			$this->data['params']      = $this->params;
		}
				  	
		
		///// methods wise  /////
		//if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
		if(($this->input->server('REQUEST_METHOD') == 'POST')) {
			$get_delimiter=',';	
			if(!empty($_FILES['file']['tmp_name']))
			{
				$name=$_FILES['file']['tmp_name'];
				$get_delimiter=$this->detect_delimiter($name);
			}
			//echo  $get_delimiter; exit;
			$msg = '';
			//$this->params['file']=$this->input->post('file');
			$this->params['file']=$_FILES['file']['tmp_name'];
			//$this->params['field_delimiter']=$this->input->post('field_delimiter');
			$this->params['field_delimiter']=$get_delimiter;
			$this->params['delimiter_option']=$this->input->post('delimiter_option');			
			$this->params['import_mode']=$this->input->post('import_mode');
			$this->params['cat_separator']=$this->input->post('cat_separator');
			$this->params['images_dir']=$this->input->post('images_dir');			
			$this->params['price_multiplier']= doubleval(str_replace(',', '.',$this->input->post('price_multiplier')));
			$this->params['download_source_dir']=$this->input->post('download_source_dir');
			$this->params['file_name_postfix']=$this->input->post('file_name_postfix');
			$this->params['mode']=$this->input->post('mode');
			
			if ($this->input->post('field_delimiter')!==NULL) {
				//$this->params['field_delimiter'] = $this->input->post('field_delimiter');
				$this->params['field_delimiter'] = $get_delimiter;
			} else {
				$this->params['field_delimiter'] = ',';
			}
			
			if ($this->input->post('delimiter_option')!==NULL) {
				$this->params['delimiter_option'] = $this->input->post('delimiter_option');
			} else {
				$this->params['delimiter_option'] = ',';
			}
			
			if($this->params['file'] !==NULL )
			{
				$this->params['file']=$this->params['file'];
			}
			else
			{
				$msg.="File must be csv upload";
				$this->error['warning']=$msg;				
			}			
			
			$this->data['params']      = $this->params;
			$params = $this->params;
			
			//file upload
		 	if (!empty($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
				
				//$filename = $_FILES['file']['name'] . '.' . md5(rand());
				
				//$filename = '../temp_csv/' . basename($_FILES['file']['name']);
				$filename = $this->tmp_dir  . basename(md5(rand()).$_FILES['file']['name']);
				
				if (move_uploaded_file($_FILES['file']['tmp_name'],  $filename)) {
				
				  $this->params['file'] = $filename;
				  $this->params['file_name'] = $_FILES['file']['name'];
				} else {
					$msg = $msg . str_replace('{dest_dir}', $this->tmp_dir, $this->language->get('error_cannot_move_file'));
					$this->error['warning']=$msg;
				}
			}
			
			if (empty($msg)) {
				$params = $this->params;
				if ($this->import_product->openFile($params)) {
					
					$this->params['columns'] = $this->import_product->readColumns($params['field_delimiter']);
					
					if (count($this->params['columns']) == 1) {		
								
						$msg .= "Wrong field delimiter or incorrect file format.";
						$this->error['warning']=$msg;
					}
				} else {
					
					//$msg .= $this->import_product->getLastError();
					$msg .= "File can not be open.";
					//$this->error['warning']=$msg;
				}
			}
			
			
			if (!empty($msg)) {
				$this->error['warning']=$msg;
				//$this->addTopMessage($msg, 'E');
				//$this->session->data['save_params'] = true;
				/*$admin_theme = $this->common->config('admin_theme');
				$content_page="themes/".$admin_theme."/system/import_products";
				$this->load->view($content_page,$this->data);*/
			 	//return $this->redirect($this->url->link('tool/ka_product_import', 'token=' . $this->session->data['token'], 'SSL'));			
			}
			else
			{		
				//go to step 2 			
				//$this->data=$this->step2();
					
				if(!empty($this->session->userdata('save_params')))
				{				
					$this->session->unset_userdata('save_params');
					$this->session->set_userdata('save_params',$this->params);									
				}
				else
				{				
					$this->session->set_userdata('save_params',$this->params);			
					
					/*if($this->input->post('set_field-model') !== NULL || $this->input->post('set_field-product_name') !== NULL || $this->input->post('set_field-seo_url') !== NULL)
					{					
						$this->data=$this->step3();	
						
					}*/
				}
				/*$sp=$this->session->userdata('save_params');
				echo "<pre>";
				print_r($sp);
				echo "</pre>";
				exit;*/
				redirect('system/import_product/step2');
			}		
			
		}
		
		/*if($this->input->post('set_field-model') !== NULL || $this->input->post('set_field-product_name') !== NULL || $this->input->post('set_field-seo_url') !== NULL)
		{					
			$this->data=$this->step3();	
			echo "<pre>";
			print_r($this->data);
			echo "</pre>";
		}*/
		
		
		///// //methods wise  /////
		if (isset($this->error['warning'])) {
			$this->data['error'] = $this->error['warning'];
		} else {
			$this->data['error'] = '';
		}

		if ($this->session->userdata('success')!==NULL) {
			$this->data['success'] = $this->session->userdata('success');

			$this->session->set_userdata('success','');
		} else {
			$this->data['success'] = '';
		}	
		   
		/*$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/system/import_products";
		$this->load->view($content_page,$this->data);*/
		$this->prepareOutput($this->data);
	}
	
	/*
	* step 2
	*/	
	public function step2() { // step2
		
		$this->data['form_action']   = base_url('system/import_product/step3');
		$this->data['upload_file_size']   = ini_get('upload_max_filesize');			
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'CSV Product Import',
		   'href' => base_url('system/import_product'),		 
		  );
		$save_params=$this->session->userdata('save_params');
				
		unset($save_params['params']['step']);
		
		$this->params['step'] = 2;	
		$save_params['step']=$this->params['step'];
		//$save_params['params']['multicat_sep']  = ":::";
		$this->params=$save_params;
				
		//$this->params['step'] = 2;	
		
		
		$this->data['columns'] = $this->params['columns'];
		
		array_unshift($this->data['columns'], '');

		if (($this->input->server('REQUEST_METHOD') == 'POST')) {
			
			$this->updateMatches();
			
			$sets = $this->import_product->getFieldSets();
			$this->import_product->copyMatches($sets, $this->params['matches'], $this->data['columns']);
			
			$errors_found = false;			
			foreach ($sets['fields'] as $field) {
				if (!empty($field['required']) && empty($field['column'])) {
					//$this->addTopMessage(sprintf($this->common->config('error_field_required'), $field['name']), 'E');
					$this->error['warning']=$field['name'];
					$errors_found = true;
				}
			}
			
			if ($errors_found) {
				//return $this->redirect($this->url->link('tool/ka_product_import/step2', 'token=' . $this->session->data['token'], 'SSL'));
				//echo "Hello";exit;
				$this->step2();
			}
			
			/*if ($this->input->post['mode'] == 'save_profile') {
			
				if (empty($this->request->post['profile_name'])) {
					//$this->addTopMessage("Profile name is empty", "E");
					$this->error['warning']="Profile name is empty";
					
				} else {
				
					// we will create new profile always on saving
					//				
					if ($this->import_product->setProfileParams(0, $this->input->post['profile_name'], $this->params)) {
						//$this->addTopMessage("Profile has been saved succesfully");
						$this->session->set_userdata('success',"Profile has been saved succesfully");
					}
				}
			
				//return $this->redirect($this->url->link('tool/ka_product_import/step2', 'token=' . $this->session->data['token'], 'SSL'));
			}*/
						
			//return $this->redirect($this->url->link('tool/ka_product_import/step3', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$sets = $this->import_product->getFieldSets();
		
		/*echo "<pre>";
		print_r($this->params['matches']);
		echo "</pre>";
		exit;*/
		
		//
		// $matches - stores array of fields and assigned columns
		// $columns - list of columns in the file
		//
		if (!empty($this->params['matches'])) {
			$this->import_product->copyMatches($sets, $this->params['matches'], $this->data['columns']);
		}

		$this->import_product->findMatches($sets, $this->data['columns']);
		$this->data['matches'] = $sets;
		/*echo "<pre>";
		print_r($this->data['matches']);
		echo "</pre>";
		exit;*/
		/*$this->data['attribute_page_url'] = $this->url->link('catalog/attribute', 'token=' . $this->session->data['token'], 'SSL');		
		$this->data['filter_page_url']    = $this->url->link('catalog/filter', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['option_page_url']    = $this->url->link('catalog/option', 'token=' . $this->session->data['token'], 'SSL');
    	$this->data['action']             = $this->url->link('tool/ka_product_import/step2', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['back_action']        = $this->url->link('tool/ka_product_import', 'token=' . $this->session->data['token'], 'SSL');*/
		
		$this->data['attribute_page_url'] = base_url('catalog/attributes');		
		$this->data['filter_page_url']    = base_url('catalog/filter');
		$this->data['option_page_url']    = base_url('catalog/options');    	
		$this->data['back_action']        = base_url('system/import_product');
		$this->data['params']             = $this->params;

		//$this->data['filesize']           = $this->kaformat->convertToMegabyte(filesize($this->params['file']));
		/*$this->data['backup_link']        = $this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL');*/
		
		/*if (!empty($this->session->data['hide_backup_warning'])) {
			$this->data['hide_backup_warning'] = true;
		}*/
		
		if (isset($this->error['warning'])) {
			$this->data['error'] = $this->error['warning'];
		} else {
			$this->data['error'] = '';
		}

		if ($this->session->userdata('success')!==NULL) {
			$this->data['success'] = $this->session->userdata('success');

			$this->session->set_userdata('success','');
		} else {
			$this->data['success'] = '';
		}	
		//return $this->data;
		$this->prepareOutput($this->data);
	}
	
	/*
	* calculate seconds to hour and minutes
	*/
	function secToHR($seconds) {
		$hours = floor($seconds / 3600);
		$minutes = floor(($seconds / 60) % 60);
		$seconds = $seconds % 60;
		if($hours != 0)
		{
			return "$hours hours:$minutes minutes:$seconds";
		}
		else
		{
			return "$minutes"."minutes:$seconds";
		}
	}

	/*
	* step 3
	*/
	public function step3() { // step3
			
		$save_params=$this->session->userdata('save_params');
		
		/*echo "<pre>";
		print_r($save_params);
		echo "</pre>";
		exit;*/			
		unset($save_params['params']['step']);
		
		$this->params['step'] = 3;
		$save_params['step']=$this->params['step'];
		//$save_params['params']['multicat_sep']  = ":::";
		$this->params=$save_params;
		$params = $this->params;
		
		//$this->params['step'] = 3;
		/////////////
		$this->benchmark->mark('code_start');
	
		$ack=$this->import_product->csvImportData($params);
		
		$this->benchmark->mark('code_end');
		
		//code for delete .tmp file from folder

		// Define the folder to clean
		// (keep trailing slashes)
		$catalogFolder  = '../image/catalog/';
		$temp_csvFolder  = '../temp_csv/';
		// Filetypes to check (you can also use *.*)
		$fileTypes      = '*.tmp';
		$filecsvTypes   = '*.csv';
		// Here you can define after how many
		// minutes the files should get deleted
		$expire_time    = 30; 
		 
		// Find all files of the given file type
		foreach(glob($catalogFolder . $fileTypes) as $Filename) {
		 
			// Read file creation time
			$FileCreationTime = filectime($Filename);
		 
			// Calculate file age in seconds
			$FileAge = time() - $FileCreationTime; 
		 
			// Is the file older than the given time span?
			if ($FileAge > ($expire_time * 60)){
		 
				// Now do something with the olders files...
		 
				//print "The file $Filename is older than $expire_time minutes\n";
		 
				// For example deleting files:
				unlink($Filename);
			}
		 
		}
		
		// Find all files of the given file type
		foreach (glob($temp_csvFolder . $filecsvTypes) as $Filename_csv) {		 
			$FileCreationTime = filectime($Filename_csv);
			$FileAge = time() - $FileCreationTime; 
			if ($FileAge > ($expire_time * 60)){
				unlink($Filename_csv);
			}
		}		
		
	
		/*$save_params=$this->session->userdata('save_params');
						
		unset($save_params['params']['step']);
		
		$this->params['step'] = 3;
		$save_params['params']['step']=$this->params['step'];
		
		$this->params=$save_params['params'];
		$params = $this->params;*/
			
			
		//$this->data['done_action']        =  base_url('system/import_product');
		//$this->data['params']             = $this->params;
		$sec = $this->import_product->getSecPerCycle();
		$this->params['update_interval']    = $sec.' - ' .($sec + 5);

		// format=raw&tmpl=component - these parameters are used for compatibility with Mojoshop
		//
		//$this->data['page_url'] = base_url('system/import_product/stat');
		
		$this->params['csv_total_record']=$ack['csv_total_record'];
		$this->params['total_record_inserted']=$ack['total_record_inserted'];
		$this->params['total_record_updated']=$ack['total_record_updated'];
		$this->params['total_record_proccessed']=$ack['total_record_proccessed'];
		$this->params['take_time_proccessed']=$this->secToHR($this->benchmark->elapsed_time('code_start', 'code_end'));
		$this->params['status']='completed';
		//return $this->data;
		//exit;
		
		$this->data['form_action']   = base_url('system/import_product');
		//$this->data['upload_file_size']   = ini_get('upload_max_filesize');			
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'CSV Product Import',
		   'href' => base_url('system/import_product'),		 
		  );
		/*$save_params=$this->session->userdata('save_params');
				
		unset($save_params['params']['step']);
		
		$this->params['step'] = 3;	
		$save_params['params']['step']=$this->params['step'];
		//$save_params['params']['multicat_sep']  = ":::";
		$this->params=$save_params['params'];*/
		
		//return $this->data;
		$this->data['params']    = $this->params;
		
		if (isset($this->error['warning'])) {
			$this->data['error'] = $this->error['warning'];
		} else {
			$this->data['error'] = '';
		}

		if ($this->session->userdata('success')!==NULL) {
			$this->data['success'] = $this->session->userdata('success');

			$this->session->set_userdata('success','');
		} else {
			$this->data['success'] = '';
		}	
		/*echo "<pre>";
		print_r($this->data['params']);
		echo "</pre>";
		exit;*/
		$this->prepareOutput($this->data);
		
	}
	
	/**
	* 
	* @function name 	: validateForm()
	* @description   	: Validate form data
	* @access 		: public
	* @param   		: void
	* @return        	: boolean
	*
	*/
	public function validateForm() 
	{
		$validation = array(				   
				array(
					'field' => 'file',
					'label' => 'File', 					
					'rules' => 'trim|xss_clean|callback_validate_upload_file|callback_validate_file_size', 					
					'errors' => array('validate_upload_file' => 'Wrong %s!','validate_file_size'=>'%s is too large')
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
	* @function name 	: validate_upload_file()
	* @description   	: Validate upload file data
	* @access 			: public
	* @param   			: void
	* @return        	: boolean
	*
	*/
	public function validate_upload_file()
	{		
		/*echo "<pre>";
		print_r($_FILES);
		echo "</pre>";				
		exit;*/
				
		//validate whether uploaded file is a csv file
		$csvMimes = array('application/vnd.ms-excel','text/comma-separated-values','text/plain','text/csv','text/tsv');
		if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes))
		{
			if(is_uploaded_file($_FILES['file']['tmp_name']))
			{
				
				return TRUE;
				//return FALSE;
			}
			else
			{
				return FALSE;
				//return TRUE;
			}
		}
		else
		{
			return FALSE;
		}
	}
	
	/**
	* 
	* @function name 	: validate_image_path_url()
	* @description   	: Validate upload file data
	* @access 			: public
	* @param   			: void
	* @return        	: boolean
	*
	*/
	public function validate_image_path_url()
	{
		$image_directory=$this->input->post('image_direcotry');
		
		$get_dir_make=explode('/',$image_directory);
		if($get_dir_make[0] == "" || end($get_dir_make) == "")
		{
			return FALSE;
			//return TRUE;
		}
		else
		{
			//return FALSE;
			return TRUE;
		}		
	}
	
	/**
	* 
	* @function name 	: validate_file_size()
	* @description   	: Validate upload file size
	* @access 			: public
	* @param   			: void
	* @return        	: boolean
	*
	*/
	public function validate_file_size()
	{
		//$file=$this->input->post('file');
		if(!empty($_FILES['file']['name']))
		{		
			// Check file size 2 MB
			if ($_FILES['file']['size'] > 2097152) {
				return FALSE;
			}			
			else
			{
				return TRUE;
			}
		}
		else
		{
			return FALSE;
		}		
	}
	
	 /**
	 * @function name 	: detect_delimiter()
	 * @description   	: Detect delimiter of cells.
	 * @access 			: string $name
	 * @param   		: CSV file path.
	 * @return        	: Return detected delimiter.   
     */
     public function detect_delimiter($name) {
      $delimiters = array(
	  	'\t' => 0,
        ';' => 0,
        ',' => 0,
		'|' => 0,
		' ' => 0,
      );
     
      $handle = fopen($name, 'r');
      $first_line = fgets($handle);
      fclose($handle);
      foreach ($delimiters as $delimiter => &$count) {
        $count = count(str_getcsv($first_line, $delimiter));
      }
     
      return array_search(max($delimiters), $delimiters);
    }
	
	 /**
	 * @function name 	: detect_delimiter()
	 * @description   	: Detect delimiter of cells.
	 * @access 			: string $name
	 * @param   		: CSV file path.
	 * @return        	: Return detected delimiter.   
     */
     public function get_delimiter() {
		 $this->output->unset_template();	  
		 $name=$_FILES['file']['tmp_name'];
		 
		  $delimiters = array(			
			'|' => 0,
			';' => 0,
			',' => 0,
			' ' => 0,
			'\t' => 0,			
		  );
		 
		  $handle = fopen($name, 'r');
		  $first_line = fgets($handle);
		  fclose($handle);
		  foreach ($delimiters as $delimiter => &$count) {
			$count = count(str_getcsv($first_line, $delimiter));
		  }
		  
		  echo array_search(max($delimiters), $delimiters);
		  //exit;
		  //return array_search(max($delimiters), $delimiters);
    }
	
	
	
	//
	public function csvImport($get_import_mode,$csv,$get_columns)
	{
		/*echo "<pre>";
		print_r($csv);
		echo "</pre>";*/
		//get assocative array from scv
		/*$rows 	= array_map('str_getcsv', file($_FILES['file']['tmp_name']));
		$header = array_shift($rows);
		$csv 	= array();
		foreach ($rows as $row) {
		  $csv[] = array_combine($header, $row);
		}
		
		//get field name from table
		$get_columns=$this->import_product->getColumns();*/
		
		if(count($csv)>0)
		{						
			if($get_import_mode == "replace")
			{		
				$value_str="";				
				$col_name="";
				$model_name="";				
				foreach($csv as $csv_data)
				{																
					foreach($csv_data as $key=>$value)
					{
						foreach($get_columns as $gc)
						{			
							foreach($gc as $col_key=>$col_value)
							{	
								if($key == "product_id")
								{		
									//skip product_id column because it is autoincrement in product table
								}
								else
								{
									if($key == $col_value)
									{
										//$insert_str.=$col_value."=".$value.",";
										if($key == "model")
										{
											$model_name=$value;
										}
										
										$col_name .= "`".$col_value."`".",";
										if($col_key != "int")
										{
											$value=trim($value);
											$value_str.="`".$col_value."`"."="."'$value'".",";
											//$value_str.="'$value'".",";
										}
										else
										{
											$value_str.="`".$col_value."`"."=".$value.",";
											//$value_str.=$value.",";
										}
									}
								}
							}
						}
					}
					
					$pass_value_str=rtrim($value_str,',');
					$pass_col_str=rtrim($col_name,',');
					
					$exists_record=$this->import_product->existsRecord($model_name);
					if($exists_record == 0)
					{		
						$ack=$this->import_product->insertData($pass_col_str,$pass_value_str);															
					}
					else
					{
						$ack=$this->import_product->updateData($model_name,$pass_value_str);
					}
				}
				
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				if ($this->session->userdata('success')!==NULL) 
				{
					$this->data['success'] = $this->session->userdata('success');
					$this->session->set_userdata('success','');
					
				} 
				else 
				{
					$this->data['success'] = '';
				}
			}
			else
			{		
				$value_str="";				
				$col_name="";
				$model_name="";				
				foreach($csv as $csv_data)
				{																
					foreach($csv_data as $key=>$value)
					{
						foreach($get_columns as $gc)
						{			
							foreach($gc as $col_key=>$col_value)
							{	
								if($key == "product_id")
								{		
									//skip product_id column because it is autoincrement in product table
								}
								else
								{
									if($key == $col_value)
									{
										//$insert_str.=$col_value."=".$value.",";
										if($key == "model")
										{
											$model_name=$value;
										}
										
										$col_name .= "`".$col_value."`".",";
										if($col_key != "int")
										{
											$value=trim($value);
											//$value_str.="`".$col_value."`"."="."'$value'".",";
											$value_str.="'$value'".",";
										}
										else
										{
											//$value_str.="`".$col_value."`"."=".$value.",";
											$value_str.=$value.",";
										}
									}
								}
							}
						}
					}
				
					$pass_value_str=rtrim($value_str,',');
					$pass_col_str=rtrim($col_name,',');
				
					$exists_record=$this->import_product->existsRecord($model_name);
					if($exists_record == 0)
					{								
						$ack=$this->import_product->insertData($pass_col_str,$pass_value_str);
					}
					
					$value_str="";
					$col_name="";	
				}
			
			
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				if ($this->session->userdata('success')!==NULL) 
				{
					$this->data['success'] = $this->session->userdata('success');
					$this->session->set_userdata('success','');
					
				} 
				else 
				{
					$this->data['success'] = '';
				}
			}
		}
		else
		{
			echo $this->error['error']="csv has no data";
			
			if (isset($this->error['error'])) {
				$this->data['error'] = $this->error['error'];
			} else {
				$this->data['error'] = '';
			}
		}
	}
	
	
	/*
	*if header and csv header not equal
	*/
	public function csvImport2($get_import_mode)
	{		
		$get_seperator=$this->input->post('field_delimiter');
		$get_import_mode=$this->input->post('import_mode');
		$get_image_direcotry=$this->input->post('image_direcotry');
		
		/*echo $delimiter;
		exit;*/
		$name=$_FILES['file']['tmp_name'];
		$get_delimiter=$this->detect_delimiter($name);
		/*echo $get_delimiter;
		exit;*/
		
		//get field name from table
		$get_columns=$this->import_product->getColumns();
	
		//get assocative array from scv
		$rows = array_map('str_getcsv', file($_FILES['file']['tmp_name']));
		
		$get_header = array_shift($rows);
		$header_temp=array();
		$header=array();
		foreach($get_header as $col_name)
		{		
			$header_temp=explode('|',$col_name);
		}
		
		//$row_temp=array();
		//foreach ($rows as $row) {
		foreach($get_columns as $columns)
		{
			foreach($columns as $column_key=>$column_value)
			{
				//echo $column_value;
				for($i=0;$i<count($header_temp);$i++)
				{		
					$header_value=trim($header_temp[$i],'"');
					if($column_value == $header_value)	
					{		
						$header[]=$header_temp[$i];
						//$row_temp[]=$row;
					}
				}
			}
		}
		//}
		
		$value_str="";
		$col_name="";
		//skip first line
		$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
		$rows 	= fgetcsv($csvFile);
		$lines 	= array();
		
		fgetcsv($csvFile);
		while(($line = fgetcsv($csvFile)) !== FALSE){
			echo "<pre>";
			print_r($line);
			echo "</pre>";						
			//$csv[] = array_combine($header, $line);						
		}
		exit;
		/*echo "<pre>";
		print_r($row_temp);
		echo "</pre>";	
		exit;*/
		//echo count($header)."||".count($rows);
		//exit;		
		
		$csv = array();
		//$counter1=0;
		foreach ($rows as $row) {			
			for($i=0;$i<count($header);$i++)
			{	
				echo $header[$i]."=".$row[$i]."<br>";	
				//$csv[] = array_combine($header, $row);
				
			}
			echo "<br>====================<br>";
		}
		
		
		
		
		if(count($csv)>0)
		{		
			if($get_import_mode == "replace")
			{		
				$value_str="";				
				$col_name="";
				$model_name="";				
				foreach($csv as $csv_data)
				{																
					foreach($csv_data as $key=>$value)
					{
						foreach($get_columns as $gc)
						{			
							foreach($gc as $col_key=>$col_value)
							{	
								if($key == "product_id")
								{		
									//skip product_id column because it is autoincrement in product table
								}
								else
								{
									if($key == $col_value)
									{
										//$insert_str.=$col_value."=".$value.",";
										if($key == "model")
										{
											$model_name=$value;
										}
										
										$col_name .= "`".$col_value."`".",";
										if($col_key != "int")
										{
											$value=trim($value);
											$value_str.="`".$col_value."`"."="."'$value'".",";
											//$value_str.="'$value'".",";
										}
										else
										{
											$value_str.="`".$col_value."`"."=".$value.",";
											//$value_str.=$value.",";
										}
									}
								}
							}
						}
					}
					
					$pass_value_str=rtrim($value_str,',');
					$pass_col_str=rtrim($col_name,',');
					
					$exists_record=$this->import_product->existsRecord($model_name);
					if($exists_record == 0)
					{		
						$ack=$this->import_product->insertData($pass_col_str,$pass_value_str);															
					}
					else
					{
						$ack=$this->import_product->updateData($model_name,$pass_value_str);
					}
				}
				
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				if ($this->session->userdata('success')!==NULL) 
				{
					$this->data['success'] = $this->session->userdata('success');
					$this->session->set_userdata('success','');
					
				} 
				else 
				{
					$this->data['success'] = '';
				}
			}
			else
			{		
				$value_str="";				
				$col_name="";
				$model_name="";				
				foreach($csv as $csv_data)
				{																
					foreach($csv_data as $key=>$value)
					{
						foreach($get_columns as $gc)
						{			
							foreach($gc as $col_key=>$col_value)
							{	
								if($key == "product_id")
								{		
									//skip product_id column because it is autoincrement in product table
								}
								else
								{
									if($key == $col_value)
									{
										//$insert_str.=$col_value."=".$value.",";
										if($key == "model")
										{
											$model_name=$value;
										}
										
										$col_name .= "`".$col_value."`".",";
										if($col_key != "int")
										{
											$value=trim($value);
											//$value_str.="`".$col_value."`"."="."'$value'".",";
											$value_str.="'$value'".",";
										}
										else
										{
											//$value_str.="`".$col_value."`"."=".$value.",";
											$value_str.=$value.",";
										}
									}
								}
							}
						}
					}
				
					$pass_value_str=rtrim($value_str,',');
					$pass_col_str=rtrim($col_name,',');
				
					$exists_record=$this->import_product->existsRecord($model_name);
					if($exists_record == 0)
					{								
						$ack=$this->import_product->insertData($pass_col_str,$pass_value_str);
					}
					
					$value_str="";
					$col_name="";	
					//echo $pass_col_str."<br>=================================="."<br>";
					//echo "<br>=================================="."<br>";
				}
			
			
			
			/*echo "<pre>";
			print_r($csv);
			echo "</pre>";*/				
			//exit;
			
			///////////////////////////
			/*$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
	
			//skip first line
			fgetcsv($csvFile);
			
			//import product details in product table as well as upload image 
			$this->product_import->writecsvdata($csvFile);			
									
			//close opened csv file
			fclose($csvFile);*/
			
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				if ($this->session->userdata('success')!==NULL) 
				{
					$this->data['success'] = $this->session->userdata('success');
					$this->session->set_userdata('success','');
				} 
				else 
				{
					$this->data['success'] = '';
				}
			}
		}
		else
		{
			echo $this->error['error']="csv has no data";
			
			if (isset($this->error['error'])) {
				$this->data['error'] = $this->error['error'];
			} else {
				$this->data['error'] = '';
			}
		}
	}
	
	
	/*
		The function updates $this->params['matches'] array with assigned columns and some other parameters.

		POST REQUEST:
			fields[<fieldid>     => <column position in the file>
			discounts[<fieldid>] => <column position in the file>
			...
	*/
	public function updateMatches() {

		$sets = $this->import_product->getFieldSets();
		
		foreach ($sets as $sk => $sv) {

			if (empty($sv)) {
				continue;
			}
			
			$fields = $this->input->post[$sk];
			
			foreach ($sv as $f_idx => $f_data) {
			
				if ($sk == 'filter_groups') {
					$f_key = $f_data['filter_group_id'];
					
				} elseif ($sk == 'attributes') {
					$f_key = $f_data['attribute_id'];
					
				} elseif ($sk == 'options') {
					$f_key = $f_data['option_id'];
					
				} else {
					$f_key = (isset($f_data['field']) ? $f_data['field']:$f_idx);
				}
				
				if (isset($fields[$f_key])) {
					if ($fields[$f_key] > 0) {
						$matches[$sk][$f_key] = $this->params['columns'][$fields[$f_key]-1];
					} else {
						$matches[$sk][$f_key] = '';
					}
				}
			}
		}

		$matches['required_options'] = (isset($this->request->post['required_options'])) ? $this->request->post['required_options'] : array();
		
		$this->params['matches'] = $matches;

		return true;
	}
	
	/*
		The function is called by ajax script and it outputs information in json format.

		json format:
			status - in progress, completed, error;
			...    - extra import parameters.
	*/
	public function stat() {
		
		$save_params=$this->session->userdata('save_params');
			
		unset($save_params['params']['step']);
		
		$this->params['step'] = 3;
		$save_params['params']['step']=$this->params['step'];
		/*echo "<pre>";
		print_r($save_params['params']);
		echo "</pre>";
		exit;*/
		$this->params=$save_params['params'];
		
		if ($this->params['step'] != 3) {
			//$this->addTopMessage('This script can be requested at step 3 only', 'E');
			$this->error['warning']="This script can be requested at step 3 only";
			//return $this->redirect($this->url->link('tool/ka_product_import/step2', 'token=' . $this->session->data['token'], 'SSL'));
			$this->step2();
		}
		
		$this->import_product->processImport();
		/*echo "<pre>";
		print_r($this->params);
		echo "</pre>";
		echo "hello check stat()";exit;*/

		$stat                  = $this->import_product->getImportStat();
		$stat['messages']      = $this->import_product->getImportMessages();
		$stat['time_passed']   = $this->kaformat->formatPassedTime(time() - $stat['started_at']);
		$stat['completion_at'] = sprintf("%.2f%%", $stat['offset'] / ($stat['filesize']/100));
	
 		echo json_encode($stat);
	}
	
	
	/*public function test()
	{
		$this->output->unset_template();
		$res=$this->product->getProductDescriptions(28);
		echo "<pre>";
		print_r($res);
		echo "</pre>";
		exit;
	}*/
	
	public function prepareOutput($data) {
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/system/import_products";
		$this->load->view($content_page,$data);
	}
}
?>