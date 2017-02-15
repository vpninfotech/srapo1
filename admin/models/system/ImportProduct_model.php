<?php

/**
 * ImportProduct Model Class
 * Collection of various common function related to Upload Bulk Product in database  
 * operation
 *
 * @author    Nitin Sabhadiya,Mitesh
 * @license   http://www.vpninfotech.com/
 */
class ImportProduct_model extends CI_Model 
{
	//data
	public $data = array();
	// constants
	public $sec_per_cycle    = 10;
	public $enclosure        = '"';
	//	protected $escape           = '\\'; - not supported;
	public $default_attribute_group_name = 'unassigned';
	public $curl_resolve_attempts = 3;

	public $extended_types          = array('select', 'radio', 'checkbox', 'image');
	public $options_with_def_values = array('text', 'textarea', 'date', 'time', 'datetime');
	public $option_types            = array('select', 'radio', 'checkbox', 'image', 'text', 'textarea',
	                                     'file', 'date', 'time', 'datetime');
	public $options_with_images     = array('select', 'radio', 'checkbox', 'image');

	public $record_types = array(
		'product_option_id' => 1,
		'product_option_value_id' => 2,
	);
	
	public $delimiters = array(
		"\t"   => 'tab',
		";"  => 'semicolon ";"',
		','  => 'comma ","',
		'|'  => 'pipe "|"',
		' '  => 'space " "',
	);
	
	// session variables
	public $stat;

	//temporary vaiables
	public $columns;
	public $messages;
	public $kalog = null;
	public $default_attribute_group_id;
	public $product_mark = ''; // current product identfier in format like '(model: MK1233): '
	public $kaformat;
	
	public $key_fields = null;
	public $org_error_handler = null;
	private $params= array();
		
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
	
	/*
		TRUE  - success
		FALSE - fail. See lastError for details.
	*/
	public function openFile($params){
		
		if (empty($params['file']) || !is_file($params['file'])) {
			$this->lastError = "File '" . $params['file'] ."' does not exist.";
			return false;
		}

		$this->params = $params;
		
		$options = array();
		
		if (!empty($params['opt_enable_macfix'])) {
			$options['enable_macfix'] = true;
		}
		//print_r($options);exit;
		//if (!$this->file->fopen($params['file'], 'r', $options, $params['charset'])) {
		if (!$this->kafileutf8->fopen($params['file'], 'r', $options)) {
		//if (!fopen($params['file'], 'r')) {
			//$this->lastError = $this->file->getLastError();
			$this->lastError = $this->kafileutf8->getLastError();
			return false;
		}
		
		return true;
	}
	
	public function readColumns($delimiter) {
		//if (empty($this->file->handle)) {
			
		if (empty($this->kafileutf8->handle)) {
			
			//$this->lastError = "readColumns: file handle is not valid.";
			$this->error['warning']="readColumns: file handle is not valid.";
			return false;
		}
	
		//rewind($this->file->handle);
		rewind($this->kafileutf8->handle);
		//$columns = fgetcsv($this->file->handle, 0, $delimiter, $this->enclosure);
		$columns = fgetcsv($this->kafileutf8->handle, 0, $delimiter, $this->enclosure);
		
		if (empty($columns)) {
			return false;
		}
				
		foreach ($columns as &$cv) {
			$cv = trim($cv);
		}
	
    	return $columns;
	}
	
	/*
		get product information from the row.

		RETURNS:
			product_id - if product exists
			false      - if product does NOT exist
			
		    lastError  - message. If it is set, the product will not be imported!
	*/
	public function getProductId($data) {
		$this->lastError = '';
		// get product_id. It finds an existing product or creates a new one.

		$where = array();

		if (!empty($data['product_id'])) {
		
			$where[] = "product_id='" . (int)$data['product_id'] . "'";
			
		} else {
		
			if (isset($data['model']) && in_array('model', $this->key_fields)) {
				if (!empty($this->params['field_lengths']['model'])) {
					if (utf8_strlen($data['model']) > $this->params['field_lengths']['model']) {
						$this->lastError = 'Model field (' . $data['model'] . ') exceeds the maximum field size(' .
							$this->params['field_lengths']['model'] ."). Product is skipped.";
					};
				}				
				$where[] = "model='" . $data['model'] . "'";
			}

			if (isset($data['sku']) && in_array('sku', $this->key_fields)) {
				if (!empty($this->params['field_lengths']['sku'])) {
					if (utf8_strlen($data['sku']) > $this->params['field_lengths']['sku']) {
						$this->lastError = 'SKU field (' . $data['sku'] . ') exceeds the maximum field size(' .
							$this->params['field_lengths']['sku'] ."). Product is skipped.";
					};
				}				
				$where[] = "sku='" . $data['sku'] . "'";
			}
			
			if (isset($data['upc']) && in_array('upc', $this->key_fields)) {
				if (!empty($this->params['field_lengths']['upc'])) {
					if (utf8_strlen($data['upc']) > $this->params['field_lengths']['upc']) {
						$this->lastError = 'UPC field (' . $data['upc'] . ') exceeds the maximum field size(' .
							$this->params['field_lengths']['upc'] ."). Product is skipped.";
					};
				}				
				$where[] = "upc='" . $data['upc'] . "'";
			}
		}
		
		if (empty($where)) {
			$this->lastError = 'key fields are empty';
			return false;
		}

		$query_sel = $this->db->query("SELECT product_id FROM product AS p WHERE " . implode(" AND ", $where));
		$sel=$query_sel->row_array();
		$product_id = (isset($sel['product_id'])) ?$sel['product_id'] : 0;

		return $product_id;
	}
	
	/*public function Imports()
	{
		
		//$this->updateProducts($product_id, $data, $delete_old, $is_new);	
		$this->updateProduct($product_id, $data, $is_new);
		
		$this->saveCategories($product_id, $data, $delete_old, $is_new);
	
		$this->saveAdditionalImages($product_id, $data, $delete_old, $is_new);
	
		$this->saveAttributes($row, $product, $delete_old, $is_first_product);
		
		$this->saveFilters($row, $product, $delete_old);
	
		$this->saveOptions($row, $product, $delete_old);
	
		$this->saveDiscounts($row, $product, $delete_old);
	
		$this->saveSpecials($row, $product, $delete_old);
	
		//$this->saveRewardPoints($row, $product, $delete_old);
						
		$this->saveRelatedProducts($data, $product, $delete_old);
		
		$this->saveDownloads($data, $product, $delete_old);
		
		$this->saveReviews($row, $product, $delete_old);
	}*/
	
	//public function updateProducts($product_id, $data, $delete_old, $is_new){}
	public function updateProduct($product_id, $data, $is_new){
		
		if (empty($product_id)) {
			return false;
		}

		$product = array();

		// set the product status
		//
		if (isset($data['status'])) {
			$product['status'] = (in_array($data['status'], array('1','Y'))) ? 1 : 0;

		} elseif ($is_new) {

			// keep in mind: the option can have an empty value
			//
			if ($this->params['status_for_new_products'] == 'enabled') {
				$product['status'] = 1;
			} elseif ($this->params['status_for_new_products'] == 'disabled') {
				$product['status'] = 0;
			} else {
				if (!empty($data['quantity']) && $data['quantity'] > 0) {
					$product['status'] = 1;
				} else {
					$product['status'] = 0;
				}
			}

		} else {
			// keep in mind: the option can have an empty value
			//
			if ($this->params['status_for_existing_products'] == 'enabled') {
				$product['status'] = 1;
			} elseif ($this->params['status_for_existing_products'] == 'disabled') {
				$product['status'] = 0;
			} elseif ($this->params['status_for_existing_products'] == 'enabled_gt_0') {
				if (!empty($data['quantity']) && $data['quantity'] > 0) {
					$product['status'] = 1;
				} elseif (isset($data['quantity']) && strlen(trim($data['quantity']))) {
					$product['status'] = 0;
				}
			}
		}

		// get a manufacturer id
		//
		if (isset($data['manufacturer'])) {
			$query_sel = $this->db->query("SELECT manufacturer_id FROM manufacturer AS m WHERE firstname='" . $data['manufacturer'] . "'");
			$sel=$query_sel->row_array();
			if (!empty($sel['manufacturer_id'])) {
				$manufacturer_id = $sel['manufacturer_id'];
			} elseif (!empty($data['manufacturer'])) {
				$rec = array(
					'name' => $data['manufacturer'],
				);
				$manufacturer_id = $this->kadb->queryInsert("manufacturer", $rec);
			} else {
				$manufacturer_id = 0;
			}
			$product['manufacturer_id'] = $manufacturer_id;

			// insert a new manufacturer to the stores
			//
			/*if (!empty($manufacturer_id)) {
				if (!$this->insertToStores('manufacturer', $manufacturer_id, $this->params['store_ids'])) {
					$this->addImportMessage("Saving the record to stores has failed");
				}
			}*/
		}

		// get a tax class id
		//
		if (isset($data['tax_class'])) {
			$query_sel = $this->db->query("SELECT tax_class_id FROM tax_class AS t WHERE title='" . $data['tax_class'] . "'");
			$sel=$query_sel->row_array();
			if (empty($sel) && !empty($data['tax_class'])) {
				$this->addImportMessage($this->product_mark . "Tax class name '$data[tax_class]' not found");
			}
			$tax_class_id = (isset($sel['tax_class_id'])) ?$sel['tax_class_id'] : 0;
			$product['tax_class_id'] = $tax_class_id;
		}

		// Weight. Sample value: 10.000Kg
		//
		$product['weight_class_id'] = $this->common->config('config_weight_class_id');
		/*if (isset($data['weight'])) {
			$pair = $this->kaformat->parseWeight($data['weight']);
			$product['weight']          = $pair['value'];
			$product['weight_class_id'] = $pair['weight_class_id'];
		} elseif ($is_new) {
			$product['weight_class_id'] = $this->common->config('config_weight_class_id');
		}*/

		// Dimensions. Sample value: 23.07Cm
		//
		$length_params = array('length', 'height', 'width');
		
		foreach ($length_params as $lv) {
			$product['length_class_id'] = $this->common->config('config_length_class_id');
			/*if (isset($data[$lv])) {
				$pair = $this->kaformat->parseLength($data[$lv]);
				$product[$lv]               = $pair['value'];
				$product['length_class_id'] = $pair['length_class_id'];
			} elseif ($is_new) {
				$product['length_class_id'] = $this->common->config('config_length_class_id');
			}*/
		}
		
		// insert the product to the selected store
		//
	    /*if (!$this->insertToStores('product', $product_id, $this->params['store_ids'])) {
    		$this->addImportMessage("Saving the record to stores has failed");
	    }

		$this->updateProductDescription($product_id, $data);*/
				
		// stock status
		//
		if (!empty($data['stock_status'])) {
			$qry = $this->db->query("SELECT stock_status_id FROM stock_status WHERE '" . utf8_strtolower($data['stock_status'], 'utf-8') . "' LIKE LOWER(name)");
					
			if (empty($qry->row)) {
				$this->addImportMessage($this->product_mark . "stock status not found - $data[stock_status]");
				if ($is_new) {
					$product['stock_status_id'] = $this->common->config('config_stock_status_id');
				}
			} else {
				$product['stock_status_id'] = $qry->row['stock_status_id'];
			}
		} elseif ($is_new) {
			$product['stock_status_id'] = $this->common->config('config_stock_status_id');
		}

		// update price
		//
		if (isset($data['price']) && strlen($data['price'])) {
			//$product['price'] = $this->kaformat->formatPrice($data['price']);
			$product['price'] = $this->formatPrice($data['price']);
			if (!empty($this->params['price_multiplier'])) {
				$product['price'] = $product['price'] * $this->params['price_multiplier'];
			}
		}

		// insert an image
		//
		if (isset($data['image'])) {
			if (!empty($data['image'])) {
				$file = $this->getImageFile($data['image']);
				if ($file === false) {
					if (!empty($this->lastError)) {
						$this->addImportMessage($this->product_mark . "image cannot be saved - " . $this->lastError);
					}
				} elseif (!empty($file)) {
					$product['image'] = $file;
				}
			} else {
				$product['image'] = '';
			}
		}

		// insert date available
		//
		if (!empty($data['date_available'])) {
			if (!$this->kaformat->formatDate($data['date_available'])) {
				$this->addImportMessage($this->product_mark . "Wrong date format in 'date available' field. We recommend to use YYYY-MM-DD. Ex. 2012-11-28");
				if ($is_new) {
					$product['date_available'] = '2000-01-01';
				}
			} else {
				if ($data['date_available'] != '0000-00-00') {
					$product['date_available'] = $data['date_available'];
				} else {
					$product['date_available'] = '2000-01-01';
				}
			}
		} elseif ($is_new) {
			$product['date_available'] = '2000-01-01';
		}
		
		$this->kadb->queryUpdate('product', $product, "product_id='$product_id'");

		// insert seo keyword
		//		
		if (isset($data['seo_keyword']) || !empty($this->params['opt_generate_seo_keyword'])) {
	
			/*if (!empty($data['seo_keyword'])) {
				$this->db->query("DELETE FROM url_alias WHERE query = 'product_id=" . $product_id. "'");
				
			} elseif (!empty($this->params['opt_generate_seo_keyword'])) {
				$qry = $this->db->query("SELECT url_alias_id FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . $product_id. "'");

				if (empty($qry->row) && !empty($lang['name'])) {
					$data['seo_keyword'] = $this->generateProductUrl($product_id, $lang['name']);
					if (empty($data['seo_keyword'])) {
						$this->addImportMessage($this->product_mark . "Unable to generate SEO friendly URL for product ($lang[name])");
					}
				}
			}*/
			
			if (!empty($data['seo_keyword'])) {
				$this->db->query("INSERT INTO product SET query = 'product_id=" . (int)$product_id . "', seo_url = '" . $data['seo_keyword'] . "'");
			}
		}

		// produt layout
		//		
		/*if (isset($data['layout'])) {
			$qry = $this->db->query('SELECT * FROM ' . DB_PREFIX . "layout WHERE
				name = '" . $this->db->escape($data['layout']) . "'"
			);
			
			if (!empty($qry->row['layout_id'])) {
				$layout_id = $qry->row['layout_id'];
			} else {
				$layout_id = 0;
			}
			
			foreach ($this->params['store_ids'] as $store_id) {
				$this->db->query("REPLACE INTO " . DB_PREFIX . "product_to_layout SET
					product_id = '" . (int)$product_id . "', 
					store_id   = '" . (int)$store_id . "', 
					layout_id  = '" . (int)$layout_id . "'"
				);
			}
		}*/

		return true;
	}
	
