<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Sitemap extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        
        $this->_init();
        //$this->load->library('document');
        //$this->load->library('headers');
    }
	
    private function _init() {
            //--Set Template
            $this->output->set_template('site_template');
            $site_theme = $this->common->config('catalog_theme');
            $this->output->set_common_meta('Site Map','sarpo','Sitemap Page');
    }
    public function index()
    {
        $data['breadcrumbs']   = array();
        $data['breadcrumbs'][] = array(
           'text' => '<i class="glyphicon glyphicon-home"></i> Home',
           'href' => site_url('common/home'),
        );
        $data['breadcrumbs'][] = array(
           'text' => 'Site Map',  
           'href' => site_url('information/sitemap'),
        );
        
        $this->load->model('catalog/category_model','category');
        $this->load->model('catalog/product_model','product');
        
        $data['categories'] = array();
        
        $categories_1 = $this->category->getCategories(0);
        
        foreach ($categories_1 as $category_1) {
            $level_2_data = array();
            
            $categories_2 = $this->category->getCategories($category_1['category_id']);
            
            foreach ($categories_2 as $category_2) {
                $level_3_data = array();
                
                $categories_3 = $this->category->getCategories($category_2['category_id']);
                
                foreach ($categories_3 as $category_3) {
                    $level_3_data[] = array(
                        'name' => $category_3['category_name'],
                        'href' => site_url($category_3['seo_keywords'])
                    );
                }
                $level_2_data[] = array(
                    'name'     => $category_2['category_name'],
                    'children' => $level_3_data,
                    'href'     => site_url($category_2['seo_keywords'])
                );
            }
            $data['categories'][] = array(
                'name'     => $category_1['category_name'],
                'children' => $level_2_data,
                'href'     => site_url( $category_1['seo_keywords'])
            );
        }
        
        $this->load->model('catalog/information_model','information');
        
        $data['information'] = array();
        
        foreach ($this->information->getInformations() as $result) {
            $data['informations'][] = array(
                'title' => $result['title'],
                'href'  => site_url('information/information/index/', $this->commons->encode($result['information_id']))
            );
        }
        
        //$data['success'] = $this->session->unset_userdata('success');
        $this->document->setTitle('title');
        $this->document->setDescription('description');
        $this->document->setKeywords('keyword');
        $data['header'] = $this->headers->getHeaders();
        $site_theme = $this->common->config('catalog_theme');
        //$this->load->section('colom_right', "themes/".$site_theme."/common/colom_right");
        $this->load->view("themes/".$site_theme."/information/sitemap",$data);
    }
}
