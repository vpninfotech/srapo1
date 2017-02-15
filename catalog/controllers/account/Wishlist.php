<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		$this->_init();
		
		$this->load->library('customer');
		
		$this->lang->load('account/wishlist_lang','english');

		$this->load->model('account/wishlist_model','wishlist');

		$this->load->model('catalog/product_model','product');

		$this->load->model('tool/image','image');
	}
	
	private function _init() {
		
		//--Set Template
		$this->output->set_template('site_template');
		$site_theme = $this->common->config('catalog_theme');
		$this->output->set_common_meta('Product','sarpo','Home Page');
		

	}
	public function index()
	{
		if (!$this->customer->isLogged()) {
			$this->session->set_userdata('redirect',site_url('account/wishlist'));

			redirect(site_url('account/login'));
		}

		$this->document->setTitle($this->lang->line('heading_title'));
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => '<i class="glyphicon glyphicon-home"></i> Home',
			'href' => site_url('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => 'Account',
			'href' => site_url('account/account')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('heading_title'),
			'href' => site_url('account/wishlist')
		);

		$data['heading_title'] = $this->lang->line('heading_title');
		$this->document->setDescription($this->common->config('config_meta_description'));
		
		$this->document->setKeywords($this->common->config('config_meta_keyword'));
		
		$data['header'] = $this->headers->getHeaders();
		$data['text_empty'] = $this->lang->line('text_empty');

		$data['column_image'] = $this->lang->line('column_image');
		$data['column_name'] = $this->lang->line('column_name');
		$data['column_model'] = $this->lang->line('column_model');
		$data['column_stock'] = $this->lang->line('column_stock');
		$data['column_price'] = $this->lang->line('column_price');
		$data['column_action'] = $this->lang->line('column_action');

		$data['button_continue'] = $this->lang->line('button_continue');
		$data['button_cart'] = $this->lang->line('button_cart');
		$data['button_remove'] = $this->lang->line('button_remove');
		
		if ($this->session->userdata('success')!==NULL) {
			$data['success'] = $this->session->userdata('success');
			$this->session->unset_userdata('success');
		} else {
			$data['success'] = '';
		}

		$data['products'] = array();

		$results = $this->wishlist->getWishlist();
		
		foreach ($results as $result) {
			$product_info = $this->product->getProduct($result['product_id']);

			if ($product_info) {
				if ($product_info['image']) {
					$image = $this->image->resize($product_info['image'], $this->common->config('config_image_wishlist_width'), $this->common->config('config_image_wishlist_height'));
				} else {
					$image = false;
				}

				if ($product_info['quantity'] <= 0) {
					$stock = $product_info['stock_status'];
				} elseif ($this->common->config('config_stock_display')) {
					$stock = $product_info['quantity'];
				} else {
					$stock = $this->lang->line('text_instock');
				}

				if (($this->common->config('config_customer_price') && $this->customer->isLogged()) || !$this->common->config('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->common->config('config_tax')));
				} else {
					$price = false;
				}

				if ((float)$product_info['special']) {
					$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->common->config('config_tax')));
				} else {
					$special = false;
				}
				$data['products'][] = array(
					'product_id' => $product_info['product_id'],
					'thumb'      => $image,
					'name'       => $product_info['name'],
					'model'      => $product_info['model'],
					'stock'      => $stock,
					'price'      => $price,
					'special'    => $special,
					'href'       => site_url($this->common->getSeoUrl('product_id',$product_info['product_id'])),
					'remove'     => site_url('account/wishlist/remove/' . $product_info['product_id'])
				);
			} else {
				$this->wishlist->deleteWishlist($product_id);
			}
			
			
		}
		$data['continue'] = site_url('account/account');
		$site_theme = $this->common->config('catalog_theme');
		$this->load->view("themes/".$site_theme."/account/wishlist",$data);
	}
	
	public function add()
	{
		$this->output->unset_template();
		$json = array();

		if ($this->input->post('product_id')!==NULL) {
			$product_id = $this->input->post('product_id');
		} else {
			$product_id = 0;
		}

		$product_info = $this->product->getProduct($product_id);
		
		if ($product_info) {
			if ($this->customer->isLogged()) {
				// Edit customers cart
				$this->wishlist->addWishlist($this->input->post('product_id'));
				

				$success_format = $this->lang->line('text_success1');
                                
                                if ($product_info['image']) {
                                    $image = $this->image->resize( $product_info['image'], 42, 56  );
                                } else {
                                    $image = $this->image->resize( 'no_image.png', 42, 56 );
                                }
                                
                                $json['product_image'] = "<a href = ".site_url($product_info['seo_keywords'])."><img src =".$image."></img></a>";
            
				$json['success'] = sprintf($success_format, site_url($this->common->getSeoUrl('product_id',$product_info['product_id'])), $product_info['name'], site_url('account/wishlist'));

				$json['total'] = sprintf($this->lang->line('text_wishlist'), $this->wishlist->getTotalWishlist());
			} else {
			if (!($this->session->userdata('wishlist')!==NULL)) {
					$this->session->set_userdata('wishlist',array());
				}
				$wishlist = $this->session->userdata('wishlist');
				$wishlist[] = $this->input->post('product_id');
				$this->session->set_userdata('wishlist',$wishlist);

				$this->session->set_userdata('wishlist',array_unique($this->session->userdata('wishlist')));
				$json['product_title'] = $product_info['name'];
           
            if ($product_info['image']) {
                $image = $this->image->resize( $product_info['image'], 42, 56  );
            } else {
                $image = $this->image->resize( 'no_image.png', 42, 56 );
            }
            
            $json['product_image'] = "<a href = ".site_url($product_info['seo_keywords'])."><img src =".$image."></img></a>";
				

/*$json['success'] = sprintf($this->lang->line('text_login'), site_url('account/login'), site_url('account/register'), site_url($this->common->getSeoUrl('product_id',$product_info['product_id'])), $product_info['name'], site_url('account/wishlist'));*/
$json['success'] = sprintf($this->lang->line('text_login'), site_url($this->common->getSeoUrl('product_id',$product_info['product_id'])), $product_info['name'], site_url('account/wishlist'));
				$json['total'] = sprintf($this->lang->line('text_wishlist'), (($this->session->userdata('wishlist')!==NULL) ? count($this->session->userdata('wishlist')) : 0));
			}
		}

		echo json_encode($json);
	}
	
	public function remove($id='')
	{
		if ($id!==NULL) {
			// Remove Wishlist
			$this->wishlist->deleteWishlist($id);

			$this->session->set_userdata('success',$this->lang->line('text_remove'));

			redirect(site_url('account/wishlist'));
		}
	}
}
