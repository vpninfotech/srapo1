<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Api_cart
* @Auther       : Indrajit
* @Date         : 20-12-2016
* @Description  : Api customers Operation
*
*/
class Api_currency  extends CI_Controller 
{
	private $data=array();
	private $error = array();
	function __construct()
	{
            parent::__construct();

            $this->_init();

            $this->rbac->CheckAuthentication();

            $this->load->model('customers/Customer_groups_model','customers_group');
			
			$this->load->model('customers/customers_model','customers');

			$this->load->model('system/currency_model','currency_model');

            $this->lang->load('api/api_currency_lang', 'english');

            $this->load->model('common');

            $this->load->library('commons');

            $this->load->library('mycart');

            $this->load->library('currency');
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
	public function index() 
	{
		$json = array();

		if (($this->input->server('REQUEST_METHOD') == 'POST')) 
		{
			
			$currency_info = $this->currency_model->getCurrencyByCode($this->input->post('currency'));

			if ($currency_info) 
			{
				$json['code'] = $this->currency->set($this->input->post('currency'));

				
				$this->session->unset_userdata('shipping_method');
				$this->session->unset_userdata('shipping_methods');

				$json['success'] = $this->lang->line('text_success');
			} else {
				$json['error'] = $this->lang->line('error_currency');
			}
		}

		// if (isset($this->request->server['HTTP_ORIGIN'])) {
		// 	$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
		// 	$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		// 	$this->response->addHeader('Access-Control-Max-Age: 1000');
		// 	$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		// }

		// $this->response->addHeader('Content-Type: application/json');
		// $this->response->setOutput(json_encode($json));

		echo json_encode($json);
	}
}
