<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
* @file name    : Home
* @Auther       : Vinay
* @Date         : 05-12-2017
* @Description  : Account Related Operation Like Login, Register, Forgotpassword, etc.
*
*/
class Home extends CI_Controller {
	function __construct()
	{
            parent::__construct();
                
            $this->_init();
            
           $this->load->model('tool/image');
             $this->load->model('modules/bestSeller','BestSeller');
             $this->load->model('modules/popularProducts','PopularProducts');
              $this->load->model('modules/latestProduct','latestproduct');
             $this->load->model('modules/specialProduct','specialproduct');
	}
	
	private function _init() {
            //--Set Template
            $this->output->set_template('site_template');
            $site_theme = $this->common->config('catalog_theme');
           
	}
        
	public function index()
	{
            $this->document->setTitle('title');
            $this->document->setDescription('description');
            $this->document->setKeywords('keyword');
	    $data['header'] = $this->headers->getHeaders();
             $image_data = array();
           $this->load->model('design/banner_model','banner');

           $slider_list = $this->banner->getBanner('home','main banner');
           foreach ($slider_list as $key => $value) 
            {
                   if (is_file(DIR_IMAGE . $value['image'])) {                
                $image = $this->image->resize($value['image'], 1920, 560);
            } else {
                $image = $this->image->resize('no_image.png', 1920, 560);
            }
                  $image_data[]=array(
                        'banner_id'       => $value['banner_id'],
                        'banner_image_id' => $value['banner_image_id'],
                        'title'           => $value['title'],
                        'link'            => $value['link'],
                        'sort_order'      => $value['sort_order'],
                        'image'           => $image,
                        );
            }
            $data['slider_list'] = $image_data;
            $site_theme = $this->common->config('catalog_theme');
            $this->load->section('slider', "themes/".$site_theme."/common/home-slider",$data);
            $this->load->section('content_top', "themes/".$site_theme."/common/content_top");
            $this->load->section('content', "themes/".$site_theme."/common/featured-list");
            $this->load->section('content_bottom', "themes/".$site_theme."/common/content_bottom");
            $this->load->view("themes/".$site_theme."/common/home",$data);
	}
        
}
