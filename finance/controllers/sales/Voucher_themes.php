<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : VoucherThemes
* @Auther       : Indrajit
* @Date         : 16-11-2016
* @Description  : Admin customers Operation
*
*/

class Voucher_themes extends CI_Controller {

    private $data=array();
	private $error = array();

	function __construct()
	{
            parent::__construct();

            $this->_init();

            $this->rbac->CheckAuthentication();

			$this->load->model('sales/Voucher_themes_model','voucher_themes');

            $this->lang->load('sales/voucher_themes_lang', 'english');

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
            $this->output->set_template('finance_template');
            $admin_theme = $this->common->config('admin_theme');
            $this->output->set_common_meta('Voucher Themes','sarpo','This is srapo Voucher Themes page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load VoucherThemes view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'name', $sort_order = 'ASC', $offset = 0)
	{
            // breadcrumbs
            $this->data['add']             = base_url('sales/voucher_themes/add');
            if($this->session->userdata('role_id')== 1)
            {
                    $this->data['delete']  = base_url('sales/voucher_themes/delete');
            }
            else
            {
                    $this->data['delete']  = base_url('sales/voucher_themes/softDelete');
            }
            $this->data['breadcrumbs']   = array();
            $this->data['breadcrumbs'][] = array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),

            );
            $this->data['breadcrumbs'][] = array(
               'text' => 'Voucher Themes',  
               'href' => base_url('sales/voucher_themes'),

            );
		  	
		 
            // pagination
            $limit = $this->common->config('config_limit_admin');
            $data = array(
                'sort' => $sort_by,
                'order'=> $sort_order,
                'start'=> $offset,
                'limit'=> $limit
            );
		
            $url = base_url("sales/voucher_themes/index/$sort_by/$sort_order");
            $total_records = $this->voucher_themes->getTotalVoucherThemes();
            $config =$this->commons->pagination($url,$total_records,$limit);
            $this->pagination->initialize($config);
            $config['uri_segment'] = 6;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['sort_by'] = $sort_by;
            $this->data['sort_order'] = $sort_order;
            $results = $this->voucher_themes->getVoucherThemes($data);
			
            $this->data['pages'] = ceil($total_records/$limit);
            $this->data['totals'] = ceil($total_records);
            $this->data['range'] = ceil($offset+1);
		
            // URL creation
            $url='';
            if ($this->uri->segment(4)!==NULL) {
                    $url .= '/'.$this->uri->segment(4);
            }
            else
            {
                    $url .= '/name';
            }

            if ($this->uri->segment(5)!==NULL) {
                    $url .= '/'.$this->uri->segment(5);
            }
            else
            {
                    $url .= '/ASC';
            }
            if ($this->uri->segment(6)!==NULL) {
                    $url .= '/'.$this->uri->segment(6);
            }
            else
            {
                    $url .= '/0';
            }
		
            foreach ($results as $result) { 
                    $this->data['records'][] = array(
                            'voucher_theme_id'   => $result['voucher_theme_id'],
                            'is_deleted'         => $result['is_deleted'],
                            'name' 		 => $result['name'],
                            'edit'               =>base_url('sales/voucher_themes/edit'.$url.'/'.$this->commons->encode($result['voucher_theme_id']))
                    );
            }
		
            if (isset($this->error['warning'])) {
                    $this->data['error_warning'] = $this->error['warning'];
            } else {
                    $this->data['error_warning'] = '';
            }

            if ($this->session->userdata('success')!==NULL) {
                    $this->data['success'] = $this->session->userdata('success');

                    $this->session->set_userdata('success','');
            } else {
                    $this->data['success'] = '';
            }
		
            if ($this->input->post('selected') !==NULL) {
                    $this->data['selected'] = (array)$this->input->post('selected');
            } else {
                    $this->data['selected'] = array();
            }
            //print_r($this->data);
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/sales/voucher_themes_list";
            $this->load->view($content_page,$this->data);
		
	}
	
