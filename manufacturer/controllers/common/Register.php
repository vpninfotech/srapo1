<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Register
* @Auther       : Indrajit
* @Date         : 30-12-2016
* @Description  : Manufacturer Register Operation
*
*/

class Register extends CI_Controller   {

    private $data=array();

    function __construct() {
		
        parent::__construct();
        
        $this->_init();

        $this->lang->load('common/login_lang', 'english');

        $this->load->model('common/login_model','login');

        $this->load->model('catalog/Manufacturer_model','Manufacturer_model');		

        //get country list
        $this->load->model('system/country_model','country');

        //get zone(state) list
        $this->load->model('system/zone_model','zone'); 
    }
	
    /**
    * 
    * @function name : _init()
    * @description   : initialize required resources in this view
    * @param   	     : void
    * @return        : void
    *
    */
    private function _init() 
    {
       
    }
	
    /**
    * 
    * @function name : index()
    * @description   : load login view
    * @param   	     : void
    * @return        : void
    *
    */
    public function index($Back_To='')	
    {


        $admin_theme = $this->common->config('admin_theme');
        $this->data['admin_theme'] = $admin_theme;
        $content_page="themes/".$admin_theme."/common/register";
        $this->load->view($content_page,$this->data);
		 
    }
    /**
    * 
    * @function name : verify()
    * @description   : After register verification and Add more details
    * @param         : void
    * @return        : void
    *
    */
    public function verify()  
    {
        $manufacturer_info = $this->Manufacturer_model->getManufacturerById($this->session->userdata('manufacturer_user_id'));
        $manufacturer_address_info = $this->Manufacturer_model->getManufacturerAddressById($this->session->userdata('manufacturer_user_id'));
        if($manufacturer_info)
        {
            $this->data['manufacturer_id'] = $manufacturer_info['manufacturer_id'];
            $this->data['firstname'] = $manufacturer_info['firstname'];
            $this->data['lastname'] = $manufacturer_info['lastname'];
            $this->data['middlename'] = $manufacturer_info['middlename'];
            $this->data['email'] = $manufacturer_info['email'];
            $this->data['telephone'] = $manufacturer_info['telephone'];
            $this->data['mobile'] = $manufacturer_info['mobile'];
            $this->data['gender'] = $manufacturer_info['gender'];
            if($manufacturer_info['dob'] !== '0000-00-00')
            {
                $this->data['dob'] = date('m/d/Y',strtotime($manufacturer_info['dob']));
            }
            else
            {
                $this->data['dob'] = '';
            }
            if($manufacturer_address_info)
            {
                $this->data['address'] = $manufacturer_address_info['address_1'];
            $this->data['city'] = $manufacturer_address_info['city'];
            $this->data['postcode'] = $manufacturer_address_info['postcode'];
            $this->data['country_id'] = $manufacturer_address_info['country_id'];
            $this->data['state_id'] = $manufacturer_address_info['state_id']; 
            }
            else
            {
                $this->data['address'] = '';
                $this->data['city'] = '';
                $this->data['postcode'] = '';
                $this->data['country_id'] = '';
                $this->data['state_id'] = '';
            }
           

            $this->data['bank_name'] = $manufacturer_info['bank_name'];
            $this->data['bank_address'] = $manufacturer_info['bank_address'];
            $this->data['bank_ifsc_code'] = $manufacturer_info['bank_ifsc_code'];
            $this->data['account_no'] = $manufacturer_info['account_no'];
            $this->data['account_name'] = $manufacturer_info['account_name'];
            $this->data['bank_document'] = $manufacturer_info['bank_document'];
            $this->data['membership_fee'] = $manufacturer_info['membership_fee'];
            $this->data['wallet_balance'] = $manufacturer_info['wallet_balance'];
            $this->data['upload_pancard'] = $manufacturer_info['upload_pancard'];
            $this->data['upload_bank_doc'] = $manufacturer_info['upload_bank_doc'];
            $this->data['upload_register_no'] = $manufacturer_info['upload_register_no'];
            $this->data['company_name'] = $manufacturer_info['company_name'];
            $this->data['company_address'] = $manufacturer_info['company_address'];
            $this->data['company_logo'] = $manufacturer_info['company_logo'];
            $this->data['cst'] = $manufacturer_info['cst'];
            $this->data['gst'] = $manufacturer_info['gst'];
            $this->data['select_plan'] = $manufacturer_info['select_plan'];


        }
        else
        {
            redirect('common/login');
        }
        
        if ($this->session->flashdata('error') !== NULL) 
        {
            $this->data['error'] = $this->session->flashdata('error');
        } else {
            $this->data['error'] = '';
        }

        if ($this->session->flashdata('success')!==NULL) {
            $this->data['success'] = $this->session->flashdata('success');

        } 
        else 
        {
            $this->data['success'] = '';
        }

        //get country list
        $this->data['countries'] = $this->country->getCountries();
        
        $admin_theme = $this->common->config('admin_theme');
        $this->data['admin_theme'] = $admin_theme;
        $content_page="themes/".$admin_theme."/common/verify";
        $this->load->view($content_page,$this->data);
         
    }
    /**
    * 
    * @function name : add()
    * @description   : load login view
    * @param         : void
    * @return        : void
    *
    */
    public function add()  
    {


        if (($this->input->server('REQUEST_METHOD') == 'POST'))
        {
            $res = $this->login->register();
            if($res)
            {
                $this->data['success']='Thank you for Registering with Srapo, please verify your email address by clicking on the link we sent you.';
            }
            else
            {
                $this->data['error']='Something went wrong!';
            }
        }

        $this->index();
         
    }
     /**
    * 
    * @function name : add()
    * @description   : load login view
    * @param         : void
    * @return        : void
    *
    */
    public function edit()  
    {


        if (($this->input->server('REQUEST_METHOD') == 'POST'))
        {
            $res = $this->login->editManufacturer();
            if($res)
            {
                $this->session->set_flashdata('success','Update records successfully.');
            }
            else
            {
                $this->session->set_flashdata('error','Something went Wrong !');
            }
        }

       redirect('common/register/verify');
         
    }
     /**
    * 
    * @function name : check_exits_email()
    * @description   : check given email adresss exists or not
    * @param         : $email for check exists email
    * @return        : void
    *
    */
    public function check_exits_email()  
    {
        if (($this->input->server('REQUEST_METHOD') == 'POST'))
        {
            $this->db->from('manufacturer');
            $this->db->where('email',$this->input->post('email',true));
             $query=$this->db->get();
            if($query->num_rows()>0) 
            {
               echo json_encode(FALSE);
           }
            else
            {
                echo json_encode(TRUE);   
            } 
             
         }     
        else
        {
               echo json_encode(FALSE);
        }
    }

