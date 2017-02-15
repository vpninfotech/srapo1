<?php

if (!defined('BASEPATH'))exit('No direct script access allowed');

/**
 * 
 * @file name    : Product
 * @Auther       : Vinay
 * @Date         : 17-11-2016
 * @Description  : Admin Product Related Collection of functions
 *
 */
class Product extends CI_Controller {

    private $data=array();
    private $error = array();

    function __construct() {
        parent::__construct();

        $this->_init();

        $this->rbac->CheckAuthentication();

        $this->load->model('catalog/product_model', 'product');

        $this->lang->load('catalog/product_lang', 'english');

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
        $this->output->set_template('manufacturer_template');
        $admin_theme = $this->common->config('admin_theme');
        $this->output->set_common_meta('Products', 'sarpo', 'This is srapo Products page');
    }

    /**
     * 
     * @function name : index()
     * @description   : load Product view
     * @param            : void
     * @return        : void
     *
     */
    public function index($sort_by = 'product_name', $sort_order = 'ASC', $offset = 0) {
        //$this->data['add'] = base_url('catalog/product/add');
        if ($this->session->userdata('manufacturer_role_id') == 1) {
            $this->data['delete'] = base_url('catalog/product/delete');
        } else {
            $this->data['delete'] = base_url('catalog/product/softDelete');
        }
        $this->data['breadcrumbs'] = array();
        $this->data['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-dashboard"></i> Home',
            'href' => base_url('dashboard/dashboard'),
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Products',
            'href' => base_url('catalog/product'),
        );
        $filter_array             = $this->session->userdata('product_filter_array');
        $filter_name              = "";
        $filter_model             = "";
        $filter_price             = "";
        $filter_status            = "";
        $filter_quantity          = "";
       
        if(isset($filter_array['filter_name']))
        {
          $filter_name =   $filter_array['filter_name'];
        }
        if(isset($filter_array['filter_model']))
        {
          $filter_model =   $filter_array['filter_model'];
        }
        if(isset($filter_array['filter_price']))
        {
          $filter_price =   $filter_array['filter_price'];
        }
        if(isset($filter_array['filter_status']))
        {
          $filter_status =   $filter_array['filter_status'];
        }
        if(isset($filter_array['filter_quantity']))
        {
          $filter_quantity =   $filter_array['filter_quantity'];
        }
       

        $this->data['filter_name'] = $filter_name;
        $this->data['filter_model'] = $filter_model;
        $this->data['filter_price'] = $filter_price;
        $this->data['filter_quantity'] = $filter_quantity;
        $this->data['filter_status'] = $filter_status;
        $this->data['customer_group'] = array();
        // pagination
        $limit = $this->common->config('config_limit_admin');
        $data = array(
            'filter_name' => $filter_name,
            'filter_model' => $filter_model,
            'filter_price' => $filter_price,
            'filter_quantity' => $filter_quantity,
            'filter_status' => $filter_status,
            'sort' => $sort_by,
            'order' => $sort_order,
            'start' => $offset,
            'limit' => $limit
        );

        $url = base_url("catalog/product/index/$sort_by/$sort_order");
        $total_records = $this->product->getTotalProduct();
        $config = $this->commons->pagination($url, $total_records, $limit);
        $this->pagination->initialize($config);
        $config['uri_segment'] = 6;
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['sort_by'] = $sort_by;
        $this->data['sort_order'] = $sort_order;
        $results = $this->product->getProducts($data);

        $this->data['pages'] = ceil($total_records / $limit);
        $this->data['totals'] = ceil($total_records);
        $this->data['range'] = ceil($offset + 1);

        // URL creation
        $url = '';
        if ($this->uri->segment(4) !== NULL) {
            $url .= '/' . $this->uri->segment(4);
        } else {
            $url .= '/product_name';
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
        
        $this->load->model('tool/image');
        //print_r($results);
        foreach ($results as $result) {
            if (is_file(DIR_IMAGE . $result['image'])) {                
                $image = $this->image->resize($result['image'], 500, 500);
            } else {
                $image = $this->image->resize('no_image.png', 500, 500);
            }
            
            $special = false;
            
            $product_specials = $this->product->getProductSpecials($result['product_id']);
            
            foreach ($product_specials  as $product_special) {
                if (($product_special['date_start'] == '0000-00-00' || strtotime($product_special['date_start']) < time()) && ($product_special['date_end'] == '0000-00-00' || strtotime($product_special['date_end']) > time())) {
                    $special = $product_special['price'];

                    break;
                }
            }
            
            $this->data['records'][] = array(
                'product_id' => $result['product_id'],
                'image' => $image,
                'product_name' => $result['product_name'],
                'model' => $result['model'],
                'price' => $result['price'],
                'quantity' => $result['quantity'],
                'special'    => $special,
                'user_status' => ($result['status'] ? $this->lang->line('text_enabled') : $this->lang->line('text_disabled')),
                'date_added' => date($this->common->config('config_date_format'), strtotime($result['date_added'])),
                'edit' => base_url('catalog/product/edit' . $url . '/' . $this->commons->encode($result['product_id']))
            );
        }

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if ($this->session->userdata('success') !== NULL) {
            $this->data['success'] = $this->session->userdata('success');
            $this->session->set_userdata('success', '');
        } else {
            $this->data['success'] = '';
        }

        if ($this->input->post('selected') !== NULL) {
            $this->data['selected'] = (array) $this->input->post('selected');
        } else {
            $this->data['selected'] = array();
        }

        $admin_theme = $this->common->config('admin_theme');
        $content_page = "themes/" . $admin_theme . "/catalog/product_list";
        $this->load->view($content_page, $this->data);
    }
    /**
    * 
    * @function name : search()
    * @description   : set session data by filter paramater
    * @param         : void
    * @return        : void
    *
    */
    public function search()
    {
            if ($this->input->post('button_filter') !== NULL) 
            {
               if ($this->input->post('filter_name') !== NULL) {
                    $filter_name = $this->input->post('filter_name');
                } else {
                    $filter_name = '';
                }

                if ($this->input->post('filter_model') !== NULL) {
                    $filter_model = $this->input->post('filter_model');
                } else {
                    $filter_model = '';
                }

                if ($this->input->post('filter_price') !== NULL) {
                    $filter_price = $this->input->post('filter_price');
                } else {
                    $filter_price = '';
                }

                if ($this->input->post('filter_quantity') !== NULL) {
                    $filter_quantity = $this->input->post('filter_quantity');
                } else {
                    $filter_quantity = '';
                }

                if ($this->input->post('filter_status')!==NULL) 
                {
                    if ($this->input->post('filter_status')!= '*') 
                    {
                        $filter_status = $this->input->post('filter_status');
                    } 
                    else 
                    {
                        $filter_status = '*';
                    }
                }
                else
                {
                    $filter_status = '';
                }
                $filter['filter_name'] = $filter_name;
                $filter['filter_model'] = $filter_model;
                $filter['filter_price'] = $filter_price;
                $filter['filter_status'] = $filter_status;
                $filter['filter_quantity'] = $filter_quantity;
                $this->session->set_userdata('product_filter_array', $filter);
            }
            if ($this->input->post('button_all') !== NULL) 
            {
               $this->session->set_userdata('product_filter_array', array());
            }
            $this->index();
           
    }

    /**
     * 
     * @function name : edit()
     * @description   : edit product records
     * @param   		 : void
     * @return        : void
     *
     */
    public function edit($sort_by = 'product_name', $sort_order = 'ASC', $offset = 0) {
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {

            $this->product->editProduct();
            $this->session->set_userdata('success', $this->lang->line('text_success'));

            // Generate back url
            $url = '';

            if ($this->uri->segment(4) !== NULL) {
                $url .= '/' . $this->uri->segment(4);
            } else {
                $url .= '/product_name';
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

            redirect('catalog/product/index' . $url);
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
    public function getForm() {
        // Transaction Status
        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if ($this->session->userdata('success') !== NULL) {
            $this->data['success'] = $this->session->userdata('success');

            $this->session->set_userdata('success', '');
        } else {
            $this->data['success'] = '';
        }

        // Generate back url
        $url = '';

        if ($this->uri->segment(4) !== NULL) {
            $url .= '/' . $this->uri->segment(4);
        } else {
            $url .= '/product_name';
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

        // breadcrumbs
        $this->data['breadcrumbs'] = array();
        $this->data['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-dashboard"></i> Home',
            'href' => base_url('dashboard/dashboard'),
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Products',
            'href' => base_url('catalog/product'),
        );

        // Add or Edit Transaction
        $count = $this->uri->total_segments();
        $method = $this->uri->segment(3);
        if ($method == 'edit') {
            $this->data['form_action'] = base_url('catalog/product/edit' . $url . '/' . $this->uri->segment($count));
            $this->data['product_id'] = $this->commons->decode($this->uri->segment($count));
            $this->data['text_form'] = $this->lang->line('text_edit');
            //echo "1";
        } 
        //$this->data['refresh'] 		= base_url('customers/customer/refresh');
        $this->data['cancel'] = base_url('catalog/product/index'.$url);

        // Set Value Back
        if (1) {
            $product_info = $this->product->getProductById($this->commons->decode($this->uri->segment($count)));
        }

        //====== tab-general ======
        if ($this->input->post('product_name') !== NULL) {
            $this->data['product_name'] = $this->input->post('product_name');
        } elseif (!empty($product_info)) {
            $this->data['product_name'] = $product_info['product_name'];
        } else {
            $this->data['product_name'] = '';
        }

        if ($this->input->post('product_description') !== NULL) {
            $this->data['product_description'] = $this->input->post('product_description');
        } elseif (!empty($product_info)) {
            $this->data['product_description'] = $product_info['product_description'];
        } else {
            $this->data['product_description'] = '';
        }

        if ($this->input->post('metatag') !== NULL) {
            $this->data['metatag'] = $this->input->post('metatag');
        } elseif (!empty($product_info)) {
            $this->data['metatag'] = $product_info['meta_title'];
        } else {
            $this->data['metatag'] = '';
        }

        if ($this->input->post('metadesc') !== NULL) {
            $this->data['metadesc'] = $this->input->post('metadesc');
        } elseif (!empty($product_info)) {
            $this->data['metadesc'] = $product_info['meta_description'];
        } else {
            $this->data['metadesc'] = '';
        }

        if ($this->input->post('metakeyword') !== NULL) {
            $this->data['metakeyword'] = $this->input->post('metakeyword');
        } elseif (!empty($product_info)) {
            $this->data['metakeyword'] = $product_info['meta_keyword'];
        } else {
            $this->data['metakeyword'] = '';
        }

        if ($this->input->post('p_tag') !== NULL) {
            $this->data['p_tag'] = $this->input->post('p_tag');
        } elseif (!empty($product_info)) {
            $this->data['p_tag'] = $product_info['product_tag'];
        } else {
            $this->data['p_tag'] = '';
        }

        //====== tab-data ======
        //====Start Code: Call image model for resize the image
        $this->load->model('tool/image');
        if (($this->input->post('image')) !== NULL) {
            $this->data['config_image'] = $this->input->post('image');
            if (is_file(DIR_IMAGE . $this->input->post('image'))) {
                $this->data['thumb'] = $this->image->resize($this->input->post('image'), 100, 100);
            } else {
                $this->data['thumb'] = $this->image->resize('no_image-100x100.png', 100, 100);
            }
        } elseif (!empty($product_info)) {
            $this->data['config_image'] = $product_info['image'];
            if (is_file(DIR_IMAGE . $product_info['image'])) {
                $this->data['thumb'] = $this->image->resize($product_info['image'], 100, 100);
            } else {
                $this->data['thumb'] = $this->image->resize('no_image-100x100.png', 100, 100);
            }
        } else {
            $this->data['config_image'] = '';
            $this->data['thumb'] = $this->image->resize('no_image-100x100.png', 100, 100);
        }
        //====End Code: Call image model for resize the image
        $this->data['placeholder'] = $this->image->resize('no_image-100x100.png', 100, 100);

        if ($this->input->post('model') !== NULL) {
            $this->data['model'] = $this->input->post('model');
        } elseif (!empty($product_info)) {
            $this->data['model'] = $product_info['model'];
        } else {
            $this->data['model'] = '';
        }

         if ($this->input->post('catalog_no') !== NULL) {
            $this->data['catalog_no'] = $this->input->post('catalog_no');
        } elseif (!empty($product_info)) {
            $this->data['catalog_no'] = $product_info['catalog_no'];
        } else {
            $this->data['catalog_no'] = '';
        }

        if ($this->input->post('sku') !== NULL) {
            $this->data['sku'] = $this->input->post('sku');
        } elseif (!empty($product_info)) {
            $this->data['sku'] = $product_info['sku'];
        } else {
            $this->data['sku'] = '';
        }

        if ($this->input->post('upc') !== NULL) {
            $this->data['upc'] = $this->input->post('upc');
        } elseif (!empty($product_info)) {
            $this->data['upc'] = $product_info['upc'];
        } else {
            $this->data['upc'] = '';
        }

        if ($this->input->post('ean') !== NULL) {
            $this->data['ean'] = $this->input->post('ean');
        } elseif (!empty($product_info)) {
            $this->data['ean'] = $product_info['ean'];
        } else {
            $this->data['ean'] = '';
        }

        if ($this->input->post('jan') !== NULL) {
            $this->data['jan'] = $this->input->post('jan');
        } elseif (!empty($product_info)) {
            $this->data['jan'] = $product_info['jan'];
        } else {
            $this->data['jan'] = '';
        }

        if ($this->input->post('isbn') !== NULL) {
            $this->data['isbn'] = $this->input->post('isbn');
        } elseif (!empty($product_info)) {
            $this->data['isbn'] = $product_info['isbn'];
        } else {
            $this->data['isbn'] = '';
        }

        if ($this->input->post('mpn') !== NULL) {
            $this->data['mpn'] = $this->input->post('mpn');
        } elseif (!empty($product_info)) {
            $this->data['mpn'] = $product_info['mpn'];
        } else {
            $this->data['mpn'] = '';
        }

        if ($this->input->post('location') !== NULL) {
            $this->data['location'] = $this->input->post('location');
        } elseif (!empty($product_info)) {
            $this->data['location'] = $product_info['location'];
        } else {
            $this->data['location'] = '';
        }

          if ($this->input->post('manufacturer_price') !== NULL) {
            $this->data['manufacturer_price'] = $this->input->post('manufacturer_price');
        } elseif (!empty($product_info)) {
            $this->data['manufacturer_price'] = $product_info['manufacturer_price'];
        } else {
            $this->data['manufacturer_price'] = '';
        }
        
        if ($this->input->post('price') !== NULL) {
            $this->data['price'] = $this->input->post('price');
        } elseif (!empty($product_info)) {
            $this->data['price'] = $product_info['price'];
        } else {
            $this->data['price'] = '';
        }

        if ($this->input->post('tax_class') !== NULL) {          
            $this->data['tax_class'] = $this->input->post('tax_class');
        } elseif (!empty($product_info)) {          
            $this->data['tax_class'] = $product_info['tax_class_id'];
        } else {  
            $this->data['tax_class'] = 0;
        }

        if ($this->input->post('qty') !== NULL) {
            $this->data['qty'] = $this->input->post('qty');
        } elseif (!empty($product_info)) {
            $this->data['qty'] = $product_info['quantity'];
        } else {
            $this->data['qty'] = 1;
        }

        if ($this->input->post('m_qty') !== NULL) {
            $this->data['m_qty'] = $this->input->post('m_qty');
        } elseif (!empty($product_info)) {
            $this->data['m_qty'] = $product_info['min_quantity'];
        } else {
            $this->data['m_qty'] = 1;
        }

        if ($this->input->post('subtract') !== NULL) {
            $this->data['subtract'] = $this->input->post('subtract');
        } elseif (!empty($product_info)) {
            $this->data['subtract'] = $product_info['subtract_stock'];
        } else {
            $this->data['subtract'] = 1;
        }

        $this->load->model('system/stock_status_model');

        $this->data['stock_statuses'] = $this->stock_status_model->getStockStatuses();

        if ($this->input->post('stock_status_id') !== NULL) {
            $this->data['stock_status_id'] = $this->input->post('stock_status_id');
        } elseif (!empty($product_info)) {
            $this->data['stock_status_id'] = $product_info['stock_status_id'];
        } else {
            $this->data['stock_status_id'] = 0;
        }

        if ($this->input->post('shipping') !== NULL) {
            $this->data['shipping'] = $this->input->post('shipping');
        } elseif (!empty($product_info)) {
            $this->data['shipping'] = $product_info['shipping'];
        } else {
            $this->data['shipping'] = 1;
        }

        if ($this->input->post('seo_url') !== NULL) {
            $this->data['seo_url'] = $this->input->post('seo_url');
        } elseif (!empty($product_info)) {
            $this->data['seo_url'] = $product_info['seo_url'];
        } else {
            $this->data['seo_url'] = "";
        }

        if ($this->input->post('date_available') !== NULL) {
            $this->data['date_available'] = $this->input->post('date_available');
        } elseif (!empty($product_info)) {
            $this->data['date_available'] = ($product_info['date_available'] != '0000-00-00') ? $product_info['date_available'] : '';
        } else {
            $this->data['date_available'] = date('Y-m-d');
        }

        if ($this->input->post('length') !== NULL) {
            $this->data['length'] = $this->input->post('length');
        } elseif (!empty($product_info)) {
            $this->data['length'] = $product_info['length'];
        } else {
            $this->data['length'] = "";
        }

        if ($this->input->post('width') !== NULL) {
            $this->data['width'] = $this->input->post('width');
        } elseif (!empty($product_info)) {
            $this->data['width'] = $product_info['width'];
        } else {
            $this->data['width'] = "";
        }

        if ($this->input->post('height') !== NULL) {
            $this->data['height'] = $this->input->post('height');
        } elseif (!empty($product_info)) {
            $this->data['height'] = $product_info['height'];
        } else {
            $this->data['height'] = "";
        }

        if ($this->input->post('length_class') !== NULL) {
            $this->data['length_class'] = $this->input->post('length_class');
        } elseif (!empty($product_info)) {
            $this->data['length_class'] = $product_info['length_class'];
        } else {
            $this->data['length_class'] = $this->common->config('config_length_class_id');
        }
        
        if ($this->input->post('weight') !== NULL) {
            $this->data['weight'] = $this->input->post('weight');
        } elseif (!empty($product_info)) {
            $this->data['weight'] = $product_info['weight'];
        } else {
            $this->data['weight'] = "";
        }

        if ($this->input->post('weight_class') !== NULL) {
            $this->data['weight_class'] = $this->input->post('weight_class');
        } elseif (!empty($product_info)) {
            $this->data['weight_class'] = $product_info['weight_class'];
        } else {
            $this->data['weight_class'] = $this->common->config('config_weight_class_id');
        }

        if ($this->input->post('status') !== NULL) {
            $this->data['status'] = $this->input->post('status');
        } elseif (!empty($product_info)) {
            $this->data['status'] = $product_info['status'];
        } else {
            $this->data['status'] = 1;
        }

         if ($this->input->post('is_front') !== NULL) {
            $this->data['is_front'] = $this->input->post('is_front');
        } elseif (!empty($product_info)) {
            $this->data['is_front'] = $product_info['is_front'];
        } else {
            $this->data['is_front'] = 0;
        }

        if ($this->input->post('sort_order') !== NULL) {
            $this->data['sort_order'] = $this->input->post('sort_order');
        } elseif (!empty($product_info)) {
            $this->data['sort_order'] = $product_info['sort_order'];
        } else {
            $this->data['sort_order'] = 1;
        }
        
        if ($this->input->server('REQUEST_METHOD') == 'POST')
        {
            if($this->input->post('is_deleted')==1)
            {
               $this->data['is_deleted'] = $this->input->post('is_deleted'); 
            }else {
                 $this->data['is_deleted'] = 0;
            }
        } elseif (!empty($product_info)) {
                $this->data['is_deleted'] = $product_info['is_deleted'];
        } else {
                $this->data['is_deleted'] = 0;
        }

        //====== tab-link ======        
        //====== Manufacturer ======
        $this->load->model('catalog/manufacturer_model');

        if ($this->input->post('manufacturer_id') !== NULL) {
            $this->data['manufacturer_id'] = $this->input->post('manufacturer_id');
        } elseif (!empty($product_info)) {
            $this->data['manufacturer_id'] = $product_info['manufacturer_id'];
        } else {
            $this->data['manufacturer_id'] = "";
        }

        if ($this->input->post('manufacturer') !== NULL) {
            $this->data['manufacturer'] = $this->input->post('manufacturer');
        } elseif (!empty($product_info)) {
            $manufacturer_info = $this->manufacturer_model->getManufacturerById($product_info['manufacturer_id']);
            if ($manufacturer_info) {
                $this->data['manufacturer'] = $manufacturer_info['firstname']." ".$manufacturer_info['lastname'];
            } else {
                $this->data['manufacturer'] = "";
            }
        } else {
            $this->data['manufacturer'] = "";
        }
       
        //====== Categories ======
        if (($this->input->post('product_category') !== NULL)) {
            $categories = $this->input->post('product_category');
        } elseif (($this->commons->decode($this->uri->segment(7)))) {
            $categories = $this->product->getProductCategories($this->commons->decode($this->uri->segment(7)));
        } else {
            $categories = array();
        }

        $this->load->model('catalog/category_model');

        $this->data['product_category'] = array();
        foreach ($categories as $category_id) {
            $category_info = $this->category_model->getPath($category_id);
            if ($category_info) {
                $this->data['product_category'][] = array(
                    'category_id' => $category_info[0]['category_id'],
                    'category_name' => ($category_info[0]['category_name'])
                );
            }
        }

        //====== Filter ======            
        if (($this->input->post('product_filter') !== NULL)) {
            $filters = $this->input->post('product_filter');
        } elseif (($this->commons->decode($this->uri->segment(7)))) {
            $filters = $this->product->getProductFilters($this->commons->decode($this->uri->segment(7)));
        } else {
            $filters = array();
        }

        $this->load->model('catalog/filter_model');

        $this->data['product_filters'] = array();
        foreach ($filters as $filter_id) {
            $filter_info = $this->filter_model->getFilterNameById($filter_id);

            if ($filter_info) {
                $this->data['product_filters'][] = array(
                    'filter_id' => $filter_info[0]['filter_id'],
                    'filter_name' => $filter_info[0]['group'] . ' &gt; ' . $filter_info[0]['filter_name']
                );
            }
        }
        
        //====== Downloads ======            
        if (($this->input->post('product_download') !== NULL)) {
            $product_downloads = $this->input->post('product_download');
        } elseif (($this->commons->decode($this->uri->segment(7)))) {
            $product_downloads = $this->product->getProductDownload($this->commons->decode($this->uri->segment(7)));
        } else {
            $product_downloads = array();
        }
       
        $this->load->model('catalog/downloads_model');

        $this->data['product_downloads'] = array();
        foreach ($product_downloads as $download_id) {
            $download_info = $this->downloads_model->getProductDownload($download_id);
            
            if ($download_info) {
                $this->data['product_downloads'][] = array(
                    'download_id' => $download_info[0]['download_id'],
                    'name' => $download_info[0]['name']
                );
            }
        }

        //====== Related Product ======            
        if (($this->input->post('product_related') !== NULL)) {
            $products = $this->input->post('product_related');
        } elseif (($this->commons->decode($this->uri->segment(7)))) {
            $products = $this->product->getProductRelated($this->commons->decode($this->uri->segment(7)));
        } else {
            $products = array();
        }

        $this->data['product_relateds'] = array();

        foreach ($products as $product) {
            $product_info = $this->product->getProduct($product);
            if ($product_info) {
                $this->data['product_relateds'][] = array(
                    'product_id' => $product_info[0]['product_id'],
                    'product_name' => ($product_info[0]['product_name'])
                );
            }
        }

        //====== tab-attribute[Remaining] ======
        $this->load->model('catalog/attributes_model');
        
        if(($this->input->post('product_attribute') !== NULL)) {
            $product_attributes = $this->input->post('product_attribute');
        } elseif(($this->commons->decode($this->uri->segment(7)))) {
            $product_attributes = $this->product->getProductAttributes($this->commons->decode($this->uri->segment(7)));
        } else {
            $product_attributes = array();
        }
        $this->data['product_attributes'] = array();

        foreach($product_attributes as $key=>$product_attribute) {
            
            $attribute_info = $this->attributes_model->getAttribute($product_attribute['attribute_id']);
       
            if($attribute_info) {
                $this->data['product_attributes'][] = array (
                    'attribute_id'      => $product_attribute['attribute_id'],
                    'attribute_name'    => $attribute_info['attribute_name'],
                    'text'              => $product_attribute['text']
                );
            }
        }
        
        //====== tab-option ======
        $this->load->model('catalog/option_model');
        
        if(($this->input->post('product_option') !== NULL)) {
            $product_options = $this->input->post('product_option');
        } elseif(($this->commons->decode($this->uri->segment(7)))) {
            $product_options = $this->product->getProductOptions($this->commons->decode($this->uri->segment(7)));
        } else {
            $product_options = array();
        }
        
        $this->data['product_options'] = array();
        
        foreach($product_options as $product_option) {
            $product_option_value_data = array();
            
            if(isset($product_option['product_option_value'])) {
                foreach($product_option['product_option_value'] as $product_option_value) {
                    $product_option_value_data[] = array(
                        'product_option_value_id' => $product_option_value['product_option_value_id'],
                        'option_value_id'         => $product_option_value['option_value_id'],
                        'quantity'                => $product_option_value['quantity'],
                        'subtract'                => $product_option_value['subtract'],
                        'price'                   => $product_option_value['price'],
                        'price_prefix'            => $product_option_value['price_prefix'],
                        'points'                  => $product_option_value['points'],
                        'points_prefix'           => $product_option_value['points_prefix'],
                        'weight'                  => $product_option_value['weight'],
                        'weight_prefix'           => $product_option_value['weight_prefix']
                    );
                }
            }
            $this->data['product_options'][] = array(
                'product_option_id'    => $product_option['product_option_id'],
                'product_option_value' => $product_option_value_data,
                'option_id'            => $product_option['option_id'],
                'name'                 => $product_option['name'],
                'type'                 => $product_option['type'],
                'value'                => isset($product_option['value']) ? $product_option['value'] : '',
                'required'             => $product_option['required'] 
            );
        }
            
        $this->data['option_values'] = array();
            
        foreach($this->data['product_options'] as $product_option) {
            if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
                if (!isset($this->data['option_values'][$product_option['option_id']])) {
                        $this->data['option_values'][$product_option['option_id']] = $this->option_model->getOptionValues($product_option['option_id']);
                }
            }
        }
    
        //====== tab-discount ======
        $this->load->model('customers/customer_groups_model');

        $this->data['customer_groups'] = $this->customer_groups_model->getCustomerGroups();
        
        if (($this->input->post('product_discount') !== NULL)) {
            $product_discounts = $this->input->post('product_discount');
        } elseif (($this->commons->decode($this->uri->segment(7)))) {
            $product_discounts = $this->product->getProductDiscounts($this->commons->decode($this->uri->segment($count)));
        } else {
            $product_discounts = array();
        }

        $this->data['product_discounts'] = array();

        foreach ($product_discounts as $key=>$product_discount) {
            //echo "<pre>"; print_r( $product_discount );
            $this->data['product_discounts'][] = array(
                'customer_group_id' => $product_discount['customer_group_id'],
                'quantity' => $product_discount['quantity'],
                'priority' => $product_discount['priority'],
                'price' => $product_discount['price'],
                'date_start' => ($product_discount['date_start'] != '0000-00-00') ? $product_discount['date_start'] : '',
                'date_end' => ($product_discount['date_end'] != '0000-00-00') ? $product_discount['date_end'] : ''
            );
        }

        //====== tab-special ======
        if (($this->input->post('product_special') !== NULL)) {
            $product_specials = $this->input->post('product_special');
        } elseif (($this->commons->decode($this->uri->segment(7)))) {
            $product_specials = $this->product->getProductSpecials($this->commons->decode($this->uri->segment($count)));
        } else {
            $product_specials = array();
        }

        $this->data['product_specials'] = array();
       
        foreach ($product_specials as $key=>$product_special) {
            //echo "<pre>"; print_r( $product_special );
            $this->data['product_specials'][] = array(
                'customer_group_id' => $product_special['customer_group_id'],
                'priority' => $product_special['priority'],
                'price' => $product_special['price'],
                'date_start' => ($product_special['date_start'] != '0000-00-00') ? $product_special['date_start'] : '',
                'date_end' => ($product_special['date_end'] != '0000-00-00') ? $product_special['date_end'] : ''
            );
        }
        
        //====== tab-image ======
        if(($this->input->post('product_image')!==NULL)) {
            $product_images = $this->input->post('product_image');
            
        } elseif(($this->commons->decode($this->uri->segment(7)))) {
            $product_images = $this->product->getProductImages($this->commons->decode($this->uri->segment($count)));
        } else {
            $product_images = array();
             
        }
       
       
        $this->data['product_images'] = array();
        foreach($product_images as $key=>$product_image) {

            if(is_file(DIR_IMAGE . $product_image['image'])) {
                $image = $product_image['image'];
                $thumb = $product_image['image'];
            } else {
                $image = '';
                $thumb = 'no_image.png';
                $this->data['placeholder'] = $this->image->resize('no_image-100x100.png', 100, 100);
            }
            
            $this->data['product_images'][] = array (                
                'image' => $image,
                'thumb' => $this->image->resize($thumb, 100, 100),
                'sort_order' => $product_image['sort_order']
            );
        }

        $admin_theme = $this->common->config('admin_theme');
        $content_page = "themes/" . $admin_theme . "/catalog/product";
        $this->load->view($content_page, $this->data);
    }

    /**
     * 
     * @function name : validateForm()
     * @description   : Validate Entered Form data
     * @param         : void
     * @return        : void
     *
     */
    public function validateForm() {
        $validation = array(
            
            array(
                'field' => 'qty',
                'label' => 'Quantity',
                'rules' => 'trim|numeric|xss_clean',
                'errors' => array('decimal' => 'Only numeric/decimal numbers are allowed!')
            ),
            
        );

        $this->form_validation->set_rules($validation);
        if ($this->form_validation->run() == FALSE) {
            $this->error['error'] = $this->session->set_userdata('warning', $this->lang->line('error_warning'));
            $this->data['error'] = $this->session->userdata('warning', $this->lang->line('error_warning'));
            return FALSE;
        } else {

            return TRUE;
        }
    } 

    /**
     * 
     * @function name : autocomplete()
     * @description   : Check product relation for delete
     * @param   		 : void
     * @return        : void
     *
     */
    public function autocomplete() {
        $this->output->unset_template();
        $json = array();

        if ($this->input->post('product_name') !== NULL) {
            $filter_name = $this->input->post('product_name');
        } else {
            $filter_name = '';
        }

        if ($this->input->post('product_model') !== NULL) {
            $filter_model = $this->input->post('product_model');
        } else {
            $filter_model = '';
        }

        $filter_data = array(
            'filter_name' => $filter_name,
            'filter_model' => $filter_model,
            'start' => 0,
            'limit' => 5
        );

        $results = $this->product->getProducts($filter_data);
        foreach ($results as $result) {
            $json[] = array(
                'product_id' => $result['product_id'],
                'product_name' => $result['product_name'],
                'product_model' => $result['model']
            );
        }


        $sort_order = array();

        foreach ($json as $key => $value) {
            $sort_order[$key] = $value['product_name'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

        echo json_encode($json);
    }

}
