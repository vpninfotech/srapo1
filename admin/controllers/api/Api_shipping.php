<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Api_shipping
* @Auther       : Indrajit
* @Date         : 24-12-2016
* @Description  : Api customers Operation
*
*/
class Api_shipping extends CI_Controller 
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

            $this->lang->load('api/api_shipping_lang', 'english');

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
	public function address() 
	{
		

		// Delete old shipping address, shipping methods and method so not to cause any issues if there is an error
		$this->session->unset_userdata('shipping_address');
		$this->session->unset_userdata('shipping_methods');
		$this->session->unset_userdata('shipping_method');

		$json = array();

		if ($this->mycart->hasShipping()) 
		{
			if (($this->input->server('REQUEST_METHOD') == 'POST')) 
			{
				if ((strlen(trim($this->input->post('firstname'))) < 1) || (strlen(trim($this->input->post('firstname'))) > 32)) {
					$json['error']['firstname'] = $this->lang->line('error_firstname');
				}

				if ((strlen(trim($this->input->post('lastname'))) < 1) || (strlen(trim($this->input->post('lastname'))) > 32)) {
					$json['error']['lastname'] = $this->lang->line('error_lastname');
				}

				if ((strlen(trim($this->input->post('address_1'))) < 3) || (strlen(trim($this->input->post('address_1'))) > 128)) {
					$json['error']['address_1'] = $this->lang->line('error_address_1');
				}

				if ((strlen($this->input->post('city')) < 2) || (strlen($this->input->post('city')) > 32)) {
					$json['error']['city'] = $this->lang->line('error_city');
				}

				if ((strlen(trim($this->input->post('postcode'))) < 2 || strlen(trim($this->input->post('postcode'))) > 10)) {
					$json['error']['postcode'] = $this->lang->line('error_postcode');
				}

				if ($this->input->post('country_id') == '') {
					$json['error']['country'] = $this->lang->line('error_country');
				}

				if ($this->input->post('zone_id') == '') 
				{
					$json['error']['zone'] = $this->lang->line('error_zone');
				}

				if (!$json) {
					$this->load->model('system/country_model','country');

				$country_info = $this->country->getCountry($this->input->post('country_id'));

					if ($country_info) {
						$country = $country_info['country_name'];
						$iso_code_2 = $country_info['iso_code_2'];
						$iso_code = $country_info['iso_code'];
						$address_format = '';
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

					 $shipping_address = array(
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
						'iso_code'     => $iso_code,
						'address_format' => $address_format,
						
					);
					 $this->session->set_userdata('shipping_address',$shipping_address);

					$json['success'] = $this->lang->line('text_address');

					$this->session->unset_userdata('shipping_method');
					$this->session->unset_userdata('shipping_methods');
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

	public function methods() 
	{
		// Delete past shipping methods and method just in case there is an error
		$this->session->unset_userdata('shipping_methods');
		$this->session->unset_userdata('shipping_method');

		$json = array();

		if ($this->mycart->hasShipping()) {
			if ($this->session->userdata('shipping_address') === NULL) 
			{
				$json['error'] = $this->lang->line('error_address');
			}

			if (!$json) {
				// Shipping Methods
				$json['shipping_methods'] = array();

				$results = $this->common->getShippingMethod();

				foreach ($results as $result) 
				{
					$this->load->model('shipping/'.$result['shipping_code'].'_model',$result['shipping_code'].'_model');
					$model = $result['shipping_code'].'_model';
					$shipping_address = $this->session->userdata('shipping_address');
					$quote = $this->$model->getQuote($shipping_address['country_id']);
					if ($quote) {
							$json['shipping_methods'][$result['shipping_code']] = array(
								'title'      => $quote['title'],
								'quote'      => $quote['quote'],
								'sort_order' => $quote['sort_order'],
								'error'      => $quote['error']
							);
						}
					
				}

				
				if ($json['shipping_methods']) {
					$this->session->set_userdata('shipping_methods',$json['shipping_methods']);
				} else {
					$json['error'] = $this->lang->line('error_no_shipping');
				}
			}
		} else {
			$json['shipping_methods'] = array();
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

	public function method() {
		// Delete old shipping method so not to cause any issues if there is an error
		$this->session->unset_userdata('shipping_method');

		$json = array();

		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{
			if ($this->mycart->hasShipping()) {
				// Shipping Address
				if ($this->session->userdata('shipping_address') === NULL) 
				{
					$json['error'] = $this->lang->line('error_address');
				}

				// Shipping Method
				if ($this->session->userdata('shipping_methods') === NULL) 
				{
					$json['error'] = $this->lang->line('error_no_shipping');
				} elseif ($this->input->post('shipping_method') == "") 
				{
					$json['error'] = $this->lang->line('error_method');
				} else {
					$shipping = explode('.', $this->input->post('shipping_method'));
					$shipping_methods = $this->session->userdata('shipping_methods');
					if (!isset($shipping[0]) || !isset($shipping[1]) || !isset($shipping_methods[$shipping[0]]['quote'][$shipping[1]])) {
						$json['error'] = $this->lang->line('error_method');
					}
				}

				if (!$json) 
				{
					$this->session->set_userdata('shipping_method',$shipping_methods[$shipping[0]]['quote'][$shipping[1]]);

					$json['success'] = $this->lang->line('text_method');
				}
			} 
			else 
			{
				$this->session->unset_userdata('shipping_address');
				$this->session->unset_userdata('shipping_method');
				$this->session->unset_userdata('shipping_methods');
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
