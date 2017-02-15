<?php
/**
* 
* @file name   : Common
* @Auther      : Indrajit
* @Date        : 06-10-2016
* @Description : Common Business Logic
*
*/
class Common extends CI_Model 
{
		
	function __construct()
	{
		parent::__construct();
		
	}

/**
* 
* @function name : config
* @description   : Find string length
* @param1        : string
* @return        : array
*
*/
    function config($key='') {

        $this->db->where('key',$key);
        $query = $this->db->get('setting');
        $res=$query->row_array();
if(isset($res['val']) && $res['key'] != 'admin_theme')
{

//echo "<pre>";
//print_r($res);
//exit;
}
        return isset($res['val'])?$res['val']:'';

    }	

/**
* 
* @function name : escape
* @description   : This can help prevent SQL injection attacks which are often performed by using the ' character to append malicious code to an SQL query.
* @param1        : string
* @return        : string
*
*/    
    function escape($val) {
        
        return @mysqli_real_escape_string($val);
        
    }

/**
* 
* @function name : GetByKey
* @description   : get data by key and value from table
* @param1        : string
* @param2        : string
* @return        : array
*
*/ 
    function GetByKey($k,$v)
    {
		$this->db->from('email_template');
		$this->db->where($k,$v);
		$query=$this->db->get();
		return $query->result_array();
    }
	/**
    * 
    * @function name : getUser()
    * @description   : get user record by user_id
    * @access        : public
    * @param         : int $user_id The user id that you want
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
    * @function name : getSmallUserProfile()
    * @description   : get small size user profile image by image name
    * @access        : public
    * @param         : int $image The image name that you want
    * @return        : small(25x25) size image
    *
    */
    public function getSmallUserProfile($image) 
    {
        //====Start Code: Call image model for resize the image
        $this->load->model('tool/image');

        if (is_file(DIR_IMAGE . $image)) {
            return $this->image->resize($image, 25, 25);
        } else {
           return;
        }
        //====End Code: Call image model for resize the image
    }
    
    /**
    * 
    * @function name : getUserProfile()
    * @description   : get user profile image by image name
    * @access        : public
    * @param         : int $image The image name that you want
    * @return        : image(90x90) size image
    *
    */
    public function getUserProfile($image) 
    {
        //====Start Code: Call image model for resize the image
        $this->load->model('tool/image');

        if (is_file(DIR_IMAGE . $image)) {
            return $this->image->resize($image, 90, 90);
        } else {
           return;
        }
        //====End Code: Call image model for resize the image
    }

    public function getPaymentMethod()
    {
        $this->db->from('payment_method');
        $this->db->where('status',1);
        $query=$this->db->get();
        return $query->result_array();

    }

    public function getShippingMethod()
    {
        $this->db->from('shipping_method');
        $this->db->where('status',1);
        $query=$this->db->get();
        return $query->result_array();

    }
    public function updatePaymentMethodStatus($payment_method_code,$status)
    {
      $this->db->set('status',$status);
      $this->db->where('payment_code',$payment_method_code);
      $this->db->update('payment_method');
    }
    public function updateShippingMethodStatus($shipping_method_code,$status)
    {
      $this->db->set('status',$status);
      $this->db->where('shipping_code',$shipping_method_code);
      $this->db->update('shipping_method');
    }
	
	public function notification($data=array())
	{
		foreach($data as $row)
		{
			$this->db->set('notify_to',$row['id']);
			$this->db->set('notify_to_role_id',$row['role_id']);
			$this->db->set('notify_by',$this->session->userdata('user_id'));
			$this->db->set('notify_by_role_id',$this->session->userdata('role_id'));
			$this->db->set('module',$row['module']);
			$this->db->set('description',$row['description']);
			$this->db->set('action_type',$row['action_type']);
			$this->db->set('url',$row['url']);
			$this->db->set('is_read',0);
			$this->db->insert('notification');
		}
	}

}
?>