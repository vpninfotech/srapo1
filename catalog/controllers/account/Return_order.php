<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Return_order extends CI_Controller {
    function __construct()
    {
        parent::__construct();		

        $this->_init();

        $this->lang->load('account/return_lang','english');

        $this->load->model('account/return_order_model','return');

        $this->load->model('common');

        $this->load->library('commons');

        $this->load->library('customer');
        
        $this->load->library('pagination');
    }
	
    private function _init() {
        //--Set Template
        $this->output->set_template('site_template');
        $site_theme = $this->common->config('catalog_theme');
        $this->output->set_common_meta('Return','sarpo','Return order page');
    }
    
    public function index($sort_by = 'return_id', $sort_order = 'ASC', $offset = 0)
    {
        // breadcrumbs
        $data['breadcrumbs']   = array();
        $data['breadcrumbs'][] = array(
           'text' => '<i class="glyphicon glyphicon-home"></i> Home',
           'href' => site_url('common/home'),
        );
        $data['breadcrumbs'][] = array(
           'text' => 'Account',  
           'href' => site_url('account/account'),
        );
        $data['breadcrumbs'][] = array(
           'text' => 'Product Returns',  
           'href' => site_url('account/return_order'),
        );
        
        //Pagination
        
        $limit = $this->common->config('config_product_limit');
        $filter_data = array(
            'sort'  => $sort_by,
            'order' => $sort_order,
            'start' => $offset,
            'limit' => $limit
        );
        
        $url = base_url("account/return_order/index/$sort_by/$sort_order");
        
        $total_records = $this->return->getTotalReturns();        
        
        $config = $this->commons->pagination($url, $total_records, $limit);
        $this->pagination->initialize($config);
        $config['uri_segment'] = 6;
        $data['pagination'] = $this->pagination->create_links();
        $data['sort_by'] = $sort_by;
        $data['sort_order'] = $sort_order;
        $results = $this->return->getReturns($filter_data);
         
        
        
       
        
        $data['pages'] = ceil($total_records / $limit);
        $data['totals'] = ceil($total_records);
        $data['range'] = ceil($offset + 1);
        
        // URL creation
        $url = '';
        if ($this->uri->segment(4) !== NULL) {
            $url .= '/' . $this->uri->segment(4);
        } else {
            $url .= '/return_id';
        }

        if ($this->uri->segment(5) !== NULL) {
            $url .= '/' . $this->uri->segment(5);
        } else {
            $url .= '/ASC';
        }
        if ($this->uri->segment(6) !== NULL) {
            $url .= '/' . $this->uri->segment(6);
        } else {
            $url .= '/0';
        }
        
        foreach ($results as $result) { 
            $data['records'][] = array(
                'return_id'   => $result['return_id'],
                'order_id'    => $result['order_id'],
                'name'        => $result['firstname']." ".$result['lastname'],
                'status'      => $result['status'],
                'date_added'  => date($this->common->config('config_date_format'), strtotime($result['date_added'])), 
                'view'        => base_url('account/return_order/info'. $url . '/' . $this->commons->encode($result['return_id'])), 
            );
        }
        
        $this->document->setTitle('title');
        $this->document->setDescription('description');
        $this->document->setKeywords('keyword');
        $data['header'] = $this->headers->getHeaders();
        $site_theme = $this->common->config('catalog_theme');          
        $this->load->view("themes/".$site_theme."/account/return_order_list",$data);       
    }
    
    public function info() {
        $count = $this->uri->total_segments();
        $id = $this->commons->decode($this->uri->segment($count));
        if ((int)$id) {
            $return_id = (int)$id;
        } else {
            $return_id = 0;
        }
        
        $return_info = $this->return->getReturn((int)$return_id);
        
        if ($return_info) {
            //Breadcrumbs
            $data['breadcrumbs']   = array();
            $data['breadcrumbs'][] = array(
                'text' => '<i class="glyphicon glyphicon-home"></i> Home',
                'href' => base_url('common/home'),
            );
            $data['breadcrumbs'][] = array(
                'text' => 'Account',  
                'href' => base_url('account/account'),
            );
            // URL creation
            $url = '';
            if ($this->uri->segment(4) !== NULL) {
                $url .= '/' . $this->uri->segment(4);
            } else {
                $url .= '/return_id';
            }

            if ($this->uri->segment(5) !== NULL) {
                $url .= '/' . $this->uri->segment(5);
            } else {
                $url .= '/ASC';
            }
            if ($this->uri->segment(6) !== NULL) {
                $url .= '/' . $this->uri->segment(6);
            } else {
                $url .= '/0';
            }
            $data['breadcrumbs'][] = array(
                'text' => 'Product Returns',  
                'href' => base_url('account/return_order/index'.$url.'/'.$this->commons->encode($return_info['return_id'])),
            );
            $data['breadcrumbs'][] = array(
                'text' => 'Return Information',
                'href' => base_url('account/return_order/info'.$url.'/'.$this->commons->encode($return_info['return_id'])),
            );
            
            $data['return_id'] = $return_info['return_id'];
            $data['order_id'] = $return_info['order_id'];
            $data['date_ordered'] = date($this->common->config('config_date_format'), strtotime($return_info['date_ordered']));
            $data['date_added'] = date($this->common->config('config_date_format'), strtotime($return_info['date_added']));
            $data['firstname'] = $return_info['firstname'];
            $data['lastname'] = $return_info['lastname'];
            $data['email'] = $return_info['email'];
            $data['telephone'] = $return_info['telephone'];
            $data['product'] = $return_info['product'];
            $data['model'] = $return_info['model'];
            $data['quantity'] = $return_info['quantity'];
            $data['reason'] = $return_info['reason'];
            $data['opened'] = $return_info['opened'] ? $this->lang->line('text_yes') : $this->lang->line('text_no');
            $data['comment'] = nl2br($return_info['comment']);
            $data['action'] = $return_info['action'];
            
            $data['histories'] = array();
            
            $results = $this->return->getReturnHistories((int)$return_id);
            
            foreach ($results as $result) {
                $data['histories'][] = array(
                    'date_added'    => date($this->common->config('config_date_format'), strtotime($result['date_added'])),
                    'status'        => $result['status'],
                    'comment'       => nl2br($result['comment'])
                );
            }
            
            $data['back'] = site_url('account/return_order');
            
            $this->document->setTitle('title');
            $this->document->setDescription('description');
            $this->document->setKeywords('keyword');
            $data['header'] = $this->headers->getHeaders();
        
            $site_theme = $this->common->config('catalog_theme');
            $this->load->view("themes/".$site_theme."/account/return_info",$data);
        } else {
            //Breadcrumbs
            $data['breadcrumbs']   = array();
            $data['breadcrumbs'][] = array(
                'text' => '<i class="glyphicon glyphicon-home"></i> Home',
                'href' => base_url('common/home'),
            );
            $data['breadcrumbs'][] = array(
                'text' => 'Account',  
                'href' => base_url('account/account'),
            );
            // URL creation
            $url = '';
            if ($this->uri->segment(4) !== NULL) {
                $url .= '/' . $this->uri->segment(4);
            } else {
                $url .= '/return_id';
            }

            if ($this->uri->segment(5) !== NULL) {
                $url .= '/' . $this->uri->segment(5);
            } else {
                $url .= '/ASC';
            }
            if ($this->uri->segment(6) !== NULL) {
                $url .= '/' . $this->uri->segment(6);
            } else {
                $url .= '/0';
            }
            $data['breadcrumbs'][] = array(
                'text' => 'Product Returns',  
                'href' => base_url('account/return_order/index'.$url.'/'.$this->commons->encode($return_info['return_id'])),
            );
            $data['breadcrumbs'][] = array(
                'text' => 'Return Information',
                'href' => base_url('account/return_order/info'.$url.'/'.$this->commons->encode($return_info['return_id'])),
            );
             $data['heading_title'] = "Product Returns";
            $data['text_error'] = $this->lang->line('text_error');
            $data['back'] = site_url('account/return_order');
            
            $this->document->setTitle('title');
            $this->document->setDescription('description');
            $this->document->setKeywords('keyword');
            $data['header'] = $this->headers->getHeaders();

            $site_theme = $this->common->config('catalog_theme');
            $this->load->view("themes/".$site_theme."/error/not_found",$data);
        }
        
        
    }
        
    public function add()
    {
        
        if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
            $this->return->addReturn($this->input->post());
            redirect('account/return_order/success');
        }
        $this->getForm();
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
        // breadcrumbs
        $data['breadcrumbs']   = array();
        $data['breadcrumbs'][] = array(
           'text' => '<i class="glyphicon glyphicon-home"></i> Home',
           'href' => base_url('common/home'),

        );
        $data['breadcrumbs'][] = array(
           'text' => 'Account',  
           'href' => base_url('account/account'),

        );
        $data['breadcrumbs'][] = array(
           'text' => 'Product Returns',  
           'href' => base_url('account/return_order/add'),
        );            

        // Add or Edit Transaction
        $count = $this->uri->total_segments();
        $method = $this->uri->segment(3);
        if ($method=='add') 
        {
            $data['form_action'] = base_url('account/return_order/add');
            $data['customer_id'] = '';
            $data['heading_title'] = $this->lang->line('heading_title');
            $data['text_description'] = $this->lang->line('text_description');
            $data['text_order'] = $this->lang->line('text_order');
            $data['text_product'] = $this->lang->line('text_product');           
        } 
        
        $data['back'] 		= base_url('account/return_order');
        
        $order_id = $this->commons->decode($this->uri->segment(4));
        
        $this->load->model('account/order_model');
        
        if ((int)$order_id) {
           $order_info = $this->order_model->getOrder((int)$order_id); 
        }
        
        $product_id = $this->commons->decode($this->uri->segment(5));
        
        $this->load->model('catalog/product_model');
        
        if((int)$product_id) {
            $product_info = $this->product_model->getProduct((int)$product_id);
        }
        
        if ($this->input->post('order_id')!==NULL) {
            $data['order_id'] = $this->input->post('order_id');
        } elseif (!empty($order_info)) {
            $data['order_id'] = $order_info['order_id'];
        } else {
            $data['order_id'] = '';
        }
        
        if ($this->input->post('date_ordered')!==NULL) {
            $data['date_ordered'] = $this->input->post('date_ordered');
        } elseif (!empty($order_info)) {
            $data['date_ordered'] = date('Y-m-d', strtotime($order_info['date_added']));
        } else {
            $data['date_ordered'] = '';
        }
       
        if ($this->input->post('firstname')!==NULL) {
            $data['firstname'] = $this->input->post('firstname');
        } elseif (!empty($order_info)) {
            $data['firstname'] = $order_info['firstname'];
        } else {
            $data['firstname'] = $this->customer->getFirstName();
        }
        
        if ($this->input->post('lastname')!==NULL) {
            $data['lastname'] = $this->input->post('lastname');
        } elseif (!empty($order_info)) {
            $data['lastname'] = $order_info['lastname'];
        } else {
            $data['lastname'] = $this->customer->getLastName();
        }
        
        if ($this->input->post('email')!==NULL) {
            $data['email'] = $this->input->post('email');
        } elseif (!empty($order_info)) {
            $data['email'] = $order_info['email'];
        } else {
            $data['email'] = $this->customer->getEmail();
        }
        
        if ($this->input->post('telephone')!==NULL) {
            $data['telephone'] = $this->input->post('telephone');
        } elseif (!empty($order_info)) {
            $data['telephone'] = $order_info['telephone'];
        } else {
            $data['telephone'] = $this->customer->getTelephone();
        }
        
        if ($this->input->post('product')!==NULL) {
            $data['product'] = $this->input->post('product');
        } elseif (!empty($product_info)) {
            $data['product'] = $product_info['name'];
        } else {
            $data['product'] = '';
        }        
        
        if ($this->input->post('model')!==NULL) {
            $data['model'] = $this->input->post('model');
        } elseif (!empty($product_info)) {
            $data['model'] = $product_info['model'];
        } else {
            $data['model'] = '';
        }
        
        if ($this->input->post('quantity')!==NULL) {
            $data['quantity'] = $this->input->post('quantity');
        } else {
            $data['quantity'] = 1;
        }
        
        if ($this->input->post('opened')!==NULL) {
            $data['opened'] = $this->input->post('opened');
        } else {
            $data['opened'] = false;
        }
        
        if ($this->input->post('return_reason_id')!==NULL) {
            $data['return_reason_id'] = $this->input->post('return_reason_id');
        } else {
            $data['return_reason_id'] = '';
        }
        
        $this->load->model('system/return_reason_model');
        
        $data['return_reasons'] = $this->return_reason_model->getReturnReasons();
        
        if ($this->input->post('comment')!==NULL) {
            $data['comment'] = $this->input->post('comment');
        } else {
            $data['comment'] = '';
        }
        
        $this->document->setTitle('title');
        $this->document->setDescription('description');
        $this->document->setKeywords('keyword');
        $data['header'] = $this->headers->getHeaders();
        //echo '<pre>'.$count;print_r($this->data);die;
        $site_theme = $this->common->config('catalog_theme');
        $this->load->section('content', "themes/".$site_theme."/account/return",$data);		
        $this->load->view("themes/".$site_theme."/account/account",$data);
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
    public function validateForm() {
        // Add or Edit Transaction

        $validation = array(
                        array(
                            'field' => 'firstname',
                            'label' => 'First Name', 
                            'rules' => 'trim|required|min_length[1]|max_length[32]|xss_clean', 
                            'errors' => array('required' => '%s must be between 1 and 32 characters!','min_length'=>'%s must be between 1 and 32 characters!','max_length'=>'%s must be between 1 and 32 characters!')
                        ),

                        array(
                            'field' => 'lastname',
                            'label' => 'Last Name', 
                            'rules' => 'trim|required|min_length[1]|max_length[32]|xss_clean', 
                            'errors' => array('required' => '%s must be between 1 and 32 characters!','min_length'=>'%s must be between 1 and 32 characters!','max_length'=>'%s must be between 1 and 32 characters!')
                        ),

                        array(
                            'field' => 'email',
                            'label' => 'E-Mail Address', 
                            'rules' => 'trim|required|xss_clean|valid_email', 
                            'errors' => array('required' => '%s  does not appear to be valid!','valid_email'=>'%s  does not appear to be valid!')
                        ),
            
                        array(
                            'field' => 'telephone',
                            'label' => 'City', 
                            'rules' => 'trim|required|min_length[3]|numeric|max_length[32]|xss_clean', 
                            'errors' => array('required' => '%s must be between 3 and 32 characters!','min_length'=>'%s must be between 3 and 32 characters!','max_length'=>'%s must be between 3 and 32 characters!')
                        ),
            
                        array(
                            'field' => 'order_id',
                            'label' => 'Order ID', 
                            'rules' => 'trim|required|xss_clean', 
                            'errors' => array('required' => '%s required!')
                        ),
            
                        array(
                            'field' => 'product',
                            'label' => 'Product Name', 
                            'rules' => 'trim|required|min_length[3]|max_length[255]|xss_clean', 
                            'errors' => array('required' => '%s must be between 3 and 255 characters!','min_length'=>'%s must be between 3 and 255 characters!','max_length'=>'%s must be between 3 and 255 characters!')
                        ),
            
                        array(
                            'field' => 'model',
                            'label' => 'Product Model', 
                            'rules' => 'trim|required|min_length[3]|max_length[64]|xss_clean', 
                            'errors' => array('required' => '%s must be between 3 and 64 characters!','min_length'=>'%s must be between 3 and 64 characters!','max_length'=>'%s must be between 3 and 64 characters!')
                        ),
            
                        array(
                            'field' => 'return_reason_id',
                            'label' => 'product reason', 
                            'rules' => 'trim|required|xss_clean', 
                            'errors' => array('required' => 'You must select a return %s !')
                        ),
                                                 
                    );
                    $this->form_validation->set_rules($validation);
                    if ($this->form_validation->run() == FALSE) {
                        return FALSE;
                    }else{
                        return TRUE;
                    }
    }
    
    public function success() {
        
        // breadcrumbs
        $data['breadcrumbs']   = array();
        $data['breadcrumbs'][] = array(
           'text' => '<i class="glyphicon glyphicon-home"></i> Home',
           'href' => base_url('common/home'),

        );
        $data['breadcrumbs'][] = array(
           'text' => 'Product Returns',  
           'href' => base_url('account/return_order'),

        );
        
        $data['heading_title'] = $this->lang->line('heading_title');
        
        $data['text_message'] = $this->lang->line('text_message');
        
        $this->document->setTitle('title');
        $this->document->setDescription('description');
        $this->document->setKeywords('keyword');
        $data['header'] = $this->headers->getHeaders();
        
        $site_theme = $this->common->config('catalog_theme');
        $this->load->view("themes/".$site_theme."/common/success",$data);
    }

	
}
