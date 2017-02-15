 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
* @file name    : Reset_password
* @Auther       : RITESH
* @Date         : 05-12-2016
* @Description  : manufacturer Reset Password Operation
*
*/
class Reset_password extends CI_Controller {

    private $data=array();

    function __construct()
    {
        parent::__construct();

        $this->_init();
           
        $this->load->model('common/login_model','login');
    }
	
    /**
    * 
    * @function name : _init()
    * @description   : initialize required resources in this view
    * @param   	     : void
    * @return        : void
    *
    */
	
    private function _init() {
		
        
    }
	
    /**
    * 
    * @function name : index()
    * @description   : load login view
    * @param         : void
    * @return        : void
    *
    */
   public function index($user_id = "",$verify_code = "")   {

        $this->data['form_action']     = base_url('common/reset_password');

        if(($this->input->server('REQUEST_METHOD') == 'POST'))
        {
            if($this->input->post('user_id') !== "")
            {
                $result = $this->login->resetPassword();
                if($result)
                {
                   $this->session->set_flashdata('success','Your Password reset successfully!');
                    redirect('common/login');
                }
                else
                {
                    $this->data['error']="Warning: You do not have permission to reset password!";
                }   
            }
            else
            {
                $this->data['error']="Warning: You do not have permission to reset password!";
            }
            
        }
        if($verify_code != "")
        {
             $check_code = $this->login->verify_code($user_id,$this->commons->decode($verify_code));
             if($check_code)
             {
                  $this->data['success']="Success: The activation link verified successfully!";
             }
             else
             {
                 $this->session->set_flashdata('error','Warning: Activation link is either invalid or expired.');
                 redirect('common/login');
             }
        }
         
        if (($this->input->post('user_id')) !== NULL) {
            $this->data['user_id'] = $this->input->post('user_id');
        } else {
            $this->data['user_id'] = $user_id;
        }
        $admin_theme = $this->common->config('admin_theme');
        $content_page="themes/".$admin_theme."/common/reset_password";
        $this->load->view($content_page,$this->data);
    }
}
