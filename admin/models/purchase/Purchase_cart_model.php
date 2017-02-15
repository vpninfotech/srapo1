<?php
/**
* 
* @file name   : Purchase_cart_model
* @Auther      : Mitesh
* @Date        : 23-12-2016
* @Description : Collection of various common function related to purchase product database operation.
*
*/
class Purchase_cart_model extends CI_Model 
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
		$this->load->model('catalog/product_model','product');
    }
	
	    
	/* add purchase cart product */
	public function add_purchase_cart()
	{
		$product_id=$this->input->post('product_id');
		$model=$this->input->post('model');
		$manufacturer_price=$this->input->post('manufacturer_price');
		$product_name=$this->input->post('product_name');
		$quantity = 1;
		
		$get_product_exist=$this->check_product_in_cart($product_id);
		
		if($get_product_exist > 0)
		{
			
			$this->db->query("UPDATE purchase_product SET quantity = (quantity + " . (int)$quantity . ") WHERE purchase_id = 0 and product_id = '".$product_id."'");			
		}
		else
		{
			
			$this->db->set('purchase_id',0);
			$this->db->set('product_id',$this->input->post('product_id'));		
			$this->db->set('name',$this->input->post('product_name'));
			$this->db->set('model',$this->input->post('model'));
			$this->db->set('quantity',1);
			$this->db->set('price',$this->input->post('manufacturer_price')); //manufacturer price		
			$this->db->set('total',$this->input->post('manufacturer_price'));		
			/*$this->db->set('date_added',date('Y-m-d h:i:sa'));
			$this->db->set('added_by',$this->session->userdata('finance_user_id'));
			$this->db->set('date_modified',date('Y-m-d h:i:sa'));
			$this->db->set('modified_by',$this->session->userdata('finance_user_id'));*/        
			$this->db->insert('purchase_product');
			return $this->db->insert_id();	
		}
				
	}
	
	//get purchase product data
	public function get_purchase_product($data = array())
	{
		$purchase_id=$this->input->post('purchase_id');
		if($purchase_id == "")
		{
			$cart_data=$this->db->query("select * from purchase_product where purchase_id = 0");
		}
		else
		{
			$cart_data=$this->db->query("select * from purchase_product where purchase_id = '".(int)$purchase_id."'");
		}
		return $cart_data->result_array();
	}
	

	/*public function get_purchase_product_edit($purchase_id)
	{
		$cart_data=$this->db->query("select * from purchase_product where purchase_id = '".$purchase_id."'");
		return $cart_data->result_array();
	}*/
	
	//check product exists in cart
	public function check_product_in_cart($product_id)
	{
		$cart_data=$this->db->query("select * from purchase_product where purchase_id = 0 and product_id = '".$product_id."'");
		$count_product=$cart_data->num_rows();
		return $count_product;
		//return $cart_data->result_array();
	}
	
	//update purchase product quantity
	public function updateProductQuantity()
	{
		$product_id = $this->input->post('product_id');
		$purchase_id = $this->input->post('purchase_id');
		$quantity = $this->input->post('quantity');
		$purchase_product_id = $this->input->post('purchase_product_id');
		
		//get product data
		$get_product_data=$this->product->getProductById($product_id);
		$product_price=$get_product_data['manufacturer_price'];
		
		$total=$quantity*$product_price;
		
		/*echo $quantity.'*'.$product_price.'='.$total;
		exit;*/
		
		$this->db->query("UPDATE purchase_product SET quantity = " . (int)$quantity . " , total = ".$total." WHERE purchase_product_id = ".$purchase_product_id." and purchase_id = '".$purchase_id ."' and product_id = '".$product_id."'");		
	}
	
	//calculate grand total
	public function product_grand_total()
	{
		$purchase_id=$this->input->post('purchase_id');
		if($purchase_id == "" || $purchase_id == 0)
		{
			$query=$this->db->query("SELECT sum(total) as grand_total FROM `purchase_product` where purchase_id=0");
		}
		else
		{
			$query=$this->db->query("SELECT sum(total) as grand_total FROM `purchase_product` where purchase_id='".(int)$purchase_id."'");
		}
		return $query->row_array();
		
	}
	
	//delete data
	public function delete_purchase_product()
	{
		$purchase_id=$this->input->post('purchase_id');
		$product_id=$this->input->post('product_id');
		if($purchase_id == "" || $purchase_id == 0)
		{
			$query=$this->db->query("delete FROM `purchase_product` where purchase_id=0 and product_id='".$product_id."'");
		}
		else
		{
			$query=$this->db->query("delete FROM `purchase_product` where purchase_id='".(int)$purchase_id."' and product_id='".$product_id."'");
		}
		
		return $query;
		
	}
	
}