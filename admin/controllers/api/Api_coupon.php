<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Api_coupon
* @Auther       : Indrajit
* @Date         : 22-12-2016
* @Description  : Api coupon Operation
*
*/
class Api_coupon extends CI_Controller 
{
	private $data=array();
	private $error = array();
	function __construct()
	{
            parent::__construct();

            $this->_init();

            $this->rbac->CheckAuthentication();

            $this->lang->load('api/api_coupon_lang', 'english');

            $this->load->model('common');

            $this->load->library('commons');

            $this->load->library('pagination');

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
		

		// Delete past coupon in case there is an error
		$this->session->unset_userdata('coupon');

		$json = array();

		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{
			$this->load->model('api/total_coupon_model','coupon');

			if ($this->input->post('coupon') !== "") 
			{
				$coupon = $this->input->post('coupon');
			} else {
				$coupon = '';
			}

			$coupon_info = $this->coupon->getCoupon($coupon);
			if (count($coupon_info)>0) 
			{
				$this->session->set_userdata('coupon',$this->input->post('coupon'));
				$json['success'] = $this->lang->line('text_success');
			} else {
				$json['error'] = $this->lang->line('error_coupon');
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
