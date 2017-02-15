<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Contact_send_mail
* @Auther       : Indrajit
* @Date         : 05-12-2016
* @Description  : Admin Send Mail Related Collection of functions
*
*/

class Contact_send_mail extends CI_Controller {

private $data=array();

	function __construct()
	{
		parent::__construct();
		
		$this->_init();

		 $this->rbac->CheckAuthentication();

            $this->lang->load('marketing/contact_send_mail_lang', 'english');

            //customer group model
            $this->load->model('customers/customer_groups_model','customer_groups_model');

            //customer model
           $this->load->model('customers/customers_model','customer');

           //manufacturer Model
           $this->load->model('catalog/manufacturer_model','manufacturer');
          
             // Mailer Libraries
           $this->load->library('mailer');

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
		$this->output->set_common_meta('Mail','sarpo','This is srapo Mail page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Change_password view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index()	{
		$this->data['form_action']   = base_url('marketing/contact_send_mail/send');
		$this->data['cancel'] 		= base_url('marketing/contact_send_mail');
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Mail',
		   'href' => base_url('marketing/contact_send_mail'),
		 
		  );
		$this->data['customer_groups']  = $this->customer_groups_model->getCustomerGroups();
		// echo "<pre>";
		// print_r($this->data['customer_groups'])  ;exit;             
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/marketing/contact_send_mail";
		$this->load->view($content_page,$this->data);
	}
	 
	public function send($page="") {
		$this->output->unset_template();
		$json = array();
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			
			if (!$this->input->post('subject')) {
				$json['error']['subject'] = $this->lang->line('error_subject');
				
			}

			if (!$this->input->post('message')) {
				$json['error']['message'] = $this->lang->line('error_message');
			}
			if (!$json) {
				
				$store_name = $this->common->config('config_store_name');;

				if (isset($page) && $page !=="") {
					$page = $page;
				} else {
					$page = 1;
				}

				$email_total = 0;

				$emails = array();

				switch ($this->input->post('to')) {
					case 'newsletter':
						$customer_data = array(
							'filter_newsletter' => 1,
							'start'             => ($page - 1) * 10,
							'limit'             => 10
						);

						$email_total = $this->customer->getTotalCustomer($customer_data);

						$results = $this->customer->getCustomer($customer_data);

						foreach ($results as $result) {
							$emails[] = $result['email'];
						}
						break;
					case 'customer_all':
						$customer_data = array(
							'start' => ($page - 1) * 10,
							'limit' => 10
						);

						$email_total = $this->customer->getTotalCustomer($customer_data);

						$results = $this->customer->getCustomer($customer_data);

						foreach ($results as $result) {
							$emails[] = $result['email'];
						}
						break;
					case 'manufacturer_all':
						$manufacturer_data = array(
							'start' => ($page - 1) * 10,
							'limit' => 10
						);

						$email_total = $this->manufacturer->getTotalManufacturer($manufacturer_data);

						$results = $this->manufacturer->getManufacturer($manufacturer_data);

						foreach ($results as $result) {
							$emails[] = $result['email'];
						}
						break;
					case 'customer_group':
						$customer_data = array(
							'filter_customer_group_id' => $this->input->post('customer_group_id'),
							'start'                    => ($page - 1) * 10,
							'limit'                    => 10
						);

						$email_total = $this->customer->getTotalCustomer($customer_data);

						$results = $this->customer->getCustomer($customer_data);

						foreach ($results as $result) {
							$emails[$result['customer_id']] = $result['email'];
						}
						break;
					case 'customer':
						if (!empty($this->input->post('customer'))) {
							foreach ($this->input->post('customer') as $customer_id) {
								$customer_info = $this->customer->getCustomerById($customer_id);

								if ($customer_info) {
									$emails[] = $customer_info['email'];
								}
							}
						}
						break;
					case 'manufacturer':
						if (!empty($this->input->post('manufacturer'))) {
							foreach ($this->input->post('manufacturer') as $manufacturer_id) {
								$manufacturer_info = $this->manufacturer->getManufacturerById($manufacturer_id);

								if ($manufacturer_info) {
									$emails[] = $manufacturer_info['email'];
								}
							}
						}
						break;
					case 'product':
						if (!empty($this->input->post('product'))) {
							$email_total = $this->common->getTotalEmailsByProductsOrdered($this->input->post('product'));

							$results = $this->common->getEmailsByProductsOrdered($this->input->post('product'), (($page - 1) * 10), 10);

							foreach ($results as $result) {
								$emails[] = $result['email'];
							}
						}
						break;
				}
				
				if ($emails) {
					$start = ($page - 1) * 10;
					$end = $start + 10;

					if ($end < $email_total) {
						$json['success'] = sprintf($this->lang->line('text_success'), $start, $email_total);
					} else {
						$json['success'] = $this->lang->line('text_success');
					}

					if ($end < $email_total) {
						$json['next'] = base_url('marketing/contact_send_mail/'.($page + 1));
					} else {
						$json['next'] = '';
					}

					$message  = '<html dir="ltr" lang="en">' . "\n";
					$message .= '  <head>' . "\n";
					$message .= '    <title>' . $this->input->post['subject'] . '</title>' . "\n";
					$message .= '    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
					$message .= '  </head>' . "\n";
					$message .= '  <body>' . html_entity_decode($this->input->post('message'), ENT_QUOTES, 'UTF-8') . '</body>' . "\n";
					$message .= '</html>' . "\n";

					foreach ($emails as $email) {
						if (preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
							
							$subject = html_entity_decode($this->input->post('subject'), ENT_QUOTES, 'UTF-8');
							$this->mailer->Send_contact_mail($email,$subject,$message);
						}
					}
				}
			}

		}
		echo json_encode($json);
	}
	
}
