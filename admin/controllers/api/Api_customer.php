<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Api_customer
* @Auther       : Indrajit
* @Date         : 20-12-2016
* @Description  : Api customers Operation
*
*/

class Api_customer extends CI_Controller 
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

            $this->lang->load('api/api_customer_lang', 'english');

            $this->load->model('common');

            $this->load->library('commons');

            $this->load->library('pagination');

            $this->load->library('customer');
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
	* @description   : load customers view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index() {
		// Delete past customer in case there is an error
		$this->session->unset_userdata('customer');

		$json = array();

		if (($this->input->server('REQUEST_METHOD') == 'POST'))
		{
			
			// Add keys for missing post vars
			$keys = array(
				'customer_id',
				'customer_group_id',
				'firstname',
				'lastname',
				'email',
				'telephone',
				'fax'
			);

			// Customer
			if($this->input->post('customer_id'))
			{
				$customer_info = $this->customers->getCustomerById($this->input->post('customer_id'));
				if (!$customer_info) 
				{
					$json['error']['warning'] = $this->lang->line('error_customer');
				}
				else
				{
					if(!$this->customer->login($customer_info['email'], '', true))
					{
						$json['error']['warning'] = $this->lang->line('error_customer');
					}
				}
			}

			if ((strlen(trim($this->input->post('firstname'))) < 1) || (strlen(trim($this->input->post('firstname'))) > 32)) {
				$json['error']['firstname'] = $this->lang->line('error_firstname');
			}

			if ((strlen(trim($this->input->post('lastname'))) < 1) || (strlen(trim($this->input->post('lastname'))) > 32)) {
				$json['error']['lastname'] = $this->lang->line('error_lastname');
			}

			if ((strlen($this->input->post('email')) > 96) || (!preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->input->post('email')))) {
				$json['error']['email'] = $this->lang->line('error_email');
			}

			if ((strlen($this->input->post('telephone')) < 3) || (strlen($this->input->post('telephone')) > 32)) {
				$json['error']['telephone'] = $this->lang->line('error_telephone');
			}

			if (!$json) {
				
				 $customer_details = array(
					'customer_id'       => $this->input->post('customer_id'),
					'customer_group_id' => $this->input->post('customer_group_id'),
					'firstname'         => $this->input->post('firstname'),
					'lastname'          => $this->input->post('lastname'),
					'email'             => $this->input->post('email'),
					'telephone'         => $this->input->post('telephone'),
				);
				 $this->session->set_userdata('customer',$customer_details);
				$json['success'] = $this->lang->line('text_success');
			}
		}

		echo json_encode($json);
	}
}