	/**
	* 
	* @function name : add()
	* @description   : load VoucherThemes Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function add()	
        {	
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
                
                $this->voucher_themes->addVoucherThemes();
                $this->session->set_userdata('success',$this->lang->line('text_success'));

                // Generate back url
                $url = '';

                if ($this->uri->segment(4)!==NULL) {
                    $url .= '/'.$this->uri->segment(4);
                }
                else
                {
                    $url .= '/name';
                }
				
                if ($this->uri->segment(5)!==NULL) {
                    $url .= '/'.$this->uri->segment(5);
                }
                else
                {
                    $url .= '/ASC';
                }
                if ($this->uri->segment(6)!==NULL) {
                    $url .= '/'.$this->uri->segment(6);
                }
                else
                {
                    $url .= '/0';
                }
                if ($this->uri->segment(7)!==NULL) {
                    $url .= '/'.$this->uri->segment(7);
                }
                redirect('sales/voucher_themes');
	    }
            $this->getForm();
	}
	
	/**
	* 
	* @function name : edit()
	* @description   : edit VoucherThemes records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'name', $sort_order = 'ASC', $offset = 0)
	{	
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				 
                

                // Generate back url
                $url = '';
		
                if ($this->uri->segment(4)!==NULL) {
                    $url .= '/'.$this->uri->segment(4);
                }
                else
                {
                    $url .= '/name';
                }
				
                if ($this->uri->segment(5)!==NULL) {
                    $url .= '/'.$this->uri->segment(5);
                }
                else
                {
                    $url .= '/ASC';
                }
                if ($this->uri->segment(6)!==NULL) {
                    $url .= '/'.$this->uri->segment(6);
                }
                else
                {
                    $url .= '/0';
                }
		
                if ($this->input->post('is_deleted') == 1) {
                    $res = $this->validateSoftDelete($this->input->post('voucher_theme_id'));
                    if($res==0)
                    {
                        $this->session->set_userdata('error',$this->error['warning']);
                        redirect('sales/voucher_themes/edit'.$url.'/'.$this->commons->encode($this->input->post('voucher_theme_id')));  
                    }
                } 
                $this->voucher_themes->editVoucherThemes();
                $this->session->set_userdata('success',$this->lang->line('text_success'));
                
                redirect('sales/voucher_themes/index'.$url);
	    }
            $this->getForm();
	}
	
	/**
	* 
	* @function name : delete()
	* @description   : perminant delete records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function delete()
	{
		 
            if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
            {
				 
                foreach ($this->input->post('selected') as $voucher_theme_id) 
                {
					 
					
                    $this->voucher_themes->delete($voucher_theme_id);
                }

                $this->session->set_userdata('success',$this->lang->line('text_success'));
               $this->index();
            }
            else
            {
				 
                $this->index();
            }
	}
	
	/**
	* 
	* @function name : softDeleteVoucherThemes()
	* @description   : soft Delete Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function softDelete()
	{
            if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
            {
                foreach ($this->input->post('selected') as $voucher_theme_id) 
                {
                    $this->voucher_themes->softDelete($voucher_theme_id);
                }

                $this->session->set_userdata('success',$this->lang->line('text_success'));
                
            }
            $this->index();
	}
	
	
	/**
	* 
	* @function name : getForm()
	* @description   : Generate Form for Add and Edit Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function getForm()
	{

            // Transaction Status
            if (isset($this->error['warning']) || $this->session->userdata('error')!==NULL) {
                if ($this->session->userdata('error')!==NULL)
                { 
                    //echo "Error".$this->session->userdata('error'); exit;
                    $this->error['warning'] = $this->session->userdata('error');
                }
                $this->data['error'] = $this->error['warning'];
                $this->session->set_userdata('error','');
            } else {
                $this->data['error'] = '';
            }

            if ($this->session->userdata('success')!==NULL) {
                $this->data['success'] = $this->session->userdata('success');

                $this->session->set_userdata('success','');
            } else {
                $this->data['success'] = '';
            }
		
            // Generate back url
            $url = '';

            if ($this->uri->segment(4)!==NULL) {
                $url .= '/'.$this->uri->segment(4);
            }
            else
            {
                $url .= '/name';
            }
		
            if ($this->uri->segment(5)!==NULL) {
                $url .= '/'.$this->uri->segment(5);
            }
            else
            {
                $url .= '/ASC';
            }
            if ($this->uri->segment(6)!==NULL) {
                $url .= '/'.$this->uri->segment(6);
            }
            else
            {
                $url .= '/0';
            }
            
            // breadcrumbs
            $this->data['breadcrumbs']   	= array();
            $this->data['breadcrumbs'][] 	= array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),

            );
            $this->data['breadcrumbs'][] = array(
              'text' => 'Voucher Themes',
              'href' => base_url('sales/voucher_themes'),

            );
		 
            // Add or Edit Transaction
            $count = $this->uri->total_segments();
            $method = $this->uri->segment(3);
            if ($method=='add') 
            {
                $this->data['form_action'] = base_url('sales/voucher_themes/add'.$url);
                $this->data['voucher_theme_id'] = '';
                $this->data['text_form'] = $this->lang->line('text_add');
                //echo "1";
            } 
            else 
            {
                $this->data['form_action'] = base_url('sales/voucher_themes/edit'.$url.'/'.$this->uri->segment($count));

                $this->data['voucher_theme_id'] = $this->commons->decode($this->uri->segment($count));
                $this->data['text_form'] = $this->lang->line('text_edit');
            }
            //$this->data['refresh'] 		= base_url('sales/voucher_themes/refresh');
            $this->data['cancel'] 		= base_url('sales/voucher_themes/index'.$url);
			 
            // Set Value Back
            if (1) 
            {
                $VoucherThemes_info = $this->voucher_themes->getVoucherThemesById($this->commons->decode($this->uri->segment($count)));
            }
			
			 
			
            if ($this->input->post('name')!==NULL) {
                $this->data['name'] = $this->input->post('name');
            } elseif (!empty($VoucherThemes_info)) {

                $this->data['name'] = $VoucherThemes_info['name'];
            } else {
                $this->data['name'] = '';
            }

			//====Start Code: Call image model for resize the image
            $this->load->model('tool/image'); 
			if  (($this->input->post('image')) !== NULL)
			{

				$this->data['config_image'] = $this->input->post('image');
				if(is_file(DIR_IMAGE . $this->input->post('image')))
				{
					
				$this->data['thumb'] = $this->image->resize($this->input->post('image'), 100, 100);
				}
				else
				{
					 $this->data['thumb'] = $this->image->resize('no_image-100x100.png', 100, 100);
				}
				
		    } elseif (!empty($VoucherThemes_info)) {

			$this->data['config_image'] = $VoucherThemes_info['image'];
				if(is_file(DIR_IMAGE . $VoucherThemes_info['image'])){
					$this->data['thumb'] = $this->image->resize($VoucherThemes_info['image'], 100, 100);
				}
				else
				{
					 $this->data['thumb'] = $this->image->resize('no_image-100x100.png', 100, 100);
				}
		   } else {

			$this->data['config_image'] = '';
			$this->data['thumb'] = $this->image->resize('no_image-100x100.png', 100, 100);
		   }
			 
             //====End Code: Call image model for resize the image
	 

            $this->data['placeholder'] = $this->image->resize('no_image-100x100.png', 100, 100);
			
           
		
           if ($this->input->server('REQUEST_METHOD') == 'POST')
            {
                if($this->input->post('is_deleted')==1)
                {
                    $this->data['is_deleted'] = $this->input->post('is_deleted'); 
                }else {
                    $this->data['is_deleted'] = 0;
                }
            } elseif (!empty($VoucherThemes_info)) {
		$this->data['is_deleted'] = $VoucherThemes_info['is_deleted'];
            } else {
		$this->data['is_deleted'] = 0;
            }
            
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/sales/voucher_themes";
            $this->load->view($content_page,$this->data);
	}
	
	/**
	* 
	* @function name : validateForm()
	* @description   : Validate Entered Form data
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateForm()
	{
		 $validation = array(
                            array(
                                'field'     => 'name',
                                'label'     => 'Voucher Themes Name', 
                                'rules'     =>'trim|required|min_length[3]|max_length[32]|xss_clean|callback_check_exists_name', 
                                'errors'    => array('required' => '%s must be between 3 and 32 characters!','min_length'=>'%s must be between 3 and 32 characters!','max_length'=>'%s must be between 3 and 32 characters!','check_exists_name'=>'%s already exists!')
					    ),
						
						 array(
                                'field'     => 'image',
                                'label'     => 'Image', 
                                'rules'     => 'required', 
                                'errors'    => array('required' => '%s required!')
					    ),
					     
					);
			$this->form_validation->set_rules($validation);
			if ($this->form_validation->run() == FALSE) {
				return FALSE;
			}else{
				return TRUE;
			}
	}
	
        /**
	* 
	* @function name : validateDelete()
	* @description   : Check voucher_themes relation for delete
	* @param         : void
	* @return        : void
	*
	*/
	 

