<?php
/**
* 
* @file name   : Purchase_return_model
* @Auther      : Mitesh
* @Date        : 20-12-2016
* @Description : Collection of various common function related to purchase database operation.
*
*/
class Purchase_return_model extends CI_Model 
{
    /**
    * 
    * @function name 	: __construct()
    * @description   	: initialize variables
    * @param   		    : void
    * @return        	: void
    *
    */
    public function __construct() 
    {
        parent::__construct();
    }
	
	/**
    * 
    * @function name 	: getPurchaseReturn()
    * @description   	: get purchase return details from "purchase_return" and table
    * @param   		    : void
    * @return        	: purchase return data
    *
    */
    public function getPurchaseReturn($purchase_return_id) 
    {
		$this->db->from('purchase_return');
		$this->db->where('purchase_return_id',(int)$purchase_return_id);
		$query=$this->db->get();
		return $query->row_array();
	}
	
	/**
    * 
    * @function name 	: getManufactuereInfo()
    * @description   	: get manufacturer details from "manufacturer" and "manufacturer_address" table
    * @param   		    : void
    * @return        	: manufacturer data
    *
    */
    public function getManufactuereInfo($manufacturer_id) 
    {
		$query=$this->db->query("SELECT distinct m.*,m_add.* FROM manufacturer m join manufacturer_address m_add on m.manufacturer_id = m_add.manufacturer_id where m.manufacturer_id={$manufacturer_id}");   
		   
	    return $query->row_array();
    }
	
	
	/**
    * 
    * @function name 	: getProducts()
    * @description   	: get product details from "manufacturer" and "manufacturer_address" table
    * @param   		    : void
    * @return        	: manufacturer data
    *
    */
	public function getProducts($data = array())
	{	
		//$sql = "SELECT  p.*,pp.* from purchase p join purchase_product pp on p.purchase_id = pp.purchase_id where 1=1";
		$sql = "SELECT distinct p.*,pp.* from purchase p join purchase_product pp on p.purchase_id = pp.purchase_id where 1=1";
		
		$implode = array();
		
		if (!empty($data['filter_name'])) {
			$implode[] = " pp.name LIKE '%" . $data['filter_name'] . "%'";
		}
		
		if(isset($data['filter_manufacturer_id']) && $data['filter_manufacturer_id']!='')
		{
			$implode[] = " p.manufacturer_id = " . $data['filter_manufacturer_id'];
		}
		
		if (isset($data['filter_purchase_id']) && $data['filter_purchase_id']!='') {
			$implode[] = " p.purchase_id = " . $data['filter_purchase_id'];
		}	
		
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		
		$query = $this->db->query($sql);
       
		return $query->result_array();
	}
	
	/**
    * 
    * @function name 	: getProductOptions()
    * @description   	: get product details from "purchase_product" and "purchase_option" table
    * @param   		    : void
    * @return        	: product options data
    *
    */
	public function getProductOptions()
	{	
		$purchase_id=$this->input->post('purchase_id');
		$manufacturer_id=$this->input->post('manufacturer_id');
		$purchase_product_id=$this->input->post('purchase_product_id');
		$product_id=$this->input->post('product_id');
		
		$sql = "SELECT pp.*,po.* from purchase_product pp left join purchase_option po on pp.purchase_product_id=po.purchase_product_id where pp.purchase_id='".(int)$purchase_id."' and pp.product_id='".(int)$product_id."' and pp.purchase_product_id='".(int)$purchase_product_id."'";
		
		$query=$this->db->query($sql);
		
		return $query->result_array();		
	}
	
	/**
    * 
    * @function name 	: addPurchaseReturn()
    * @description   	: add data of purchase return in tables
    * @param   		    : void
    * @return        	: void
    *
    */
	public function addPurchaseReturn()
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
		
