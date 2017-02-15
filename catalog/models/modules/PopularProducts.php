<?php
/**
 * PopularProducts Class
 * PopularProducts Class Provide a Product list of high rating
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class PopularProducts extends CI_Model 
{
	/**
	* 
	* @function name 	: __construct()
	* @description   	: initialize variables
	* @param   		 	: void
	* @return        	: void
	*
	*/	
	function __construct()
	{
		parent::__construct();
		
	}
	
	/**
	* 
	* @function name 	: index()
	* @description   	: get Popular Products
	* @access 		 	: public
	* @param   		 	: void
	* @return       	: array The PopularProducts
	*
	*/
	public function PopularProducts($category_id='') 
	{
		$this->load->model('catalog/product','product');
		
		$this->load->model('tool/image','image');
		
		$this->load->library('currency');
		
		$this->load->library('tax');
		
		$data['products'] = array();
		
		$results = $this->product->getPopularProducts($this->common->config('config_bestseller_limit'),$category_id);
		
	if ($results) 
	{
		foreach ($results as $result) 
		{
			if ($result['image']) 
			{
				$image = $this->image->resize($result['image'], $this->common->config('config_image_related_width'), $this->common->config('config_image_related_height'));
			} 
			else 
			{

				$image = $this->image->resize('no_image.png', $this->common->config('config_image_product_width'), $this->common->config('config_image_product_height'));
			}

				if (($this->common->config('config_customer_price') && $this->session->userdata('customer_login_status')) || !$this->common->config('config_customer_price')) {
					
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
					$rating = $result['rating'];
				} else {
					$rating = false;
				}

				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => substr(strip_tags(html_entity_decode(ucwords(strtolower($result['name'])), ENT_QUOTES, 'UTF-8')), 0, 28) . '...',
					'description' => substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->common->config('config_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'rating'      => $rating,
					'minimum'     => $result['min_quantity'],
					'href'        => site_url($this->common->getSeoUrl('product_id',$result['product_id']))
				);
			}
//echo '<pre>';print_r($data);
			return $data;
		}
	}
}