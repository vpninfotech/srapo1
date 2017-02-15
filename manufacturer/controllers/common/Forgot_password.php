 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
* @file name    : Forgot_password
* @Auther       : RITESH
* @Date         : 05-12-2016
* @Description  : manufacturer Forgot Password Operation
*
*/
class Forgot_password extends CI_Controller {

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
    * @param   	 : void
    * @return        : void
    *
    */
	
    private function _init() {
		
       
    }
	
    /**
    * 
    * @function name : index()
    * @description   : load Forgot Password view
    * @param   	 : void
    * @return        : void
    *
    */
    public function index()	
    {
        if(($this->input->server('REQUEST_METHOD') == 'POST'))
        {
            $check_email = $this->login->forgotPassword();
            if($check_email == 1) {
                $this->data['success']="Success:  An email with a confirmation link has been sent your Register email address!";
            } else {
                $this->data['error']="Warning: The E-Mail Address was not found in our records, please try again!";
            }
        }
                
        if (($this->input->post('email')) !== NULL) {
                $this->data['email'] = $this->input->post('email');
        } else {
                $this->data['email'] = '';
        }
                
        $admin_theme = $this->common->config('admin_theme');
        $content_page="themes/".$admin_theme."/common/forgot_password";
        $this->load->view($content_page,$this->data);
    }
	
    /**
    * 
    * @function name 	: validate()
    * @description   	: Validate form data
    * @access 		: public
    * @param   		: void
    * @return        	: boolean
    *
    */
    public function validate() {
        $validation = array(
                        array(
                            'field' => 'email',
                            'label' => 'Email', 
                            'rules' => 'trim|required|valid_email|xss_clean', 
                            'errors' => array('required' => 'Please Provide %s.','valid_email'=>'Please Provide Valid %s')
                        ),
                    );
                    $this->form_validation->set_rules($validation);
                    if ($this->form_validation->run() == FALSE){
                        return FALSE;
                    } else {
                        return TRUE;
                        //$this->data['error'] = 'Warning: The E-Mail Address was not found in our records, please try again!';
                    }
    }
	
}
	
	