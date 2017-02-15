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
    
   public function editSetting($data) {

		$this->db->query("DELETE FROM `setting` WHERE `key` LIKE 'weight_%'");

		foreach ($data as $key => $value) {
			
			if (substr($key, 0, strlen('weight_')) == 'weight_') {
				
				if (!is_array($value)) {
					$this->db->set('key',$key);
					$this->db->set('val',$value);
					$this->db->insert('setting');
				} else {
					$this->db->set('key',$key);
					$this->db->set('val',$value);
					$this->db->insert('setting');
					
				}
			}
		}
		$this->common->updateShippingMethodStatus('weight',$data['weight_status']);
	}
    
}
