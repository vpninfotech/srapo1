<?php
require_once APPPATH."third_party/Sendgrid/autoload.php";
class Mailer 
{
	function Mailer()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('Common','Common');
		//$this->CI->load->model('system/settings_model','email_config');
                //$this->CI->load->library('email');
	}
	
	//=============================================================
	function Send_Singal_Html_Email($Recipient,$Template,$Filter)
	{
		// If email send is enabled from admin panel
		if($this->CI->Common->config('config_email')) 
		{
			foreach($Filter as $k=>$v)
			{
				$Template['Message'] = str_replace($k,$v,$Template['Message']);
			}
			if(strtoupper($this->CI->Common->config('config_mail_protocol')) === 'SMTP')
			{
				// The mail sending protocol.
				$config['protocol'] = 'smtp';
				// SMTP Server Address for Gmail.
				$config['smtp_host'] = $this->CI->Common->config('config_mail_smtp_hostname');
				// SMTP Port - the port that you is required
				$config['smtp_port'] = $this->CI->Common->config('config_mail_smtp_port');
				// SMTP Username like. (abc@gmail.com)
				$config['smtp_user'] = $this->CI->Common->config('config_mail_smtp_username');
				// SMTP Password like (abc***##)
				$config['smtp_pass'] = $this->CI->Common->config('config_mail_smtp_password');
				// SMTP Timeout like (5) time in seconds
				$config['smtp_timeout'] = $this->CI->Common->config('config_mail_smtp_timeout');
  				$config['charset'] = 'iso-8859-1';
				$config['mailtype'] = 'html';
                $this->CI->email->initialize($config);
            }
            $this->CI->email->from($this->CI->Common->config('config_email'), $this->CI->Common->config('config_store_name'));
            $this->CI->email->to($Recipient);
            $this->CI->email->subject($Template['Subject']);
            $this->CI->email->message($Template['Message']);
            $this->CI->email->set_mailtype('html');           
            if($this->CI->email->send())
			{	
                return $Template['Message'];
			}
			else
			{	
				return 'Email Counld not Sent.';
			}
		}
		else
		{
			return 'Email functionality is currently disabled by admin.';
		}
	}
	//=============================================================
	function Send_contact_mail($Recipient,$subject,$message)
	{
		// If email send is enabled from admin panel
		if($this->CI->Common->config('config_email')) 
		{
			if(strtoupper($this->CI->Common->config('config_mail_protocol')) === 'SMTP')
			{
				// The mail sending protocol.
				$config['protocol'] = 'smtp';
				// SMTP Server Address for Gmail.
				$config['smtp_host'] = $this->CI->Common->config('config_mail_smtp_hostname');
				// SMTP Port - the port that you is required
				$config['smtp_port'] = $this->CI->Common->config('config_mail_smtp_port');
				// SMTP Username like. (abc@gmail.com)
				$config['smtp_user'] = $this->CI->Common->config('config_mail_smtp_username');
				// SMTP Password like (abc***##)
				$config['smtp_pass'] = $this->CI->Common->config('config_mail_smtp_password');
				// SMTP Timeout like (5) time in seconds
				$config['smtp_timeout'] = $this->CI->Common->config('config_mail_smtp_timeout');
  				$config['charset'] = 'iso-8859-1';
				$config['mailtype'] = 'html';
                $this->CI->email->initialize($config);
            }
            $this->CI->email->from($this->CI->Common->config('config_email'), $this->CI->Common->config('config_store_name'));
            $this->CI->email->to($Recipient);
            $this->CI->email->subject($subject);
            $this->CI->email->message($message);
            $this->CI->email->set_mailtype('html');           
            if($this->CI->email->send())
			{	
                return 'Mail sent sucessfully!';
			}
			else
			{	
				return 'Email Counld not Sent.';
			}
		}
		else
		{
			return 'Email functionality is currently disabled by admin.';
		}
	}
	function Tpl_Email($TemplateCode,$email='')
	{
		$data = array();
                
		$filename = THEME_PATH.'/email_tpl/template.html';
		$tpl = file_get_contents($filename, true);
                
                $Facebook = ADMIN_PATH.'default/images/facebook.png' ;
                $Twitter = ADMIN_PATH.'default/images/twitter.png' ;
                $Googleplus = ADMIN_PATH.'default/images/googleplus.png' ;
                $Pineterst = ADMIN_PATH.'default/images/pineterst.png' ;
                $Instagram = ADMIN_PATH.'default/images/instagram.png' ;
                
		$EMAIL_TPL = $this->CI->common->GetByKey('template_code',$TemplateCode);
                $Social = '<tr>
                    <td align="center" bgcolor="#ff2341" style="font-family: Arial,Helvetica,sans-serif; font-size: 14px; font-weight: bold; color: #ffffff; padding: 15px 10px 5px 10px">
                        Connect with us
                    </td>
                </tr>
                <tr>
                    <td align="center" height="60" bgcolor="#ff2341">';
                if($this->CI->Common->config('config_facebook_link')!=="")
                {
                    $Social.= ' <a href="'.$this->CI->Common->config('config_facebook_link').'" target="_blank" rel="noreferrer" style="text-decoration:none">
                            <img src="'.$Facebook.'" alt="Facebook" width="49" height="49" border="0" hspace="0" vspace="0" />
                        </a>';
                }
                if($this->CI->Common->config('config_twitter_link')!=="")
                {
                    $Social.= ' <a href="'.$this->CI->Common->config('config_twitter_link').'" target="_blank" rel="noreferrer" style="text-decoration:none">
                            <img src="'.$Twitter.'" alt="Twitter" width="49" height="49" border="0" hspace="0" vspace="0" />
                        </a>';
                }
                if($this->CI->Common->config('config_googleplus_link')!=="")
                {
                    $Social.= ' <a href="'.$this->CI->Common->config('config_googleplus_link').'" target="_blank" rel="noreferrer" style="text-decoration:none">
                            <img src="'.$Googleplus.'" alt="GooglePlus" width="49" height="49" border="0" hspace="0" vspace="0" />
                        </a>';
                }
                if($this->CI->Common->config('config_pinterest_link')!=="")
                {
                    $Social.= ' <a href="'.$this->CI->Common->config('config_pinterest_link').'" target="_blank" rel="noreferrer" style="text-decoration:none">
                            <img src="'.$Pineterst.'" alt="Pinterest" width="49" height="49" border="0" hspace="0" vspace="0" />
                        </a>';
                }
                if($this->CI->Common->config('config_instagram_link')!=="")
                {
                    $Social.= ' <a href="'.$this->CI->Common->config('config_instagram_link').'" target="_blank" rel="noreferrer" style="text-decoration:none">
                            <img src="'.$Instagram.'" alt="Instagram" width="49" height="49" border="0" hspace="0" vspace="0" />
                        </a>';
                }
                $Social.=' </td>
               </tr>';
                $tpl = str_replace("@Social@",$Social,$tpl);
                
                 if($email!='')
                 {
		     $tpl = str_replace("@unsubscribe@",HTTP_CATALOG.('account/login/unsubscribe').'/'.$email,$tpl);
                 }
                 else
                 {
                    $tpl = str_replace("@unsubscribe@","#",$tpl);
                  }
                //$tpl = str_replace("@Unsubscribe@",$Recipient,$tpl);
                //$tpl = str_replace("@Twitter@",$Twitter,$tpl);
                //$tpl = str_replace("@Googleplus@",$Googleplus,$tpl);
                //$tpl = str_replace("@Pineterst@",$Pineterst,$tpl);
                //$tpl = str_replace("@Instagram@",$Instagram,$tpl);
                
                $tpl = str_replace("@home@",HTTP_CATALOG,$tpl);
		
		$tpl = str_replace("@baseurl@",base_url(),$tpl);
		$tpl = str_replace("@Logo@",HTTP_CATALOG.'image/'.$this->CI->Common->config('config_logo'),$tpl);
		//$tpl = str_replace("@facebooklink@",$this->CI->Common->config('facebooklink'),$tpl);
		//$tpl = str_replace("@googlelink@",$this->CI->Common->config('googlelink'),$tpl);
		//$tpl = str_replace("@twitterlink@",$this->CI->Common->config('twitterlink'),$tpl);
		//$tpl = str_replace("@youtubelink@",$this->CI->Common->config('youtubelink'),$tpl);
		//$tpl = str_replace("@copyright_text@",$this->CI->Common->config('copyright_text'),$tpl);
		$tpl = str_replace("@MessageBody@",$EMAIL_TPL[0]['content'],$tpl);
		
		$data['Subject'] =$EMAIL_TPL[0]['subject'];
		$data['Message'] = $tpl;
                //print_r($data);exit;
		return $data;	
	}
}
?>