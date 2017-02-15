<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compare extends CI_Controller {
    function __construct()
    {
        parent::__construct();

        $this->_init();

        $this->lang->load('product/compare_lang','english');

        $this->load->model('catalog/product_model','product');
        
        $this->load->model('common');

        $this->load->library('commons');

        $this->load->library('customer');
        
        $this->load->library('tax');
        
        $this->load->library('length');
        
        $this->load->library('weight');
    }
	
    private function _init() {
        //--Set Template
        $this->output->set_template('site_template');
        $site_theme = $this->common->config('catalog_theme');
        $this->output->set_common_meta('Product','sarpo','Home Page');
    }
    
    public function index()
    {
        $this->load->model('tool/image');
       
        $compare = $this->session->userdata('compare');
        if (!$compare) {
            $this->session->set_userdata('compare',array());
        }
        
        $count = $this->uri->total_segments();        
        $remove = $this->commons->decode($this->uri->segment($count));
        
        if ((int)$remove) {
            $sessionData  = $this->session->userdata('compare');
            $key = array_search((int)$remove,$this->session->userdata('compare'));
            if ($key !== false) {
                //print_r($sessionData[$key]);exit;
                unset($sessionData[$key]);
                $this->session->set_userdata('compare', $sessionData);
                $this->session->set_userdata('success',$this->lang->line('text_remove'));
            }
            
            redirect('product/compare');
        }
        
        $data['heading_title'] = $this->lang->line('heading_title');
        $data['text_product'] = $this->lang->line('text_product');
        
        // breadcrumbs
        $data['breadcrumbs']   = array();
        $data['breadcrumbs'][] = array(
           'text' => '<i class="glyphicon glyphicon-home"></i> Home',
           'href' => site_url('common/home'),
        );        
        $data['breadcrumbs'][] = array(
           'text' => 'Product Comparison',  
           'href' => site_url('product/compare'),
        );
        // Transaction Status
        if (isset($this->error['warning'])) 
        {
            $data['error_warning'] = $this->error['warning'];
        } 
        else 
        {
            $data['error_warning'] = '';
        }

        if ($this->session->userdata('success')!==NULL) 
        {
            $data['success'] = $this->session->userdata('success');

            $this->session->unset_userdata('success');
        } 
        else 
        {
            $data['success'] = '';
        }
        
        $data['text_empty'] = $this->lang->line('text_empty');
        
        $data['review_status'] = $this->common->config('config_review_status');
        
        $data['products'] = array();
        
        $data['attribute_groups'] = array();
        
        foreach ($this->session->userdata('compare') as $key => $product_id) {
            
            $product_info = $this->product->getProduct($product_id);
            
            if ($product_info) {
                if ($product_info['image']) {
                    $image = $this->image->resize( $product_info['image'], $this->common->config('config_image_compare_width'), $this->common->config('config_image_compare_height') );
                } else {
                   $image = $this->image->resize('no_image.png', $this->common->config('config_image_compare_width'), $this->common->config('config_image_compare_height') );
                }
                
                if ($this->customer->isLogged() || !$this->common->config('config_customer_price')) {
                    $price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->common->config('config_tax'), $this->session->userdata('currency')));                    
                } else {
                    $price = false;
                }
                
                if ((float)$product_info['special']) {
                    $special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->common->config('config_tax'), $this->session->userdata('currency')));
                } else {
                    $special = false;
                }
                
                if ($product_info['quantity'] <= 0) {
                    $availability = $product_info['stock_status'];
                } elseif ($this->common->config('config_stock_display')) {
                    $availability = $product_info['quantity'];
                } else {
                    $availability = $this->lang->line('text_instock');
                }
                
                $attribute_data = array();
                
                $attribute_groups = $this->product->getProductAttributes($product_id);
                
                foreach ($attribute_groups as $attribute_group) {
                    foreach ($attribute_group['attribute'] as $attribute) {
                        $attribute_data[$attribute['attribute_id']] = $attribute['text'];
                    }
                }
                
                $review_format = $this->lang->line('text_reviews');
                $data['products'][$product_id] = array(
                    'product_id'   => $product_info['product_id'],
                    'name'         => $product_info['name'],
                    'thumb'        => $image,
                    'price'        => $price,
                    'special'      => $special,
                    'description'  => $this->commons->neat_trim($product_info['description'], 200, '...'),
                    'model'        => $product_info['model'],
                    'manufacturer' => $product_info['manufacturer'],
                    'availability' => $availability,
                    'minimum'      => $product_info['min_quantity'] > 0 ? $product_info['min_quantity'] : 1,
                    'rating'       => (int)$product_info['rating'],
                    'reviews'      => sprintf($review_format, (int)$product_info['reviews']),
                    'weight'       => $this->weight->format($product_info['weight'], $product_info['weight_class']),
                    'length'       => $this->length->format($product_info['length'], $product_info['length_class']),
                    'width'        => $this->length->format($product_info['width'], $product_info['length_class']),
                    'height'       => $this->length->format($product_info['height'], $product_info['length_class']),
                    'attribute'    => $attribute_data,                    
                    'href'         => site_url($product_info['seo_keywords']),
                    'remove'       => site_url('product/compare/index/remove/' . $this->commons->encode($product_id))
                );
                
                foreach ($attribute_groups as $attribute_group) {
                    $data['attribute_groups'][$attribute_group['attribute_group_id']]['name'] = $attribute_group['name'];

                    foreach ($attribute_group['attribute'] as $attribute) {
                        $data['attribute_groups'][$attribute_group['attribute_group_id']]['attribute'][$attribute['attribute_id']]['name'] = $attribute['name'];
                    }
                }
            } else {
                $sessionData  = $this->session->userdata('compare');
                $key = array_search((int)$remove,$this->session->userdata('compare'));
                unset($sessionData[$key]);
                $this->session->set_userdata('compare', $sessionData);
                //$this->session->unset_userdata('compare')[$key];
            }
        } 
        
        $this->document->setTitle('title');
        $this->document->setDescription('description');
        $this->document->setKeywords('keyword');
        $data['header'] = $this->headers->getHeaders();
        $site_theme = $this->common->config('catalog_theme');
        $this->load->view("themes/".$site_theme."/product/compare",$data);
        //$this->load->section('content', "themes/".$site_theme."/account/address_list",$data);
        //$this->load->view("themes/".$site_theme."/account/account",$data);
    }
        
    public function add() {
        $this->output->unset_template();
        $json = array();
     	$compare=array();
     	if($this->session->userdata('compare')!==NULL)
     	{
     	   $compare = $this->session->userdata('compare');
     	}
        
        if (!$compare) {
          
            $this->session->set_userdata('compare',array());
        }
        
        if ($this->input->post('product_id')!==NULL) {
            $product_id = $this->input->post('product_id');
        } else {
            $product_id = 0;
        }
        
        $product_info = $this->product->getProduct($product_id);
        
        if ($product_info) {
            if (!in_array($this->input->post('product_id'),$compare)) {
               
                if (count($compare) >= 4) {
                   
                    array_shift($compare);
                } 
               // print_r($product_info);
                array_push($compare,$this->input->post('product_id'));
               // $compare[] = $this->input->post('product_id');
                $this->session->set_userdata('compare',$compare);
            }  
            $success_format = $this->lang->line('text_success');
            
            $json['product_title'] = $product_info['name'];
            $this->load->model('tool/image');
            if ($product_info['image']) {
                $image = $this->image->resize( $product_info['image'], 42, 56  );
            } else {
                $image = $this->image->resize( 'no_image.png', 42, 56 );
            }

            $json['product_image'] = "<a href = ".site_url($product_info['seo_keywords'])."><img src =".$image."></img></a>";

            $json['success'] = sprintf($success_format, site_url($product_info['seo_keywords']), $product_info['name'], site_url('product/compare'));
            
            $total_format = $this->lang->line('text_compare');
            
            $json['total'] = sprintf($total_format, (($this->session->userdata('compare')!==NULL) ? count($this->session->userdata('compare')) : 0 ));
             
             echo json_encode($json);
        }
    }
}
