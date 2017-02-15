<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FileManager extends CI_Controller {
	private $data=[];
	private $admin_theme;
	public function __construct()
	{
		parent::__construct();
		$this->admin_theme = $this->common->config('admin_theme');
		$this->load->model('tool/Image','image');
		$this->load->library('pagination');
	}
	
	/**
	* 
	* @function name : index
	* @description   : view Files and Folders
	* @return   	 : HTML View
	*
	*/
	
	public function index()
	{
		
		// Check Search is perform or not 
		if ($this->input->get('filter_name')) {
			$filter_name = rtrim(str_replace(array('../', '..\\', '..', '*'), '', $this->input->get('filter_name')), '/');
		} else {
			$filter_name = null;
		}
		
		// Make sure we have the correct directory
		if ($this->input->get('directory')) {
			$directory = rtrim(DIR_IMAGE . 'catalog/' . str_replace(array('../', '..\\', '..'), '', $this->input->get('directory')), '/');
		} else {
			$directory = DIR_IMAGE . 'catalog';
		}
		
		// Make sure requested page for pagination
		if ($this->input->get('page')) {
			$page = $this->input->get('page');
		} else {
			$page = 1;
		}

		$this->data['images'] = array();
		
		// Get directories
		$directories = glob($directory . '/' . $filter_name . '*', GLOB_ONLYDIR);

		if (!$directories) {
			$directories = array();
		}
		
		// Get files
		$files = glob($directory . '/' . $filter_name . '*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}', GLOB_BRACE);

		if (!$files) {
			$files = array();
		}
		
		// Merge directories and files
		$images = array_merge($directories, $files);
		
		// Get total number of files and directories
		$image_total = count($images);

		// Split the array based on current page number and max number of items per page of 10
		$images = array_splice($images, ($page - 1) * 16, 16);
		$server = HTTP_CATALOG;
		foreach ($images as $image) {
		$name = str_split(basename($image), 14);
			
			if (is_dir($image)) {
				$url = '';

				if ($this->input->get('target')) {
					$url .= '&target=' . $this->input->get('target');
				}

				if ($this->input->get('thumb')) {
					$url .= '&thumb=' . $this->input->get('thumb');
				}
			
			$this->data['images'][] = array(
					'thumb' => '',
					'name'  => implode('', $name),
					'type'  => 'directory',
					'path'  => substr($image, strlen(DIR_IMAGE)),
					'href'  => BASE_URL.'common/filemanager?directory='. urlencode(substr($image, strlen(DIR_IMAGE . 'catalog/'))). $url
				);
				
				
			}elseif (is_file($image)) {
				$this->data['images'][] = array(
					'thumb' => $this->image->resize(substr($image, strlen(DIR_IMAGE)), 100, 100),
					'name'  => implode('', $name),
					'type'  => 'image',
					'path'  => substr($image, strlen(DIR_IMAGE)),
					'href'  => $server . '/image/' . substr($image, strlen(DIR_IMAGE))
				);
			}
		}
		if ($this->input->get('directory')) {
			$this->data['directory'] = urlencode($this->input->get('directory'));
		} else {
			$this->data['directory'] = '';
		}

		if ($this->input->get('filter_name')) {
			$this->data['filter_name'] = $this->input->get('filter_name');
		} else {
			$this->data['filter_name'] = '';
		}
		// Return the target ID for the file manager to set the value
		if ($this->input->get('target')) {
			$this->data['target'] = $this->input->get('target');
		} else {
			$this->data['target'] = '';
		}

		// Return the thumbnail for the file manager to show a thumbnail
		if ($this->input->get('thumb')) {
			$this->data['thumb'] = $this->input->get('thumb');
		} else {
			$this->data['thumb'] = '';
		}
		
		// Parent
		$url = '';

		if ($this->input->get('directory')) {
			$pos = strrpos($this->input->get('directory'), '/');

			if ($pos) {
				$url .= '&directory=' . urlencode(substr($this->input->get('directory'), 0, $pos));
			}
		}

		if ($this->input->get('target')) {
			$url .= '&target=' . $this->input->get('target');
		}

		if ($this->input->get('thumb')) {
			$url .= '&thumb=' . $this->input->get('thumb');
		}

		$this->data['parent'] = BASE_URL.'common/filemanager?'.$url;
		
		
		// Refresh
		$url = '';

		if ($this->input->get('directory')) {
			$url .= '&directory=' . urlencode($this->input->get('directory'));
		}

		if ($this->input->get('target')) {
			$url .= '&target=' . $this->input->get('target');
		}

		if ($this->input->get('thumb')) {
			$url .= '&thumb=' . $this->input->get('thumb');
		}

		$this->data['refresh'] = BASE_URL.'common/filemanager?'.$url;
		
		//Pagination 
		$url = '';

		if ($this->input->get('directory')) {
			$url .= '&directory=' . urlencode(html_entity_decode($this->input->get('directory'), ENT_QUOTES, 'UTF-8'));
		}

		if ($this->input->get('filter_name')) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->input->get('filter_name'), ENT_QUOTES, 'UTF-8'));
		}

		if ($this->input->get('target')) {
			$url .= '&target=' . $this->input->get('target');
		}

		if ($this->input->get('thumb')) {
			$url .= '&thumb=' . $this->input->get('thumb');
		}
		
		// Generate pagination link
		$page_no = ceil($image_total/16);
		$pagination = '';
		
		$pagination .='<ul class="pagination">';
		for($i=1;$i<=$page_no;$i++)
		{
			if($i == $page)
			$active = 'class="active"';
			else
			$active = '';
			$page_url =BASE_URL.'common/filemanager?'.$url.'&page='.$i;
			$pagination .='<li '.$active.'>';
			$pagination .='<a class="pagination1" href="'.$page_url.'" title="'.$i.'">'.$i.'</a>';
			$pagination .='</li>';
		}
			$pagination .='</ul>';
		
		$this->data['pagination'] = $pagination;
		
		//echo '<pre>';print_r($this->data);die;
		$content_page="themes/".$this->admin_theme ."/common/filemanager";
		$this->load->view($content_page,$this->data);
	}
	
	
	/**
	* 
	* @function name : Upload
	* @return   	 : Json response message
	*
	*/
	
	public function  upload()
	{

		//print_r(json_encode($_POST['directory']));
		//echo json_encode($this->input->post('directory'));
		//print_r(json_encode($_FILES['file']));
		
		$json = array();

		
		// Make sure we have the correct directory
		if ($this->input->post('directory')) {
			$directory = rtrim(DIR_IMAGE . 'catalog/' . str_replace(array('../', '..\\', '..'), '', urldecode($this->input->post('directory'))), '/');
		} else {
			$directory = DIR_IMAGE . 'catalog';
		}

		// Check its a directory
		if (!is_dir($directory)) {
			$json['error'] = 'Warning: Directory does not exist!';
		}

		if (!$json) {
			if (!empty($_FILES['file']['name']) && is_file($_FILES['file']['tmp_name'])) {
				// Sanitize the filename
				$filename = basename(html_entity_decode($_FILES['file']['name'], ENT_QUOTES, 'UTF-8'));

				// Validate the filename length
				if ((strlen($filename) < 3) || (strlen($filename) > 255)) {
					$json['error'] = 'Warning: Filename must be a between 3 and 255!';
				}

				// Allowed file extension types
				$allowed = array(
					'jpg',
					'jpeg',
					'gif',
					'png'
				);

				if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
					$json['error'] = 'Warning: Incorrect file type!';
				}

				// Allowed file mime types
				$allowed = array(
					'image/jpeg',
					'image/pjpeg',
					'image/png',
					'image/x-png',
					'image/gif'
				);

				if (!in_array($_FILES['file']['type'], $allowed)) {
					$json['error'] = 'Warning: Incorrect file type!';
				}

				// Check to see if any PHP files are trying to be uploaded
				$content = file_get_contents($_FILES['file']['tmp_name']);

				if (preg_match('/\<\?php/i', $content)) {
					$json['error'] = 'Warning: Incorrect file type!';
				}

				// Return any upload error
				if ($_FILES['file']['error'] != UPLOAD_ERR_OK) {
					$json['error'] = 'Warning: File could not be uploaded for an unknown reason!' . $this->get->files['file']['error'];
				}
			} else {
				$json['error'] = 'Warning: File could not be uploaded for an unknown reason!';
			}
		}

		if (!$json) {
			move_uploaded_file($_FILES['file']['tmp_name'], $directory . '/' . $filename);

			$json['success'] = 'Success: Your file has been uploaded!';
		}

		echo json_encode($json);
	}
	
	/**
	* 
	* @function name : Create
	* @description   : Create a new directory
	* @return   	 : Json response message
	*
	*/
	
	public function create()
	{
		
		$json = array();
		

		// Make sure we have the correct directory
		if ($this->input->get('directory')) {
			$directory = rtrim(DIR_IMAGE . 'catalog/' . str_replace(array('../', '..\\', '..'), '', $this->input->get('directory')), '/');
		} else {
			$directory = DIR_IMAGE . 'catalog';
		}

		// Check its a directory
		if (!is_dir($directory)) {
			$json['error'] = 'Warning: Directory does not exist!';
		}
		if (!$json) {
			// Sanitize the folder name
			$folder = str_replace(array('../', '..\\', '..'), '', basename(html_entity_decode($this->input->get('folder'), ENT_QUOTES, 'UTF-8')));

			// Validate the filename length
			if ((strlen($folder) < 3) || (strlen($folder) > 128)) {
				$json['error'] = 'Warning: Folder name must be a between 3 and 255!';
			}
			// Check if directory already exists or not
			if (is_dir($directory . '/' . $folder)) {
				$json['error'] = 'Warning: A file or directory with the same name already exists!';
			}
		}

		if (!$json) {
			mkdir($directory . '/' . $folder, 0777);
			chmod($directory . '/' . $folder, 0777);

			$json['success'] = 'Success: Directory created!';
		}


		echo json_encode($json);
	}
	
	/**
	* 
	* @function name : Delete
	* @description   : Delete selected Files or Folders
	* @return   	 : Json response message
	*
	*/
	
	public function delete()
	{

		$json = array();


		if ($this->input->post('path')) {
			$paths = $this->input->post('path');
		} else {
			$paths = array();
		}

		// Loop through each path to run validations
		foreach ($paths as $path) {
			$path = rtrim(DIR_IMAGE . str_replace(array('../', '..\\', '..'), '', $path), '/');

			// Check path exsists
			if ($path == DIR_IMAGE . 'catalog') {
				$json['error'] = 'Warning: You can not delete this directory!';

				break;
			}
		}

		if (!$json) {
			// Loop through each path
			foreach ($paths as $path) {
				$path = rtrim(DIR_IMAGE . str_replace(array('../', '..\\', '..'), '', $path), '/');

				// If path is just a file delete it
				if (is_file($path)) {
					unlink($path);

				// If path is a directory beging deleting each file and sub folder
				} elseif (is_dir($path)) {
					$files = array();

					// Make path into an array
					$path = array($path . '*');

					// While the path array is still populated keep looping through
					while (count($path) != 0) {
						$next = array_shift($path);

						foreach (glob($next) as $file) {
							// If directory add to path array
							if (is_dir($file)) {
								$path[] = $file . '/*';
							}

							// Add the file to the files to be deleted array
							$files[] = $file;
						}
					}

					// Reverse sort the file array
					rsort($files);

					foreach ($files as $file) {
						// If file just delete
						if (is_file($file)) {
							unlink($file);

						// If directory use the remove directory function
						} elseif (is_dir($file)) {
							rmdir($file);
						}
					}
				}
			}

			$json['success'] = 'Success: Your file or directory has been deleted!';
		}

		echo json_encode($json);
	}
	
}
