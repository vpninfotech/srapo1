<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		$this->_init();
		$this->load->library('tax');
		$this->load->library('mycart');
		$this->load->library('customer');
		$this->lang->load('checkout/cart_lang','english');
		//$this->load->model('weight_model','weight');
	}
	
	private function _init() 
	{
		//--Set Template
		$this->output->set_template('site_template');
		$site_theme = $this->common->config('catalog_theme');
		$this->output->set_common_meta('Cart','sarpo','Cart Page');
	}
	public function index()
	{
		
		/*----------------- Catalog ------------------*/
        $this->load->model('catalog/category_model','category');
        $this->load->model('catalog/product_model','product');
        $this->load->model('tool/image','image');
        /* --------------------------------------------*/


		$this->document->setTitle($this->lang->line('heading_title'));

		
        if ($this->input->post('catalog_no')!==NULL) {
            $catalog_no = $this->input->post('catalog_no');
        } else {
            $catalog_no = '';
        }
        if ($this->input->post('product_id')!==NULL) {
            $product_id = $this->input->post('product_id');
        } else {
            $product_id = '';
        }
        if ($this->input->post('single_product')!==NULL) {
            $single_product = (int) $this->input->post('single_product');
        } else {
            $single_product = '';
        }
        /* --------------------------------------------*/
		
		$this->document->setDescription($this->common->config('config_meta_description'));
		
		$this->document->setKeywords($this->common->config('config_meta_keyword'));
		
		$data['header'] = $this->headers->getHeaders();
		
		$data['breadcrumbs']   	= array();
		
		$data['breadcrumbs'][] 	= array(
		   'text' => 'Home',
		   'href' =>site_url('common/home'),
		 
		  );
		
		$data['breadcrumbs'][] 	= array(
		   'text' => $this->lang->line('heading_title'),
		   'href' =>site_url('checkout/cart'),
		 
		  );

		if ($this->mycart->hasProducts() || !empty($this->session->userdata('vouchers'))) 		{
		
			$data['heading_title'] = $this->lang->line('heading_title');
	
			$data['text_recurring_item'] = $this->lang->line('text_recurring_item');
			$data['text_next'] = $this->lang->line('text_next');
			$data['text_next_choice'] = $this->lang->line('text_next_choice');
	
			$data['column_image'] = $this->lang->line('column_image');
			$data['column_name'] = $this->lang->line('column_name');
			$data['column_model'] = $this->lang->line('column_model');
			$data['column_quantity'] = $this->lang->line('column_quantity');
			$data['column_price'] = $this->lang->line('column_price');
			$data['column_total'] = $this->lang->line('column_total');
	
			$data['button_update'] = $this->lang->line('button_update');
			$data['button_remove'] = $this->lang->line('button_remove');
			$data['button_shopping'] = $this->lang->line('button_shopping');
			$data['button_checkout'] = $this->lang->line('button_checkout');
		
			if (!$this->mycart->hasStock() && 
				(!$this->common->config('config_stock_checkout') || 
				$this->common->config('config_stock_warning'))) 
			{
				$data['error_warning'] = $this->lang->line('error_stock');
			} elseif ($this->session->userdata('error')!==NULL) {
				$data['error_warning'] = $this->session->userdata('error');

				$this->session->set_userdata('error','');
			} else {
				$data['error_warning'] = '';
			}
			
			if ($this->common->config('config_customer_price') && 
			!$this->customer->isLogged()) 
		{
				$data['attention'] = sprintf($this->lang->line('text_login'), site_url('account/login'), site_url('account/register'));
			} else {
				$data['attention'] = '';
			}

			if ($this->session->userdata('success')!==NULL) {
				$data['success'] = $this->session->userdata('success');

				$this->session->set_userdata('success','');
			} else {
				$data['success'] = '';
			}

			$data['action'] = site_url('checkout/cart/edit');
			
			if ($this->common->config('config_cart_weight')) {
				$data['weight'] = $this->weight->format($this->cart->getWeight(), $this->common->config('config_weight_class_id'), $this->lang->line('decimal_point'), $this->lang->line('thousand_point'));
			} else {
				$data['weight'] = '';
			}
			
			$this->load->model('tool/image','image');
			
			$data['products'] = array();

			$products = $this->mycart->getProducts();
			
			foreach ($products as $product) {
				$product_total = 0;
				
				
				
				
				foreach ($products as $product_2) {
					if ($product_2['product_id'] == $product['product_id']) {
						$product_total += $product_2['quantity'];
					}
				}
				
				if ($product['minimum'] > $product_total) {
					$data['error_warning'] = sprintf($this->lang->line('minimum'), $product['name'], $product['minimum']);
				}
		
				if ($product['image']) {
					$image = $this->image->resize($product['image'], $this->common->config('config_image_cart_width'), $this->common->config('config_image_cart_height'));
				} else {
					$image = $this->image->resize('no_image.png', $this->common->config('config_image_cart_width'), $this->common->config('config_image_cart_height'));;
				}

				$option_data = array();
		
				foreach ($product['option'] as $option) {
					if ($option['type'] != 'file') {
						$value = $option['value'];
					} else {
						$upload_info = '';

						if ($upload_info) {
							$value = '';
						} else {
							$value = '';
						}
					}

					$option_data[] = array(
						'name'  => $option['name'],
						'value' => (strlen($value) > 20 ? substr($value, 0, 20) . '..' : $value)
					);
				}
				
				// Display prices
				if (($this->common->config('config_customer_price') && $this->customer->isLogged()) || !$this->common->config('config_customer_price')) {
				
					$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->common->config('config_tax')));
				} else {
					$price = false;
				}
				
				// Display prices
				if (($this->common->config('config_customer_price') && $this->customer->isLogged()) || !$this->common->config('config_customer_price')) {
					$total = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->common->config('config_tax')) * $product['quantity']);
				} else {
					$total = false;
				}
				if($product['catalog_product']==0){
					$url = site_url($this->common->getSeoUrl('product_id',$product['product_id']));
				}
				else
				{
					$url = '';
				}
				$data['products'][] = array(
					'cart_id'   => $product['cart_id'],
					'thumb'     => $image,
					'name'      => $product['name'],
					'model'     => $product['model'],
					'catalog_product'=> $product['catalog_product'],
					'catalog_no'     => $product['catalog_no'],
					'option'    => $option_data,
					'quantity'  => $product['quantity'],
					'stock'     => $product['stock'] ? true : !(!$this->common->config('config_stock_checkout') || $this->common->config('config_stock_warning')),
					'price'     => $price,
					'total'     => $total,
					'href'      => $url
				);
			}
			
			// Gift Voucher
			$data['vouchers'] = array();
	
			if (!empty($this->session->userdata('vouchers'))) {
				foreach ($this->session->userdata('vouchers') as $key => $voucher) {
					$data['vouchers'][] = array(
						'key'         => $key,
						'description' => $voucher['description'],
						'amount'      => $this->currency->format($voucher['amount'], $this->session->userdata('currency')),
						'remove'      => site_url('checkout/cart/remove/'.$key)
					);
				}
			}
			
			// Totals

			$total_data = array();
			$total = 0;
			$taxes = $this->mycart->getTaxes();
		
			// Display prices
			if (($this->common->config('config_customer_price') && $this->customer->isLogged()) || !$this->common->config('config_customer_price')) {
				$sort_order = array();
			
				$results[]=array('code'=>'sub_total');
				$results[]=array('code'=>'shipping');
				$results[]=array('code'=>'tax');
				$results[]=array('code'=>'coupon');
				$results[]=array('code'=>'voucher');
				$results[]=array('code'=>'total');
				
				foreach ($results as $result) {
				
					$this->load->model('api/Total_'.$result['code'].'_model',$result['code'].'_model');
					$model = $result['code'].'_model';
					$this->$model->getTotal($total_data, $total, $taxes);
				
				}
				
			$data['totals'] = array();
			
			foreach ($total_data as $total) {
				$data['totals'][] = array(
					'title' => $total['title'],
					'text'  => $this->currency->format($total['value'], $this->session->userdata('currency'))
				);
			}
		}	
			$data['continue'] = site_url('common/home');

			$data['checkout'] = site_url('checkout/checkout');
			
			$site_theme = $this->common->config('catalog_theme');
		
			$this->load->view("themes/".$site_theme."/checkout/cart",$data);
				
	} else {
		
		
			$data['heading_title'] = $this->lang->line('heading_title');

			$data['text_error'] = $this->lang->line('text_empty');

			$data['button_continue'] = 'Continue';

			$data['continue'] = site_url('common/home');

			$this->session->unset_userdata('success');

			$site_theme = $this->common->config('catalog_theme');
			
			$this->load->view("themes/".$site_theme."/common/error",$data);
	}
			
	
	}
	
	public function addcatalog() {
		$catalog_product = 1;
        $this->output->unset_template();
		$json = array();

		if ($this->input->post('catalog_no')!==NULL) {
			$catalog_no = $this->input->post('catalog_no');
		} else {
			$catalog_no = 0;
		}
		
		/* ----------------  catalog price ---------------*/
		
		if ($this->input->post('product_id')!==NULL) {
			$product_id = (int)$this->input->post('product_id');
		} else {
			$product_id = 0;
		}
		
		if ($this->input->post('category_id')!==NULL) {
			$category_id = (int)$this->input->post('category_id');
		} else {
			$category_id = 0;
		}

		

		$product_info = $this->product->getProduct($product_id);
		
		$product_info['price']=$this->product->getCatalogTotalPrice($catalog_no);
		
		if($catalog_product == '1')
		{
			
			$product_info['special']=$product_info['price']-(($product_info['price']*7)/100);
		}
		else
		{
			$product_info['special']=NULL;
		}
		
		if ($product_info) {
			if ($this->input->post('quantity')!==NULL) {
				$quantity = (int)$this->input->post('quantity');
			} else {
				$quantity = 1;
			}
			$option = array();
			$recurring_id=NULL;
			/*------ catalog data -------------*/
			$catalogdata['catalog_no']=$catalog_no;
			$catalogdata['price']=$product_info['price'];
			$catalogdata['special']=$product_info['special'];
			$catalogdata=$catalogdata;
			/*---------------------------------*/
			
			if (!$json) {
				$data = $this->mycart->add($this->input->post('product_id'), $quantity, $option, $catalogdata,1);

				$this->load->model('tool/image');
                                $success_format = $this->lang->line('text_success');
                               
                                if ($product_info['image']) {
                                    $image = $this->image->resize( $product_info['image'], 42, 56  );
                                } else {
                                    $image = $this->image->resize( 'no_image.png', 42, 56 );
                                }
                                
                                $json['product_image'] = "<a href = ".site_url($product_info['seo_keywords'])."><img src =".$image."></img></a>";
            
				$json['success'] = sprintf($success_format, site_url($this->input->post('path').'/'.$product_info['catalog_no'].'-'.$this->input->post('product_id')), "Full Catalog : ".$product_info['catalog_no'], site_url('checkout/cart'));
				
				
				
				

				// Unset all shipping and payment methods
				$this->session->unset_userdata('shipping_method');
				$this->session->unset_userdata('shipping_methods');
				$this->session->unset_userdata('payment_method');
				$this->session->unset_userdata('payment_methods');
				
				// Totals

				$total_data = array();
				$total = 0;
				$taxes = $this->mycart->getTaxes();
		
				// Display prices
				if (($this->common->config('config_customer_price') && $this->customer->isLogged()) || !$this->common->config('config_customer_price')) {
					$sort_order = array();
				
					$results[]=array('code'=>'sub_total');
					$results[]=array('code'=>'shipping');
					$results[]=array('code'=>'tax');
					$results[]=array('code'=>'coupon');
					$results[]=array('code'=>'voucher');
					$results[]=array('code'=>'total');
				
				foreach ($results as $result) {
				
					$this->load->model('api/Total_'.$result['code'].'_model',$result['code'].'_model');
					$model = $result['code'].'_model';
					$this->$model->getTotal($total_data, $total, $taxes);
				
				}
				
			$data['totals'] = array();
			
			foreach ($total_data as $total) {
				$data['totals'][] = array(
					'title' => $total['title'],
					'text'  => $this->currency->format($total['value'], $this->session->userdata('currency'))
				);
			}
		
			}
			$json['total'] = sprintf($this->lang->line('text_items'), $this->mycart->countProducts() + (($this->session->userdata('vouchers')!==NULL) ? count($this->session->userdata('vouchers')) : 0), $this->currency->format($total['value'], $this->session->userdata('currency')));
			} else {
				$json['redirect'] = site_url($this->common->getSeoUrl('product_id',$product_id));
			}
		}

		echo json_encode($json);
	}
	
	public function add()
	{
		$this->output->unset_template();
		$json = array();
		
		if ($this->input->post('product_id')!==NULL) {
			$product_id = (int)$this->input->post('product_id');
		} else {
			$product_id = 0;
		}
		
		$this->load->model('catalog/product_model','product');
		
		$product_info = $this->product->getProduct($product_id);
		
		
		if ($product_info) {
			if (($this->input->post('quantity')!==NULL) && ((int)$this->input->post('quantity') >= $product_info['min_quantity'])) {
				$quantity = (int)$this->input->post('quantity');
			} else {
				$quantity = $product_info['min_quantity'] ? $product_info['min_quantity'] : 1;
			}

			if ($this->input->post('option')!==NULL) {
				$option = array_filter($this->input->post('option'));
			} else {
				$option = array();
			}
			
			$product_options = $this->product->getProductOptions($this->input->post('product_id'));
			
			foreach ($product_options as $product_option) {
				if ($product_option['required'] && empty($option[$product_option['product_option_id']])) {
					$json['error']['option'][$product_option['product_option_id']] = sprintf($this->lang->line('error_required'), $product_option['name']);
				}
			}
			
			if (!$json) {
				$this->mycart->add($this->input->post('product_id'), $quantity, $option);

				$this->load->model('tool/image');
                                $success_format = $this->lang->line('text_success');
                               
                                if ($product_info['image']) {
                                    $image = $this->image->resize( $product_info['image'], 42, 56  );
                                } else {
                                    $image = $this->image->resize( 'no_image.png', 42, 56 );
                                }
                                
                                $json['product_image'] = "<a href = ".site_url($product_info['seo_keywords'])."><img src =".$image."></img></a>";
            
				$json['success'] = sprintf($success_format, site_url($this->common->getSeoUrl('product_id',$product_info['product_id'])), $product_info['name'], site_url('checkout/cart'));
				
				// Unset all shipping and payment methods
				$this->session->unset_userdata('shipping_method');
				$this->session->unset_userdata('shipping_methods');
				$this->session->unset_userdata('payment_method');
				$this->session->unset_userdata('payment_methods');
				
				// Totals

				$total_data = array();
				$total = 0;
				$taxes = $this->mycart->getTaxes();
		
				// Display prices
				if (($this->common->config('config_customer_price') && $this->customer->isLogged()) || !$this->common->config('config_customer_price')) {
					$sort_order = array();
				
					$results[]=array('code'=>'sub_total');
					$results[]=array('code'=>'shipping');
					$results[]=array('code'=>'tax');
					$results[]=array('code'=>'coupon');
					$results[]=array('code'=>'voucher');
					$results[]=array('code'=>'total');
				
				foreach ($results as $result) {
				
					$this->load->model('api/Total_'.$result['code'].'_model',$result['code'].'_model');
					$model = $result['code'].'_model';
					$this->$model->getTotal($total_data, $total, $taxes);
				
				}
				
			$data['totals'] = array();
			
			foreach ($total_data as $total) {
				$data['totals'][] = array(
					'title' => $total['title'],
					'text'  => $this->currency->format($total['value'], $this->session->userdata('currency'))
				);
			}
		
			}
			$json['total'] = sprintf($this->lang->line('text_items'), $this->mycart->countProducts() + (($this->session->userdata('vouchers')!==NULL) ? count($this->session->userdata('vouchers')) : 0), $this->currency->format($total['value'], $this->session->userdata('currency')));
			} else {
				$json['redirect'] = site_url($this->common->getSeoUrl('product_id',$product_id));
			}
		}
		echo json_encode($json);			
	}
	
	public function edit() {
		
		$json = array();

		// Update
		if (!empty($this->input->post('quantity'))) {
			foreach ($this->input->post('quantity') as $key => $value) {
				echo json_encode($key.'->'.$value);
				$this->mycart->update($key, $value);
			}

			$this->session->set_userdata('success',$this->lang->line('text_remove'));
			
			$this->session->unset_userdata('shipping_method');
			$this->session->unset_userdata('shipping_methods');
			$this->session->unset_userdata('payment_method');
			$this->session->unset_userdata('payment_methods');
			
			redirect(site_url('checkout/cart'));
		}
		echo json_encode($json);
	}
	
	public function remove() {
		$this->output->unset_template();
		$json = array();
		
		if (($this->input->server('REQUEST_METHOD') == 'POST'))  
		{
			// Remove
			if ($this->input->post('key')) 
			{
				$this->mycart->remove($this->input->post('key'));
				if($this->session->userdata('vouchers') !== NULL)
				{
					$vouchers = $this->session->userdata('vouchers');
					unset($vouchers[$this->input->post('key')]);
					$this->session->set_userdata('vouchers', $vouchers);	
				}

				$json['success'] = $this->lang->line('text_success');
				
				$this->session->unset_userdata('shipping_method');
				$this->session->unset_userdata('shipping_methods');
				$this->session->unset_userdata('payment_method');
				$this->session->unset_userdata('payment_methods');
				
			// Totals

				$total_data = array();
				$total = 0;
				$taxes = $this->mycart->getTaxes();
		
				// Display prices
				if (($this->common->config('config_customer_price') && $this->customer->isLogged()) || !$this->common->config('config_customer_price')) {
					$sort_order = array();
				
					$results[]=array('code'=>'sub_total');
					$results[]=array('code'=>'shipping');
					$results[]=array('code'=>'tax');
					$results[]=array('code'=>'coupon');
					$results[]=array('code'=>'voucher');
					$results[]=array('code'=>'total');
				
				foreach ($results as $result) {
				
					$this->load->model('api/Total_'.$result['code'].'_model',$result['code'].'_model');
					$model = $result['code'].'_model';
					$this->$model->getTotal($total_data, $total, $taxes);
				
				}
				
			$data['totals'] = array();
			
			foreach ($total_data as $total) {
				$data['totals'][] = array(
					'title' => $total['title'],
					'text'  => $this->currency->format($total['value'], $this->session->userdata('currency'))
				);
			}
		
			$json['total'] = sprintf($this->lang->line('text_items'), $this->mycart->countProducts() + (($this->session->userdata('vouchers')!==NULL) ? count($this->session->userdata('vouchers')) : 0), $this->currency->format($total['value'], $this->session->userdata('currency')));
	
		}
		}
		}

		echo json_encode($json);
	}
		
}
