<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher extends CI_Controller {
	private $error = array();
	function __construct()
	{
		parent::__construct();
		
		$this->_init();
		
		$this->load->library('customer');
		
		$this->lang->load('account/voucher_lang','english');

	}
	
	private function _init() {
		
		//--Set Template
		$this->output->set_template('site_template');
		$site_theme = $this->common->config('catalog_theme');
		$this->output->set_common_meta('Purchase a Gift Certificate','sarpo','Purchase a Gift Certificate');
		

	}
	public function index()
	{
		$this->document->setTitle($this->lang->line('heading_title'));
		
		if (!($this->session->userdata('vouchers')!==NULL)) {
			$this->session->set_userdata('vouchers',array());
		}
		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validate()) {
			
		$voucher_data['vouchers'][mt_rand()] = array(
				'description'      => sprintf($this->lang->line('text_for'), $this->currency->format($this->currency->convert($this->input->post('amount'), $this->currency->getCode(), $this->common->config('config_currency'))), $this->input->post('to_name')),
				'to_name'          => $this->input->post('to_name'),
				'to_email'         => $this->input->post('to_email'),
				'from_name'        => $this->input->post('from_name'),
				'from_email'       => $this->input->post('from_email'),
				'voucher_theme_id' => $this->input->post('voucher_theme_id'),
				'message'          => $this->input->post('message'),
				'amount'           => $this->currency->convert($this->input->post('amount'), $this->currency->getCode(), $this->common->config('config_currency'))
			);
		$this->session->set_userdata('vouchers',$voucher_data['vouchers']); 

			redirect(('account/voucher/success'));
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => 'Home',
			'href' => site_url('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => 'Account',
			'href' => site_url('account/account')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('text_voucher'),
			'href' => site_url('account/voucher')
		);
		
		$data['heading_title'] 		= $this->lang->line('heading_title');

		$data['text_description'] 	= $this->lang->line('text_description');
		$data['text_agree'] 		= $this->lang->line('text_agree');

		$data['entry_to_name'] 		= $this->lang->line('entry_to_name');
		$data['entry_to_email'] 	= $this->lang->line('entry_to_email');
		$data['entry_from_name'] 	= $this->lang->line('entry_from_name');
		$data['entry_from_email'] 	= $this->lang->line('entry_from_email');
		$data['entry_theme'] 		= $this->lang->line('entry_theme');
		$data['entry_message'] 		= $this->lang->line('entry_message');
		$data['entry_amount']		= $this->lang->line('entry_amount');

		$data['help_message'] 		= $this->lang->line('help_message');
		$data['help_amount'] = sprintf($this->lang->line('help_amount'), $this->currency->format($this->common->config('config_voucher_min')), $this->currency->format($this->common->config('config_voucher_max')));

		$data['button_continue'] = $this->lang->line('button_continue');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['to_name'])) {
			$data['error_to_name'] = $this->error['to_name'];
		} else {
			$data['error_to_name'] = '';
		}

		if (isset($this->error['to_email'])) {
			$data['error_to_email'] = $this->error['to_email'];
		} else {
			$data['error_to_email'] = '';
		}

		if (isset($this->error['from_name'])) {
			$data['error_from_name'] = $this->error['from_name'];
		} else {
			$data['error_from_name'] = '';
		}

		if (isset($this->error['from_email'])) {
			$data['error_from_email'] = $this->error['from_email'];
		} else {
			$data['error_from_email'] = '';
		}

		if (isset($this->error['theme'])) {
			$data['error_theme'] = $this->error['theme'];
		} else {
			$data['error_theme'] = '';
		}

		if (isset($this->error['amount'])) {
			$data['error_amount'] = $this->error['amount'];
		} else {
			$data['error_amount'] = '';
		}

		$data['action'] = site_url('account/voucher');

		if ($this->input->post('to_name')!==NULL) {
			$data['to_name'] = $this->input->post('to_name');
		} else {
			$data['to_name'] = '';
		}

		if ($this->input->post('to_email')!==NULL) {
			$data['to_email'] = $this->input->post('to_email');
		} else {
			$data['to_email'] = '';
		}

		if ($this->input->post('from_name')!==NULL) {
			$data['from_name'] = $this->input->post('from_name');
		} elseif ($this->customer->isLogged()) {
			$data['from_name'] = $this->customer->getFirstName() . ' '  . $this->customer->getLastName();
		} else {
			$data['from_name'] = '';
		}

		if ($this->input->post('from_email')!==NULL) {
			$data['from_email'] = $this->input->post('from_email');
		} elseif ($this->customer->isLogged()) {
			$data['from_email'] = $this->customer->getEmail();
		} else {
			$data['from_email'] = '';
		}

		$this->load->model('total/Voucher_theme_model','voucher_theme');

		$data['voucher_themes'] = $this->voucher_theme->getVoucherThemes();

		if ($this->input->post('voucher_theme_id')!==NULL) {
			$data['voucher_theme_id'] = $this->input->post('voucher_theme_id');
		} else {
			$data['voucher_theme_id'] = '';
		}

		if ($this->input->post('message')!==NULL) {
			$data['message'] = $this->input->post('message');
		} else {
			$data['message'] = '';
		}

		if ($this->input->post('amount')!==NULL) {
			$data['amount'] = $this->input->post('amount');
		} else {
			$data['amount'] = $this->currency->format($this->common->config('config_voucher_min'), $this->common->config('config_currency'), false, false);
		}

		if ($this->input->post('agree')!==NULL) {
			$data['agree'] = $this->input->post('agree');
		} else {
			$data['agree'] = false;
		}
		$data['header'] = $this->headers->getHeaders();
        $site_theme = $this->common->config('catalog_theme');
		//echo '<pre>';print_r($data);die;
        $this->load->view("themes/".$site_theme."/account/voucher",$data);
	}
	
	public function success() {

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => 'Home',
			'href' => site_url('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('text_voucher'),
			'href' => site_url('account/voucher')
		);


		$data['text_message'] = $this->lang->line('text_message');

		$data['button_continue'] = $this->lang->line('button_continue');

		$data['continue'] = site_url('checkout/cart');
		
		$data['heading_title'] = $this->lang->line('heading_title');
        
        $data['text_message'] = $this->lang->line('text_message');
        
        $this->document->setTitle('title');
        $this->document->setDescription('description');
        $this->document->setKeywords('keyword');
        $data['header'] = $this->headers->getHeaders();
		
        $site_theme = $this->common->config('catalog_theme');
        $this->load->view("themes/".$site_theme."/common/success",$data);	
	}
	
	protected function validate() {
		if ((strlen($this->input->post('to_name')) < 1) || (strlen($this->input->post('to_name')) > 64)) {
			$this->error['to_name'] = $this->lang->line('error_to_name');
		}

		if ((strlen($this->input->post('to_email')) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->input->post('to_email'))) {
			$this->error['to_email'] = $this->lang->line('error_email');
		}

		if ((strlen($this->input->post('from_name')) < 1) || (strlen($this->input->post('from_name')) > 64)) {
			$this->error['from_name'] = $this->lang->line('error_from_name');
		}

		if ((strlen($this->input->post('from_email')) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->input->post('from_email'))) {
			$this->error['from_email'] = $this->lang->line('error_email');
		}

		if (!($this->input->post('voucher_theme_id')!==NULL)) {
			$this->error['theme'] = $this->lang->line('error_theme');
		}

		if (($this->currency->convert($this->input->post('amount'), $this->currency->getCode(), $this->common->config('config_currency')) < $this->common->config('config_voucher_min')) || ($this->currency->convert($this->input->post('amount'), $this->currency->getCode(), $this->common->config('config_currency')) > $this->common->config('config_voucher_max'))) {
			$this->error['amount'] = sprintf($this->lang->line('error_amount'), $this->currency->format($this->common->config('config_voucher_min')), $this->currency->format($this->common->config('config_voucher_max')));
		}

		if (!($this->input->post('agree')!==NULL)) {
			$this->error['warning'] = $this->lang->line('error_agree');
		}

		return !$this->error;
	}
}

