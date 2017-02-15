<?php

/**
 * Return_Status Model Class
 * Collection of various common function related to Return_Status database operation.
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Customers_model extends CI_Model 
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
	* @function name 	: Customer()
	* @description   	: get Customer record by customer_id
	* @access 		 	: public
	* @param   		 	: int $customer_id The customer_id  that you want
	* @return       	: array The selected customer_id array
	*
	*/
	public function getCustomerById($customer_id)
    {
		$this->db->from('customer');
		$this->db->where('customer_id',(int)$customer_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	
	/**
	* 
	* @function name 	: addCustomer()
	* @description   	: add Customer record in database
	* @access 		 	: public
	* @return       	: int last inserted Customer record id
	*
	*/
	public function addCustomer()
	{
		$newsletter = $this->input->post('newsletter');
		if(isset($newsletter))
		{
   			$newsletter = 1;
		}
		else
		{
   			$newsletter = 0;
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
		$this->db->set('group_id',$this->input->post('group_id'));
		$this->db->set('firstname',$this->input->post('first_name'));
		$this->db->set('middlename',$this->input->post('middlename'));
		$this->db->set('lastname',$this->input->post('last_name'));
		$this->db->set('telephone',$this->input->post('telephone'));
		$this->db->set('email',$this->input->post('email'));
		$this->db->set('password',md5($this->input->post('password')));
		$this->db->set('gender',$this->input->post('gender'));
		$this->db->set('dob',$this->input->post('dob'));
		$this->db->set('newsletter',$newsletter);
		$this->db->set('ip',$_SERVER['REMOTE_ADDR']);
		$this->db->set('last_access',date('Y-m-d h:i:sa'));
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('user_id'));
                $this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('approve',$this->input->post('approve'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->insert('customer');
		return $this->db->insert_id();
		 
	}
	
	/**
	* 
	* @function name 	: editCustomer()
	* @description   	: edit Customer record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editCustomer()
	{
		$newsletter = $this->input->post('newsletter');
		if(isset($newsletter))
		{
   			$newsletter = 1;
		}
		else
		{
   			$newsletter = 0;
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
		$this->db->set('group_id',$this->input->post('group_id'));
		$this->db->set('firstname',$this->input->post('first_name'));
		$this->db->set('middlename',$this->input->post('middlename'));
		$this->db->set('lastname',$this->input->post('last_name'));
		$this->db->set('telephone',$this->input->post('telephone'));
		$this->db->set('email',$this->input->post('email'));
		if($this->input->post('password')!=="")
        {
          $this->db->set('password', md5($this->input->post('password')));  
        }
		$this->db->set('gender',$this->input->post('gender'));
		$this->db->set('dob',$this->input->post('dob'));
		$this->db->set('newsletter',$newsletter);
		$this->db->set('ip',$_SERVER['REMOTE_ADDR']);
		$this->db->set('last_access',date('Y-m-d h:i:sa'));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('approve',$this->input->post('approve'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));
		$this->db->where('customer_id',(int)$this->input->post('customer_id'));
		return $this->db->update('customer');	
	}
	
	
	/**
	* 
	* @function name 	: softDeleteCustomer()
	* @description   	: only status change not actual delete Customer from database
	* @access 		 	: public
	* @param   		 	: int $customer_id The customer_id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteCustomer($customer_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('customer_id',(int)$customer_id);
		return $this->db->update('customer');
	}
	
	/**
	* 
	* @function name 	: deleteCustomer()
	* @description   	: delete Customer record from database
	* @access 		 	: public
	* @param   		 	: int $customer_id The customer_id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteCustomer($customer_id) 
	{	
		$this->db->where('customer_id',(int)$customer_id);
		return $this->db->delete('customer');
	} 
	
	
	/**
	* 
	* @function name 	: getCustomer()
	* @description   	: get all Customer from database
	* @access 		 	: public
	* @param   		 	: string $Customer The Customer code that you want to get
	* @return       	: array The selected Customer array
	*
	*/
	public function getCustomer($data = array())
	{
		$sql = "SELECT *, CONCAT(firstname, ' ', lastname) AS name FROM customer";

		$implode = array();

		if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(firstname, ' ',lastname) LIKE '%" . $data['filter_name'] . "%'";
		}
		
		if (!empty($data['filter_email'])) {
			$implode[] = "email LIKE '%" . $data['filter_email'] . "%'";
		}
		
		if (!empty($data['filter_customer_group_id'])) {
			$implode[] = "group_id LIKE '%" . $data['filter_customer_group_id'] . "%'";
		}
	
		if(isset($data['filter_status']) && $data['filter_status']!='*' && $data['filter_status']!='')
                //if(!empty($data['filter_status']))
		{
			$implode[] = "status ='" . $data['filter_status'] . "'";
		
		}
		if (!empty($data['filter_date_added'])) {
			$implode[] = "date(date_added) = '" . date('Y-m-d',strtotime($data['filter_date_added']))."'";
		}
		
		if (!empty($data['filter_ip'])) {
			$implode[] = "ip LIKE '%" . $data['filter_ip'] . "%'";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$sort_data = array(
			'firstname'
		);
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY firstname";
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
                //echo $this->db->last_query();
		$query->result_array();
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getCustomer()
	* @description   	: get total no of Customer from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalCustomer() 
	{
		$sql = "SELECT COUNT(*) AS total FROM customer";
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	
	/**
    * 
    * @function name : getUserByEmail()
    * @description   : get user record by email_id
    * @access        : public
    * @param   	     : int $email The user email that you want
    * @return        : array The selected users array
    *
    */
    public function getUserByEmail($email) 
    {
        $this->db->from('customer');
        $this->db->where('email',$email);
        $query=$this->db->get();
        return $query->row_array();
    }
    
}

?>