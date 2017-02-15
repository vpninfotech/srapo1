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
		if(!$this->obj->session->userdata('Dlogin_status'))
		{
			$Back_To =str_replace("/srapo_CI/dataoperator/","",$_SERVER['REQUEST_URI']);
			$Back_To = $this->obj->commons->encode($Back_To);
			redirect('common/login/index/'.$Back_To);
		}
		
	}
}
?>