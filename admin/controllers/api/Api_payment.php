<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Api_payment
* @Auther       : Indrajit
* @Date         : 20-12-2016
* @Description  : Api customers Operation
*
*/
class Api_payment extends CI_Controller 
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

            $this->lang->load('api/api_payment_lang', 'english');

            $this->load->model('common');

            $this->load->library('commons');

            $this->load->library('pagination');

            $this->load->library('mycart');

            $this->load->library('tax');

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
	public function address() 
	{
		

		// Delete old payment address, payment methods and method so not to cause any issues if there is an error
		$this->session->unset_userdata('payment_address');
		$this->session->unset_userdata('payment_methods');
		$this->session->unset_userdata('payment_method');

		$json = array();

		if (($this->input->server('REQUEST_METHOD') == 'POST')) 
		{
			
			if ((strlen(trim($this->input->post('firstname'))) < 1) || (strlen(trim($this->input->post('firstname'))) > 32)) 
			{
				$json['error']['firstname'] = $this->lang->line('error_firstname');
			}

			if ((strlen(trim($this->input->post('lastname'))) < 1) || (strlen(trim($this->input->post('lastname'))) > 32)) 
			{
				$json['error']['lastname'] = $this->lang->line('error_lastname');
			}

			if ((strlen(trim($this->input->post('address_1'))) < 3) || (strlen(trim($this->input->post('address_1'))) > 128)) 
			{
				$json['error']['address_1'] = $this->lang->line('error_address_1');
			}

			if ((strlen($this->input->post('city')) < 2) || (strlen($this->input->post('city')) > 32)) 
			{
				$json['error']['city'] = $this->lang->line('error_city');
			}

			if ((strlen(trim($this->input->post('postcode'))) < 2 || strlen(trim($this->input->post('postcode'))) > 10)) 
			{
				$json['error']['postcode'] = $this->lang->line('error_postcode');
			}

			if ($this->input->post('country_id') == '') 
			{
				$json['error']['country'] = $this->lang->line('error_country');
			}

			if ($this->input->post('zone_id') == '') 
			{
				$json['error']['zone'] = $this->lang->line('error_zone');
			}

			
			if (!$json) 
			{
				$this->load->model('system/country_model','country');

				$country_info = $this->country->getCountry($this->input->post('country_id'));

				if ($country_info) 
				{
					$country = $country_info['country_name'];
					$iso_code_2 = $country_info['iso_code_2'];
					$iso_code = $country_info['iso_code'];
					$address_format = "";
				} else {
					$country = '';
					$iso_code_2 = '';
					$iso_code = '';
					$address_format = '';
				}

				$this->load->model('system/zone_model','zone');

				$zone_info = $this->zone->getZone($this->input->post('zone_id'));

				if ($zone_info) {
					$zone = $zone_info['state_name'];
					$zone_code = $zone_info['state_code'];
				} else {
					$zone = '';
					$zone_code = '';
				}

				 $payment_address = array(
					'firstname'      => $this->input->post('firstname'),
					'lastname'       => $this->input->post('lastname'),
					'company'        => $this->input->post('company'),
					'address_1'      => $this->input->post('address_1'),
					'address_2'      => $this->input->post('address_2'),
					'postcode'       => $this->input->post('postcode'),
					'city'           => $this->input->post('city'),
					'zone_id'        => $this->input->post('zone_id'),
					'zone'           => $zone,
					'zone_code'      => $zone_code,
					'country_id'     => $this->input->post('country_id'),
					'country'        => $country,
					'iso_code_2'     => $iso_code_2,
					'iso_code'     	 => $iso_code,
					'address_format' => $address_format,
				);
				 $this->session->set_userdata('payment_address',$payment_address);
				$json['success'] = $this->lang->line('text_address');

				$this->session->unset_userdata('payment_method');
				$this->session->unset_userdata('payment_methods');
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

	public function methods() 
	{
		// Delete past shipping methods and method just in case there is an error
		$this->session->unset_userdata('payment_method');
		$this->session->unset_userdata('payment_methods');

		$json = array();

		if (($this->input->server('REQUEST_METHOD') == 'POST')) 
		{
			// Payment Address
			if ($this->session->userdata('payment_address') === NULL) 
			{
				$json['error'] = $this->lang->line('error_address');
			}

			if (!$json) {
				// Totals
				$total_data = array();
				$total = 0;
				$taxes = $this->mycart->getTaxes();

				$results[]=array('code'=>'sub_total');
				$results[]=array('code'=>'shipping');
				$results[]=array('code'=>'tax');
				$results[]=array('code'=>'coupon');
				$results[]=array('code'=>'voucher');
				$results[]=array('code'=>'total');
				
				foreach ($results as $result) {
					
						$this->load->model('api/Total_'.$result['code'].'_model',$result['code'].'_model');
						$model = $result['code'].'_model';
						$this->$model->getTotal($total_data, $total, $taxes);
					
				}

				// Payment Methods
				$json['payment_methods'] = array();
				
				$results = $this->common->getPaymentMethod();

				foreach ($results as $result) 
				{
					$this->load->model('payment/'.$result['payment_code'].'_model',$result['payment_code'].'_model');
					$model = $result['payment_code'].'_model';
					$payment_address = $this->session->userdata('payment_address');
					$method = $this->$model->getMethod($payment_address['country_id'], $total);
					$json['payment_methods'][$result['payment_code']] = $method;
					
				}

				if ($json['payment_methods']) 
				{
					$this->session->set_userdata('payment_methods',$json['payment_methods']);
				} 
				else 
				{
					$json['error'] = $this->lang->line('error_no_payment');
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

	public function method() 
	{
		// Delete old payment method so not to cause any issues if there is an error
		$this->session->unset_userdata('payment_method');
		

		$json = array();

		if (($this->input->server('REQUEST_METHOD') == 'POST')) 
		{
			// Payment Address
			if ($this->session->userdata('payment_address') === NULL) 
			{
				$json['error'] = $this->lang->line('error_address');
			}

			// Payment Method
			if ($this->session->userdata('payment_methods') === NULL) 
			{
				$json['error'] = $this->lang->line('error_no_payment');
			} 
			elseif ($this->input->post('payment_method') == "") 
			{
				$json['error'] = $this->lang->line('error_method');
			} 

			if (!$json) 
			{
				$payment_method = $this->session->userdata('payment_methods');
				if(isset($payment_method[$this->input->post('payment_method')]))
				{
					$this->session->set_userdata('payment_method',$payment_method[$this->input->post('payment_method')]); 
					$json['success'] = $this->lang->line('text_method');	
				}
				else
				{
					$json['error'] = $this->lang->line('error_method');	
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
