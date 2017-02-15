<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		
		$this->_init();
		
		$this->lang->load('product/product_lang','english');
		$this->load->library('tax');
		$this->load->model('modules/latestProduct','latestproduct');
		 $this->load->model('design/banner_model','banner');
	}
	
	private function _init() {
		
		//--Set Template
		$this->output->set_template('site_template');
		$site_theme = $this->common->config('catalog_theme');
		

	}
	public function index($pathp='',$product_idp='')
	{
		$path = $pathp;
		$product_id = $product_idp;
		if($product_idp=='')
		{
			$product_id = $this->common->getSeoUrlId($pathp);
			$path='';
			$product_keyword_id = $product_id;
		}
		$product_keyword_id = $product_id;
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] 	= array(
		   'text' =>'<i class="glyphicon glyphicon-home"></i> Home',
		   'href' =>site_url('common/home'),
		 
		  );
		
		$this->load->model('catalog/category_model','category');
		
		if (isset($path) && $path!='')
		{
			$paths = '';
			
			$category_path = explode('_', $path);
			$product_keyword_id = $product_id;
			$product_id = $this->common->getSeoUrlId($product_id);
			
			$category_id = $this->common->getSeoUrlId(array_pop($category_path));
			//print_r($parts);
			foreach ($category_path as $path_keyword) {
				if (!$paths) {
					$paths = $path_keyword;
					$paths_id = (int)$this->common->getSeoUrlId($path_keyword);
				} else { 
					$paths .= '_' . $path_keyword;
					$paths_id = (int)$this->common->getSeoUrlId($path_keyword);
				}
				
				$category_info = $this->category->getCategory($paths_id);
				$category_info = $category_info[0];
				
				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['category_name'],
						'href' => site_url($paths)
					);
				}
			}
			
			// Set the last category breadcrumb
			$category_info = $this->category->getCategory($category_id);
			if(isset($category_info) && count($category_info)>0){
				$category_info = $category_info[0];
			}
			if($category_info)
			{
				$url = '';
	
				if ($this->input->post('sort')!==NULL) {
					$url .= '&sort=' . $this->input->post('sort');
				}
	
				if ($this->input->post('order')!==NULL) {
					$url .= '&order=' . $this->input->post('order');
				}
				
				if ($this->input->post('page')!==NULL) {
					$url .= '&page=' . $this->input->post('page');
				}
				
				if ($this->input->post('limit')!==NULL) {
					$url .= '&limit=' . $this->input->post('limit');
				}
				
				$data['breadcrumbs'][] = array(
		   			'text' => $category_info['category_name'],
		   			'href' => site_url($category_path),
		 
		  		);
			}
		}
		
		if (isset($product_id)) {
			$product_id = (int)$product_id;
		} else {
			$product_id = 0;
		}

		$this->load->model('catalog/product_model','product');

		$product_info = $this->product->getProduct($product_id);
			
		if ($product_info) {
			$url = '';
			if ($this->input->post('path')!==NULL) {
				$url .= '&path=' . $this->input->post('path');
			}

			if ($this->input->post('filter')!==NULL) {
				$url .= '&filter=' . $this->input->post('filter');
			}

			if ($this->input->post('manufacturer_id')!==NULL) {
				$url .= '&manufacturer_id=' . $this->input->post('manufacturer_id');
			}

			if ($this->input->post('search')!==NULL) {
				$url .= '&search=' . $this->input->post('search');
			}

			if ($this->input->post('tag')!==NULL) {
				$url .= '&tag=' . $this->input->post('tag');
			}

			if ($this->input->post('description')!==NULL) {
				$url .= '&description=' . $this->input->post('description');
			}

			if ($this->input->post('category_id')!==NULL) {
				$url .= '&category_id=' . $this->input->post('category_id');
			}

			if ($this->input->post('sub_category')!==NULL) {
				$url .= '&sub_category=' . $this->input->post('sub_category');
			}

			if ($this->input->post('sort')!==NULL) {
				$url .= '&sort=' . $this->input->post('sort');
			}

			if ($this->input->post('order')!==NULL) {
				$url .= '&order=' . $this->input->post('order');
			}

			if ($this->input->post('page')!==NULL) {
				$url .= '&page=' . $this->input->post('page');
			}

			if ($this->input->post('limit')!==NULL) {
				$url .= '&limit=' . $this->input->post('limit');
			}
			
			$data['breadcrumbs'][] = array(
				'text' => $product_info['name'],
				'href' => site_url($path.'/'.$product_keyword_id)
			);
			
			$this->document->setTitle($product_info['meta_title']);
			$this->document->setDescription($product_info['meta_description']);
			$this->document->setKeywords($product_info['meta_keyword']);
			$data['header'] = $this->headers->getHeaders();
			$data['heading_title'] = $product_info['name'];

			$data['text_select'] = $this->lang->line('text_select');
			$data['text_manufacturer'] = $this->lang->line('text_manufacturer');
			$data['text_model'] = $this->lang->line('text_model');
			$data['text_reward'] = $this->lang->line('text_reward');
			$data['text_points'] = $this->lang->line('text_points');
			$data['text_stock'] = $this->lang->line('text_stock');
			$data['text_discount'] = $this->lang->line('text_discount');
			$data['text_tax'] = $this->lang->line('text_tax');
			$data['text_option'] = $this->lang->line('text_option');
			$data['text_minimum'] = sprintf($this->lang->line('text_minimum'), $product_info['min_quantity']);
			$data['text_write'] = $this->lang->line('text_write');
			$data['text_login'] = sprintf($this->lang->line('text_login'), site_url('account/login'), site_url('account/register'));
			$data['text_note'] = $this->lang->line('text_note');
			$data['text_tags'] = $this->lang->line('text_tags');
			$data['text_related'] = $this->lang->line('text_related');
			$data['text_payment_recurring'] = $this->lang->line('text_payment_recurring');
			$data['text_loading'] = $this->lang->line('text_loading');

			$data['entry_qty'] = $this->lang->line('entry_qty');
			$data['entry_name'] = $this->lang->line('entry_name');
			$data['entry_review'] = $this->lang->line('entry_review');
			$data['entry_rating'] = $this->lang->line('entry_rating');
			$data['entry_good'] = $this->lang->line('entry_good');
			$data['entry_bad'] = $this->lang->line('entry_bad');

			$data['button_cart'] = $this->lang->line('button_cart');
			$data['button_wishlist'] = $this->lang->line('button_wishlist');
			$data['button_compare'] = $this->lang->line('button_compare');
			$data['button_upload'] = $this->lang->line('button_upload');
			$data['button_continue'] = $this->lang->line('button_continue');
			
			$this->load->model('catalog/review_model','review');
			
			$data['tab_description'] = $this->lang->line('tab_description');
			$data['tab_attribute'] = $this->lang->line('tab_attribute');
			$data['tab_review'] = sprintf($this->lang->line('tab_review'), $product_info['reviews']);

			$data['product_id'] = (int)$product_id;
			$data['manufacturer'] = $product_info['manufacturer'];
			$data['model'] = $product_info['model'];
			$data['description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');
			
			if ($product_info['quantity'] <= 0) {
				$data['stock'] = $product_info['stock_status'];
			} elseif ($this->common->config('config_stock_display')) {
				$data['stock'] = $product_info['quantity'];
			} else {
				$data['stock'] = $this->lang->line('text_instock');
			}
			
			$this->load->model('tool/image','image');
			
			if ($product_info['image']) {
				$data['popup'] = $this->image->resize($product_info['image'], $this->common->config('config_image_popup_width'), $this->common->config('config_image_popup_height'));
			} else {
				$data['popup'] = $this->image->resize('no_image.png', $this->common->config('config_image_popup_width'), $this->common->config('config_image_popup_height'));;
			}
			
			if ($product_info['image']) {
				$data['thumb'] = $this->image->resize($product_info['image'], $this->common->config('config_image_thumb_width'), $this->common->config('config_image_thumb_height'));
			} else {
				$data['thumb'] = $this->image->resize('no_image.png', $this->common->config('config_image_thumb_width'), $this->common->config('config_image_thumb_height'));
			}
			
			$data['images'] = array();

			$results = $this->product->getProductImages($product_id);
			
			foreach ($results as $result) {
				$data['images'][] = array(
					'popup' => $this->image->resize($result['image'], $this->common->config('config_image_popup_width'), $this->common->config('config_image_popup_height')),
					'thumb' => $this->image->resize($result['image'], $this->common->config('config_image_thumb_width'), $this->common->config('config_image_thumb_height'))
				);
			}

			if ($this->session->userdata('customer_login_status') || !$this->common->config('config_customer_price')) {
				$data['price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->common->config('config_tax')), $this->session->userdata['currency']);
			} else {
				$data['price'] = false;
			}
			
			if ((float)$product_info['special']) {
				$data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->common->config('config_tax')), $this->session->userdata('currency'));
			} else {
				$data['special'] = false;
			}
			
			if ($this->common->config('config_tax')) {
				$data['tax'] = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $this->session->userdata('currency'));
			} else {
				$data['tax'] = false;
			}

			$discounts = $this->product->getProductDiscounts($product_id);
			
			$data['discounts'] = array();

			foreach ($discounts as $discount) {
				$data['discounts'][] = array(
					'quantity' => $discount['quantity'],
					'price'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->common->config('config_tax')), $this->session->userdata('currency'))
				);
			}
			
			$data['options'] = array();
			
			foreach ($this->product->getProductOptions($product_id) as $option) {
				$product_option_value_data = array();

				foreach ($option['product_option_value'] as $option_value) {
					if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
						if ((($this->common->config('config_customer_price') && $this->session->userdata('customer_login_status')) || !$this->common->config('config_customer_price')) && (float)$option_value['price']) {
							$price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->common->config('config_tax') ? 'P' : false), $this->session->userdata('currency'));
						} else {
							$price = false;
						}

						$product_option_value_data[] = array(
							'product_option_value_id' => $option_value['product_option_value_id'],
							'option_value_id'         => $option_value['option_value_id'],
							'name'                    => $option_value['name'],
							'image'                   => $this->image->resize($option_value['image'], 50, 50),
							'price'                   => $price,
							'price_prefix'            => $option_value['price_prefix']
						);
					}
				}

				$data['options'][] = array(
					'product_option_id'    => $option['product_option_id'],
					'product_option_value' => $product_option_value_data,
					'option_id'            => $option['option_id'],
					'name'                 => $option['name'],
					'type'                 => $option['type'],
					'value'                => $option['value'],
					'required'             => $option['required']
				);
			}
			
			if ($product_info['min_quantity']) {
				$data['minimum'] = $product_info['min_quantity'];
			} else {
				$data['minimum'] = 1;
			}
			
			$data['review_status'] = $this->common->config('config_review_status');

			if ($this->common->config('config_review_guest') || $this->session->userdata('customer_login_status')) {
				$data['review_guest'] = true;
			} else {
				$data['review_guest'] = false;
			}

			if ($this->session->userdata('customer_login_status')) {
				$data['customer_name'] = $this->session->userdata('customer_name');
			} else {
				$data['customer_name'] = '';
			}

			$data['reviews'] = sprintf($this->lang->line('text_reviews'), (int)$product_info['reviews']);
			$data['rating'] = (int)$product_info['rating'];
			
			$data['share'] = site_url($product_keyword_id);

			$data['attribute_groups'] = $this->product->getProductAttributes($product_id);
			
			$data['products'] = array();

			$results = $this->product->getProductRelated($product_id);
			
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->image->resize($result['image'], $this->common->config('config_image_related_width'), $this->common->config('config_image_related_height'));
				} else {
					$image = $this->image->resize('no_image.png', $this->common->config('config_image_related_width'), $this->common->config('config_image_related_height'));
				}

				if ($this->session->userdata('customer_login_status') || !$this->common->config('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->common->config('config_tax')), $this->session->userdata('currency'));
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->common->config('config_tax')), $this->session->userdata('currency'));
				} else {
					$special = false;
				}

				if ($this->common->config('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->userdata('currency'));
				} else {
					$tax = false;
				}

				if ($this->common->config('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}

				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => substr(strip_tags(html_entity_decode(ucwords(strtolower($result['name'])), ENT_QUOTES, 'UTF-8')), 0, 35) . '...',
					'description' => substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->common->config('config_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'minimum'     => $result['min_quantity'] > 0 ? $result['min_quantity'] : 1,
					'rating'      => $rating,
					'href'        => site_url($this->common->getSeoUrl('product_id',$result['product_id']))
				);
			}
			//echo '<pre>';print_r($data['products']);
			$data['tags'] = array();

			if ($product_info['tag']) {
				$tags = explode(',', $product_info['tag']);

				foreach ($tags as $tag) {
					$data['tags'][] = array(
						'tag'  => trim($tag),
						'href' => site_url('product/search/'.trim($tag))
					);
				}
			}
			
			$this->product->updateViewed($product_id);
			if(isset($category_id))
			{
				$data['latestproduct_list'] = $this->latestproduct->getLatestProduct($category_id);	
			}
			else
			{
				$data['latestproduct_list'] = $this->latestproduct->getLatestProduct();	
			}
		
		$site_theme = $this->common->config('catalog_theme');
		$this->load->section('colom_right', "themes/".$site_theme."/common/colom_right",$data);
		
		$this->load->view("themes/".$site_theme."/product/product",$data);
			//echo '<pre>';print_r($data);
		}
		else
		{
			$url = '';
			if ($this->input->post('path')!==NULL) {
				$url .= '&path=' . $this->input->post('path');
			}

			if ($this->input->post('filter')!==NULL) {
				$url .= '&filter=' . $this->input->post('filter');
			}

			if ($this->input->post('manufacturer_id')!==NULL) {
				$url .= '&manufacturer_id=' . $this->input->post('manufacturer_id');
			}

			if ($this->input->post('search')!==NULL) {
				$url .= '&search=' . $this->input->post('search');
			}

			if ($this->input->post('tag')!==NULL) {
				$url .= '&tag=' . $this->input->post('tag');
			}

			if ($this->input->post('description')!==NULL) {
				$url .= '&description=' . $this->input->post('description');
			}

			if ($this->input->post('category_id')!==NULL) {
				$url .= '&category_id=' . $this->input->post('category_id');
			}

			if ($this->input->post('sub_category')!==NULL) {
				$url .= '&sub_category=' . $this->input->post('sub_category');
			}

			if ($this->input->post('sort')!==NULL) {
				$url .= '&sort=' . $this->input->post('sort');
			}

			if ($this->input->post('order')!==NULL) {
				$url .= '&order=' . $this->input->post('order');
			}

			if ($this->input->post('page')!==NULL) {
				$url .= '&page=' . $this->input->post('page');
			}

			if ($this->input->post('limit')!==NULL) {
				$url .= '&limit=' . $this->input->post('limit');
			}
			
			$data['breadcrumbs'][] = array(
				'text' => 'Error Page',
				'href' => site_url($product_id)
			);
			
			$this->document->setTitle($this->lang->line('text_error'));

			$data['heading_title'] = $this->lang->line('text_error');

			$data['text_error'] = $this->lang->line('text_error');

			$data['button_continue'] = $this->lang->line('button_continue');

			$data['continue'] = site_url('common/home');
			
			$site_theme = $this->common->config('catalog_theme');
			$this->load->view("themes/".$site_theme."/common/error",$data);
		}
		
	}
	
		public function review($product_id='') {
$this->output->unset_template();
		$this->load->model('catalog/review_model','review');

		$data['text_no_reviews'] = $this->lang->line('text_no_reviews');

		if ($this->input->post('page')!==NULL) {
			$page = $this->input->post('page');
		} else {
			$page = 1;
		}
		$limit = 10;
		$data['reviews'] = array();

		$review_total = $this->review->getTotalReviewsByProductId($product_id);

		$results = $this->review->getReviewsByProductId($product_id, ($page - 1) * $limit, $limit);

		foreach ($results as $result) {
			$data['reviews'][] = array(
				'author'     => $result['author'],
				'text'       => nl2br($result['text']),
				'rating'     => (int)$result['rating'],
				'date_added' => date('d/m/Y', strtotime($result['date_added']))
			);
		}
		// Generate pagination link
		$no = $review_total;
		$page_no = ceil((int)$no/(int)$limit);
		$pagination = '';
		
		$pagination .='<ul class="pagination">';
		for($i=1;$i<=$page_no;$i++)
		{
			if($i == $page)
			$active = 'class="active"';
			else
			$active = '';
			$pagination .='<li '.$active.'>';
			$pagination .='<a class="pagination1" onclick="getReview('.$i.');" title="'.$i.'">'.$i.'</a>';
			$pagination .='</li>';
		}
			$pagination .='</ul>';
		
		$data['pagination'] = $pagination;
		
		
		$site_theme = $this->common->config('catalog_theme');
		echo json_encode($data);exit;
		

	}
	
	public function write($product_id='') {

		$json = array();

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			if ((strlen($this->input->post('name')) < 3) || (strlen($this->input->post('name')) > 25)) {
				$json['error'] = $this->lang->line('error_name');
			}

			if ((strlen($this->input->post('text')) < 25) || (strlen($this->input->post('text')) > 1000)) {
				$json['error'] = $this->lang->line('error_text');
			}

			if (empty($this->input->post('rating')) || $this->input->post('rating') < 0 || $this->input->post('rating') > 5) {
				$json['error'] = $this->lang->line('error_rating');
			}

			if (!isset($json['error'])) {
				$this->load->model('catalog/review_model','review');

				$this->review->addReview($product_id, $this->input->post());

				$json['success'] = $this->lang->line('text_success');
			}
		}
		$this->output->unset_template();
		echo json_encode($json);
	}

}
