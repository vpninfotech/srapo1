<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Currency
* @Auther       : Nitin Sabhadiya
* @Date         : 09-11-2016
* @Description  : Currency Related Collection of functions
*
*/

class Currency extends CI_Controller {

	private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('system/currency_model','currency');
		
		$this->lang->load('system/currency_lang', 'english');
		
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
		$this->output->set_common_meta('Currencies','sarpo','This is srapo Currencies page');
		

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load currency view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'title', $sort_order = 'ASC', $offset = 0)	
	{
	

		// breadcrumbs
		$this->data['add'] 			 = base_url('system/currency/add');
		if($this->session->userdata('role_id')== 1)
		{
			$this->data['delete'] 		= base_url('system/currency/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('system/currency/softDelete');
		}
		$this->data['refresh'] 			= base_url('system/currency/refresh');
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		  
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Currencies',
		   'href' => base_url('system/currency'),
		 
		  );
		  
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("system/currency/index/$sort_by/$sort_order");
		$total_records = $this->currency->getTotalCurrencies();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->currency->getCurrencies($data);
		$this->data['pages'] = ceil($total_records/$limit);
		$this->data['totals'] = ceil($total_records);
		$this->data['range'] = ceil($offset+1);
		
		// URL creation
		$url='';
		if ($this->uri->segment(4)!==NULL) {
			$url .= '/'.$this->uri->segment(4);
		}
		else
		{
			$url .= '/title';
		}
		
		if ($this->uri->segment(5)!==NULL) {
			$url .= '/'.$this->uri->segment(5);
		}
		else
		{
			$url .= '/ASC';
		}
		if ($this->uri->segment(6)!==NULL) {
			$url .= '/'.$this->uri->segment(6);
		}
		else
		{
			$url .= '/0';
		}
		
		foreach ($results as $result) {
			$this->data['records'][] = array(
				'currency_id'   => $result['currency_id'],
				'title'         => $result['title'] . (($result['code'] == $this->common->config('config_currency')) ? $this->lang->line('text_default_b') : null),
				'code'          => $result['code'],
				'value'         => $result['value'],
                                'is_deleted'    => $result['is_deleted'],
				'date_modified' => date($this->common->config('config_date_format'), strtotime($result['date_modified'])),
				'edit'          =>base_url('system/currency/edit'.$url.'/'.$this->commons->encode($result['currency_id']))
			);
		}
		
		
	
		
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if ($this->session->userdata('success')!==NULL) {
			$this->data['success'] = $this->session->userdata('success');

			$this->session->set_userdata('success','');
		} else {
			$this->data['success'] = '';
		}
		
		if ($this->input->post('selected') !==NULL) {
			$this->data['selected'] = (array)$this->input->post('selected');
		} else {
			$this->data['selected'] = array();
		}
		//print_r($this->data);
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/system/currency_list";
		$this->load->view($content_page,$this->data);

	}
	
	/**
	* 
	* @function name : add()
	* @description   : load currency Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	
	public function add()	{
	
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				$this->currency->addCurrency();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/title';
				}
				
				if ($this->uri->segment(5)!==NULL) {
					$url .= '/'.$this->uri->segment(5);
				}
				else
				{
					$url .= '/ASC';
				}
				if ($this->uri->segment(6)!==NULL) {
					$url .= '/'.$this->uri->segment(6);
				}
				else
				{
					$url .= '/0';
				}
				if ($this->uri->segment(7)!==NULL) {
					$url .= '/'.$this->uri->segment(7);
				}
				redirect('system/currency');
	     }
		$this->getForm();
	}
	
	/**
	* 
	* @function name : edit()
	* @description   : edit currency records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'title', $sort_order = 'ASC', $offset = 0)
	{
		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				 
								
                    // Generate back url
                    $url = '';

                    if ($this->uri->segment(4)!==NULL) {
                            $url .= '/'.$this->uri->segment(4);
                    }
                    else
                    {
                            $url .= '/title';
                    }

                    if ($this->uri->segment(5)!==NULL) {
                            $url .= '/'.$this->uri->segment(5);
                    }
                    else
                    {
                            $url .= '/ASC';
                    }
                    if ($this->uri->segment(6)!==NULL) {
                            $url .= '/'.$this->uri->segment(6);
                    }
                    else
                    {
                            $url .= '/0';
                    }
                    
                    if ($this->input->post('is_deleted') == 1) {
                        $res = $this->validateSoftDelete($this->input->post('currency_id'));
                        if($res==0)
                        {
                            $this->session->set_userdata('error',$this->error['warning']);
                            redirect('system/currency/edit'.$url.'/'.$this->commons->encode($this->input->post('currency_id')));  
                        }
                    }   
                    
                    $this->currency->editCurrency();
                    $this->session->set_userdata('success',$this->lang->line('text_success'));
                    redirect('system/currency/index'.$url);
				
	     }
	   
		$this->getForm();
	}
	
	/**
	* 
	* @function name : delete()
	* @description   : perminant delete records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function delete()
	{
		if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
		{
			foreach ($this->input->post('selected') as $currency_id) 
			{
				$this->currency->deleteCurrency($currency_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success'));
			$this->index();
		}
		else
		{
			$this->index();
		}
		
	}
	
	/**
	* 
	* @function name : softDelete()
	* @description   : soft Delete Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function softDelete()
	{
		if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
		{
			foreach ($this->input->post('selected') as $currency_id) 
			{
				$this->currency->softDeleteCurrency($currency_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success'));
			
		}
                $this->index();
	}
	
	/**
	* 
	* @function name : refresh()
	* @description   : soft Delete Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function refresh()
	{
		$this->currency->refresh(true);

		
		$this->session->set_userdata('success',$this->lang->line('text_success'));
		//redirect('system/currency/index');
		$this->index();
	}
	
	/**
	* 
	* @function name : getForm()
	* @description   : Generate Form for Add and Edit Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function getForm()
	{
		// Transaction Status
		if (isset($this->error['warning']) || $this->session->userdata('error')!==NULL) {
			if ($this->session->userdata('error')!==NULL)
                        { 
                            //echo "Error".$this->session->userdata('error'); exit;
                            $this->error['warning'] = $this->session->userdata('error');
                        }
			$this->data['error'] = $this->error['warning'];
                        $this->session->set_userdata('error','');
		} else {
			$this->data['error'] = '';
		}
		
		if ($this->session->userdata('success')!==NULL) {
			$this->data['success'] = $this->session->userdata('success');

			$this->session->set_userdata('success','');
		} else {
			$this->data['success'] = '';
		}
		
		// Generate back url
		$url = '';

		if ($this->uri->segment(4)!==NULL) {
			$url .= '/'.$this->uri->segment(4);
		}
		else
		{
			$url .= '/title';
		}
		
		if ($this->uri->segment(5)!==NULL) {
			$url .= '/'.$this->uri->segment(5);
		}
		else
		{
			$url .= '/ASC';
		}
		if ($this->uri->segment(6)!==NULL) {
			$url .= '/'.$this->uri->segment(6);
		}
		else
		{
			$url .= '/0';
		}
		
		
		
		// breadcrumbs
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		 $this->data['breadcrumbs'][] = array(
		   'text' => 'Currencies',
		   'href' => base_url('system/currency'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{
			$this->data['form_action'] = base_url('system/currency/add'.$url);
			$this->data['currency_id'] = '';
			$this->data['text_form'] 		= $this->lang->line('text_add');
		} 
		else 
		{
			$this->data['form_action'] = base_url('system/currency/edit'.$url.'/'.$this->uri->segment($count));
			$this->data['text_form'] 		= $this->lang->line('text_edit');
			
			$this->data['currency_id'] = $this->commons->decode($this->uri->segment($count));
		}
		$this->data['refresh'] 		= base_url('system/currency/refresh');
		$this->data['cancel'] 		= base_url('system/currency/index'.$url);
		
		
		// Set Value Back
		if (1) 
		{
			$currency_info = $this->currency->getCurrency($this->commons->decode($this->uri->segment($count)));
		}
		//echo '<pre>';print_r($currency_info);
		
		if ($this->input->post('title')!==NULL) {
			$this->data['title'] = $this->input->post('title');
		} elseif (!empty($currency_info)) {
			
			$this->data['title'] = $currency_info['title'];
		} else {
			$this->data['title'] = '';
		}
		
		if ($this->input->post('code')!==NULL) {
			$this->data['code'] = $this->input->post('code');
		} elseif (!empty($currency_info)) {
			$this->data['code'] = $currency_info['code'];
		} else {
			$this->data['code'] = '';
		}
		
		if ($this->input->post('symbol_left')!==NULL) {
			$this->data['symbol_left'] = $this->input->post('symbol_left');
		} elseif (!empty($currency_info)) {
			$this->data['symbol_left'] = $currency_info['symbol_left'];
		} else {
			$this->data['symbol_left'] = '';
		}
		if ($this->input->post('symbol_left')!==NULL) {
			$this->data['symbol_left'] = $this->input->post('symbol_left');
		} elseif (!empty($currency_info)) {
			$this->data['symbol_left'] = $currency_info['symbol_left'];
		} else {
			$this->data['symbol_left'] = '';
		}
		
		if ($this->input->post('symbol_right')!==NULL) {
			$this->data['symbol_right'] = $this->input->post('symbol_right');
		} elseif (!empty($currency_info)) {
			$this->data['symbol_right'] = $currency_info['symbol_right'];
		} else {
			$this->data['symbol_right'] = '';
		}
		
		if ($this->input->post('decimal_place')!==NULL) {
			$this->data['decimal_place'] = $this->input->post('decimal_place');
		} elseif (!empty($currency_info)) {
			$this->data['decimal_place'] = $currency_info['decimal_place'];
		} else {
			$this->data['decimal_place'] = '';
		}
		
		if ($this->input->post('value')!==NULL) {
			$this->data['value'] = $this->input->post('value');
		} elseif (!empty($currency_info)) {
			$this->data['value'] = $currency_info['value'];
		} else {
			$this->data['value'] = '';
		}
		
		if ($this->input->post('status')!==NULL)
                {
			$this->data['status'] = $this->input->post('status');
		} elseif (!empty($currency_info)) {
			$this->data['status'] = $currency_info['status'];
		} else {
			$this->data['status'] = 0;
		}
		
                if ($this->input->server('REQUEST_METHOD') == 'POST')
                {
                    if($this->input->post('is_deleted')==1)
                    {
                       $this->data['is_deleted'] = $this->input->post('is_deleted'); 
                    }else {
                         $this->data['is_deleted'] = 0;
                    }
		} elseif (!empty($currency_info)) {
			$this->data['is_deleted'] = $currency_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
		//echo '<pre>'.$count;print_r($this->data);die;
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/system/currency";
		$this->load->view($content_page,$this->data);
	}
	
	/**
	* 
	* @function name : validateForm()
	* @description   : Validate Entered Form data
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateForm()
	{
		$validation = array(
					   
					    array(
					        'field' => 'title',
					        'label' => 'Currency Title', 
					        'rules' => 'trim|required|min_length[3]|max_length[128]|xss_clean|callback_check_exists_title', 
					        'errors' => array('required' => '%s must be between 3 and 128 characters!','min_length'=>'%s must be between 3 and 128 characters!','max_length'=>'%s must be between 3 and 128 characters!','check_exists_title'=>'%s already exists!')
					    ),
					    array(
					        'field' => 'code',
					        'label' => 'Currency Code', 
					        'rules' => 'trim|required|exact_length[3]|xss_clean|callback_check_exists_code', 
					        'errors' => array('required' => '%s must contain 3 characters!!','exact_length'=>'%s must contain 3 characters!!','check_exists_code'=>'%s already exists!')
					    )
					   
					);
					$this->form_validation->set_rules($validation);
			if ($this->form_validation->run() == FALSE) {
				return FALSE;
			}else{
				return TRUE;
			}
	}
	
	/**
	* 
	* @function name : validateDelete()
	* @description   : Check currency relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{
            $this->load->model('sales/orders_model');
            
            foreach ($this->input->post('selected') as $currency_id) 
            {
                $currency_info = $this->currency->getCurrency($currency_id);
                if ($currency_info) 
                {
                    if ($this->common->config('config_currency') == $currency_info['code']) {
                         $this->error['warning'] = $this->lang->line('error_default');
                    }                                           
                }
                
                $order_total = $this->orders_model->getTotalOrdersByCurrencyId($currency_id);
                if ($order_total) {
                    $this->error['warning'] = $this->lang->line('error_order').'('.$order_total.')';
                }
            }
		return !$this->error;
	}
        
        /**
	* 
	* @function name : validateSoftDelete()
	* @description   : Check currency relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateSoftDelete($currency_id) 
	{
            $this->load->model('sales/orders_model');
            
            
            $currency_info = $this->currency->getCurrency($currency_id);
            if ($currency_info) 
            {
                if ($this->common->config('config_currency') == $currency_info['code']) {
                     $this->error['warning'] = $this->lang->line('error_default');
                }                                           
            }

            $order_total = $this->orders_model->getTotalOrdersByCurrencyId($currency_id);
            if ($order_total) {
                $this->error['warning'] = $this->lang->line('error_order').'('.$order_total.')';
            }
           
            return !$this->error;
	}
        
	/**
	* 
	* @function name 	: check_exists_title()
	* @description   	: Validate for currency title existing or not
	* @access 		: public
	* @param   		: void
	* @return        	: boolean
	*
	*/
    function check_exists_title($str)
	{
		$this->db->from('currency');
		$this->db->where('LOWER(title)',strtolower($str));
                $this->db->where('is_deleted=0');
		if($this->input->post('currency_id') !="")
		{
			$this->db->where('currency_id !=',$this->input->post('currency_id'));
		}
		$query=$this->db->get();
		$row = $query->num_rows();
		if($row > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		} 
	} 
	/**
	* 
	* @function name 	: check_exists_code()
	* @description   	: Validate for currency code existing or not
	* @access 		: public
	* @param   		: void
	* @return        	: boolean
	*
	*/
    function check_exists_code($str)
	{
	  	$this->db->from('currency');
		$this->db->where('LOWER(code)',strtolower($str));
                $this->db->where('is_deleted=0');
		if($this->input->post('currency_id') !="")
		{
			$this->db->where('currency_id !=',$this->input->post('currency_id'));
		}
		$query=$this->db->get();
		$row = $query->num_rows();
		if($row > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		} 
	}    
	
}
