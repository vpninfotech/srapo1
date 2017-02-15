<?php

if (!defined('BASEPATH'))exit('No direct script access allowed');

/**
 * 
 * @file name    : Email Template
 * @Auther       : Vinay
 * @Date         : 06-12-2016
 * @Description  : Admin Email Template Related Collection of functions
 *
 */
class Email_template extends CI_Controller {

    private $data=array();
    private $error = array();

    function __construct() {
        parent::__construct();

        $this->_init();

        $this->rbac->CheckAuthentication();

        $this->load->model('system/email_template_model', 'email_template');

        $this->lang->load('system/email_template_lang', 'english');

        $this->load->model('common');
        
        $this->load->library('Mailer');
        
        $this->load->library('commons');

        $this->load->library('pagination');
    }

    /**
     * 
     * @function name : _init()
     * @description   : initialize required resources in this view
     * @param         : void
     * @return        : void
     *
     */
    private function _init() {
        //--Set Template
        $this->output->set_template('admin_template');
        $admin_theme = $this->common->config('admin_theme');
        $this->output->set_common_meta('Email Template', 'sarpo', 'This is srapo email template page');
    }

    /**
     * 
     * @function name : index()
     * @description   : load Product view
     * @param         : void
     * @return        : void
     *
     */
    public function index($sort_by = 'template_name', $sort_order = 'ASC', $offset = 0) {
        
        $this->data['breadcrumbs'] = array();
        $this->data['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-dashboard"></i> Home',
            'href' => base_url('dashboard/dashboard'),
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Email Templates',
            'href' => base_url('system/email_template'),
        );
        
        // pagination
        $limit = $this->common->config('config_limit_admin');
        $data = array(            
            'sort' => $sort_by,
            'order' => $sort_order,
            'start' => $offset,
            'limit' => $limit
        );

        $url = base_url("system/email_template/index/$sort_by/$sort_order");
        $total_records = $this->email_template->getTotalEmailTemplate();
        $config = $this->commons->pagination($url, $total_records, $limit);
        $this->pagination->initialize($config);
        $config['uri_segment'] = 6;
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['sort_by'] = $sort_by;
        $this->data['sort_order'] = $sort_order;
        $results = $this->email_template->getEmailTemplates($data);

        $this->data['pages'] = ceil($total_records / $limit);
        $this->data['totals'] = ceil($total_records);
        $this->data['range'] = ceil($offset + 1);

        // URL creation
        $url = '';
        if ($this->uri->segment(4) !== NULL) {
            $url .= '/' . $this->uri->segment(4);
        } else {
            $url .= '/template_name';
        }

        if ($this->uri->segment(5) !== NULL) {
            $url .= '/' . $this->uri->segment(5);
        } else {
            $url .= '/ASC';
        }
        if ($this->uri->segment(6) !== NULL) {
            $url .= '/' . $this->uri->segment(6);
        } else {
            $url .= '/0';
        }
        
        
        //print_r($results);
        foreach ($results as $result) { 
            $this->data['records'][] = array(
                'template_id' => $result['template_id'],
                'template_name' => $result['template_name'],
                'subject' => $result['subject'],                
                'edit' => base_url('system/email_template/edit' . $url . '/' . $this->commons->encode($result['template_id']))
            );
        }

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if ($this->session->userdata('success') !== NULL) {
            $this->data['success'] = $this->session->userdata('success');
            $this->session->set_userdata('success', '');
        } else {
            $this->data['success'] = '';
        }

        if ($this->input->post('selected') !== NULL) {
            $this->data['selected'] = (array) $this->input->post('selected');
        } else {
            $this->data['selected'] = array();
        }

        $admin_theme = $this->common->config('admin_theme');
        $content_page = "themes/" . $admin_theme . "/system/email_template_list";
        $this->load->view($content_page, $this->data);
    }   

