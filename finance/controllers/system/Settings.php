<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Settings
* @Auther       : Indrajit
* @Date         : 20-10-2016
* @Description  : Admin Settings Operation
*
*/

class Settings extends CI_Controller {

private $data=array();

	function __construct() {
		parent::__construct();
                
		$this->_init();
        
               $this->rbac->CheckAuthentication();

                // Load settings_model
                $this->load->model('system/settings_model','settings');

                 // Load country_model
                $this->load->model('system/country_model','country');
       
                // Load zone_model
                $this->load->model('system/zone_model','zone');

                // Load currency_model
                $this->load->model('system/currency_model','currency');

                // Load order_status_model
                $this->load->model('system/order_status_model','order_status');

                // Load Return_status_model
                $this->load->model('system/Return_status_model','Return_status');
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
            $this->output->set_template('admin_template');
            $admin_theme = $this->common->config('admin_theme');
            $this->output->set_common_meta('Settings','sarpo','This is srapo Settings page');
	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Setting view
	* @param   	 : void
	* @return        : void
	*
	*/
	public function index()	{
            $this->data['form_action']   = base_url('system/settings');
            $this->data['breadcrumbs']   = array();
            $this->data['breadcrumbs'][] = array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),

            );
            $this->data['breadcrumbs'][] = array(
               'text' => 'Settings',
               'href' => base_url('system/settings'),

            );
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validate()) 
            {
                $this->settings->save();
                $this->data['success']="Success: You have modified Settings!";
            }
            if  (($this->input->post('config_meta_title')) !== NULL) {
                $this->data['config_meta_title'] = $this->input->post('config_meta_title');
            } else {
                $this->data['config_meta_title'] = ($this->common->config('config_meta_title'));
            }
            
            if  (($this->input->post('config_meta_description')) !== NULL) {
                $this->data['config_meta_description'] = $this->input->post('config_meta_description');
            } else {
                $this->data['config_meta_description'] = $this->common->config('config_meta_description');
            }
            
            if  (($this->input->post('config_meta_keyword')) !== NULL) {
                $this->data['config_meta_keyword'] = $this->input->post('config_meta_keyword');
            } else {
                $this->data['config_meta_keyword'] = $this->common->config('config_meta_keyword');
            }
            
            //====Code Start: Get all themes directory 
            $this->data['templates'] = array();
            
            $directories = glob(THEME_PATH.'/admin/themes/*' , GLOB_ONLYDIR);

            foreach ($directories as $directory) {
		 $this->data['templates'][] = basename($directory);
            }
            //====Code End: Get all themes directory
            
            if  (($this->input->post('config_template')) !== NULL) {
                $this->data['config_template'] = $this->input->post('config_template');
            } else {
                $this->data['config_template'] = $this->common->config('config_template');
            }
            
            if  (($this->input->post('config_store_name')) !== NULL) {
                $this->data['config_store_name'] = $this->input->post('config_store_name');
            } else {
                $this->data['config_store_name'] = $this->common->config('config_store_name');
            }
            
            if  (($this->input->post('config_store_owner')) !== NULL) {
                $this->data['config_store_owner'] = $this->input->post('config_store_owner');
            } else {
                $this->data['config_store_owner'] = $this->common->config('config_store_owner');
            }
            
            if  (($this->input->post('config_address')) !== NULL) {
                $this->data['config_address'] = $this->input->post('config_address');
            } else {
                $this->data['config_address'] = $this->common->config('config_address');
            }
            
            if  (($this->input->post('config_geocode')) !== NULL) {
                $this->data['config_geocode'] = $this->input->post('config_geocode');
            } else {
                $this->data['config_geocode'] = $this->common->config('config_geocode');
            }
            
            if  (($this->input->post('config_email')) !== NULL) {
                $this->data['config_email'] = $this->input->post('config_email');
            } else {
                $this->data['config_email'] = $this->common->config('config_email');
            }
            
            if  (($this->input->post('config_telephone')) !== NULL) {
                $this->data['config_telephone'] = $this->input->post('config_telephone');
            } else {
                $this->data['config_telephone'] = $this->common->config('config_telephone');
            }
            
            if  (($this->input->post('config_fax')) !== NULL) {
                $this->data['config_fax'] = $this->input->post('config_fax');
            } else {
                $this->data['config_fax'] = $this->common->config('config_fax');
            }
            
            if  (($this->input->post('config_image')) !== NULL) {
                $this->data['config_image'] = $this->input->post('config_image');
            } else {
                $this->data['config_image'] = $this->common->config('config_image');
            }
            
            //====Start Code: Call image model for resize the image
            $this->load->model('tool/image');
            
            if (($this->input->post('config_image') !== NULL) && is_file(DIR_IMAGE . $this->input->post('config_image'))) {
                  $this->data['thumb'] = $this->image->resize($this->input->post('config_image'), 100, 100);
            } elseif ($this->common->config('config_image') && is_file(DIR_IMAGE . $this->common->config('config_image'))) {
                  $this->data['thumb'] = $this->image->resize($this->common->config('config_image'), 100, 100);
            } else {
                  $this->data['thumb'] = $this->image->resize('no_image-100x100.png', 100, 100);
            }

            $this->data['placeholder'] = $this->image->resize('no_image-100x100.png', 100, 100);
            //====End Code: Call image model for resize the image
            
            if  (($this->input->post('config_opening_time')) !== NULL) {
                $this->data['config_opening_time'] = $this->input->post('config_opening_time');
            } else {
                $this->data['config_opening_time'] = $this->common->config('config_opening_time');
            }
            
            if  (($this->input->post('config_comment')) !== NULL) {
                $this->data['config_comment'] = $this->input->post('config_comment');
            } else {
                $this->data['config_comment'] = $this->common->config('config_comment');
            }
            
            if  (($this->input->post('config_country_id')) !== NULL) {
                $this->data['config_country_id'] = $this->input->post('config_country_id');
            } else {
                $this->data['config_country_id'] = $this->common->config('config_country_id');
            }
            
            if  (($this->input->post('config_zone_id')) !== NULL) {
                $this->data['config_zone_id'] = $this->input->post('config_zone_id');
            } else {
                $this->data['config_zone_id'] = $this->common->config('config_zone_id');
            }
            
            if  (($this->input->post('config_language')) !== NULL) {
                $this->data['config_language'] = $this->input->post('config_language');
            } else {
                $this->data['config_language'] = $this->common->config('config_language');
            }
            
            if  (($this->input->post('config_admin_language')) !== NULL) {
                $this->data['config_admin_language'] = $this->input->post('config_admin_language');
            } else {
                $this->data['config_admin_language'] = $this->common->config('config_admin_language');
            }
            
            if  (($this->input->post('config_currency')) !== NULL) {
                $this->data['config_currency'] = $this->input->post('config_currency');
            } else {
                $this->data['config_currency'] = $this->common->config('config_currency');
            }
            
            if  (($this->input->post('config_currency_auto')) !== NULL) {
                $this->data['config_currency_auto'] = $this->input->post('config_currency_auto');
            } else {
                $this->data['config_currency_auto'] = $this->common->config('config_currency_auto');
            }
            
            if  (($this->input->post('config_length_class_id')) !== NULL) {
                $this->data['config_length_class_id'] = $this->input->post('config_length_class_id');
            } else {
                $this->data['config_length_class_id'] = $this->common->config('config_length_class_id');
            }
            
            if  (($this->input->post('config_weight_class_id')) !== NULL) {
                $this->data['config_weight_class_id'] = $this->input->post('config_weight_class_id');
            } else {
                $this->data['config_weight_class_id'] = $this->common->config('config_weight_class_id');
            }
            
            if  (($this->input->post('config_date_format')) !== NULL) {
                $this->data['config_date_format'] = $this->input->post('config_date_format');
            } else {
                $this->data['config_date_format'] = $this->common->config('config_date_format');
            }
            
            if  (($this->input->post('config_time_format')) !== NULL) {
                $this->data['config_time_format'] = $this->input->post('config_time_format');
            } else {
                $this->data['config_time_format'] = $this->common->config('config_time_format');
            }
            
            if  (($this->input->post('config_product_count')) !== NULL) {
                $this->data['config_product_count'] = $this->input->post('config_product_count');
            } else {
                $this->data['config_product_count'] = $this->common->config('config_product_count');
            }
            
            if  (($this->input->post('config_product_limit')) !== NULL) {
                $this->data['config_product_limit'] = $this->input->post('config_product_limit');
            } else {
                $this->data['config_product_limit'] = $this->common->config('config_product_limit');
            }
            
            if  (($this->input->post('config_product_description_length')) !== NULL) {
                $this->data['config_product_description_length'] = $this->input->post('config_product_description_length');
            } else {
                $this->data['config_product_description_length'] = $this->common->config('config_product_description_length');
            }
            
            if  (($this->input->post('config_limit_admin')) !== NULL) {
                $this->data['config_limit_admin'] = $this->input->post('config_limit_admin');
            } else {
                $this->data['config_limit_admin'] = $this->common->config('config_limit_admin');
            }
            
            if  (($this->input->post('config_review_status')) !== NULL) {
                $this->data['config_review_status'] = $this->input->post('config_review_status');
            } else {
                $this->data['config_review_status'] = $this->common->config('config_review_status');
            }
            
            if  (($this->input->post('config_review_guest')) !== NULL) {
                $this->data['config_review_guest'] = $this->input->post('config_review_guest');
            } else {
                $this->data['config_review_guest'] = $this->common->config('config_review_guest');
            }
            
            if  (($this->input->post('config_review_mail')) !== NULL) {
                $this->data['config_review_mail'] = $this->input->post('config_review_mail');
            } else {
                $this->data['config_review_mail'] = $this->common->config('config_review_mail');
            }
            
            if  (($this->input->post('config_voucher_min')) !== NULL) {
                $this->data['config_voucher_min'] = $this->input->post('config_voucher_min');
            } else {
                $this->data['config_voucher_min'] = $this->common->config('config_voucher_min');
            }
            
            if  (($this->input->post('config_voucher_max')) !== NULL) {
                $this->data['config_voucher_max'] = $this->input->post('config_voucher_max');
            } else {
                $this->data['config_voucher_max'] = $this->common->config('config_voucher_max');
            }
            
            if  (($this->input->post('config_login_attempts')) !== NULL) {
                $this->data['config_login_attempts'] = $this->input->post('config_login_attempts');
            } else {
                $this->data['config_login_attempts'] = $this->common->config('config_login_attempts');
            }
            
            $this->load->model('catalog/information_model');
            $this->data['informations'] = $this->information_model->getInformations();

            if  (($this->input->post('config_account_id')) !== NULL) {
                $this->data['config_account_id'] = $this->input->post('config_account_id');
            } else {
                $this->data['config_account_id'] = $this->common->config('config_account_id');
            }
            
            if  (($this->input->post('config_account_mail')) !== NULL) {
                $this->data['config_account_mail'] = $this->input->post('config_account_mail');
            } else {
                $this->data['config_account_mail'] = $this->common->config('config_account_mail');
            }
            
            if  (($this->input->post('config_invoice_prefix')) !== NULL) {
                $this->data['config_invoice_prefix'] = $this->input->post('config_invoice_prefix');
            } else {
                $this->data['config_invoice_prefix'] = $this->common->config('config_invoice_prefix');
            }
            
            if  (($this->input->post('config_cart_weight')) !== NULL) {
                $this->data['config_cart_weight'] = $this->input->post('config_cart_weight');
            } else {
                $this->data['config_cart_weight'] = $this->common->config('config_cart_weight');
            }
            
            if  (($this->input->post('config_checkout_id')) !== NULL) {
                $this->data['config_checkout_id'] = $this->input->post('config_checkout_id');
            } else {
                $this->data['config_checkout_id'] = $this->common->config('config_checkout_id');
            }
            
            if  (($this->input->post('config_order_status_id')) !== NULL) {
                $this->data['config_order_status_id'] = $this->input->post('config_order_status_id');
            } else {
                $this->data['config_order_status_id'] = $this->common->config('config_order_status_id');
            }
            
            if  (($this->input->post('config_fraud_status_id')) !== NULL) {
                $this->data['config_fraud_status_id'] = $this->input->post('config_fraud_status_id');
            } else {
                $this->data['config_fraud_status_id'] = $this->common->config('config_fraud_status_id');
            }
            
            if  (($this->input->post('config_order_mail')) !== NULL) {
                $this->data['config_order_mail'] = $this->input->post('config_order_mail');
            } else {
                $this->data['config_order_mail'] = $this->common->config('config_order_mail');
            }
            
            if  (($this->input->post('config_stock_display')) !== NULL) {
                $this->data['config_stock_display'] = $this->input->post('config_stock_display');
            } else {
                $this->data['config_stock_display'] = $this->common->config('config_stock_display');
            }
            
            if  (($this->input->post('config_stock_warning')) !== NULL) {
                $this->data['config_stock_warning'] = $this->input->post('config_stock_warning');
            } else {
                $this->data['config_stock_warning'] = $this->common->config('config_stock_warning');
            }
            
            if  (($this->input->post('config_stock_checkout')) !== NULL) {
                $this->data['config_stock_checkout'] = $this->input->post('config_stock_checkout');
            } else {
                $this->data['config_stock_checkout'] = $this->common->config('config_stock_checkout');
            }
            
            if  (($this->input->post('config_return_id')) !== NULL) {
                $this->data['config_return_id'] = $this->input->post('config_return_id');
            } else {
                $this->data['config_return_id'] = $this->common->config('config_return_id');
            }
            
            if  (($this->input->post('config_return_status_id')) !== NULL) {
                $this->data['config_return_status_id'] = $this->input->post('config_return_status_id');
            } else {
                $this->data['config_return_status_id'] = $this->common->config('config_return_status_id');
            }
            
            if  (($this->input->post('config_logo')) !== NULL) {
                $this->data['config_logo'] = $this->input->post('config_logo');
            } else {
                $this->data['config_logo'] = $this->common->config('config_logo');
            }
            
            //====Start Code: Call image model for resize the image
            if (($this->input->post('config_logo') !== NULL) && is_file(DIR_IMAGE . $this->input->post('config_logo'))) {
		$this->data['logo'] = $this->image->resize($this->input->post('config_logo'), 100, 100);
	    } elseif ($this->common->config('config_logo') && is_file(DIR_IMAGE . $this->common->config('config_logo'))) {
		$this->data['logo'] = $this->image->resize($this->common->config('config_logo'), 100, 100);
            } else {
		$this->data['logo'] = $this->image->resize('no_image.png', 100, 100);
            }
            //====End Code: Call image model for resize the image
            
            if  (($this->input->post('config_icon')) !== NULL) {
                $this->data['config_icon'] = $this->input->post('config_icon');
            } else {
                $this->data['config_icon'] = $this->common->config('config_icon');
            }
            
            //====Start Code: Call image model for resize the image
            if (($this->input->post('config_icon') !== NULL) && is_file(DIR_IMAGE . $this->input->post('config_icon'))) {
		$this->data['icon'] = $this->image->resize($this->input->post('config_icon'), 100, 100);
	    } elseif ($this->common->config('config_icon') && is_file(DIR_IMAGE . $this->common->config('config_icon'))) {
		$this->data['icon'] = $this->image->resize($this->common->config('config_icon'), 100, 100);
            } else {
		$this->data['icon'] = $this->image->resize('no_image.png', 100, 100);
            }
            //====End Code: Call image model for resize the image
            
            if  (($this->input->post('config_image_category_width')) !== NULL) {
                $this->data['config_image_category_width'] = $this->input->post('config_image_category_width');
            } else {
                $this->data['config_image_category_width'] = $this->common->config('config_image_category_width');
            }
            
            if  (($this->input->post('config_image_category_height')) !== NULL) {
                $this->data['config_image_category_height'] = $this->input->post('config_image_category_height');
            } else {
                $this->data['config_image_category_height'] = $this->common->config('config_image_category_height');
            }
            
            if  (($this->input->post('config_image_thumb_width')) !== NULL) {
                $this->data['config_image_thumb_width'] = $this->input->post('config_image_thumb_width');
            } else {
                $this->data['config_image_thumb_width'] = $this->common->config('config_image_thumb_width');
            }
            
            if  (($this->input->post('config_image_thumb_height')) !== NULL) {
                $this->data['config_image_thumb_height'] = $this->input->post('config_image_thumb_height');
            } else {
                $this->data['config_image_thumb_height'] = $this->common->config('config_image_thumb_height');
            }
            
            if  (($this->input->post('config_image_popup_width')) !== NULL) {
                $this->data['config_image_popup_width'] = $this->input->post('config_image_popup_width');
            } else {
                $this->data['config_image_popup_width'] = $this->common->config('config_image_popup_width');
            }
            
            if  (($this->input->post('config_image_popup_height')) !== NULL) {
                $this->data['config_image_popup_height'] = $this->input->post('config_image_popup_height');
            } else {
                $this->data['config_image_popup_height'] = $this->common->config('config_image_popup_height');
            }
            
            if  (($this->input->post('config_image_product_width')) !== NULL) {
                $this->data['config_image_product_width'] = $this->input->post('config_image_product_width');
            } else {
                $this->data['config_image_product_width'] = $this->common->config('config_image_product_width');
            }
            
            if  (($this->input->post('config_image_product_height')) !== NULL) {
                $this->data['config_image_product_height'] = $this->input->post('config_image_product_height');
            } else {
                $this->data['config_image_product_height'] = $this->common->config('config_image_product_height');
            }
            
            if  (($this->input->post('config_image_additional_width')) !== NULL) {
                $this->data['config_image_additional_width'] = $this->input->post('config_image_additional_width');
            } else {
                $this->data['config_image_additional_width'] = $this->common->config('config_image_additional_width');
            }
            
            if  (($this->input->post('config_image_additional_height')) !== NULL) {
                $this->data['config_image_additional_height'] = $this->input->post('config_image_additional_height');
            } else {
                $this->data['config_image_additional_height'] = $this->common->config('config_image_additional_height');
            }
            
            if  (($this->input->post('config_image_related_width')) !== NULL) {
                $this->data['config_image_related_width'] = $this->input->post('config_image_related_width');
            } else {
                $this->data['config_image_related_width'] = $this->common->config('config_image_related_width');
            }
            
            if  (($this->input->post('config_image_related_height')) !== NULL) {
                $this->data['config_image_related_height'] = $this->input->post('config_image_related_height');
            } else {
                $this->data['config_image_related_height'] = $this->common->config('config_image_related_height');
            }
            
            if  (($this->input->post('config_image_compare_width')) !== NULL) {
                $this->data['config_image_compare_width'] = $this->input->post('config_image_compare_width');
            } else {
                $this->data['config_image_compare_width'] = $this->common->config('config_image_compare_width');
            }
            
            if  (($this->input->post('config_image_compare_height')) !== NULL) {
                $this->data['config_image_compare_height'] = $this->input->post('config_image_compare_height');
            } else {
                $this->data['config_image_compare_height'] = $this->common->config('config_image_compare_height');
            }
            
            if  (($this->input->post('config_image_wishlist_width')) !== NULL) {
                $this->data['config_image_wishlist_width'] = $this->input->post('config_image_wishlist_width');
            } else {
                $this->data['config_image_wishlist_width'] = $this->common->config('config_image_wishlist_width');
            }
            
            if  (($this->input->post('config_image_wishlist_height')) !== NULL) {
                $this->data['config_image_wishlist_height'] = $this->input->post('config_image_wishlist_height');
            } else {
                $this->data['config_image_wishlist_height'] = $this->common->config('config_image_wishlist_height');
            }
            
            if  (($this->input->post('config_image_cart_width')) !== NULL) {
                $this->data['config_image_cart_width'] = $this->input->post('config_image_cart_width');
            } else {
                $this->data['config_image_cart_width'] = $this->common->config('config_image_cart_width');
            }
            
            if  (($this->input->post('config_image_cart_height')) !== NULL) {
                $this->data['config_image_cart_height'] = $this->input->post('config_image_cart_height');
            } else {
                $this->data['config_image_cart_height'] = $this->common->config('config_image_cart_height');
            }
            
            if  (($this->input->post('config_image_location_width')) !== NULL) {
                $this->data['config_image_location_width'] = $this->input->post('config_image_location_width');
            } else {
                $this->data['config_image_location_width'] = $this->common->config('config_image_location_width');
            }
            
            if  (($this->input->post('config_image_location_height')) !== NULL) {
                $this->data['config_image_location_height'] = $this->input->post('config_image_location_height');
            } else {
                $this->data['config_image_location_height'] = $this->common->config('config_image_location_height');
            }
            
            if  (($this->input->post('config_mail_protocol')) !== NULL) {
                $this->data['config_mail_protocol'] = $this->input->post('config_mail_protocol');
            } else {
                $this->data['config_mail_protocol'] = $this->common->config('config_mail_protocol');
            }
            
            if  (($this->input->post('config_mail_parameter')) !== NULL) {
                $this->data['config_mail_parameter'] = $this->input->post('config_mail_parameter');
            } else {
                $this->data['config_mail_parameter'] = $this->common->config('config_mail_parameter');
            }
            
            if  (($this->input->post('config_mail_smtp_hostname')) !== NULL) {
                $this->data['config_mail_smtp_hostname'] = $this->input->post('config_mail_smtp_hostname');
            } else {
                $this->data['config_mail_smtp_hostname'] = $this->common->config('config_mail_smtp_hostname');
            }
            
            if  (($this->input->post('config_mail_smtp_username')) !== NULL) {
                $this->data['config_mail_smtp_username'] = $this->input->post('config_mail_smtp_username');
            } else {
                $this->data['config_mail_smtp_username'] = $this->common->config('config_mail_smtp_username');
            }
            
            if  (($this->input->post('config_mail_smtp_password')) !== NULL) {
                $this->data['config_mail_smtp_password'] = $this->input->post('config_mail_smtp_password');
            } else {
                $this->data['config_mail_smtp_password'] = $this->common->config('config_mail_smtp_password');
            }
            
            if  (($this->input->post('config_mail_smtp_port')) !== NULL) {
                $this->data['config_mail_smtp_port'] = $this->input->post('config_mail_smtp_port');
            } else {
                $this->data['config_mail_smtp_port'] = $this->common->config('config_mail_smtp_port');
            }
            
            if  (($this->input->post('config_mail_smtp_timeout')) !== NULL) {
                $this->data['config_mail_smtp_timeout'] = $this->input->post('config_mail_smtp_timeout');
            } else {
                $this->data['config_mail_smtp_timeout'] = $this->common->config('config_mail_smtp_timeout');
            }
            
            if  (($this->input->post('config_mail_alert')) !== NULL) {
                $this->data['config_mail_alert'] = $this->input->post('config_mail_alert');
            } else {
                $this->data['config_mail_alert'] = $this->common->config('config_mail_alert');
            }
            // Social Link
            if  (($this->input->post('config_facebook_link')) !== NULL) {
                $this->data['config_facebook_link'] = $this->input->post('config_facebook_link');
            } else {
                $this->data['config_facebook_link'] = $this->common->config('config_facebook_link');
            }
            
            if  (($this->input->post('config_twitter_link')) !== NULL) {
                $this->data['config_twitter_link'] = $this->input->post('config_twitter_link');
            } else {
                $this->data['config_twitter_link'] = $this->common->config('config_twitter_link');
            }
            
            if  (($this->input->post('config_googleplus_link')) !== NULL) {
                $this->data['config_googleplus_link'] = $this->input->post('config_googleplus_link');
            } else {
                $this->data['config_googleplus_link'] = $this->common->config('config_googleplus_link');
            }
            
            if  (($this->input->post('config_pinterest_link')) !== NULL) {
                $this->data['config_pinterest_link'] = $this->input->post('config_pinterest_link');
            } else {
                $this->data['config_pinterest_link'] = $this->common->config('config_pinterest_link');
            }
            
            if  (($this->input->post('config_instagram_link')) !== NULL) {
                $this->data['config_instagram_link'] = $this->input->post('config_instagram_link');
            } else {
                $this->data['config_instagram_link'] = $this->common->config('config_instagram_link');
            }
            // Get Country List For ComboBox
            $this->data['country_list'] =$this->country->getCountries();
            
            // Get State/Zone List For ComboBox
            $this->data['state_list'] =$this->zone->getZones();

            // Get Currency List For ComboBox
            $this->data['currency_list'] =$this->currency->getCurrencies();

            // Get Order Status List For ComboBox
            $this->data['order_status_list'] =$this->order_status->getOrderStatuses();

            // Get Return_status List for ComboBox
            $this->data['return_status_list'] =$this->Return_status->getReturnStatuses();

            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/system/settings";
            $this->load->view($content_page,$this->data);
	}
        
        /**
	* 
	* @function name : validation()
	* @description   : generate validation when input data incorrect
	* @param   	 : void
	* @return        : TRUE/FALSE
	*
	*/
	public function validate() {
            $validation = array(
                            array(
                                'field'     => 'config_meta_title',
                                'label'     => 'Meta Title', 
                                'rules'     => 'required|xss_clean|min_length[3]|max_length[32]', 
                                'errors'    => array('required' => '%s must be between 3 and 32 characters!','min_length'=>'%s must be between 3 and 32 characters!','max_length'=>'%s must be between 3 and 32 characters!')
                            ),
                            array(
                                'field'     => 'config_store_name',
                                'label'     => 'Store Name', 
                                'rules'     => 'required|xss_clean|min_length[3]|max_length[32]', 
                                'errors'    => array('required' => '%s must be between 3 and 32 characters!','min_length'=>'%s must be between 3 and 32 characters!','max_length'=>'%s must be between 3 and 32 characters!')
                            ),
                            array(
                                'field'     => 'config_store_owner',
                                'label'     => 'Store Owner', 
                                'rules'     => 'required|xss_clean|min_length[3]|max_length[64]', 
                                'errors'    => array('required' => '%s must be between 3 and 64 characters!','min_length'=>'%s must be between 3 and 64 characters!','max_length'=>'%s must be between 3 and 64 characters!')
                            ),
                            array(
                                'field'     => 'config_address',
                                'label'     => 'Address', 
                                'rules'     => 'required|xss_clean|min_length[10]|max_length[256]', 
                                'errors'    => array('required' => '%s must be between 10 and 256 characters!','min_length'=>'%s must be between 10 and 256 characters!','max_length'=>'%s must be between 10 and 256 characters!')
                            ),
                              array(
                                'field'     => 'config_email',
                                'label'     => 'E-Mail Address', 
                                'rules'     => 'trim|required|xss_clean|valid_email', 
                                'errors'    => array('required' => '%s  does not appear to be valid!','valid_email'=>'%s  does not appear to be valid!')
                            ),
                            array(
                                'field'     => 'config_telephone',
                                'label'     => 'Telephone', 
                                'rules'     => 'required|xss_clean|min_length[3]|max_length[32]|integer', 
                                'errors'    => array('required' => '%s must be between 3 and 32 characters!','min_length'=>'%s must be between 3 and 32 characters!','max_length'=>'%s must be between 3 and 32 characters!')
                            ),
                               array(
                                'field'     => 'config_date_format',
                                'label'     => 'Date Format', 
                                'rules'     => 'trim|required|xss_clean', 
                                'errors'    => array('required' => 'Please select %s!')
                            ),
                            array(
                                'field'     => 'config_time_format',
                                'label'     => 'Time Format', 
                                'rules'     => 'trim|required|xss_clean', 
                                'errors'    => array('required' => 'Please select %s!')
                            ),
                            array(
                                'field'     => 'config_product_limit',
                                'label'     => 'Default Items Per Page', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Limit required!')
                            ),
                            array(
                                'field'     => 'config_product_description_length',
                                'label'     => 'List Description Limit', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Limit required!')
                            ),
                            array(
                                'field'     => 'config_limit_admin',
                                'label'     => 'Default Items Per Page', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Limit required!')
                            ),
                            array(
                                'field'     => 'config_voucher_min',
                                'label'     => 'Minimum voucher amount', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => '%s required!')
                            ),
                            array(
                                'field'     => 'config_voucher_max',
                                'label'     => 'Maximum voucher amount', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => '%s required!')
                            ),
                            array(
                                'field'     => 'config_image_category_width',
                                'label'     => 'Category List Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Category List Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_category_height',
                                'label'     => 'Category List Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Category List Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_thumb_width',
                                'label'     => 'Product Image Thumb Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Product Image Thumb Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_thumb_height',
                                'label'     => 'Product Image Thumb Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Product Image Thumb Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_popup_width',
                                'label'     => 'Product Image Popup Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Product Image Popup Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_popup_height',
                                'label'     => 'Product Image Popup Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Product Image Popup Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_product_width',
                                'label'     => 'Product List Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Product List Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_product_height',
                                'label'     => 'Product List Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Product List Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_additional_width',
                                'label'     => 'Additional Product Image Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Additional Product Image Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_additional_height',
                                'label'     => 'Additional Product Image Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Additional Product Image Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_related_width',
                                'label'     => 'Related Product Image Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Related Product Image Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_related_height',
                                'label'     => 'Related Product Image Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Related Product Image Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_compare_width',
                                'label'     => 'Compare Image Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Compare Image Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_compare_height',
                                'label'     => 'Compare Image Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Compare Image Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_wishlist_width',
                                'label'     => 'Wish List Image Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Wish List Image Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_wishlist_height',
                                'label'     => 'Wish List Image Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Wish List Image Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_cart_width',
                                'label'     => 'Cart Image Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Cart Image Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_cart_height',
                                'label'     => 'Cart Image Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Cart Image Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_location_width',
                                'label'     => 'Store Image Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Store Image Size dimensions required!')
                            ),
                            array(
                                'field'     => 'config_image_location_height',
                                'label'     => 'Store Image Size dimensions', 
                                'rules'     => 'trim|required|xss_clean|integer', 
                                'errors'    => array('required' => 'Store Image Size dimensions required!')
                            ),
                           array(
                                'field'     => 'config_facebook_link',
                                'label'     => 'Facebook', 
                                'rules'     => 'trim|prep_url|xss_clean', 
                                'errors'    => array('valid_url' => 'Enter %s valid url!')
                            ),
                
                            array(
                                'field'     => 'config_twitter_link',
                                'label'     => 'Twitter', 
                                'rules'     => 'trim|prep_url|xss_clean', 
                                'errors'    => array('valid_url' => 'Enter %s valid url!')
                            ),
                
                            array(
                                'field'     => 'config_googleplus_link',
                                'label'     => 'Google+', 
                                'rules'     => 'trim|prep_url|xss_clean', 
                                'errors'    => array('valid_url' => 'Enter %s valid url!')
                            ),
                
                            array(
                                'field'     => 'config_pinterest_link',
                                'label'     => 'Pinterest', 
                                'rules'     => 'trim|prep_url|xss_clean', 
                                'errors'    => array('valid_url' => 'Enter %s valid url!')
                            ),
                
                            array(
                                'field'     => 'config_instagram_link',
                                'label'     => 'Instagram', 
                                'rules'     => 'trim|prep_url|xss_clean', 
                                'errors'    => array('valid_url' => 'Enter %s valid url!')
                            )
                        
                        );

            $this->form_validation->set_rules($validation);
            if ($this->form_validation->run() == FALSE){

                $this->data['error']="Warning: Please check the form carefully for errors!";
                return FALSE;
            }
            else{
                //$this->data['success']="Success: You have modified Settings!";
                return TRUE;
            }
        }
		
	/**
	* 
	* @function name : getState()
	* @description   : get data from State
	* @param   		 : void
	* @return        : void
	*
	*/
    public function getState()
    {
	   $this->output->unset_template();
	   $country_id = $this->input->post('country_id');
       $data = $this->zone->getZoneByCountryId($country_id);
	   echo json_encode($data);
    }

	
}
