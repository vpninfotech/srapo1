<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Login_model class
 * Collection of various common function related to system authantication.
 *
 * @author    RITESH
 * @license   http://www.vpninfotech.com/
 */

class Login_model extends CI_Model	
{
	
    /**
    * 
    * @function name 	: __construct()
    * @description   	: Initialize variables
    * @access 		    : private
    * @param   		    : void
    * @return        	: void
    *
    */
    public function __construct()	
    {
        parent::__construct();
        $this->load->library('commons');
        $this->load->library('mailer'); 
    }
	
    /**
    * 
    * @function name 	: Login()
    * @description   	: Check UserName and Password for Aithantication
    * @access 		    : public
    * @param   		    : void
    * @return        	: void
    *
    */
    public function Login()	
    { 
        $this->db->from('manufacturer');
        $this->db->where_in('role_id',array(6));
        $this->db->where('email',($this->input->post('email')));
        $this->db->where("password",md5($this->input->post('password')));
        $query=$this->db->get();
               
        //echo $this->db->last_query();
        if ($query->num_rows() == 0)  return 'invalid'; // invalid id or password
        $result = $query->row_array();
        
        if ($result['status'] == 0)  return 'inactive'; // Inactive Account
        
        $get_token  = $this->commons->token();

        // Set session data
        $this->session->set_userdata(array(
                'manufacturer_user_id'        => $result['manufacturer_id'],
                'manufacturer_name'           => $result['firstname'].' '.$result['lastname'],
                'manufacturer_role_id'        => $result['role_id'],
                'manufacturer_image'          => $result['image'],
                'manufacturer_email'          => $result['email'],
                'manufacturer_status'          => $result['status'],
                'manufacturer_token'          => $get_token,
                'manufacturer_login_status'   => TRUE,
                'manufacturer_session_id'     => session_id()
        ));
               
        //Modify Lass_Access Field in Database
        $this->db->set('last_access',date('Y-m-d h:i:sa'))->where('manufacturer_id',$this->session->userdata('manufacturer_user_id'))->update('manufacturer');
                
    }

    /** 
    * @function name 	: changePassword()
    * @description   	: Change manufacturer password
    * @access 		    : public
    * @param   		    : void
    * @return        	: boolean  
    */
    public function changePassword()	
    {
        $this->db->from('manufacturer');
        $this->db->where("manufacturer_id",$this->session->userdata('manufacturer_user_id'));
        $this->db->where('password', md5($this->input->post('password')));
        $query=$this->db->get();
		
        if ($query->num_rows() == 0)  return false; // Email not found
		
            $this->db->set('password',md5($this->input->post('password')));
            $this->db->where("user_id",$this->session->userdata('manufacturer_user_id'));

            if($this->db->update('manufacturer'))	
            {	
                return TRUE;   
            }	
            else 	
            {	
                return FALSE;  
            }
    }
	 /** 
    * @function name    : verify_code()
    * @description      : check admin user forgor password verification code
    * @access       : public
    * @param        : void
    * @return           : array  
    */
    public function verify_code($manufacturer_id,$verify_code)
    {
        $this->db->from('manufacturer');
         $this->db->where('manufacturer_id',(int)$manufacturer_id);
        $this->db->where('activation_code',$verify_code);
        $query=$this->db->get();
        if ($query->num_rows() > 0)
        {   
            return TRUE;
        }
        else
        { 
            return FALSE;
        }
    }
   /** 
    * @function name    : resetPassword()
    * @description      : reset manufacture user password
    * @access       : public
    * @param        : void
    * @return           : array  
    */
    public function resetPassword()
    {
        $this->db->set('activation_code','');
        $this->db->set('password', md5($this->input->post('password')));
        $this->db->where('manufacturer_id',$this->input->post('manufacturer_id',true));
        $result = $this->db->update('manufacturer');
        
        return $result;
    }
        
    /** 
    * @function name 	: checkActivationCode()
    * @description   	: check activation code    
    * @access 		    : public
    * @param            : string $manufacturer_id The manufacture id is activation code
    * @param   		    : string $code The code is activation code
    * @return        	: boolean  
    */
    public function checkActivationCode($manufacturer_id,$code)
    {
        $this->db->where('activation_code',$code);
        $this->db->where('manufacturer_id',(int)$manufacturer_id);
        $query = $this->db->get('manufacturer');	
        if ($query->num_rows() > 0)
        { 
        	 $this->db->set('activation_code', '');
             $this->db->set('status', 2);
            $this->db->where('manufacturer_id',$manufacturer_id);
            $this->db->update('manufacturer');
            return TRUE;
        }
        else
        { 
            return FALSE;
        }
    }
	
    /** 
    * @function name 	: LogOut()
    * @description   	: Make Session clear    
    * @access 		    : public
    * @param   		    : void
    * @return        	: void  
    */
    public function LogOut()
    {
        $this->session->set_userdata(array(
            
            'manufacturer_user_id'        => NULL,
            'manufacturer_name'           => NULL,
            'manufacturer_role_id'        => NULL,
            'manufacturer_image'          => NULL,
            'manufacturer_email'          => NULL,
            'manufacturer_token'          => NULL,
            'manufacturer_status'         => FALSE, 
            'manufacturer_login_status'   => FALSE,            
        )); 
        // unset($_SESSION['token']);
    }
        
