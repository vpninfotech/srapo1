<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Return_reason
* @Auther       : Indrajit
* @Date         : 10-10-2016
* @Description  : Return Reason Related Collection of functions
*
*/

class Return_reason extends CI_Controller {

        private $data=array();
	private $error = array();

	function __construct()
	{
            parent::__construct();

            $this->_init();

            $this->rbac->CheckAuthentication();

            $this->load->model('system/return_reason_model','return_reason');
            
            $this->lang->load('system/return_reason_lang', 'english');

            $this->load->model('common');

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
	
	private function _init() 
        {	
            //--Set Template
            $this->output->set_template('admin_template');
            $admin_theme = $this->common->config('admin_theme');
            $this->output->set_common_meta('Return Reason','sarpo','This is srapo Return Reason page');
	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Return_reason view
	* @param         : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'return_reason_name', $sort_order = 'ASC', $offset = 0) 
        {
            
            // breadcrumbs
            $this->data['add']              = base_url('system/return_reason/add');
            
            if($this->session->userdata('role_id')== 1) 
            {
                $this->data['delete']       = base_url('system/return_reason/delete');
            } 
            else 
            {
                $this->data['delete']       = base_url('system/return_reason/softDelete');
            }
            
            //$this->data['refresh']          = base_url('system/return_reason/refresh');
            $this->data['breadcrumbs']      = array();
            $this->data['breadcrumbs'][]    = array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),
            );

            $this->data['breadcrumbs'][]    = array(
               'text' => 'Return Reasons',
               'href' => base_url('system/return_reason'),
            );
                
            //	pagination
            $limit = $this->common->config('config_limit_admin');
            $data = array(
                'sort' => $sort_by,
                'order'=> $sort_order,
                'start'=> $offset,
                'limit'=> $limit
            );
		
