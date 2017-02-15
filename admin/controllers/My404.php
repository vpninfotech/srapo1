<?php 
class My404 extends CI_Controller 
{
    private $data=[];

	function __construct()
	{
		parent::__construct();

		$this->rbac->CheckAuthentication();
		$this->_init();
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
		$this->output->set_common_meta('Dashboard','sarpo','This is srapo Dashboard page');
	}
	
    public function index() 
    { 
    
    	$admin_theme = $this->common->config('admin_theme');
	$content_page="themes/".$admin_theme."/my404";
	$this->load->view($content_page);
    
    } 
} 
?> 