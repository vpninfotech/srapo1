<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Api_manufacturer
* @Auther       : Mitesh
* @Date         : 26-12-2016
* @Description  : Api manufacturer Operation
*
*/

class Api_manufacturer extends CI_Controller 
{
	private $data=array();
	private $error = array();

	function __construct()
	{
            parent::__construct();

            $this->_init();

            $this->rbac->CheckAuthentication();

            $this->load->model('catalog/manufacturer_model','manufacturer_model');
			
            $this->lang->load('api/api_manufacturer_lang', 'english');

            $this->load->model('common');

            $this->load->library('commons');

            $this->load->library('pagination');

            $this->load->library('manufacturer');
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
		
            
	}
	/**
	* 
	* @function name : index()
	* @description   : load manufacturers view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index() {
		// Delete past manufacturer in case there is an error
		$this->session->unset_userdata('manufacturer');

		$json = array();

		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{
			
			// manufacturer
			if($this->input->post('manufacturer_id'))
			{
				$manufacturer_info = $this->manufacturer_model->getmanufacturerById($this->input->post('manufacturer_id'));
				if (!$manufacturer_info) 
				{
					$json['error']['warning'] = $this->lang->line('error_manufacturer');
				}
				else
				{
					if(!$this->manufacturer->login($manufacturer_info['email'], '', true))
					{
						$json['error']['warning'] = $this->lang->line('error_manufacturer');
					}
				}
			}

			
			if (!$json) {
				
				 $manufacturer_details = array(
					'manufacturer_id'       => $this->input->post('manufacturer_id')					
				);
				$this->session->set_userdata('manufacturer',$manufacturer_details);
				$json['success'] = $this->lang->line('text_success');
			}
		}

		echo json_encode($json);
	}
}
