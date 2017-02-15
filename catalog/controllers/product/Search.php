<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
* @file name    : Search
* @Auther       : Indrajit Kaplatiya
* @Date         : 13/01/2017
* @Description  : Product related search functionality
*
*/
class Search extends CI_Controller {
	function __construct()
	{
            parent::__construct();

            $this->_init();
			
			$this->lang->load('product/search_lang','english');

			$this->load->model('catalog/category_model','category');

			$this->load->model('catalog/product_model','product');

			$this->load->model('tool/image','image');

			$this->load->library('tax');

          
	}
	
	private function _init() {
            //--Set Template
            $this->output->set_template('site_template');
            $site_theme = $this->common->config('catalog_theme');
           
	}
	public function index() {
		
		if ($this->input->post('search')) 
		{
			$search = $this->input->post('search');
		} 
		else 
		{
			$search = '';
		}

		if ($this->input->post('tag')) 
		{
			$tag = $this->input->post('tag');
		} 
		elseif ($this->input->post('search')) 
		{
			$tag = $this->input->post('search');
		} else {
			$tag = '';
		}

		if ($this->input->post('description')) 
		{
			$description = $this->input->post('description');
		} else {
			$description = '';
		}

		if ($this->input->post('category_id')) 
		{
			$category_id = $this->input->post('category_id');
		} else {
			$category_id = 0;
		}

		if ($this->input->post('sub_category')) 
		{
			$sub_category = $this->input->post('sub_category');
		} else {
			$sub_category = '';
		}

		if ($this->input->post('sort')) {
			$sort = $this->input->post('sort');
		} else {
			$sort = 'p.sort_order';
		}

		if ($this->input->post('order')) {
			$order = $this->input->post('order');
		} else {
			$order = 'ASC';
		}

		if ($this->input->post('page')) 
		{
			$page = $this->input->post('page');
		} else {
			$page = 1;
		}

		if ($this->input->post('limit')) {
			$limit = (int)$this->input->post('limit');
		} else {
			$limit = $this->common->config('config_product_limit');
		}

		if ($this->input->post('search')) 
		{
			$this->document->setTitle($this->lang->line('heading_title') .  ' - ' . $this->input->post('search'));
		} elseif ($this->input->post('tag')) 
		{
			$this->document->setTitle($this->lang->line('heading_title') .  ' - ' . $this->lang->line('heading_tag') . $this->input->post('tag'));
		} else {
			$this->document->setTitle($this->lang->line('heading_title'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => '<i class="glyphicon glyphicon-home"></i> Home',
			'href' => site_url('common/home'),
		);

		// $url = '';

		// if (isset($this->request->get['search'])) {
		// 	$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		// }

		// if (isset($this->request->get['tag'])) {
		// 	$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
		// }

		// if (isset($this->request->get['description'])) {
		// 	$url .= '&description=' . $this->request->get['description'];
		// }

		// if (isset($this->request->get['category_id'])) {
		// 	$url .= '&category_id=' . $this->request->get['category_id'];
		// }

		// if (isset($this->request->get['sub_category'])) {
		// 	$url .= '&sub_category=' . $this->request->get['sub_category'];
		// }

		// if (isset($this->request->get['sort'])) {
		// 	$url .= '&sort=' . $this->request->get['sort'];
		// }

		// if (isset($this->request->get['order'])) {
		// 	$url .= '&order=' . $this->request->get['order'];
		// }

		// if (isset($this->request->get['page'])) {
		// 	$url .= '&page=' . $this->request->get['page'];
		// }

		// if (isset($this->request->get['limit'])) {
		// 	$url .= '&limit=' . $this->request->get['limit'];
		// }

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('heading_title'),
			'href' => site_url('product/search')
		);

		if ($this->input->post('search')) 
		{
			$data['heading_title'] = $this->lang->line('heading_title') .  ' - ' . $this->input->post('search');
		} else {
			$data['heading_title'] = $this->lang->line('heading_title');
		}

		$data['text_empty'] = $this->lang->line('text_empty');
		$data['text_search'] = $this->lang->line('text_search');
		$data['text_keyword'] = $this->lang->line('text_keyword');
		$data['text_category'] = $this->lang->line('text_category');
		$data['text_sub_category'] = $this->lang->line('text_sub_category');
		$data['text_quantity'] = $this->lang->line('text_quantity');
		$data['text_manufacturer'] = $this->lang->line('text_manufacturer');
		$data['text_model'] = $this->lang->line('text_model');
		$data['text_price'] = $this->lang->line('text_price');
		$data['text_tax'] = $this->lang->line('text_tax');
		$data['text_points'] = $this->lang->line('text_points');
		$data['text_compare'] = sprintf($this->lang->line('text_compare'), $this->session->userdata('compare') ? count($this->session->userdata('compare')) : 0);
		$data['text_sort'] = $this->lang->line('text_sort');
		$data['text_limit'] = $this->lang->line('text_limit');

		$data['entry_search'] = $this->lang->line('entry_search');
		$data['entry_description'] = $this->lang->line('entry_description');

		$data['button_search'] = 'Search';
		$data['button_cart'] = $this->lang->line('button_cart');
		$data['button_wishlist'] = $this->lang->line('button_wishlist');
		$data['button_compare'] = $this->lang->line('button_compare');
		$data['button_list'] = $this->lang->line('button_list');
		$data['button_grid'] = $this->lang->line('button_grid');

		$data['compare'] = site_url('product/compare');

		$this->load->model('catalog/category_model','category');

		// 3 Level Category Search
		$data['categories'] = array();

		$categories_1 = $this->category->getCategories(0);
		// echo "<pre>";
		// print_r($categories_1);
		foreach ($categories_1 as $category_1) {
			$level_2_data = array();

			$categories_2 = $this->category->getCategories($category_1['category_id']);

			foreach ($categories_2 as $category_2) {
				$level_3_data = array();

				$categories_3 = $this->category->getCategories($category_2['category_id']);

				foreach ($categories_3 as $category_3) {
					$level_3_data[] = array(
						'category_id' => $category_3['category_id'],
						'name'        => $category_3['category_name'],
					);
				}

				$level_2_data[] = array(
					'category_id' => $category_2['category_id'],
					'name'        => $category_2['category_name'],
					'children'    => $level_3_data
				);
			}

			$data['categories'][] = array(
				'category_id' => $category_1['category_id'],
				'name'        => $category_1['category_name'],
				'children'    => $level_2_data
			);
		}

		$data['products'] = array();

		if ($this->input->post('search') || $this->input->post('tag')) {

			$filter_data = array(
				'filter_name'         => $search,
				'filter_tag'          => $tag,
				'filter_description'  => $description,
				'filter_category_id'  => $category_id,
				'filter_sub_category' => $sub_category,
				'sort'                => $sort,
				'order'               => $order,
				'start'               => ($page - 1) * $limit,
				'limit'               => $limit
			);

			$product_total = $this->product->getTotalProducts($filter_data);

			$results = $this->product->getProducts($filter_data);

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
					'name'        => substr(strip_tags(html_entity_decode(ucwords(strtolower($result['name'])), ENT_QUOTES, 'UTF-8')), 0, 35) . '...',
					'description' => substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->common->config('config_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'model'       => $result['model'],
					'quantity'    => $result['quantity'],
					'rating'      => $result['rating'],
					'minimum'     => $result['min_quantity'] > 0 ? $result['min_quantity'] : 1,
					'href'        => site_url($this->common->getSeoUrl('product_id',$result['product_id']))
				);
			}

			$url = '';

			$data['sorts'] = array();

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => site_url('product/search', 'sort=p.sort_order&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_name_asc'),
				'value' => 'p.product_name-ASC',
				'href'  => site_url('product/search', 'sort=pd.name&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_name_desc'),
				'value' => 'p.product_name-DESC',
				'href'  => site_url('product/search', 'sort=pd.name&order=DESC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_price_asc'),
				'value' => 'p.price-ASC',
				'href'  => site_url('product/search', 'sort=p.price&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_price_desc'),
				'value' => 'p.price-DESC',
				'href'  => site_url('product/search', 'sort=p.price&order=DESC' . $url)
			);

			if ($this->common->config('config_review_status')) {
				$data['sorts'][] = array(
					'text'  => $this->lang->line('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => site_url('product/search', 'sort=rating&order=DESC' . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->lang->line('text_rating_asc'),
					'value' => 'rating-ASC',
					'href'  => site_url('product/search', 'sort=rating&order=ASC' . $url)
				);
			}

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => site_url('product/search', 'sort=p.model&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_model_desc'),
				'value' => 'p.model-DESC',
				'href'  => site_url('product/search', 'sort=p.model&order=DESC' . $url)
			);

			$url = '';

			$data['limits'] = array();

			$limits = array_unique(array($this->common->config('config_product_limit'), 25, 50, 75, 100));

			sort($limits);

			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => site_url('product/search', $url . '&limit=' . $value)
				);
			}

			$url = '';

			// Generate pagination link
			$no = $product_total;
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
				$pagination .='<a class="pagination1" onclick="getSearchProduct('.$i.')" title="'.$i.'">'.$i.'</a>';
				$pagination .='</li>';
			}
				$pagination .='</ul>';
			
			$data['pagination'] = $pagination;

			$data['results'] = sprintf($this->lang->line('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

		}

		$data['search'] = $search;
		$data['description'] = $description;
		$data['category_id'] = $category_id;
		$data['sub_category'] = $sub_category;

		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['limit'] = $limit;

		
		$data['header'] = $this->headers->getHeaders();
		// echo "<pre>";
		// print_r($data);
		$site_theme = $this->common->config('catalog_theme');
		$this->load->view("themes/".$site_theme."/product/search",$data);
	}

	function ajaxSearch()
	{
		$this->output->unset_template();
		$json=array();
		
		if ($this->input->post('search')) 
		{
			$search = $this->input->post('search');
		} 
		else 
		{
			$search = '';
		}

		if ($this->input->post('tag')) 
		{
			$tag = $this->input->post('tag');
		} 
		elseif ($this->input->post('search')) 
		{
			$tag = $this->input->post('search');
		} else {
			$tag = '';
		}

		if ($this->input->post('description')) 
		{
			$description = $this->input->post('description');
		} else {
			$description = '';
		}

		if ($this->input->post('category_id')) 
		{
			$category_id = $this->input->post('category_id');
		} else {
			$category_id = 0;
		}

		if ($this->input->post('sub_category')) 
		{
			$sub_category = $this->input->post('sub_category');
		} else {
			$sub_category = '';
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

		if ($this->input->post('page')) 
		{
			$page = $this->input->post('page');
		} else {
			$page = 1;
		}

		if ($this->input->post('limit')) {
			$limit = (int)$this->input->post('limit');
		} else {
			$limit = $this->common->config('config_product_limit');
		}

		if ($this->input->post('search')) 
		{
			$this->document->setTitle($this->lang->line('heading_title') .  ' - ' . $this->input->post('search'));
		} elseif ($this->input->post('tag')) 
		{
			$this->document->setTitle($this->lang->line('heading_title') .  ' - ' . $this->lang->line('heading_tag') . $this->input->post('tag'));
		} else {
			$this->document->setTitle($this->lang->line('heading_title'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => 'Home',
			'href' => site_url('common/home'),
		);

		// $url = '';

		// if (isset($this->request->get['search'])) {
		// 	$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		// }

		// if (isset($this->request->get['tag'])) {
		// 	$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
		// }

		// if (isset($this->request->get['description'])) {
		// 	$url .= '&description=' . $this->request->get['description'];
		// }

		// if (isset($this->request->get['category_id'])) {
		// 	$url .= '&category_id=' . $this->request->get['category_id'];
		// }

		// if (isset($this->request->get['sub_category'])) {
		// 	$url .= '&sub_category=' . $this->request->get['sub_category'];
		// }

		// if (isset($this->request->get['sort'])) {
		// 	$url .= '&sort=' . $this->request->get['sort'];
		// }

		// if (isset($this->request->get['order'])) {
		// 	$url .= '&order=' . $this->request->get['order'];
		// }

		// if (isset($this->request->get['page'])) {
		// 	$url .= '&page=' . $this->request->get['page'];
		// }

		// if (isset($this->request->get['limit'])) {
		// 	$url .= '&limit=' . $this->request->get['limit'];
		// }

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('heading_title'),
			'href' => site_url('product/search')
		);

		if ($this->input->post('search')) 
		{
			$data['heading_title'] = $this->lang->line('heading_title') .  ' - ' . $this->input->post('search');
		} else {
			$data['heading_title'] = $this->lang->line('heading_title');
		}

		$data['text_empty'] = $this->lang->line('text_empty');
		$data['text_search'] = $this->lang->line('text_search');
		$data['text_keyword'] = $this->lang->line('text_keyword');
		$data['text_category'] = $this->lang->line('text_category');
		$data['text_sub_category'] = $this->lang->line('text_sub_category');
		$data['text_quantity'] = $this->lang->line('text_quantity');
		$data['text_manufacturer'] = $this->lang->line('text_manufacturer');
		$data['text_model'] = $this->lang->line('text_model');
		$data['text_price'] = $this->lang->line('text_price');
		$data['text_tax'] = $this->lang->line('text_tax');
		$data['text_points'] = $this->lang->line('text_points');
		$data['text_compare'] = sprintf($this->lang->line('text_compare'), $this->session->userdata('compare') ? count($this->session->userdata('compare')) : 0);
		$data['text_sort'] = $this->lang->line('text_sort');
		$data['text_limit'] = $this->lang->line('text_limit');

		$data['entry_search'] = $this->lang->line('entry_search');
		$data['entry_description'] = $this->lang->line('entry_description');

		$data['button_search'] = 'Search';
		$data['button_cart'] = $this->lang->line('button_cart');
		$data['button_wishlist'] = $this->lang->line('button_wishlist');
		$data['button_compare'] = $this->lang->line('button_compare');
		$data['button_list'] = $this->lang->line('button_list');
		$data['button_grid'] = $this->lang->line('button_grid');

		$data['compare'] = site_url('product/compare');

		$this->load->model('catalog/category_model','category');

		// 3 Level Category Search
		$data['categories'] = array();

		$categories_1 = $this->category->getCategories(0);
		// echo "<pre>";
		// print_r($categories_1);
		foreach ($categories_1 as $category_1) {
			$level_2_data = array();

			$categories_2 = $this->category->getCategories($category_1['category_id']);

			foreach ($categories_2 as $category_2) {
				$level_3_data = array();

				$categories_3 = $this->category->getCategories($category_2['category_id']);

				foreach ($categories_3 as $category_3) {
					$level_3_data[] = array(
						'category_id' => $category_3['category_id'],
						'name'        => $category_3['category_name'],
					);
				}

				$level_2_data[] = array(
					'category_id' => $category_2['category_id'],
					'name'        => $category_2['category_name'],
					'children'    => $level_3_data
				);
			}

			$data['categories'][] = array(
				'category_id' => $category_1['category_id'],
				'name'        => $category_1['category_name'],
				'children'    => $level_2_data
			);
		}

		$data['products'] = array();

		if ($this->input->post('search') || $this->input->post('tag')) {

			$filter_data = array(
				'filter_name'         => $search,
				'filter_tag'          => $tag,
				'filter_description'  => $description,
				'filter_category_id'  => $category_id,
				'filter_sub_category' => $sub_category,
				'sort'                => $sort,
				'order'               => $order,
				'start'               => ($page - 1) * $limit,
				'limit'               => $limit
			);

			$product_total = $this->product->getTotalProducts($filter_data);

			$results = $this->product->getProducts($filter_data);

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
					'name'        => substr(strip_tags(html_entity_decode(ucwords(strtolower($result['name'])), ENT_QUOTES, 'UTF-8')), 0, 35) . '...',
					'description' => substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->common->config('config_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'model'       => $result['model'],
					'quantity'    => $result['quantity'],
					'rating'      => $result['rating'],
					'minimum'     => $result['min_quantity'] > 0 ? $result['min_quantity'] : 1,
					'href'        => site_url($this->common->getSeoUrl('product_id',$result['product_id']))
				);
			}

			$url = '';

			$data['sorts'] = array();

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => site_url('product/search', 'sort=p.sort_order&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_name_asc'),
				'value' => 'p.product_name-ASC',
				'href'  => site_url('product/search', 'sort=pd.name&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_name_desc'),
				'value' => 'p.product_name-DESC',
				'href'  => site_url('product/search', 'sort=pd.name&order=DESC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_price_asc'),
				'value' => 'p.price-ASC',
				'href'  => site_url('product/search', 'sort=p.price&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_price_desc'),
				'value' => 'p.price-DESC',
				'href'  => site_url('product/search', 'sort=p.price&order=DESC' . $url)
			);

			if ($this->common->config('config_review_status')) {
				$data['sorts'][] = array(
					'text'  => $this->lang->line('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => site_url('product/search', 'sort=rating&order=DESC' . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->lang->line('text_rating_asc'),
					'value' => 'rating-ASC',
					'href'  => site_url('product/search', 'sort=rating&order=ASC' . $url)
				);
			}

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => site_url('product/search', 'sort=p.model&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->lang->line('text_model_desc'),
				'value' => 'p.model-DESC',
				'href'  => site_url('product/search', 'sort=p.model&order=DESC' . $url)
			);

			$url = '';

			$data['limits'] = array();

			$limits = array_unique(array($this->common->config('config_product_limit'), 25, 50, 75, 100));

			sort($limits);

			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => site_url('product/search', $url . '&limit=' . $value)
				);
			}

			$url = '';

			// Generate pagination link
			$no = $product_total;
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
				$pagination .='<a class="pagination1" onclick="getSearchProduct('.$i.')" title="'.$i.'">'.$i.'</a>';
				$pagination .='</li>';
			}
				$pagination .='</ul>';
			
			$data['pagination'] = $pagination;

			$data['results'] = sprintf($this->lang->line('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

		}

		$data['search'] = $search;
		$data['description'] = $description;
		$data['category_id'] = $category_id;
		$data['sub_category'] = $sub_category;

		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['limit'] = $limit;

		
		$data['header'] = $this->headers->getHeaders();
		// $site_theme = $this->common->config('catalog_theme');
		// $this->load->view("themes/".$site_theme."/product/search",$data);

		echo json_encode($data);		
	}
	  /**
     * 
     * @function name : autocomplete()
     * @description   : Check product relation for delete
     * @param         : void
     * @return        : void
     *
     */
    public function autocomplete() {
        $this->output->unset_template();
        $json = array();

        if ($this->input->get('query') !== NULL) {
            $filter_name = $this->input->get('query');
        } else {
            $filter_name = '';
        }

        if ($this->input->get('query') !== NULL) {
            $filter_model = $this->input->get('query');
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
        foreach ($results as $key=>$result) 
        {
        	if (is_file(DIR_IMAGE . $result['image'])) 
           {                
                $image = $this->image->resize($result['image'], 40, 40);
            } 
            else 
            {
                $image = $this->image->resize('no_image.png', 40, 40);
            }
                $json[$key]['lable'] = $result['name'];
                $json[$key]['value'] = $result['name'];
                $json[$key]['price'] = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->common->config('config_tax')));
                $json[$key]['icon'] = $image;
               	$json[$key]['href'] = site_url($this->common->getSeoUrl('product_id',$result['product_id']));

            
        }


        $sort_order = array();

        foreach ($json as $key => $value) {
            $sort_order[$key] = $value['lable'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

        echo json_encode($json);
    }

}