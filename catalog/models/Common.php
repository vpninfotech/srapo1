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
* @function name : getSeoUrl
* @description   : get Seo Url keyword based on id and controller name(
* @param1        : string Controller Name[Ex: category_id,product_id,information_id]
* @param2        : int $id id of Records
* @return        : String Keyword of particular records
*
*/
    function getSeoUrl($controller='',$id='') {

        $this->db->where('query',$controller.'='.$id);
        $query = $this->db->get('url_alias');
		
        return $query->row('keyword');
    }
    
    function getSeoUrlId($keyword='') {

        $this->db->where('keyword',$keyword);
        $query = $this->db->get('url_alias');
        $query = $query->row('query');
		$directory  = explode('_',$query);
		$controller = explode('=',$directory[1]);
		return $controller[1];
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
    * @function name : getCustomer()
    * @description   : get customer record by customer_id
    * @access        : public
    * @param         : int $customer_id The user id that you want
    * @return        : array The selected users array
    *
    */
    public function getCustomer($customer_id) 
    {
        $this->db->from('customer');
        $this->db->where('customer_id',(int)$customer_id);
        $query=$this->db->get();
        return $query->row_array();
    }
    
    /**
    * 
    * @function name : getCustomerByEmail()
    * @description   : get customer record by email
    * @access        : public
    * @param         : int $email The user email id that you want
    * @return        : array The selected users array
    *
    */
    public function getCustomerByEmail($email) 
    {
        $this->db->from('customer');
        $this->db->where('email',$email);
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
   /**
    * 
    * @function name 	: getCountryNameById()
    * @description   	: get country record by currency_id
    * @access 		 	: public
    * @param   		 	: int $country_id The country id that you want
    * @return       	: array The selected country array
    *
    */
    public function getCountryNameById($country_id)
    {
        $this->db->select('country_name');
        $this->db->from('country');
        $this->db->where('country_id',(int)$country_id);
        $query=$this->db->get();
        $query->row_array();
        return $query->row('country_name');
    }
     /**
    * 
    * @function name    : getCountryIdByName()
    * @description      : get country record by currency Name
    * @access           : public
    * @param            : int $country_id The country id that you want
    * @return           : array The selected country array
    *
    */
    public function getCountryIdByName($country_name)
    {
        $this->db->select('country_id');
        $this->db->from('country');
        $this->db->where('country_name',$country_name);
        $query=$this->db->get();
        $query->row_array();
        return $query->row('country_id');
    }
    /**
    * 
    * @function name 	: getStateNameById()
    * @description   	: get state record by currency_id
    * @access 		 	: public
    * @param   		 	: int $country_id The country id that you want
    * @return       	: array The selected country array
    *
    */
    public function getStateNameById($state_id)
    {
        $this->db->select('state_name');
        $this->db->from('state');
        $this->db->where('state_id',(int)$state_id);
        $query=$this->db->get();
        $query->row_array();
        return $query->row('state_name');
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
}
?>