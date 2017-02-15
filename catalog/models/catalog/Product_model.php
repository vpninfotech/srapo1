<?php
/**
 * Product Model Class
 * Collection of various common function related to Product database operation.
 *
 * @author    Nitin Sabhadiya
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
	function __construct()
	{
		parent::__construct();
		
	}
	
	/**
	* 
	* @function name 	: updateViewed()
	* @description   	: Update Product Viewed Count
	* @access 		 	: public
	* @param   		 	: int $product_id The product id that you want to update view
	* @return       	: void
	*
	*/
	public function updateViewed($product_id) 
	{
		$this->db->query("UPDATE product SET viewed = (viewed + 1) WHERE product_id = '" . (int)$product_id . "'");
	}
	
	/**
	* 
	* @function name 	: getProduct()
	* @description   	: get All Details of particular products by product id
	* @access 		 	: public
	* @param   		 	: int $product_id The product id that you want to get data
	* @return       	: Array of Product details
	*
	*/
	public function getProduct($product_id) {
		$query = $this->db->query("SELECT DISTINCT *, p.product_name AS name, p.catalog_no AS catalog,p.catalog_product, p.image, CONCAT_WS(' ',m.firstname,m.lastname) AS manufacturer, (SELECT DISTINCT keyword FROM url_alias WHERE query = 'product_id=" . (int)$product_id . "') AS seo_keywords, (SELECT price FROM product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$this->common->config('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount,(SELECT price FROM product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->common->config('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special,
(SELECT date_start FROM product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->common->config('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special_date_start,
(SELECT date_end FROM product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->common->config('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special_date_end,(SELECT ss.stock_status_name FROM stock_status ss WHERE ss.stock_status_id = p.stock_status_id) AS stock_status,p.weight_class AS weight_class,p.length_class AS length_class,(SELECT AVG(rating) AS total FROM review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating,(SELECT COUNT(*) AS total FROM review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order FROM product p LEFT JOIN manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id = '" . (int)$product_id . "' AND p.status = '1' AND p.date_available <= NOW()");
		

		if ($query->num_rows()) {
			
			return array(
				'product_id'       => $query->row()->product_id,
				'seo_keywords'     => $query->row()->seo_keywords,
				'name'             => $query->row()->product_name,
				'description'      => $query->row()->product_description,
				'meta_title'       => $query->row()->meta_title,
				'meta_description' => $query->row()->meta_description,
				'meta_keyword'     => $query->row()->meta_keyword,
				'tag'              => $query->row()->product_tag,
				'catalog_no'       => $query->row()->catalog_no,
				'catalog_product'  => $query->row()->catalog_product,
				'model'            => $query->row()->model,
				'sku'              => $query->row()->sku,
				'upc'              => $query->row()->upc,
				'ean'              => $query->row()->ean,
				'jan'              => $query->row()->jan,
				'isbn'             => $query->row()->isbn,
				'mpn'              => $query->row()->mpn,
				'location'         => $query->row()->location,
				'quantity'         => $query->row()->quantity,
				'stock_status'     => $query->row()->stock_status,
				'image'            => $query->row()->image,
				'manufacturer_id'  => $query->row()->manufacturer_id,
				'manufacturer'     => $query->row()->manufacturer,
				'price'            => ($query->row()->discount ? $query->row()->discount : $query->row()->price),
				'special'          => $query->row()->special,
                 'special_date_start'=> $query->row()->special_date_start,
				'special_date_end'          => $query->row()->special_date_end,
				'tax_class_id'     => $query->row()->tax_class_id,
				'date_available'   => $query->row()->date_available,
				'weight'           => $query->row()->weight,
				'weight_class'  => $query->row()->weight_class,
				'length'           => $query->row()->length,
				'width'            => $query->row()->width,
				'height'           => $query->row()->height,
				'length_class'  => $query->row()->length_class,
				'subtract'         => $query->row()->subtract_stock,
				'rating'           => round($query->row()->rating),
				'reviews'          => $query->row()->reviews ? $query->row()->reviews : 0,
				'min_quantity'          => $query->row()->min_quantity,
				'sort_order'       => $query->row()->sort_order,
				'status'           => $query->row()->status,
				'date_added'       => $query->row()->date_added,
				'date_modified'    => $query->row()->date_modified,
				'viewed'           => $query->row()->viewed
			);
		} else {
			return false;
		}
	}
	
	/**
	* 
	* @function name 	: getProducts()
	* @description   	: get All products by Filter data
	* @access 		 	: public
	* @param   		 	: Array $data The product Filter data
	* @return       	: Array of Products details
	*
	*/
	public function getProducts($data = array()) {
		$sql = "SELECT p.product_id, (SELECT AVG(rating) AS total FROM review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT price FROM product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$this->common->config('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->common->config('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM category_path cp LEFT JOIN product_category p2c ON (cp.category_id = p2c.category_id)";
			} else {
				$sql .= " FROM product_category p2c";
			}

			if (!empty($data['filter_filter'])) {
				$sql .= " LEFT JOIN product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN product p ON (pf.product_id = p.product_id)";
			} else {
				$sql .= " LEFT JOIN product p ON (p2c.product_id = p.product_id)";
			}
		} else {
			$sql .= " FROM product p";
		}

		$sql .= " WHERE p.status = '1' AND p.date_available <= NOW()";

		if (!empty($data['filter_category_id'])) {
			
			$category_implode = array();
			if (!empty($data['filter_filter'])) {
				$implode = array();
				

				$filters = $data['filter_filter'];

				foreach ($filters as $filter_id) {
					$category_id = substr($filter_id, 0, 1);
					if($category_id == 'c')
					{
						$category_implode[] = (int)ltrim($filter_id, 'c');	
					}
					else
					{
						$implode[] = (int)$filter_id;
					}
					
					
				}
				if($implode)
				{
					$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";	
				}
				
				
			}

			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$category_implode[] = (int)$data['filter_category_id'];
				//$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
				$sql .= " AND p2c.category_id IN (" . implode(',', $category_implode) . ")";
			}
			
		}
		//============== Start : For Catalog ===============
		
		if (!empty($data['catalog_no'])) {
			$sql .= " AND p.catalog_no = '" . $data['catalog_no'] . "'";
		}
		$data['catalog_product']=isset($data['catalog_product'])?$data['catalog_product']:'';
		if (($data['catalog_product']!==NULL) && $data['catalog_product']=='0' || $data['catalog_product']=='1') {
			$sql .= " AND p.catalog_product = '" . (int)$data['catalog_product'] . "'";
		}
		
			$sql .= " AND p.quantity != '0'";
		//============== End : For Catalog ===============
		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "p.product_name LIKE '%" . $word . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR p.product_description LIKE '%" . $data['filter_name']. "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_tag'])));

				foreach ($words as $word) {
					$implode[] = "p.product_tag LIKE '%" . $word. "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.model) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.sku) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.upc) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.ean) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.jan) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.isbn) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.mpn) = '" . strtolower($data['filter_name']) . "'";
			}

			$sql .= ")";
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}
                 if(isset($data['maxPrice']) && isset($data['minPrice']) && $data['maxPrice'] > -1 && $data['minPrice'] > -1)
		{
			$special  = "(SELECT price FROM `product_special` ps WHERE ps.product_id = p.product_id  AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1)";
            $sql .= " AND COALESCE(" . $special . ", p.price) BETWEEN " . $data['minPrice'] . " AND " . $data['maxPrice'] . "";
		}
		if($data['catalog_product']==1)
		{
			$sql .= " GROUP BY p.catalog_no";
		}else
		{
			$sql .= " GROUP BY p.product_id";
		}

		$sort_data = array(
			'pd.name',
			'p.model',
			'p.quantity',
			'p.price',
			'rating',
			'p.sort_order',
			'p.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'p.product_name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} elseif ($data['sort'] == 'p.price') {
				$sql .= " ORDER BY (CASE WHEN special IS NOT NULL THEN special WHEN discount IS NOT NULL THEN discount ELSE p.price END)";
			} else {
				//$sql .= " ORDER BY " . $data['sort'];
				$sql .= " ORDER BY convert(`catalog_no`, decimal) DESC," . $data['sort'];
			}
		} else {
			//$sql .= " ORDER BY p.sort_order";
			$sql .= " ORDER BY convert(catalog_no, decimal) DESC,p.sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(p.product_name) DESC";
		} else {
			$sql .= " ASC, LCASE(p.product_name) ASC";
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

		$product_data = array();
//echo $sql;
		$query = $this->db->query($sql);

		foreach ($query->result_array() as $result) {
			$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
		}

		return $product_data;
	}
	
	/**
	* 
	* @function name 	: getProductSpecials()
	* @description   	: get All products by Filter data
	* @access 		 	: public
	* @param   		 	: Array $data The product Filter data
	* @return       	: Array of Products details
	*
	*/
	public function getProductSpecials($data = array()) {
		$sql = "SELECT DISTINCT ps.product_id, (SELECT AVG(rating) FROM review r1 WHERE r1.product_id = ps.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating FROM product_special ps LEFT JOIN product p ON (ps.product_id = p.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND ps.customer_group_id = '" . (int)$this->common->config('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) GROUP BY ps.product_id";

		$sort_data = array(
			'p.product_name',
			'p.model',
			'ps.price',
			'rating',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'p.product_name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(p.product_name) DESC";
		} else {
			$sql .= " ASC, LCASE(p.product_name) ASC";
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

		$product_data = array();

		$query = $this->db->query($sql);

		foreach ($query->result_array() as $result) {
			$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
		}

		return $product_data;
	}
	
	/**
	* 
	* @function name 	: getLatestProducts()
	* @description   	: get All Latest products by limit
	* @access 		 	: public
	* @param   		 	: int $limit limit of data
	* @return       	: Array of Products details
	*
	*/
	public function getLatestProducts($limit,$category_id='') {

			if($category_id !=='')
			{
				$query = $this->db->query("SELECT p.product_id FROM product p 
					LEFT JOIN `product_category` pc ON (pc.product_id = p.product_id)
					LEFT JOIN `category` c ON (c.category_id = pc.category_id)
					WHERE pc.category_id =" .(int)$category_id. " AND p.status = '1' AND p.date_available <= NOW() ORDER BY p.date_added DESC LIMIT " . (int)$limit);	
		
			}	
			else
			{
				$query = $this->db->query("SELECT p.product_id FROM product p WHERE p.status = '1' AND p.date_available <= NOW() ORDER BY p.date_added DESC LIMIT " . (int)$limit);	
			}
			
			foreach ($query->result_array() as $result) {
				$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
			}
		return $product_data;
	}
	
	/**
	* 
	* @function name 	: getPopularProducts()
	* @description   	: get All Popular products by limit
	* @access 		 	: public
	* @param   		 	: int $limit limit of data
	* @return       	: Array of Products details
	*
	*/
	public function getPopularProducts($limit,$category_id='') 
	{
		$product_data = array();
			if($category_id !=='')
			{
				$query = $this->db->query("SELECT p.product_id FROM product p 
					LEFT JOIN `product_category` pc ON (pc.product_id = p.product_id)
					LEFT JOIN `category` c ON (c.category_id = pc.category_id)
					LEFT JOIN `category_path` cp ON (cp.path_id = pc.category_id)
					WHERE p.status = '1' AND cp.path_id =" .(int)$category_id. " AND p.date_available <= NOW() ORDER BY p.viewed DESC, p.date_added DESC LIMIT " . (int)$limit);
		
			}		
			else
			{
				$query = $this->db->query("SELECT p.product_id FROM product p WHERE p.status = '1' AND p.date_available <= NOW() ORDER BY p.viewed DESC, p.date_added DESC LIMIT " . (int)$limit);
	
			}
			//echo $this->db->last_query();
			foreach ($query->result_array() as $result) {
				$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
			}
			
		return $product_data;
	}
	
	/**
	* 
	* @function name 	: getBestSellerProducts()
	* @description   	: get Best Seller products by limit
	* @access 		 	: public
	* @param   		 	: int $limit limit of data
	* @return       	: Array of Products details
	*
	*/
	public function getBestSellerProducts($limit,$category_id='') {
		
			$product_data = array();
			if($category_id !=='')
			{
				$query = $this->db->query("SELECT op.product_id, SUM(op.quantity) AS total FROM order_product op 
					LEFT JOIN `order` o ON (op.order_id = o.order_id) 
					LEFT JOIN `product` p ON (op.product_id = p.product_id) 
					LEFT JOIN `product_category` pc ON (pc.product_id = p.product_id)
					LEFT JOIN `category` c ON (c.category_id = pc.category_id)
					LEFT JOIN `category_path` cp ON (cp.path_id = pc.category_id)
					WHERE o.order_status_id > 0 AND cp.path_id=" .(int)$category_id. " AND p.status = '1' AND p.date_available <= NOW() GROUP BY op.product_id ORDER BY total DESC LIMIT " . (int)$limit);
			}
			else
			{
					$query = $this->db->query("SELECT op.product_id, SUM(op.quantity) AS total FROM order_product op LEFT JOIN `order` o ON (op.order_id = o.order_id) LEFT JOIN `product` p ON (op.product_id = p.product_id) WHERE o.order_status_id > '0' AND p.status = '1' AND p.date_available <= NOW() GROUP BY op.product_id ORDER BY total DESC LIMIT " . (int)$limit);	
			}

			foreach ($query->result_array() as $result) {
				$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
			}
		return $product_data;
	}
	
	/**
	* 
	* @function name 	: getProductAttributes()
	* @description   	: get product Attributes by product id
	* @access 		 	: public
	* @param   		 	: int $product_id lproduct id
	* @return       	: Array of Products details
	*
	*/
	public function getProductAttributes($product_id) {
		$product_attribute_group_data = array();

		$product_attribute_group_query = $this->db->query("SELECT ag.attribute_group_id, ag.attribute_group_name FROM product_attribute pa LEFT JOIN attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN attribute_group ag ON (a.attribute_group_id = ag.attribute_group_id) WHERE pa.product_id = '" . (int)$product_id . "' GROUP BY ag.attribute_group_id ORDER BY ag.sort_order, ag.attribute_group_name");

		foreach ($product_attribute_group_query->result_array() as $product_attribute_group) {
			$product_attribute_data = array();

			$product_attribute_query = $this->db->query("SELECT a.attribute_id, a.attribute_name, pa.text FROM product_attribute pa LEFT JOIN attribute a ON (pa.attribute_id = a.attribute_id) WHERE pa.product_id = '" . (int)$product_id . "' AND a.attribute_group_id = '" . (int)$product_attribute_group['attribute_group_id'] . "' ORDER BY a.sort_order, a.attribute_name");

			foreach ($product_attribute_query->result_array() as $product_attribute) {
				$product_attribute_data[] = array(
					'attribute_id' => $product_attribute['attribute_id'],
					'name'         => $product_attribute['attribute_name'],
					'text'         => $product_attribute['text']
				);
			}

			$product_attribute_group_data[] = array(
				'attribute_group_id' => $product_attribute_group['attribute_group_id'],
				'name'               => $product_attribute_group['attribute_group_name'],
				'attribute'          => $product_attribute_data
			);
		}

		return $product_attribute_group_data;
	}
	
	/**
	* 
	* @function name 	: getProductOptions()
	* @description   	: get product Options by product id
	* @access 		 	: public
	* @param   		 	: int $product_id lproduct id
	* @return       	: Array of Products details
	*
	*/
	public function getProductOptions($product_id) {
		$product_option_data = array();

		$product_option_query = $this->db->query("SELECT * FROM product_option po LEFT JOIN `option` o ON (po.option_id = o.option_id) WHERE po.product_id = '" . (int)$product_id . "' ORDER BY o.sort_order");

		foreach ($product_option_query->result_array() as $product_option) {
			$product_option_value_data = array();

			$product_option_value_query = $this->db->query("SELECT * FROM product_option_value pov LEFT JOIN option_value ov ON (pov.option_value_id = ov.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' ORDER BY ov.sort_order");

			foreach ($product_option_value_query->result_array() as $product_option_value) {
				$product_option_value_data[] = array(
					'product_option_value_id' => $product_option_value['product_option_value_id'],
					'option_value_id'         => $product_option_value['option_value_id'],
					'name'                    => $product_option_value['name'],
					'image'                   => $product_option_value['image'],
					'quantity'                => $product_option_value['quantity'],
					'subtract'                => $product_option_value['subtract'],
					'price'                   => $product_option_value['price'],
					'price_prefix'            => $product_option_value['price_prefix'],
					'weight'                  => $product_option_value['weight'],
					'weight_prefix'           => $product_option_value['weight_prefix']
				);
			}

			$product_option_data[] = array(
				'product_option_id'    => $product_option['product_option_id'],
				'product_option_value' => $product_option_value_data,
				'option_id'            => $product_option['option_id'],
				'name'                 => $product_option['name'],
				'type'                 => $product_option['type'],
				'value'                => $product_option['value'],
				'required'             => $product_option['required']
			);
		}

		return $product_option_data;
	}
	
	/**
	* 
	* @function name 	: getProductDiscounts()
	* @description   	: get product Discount by product id
	* @access 		 	: public
	* @param   		 	: int $product_id lproduct id
	* @return       	: Array of Products details
	*
	*/
	public function getProductDiscounts($product_id) {
		$query = $this->db->query("SELECT * FROM product_discount WHERE product_id = '" . (int)$product_id . "' AND customer_group_id = '" . (int)$this->common->config('config_customer_group_id') . "' AND quantity > 1 AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity ASC, priority ASC, price ASC");

		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getProductImages()
	* @description   	: get product Images by product id
	* @access 		 	: public
	* @param   		 	: int $product_id lproduct id
	* @return       	: Array of Products details
	*
	*/
	public function getProductImages($product_id) {
		$query = $this->db->query("SELECT * FROM product_image WHERE product_id = '" . (int)$product_id . "' ORDER BY sort_order ASC");

		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getProductRelated()
	* @description   	: get product Related by product id
	* @access 		 	: public
	* @param   		 	: int $product_id lproduct id
	* @return       	: Array of Products details
	*
	*/
	public function getProductRelated($product_id) {
		$product_data = array();

		$query = $this->db->query("SELECT * FROM product_related pr LEFT JOIN product p ON (pr.related_id = p.product_id) WHERE pr.product_id = '" . (int)$product_id . "' AND p.status = '1' AND p.date_available <= NOW()");

		foreach ($query->result_array() as $result) {
			$product_data[$result['related_id']] = $this->getProduct($result['related_id']);
		}

		return $product_data;
	}
	
	/**
	* 
	* @function name 	: getCategories()
	* @description   	: get product Category by product id
	* @access 		 	: public
	* @param   		 	: int $product_id lproduct id
	* @return       	: Array of Products details
	*
	*/
	public function getCategories($product_id) {
		$query = $this->db->query("SELECT * FROM product_category WHERE product_id = '" . (int)$product_id . "'");

		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalProducts()
	* @description   	: get Total Products
	* @access 		 	: public
	* @param   		 	: Array Product filter data
	* @return       	: Array of Products details
	*
	*/
	public function getTotalProducts($data = array()) {
		
		if($data['catalog_product']==1)
		{
			$sql = "SELECT COUNT(DISTINCT p.catalog_no) AS total";
		}
		else
		{
			$sql = "SELECT COUNT(DISTINCT p.product_id) AS total";
		}

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM category_path cp LEFT JOIN product_category p2c ON (cp.category_id = p2c.category_id)";
			} else {
				$sql .= " FROM product_category p2c";
			}

			if (!empty($data['filter_filter'])) {
				$sql .= " LEFT JOIN product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN product p ON (pf.product_id = p.product_id)";
			} else {
				$sql .= " LEFT JOIN product p ON (p2c.product_id = p.product_id)";
			}
		} else {
			$sql .= " FROM product p";
		}

		$sql .= " WHERE p.status = '1' AND p.date_available <= NOW()";

		if (!empty($data['filter_category_id'])) {
			
			$category_implode = array();
			if (!empty($data['filter_filter'])) {
				$implode = array();
				

				$filters = $data['filter_filter'];

				foreach ($filters as $filter_id) {
					$category_id = substr($filter_id, 0, 1);
					if($category_id == 'c')
					{
						$category_implode[] = (int)ltrim($filter_id, 'c');	
					}
					else
					{
						$implode[] = (int)$filter_id;
					}
					
					
				}
				if($implode)
				{
					$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";	
				}
				
				
			}

			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$category_implode[] = (int)$data['filter_category_id'];
				//$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
				$sql .= " AND p2c.category_id IN (" . implode(',', $category_implode) . ")";
			}
			
		}

		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "p.product_name LIKE '%" . $word . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR p.product_description LIKE '%" . $data['filter_name'] . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_tag'])));

				foreach ($words as $word) {
					$implode[] = "p.product_tag LIKE '%" . $word . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.model) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.sku) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.upc) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.ean) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.jan) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.isbn) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.mpn) = '" . strtolower($data['filter_name']) . "'";
			}

			$sql .= ")";
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}
               if(isset($data['maxPrice']) && isset($data['minPrice']) && $data['maxPrice'] > -1 && $data['minPrice'] > -1)
		{
			$special  = "(SELECT price FROM `product_special` ps WHERE ps.product_id = p.product_id  AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1)";
            $sql .= " OR COALESCE(" . $special . ", p.price) BETWEEN " . $data['minPrice'] . " AND " . $data['maxPrice'] . "";
		}
 
		$query = $this->db->query($sql);

		return $query->row()->total;
	}
	
	/**
	* 
	* @function name 	: getTotalProductSpecials()
	* @description   	: get Total Products Special
	* @access 		 	: public
	* @param   		 	: void
	* @return       	: int total number of products
	*
	*/
	public function getTotalProductSpecials() {
		$query = $this->db->query("SELECT COUNT(DISTINCT ps.product_id) AS total FROM product_special ps LEFT JOIN product p ON (ps.product_id = p.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND ps.customer_group_id = '" . (int)$this->common->config('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW()))");

		if (isset($query->row()->total)) {
			return $query->row()->total;
		} else {
			return 0;
		}
	}
	
	public function getCatalogTotalPrice($catalog_no)
	{
		
		$query = $this->db->query("SELECT p.price,(SELECT price FROM product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$this->common->config('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount,(SELECT price FROM product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->common->config('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special FROM product p where catalog_no ='" . $catalog_no . "' AND catalog_product ='1' AND quantity != '0' AND status ='1' ");

		$result=$query->result_array();
		
		//echo '<pre>';print_r($result);
		$total=0;
		foreach($result as $data)
		{

			if($data['special'])
			{
				$total += $data['special'];
			}
			else
			{
				$total += $data['price'];
			}
		}
		
		return $total;	
	}
	
	public function getCatalogProductCount($catalog_no) {
		$product_image=array();
		$query = $this->db->query("SELECT count(*) as total_item FROM product where catalog_no ='" . $catalog_no . "' AND status!='0' ");
		$result=$query->result_array();
		return $result[0]['total_item'];
	}
	
	/**
	* 
	* @function name 	: getTotalProductss()
	* @description   	: get Total Products
	* @access 		 	: public
	* @param   		 	: Array Product filter data
	* @return       	: Array of Products details
	*
	*/
	public function getTotalProductss($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.product_id) AS total";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM category_path cp LEFT JOIN product_category p2c ON (cp.category_id = p2c.category_id)";
			} else {
				$sql .= " FROM product_category p2c";
			}

			if (!empty($data['filter_filter'])) {
				$sql .= " LEFT JOIN product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN product p ON (pf.product_id = p.product_id)";
			} else {
				$sql .= " LEFT JOIN product p ON (p2c.product_id = p.product_id)";
			}
		} else {
			$sql .= " FROM product p";
		}

		$sql .= " WHERE p.status = '1' AND p.date_available <= NOW()";

		if (!empty($data['filter_category_id'])) {
			
			$category_implode = array();
			if (!empty($data['filter_filter'])) {
				$implode = array();
				

				$filters = $data['filter_filter'];

				foreach ($filters as $filter_id) {
					$category_id = substr($filter_id, 0, 1);
					if($category_id == 'c')
					{
						$category_implode[] = (int)ltrim($filter_id, 'c');	
					}
					else
					{
						$implode[] = (int)$filter_id;
					}
					
					
				}
				if($implode)
				{
					$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";	
				}
				
				
			}

			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$category_implode[] = (int)$data['filter_category_id'];
				//$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
				$sql .= " AND p2c.category_id IN (" . implode(',', $category_implode) . ")";
			}
			
		}
		//======  Start : catalog product  ================
		if (!empty($data['catalog_no'])) {
			$sql .= " AND p.catalog_no = '" . $data['catalog_no'] . "'";
		}
		
		if (isset($data['catalog_product']) && $data['catalog_product']=='0' || $data['catalog_product']=='1') {
			$sql .= " AND p.catalog_product = '" . (int)$data['catalog_product'] . "'";
		}
		//======  End : catalog product  ================
		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "p.product_name LIKE '%" . $word . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR p.product_description LIKE '%" . $data['filter_name'] . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_tag'])));

				foreach ($words as $word) {
					$implode[] = "p.product_tag LIKE '%" . $word . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.model) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.sku) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.upc) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.ean) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.jan) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.isbn) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.mpn) = '" . strtolower($data['filter_name']) . "'";
			}

			$sql .= ")";
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}
               if(isset($data['maxPrice']) && isset($data['minPrice']) && $data['maxPrice'] > -1 && $data['minPrice'] > -1)
		{
			$special  = "(SELECT price FROM `product_special` ps WHERE ps.product_id = p.product_id  AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1)";
            $sql .= " OR COALESCE(" . $special . ", p.price) BETWEEN " . $data['minPrice'] . " AND " . $data['maxPrice'] . "";
		}
 
		$query = $this->db->query($sql);

		return $query->row()->total;
	}
	
	/**
	* 
	* @function name 	: getProductss()
	* @description   	: get All products by Filter data
	* @access 		 	: public
	* @param   		 	: Array $data The product Filter data
	* @return       	: Array of Products details
	*
	*/
	public function getProductss($data = array()) {
		$sql = "SELECT p.product_id, (SELECT AVG(rating) AS total FROM review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT price FROM product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$this->common->config('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->common->config('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM category_path cp LEFT JOIN product_category p2c ON (cp.category_id = p2c.category_id)";
			} else {
				$sql .= " FROM product_category p2c";
			}

			if (!empty($data['filter_filter'])) {
				$sql .= " LEFT JOIN product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN product p ON (pf.product_id = p.product_id)";
			} else {
				$sql .= " LEFT JOIN product p ON (p2c.product_id = p.product_id)";
			}
		} else {
			$sql .= " FROM product p";
		}

		$sql .= " WHERE p.status = '1' AND p.date_available <= NOW()";

		if (!empty($data['filter_category_id'])) {
			
			$category_implode = array();
			if (!empty($data['filter_filter'])) {
				$implode = array();
				

				$filters = $data['filter_filter'];

				foreach ($filters as $filter_id) {
					$category_id = substr($filter_id, 0, 1);
					if($category_id == 'c')
					{
						$category_implode[] = (int)ltrim($filter_id, 'c');	
					}
					else
					{
						$implode[] = (int)$filter_id;
					}
					
					
				}
				if($implode)
				{
					$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";	
				}
				
				
			}

			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$category_implode[] = (int)$data['filter_category_id'];
				//$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
				$sql .= " AND p2c.category_id IN (" . implode(',', $category_implode) . ")";
			}
			
		}
		
		//============== Start : For Catalog ===============
		
		if (!empty($data['catalog_no'])) {
			$sql .= " AND p.catalog_no = '" . $data['catalog_no'] . "'";
		}
		
		if (($data['catalog_product']!==NULL) && $data['catalog_product']=='0' || $data['catalog_product']=='1') {
			$sql .= " AND p.catalog_product = '" . (int)$data['catalog_product'] . "'";
		}
		
			$sql .= " AND p.quantity != '0'";
		//============== End : For Catalog ===============
			
		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "p.product_name LIKE '%" . $word . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR p.product_description LIKE '%" . $data['filter_name']. "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_tag'])));

				foreach ($words as $word) {
					$implode[] = "p.product_tag LIKE '%" . $word. "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.model) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.sku) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.upc) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.ean) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.jan) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.isbn) = '" . strtolower($data['filter_name']) . "'";
				$sql .= " OR LCASE(p.mpn) = '" . strtolower($data['filter_name']) . "'";
			}

			$sql .= ")";
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}
                 if(isset($data['maxPrice']) && isset($data['minPrice']) && $data['maxPrice'] > -1 && $data['minPrice'] > -1)
		{
			$special  = "(SELECT price FROM `product_special` ps WHERE ps.product_id = p.product_id  AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1)";
            $sql .= " AND COALESCE(" . $special . ", p.price) BETWEEN " . $data['minPrice'] . " AND " . $data['maxPrice'] . "";
		}
		
		if (isset($data['catalog_product']) && $data['catalog_product'] == '1')		
		{				
		    $sql .= " GROUP BY p.product_id";		
		}		
		else		
		{		
			$sql .= " GROUP BY p.catalog_no";			
		}		
		
		
		$sort_data = array(
			'pd.name',
			'p.model',
			'p.quantity',
			'p.price',
			'rating',
			'p.sort_order',
			'p.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'p.product_name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} elseif ($data['sort'] == 'p.price') {
				$sql .= " ORDER BY (CASE WHEN special IS NOT NULL THEN special WHEN discount IS NOT NULL THEN discount ELSE p.price END)";
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(p.product_name) DESC";
		} else {
			$sql .= " ASC, LCASE(p.product_name) ASC";
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

		$product_data = array();
        //echo $sql;
		$query = $this->db->query($sql);

		foreach ($query->result_array() as $result) {
			$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
		}

		return $product_data;
	}
	
	public function getProductAllImages($catalog_no) {
		$product_image=array();
		$query = $this->db->query("SELECT * FROM product where catalog_no ='" . $catalog_no . "' ORDER BY sort_order ASC");
		
		return $query->result_array();
	}
}