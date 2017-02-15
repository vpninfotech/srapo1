<?php
/**
 * Ticket Model Class
 * Collection of various common function related to Ticket database operation.
 *
 * @author    Indrajit Kaplatiya
 * @license   http://www.vpninfotech.com/
 */
class Ticket_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
    * 
    * @function name : GetById()
    * @description   : get tickets records by $id
    * @access        : public
    * @param   	     : void
    * @return        : array The all tickets
    *
    */
    public function GetById($id)
    {
        $this->db->from('ticket');
        $this->db->where('ticket_id',$id);
        $query=$this->db->get();
        return $query->row_array();
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
        $this->db->where('customer_id',$this->session->userdata('logistic_user_id'));
        $this->db->order_by('ticket_id','desc');
        $query=$this->db->get();
        return $query->result_array();
    }

    /**
    * 
    * @function name : GetByRoleId()
    * @description   : get tickets records by $roleId
    * @access        : public
    * @param   	     : void
    * @return        : array The selected tickets
    *
    */
    function GetByRoleId($roleId)
    {
        $this->db->select('ticket.*,role.role_name as RoleName');
        $this->db->from('ticket');
        $this->db->join('role','ticket.department_id=role.role_id');
        $this->db->where('ticket.department_id=',$roleId);
        $this->db->where('customer_id',$this->session->userdata('logistic_user_id'));
        $this->db->order_by('ticket_id','desc');
        $query=$this->db->get();
        return $query->result_array();
    }
    /**
    * 
    * @function name : getCustomer()
    * @description   : get customer records
    * @access        : public
    * @param   	     : void
    * @return        : array The selected users array
    *
    */
    public function getCustomer()
    {
        $sql = "SELECT *, CONCAT(firstname, ' ', lastname) AS name FROM customer where is_deleted = 0";	
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    /**
    * 
    * @function name : getManufacturer()
    * @description   : get manufacturer records
    * @access        : public
    * @param   	     : void
    * @return        : array The manufacturer array
    *
    */
    public function getManufacturer()
    {
    	$sql = "SELECT *, CONCAT(firstname,' ',lastname) AS name FROM manufacturer WHERE is_deleted = 0";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    /**
    * 
    * @function name : getUser()
    * @description   : get user record by role_id
    * @access        : public
    * @param   	     : int $role_id The role id that you want
    * @return        : array The selected users array
    *
    */
    public function getUserByRoleId($role_id) 
    {
        $this->db->from('admin_user');
        $this->db->where('role_id',(int)$role_id);
        $this->db->where('is_deleted=',0);
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
    	$sql = "SELECT * FROM role where is_deleted = 0";  
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
        $this->db->set('modified_by',$this->session->userdata('logistic_user_id'));	
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->where('ticket_reply_id',$this->input->post('ticket_reply_id'));
        return $this->db->update('ticket_reply');	
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
		
        if(isset($_FILES['Attachments']['name']) && $_FILES['Attachments']['name'][0] != NULL)
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
        $this->db->set('added_by',$this->session->userdata('logistic_user_id'));
        $this->db->set('added_by_role_id',$this->session->userdata('logistic_role_id'));	
        $this->db->set('date_added',date("Y-m-d H:i:sa"));
        $this->db->insert('ticket_reply');
        return $success."-".$fail;
    }
    /**
    * 
    * @function name : edit_ticket()
    * @description   : edit  ticket details
    * @access        : public
    * @param   	     : void
    * @return        : Int
    *
    */
    function edit_ticket()
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
        $this->db->set('title',$this->input->post('Title'));
        $this->db->set('priority',$this->input->post('Priority'));
        $this->db->set('description',$this->input->post('Description'));
        $this->db->set('attachments',$imagearr);
        $this->db->set('status','2');
        $this->db->set('modified_by',$this->session->userdata('logistic_user_id'));
        $this->db->set('date_modified',date("Y-m-d H:i:sa"));
        $this->db->where('ticket_id',$this->input->post('ticket_id'));
        return $this->db->update('ticket');	
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
    function add_ticket()
    {
        $imagearr='';
        $fail=0;$success=0;
        $path="../uploads/tickets_attachments/";
        if(isset($_FILES['Attachments']['name']) && $_FILES['Attachments']['name'][0] != NULL)
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

         $this->db->set('department_id',$this->session->userdata('logistic_role_id'));	
        $this->db->set('customer_id',$this->session->userdata('logistic_user_id'));
        $this->db->set('title',$this->input->post('Title'));
        $this->db->set('priority',$this->input->post('Priority'));
        $this->db->set('description',$this->input->post('Description'));
        $this->db->set('attachments',$imagearr);
        $this->db->set('status','2');
        $this->db->set('added_by',$this->session->userdata('logistic_user_id'));
        $this->db->set('added_by_role_id',$this->session->userdata('logistic_role_id'));
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
    * @function name : delete_ticket()
    * @description   : delete  ticket details by $TicketId
    * @access        : public
    * @param   	     : Int $TicketId
    * @return        : Int
    *
    */
    function delete_ticket($TicketId)
    {

    $path="uploads/tickets_attachments/";
    //===================== Delete Ticket Note data ==================
    $this->db->where('ticket_id',$TicketId);
    $this->db->from('ticket_reply');
    $query=$this->db->get();
    foreach($query->result_array() as $data)
    {
        if($data['attachments'])
        {
            $attchs=explode("|",$data['attachments']);
            foreach($attchs as $attach)	
            {
                $this->filestorage->DeleteImageTickets($path,$attach);	
            }
        }	
    }

    $this->db->where('ticket_id',$TicketId);
    $this->db->delete('ticket_reply');	

    //===================== Delete Ticket data ==================
    $this->db->where('ticket_id',$TicketId);
    $this->db->from('ticket');
    $query=$this->db->get();
    $data1=$query->row_array();
    if($data1['attachments'])
    {
        $attach=explode("|",$data1['attachments']);
        foreach($attach as $image)	
        {
            $this->filestorage->DeleteImageTickets($path,$image);
        }
    }	
    $this->db->where('ticket_id',$TicketId);
    return $this->db->delete('ticket');	
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
        //===================== Delete Ticket Note Attachments ==================
        $this->db->where('ticket_reply_id',$this->input->post('TicketReplyId'));
        $this->db->from('ticket_reply');
        $query=$this->db->get();
        $data=$query->row_array();
        if($data['Attachments'])
        {
            $attchs=explode("|",$data['Attachments']);
            foreach($attchs as $attach)	
            {
                $this->filestorage->DeleteImageTickets($path,$attach);	
            }
        }	

        $this->db->where('ticket_reply_id',$this->input->post('TicketReplyId'));
        $this->db->delete('ticket_reply');	
    }
	
	
	/**
	* 
	* @function name 	: getTotalTickets()
	* @description   	: get total no of Tickets
	* @access 		 	: public
	* @return       	: int total no of Tickets
	*
	*/
	public function getTotalTickets($data = array()) 
	{
            
		$sql = "SELECT COUNT(*) AS total FROM ticket where department_id = '".(int)$this->session->userdata('logistic_role_id')."' AND customer_id='".(int)$this->session->userdata('logistic_user_id')."'";
       
	    if (!empty($data['filter_date_added'])) {
				$sql .= " AND date_added = '" . $data['filter_date_added'] . "'";
		}    
        /*$implode = array();
                
		if (!empty($data['filter_date_added'])) {
			$implode[] = "date_added = '" . $data['filter_date_added'] . "'";
		}
                 
		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}*/
                
		$query = $this->db->query($sql);
                
		$row = $query->row_array();
		
		return $row['total'];
	}
	
	
}