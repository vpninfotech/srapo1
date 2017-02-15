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
        foreach($post_data as $k=>$v)
        {

            if(is_array($v))
            {
                 $this->db->set('val',json_encode($v))->where('key',$k)->update('setting');    
            }
            else
            {
                $this->db->set('val',stripslashes($v))->where('key',$k)->update('setting');   
            }
            
            
        }
       
        
    }
    
    
}
