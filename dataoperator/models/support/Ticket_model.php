<?php
/**
 * Data_operator_ticket Model Class
 * Collection of various common function related to Ticket database operation.
 *
 * @author    Indrajit Kaplatiya,Mitesh
 * @license   http://www.vpninfotech.com/
 */
class Ticket_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	  
	
	///// add required function /////
	/**
	* 
	* @function name 	: getTotalTickets()
	* @description   	: get total no of Tickets from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalTickets() 
	{
		//$sql = "SELECT COUNT(*) AS total FROM ticket where department_id=5";
		if($this->session->userdata('role_id')!=1)
		{
			//$sql .= " WHERE is_deleted = 0";
			$sql = "SELECT COUNT(*) AS total FROM ticket where department_id=5 and is_deleted = 0";
		}
		else
		{
			$sql = "SELECT COUNT(*) AS total FROM ticket where department_id=5";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	/**
	* 
	* @function name 	: getDataOperatorTickets()
	* @description   	: get all Data Operator Tickets from database
	* @access 		 	: public
	* @param   		 	: string $department_id The department id that you want to get
	* @return       	: array The selected state array
	*
	*/
	public function getDataOperatorTickets($data = array())
	{
		if($data)
		{
			$sql = "SELECT * FROM ticket where department_id=5";

			$sort_data = array(
				'ticket_id'				
			);
			if($this->session->userdata('role_id')!=1)
			{
				$sql .= " and is_deleted = 0";
			}
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY ticket_id";
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
			$sql = "SELECT * FROM tickets where department_id=5 and is_deleted = 0 ORDER BY ticket_id ASC";
		}

		$query = $this->db->query($sql);
		//$query->result_array();
                //echo $this->db->last_query();
		return $query->result_array();
	}
	
	
	/**
	* 
	* @function name 	: softDeleteTicket()
	* @description   	: only status change not actual delete state from database
	* @access 		 	: public
	* @param   		 	: int $ticket_id The ticket id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteTicket($ticket_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('ticket_id',(int)$ticket_id);
		return $this->db->update('ticket');
	}
	
	/**
	* 
	* @function name 	: deleteTicket()
	* @description   	: delete Ticket record from database
	* @access 		 	: public
	* @param   		 	: int $ticket_id The ticket id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteTicket($ticket_id) 
	{	
		$this->db->where('ticket_id',(int)$ticket_id);
		return $this->db->delete('ticket');
	} 
	
	/**
	* 
	* @function name 	: getTicketDetails()
	* @description   	: get ticket record by ticket_id
	* @access 		 	: public
	* @param   		 	: int $ticket_id The ticket id that you want
	* @return       	: array The selected ticket array
	*
	*/
	public function getTicketDetails($ticket_id)
    {
		$this->db->from('ticket');
		$this->db->where('ticket_id',(int)$ticket_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	
	/**
    * 
    * @function name : add_ticket()
    * @description   : add  ticket details
    * @access        : public
    * @param   	     : void
    * @return        : Int
    *
    */
	function addTicket()
	{
		/*echo "<pre>";
		print_r($_FILES);
		echo "</pre>";
		exit;*/
		$imagearr='';
		$fail=0;$success=0;
		$path="../uploads/tickets_attachments/";
		if(isset($_FILES['Attachments']['name']) && $_FILES['Attachments']['name'] != NULL)
		{
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
			// }		
		}

		$this->db->set('department_id',$this->session->userdata('Drole_id'));	
		$this->db->set('customer_id',$this->session->userdata('Duser_id'));
		$this->db->set('title',$this->input->post('Title'));
		$this->db->set('priority',$this->input->post('Priority'));
		$this->db->set('description',$this->input->post('Description'));
		$this->db->set('attachments',$imagearr);
		$this->db->set('status','1');
		$this->db->set('added_by',$this->session->userdata('Duser_id'));
		$this->db->set('added_by_role_id',$this->session->userdata('Drole_id'));
		$this->db->set('date_added',date("Y-m-d H:i:sa"));
		$res=$this->db->insert('ticket');	
	    if($res)
		{
			$last_id=$this->db->insert_id();
			$ticketcode=date("Y").$last_id;
			$this->db->set('ticket_code',$ticketcode);
			$this->db->where('ticket_id',$last_id);
		    $this->db->update('ticket');
			return $last_id;	
		}
		else
		{
			return false;	
		}
	}
	
	/**
    * 
    * @function name : editTicket()
    * @description   : edit  ticket details
    * @access        : public
    * @param   	     : void
    * @return        : Int
    *
    */
	function editTicket()
	{
		$imagearr='';
		$fail=0;$success=0;
		$path="../uploads/tickets_attachments/";
		if(isset($_FILES['Attachments']['name']) && $_FILES['Attachments']['name'] != NULL)
		{
			
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
		//echo $this->input->post('ticket_id');exit;
		$this->db->set('department_id',$this->session->userdata('Drole_id'));	
		$this->db->set('customer_id',$this->session->userdata('Duser_id'));
		$this->db->set('title',$this->input->post('Title'));
		$this->db->set('priority',$this->input->post('Priority'));
		$this->db->set('description',$this->input->post('Description'));
		$this->db->set('attachments',$imagearr);
		
		$this->db->set('modified_by',$this->session->userdata('Duser_id'));
		$this->db->set('date_modified',date("Y-m-d H:i:sa"));
		$this->db->where('ticket_id',$this->input->post('ticket_id'));
		return $this->db->update('ticket');	
	}
	
	/**
    * 
    * @function name : ticketinfo_byid()
    * @description   : get ticket details bt $ticketid
    * @access        : public
    * @param   	     : Int $ticketid for get ticket details 
    * @return        : array of selected ticket details
    *
    */
	public function ticketinfo_byid($ticketid)
	{
		$this->db->from('ticket');
		$this->db->where('ticket_id',$ticketid);
		$query=$this->db->get();
		$data=$query->row_array();	
		if($data)
		{
			//---Created by User details
			if($data['added_by_role_id'] == 6)
			{
				$this->db->from('manufacturer');
				$this->db->where('manufacturer_id',(int)$data['added_by']);
				$query=$this->db->get();
				$manufacturer_details = $query->row_array();
				if($manufacturer_details)
				{
					$data['create_by'] = $manufacturer_details['firstname'].' '.$manufacturer_details['lastname'];
				}
			}
			else if($data['added_by_role_id'] == 8)
			{
				$this->db->from('customer');
				$this->db->where('customer_id',(int)$data['added_by']);
				$query=$this->db->get();
				$customer_details = $query->row_array();
				if($customer_details)
				{
					$data['create_by'] = $customer_details['firstname'].' '.$customer_details['lastname'];
				}
			}
			else
			{
				$this->db->from('admin_user');
		        $this->db->where('admin_id',(int)$data['added_by']);
		        $query=$this->db->get();
		        $user_details = $query->row_array();
				if($user_details)
				{
					$data['create_by'] = $user_details['firstname'].' '.$user_details['lastname'];
				}
			}
			//---On Behalf of User details
			if($data['department_id'] == 6)
			{
				$this->db->from('manufacturer');
				$this->db->where('manufacturer_id',(int)$data['customer_id']);
				$query=$this->db->get();
				$manufacturer_details = $query->row_array();
				if($manufacturer_details)
				{
					$data['behalf_of'] = $manufacturer_details['firstname'].' '.$manufacturer_details['lastname'];
				}
			}
			else if($data['department_id'] == 8)
			{
				$this->db->from('customer');
				$this->db->where('customer_id',(int)$data['customer_id']);
				$query=$this->db->get();
				$customer_details = $query->row_array();
				if($customer_details)
				{
					$data['behalf_of'] = $customer_details['firstname'].' '.$customer_details['lastname'];
				}
			}
			else
			{
				$this->db->from('admin_user');
		        $this->db->where('admin_id',(int)$data['customer_id']);
		        $query=$this->db->get();
		        $user_details = $query->row_array();
				if($user_details)
				{
					$data['behalf_of'] = $user_details['firstname'].' '.$user_details['lastname'];
				}
			}
			$this->db->from('ticket_reply');
			$this->db->where('ticket_id',$data['ticket_id']);
			$this->db->order_by('ticket_reply_id','desc');
			$query=$this->db->get();
			$data['Ticket_reply']=$query->result_array();	

			foreach ($data['Ticket_reply'] as $key => $value) {
				$data['Ticket_reply'][$key]['created_by'] = "";
				//---Created by ticket reply details
				if($value['added_by_role_id'] == 6)
				{
					$this->db->from('manufacturer');
					$this->db->where('manufacturer_id',(int)$value['added_by']);
					$query=$this->db->get();
					$manufacturer_details = $query->row_array();
					if($manufacturer_details)
					{
						$data['Ticket_reply'][$key]['created_by'] = $manufacturer_details['firstname'].' '.$manufacturer_details['lastname'];
					}
				}
				else if($value['added_by_role_id'] == 8)
				{
					$this->db->from('customer');
					$this->db->where('customer_id',(int)$value['added_by']);
					$query=$this->db->get();
					$customer_details = $query->row_array();
					if($customer_details)
					{
						$data['Ticket_reply'][$key]['created_by'] = $customer_details['first_name'].' '.$customer_details['last_name'];
					}
				}
				else
				{
					$this->db->from('admin_user');
			        $this->db->where('admin_id',(int)$value['added_by']);
			        $query=$this->db->get();
			        $user_details = $query->row_array();
					if($user_details)
					{
						$data['Ticket_reply'][$key]['created_by'] = $user_details['firstname'].' '.$user_details['lastname'];
					}
				}
			}
		} 
		
		return $data;	
	}
	
	/**
    * 
    * @function name : GetAll()
    * @description   : get All tickets records
    * @access        : public
    * @param   	     : void
    * @return        : array The all tickets
    *
    */
	public function GetAll()
    {
		$this->db->select('ticket.*,role.role_name as RoleName');
		$this->db->from('ticket');
		$this->db->join('role','ticket.department_id=role.role_id');
		$this->db->order_by('ticket_id','desc');
		$query=$this->db->get();
		return $query->result_array();
    }
	
	/**
    * 
    * @function name : getUserGroups()
    * @description   : get All user Group records
    * @access        : public
    * @param   	     : void
    * @return        : array The users Groups array
    *
    */
    public function getUserGroups()
    {
    	$sql = "SELECT * FROM role where is_deleted = 0 AND role_id != 1";  
        $query = $this->db->query($sql);
        return $query->result_array();
    }
	/**
    * 
    * @function name : ChangeStatus()
    * @description   : change ticket status by $v(Status) and $id(Ticket id)
    * @access        : public
    * @param   	     : Int $v as a status code(Like 1,2,3) 
    * @param   	     : Int $id as a ticket id
    * @return        : int
    *
    */
	public function ChangeStatus($v,$id) 
	{
		$this->db->set('status', $v);
		$this->db->where_in('ticket_id',$id);
		return $this->db->update('ticket');
	}
	
	/**
    * 
    * @function name : reply()
    * @description   : add ticket reply
    * @access        : public
    * @param   	     : void
    * @return        : String
    *
    */
	function reply()
	{
		$imagearr='';
		$fail=0;$success=0;
		$path="../uploads/tickets_attachments/";
		
		if(isset($_FILES['Attachments']['name']) && $_FILES['Attachments']['name'] != NULL)
		{
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
		
		
		$this->db->set('ticket_id',$this->input->post('ticket_id'));	
		$this->db->set('description',$this->input->post('ReplyText'));	
		$this->db->set('attachments',$imagearr);
		$this->db->set('status','1');	
		$this->db->set('added_by',$this->session->userdata('Duser_id'));
		$this->db->set('added_by_role_id',$this->session->userdata('Drole_id'));	
		$this->db->set('date_added',date("Y-m-d H:i:sa"));
		$this->db->insert('ticket_reply');
		return $success."-".$fail;
	}
	
	/**
    * 
    * @function name : fetch_ticket_reply()
    * @description   : get ticket_reply details
    * @access        : public
    * @param   	     : void
    * @return        : array of selected ticket reply details
    *
    */
	public function fetch_ticket_reply()
	{
		$this->db->from('ticket_reply');
		$this->db->where('ticket_reply_id',$this->input->post('TicketReplyId'));
		$query=$this->db->get();
		return $query->row_array();		
	}
	
	/**
    * 
    * @function name : edit_ticket_reply()
    * @description   : edit ticket_reply details
    * @access        : public
    * @param   	     : void
    * @return        : Int
    *
    */
	function edit_ticket_reply()
	{
		$imagearr='';
		$fail=0;$success=0;
		$path="../uploads/tickets_attachments/";
		
		if(isset($_FILES['Attachments']['name']) && $_FILES['Attachments']['name'][0] != NULL)
		{
			
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
		
		
			
		$this->db->set('description',$this->input->post('ReplyText'));	
		$this->db->set('attachments',$imagearr);
		$this->db->set('modified_by',$this->session->userdata('Duser_id'));	
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->where('ticket_reply_id',$this->input->post('ticket_reply_id'));
		return $this->db->update('ticket_reply');	
	}
	
	/**
    * 
    * @function name : delete_ticket_note()
    * @description   : delete  ticket reply details
    * @access        : public
    * @param   	     : Int $TicketId
    * @return        : Int
    *
    */
	function delete_ticket_note()
	{
		
		$path="uploads/tickets_attachments/";
		
		$this->db->where('ticket_reply_id',$this->input->post('TicketReplyId'));
		$this->db->from('ticket_reply');
		$query=$this->db->get();
		$data=$query->row_array();
		
		if($data['attachments'])
		{
			$attchs=explode("|",$data['attachments']);
			foreach($attchs as $attach)	
			{
				$this->filestorage->DeleteImageTickets($path,$attach);	
			}
		}	

		$this->db->where('ticket_reply_id',$this->input->post('TicketReplyId'));
		$this->db->delete('ticket_reply');	
	}
	
}