        public function validateDelete() 
	{	
		$this->load->model('sales/gift_vouchers_model');
		foreach ($this->input->post('selected') as $theme_id) 
		{
			$voucher_total = $this->gift_vouchers_model->getTotalVouchersByVoucherThemeId($theme_id);

			if ($voucher_total) 
			{			
				$this->error['warning'] = $this->lang->line('error_default').'('.$voucher_total.')!';
			}
		}
		return !$this->error;
	}
        
        /**
	* 
	* @function name : validateSoftDelete()
	* @description   : Check voucher_themes relation for delete
	* @param         : void
	* @return        : void
	*
	*/
	 

        public function validateSoftDelete($theme_id) 
	{	
            $this->load->model('sales/gift_vouchers_model');
		
            $voucher_total = $this->gift_vouchers_model->getTotalVouchersByVoucherThemeId($theme_id);

            if ($voucher_total) 
            {			
                $this->error['warning'] = $this->lang->line('error_default').'('.$voucher_total.')!';
            }
		
            return !$this->error;
	}
	
    /**
    * 
    * @function name    : check_exists_name()
    * @description      : Validate for voucher themes name existing or not
    * @access           : public
    * @param            : void
    * @return           : boolean
    *
    */
    function check_exists_name($str)
    {
        $this->db->from('voucher_theme');
        $this->db->where('LOWER(name)',strtolower($str));
        if($this->input->post('voucher_theme_id') !="")
        {
            $this->db->where('voucher_theme_id !=',$this->input->post('voucher_theme_id'));
        }
        $query=$this->db->get();
        $row = $query->num_rows();
        if($row > 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        } 
    } 

        
	 
	
}