	/* 
	* save Categories
	*/
	public function saveCategories($product_id, $row, $data) {

		//echo $product_id."<br>";
		
		/*echo "<pre>";
		print_r($row);
		print_r($data);
		echo "</pre>";*/		
		
		//echo $data['category_name'];
		//echo "cat_sepetrator: ".$this->params['cat_separator'];
		
		$save_params=$this->session->userdata('save_params');
		$this->params=$save_params;
		$params = $this->params;
		
		/*echo "<pre>";
		print_r($save_params);
		echo "</pre>";
		exit;*/
	/*	echo $this->params['import_mode'];
		exit;*/
		$delete_old       = true;  
		if($this->params['import_mode'] == 'replace')
		{
			$is_first_product = true;		// first occurence of the product in the file
			$delete_old       = false;  	// delete product_category according to product id
		}
	/*	else
		{
			$is_first_product = false;		// first occurence of the product in the file
			$delete_old       = true;  	// delete product_category according to product id
		}*/
		
		$data['category']=$row[$data['category_name']];		
		//echo $data['category']."<br>";
			
		//exit;

		$category_assigned = false;
		
		if (!empty($data['category'])) {
			if ($delete_old) {
				$this->db->query("DELETE FROM product_category WHERE product_id = '".(int)$product_id."'");
			}			
		}
		
		//$multicat_sep = $this->params['cat_separator'];
		//$save_params['params']['multicat_sep']  = ":::";
		$multicat_sep =":::";
		$cats_list    = array();	
		
		
		// assign categories by category_id
		//
		if (!empty($data['category_id'])) {

			if (!empty($multicat_sep)) {
				$cats_list = explode($multicat_sep, $data['category_id']);	
			} else {
				$cats_list = array($data['category_id']);
			}
			foreach ($cats_list as $cat) {
				$cat = (int)$cat;
				$qry_category = $this->db->query("SELECT category_id FROM category WHERE category_id = '" . $cat . "'");
				$qry=$qry_category->row_array();
				if ($qry_category->num_rows()>0) {
				//if (!empty($qry->row)) {
					$rec = array(
						'product_id'  => $product_id,
						'category_id' => $qry['category_id'],
					);
					$this->kadb->queryInsert('product_category', $rec, true);
					$category_assigned = true;
				} else {
					$this->addImportMessage($this->product_mark . " category ID not found '$cat'");
				}
			}
		}

		
		// assign categories by name
		//				
		if (!empty($data['category'])) {

			// insert categories
			//
			if (!empty($data['category'])) {
				if (!empty($multicat_sep)) {
					$cats_list = explode($multicat_sep, $data['category']);
				} else {
					$cats_list = array($data['category']);
				}
				
				foreach ($cats_list as $cat) {
					if ($this->saveCategory($product_id, $cat)) {
						$category_assigned = true;
					}
					
				}
			}
		}

		// assign the default category for new products if no categories were assigned
		//
		/*if (!$category_assigned && $is_new) {
			if (!empty($this->params['default_category_id'])) {
				$category_id = $this->params['default_category_id'];
				$rec = array(
					'product_id'  => $product_id,
					'category_id' => $category_id,
				);
			}
			$this->kadb->queryInsert('product_category', $rec, true);			
		}*/		
		
	}	
	
	
	//public function saveAdditionalImages($product_id, $data, $delete_old, $is_new){}
	public function saveAdditionalImages($product_id, $row, $data) {
		//echo $product_id."<br>";
		//echo $row[$data['additional_image']];exit;
		/*echo "<pre>";
		//print_r($row);
		//print_r($data);
		print_r($products);
		echo "</pre>";
		exit;*/
		$data['additional_image']=$row[$data['additional_image']];
		//echo $data['additional_image']."<br>";exit;
		if (empty($data['additional_image'])) {
			return true;
		}
		//echo $data['additional_image']."<br>";exit;
		/*$delete_old       = true;
		if($this->params['import_mode'] == 'replace')
		{
			$is_first_product = true;		// first occurence of the product in the file
			$delete_old       = false;  	// delete product_category according to product id
		}
		
		if ($delete_old) {
			$this->db->query("DELETE FROM product_image WHERE product_id = '".(int)$products[0]['product_id']."'");
		}
*/
		// insert an additional product image
		//
		$this->params['ka_pi_image_separator']=',';
		if (!empty($this->params['ka_pi_image_separator'])) {
			$images = explode($this->params['ka_pi_image_separator'], $data['additional_image']);
		} else {
			$images = array($row[$data['additional_image']]);
		}
				
		$sort_order = 0;
		//if (!$delete_old && !$is_new) {
			$qry_product_image = $this->db->query("SELECT sort_order FROM product_image WHERE product_id = '" . (int)$product_id . "'");
			$qry=$qry_product_image->result_array();
			if($qry_product_image->num_rows() > 0)
			{
				if (!empty($qry['sort_order'])) {
					$sort_order = $qry['sort_order'];
				}
			}
		//}
		
		foreach ($images as $image) {
		
			if (empty($image))
				continue;
				
			$file = $this->getImageFile($image);
			if ($file === false) {
				$this->addImportMessage($this->product_mark . "image cannot be saved - " . $this->lastError);

			} elseif (!empty($file)) {

				$qry = $this->db->query("SELECT product_image_id FROM product_image	WHERE image = '" . 'catalog/'.$file . "' AND product_id = '".(int)$product_id."'");
				
				
				//echo $qry->num_rows()."<br>";exit;
				//if (empty($qry->row)) {
				if ($qry->num_rows() <= 0) {					
					$sort_order += 5;
					
					$this->db->query("DELETE FROM product_image WHERE image = '" . 'catalog/'.$file . "' AND product_id = '".(int)$product_id."'");	
					
					$this->db->query("INSERT INTO product_image SET product_id = '" . (int)$product_id . "', sort_order = " . $sort_order . ", image = '" . 'catalog/'.$file . "'");
				}
				
			}
		}
	}

	
	//public function saveAttributes($row, $product, $delete_old, $is_first_product){}
	//public function saveAttributes($row, $product, $delete_old, $is_first_product) {
	public function saveAttributes($products,$row,$data) {
		//echo $products[0]['product_id'];exit;
		$this->params['matches']['attributes']=$data['attribute_data'];
		/*echo "<pre>";
		print_r($products);
		echo "</pre>";
		exit;*/
		if (empty($this->params['matches']['attributes'])) {
			return true;
		}
		
		/*if($this->params['import_mode'] == 'replace')
		{
			$is_first_product = true;		// first occurence of the product in the file
			$delete_old       = false;  	// delete product_category according to product id
						
		}
		else
		{
			$delete_old       = true;
			$is_first_product = false;
		}		
		
		if ($delete_old) {
			
			$this->db->query("DELETE FROM product_attribute WHERE product_id = '".(int)$products[0]['product_id']."'");
		}*/

		$data = array();
		foreach ($this->params['matches']['attributes'] as $ak => $av) {
			if (empty($av['column']))
				continue;

			$val = $row[$av['column']];
			/*if (!$is_first_product) {
				continue;
			}*/
			
			if (strlen($val) == 0 || strcasecmp($val, '[DELETE]') == 0)  {
			
				$this->db->query("DELETE FROM product_attribute WHERE product_id = '".(int)$products['product_id']."'  AND	attribute_id = '" .$av['attribute_id'] . "'");
				
			} else {
				
				$rec = array(
					'product_id'   => $products['product_id'],
					'attribute_id' => $av['attribute_id'],
					//'language_id'  => $this->params['language_id'],
					'text'         => $val
				);

				$this->kadb->queryInsert('product_attribute', $rec, true);
			}
		}

		return true;
	}
	/*public function saveAttributes($product) {
		
		//////////// attribute  /////////////
		$match_attribute=array();
		$make_attribute_str="";
		$sets= $this->getFieldSets();
		$attribute_id_list=array();
		foreach($sets['attributes'] as $attribute_key=>$attribute_value)
		{
			$attribute_id_list[]=$attribute_value['attribute_id'];			
		}
		
		//get column number 
		for($attribute_count=0;$attribute_count<count($attribute_id_list);$attribute_count++){
			
			$attributes_value=$this->input->post("attributes[".$attribute_id_list[$attribute_count]."]");
			//echo "attribute value:".$attributes_value."<br>";
			if($attributes_value != 0)
			{								
				$attributes_val=(int)$attributes_value-1;
				$match_attribute[$attribute_id_list[$attribute_count]]=$attributes_val;				
			}
		}				
		
		$cnt_i=0;
		//cvs file read line by line
		$file=$this->params['file'];
		$import_mode=$this->params['import_mode'];
		$fileData=fopen($file,'r');
		//skip first row from csv file
		fgetcsv($fileData);
		
		$delimiter=$this->params['field_delimiter'];	
		while($row=fgetcsv($fileData, 0, $delimiter, $this->enclosure))
		{
			foreach($match_attribute as $key_attribute=>$value_attribute)
			{
				
				$exists_attribute=$this->existsAttribute($product[$cnt_i],$key_attribute,$row[$value_attribute]);
				
				if($exists_attribute == 0)
				{
					$attribute_str.= "`product_id`=".(int)$product[$cnt_i].", `attribute_id`=".(int)$key_attribute.","."`text`="."'".$row[$value_attribute]."' ";
					//$this->insertAttribute($product[$cnt_i],$key_attribute,$row[$value_attribute]);	
					$product_id=$product[$cnt_i];
					if($import_mode == "add")
					{
						$this->insertAttribute(rtrim($attribute_str,","));
					}
					else
					{
						$this->updateAttribute($product_id,rtrim($attribute_str,","));
					}
					
					$attribute_str="";	
				}
				
			}
			$cnt_i++;
			
			//echo $attribute_str;
			//echo "<br>==============================<br>";
			
		}
		
		//exit;
		////////////////   //attribute	 ///////////////////
			
		return true;
	}*/
	
	/*
	* Insert Attribute
	*/
/*	public function insertAttribute($attribute_str)
	{		
		$query=$this->db->query("insert into `product_attribute` set $attribute_str");
		
		$insert_id=$this->db->insert_id();		
		
		return $insert_id;	
	}*/
	
	/*
	* Update Attribute
	*/
	/*public function updateAttribute($product_id,$attribute_str)
	{		
		$query=$this->db->query("update `product_attribute` set $attribute_str where `product_id`='".(int)$product_id."'");
		
		return $query;	
	}*/
	
	
	
	public function saveFilters($product,$row ,$data) {
		
		$this->params['matches']['filter_groups']=$data['filter_data'];
	/*	echo "<pre>";
		print_r($this->params['matches']['filter_groups']);
		echo "</pre>";*/
		if (empty($this->params['matches']['filter_groups'])) {
			return true;
		}
		
		
		/*if($this->params['import_mode'] == 'replace')
		{
			$is_first_product = true;		// first occurence of the product in the file
			$delete_old       = false;  	// delete product_category according to product id
						
		}
		else
		{
			$is_first_product = false;		// first occurence of the product in the file
			$delete_old       = true;  	// delete product_category according to product id
		}
		if ($delete_old) {
			$this->db->query("DELETE FROM product_filter WHERE product_id = '".(int)$product[0]['product_id']."'");
		}*/

		if (empty($this->params['ka_pi_compare_as_is'])) {
			$name_comparison = "TRIM(CONVERT(filter_name using utf8)) LIKE ";
		} else {
			$name_comparison = "filter_name = ";
		}
		
		$data = array();
		foreach ($this->params['matches']['filter_groups'] as $ak => $av) {
			if (empty($av['column']))
				continue;
			
			$val = $row[$av['column']];

			//$sep = $this->config->get('ka_pi_general_separator');
			$sep = ",";
			if (!empty($sep)) {
				$filter_values = explode($sep, $val);
			} else {
				$filter_values = array($val);
			}
			
			foreach ($filter_values as $fv) {
			
				if (empty($fv)) {
					continue;
				}
				
				// find the filter_id
				//
				$filter_id = false;
				$filter_group_id = $av['filter_group_id'];
				$fv = trim($fv);
				
				$qry_filter = $this->db->query("SELECT filter_id FROM filter WHERE $name_comparison '". $fv . "' AND filter_group_id = '$filter_group_id'");
				
				$qry=$qry_filter->row_array();
				// create a new filter if required
				//
				//if (empty($qry->row)) {
				if ($qry_filter->num_rows() <= 0) {
					// add a new filter value
					//
					//$this->db->query("INSERT INTO filter SET filter_group_id = '" . (int)$filter_group_id . "',sort_order = 0");
					//$filter_id = $this->db->insert_id();
					
					/*if (empty($filter_id)) {
						$this->report('filter was not created');
						continue;
					}*/
					//echo $av['filter_group_id']."<br>";exit;
					$rec = array(
						//'filter_id'       => $filter_id,
						'filter_group_id' => $filter_group_id,
						//'language_id'     => $this->params['language_id'],
						'sort_order'	  => 0,
						'filter_name'     => $fv
					);
					$this->kadb->queryInsert('filter', $rec);
					$filter_id = $this->db->insert_id();

				} else {
					//echo $qry['filter_id'];
					$filter_id = $qry['filter_id'];
				}
				//echo $product['product_id']."||".$filter_id."<br>";
				// assign the filter
				//
				//$this->db->query("REPLACE INTO product_filter SET product_id = '" . (int)$product['product_id'] . "', filter_id = '" . (int)$filter_id . "'");
				
				$qry_filter = $this->db->query("SELECT * FROM product_filter WHERE product_id = '" . (int)$product['product_id'] . "' AND filter_id = '" . (int)$filter_id . "'");
			 
				//$qry=$qry_filter->row_array();
				
				// create a new filter if required
				//
				//if (empty($qry->row)) {
				if ($qry_filter->num_rows() <= 0) {
					$this->db->query("INSERT INTO product_filter SET product_id = '" . (int)$product['product_id'] . "', filter_id = '" . (int)$filter_id . "'");
				}
				else
				{
					$this->db->query("REPLACE INTO product_filter SET product_id = '" . (int)$product['product_id'] . "', filter_id = '" . (int)$filter_id . "'");
				}
			}
		}

		return true;
	}
	
	
	
	/* 
	* get filter id by filter_group_id
	*/
	public function getFilterId($filter_group_id)
	{
		$this->db->select('fg.filter_group_id,f.filter_id,f.filter_name as filter_name');
		$this->db->from('filter_group fg');
		$this->db->join('filter f','fg.filter_group_id=f.filter_group_id','left');
		$this->db->where('fg.filter_group_id',(int)$filter_group_id);
		$query=$this->db->get();
		$res=$query->result_array();
		
		return  $res;
	}
	
	
		
	//public function saveOptions($row, $product, $delete_old){}
	//public function saveOptions($row, $product, $delete_old) {
	public function saveOptions($products,$row,$data) {
						
		$this->params['matches']['options']=$data['match_params_option'];
		
		/*echo "<pre>";		
		print_r($this->params['matches']['options']);
		echo "</pre>";*/
		// STAGE 1: process simple options from the selected columns
		//
		if (!empty($this->params['matches']['options'])) {
		
			foreach ($this->params['matches']['options'] as $ok => $ov) {
				if (empty($ov['column']))
					continue;

				$val = $row[$ov['column']];
				//echo "<br>".$val."<br>";
				
				
				if (empty($val)) {
					continue;
				}
				$this->params['ka_pi_options_separator']=',';
				if (!empty($this->params['ka_pi_options_separator'])) {
					$option_values = explode($this->params['ka_pi_options_separator'], $val);
				} else {
					$option_values = array($val);
				}
				
				foreach ($option_values as $ovalue) {
					
					$option = array(
						'name'     => $ov['name'],
						'type'     => $ov['type'],
						'value'    => $ovalue,
						'required' => (!empty($ov['required']))
					);
					/*echo "<pre>";		
					print_r($option);
					echo "</pre>";*/
					$this->saveOption($products, $option);
				}
			}
		}
		
		// STAGE 2: process extended options
		//
		if (!empty($this->params['matches']['ext_options'])) {
			$option = array();
			foreach ($this->params['matches']['ext_options'] as $ck => $cv) {
				if (empty($cv['column']))
					continue;

				$val = $row[$cv['column']];
				$option[$cv['field']] = trim($val);
			}
			
			if (!empty($option['name'])) {
			
				if (!empty($this->params['ka_pi_options_separator'])) {
				
					$multi_options = array();
					$option_keys = array('value', 'quantity', 'subtract', 'image', 'price', 'points', 'weight', 'sort_order');

					$max_option_length = 0;
					foreach ($option_keys as $key) {
						if (isset($option[$key])) {
							$multi_options[$key] = explode($this->params['ka_pi_options_separator'], $option[$key]);
							$max_option_length = max($max_option_length, count($multi_options[$key]));
						}
					}
					
					for ($i = 0; $i < $max_option_length; $i++) {
						$tmp_option = $option;
						
						foreach ($multi_options as $key => $val) {
							if (isset($multi_options[$key][$i])) {
								$tmp_option[$key] = $multi_options[$key][$i];
							} else {
								$tmp_option[$key] = $multi_options[$key][count($option[$key]) - 1];
							}
						}
						
						$this->saveOption($product, $tmp_option);
					}
					
				} else {
					$this->saveOption($product, $option);
				}
			}
		}
	}
	
