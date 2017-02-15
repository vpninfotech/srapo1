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
	* @function name 	: editProduct()
	* @description   	: edit Product record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editProduct()
	{    
            $this->db->set('quantity',$this->input->post('qty'));
            $this->db->set('date_modified',date('Y-m-d h:i:sa'));
            $this->db->set('modified_by',$this->session->userdata('manufacturer_user_id'));
            $this->db->where('product_id',(int)$this->input->post('product_id'));
            $query = $this->db->update('product');
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
            $sql ="SELECT * FROM product WHERE manufacturer_id = '".$this->session->userdata('manufacturer_user_id')."'";
		   
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
	
            if($this->session->userdata('manufacturer_user_id')!=1)
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
            if($this->session->userdata('manufacturer_user_id')!=1)
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
		$query = $this->db->query("SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM product_option_value pov LEFT JOIN option_value ov ON (pov.option_value_id = ov.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_value_id = '" . (int)$product_option_value_id . "'");

		return $query->result_array();
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