     /**
    * 
    * @function name : active_manufacturer()
    * @description   : check manufacturer activation link
    * @param         : $manufacturer_id for activation link check
    * @param         : $activation_code for activation link validate activation code
    * @return        : void
    *
    */
    public function active_manufacturer($manufacturer_id = '',$activation_code = '')  
    {
        if($manufacturer_id !== "" && $activation_code !== "")
        {
            $res = $this->login->checkActivationCode($this->commons->decode($manufacturer_id),$this->commons->decode($activation_code));
            if($res)
            {
                $this->session->set_flashdata('success','Your Account have been activated successfully');
                redirect('common/login');
            }
            else
            {
                $this->data['error'] = "Activation link is either invalid or expired.";
            }
        }
        else
        {
            $this->data['error'] = "Activation link is either invalid or expired.";  
        }
        $this->index();
        
    }
     /**
    * 
    * @function name    : get_zone_by_country_id()
    * @description      : get zone list by country Id 
    * @access           : public
    * @param            : void
    * @return           : json
    *
    */
    public function get_zone_by_country_id() {
        $this->output->unset_template();
        $json = array();
        
        $country_info = $this->country->getCountry($this->input->post('country_id'));
        
        if($country_info) {
            $this->load->model('system/zone_model');
            
            $json = array(
                'country_id'        => $country_info['country_id'],
                'country_name'      => $country_info['country_name'],
                'iso_code_2'        => $country_info['iso_code_2'],
                'iso_code'          => $country_info['iso_code'],
                'zone'              => $this->zone->getZoneByCountryId($this->input->post('country_id')),
                'status'            => $country_info['status']  
            );
        }
        
        $sort_order = array();

        echo json_encode($json);
    }

	
}
