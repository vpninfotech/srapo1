<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogs extends CI_Controller {
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
    public function index($path='',$catalog_no='')
    {
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
        /*----------------- For catalog ------------------*/
		$catalog_nos = explode('-', $catalog_no);
		
		$catalog_no = $catalog_nos[0];
		$product_id = $catalog_nos[1];
        if ($catalog_no!==NULL) {
            $catalog_no = $catalog_no;
        } else {
            $catalog_no = '';
        }
        if ($product_id!==NULL) {
            $product_id = $product_id;
        } else {
            $product_id = '';
        }
        
        /* --------------------------------------------*/
        $data['breadcrumbs']   	= array();
		
		$data['breadcrumbs'][] 	= array(
		   'text' => 'Home',
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
				
				if ($category_info) {
					if(strtolower($category_info['category_name']) == 'look book')
					{
						$catalog_product =1;
					}
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

			
			$data['button_wishlist'] 	= $this->lang->line('button_wishlist');
			$data['button_compare'] 	= $this->lang->line('button_compare');
			$data['button_continue'] 	= $this->lang->line('button_continue');
			$data['button_list'] 		= $this->lang->line('button_list');
			$data['button_grid'] 		= $this->lang->line('button_grid');
			$data['button_cart'] 		= $this->lang->line('button_grid');
			$data['path']  = $path;
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
			//print_r($results);die;
			foreach ($results as $result) {
				$filter_data = array(
					'filter_category_id'  => $result['category_id'],
					'filter_sub_category' => true,
					'catalog_product' 	 => $catalog_product
				);
				
				$data['categories'][] = array(
					'name' => $result['category_name'] . ($this->common->config('config_product_count') ? ' (' . $this->product->getTotalProducts($filter_data) . ')' : ''),
					'href' => site_url($this->common->getSeoUrl('category_id',$result['category_id'])),
				);
		}
			
		$data['products'] = array();

		$filter_data = array(
			'filter_category_id' => $category_id,
			'catalog_product' 	 => $catalog_product,
			'filter_filter'      => $filter,
			'catalog_no'         => $catalog_no,
			'sort'               => $sort,
			'order'              => $order,
			'start'              => ($page - 1) * $limit,
			'limit'              => $limit
		);
        $product_total = $this->product->getTotalProductss($filter_data);

		$results = $this->product->getProductss($filter_data);
		//print_r($results);die;
            /*echo "<pre>";
            print_r($filter_data);
            die;*/
            // Set the last category breadcrumb

			$data['breadcrumbs'][] = array(
		   			'text' => 'Catalog : ' . $catalog_no,
		   			'href' => site_url($path),
		 
		  		);
			
            foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->image->resize($result['image'], $this->common->config('config_image_product_width'), $this->common->config('config_image_product_height'));
				} else {
					$image = $this->image->resize('no_image.png', $this->common->config('config_image_product_width'), $this->common->config('config_image_product_height'));
				}

				if (1) {
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
				
                $data['download']               = site_url('product/catalogs/downloadZip/'.$catalog_no);
                $data['product_id']             = $product_id;
                /* ----------------  catalog price ---------------*/
                $data['catalogs']['catalog_no'] = $catalog_no;
                if ($result['catalog_product']!= '1') {
                    $data['catalogs']['price']   = $this->product->getCatalogTotalPrice($catalog_no);
					
                    $data['catalogs']['special'] = $data['catalogs']['price'] - (($data['catalogs']['price'] * 7) / 100);
                } else {
                    $data['catalogs']['price']   = $this->product->getCatalogTotalPrice($catalog_no);
                    $data['catalogs']['special'] = NULL;
                }
               
                if (($this->common->config('config_customer_price') && $this->customer->isLogged()) || !$this->common->config('config_customer_price')) {
                    $data['catalogs']['price'] = $this->currency->format($this->tax->calculate($data['catalogs']['price'], $result['tax_class_id'], $this->common->config('config_tax')));
                } else {
                    $data['catalogs']['price'] = false;
                }
                if ((float) $data['catalogs']['special']) {
                    $data['catalogs']['special'] = $this->currency->format($this->tax->calculate($data['catalogs']['special'], $result['tax_class_id'], $this->common->config('config_tax')));
                } else {
                    $data['catalogs']['special'] = false;
                }
                /*-----------------------------------------------*/
                $data['attributes'] = array();
				
                //$data['attributes'] = $this->model_catalog_product->getAttributes();
                $data['attributes'] = $this->product->getProductAttributes($product_id);
				if(count($data['attributes'])>0)
                $data['attributes'] = $data['attributes'][0]['attribute'];
                $attribute_groups   = array();
                $attribute_groups   = $this->product->getProductAttributes($result['product_id']);
                $data['products'][] = array(
                    'product_id' => $result['product_id'],
                    'model' => $result['model'],
					'catalog_no' => $result['catalog_no'],
                    'catalog_product' => $result['catalog_product'],
                    'thumb' => $image,
                    'name' => substr(strip_tags(html_entity_decode(ucwords(strtolower($result['name'])), ENT_QUOTES, 'UTF-8')), 0, 35) . '...',
                    'description' => substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->common->config('config_product_description_length')) . '..',
                    'price' => $price,
                    'pprice' => $result['price'],
                    'sspecial' => $result['special'],
                    'special' => $special,
                    'tax' => $tax,
                    'minimum' => $result['min_quantity'] > 0 ? $result['min_quantity'] : 1,
                    'rating' => $result['rating'],
                    'attribute_groups' => $attribute_groups,
                    'href' => site_url('product/product')
                );
            }
            $this->session->set_userdata('products',isset($data['products']) ? $data['products'] : '');
		
            $this->session->set_userdata('attributes',isset($data['attributes']) ? $data['attributes'] : '');
			
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
		$data['header'] = $this->headers->getHeaders();
		$this->load->section('filter', "themes/".$site_theme."/common/filter",$data);

			$this->load->view("themes/".$site_theme."/product/catalog",$data);
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
				'href' => site_url('product/category')
			);

			$this->document->setTitle($this->lang->line('text_error'));

			$data['heading_title'] = $this->lang->line('text_error');

			$data['text_error'] = $this->lang->line('text_error');

			$data['button_continue'] = $this->lang->line('button_continue');
			$data['header'] = $this->headers->getHeaders();
			$data['continue'] = site_url('common/home');
			$site_theme = $this->common->config('catalog_theme');
			$this->load->view("themes/".$site_theme."/common/error",$data);
		}
    }
    // Do not delete thisline if delete askquesion button also deleted
    public function downloadZip($catalog_no='')
    {
        $products   = $this->session->userdata('products');
        $attributes = $this->session->userdata('attributes');
		
       
        $this->load->model('catalog/product_model','product');
        $this->load->model('tool/image','image');
        $productData = $this->product->getProductAllImages($catalog_no);
      
        $zip         = new ZipArchive;
        $zip_name    = "image/Catalog" . $catalog_no . ".zip";
        if ($zip->open($zip_name, ZipArchive::CREATE)) {
			
            foreach ($productData as $key => $image) {
				
                $filename = substr(strrchr($image['image'], "/"), 1);
				
                $zip->addFile("image/" . $image['image'], $filename);
            }
            $zip->close();
            header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: Binary");
            header("Content-Length: " . filesize($zip_name));
            header("Content-Disposition: attachment; filename=\"" . basename($zip_name) . "\"");
            readfile($zip_name);
            unlink($zip_name);
            unlink("image/Catalog" . $catalog_no . ".html");
            unlink($csv_filename);
        } else {
            return false;
        }
        $this->index();
    }
}



