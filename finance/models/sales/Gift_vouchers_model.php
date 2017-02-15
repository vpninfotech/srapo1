  <?php

/**
 * GiftVouchers Model Class
 * Collection of various common function related to GiftVouchers  database operation.
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Gift_vouchers_model extends CI_Model 
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
	* @function name 	: GiftVouchers()
	* @description   	: get GiftVouchers record by voucher_theme_id	
	* @access 		 	: public
	* @param   		 	: int $voucher_theme_id	 The voucher_theme_id that you want
	* @return       	: array The selected voucher_theme_id array
	*
	*/
	public function getGiftVouchersById($voucher_id)
    {
		$this->db->from('voucher');
		$this->db->where('voucher_id',(int)$voucher_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	
	/**
	* 
	* @function name 	: addGiftVouchers()
	* @description   	: add GiftVouchers record in database
	* @access 		 	: public
	* @return       	: int last inserted GiftVouchers record id
	*
	*/
	public function addGiftVouchers()
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
		  
		$this->db->set('code',$this->input->post('code')); 
		$this->db->set('from_name',$this->input->post('from_name')); 
		$this->db->set('from_email',$this->input->post('from_email')); 
		$this->db->set('to_name',$this->input->post('to_name')); 
		$this->db->set('to_email',$this->input->post('to_email')); 
		$this->db->set('message',$this->input->post('message')); 
		$this->db->set('amount', $this->input->post('amount'));
		$this->db->set('status', $this->input->post('status'));
		$this->db->set('voucher_theme_id', $this->input->post('voucher_theme_id'));
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('user_id'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->insert('voucher');
		return $this->db->insert_id();
		 
	}
	
	/**
	* 
	* @function name 	: editGiftVouchers()
	* @description   	: edit GiftVouchers record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editGiftVouchers()
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
		
		$this->db->set('code',$this->input->post('code')); 
		$this->db->set('from_name',$this->input->post('from_name')); 
		$this->db->set('from_email',$this->input->post('from_email')); 
		$this->db->set('to_name',$this->input->post('to_name')); 
		$this->db->set('to_email',$this->input->post('to_email')); 
		$this->db->set('message',$this->input->post('message')); 
		$this->db->set('amount', $this->input->post('amount'));
		$this->db->set('status', $this->input->post('status'));
		$this->db->set('voucher_theme_id', $this->input->post('voucher_theme_id'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('user_id'));
		$this->db->where('voucher_id',(int)$this->input->post('voucher_id'));
		return $this->db->update('voucher');	
	}
	
	
	/**
	* 
	* @function name 	: softGiftVouchers()
	* @description   	: only status change not actual delete GiftVouchers from database
	* @access 		 	: public
	* @param   		 	: int $voucher_id The voucher_id that you want to delete
	* @return       	: void
	*
	*/
	public function softDelete($voucher_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('voucher_id',(int)$voucher_id);
		return $this->db->update('voucher');
	}
	
	/**
	* 
	* @function name 	: deleteGiftVouchers()
	* @description   	: delete GiftVouchers record from database
	* @access 		 	: public
	* @param   		 	: int $voucher_id The voucher_id that you want to delete
	* @return       	: void
	*
	*/
	public function delete($voucher_id) 
	{	
		$this->db->where('voucher_id',(int)$voucher_id);
		 
		return $this->db->delete('voucher');
		
	} 
	
	
	/**
	* 
	* @function name 	: getGiftVouchers()
	* @description   	: get all GiftVouchers from database
	* @access 		 	: public
	* @param   		 	: string $GiftVouchers The GiftVouchers code that you want to get
	* @return       	: array The selected GiftVouchers array
	*
	*/
	public function getGiftVouchers($data = array())
	{
		if($data)
		{
			$sql = "SELECT * FROM voucher WHERE 1=1";

			$sort_data = array(
				'code',
                                'from_name',
                                'to_name',
                                'amount',
                                'status',
                                'date_added'
			);
			if($this->session->userdata('role_id')!=1)
			{
				$sql .= " AND is_deleted = 0";
			}
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY code";
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
			$sql = "SELECT * FROM voucher WHERE is_deleted = 0 ORDER BY code";	
		}

		$query = $this->db->query($sql);
		$query->result_array();
                //echo $this->db->last_query();
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: gettotalGiftVouchers()
	* @description   	: get total no of GiftVouchers from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalGiftVouchers() 
	{
		$sql = "SELECT COUNT(*) AS total FROM  voucher ";
		if($this->session->userdata('role_id')!=1)
		{
			$sql .= "WHERE is_deleted = 0";
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
    public function getUserByEmail($from_email) 
    {
        $this->db->from('voucher');
        $this->db->where('from_email',$from_email);
        $query=$this->db->get();
        return $query->row_array();
    }
	
	/**
    * 
    * @function name : getTotalVouchersByVoucherThemeId()
    * @description   : get voucher record by $theme_id
    * @access        : public
    * @param   	     : int $theme_id
    * @return        : int total no of records
    *
    */
    public function getTotalVouchersByVoucherThemeId($voucher_theme_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM voucher WHERE voucher_theme_id = '" . (int)$voucher_theme_id . "'");
        return $query->row('total');
        
    }
    /**
    * 
    * @function name : sendVoucher()
    * @description   : get voucher record by $voucher_id and send voucher on mail
    * @access        : public
    * @param   	     : int $voucher_id
    * @return        : int total no of records
    *
    */
    public function sendVoucher($voucher_id) {
        $voucher_info = $this->getGiftVouchersById($voucher_id);
        
        if ($voucher_info) {
            if ($voucher_info['order_id']) {
                $order_id = $voucher_info['order_id'];
            } else {
                $order_id = 0;
            }
        }
        
        $this->load->model('sales/orders_model');
        $order_info = $this->orders_model->getOrder($order_id);
        
        $this->load->model('sales/voucher_themes_model');
        $voucher_theme_info = $this->voucher_themes_model->getVoucherThemesById($voucher_info['voucher_theme_id']);
        
        if ($voucher_theme_info && is_file(DIR_IMAGE . $voucher_theme_info['image'])) {
            $voucherTheme = HTTP_CATALOG . 'image/' . $voucher_theme_info['image'];
        } else {
            $voucherTheme = '';
        }
        
        // If voucher belongs to an order
        if ($order_info) {
            //=== Send Email ====
            
            $Template = $this->mailer->Tpl_Email('gift_voucher_receive',$this->commons->encode($voucher_info['to_email']));
                $Recipient = $voucher_info['to_email'];
                $Filter = array(
                    '{{RECEIVER-NAME}}'         =>$voucher_info['to_name'],
                    '{{AMOUNT-WITH-CURRENCY}}'  =>$this->currency->format($voucher_info['amount'], $order_info['currency_code'], $order_info['currency_value']),
                    '{{SENDER-NAME}}'           =>$voucher_info['from_name'],
                    '{{MSG}}'                   =>$voucher_info['message'],
                    '{{THEME}}'                 =>'<img src="'.$voucherTheme.'" width="40%" alt="voucher-theme">',
                    '{{CODE}}'                  =>$voucher_info['code'],
                    '{{STORE-URL}}'             =>'<a href="'.HTTP_CATALOG.'" target="_blank">srapo.com</a>'
                );
            $this->mailer->Send_Singal_Html_Email($Recipient,$Template,$Filter);
            //===================
        
        // If voucher does not belong to an order
        } else {
            //=== Send Email ====
            
            $Template = $this->mailer->Tpl_Email('gift_voucher_receive',$this->commons->encode($voucher_info['to_email']));
                $Recipient = $voucher_info['to_email'];
                $Filter = array(
                    '{{RECEIVER-NAME}}'         =>$voucher_info['to_name'],
                    '{{AMOUNT-WITH-CURRENCY}}'  =>$this->currency->format($voucher_info['amount'], $order_info['currency_code'], $order_info['currency_value']),
                    '{{SENDER-NAME}}'           =>$voucher_info['from_name'],
                    '{{MSG}}'                   =>$voucher_info['message'],
                    '{{THEME}}'                 =>'<img src="'.$voucherTheme.'" width="40%" alt="voucher-theme">',
                    '{{CODE}}'                  =>$voucher_info['code'],
                    '{{STORE-URL}}'             =>'<a href="'.HTTP_CATALOG.'" target="_blank">srapo.com</a>'
                );
            $this->mailer->Send_Singal_Html_Email($Recipient,$Template,$Filter);
            //===================
        }
    }	
	 
    
}
	
	 
	 
    
 

?>