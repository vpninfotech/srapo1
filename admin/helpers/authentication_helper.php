<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


   function varify_session($token='')
   {
       //get main CodeIgniter object
       $CI =& get_instance();
       $user_session_token = $CI->session->userdata('token');
       if($token !== $user_session_token) 
	   {
           redirect('common/login');
       }
   }
   
   function varify_user()
   {
	    $CI =& get_instance();
		if(!$CI->session->userdata('login_status'))
		{
			$Back_To =$_SERVER['HTTP_REFERER'];
			$Back_To = $this->obj->functions->encode($Back_To);
			redirect('common/login/'.$Back_To);
		}
   }