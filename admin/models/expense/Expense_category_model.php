<?php

/**
 * Expense Category Model Class
 * Collection of various common function related to expense category database operation.
 *
 * @author    Mitesh
 * @license   http://www.vpninfotech.com/
 */
class expense_category_model extends CI_Model 
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
	* @function name 	: getExpenseCategory()
	* @description   	: get expense category record by expense_category_id
	* @access 		 	: public
	* @param   		 	: int $expense_category_id The expense category id that you want
	* @return       	: array The selected expense category array
	*
	*/
	public function getExpenseCategory($expense_category_id)
    {
		$this->db->from('expense_category');
		$this->db->where('expense_category_id',(int)$expense_category_id);
		$query=$this->db->get();
		return $query->row_array();
    }
    
	/**
	* 
	* @function name 	: addExpenseCategory()
	* @description   	: add currency record in database
	* @access 		 	: public
	* @return       	: int last inserted currency record id
	*
	*/
	public function addExpenseCategory()
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
		$this->db->set('expense_category_name',$this->input->post('expense_category_name'));		
		$this->db->set('transaction',$this->input->post('transaction'));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('user_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('user_id'));
		$this->db->insert('expense_category');
		
		return $this->db->insert_id();
	}
	
	/**
	* 
	* @function name 	: editExpenseCategory()
	* @description   	: edit expense category record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editExpenseCategory()
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
		$this->db->set('expense_category_name',$this->input->post('expense_category_name'));
		$this->db->set('transaction',$this->input->post('transaction'));		
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));
		$this->db->where('expense_category_id',(int)$this->input->post('expense_category_id'));
		return $this->db->update('expense_category');	
	}
	
	
	/**
	* 
	* @function name 	: softDeleteExpenseCategory()
	* @description   	: only status change not actual delete expense category from database
	* @access 		 	: public
	* @param   		 	: int $expense_category_id The expense category id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteExpenseCategory($expense_category_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('expense_category_id',(int)$expense_category_id);
		return $this->db->update('expense_category');
	}
	
	/**
	* 
	* @function name 	: deleteExpenseCategory()
	* @description   	: delete expense category record from database
	* @access 		 	: public
	* @param   		 	: int $expense_category_id The expense category id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteExpenseCategory($expense_category_id) 
	{	
		$this->db->where('expense_category_id',(int)$expense_category_id);
		return $this->db->delete('expense_category');
	} 
		
	
	/**
	* 
	* @function name 	: getExpenseCategories()
	* @description   	: get all expense categories from database
	* @access 		 	: public
	* @param   		 	: string $expense_categories The expense categories that you want to get
	* @return       	: array The selected currency array
	*
	*/
	public function getExpenseCategories($data = array())
	{
		if($data)
		{

			$sql = "SELECT * FROM expense_category";

			$sort_data = array(
				'expense_category_name',
				'status'			
			);
			if($this->session->userdata('role_id')!=1)
			{
				$sql .= " WHERE is_deleted = 0";
			}
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY title";
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
			$sql = "SELECT * FROM expense_category WHERE is_deleted = 0 ORDER BY expense_category_name ASC";
		}
		$query = $this->db->query($sql);
		
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalExpenseCategory()
	* @description   	: get total no of expense category from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalExpenseCategory() 
	{
		$sql = "SELECT COUNT(*) AS total FROM expense_category";
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	
	/**
	* 
	* @function name 	: refresh()
	* @description   	: refresh all currency rate
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function refresh($force = false)
	{
		if (extension_loaded('curl'))
		{
			$data = array();
			
			if ($force)
			{
				$this->db->where('code !=', $this->common->config('config_currency'));
				$this->db->from('currency');
				$query=$this->db->get();
			}
			else
			{
				
				$this->db->where('code !=', $this->common->config('config_currency'));
				$this->db->where('date_modified < ', date('Y-m-d H:i:s', strtotime('-1 day')));
				$this->db->from('currency');
				$query=$this->db->get();
			}
			
			foreach ($query->result_array() as $result)
			{
				$data[] = $this->common->config('config_currency') . $result['code'] . '=X';
			}
			
			$curl = curl_init();

			curl_setopt($curl, CURLOPT_URL, 'http://download.finance.yahoo.com/d/quotes.csv?s=' . implode(',', $data) . '&f=sl1&e=.csv');

			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($curl, CURLOPT_TIMEOUT, 30);

			$content = curl_exec($curl);

			curl_close($curl);

			$lines = explode("\n", trim($content));
			
			foreach ($lines as $line) 
			{
				$currency = substr($line, 4, 3);
				$value = substr($line, 11, 6);

				if ((float)$value) 
				{
					$this->db->set('value',(float)$value);
					$this->db->set('date_modified',date('Y-m-d H:i:s'));
					$this->db->where('code',$currency);
					$this->db->update('currency');
				}
			}
			
			$this->db->set('value','1.00000');
			$this->db->set('date_modified',date('Y-m-d H:i:s'));
			$this->db->where('code',$this->common->config('config_currency'));
			$this->db->update('currency');
			
		}
	}
	
	/**
	* 
	* @function name 	: getUsedExpenseCategory()
	* @description   	: get total no of Expense Category used in Expense from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getUsedExpenseCategory($expense_category_id) 
	{
		$sql = "SELECT COUNT(*) AS total FROM expense";
		if($this->session->userdata('role_id')!=1 && $expense_category_id > 0)
		{
			$sql .= " WHERE is_deleted = 0 and expense_category_id = $expense_category_id";
		}
		else
		{
			$sql .= " WHERE is_deleted = 0 ";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
}