            $url = base_url("system/return_reason/index/$sort_by/$sort_order");
            $total_records = $this->return_reason->getTotalReturnReason();
            $config =$this->commons->pagination($url,$total_records,$limit);
            $this->pagination->initialize($config);
            $config['uri_segment'] = 6;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['sort_by'] = $sort_by;
            $this->data['sort_order'] = $sort_order;
            $results = $this->return_reason->getReturnReasons($data);
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
                $url .= '/return_reason_name';
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
                    'return_reason_id'               => $result['return_reason_id'],
                    'return_reason_name'             => $result['return_reason_name'],
                    'return_reason_date_modified'    => date($this->common->config('config_date_format'), strtotime($result['date_added'])),
                    'is_deleted'                     => $result['is_deleted'],
                    'edit'                           =>base_url('system/return_reason/edit'.$url.'/'.$this->commons->encode($result['return_reason_id']))
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
            $content_page="themes/".$admin_theme."/system/return_reason_list";
            $this->load->view($content_page,$this->data);
	}
	
        /**
	* 
	* @function name : add()
	* @description   : load return_reason Add view
	* @param   	 : void
	* @return        : void
	*
	*/
	public function add() 
        {
	
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) 
            {
                $this->return_reason->addReturnReason();
                $this->session->set_userdata('success',$this->lang->line('text_success'));

                // Generate back url
                $url = '';

                if ($this->uri->segment(4)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(4);
                } 
                else 
                {
                    $url .= '/return_reason_name';
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
                redirect('system/return_reason');
            }
            $this->getForm();
	}
        
        /**
	* 
	* @function name : edit()
	* @description   : edit return_reason records
	* @param         : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'return_reason_name', $sort_order = 'ASC', $offset = 0) 
        {
		
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) 
            {
                // Generate back url
                $url = '';

                if ($this->uri->segment(4)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(4);
                } 
                else
                {
                    $url .= '/return_reason_name';
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
                    $res = $this->validateSoftDelete($this->input->post('return_reason_id'));
                    if($res==0)
                    {
                        $this->session->set_userdata('error',$this->error['warning']);
                        redirect('system/return_reason/edit'.$url.'/'.$this->commons->encode($this->input->post('return_reason_id')));  
                    }
                }
                $this->return_reason->editReturnReason();
                $this->session->set_userdata('success',$this->lang->line('text_success'));
                redirect('system/return_reason/index'.$url);
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
	public function delete() {
            if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
            {
                foreach ($this->input->post('selected') as $return_reason_id) 
                {
                    $this->return_reason->deleteReturnReason($return_reason_id);
                }

                $this->session->set_userdata('success',$this->lang->line('text_success'));
                redirect('system/return_reason/index');
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
                foreach ($this->input->post('selected') as $return_reason_id) 
                {
                    $this->return_reason->softDeleteReturnReason($return_reason_id);
                }

                $this->session->set_userdata('success',$this->lang->line('text_success'));
                
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
                $url .= '/return_reason_name';
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
              'text' => 'Return Reasons',
              'href' => base_url('system/return_reason'),

            );
		 
            // Add or Edit Transaction
            $count = $this->uri->total_segments();
            $method = $this->uri->segment(3);
            
            if ($method=='add') 
            {
                $this->data['form_action'] = base_url('system/return_reason/add'.$url);
                $this->data['return_reason_id'] = '';
                $this->data['text_form'] = $this->lang->line('text_add');
            } 
            else 
            {
                $this->data['form_action'] = base_url('system/return_reason/edit'.$url.'/'.$this->uri->segment($count));
                $this->data['return_reason_id'] = $this->commons->decode($this->uri->segment($count));
                $this->data['text_form'] = $this->lang->line('text_edit');
            }
            
            //$this->data['refresh'] 		= base_url('system/return_reason/refresh');
            $this->data['cancel'] 		= base_url('system/return_reason/index'.$url);
		
            // Set Value Back
            if (1) 
            {
                $return_reason_info = $this->return_reason->getReturnReason($this->commons->decode($this->uri->segment($count)));
            }
		
            if ($this->input->post('return_reason_name')!==NULL) 
            {
                    $this->data['return_reason_name'] = $this->input->post('return_reason_name');
            } 
            elseif (!empty($return_reason_info)) 
            {

                    $this->data['return_reason_name'] = $return_reason_info['return_reason_name'];
            } 
            else 
            {
                    $this->data['return_reason_name'] = '';
            }
		
            if ($this->input->server('REQUEST_METHOD') == 'POST')
            {
                if($this->input->post('is_deleted')==1)
                {
                    $this->data['is_deleted'] = $this->input->post('is_deleted'); 
                }else {
                    $this->data['is_deleted'] = 0;
                }
            } elseif (!empty($return_reason_info)) {
		$this->data['is_deleted'] = $return_reason_info['is_deleted'];
            } else {
		$this->data['is_deleted'] = 0;
            }
            //echo '<pre>'.$count;print_r($this->data);die;
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/system/return_reason";
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
                                'field'     => 'return_reason_name',
                                'label'     => 'Return Reason Name', 
                                'rules'     => 'trim|required|min_length[4]|max_length[31]|xss_clean|callback_check_exists_return_reason_name', 
                                'errors'    => array('required' => '%s must be between 3 and 32 characters!','min_length'=>'%s must be between 3 and 32 characters!','max_length'=>'%s must be between 3 and 32 characters!','check_exists_return_reason_name'=>'%s already exists!')
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
	* @description   : Check return_reason relation for delete
	* @param         : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{
            $this->load->model('sales/returns_model');
            foreach ($this->input->post('selected') as $return_reason_id) 
            {  
                $return_total = $this->returns_model->getTotalReturnsByReturnReasonId($return_reason_id);
                if ($return_total) 
                {
                    $this->error['warning'] = $this->lang->line('error_return').'('.$return_total.')';
                }
            }
		return !$this->error;
	}
        
        /**
	* 
	* @function name : validateSoftDelete()
	* @description   : Check return_reason relation for delete
	* @param         : void
	* @return        : void
	*
	*/
	public function validateSoftDelete($return_reason_id) 
	{
            $this->load->model('sales/returns_model');
              
            $return_total = $this->returns_model->getTotalReturnsByReturnReasonId($return_reason_id);
            if ($return_total) 
            {
                $this->error['warning'] = $this->lang->line('error_return').'('.$return_total.')';
            }
            
            return !$this->error;
	}
     /**
    * 
    * @function name    : check_exists_return_reason_name()
    * @description      : Validate for return reason name existing or not
    * @access           : public
    * @param            : void
    * @return           : boolean
    *
    */
    function check_exists_return_reason_name($str)
    {
        $this->db->from('return_reason');
        $this->db->where('LOWER(return_reason_name)',strtolower($str));
        $this->db->where('is_deleted=0');
        if($this->input->post('return_reason_id') !="")
            
        {
            $this->db->where('return_reason_id !=',$this->input->post('return_reason_id'));
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
