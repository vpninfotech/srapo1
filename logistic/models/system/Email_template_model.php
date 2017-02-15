<?php

/**
 * Email_template Model Class
 * Collection of various common function related to Email Template database operation.
 *
 * @author    Vinay Ghael
 * @license   http://www.vpninfotech.com/
 */
class Email_template_model extends CI_Model 
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
	}
	
	/**
	* 
	* @function name 	: getEmailTemplateById()
	* @description   	: get email_template record by template_id
	* @access 		: public
	* @param   		: int $template_id The template_id  that you want
	* @return       	: array The selected template_id array
	*
	*/
	public function getEmailTemplateById($template_id)
        {
            $this->db->from('email_template');
            $this->db->where('template_id',(int)$template_id);
            $query=$this->db->get();
            return $query->row_array();
        }
        
        /**
        * 
        * @function name : GetField
        * @description   : get data by field, key and value from table
        * @param1        : string
        * @param2        : string
        * @return        : array
        *
        */ 
        function GetField($Field,$k,$v)
        {
            $this->db->from('email_template');
            $this->db->where($k,$v);
            $query=$this->db->get();
            $row = $query->row_array();
            return $row[$Field];
        }
	
	/**
	* 
	* @function name 	: editProduct()
	* @description   	: edit Product record in database
	* @access 		: public
	* @return       	: void
	*
	*/
	public function editEmailTemplate()
	{  
            $this->db->set('subject',$this->input->post('subject'));
            $this->db->set('content',$this->input->post('message'));
            $this->db->where('template_id',(int)$this->input->post('template_id'));
            return $this->db->update('email_template');
	}
	
	/**
	* 
	* @function name 	: getEmailTemplates()
	* @description   	: get all email templates from database
	* @access 		: public
	* @param   		: string $Email_template The Email Template that you want to get
	* @return       	: array The selected Email Template array
	*
	*/
	public function getEmailTemplates($data = array())
	{
            $sql = "SELECT * FROM email_template";		

            $sort_data = array(
                'template_name',
                'subject'
            );
		
            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY " . $data['sort'];
            } else {
                $sql .= " ORDER BY template_name";
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
            //echo $this->db->last_query();
            $query->result_array();
            return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalEmailTemplate()
	* @description   	: get total no of email template from database
	* @access 		: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalEmailTemplate() 
	{
            $sql = "SELECT COUNT(*) AS total FROM email_template";            
            $query = $this->db->query($sql);
            return $query->row('total');
	}  
        
        /**
	* 
	* @function name 	: RestoreDefault()
	* @description   	: restore message body of email template from database
	* @access 		: public
        * @param                : $TemplateId
	* @return       	: void
	*
	*/
        function RestoreDefault($TemplateId)
	{
            $Content = $this->GetField('default','template_id',$TemplateId);
            $this->db->set('content',$Content);
            $this->db->where('template_id',$TemplateId);
            $this->db->update('email_template');	
	}
}

?>