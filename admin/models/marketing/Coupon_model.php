<?php
/**
* 
* @file name   : Coupon_model
* @Auther      : Vinay
* @Date        : 15-11-2016
* @Description : Collection of various common function related to coupons database operation.
*
*/
class Coupon_model extends CI_Model 
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
    
    /**
    * 
    * @function name : getCoupon()
    * @description   : get coupon record by coupons_id
    * @access        : public
    * @param   	     : int $coupons_id The coupons id that you want
    * @return        : array The selected coupons array
    *
    */
    public function getCoupon($coupon_id) 
	{
        $this->db->from('coupon');
        $this->db->where('coupon_id',(int)$coupon_id);
        $query=$this->db->get();
        return $query->row_array();
    }
        
    /**
    * 
    * @function name : addCoupon()
    * @description   : add coupon record in database
    * @access        : public
    * @return        : int last inserted coupon record id
    *
    */
    public function addCoupon($data) 
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
            $this->db->set('coupon_name', $this->input->post('coupon_name'));
            $this->db->set('coupon_code', $this->input->post('code'));
            $this->db->set('coupon_type', $this->input->post('coupon_type'));
            $this->db->set('discount', $this->input->post('discount'));
            $this->db->set('logged', $this->input->post('customer_login'));
            $this->db->set('shipping', $this->input->post('shipping'));
            $this->db->set('total', $this->input->post('total_amt'));
            $this->db->set('date_start', $this->input->post('start_date'));
            $this->db->set('date_end', $this->input->post('end_date'));
            $this->db->set('uses_total', $this->input->post('uses_per_coupon'));
            $this->db->set('uses_customer', $this->input->post('uses_per_customer'));
            $this->db->set('status', $this->input->post('status'));
            $this->db->set('date_added',date('Y-m-d h:i:sa'));
            $this->db->set('added_by', $this->session->userdata('user_id'));
            $this->db->set('date_modified',date('Y-m-d h:i:sa'));
            $this->db->set('modified_by', $this->session->userdata('user_id'));
            $this->db->set('is_deleted', $is_deleted);
            $this->db->insert('coupon');
            
            $coupon_id = $this->db->insert_id();
            
            if(isset($data['coupon_product'])) {
                foreach($data['coupon_product'] as $product_id) {
                    $this->db->set('coupon_id',(int)$coupon_id);
                    $this->db->set('product_id',(int)$product_id);
                    $this->db->set('status', $this->input->post('status'));
                    $this->db->set('date_added',date('Y-m-d h:i:sa'));
                    $this->db->set('added_by', $this->session->userdata('user_id'));
                    $this->db->set('date_modified',date('Y-m-d h:i:sa'));
                    $this->db->set('modified_by', $this->session->userdata('user_id'));
                    $this->db->set('is_deleted', $is_deleted);
                    $this->db->insert('coupon_product');
                    //$this->db->query("INSERT INTO coupon_product SET coupon_id = '".(int)$coupon_id."', product_id = '".(int)$product_id."'");
                }
            }
            
            if(isset($data['coupon_category'])) {
                foreach($data['coupon_category'] as $category_id) {
                    $this->db->set('coupon_id',(int)$coupon_id);
                    $this->db->set('category_id',(int)$category_id);
                    $this->db->set('status', $this->input->post('status'));
                    $this->db->set('date_added',date('Y-m-d h:i:sa'));
                    $this->db->set('added_by', $this->session->userdata('user_id'));
                    $this->db->set('date_modified',date('Y-m-d h:i:sa'));
                    $this->db->set('modified_by', $this->session->userdata('user_id'));
                    $this->db->set('is_deleted', $is_deleted);
                    $this->db->insert('coupon_category');
                    //$this->db->query("INSERT INTO coupon_category SET coupon_id = '".(int)$coupon_id."', category_id = '".(int)$category_id."'");
                }
            }
            return $coupon_id;
    }
    
    /**
    * 
    * @function name : editCoupon()
    * @description   : edit coupons record in database
    * @access        : public
    * @return        : void
    *
    */
    public function editCoupon($data) 
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
            $this->db->set('coupon_name', $this->input->post('coupon_name'));
            $this->db->set('coupon_code', $this->input->post('code'));
            $this->db->set('coupon_type', $this->input->post('coupon_type'));
            $this->db->set('discount', $this->input->post('discount'));
            $this->db->set('logged', $this->input->post('customer_login'));
            $this->db->set('shipping', $this->input->post('shipping'));
            $this->db->set('total', $this->input->post('total_amt'));
            $this->db->set('date_start', $this->input->post('start_date'));
            $this->db->set('date_end', $this->input->post('end_date'));
            $this->db->set('uses_total', $this->input->post('uses_per_coupon'));
            $this->db->set('uses_customer', $this->input->post('uses_per_customer'));
            $this->db->set('status', $this->input->post('status'));
            $this->db->set('date_modified',date('Y-m-d h:i:sa'));
            $this->db->set('modified_by', $this->session->userdata('user_id'));
            $this->db->set('is_deleted', $is_deleted);
            $this->db->where('coupon_id',(int)$this->input->post('coupon_id'));
            $res = $this->db->update('coupon');	
            
            $this->db->query("DELETE FROM coupon_product WHERE coupon_id = '".(int)$this->input->post('coupon_id')."'");
            
            if(isset($data['coupon_product'])) {
                foreach($data['coupon_product'] as $product_id) {
                    $this->db->set('coupon_id',(int)$this->input->post('coupon_id'));
                    $this->db->set('product_id',(int)$product_id);
                    $this->db->set('status', $this->input->post('status'));
                    $this->db->set('date_added',date('Y-m-d h:i:sa'));
                    $this->db->set('added_by', $this->session->userdata('user_id'));
                    $this->db->set('date_modified',date('Y-m-d h:i:sa'));
                    $this->db->set('modified_by', $this->session->userdata('user_id'));
                    $this->db->set('is_deleted', $is_deleted);
                    $this->db->insert('coupon_product');
                    //$this->db->query("INSERT INTO coupon_product SET coupon_id = '".(int)$coupon_id."', product_id = '".(int)$product_id."'");
                }
            }
            
            $this->db->query("DELETE FROM coupon_category WHERE coupon_id = '".(int)$this->input->post('coupon_id')."'");
            
            if(isset($data['coupon_category'])) {
                foreach($data['coupon_category'] as $category_id) {
                    $this->db->set('coupon_id',(int)$this->input->post('coupon_id'));
                    $this->db->set('category_id',(int)$category_id);
                    $this->db->set('status', $this->input->post('status'));
                    $this->db->set('date_added',date('Y-m-d h:i:sa'));
                    $this->db->set('added_by', $this->session->userdata('user_id'));
                    $this->db->set('date_modified',date('Y-m-d h:i:sa'));
                    $this->db->set('modified_by', $this->session->userdata('user_id'));
                    $this->db->set('is_deleted', $is_deleted);
                    $this->db->insert('coupon_category');
                    //$this->db->query("INSERT INTO coupon_category SET coupon_id = '".(int)$coupon_id."', category_id = '".(int)$category_id."'");
                }
            }
            
            return $res;
    }
	
    /**
    * 
    * @function name 	: softDeleteCoupon()
    * @description   	: only status change not actual delete coupons from database
    * @access 			: public
    * @param   			: int $coupons_id The coupons id that you want to delete
    * @return       	: void
    *
    */
    public function softDeleteCoupon($coupon_id) 
    {	
        $this->db->set('is_deleted',1);
        $this->db->where('coupon_id',(int)$coupon_id);
        return $this->db->update('coupon');
    }
    
    /**
    * 
    * @function name 	: deleteCoupon()
    * @description   	: delete coupons record from database
    * @access 			: public
    * @param   			: int $coupons_id The coupons id that you want to   	delete
    * @return       	: void
    *
    */
    public function deleteCoupon($coupon_id) 
    {	
        $this->db->where('coupon_id',(int)$coupon_id);
        $res = $this->db->delete('coupon');
        
        $this->db->where('coupon_id',(int)$coupon_id);
        $this->db->delete('coupon_category');
        
        $this->db->where('coupon_id',(int)$coupon_id);
        $this->db->delete('coupon_product');
        
        return $res;
    }
    
    /**
    * 
    * @function name 	: getCoupones()
    * @description   	: get all coupons from database
    * @access 			: public
    * @param   			: string $coupons_id The coupons name that you want to get
    * @return       	: array The selected coupons array
    *
    */
    public function getCoupons($data = array()) 
	{
        $sql = "SELECT * FROM coupon WHERE 1=1";
        $sort_data = array(
            'coupon_name','coupon_code','discount','date_start','date_end','status'
        );
        if($this->session->userdata('role_id')!=1) 
		{
            $sql .= " AND is_deleted = 0";
        }
        
          if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY coupon_name";
        }


        if (isset($data['order']) && ($data['order'] == 'DESC')) 
		{
            $sql .= " DESC";
        } 
		else 
		{
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) 
		{
            if ($data['start'] < 0) 
			{
                $data['start'] = 0;
            }
            
            if ($data['limit'] < 1) 
			{
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }
        $query = $this->db->query($sql);
        $query->result_array();
        return $query->result_array();
    }
    
    /**
    * 
    * @function name 	: getTotalCoupon()
    * @description   	: get total no of coupons from database
    * @access 		    : public
    * @return       	: int total no of records
    *
    */
    public function getTotalCoupon() 
	{
        $sql = "SELECT COUNT(*) AS total FROM coupon";
        if($this->session->userdata('role_id')!=1) 
		{
            $sql .= " WHERE is_deleted = 0";
        }
        $query = $this->db->query($sql);
        return $query->row('total');
    }
                
    /**
    * 
    * @function name 	: getCouponProducts()
    * @description   	: get all product to related coupan code
    * @access 			: public
	* @param   			: string $coupons_id The coupons id that you want to get
    * @return       	: int total no of products
    *
    */
	public function getCouponProducts($coupon_id) 
	{
		$coupon_product_data = array();
		
		$query = $this->db->query("SELECT * FROM coupon_product WHERE coupon_id = '" . (int)$coupon_id . "'");
		
		foreach ($query->result_array() as $result) 
		{
			$coupon_product_data[] = $result['product_id'];
		}
		
		return $coupon_product_data;
	}
    
	/**
    * 
    * @function name 	: getCouponCategories()
    * @description   	: get all category to related coupan code
    * @access 			: public
	* @param   			: string $coupons_id The coupons id that you want to get
    * @return       	: int total no of category
    *
    */   
	public function getCouponCategories($coupon_id) 
	{
		$coupon_category_data = array();
	
		$query = $this->db->query("SELECT * FROM coupon_category WHERE coupon_id = '" . (int)$coupon_id . "'");
	
		foreach ($query->result_array() as $result) 
		{
			$coupon_category_data[] = $result['category_id'];
		}
	
		return $coupon_category_data;
	}
	
	/**
    * 
    * @function name 	: getCouponByCode()
    * @description   	: get coupan record related to given coupan code
    * @access 			: public
	* @param   			: string $code The $code that you want to get coupan record
    * @return       	: Array of coupan code
    *
    */ 
	public function getCouponByCode($code)
	{
		$query = $this->db->query("SELECT DISTINCT * FROM coupon WHERE coupon_code = '" . $code . "'");

		return $query->row_array();
	}
	
	/**
    * 
    * @function name 	: getCouponHistories()
    * @description   	: get coupan record related to given coupan code
    * @access 			: public
	* @param   			: array $data The $data is a all required fields for query
    * @return       	: Array of coupan code
    *
    */ 
	public function getCouponHistories($data = array()) 
	{
		if ($data['start'] < 0) 
		{
			$start = 0;
		}
		
		if ($data['limit'] < 1) 
		{
			$limit = 10;
		}
		
		if(isset($data['coupon_id']))
		{
			$coupon_id = $data['coupon_id'];
		}
		else
		{
			$coupon_id = 0;	
		}
		
		$query = $this->db->query("SELECT ch.order_id, CONCAT(c.firstname, ' ', c.lastname) AS customer, ch.amount, ch.date_added FROM coupon_history ch LEFT JOIN customer c ON (ch.customer_id = c.customer_id) WHERE ch.coupon_id = '" . (int)$coupon_id . "' ORDER BY ch.date_added ASC LIMIT " . (int)$start . "," . (int)$limit);
		
		return $query->result_array();
	}
	
	/**
    * 
    * @function name 	: getTotalCouponHistories()
    * @description   	: get total used coupan code total of particular coupan code
    * @access 			: public
	* @param 			: int $coupan_id The $coupan_id is used to get related records
    * @return       	: int Total used coupans
    *
    */ 
	public function getTotalCouponHistories($coupon_id) 
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM coupon_history WHERE coupon_id = '" . (int)$coupon_id . "'");
	
       return $query->row('total');
	}
	
    
}