    /** 
    * @function name 	: forgotPassword()
    * @description   	: send password reset link or code on mail    
    * @access 		    : public
    * @param   		    : void
    * @return        	: void  
    */
    public function forgotPassword() {

        $this->db->from('manufacturer');
        $this->db->where('email',$this->input->post('email'));
        $this->db->where('role_id = 6');
        $query=$this->db->get();
        if($query->num_rows()>0) {
            $res = $query->row_array();
            $RandNo = $this->commons->generate_randomnumber(4);
            $acc_code = $RandNo.$res['manufacturer_id'];
                
            $this->db->set('activation_code', $acc_code);
            $this->db->where('manufacturer_id',$res['manufacturer_id']);
            $this->db->update('manufacturer');
           
           //=== Send Email ====
                $Template = $this->mailer->Tpl_Email('forgot_password',$this->commons->encode($this->input->post('email')));
                    $Recipient = $res['email'];
                    $Filter = array(
                        '{{NAME}}' =>$res['firstname'].' '.$res['lastname'],
                        '{{RESET_CODE}}' =>$acc_code,
                        '{{RESET_LINK}}' =>base_url('common/reset_password/index/'.$res['manufacturer_id'].'/'.$this->commons->encode($acc_code))
                    );
                $this->mailer->Send_Singal_Html_Email($Recipient,$Template,$Filter);
            //===================
            return TRUE; 
        } else {
            return FALSE;
        }
            
    }

    /** 
    * @function name    : register()
    * @description      : register manufacturer    
    * @access           : public
    * @param            : void
    * @return           : void  
    */
    public function register() 
    {
        $activation_code = $this->commons->generate_randomnumber(6);
        $this->db->set('role_id',6);
        $this->db->set('firstname',$this->input->post('firstname'));
        $this->db->set('lastname',$this->input->post('lastname'));
        $this->db->set('email',$this->input->post('email'));
        $this->db->set('activation_code',$activation_code);
        $this->db->set('password', md5($this->input->post('password')));
        $this->db->set('date_added',date('Y-m-d H:i:s'));
        $this->db->set('status',0);
        $this->db->insert('manufacturer');
       $manufacturer_id = $this->db->insert_id();
       if($manufacturer_id > 0)
       {
            $name = $this->input->post('firstname')." ".$this->input->post('lastname');
            $email = $this->input->post('email');
            $activation_link = base_url('common/register/active_manufacturer/').$this->commons->encode($manufacturer_id).'/'.$this->commons->encode($activation_code);
            //=== Send Email ====
            $Template = $this->mailer->Tpl_Email('manufacturer_signup',$this->commons->encode($email));
                $Recipient = $email;
                $Filter = array(
                    '{{NAME}}' =>$name,
                    '{{ACTIVATION_LINK}}' => $activation_link,
                );
            $this->mailer->Send_Singal_Html_Email($Recipient,$Template,$Filter);
            //===================
        } 
         return $manufacturer_id;
    }
     /** 
    * @function name    : edit()
    * @description      : edit manufacturer    
    * @access           : public
    * @param            : void
    * @return           : void  
    */
    public function editManufacturer() 
    {
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

        $this->db->set('firstname',$this->input->post('firstname'));
        $this->db->set('middlename',$this->input->post('middlename'));
        $this->db->set('lastname',$this->input->post('lastname'));
        $this->db->set('email',$this->input->post('email'));
        $this->db->set('mobile',$this->input->post('mobile'));
        $this->db->set('gender',$this->input->post('gender'));
        if($this->input->post('dob') !=="")
        {
            $this->db->set('dob',date('Y-m-d', strtotime($this->input->post('dob'))));
        }
        
        $this->db->set('company_name',$this->input->post('company_name'));
        $this->db->set('company_address',$this->input->post('company_address'));
        $this->db->set('telephone',$this->input->post('telephone'));
        $this->db->set('company_logo',$company_logo);

        $this->db->set('bank_name',$this->input->post('bank_name'));
        $this->db->set('bank_address',$this->input->post('bank_address'));
        $this->db->set('bank_ifsc_code',$this->input->post('bank_ifsc_code'));
        $this->db->set('account_no',$this->input->post('account_no'));
        $this->db->set('account_name',$this->input->post('account_name'));

        $this->db->set('gst',$gst);
        $this->db->set('cst',$cst);
        $this->db->set('upload_pancard',$upload_pancard);
        $this->db->set('upload_bank_doc',$upload_bank_doc);

        $this->db->set('select_plan',$this->input->post('select_plan'));
        
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by',$this->session->userdata('manufacturer_user_id'));
        
        $this->db->where('manufacturer_id',(int)$this->input->post('manufacturer_id'));
        $res= $this->db->update('manufacturer');            

        if($res)
        {
           //address details                    
            $this->db->query("delete from manufacturer_address where manufacturer_id='".(int)$this->input->post('manufacturer_id')."'");
            $this->db->set('address_1',$this->input->post('address'));            
            $this->db->set('city',$this->input->post('city'));
            $this->db->set('postcode',$this->input->post('postcode'));
            $this->db->set('country_id',(int)$this->input->post('country'));
            $this->db->set('state_id',(int)$this->input->post('state'));            
            $this->db->set('manufacturer_id',(int)$this->input->post('manufacturer_id'));
            $this->db->insert('manufacturer_address');  
                
        }
        return $res;

    }	 
    
}
