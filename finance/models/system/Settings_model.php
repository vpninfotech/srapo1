<?php
/**
* 
* @file name   : Settings_model
* @Auther      : Vinay
* @Date        : 21-10-2016
* @Description : Common Business Logic
*
*/
class Settings_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    /**
    * 
    * @function name : save()
    * @description   : save settings value into setting table
    * @param   	     : void
    * @return        : void
    *
    */
    public function save() {
        $post_data = $this->input->post();
        //print_r($post_data);
        
        foreach($post_data as $k=>$v)
        {
            
            //$value = $this->common->escape($v);
            $this->db->set('val',stripslashes($v))->where('key',$k)->update('setting');
            
        }        
    }
    
    /**
    * 
    * @function name : getConfigCurrency()
    * @description   : save settings value into setting table
    * @param   	     : void
    * @return        : void
    *
    */
    public function getConfigCurrency() {
       
	   $get_config_currency=$this->db->query("select * from `setting` where `key` = 'config_currency'");  
	   
	   $config_currency=$get_config_currency->row_array();  
	   
	   return $config_currency;
    }
}