    /**
     * 
     * @function name : edit()
     * @description   : edit email template records
     * @param         : void
     * @return        : void
     *
     */
    public function edit($sort_by = 'template_name', $sort_order = 'ASC', $offset = 0) {
        if (($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {

            $this->email_template->editEmailTemplate();
            $this->session->set_userdata('success', $this->lang->line('text_success'));

            // Generate back url
            $url = '';

            if ($this->uri->segment(4) !== NULL) {
                $url .= '/' . $this->uri->segment(4);
            } else {
                $url .= '/template_name';
            }

            if ($this->uri->segment(5) !== NULL) {
                $url .= '/' . $this->uri->segment(5);
            } else {
                $url .= '/ASC';
            }
            if ($this->uri->segment(6) !== NULL) {
                $url .= '/' . $this->uri->segment(6);
            } else {
                $url .= '/0';
            }

            redirect('system/email_template/index' . $url);
        }
        $this->getForm();
    }

    /**
     * 
     * @function name : getForm()
     * @description   : Generate Form for Add and Edit Records
     * @param         : void
     * @return        : void
     *
     */
    public function getForm() {
        // Transaction Status
        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if ($this->session->userdata('success') !== NULL) {
            $this->data['success'] = $this->session->userdata('success');

            $this->session->set_userdata('success', '');
        } else {
            $this->data['success'] = '';
        }

        // Generate back url
        $url = '';

        if ($this->uri->segment(4) !== NULL) {
            $url .= '/' . $this->uri->segment(4);
        } else {
            $url .= '/template_name';
        }

        if ($this->uri->segment(5) !== NULL) {
            $url .= '/' . $this->uri->segment(5);
        } else {
            $url .= '/ASC';
        }
        if ($this->uri->segment(6) !== NULL) {
            $url .= '/' . $this->uri->segment(6);
        } else {
            $url .= '/0';
        }

        // breadcrumbs
        $this->data['breadcrumbs'] = array();
        $this->data['breadcrumbs'][] = array(
            'text' => '<i class="fa fa-dashboard"></i> Home',
            'href' => base_url('dashboard/dashboard'),
        );
        $this->data['breadcrumbs'][] = array(
            'text' => 'Email Templates',
            'href' => base_url('catalog/product'),
        );

        // Add or Edit Transaction
        $count = $this->uri->total_segments();
        $this->uri->segment($count);
        $method = $this->uri->segment(3);
        if ($method == 'edit') {
            $this->data['form_action'] = base_url('system/email_template/edit' . $url . '/' . $this->uri->segment($count));
            $this->data['template_id'] = $this->commons->decode($this->uri->segment($count));
            $this->data['text_form'] = $this->lang->line('text_edit'); 
            
            $this->data['restore_data'] = base_url('system/email_template/restore_template_value' . $url . '/' . $this->uri->segment($count));
            $this->data['view_template'] = base_url('system/email_template/view_email_template/');
        }        
        $this->data['cancel'] = base_url('system/email_template/index' . $url);

        // Set Value Back
        if (1) {
            $template_info = $this->email_template->getEmailTemplateById($this->commons->decode($this->uri->segment($count)));
        }

        
        if ($this->input->post('subject') !== NULL) {
            $this->data['subject'] = $this->input->post('subject');
        } elseif (!empty($template_info)) {
            $this->data['subject'] = $template_info['subject'];
        } else {
            $this->data['subject'] = '';
        }
        
        if(!empty($template_info)) {
            $this->data['template_name'] = $template_info['template_name'];
        }
        
        if(!empty($template_info)) {
            $this->data['template_code'] = $template_info['template_code'];
        }
        
        if(!empty($template_info)) {
            $this->data['hints'] = $template_info['hint_value'];
        }

        if ($this->input->post('message') !== NULL) {
            $this->data['message'] = $this->input->post('message');
        } elseif (!empty($template_info)) {
            $this->data['message'] = $template_info['content'];
        } else {
            $this->data['message'] = '';
        }  

        $admin_theme = $this->common->config('admin_theme');
        $content_page = "themes/" . $admin_theme . "/system/email_template";
        $this->load->view($content_page, $this->data);
    }

    /**
     * 
     * @function name : validateForm()
     * @description   : Validate Entered Form data
     * @param         : void
     * @return        : void
     *
     */
    public function validateForm() {
        $validation = array(
            array(
                'field' => 'subject',
                'label' => 'Subject',
                'rules' => 'trim|required|xss_clean',
                'errors' => array('required' => '%s must be required!')
            ),
        );

        $this->form_validation->set_rules($validation);
        if ($this->form_validation->run() == FALSE) {
            $this->error['error'] = $this->session->set_userdata('warning', $this->lang->line('error_warning'));
            $this->data['error'] = $this->session->userdata('warning', $this->lang->line('error_warning'));
            return FALSE;
        } else {

            return TRUE;
        }
    }
    
    /**
     * 
     * @function name : restore_template_value()
     * @description   : restore_template_value() function used to set default template message
     * @param         : void
     * @return        : void
     *
     */
    public function restore_template_value()
    {
        $count = $this->uri->total_segments();
        $this->uri->segment($count);
        $this->email_template->RestoreDefault($this->commons->decode($this->uri->segment($count)));
        $this->data['success'] = $this->session->set_flashdata('success', 'Default Value Restored Successfully');
        // Generate back url
        $url = '';

        if ($this->uri->segment(4) !== NULL) {
            $url .= '/' . $this->uri->segment(4);
        } else {
            $url .= '/template_name';
        }

        if ($this->uri->segment(5) !== NULL) {
            $url .= '/' . $this->uri->segment(5);
        } else {
            $url .= '/ASC';
        }
        if ($this->uri->segment(6) !== NULL) {
            $url .= '/' . $this->uri->segment(6);
        } else {
            $url .= '/0';
        }
        redirect('system/email_template/edit' . $url .'/'. $this->uri->segment($count));	
    }
    
    /**
     * 
     * @function name : send_test_email()
     * @description   : send_test_email() function used to send mail only for test
     * @param         : void
     * @return        : void
     *
     */
    function send_test_email()
    {
        $count = $this->uri->total_segments();
        $this->uri->segment($count);
        $TPL=$this->email_template->getEmailTemplateById($this->commons->decode($this->uri->segment($count)));
        $Template = $this->mailer->Tpl_Email($TPL['template_code'],$this->commons->encode($this->input->post('EmailId')));
        $Recipient = $this->input->post('EmailId');
        $Filter = array();
        foreach(explode("|",$TPL['hint_value']) as $hint)
        {
                 $h = explode("$",$hint);
                 $Filter[trim($h[0])] = trim($h[1]);
        } 
        $this->mailer->Send_Singal_Html_Email($Recipient,$Template,$Filter);
        $this->session->set_flashdata('success', 'Email Sent Successfully');
        // Generate back url
        $url = '';

        if ($this->uri->segment(4) !== NULL) {
            $url .= '/' . $this->uri->segment(4);
        } else {
            $url .= '/template_name';
        }

        if ($this->uri->segment(5) !== NULL) {
            $url .= '/' . $this->uri->segment(5);
        } else {
            $url .= '/ASC';
        }
        if ($this->uri->segment(6) !== NULL) {
            $url .= '/' . $this->uri->segment(6);
        } else {
            $url .= '/0';
        }
        redirect('system/email_template/edit' . $url .'/'. $this->uri->segment($count));	
    }
    
    /**
     * 
     * @function name : view_email_template()
     * @description   : view_email_template() function used to show email template with message body
     * @param         : void
     * @return        : void
     *
     */
    public function view_email_template() {
        $this->output->unset_template();
        $count = $this->uri->total_segments();
        $this->uri->segment($count);
        $TPL = $this->mailer->Tpl_Email($this->uri->segment($count));
        print_r($TPL['Message']);
    }
    
}
