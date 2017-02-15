<?php

/**
 * Product_model Model Class
 * Collection of various common function related to Product database operation.
 *
 * @author    Indrajit Kaplatiya
 * @license   http://www.vpninfotech.com/
 */
class Product_model extends CI_Model 
{
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
		parent::__construct();
	}
	
	/**
	* 
	* @function name 	: getProductById()
	* @description   	: get product record by product_id
	* @access 		 	: public
	* @param   		 	: int $product_id The product_id  that you want
	* @return       	: array The selected product_id array
	*
	*/
	public function getProductById($product_id)
        {
            $this->db->from('product');
            $this->db->where('product_id',(int)$product_id);
            $query=$this->db->get();
            return $query->row_array();
        }
	
	/**
	* 
	* @function name 	: addProduct()
	* @description   	: add Product record in database
	* @access 		 	: public
	* @return       	: int last inserted Product record id
	*
	*/
	public function addProduct()
	{
                $is_deleted = $this->input->post('is_deleted');
		if(isset($is_deleted))
		{
   			$is_deleted = 1;
		}
		else
		{
   			$is_deleted = 0;
		}
		//tab-general
		$this->db->set('product_name',$this->input->post('product_name'));
		$this->db->set('product_description',$this->input->post('product_description'));
		$this->db->set('meta_title',$this->input->post('metatag'));
		$this->db->set('meta_description',$this->input->post('metadesc'));
		$this->db->set('meta_keyword',$this->input->post('metakeyword'));
		$this->db->set('product_tag',$this->input->post('p_tag'));
                //tab-data
        $this->db->set('catalog_no',$this->input->post('catalog_no'));
		$this->db->set('model',$this->input->post('model'));
		$this->db->set('sku',$this->input->post('sku'));
		$this->db->set('upc',$this->input->post('upc'));
		$this->db->set('ean',$this->input->post('ean'));
		$this->db->set('jan',$this->input->post('jan'));
		$this->db->set('isbn',$this->input->post('isbn'));
		$this->db->set('mpn',$this->input->post('mpn'));
                $this->db->set('location',$this->input->post('location'));
                $this->db->set('manufacturer_price',$this->input->post('manufacturer_price'));
                $this->db->set('price',$this->input->post('price'));
                $this->db->set('tax_class_id',$this->input->post('tax_class'));
                $this->db->set('quantity',$this->input->post('qty'));
                $this->db->set('min_quantity',$this->input->post('m_qty'));
                $this->db->set('subtract_stock',$this->input->post('subtract'));
                $this->db->set('stock_status_id',$this->input->post('stock_status_id'));
                $this->db->set('shipping',$this->input->post('shipping'));
                $this->db->set('seo_url',$this->input->post('seo_url'));
                $this->db->set('date_available',$this->input->post('date_available'));
                $this->db->set('length',$this->input->post('length'));
                $this->db->set('width',$this->input->post('width'));
                $this->db->set('height',$this->input->post('height'));
                $this->db->set('length_class',$this->input->post('length_class'));
                $this->db->set('weight',$this->input->post('weight'));
                $this->db->set('weight_class',$this->input->post('weight_class'));
                $this->db->set('status',$this->input->post('status'));
                $this->db->set('sort_order',$this->input->post('sort_order'));
                $this->db->set('is_front',$this->input->post('is_front')); 
                $this->db->set('is_deleted',$is_deleted);
                //tab-manufacturer
                $this->db->set('manufacturer_id',$this->input->post('manufacturer_id'));
                
                $this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('Duser_id'));
                $this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('Duser_id'));
		$this->db->insert('product');
                
                $product_id = $this->db->insert_id();
                
                if($this->input->post('image')!== "") {
                    $this->db->set('image',$this->input->post('image'));
                    $this->db->where('product_id',(int)$product_id);
                    $this->db->update('product');
                }
                
                //tab-links
                //Category
                if($this->input->post('product_category') !== NULL) {
                    foreach($this->input->post('product_category') as $category_id) {
                        $this->db->set('product_id',(int)$product_id);
                        $this->db->set('category_id',(int)$category_id);
                        $this->db->insert('product_category');
                    }
                }
                //Filter
                if($this->input->post('product_filter') !== NULL) {
                    foreach($this->input->post('product_filter') as $filter_id) {
                        $this->db->set('product_id',(int)$product_id);
                        $this->db->set('filter_id',(int)$filter_id);
                        $this->db->insert('product_filter');
                    }
                }
                //Downloads
                if($this->input->post('product_download') !== NULL) {
                    foreach($this->input->post('product_download') as $download_id) {
                        $this->db->set('product_id',(int)$product_id);
                        $this->db->set('download_id',(int)$download_id);
                        $this->db->insert('product_download');
                    }
                }
                //Product Related
                if($this->input->post('product_related') !== NULL) {
                    foreach($this->input->post('product_related') as $related_id) {
                        $this->db->set('product_id',(int)$product_id);
                        $this->db->set('related_id',(int)$related_id);
                        $this->db->insert('product_related');
                    }
                }
                
                //tab-attribute
                if($this->input->post('product_attribute')!==NULL) {
                    foreach($this->input->post('product_attribute') as $attribute_id) {
                       if($attribute_id['attribute_id']) {
                            $this->db->set('product_id',(int)$product_id);
                            $this->db->set('attribute_id',(int)$attribute_id['attribute_id']);
                            $this->db->set('text',$attribute_id['text']);
                            $this->db->insert('product_attribute');
                       } 
                    }
                }
                
                
                //tab-option
                if($this->input->post('product_option') !== NULL) {
                    foreach($this->input->post('product_option') as $product_option) {
                       
                        if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
                            if(isset($product_option['product_option_value'])) {
                                $this->db->set('product_id',(int)$product_id);
                                $this->db->set('option_id',(int)$product_option['option_id']);
                                $this->db->set('required',(int)$product_option['required']);
                                $this->db->set('status',$this->input->post('status'));                
                                $this->db->set('is_deleted',$is_deleted);
                                $this->db->set('date_added',date('Y-m-d h:i:sa'));
                                $this->db->set('added_by',$this->session->userdata('Duser_id'));
                                $this->db->set('date_modified',date('Y-m-d h:i:sa'));
                                $this->db->set('modified_by',$this->session->userdata('Duser_id'));
                                $this->db->insert('product_option');
                                
                                $product_option_id = $this->db->insert_id();
                                
                                foreach($product_option['product_option_value'] as $product_option_value) {
                                    $this->db->set('product_option_id',(int)$product_option_id);
                                    $this->db->set('product_id',(int)$product_id);
                                    $this->db->set('option_id',(int)$product_option['option_id']);
                                    $this->db->set('option_value_id',(int)$product_option_value['option_value_id']);
                                    $this->db->set('quantity',$product_option_value['quantity']);
                                    $this->db->set('subtract',$product_option_value['subtract']);
                                    $this->db->set('price',$product_option_value['price']);
                                    $this->db->set('price_prefix',$product_option_value['price_prefix']);
                                    $this->db->set('points',$product_option_value['points']);
                                    $this->db->set('points_prefix',$product_option_value['points_prefix']);
                                    $this->db->set('weight',$product_option_value['weight']);
                                    $this->db->set('weight_prefix',$product_option_value['weight_prefix']);
                                    $this->db->set('status',$this->input->post('status'));                
                                    $this->db->set('is_deleted',$is_deleted);
                                    $this->db->set('date_added',date('Y-m-d h:i:sa'));
                                    $this->db->set('added_by',$this->session->userdata('Duser_id'));
                                    $this->db->set('date_modified',date('Y-m-d h:i:sa'));
                                    $this->db->set('modified_by',$this->session->userdata('Duser_id'));
                                    $this->db->insert('product_option_value');
                                }
                            }
                        } 
                        if ($product_option['type'] == 'date' || $product_option['type'] == 'time' || $product_option['type'] == 'datetime' || $product_option['type'] == 'text' || $product_option['type'] == 'textarea' || $product_option['type'] == 'file') {
                            $this->db->set('product_id',(int)$product_id);
                            $this->db->set('option_id',(int)$product_option['option_id']);
                            $this->db->set('value',$product_option['value']);
                            $this->db->set('required',(int)$product_option['required']);
                            $this->db->set('status',$this->input->post('status'));                
                            $this->db->set('is_deleted',$is_deleted);
                            $this->db->set('date_added',date('Y-m-d h:i:sa'));
                            $this->db->set('added_by',$this->session->userdata('Duser_id'));
                            $this->db->set('date_modified',date('Y-m-d h:i:sa'));
                            $this->db->set('modified_by',$this->session->userdata('Duser_id'));
                            $this->db->insert('product_option');
                        }
                        }
                    }
                
                
                //tab-discount
                if($this->input->post('product_discount') !== NULL) {
                    foreach($this->input->post('product_discount') as $product_discount) {
                        $this->db->set('product_id',(int)$product_id);
                        $this->db->set('customer_group_id',(int)$product_discount['customer_group_id']);
                        $this->db->set('quantity',$product_discount['quantity']);
                        $this->db->set('priority',$product_discount['priority']);
                        $this->db->set('price',$product_discount['price']);
                        $this->db->set('date_start',$product_discount['date_start']);
                        $this->db->set('date_end',$product_discount['date_end']);
                        $this->db->set('status',$this->input->post('status'));                
                        $this->db->set('is_deleted',$is_deleted);
                        $this->db->set('date_added',date('Y-m-d h:i:sa'));
                        $this->db->set('added_by',$this->session->userdata('Duser_id'));
                        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
                        $this->db->set('modified_by',$this->session->userdata('Duser_id'));
                        $this->db->insert('product_discount');
                    }  
                }
                
                //tab-special
                if($this->input->post('product_special') !== NULL) {
                    foreach($this->input->post('product_special') as $product_special) {
                        $this->db->set('product_id',(int)$product_id);
                        $this->db->set('customer_group_id',(int)$product_special['customer_group_id']);                       
                        $this->db->set('priority',$product_special['priority']);
                        $this->db->set('price',$product_special['price']);
                        $this->db->set('date_start',$product_special['date_start']);
                        $this->db->set('date_end',$product_special['date_end']);
                        $this->db->set('status',$this->input->post('status'));                
                        $this->db->set('is_deleted',$is_deleted);
                        $this->db->set('date_added',date('Y-m-d h:i:sa'));
                        $this->db->set('added_by',$this->session->userdata('Duser_id'));
                        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
                        $this->db->set('modified_by',$this->session->userdata('Duser_id'));
                        $this->db->insert('product_special');
                    }  
                }
                
                //tab-image
                if($this->input->post('product_image') !== NULL) {
                    foreach($this->input->post('product_image') as $product_image) {
                        $this->db->set('product_id',(int)$product_id);
                        $this->db->set('image',$product_image['image']);                       
                        $this->db->set('sort_order',$product_image['sort_order']);                        
                        $this->db->insert('product_image');
                    }  
                }
                
		return $this->db->insert_id();
		 
	}
        
        /*public function insertOptionValue($data) {
            if(isset($data) && count($data)>0) {
              
                $this->db->insert('product_option_value',$data);
                return $this->db->insert_id();
            }
        }*/

        /**
	* 
	* @function name 	: editProduct()
	* @description   	: edit Product record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editProduct()
	{
                $is_deleted = $this->input->post('is_deleted');
		if(isset($is_deleted))
		{
   			$is_deleted = 1;
		}
		else
		{
   			$is_deleted = 0;
		}
                
                //tab-general
		$this->db->set('product_name',$this->input->post('product_name'));
		$this->db->set('product_description',$this->input->post('product_description'));
		$this->db->set('meta_title',$this->input->post('metatag'));
		$this->db->set('meta_description',$this->input->post('metadesc'));
		$this->db->set('meta_keyword',$this->input->post('metakeyword'));
		$this->db->set('product_tag',$this->input->post('p_tag'));
                //tab-data
        $this->db->set('catalog_no',$this->input->post('catalog_no'));
		$this->db->set('model',$this->input->post('model'));
		$this->db->set('sku',$this->input->post('sku'));
		$this->db->set('upc',$this->input->post('upc'));
		$this->db->set('ean',$this->input->post('ean'));
		$this->db->set('jan',$this->input->post('jan'));
		$this->db->set('isbn',$this->input->post('isbn'));
		$this->db->set('mpn',$this->input->post('mpn'));
                $this->db->set('location',$this->input->post('location'));
                $this->db->set('manufacturer_price',$this->input->post('manufacturer_price'));
                $this->db->set('price',$this->input->post('price'));
                $this->db->set('tax_class_id',$this->input->post('tax_class'));
                $this->db->set('quantity',$this->input->post('qty'));
                $this->db->set('min_quantity',$this->input->post('m_qty'));
                $this->db->set('subtract_stock',$this->input->post('subtract'));
                $this->db->set('stock_status_id',$this->input->post('stock_status_id'));
                $this->db->set('shipping',$this->input->post('shipping'));
                $this->db->set('seo_url',$this->input->post('seo_url'));
                $this->db->set('date_available',$this->input->post('date_available'));
                $this->db->set('length',$this->input->post('length'));
                $this->db->set('width',$this->input->post('width'));
                $this->db->set('height',$this->input->post('height'));
                $this->db->set('length_class',$this->input->post('length_class'));
                $this->db->set('weight',$this->input->post('weight'));
                $this->db->set('weight_class',$this->input->post('weight_class'));
                $this->db->set('status',$this->input->post('status'));
                $this->db->set('sort_order',$this->input->post('sort_order'));
                $this->db->set('status',$this->input->post('status'));
                $this->db->set('is_front',$this->input->post('is_front'));                 
                $this->db->set('is_deleted',$is_deleted);
                //tab-manufacturer
                $this->db->set('manufacturer_id',$this->input->post('manufacturer_id'));
		
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('Duser_id'));
		$this->db->where('product_id',(int)$this->input->post('product_id'));
                $query = $this->db->update('product');
               
                if($this->input->post('image')!== "") {
                    $this->db->set('image',$this->input->post('image'));
                    $this->db->where('product_id',(int)$this->input->post('product_id'));
                    $this->db->update('product');
                }
                
                //tab-links
                //Category
                $this->db->query("DELETE FROM product_category WHERE product_id = '".(int)$this->input->post('product_id')."'");
                
                if($this->input->post('product_category') !== NULL) {
                    foreach($this->input->post('product_category') as $category_id) {
                        $this->db->set('product_id',(int)$this->input->post('product_id'));
                        $this->db->set('category_id',(int)$category_id);
                        $this->db->insert('product_category');
                    }
                }
                //Filter
                $this->db->query("DELETE FROM product_filter WHERE product_id = '".(int)$this->input->post('product_id')."'");
                
                if($this->input->post('product_filter') !== NULL) {
                    foreach($this->input->post('product_filter') as $filter_id) {
                        $this->db->set('product_id',(int)$this->input->post('product_id'));
                        $this->db->set('filter_id',(int)$filter_id);
                        $this->db->insert('product_filter');
                    }
                }
                //Downloads
                $this->db->query("DELETE FROM product_download WHERE product_id = '".(int)$this->input->post('product_id')."'");
                
                if($this->input->post('product_download') !== NULL) {
                    foreach($this->input->post('product_download') as $download_id) {
                        $this->db->set('product_id',(int)$this->input->post('product_id'));
                        $this->db->set('download_id',(int)$download_id);
                        $this->db->insert('product_download');
                    }
                }
                //Product Related
                $this->db->query("DELETE FROM product_related WHERE product_id = '".(int)$this->input->post('product_id')."'");
                
                if($this->input->post('product_related') !== NULL) {
                    foreach($this->input->post('product_related') as $related_id) {
                        $this->db->set('product_id',(int)$this->input->post('product_id'));
                        $this->db->set('related_id',(int)$related_id);
                        $this->db->insert('product_related');
                    }
                }
                
                //tab-attribute
                $this->db->query("DELETE FROM product_attribute WHERE product_id = '".(int)$this->input->post('product_id')."'");
                
                if($this->input->post('product_attribute')!==NULL) {
                    foreach($this->input->post('product_attribute') as $attribute_id) {
                       if($attribute_id['attribute_id']) {
                            $this->db->set('product_id',(int)$this->input->post('product_id'));
                            $this->db->set('attribute_id',(int)$attribute_id['attribute_id']);
                            $this->db->set('text',$attribute_id['text']);
                            $this->db->insert('product_attribute');
                       } 
                    }
                }
                
                //tab-option
                $this->db->query("DELETE FROM product_option WHERE product_id = '" . (int)$this->input->post('product_id')."'");
		$this->db->query("DELETE FROM product_option_value WHERE product_id = '" . (int)$this->input->post('product_id')."'");
                
                if($this->input->post('product_option') !== NULL) {
                    foreach($this->input->post('product_option') as $product_option) {
                        if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
                            if(isset($product_option['product_option_value'])) {
                                $this->db->set('product_id',(int)$this->input->post('product_id'));
                                $this->db->set('option_id',(int)$product_option['option_id']);
                                $this->db->set('required',(int)$product_option['required']);
                                $this->db->set('date_added',date('Y-m-d h:i:sa'));
                                $this->db->set('status',$this->input->post('status'));                
                                $this->db->set('is_deleted',$is_deleted);
                                $this->db->set('added_by',$this->session->userdata('Duser_id'));
                                $this->db->set('date_modified',date('Y-m-d h:i:sa'));
                                $this->db->set('modified_by',$this->session->userdata('Duser_id'));
                                $this->db->insert('product_option');
                                
                                $product_option_id = $this->db->insert_id();
                                
                                foreach($product_option['product_option_value'] as $product_option_value) {
                                    $this->db->set('product_option_id',(int)$product_option_id);
                                    $this->db->set('product_id',(int)$this->input->post('product_id'));
                                    $this->db->set('option_id',(int)$product_option['option_id']);
                                    $this->db->set('option_value_id',(int)$product_option_value['option_value_id']);
                                    $this->db->set('quantity',$product_option_value['quantity']);
                                    $this->db->set('subtract',$product_option_value['subtract']);
                                    $this->db->set('price',$product_option_value['price']);
                                    $this->db->set('price_prefix',$product_option_value['price_prefix']);
                                    $this->db->set('points',$product_option_value['points']);
                                    $this->db->set('points_prefix',$product_option_value['points_prefix']);
                                    $this->db->set('weight',$product_option_value['weight']);
                                    $this->db->set('weight_prefix',$product_option_value['weight_prefix']);
                                    $this->db->set('status',$this->input->post('status'));                
                                    $this->db->set('is_deleted',$is_deleted);
                                    $this->db->set('date_added',date('Y-m-d h:i:sa'));
                                    $this->db->set('added_by',$this->session->userdata('Duser_id'));
                                    $this->db->set('date_modified',date('Y-m-d h:i:sa'));
                                    $this->db->set('modified_by',$this->session->userdata('Duser_id'));
                                    $this->db->insert('product_option_value');
                                }
                            } 
                        } 
                        if ($product_option['type'] == 'date' || $product_option['type'] == 'time' || $product_option['type'] == 'datetime' || $product_option['type'] == 'text' || $product_option['type'] == 'textarea' || $product_option['type'] == 'file' ) {
                           $this->db->set('product_id',(int)$this->input->post('product_id'));
                            $this->db->set('option_id',(int)$product_option['option_id']);
                            $this->db->set('value',$product_option['value']);
                            $this->db->set('required',(int)$product_option['required']);
                            $this->db->set('status',$this->input->post('status'));                
                            $this->db->set('is_deleted',$is_deleted);
                            $this->db->set('date_added',date('Y-m-d h:i:sa'));
                            $this->db->set('added_by',$this->session->userdata('Duser_id'));
                            $this->db->set('date_modified',date('Y-m-d h:i:sa'));
                            $this->db->set('modified_by',$this->session->userdata('Duser_id'));
                            $this->db->insert('product_option');
                        }
                        }
                    }
                
                
                //tab-discount
                $this->db->query("DELETE FROM product_discount WHERE product_id = '".(int)$this->input->post('product_id')."'");
                if($this->input->post('product_discount') !== NULL) {
                    foreach($this->input->post('product_discount') as $product_discount) {
                        $this->db->set('product_id',(int)$this->input->post('product_id'));
                        $this->db->set('customer_group_id',(int)$product_discount['customer_group_id']);
                        $this->db->set('quantity',$product_discount['quantity']);
                        $this->db->set('priority',$product_discount['priority']);
                        $this->db->set('price',$product_discount['price']);
                        $this->db->set('date_start',$product_discount['date_start']);
                        $this->db->set('date_end',$product_discount['date_end']);
                        $this->db->set('status',$this->input->post('status'));                
                        $this->db->set('is_deleted',$is_deleted);
                        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
                        $this->db->set('modified_by',$this->session->userdata('Duser_id'));
                        $this->db->insert('product_discount');
                    }  
                }
                
                //tab-special
                $this->db->query("DELETE FROM product_special WHERE product_id = '".(int)$this->input->post('product_id')."'");
                if($this->input->post('product_special') !== NULL) {
                    foreach($this->input->post('product_special') as $product_special) {
                        $this->db->set('product_id',(int)$this->input->post('product_id'));
                        $this->db->set('customer_group_id',(int)$product_special['customer_group_id']);                       
                        $this->db->set('priority',$product_special['priority']);
                        $this->db->set('price',$product_special['price']);
                        $this->db->set('date_start',$product_special['date_start']);
                        $this->db->set('date_end',$product_special['date_end']);
                        $this->db->set('status',$this->input->post('status'));                
                        $this->db->set('is_deleted',$is_deleted);
                        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
                        $this->db->set('modified_by',$this->session->userdata('Duser_id'));
                        $this->db->insert('product_special');
                    }  
                }
                
                //tab-image
                $this->db->query("DELETE FROM product_image WHERE product_id = '".(int)$this->input->post('product_id')."'");
                if($this->input->post('product_image') !== NULL) {
                    foreach($this->input->post('product_image') as $product_image) {
                        $this->db->set('product_id',(int)$this->input->post('product_id'));
                        $this->db->set('image',$product_image['image']);                       
                        $this->db->set('sort_order',$product_image['sort_order']);                        
                        $this->db->insert('product_image');
                    }  
                }
                
		return $query;	
	}
	
	
	/**
	* 
	* @function name 	: softDeleteProduct()
	* @description   	: only status change not actual delete Product from database
	* @access 		 	: public
	* @param   		 	: int $product_id The product_id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteProduct($product_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('product_id',(int)$product_id);
		return $this->db->update('product');
	}
	
	/**
	* 
	* @function name 	: deleteProduct()
	* @description   	: delete Product record from database
	* @access 		 	: public
	* @param   		 	: int $product_id The product_id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteProduct($product_id) 
	{	
		$this->db->where('product_id',(int)$product_id);
		$query = $this->db->delete('product');
                
                $this->db->query("DELETE FROM product_attribute WHERE product_id = '".(int)$product_id."'");
                $this->db->query("DELETE FROM product_category WHERE product_id = '".(int)$product_id."'");
                $this->db->query("DELETE FROM product_discount WHERE product_id = '".(int)$product_id."'");
                $this->db->query("DELETE FROM product_filter WHERE product_id = '".(int)$product_id."'");
                $this->db->query("DELETE FROM product_image WHERE product_id = '".(int)$product_id."'");
                $this->db->query("DELETE FROM product_download WHERE product_id = '" . (int)$product_id . "'");
                $this->db->query("DELETE FROM product_related WHERE product_id = '".(int)$product_id."'");
                $this->db->query("DELETE FROM product_special WHERE product_id = '".(int)$product_id."'");
                $this->db->query("DELETE FROM product_option WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM product_option_value WHERE product_id = '" . (int)$product_id . "'");
                $this->db->query("DELETE FROM review WHERE product_id = '" . (int)$product_id . "'");
                return $query;
	} 
	
	
	/**
	* 
	* @function name 	: getProducts()
	* @description   	: get all Product from database
	* @access 		: public
	* @param   		: string $Product The Product that you want to get
	* @return       	: array The selected Product array
	*
	*/
		public function getProducts($data = array())
	{
		
		$sql = "SELECT * FROM product WHERE 1=1";

		$implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "product_name LIKE '%" . $data['filter_name'] . "%'";
		}
		
		if (!empty($data['filter_model'])) {
			$implode[] = "model LIKE '%" . $data['filter_model'] . "%'";
		}
		
		if (!empty($data['filter_price'])) {
			$implode[] = "price LIKE '%" . $data['filter_price'] . "%'";
		}
	
		if(isset($data['filter_quantity']) && $data['filter_quantity']!='')
                //if(!empty($data['filter_status']))
		{
			$implode[] = "quantity ='" . $data['filter_quantity'] . "'";
		
		}
		if(isset($data['filter_status']) && $data['filter_status']!='*' && $data['filter_status']!='')
                //if(!empty($data['filter_status']))
		{
			$implode[] = "status ='" . $data['filter_status'] . "'";
		
		}
		
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}

		$sort_data = array(
                    'product_name','model','price','quantity','status'
		);
	
		if($this->session->userdata('Drole_id')!=1)
		{
			$sql .= " AND is_deleted = 0";
		}
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY product_name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);
                //echo $this->db->last_query();exit;
		$query->result_array();
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalProduct()
	* @description   	: get total no of Product from database
	* @access 		: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalProduct() 
	{
            $sql = "SELECT COUNT(*) AS total FROM product";
            if($this->session->userdata('Drole_id')!=1)
            {
                $sql .= " WHERE is_deleted = 0";
            }
            $query = $this->db->query($sql);

            return $query->row('total');
	}
	
	/**
	* 
	* @function name : getProductCategories()
	* @description   : get product_category record by product_id
	* @access        : public
	* @param1   	 : int $product_id
	* @return        : array
	*
	*/
	public function getProductCategories($product_id) {
            $product_category_data = array();

            $query = $this->db->query("SELECT * FROM product_category WHERE product_id = '" . (int)$product_id . "'");

            foreach ($query->result_array() as $result) {
                $product_category_data[] = $result['category_id'];
            }
            return $product_category_data;
	}
	
	/**
	* 
	* @function name : getProductFilters()
	* @description   : get product_filter record by product_id
	* @access        : public
	* @param1   	 : int $product_id
	* @return        : array
	*
	*/
        
	public function getProductFilters($product_id) {
		$product_filter_data = array();

		$query = $this->db->query("SELECT * FROM product_filter WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->result_array() as $result) {
			$product_filter_data[] = $result['filter_id'];
		}
		return $product_filter_data;
	}
	
	/**
	* 
	* @function name : getProductDownload()
	* @description   : get product_download record by product_id
	* @access        : public
	* @param1   	 : int $product_id
	* @return        : array
	*
	*/        
	public function getProductDownload($product_id) {
		$product_download_data = array();
		
		$query = $this->db->query("SELECT * FROM product_download WHERE product_id = '".(int)$product_id."'");
		
		foreach ($query->result_array() as $result) {
			$product_download_data[] = $result['download_id'];
		}           

		return $product_download_data;
	}
	
	/**
	* 
	* @function name : getProductRelated()
	* @description   : get product_related record by product_id
	* @access        : public
	* @param1   	 : int $product_id
	* @return        : array
	*
	*/ 
        
	public function getProductRelated($product_id) {
		$product_related_data = array();
		
		$query = $this->db->query("SELECT * FROM product_related WHERE product_id = '" . (int)$product_id . "'");
		foreach ($query->result_array() as $result) {
			$product_related_data[] = $result['related_id'];
		}
		
		return $product_related_data;
	}
	
	/**
	* 
	* @function name : getProduct()
	* @description   : get product record by product_id
	* @access        : public
	* @param1   	 : int $product_id
	* @return        : array
	*
	*/ 
        
	public function getProduct($product_id) {
			$product_data = array();
			
			$query = $this->db->query("SELECT * FROM product WHERE product_id = '" . (int)$product_id . "'");
			
			$product_data = $query->result_array();
			
			return $product_data;
	}
	
	/**
	* 
	* @function name : getProductAttributes()
	* @description   : get product_attribute record by product_id
	* @access        : public
	* @param1   	 : int $product_id
	* @return        : array
	*
	*/ 
        
	public function getProductAttributes($product_id) {
		$product_attribute_data = array();
		
		$query = $this->db->query("SELECT * FROM product_attribute WHERE product_id = '".(int)$product_id."'");
		
		$product_attribute_data = $query->result_array();            

		return $product_attribute_data;            
		
	}
    
	/**
	* 
	* @function name : getProductDiscounts()
	* @description   : get product_discount record by product_id
	* @access        : public
	* @param1   	 : int $product_id
	* @return        : array
	*
	*/       
        
	public function getProductDiscounts($product_id) {
			$product_discount = array();
			
	$query = $this->db->query("SELECT * FROM product_discount WHERE product_id = '" . (int)$product_id . "' ORDER BY quantity, priority, price");
	
			$product_discount = $query->result_array();
			
			return $product_discount;
	}
	
	/**
	* 
	* @function name : getProductSpecials()
	* @description   : get product_special record by product_id
	* @access        : public
	* @param1   	 : int $product_id
	* @return        : array
	*
	*/ 
        
	public function getProductSpecials($product_id) {
			$product_special = array();
			
	$query = $this->db->query("SELECT * FROM product_special WHERE product_id = '" . (int)$product_id . "' ORDER BY priority, price");

	$product_special = $query->result_array();
			
			return $product_special;
	}
	
	/**
	* 
	* @function name : getProductImages()
	* @description   : get product_images record by product_id
	* @access        : public
	* @param1   	 : int $product_id
	* @return        : array
	*
	*/ 
        
	public function getProductImages($product_id) {
			$product_image = array();
			
	$query = $this->db->query("SELECT * FROM product_image WHERE product_id = '" . (int)$product_id . "' ORDER BY sort_order ASC");
			
			$product_image = $query->result_array();
			
	return $product_image;
	}
	
	/**
	* 
	* @function name : getProductOptions()
	* @description   : get product_option record by product_id
	* @access        : public
	* @param1   	 : int $product_id
	* @return        : array
	*
	*/ 
        
	public function getProductOptions($product_id) {
		$product_option_data = array();
		
		$product_option_query = $this->db->query("SELECT * FROM product_option po LEFT JOIN `option` o ON (po.option_id = o.option_id) WHERE product_id = '".(int)$product_id."'");   
		
		foreach($product_option_query->result_array() as $product_option) {
			
			$product_option_value_data = array();
			
			$product_option_value_query = $this->db->query("SELECT * FROM product_option_value WHERE product_option_id = '".(int)$product_option['product_option_id']."'");
			
			foreach($product_option_value_query->result_array() as $product_option_value) {
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
			
			$product_option_data[] = array(
				'product_option_id'     => $product_option['product_option_id'],
				'product_option_value'  => $product_option_value_data,
				'option_id'             => $product_option['option_id'],
				'name'                  => $product_option['name'],
				'type'                  => $product_option['type'],
				'value'                 => $product_option['value'],
				'required'              => $product_option['required'],
			);
		} 
		
		return $product_option_data;
	}
		
	/**
	* 
	* @function name : getProductOptionValue()
	* @description   : get product option value record by product_id and product_option_value_id
	* @access        : public
	* @param1   	 : int $product_id
	* @param2		 : int product_option_value_id
	* @return        : array
	*
	*/
	public function getProductOptionValue($product_id, $product_option_value_id) {
		//$query = $this->db->query("SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM product_option_value pov LEFT JOIN option_value ov ON (pov.option_value_id = ov.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_value_id = '" . (int)$product_option_value_id . "'");
		
		$query = $this->db->query("SELECT pov.option_value_id, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM product_option_value pov LEFT JOIN option_value ov ON (pov.option_value_id = ov.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_value_id = '" . (int)$product_option_value_id . "'");

		//return $query->result_array();
		return $query->row_array();
	}
	
	//=== Function for validateDelete || D.07-12-2016 ===
	
	/**
	* 
	* @function name : getTotalProductByCategoryId()
	* @description   : get product record by category_id
	* @access        : public
	* @param   	     : int $category_id
	* @return        : int total no of records
	*
	*/
	public function getTotalProductByCategoryId($category_id) 
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM product_category WHERE category_id = '".(int)$category_id."'");
		return $query->row('total');
	}
	
	/**
	* 
	* @function name : getTotalProductByFilterId()
	* @description   : get product record by filter_id
	* @access        : public
	* @param   	 	 : int $filter_id
	* @return        : int total no of records
	*
	*/
	public function getTotalProductByFilterId($category_id) 
	{
		$getFilterGroupId = $this->db->query("SELECT filter_id FROM filter WHERE filter_group_id = '".(int)$category_id."'");
		$getFilterGroupData = $getFilterGroupId->result_array();
                if($getFilterGroupId->num_rows() > 0) {
                    foreach ($getFilterGroupData as $filterId) {            
                            $sql = "SELECT COUNT(*) AS total FROM category_filter WHERE filter_id = '".(int)$filterId['filter_id']."'";
                            $query = $this->db->query($sql);           
                    } 
                    return $query->row('total');
                }     
	}
	
	/**
	* 
	* @function name 	: getTotalProductsByAttributeId()
	* @description   	: get total no of Product from database
	* @access 		: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalProductsByAttributeId($attribute_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM product_attribute WHERE attribute_id = '" . (int)$attribute_id . "'");
		return $query->row('total');
	}
	
	/**
	* 
	* @function name : getTotalProductsByOptionId()
	* @description   : get product record by $option_id
	* @access        : public
	* @param   	 : int $option_id
	* @return        : int total no of records
	*
	*/
	public function getTotalProductsByOptionId($option_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM product_option WHERE option_id = '" . (int)$option_id . "'");
		return $query->row('total');
	}
	
	/**
	* 
	* @function name : getTotalProductByManufacturerId()
	* @description   : get product record by $manufacturer_id
	* @access        : public
	* @param   	 : int $manufacturer_id
	* @return        : int total no of records
	*
	*/
	public function getTotalProductsByManufacturerId($manufacturer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM product WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");
		return $query->row('total');
	}
	
	/**
	* 
	* @function name : getTotalProductsByDownloadId()
	* @description   : get product record by download_id
	* @access        : public
	* @param   	 : int $download_id
	* @return        : int total no of records
	*
	*/
	public function getTotalProductsByDownloadId($download_id) 
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM product_download WHERE download_id = '" . (int)$download_id . "'");
		return $query->row('total');
	}
	
	/**
	* 
	* @function name : getTotalProductsByStockStatusId()
	* @description   : get product record by $stock_status_id
	* @access        : public
	* @param   	 : int $stock_status_id
	* @return        : int total no of records
	*
	*/
	public function getTotalProductsByStockStatusId($stock_status_id) {
		$sql = "SELECT COUNT(*) AS total FROM product WHERE stock_status_id = '" . (int)$stock_status_id . "'";
		$query = $this->db->query($sql); 
		return $query->row('total');
	}

       
}

?>