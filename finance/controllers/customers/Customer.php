<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : customers
* @Auther       : Indrajit
* @Date         : 10-10-2016
* @Description  : Admin customers Operation
*
*/

class Customer extends CI_Controller {

    private $data=array();
	private $error = array();

	function __construct()
	{
            parent::__construct();

            $this->_init();

            $this->rbac->CheckAuthentication();

            $this->load->model('customers/Customer_groups_model','customers_group');
			
            $this->load->model('customers/customers_model','customers');

            $this->lang->load('customers/customers_lang', 'english');

            $this->load->model('common');

            $this->load->library('commons');

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
            $this->output->set_common_meta('customers','sarpo','This is srapo customers page');

	}
	        
        public function autocomplete() {
		$this->output->unset_template();
		$json = array();
			
			if ($this->input->post('filter_name')!==NULL) {
				$filter_name = $this->input->post('filter_name');
			} else {
				$filter_name = '';
			}
			
			if ($this->input->post('filter_email')!==NULL) {
				$filter_email = $this->input->post('filter_email');
			} else {
				$filter_email = '';
			}
			
			$filter_data = array(
				'filter_name'  => $filter_name,
				'filter_email' => $filter_email,
				'start'        => 0,
				'limit'        => 5
			);

			$results = $this->customers->getCustomer($filter_data);
                        

			foreach ($results as $result) {
				$json[] = array(
					'customer_id'       => $result['customer_id'],
					'firstname'         => $result['firstname'],
					'lastname'          => $result['lastname'],
					'email'             => $result['email'],
					'telephone'         => $result['telephone'],
				);
			}
		
		
		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['firstname'];
		}

		array_multisort($sort_order, SORT_ASC, $json);
                
        echo json_encode($json);
	}
}
