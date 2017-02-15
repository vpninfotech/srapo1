<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Headers class
 * Collection of various common function related to Headers.
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Headers 
{
	private $code;
	private $currencies = array();
	
	/**
	* 
	* @function name 	: __construct()
	* @description   	: initialize variables
	* @param   		 	: void
	* @return        	: void
	*
	*/
	public function __construct()	
	{
		// Get the CodeIgniter reference
		$this->_CI =& get_instance();
		$this->_CI->load->library('document');
		$this->_CI->load->model('common');
                $this->_CI->load->library('customer');
                 $this->_CI->load->library('mycart');
		$this->getHeaders();
	}
	
	public function getHeaders()
	{
		$data['title'] = $this->_CI->document->getTitle();
		$data['base'] = site_url();
		$data['description'] = $this->_CI->document->getDescription();
		$data['keywords'] = $this->_CI->document->getKeywords();
		$data['name'] = $this->_CI->common->config('config_store_name');
		
		if (is_file(FCPATH.'image/'. $this->_CI->common->config('config_logo'))) {
			
			$data['logo'] = BASE_URL . 'image/' . $this->_CI->common->config('config_logo');
		} else {
			$data['logo'] = '';
		}

		if (is_file(FCPATH.'image/'. $this->_CI->common->config('config_icon'))) {
			
			$data['favicon'] = BASE_URL . 'image/' . $this->_CI->common->config('config_icon');
		} else {
			$data['favicon'] = '';
		}
		
		// Wishlist
		$this->_CI->lang->load('account/wishlist_lang','english');
			$this->_CI->load->model('account/wishlist_model','wishlist');
		if ($this->_CI->customer->isLogged()) {

			if($this->_CI->session->userdata('wishlist')!==null)
			{
				$data['text_wishlist'] = sprintf($this->_CI->lang->line('text_wishlist'), $this->_CI->wishlist->getTotalWishlist());
			}else
			{ 
				$data['text_wishlist'] = sprintf($this->_CI->lang->line('text_wishlist'), (($this->_CI->session->userdata('wishlist')!==NULL) ? count($this->_CI->session->userdata('wishlist')) : 0));
			}
		}
		else
		{
			$data['text_wishlist'] = sprintf($this->_CI->lang->line('text_wishlist'), (($this->_CI->session->userdata('wishlist')!==NULL) ? count($this->_CI->session->userdata('wishlist')) : 0));
		}
		
		$data['home'] = site_url('common/home');
		$data['wishlist'] = site_url('account/wishlist');
		$data['account'] = site_url('account/account');
		$data['register'] = site_url('account/register');
		$data['login'] = site_url('account/login');
		$data['order'] = site_url('account/order');
                $data['voucher'] = site_url('account/voucher');
		$data['transaction'] = site_url('account/transaction');
		$data['download'] = site_url('account/download');
		$data['logout'] = site_url('account/logout');
		$data['shopping_cart'] = site_url('checkout/cart');
		$data['checkout'] = site_url('checkout/checkout');
		$data['contact'] = site_url('information/contact');
		$data['telephone'] = site_url('config_telephone');
		
                // Totals

			$total_data = array();
			$total = 0;
			$taxes = $this->_CI->mycart->getTaxes();
		
			// Display prices
			if (($this->_CI->common->config('config_customer_price') && $this->_CI->customer->isLogged()) || !$this->_CI->common->config('config_customer_price')) {
				$sort_order = array();
			
				$results[]=array('code'=>'sub_total');
				$results[]=array('code'=>'shipping');
				$results[]=array('code'=>'tax');
				$results[]=array('code'=>'coupon');
				$results[]=array('code'=>'voucher');
				$results[]=array('code'=>'total');
				
				foreach ($results as $result) {
				
					$this->_CI->load->model('api/Total_'.$result['code'].'_model',$result['code'].'_model');
					$model = $result['code'].'_model';
					$this->_CI->$model->getTotal($total_data, $total, $taxes);
				
				}
				
			$data['totals'] = array();
			
			foreach ($total_data as $total) {
				$data['totals'][] = array(
					'title' => $total['title'],
					'text'  => $this->_CI->currency->format($total['value'], $this->_CI->session->userdata('currency'))
				);
			}
		
			}
		
		
		$data['text_items'] = sprintf('%s item(s) - %s', $this->_CI->mycart->countProducts() + (($this->_CI->session->userdata('vouchers')!==NULL) ? count($this->_CI->session->userdata('vouchers')) : 0), $this->_CI->currency->format($total['value']));
 
		// Menu
		$this->_CI->load->model('catalog/Category_model','category');

		$this->_CI->load->model('catalog/Product_model','product');

		$data['categories'] = array();

		$categories = $this->_CI->category->getCategories(0);

		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();
				

				$children = $this->_CI->category->getCategories($category['category_id']);

				foreach ($children as $child) {
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);
					$sub_children_data = array();
					$sub_children = $this->_CI->category->getCategories($child['category_id']);
					foreach ($sub_children as $sub_child) 
					{
						$sub_filter_data = array(
						'filter_category_id'  => $sub_child['category_id'],
						'filter_sub_category' => true
						);
						
						// Level 3
						$sub_children_data[] = array(
						'name'  => $sub_child['category_name'],
						'category_id'=> $sub_child['category_id'],
						'href'  => site_url($category['seo_keywords'].'_'.$child['seo_keywords'].'_'.$sub_child['seo_keywords']),
						'image' => $sub_child['image'],
						);

					}
					// Level 2
					$children_data[] = array(
						'name'  => $child['category_name'],
						'category_id'=> $child['category_id'],
						'children' => $sub_children_data,
						'column'   => $category['columns'] ? $category['columns'] : 1,
						'href'  => site_url($category['seo_keywords'].'_'.$child['seo_keywords']),
						'image' => $child['image'],
						
					);
				}

				// Level 1
				$data['categories'][] = array(
					'name'     => $category['category_name'],
					'category_id'=> $category['category_id'],
					'children' => $children_data,
					'column'   => $category['columns'] ? $category['columns'] : 1,
					'href'     => site_url($category['seo_keywords']),
					'image' => $category['image'],
				);
			}
		}
                //Footer
                //Footer    | Column-1  | Logo and Address
                $data['logo'] = $this->_CI->common->config('config_logo');
                $data['address'] = $this->_CI->common->config('config_address');
                $data['phone'] = $this->_CI->common->config('config_telephone');
                $data['email'] = $this->_CI->common->config('config_email');
                
                //Footer    | Column-2  | Links
                $this->_CI->load->model('catalog/information_model','information');
                
                $data['informations'] = array();
            
                foreach ($this->_CI->information->getInformations() as $result) {
                    if ($result['bottom']) {
                        $data['informations'][] = array(
                            'title'     => $result['title'],
                            'column'    => $result['column'],
                            'href'      => site_url($this->_CI->common->getSeoUrl('information_id',$result['information_id']))
                        );
                    }
                }
                
                $data['sitemap'] = site_url('information/sitemap');
                
                //Footer    | Column-3  | Newsletter and Social
                $data['facebook'] = $this->_CI->common->config('config_facebook_link');
                $data['twitter'] = $this->_CI->common->config('config_twitter_link');
                $data['googleplus'] = $this->_CI->common->config('config_googleplus_link');
                $data['pinterest'] = $this->_CI->common->config('config_pinterest_link');
                $data['instagram'] = $this->_CI->common->config('config_instagram_link');

		return $data;
	}
}