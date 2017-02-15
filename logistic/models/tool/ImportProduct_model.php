<?php

/**
 * ImportProduct Model Class
 * Collection of various common function related to Upload Bulk Product in database  
 * operation
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class ImportProduct_model extends CI_Model 
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
	
	public function openFile($params){}
	
	public function readColumns($delimiter) {}
	
	public function getProductId($data) {}
	
	public function Imports()
	{
		
		$this->updateProducts($product_id, $data, $delete_old, $is_new);
		
		$this->saveCategories($product_id, $data, $delete_old, $is_new);
	
		$this->saveAdditionalImages($product_id, $data, $delete_old, $is_new);
	
		$this->saveAttributes($row, $product, $delete_old, $is_first_product);
		
		$this->saveFilters($row, $product, $delete_old);
	
		$this->saveOptions($row, $product, $delete_old);
	
		$this->saveDiscounts($row, $product, $delete_old);
	
		$this->saveSpecials($row, $product, $delete_old);
	
		$this->saveRewardPoints($row, $product, $delete_old);
						
		$this->saveRelatedProducts($data, $product, $delete_old);
		
		$this->saveDownloads($data, $product, $delete_old);
		
		$this->saveReviews($row, $product, $delete_old);
	}
	
	public function updateProducts($product_id, $data, $delete_old, $is_new){}
	
	public function saveCategories($product_id, $data, $delete_old, $is_new){}
	
	public function saveAdditionalImages($product_id, $data, $delete_old, $is_new){}
	
	public function saveAttributes($row, $product, $delete_old, $is_first_product){}
	
	public function saveFilters($row, $product, $delete_old){}
	
	public function saveOptions($row, $product, $delete_old){}
	
	public function saveDiscounts($row, $product, $delete_old){}

	public function saveSpecials($row, $product, $delete_old){}
	
	public function saveRewardPoints($row, $product, $delete_old){}
	
	public function saveRelatedProducts($data, $product, $delete_old){}
	
	public function saveDownloads($data, $product, $delete_old){}
	
	public function saveReviews($row, $product, $delete_old){}
	
}