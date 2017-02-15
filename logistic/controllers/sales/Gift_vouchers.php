 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : GiftVouchers
* @Auther       : Indrajit
* @Date         : 16-11-2016
* @Description  : Admin GiftVouchers Operation
*
*/

class Gift_vouchers extends CI_Controller {

    private $data=array();
	private $error = array();

	function __construct()
	{
            parent::__construct();

            $this->_init();

            $this->rbac->CheckAuthentication();

			$this->load->model('sales/Gift_vouchers_model','gift_vouchers');
			$this->load->model('sales/Voucher_themes_model','voucher_themes');

            $this->lang->load('sales/gift_vouchers_lang', 'english');

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
            $this->output->set_common_meta('Gift Vouchers','sarpo','This is srapo Gift Vouchers page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load GiftVouchers view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'code', $sort_order = 'ASC', $offset = 0)
	{
            // breadcrumbs
            $this->data['add']             = base_url('sales/gift_vouchers/add');
            if($this->session->userdata('role_id')== 1)
            {
                    $this->data['delete']  = base_url('sales/gift_vouchers/delete');
            }
            else
            {
                    $this->data['delete']  = base_url('sales/gift_vouchers/softDelete');
            }
            $this->data['breadcrumbs']   = array();
            $this->data['breadcrumbs'][] = array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),

            );
            $this->data['breadcrumbs'][] = array(
               'text' => 'Gift Vouchers',  
               'href' => base_url('sales/gift_vouchers'),

            );
		  	
		 
            // pagination
            $limit = $this->common->config('config_limit_admin');
            $data = array(
                'sort' => $sort_by,
                'order'=> $sort_order,
                'start'=> $offset,
                'limit'=> $limit
            );
		
            $url = base_url("sales/gift_vouchers/index/$sort_by/$sort_order");
            $total_records = $this->gift_vouchers->getTotalGiftVouchers();
            $config =$this->commons->pagination($url,$total_records,$limit);
            $this->pagination->initialize($config);
            $config['uri_segment'] = 6;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['sort_by'] = $sort_by;
            $this->data['sort_order'] = $sort_order;
            $results = $this->gift_vouchers->getGiftVouchers($data);
			
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
                    $url .= '/code';
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
                
                    $this->data['records'][]     = array(
                            'voucher_id'    => $result['voucher_id'],
                            'code'          => $result['code'],
                            'from_name'     => $result['from_name'],
                            'to_name' 	    => $result['to_name'],
                            'amount' 	    => $result['amount'],
                            'is_deleted'    => $result['is_deleted'],
                            'status'        =>($result['status'] ? $this->lang->line('text_enabled') : $this->lang->line('text_disabled')),
                             
                            'date_added'    => date($this->common->config('config_date_format'), strtotime($result['date_added'])),
                            'edit'          =>base_url('sales/gift_vouchers/edit'.$url.'/'.$this->commons->encode($result['voucher_id']))
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
            $content_page="themes/".$admin_theme."/sales/gift_vouchers_list";
            $this->load->view($content_page,$this->data);
		
	}
	
	/**
	* 
	* @function name : add()
	* @description   : load GiftVouchers Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function add()	
        {	
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
                
                $this->gift_vouchers->addGiftVouchers();
                $this->session->set_userdata('success',$this->lang->line('text_success'));

                // Generate back url
                $url = '';

                if ($this->uri->segment(4)!==NULL) {
                    $url .= '/'.$this->uri->segment(4);
                }
                else
                {
                    $url .= '/code';
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
                redirect('sales/gift_vouchers');
	    }
            $this->getForm();
	}
	
	/**
	* 
	* @function name : edit()
	* @description   : edit GiftVouchers records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'code', $sort_order = 'ASC', $offset = 0)
	{	
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				 
                

                // Generate back url
                $url = '';
		
                if ($this->uri->segment(4)!==NULL) {
                    $url .= '/'.$this->uri->segment(4);
                }
                else
                {
                    $url .= '/code';
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
                    $res = $this->validateSoftDelete($this->input->post('voucher_id'));
                    if($res==0)
                    {
                        $this->session->set_userdata('error',$this->error['warning']);
                        redirect('sales/gift_vouchers/edit'.$url.'/'.$this->commons->encode($this->input->post('voucher_id')));  
                    }
                }
                $this->gift_vouchers->editGiftVouchers();
                $this->session->set_userdata('success',$this->lang->line('text_success'));
                redirect('sales/gift_vouchers/index'.$url);
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
				 
                foreach ($this->input->post('selected') as $voucher_id) 
                {
					 
					
                    $this->gift_vouchers->delete($voucher_id);
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
	* @function name : softDeleteGiftVouchers()
	* @description   : soft Delete Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function softDelete()
	{
            if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
            {
                foreach ($this->input->post('selected') as $voucher_id) 
                {
                    $this->gift_vouchers->softDelete($voucher_id);
                }

                $this->session->set_userdata('success',$this->lang->line('text_success'));
                
            }
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
                $url .= '/code';
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
              'text' => 'Gift Vouchers',
              'href' => base_url('sales/gift_vouchers'),

            );
		 
            // Add or Edit Transaction
            $count = $this->uri->total_segments();
            $method = $this->uri->segment(3);
            if ($method=='add') 
            {
				$this->data['voucher_theme'] = $this->voucher_themes->getallThemesName();
				//echo '<pre>';print_r($this->data['voucher_theme']);die;
                $this->data['form_action'] = base_url('sales/gift_vouchers/add'.$url);
                $this->data['voucher_id'] = '';
                $this->data['text_form'] = $this->lang->line('text_add');
                 
            } 
            else 
            {
				$this->data['voucher_theme'] = $this->voucher_themes->getallThemesName();
                $this->data['form_action'] = base_url('sales/gift_vouchers/edit'.$url.'/'.$this->uri->segment($count));

                $this->data['voucher_id'] = $this->commons->decode($this->uri->segment($count));
                $this->data['text_form'] = $this->lang->line('text_edit');
            }
            //$this->data['refresh'] 		= base_url('sales/gift_vouchers/refresh');
            $this->data['cancel'] 		= base_url('sales/gift_vouchers/index'.$url);
			
			// Get User voucher theme Name
            
           
		
			 
            // Set Value Back
            if (1) 
            {
                $GiftVouchers_info = $this->gift_vouchers->getGiftVouchersById($this->commons->decode($this->uri->segment($count)));
            }
			
			 
			
            if ($this->input->post('code')!==NULL) {
                $this->data['code'] = $this->input->post('code');
            } elseif (!empty($GiftVouchers_info)) {

                $this->data['code'] = $GiftVouchers_info['code'];
            } else {
                $this->data['code'] = '';
            }
			
			if ($this->input->post('from_name')!==NULL) {
                $this->data['from_name'] = $this->input->post('from_name');
            } elseif (!empty($GiftVouchers_info)) {

                $this->data['from_name'] = $GiftVouchers_info['from_name'];
            } else {
                $this->data['from_name'] = '';
            }
			
			if ($this->input->post('from_email')!==NULL) {
                $this->data['from_email'] = $this->input->post('from_email');
            } elseif (!empty($GiftVouchers_info)) {

                $this->data['from_email'] = $GiftVouchers_info['from_email'];
            } else {
                $this->data['from_email'] = '';
            }
			
			if ($this->input->post('to_name')!==NULL) {
                $this->data['to_name'] = $this->input->post('to_name');
            } elseif (!empty($GiftVouchers_info)) {

                $this->data['to_name'] = $GiftVouchers_info['to_name'];
            } else {
                $this->data['to_name'] = '';
            }
			
			if ($this->input->post('to_email')!==NULL) {
                $this->data['to_email'] = $this->input->post('to_email');
            } elseif (!empty($GiftVouchers_info)) {

                $this->data['to_email'] = $GiftVouchers_info['to_email'];
            } else {
                $this->data['to_email'] = '';
            }
			if ($this->input->post('message')!==NULL) {
                $this->data['message'] = $this->input->post('message');
            } elseif (!empty($GiftVouchers_info)) {

                $this->data['message'] = $GiftVouchers_info['message'];
            } else {
                $this->data['message'] = '';
            }
			if ($this->input->post('voucher_theme_id')!==NULL) {
                $this->data['voucher_theme_id'] = $this->input->post('voucher_theme_id');
            } elseif (!empty($GiftVouchers_info)) {

                $this->data['voucher_theme_id'] = $GiftVouchers_info['voucher_theme_id'];
            } else {
                $this->data['voucher_theme_id'] = '';
            }
			
			if ($this->input->post('amount')!==NULL) {
                $this->data['amount'] = $this->input->post('amount');
            } elseif (!empty($GiftVouchers_info)) {

                $this->data['amount'] = $GiftVouchers_info['amount'];
            } else {
                $this->data['amount'] = '';
            }
			
			if ($this->input->post('status')!==NULL) {
                $this->data['status'] = $this->input->post('status');
            } elseif (!empty($GiftVouchers_info)) {

                $this->data['status'] = $GiftVouchers_info['status'];
            } else {
                $this->data['status'] = '';
            }
		
           if ($this->input->server('REQUEST_METHOD') == 'POST')
            {
                if($this->input->post('is_deleted')==1)
                {
                    $this->data['is_deleted'] = $this->input->post('is_deleted'); 
                }else {
                    $this->data['is_deleted'] = 0;
                }
            } elseif (!empty($GiftVouchers_info)) {
		$this->data['is_deleted'] = $GiftVouchers_info['is_deleted'];
            } else {
		$this->data['is_deleted'] = 0;
            }
            
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/sales/gift_vouchers";
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
                                'field' => 'code',
                                'label' => 'Code', 
                                'rules' => 'trim|required|min_length[3]|max_length[10]|xss_clean', 
                                'errors' => array('required' => '%s must be between 3 and 10 characters!','min_length'=>'%s must be between 3 and 10 characters!','max_length'=>'%s must be between 3 and 10 characters!')
                            ),
                            array(
                                'field' => 'from_name',
                                'label' => 'From Name', 
                                'rules' => 'trim|required|min_length[1]|max_length[64]|xss_clean', 
                                'errors' => array('required' => '%s must be between 1 and than 64 characters!','min_length'=>'%s must be between 1 and 64 characters!','max_length'=>'%s must be between 1 and 64 characters!')
                            ),
                           
                            array(
                                'field' => 'from_email',
                                'label' => 'From Email', 
                                'rules' => 'trim|required|xss_clean|valid_email', 
                                'errors' => array('required' => '%s  does not appear to be valid!','valid_email'=>'%s  does not appear to be valid!')
                            ),
                            array(
                                'field' => 'to_name',
                                'label' => 'To Name', 
                                'rules' => 'trim|required|min_length[1]|max_length[64]|xss_clean', 
                                'errors' => array('required' => '%s must be  between 1 and 64 characters!','min_length'=>'%s must be between 1 and 64 characters!','max_length'=>'%s must be between 1 and 64 characters!')
                            ),
                            array(
                                'field' => 'to_email',
                                'label' => 'To Email', 
                                'rules' => 'trim|required|xss_clean|valid_email', 
                                'errors' => array('required' => '%s  does not appear to be valid!','valid_email'=>'%s  does not appear to be valid!')
                            ),

                             
                            array(
                                'field' => 'message',
                                'label' => 'Message', 
                                'rules' => 'trim|required|min_length[1]|max_length[255]|xss_clean', 
                                'errors' => array('required' => '%s must be between 1 and 255 characters!','min_length'=>'%s must be between 1 and 255 characters!','max_length'=>'%s must be between 1 and 255 characters!')
					    ),
						 
						array(
                                'field' => 'amount',
                                'label' => 'Amount', 
                                'rules' => 'trim|required|greater_than_equal_to[1]|numeric|xss_clean', 
                                'errors' => array('required' => '%s  must contain a number greater than or equal to 1!')
					    ),
					     
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
	* @description   : Check voucher_themes relation for delete
	* @param         : void
	* @return        : void
	*
	*/
	 
	public function validateDelete() 
	{
            $this->load->model('sales/orders_model');
            
            foreach ($this->input->post('selected') as $voucher_id) 
            {
                $order_voucher_info = $this->orders_model->getOrderVoucherByVoucherId($voucher_id);

                if ($order_voucher_info) 
                {   
                    $url = base_url('sales/orders/info/'.$order_voucher_info['order_id']);
                    $this->error['warning'] = $this->lang->line('error_order')."<a href='".$url."' style='color: #3c8dcb; text-decoration:unset;'>order</a>!";                    
                }
                
                
            }
            return !$this->error;
	}
        
        /**
	* 
	* @function name : validateSoftDelete()
	* @description   : Check voucher_themes relation for delete
	* @param         : void
	* @return        : void
	*
	*/
	 
	public function validateSoftDelete($voucher_id) 
	{
            $this->load->model('sales/orders_model');
            
            $order_voucher_info = $this->orders_model->getOrderVoucherByVoucherId($voucher_id);

            if ($order_voucher_info) 
            {   
                $url = base_url('sales/orders/info/'.$order_voucher_info['order_id']);
                $this->error['warning'] = $this->lang->line('error_order')."<a href='".$url."' style='color: #3c8dcb; text-decoration:unset;'>order</a>!";                    
            }   
         
            return !$this->error;
	}
	/**
	* 
	* @function name : send()
	* @description   : Send gift voucher details on mail
	* @param         : void
	* @return        : void
	*
	*/
        public function send() {
            $this->output->unset_template();
            $json = array();
            
            if (!$json) {
                
                $vouchers = array();
                
                if ($this->input->post('selected') != NULL) {
                    $vouchers = $this->input->post('selected');
                } elseif ($this->input->post('voucher_id')) {
                    $vouchers[] = $this->input->post('voucher_id');                   
                }
                
                if ($vouchers) {
                   foreach ($vouchers as $voucher_id) {
                       $this->gift_vouchers->sendVoucher($voucher_id);
                   }
                   $json['success'] = $this->lang->line('text_sent');
                } else {
                   $json['error'] = $this->lang->line('error_selection');
                }
            }
            echo json_encode($json);
        }
	
	
	 
		
}
?>