		//get product details
		 $product_id=$this->input->post('product_id');
		$product_data=$this->product->getProductById($product_id);
               $product_name=$product_data['product_name'];
		$this->db->set('product_id',$this->input->post('product_id'));
		$this->db->set('purchase_id',$this->input->post('select_purchase_id'));
		$this->db->set('purchase_order_id',$this->input->post('order_id'));
		$this->db->set('purchase_product_id',$this->input->post('purchase_product_id'));
		$this->db->set('manufacturer_id',$this->input->post('manufacturer_id'));
		$this->db->set('product_name',$product_name);
		$this->db->set('model',$this->input->post('model_name'));
		$this->db->set('quantity',$this->input->post('quantity'));
		$this->db->set('total',$this->input->post('price_total'));
		$this->db->set('currency_id',$this->input->post('currency_id'));
		$this->db->set('currency_value',$this->input->post('currency_value'));
		$this->db->set('currency_code',$this->input->post('currency_code'));
        $this->db->set('opened',$this->input->post('product_is_opened'));
		$this->db->set('return_reason_id',$this->input->post('reason_for_return'));
		$this->db->set('return_action_id',$this->input->post('return_action'));
		$this->db->set('return_status_id',$this->input->post('return_status'));
		$this->db->set('comment',$this->input->post('faulty_or_other_details'));
		$this->db->set('date_ordered',date('Y-m-d h:i:sa'));
		$this->db->set('status',$this->input->post('status'));		
		$this->db->set('is_deleted',$is_deleted);
        $this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('user_id'));
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));
        $this->db->insert('purchase_return');
		
		$purchase_return_id=$this->db->insert_id();		
		
		if($purchase_return_id)
		{
			$this->db->query("INSERT INTO purchase_return_history SET purchase_return_id = '" . (int)$purchase_return_id . "', return_status_id = '" . (int)$this->input->post('status') . "', notify = 0, comment = '" . $this->input->post('faulty_or_other_details') . "', date_added = '" . date('Y-m-d h:i:sa') . "', `added_by` = '" . $this->session->userdata('user_id') . "', `date_modified` = '" . date('Y-m-d h:i:sa') . "', modified_by='".$this->session->userdata('user_id')."'");
		}
		
	}
	
	
	/**
    * 
    * @function name 	: editPurchaseReturn()
    * @description   	: edit data of purchase return in tables
    * @param   		    : void
    * @return        	: void
    *
    */
	public function editPurchaseReturn()
	{		
		$purchase_return_id=$this->input->post('purchase_return_id');
	
		$is_deleted = $this->input->post('is_deleted');
		if(isset($is_deleted))
		{
   			$is_deleted = 1;
		}
		else
		{
   			$is_deleted = 0;
		}
				
		//get product details
		$product_id=$this->input->post('product_id');
		$product_data=$this->product->getProductById($product_id);
		$product_name=$product_data['product_name'];
		$this->db->set('product_id',$this->input->post('product_id'));
		$this->db->set('purchase_id',$this->input->post('purchase_id'));
		$this->db->set('purchase_order_id',$this->input->post('order_id'));
		$this->db->set('purchase_product_id',$this->input->post('purchase_product_id'));
		$this->db->set('manufacturer_id',$this->input->post('manufacturer_id'));
		$this->db->set('product_name',$product_name);
		$this->db->set('model',$this->input->post('model_name'));
		$this->db->set('quantity',$this->input->post('quantity'));
		$this->db->set('total',$this->input->post('price_total'));
		$this->db->set('currency_id',$this->input->post('currency_id'));
		$this->db->set('currency_value',$this->input->post('currency_value'));
		$this->db->set('currency_code',$this->input->post('currency_code'));
        $this->db->set('opened',$this->input->post('product_is_opened'));
		$this->db->set('return_reason_id',$this->input->post('reason_for_return'));
		$this->db->set('return_action_id',$this->input->post('return_action'));
		$this->db->set('return_status_id',$this->input->post('return_status'));
		$this->db->set('comment',$this->input->post('faulty_or_other_details'));
		$this->db->set('date_ordered',date('Y-m-d h:i:sa'));
		$this->db->set('status',$this->input->post('status'));		
		$this->db->set('is_deleted',$is_deleted);
        $this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('user_id'));
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));
		$this->db->where('purchase_return_id',(int)$purchase_return_id);
        
		$purchase_return_ack=$this->db->update('purchase_return');	
		
		if($purchase_return_ack)
		{
			$this->db->query("INSERT INTO purchase_return_history SET purchase_return_id = '" . (int)$purchase_return_id . "', return_status_id = '" . (int)$this->input->post('status') . "', notify = 0, comment = '" . $this->input->post('faulty_or_other_details') . "', date_added = '" . date('Y-m-d h:i:sa') . "', `added_by` = '" . $this->session->userdata('user_id') . "', `date_modified` = '" . date('Y-m-d h:i:sa') . "', modified_by='".$this->session->userdata('user_id')."'");
		}
		
	}
	
	/**
	* 
	* @function name 	: getTotalPurchaseReturn()
	* @description   	: get total no of purchase return from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalPurchaseReturn() 
	{
		$sql = "SELECT COUNT(*) AS total FROM purchase_return";
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	
	/**
	* 
	* @function name 	: getPurchaseReturns()
	* @description   	: get all purchases from database
	* @access 		 	: public
	* @param   		 	: string $information The attributes that you want to get
	* @return       	: array The selected attributes array
	*
	*/
	public function getPurchaseReturns($data = array())
	{
                
		$sql = "SELECT * FROM purchase_return a WHERE 1=1";
                
		$sort_data = array(
			'purchase_id',
			'order_id',
			'sort_order'			
		);
                
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " AND is_deleted = 0";
		}
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY purchase_return_id";
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
	* @function name 	: softDeletePurchaseReturn()
	* @description   	: only status change not actual delete Purchase return from database
	* @access 		 	: public
	* @param   		 	: int $purchase_return_id The purchase return id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeletePurchaseReturn($purchase_return_id)	{	
		$this->db->set('is_deleted',1);
		$this->db->where('purchase_return_id',(int)$purchase_return_id);
		return $this->db->update('purchase_return');
	}
	
	
	/**
	* 
	* @function name 	: deletePurchaseReturn()
	* @description   	: delete purchase return record from database
	* @access 		 	: public
	* @param   		 	: int $purchase_return_id The purchase return id that you want to delete
	* @return       	: void
	*
	*/	
	public function deletePurchaseReturn($purchase_return_id) {
		
		$this->db->query("DELETE FROM `purchase_return` WHERE purchase_return_id = '" . (int)$purchase_return_id . "'");
		
		$this->db->query("DELETE FROM `purchase_return_history` WHERE purchase_return_id = '" . (int)$purchase_return_id . "'");
	}
	
	/**
	* 
	* @function name 	: viewPurchaseReturnProduct()
	* @description   	: Detail view of Purchase Return from database
	* @access 		 	: public
	* @param   		 	: int $purchase_return_id The purchase return id that you want to delete
	* @return       	: void
	*
	*/
	public function viewPurchaseReturnProduct($purchase_return_id) 
	{			
		$query=$this->db->query("select * from `purchase_return` where purchase_return_id='".(int)$purchase_return_id."'");
		return $query->row_array();
	}
	
}
?>