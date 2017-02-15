<?php

/**
 * Return_actions Model Class
 * Collection of various common function related to Manufacturer database operation.
 *
 * @author    JinalPatel
 * @license   http://www.vpninfotech.com/
 */
class Manufacturer_model extends CI_Model 
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
	* @function name 	: getManufacturerById()
	* @description   	: get manufacturer record by manufacturer_id
	* @access 		 	: public
	* @param   		 	: int $manufacturer_id The manufacturer id that you want
	* @return       	: array The selected manufacturer array
	*
	*/
	public function getManufacturerById($manufacturer_id)
        {
		$this->db->from('manufacturer');
		$this->db->where('manufacturer_id',(int)$manufacturer_id);
		$query=$this->db->get();
		return $query->row_array();
        }
		
	/**
	* 
	* @function name 	: getManufacturerAddressById()
	* @description   	: get manufacturer record by manufacturer_id
	* @access 		 	: public
	* @param   		 	: int $manufacturer_id The manufacturer id that you want
	* @return       	: array The selected manufacturer address array
	*
	*/
	public function getManufacturerAddressById($manufacturer_id)
	{
		$this->db->from('manufacturer_address');
		$this->db->where('manufacturer_id',(int)$manufacturer_id);
		$query=$this->db->get();
		return $query->row_array();
	}
	
	/**
	* 
	* @function name 	: addManufacturer()
	* @description   	: add manufacturer record in database
	* @access 		 	: public
	* @return       	: int last inserted manufacturer record id
	*
	*/
	public function addManufacturer()
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
		$company_logo='';
        $gst="";
        $cst="";
        $upload_pancard="";
        $fail=0;$success=0;
        $path="../uploads/manufacturer_documents/";
        
        if(isset($_FILES['company_logo']['name']) && $_FILES['company_logo']['name']!= NULL)
        {
            
            $imagedata=explode("|",$this->input->post('H_company_logo'));
            foreach($imagedata as $image)
            {
                $this->filestorage->DeleteImage($path,$image);  
            }
            
                $reports=$this->filestorage->FileInsert_NoType($path,'company_logo',5242880);    
                if($reports['status'] == 0)
                {
                    $fail+=1;   
                }
                else
                {
                    $success+=1;
                    if($company_logo == NULL)
                    {
                        $company_logo=$reports['msg'];
                    }
                    else
                    {
                        $company_logo.="|".$reports['msg'];
                    }
                }
               
        }
        else
        {
            $company_logo=  $this->input->post('H_company_logo');
        }

        if(isset($_FILES['gst']['name']) && $_FILES['gst']['name']!= NULL)
        {
            
            $imagedata=explode("|",$this->input->post('H_gst'));
            foreach($imagedata as $image)
            {
                $this->filestorage->DeleteImage($path,$image);  
            }
                $reports=$this->filestorage->FileInsert_NoType($path,'gst',5242880);    
                if($reports['status'] == 0)
                {
                    $fail+=1;   
                }
                else
                {
                    $success+=1;
                    if($gst == NULL)
                    {
                        $gst=$reports['msg'];
                    }
                    else
                    {
                        $gst.="|".$reports['msg'];
                    }
                }
                 
        }
        else
        {
            $gst=  $this->input->post('H_gst');
        }

        if(isset($_FILES['cst']['name']) && $_FILES['cst']['name']!= NULL)
        {
            
            $imagedata=explode("|",$this->input->post('H_cst'));
            foreach($imagedata as $image)
            {
                $this->filestorage->DeleteImage($path,$image);  
            }
                $reports=$this->filestorage->FileInsert_NoType($path,'cst',5242880);    
                if($reports['status'] == 0)
                {
                    $fail+=1;   
                }
                else
                {
                    $success+=1;
                    if($gst == NULL)
                    {
                        $cst=$reports['msg'];
                    }
                    else
                    {
                        $cst.="|".$reports['msg'];
                    }
                }
                 
        }
        else
        {
            $cst=  $this->input->post('H_cst');
        }

        if(isset($_FILES['upload_pancard']['name']) && $_FILES['upload_pancard']['name']!= NULL)
        {
            
            $imagedata=explode("|",$this->input->post('H_upload_pancard'));
            foreach($imagedata as $image)
            {
                $this->filestorage->DeleteImage($path,$image);  
            }
                $reports=$this->filestorage->FileInsert_NoType($path,'upload_pancard',5242880);    
                if($reports['status'] == 0)
                {
                    $fail+=1;   
                }
                else
                {
                    $success+=1;
                    if($upload_pancard == NULL)
                    {
                        $upload_pancard=$reports['msg'];
                    }
                    else
                    {
                        $upload_pancard.="|".$reports['msg'];
                    }
                }
                 
        }
        else
        {
            $upload_pancard=  $this->input->post('H_upload_pancard');
        }

        if(isset($_FILES['upload_bank_doc']['name']) && $_FILES['upload_bank_doc']['name']!= NULL)
        {
            
            $imagedata=explode("|",$this->input->post('H_upload_pancard'));
            foreach($imagedata as $image)
            {
                $this->filestorage->DeleteImage($path,$image);  
            }
                $reports=$this->filestorage->FileInsert_NoType($path,'upload_bank_doc',5242880);    
                if($reports['status'] == 0)
                {
                    $fail+=1;   
                }
                else
                {
                    $success+=1;
                    if($upload_bank_doc == NULL)
                    {
                        $upload_bank_doc=$reports['msg'];
                    }
                    else
                    {
                        $upload_bank_doc.="|".$reports['msg'];
                    }
                }
                 
        }
        else
        {
            $upload_bank_doc=  $this->input->post('H_upload_bank_doc');
        }

		$this->db->set('role_id',6);
		$this->db->set('firstname',$this->input->post('firstname'));
		$this->db->set('middlename',$this->input->post('middlename'));
		$this->db->set('lastname',$this->input->post('lastname'));
		$this->db->set('email',$this->input->post('email'));
        $this->db->set('password',md5($this->input->post('password')));
		$this->db->set('telephone',$this->input->post('telephone'));
		$this->db->set('mobile',$this->input->post('mobile'));
		$this->db->set('gender',$this->input->post('gender'));
		if($this->input->post('dob') !="")
        $this->db->set('dob',date('Y-m-d', strtotime($this->input->post('dob'))));
		//$this->db->set('image',$this->input->post('image'));//
		$this->db->set('bank_name',$this->input->post('bank_name'));
		$this->db->set('bank_address',$this->input->post('bank_address'));
		$this->db->set('bank_ifsc_code',$this->input->post('bank_ifsc_code'));
		$this->db->set('account_no',$this->input->post('account_no'));
		$this->db->set('account_name',$this->input->post('account_name'));

		$this->db->set('gst',$gst);
        $this->db->set('cst',$cst);
        $this->db->set('upload_pancard',$upload_pancard);
        $this->db->set('upload_bank_doc',$upload_bank_doc);

		$this->db->set('membership_fee',$this->input->post('membership_fee'));
		$this->db->set('wallet_balance',$this->input->post('wallet_balance'));
		//$this->db->set('upload_pancard',$this->input->post('upload_pancard'));//
		//$this->db->set('upload_bank_doc',$this->input->post('upload_bank_doc'));//
		$this->db->set('upload_register_no',$this->input->post('upload_register_no'));
		//$this->db->set('activation_code',$this->input->post('activation_code'));
		//$this->db->set('ip',$this->input->post('ip'));//
				
		$this->db->set('company_name',$this->input->post('company_name'));
		$this->db->set('company_address',$this->input->post('company_address'));
		 $this->db->set('company_logo',$company_logo);
        $this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('user_id'));
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));
        $this->db->insert('manufacturer');
		$manufacturer_id = $this->db->insert_id();
               if($manufacturer_id > 0)
               {
				    //address details					
					$this->db->set('manufacturer_id',$manufacturer_id);
					//$this->db->set('firstname',$this->input->post('address_firstname'));
					//$this->db->set('lastname',$this->input->post('address_lastname'));
					//$this->db->set('company',$this->input->post('address_company_name'));
					$this->db->set('address_1',$this->input->post('address_1'));
					//$this->db->set('address_2',$this->input->post('address_2'));
					$this->db->set('city',$this->input->post('city'));
				    $this->db->set('postcode',$this->input->post('postcode'));
					$this->db->set('country_id',$this->input->post('country'));
					$this->db->set('state_id',$this->input->post('state'));
					/*$this->db->set('date_added',date('Y-m-d h:i:sa'));
					$this->db->set('added_by',$this->session->userdata('user_id'));
					$this->db->set('date_modified',date('Y-m-d h:i:sa'));
					$this->db->set('modified_by',$this->session->userdata('user_id'));*/
					$this->db->insert('manufacturer_address');
					$manufacturer_address_id = $this->db->insert_id();
					
					if($manufacturer_address_id > 0)
					{				   
						$name = $this->input->post('firstname')." ".$this->input->post('lastname');
						$email = $this->input->post('email');
						$password = $this->input->post('password');
						
						//=== Send Email ====
						$Template = $this->mailer->Tpl_Email('manufacturer_create_by_admin',$this->commons->encode($email));
							$Recipient = $email;
							$Filter = array(
								'{{NAME}}' =>$name,
								'{{USER_ID}}' =>$email,
								'{{PASSWORD}}' =>$password
							);
						$this->mailer->Send_Singal_Html_Email($Recipient,$Template,$Filter);
						//===================
					}
                } 
              return $manufacturer_id;
	}
	
	/**
	* 
	* @function name 	: editManufacturer()
	* @description   	: edit manufacturer record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editManufacturer()
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

		$company_logo='';
        $gst="";
        $cst="";
        $upload_pancard="";
        $fail=0;$success=0;
        $path="../uploads/manufacturer_documents/";
        
        if(isset($_FILES['company_logo']['name']) && $_FILES['company_logo']['name']!= NULL)
        {
            
            $imagedata=explode("|",$this->input->post('H_company_logo'));
            foreach($imagedata as $image)
            {
                $this->filestorage->DeleteImage($path,$image);  
            }
            
                $reports=$this->filestorage->FileInsert_NoType($path,'company_logo',5242880);    
                if($reports['status'] == 0)
                {
                    $fail+=1;   
                }
                else
                {
                    $success+=1;
                    if($company_logo == NULL)
                    {
                        $company_logo=$reports['msg'];
                    }
                    else
                    {
                        $company_logo.="|".$reports['msg'];
                    }
                }
               
        }
        else
        {
            $company_logo=  $this->input->post('H_company_logo');
        }

        if(isset($_FILES['gst']['name']) && $_FILES['gst']['name']!= NULL)
        {
            
            $imagedata=explode("|",$this->input->post('H_gst'));
            foreach($imagedata as $image)
            {
                $this->filestorage->DeleteImage($path,$image);  
            }
                $reports=$this->filestorage->FileInsert_NoType($path,'gst',5242880);    
                if($reports['status'] == 0)
                {
                    $fail+=1;   
                }
                else
                {
                    $success+=1;
                    if($gst == NULL)
                    {
                        $gst=$reports['msg'];
                    }
                    else
                    {
                        $gst.="|".$reports['msg'];
                    }
                }
                 
        }
        else
        {
            $gst=  $this->input->post('H_gst');
        }

        if(isset($_FILES['cst']['name']) && $_FILES['cst']['name']!= NULL)
        {
            
            $imagedata=explode("|",$this->input->post('H_cst'));
            foreach($imagedata as $image)
            {
                $this->filestorage->DeleteImage($path,$image);  
            }
                $reports=$this->filestorage->FileInsert_NoType($path,'cst',5242880);    
                if($reports['status'] == 0)
                {
                    $fail+=1;   
                }
                else
                {
                    $success+=1;
                    if($gst == NULL)
                    {
                        $cst=$reports['msg'];
                    }
                    else
                    {
                        $cst.="|".$reports['msg'];
                    }
                }
                 
        }
        else
        {
            $cst=  $this->input->post('H_cst');
        }

        if(isset($_FILES['upload_pancard']['name']) && $_FILES['upload_pancard']['name']!= NULL)
        {
            
            $imagedata=explode("|",$this->input->post('H_upload_pancard'));
            foreach($imagedata as $image)
            {
                $this->filestorage->DeleteImage($path,$image);  
            }
                $reports=$this->filestorage->FileInsert_NoType($path,'upload_pancard',5242880);    
                if($reports['status'] == 0)
                {
                    $fail+=1;   
                }
                else
                {
                    $success+=1;
                    if($upload_pancard == NULL)
                    {
                        $upload_pancard=$reports['msg'];
                    }
                    else
                    {
                        $upload_pancard.="|".$reports['msg'];
                    }
                }
                 
        }
        else
        {
            $upload_pancard=  $this->input->post('H_upload_pancard');
        }

        if(isset($_FILES['upload_bank_doc']['name']) && $_FILES['upload_bank_doc']['name']!= NULL)
        {
            
            $imagedata=explode("|",$this->input->post('H_upload_pancard'));
            foreach($imagedata as $image)
            {
                $this->filestorage->DeleteImage($path,$image);  
            }
                $reports=$this->filestorage->FileInsert_NoType($path,'upload_bank_doc',5242880);    
                if($reports['status'] == 0)
                {
                    $fail+=1;   
                }
                else
                {
                    $success+=1;
                    if($upload_bank_doc == NULL)
                    {
                        $upload_bank_doc=$reports['msg'];
                    }
                    else
                    {
                        $upload_bank_doc.="|".$reports['msg'];
                    }
                }
                 
        }
        else
        {
            $upload_bank_doc=  $this->input->post('H_upload_bank_doc');
        }

		$this->db->set('role_id',6);
        $this->db->set('firstname',$this->input->post('firstname'));
		$this->db->set('middlename',$this->input->post('middlename'));
		$this->db->set('lastname',$this->input->post('lastname'));
		$this->db->set('email',$this->input->post('email'));
		if($this->input->post('password')!=="")
		{
		  $this->db->set('password', md5($this->input->post('password')));  
		}
		$this->db->set('telephone',$this->input->post('telephone'));
		$this->db->set('mobile',$this->input->post('mobile'));
		$this->db->set('gender',$this->input->post('gender'));
		if($this->input->post('dob') !=="")
		{
			$this->db->set('dob',date('Y-m-d', strtotime($this->input->post('dob'))));
		}
        $this->db->set('bank_name',$this->input->post('bank_name'));
		$this->db->set('bank_address',$this->input->post('bank_address'));
		$this->db->set('bank_ifsc_code',$this->input->post('bank_ifsc_code'));
		$this->db->set('account_no',$this->input->post('account_no'));
		$this->db->set('account_name',$this->input->post('account_name'));

		$this->db->set('gst',$gst);
        $this->db->set('cst',$cst);
        $this->db->set('upload_pancard',$upload_pancard);
        $this->db->set('upload_bank_doc',$upload_bank_doc);
        
		$this->db->set('membership_fee',$this->input->post('membership_fee'));
		$this->db->set('wallet_balance',$this->input->post('wallet_balance'));
		$this->db->set('upload_register_no',$this->input->post('upload_register_no'));
		$this->db->set('company_name',$this->input->post('company_name'));
		$this->db->set('company_address',$this->input->post('company_address'));
		 $this->db->set('company_logo',$company_logo);
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->where('manufacturer_id',(int)$this->input->post('manufacturer_id'));
		$res= $this->db->update('manufacturer');			
		// echo $this->db->last_query();exit;
		if($res)
		{
			//address details					
			$this->db->query("delete from manufacturer_address where manufacturer_id='".(int)$this->input->post('manufacturer_id')."'");
			$this->db->set('address_1',$this->input->post('address_1'));			
			$this->db->set('city',$this->input->post('city'));
			$this->db->set('postcode',$this->input->post('postcode'));
			$this->db->set('country_id',(int)$this->input->post('country'));
			$this->db->set('state_id',(int)$this->input->post('state'));			
			$this->db->set('manufacturer_id',(int)$this->input->post('manufacturer_id'));
			$this->db->insert('manufacturer_address');	
				
		}
		return $res;
		
	}
	
	
	/**
	* 
	* @function name 	: softDeleteManufacturer()
	* @description   	: only status change not actual delete manufacturer from database
	* @access 		 	: public
	* @param   		 	: int $manufacturer_id The manufacturer id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteManufacturer($manufacturer_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('manufacturer_id',(int)$manufacturer_id);
		return $this->db->update('manufacturer');
	}
	
	/**
	* 
	* @function name 	: deleteManufacturer()
	* @description   	: delete manufacturer record from database
	* @access 		 	: public
	* @param   		 	: int $manufacturer_id The manufacturer id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteManufacturer($manufacturer_id) 
	{        
				
				
                $this->load->model('support/ticket_model');
                
                $FetchTicketData = $this->ticket_model->GetTicketsDataById(6,$manufacturer_id);
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
				
            //delete address of manufacturer
			$this->db->where('manufacturer_id',(int)$manufacturer_id);
            $this->db->delete('manufacturer_address');
			
            $this->db->where('manufacturer_id',(int)$manufacturer_id);
            return $this->db->delete('manufacturer');
	} 

	/**
	* 
	* @function name 	: getManufacturer()
	* @description   	: get all manufacturer from database
	* @access 		 	: public
	* @param   		 	: string $manufacturer The manufacturer name that you want to get
	* @return       	: array The selected manufacturer array
	*
	*/
	public function getManufacturer($data = array())
	{
            
		$sql = "SELECT *, CONCAT(firstname,' ',lastname) AS name FROM manufacturer WHERE 1=1";
                
                $implode = array();
                
                if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(firstname,' ',lastname) LIKE '%" . $data['filter_name'] . "%'";
		}
                
                if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}

		$sort_data = array(
                        'name',
			'firstname',
                        'lastname',
			'email',
			'telephone',
			'membership_fee',
			'wallet_balance'
           			
		);
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " AND is_deleted = 0";
		}
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
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
	* @function name 	: getTotalManufacturer()
	* @description   	: get total no of manufacturer from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalManufacturer($data = array()) 
	{
		$sql = "SELECT COUNT(*) AS total,CONCAT(firstname,' ',lastname) AS name FROM manufacturer where 1=1 ";
		$implode = array();
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= " and is_deleted = 0";
		}
		if (!empty($data['filter_name'])) {
			$implode[] = "CONCAT(firstname,' ',lastname) LIKE '%" . $data['filter_name'] . "%'";
		}
                
                if ($implode) {
			$sql .= " and " . implode(" AND ", $implode);
		}

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
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
        $this->db->from('manufacturer');
        $this->db->where('email',$email);
        $query=$this->db->get();
        return $query->row_array();
    }
    /**
    * 
    * @function name : getBankList()
    * @description   : get Bank List
    * @access        : public
    * @return        : array 
    *
    */
    public function getBankList() 
    {
        $this->db->from('bank_list');
        $query=$this->db->get();
        return $query->result_array();
    }
        
    
}