	//public function saveDiscounts($row, $product, $delete_old){}
	public function saveDiscounts($products,$row,$data) {
	//public function saveDiscounts($product) {
		$this->params['matches']['discounts']=$data['discounts_data'];
		/*echo "discount:";
		echo "<pre>";
		print_r($this->params['matches']['discounts']);
		echo "</pre>";*/
		
		if (empty($this->params['matches']['discounts'])) {
			return true;
		}
		$delete_old       = "";
		if($this->params['import_mode'] == 'replace')
		{
			$is_first_product = true;		// first occurence of the product in the file
			$delete_old       = false;  	// delete product_category according to product id
						
		}
		
		if ($delete_old) {
			$this->db->query("DELETE FROM product_discount WHERE product_id = '".(int)$product_id."'");
		}

		$data = array();
		
		$record_valid = false;		
		foreach ($this->params['matches']['discounts'] as $ak => $av) {
		
			if (empty($av['column']))
				continue;

			$val = trim($row[$av['column']]);

			if ($av['field'] == 'price') {
				if (strlen($val) > 0) {
					$record_valid = true;
				}
				$val = $this->formatPrice($val);

			} elseif (in_array($av['field'], array('date_start', 'date_end'))) {

				if (!$this->formatDate($val)) {
					if (!empty($val)) {
						$this->addImportMessage("Wrong date format in 'discount' record. product_id = $product[product_id]");
					}
					$val = '0000-00-00';
				}

			} elseif ($av['field'] == 'customer_group') {
				$data['customer_group_id'] = $this->getCustomerGroupByName($val);
				continue;
			}

			$data[$av['field']] = $val;
		}
		
		if (!$record_valid) {
			return false;
		}

		if (empty($data['customer_group_id'])) {
			$data['customer_group_id'] = $this->common->config('config_customer_group_id');
		}
				
		if (!(isset($data['customer_group_id']) && isset($data['quantity']) &&
			isset($data['price']))
		) {
			return false;
		}
		
		$data['product_id'] = $products['product_id'];
		//echo 		$data['product_id']."<br>";
		// key fields: product_id, customer_group, quantity, date_start, date_end
		//
		$where = "product_id = '$data[product_id]'
			AND customer_group_id = '$data[customer_group_id]'
			AND quantity = '$data[quantity]'
		";
		
		if (!empty($data['date_start'])) {
			$where .= " AND date_start = '$data[date_start]'";
		}
		if (!empty($data['date_end'])) {
			$where .= " AND date_end = '$data[date_end]'";
		}

		$qry_pd = $this->db->query("SELECT product_discount_id FROM product_discount
			WHERE $where
		");
		$qry=$qry_pd->row_array();
		//if (!empty($qry->row)) {
		if ($qry_pd->num_rows() > 0) {
			//$this->kadb->queryUpdate('product_discount', $data, "product_discount_id = '" . $qry->row['product_discount_id'] . "'");
			$this->db->where('product_discount_id ', $qry['product_discount_id']);
			$this->db->update('product_discount', $data); 
		} else {		
			if($this->params['import_mode'] == 'add')
			{
				
				$this->db->query("DELETE FROM product_discount WHERE product_id = '".(int)$data['product_id']."' and customer_group_id='".(int)$data['customer_group_id']."'");
							
				$this->kadb->queryInsert('product_discount', $data);					
				
			}
		}

		return true;
	}
	
	
	//public function saveSpecials($row, $product, $delete_old){}
	public function saveSpecials($products_data,$row,$data) {
		
		/*echo "<pre>";	
		print_r($data);
		echo "</pre>";*/
		//echo "================";
		$this->params['matches']['specials']=$data['specials_data'];
	
		if (empty($this->params['matches']['specials'])) {
			return true;
		}
		
		$delete_old       = "";
		if($this->params['import_mode'] == 'replace')
		{
			$is_first_product = true;		// first occurence of the product in the file
			$delete_old       = false;  	// delete product_category according to product id
						
		}
		if ($delete_old) {
			$this->db->query("DELETE FROM product_special WHERE product_id = '".(int)$products_data['product_id']."'");
		}

		$data = array();
		
		foreach ($this->params['matches']['specials'] as $ak => $av) {
			
			if (empty($av['column']))
				continue;
//echo $av['column']."<br>";
			$val = trim($row[$av['column']]);
			//echo "product_specials: ".$av['field']."=".$val."<br>";
			if ($av['field'] == 'price') {
				$val = $this->formatPrice($val);

			} elseif (in_array($av['field'], array('date_start', 'date_end'))) {

				if (!$this->formatDate($val)) {
					if (!empty($val)) {
						$this->addImportMessage("Wrong date format in 'special' record. product_id = $product[product_id]");
					}
					$val = '0000-00-00';
				}

			} elseif ($av['field'] == 'customer_group') {	
			//echo $val."<br>";			
				$data['customer_group_id'] = $this->getCustomerGroupByName($val);
				//echo $data['customer_group_id']."<br>";
				continue;
			}

			$data[$av['field']] = $val;
		}
		//echo $data['customer_group_id']."||".$data['price'];
		if (empty($data['customer_group_id']) && empty($data['price'])) {
			return true;
		}
		
		$data['product_id'] = $products_data['product_id'];

		if (empty($data['customer_group_id'])) {
			$data['customer_group_id'] =  $this->common->config('config_customer_group_id');
		}
		
		if (!isset($data['priority'])) {
			$data['priority'] = 1;
		}

		//if (!(isset($data['customer_group_id']) && isset($data['price']))) {
		if (!isset($data['customer_group_id']) && !isset($data['price'])) {
			return false;
		}

		// key fields: customer_group, date_start, date_end
		//
		$where = " product_id = '$data[product_id]'
			AND customer_group_id = '$data[customer_group_id]'
		";
		
		if (!empty($data['date_start'])) {
			$where .= " AND date_start = '$data[date_start]'";
		}
		if (!empty($data['date_end'])) {
			$where .= " AND date_end = '$data[date_end]'";
		}
		
		$qry_ps = $this->db->query("SELECT product_special_id FROM product_special WHERE $where");
		$qry=$qry_ps->row_array();
		//echo 'row:'.$qry_ps->num_rows();
		//if (!empty($qry->row)) {
		if ($qry_ps->num_rows() > 0) {
			//$this->kadb->queryUpdate('product_special', $data, "product_special_id = '" . $qry['product_special_id'] . "'");
			$this->db->where('product_special_id ', $qry['product_special_id']);
			$this->db->update('product_special', $data);
			
		} else {
			$this->kadb->queryInsert('product_special', $data);
		}
		
		return true;
	}

	
	//public function saveRewardPoints($row, $product, $delete_old){}
	/*public function saveRewardPoints($row, $product, $delete_old) {

		if (empty($this->params['matches']['reward_points'])) {
			return true;
		}
		
		if ($delete_old) {
			$this->db->query("DELETE FROM product_reward WHERE product_id = '$product[product_id]'");
		}

		$data = array();
		foreach ($this->params['matches']['reward_points'] as $ak => $av) {
			if (empty($av['column']))
				continue;

			$val = $row[$av['column']];

			if ($av['field'] == 'customer_group') {				
				$data['customer_group_id'] = $this->getCustomerGroupByName($val);
				continue;
			}

			$data[$av['field']] = $val;
		}

		if (empty($data['points'])) {
			return false;
		}

		$data['product_id'] = $product['product_id'];

		if (empty($data['customer_group_id'])) {
			$data['customer_group_id'] = $this->config->get('config_customer_group_id');
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_reward WHERE 
			product_id = '$product[product_id]'
			AND customer_group_id = '$data[customer_group_id]'
		");
		$this->kadb->queryInsert('product_reward', $data);

		return true;
	}*/
	
	//public function saveRelatedProducts($data, $product, $delete_old){}
	/* 
		$data     - array of file data split by columns
		$product  - product data array
	*/
	public function saveRelatedProducts($data, $product, $delete_old) {

		if (empty($data['related_product'])) {
			return true;
		}
	
		if ($delete_old) {
			$this->db->query("DELETE FROM product_related WHERE product_id = '".(int)$product['product_id']."'");
		}
	
		// get the array of related models
		//
		$related = array();
		$sep     = $this->common->config('ka_pi_related_products_separator');		
		if (!empty($sep)) {
			$related = explode($sep, $data['related_product']);
		} else {
			$related = array($data['related_product']);
		}
		
		foreach ($related as $rv) {
			if (empty($rv)) {
				continue;
			}

			$qry_product = $this->db->query("SELECT product_id FROM product WHERE model = '" . $rv . "'");
			$qry=$qry_product->row_array();
			//if (empty($qry->row)) {
			if ($qry->num_rows() > 0) {
				continue;
			}

			// link to all products with found model regardless of their number
			//
			foreach ($qry_product->result_array as $row) {
			
				$rec = array(
					'product_id' => $product['product_id'],
					'related_id' => $row['product_id']
				);
				$this->kadb->queryInsert('product_related', $rec, true);

				$rec = array(
					'product_id' => $row['product_id'],
					'related_id' => $product['product_id']
				);
				$this->kadb->queryInsert('product_related', $rec, true);
			}
		}

		return true;
	}

	
	//public function saveDownloads($data, $product, $delete_old){}
	public function saveDownloads($product_id,$row,$data) {
		//products_id
		//echo $product_id;
		
		//csv row data
		/*echo "<pre>";
		print_r($row);
		echo "</pre>";*/
		
		//data
		//echo $data['downloads'];
		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/
		
		if (empty($data['downloads'])) {
			return true;
		}
		
		$save_params=$this->session->userdata('save_params');
		$this->params=$save_params;
		$params = $this->params;
		
		/*echo "<pre>";
		print_r($params);
		echo "</pre>";*/
		//echo $this->params['import_mode']."<br>";
		$delete_old       = true;
		if($this->params['import_mode'] == 'replace')
		{
			$is_first_product = true;		// first occurence of the product in the file
			$delete_old       = false;  	// delete product_category according to product id
		}
		
		$data['downloads']=$row[$data['downloads']];	
		
		/////   create folder    //////
		//create main and create sub directories 
		$img_dir=$params['download_source_dir'];
		$static_image_path="../system/storage/download/";
		$table_image_path="download/".$img_dir;
		$image_directory=$static_image_path.$img_dir;
		
		$get_dir_make=explode('/',$image_directory);		
			
		$total_dir=count($get_dir_make);
									
		for($i=0;$i<$total_dir;$i++)
		{	
			$path="";
			for($j=0;$j<$i;$j++)
			{	
				$path.=$get_dir_make[$j]."/";
			}			
			
			$new_path=substr_replace($path, "", -1);
					
			if(!is_dir($path.$get_dir_make[$i]))	
			{
				mkdir($path.$get_dir_make[$i]);			
			}		
		}
		
		//get main path
		for($mpi=0;$mpi<=$total_dir;$mpi++)
		{
			$mainpath="";
			for($mpj=0;$mpj<$mpi;$mpj++)
			{
				$mainpath.=$get_dir_make[$mpj]."/";
			}
		}	
		//////////////////////////////////////////
		$file="";
		$url=$data['downloads'];
		if(!empty($url))
		{
			//echo $url."<br>";
			//Check to see if the file exists by trying to open it for read only									
			$check = $this->checkRemoteFile($url);
	
			if($check == true){
				$file = basename($url);  
				$file = preg_replace("/\?.+/", "", $file);
				$img = $image_directory.'/'.$file;
				
				if(!file_exists($img)) {
					error_reporting(E_ERROR | E_PARSE);
					file_put_contents($img, file_get_contents($url));
				}							
			}
			if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
				//$make_str.="`".$key."`"."='".$row[$value]."',";
			}	
			else
			{			
				//$make_str.="`".$key."`"."='".$table_image_path.'/'.$file."',";
				$data['image_file_path']=$table_image_path.'/'.$file;					
			}
		}
		
		if (empty($data['downloads'])) {
			return true;
		}
	
		if ($delete_old) {
			$this->db->query("DELETE FROM product_download WHERE product_id = '".(int)$product_id."'");
		}
	
		$downloads = array();
		$sep = $this->common->config('ka_pi_general_separator');
		if (!empty($sep)) {
			$downloads = explode($sep, $data['downloads']);
		} else {
			$downloads = array($data['downloads']);
		}
		
		foreach ($downloads as $dv) {
			if (empty($dv)) {
				continue;
			}
			$dv=$data['image_file_path'];
			
			// 1) detect file parts from the file name
			//
			$ext = $dest_filename = $mask = '';
			$info = pathinfo($dv);

			if ($this->params['file_name_postfix'] == 'generate') {				
				$mask = $dv;
				$ext  = md5(mt_rand());
				
			} elseif ($this->params['file_name_postfix'] == 'detect') {
				$mask = $info['filename'];
				$ext  = $info['extension'];
				
			} else {
				$mask = $dv;
			}
			
			$filename = $mask . (!empty($ext) ? '.'.$ext : '');
			$concate_ext_file=$file.(!empty($ext) ? '.'.$ext : '');
			// 2) find this file in downloads
			//			
			$qry_download = $this->db->query("SELECT * FROM download WHERE mask = '" . $mask . "'");
			$qry=$qry_download->row_array();
			//if (!empty($qry->row)) {
			if ($qry_download->num_rows() > 0) {
				$download_id = $qry['download_id'];
			} else {
			
				/*$data = array(
					'src_file'  => $dv,
					'filename'  => $filename,
					'mask'      => $mask,
				);*/
				$data = array(
					'src_file'  	=> $data['image_file_path'],
					'filename'  	=> $filename,
					'mask'      	=> $mask,
					//'download_name'	=> $concate_ext_file
					'download_name'	=> $file
				);
				
				$download_id = $this->addDownload($data);
			}
			
			// 3) connect product and download record
			//
			if (!empty($download_id)) {
				$rec = array(
					'product_id'  => $product_id,
					'download_id' => $download_id
				);
				$this->kadb->queryInsert('product_download', $rec, true);
			}
		}

		return true;
	}
	
	//public function saveReviews($row, $product, $delete_old){}
	/*public function saveReviews($row, $product, $delete_old) {

		if (empty($this->params['matches']['reviews'])) {
			return true;
		}

		if ($delete_old) {
			$this->db->query("DELETE FROM review WHERE product_id = '".(int)$product['product_id']."'");
		}

		$rec = array();
		
		foreach ($this->params['matches']['reviews'] as $ak => $av) {
				
			if (!isset($av['column']) || strlen($av['column']) == 0)
				continue;

			$val = $row[$av['column']];
			$rec[$av['field']] = $val;
		}
		
		if (empty($rec['author']) || empty($rec['text'])) {
			return false;
		}
		
		$rec['product_id'] = $product['product_id'];
		
		if (empty($rec['date_added'])) {
			if (!empty($rec['date_modified'])) {
				$rec['date_added'] = $rec['date_modified'];
			}
		}
		
		if (!empty($rec['date_added'])) {
			$rec['date_added'] = $this->parseDate($rec['date_added']);
		}
		
		if (!empty($rec['date_modified'])) {
			$rec['date_modified'] = $this->parseDate($rec['date_modified']);
		}

		$qry_review = $this->db->query("SELECT * FROM review WHERE author = '" . $rec['author'] . "' AND product_id = '" . $rec['product_id'] . "'");
		//$qry=$qry_review->result_array();
		$qry=$qry_review->row_array();
		if (!empty($qry)) {

			if (isset($rec['status']) && strlen($rec['status']) == 0) {
				unset($rec['status']);
			}
		
			$rec = array_merge($qry->rows[0], $rec);
			unset($rec['review_id']);
			
			$this->kadb->queryUpdate("review", $rec, "review_id = '" . (int)$qry['review_id'] . "'");
			
		} else {
			if (empty($rec['status'])) {
				$rec['status'] = 1;
			}
			$this->kadb->queryInsert('review', $rec);					
		}
		
		return true;		
	}*/
	
	
	//Additional methods
	/*
	* addImportMessage
	*/
	public function addImportMessage($msg, $type = 'W') {
		static $too_many = false;

		if ($too_many ) return false;

		$prefix = '';
		if ($type == 'W') {
			$prefix = 'WARNING';
		} else if ($type == 'E') {
	  		$prefix = 'ERROR';
	  	} elseif ($type == 'I') {
		  	$prefix = 'INFO';
		}


		if (!empty($this->messages) && count($this->messages) > 200) {
			$too_many = true;
	  		$msg = "too many messages...";
	  	} else {
		  	$msg = $prefix . ': ' . $msg;
		}

	  	//$this->kalog->write("Message: " . $msg);

		$this->messages[] = $msg;
	}	
	
	/*
		RETURNS:
			$file - path with file name within image directory or FALSE on error.

		File name can be theortically converted to the right charset but we do not support
		it at this moment.
		$file  = iconv('utf-8', 'Windows-1251', $image);
	*/
	public function getImageFile($image) {
		$this->lastError = '';
		error_reporting(E_ERROR | E_PARSE);
		if (empty($image))
			return false;

		$image = trim($image);
		
		$file = '';
		if ($this->isUrl($image)) {

		    $url_info = @parse_url($image);

		    if (empty($url_info)) {
	    		$this->lastError = "Invalid URL data $url";
	    		return false;
			}

	    	// 1) get relative image directory to $images_dir
			//
		    $fullname  = '';
		    //$images_dir = str_replace("\\", '/', $this->params['incoming_images_dir']);
      		$images_dir = str_replace("\\", '/', $this->params['images_dir']);
			
	    	if (!empty($url_info['path'])) {
	    		$url_info['path'] = urldecode($url_info['path']);
	    		
			    $path_info = pathinfo($url_info['path']);
			    $path_info['dirname'] = $this->strip($path_info['dirname'], array("\\","/"));

			    if (!empty($path_info['dirname'])) {
		    		$images_dir = $images_dir . $path_info['dirname'] . '/';
		    		if (!file_exists(DIR_IMAGE .'catalog/' . $images_dir)) {
			    		if (!mkdir(DIR_IMAGE .'catalog/' . $images_dir, 0755, true)) {
			    			$this->lastError = "Script cannot create directory: $images_dir";
			    			return false;
		    			}
			    	}
			    }
			    
			    // skip downloading files if they exist on the server
			    // it works for direct URLs only.
			    //
			    if (!empty($this->params['skip_img_download'])) {
					if (empty($url_info['query']) && !empty($path_info['extension'])) {
						$_file = $images_dir . $path_info['basename'];
						if (is_file(DIR_IMAGE .'catalog/' . $_file) && filesize(DIR_IMAGE .'catalog/' . $_file) > 0) {
							return $_file;
						}
					}
				}
			}
		
			// 2) download file and parse the path
			//
			$image = htmlspecialchars_decode($image);
		    $tmp = str_replace(array(' '), array('%20'), $image);

		    $content = $this->getFileContentsByUrl($tmp);
	    	if (empty($content)) {
		    	$this->lastError = "File content is empty for $tmp (" . $this->lastError . ")";
		    	return false;
	    	}

	    	// save the image to a temporary file
	    	//
		  	$tmp_file = tempnam(DIR_IMAGE .'catalog/' . $images_dir, "tmp");
		  	
		  	$size = file_put_contents($tmp_file, $content);
		  	if (empty($size)) {
		  		$this->lastError = "Cannot save new image file: $tmp_file";
			  	return false;
			}

    		$image_info = getimagesize($tmp_file);
    		if (empty($image_info)) {
				$this->lastError = "getimagesize returned empty info for the file: $image";
				return false;
			}
			
			// 3) get a complete image file path
			//
			if (!empty($url_info['query'])) {
				$filename = '';
				if (!empty($path_info['basename'])) {
					$filename = $path_info['basename'];
				}
				$query = $this->normalizeFilename($url_info['query']);
				$filename = $filename . $query . image_type_to_extension($image_info[2]);

			} else {
				$filename = $path_info['basename'];
				if (empty($path_info['extension'])) {
					$filename = $filename . image_type_to_extension($image_info[2]);
				}
			}

			// 4) move the image file to the incoming directory
			//
			if (is_file(DIR_IMAGE .'catalog/' . $images_dir . $filename)) {
				@unlink(DIR_IMAGE .'catalog/' . $images_dir . $filename);
			}
			
			if (!is_file(DIR_IMAGE .'catalog/' . $images_dir . $filename)) {
				if (!rename($tmp_file, DIR_IMAGE .'catalog/' . $images_dir . $filename)) {
					$this->lastError = "rename operation failed. from $tmp_file to " . DIR_IMAGE .'catalog/'. $images_dir . $filename;
					return false;
				}

				if (!chmod(DIR_IMAGE .'catalog/'. $images_dir . $filename, 0644)) {
					$this->lastError = "chmod failed for file: $filename";
					return false;
				}
			}

		   	$file = $images_dir . $filename;
		   	
		} else {
			
			//
			// if the image is a regular file
			//
			$file = $this->params['images_dir'].$image;
			if (!is_file(DIR_IMAGE .'catalog/'. $file)) {
				$this->lastError = "File not found " . DIR_IMAGE . $file;
				return false;
			}
		}

		return $file;
	}
	
