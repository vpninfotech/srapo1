<?php
/**
* 
* @file name   : Expense_model
* @Auther      : Mitesh
* @Date        : 20-12-2016
* @Description : Collection of various common function related to expense database operation.
*
*/
class Expense_model extends CI_Model 
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
    
	public function getPaymentMethods()
	{
		$get_payment_modes=$this->db->query("select * from `payment_method` where `status` = 1");
		return $get_payment_modes->result_array();
	}
	
	public function getExpense($expense_id)
	{
		$get_expense=$this->db->query("select * from `expense` where expense_id='".(int)$expense_id."' and `status` = 1");
		return $get_expense->row_array();
	}
	
	/**
	* 
	* @function name 	: getExpenses()
	* @description   	: get all expenses from database
	* @access 		 	: public
	* @param   		 	: string $expenses The Expenses that you want to get
	* @return       	: array The selected TaxRates array
	*
	*/
	public function getExpenses($data = array())
	{
		if($data)
		{
			$sql = "SELECT * FROM `expense`";

			$sort_data = array(
				'expense_name'
			);
			if($this->session->userdata('finance_role_id')!=3)
			{
				$sql .= " WHERE is_deleted = 0";
			}
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY expense_name";
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
		}
		else
		{
			$sql = "SELECT * FROM `expense` WHERE `is_deleted` = 0 ORDER BY expense_name";	
		}

		$query = $this->db->query($sql);
		/*echo $this->db->last_query();
		exit;*/
		return $query->result_array();
	}
	
	public function addExpense()
	{
		$imagearr='';
		$fail=0;$success=0;
		$path="../uploads/expense_attachments/";
		if(isset($_FILES['Attachments']['name']) && $_FILES['Attachments']['name'][0] != NULL)
		{			
			$reports=$this->filestorage->FileInsert_NoType($path,'Attachments',5242880);	
			if($reports['status'] == 0)
			{
				$fail+=1;	
			}
			else
			{
				$success+=1;
				if($imagearr == NULL)
				{
					$imagearr=$reports['msg'];
				}
				else
				{
					$imagearr.="|".$reports['msg'];
				}
			}
		}
		
		$is_deleted = $this->input->post('is_deleted');
		if(isset($is_deleted))
		{
   			$is_deleted = 1;
		}
		else
		{
   			$is_deleted = 0;
		}
		
		//get tax rate
		//$tax_data=$this->tax_rates->getTaxRatesById($this->input->post('tax'));
		
		$this->db->set('user_type_id',$this->input->post('user_type'));
		$this->db->set('user_id',$this->input->post('user_list'));
		$this->db->set('expense_date',date('Y-m-d',strtotime($this->input->post('expense_date'))));
		$this->db->set('reference',$this->input->post('reference'));
		$this->db->set('expense_name',$this->input->post('expense_name'));
		$this->db->set('expense_category_id',$this->input->post('expense_category'));
		$this->db->set('expense_amount',$this->input->post('amount'));
		$this->db->set('attachment',$imagearr);
		$this->db->set('note',$this->input->post('description'));
		$this->db->set('currency_code',$this->input->post('currency_code'));
		$this->db->set('currency_value',$this->input->post('currency_value'));
		$this->db->set('currency_id',$this->input->post('currency_id'));
		// $this->db->set('payment_method',$this->input->post('payment_method'));
		// $this->db->set('tax_id',$this->input->post('tax'));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('finance_user_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('finance_user_id'));
		$this->db->insert('expense');
		return $this->db->insert_id();
	}
	
	
	/**
	* 
	* @function name 	: editExpense()
	* @description   	: edit expense record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editExpense()
	{		
		$imagearr='';
		$fail=0;$success=0;
		$path="../uploads/expense_attachments/";
		if(isset($_FILES['Attachments']['name']) && $_FILES['Attachments']['name'][0] != NULL)
		{
			/* delete file */
			$file=$path.$this->input->post('HAttachments');
			if(file_exists($file))
			{
				if(is_file($file))
				{
					unlink($file); //delete file
				}
			}
			/* //delete file */
			
			$imagedata=explode("|",$this->input->post('HAttachments'));
			foreach($imagedata as $image)
			{
				$this->filestorage->DeleteImage($path,$image);	
			}
			// foreach($_FILES['Attachments']['name'] as $key=>$val)
			// {
				$reports=$this->filestorage->FileInsert_NoType($path,'Attachments',5242880);	
				if($reports['status'] == 0)
				{
					$fail+=1;	
				}
				else
				{
					$success+=1;
					if($imagearr == NULL)
					{
						$imagearr=$reports['msg'];
					}
					else
					{
						$imagearr.="|".$reports['msg'];
					}
				}
			//}		
		}
		else
		{
			$imagearr=	$this->input->post('HAttachments');
		}
		
		/*$is_deleted = $this->input->post('is_deleted');
		if(isset($is_deleted))
		{
   			$is_deleted = 1;
		}
		else
		{
   			$is_deleted = 0;
		}*/
		
		//get tax rate
		//$tax_data=$this->tax_rates->getTaxRatesById($this->input->post('tax'));
		
		
		$this->db->set('user_type_id',$this->input->post('user_type'));
		$this->db->set('user_id',$this->input->post('user_list'));
		$this->db->set('expense_date',date('Y-m-d',strtotime($this->input->post('expense_date'))));
		$this->db->set('reference',$this->input->post('reference'));
		$this->db->set('expense_name',$this->input->post('expense_name'));
		$this->db->set('expense_category_id',$this->input->post('expense_category'));
		$this->db->set('expense_amount',$this->input->post('amount'));
		$this->db->set('attachment',$imagearr);
		$this->db->set('note',$this->input->post('description'));
		$this->db->set('currency_code',$this->input->post('currency_code'));
		$this->db->set('currency_value',$this->input->post('currency_value'));
		$this->db->set('currency_id',$this->input->post('currency_id'));
		// $this->db->set('payment_method',$this->input->post('payment_method'));
		// $this->db->set('tax_id',$this->input->post('tax'));		
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('user_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('user_id'));		
		$this->db->where('expense_id',(int)$this->input->post('expense_id'));
		return $this->db->update('expense');	
	}
	
	/**
	* 
	* @function name 	: getTotalExpense()
	* @description   	: get total no of expense from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalExpense() 
	{
		$sql = "SELECT COUNT(*) AS total FROM expense";
		if($this->session->userdata('finance_role_id')!=3)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}

	/**
	* 
	* @function name 	: deleteExpense()
	* @description   	: delete expense record from database
	* @access 		 	: public
	* @param   		 	: int $expense_id The expense_id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteExpense($expense_id) 
	{	
		$expense_info = $this->expense->getExpense($expense_id);
		
		if($expense_info['attachment'] != "")
		{
			/* delete file */
			$file="../uploads/expense_attachments/". $expense_info['attachment'];
			if(file_exists($file))
			{
				if(is_file($file))
				{
					unlink($file); //delete file
				}
			}
			/* //delete file */
		}
		
				
		$this->db->where('expense_id',(int)$expense_id);
		return $this->db->delete('expense');
	} 
	
	/**
	* 
	* @function name 	: softDeleteCurrency()
	* @description   	: only status change not actual delete currency from database
	* @access 		 	: public
	* @param   		 	: int $currency_id The currency id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteExpense($expense_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('expense_id',(int)$expense_id);
		return $this->db->update('expense');
	}
	
	/**
	* 
	* @function name 	: viewExpense()
	* @description   	: Detail view of expense from database
	* @access 		 	: public
	* @param   		 	: int $expense_id The expense id that you want to delete
	* @return       	: void
	*
	*/
	public function viewExpense($expense_id) 
	{	
		//$expense_id=(int)$this->input->post('expense_id');
		$get_expense=$this->db->query("select * from `expense` where expense_id='".(int)$expense_id."' and `status` = 1");
		return $get_expense->row_array();
	}
	
	/**
	* 
	* @function name : getUserDataByUserId()
	* @description   : get User records by UserId
	* @param   		 : void
	* @return        : json
	*
	*/
	public function getUserDataByUserId($expense_user_id,$expense_user_type_id)
	{
		//$this->output->unset_template();
		$role_id = $expense_user_type_id;		
		$data = array();
		if($role_id)
		{
			if($role_id == 6)
			{
				/*$manufacture_list = $this->ticket->getManufacturer();				
				foreach ($manufacture_list as $key => $value) {
					$data[$key]['user_id'] = $value['manufacturer_id'];
					$data[$key]['user_name'] = $value['name'];
				}*/
				
				$manufacture_data=$this->ticket->getManufacturerById($expense_user_id);
				/*echo "<pre>";
				print_r($manufacture_data);
				echo "</pre>";
				exit;*/
				$data['user_id']=$manufacture_data['manufacturer_id'];
				$data['user_name']=$manufacture_data['name'];
				/*foreach ($manufacture_data as $key1 => $value1) {
					$data[$key1]['user_id'] = $value1['manufacturer_id'];
					$data[$key1]['user_name'] = $value1['name'];
				}*/
			}
			if($role_id == 8)
			{
				/*$customer_list = $this->ticket->getCustomer();
				foreach ($customer_list as $key => $value) {
					$data[$key]['user_id'] = $value['customer_id'];
					$data[$key]['user_name'] = $value['name'];
				}*/
				
				$customer_data = $this->ticket->getCustomerById($expense_user_id);
				$data['user_id'] = $customer_data['customer_id'];
				$data['user_name'] = $customer_data['name'];
			}
			if($role_id != 6 &&  $role_id != 8)
			{
				/*$user_list = $this->ticket->getUserByRoleId($role_id);
				foreach ($user_list as $key => $value) {
					$data[$key]['user_id'] = $value['admin_id'];
					$data[$key]['user_name'] = $value['firstname'].' '.$value['lastname'];
				}*/
				$user_list = $this->ticket->getUserByAdminId($expense_user_id) ;
				$data['user_id'] = $user_list['admin_id'];
				$data['user_name'] = $user_list['firstname'].' '.$user_list['lastname'];
				/*foreach ($user_list as $key => $value) {
					$data[$key]['user_id'] = $value['admin_id'];
					$data[$key]['user_name'] = $value['firstname'].' '.$value['lastname'];
				}*/
			}
		}
		
		return $data;
		//echo json_encode($data);

	}
	
	
}
?>