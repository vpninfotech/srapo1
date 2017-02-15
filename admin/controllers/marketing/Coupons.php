<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Coupons
* @Auther       : Vinay
* @Date         : 15-11-2016
* @Description  : Admin Coupon Related Collection of functions
*
*/

class Coupons extends CI_Controller {

        private $data=array();
	private $error = array();

	function __construct()
	{
            parent::__construct();

            $this->_init();

            $this->rbac->CheckAuthentication();
			
            $this->load->model('marketing/coupon_model','coupon');
            
			$this->load->model('catalog/product_model','product');
			
            $this->lang->load('marketing/coupon_lang', 'english');

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
            $this->output->set_common_meta('Coupons','sarpo','This is srapo Coupons page');
	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Coupon view
	* @param         : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'coupon_name', $sort_order = 'ASC', $offset = 0) 
	{
            
            // breadcrumbs
            $this->data['add']              = base_url('marketing/coupons/add');
            
            if($this->session->userdata('role_id')== 1) 
            {
                $this->data['delete']       = base_url('marketing/coupons/delete');
            } 
            else 
            {
                $this->data['delete']       = base_url('marketing/coupons/softDelete');
            }
            
            //$this->data['refresh']          = base_url('marketing/coupon/refresh');
            $this->data['breadcrumbs']      = array();
            $this->data['breadcrumbs'][]    = array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),
            );

            $this->data['breadcrumbs'][] = array(
               'text' => 'Coupons',
               'href' => base_url('marketing/coupon'),
            );
                
            //	pagination
            $limit = $this->common->config('config_limit_admin');
            $data = array(
                'sort' => $sort_by,
                'order'=> $sort_order,
                'start'=> $offset,
                'limit'=> $limit
            );
		
            $url = base_url("marketing/coupons/index/$sort_by/$sort_order");
            $total_records = $this->coupon->getTotalCoupon();
            $config =$this->commons->pagination($url,$total_records,$limit);
            $this->pagination->initialize($config);
            $config['uri_segment'] = 6;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['sort_by'] = $sort_by;
            $this->data['sort_order'] = $sort_order;
            $results = $this->coupon->getCoupons($data);
            $this->data['pages'] = ceil($total_records/$limit);
            $this->data['totals'] = ceil($total_records);
            $this->data['range'] = ceil($offset+1);
		
            $url='';
            if ($this->uri->segment(4)!==NULL) 
			{
                $url .= '/'.$this->uri->segment(4);
            } 
            else 
            {
                $url .= '/coupon_name';
            }

            if ($this->uri->segment(5)!==NULL) 
            {
                $url .= '/'.$this->uri->segment(5);
            } 
            else 
            {
                $url .= '/ASC';
            }
            if ($this->uri->segment(6)!==NULL) 
            {
                $url .= '/'.$this->uri->segment(6);
            } 
            else 
            {
                $url .= '/0';
            }
		
            foreach ($results as $result) 
            {
                $this->data['records'][] = array(
                    'coupon_id'        => $result['coupon_id'],
                    'coupon_name'      => $result['coupon_name'],
                    'coupon_code'      => $result['coupon_code'],
                    'discount'         => $result['discount'],
                    'date_start'       => $result['date_start'],                    
                    'date_end'         => $result['date_end'],
                    'is_deleted'    => $result['is_deleted'],
                    'status'           => ($result['status'] ? $this->lang->line('text_enabled') : $this->lang->line('text_disabled')),
                    'date_modified'    => date($this->common->config('config_date_format'), strtotime($result['date_modified'])),
                    'edit'             =>base_url('marketing/coupons/edit'.$url.'/'.$this->commons->encode($result['coupon_id']))
                );
            }
		
            if (isset($this->error['warning'])) 
            {
                $this->data['error_warning'] = $this->error['warning'];
            } 
            else 
            {
                $this->data['error_warning'] = '';
            }

            if ($this->session->userdata('success')!==NULL) 
            {
                $this->data['success'] = $this->session->userdata('success');
                $this->session->set_userdata('success','');
            } 
            else 
            {
                $this->data['success'] = '';
            }
		
            if ($this->input->post('selected') !==NULL) 
            {
                $this->data['selected'] = (array)$this->input->post('selected');
            } 
            else 
            {
                $this->data['selected'] = array();
            }
            //print_r($this->data);
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/marketing/coupons_list";
            $this->load->view($content_page,$this->data);
	}
        
        /**
	* 
	* @function name : add()
	* @description   : load coupon Add view
	* @param   	 : void
	* @return        : void
	*
	*/
	public function add() 
	{
	
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
                $this->coupon->addCoupon($this->input->post());
                $this->session->set_userdata('success',$this->lang->line('text_success'));

                // Generate back url
                $url = '';

                if ($this->uri->segment(4)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(4);
                } 
                else 
                {
                    $url .= '/coupon_name';
                }

                if ($this->uri->segment(5)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(5);
                } 
                else 
                {
                    $url .= '/ASC';
                }
                if ($this->uri->segment(6)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(6);
                } 
                else 
                {
                    $url .= '/0';
                }
                if ($this->uri->segment(7)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(7);
                }
               
                redirect('marketing/coupons/index'.$url);
            } 
            $this->getForm();
	}
        
        /**
	* 
	* @function name : edit()
	* @description   : edit coupon records
	* @param         : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'coupon_name', $sort_order = 'ASC', $offset = 0) 
	{
		
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
                $this->coupon->editCoupon($this->input->post());
                $this->session->set_userdata('success',$this->lang->line('text_success'));

                // Generate back url
                $url = '';

                if ($this->uri->segment(4)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(4);
                } 
                else 
                {
                    $url .= '/coupon_name';
                }

                if ($this->uri->segment(5)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(5);
                } 
                else 
                {
                    $url .= '/ASC';
                }
                if ($this->uri->segment(6)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(6);
                } 
                else 
                {
                    $url .= '/0';
                }
                redirect('marketing/coupons/index'.$url);
            } 
            $this->getForm(); 
	}
        
        /**
	* 
	* @function name : delete()
	* @description   : permanent delete records
	* @param         : void
	* @return        : void
	*
	*/
	public function delete() 
	{
            //if (($this->input->post('selected')!==NULL) && $this->validateDelete())
			if (($this->input->post('selected')!==NULL)) 
            {
                foreach ($this->input->post('selected') as $coupon_id) 
                {
                    $this->coupon->deleteCoupon($coupon_id);
                }

                $this->session->set_userdata('success',$this->lang->line('text_success'));
                // Generate back url
                $url = '';

                if ($this->uri->segment(4)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(4);
                } 
                else 
                {
                    $url .= '/coupon_name';
                }

                if ($this->uri->segment(5)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(5);
                } 
                else 
                {
                    $url .= '/ASC';
                }
                if ($this->uri->segment(6)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(6);
                } 
                else 
                {
                    $url .= '/0';
                }
                redirect('marketing/coupons/index'.$url);
            }
            $this->index();
	}
        
        /**
	* 
	* @function name : softDelete()
	* @description   : soft Delete Records
	* @param   	 : void
	* @return        : void
	*
	*/
	public function softDelete()
	{
            //if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
			if (($this->input->post('selected')!==NULL))
            {
                foreach ($this->input->post('selected') as $coupon_id) 
                {
                    $this->coupon->softDeleteCoupon($coupon_id);
                }

                $this->session->set_userdata('success',$this->lang->line('text_success'));
                redirect('marketing/coupons/index');
            }
            $this->index();
	}
        
        
        /**
	* 
	* @function name : getForm()
	* @description   : Generate Form for Add and Edit Records
	* @param   	 : void
	* @return        : void
	*
	*/
	public function getForm()
	{
            // Transaction Status
            if (isset($this->error['warning'])) 
            {
                $this->data['error_warning'] = $this->error['warning'];
            } 
            else 
            {
                $this->data['error_warning'] = '';
            }
		
            if ($this->session->userdata('success')!==NULL) 
            {
                $this->data['success'] = $this->session->userdata('success');

                $this->session->set_userdata('success','');
            } 
            else 
            {
                $this->data['success'] = '';
            }
		
            // Generate back url
            $url = '';

            if ($this->uri->segment(4)!==NULL) 
            {
                $url .= '/'.$this->uri->segment(4);
            }
            else 
            {
                $url .= '/coupons_name';
            }

            if ($this->uri->segment(5)!==NULL)
            {
                $url .= '/'.$this->uri->segment(5);
            } 
            else 
            {
                $url .= '/ASC';
            }
            if ($this->uri->segment(6)!==NULL) 
            {
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
              'text' => 'Coupons',
              'href' => base_url('marketing/coupons'),

            );
		 
            // Add or Edit Transaction
            $count = $this->uri->total_segments();
            $method = $this->uri->segment(3);
            
            if ($method=='add') 
            {
                $this->data['form_action']  = base_url('marketing/coupons/add'.$url);
                $this->data['coupon_id']   = '';
		$this->data['text_form']    = $this->lang->line('text_add');
            } 
            else 
            {
                $this->data['form_action']  = base_url('marketing/coupons/edit'.$url.'/'.$this->uri->segment($count));
                $this->data['coupon_id']   = $this->commons->decode($this->uri->segment($count));
		$this->data['text_form']    = $this->lang->line('text_edit');
            }
            
            //$this->data['refresh'] 		= base_url('marketing/coupons/refresh');
            $this->data['cancel'] 		= base_url('marketing/coupons/index'.$url);
		
            // Set Value Back
            if (1) 
            {
                $coupons_info = $this->coupon->getCoupon($this->commons->decode($this->uri->segment($count)));
            }
		
            if ($this->input->post('coupon_name')!==NULL) 
            {
                $this->data['coupon_name'] = $this->input->post('coupon_name');
            } 
            elseif (!empty($coupons_info)) 
            {
                $this->data['coupon_name'] = $coupons_info['coupon_name'];
            } 
            else 
            {
                $this->data['coupon_name'] = '';
            }
            
            if ($this->input->post('code')!==NULL) 
            {
                $this->data['code'] = $this->input->post('code');
            } 
            elseif (!empty($coupons_info)) 
            {
                $this->data['code'] = $coupons_info['coupon_code'];
            } 
            else 
            {
                $this->data['code'] = '';
            }
            
            if ($this->input->post('coupon_type')!==NULL)
            {
                $this->data['coupon_type'] = $this->input->post('coupon_type');
            } elseif (!empty($coupons_info)) {
                $this->data['coupon_type'] = $coupons_info['coupon_type'];
            } else {
                $this->data['coupon_type'] = 'percentage';
            }
            
            if ($this->input->post('discount')!==NULL) 
            {
                $this->data['discount'] = $this->input->post('discount');
            } 
            elseif (!empty($coupons_info)) 
            {
                $this->data['discount'] = $coupons_info['discount'];
            } 
            else 
            {
                $this->data['discount'] = '';
            }
            
            if ($this->input->post('total_amt')!==NULL) 
            {
                $this->data['total_amt'] = $this->input->post('total_amt');
            } 
            elseif (!empty($coupons_info)) 
            {
                $this->data['total_amt'] = $coupons_info['total'];
            } 
            else 
            {
                $this->data['total_amt'] = '';
            }
            
            if  (($this->input->post('customer_login')) !== NULL) {
                $this->data['customer_login'] = $this->input->post('customer_login');
            } else {
                $this->data['customer_login'] = $coupons_info['logged'];
            }
            
            if  (($this->input->post('shipping')) !== NULL) {
                $this->data['shipping'] = $this->input->post('shipping');
            } else {
                $this->data['shipping'] = $coupons_info['shipping'];
            }
            
            if ($this->input->post('start_date')!==NULL) 
            {
                $this->data['start_date'] = $this->input->post('start_date');
            } 
            elseif (!empty($coupons_info)) 
            {
                $this->data['start_date'] = date("Y-m-d",strtotime($coupons_info['date_start']));
            } 
            else 
            {
                $this->data['start_date'] = '';
            }
            
            if ($this->input->post('end_date')!==NULL) 
            {
                $this->data['end_date'] = $this->input->post('end_date');
            } 
            elseif (!empty($coupons_info)) 
            {
                $this->data['end_date'] = date("Y-m-d",strtotime($coupons_info['date_end']));
                //$this->data['end_date'] = $coupons_info['date_end'];
            } 
            else 
            {
                $this->data['end_date'] = '';
            }
            
            
            if ($this->input->post('uses_per_coupan')!==NULL) 
            {
                $this->data['uses_per_coupan'] = $this->input->post('uses_per_coupan');
            } 
            elseif (!empty($coupons_info)) 
            {
                $this->data['uses_per_coupan'] = $coupons_info['uses_total'];
            } 
            else 
            {
                $this->data['uses_per_coupan'] = 1;
            }
            
            if ($this->input->post('uses_per_customer')!==NULL) 
            {
                $this->data['uses_per_customer'] = $this->input->post('uses_per_customer');
            } 
            elseif (!empty($coupons_info)) 
            {
                $this->data['uses_per_customer'] = $coupons_info['uses_customer'];
            } 
            else 
            {
                $this->data['uses_per_customer'] = 1;
            }
            
            if ($this->input->post('status')!==NULL)
            {
                $this->data['status'] = $this->input->post('status');
            } elseif (!empty($coupons_info)) {
                $this->data['status'] = $coupons_info['status'];
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
            } elseif (!empty($coupons_info)) {
		$this->data['is_deleted'] = $coupons_info['is_deleted'];
            } else {
		$this->data['is_deleted'] = 0;
            }
            
            /////////////===EXTRA PART_FETCH PRODUCT
            if (($this->input->post('coupon_product')!==NULL)) {
                    $products = $this->input->post('coupon_product');
            } elseif (($this->commons->decode($this->uri->segment($count))!==NULL)) {
                    $products = $this->coupon->getCouponProducts($this->commons->decode($this->uri->segment($count)));
            } else {
                    $products = array();
            }

            $this->data['coupon_product'] = array();

            foreach ($products as $product_id) {
                    $product_info = $this->product->getProductById($product_id);
                   
                    if ($product_info) {
                            $this->data['coupon_product'][] = array(
                                    'product_id' => $product_info['product_id'],
                                    'product_name'       => $product_info['product_name']
                            );
                    }
            }
            
            //=== FETCH CATEGORY
            if (($this->input->post('coupon_category')!==NULL)) {
                    $categories = $this->input->post('coupon_category');
            } elseif (($this->commons->decode($this->uri->segment($count))!==NULL)) {
                    $categories = $this->coupon->getCouponCategories($this->commons->decode($this->uri->segment($count)));
            } else {
                    $categories = array();
            }
            
            $this->load->model('catalog/category_model');
            
            $this->data['coupon_category'] = array();

            foreach ($categories as $category_id) {
                $category_info = $this->category_model->getPath($category_id);
                if ($category_info) {
                    $this->data['coupon_category'][] = array(
                        'category_id' => $category_info[0]['category_id'],
                        'category_name' => ($category_info[0]['category_name'])
                    );
                }
            }  
           
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/marketing/coupons";
            $this->load->view($content_page,$this->data);
	}
        
        /**
	* 
	* @function name 	: validateForm()
	* @description   	: Validate form data
	* @access 		: public
	* @param   		: void
	* @return        	: boolean
	*
	*/
	public function validateForm() 
	{
            $validation = array(
                            array(
                                'field' => 'code',
                                'label' => 'Code', 
                                'rules' => 'trim|required|min_length[3]|max_length[10]|xss_clean|callback_code_check', 
                                'errors' => array('required' => '%s must be between 3 and 10 characters!','min_length'=>'%s must be between 3 and 10 characters!','max_length'=>'%s must be between 3 and 10 characters!','code_check'=>'%s is already in use!')
                            ),
                            array(
                                'field' => 'coupon_name',
                                'label' => 'Coupon Name', 
                                'rules' => 'trim|required|min_length[3]|max_length[128]|xss_clean', 
                                'errors' => array('required' => '%s must be between 3 and 128 characters!','min_length'=>'%s must be between 3 and 128 characters!','max_length'=>'%s must be between 3 and 128 characters!')
                            ),
                            array(
                                'field' => 'discount',
                                'label' => 'Discount', 
                                'rules' => 'numeric|is_natural|xss_clean', 
                                'errors' => array('numeric' => 'Numeric value only!'),
                            ),
                            array(
                                'field' => 'total_amt',
                                'label' => 'Total Amount', 
                                'rules' => 'numeric|is_natural|xss_clean', 
                                'errors' => array('numeric' => 'Numeric value only!'),
                            ),
                            array(
                                'field' => 'customer_login',
                                'label' => 'Customer Login', 
                                'rules' => 'required|xss_clean', 
                                'errors' => array('required' => '%s field is required!'),
                            ),
                            array(
                                'field' => 'shipping',
                                'label' => 'Free Shipping', 
                                'rules' => 'required|xss_clean', 
                                'errors' => array('required' => '%s field is required!'),
                            )
                        );
                        $this->form_validation->set_rules($validation);
                        if ($this->form_validation->run() == FALSE) 
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
	* @function name : validateDelete()
	* @description   : Check coupons relation for delete
	* @param         : void
	* @return        : void
	*
	*/
	/*public function validateDelete() 
	{
            foreach ($this->input->post('selected') as $coupon_id) 
            {
                $coupons_info = $this->coupon->getCoupon($coupon_id);
				$product_total = 0;
                if (0) 
                {
                	$this->error['warning'] = $this->lang->line('error_product').$product_total;
                }
            }

		return !$this->error;
	}*/
    /**
    * 
    * @function name    : check_exists_coupons_name()
    * @description      : Validate for stock status name existing or not
    * @access           : public
    * @param            : void
    * @return           : boolean
    *
    */
    function code_check($str)
    {
        $this->db->from('coupon');
        $this->db->where('LOWER(coupon_code)',strtolower($str));
        if($this->input->post('coupon_id') !="")
        {
            $this->db->where('coupon_id !=',$this->input->post('coupon_id'));
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
