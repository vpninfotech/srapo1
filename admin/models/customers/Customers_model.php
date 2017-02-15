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
                $this->load->library('mailer');
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
                
                $customer_id = $this->db->insert_id();
                
                if($this->input->post('address') !== NULL) {
                   // print_r($this->input->post('address'));exit;
                    foreach($this->input->post('address') as $address) {
                        $this->db->set('customer_id',(int)$customer_id);
                        $this->db->set('firstname',$address['firstname']);
                        $this->db->set('lastname',$address['lastname']);
                        $this->db->set('company',$address['company']);
                        $this->db->set('address_1',$address['address_1']);
                        $this->db->set('address_2',$address['address_2']);
                        $this->db->set('city',$address['city']);
                        $this->db->set('postcode',$address['postcode']);
                        $this->db->set('state_id',$address['state_id']);
                        $this->db->set('country_id',$address['country_id']);
                        $this->db->set('date_added',date('Y-m-d h:i:sa'));
                        $this->db->set('added_by',(int)$this->session->userdata('user_id'));
                        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
                        $this->db->set('modified_by',(int)$this->session->userdata('user_id'));
                        $this->db->insert('address');
                        
                        if(isset($address['default'])) {
                            $address_id = $this->db->insert_id();
                            
                            $this->db->query("UPDATE customer SET address_id = '".(int)$address_id."' WHERE customer_id = '".(int)$customer_id."'");
                            
                        }
                    }
                }
                if($customer_id)
               {
                    $name = $this->input->post('first_name')." ".$this->input->post('last_name');
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');
                  //=== Send Email ====
                    $Template = $this->mailer->Tpl_Email('customer_create_by_admin',$this->commons->encode($email));
                        $Recipient = $email;
                        $Filter = array(
                            '{{NAME}}' =>$name,
                            '{{USER_ID}}' =>$email,
                            '{{PASSWORD}}' =>$password
                        );
                    $this->mailer->Send_Singal_Html_Email($Recipient,$Template,$Filter);
                //===================
                } 
                
		return $customer_id;
		 
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
                $query = $this->db->update('customer');
                
                $this->db->query("DELETE FROM address WHERE customer_id='".(int)$this->input->post('customer_id')."'");
                
                if($this->input->post('address') !== NULL) {
                   // print_r($this->input->post('address'));exit;
                    foreach($this->input->post('address') as $address) {
                       
                        $this->db->set('customer_id',(int)$this->input->post('customer_id'));
                        $this->db->set('firstname',$address['firstname']);
                        $this->db->set('lastname',$address['lastname']);
                        $this->db->set('company',$address['company']);
                        $this->db->set('address_1',$address['address_1']);
                        $this->db->set('address_2',$address['address_2']);
                        $this->db->set('city',$address['city']);
                        $this->db->set('postcode',$address['postcode']);
                        $this->db->set('state_id',$address['state_id']);
                        $this->db->set('country_id',$address['country_id']);
                        $this->db->set('date_added',date('Y-m-d h:i:sa'));
                        $this->db->set('added_by',(int)$this->session->userdata('user_id'));
                        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
                        $this->db->set('modified_by',(int)$this->session->userdata('user_id'));
                        $this->db->insert('address');
                        
                        if(isset($address['default'])) {
                            $address_id = $this->db->insert_id();
                            
                            $this->db->query("UPDATE customer SET address_id = '".(int)$address_id."' WHERE customer_id = '".(int)$this->input->post('customer_id')."'");
                            
                        }
                    }
                }
                
                
		return $query;	
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
            
            $this->load->model('support/ticket_model');
                
                $FetchTicketData = $this->ticket_model->GetTicketsDataById(8,$customer_id);
                $path="uploads/tickets_attachments/";
                
                foreach ($FetchTicketData as $TicketData) {
                    
                    $getTicketInfo = $this->ticket_model->ticketinfo_byid($TicketData['ticket_id']);
                    
                    
                    foreach ($getTicketInfo['Ticket_reply'] as $TicketInfo) {
                        
                        if($TicketInfo['attachments'])
                        {
                            $attchs=explode("|",$TicketInfo['attachments']);
                            foreach($attchs as $attach)	
                            {
                                $this->filestorage->DeleteImageTickets($path,$attach);	
                            }
                        }
                    }
                    $this->db->where('ticket_id',(int)$TicketData['ticket_id']);
                    $this->db->delete('ticket_reply'); 
                    
                    $this->db->where('department_id',(int)$TicketData['department_id']);
                    $this->db->where('customer_id',(int)$TicketData['customer_id']);
                    if($TicketData['attachments'])
                    {
                        $attchs=explode("|",$TicketData['attachments']);
                        foreach($attchs as $attach)	
                        {
                            $this->filestorage->DeleteImageTickets($path,$attach);	
                        }
                    }
                    $this->db->delete('ticket');
                    //echo $this->db->last_query();
                }
		$this->db->where('customer_id',(int)$customer_id);
		$query = $this->db->delete('customer');
                $this->db->query("DELETE FROM address WHERE customer_id = '" . (int)$customer_id . "'");
                return $query;
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
		$sql = "SELECT *, CONCAT(firstname, ' ', lastname) AS name FROM customer WHERE 1=1";

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
			$sql .= " AND " . implode(" AND ", $implode);
		}

		$sort_data = array(
			'firstname','lastname','email','status','ip','date_added'
		);
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " AND is_deleted = 0";
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
       //         echo $this->db->last_query();
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
	public function getTotalCustomer($data = array()) 
	{
            
		$sql = "SELECT COUNT(*) AS total FROM customer";
                
                $implode = array();
                
                if (!empty($data['filter_name'])) {
                    $implode[] = "CONCAT(firstname, ' ', lastname) LIKE '%" . $data['filter_name'] . "%'";
		}
                
                if (!empty($data['filter_email'])) {
                    $implode[] = "email LIKE '%" . $data['filter_email'] . "%'";
		}
                
                if (!empty($data['filter_customer_group_id'])) {
                    $implode[] = "group_id = '" . (int)$data['filter_customer_group_id'] . "'";
		}
                
                if (!empty($data['filter_status'])) {
                    $implode[] = "status = '" . (int)$data['filter_status'] . "'";
		}
                
                if (!empty($data['filter_date_added'])) {
                    $implode[] = "date_added = '" . $data['filter_date_added'] . "'";
		}
                
                if (!empty($data['filter_ip'])) {
                    $implode[] = "ip LIKE '%" . $data['filter_ip'] . "%'";
		}
                
                if ($implode) {
                    $sql .= " WHERE " . implode(" AND ", $implode);
		}
                
		$query = $this->db->query($sql);
                
                $row = $query->row_array();
                
                return $row['total'];
                    
                
                
		
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
    public function getAddress($address_id) {
		$address_query = $this->db->query("SELECT * FROM address WHERE address_id = '" . (int)$address_id . "'");

		if ($address_query->num_rows()) {
			$country_query = $this->db->query("SELECT * FROM `country` WHERE country_id = '" . (int)$address_query->row('country_id') . "'");

			if ($country_query->num_rows) {
				$country = $country_query->row('country_name');
				$iso_code_2 = $country_query->row('iso_code_2');
				$iso_code = $country_query->row('iso_code');
				$address_format = '';
			} else {
				$country = '';
				$iso_code_2 = '';
				$iso_code = '';
				$address_format = '';
			}

			$zone_query = $this->db->query("SELECT * FROM `state` WHERE state_id = '" . (int)$address_query->row('state_id') . "'");

			if ($zone_query->num_rows) 
			{
				$zone = $zone_query->row('state_name');
				$zone_code = $zone_query->row('code');
			} else {
				$zone = '';
				$zone_code = '';
			}

			return array(
				'address_id'     => $address_query->row('address_id'),
				'customer_id'    => $address_query->row('customer_id'),
				'firstname'      => $address_query->row('firstname'),
				'lastname'       => $address_query->row('lastname'),
				'company'        => $address_query->row('company'),
				'address_1'      => $address_query->row('address_1'),
				'address_2'      => $address_query->row('address_2'),
				'postcode'       => $address_query->row('postcode'),
				'city'           => $address_query->row('city'),
				'zone_id'        => $address_query->row('state_id'),
				'zone'           => $zone,
				'zone_code'      => $zone_code,
				'country_id'     => $address_query->row('country_id'),
				'country'        => $country,
				'iso_code_2'     => $iso_code_2,
				'iso_code'       => $iso_code,
				'address_format' => $address_format,
				
			);
		}
	}
    
    public function getAddresses($customer_id) {
        $address_data = array();
        
        $query = $this->db->query("SELECT * FROM address WHERE customer_id = '".(int)$customer_id."'");
        
        $address_data = $query->result_array();
       
        return $address_data;
    }
	
	/**
    * 
    * @function name : getTotalCustomersByCustomerGroupId()
    * @description   : get customer record by $customer_group_id
    * @access        : public
    * @param   	     : int $customer_group_id
    * @return        : int total no of records
    *
    */
    public function getTotalCustomersByCustomerGroupId($customer_group_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM customer WHERE group_id = '" . (int)$customer_group_id . "'");
        return $query->row('total');
    }
	
	/**
    * 
    * @function name : getTotalAddressesByCountryId()
    * @description   : get customer record by $country_id
    * @access        : public
    * @param   	     : int $country_id
    * @return        : int total no of records
    *
    */
    public function getTotalAddressesByCountryId($country_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM address WHERE country_id = '" . (int)$country_id . "'");
        return $query->row('total');
    }
	
	/**
    * 
    * @function name : getTotalAddressesByZoneId()
    * @description   : get customer record by $zone_id
    * @access        : public
    * @param   	     : int $zone_id
    * @return        : int total no of records
    *
    */
    public function getTotalAddressesByZoneId($zone_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM address WHERE state_id = '" . (int)$zone_id . "'");
        return $query->row('total');
    }
    
}

?>