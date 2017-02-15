<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		$this->_init();
		
		$this->load->model('modules/filter','filter');
		
		$this->lang->load('product/category_lang','english');

		$this->load->model('catalog/category','category');

		$this->load->model('catalog/product','product');

		$this->load->model('tool/image','image');
		
		$this->load->library('tax');
		
		$this->load->library('pagination');
	}
	
	private function _init() {
		
		//--Set Template
		$this->output->set_template('site_template');
		$site_theme = $this->common->config('catalog_theme');
	}
	public function index($path='',$id='')
	{   
		$catalog_product =0;
		//get settings data
		if ($this->input->post('filter')!==NULL) {
			$filter = $this->input->post('filter');
		} else {
			$filter = '';
		}

		if ($this->input->post('sort')!==NULL) {
			$sort = $this->input->post('sort');
		} else {
			$sort = 'p.sort_order';
		}

		if ($this->input->post('order')!==NULL) {
			$order = $this->input->post('order');
		} else {
			$order = 'ASC';
		}

		if ($this->input->post('page')!==NULL) {
			$page = $this->input->post('page');
		} else {
			$page = 1;
		}

		if ($this->input->post('limit')!==NULL) {
			$limit = (int)$this->input->post('limit');
		} else {
			$limit = $this->common->config('config_product_limit');
		}
		
		$data['breadcrumbs']   	= array();
		
		$data['breadcrumbs'][] 	= array(
		   'text' => '<i class="glyphicon glyphicon-home"></i> Home',
		   'href' =>site_url('common/home'),
		 
		  );
		
		if(isset($path)) {
			
			$url = '';

			if ($this->input->post('sort')!==NULL) {
				$url .= '&sort=' . $this->input->post('sort');
			}

			if ($this->input->post('order')!==NULL) {
				$url .= '&order=' . $this->input->post('order');
			}

			if ($this->input->post('limit')!==NULL) {
				$url .= '&limit=' . $this->input->post('limit');
			}
			$paths = '';
			
			$parts = explode('_', $path);
			
			$category_id = $this->common->getSeoUrlId(array_pop($parts));
                        $data['category_id'] = $category_id;
			
			foreach ($parts as $path_keyword) {
				if (!$paths) {
					$paths = $path_keyword;
					$paths_id = (int)$this->common->getSeoUrlId($path_keyword);
				} else { 
					$paths .= '_' . $path_keyword;
					$paths_id = (int)$this->common->getSeoUrlId($path_keyword);
				}
				
				$category_info = $this->category->getCategory($paths_id);
				$category_info = $category_info[0];
				
				if(strtolower($category_info['category_name']) == 'look book')
				{
					$catalog_product =1;
				}
				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['category_name'],
						'href' => site_url($paths)
					);
				}
			}
			
		} else {
			$category_id = 0;
		}
		
		$category_info = $this->category->getCategory($category_id);
		
		if(isset($category_info) && count($category_info)>0){
			$category_info = $category_info[0];
		}
		if ($category_info) {
			$this->document->setTitle($category_info['meta_title']);
			$this->document->setDescription($category_info['meta_description']);
			$this->document->setKeywords($category_info['meta_keyword']);
			$data['header'] = $this->headers->getHeaders();
			
			$data['heading_title'] = $category_info['category_name'];
			
			$data['text_refine'] 		= $this->lang->line('text_refine');
			$data['text_empty'] 		= $this->lang->line('text_empty');
			$data['text_quantity'] 		= $this->lang->line('text_quantity');
			$data['text_manufacturer'] 	= $this->lang->line('text_manufacturer');
			$data['text_model'] 		= $this->lang->line('text_model');
			$data['text_price'] 		= $this->lang->line('text_price');
			$data['text_tax'] 			= $this->lang->line('text_tax');
			$data['text_points'] 		= $this->lang->line('text_points');
			$data['text_compare'] 		= sprintf($this->lang->line('text_compare'), (($this->session->userdata('compare')!=NULL) ? count($this->session->userdata('compare')) : 0));
			$data['text_sort'] 			= $this->lang->line('text_sort');
			$data['text_limit'] 		= $this->lang->line('text_limit');

			$data['button_cart'] 		= $this->lang->line('button_cart');
			$data['button_wishlist'] 	= $this->lang->line('button_wishlist');
			$data['button_compare'] 	= $this->lang->line('button_compare');
			$data['button_continue'] 	= $this->lang->line('button_continue');
			$data['button_list'] 		= $this->lang->line('button_list');
			$data['button_grid'] 		= $this->lang->line('button_grid');
			
			if(strtolower($category_info['category_name']) == 'look book')
			{
				$catalog_product =1;
			}
			// Set the last category breadcrumb
			$data['breadcrumbs'][] = array(
		   			'text' => $category_info['category_name'],
		   			'href' => site_url($path),
		 
		  		);
			
			// set category image thumb	
			if ($category_info['image']) {
				$data['thumb'] = $this->image->resize($category_info['image'], $this->common->config('config_image_category_width'), $this->common->config('config_image_category_height'));
			} else {
				$data['thumb'] = '';
			}
			
			$data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
			$data['compare'] = site_url('product/compare');

			$url = '';
			
			if ($this->input->post('filter')!==NULL) {
				$url .= '&filter=' . $this->input->post('filter');
			}

			if ($this->input->post('sort')!==NULL) {
				$url .= '&sort=' . $this->input->post('sort');
			}

			if ($this->input->post('order')!==NULL) {
				$url .= '&order=' . $this->input->post('order');
			}

			if ($this->input->post('limit')!==NULL) {
				$url .= '&limit=' . $this->input->post('limit');
			}
			
			$data['categories'] = array();
			
			$results = $this->category->getCategories($category_id);
			
			foreach ($results as $result) {
				$filter_data = array(
					'filter_category_id'  => $result['category_id'],
					'catalog_product' 	 => $catalog_product,
					'filter_sub_category' => true
				);
				
				$data['categories'][] = array(
					'name' => $result['category_name'] . ($this->common->config('config_product_count') ? ' (' . $this->product->getTotalProducts($filter_data) . ')' : ''),
					'href' => site_url($this->common->getSeoUrl('category_id',$result['category_id'])),
				);
		}
			
		$data['products'] = array();

		$filter_data = array(
			'filter_category_id' => $category_id,
			'filter_filter'      => $filter,
			'catalog_product' 	 => $catalog_product,
			'sort'               => $sort,
			'order'              => $order,
			'start'              => ($page - 1) * $limit,
			'limit'              => $limit
		);
		
		$product_total = $this->product->getTotalProducts($filter_data);
		
		$results = $this->product->getProducts($filter_data);
		
		foreach ($results as $result) {
			if($catalog_product == '1')
				{
					$result['price']=$this->product->getCatalogTotalPrice($result['catalog_no']);
					$result['special']=$result['price']-(($result['price']*7)/100);
				}
				
				if ($result['image']) {
					$image = $this->image->resize($result['image'], $this->common->config('config_image_product_width'), $this->common->config('config_image_product_height'));
				} else {
					$image = $this->image->resize('no_image.png', $this->common->config('config_image_product_width'), $this->common->config('config_image_product_height'));
				}

				if (($this->common->config('config_customer_price') && $this->customer->isLogged()) || !$this->common->config('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->common->config('config_tax')));
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->common->config('config_tax')));
				} else {
					$special = false;
				}

				if ($this->common->config('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}

				if ($this->common->config('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}

				if($catalog_product ==1)
				{
				$data['button'] 	= $this->lang->line('button_catalog');
				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'model'       => $result['model'],
					'catalog_no'  => $result['catalog_no'],
					'total_item'  => $this->product->getCatalogProductCount($result['catalog_no']), 
					'catalog_product' => $result['catalog_product'],
					'name'        =>$result['catalog_no'],
					'quantity'    => $result['quantity'],
					'description' => substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->common->config('config_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'minimum'     => $result['min_quantity'] > 0 ? $result['min_quantity'] : 1,
					'rating'      => $result['rating'],
					'href'        => site_url($path.'/'.$result['catalog_no'].'-'.$result['product_id'])
					
				);
				}
				else
				{
					$data['button'] 		= $this->lang->line('button_cart');
					$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'model'       => $result['model'],
					'total_item'  => 0,
					'catalog_no'       => $result['catalog_no'],
					'catalog_product' => $result['catalog_product'],
					'name'        => substr(strip_tags(html_entity_decode(ucwords(strtolower($result['name'])), ENT_QUOTES, 'UTF-8')), 0, 35) . '...',
					'quantity'    => $result['quantity'],
					'description' => substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->common->config('config_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'minimum'     => $result['min_quantity'] > 0 ? $result['min_quantity'] : 1,
					'rating'      => $result['rating'],
					'href'        => site_url($this->common->getSeoUrl('product_id',$result['product_id']))
				);
				}
			}
			
			$url = '';

			if ($this->input->post('filter')!==NULL) {
				$url .= '&filter=' . $this->input->post('filter');
			}

			if ($this->input->post('limit')!==NULL) {
				$url .= '&limit=' . $this->input->post('limit');
			}

			$data['sorts'] = array();
			
			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => site_url($this->common->getSeoUrl('category_id',$category_info['category_id']))
			);

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_name_asc'),
				'value' => 'p.product_name-ASC',
				'href'  => site_url($this->common->getSeoUrl('category_id',$category_info['category_id']))
			);

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_name_desc'),
				'value' => 'p.product_name-DESC',
				'href'  => site_url($this->common->getSeoUrl('category_id',$category_info['category_id']))
			);

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_price_asc'),
				'value' => 'p.price-ASC',
				'href'  => site_url($this->common->getSeoUrl('category_id',$category_info['category_id']))
			);

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_price_desc'),
				'value' => 'p.price-DESC',
				'href'  => site_url($this->common->getSeoUrl('category_id',$category_info['category_id']))
			);

			if ($this->common->config('config_review_status')) {
				$data['sorts'][] = array(
					'text'  => $this->lang->line('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => site_url($this->common->getSeoUrl('category_id',$category_info['category_id']))
				);

				$data['sorts'][] = array(
					'text'  => $this->lang->line('text_rating_asc'),
					'value' => 'rating-ASC',
					'href'  => site_url($this->common->getSeoUrl('category_id',$category_info['category_id']))
				);
			}

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => site_url($this->common->getSeoUrl('category_id',$category_info['category_id']))
			);

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_model_desc'),
				'value' => 'p.model-DESC',
				'href'  => site_url($this->common->getSeoUrl('category_id',$category_info['category_id']))
			);

			$url = '';
			
			if ($this->input->post('filter')!==NULL) {
				$url .= '&filter=' . $this->input->post('filter');
			}

			if ($this->input->post('sort')!==NULL) {
				$url .= '&sort=' . $this->input->post('sort');
			}

			if ($this->input->post('order')!==NULL) {
				$url .= '&order=' . $this->input->post('order');
			}

			$data['limits'] = array();

			$limits = array_unique(array($this->common->config('config_product_limit'), 25, 50, 75, 100));

			sort($limits);
			
			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => site_url($this->common->getSeoUrl('category_id',$category_info['category_id']))
				);
			}

			$url = '';
			
			if ($this->input->post('filter')!==NULL) {
				$url .= '&filter=' . $this->input->post('filter');
			}

			if ($this->input->post('sort')!==NULL) {
				$url .= '&sort=' . $this->input->post('sort');
			}

			if ($this->input->post('order')!==NULL) {
				$url .= '&order=' . $this->input->post('order');
			}

			if ($this->input->post('limit')!==NULL) {
				$url .= '&limit=' . $this->input->post('limit');
			}
			
			// Generate pagination link
			$no = $this->product->getTotalProducts($filter_data);
			$page_no = ceil((int)$no/(int)$limit);
			$pagination = '';
			
			$pagination .='<ul class="pagination">';
			for($i=1;$i<=$page_no;$i++)
			{
				if($i == $page)
				$active = 'class="active"';
				else
				$active = '';
				$page_url =$this->common->getSeoUrl('category_id',$category_info['category_id']).'?'.$url.'&page='.$i;
				$pagination .='<li '.$active.'>';
				$pagination .='<a class="pagination1" onclick="setPaginationPage('.$i.')" title="'.$i.'">'.$i.'</a>';
				$pagination .='</li>';
			}
				$pagination .='</ul>';
			
			$data['pagination'] = $pagination;
			$data['sort'] = $sort;
			$data['order'] = $order;
			$data['limit'] = $limit;
			

		//Filter Call
		$data['filter']  = array();
		$filter_data = '';
		$data['filter']['show'] = array('sort'=>'','order'=>'','limit'=>'');
		$data['filter']['data'] = $this->filter->getFilter($category_id,$filter_data,$data['filter']['show']);
		$site_theme = $this->common->config('catalog_theme');
		//echo '<pre>';print_r($data);die;
		$this->load->section('filter', "themes/".$site_theme."/common/filter",$data);
		
		$this->load->view("themes/".$site_theme."/product/category",$data);
		
		} else {
			$url = '';

			if ($this->input->post('path')!==NULL) {
				$url .= '&path=' . $this->input->post('path');
			}

			if ($this->input->post('filter')!==NULL) {
				$url .= '&filter=' . $this->input->post('filter');
			}

			if ($this->input->post('sort')!==NULL) {
				$url .= '&sort=' . $this->input->post('sort');
			}

			if ($this->input->post('order')!==NULL) {
				$url .= '&order=' . $this->input->post('order');
			}

			if ($this->input->post('limit')!==NULL) {
				$url .= '&limit=' . $this->input->post('limit');
			}

			if ($this->input->post('page')!==NULL) {
				$url .= '&page=' . $this->input->post('page');
			}


			$data['breadcrumbs'][] = array(
				'text' => $this->lang->line('text_error'),
				'href' => $this->url->link('product/category')
			);

			$this->document->setTitle($this->lang->line('text_error'));

			$data['heading_title'] = $this->lang->line('text_error');

			$data['text_error'] = $this->lang->line('text_error');

			$data['button_continue'] = $this->lang->line('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->load->view("themes/".$site_theme."/common/error",$data);
		}
	}
        public function search()
	{   
		$this->output->unset_template();
		if(($this->input->server('REQUEST_METHOD') == 'POST'))
		{
			$category_id = $this->input->post('category_id');
			//get settings data
			if ($this->input->post('filter')!==NULL) 
			{
				$filter = $this->input->post('filter');
			} 
			else 
			{
				$filter = '';
			}
		
			if ($this->input->post('sort')!==NULL) 
			{
				$sort = $this->input->post('sort');
				$sort_filter = explode('-', $sort);
				if(isset($sort_filter[0]))
				{
					$sort = $sort_filter[0];
				}
			} 
			else 
			{
				$sort = 'p.sort_order';
			}

			if ($this->input->post('order')!==NULL) 
			{
				$order = $this->input->post('order');
				$order_filter = explode('-', $order);
				if(isset($order_filter[1]))
				{
					$order = $order_filter[1];
				}
			} 
			else 
			{
				$order = 'ASC';
			}

			
			
			if ($this->input->post('page')!==NULL) 
			{
				$page = $this->input->post('page');
			} 
			else 
			{
				$page = 1;
			}

			if ($this->input->post('limit')!==NULL) {
				$limit = (int)$this->input->post('limit');
			} else {
				$limit = $this->common->config('config_product_limit');
			}
		
			if(isset($category_id)) {
				$category_id = $category_id;
			} else {
				$category_id = 0;
			}
		
			$category_info = $this->category->getCategory($category_id);
			if(isset($category_info) && count($category_info)>0){
				$category_info = $category_info[0];
			}
		if ($category_info) {
			// set category image thumb	
			if ($category_info['image']) {
				$data['thumb'] = $this->image->resize($category_info['image'], $this->common->config('config_image_category_width'), $this->common->config('config_image_category_height'));
			} 
			else 
			{
				$data['thumb'] = '';
			}
			
			$data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
			$data['compare'] = site_url('product/compare');

			$url = '';
			$data['categories'] = array();
			
			$results = $this->category->getCategories($category_id);
			foreach ($results as $result) {
				$filter_data = array(
					'filter_category_id'  => $result['category_id'],
					'filter_sub_category' => true,
					'catalog_product'=>0
				);
				
				$data['categories'][] = array(
					'name' => $result['category_name'] . ($this->common->config('config_product_count') ? ' (' . $this->product->getTotalProducts($filter_data) . ')' : ''),
					'href' => site_url($this->common->getSeoUrl('category_id',$result['category_id'])),
				);
			}
			
		$data['products'] = array();

		$filter_data = array(
			'filter_category_id' => $category_id,
			'filter_filter'      => $filter,
			'sort'               => $sort,
			'catalog_product'=>0,
			'order'              => $order,
			'start'              => ($page - 1) * $limit,
			'limit'              => $limit
		);
		if ($this->input->post('range')!==NULL) 
		{
			$range = $this->input->post('range');
			if(isset($range[0]))
			{
				$minprice = $range[0]; 
				$filter_data['minPrice'] = $this->currency->convert($minprice,$this->session->userdata('currency'),$this->common->config('config_currency'));
			}
			
			if(isset($range[1]))
			{
				$maxprice = $range[1]; 
				$filter_data['maxPrice'] = $this->currency->convert($maxprice,$this->session->userdata('currency'),$this->common->config('config_currency'));
			}

			

		} 
		
		$product_total = $this->product->getTotalProducts($filter_data);

		$results = $this->product->getProducts($filter_data);
		//print_r($results);die;
		foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->image->resize($result['image'], $this->common->config('config_image_product_width'), $this->common->config('config_image_product_height'));
				} else {
					$image = $this->image->resize('no_image.png', $this->common->config('config_image_product_width'), $this->common->config('config_image_product_height'));
				}

				if (($this->common->config('config_customer_price') && $this->customer->isLogged()) || !$this->common->config('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->common->config('config_tax')));
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->common->config('config_tax')));
				} else {
					$special = false;
				}

				if ($this->common->config('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
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
					'model'       => $result['model'],
					'name'        => substr(strip_tags(html_entity_decode(ucwords(strtolower($result['name'])), ENT_QUOTES, 'UTF-8')), 0, 35) . '...',
					'quantity'    => $result['quantity'],
					'description' => substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->common->config('config_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'minimum'     => $result['min_quantity'] > 0 ? $result['min_quantity'] : 1,
					'rating'      => $result['rating'],
					'href'        => site_url($this->common->getSeoUrl('product_id',$result['product_id']))
				);
			}
			


			$url = '';
			$data['limits'] = array();

			$limits = array_unique(array($this->common->config('config_product_limit'), 25, 50, 75, 100));

			sort($limits);
			
			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => site_url($this->common->getSeoUrl('category_id',$category_info['category_id']))
				);
			}
			// Generate pagination link
			$no = $this->product->getTotalProducts($filter_data);
			$page_no = ceil((int)$no/(int)$limit);
			$pagination = '';
			
			$pagination .='<ul class="pagination">';
			for($i=1;$i<=$page_no;$i++)
			{
				if($i == $page)
				$active = 'class="active"';
				else
				$active = '';
				$page_url =$this->common->getSeoUrl('category_id',$category_info['category_id']).'?'.$url.'&page='.$i;
				$pagination .='<li '.$active.'>';
				$pagination .='<a class="pagination1" onclick="setPaginationPage('.$i.')" title="'.$i.'">'.$i.'</a>';
				$pagination .='</li>';
			}
				$pagination .='</ul>';
			
			$data['pagination'] = $pagination;
			$data['sort'] = $sort;
			$data['order'] = $order;
			$data['limit'] = $limit;
			$data['success']="Successfully";
			
	}	
		}
		else
		{
			$data['error'] ="Something went wrong!";
		}
		
		echo json_encode($data);
		
		
		
	}
       }