	/*
		PARAMETERS:
			..
			$category_chain - encoded html string
			..
	*/
	public function saveCategory($product_id, $category_chain, $clear_cache = false) {
		
		//echo $product_id."<br>";
		
		//echo $category_chain."<br>";
		
		$save_params=$this->session->userdata('save_params');		
		$this->params=$save_params;
		$params = $this->params;
		
		//echo $this->params['cat_separator']."<br>";
		
		if (empty($category_chain)) {
			return false;
		}

		if (!empty($this->params['cat_separator'])) {
		/*	echo $category_chain."<br>";
			echo $this->params['cat_separator'];*/
			
			//$category_chain = $this->kaformat->strip($category_chain, $this->params['cat_separator']);
			$category_chain = $this->strip($category_chain, $this->params['cat_separator']);
			
			$category_names = explode($this->params['cat_separator'], $category_chain);
		} else {
			$category_names = array($category_chain);
		}

		$categories = array();

		$parent_id   = 0;
		$category_id = 0;
		
		if (empty($this->params['ka_pi_compare_as_is'])) {
			$name_comparison = "TRIM(CONVERT(category_name using utf8)) LIKE ";
		} else {
			$name_comparison = "category_name = ";
		}
		
		foreach ($category_names as $ck => $cv) {

			$cv = trim($cv);
			$new_category = false;
			
			// we use convert function here to make comparison case-insensitive
			// http://dev.mysql.com/doc/refman/5.0/en/cast-functions.html#function_convert
			//
			// http://dev.mysql.com/doc/refman/5.0/en/string-comparison-functions.html#operator_like
			//
			//echo "name compare: ".$parent_id."<br>";
			//$query_sel = $this->db->query("SELECT category_id FROM category WHERE $name_comparison '". $cv . "' AND parent_id = '$parent_id'");
			
			$query_sel = $this->db->query("SELECT category_id FROM category WHERE category_name= '". $cv . "' AND parent_id = '$parent_id'");
			$sel=$query_sel->row_array();
			if (empty($sel)) {
				$this->db->query("INSERT INTO category SET category_name='".$cv."', parent_id = '$parent_id', status ='1', image = '', date_modified = '".date('Y-m-d h:i:sa')."', date_added = '".date('Y-m-d h:i:sa')."'");
				$category_id = $this->db->insert_id();
				$is_new      = true;
				
				
				/*$rec = array(
					'category_id' => $category_id,
					'language_id' => $this->params['language_id'],
					'name'        => $cv
				);
				$this->kadb->queryInsert('category_description', $rec);*/
				//$this->stat['categories_created']++;

				$level = 0;
				$query = $this->db->query("SELECT * FROM `category_path` WHERE category_id = '" . (int)$parent_id . "' ORDER BY `level` ASC");
				
				//foreach ($query->rows as $result) {
				foreach ($query->result_array() as $result) {
					$this->db->query("REPLACE INTO `category_path` SET `category_id` = '" . (int)$category_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");
					$level++;
				}
				$this->db->query("REPLACE INTO `category_path` SET `category_id` = '" . (int)$category_id . "', `path_id` = '" . (int)$category_id . "', `level` = '" . (int)$level . "'");
				
			} else {
				$category_id = $sel['category_id'];
			}

			// insert category to stores
			/*if (!$this->insertToStores('category', $category_id, $this->params['store_ids'])) {
				$this->addImportMessage("Saving the record to stores has failed");
			}*/
			
			//save category_id and category_name in "url_alias"
			if($category_id != 0)
			{					
				$this->db->query("DELETE FROM url_alias WHERE query = 'category_id=" . $category_id. "'");
				$this->db->query("INSERT INTO url_alias SET query = 'category_id=" . (int)$category_id . "', keyword = '" . $this->seoUrl($cv) . "'");
			}
			

			$parent_id = $category_id;
		}

		if (empty($category_id)) {
			return false;
		}
		
		//$query_check_exists=$this->db->query("select * from `product_category` where 'product_id'='".$product_id."' AND 'category_id'='".$category_id."'");
		
		if($this->params['import_mode'] == 'add')
		{
			$query_check_exists=$this->db->query("SELECT *  FROM `product_category` WHERE `product_id` = '".$product_id."' AND `category_id` = '".$category_id."'");
			//echo $query_check_exists->num_rows()."<br>";
			if($query_check_exists->num_rows() > 0)
			{
				//echo "delete"."<br>";
				$this->db->query("DELETE FROM product_category WHERE product_id = '".$product_id."' AND 'category_id'='".$category_id."'");
			}
			else
			{
				//echo "insert"."<br>";
				$rec = array(
					'product_id'  => $product_id,
					'category_id' => $category_id,
				);
				$this->kadb->queryInsert('product_category', $rec, true);
			}
		}
		else
		{
			$rec = array(
					'product_id'  => $product_id,
					'category_id' => $category_id,
				);
				$this->kadb->queryInsert('product_category', $rec, true);
		}		
		
		if ($clear_cache) {
			$this->cache->delete('category');
		}
				
		return true;
	}
	
	/*
		Function saves one product option.

		PARAMETERS:
			...
			option['value'] - it can be empty for text options (and maybe other option types)
			...
			
		RETURNS:
			true  - success
			false - error / fail
	*/	
	public function saveOption($product, $option) {

		$is_new = false;
		$data = array();
	
		// validate parameters
		//
		$option['type'] = strtolower($option['type']);
		if (!in_array($option['type'], $this->option_types)) {
			$this->addImportMessage($this->product_mark . "Invalid option type - $option[type]");
			return false;
		}

		$option['value'] = trim($option['value']);

		// STAGE 1: find the option in the store
		//
		$qry_row = $this->db->query("SELECT option_id,name FROM `option` WHERE type='".$option['type']."' AND name='" . $option['name'] . "'");
		
		$qry=$qry_row->row_array();
		/*echo $qry_row->num_rows()."<br>";
		echo "<pre>";
		print_r($qry);
		echo "</pre>";*/
		//if (empty($qry)) {
		if ($qry_row->num_rows() > 0) {
			
			// if the option is NOT found
			//
			/*if (empty($this->params['opt_create_options'])) {
				$this->addImportMessage("Option '".$option['name']."' does not exist in the store. If you want to create options from the file then enable the appropriate setting on the extension settings page.");
				return false;
			}*/

			$rec = array(
				'type'   => $option['type'],
			);
			
			/*if (!empty($option['group_sort_order'])) {
				$rec['sort_order'] = $option['group_sort_order'];
			};
			$option_id = $this->kadb->queryInsert('option', $rec);
			
			if (empty($option_id)) {
				$this->addImportMessage("Cannot create a new option");
				return false;
			}*/
			
			//$is_new = true;

			$qry_exists = $this->db->query("SELECT option_id,name,'type' FROM `option` WHERE type='".$option['type']."' AND name='" . $option['name'] . "'");
			$qry=$qry_exists->row_array();
			/*echo $qry_exists->num_rows()."<br>";
			echo "<pre>";
print_r($option);
echo "</pre>";*/

			if($qry_exists->num_rows() <= 0)
			{
				/*echo "insert option";
				exit;*/
				$rec = array(
					'option_id'   => $option_id,				
					'name'        => $option['name'],					
					//'sort_order'  => $option['sort_order']
				);
			
				//$this->kadb->queryInsert('option_description', $rec);
				$this->kadb->queryInsert('option', $rec);
				
				$this->addImportMessage("New option created - $option[name]", 'I');
			}
			// repeat option request
			//
			$qry = $this->db->query("SELECT option_id FROM `option` WHERE type='".$option['type']."' AND name='" . $option['name'] . "'");
			$qry=$qry_exists->row_array();
		} else {
		

			// update group sort order for existing option group
			//
			/*if (!empty($option['group_sort_order'])) {
				$rec = array(
					'sort_order' => $option['group_sort_order'],
				);
				$this->kadb->queryUpdate('option', $rec, "option_id = '" . $qry['option_id'] . "'");
			}*/
		}
		
		//
		// STAGE 2: option found/created and we are going to assing it to a product
		//		
		$option_id = $option['option_id'] = $qry['option_id'];

		// find product option id or insert a new one
		//
	   	$qry1 = $this->db->query("SELECT product_option_id FROM product_option WHERE product_id='".(int)$product['product_id']."' AND option_id='".(int)$option['option_id']."'");
   		$qry=$qry1->row_array();
		
		$count_row=$qry1->num_rows();
		$rec = array(
			'required' => $option['required'],
		);
		/*echo "<pre>";
		print_r($qry);
		echo "</pre>";
		exit;*/
		if ($this->options_with_def_values) {
			$rec['value'] = $option['value'];
		}
   		
	   	if (empty($qry['product_option_id'])) {
			if($count_row <= 0)
			{
				$rec['product_id'] = $product['product_id'];
				$rec['option_id']  = $option['option_id'];
				$rec['date_added']  = date('Y-m-d h:i:sa');
				$product_option_id = $this->kadb->queryInsert('product_option', $rec);
			}
		} else {
			
			$product_option_id = $qry['product_option_id'];
			
			//$this->kadb->queryUpdate('product_option', $rec, "product_option_id = '".(int)$product_option_id."'");
			
			$this->db->where('product_option_id', (int)$product_option_id);
			$this->db->update('product_option', $rec);
		}
		
		//$this->registerRecord($product['product_id'], $this->record_types['product_option_id'], $product_option_id);

		
		//	There are two option types in Opencart:
		//		simple   - user enters a custom value manually
		//		extended - options with predefined values
		
		if (in_array($option['type'], $this->extended_types)) {

			// find option value or insert a new one
			//
			$qry_option_value = $this->db->query("SELECT option_value_id FROM option_value WHERE option_id = '" .(int)$option_id . "' AND name='" . $option['value'] . "'");
			$qry=$qry_option_value->row_array();
			/*echo "<pre>";
			print_r($qry);
			echo "</pre>";*/
			if (empty($qry['option_value_id'])) {
				$rec = array(
					'option_id' => $option['option_id'],
					'option_value_id' => $qry['option_value_id'],					
					'name'            => $option['value'],
					'date_added'     => date('Y-m-d h:i:sa')				
				);
				
				$option_value_id = $this->kadb->queryInsert('option_value', $rec);

				/*$rec = array(
					'option_id'       => $option['option_id'],
					'option_value_id' => $option_value_id,					
					'name'            => $option['value']
				);

				$this->kadb->queryInsert('option_value_description', $rec);*/

			} else {
				$option_value_id = $qry['option_value_id'];
			}

			//
			// collect in $rec array extra option parameters and update the option if required
			//
			$rec = array();
			
			if (in_array($option['type'], $this->options_with_images) && !empty($option['image'])) {
				$file = $this->getImageFile($option['image']);
				if ($file === false) {
					$this->addImportMessage("image cannot be saved - " . $this->lastError);
				} else {
					$rec['image'] = $file;
				}
			}
			
			if (isset($option['sort_order'])) {
				$rec['sort_order'] = $option['sort_order'];
			}
			
			if (!empty($rec)) {
				
				//$this->kadb->queryUpdate('option_value', $rec, "option_value_id = '$option_value_id'");
				$this->db->where('option_value_id', (int)$option_value_id);
				$this->db->update('option_value', $rec);
			}
			
			$rec = array(
				'product_option_id' => $product_option_id,
				'product_id'        => $product['product_id'],
				'option_id'         => $option_id,
				'option_value_id'   => $option_value_id
			);
			
			if (isset($option['quantity'])) {
				$rec['quantity'] = $option['quantity'];
			}
			
			if (isset($option['subtract'])) {
				$rec['subtract'] = $option['subtract'];
			}
			
			if (isset($option['price'])) {
				$rec['price']        = abs($this->formatPrice($option['price']));
				$rec['price_prefix'] = ($option['price'] < 0 ? '-':'+');
			}
			
			if (isset($option['points'])) {
				$rec['points']        = abs($option['points']);
				$rec['points_prefix'] = ($option['points'] < 0 ? '-':'+');				
			}

			if (isset($option['weight'])) {
				$rec['weight']        = abs($option['weight']);
				$rec['weight_prefix'] = ($option['weight'] < 0 ? '-':'+');
			}

    		$qry_product_option_value = $this->db->query("SELECT * FROM product_option_value WHERE product_option_id='".(int)$product_option_id."' AND option_value_id='".(int)$option_value_id."'");
			//$qry=$qry_product_option_value->result_array();
			$qry=$qry_product_option_value->row_array();
			
	     	//if (!empty($qry->rows)) {
	     	if (!empty($qry)) {
	     		$product_option_value_id = (int)$qry['product_option_value_id'];
	     	
	     		if ($qry_product_option_value->num_rows() > 1) {
					$this->db->query("DELETE FROM product_option_value WHERE product_option_id = '".(int)$product_option_id."' AND option_value_id = '".(int)$option_value_id."' AND product_option_value_id <> '" . (int)$product_option_value_id  . "'
					");
				}
	     	
	     		//$this->kadb->queryUpdate('product_option_value', $rec, "product_option_value_id = '" . (int) $qry['product_option_value_id'] . "'");
				$this->db->where('product_option_value_id', (int)$qry['product_option_value_id']);
				$this->db->update('product_option_value', $rec);
			} else {
				$product_option_value_id = $this->kadb->queryInsert('product_option_value', $rec);
			}
			
			//$this->registerRecord($product['product_id'], $this->record_types['product_option_value_id'], $product_option_value_id);
		}

		return true;
		
	}
	
	/*
	* saveSeoUrl
	*/
	public function saveSeoUrl($product_id,$row,$data)
	{
		//echo $product_id."<br>";
		$col_seourl_num=$data['seo_url'];			
		
		/*echo "<pre>";
		print_r($row);
		echo "</pre>";*/
		
							
		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/
		//exit;
		$product_seo_keyword=$this->seoUrl($row[$col_seourl_num]);
		/*echo $product_seo_keyword;		
		exit;*/
		
		if(preg_match('/^[a-zA-z-]*$/',$product_seo_keyword))
		{
			//echo "match";			
			if (isset($product_seo_keyword)) {
								
				if (!empty($product_seo_keyword)) {					
					
					$this->db->query("DELETE FROM url_alias WHERE query = 'product_id=" . $product_id. "'");
					$this->db->query("INSERT INTO url_alias SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $product_seo_keyword . "'");				
				} 		
				
			}
		}
		else
		{
			//echo "not match";
		}
		return true;
		
	}
	
	public function seoUrl($string) {
		//Lower case everything
		$string = strtolower($string);
		//Make alphanumeric (removes all other characters)
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		//Clean up multiple dashes or whitespaces
		$string = preg_replace("/[\s-]+/", " ", $string);
		//Convert whitespaces and underscore to dash
		$string = preg_replace("/[\s_]/", "-", $string);
		return $string;
	}

	/* 
	* generate seo url
	*/
	public function generateProductUrl($id) {
				
		$qry = $this->db->query("SELECT url_alias_id FROM url_alias WHERE keyword='" . $url . "'");
			
		if (empty($qry->row)) {
			return $url;
		}
		
		$url = $url . "-p-" . $id;
		$qry = $this->db->query("SELECT url_alias_id FROM url_alias WHERE keyword='" . $url . "'");

		if (empty($qry->row)) {
			return $url;
		}

		
		return false;
	}
	
	
	/*
	* registerRecord
	*/
	public function registerRecord($product_id, $type, $id) {
		$rec = array(
			'product_id' => $product_id,
			'record_type' => $type,
			'record_id'  => $id,
			'token' => $this->session->data['token'],
		);
		$this->kadb->queryInsert('ka_import_records', $rec, true);
	}
	
	/*
	* getCustomerGroupByName
	*/
	public function getCustomerGroupByName($customer_group) {

		static $customer_groups;

		if (isset($customer_groups[$customer_group])) {
			return $customer_groups[$customer_group];
		}

		$qry_customer_group = $this->db->query("SELECT customer_group_id FROM customer_group WHERE group_name = '$customer_group'");

		$qry=$qry_customer_group->row_array();
		//if (empty($qry->row)) {
		if ($qry_customer_group->num_rows() > 0) {
			$customer_groups[$customer_group] = 0;
			return 0;
		}
		
		$customer_groups[$customer_group] = $qry['customer_group_id'];
						
		return $qry['customer_group_id'];
	}
	
	/*
	* addDownload
	*/
	public function addDownload($data) {
		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/
		//$src_file = $this->params['download_source_dir'] . $this->strip($data['src_file'], array("\\", "/"));
		$src_file = $data['src_file'];
		
		// 1) copy the file to downloads directory
		//
		/*if (!file_exists($src_file)) {
			$this->addImportMessage("File does not exist: $src_file");
			return false;			
		}
		
		$dest_file = DIR_DOWNLOAD . $data['filename'];
		if (!copy($src_file, $dest_file)) {
			$this->addImportMessage("Cannot copy file from $src_file to $dest_file.");
			return false;
		}*/
		
		// 2) add a new record to the database
		//
      	$this->db->query("INSERT INTO download SET name = '" . $data['download_name'] . "',filename   = '" . $data['filename'] . "', mask       = '" . $data['mask'] . "', date_added = '".date('Y-m-d h:i:sa')."'");
	
      	$download_id = $this->db->insert_id(); 
      	
       	//$this->db->query("INSERT INTO download SET download_id = '" . (int)$download_id . "', name = '" . $data['mask'] . "'");
       	
       	return $download_id;
	}
	
	/*
	* parseDate
	*/
	public function parseDate($str) {
    
    	$res = '';

    	$date = strtotime($str);
    	if (!empty($date)) {
	    	$res = date("Y-m-d H:i:s", $date);
	    }
	    
	    return $res;
    }
	
	/*
		returns:
			array - on success
			false - on error
	*/
	/*public function getProfileParams($profile_id) {
	
		$qry = $this->db->query("SELECT * FROM " . DB_PREFIX . "ka_import_profiles WHERE import_profile_id = '" . $this->db->escape($profile_id) . "'");
		if (empty($qry->rows)) {
			return false;
		}

		if (!empty($qry->row['params'])) {
			$params = unserialize($qry->row['params']);
		} else {
			$params = array();
		}

		return $params;
	}*/
	
	
	public function examineFileData($file) {

		$file = base64_decode($file);
		$file = substr($file, 0, 256);
		
		$result = array(
			'error' => '',
			'charset' => '',
			'delimiter' => '',
		);
		
		if (ord($file[0]) == 0xd0 && ord($file[1]) == 0xcf) {
			$result['error'] = 'The file looks like a native MS Excel file. The extension works with CSV files only. Save your MS Excel file as UNICODE text file and try to import the data again.';
			return $result;
		}
		
		if ((ord($file[0]) == 0xff && ord($file[1]) == 0xfe)
		) {
			$result['charset'] = 'UTF-16';
		}		

		// try to detect a field delimiter
		//
		$max = array(
			'delimiter' => '',
			'count' => 0,
		);		
		foreach ($this->delimiters as $delimiter => $name) {
			if (in_array($delimiter, array(' '))) {
				continue;
			}
		
			$arr = self::str_getcsv($file, $delimiter);
			
			if (count($arr) > $max['count']) {
				$max['delimiter'] = $delimiter;
				$max['count'] = count($arr);
			}
		}
		
		if ($max['count'] >= 4) {
			$result['delimiter'] = $max['delimiter'];
		}
		
		return $result;
	}
	
	
	/*
	* get Field set
	*/
	public function getFieldSets() {
		$save_params=$this->session->userdata('save_params');		
		$this->params=$save_params;
		$params = $this->params;
		
		$fields = array(
			'model' => array(
				'field' => 'model',
				//'required' => false,
				'copy'  => true,
				'name'  => 'Model',
				'must'	=> 'must',
				//'descr' => 'A unique product code required'
				'descr' => 'A unique product model required'
			),
			'sku' => array(
				'field' => 'sku',
				'copy'  => true,
				'name'  => 'SKU',
				'descr' => ''
			),
			'upc' => array(
				'field' => 'upc',
				'copy'  => true,
				'name'  => 'UPC',
				'descr' => 'Universal Product Code',
			),			
			'ean' => array(
				'field' => 'ean',
				'copy'  => true,
				'name'  => 'EAN',
				'descr' => 'European Article Number',
			),
			'jan' => array(
				'field' => 'jan',
				'copy'  => true,
				'name'  => 'JAN',
				'descr' => 'Japanese Article Number',
			),
			'isbn' => array(
				'field' => 'isbn',
				'copy'  => true,
				'name'  => 'ISBN',
				'descr' => 'International Standard Book Number',
			),
			'mpn' => array(
				'field' => 'mpn',
				'copy'  => true,
				'name'  => 'MPN',
				'descr' => 'Manufacturer Part Number',
			),			
			array(
				'field' => 'name',
				'name'  => 'Product Name',
				'descr' => 'Product name',
				'must'	=> 'must'
			),
			array(
				'field'    => 'product_description',
				'name'     => 'Description',
				'descr'    => 'Product description',
			),
			array(
				'field'    => 'category_id',
				'name'     => 'Category ID',
				'descr'    => "If this field is specified then the 'category name' field will be ignored",
			),
			array(
				'field'    => 'category',
				'name'     => 'Category Name',
				'descr'    => 'Full category path. Example: category' . $this->params['cat_separator'] . 'subcategory1' . $this->params['cat_separator'] . 'subcategory2',
				'tip'      => htmlspecialchars('This product import extension can find or create categories by name. CSV Category Import extension.'),
			),
			array(
				'field' => 'location',
				'copy'  => true,
				'name'  => 'Location',
				'descr' => 'This field is not used in front-end but it can be defined for products'
			),
			array(
				'field' => 'quantity',
				'copy'  => true,
				'name'  => 'Quantity',
				'descr' => ''
			),			
			array(
				'field' => 'min_quantity',
				'copy'  => true,
				'name'  => 'Minimum Quantity',
				'descr' => ''
			),
			'subtract' => array(
				'field' => 'subtract_stock',
				'copy'  => true,
				'name'  => 'Subtract Stock',
				'descr' => "1 - Yes, 0 - No."
			),
			'stock_status' => array(
				'field' => 'stock_status_id',
				'name'  => 'Out of Stock Status',
				'descr' => 'Name of the stock status. Only stock statuses registered in the store are processed.'
			),			 
			'shipping' => array(
				'field' => 'shipping',
				'copy'  => true,
				'name'  => 'Requires Shipping',
				'descr' => '1 - Yes, 0 - No.'
			),
			array(
				'field' => 'status',
				'name'  => 'Status',
				'descr' => "Status 'Enabled' can be defined by '1' or 'Y'. If the status column is not used then behavior depends on the extension settings."
			),			
			array(
				'field' => 'image',
				'name'  => 'Main Product Image',
				'descr' => "A relative path to the image file within 'image' directory or URL."
			),
			array(
				'field' => 'additional_image',
				'name'  => 'Additional Product Image',
				'descr' => "A relative path to the image file within 'image' directory or URL."
			),
			array(				
				'field' => 'manufacturer_id',
				'name'  => 'Manufacturer',
				'descr' => 'Manufacturer name'
			),
			array(				
				'field' => 'manufacture_catalog_no',
				'name'  => 'Manufacture Catalog No',
				'descr' => 'Manufacture catalog no'
			),
			array(				
				'field' => 'manufacture_product_code',
				'name'  => 'Manufacture Product Code',
				'descr' => 'Manufacture product code'
			),
			array(				
				'field' => 'manufacture_catalog_name',
				'name'  => 'Manufacture Catalog Name',
				'descr' => 'Manufacture catalog name'
			),			
			array(
				'field' => 'price',
				'name'  => 'Price',
				'descr' => 'Regular product price in primary currency (' . $this->common->config('config_currency') . ')',
			),
			array(
				'field' => 'manufacturer_price',
				'name'  => 'Manufacturer Price',
				'descr' => 'Product manufacturer price in primary currency (' . $this->common->config('config_currency') . ')',
			),
			array(
				'field' => 'tax_class_id',
				'name'  => 'Tax class',
				'descr' => 'Tax class'
			),
			array(
				'field' => 'weight',
				'name'  => 'Weight',
				'descr' => 'Weight class units (declared in the store) can be used with the value. Example: 15.98lbs (no spaces).'
			),
			array(
				'field' => 'length',
				'name'  => 'Length',
				'descr' => 'Length class units (declared in the store) can be used with the value. Example: 1.70m (no spaces)'
			),
			array(
				'field' => 'width',
				'name'  => 'Width',
				'descr' => 'Length class units (declared in the store) can be used with the value. Example: 1.70m (no spaces)'
			),
			array(
				'field' => 'height',
				'name'  => 'Height',
				'descr' => 'Length class units (declared in the store) can be used with the value. Example: 1.70m (no spaces)'
			),
			array(
				'field' => 'meta_keyword',
				'name'  => 'Meta tag keywords',
				'descr' => ''
			),
			array(
				'field' => 'meta_title',
				'name'  => 'Meta title',
				'descr' => ''
			),
			array(
				'field' => 'meta_description',
				'name'  => 'Meta tag description',
				'descr' => ''
			),
			'points' => array(
				'field' => 'points',
				'copy'  => true,
				'name'  => 'Points Required',
				'descr' => 'Number of reward points required to make purchase'
			),
			'sort_order' => array(
				'field' => 'sort_order',
				'copy'  => true,
				'name'  => 'Sort Order',
				'descr' => ''
			),
			/*array(
				'field' => 'seo_keyword',
				'name'  => 'SEO Keyword',
				'descr' => 'SEO friendly URL for the product. Make sure that it is unique in the store.'
			),*/
			array(
				'field' => 'seo_url',
				'name'  => 'SEO URL',
				'must'	=> 'must',
				'descr' => 'SEO friendly URL for the product. Make sure that it is unique in the store.'				
			),
			/*array(
				'field' => 'product_tags',
				'name'  => 'Product Tags',
				'descr' => 'List of product tags separated by comma'
			),*/
			array(
				'field' => 'date_available',
				'name'  => 'Date Available',
				'descr' => 'Format: YYYY-MM-DD, Example: 2012-03-25'
			),
			/*array(
				'field' => 'related_product',
				'name'  => 'Related Product',
				'descr' => 'model identifier of the related product',
			),*/
			'downloads' => array(
				'field' => 'downloads',
				'name'  => 'Downloads',
				'descr' => 'Downloadable file(s)',
			),
			/*'layout'    => array(
				'field' => 'layout',
				'name'  => 'Laytout',
				'descr' => 'Product layout'
			),*/
		);
		
		/*$enable_delete_flag = true;
		if ($enable_delete_flag) {
			$fields[] = array(
				'field' => 'delete_product_flag',
				'name'  => '"Delete Product" Flag',
				'descr' => 'Any non-empty value will be treated as positive confirmation, be careful',
			);
			$fields[] = array(
				'field' => 'remove_from_store',
				'name'  => 'Remove from Store',
				'descr' => "Set this flag to a non empty value in order to remove the product from the stores selected on the prevous step (without real deletion from the database). It might be useful for multi-store solutions.",
			);
		}*/
		
		/*if ($this->config->get('ka_pi_enable_product_id')) {
			$product_id_field = array(
				'field' => 'product_id',
				'name'  => 'product_id',
				'descr' => 'You import this value at your own risk.'
			);
			array_unshift($fields, $product_id_field);
		}*/

		$this->addCustomProductFields($fields);
		
		/*foreach ($this->key_fields as $kfk => $kfv) {
			$fields[$kfv]['required'] = true;
		}*/
		
		$specials = array(
			array(
				'field' => 'customer_group',
				'name'  => 'Customer Group',
				'descr' => ''
			),
			array(
				'field' => 'priority',
				'name'  => 'Prioirity',
				'descr' => ''
			),
			array(
				'field'    => 'price',
				'name'     => 'Price',
				'descr'    => ''
			),
			array(
				'field' => 'date_start',
				'name'  => 'Date Start',
				'descr' => 'Format: YYYY-MM-DD, Example: 2012-03-25'
			),
			array(
				'field' => 'date_end',
				'name'  => 'Date End',
				'descr' => 'Format: YYYY-MM-DD, Example: 2012-03-25'
			),
		);			

		$discounts = array(
			array(
				'field' => 'customer_group',
				'name'  => 'Customer Group',
				'descr' => ''
			),
			'quantity' => array(
				'field' => 'quantity',
				'name'  => 'Quantity',
				'descr' => ''
			),
			'priority' => array(
				'field' => 'priority',
				'name'  => 'Prioirity',
				'descr' => ''
			),
			'price' => array(
				'field' => 'price',
				'name'  => 'Price',
				'descr' => ''
			),
			'date_start' => array(
				'field' => 'date_start',
				'name'  => 'Date Start',
				'descr' => 'Format: YYYY-MM-DD, Example: 2012-03-25'
			),
			'date_end' => array(
				'field' => 'date_end',
				'name'  => 'Date End',
				'descr' => 'Format: YYYY-MM-DD, Example: 2012-03-25'
			),
		);			

		$reward_points = array(
			'customer_group' => array(
				'field' => 'customer_group',
				'name'  => 'Customer Group',
				'descr' => '',
			),
			'points' => array(
				'field'    => 'points',
				'name'     => 'Reward Points',
				'descr'    => '',
			),
		);

		$ext_options = array(
			'name' => array(
				'field' => 'name',
				'name'  => 'Option Name',
				'descr' => 'required'
			),
			'type' => array(
				'field' => 'type',
				'name'  => 'Option Type',
				'descr' => 'required'
			),
			'value' => array(
				'field' => 'value',
				'name'  => 'Option Value',
				'descr' => 'required'
			),
			'required' => array(
				'field' => 'required',
				'name'  => 'Option Required',
				'descr' => ''
			),
			'image' => array(
				'field' => 'image',
				'name'  => 'Option Image',
				'descr' => ''
			),
			'sort_order' => array(
				'field' => 'sort_order',
				'name'  => 'Value Sort Order',
				'descr' => 'Sort order for option values'
			),
			'group_sort_order' => array(
				'field' => 'group_sort_order',
				'name'  => 'Group Sort Order',
				'descr' => 'Sort order for option groups. Empty cells are skipped.'
			),
			'quantity' => array(
				'field' => 'quantity',
				'name'  => 'Option Quantity',
				'descr' => ''
			),
			'subtract' => array(
				'field' => 'subtract',
				'name'  => 'Option Subtract',
				'descr' => ''
			),
			'price' => array(
				'field' => 'price',
				'name'  => 'Option Price',
				'descr' => ''
			),
			'points' => array(
				'field' => 'points',
				'name'  => 'Option Points',
				'descr' => ''
			),
			'weight' => array(
				'field' => 'weight',
				'name'  => 'Option Weight',
				'descr' => ''
			),
		);

		$reviews = array(
			'author' => array(
				'field' => 'author',
				'name'  => 'Author',
				'descr' => 'Text field. Mandatory.'
			),
			'text' => array(
				'field' => 'text',
				'name'  => 'Review Text',
				'descr' => 'Mandatory.'
			),
			'rating' => array(
				'field' => 'rating',
				'name'  => 'Rating',
				'descr' => 'Mandatory. number (1 - 5)'
			),
			'status' => array(
				'field' => 'status',
				'name'  => 'Status',
				'descr' => '1 - enabled (default value), 0 - disabled'
			),
			'date_added' => array(
				'field' => 'date_added',
				'name'  => 'Date Added',
				'descr' => 'Recommended format:YYYY-MM-DD HH:MM:SS'
			),
			'date_modified' => array(
				'field' => 'date_modified',
				'name'  => 'Date Modified',
				'descr' => 'Recommended format:YYYY-MM-DD HH:MM:SS'
			),
		);
		
		$sets = array(
			'fields'        => $fields,
			'discounts'     => $discounts,
			'specials'      => $specials,
			'reward_points' => $reward_points,
			'ext_options'   => $ext_options,
			'reviews'       => $reviews,
		);
	
		$sets['attributes'] = $this->attributes->getAttributes();
		
		$sets['options'] = $this->option->getOptions();
		
		$sets['filter_groups']   = $this->filter->getFilterGroups();
		
		/*$sets['product_profiles'] = array(
			'name' => array(
				'field'    => 'name',
				'name'     => 'Profile name',
				'descr'    => '',
			),
			'customer_group' => array(
				'field' => 'customer_group',
				'name'  => 'Customer Group',
				'descr' => '',
			),
		);*/
		/*echo "<pre>";
		print_r($sets['attributes']);
		echo "</pre>";	
		exit;*/
		return $sets;
	}
	
	
	/*
		Extends array with custom fields from the product table only.
		
	*/	
	public function addCustomProductFields(&$fields) {
		$default_fields = array('product_id', 'model', 'sku', 'upc', 'ean', 'jan', 'isbn', 'mpn','location', 'quantity', 'stock_status_id', 'image', 'manufacturer_id', 'shipping','price', 'tax_class_id', 'date_available', 'weight', 'weight_class','length', 'width', 'height','length_class', 'subtract', 'min_quantity', 'sort_order', 'skip_import','status', 'date_added', 'date_modified', 'viewed'
		);
		
		if (!empty($fields)) {
			foreach ($fields as $field) {
				$default_fields[] = $field['field'];
			}
		}
	
		$qry_product_fields = $this->db->query('SHOW FIELDS FROM product');
		$qry=$qry_product_fields->row_array();
		//if (empty($qry->rows)) {
		if ($qry_product_fields->num_rows() > 0) {
			return false;
		}
		
		foreach ($qry as $row) {
			if (in_array($row['Field'], $default_fields)) {
				continue;
			}
			
			$field = array(
				'field' => $row['Field'],
				'copy'  => true,
				'name'  => $row['Field'],
				'descr' => 'Custom field. Type: ' . $row['Type']
			);
			
			$fields[] = $field;
		}
		
		return true;
	}
	
	/*
		$matches - sets array
		$matches - hash array of column names			
	*/
	public function copyMatches(&$sets, $matches, $columns) {

		// remove empty columns except the first one meaning 'not selected'
		//
		foreach ($columns as $ck => $cv) {
			if ($ck == 0 || !empty($cv)) {
				$tmp[$cv] = $ck;
			}
		}
		$columns = $tmp;

		foreach ($sets as $sk => $sv) {
		
			foreach ($sv as $f_idx => $f_data) {
				if ($sk == 'filter_groups') {
					$f_key = $f_data['filter_group_id'];
					
				} elseif ($sk == 'attributes') {
					$f_key = $f_data['attribute_id'];
					
				} elseif ($sk == 'options') {
					$f_key = $f_data['option_id'];
					
					if (isset($matches['required_options'][$f_key])) {
						$sets[$sk][$f_idx]['required'] = true;
					}
					
				} else {
					$f_key = (isset($f_data['field']) ? $f_data['field']:$f_idx);
				}
				
				if (isset($matches[$sk][$f_key])) {
					if (isset($columns[$matches[$sk][$f_key]])) {
						$sets[$sk][$f_idx]['column'] = $columns[$matches[$sk][$f_key]];
					}
				}
			}
		}
		
		return true;
	}
	
	
	/*
		PARAMETERS:
			$matches - an array with field sets
				array(
					'fields' =>
									array(
										'field' => 'model',
										'required' => true,
										'copy'  => true,
										'name'  => 'Model',
										'descr' => 'A unique product code required by Opencart'
									),
									...
					'options'    =>
					'attributes' =>
					...
			 	
			$columns - an array with column names like
				arrray(
					0 => 'model'
					1 => 'name'
					...
				);

		RETURNS:
			true  - on success. In this case the matches array is extended with th 'column' value
							containing the column name associated with the field.

			false - error.
	*/
	public function findMatches(&$matches, $columns) {

		$tmp = array();
		$name="";
		foreach ($columns as $ck => $cv) {
			$cv = utf8_strtolower($cv, 'utf-8');			
			$tmp[$cv] = $ck;
		}
		$columns = $tmp;
		/*echo "<pre>";
		print_r($columns);
		echo "</pre>";*/
		//exit;
		/*
			'set name' => (
				<field id>
				<readable name for users>
				<prefix>
			);
		*/
		$sets = array(
			'fields'        => array('field', 'name', ''), 
			'attributes'    => array('attribute_id', 'name', 'attribute:'),
			'filter_groups' => array('filter_group_id', 'name', 'filter group:'), 
			'options'       => array('option_id', 'name', 'simple option:'),
			'ext_options'   => array('field', 'name', 'option:'),
			'discounts'     => array('field', 'name', 'discount:'),
			'specials'      => array('field', 'name', 'special:'),
			/*'reward_points' => array('field', 'name', 'reward point:'),
			'product_profiles' => array('field', 'name', 'product profile:'),
			'reviews' => array('field', 'name', 'review:'),*/
		);
		
		foreach ($sets as $sk => $sv) {
		
			if (!isset($matches[$sk])) {
				continue;
			}
			
			foreach ($matches[$sk] as $mk => $mv) {
				/*echo "<pre>";
				print_r($sv);
				echo "</pre>";
				exit;*/
			
				//$name=utf8_strtolower($mv[$sv[1]], 'utf-8');
				
				if (isset($mv['column'])) {
					continue;
				}				
				
				$field = utf8_strtolower($mv[$sv[0]], 'utf-8');
				//$name  = utf8_strtolower($mv[$sv[1]], 'utf-8');
				
				//echo $name;
				//exit;
				/*if (isset($columns[$sv[2]. $field])) {
					$mv['column'] = $columns[$sv[2]. $field];
					
				} elseif (isset($columns[$sv[2]. $name])) {
					$mv['column'] = $columns[$sv[2]. $name];
				} else {
					$mv['column'] = 0;
				}*/
				if (isset($columns[$sv[2]. $field])) {
					$mv['column'] = $columns[$sv[2]. $field];
					
				/*} elseif (isset($columns[$sv[1]. $name])) {
					$mv['column'] = $columns[$sv[1]. $name];*/
				} else {
					$mv['column'] = 0;
				}
				$matches[$sk][$mk] = $mv;
			}
		}
		
		return true;
	}
	
	
	public function initImport($params) {

		if (!$this->openFile($params)) {
			//$this->report("initImport: file was not loaded. Last Error:" . $this->lastError);
			
			return false;
		}
		
		// clean up the temporary table		
		//
		/*$this->db->query("DELETE FROM ka_product_import
				WHERE 
					token = '" . $this->session->data['token'] . "'
					OR TIMESTAMPDIFF(HOUR, added_at, NOW()) > 168"
		);*/


		$this->params = $params;
		/*echo "<pre>";
		print_r($this->params);
		echo "</pre>";
		exit;*/
		
		if (!empty($this->params['images_dir'])) {
			$this->params['images_dir'] = $this->kaformat->strip($this->params['images_dir'], array("\\", "/"));
			if (!empty($this->params['images_dir'])) {
				$this->params['images_dir'] = $this->params['images_dir'] . '/';
			}
		}
		// store relative path in incoming images directory 
		// important: if incoming_images_dir exists then it should ends with slash
		//
		/*$incoming_images_dir = '';
		if (!empty($this->params['incoming_images_dir'])) {
			$this->params['incoming_images_dir'] = $this->kaformat->strip($this->params['incoming_images_dir'], array("\\", "/"));
			if (!empty($this->params['incoming_images_dir'])) {
				$incoming_images_dir = $this->params['incoming_images_dir'] . '/';
			}
		}
		$this->params['incoming_images_dir'] = $incoming_images_dir;*/

		// remove sets if they are not required in the current import
		//
		$sets = $this->getFieldSets();
		$this->copyMatches($sets, $params['matches'], $params['columns']);
		
		foreach ($sets as $sk => $sv) {
		
			$has_column = false;
			foreach ($sv as $msk => $msv) {
				if (isset($msv['column'])) {
					$has_column = true;
				}
			}
			
			if (!$has_column) {
				unset($sets[$sk]);
			}
		}
		
		$this->params['matches'] = $sets;

		/*$this->params['status_for_new_products']      = $this->config->get('ka_pi_status_for_new_products');
		$this->params['status_for_existing_products'] = $this->config->get('ka_pi_status_for_existing_products');
		$this->params['ka_pi_options_separator']      = $this->config->get('ka_pi_options_separator');
		$this->params['skip_img_download']            = $this->config->get('ka_pi_skip_img_download');
		$this->params['ka_pi_image_separator']        = str_replace(array('\r','\n'), array("\r", "\n"), $this->config->get('ka_pi_image_separator'));*/

		$this->params['cat_separator'] = $this->params['cat_separator'];
		//$this->params['multicat_sep']  = $this->config->get('ka_pi_multicat_separator');
		
		/*$this->params['opt_create_options']       = $this->config->get('ka_pi_create_options');
		$this->params['opt_compare_as_is']        = $this->config->get('ka_pi_compare_as_is');
		$this->params['opt_generate_seo_keyword'] = $this->config->get('ka_pi_generate_seo_keyword');*/
		
		$download_source_dir = '';
		if (!empty($this->params['download_source_dir'])) {
			$this->params['download_source_dir'] = $this->kaformat->strip($this->params['download_source_dir'], array("\\", "/"));
			if (!empty($this->params['download_source_dir'])) {
				$download_source_dir = dirname(DIR_APPLICATION) . DIRECTORY_SEPARATOR . $this->params['download_source_dir'] . '/';
			}
		}
		$this->params['download_source_dir'] = $download_source_dir;
		
		$this->params['field_lengths'] = $this->getFieldLengths('product', array('model', 'sku', 'upc'));
		
		$this->stat = array(
			'filesize'         => filesize($params['file']),
			'offset'           => 0,

			'started_at'       => time(),

			'lines_processed'  => 0,
			'products_created' => 0,			
			'products_updated' => 0,
			'products_deleted' => 0,

			'categories_created' => 0,

			'errors'           => array(),
			'status'           => 'not_started',
			'col_count'        => count($params['columns']),
		);
		
		//$this->kalog->write("Import started. Parameters: " . var_export($this->stat, true));
		if(empty($this->session->userdata('stat')))
		{
			$this->session->set_userdata('stat',$this->stat);
		}
		else
		{
			$this->session->unset_userdata('stat');
			$this->session->set_userdata('stat',$this->stat);
		}
		
		return true;
	}
	
	/*
		it works with varchar(...) type only right now
		
		RETURNS:
			array where keys are fields, values are field lengths
	*/
	public function getFieldLengths($table, $fields) {
	
		$qry = $this->db->query("DESCRIBE `$table`");
		if (empty($qry->rows) || empty($fields)) {
			return false;
		}
		
		$ret = array_combine($fields, array_fill(0, count($fields), 0));
		foreach ($qry->rows as $f) {

			if (!in_array($f['Field'], $fields)) {
				continue;
			}
		
			if (!preg_match("/varchar\((\d*)\)/", $f['Type'], $matches)) {
				continue;
			}
			
			$ret[$f['Field']] = intval($matches[1]);
		}
		
		return $ret;	
	}
	
	
	/*
		This function is supposed to be called from an external object multiple times. But first you
		will need to call initImport() to define import parameters.

		Import status can be checked by requesting getImportStat() function and verifying $status
		parameter.
	*/
	public function processImport() {
		
		$this->process();
		
		// switch error output to our stream
		//
		/*if (!defined('KA_DEBUG')) {
			$old_config_error_display = $this->config->get('config_error_display');
			$this->config->set('config_error_display', false);
		}*/
		
		//$this->process();
		
		/*if (!defined('KA_DEBUG')) {
			$this->config->set('config_error_display', $old_config_error_display);
		}*/

		return;
	}
	
	public function getUploadMaxFilesize() {
		static $max_filesize;

		if (!isset($max_filesize)) {
			/*$post_max_size = $this->kaformat->convertToByte(ini_get('post_max_size'));
			$upload_max_filesize = $this->kaformat->convertToByte(ini_get('upload_max_filesize'));*/
			$post_max_size = $this->convertToMegabyte(ini_get('post_max_size'));
			$upload_max_filesize = $this->convertToMegabyte(ini_get('upload_max_filesize'));
			$max_filesize = intval(min($post_max_size, $upload_max_filesize));
		}

    	return $max_filesize;
	}
	
	/*
  		function converts values like 10M to bytes
	*/
	public function convertToByte($file_size) {
		$val = trim($file_size);
		switch (strtolower(substr($val, -1))) {
			case 'g':
				$val *= 1024;
			case 'm':
				$val *= 1024;
			case 'k':
				$val *= 1024;
		}
		return $val;
	}
	
	/*
		Function converts value to human readable format like 10.1 Mb 
	*/
	public function convertToMegabyte($val) {
	
		if (!is_numeric($val)) {
			$val = $this->convertToByte($val);
		}

		if ($val >= 1073741824) {
			$val = round($val/1073741824, 1) . " Gb";

		} elseif ($val >= 1048576) {
			$val = round($val/1048576, 1) . " Mb";

		} elseif ($val >= 1024) {
			$val = round($val/1024, 1) . " Kb";
		} else {
			$val = $val . " bytes";
		}

		return $val;
	}	
	
	/*
		PARAMETERS:
			$str   - string
			$chars - a character or array of characters
	*/
	public function strip($str, $chars) {
		
		$str = trim($str);

		if (empty($chars)) {
			return $str;
		}

		if (!is_array($chars)) {
			$chars = array($chars);
		}

		$pat = array();
		$rep = array();
		foreach($chars as $char) {
			$pat[] = "/(" . preg_quote($char, '/') . ")*$/";
			$rep[] = '';
			$pat[] = "/^(" . preg_quote($char, '/') . ")*/";
			$rep[] = '';
		}

		$res = preg_replace($pat, $rep, $str);
		
		return $res;
	}
	
	/*
 		This function is used for writing messages to log and displaying them instantly during development.
 	*/
 	public function report($msg) {

 		if (defined('KA_DEBUG')) {
 			echo $msg;
 		}

		//$this->kalog->write($msg);
 	}
	
	public function getSecPerCycle() {
		return $this->sec_per_cycle;
	}
	
	public function getImportMessages() {
		return $this->messages;
	}

	public function getImportStat() {
	 	return $this->stat;
	}
	
	/*
		function updates $this->stat array.
		
		Import status can be determined by 
			$this->stat['status']  - completed, in_progress, error, not_started
			$this->stat['message'] - last import fatal error
	*/
	public function process() {

		//$this->kaformat = new KaFormat($this->registry, $this->params['language_id']);
		
		$stat_data=$this->session->userdata('stat');
		$this->stat = $stat_data;
		/*echo "<pre>";
		print_r($this->stat);
		echo "</pre>";
		echo $this->stat['status'];
		exit;*/
		if ($this->stat['status'] == 'completed') {
			return;
		}
		
		$max_execution_time = @ini_get('max_execution_time');
		if ($max_execution_time > 5 && $max_execution_time < $this->sec_per_cycle) {
			$this->sec_per_cycle = $max_execution_time - 3;
		}
		
		$started_at = time();
		
		$save_params=$this->session->userdata('save_params');		
					
		unset($save_params['params']['step']);	
		
		$this->params['step'] = 3;	
		
		$save_params['params']['step']=$this->params['step'];
			
		$this->params=$save_params['params'];			
		
		if (!$this->openFile($this->params)) {
			
			//$this->addImportMessage("Cannot open file: " . $this->params['file'], 'E');
			$this->error['warning']="Cannot open file: " . $this->params['file'];
			$this->stat['status']  = 'error';
			return;
		}
		
		
		$col_count = $this->stat['col_count'];
		
		//echo "Check Process";exit;
		if ($this->stat['offset']) {
			
			
			if ($this->kafileutf8->fseek($this->stat['offset']) == -1) {
				//$this->addImportMessage("Cannot offset at $this->stat[offset] in file: $file.", 'E');
				$this->error['warning']= "Cannot offset at $this->stat[offset] in file: $file.";
				$this->stat['status']  = 'error';
				return;
			}
		} else {
			
			$tmp = fgetcsv($this->kafileutf8->handle, 0, $this->params['field_delimiter'], $this->enclosure);
			
			$this->stat['lines_processed'] = 1;
			
			if (is_null($tmp) || count($tmp) != $col_count) {
				//$this->addImportMessage("File header does not match the initial file header.", 'E');
				
				$this->error['warning']= "File header does not match the initial file header.";
				$this->stat['status']  = 'error';
				return;
			}
		}
		
		
		$status = 'error';
		while ($row = fgetcsv($this->kafileutf8->handle, 0, $this->params['field_delimiter'], $this->enclosure)) {
			
			$this->stat['lines_processed']++;
			//$row = $this->request->clean($row);
			$row=$row;
			
			if (!is_array($row)) {
				
				//$this->addImportMessage('File reading error. File ended unexpectedly.');
				$this->error['warning']= "File reading error. File ended unexpectedly.";
				continue;
			}
			
			// compare number of read values against the number of columns in the header
			//
			$row_count = count($row);
			
			if ($row_count < $col_count) {
				
				if ($row_count == 1) {
					continue;
				}

				// extend the line with empty values. MS Excel may 'optimize' a CSV file and remove
				// trailing empty cells
				//
				$tail = array_fill($row_count, $col_count - $row_count, '');
				$row = array_merge($row, $tail);
				
			} elseif ($row_count > $col_count) {
				
				$row = array_slice($row, 0, $col_count);
			}
				

			// delete previous product records like 'specials', 'discounts' etc.
			//
			$delete_old_param = ($this->params['import_mode'] == 'replace');

			$product          = array();
			$data             = array();
			$is_new           = false;

			$is_first_product = true;		// first occurence of the product in the file
			$delete_old       = false;  	// 
			// fill in associated product fields
			//
			if (empty($this->params['matches']['fields'])) {
				
				//$this->addImportMessage("Import script lost parameters. Aborting...");
				$this->error['warning']= "Import script lost parameters. Aborting...";
				$status = 'error';
				break;
			}


			foreach ($this->params['matches']['fields'] as $fk => $fv) {
				if (!isset($fv['column']))
					continue;

				$data[$fv['field']] = trim($row[$fv['column']]);
				
				if (!empty($fv['copy'])) {
					$product[$fv['field']] = $data[$fv['field']];
				}
			}

			if (!empty($data['model'])) {
				$this->product_mark = '(model:' . $data['model'] . '): ';
			} else {
				$this->product_mark = '';
			}
			
			// get product id
			//
			$product_id = $this->getProductId($data);
			if (!empty($this->lastError)) {
				//$this->addImportMessage($this->lastError . " Line " . $this->stat['lines_processed']);
				$this->error['warning']= " Line " . $this->stat['lines_processed'];
				continue;
			}
			
			// here we have two separate ways
			// 1) delete product
			// 2) go through insert/update procedure
			//
			if (!empty($product_id) && !$this->isImportable($product_id)) {
				continue;
				
			} elseif (!empty($data['delete_product_flag'])) {
				if (!empty($product_id)) {
					$this->import_product->deleteProduct($product_id);
					$this->stat['products_deleted']++;
				}
				
			} /*elseif (!empty($data['remove_from_store'])) {
			
				if (!empty($product_id)) {
					$this->removeFromStores('product', $product_id, $this->params['store_ids']);
					$this->stat['products_updated']++;
				}
				
			}*/ else {

				if (empty($product_id)) {

					if (!empty($this->params['skip_new_products'])) {
						continue;
					}
					
					if (!empty($this->params['tpl_product_id'])) {
						if (!empty($data['product_id'])) {
							//$this->addImportMessage('Product template is not used when product_id is specified in the file');
							$this->error['warning']= "Product template is not used when product_id is specified in the file";
						} else {
							$this->import_product->copyProduct($this->params['tpl_product_id']);
							$product_id = $this->import_product->getLastProductId();
						}
					}
					
					if (empty($product_id)) {
					
						if (empty($data['name'])) {
							$this->addImportMessage("Product name is not specified for a new product. Line is skipped: " . $this->stat['lines_processed']);
							continue;
						}
					
						if (empty($data['product_id'])) {
							$this->db->query("INSERT INTO product SET date_modified = '".date('Y-m-d h:i:sa')."', date_added = '".date('Y-m-d h:i:sa')."'");
							$product_id = $this->db->insert_id();
						} else {
							$this->db->query("REPLACE INTO product SET date_modified = '".date('Y-m-d h:i:sa')."', date_added = '".date('Y-m-d h:i:sa')."', product_id = '" . $data['product_id'] . "'");
							$product_id = $data['product_id'];
						}
						
						if (empty($product_id)) {
							//$this->addImportMessage("Insert operation failed.");
							$this->error['warning']= "Insert operation failed.";
							continue;
						}
					}

					$is_new = true;
					$this->stat['products_created']++;
				}

				// check if we already updated the product
				//
				/*$qry = $this->db->query("SELECT product_id FROM ka_product_import
					WHERE product_id = '$product_id'
					AND token='" . $this->session->data['token'] . "';"
				);

				if (empty($qry->row)) {
					$rec = array(
						product_id' => $product_id,
						is_new'     => ($is_new ? 1 : 0),
						token'      => $this->session->data['token']
					);
					$this->kadb->queryInsert('ka_product_import', $rec);
				} else {
					$is_first_product = false;
				}*/
				
				// update product fields once
				//
				if ($is_first_product) {
					$this->kadb->queryUpdate('product', $product, "product_id='$product_id'");
					if (!$this->updateProduct($product_id, $data, $is_new)) {
						continue;
					}
					if (!$is_new) {
						$this->stat['products_updated']++;
					}
				}

				if ($delete_old_param && $is_first_product) {
					$delete_old = true;
				}
			
				$product['product_id'] = $product_id;

				$this->saveCategories($product_id, $data, $delete_old, $is_new);

				$this->saveAdditionalImages($product_id, $data, $delete_old, $is_new);

				$this->saveAttributes($row, $product, $delete_old, $is_first_product);
				
				$this->saveFilters($row, $product, $delete_old);

				$this->saveOptions($row, $product, $delete_old);

				$this->saveDiscounts($row, $product, $delete_old);

				$this->saveSpecials($row, $product, $delete_old);

				//$this->saveRewardPoints($row, $product, $delete_old);

				//$this->saveProductProfiles($row, $product, $delete_old);
								
				$this->saveRelatedProducts($data, $product, $delete_old);
				
				$this->saveDownloads($data, $product, $delete_old);
				
				$this->saveReviews($row, $product, $delete_old);
			}
			
			if (time() - $started_at > $this->sec_per_cycle) {
				$status = 'in_progress';
				break;
			}
		}

		$this->cache->delete('product');

	    if (feof($this->file->handle)) {
	    
	    	fclose($this->file->handle);

    		$this->stat['status'] = 'completed';
    		$this->stat['offset'] = $this->stat['filesize'];
	    	//$this->kalog->write("Import completed. Parameters: " . var_export($this->stat, true));
	    	// rename the import file if required
	    	//
	    	if ($this->params['location'] == 'server' && !empty($this->params['rename_file'])) {
		    	$path_parts = pathinfo($this->params['file']);
	    	
		    	$dest_file  = $path_parts['dirname'] . DIRECTORY_SEPARATOR . $path_parts['filename'] 
					. '.' . 'processed_at_' . date("Ymd-His") 
					. '.' . $path_parts['extension'];
				if (!rename($this->params['file'], $dest_file)) {
					$this->addImportMessage("rename operation failed. from " .$this->params['file'] . " to " . $dest_file);
				}
			}
			
			if (!empty($this->params['disable_not_imported_products'])) {
				$this->disableNotImportedProducts();
			}
			
			$this->deleteRecords();
			
			// clean up the temporary table
			//
			$this->db->query("DELETE FROM " . DB_PREFIX . "ka_product_import
					WHERE token = '" . $this->session->data['token'] . "'"
			);

	    } else if ($status == 'error') {
	    	fclose($this->file->handle);
			$this->stat['status'] = $status;
			
		} else {
			$this->stat['offset'] = ftell($this->file->handle);
			$this->stat['status'] = 'in_progress';
			fclose($this->file->handle);
		}

	    return;
	}

	
	/*public function getProfiles() {
		$qry = $this->db->query("SELECT import_profile_id, name FROM " . DB_PREFIX . "ka_import_profiles");

		$profiles = array();				
		if (!empty($qry->rows)) {
			foreach ($qry->rows as $row) {
				$profiles[$row['import_profile_id']] = $row['name'];
			}
		}
				
		return $profiles;
	}*/
	
	
	
	
	/*
	* csvImportData()
	*/
	public function csvImportData($params)
	{
		set_time_limit(0);
		/*$save_params=$this->session->userdata('save_params');
					
		unset($save_params['params']['step']);
		
		$this->params['step'] = 3;
		$save_params['params']['step']=$this->params['step'];
		//$save_params['params']['multicat_sep']  = ":::";
		$this->params=$save_params['params'];
		$params = $this->params;*/
		
		/*echo "<pre>";
		print_r($params);
		echo "</pre>";
		exit;*/
		/////////////////
		//create main and create sub directories 
		$img_dir=$params['images_dir'];
		$static_image_path="../image/catalog/";
		$table_image_path="catalog/".$img_dir;
		$image_directory=$static_image_path.$img_dir;
		
		$get_dir_make=explode('/',$image_directory);		
			
		$total_dir=count($get_dir_make);
									
		for($i=0;$i<$total_dir;$i++)
		{	
			$path="";
			for($j=0;$j<$i;$j++)
			{	
				$path.=$get_dir_make[$j]."/";
			}			
			
			$new_path=substr_replace($path, "", -1);
					
			if(!is_dir($path.$get_dir_make[$i]))	
			{
				mkdir($path.$get_dir_make[$i]);			
			}		
		}
		
		//get main path
		for($mpi=0;$mpi<=$total_dir;$mpi++)
		{
			$mainpath="";
			for($mpj=0;$mpj<$mpi;$mpj++)
			{
				$mainpath.=$get_dir_make[$mpj]."/";
			}
		}			
		//////////////////
		
		$make_str="";
		$model_name="";
		$category_name="";
		$col_list="";
		$total_record_inserted=0;
		$total_record_updated=0;
		$csv_total_record=0;
			
		$import_mode=$params['import_mode'];
		
		//General tab
		$match_field=array();
		$match_field_key=array();
		$model=0;
		$field_model=$this->input->post('fields[model]');
		if($field_model != 0)
		{
			$model=(int)$field_model-1;
			$match_field['model']=$model;			
		}
		//echo $match_field['model'];exit;
		$field_sku=$this->input->post('fields[sku]');
		if($field_sku != 0)
		{
			$sku=(int)$field_sku-1;
			$match_field['sku']=$sku;			
		}
		
		$field_upc=$this->input->post('fields[upc]');
		if($field_upc != 0)
		{
			$upc=(int)$field_upc-1;
			$match_field['upc']=$upc;
			
		}
		
		$field_ean=$this->input->post('fields[ean]');
		if($field_ean != 0)
		{
			$ean=(int)$field_ean-1;
			$match_field['ean']=$ean;
		}
		
		$field_jan=$this->input->post('fields[jan]');
		if($field_jan != 0)
		{
			$jan=(int)$field_jan-1;
			$match_field['jan']=$jan;
		}
		
		$field_isbn=$this->input->post('fields[isbn]');
		if($field_isbn != 0)
		{
			$isbn=(int)$field_isbn-1;
			$match_field['isbn']=$isbn;
		}
		
		$field_mpn=$this->input->post('fields[mpn]');
		if($field_mpn != 0)
		{
			$mpn=(int)$field_mpn-1;
			$match_field['mpn']=$mpn;
		}
		
		$field_product_name=$this->input->post('fields[name]');
		if($field_product_name != 0)
		{
			$product_name=(int)$field_product_name-1;
			$match_field['product_name']=$product_name;
		}
		
		$field_product_description=$this->input->post('fields[product_description]');
		if($field_product_description != 0)
		{
			$product_description=(int)$field_product_description-1;
			$match_field['product_description']=$product_description;
		}
		
		$field_category_name=$this->input->post('fields[category]');
		if($field_category_name != 0)
		{
			$category_name=(int)$field_category_name-1;
			$data['category_name']=$category_name;
			//$match_field['category_name']=$category_name;
		}
		
		$field_location=$this->input->post('fields[location]');
		if($field_location != 0)
		{
			$location=(int)$field_location-1;
			$match_field['location']=$location;
		}
		
		$field_quantity=$this->input->post('fields[quantity]');
		if($field_quantity != 0)
		{
			$quantity=(int)$field_quantity-1;
			$match_field['quantity']=$quantity;
		}
		
		$field_min_quantity=$this->input->post('fields[min_quantity]');
		if($field_min_quantity != 0)
		{
			$min_quantity=(int)$field_min_quantity-1;
			$match_field['min_quantity']=$min_quantity;
		}
		
		$field_subtract_stock=$this->input->post('fields[subtract_stock]');
		if($field_subtract_stock != 0)
		{
			$subtract_stock=(int)$field_subtract_stock-1;
			$match_field['subtract_stock']=$subtract_stock;
		}
		
		$field_stock_status_id=$this->input->post('fields[stock_status_id]');
		if($field_stock_status_id != 0)
		{
			$stock_status_id=(int)$field_stock_status_id-1;
			$match_field['stock_status_id']=$stock_status_id;
		}
		
		$field_shipping=$this->input->post('fields[shipping]');
		if($field_shipping != 0)
		{
			$shipping=(int)$field_shipping-1;
			$match_field['shipping']=$shipping;
		}
		
		$field_status=$this->input->post('fields[status]');
		if($field_status != 0)
		{
			$status=(int)$field_status-1;
			$match_field['status']=$status;
		}
		
		$field_image=$this->input->post('fields[image]');
		if($field_image != 0)
		{
			$image=(int)$field_image-1;
			$match_field['image']=$image;
		}
				
		$field_additional_image=$this->input->post('fields[additional_image]');
		if($field_additional_image != 0)
		{
			$additional_image=(int)$field_additional_image-1;
			$data['additional_image']=$additional_image;
		}	
		
		$field_manufacturer_id=$this->input->post('fields[manufacturer_id]');
		if($field_manufacturer_id != 0)
		{
			$manufacturer_id=(int)$field_manufacturer_id-1;
			$match_field['manufacturer_id']=$manufacturer_id;			
		}
		
		$field_manufacture_catalog_no=$this->input->post('fields[manufacture_catalog_no]');
		if($field_manufacture_catalog_no != 0)
		{
			$manufacture_catalog_no=(int)$field_manufacture_catalog_no-1;
			$match_field['manufacture_catalog_no']=$manufacture_catalog_no;			
		}
		
		$field_manufacture_product_code=$this->input->post('fields[manufacture_product_code]');
		if($field_manufacture_product_code != 0)
		{
			$manufacture_product_code=(int)$field_manufacture_product_code-1;
			$match_field['manufacture_product_code']=$manufacture_product_code;			
		}
		
		$field_manufacture_catalog_name=$this->input->post('fields[manufacture_catalog_name]');
		if($field_manufacture_catalog_name != 0)
		{
			$manufacture_catalog_name=(int)$field_manufacture_catalog_name-1;
			$match_field['manufacture_catalog_name']=$manufacture_catalog_name;			
		}
		
		$field_price=$this->input->post('fields[price]');
		if($field_price != 0)
		{
			$price=(int)$field_price-1;
			$match_field['price']=$price;
		}
		
		$field_manufacturer_price=$this->input->post('fields[manufacturer_price]');
		if($field_manufacturer_price != 0)
		{
			$manufacturer_price=(int)$field_manufacturer_price-1;
			$match_field['manufacturer_price']=$manufacturer_price;
		}
		
		$field_tax_class_id=$this->input->post('fields[tax_class_id]');
		if($field_tax_class_id != 0)
		{
			$tax_class_id=(int)$field_tax_class_id-1;
			$match_field['tax_class_id']=$tax_class_id;
		}
		
		$field_weight=$this->input->post('fields[weight]');
		if($field_weight != 0)
		{
			$weight=(int)$field_weight-1;
			$match_field['weight']=$weight;
		}
		
		$field_length=$this->input->post('fields[length]');
		if($field_length != 0)
		{
			$length=(int)$field_length-1;
			$match_field['length']=$length;
		}
		
		$field_width=$this->input->post('fields[width]');
		if($field_width != 0)
		{
			$width=(int)$field_width-1;
			$match_field['width']=$width;
		}
		
		$field_height=$this->input->post('fields[height]');
		if($field_height != 0)
		{
			$height=(int)$field_height-1;
			$match_field['height']=$height;
		}
		
		$field_meta_keyword=$this->input->post('fields[meta_keyword]');
		if($field_meta_keyword != 0)
		{
			$meta_keyword=(int)$field_meta_keyword-1;
			$match_field['meta_keyword']=$meta_keyword;
		}
		
		$field_meta_title=$this->input->post('fields[meta_title]');
		if($field_meta_title != 0)
		{
			$meta_title=(int)$field_meta_title-1;
			$match_field['meta_title']=$meta_title;
		}
		
		$field_meta_description=$this->input->post('fields[meta_description]');
		if($field_meta_description != 0)
		{
			$meta_description=(int)$field_meta_description-1;
			$match_field['meta_description']=$meta_description;
		}
		
		$field_sort_order=$this->input->post('fields[sort_order]');
		if($field_sort_order != 0)
		{
			$sort_order=(int)$field_sort_order-1;
			$match_field['sort_order']=$sort_order;
		}
		
		$field_seo_url=$this->input->post('fields[seo_url]');
		if($field_seo_url != 0)
		{
			$seo_url=(int)$field_seo_url-1;
			$match_field['seo_url']=$seo_url;
			$data['seo_url']=$seo_url;
		}
		
		$field_date_available=$this->input->post('fields[date_available]');
		if($field_date_available != 0)
		{
			$date_available=(int)$field_date_available-1;
			$match_field['date_available']=$date_available;
		}
		
		$field_download_source_dir=$this->input->post('fields[downloads]');
		if($field_download_source_dir != 0)
		{
			$download_source_dir=(int)$field_download_source_dir-1;
			$data['downloads']=$download_source_dir;
		}
		
		/*echo "<pre>";
		//print_r($match_field);
		print_r($data);
		echo "</pre>";
		exit;*/
		/* options */
		$sets= $this->getFieldSets();
		
		$option_id_list=array();
		$match_options=array();
		$match_options1=array();
		foreach($sets['options'] as $option_key=>$option_value)
		{
			$option_column_value1=0;
			
			$option_id_list[]=$option_value['option_id'];	
						
			$op_id=$option_value['option_id'];
			$option_column_value=$this->input->post("options[$op_id]");	
			
			if($option_column_value != 0)
			{		
				$option_required=$this->input->post("required_options[$op_id]");
				if($option_required == "Y")
				{
					$option_required=1;
				}
				else
				{
					$option_required=0;
				}
				//echo $op_id."||".$option_required."<br>";		
				$match_options['option_id']=$option_value['option_id'];	
				$match_options['type']=$option_value['type'];
				$match_options['sort_order']=$option_value['sort_order'];
				$match_options['group_sort_order']=$option_value['sort_order'];				
				$match_options['name']=$option_value['name'];
				$match_options['column']=$option_column_value-1;
				$match_options['required']=$option_required;
				$match_options1[]=$match_options;
				$option_column_value=0;
			}
			/*else
			{
				$match_options['option_id']=$option_value['option_id'];	
				$match_options['type']=$option_value['type'];
				$match_options['sort_order']=$option_value['sort_order'];
				$match_options['name']=$option_value['name'];	
				$match_options1[]=$match_options;			
				$option_column_value=0;
			}*/
			//$option_column_value=0;
		}
			
		
		$data['match_params_option']=$match_options1;
		/*echo"<pre>";
		print_r($data['match_params_option']);
		echo"</pre>";
		exit;*/
		/* //options */
				
		/* discounts */
		$d_customer_group=0;
		$d_price=0;
		$d_priority=0;
		$d_quantity=0;
		$d_date_start=0;
		$d_date_end=0;
		
		$discounts_customer_group=$this->input->post('discounts[customer_group]');
		if($discounts_customer_group != 0)
		{
			$d_customer_group=(int)$discounts_customer_group-1;
			$data['discount_customer_group']=$d_customer_group;
		}
		
		$discount_price=$this->input->post('discounts[price]');
		if($discount_price != 0)
		{
			$d_price=(int)$discount_price-1;
			$data['discount_price']=$d_price;
		}
		
		$discount_priority=$this->input->post('discounts[priority]');
		if($discount_priority != 0)
		{
			$d_priority=(int)$discount_priority-1;
			$data['discount_priority']=$d_priority;
		}
		
		$discounts_quantity=$this->input->post('discounts[quantity]');
		if($discounts_quantity != 0)
		{
			$d_quantity=(int)$discounts_quantity-1;
			$data['discount_quantity']=$d_quantity;
		}
		
		$discounts_date_start=$this->input->post('discounts[date_start]');
		if($discounts_date_start != 0)
		{
			$d_date_start=(int)$discounts_date_start-1;
			$data['discount_date_start']=$d_date_start;
		}
		
		$discounts_date_end=$this->input->post('discounts[date_end]');
		if($discounts_date_end != 0)
		{
			$d_date_end=(int)$discounts_date_end-1;
			$data['discount_date_end']=$d_date_end;
		}		
		
		$sets= $this->getFieldSets();
		foreach($sets['discounts'] as $d_key=>$d_val)
		{			
			if($d_key == "customer_group")
			{
				if($d_customer_group != 0)
				{
					$sets['discounts'][$d_key]['column']=$d_customer_group;
				}
			}
			if($d_key == "price")
			{
				if($d_price != 0)
				{
					$sets['discounts'][$d_key]['column']=$d_price;
				}
			}
			if($d_key == "priority")
			{
				if($d_priority != 0)
				{
					$sets['discounts'][$d_key]['column']=$d_priority;
				}
			}
			if($d_key == "quantity")
			{
				if($d_quantity != 0)
				{
					$sets['discounts'][$d_key]['column']=$discounts_quantity;
				}
			}					
			if($d_key == "date_start")
			{
				if($d_date_start != 0)
				{
					$sets['discounts'][$d_key]['column']=$d_date_start;
				}
			}			
			if($d_key == "date_end")
			{
				if($d_date_end != 0)
				{
					$sets['discounts'][$d_key]['column']=$d_date_end;
				}
			}			
		}		
			
		$data['discounts_data']=$sets['discounts'];
		/*echo "<pre>";
		print_r($this->params['matches']['discounts']);
		echo "</pre>";*/	
		//exit;
		/* //discounts */
		
		/* product Specials */		
		$s_customer_group=0;
		$s_price=0;
		$s_priority=0;
		$s_quantity=0;
		$s_date_start=0;
		$s_date_end=0;
		
		$specials_customer_group=$this->input->post('specials[customer_group]');
		if($specials_customer_group != 0)
		{
			$s_customer_group=(int)$specials_customer_group-1;
			$data['specials_customer_group']=$s_customer_group;
		}
		//echo 'col num: '.$s_customer_group."<br>";exit;
		$specials_price=$this->input->post('specials[price]');
		if($specials_price != 0)
		{
			$s_price=(int)$specials_price-1;
			$data['specials_price']=$s_price;
		}
		
		$specials_priority=$this->input->post('specials[priority]');
		if($specials_priority != 0)
		{
			$s_priority=(int)$specials_priority-1;
			$data['specials_priority']=$s_priority;
		}
		
		$specials_date_start=$this->input->post('specials[date_start]');
		if($specials_date_start != 0)
		{
			$s_date_start=(int)$specials_date_start-1;
			$data['specials_date_start']=$s_date_start;
		}
		
		$specials_date_end=$this->input->post('specials[date_end]');
		if($specials_date_end != 0)
		{
			$s_date_end=(int)$specials_date_end-1;
			$data['specials_date_end']=$s_date_end;
		}
				
		//echo 'col num: '.$s_customer_group."<br>";exit;
		//$sets= $this->getFieldSets();
		//echo count($sets['specials']);exit;
		
		//foreach($sets['specials'] as $s_key=>$s_val)
		$temp_special=array();
		$temp_set=array();
		//echo "<pre>";print_r($sets['specials']);
		foreach($sets['specials'] as $s_key=>$s_val)
		{	
				if($s_val['field'] == "customer_group" && $s_customer_group != 0)
				{	
					//$sets['specials'][$s_val['field']]['column']=$s_customer_group;
					
					$temp_special["customer_group"]=$s_customer_group;
					
				}
				if($s_val['field'] == "price" && $s_price != 0)
				{	
					//$sets['specials'][$s_val['field']]['column']=$s_price;	
					
					$temp_special["price"]=$s_price;
				}
				if($s_val['field'] == "priority" && $s_priority != 0)
				{				
					//$sets['specials'][$s_key]['column'][]=$s_priority;
					$temp_special["priority"]=$s_priority;	
				}								
				if($s_val['field'] == "date_start" && $s_date_start != 0)
				{				
					//$sets['specials'][$s_key]['column'][]=$s_date_start;	
					$temp_special["date_start"]=$s_date_start;
				}			
				if($s_val['field'] == "date_end" && $s_date_end != 0)
				{
					//$sets['specials'][$s_key]['column'][]=$s_date_end;	
					$temp_special["date_end"]=$s_date_start;						
				}			
		}
		
		
		//for($i=0;$i<count($temp_special);$i++)
		foreach($sets['specials'] as $s_key=>$s_val)
		{
			//echo $s_key."||s<br>";
			foreach($temp_special as $ts_key=>$ts_val)
			{		
				//echo $s_val['field'] ."==". $ts_key."<br>";
				if($s_val['field'] == $ts_key)
				{	
					$sets['specials'][$s_key]['column']=$ts_val;
					//$temp_sp_array=$sets['specials'][$ts_key];
					//$temp_sp_array['column']=$ts_val;
					//echo $ts_key."<br>";
					//echo $sets['specials'][$s_key]['column'];
				}
			}
		}
		
		//exit;		
		//echo 'col num in side: '.$s_customer_group."<br>";exit;	
		$data['specials_data']=$sets['specials'];	
		
		/*echo "===============================";
		echo "<pre>";
		print_r($data['specials_data']);
		//print_r($temp_special);
		echo "</pre>";
		exit;*/
		/* //product Specials */
		
		/* product_filter */
		$match_filter=array();
		$make_filter_str="";
		$sets= $this->getFieldSets();
		$filter_id_list=array();
		$filter_group_column_num=0;
		$match_filter_list=array();
		foreach($sets['filter_groups'] as $filter_key=>$filter_value)
		{
			$filter_data['filter_group_id']=$filter_value['filter_group_id'];
			$filter_data['sort_order']=$filter_value['sort_order'];
			$filter_data['filter_group_name']=$filter_value['filter_group_name'];			
			$filter_group_id_list[]=$filter_data;
			//$filter_group_id_list[]=$filter_value['filter_group_id'];			
		}
		
		//get column number 
		foreach($filter_group_id_list as $filter_key=>$filter_value)
		{
			
			//echo $filter_key."=".$filter_value['filter_group_id'];
			$filters_value=$this->input->post("filter_groups[".$filter_value['filter_group_id']."]");
			$filter_col=$filters_value-1;
			//echo $filters_value."<br>";
			if($filters_value > 0)
			{
				$filter_data['filter_group_id']=$filter_value['filter_group_id'];
				$filter_data['sort_order']=$filter_value['sort_order'];
				$filter_data['name']=$filter_value['filter_group_name'];
				$filter_data['column']=$filter_col;	
				$match_filter_list[]=$filter_data;	
					
			}
			else
			{
				$filter_data['filter_group_id']=$filter_value['filter_group_id'];
				$filter_data['sort_order']=$filter_value['sort_order'];
				$filter_data['name']=$filter_value['filter_group_name'];
				$filter_data['column']=0;	
				$match_filter_list[]=$filter_data;
			}		
		}	
		/*echo "<pre>";
		print_r($match_filter_list);		
		echo "</pre>";
		exit;*/
		foreach($sets['filter_groups'] as $f_key=>$f_value)
		{
			foreach($match_filter_list as $tf_key=>$tf_val)
			{		
				//echo $tf_val['name'] ."==". $f_value['filter_group_name']."<br>";
				if($tf_val['name'] == $f_value['filter_group_name'])
				{	
					if($tf_val['column'] != 0)
					{
						$sets['filter_groups'][$f_key]['column']=$tf_val['column'];
					}
				}
			}
		}
		
		$data['filter_data']=$sets['filter_groups'];
		/*echo "<pre>";
		print_r($data['filter_data']);		
		echo "</pre>";
		exit;*/
		/* //product_filter */
		
		/* Product Attributes */
		$match_attribute=array();
		$make_attribute_str="";
		$sets= $this->getFieldSets();
		$attribute_id_list=array();
		$match_attribute_list=array();
		
		foreach($sets['attributes'] as $attribute_key=>$attribute_value)
		{
			//$attribute_id_list[]=$attribute_value['attribute_id'];
			$attributes_value=$this->input->post("attributes[".$attribute_value['attribute_id']."]");
			$attribute_col=$attributes_value-1;
			
			if($attributes_value > 0)
			{
				$attribute_data['attribute_id']=$attribute_value['attribute_id'];
				$attribute_data['attribute_group_id']=$attribute_value['attribute_group_id'];
				$attribute_data['sort_order']=$attribute_value['sort_order'];
				$attribute_data['attribute_name']=$attribute_value['attribute_name'];
				$attribute_data['attribute_group']=$attribute_value['attribute_group'];				
				$attribute_data['column']=$attribute_col;					
				$match_attribute_list[]=$attribute_data;	
					
			}
			else
			{
				$attribute_data['attribute_id']=$attribute_value['attribute_id'];
				$attribute_data['attribute_group_id']=$attribute_value['attribute_group_id'];
				$attribute_data['sort_order']=$attribute_value['sort_order'];
				$attribute_data['attribute_name']=$attribute_value['attribute_name'];
				$attribute_data['attribute_group']=$attribute_value['attribute_group'];	
				$attribute_data['column']=0;	
				$match_attribute_list[]=$attribute_data;
			}			
		}
		/*echo "<pre>";
		print_r($match_attribute_list);
		echo "</pre>";
		exit;*/
		
		foreach($sets['attributes'] as $attribute_key1=>$attribute_value1)
		{
			foreach($match_attribute_list as $ta_key=>$ta_val)
			{		
				//echo $ta_val['attribute_name'] ."==". $attribute_value1['attribute_name']."<br>";
				if($ta_val['attribute_name'] == $attribute_value1['attribute_name'])
				{	
					if($ta_val['column'] != 0)
					{
						$sets['attributes'][$attribute_key1]['column']=$ta_val['column'];
					}
				}
			}
		}
		
		$data['attribute_data']=$sets['attributes'];		
		/* //Product Attributes */	
		
		//cvs file read line by line
		$file=$params['file'];
		
		$fileData=fopen($file,'r');
		//skip first row from csv file
		fgetcsv($fileData);
		
		$delimiter=$params['field_delimiter'];				
		
		///////  start: check empty value in line   ////////////////////
		$temp_row=array();
		$line_num=0;
		$skip_line=array();
		while($row=fgetcsv($fileData, 0, $delimiter, $this->enclosure))
		{ 
			$temp_row[]=$row;
		}
		
		foreach($temp_row as $key=>$value)
		{
			//echo $line_num."<br>";
			foreach($value as $key1=>$value1)
			{
				if(empty($value1))
				{		
					$skip_line[]=$line_num;			
					//echo "inside: ".$line_num."<br>";
				}
			}
			
			$line_num++;
		}
		fclose($fileData);
		
		/*echo "<pre>";
		print_r($skip_line);
		echo "</pre>";*/
		//exit;
		///////  end: check empty value in line   ////////////////////
		
		$img="";
		$url="";
		$product=array();
				
		//cvs file read line by line
		$file=$params['file'];
		
		$fileData=fopen($file,'r');
		//skip first row from csv file
		fgetcsv($fileData);
		
		$delimiter=$params['field_delimiter'];				
		
		$line_number=0;
		//while($row=fgetcsv($fileData))
		while($row=fgetcsv($fileData, 0, $delimiter, $this->enclosure))
		{  						
			$csv_total_record++;
				
			//echo $line_number."<br>";	
			if(in_array($line_number,$skip_line))
			{
				$line_number++;
				continue;
			}
						
			///////////////////////		Products		//////////////////			
			foreach($match_field as $key=>$value)
			{	
				$col_list.="`".$key."`".",";
						
				if($this->getDataType($key)=="varchar" || $this->getDataType($key)=="text")
				{
					
					if($key == 'model')
					{
						
						$model_name=$row[$value];
						$make_str.="`".$key."`"."='".$model_name."',";
					}				
					else if($key == 'image')
					{
						$url=$row[$value];
						//Check to see if the file exists by trying to open it for read only									
						$check = $this->checkRemoteFile($url);
	
						if($check == true){
							$file = basename($url);  														
							$file = preg_replace("/\?.+/", "", $file);
							$img = $image_directory.'/'.$file;
							
							if(!file_exists($img)) {
								//error_reporting(E_ERROR | E_PARSE);
								file_put_contents($img, file_get_contents($url));
							}							
						}		
						
						if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
   							$make_str.="`".$key."`"."='".$row[$value]."',";
						}	
						else
						{			
							$make_str.="`".$key."`"."='".$table_image_path.'/'.$file."',";	
						}
					}					
					else
					{
						$make_str.="`".$key."`"."='".$row[$value]."',";
					}
				}
				else
				{
					if($key == 'price')
					{
						if (isset($row[$value]) && strlen($row[$value])) {
							$product['price'] = $row[$value];
							if (!empty($this->params['price_multiplier'])) {
								
								$product['price'] = $product['price'] * $this->params['price_multiplier'];		
								
								$make_str.="`".$key."`"."='".$product['price']."',";
							}
							else
							{								
								$make_str.="`".$key."`"."='".$row[$value]."',";
							}
						}		
					}
					else if($key == 'manufacturer_id' || $key == 'manufacturer')
					{
						// get a manufacturer id
						//
						
						if (isset($row[$value])) {
							$sel_manufacturer = $this->db->query("SELECT manufacturer_id FROM manufacturer AS m WHERE firstname='" . $row[$value] . "'");
							$sel=$sel_manufacturer->row_array();
							if (!empty($sel['manufacturer_id'])) {
								$manufacturer_id = $sel['manufacturer_id'];
							} elseif (!empty($data['manufacturer'])) {
								$rec = array(
									'name' => $data['manufacturer'],
								);
								$manufacturer_id = $this->kadb->queryInsert("manufacturer", $rec);
							} else {
								$manufacturer_id = 0;
							}
							$product['manufacturer_id'] = $manufacturer_id;	
							$make_str.="`".$key."`"."=".$manufacturer_id.",";
							
						}
					}
					else
					{						
						$make_str.="`".$key."`"."=".$row[$value].",";
					}
					//$make_str.="`".$key."`"."=".$row[$value].",";
				}				
			}
		
			$make_str=rtrim($make_str,',');
			$col_list=rtrim($col_list,',');			
			//echo $make_str;exit;
			//echo $col_list;exit;
			$exists_record=$this->import_product->existsRecord($model_name);
			if($import_mode == "add")
			{
				if($exists_record == 0)
				{		
					$ack=$this->import_product->insertData($col_list,$make_str);
					$product[]=$ack;					
					$this->saveCategories($ack,$row,$data);	
					$this->saveDownloads($ack,$row,$data);					
					$products_data[]=$this->product->getProductById($ack);
					$this->saveSeoUrl($ack,$row,$data);
					$this->saveAdditionalImages($ack,$row,$data);
					$this->saveAttributes($products_data,$row,$data);
					$this->saveFilters($products_data,$row,$data);					
					$this->saveOptions($products_data,$row,$data);
					$this->saveDiscounts($products_data,$row,$data);
					$this->saveSpecials($products_data,$row,$data);
					if($ack > 0)
					{
						$total_record_inserted++;
					}
				}
				else
				{					
					$ack=$this->import_product->updateData($model_name,$make_str);							
		
					$products_data=$this->getProductIdByModelName($model_name);
					$product_id=$products_data['product_id'];	
					$product[]=$product_id;					
					$this->saveCategories($product_id,$row,$data);
					$this->saveDownloads($product_id,$row,$data);					
					$products_data[]=$this->product->getProductById($product_id);
					$this->saveSeoUrl($product_id,$row,$data);
					$this->saveAdditionalImages($product_id,$row,$data);
					$this->saveAttributes($products_data,$row,$data);
					$this->saveFilters($products_data,$row,$data);					
					$this->saveOptions($products_data,$row,$data);
					$this->saveDiscounts($products_data,$row,$data);
					$this->saveSpecials($products_data,$row,$data);
					if($ack == true)
					{
						$total_record_updated++;
					}
				}
			}
			else
			{				
				if($exists_record == 0)
				{		
					/*$ack=$this->import_product->insertData($col_list,$make_str);
					$product[]=$ack;
					$this->saveCategories($ack,$category_name);	
					if($ack > 0)
					{
						$total_record_inserted++;
					}*/
				}
				else
				{
					$ack=$this->import_product->updateData($model_name,$make_str);
					
					$products_data=$this->getProductIdByModelName($model_name);
					$product_id=$products_data['product_id'];
					$product[]=$product_id;					
					$this->saveCategories($product_id,$category_name);	
					$this->saveDownloads($product_id,$row,$data);					
					$products_data[]=$this->product->getProductById($product_id);
					$this->saveSeoUrl($product_id,$row,$data);
					$this->saveAdditionalImages($product_id,$row,$data);
					$this->saveAttributes($products_data,$row,$data);
					$this->saveFilters($products_data,$row,$data);					
					$this->saveOptions($products_data,$row,$data);
					$this->saveDiscounts($products_data,$row,$data);
					$this->saveSpecials($products_data,$row,$data);
					if($ack == true)
					{
						$total_record_updated++;
					}
				}
				
				/*$ack_del=$this->import_product->deleteData($model_name);
				
				if($ack_del == 1)
				{
					$ack=$this->import_product->insertData($col_list,$make_str);	
					if($ack > 0)
					{
						$total_record_inserted++;
					}
				}
				
				$ack=$this->import_product->updateData($model_name,$make_str);
				if($ack == true)
				{
					$total_record_updated++;
				}*/
			}
			
			$make_str="";
			$col_list="";
			$line_number++;
	   	}
		//exit;
		fclose($fileData);
	
	
		$total_record_proccessed=(int)$total_record_inserted+(int)$total_record_updated;
		
		$this->data['csv_total_record']=$csv_total_record;
		$this->data['total_record_inserted']=$total_record_inserted;
		$this->data['total_record_updated']=$total_record_updated;
		$this->data['total_record_proccessed']=$total_record_proccessed;
				
		///////////////////////		//Products		//////////////////
		
		return $this->data; 
	}
	
	
	/*
	* get coulumn data type
	*/
	public function getDataType($column_name)
	{
		$get_type=$this->db->query("SELECT COLUMN_NAME,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'srapo' AND TABLE_NAME = 'product' and COLUMN_NAME='".$column_name."'");
		
		$type_array=$get_type->row_array();
		$type=$type_array['DATA_TYPE'];
		
		return $type;
	}
	
	/*
	* @function name 	: existsRecord()
    * @description   	: get columns list from product table
	* @param         	: string
    * @access 			: public
    * @return       	: list of columns
	*/
	public function existsRecord($model_name)
	{
		$query=$this->db->query("select * from `product` where model='".$model_name."'");

		return $query->num_rows();		
	}
		
	/*
	* @function name 	: insertData()
    * @description   	: get columns list from product table
	* @param         	: string
    * @access 			: public
    * @return       	: list of columns
	*/
	public function insertData($col_list,$make_str)
	{
		//$query=$this->db->query("insert into `product` (".$pass_col_str.") values(".$pass_value_str.")");
		
		$query=$this->db->query("insert into `product` set $make_str, `date_added` = '".date('Y-m-d h:i:sa')."', `added_by` = '".$this->session->userdata('user_id')."', `date_modified` = '".date('Y-m-d h:i:sa')."',`modified_by` = '".$this->session->userdata('user_id')."'");
		
		//echo $this->db->last_query();
		$insert_id=$this->db->insert_id();		
		
		return $insert_id;		
	}
	
	/*
	* @function name 	: updateData()
    * @description   	: get columns list from product table
	* @param         	: string
    * @access 			: public
    * @return       	: list of columns
	*/
	public function updateData($model_name,$make_str)
	{
		$query=$this->db->query("update `product` set ".$make_str." , `date_modified` = '".date('Y-m-d h:i:sa')."', `added_by` = '".$this->session->userdata('user_id')."', `modified_by` = '".$this->session->userdata('user_id')."' where `model` = '".$model_name."'");
				
		return $query;		
	}
	
	/*
	* @function name 	: deleteData()
    * @description   	: get columns list from product table
	* @param         	: model name
    * @access 			: public
    * @return       	: delete acknowledgement
	*/
	public function deleteData($model_name)
	{
		$query=$this->db->query("delete from `product` where model = '".$model_name."'");
				
		return $query;		
	}
	
	/*
	* str_getcsv
	*/
	 public static function str_getcsv($input, $delimiter = ",", $enclosure = '"', $escape = "\\") {

        $mem_size = 1 * 1024 * 1024;
        
    	if (strlen($input) >= $mem_size) {
    		return false;
    	}
    
        $fp = fopen("php://temp/maxmemory:$mem_size", 'r+');
        fputs($fp, $input);
        rewind($fp);

        $data = fgetcsv($fp, 1000, $delimiter, $enclosure);

        fclose($fp);
        return $data;
    }
	
	/*
	* @function name 	: getProductIdByModelName()
    * @description   	: get columns list from product table
	* @param         	: model name
    * @access 			: public
    * @return       	: list of columns
	*/
	public function getProductIdByModelName($model_name)
	{
		$query=$this->db->query("select * from `product` where model='".$model_name."'");

		return $query->row_array();		
	}
	
	
	/**
    * 
    * @function name 	: checkRemoteFile()
    * @description   	: check remote file exists or not
    * @param         	: string $url that you check
    * @access 			: public
    * @return       	: true or false
    *
    */
	public function checkRemoteFile($url)
	{		
		ini_set('max_execution_time', 300); //300 seconds = 5 minutes
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_NOBODY, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		if(curl_exec($ch)!==FALSE)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/*
	* check attribute exists in 'product_attribute' table
	*/
	public function existsAttribute($product_id,$attribute_id,$attribute_text)
	{
		$query=$this->db->query("select * from `product_attribute` where `product_id`='".(int)$product_id."' AND `attribute_id`='".(int)$attribute_id."' AND `text`='".$attribute_text."'");
		
		return $query->num_rows();
	}
	
	
	/*
	* check filter exists in 'product_attribute' table
	*/
	public function existsFilter($product_id,$filter_id)
	{
		$query=$this->db->query("select * from `product_filter` where `product_id`='".(int)$product_id."' AND `filter_id`='".(int)$filter_id."'");
		
		return $query->num_rows();
	}
	
	/*
		supports values like '.99', '0,99', '$1,200.00', '123,456.78' => '123456.78'
	*/
	public function parsePrice($price) {
		$price = trim($price);
	
		if (!preg_match("/([\d\-,\.` ]*)([\.,])(\d*)$/U", $price, $matches)) {
			return $price;
		}

		$matches[1] = preg_replace("/[^\d\-]/", "", $matches[1]);
		$res = doubleval($matches[1] . '.' . $matches[3]);
		
		return $res;
	}
	
	/*
	* format price 
	*/
	public function formatPrice($price, $new = false) {
		
		if (!$new) {
			return $this->parsePrice($price);
		}
		
		$price = (float) $price;
		
		return $price;
	}
	
	/*
		this function should parse the date and try to return formated as YYYY-MM-DD.
	*/
	public function formatDate(&$date) {
	
		$date = trim($date);
		
		// yyyy-mm-dd
		if (preg_match("/^\d{4}-\d{1,2}-\d{1,2}$/", $date, $matches)) {
			return true;

		// mm/dd/yyyy
		} elseif (preg_match("/^(\d{1,2})\/(\d{1,2})\/(\d{2,4})$/", $date, $matches)) {
			if ($matches[3] < 100) {
				$matches[3] += 2000;
			}
			$date = sprintf("%04d-%02d-%02d", $matches[3], $matches[1], $matches[2]);			
			return true;
			
		// dd.mm.yyyy
		} elseif (preg_match("/^(\d{1,2})\.(\d{1,2})\.(\d{2,4})$/", $date, $matches)) {
			if ($matches[3] < 100) {
				$matches[3] += 2000;
			}
			$date = sprintf("%04d-%02d-%02d", $matches[3], $matches[2], $matches[1]);
			return true;
		}
		
		return false;
	}
	
	/*
	* check url
	*/
	public function isUrl($path) {
    	return preg_match('/^(http|https|ftp):\/\//isS', $path);
	}
	
	/*
		RETURNS:
			false - on error
			array - on success. It looks like:
				array(
					'status'
						'http_version'  =>
						'status_code'   =>
						'reason_phrase' =>
					'headers'
						'<hdr1>' => value
						'<hdr2>' => value
				)
	*/
	public function parseHttpHeader($header) {
	
		if (!preg_match("/^(.*)\s(.*)\s(.*)\x0D\x0A/U", $header, $matches)) {
			return false;
		}

		$status = array(
			'http_version'  => $matches[1],
			'status_code'   => $matches[2],
			'reason_phrase' => $matches[3]
		);
		
		$headers = array();		
		$header_lines = explode("\x0D\x0A", $header);
		
		foreach ($header_lines as $line) {
			$pair        = array();
			$value_start = strpos($line, ': ');
			$name        = substr($line, 0, $value_start);
			$value       = substr($line, $value_start + 2);
						
			$headers[$name] = $value;
		}
		
		$result = array(
			'status' => $status,
			'headers' => $headers
		);
		
		return $result;					
	}


	/*
	* get image from url
	*/
	public function getFileContentsByUrl($url) {

		$message = null;
		$this->lastError = '';
		
		if (function_exists('curl_init')) {
		
			$tmp_url        = $url;
			$redirect_count = 0;
						
			do {			
				$headers = '';
				$message = null;
				
				if (preg_match("/^\/\/.*/", $tmp_url)) {
					$tmp_url = "http:" . $tmp_url;
				}
				
				$curl = curl_init($tmp_url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_HEADER, true);
				curl_setopt($curl, CURLOPT_TIMEOUT, 23);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
				
				// add custom headers to emulate a regular user activity so it will prevent bans
				// by the user-agent string
				//
				$opt_headers = array();
				$opt_headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:42.0) Gecko/20100101 Firefox/42.0";
				
				if (!empty($opt_headers)) {
					curl_setopt($curl, CURLOPT_HTTPHEADER, $opt_headers);
				}
				
				// use more attempts to resolve host name. Sometimes curl fails at resolving 
				// a valid host name.
				//
				$resolve_attempt = 0;
				while (true) {
					$response = curl_exec($curl);
					
					if ($response === false) {
					
						// curl_error code 6 means 'could not resolve host name'
						//
						if (curl_errno($curl) == 6) {
							if ($resolve_attempt++ < $this->curl_resolve_attempts) {
								continue;
							}
						}
						$this->lastError = 'CURL error (' . curl_errno($curl) . '): ' . curl_error($curl);
					}
					
					break;					
				}				
				curl_close($curl);
				
				if ($response === false) {
					break;
				}
				
				$msg_start    = strpos($response, "\x0D\x0A\x0D\x0A");
				$header_block = substr($response, 0, $msg_start);
				$headers      = $this->parseHttpHeader($header_block);				
				if (empty($headers)) {
					if (strlen($response) > 1000) {
						$this->lastError = 'No headers received. Response size is ' . strlen($response);
					} else {
						$this->lastError = 'No headers received. Response is "' . $response . '"';
					}
					break;
				}

				if ($headers['status']['status_code'] >= 200 && $headers['status']['status_code'] < 300) {
					$message = substr($response, $msg_start+4);
					break;
					
				} elseif ($headers['status']['status_code'] >= 300 && $headers['status']['status_code'] < 400) {
					$tmp_url = $headers['headers']['Location'];
					continue;
				} else {
					$this->lastError = 'Invalid status code: ' . $headers['status']['status_code'];
					break;
				}
				
			} while (++$redirect_count < 5);
			
		} else {
			if (ini_get('allow_url_fopen')) {
				$message = file_get_contents($url);
			}
		}

		return $message;
	}
	
	/*
	* normalize File name
	*/
	public function normalizeFilename($filename) {

		$chars = array('\\','/','=','.','+','*','?','[','^',']','(','$',']','&','<','>');
   		$filename = str_replace($chars, "_", $filename);

   		return $filename;
	}
	
	
	

}