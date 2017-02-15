<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
    function __construct()
    {
        parent::__construct();
		
        $this->_init();
                
        $this->rbac->CheckAuthentication();

        $this->lang->load('account/order_lang', 'english');

        //$this->load->model('system/currency_model','currency');

        $this->load->model('account/order_model','order');

        //$this->load->model('system/order_status_model','order_status');

        //$this->load->model('customers/customers_model','customers');

        //$this->load->model('customers/Customer_groups_model','customers_group');

        $this->load->model('common');

        $this->load->library('commons');
        
        $this->load->library('encryption');

        $this->load->library('customer');

        $this->load->library('currency');
        $this->load->library('mycart');

        $this->load->library('pagination');
    }
	
    private function _init() {

        //--Set Template
        $this->output->set_template('site_template');
        $site_theme = $this->common->config('catalog_theme');
        $this->output->set_common_meta('Order History','sarpo','Order History Page');


    }
    public function index($sort_by = 'order_id', $sort_order = 'ASC', $offset = 0)
    {
        //Breadcrumbs
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
            'text' => 'Order History',  
            'href' => site_url('account/order'),
        );
        
        //Pagination
        
        $limit = $this->common->config('config_product_limit');
        $data['filter'] = array(
            'sort' => $sort_by,
            'order' => $sort_order,
            'start' => $offset,
            'limit' => $limit
        );
        $url = site_url("account/order/index/$sort_by/$sort_order");
        
        $total_records = $this->order->getTotalOrders();
        
        $config = $this->commons->pagination($url, $total_records, $limit);
        $this->pagination->initialize($config);
        $config['uri_segment'] = 6;
        
        $results = $this->order->getOrders($data['filter']);
        $data['pagination'] = $this->pagination->create_links();
        
        
        
        $data['pages'] = ceil($total_records / $limit);
        $data['totals'] = ceil($total_records);
        $data['range'] = ceil($offset + 1);
        
        // URL creation
        $url = '';
        if ($this->uri->segment(4) !== NULL) {
            $url .= '/' . $this->uri->segment(4);
        } else {
            $url .= '/order_id';
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
            $product_total = $this->order->getTotalOrderProductsByOrderId($result['order_id']);
            $voucher_total = $this->order->getTotalOrderVouchersByOrderId($result['order_id']);
            
            $data['records'][] = array(
                'order_id'      => $result['order_id'],
                'name'          => $result['customer'],
                'payment_method' => $result['payment_method'],
                'status'        => $result['status'],
                'date_added'    => date($this->common->config('config_date_format'), strtotime($result['date_added'])),
                'products'      => ($product_total + $voucher_total),
                'total'         => $this->currency->format($result['total'], $result['currency_code'], $result['currency_value']),  
                'view'          => site_url('account/order/info/' . $this->commons->encode($result['order_id'])),         
            );
        }
        
        $this->document->setTitle('title');
        $this->document->setDescription('description');
        $this->document->setKeywords('keyword');
        $data['header'] = $this->headers->getHeaders();
        $site_theme = $this->common->config('catalog_theme');          
        $this->load->view("themes/".$site_theme."/account/order_list",$data);
    }
    
    public function info() {
        
        $count = $this->uri->total_segments();
        $id = $this->commons->decode($this->uri->segment($count));
        if ((int)$id) {
           $order_id = (int)$id;
        } else {
            $order_id = 0;
        }
        
        $order_info = $this->order->getOrder((int)$order_id);
        
        if ($order_info) {
            //Breadcrumbs
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
                'text' => 'Order Information',  
                'href' => site_url('account/order/info/'.$this->commons->encode($order_info['order_id'])),
            );
            
            if ($this->session->userdata('warning')!==NULL) {
                $data['error_warning'] = $this->session->userdata('warning');
                $this->session->unset_userdata('success');
            } else {
                $data['error_warning'] = '';
                //$this->session->unset_userdata('success1');
            }
            //$this->session->unset_userdata('success');
            if ($this->session->userdata('success')!==NULL) {                
                $data['success'] = $this->session->userdata('success'); 
                $this->session->unset_userdata('warning');
            } else {
                $data['success'] = '';
            }            
            //print_r($order_info);
            
            if ($order_info['invoice_no']) {
                $data['invoice_no'] = $order_info['invoice_prefix'] . $order_info['invoice_no'];
            } else {
                $data['invoice_no'] = '';
            }
            
            
            
            $data['order_id'] = $id;
            $data['date_added'] = date($this->common->config('config_date_format'), strtotime($order_info['date_added']));
            $data['payment_address'][] = array(
                'name'          => $order_info['payment_firstname']." ".$order_info['payment_lastname'],
                'company'       => $order_info['payment_company'],
                'address_1'     => $order_info['payment_address_1'],
                'address_2'     => $order_info['payment_address_2'],
                'city'          => $order_info['payment_city'],
                'postcode'      => $order_info['payment_postcode'],
                'state_id'      => $order_info['payment_zone'],
                'country_id'    => $order_info['payment_country'],
            );
            
            $data['payment_method'] = $order_info['payment_method'];
            
            $data['shipping_address'][] = array(
                'name'          => $order_info['shipping_firstname']." ".$order_info['shipping_lastname'],
                'company'       => $order_info['shipping_company'],
                'address_1'     => $order_info['shipping_address_1'],
                'address_2'     => $order_info['shipping_address_2'],
                'city'          => $order_info['shipping_city'],
                'postcode'      => $order_info['shipping_postcode'],
                'state_id'      => $order_info['shipping_zone'],
                'country_id'    => $order_info['shipping_country'],
            );
            
            $data['shipping_method'] = $order_info['shipping_method'];
            
            $this->load->model('catalog/product_model');
            //$this->load->model('tool/upload');
            
            //=== Order Cancel ===
            $data['order_cancel'] = site_url('account/order/cancel/'.$this->commons->encode($id));
            //=== Order Cancel ===
            
            //Products
            $data['product'] = array();
            
            $products = $this->order->getOrderProducts($id);
           
            foreach($products as $product) {
                $option_data = array();
                
                $options = $this->order->getOrderOptions($id,$product['order_product_id']);
                
                foreach($options as $option) {
                    /*if ($option['type'] != 'file') {
                        $value = $option['value'];
                    } else {
                        $upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

                        if ($upload_info) {
                            $value = $upload_info['name'];
                        } else {
                            $value = '';
                        }
                    }*/
                    
                    $option_data[] = array(
                        'name'  => $option['name'],
                        'value' => (strlen($option['value']) > 20 ? substr($option['value'], 0, 20) . '..' : $option['value'])
                    );
                }
                    
                $product_info = $this->product_model->getProduct($product['product_id']);
                
                /* =====REORDER====== */
                $orderID = $this->commons->encode($order_id);
                $orderProductID = $this->commons->encode($product['order_product_id']);
                $productID = $this->commons->encode($product['product_id']);
                if ($product_info) {
                    $reorder = site_url('account/order/reorder/'.$orderID.'/'.$orderProductID);
                } else {
                    $reorder = '';
                }
                
                /* =====REORDER====== */
                    
                $this->load->model('tool/image');
                if (is_file(DIR_IMAGE . $product_info['image'])) {                
                    $image = $this->image->resize($product_info['image'], 100, 100);
                } else {
                    $image = $this->image->resize('no_image.png', 100, 100);
                }
                    $data['products'][] = array (
                        'image'     => $image,
                        'name'      => $product['name'],
                        'model'     => $product['model'],
                        'option'    => $option_data,
                        'quantity'  => $product['quantity'],
                        'price'     => $this->currency->format($product['price'] + ($this->common->config('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']),
                        'total'     => $this->currency->format($product['total'] + ($this->common->config('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']),
                        'reorder'  => $reorder,
                        'return'   => site_url('account/return_order/add/'.$orderID.'/'.$productID), 
                    );
            }
                    
            //Voucher
            $data['vouchers'] = array();

            $vouchers = $this->order->getOrderVouchers($id);
                   
            foreach ($vouchers as $voucher) {
                $voucherImage = $this->order->getOrderVouchersTheme($voucher['voucher_theme_id']);
                if (is_file(DIR_IMAGE . $voucherImage['image'])) {                
                    $voucher_image = $this->image->resize($voucherImage['image'], 100, 100);
                } else {
                    $voucher_image = $this->image->resize('no_image.png', 100, 100);
                }
                $data['vouchers'][] = array(
                        'image'         => $voucher_image,
                        'description'   => $voucher['description'],
                        'amount'        => $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value'])
                );
            }
                    
            //Totals
            $data['totals'] = array();
                    
            $totals = $this->order->getOrderTotals($id);
                    
            foreach ($totals as $total) {
                $data['totals'][] = array(
                    'title' => $total['title'],
                    'text'  => $this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value']),
                );
            }
                    
            $data['comment'] = nl2br($order_info['comment']);
                    
            // History
            $data['histories'] = array();

            $results = $this->order->getOrderHistories($id);

            foreach ($results as $result) {
                $data['histories'][] = array(
                    'date_added' => date($this->common->config('config_date_format'), strtotime($result['date_added'])),
                    'status'     => $result['status'],
                    'comment'    => $result['notify'] ? nl2br($result['comment']) : ''
                );
            }
            
        
        $this->document->setTitle('title');
        $this->document->setDescription('description');
        $this->document->setKeywords('keyword');
        $data['header'] = $this->headers->getHeaders();
        
        $site_theme = $this->common->config('catalog_theme');
        $this->load->view("themes/".$site_theme."/account/order",$data);
        } else {
            //Breadcrumbs
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
                'text' => 'Order Information',  
                'href' => site_url('account/order/info/'.$this->commons->encode($order_info['order_id'])),
            );
            
            $data['text_error'] = $this->lang->line('text_error');
            $data['back'] = site_url('account/order');
            
            $this->document->setTitle('title');
            $this->document->setDescription('description');
            $this->document->setKeywords('keyword');
            $data['header'] = $this->headers->getHeaders();

            $site_theme = $this->common->config('catalog_theme');
            $this->load->view("themes/".$site_theme."/error/not_found",$data);
        }
    } 
    
    public function cancel() {
        $count = $this->uri->total_segments();
        $cancelOrderId = $this->commons->decode($this->uri->segment($count));
        
        $res = $this->order->cancelOrder((int)$cancelOrderId);
        if($res) {
            $this->session->set_flashdata('success','Success: Your order has been successfully canceled.');
        } else {
            $this->session->set_flashdata('warning','Warning: Problem into order cancelation.');
        }
        redirect('account/order');
    }
    
    public function reorder() {
        
        $order_id = $this->commons->decode($this->uri->segment(4));
        $order_product_id = $this->commons->decode($this->uri->segment(5));
        
        if ((int)$order_id) {
            $order_id = (int)$order_id;
        } else {
            $order_id = 0;
        }
        
        $order_info = $this->order->getOrder($order_id);
        
        if ($order_info) {
            if ((int)$order_product_id) {
                $order_product_id = (int)$order_product_id;
            } else {
                $order_product_id = 0;
            }
            
            $order_product_info = $this->order->getOrderProduct($order_id, $order_product_id);
            
            if ($order_product_info) {
                $this->load->model('catalog/product_model');
                
                $product_info = $this->product_model->getProduct($order_product_info['product_id']);
                
                if ($product_info) {
                    $option_data = array();
                    
                    $order_options = $this->order->getOrderOptions($order_product_info['order_id'], $order_product_id);
                    
                    foreach ($order_options as $order_option) {
                        if ($order_option['type'] == 'select' || $order_option['type'] == 'radio' || $order_option['type'] == 'image') {
                            $option_data[$order_option['product_option_id']] = $order_option['product_option_value_id'];
                        } elseif ($order_option['type'] == 'checkbox') {
                            $option_data[$order_option['product_option_id']][] = $order_option['product_option_value_id'];
                        } elseif ($order_option['type'] == 'text' || $order_option['type'] == 'textarea' || $order_option['type'] == 'date' || $order_option['type'] == 'datetime' || $order_option['type'] == 'time') {
                            $option_data[$order_option['product_option_id']] = $order_option['value'];
                        } elseif ($order_option['type'] == 'file') {
                            $option_data[$order_option['product_option_id']] =  $this->encryption->encrypt($order_option['value']);
                        }
                    }
                    
                    $this->mycart->add($order_product_info['product_id'], $order_product_info['quantity'], $option_data);
                   $format = $this->lang->line('text_success');
                   $this->session->set_userdata('success',sprintf($format, site_url('product/product/index/'.$this->commons->encode($product_info['product_id'])), $product_info['name'], site_url('checkout/cart'))); 
                   $this->session->unset_userdata('warning'); 
                } else {                    
                    $format = $this->lang->line('error_reorder');
                    $this->session->set_userdata('warning',sprintf($format, $order_product_info['name'])); 
                    $this->session->unset_userdata('success'); 
                }
            }
        }
        redirect('account/order/info/'.$this->commons->encode($order_id));    
    }
}
