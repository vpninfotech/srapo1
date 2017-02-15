<?php
/**
* 
* @file name   : Users_model
* @Auther      : Vinay
* @Date        : 08-11-2016
* @Description : Collection of various common function related to user database operation.
*
*/
class Users_model extends CI_Model 
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
         $this->load->library('mailer');
    }
    
    /**
    * 
    * @function name : getUser()
    * @description   : get user record by user_id
    * @access        : public
    * @param   	     : int $user_id The user id that you want
    * @return        : array The selected users array
    *
    */
    public function getUser($user_id) 
    {
        $this->db->from('admin_user');
        $this->db->where('admin_id',(int)$user_id);
        $query=$this->db->get();
        return $query->row_array();
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
        $this->db->from('admin_user');
        $this->db->where('email',$email);
        $query=$this->db->get();
        return $query->row_array();
    }
    
    /**
    * 
    * @function name : getTotalUsersByGroupId()
    * @description   : get user record by role_id
    * @access        : public
    * @param   	     : int $user_group_id The user role_id that you want
    * @return        : int total no of records
    *
    */
    public function getTotalUsersByGroupId($user_group_id) 
    {
        $sql = "SELECT COUNT(*) AS total FROM admin_user WHERE role_id = $user_group_id";
        $query = $this->db->query($sql);
        return $query->row('total');
    }
        
    /**
    * 
    * @function name : addUser()
    * @description   : add User record in database
    * @access        : public
    * @return        : int last inserted User record id
    *
    */
    public function addUser() 
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
        $this->db->set('role_id', $this->input->post('user_group_id'));
        $this->db->set('firstname', $this->input->post('firstname'));
        $this->db->set('middlename', $this->input->post('middlename'));
        $this->db->set('lastname', $this->input->post('lastname'));
        $this->db->set('email', $this->input->post('email'));
        $this->db->set('telephone', $this->input->post('telephone'));
        $this->db->set('image', $this->input->post('image'));
        $this->db->set('ip', $_SERVER['REMOTE_ADDR']);
        $this->db->set('password', md5($this->input->post('password')));
        $this->db->set('status', $this->input->post('status'));
        $this->db->set('date_added',date('Y-m-d h:i:sa'));
        $this->db->set('added_by', $this->session->userdata('user_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('user_id'));
        $this->db->set('is_deleted', $is_deleted);
        $this->db->insert('admin_user');
        $user_id = $this->db->insert_id();
        
        if($user_id>0) 
        {
            $name = $this->input->post('firstname')." ".$this->input->post('lastname');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            
            //=== Send Email ====
            $Template = $this->mailer->Tpl_Email('user_create_by_admin',$this->commons->encode($email));
                $Recipient = $email;
                $Filter = array(
                    '{{NAME}}' =>$name,
                    '{{USER_ID}}' =>$email,
                    '{{PASSWORD}}' =>$password
                );
            $this->mailer->Send_Singal_Html_Email($Recipient,$Template,$Filter);
            //===================
        } 
        return $user_id;
        
    }
    
    /**
    * 
    * @function name : editUser()
    * @description   : edit user record in database
    * @access        : public
    * @return        : void
    *
    */
    public function editUser() 
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
        $this->db->set('role_id', $this->input->post('user_group_id'));
        $this->db->set('firstname', $this->input->post('firstname'));
        $this->db->set('middlename', $this->input->post('middlename'));
        $this->db->set('lastname', $this->input->post('lastname'));
        $this->db->set('email', $this->input->post('email'));
        $this->db->set('telephone', $this->input->post('telephone'));
        $this->db->set('image', $this->input->post('image'));
        $this->db->set('ip', $_SERVER['REMOTE_ADDR']);
        
        if($this->input->post('password')!=="")
        {
          $this->db->set('password', md5($this->input->post('password')));  
        }
        
        $this->db->set('status', $this->input->post('status'));
        $this->db->set('is_deleted', $is_deleted);
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('user_id'));
        $this->db->where('admin_id',(int)$this->input->post('admin_id'));
       
        return $this->db->update('admin_user');	
    }
	
    /**
    * 
    * @function name 	: softDeleteUser()
    * @description   	: only status change not actual delete user from database
    * @access 		: public
    * @param   		: int $user_id The user id that you want to delete
    * @return       	: void
    *
    */
    public function softDeleteUser($user_id) 
    {	
        $this->db->set('is_deleted',1);
        $this->db->where('admin_id',(int)$user_id);
        return $this->db->update('admin_user');
    }
    
    /**
    * 
    * @function name 	: deleteUser()
    * @description   	: delete user record from database
    * @access 		: public
    * @param   		: int $user_id The user id that you want to delete
    * @return       	: void
    *
    */
    public function deleteUser($user_id) 
    { 
        $this->load->model('support/ticket_model');
                $getUserData = $this->getUser($user_id);
                $FetchTicketData = $this->ticket_model->GetTicketsDataById($getUserData['role_id'],$user_id);
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
        $this->db->where('admin_id',(int)$user_id);
        return $this->db->delete('admin_user');
    }
    /**
    * 
    * @function name 	: getUsers()
    * @description   	: get all users from database
    * @access 		: public
    * @param   		: string $user_id The user name that you want to get
    * @return       	: array The selected user array
    *
    */
    public function getUsers($data = array()) 
    {
        $sql = "SELECT * FROM admin_user";
        
        $sort_data = array(
            'firstname','lastname','status','date_added'
        );
        
        if($this->session->userdata('role_id')!=1) 
        {
            $sql .= " WHERE is_deleted = 0 AND role_id != 1";
        }

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY firstname";
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
        //echo $this->db->last_query();
        return $query->result_array();
    }
    
    /**
    * 
    * @function name 	: getTotalUser()
    * @description   	: get total no of stock_status from database
    * @access 		: public
    * @return       	: int total no of records
    *
    */
    public function getTotalUser() 
    {
        $sql = "SELECT COUNT(*) AS total FROM admin_user";
        if($this->session->userdata('role_id')!=1) 
        {
            $sql .= " WHERE is_deleted = 0";
        }
        $query = $this->db->query($sql);
        return $query->row('total');
    }

    
}