<?php
/**
* 
* @file name   : Wishlist_model
* @Auther      : Nitin Sabhadiya
* @Date        : 16-01-2017
* @Description : Collection of various Wishlist function related to user database operation.
*
*/
class Wishlist_model extends CI_Model 
{
    /**
    * 
    * @function name 	: __construct()
    * @description   	: initialize variables
    * @param   		: void
    * @return        	: void
    *
    */
    public function __construct() 
    {
        parent::__construct();
    }
    
		public function addWishlist($product_id) {

		$this->db->query("DELETE FROM customer_wishlist WHERE customer_id = '" . (int)$this->customer->getId() . "' AND product_id = '" . (int)$product_id . "'");

		$this->db->query("INSERT INTO customer_wishlist SET customer_id = '" . (int)$this->customer->getId() . "', product_id = '" . (int)$product_id . "', date_added = NOW()");

	}

	public function deleteWishlist($product_id) {

		$this->db->query("DELETE FROM customer_wishlist WHERE customer_id = '" . (int)$this->customer->getId() . "' AND product_id = '" . (int)$product_id . "'");

	}

	public function getWishlist() {
        $query = $this->db->query("SELECT * FROM customer_wishlist WHERE customer_id = '" . (int)$this->customer->getId() . "'");

		return $query->result_array();
	}

	public function getTotalWishlist() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM customer_wishlist WHERE customer_id = '" . (int)$this->customer->getId() . "'");

		return $query->row('total');
	}
    
}