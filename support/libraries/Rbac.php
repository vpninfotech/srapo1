<?php
class RBAC 
{	
	function __construct()
	{
		$this->obj =& get_instance();
	}

	//-------------------------------------------------------------
	function CheckAuthentication()
	{

		if(!$this->obj->session->userdata('support_login_status'))
		{
			$Back_To =str_replace("srapo_CI/support/","",$_SERVER['REQUEST_URI']);
			$Back_To = $this->obj->commons->encode($Back_To);
			redirect('common/login/index/'.$Back_To);
		}
		
	}
}
?>