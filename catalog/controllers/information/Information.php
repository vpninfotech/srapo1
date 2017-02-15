<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Information
* @Auther       : Vinay
* @Date         : 16-01-2017
* @Description  : Collection of Information Module related Functions
*
*/

class Information extends CI_Controller {


	private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->_init();

		$this->load->model('catalog/information_model','information');
		
		$this->lang->load('information/information_lang', 'english');
		
		$this->load->model('common');
		
		$this->load->library('commons');
		
		$this->load->library('pagination');
		 
	}
	
	/**
	* 
	* @function name : _init()
	* @description   : initialize required resources in this view
	* @param   		 : void
	* @return        : void
	*
	*/
	
	private function _init() {
		
		//--Set Template
		$this->output->set_template('site_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Footer','sarpo','This is srapo Footer page');
		

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load information view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($information_id=0)	
	{
            // breadcrumbs            
            $data['breadcrumbs']   	= array();
            $data['breadcrumbs'][] 	= array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),

            );
            
            //$count = $this->uri->total_segments();
           // $info_id = $this->commons->decode($this->uri->segment($count));
            
            //if ((int)$info_id) {
            //    $information_id = (int)$info_id;
            //} else {
            //    $information_id = 0;
            //}
            
            $information_info = $this->information->getInformation($information_id);
            
            if ($information_info) {
                $this->document->setTitle($information_info['meta_title']);
                $this->document->setDescription($information_info['meta_description']);
                $this->document->setKeywords($information_info['meta_keyword']);
                
                $data['breadcrumbs'][] = array(
                    'text' => $information_info['title'],
                    'href' => site_url('information/'.$information_id),
                );
                
                $data['heading_title'] = $information_info['title'];
                
                $data['description'] = $information_info['description'];
                
                $data['header'] = $this->headers->getHeaders();
                $site_theme = $this->common->config('catalog_theme');
                //$this->load->section('colom_right', "themes/".$site_theme."/common/colom_right");
                $this->load->view("themes/".$site_theme."/information/information",$data);
            } else {
                // breadcrumbs   
                $data['breadcrumbs'][] = array(
                    'text' => $this->lang->line('text_error'),
                    'href' => site_url('information/'.$information_id),
                );
                
                $this->document->setTitle($this->lang->line('text_error'));
                
                $data['heading_title'] = $this->lang->line('text_error');

                $data['text_error'] = $this->lang->line('text_error');
                
                $data['header'] = $this->headers->getHeaders();
                
                $data['back'] = site_url('common/home');
                $site_theme = $this->common->config('catalog_theme');
                $this->load->view("themes/".$site_theme."/error/not_found",$data);
            }
	}		
}
