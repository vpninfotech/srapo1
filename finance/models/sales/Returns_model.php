<?php
/**
 * Returns Model Class
 * Collection of various common function related to product returns database operation.
 *
 * @author    Mitesh
 * @license   http://www.vpninfotech.com/
 */
class Returns_model extends CI_Model 
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
	* @function name 	: getReturn()
	* @description   	: get return record by return_id
	* @access 		 	: public
	* @param   		 	: int $return_id The return id that you want
	* @return       	: array The selected return array
	*
	*/
	public function getReturn($return_id)
    {
		$this->db->from('return');
		$this->db->where('return_id',(int)$return_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	
	/**
	* 
	* @function name 	: existsOrderId()
	* @description   	: check order id exists or not by order id as input
	* @access 		 	: public
	* @param   		 	: int $order_id The order id that you want
	* @return       	: array The selected order id array
	*
	*/
	public function existsOrderId($order_id)
    {
		$this->db->from('return');
		$this->db->where('order_id',(int)$order_id);
		if($this->input->post("return_id") !== "")
		{
			$this->db->where('return_id !=',$this->input->post("return_id"));
		}
		$query=$this->db->get();
		return $query->num_rows();
    }
	
	/**
	* 
	* @function name 	: getCategoryFilter()
	* @description   	: get category id record by category_id from category_filter table
	* @access 		 	: public
	* @param   		 	: int $category_id The category id that you want
	* @return       	: array The selected category array
	*
	*/
	public function getCategoryFilter($category_id)
    {
		$this->db->from('category_filter');
		$this->db->where('category_id',(int)$category_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	
	/**
	* 
	* @function name 	: getCategoryProduct()
	* @description   	: get category id record by category_id from product_category table
	* @access 		 	: public
	* @param   		 	: int $category_id The category id that you want
	* @return       	: array The selected category array
	*
	*/
	public function getCategoryProduct($category_id)
    {
		$this->db->from('product_category');
		$this->db->where('category_id',(int)$category_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	
	/**
	* 
	* @function name 	: getCategoryFilters()
	* @description   	: get Category Filters record by category_id
	* @access 		 	: public
	* @param   		 	: int $category_id The category id that you want
	* @return       	: array The selected category array
	*
	*/
	public function getCategoryFilters($category_id)
    {
		$this->db->from('category_filter');
		$this->db->where('category_id',(int)$category_id);
		$query=$this->db->get();
		//return $query->row_array();
		return $query->result_array();
    }
	
	/**
	* 
	* @function name 	: addReturn()
	* @description   	: add Return record in database
	* @access 		 	: public
	* @return       	: int last inserted Return record id
	*
	*/
	public function addReturns()
	{		
		
		$get_order_id=$this->input->post('order_id');
		if(isset($get_order_id) || !empty($get_order_id))
		{			
			$this->db->select('*');
			$this->db->from('return');
			$this->db->where('order_id=',$get_order_id);
			$exists=$this->db->get();
						
			if($exists->num_rows() < 1)
			{
				$this->db->set('order_id',$this->input->post('order_id'));
				$this->db->set('date_ordered',date('Y-m-d', strtotime($this->input->post('date_ordered'))));	
				$this->db->set('customer_id',$this->input->post('customer_id'));
				$this->db->set('firstname',$this->input->post('firstname'));				
				$this->db->set('lastname',$this->input->post('lastname'));
				$this->db->set('email',$this->input->post('email'));
				$this->db->set('telephone',$this->input->post('telephone'));
				$this->db->set('product',$this->input->post('product'));
				$this->db->set('product_id',$this->input->post('product_id'));
				$this->db->set('model',$this->input->post('model'));
				$this->db->set('quantity',$this->input->post('quantity'));
				$this->db->set('return_reason_id',$this->input->post('return_reason_id'));
				$this->db->set('opened',$this->input->post('opened'));
				$this->db->set('comment',$this->input->post('comment'));
				$this->db->set('return_action_id',$this->input->post('return_action_id'));	
				$this->db->set('return_status_id',$this->input->post('return_status_id'));						
				$this->db->set('date_added',date('Y-m-d h:i:sa'));
				$this->db->set('added_by',$this->session->userdata('user_id'));
				$this->db->set('date_modified',date('Y-m-d h:i:sa'));
				$this->db->set('modified_by',$this->session->userdata('user_id'));
				$this->db->insert('return');
				
				$last_record_id=$this->db->insert_id();	
				
				return $last_record_id;
			}
			else
			{
				return 0;
			}
			
		}		
	}	
		
	/**
	* 
	* @function name 	: editReturns()
	* @description   	: edit categories record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editReturns()
	{			
		$this->db->set('order_id',$this->input->post('order_id'));
		$this->db->set('date_ordered',date('Y-m-d', strtotime($this->input->post('date_ordered'))));	
		$this->db->set('customer_id',$this->input->post('customer_id'));
		$this->db->set('firstname',$this->input->post('firstname'));				
		$this->db->set('lastname',$this->input->post('lastname'));
		$this->db->set('email',$this->input->post('email'));
		$this->db->set('telephone',$this->input->post('telephone'));
		$this->db->set('product',$this->input->post('product'));
		$this->db->set('product_id',$this->input->post('product_id'));
		$this->db->set('model',$this->input->post('model'));
		$this->db->set('quantity',$this->input->post('quantity'));
		$this->db->set('return_reason_id',$this->input->post('return_reason_id'));
		$this->db->set('opened',$this->input->post('opened'));
		$this->db->set('comment',$this->input->post('comment'));
		$this->db->set('return_action_id',$this->input->post('return_action_id'));	
		$this->db->set('return_status_id',$this->input->post('return_status_id'));	
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));
		$this->db->where('return_id',(int)$this->input->post('return_id'));		
		$res=$this->db->update('return');	
						
		return $res;	
		
	}
	
	
	/**
	* 
	* @function name 	: softDeleteAttributes()
	* @description   	: only status change not actual delete attributes from database
	* @access 		 	: public
	* @param   		 	: int $attribute_id The attribute id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteReturns($returns_id)	{	
		$this->db->set('is_deleted',1);
		$this->db->where('return_id',(int)$returns_id);
		return $this->db->update('return');
	}
	
	/**
	* 
	* @function name 	: deleteReturns()
	* @description   	: delete return record from database
	* @access 		 	: public
	* @param   		 	: int $return_id The return id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteReturns($return_id) 
	{
		//delete record from return table		
		$this->db->where('return_id',(int)$return_id);
		return $this->db->delete('return');		
	} 
	
	/**
	* 
	* @function name 	: getAttributesByCode()
	* @description   	: get attribute record by attribute code
	* @access 		 	: public
	* @param   		 	: string $attribute_id The attribute group code that you want to get
	* @return       	: array The selected attribute array
	*
	*/
	public function getAttributesByCode($attribute_id) 
	{
		$this->db->where('code',$attribute_id);
		$query=$this->db->get();
		return $query->row_array();
	}
	
	/**
	* 
	* @function name 	: getReturns()
	* @description   	: get all returns from database
	* @access 		 	: public
	* @param   		 	: string $returns The returns that you want to get
	* @return       	: array The selected returns array
	*
	*/
	public function getReturns($data = array())
	{
            
		$sql = "SELECT *,CONCAT(`firstname`,' ',`lastname`) as customer FROM `return`";
		
		$implode = array();

		if (!empty($data['return_id'])) {
			$implode[] = "`return_id` ='".$data['return_id']."'";
		}
		if (!empty($data['customer_id'])) {
			$implode[] = "`customer_id` ='".$data['customer_id']."'";			
		}
		if (!empty($data['customer'])) {			
			$implode[] = "CONCAT(`firstname`,' ',`lastname`) LIKE '%" . $data['customer'] . "%'";
		}
		if (!empty($data['model'])) {
			//$implode[] = "`model` '".$data['model']."'";
			$implode[] = "`model` LIKE '%" . $data['model'] . "%'";
		}
		if (!empty($data['date_added'])) {
			//$implode[] = "`date_added` = '" . date('Y-m-d',strtotime($data['date_added']))."'";
			$implode[] = "`date_added` like '%" . date('Y-m-d',strtotime($data['date_added']))."%'";
			//$implode[] = "`date_added` = DATE('Y-m-d','" . $this->db->escape($data['date_added']) . "')";
		}
		if (!empty($data['order_id'])) {
			$implode[] = "`order_id` ='".$data['order_id']."'";
		}
		if (!empty($data['product'])) {
			//$implode[] = "`product` ='".$data['product']."'";
			$implode[] = "product LIKE '%" . $data['product'] . "%'";
		}
		if (!empty($data['return_status_id'])) {
			$implode[] = "`return_status_id` =".$data['return_status_id']." ";
		}
		if (!empty($data['date_modified'])) {
			//$implode[] = "`date_modified` = '" . date('Y-m-d',strtotime($data['date_modified']))."'";
			$implode[] = "`date_modified` like '%" . date('Y-m-d',strtotime($data['date_modified']))."%'";
		}
				
		$sort_data = array(
			'return_id',			
			'order_id',
			'customer',
			'product',
			'model',
                        'status',
                        'date_added',
                        'date_modified'
		);

		if($this->session->userdata('role_id')!=1)
		{
			//$sql .= " WHERE is_deleted = 0";
			if($implode) 
			{			
				$sql .= " WHERE is_deleted = 0 AND ". implode(" AND ", $implode);
			}
			else
			{
				$sql .= " WHERE is_deleted = 0";
			}
		}
		else
		{
			if($implode) 
			{
				$sql .= " WHERE " . implode(" AND ", $implode);
			}
		}
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY return_id";
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
			
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalReturns()
	* @description   	: get total no of returns from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalReturns() 
	{
		$sql = "SELECT count(*) as total FROM `return`";
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " WHERE is_deleted=0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	
	/**
	* 
	* @function name 	: getAllProducts()
	* @description   	: get total no of product id and product name for categories from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getAllProducts()
	{
		$this->db->select('product_id,product_name');
		$this->db->from('product');		
		$query=$this->db->get();
		return $query->result_array();
	}
        
        /**
	* 
	* @function name : getTotalReturnsByReturnStatusId()
	* @description   : get product return record by $return_status_id
	* @access        : public
	* @param   	 : int $return_status_id
	* @return        : int total no of records
	*
	*/
        public function getTotalReturnsByReturnStatusId($return_status_id) {
            $query = $this->db->query("SELECT COUNT(*) AS total FROM `return` WHERE return_status_id = '" . (int)$return_status_id . "'");
            return $query->row('total');
	}
        
        /**
	* 
	* @function name : getTotalReturnsByReturnActionId()
	* @description   : get product return record by $return_action_id
	* @access        : public
	* @param   	 : int $return_action_id
	* @return        : int total no of records
	*
	*/
        public function getTotalReturnsByReturnActionId($return_action_id) {
            $query = $this->db->query("SELECT COUNT(*) AS total FROM `return` WHERE return_action_id = '" . (int)$return_action_id . "'");
            return $query->row('total');
	}
        
        /**
	* 
	* @function name : getTotalReturnsByReturnReasonId()
	* @description   : get product return record by $return_reason_id
	* @access        : public
	* @param   	 : int $return_reason_id
	* @return        : int total no of records
	*
	*/
        public function getTotalReturnsByReturnReasonId($return_reason_id) {
            $query = $this->db->query("SELECT COUNT(*) AS total FROM `return` WHERE return_reason_id = '" . (int)$return_reason_id . "'");
            return $query->row('total');
	}
		
	
}