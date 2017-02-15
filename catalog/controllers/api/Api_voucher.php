<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Api_voucher
* @Auther       : Indrajit
* @Date         : 20-12-2016
* @Description  : Api cart Operation
*
*/
class Api_voucher extends CI_Controller 
{
	private $data=array();
	private $error = array();
	function __construct()
	{
            parent::__construct();

            $this->_init();

            $this->lang->load('api/api_voucher_lang', 'english');

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
		// Delete past voucher in case there is an error
		$this->session->unset_userdata('voucher');
		
		$json = array();

		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{
			$this->load->model('api/total_voucher_model','voucher');

			if ($this->input->post('voucher'))
			{
				$voucher = $this->input->post('voucher');
			} else {
				$voucher = '';
			}

			$voucher_info = $this->voucher->getVoucher($voucher);

			if (count($voucher_info)>0) {
				$this->session->set_userdata('voucher',$this->input->post('voucher'));

				$json['success'] = $this->lang->line('text_success');
			} else {
				$json['error'] = $this->lang->line('error_voucher');
			}
		}

		echo json_encode($json);
	}

	public function add() 
	{
		

		$json = array();

		if (($this->input->server('REQUEST_METHOD') == 'POST')) 
		{
			// Add keys for missing post vars
			$keys = array(
				'from_name',
				'from_email',
				'to_name',
				'to_email',
				'voucher_theme_id',
				'message',
				'amount'
			);

			if($this->input->post('voucher')) 
			{
				$voucher_data =array();
				if($this->session->userdata('vouchers') !== NULL)
				{
					$voucher_data = $this->session->userdata('vouchers');
				}

				foreach ($this->input->post('voucher') as $voucher) 
				{
					if (isset($voucher['code']) && isset($voucher['to_name']) && isset($voucher['to_email']) && isset($voucher['from_name']) && isset($voucher['from_email']) && isset($voucher['voucher_theme_id']) && isset($voucher['message']) && isset($voucher['amount'])) 
					{
						$voucher_data[$voucher['code']] = array(
							'code'             => $voucher['code'],
							'description'      => sprintf($this->lang->line('text_for'), $this->currency->format($this->currency->convert($voucher['amount'], $this->currency->getCode(), $this->common->config('config_currency'))), $voucher['to_name']),
							'to_name'          => $voucher['to_name'],
							'to_email'         => $voucher['to_email'],
							'from_name'        => $voucher['from_name'],
							'from_email'       => $voucher['from_email'],
							'voucher_theme_id' => $voucher['voucher_theme_id'],
							'message'          => $voucher['message'],
							'amount'           => $this->currency->convert($voucher['amount'], $this->currency->getCode(), $this->common->config('config_currency'))
						);
					}
				}
				$this->session->set_userdata('vouchers',$voucher_data);
				$json['success'] = $this->lang->line('text_cart');

				$this->session->unset_userdata('shipping_method');
				$this->session->unset_userdata('shipping_methods');
				$this->session->unset_userdata('payment_method');
				$this->session->unset_userdata('payment_methods');
			}
			else 
			{
				// Add a new voucher if set
				if ((strlen($this->input->post('from_name')) < 1) || (strlen($this->input->post('from_name')) > 64)) 
				{
					$json['error']['from_name'] = $this->lang->line('error_from_name');
				}

				if ((strlen($this->input->post('from_email')) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->input->post('from_email'))) {
					$json['error']['from_email'] = $this->lang->line('error_email');
				}

				if ((strlen($this->input->post('to_name')) < 1) || (strlen($this->input->post('to_name')) > 64)) {
					$json['error']['to_name'] = $this->lang->line('error_to_name');
				}

				if ((strlen($this->input->post('to_email')) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->input->post('to_email'))) {
					$json['error']['to_email'] = $this->lang->line('error_email');
				}

				if (($this->input->post('amount') < $this->common->config('config_voucher_min')) || ($this->input->post('amount') > $this->common->config('config_voucher_max'))) 
				{
					$json['error']['amount'] = sprintf($this->lang->line('error_amount'), $this->currency->format($this->common->config('config_voucher_min')), $this->currency->format($this->common->config('config_voucher_max')));
				}

				if (!$json) 
				{
					$code = mt_rand();
					$voucher =array();
					if($this->session->userdata('vouchers') !== NULL)
					{
						$voucher= $this->session->userdata('vouchers');
					}
					
					$voucher[$code] = array(
						'code'             => $code,
						'description'      => sprintf($this->lang->line('text_for'), $this->currency->format($this->currency->convert($this->input->post('amount'), $this->currency->getCode(), $this->common->config('config_currency'))), $this->input->post('to_name')),
						'to_name'          => $this->input->post('to_name'),
						'to_email'         => $this->input->post('to_email'),
						'from_name'        => $this->input->post('from_name'),
						'from_email'       => $this->input->post('from_email'),
						'voucher_theme_id' => $this->input->post('voucher_theme_id'),
						'message'          => $this->input->post('message'),
						'amount'           => $this->currency->convert($this->input->post('amount'), $this->currency->getCode(), $this->common->config('config_currency'))
					);
					$this->session->set_userdata('vouchers',$voucher);
					$json['success'] = $this->lang->line('text_cart');

					$this->session->unset_userdata('shipping_method');
					$this->session->unset_userdata('shipping_methods');
					$this->session->unset_userdata('payment_method');
					$this->session->unset_userdata('payment_methods');
				}
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
