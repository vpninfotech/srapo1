<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Stock_status
* @Auther       : Indrajit
* @Date         : 09-11-2016
* @Description  : Admin Stock_status Related Collection of functions
*
*/

class Stock_status extends CI_Controller 
{

	private $data=array();
	private $error = array();

	function __construct()
	{
            parent::__construct();

            $this->_init();
			
			$this->rbac->CheckAuthentication();
			
            $this->load->model('system/stock_status_model','stock_status');
            
            $this->lang->load('system/stock_status_lang', 'english');

            $this->load->model('common');

            $this->load->library('commons');

            $this->load->library('pagination');
	}
	
	/**
	* 
	* @function name : _init()
	* @description   : initialize required resources in this view
	* @param   	 : void
	* @return        : void
	*
	*/
	private function _init() 
	{
		//--Set Template
		$this->output->set_template('admin_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Stock Status','sarpo','This is srapo Stock Status page');
	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Stock_status view
	* @param         : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'stock_status_name', $sort_order = 'ASC', $offset = 0) 
	{
            
            // breadcrumbs
            $this->data['add']              = base_url('system/stock_status/add');
            
            if($this->session->userdata('role_id')== 1) 
			{
                $this->data['delete']       = base_url('system/stock_status/delete');
            } 
			else 
			{
                $this->data['delete']       = base_url('system/stock_status/softDelete');
            }
            
            //$this->data['refresh']          = base_url('system/stock_status/refresh');
            $this->data['breadcrumbs']      = array();
            $this->data['breadcrumbs'][]    = array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),
            );

            $this->data['breadcrumbs'][] = array(
               'text' => 'Currencies',
               'href' => base_url('system/stock_status'),
            );
                
            //	pagination
            $limit = $this->common->config('config_limit_admin');
            $data = array(
                'sort' => $sort_by,
                'order'=> $sort_order,
                'start'=> $offset,
                'limit'=> $limit
            );
		
            $url = base_url("system/stock_status/index/$sort_by/$sort_order");
            $total_records = $this->stock_status->getTotalStockStatus();
            $config =$this->commons->pagination($url,$total_records,$limit);
            $this->pagination->initialize($config);
            $config['uri_segment'] = 6;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['sort_by'] = $sort_by;
            $this->data['sort_order'] = $sort_order;
            $results = $this->stock_status->getStockStatuses($data);
            $this->data['pages'] = ceil($total_records/$limit);
            $this->data['totals'] = ceil($total_records);
            $this->data['range'] = ceil($offset+1);
		
            $url='';
            if ($this->uri->segment(4)!==NULL) 
			{
                $url .= '/'.$this->uri->segment(4);
            } 
			else 
			{
                $url .= '/title';
            }

            if ($this->uri->segment(5)!==NULL) 
			{
                $url .= '/'.$this->uri->segment(5);
            } 
			else 
			{
                $url .= '/ASC';
            }
            if ($this->uri->segment(6)!==NULL) 
			{
                $url .= '/'.$this->uri->segment(6);
            } 
			else 
			{
                $url .= '/0';
            }
		
            foreach ($results as $result) 
			{
                $this->data['records'][] = array(
                    'stock_status_id'         => $result['stock_status_id'],
                    'stock_status_name'       => $result['stock_status_name'],
                    'is_deleted'              => $result['is_deleted'],
                    'date_modified'           => date($this->common->config('config_date_format'), strtotime($result['date_modified'])),
                    'edit'                    =>base_url('system/stock_status/edit'.$url.'/'.$this->commons->encode($result['stock_status_id']))
                );
            }
		
            if (isset($this->error['warning'])) 
			{
                $this->data['error_warning'] = $this->error['warning'];
            } 
			else 
			{
                $this->data['error_warning'] = '';
            }

            if ($this->session->userdata('success')!==NULL) 
			{
                $this->data['success'] = $this->session->userdata('success');

                $this->session->set_userdata('success','');
            } 
			else 
			{
                $this->data['success'] = '';
            }
		
            if ($this->input->post('selected') !==NULL) 
			{
                $this->data['selected'] = (array)$this->input->post('selected');
            } 
			else 
			{
                $this->data['selected'] = array();
            }
            //print_r($this->data);
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/system/stock_status_list";
            $this->load->view($content_page,$this->data);
	}
        
	/**
	* 
	* @function name : add()
	* @description   : load stock_status Add view
	* @param   	 : void
	* @return        : void
	*
	*/
	public function add() 
	{
	
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
                $this->stock_status->addStockStatus();
                $this->session->set_userdata('success',$this->lang->line('text_success'));

                // Generate back url
                $url = '';

                if ($this->uri->segment(4)!==NULL) 
				{
                    $url .= '/'.$this->uri->segment(4);
                } 
				else 
				{
                    $url .= '/title';
                }

                if ($this->uri->segment(5)!==NULL) 
				{
                    $url .= '/'.$this->uri->segment(5);
                } 
				else 
				{
                    $url .= '/ASC';
                }
                if ($this->uri->segment(6)!==NULL) 
				{
                    $url .= '/'.$this->uri->segment(6);
                } 
				else 
				{
                    $url .= '/0';
                }
                if ($this->uri->segment(7)!==NULL) 
				{
                    $url .= '/'.$this->uri->segment(7);
                }
               
				redirect('system/stock_status/index'.$url);
            } 
            $this->getForm();
            
	}
        
        /**
	* 
	* @function name : edit()
	* @description   : edit stock_status records
	* @param         : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'title', $sort_order = 'ASC', $offset = 0) 
	{
		
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {

                
                // Generate back url
                $url = '';

                if ($this->uri->segment(4)!==NULL) 
				{
                    $url .= '/'.$this->uri->segment(4);
                } 
				else 
				{
                    $url .= '/title';
                }

                if ($this->uri->segment(5)!==NULL) 
				{
                    $url .= '/'.$this->uri->segment(5);
                } 
				else 
				{
                    $url .= '/ASC';
                }
                if ($this->uri->segment(6)!==NULL) 
				{
                    $url .= '/'.$this->uri->segment(6);
                } 
				else 
				{
                    $url .= '/0';
                }
                
                if ($this->input->post('is_deleted') == 1) {
                    $res = $this->validateSoftDelete($this->input->post('stock_status_id'));
                    if($res==0)
                    {
                        $this->session->set_userdata('error',$this->error['warning']);
                        redirect('system/stock_status/edit'.$url.'/'.$this->commons->encode($this->input->post('stock_status_id')));  
                    }
                } 
                $this->stock_status->editStockStatus();
                $this->session->set_userdata('success',$this->lang->line('text_success'));
                redirect('system/stock_status/index'.$url);
            } 
            $this->getForm(); 

            
	}
        
        /**
	* 
	* @function name : delete()
	* @description   : permanent delete records
	* @param         : void
	* @return        : void
	*
	*/
	public function delete() 
	{
            if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
			{
                foreach ($this->input->post('selected') as $stock_status_id) 
				{
                    $this->stock_status->deleteStockStatus($stock_status_id);
                }

                $this->session->set_userdata('success',$this->lang->line('text_success'));
                // Generate back url
                $url = '';

                if ($this->uri->segment(4)!==NULL) 
				{
                    $url .= '/'.$this->uri->segment(4);
                } 
				else 
				{
                    $url .= '/title';
                }

                if ($this->uri->segment(5)!==NULL) 
				{
                    $url .= '/'.$this->uri->segment(5);
                } 
				else 
				{
                    $url .= '/ASC';
                }
                if ($this->uri->segment(6)!==NULL) 
				{
                    $url .= '/'.$this->uri->segment(6);
                } 
				else 
				{
                    $url .= '/0';
                }
                redirect('system/stock_status/index'.$url);
            }
            $this->index();
	}
        
        /**
	* 
	* @function name : softDelete()
	* @description   : soft Delete Records
	* @param   	 : void
	* @return        : void
	*
	*/
	public function softDelete()
	{
            if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
			{
                foreach ($this->input->post('selected') as $stock_status_id) 
				{
                    $this->stock_status->softDeleteStockStatus($stock_status_id);
                }

                $this->session->set_userdata('success',$this->lang->line('text_success'));
                redirect('system/stock_status/index');
            }
            $this->index();

	}
        
        
        /**
	* 
	* @function name : getForm()
	* @description   : Generate Form for Add and Edit Records
	* @param   	 : void
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
		
            if ($this->session->userdata('success')!==NULL) 
			{
                $this->data['success'] = $this->session->userdata('success');

                $this->session->set_userdata('success','');
            } 
			else 
			{
                $this->data['success'] = '';
            }
		
            // Generate back url
            $url = '';

            if ($this->uri->segment(4)!==NULL) 
			{
                $url .= '/'.$this->uri->segment(4);
            }
			else 
			{
                $url .= '/stock_status_name';
            }

            if ($this->uri->segment(5)!==NULL)
			{
                $url .= '/'.$this->uri->segment(5);
            } 
			else 
			{
                $url .= '/ASC';
            }
            if ($this->uri->segment(6)!==NULL) 
			{
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
              'text' => 'Stock Statuses',
              'href' => base_url('system/stock_status'),

            );
		 
            // Add or Edit Transaction
            $count = $this->uri->total_segments();
            $method = $this->uri->segment(3);
            
            if ($method=='add') 
			{
                $this->data['form_action'] = base_url('system/stock_status/add'.$url);
                $this->data['stock_status_id'] = '';
				$this->data['text_form'] 		= $this->lang->line('text_add');
            } 
			else 
			{
                $this->data['form_action'] = base_url('system/stock_status/edit'.$url.'/'.$this->uri->segment($count));
                $this->data['stock_status_id'] = $this->commons->decode($this->uri->segment($count));
				$this->data['text_form'] 		= $this->lang->line('text_edit');
            }
            
            //$this->data['refresh'] 		= base_url('system/stock_status/refresh');
            $this->data['cancel'] 		= base_url('system/stock_status/index'.$url);
		
            // Set Value Back
            if (1) 
            {
                $stock_status_info = $this->stock_status->getStockStatus($this->commons->decode($this->uri->segment($count)));
            }
		
            if ($this->input->post('stock_status_name')!==NULL) 
			{
                    $this->data['stock_status_name'] = $this->input->post('stock_status_name');
            } 
			elseif (!empty($stock_status_info)) 
			{

                    $this->data['stock_status_name'] = $stock_status_info['stock_status_name'];
            } 
			else 
			{
                    $this->data['stock_status_name'] = '';
            }
		
            if ($this->input->server('REQUEST_METHOD') == 'POST')
            {
                if($this->input->post('is_deleted')==1)
                {
                    $this->data['is_deleted'] = $this->input->post('is_deleted'); 
                }else {
                    $this->data['is_deleted'] = 0;
                }
            } elseif (!empty($stock_status_info)) {
		$this->data['is_deleted'] = $stock_status_info['is_deleted'];
            } else {
		$this->data['is_deleted'] = 0;
            }
            //echo '<pre>'.$count;print_r($this->data);die;
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/system/stock_status";
            $this->load->view($content_page,$this->data);
	}
        
        /**
	* 
	* @function name 	: validateForm()
	* @description   	: Validate form data
	* @access 		: public
	* @param   		: void
	* @return        	: boolean
	*
	*/
	public function validateForm() 
	{
            $validation = array(
                            array(
                                'field'     => 'stock_status_name',
                                'label'     => 'Stock Status Name', 
                                'rules'     => 'trim|required|min_length[3]|max_length[32]|xss_clean|callback_check_exists_stock_status_name', 
                                'errors'    => array('required' => '%s must be between 3 and 32 characters!','min_length'=>'%s must be between 3 and 32 characters!','max_length'=>'%s must be between 3 and 32 characters!','check_exists_stock_status_name'=>'%s already exists!')
                            ),
                        );
                        $this->form_validation->set_rules($validation);
                        if ($this->form_validation->run() == FALSE) 
						{
                            return FALSE;
                        }
						else
						{
                            return TRUE;
                        }
	}
        
        /**
	* 
	* @function name : validateDelete()
	* @description   : Check stock_status relation for delete
	* @param         : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{
            $this->load->model('catalog/product_model');
            foreach ($this->input->post('selected') as $stock_status_id) 
            {
                $product_total = $this->product_model->getTotalProductsByStockStatusId($stock_status_id);
                if ($product_total) 
                {
                	$this->error['warning'] = $this->lang->line('error_product').$product_total;
                }
            }

		return !$this->error;
	}
        
        /**
	* 
	* @function name : validateSoftDelete()
	* @description   : Check stock_status relation for delete
	* @param         : void
	* @return        : void
	*
	*/
	public function validateSoftDelete($stock_status_id) 
	{
            $this->load->model('catalog/product_model');
            $product_total = $this->product_model->getTotalProductsByStockStatusId($stock_status_id);
            if ($product_total) 
            {
                $this->error['warning'] = $this->lang->line('error_product').$product_total;
            }            
            return !$this->error;
	}
        
    /**
    * 
    * @function name    : check_exists_stock_status_name()
    * @description      : Validate for stock status name existing or not
    * @access           : public
    * @param            : void
    * @return           : boolean
    *
    */
    function check_exists_stock_status_name($str)
    {
        $this->db->from('stock_status');
        $this->db->where('LOWER(stock_status_name)',strtolower($str));
        $this->db->where('is_deleted=0');
        if($this->input->post('stock_status_id') !="")
        {
            $this->db->where('stock_status_id !=',$this->input->post('stock_status_id'));
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
