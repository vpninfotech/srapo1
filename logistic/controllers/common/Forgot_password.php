 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
* @file name    : Forgot_password
* @Auther       : Vinay
* @Date         : 29-12-2016
* @Description  : Logistic Forgot Password Operation
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
		
		//--Set Template
		$this->output->set_template('common/login_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Logistic Forgot Password','sarpo','This is srapo Logistic Forgot Password page');

		$this->load->css(ADMIN_PATH.$admin_theme.'/plugins/bootstrap/css/bootstrap.min.css');
		$this->load->css(ADMIN_PATH.$admin_theme.'/fonts/ionicons/css/ionicons.min.css');
		$this->load->css(ADMIN_PATH.$admin_theme.'/plugins/iCheck/all.css');
		$this->load->css(ADMIN_PATH.$admin_theme.'/css/AdminLTE.css');
		$this->load->css(ADMIN_PATH.$admin_theme.'/plugins/iCheck/square/blue.png');
		$this->load->css(ADMIN_PATH.$admin_theme.'/css/custom.css');
		
		$this->load->js(ADMIN_PATH.$admin_theme.'/plugins/jQuery/jquery-2.2.3.min.js');
		$this->load->js(ADMIN_PATH.$admin_theme.'/plugins/bootstrap/js/bootstrap.min.js');
		$this->load->js(ADMIN_PATH.$admin_theme.'/plugins/backstretch/jquery.backstretch.min.js');
	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Forgot Password view
	* @param   	 : void
	* @return        : void
	*
	*/
	public function index()	{

		$this->data['form_action']   =  base_url('common/forgot_password');
		$this->data['login_link']    =  base_url('common/login');
                
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validate())
		{
                        $check_email = $this->login->forgotPassword();
                        if($check_email == 1) {
                            $this->data['success']="Success:  An email with a confirmation link has been sent your admin email address!";
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
	
	