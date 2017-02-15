<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Zone
* @Auther       : Mitesh
* @Date         : 07-11-2016
* @Description  : State Related Collection of functions
*
*/

class Zone extends CI_Controller {

	private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('system/zone_model','zone');
		
		$this->lang->load('system/zone_lang', 'english');
		
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
		$this->output->set_template('admin_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Zone','sarpo','This is srapo Zone page');
		

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load zone view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'state_name', $sort_order = 'ASC', $offset = 0)	
	{
		// breadcrumbs
		$this->data['add'] 			 = base_url('system/zone/add');
		if($this->session->userdata('role_id')== 1)
		{
			$this->data['delete'] 		= base_url('system/zone/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('system/zone/softDelete');
		}
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		  
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Zones',
		   'href' => base_url('system/zone'),
		 
		  );
		  
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("system/zone/index/$sort_by/$sort_order");
		$total_records = $this->zone->getTotalZones();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->zone->getZones($data);		
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
			$url .= '/state_name';
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
				'state_id'                  => $result['state_id'],
				'country_id'   			    => $result['country_id'],
				'country_name'   			=> $result['country_name'],
				'state_name'                => $result['state_name'] . (($result['state_id'] == $this->common->config('config_zone_id')) ? $this->lang->line('text_default_b') : null),	
				'state_code'                => $result['state_code'],
                                'is_deleted'                => $result['is_deleted'],
				'date_modified' 		    => date($this->common->config('config_date_format'), strtotime($result['date_modified'])),
				'edit'          		    => base_url('system/zone/edit'.$url.'/'.$this->commons->encode($result['state_id']))
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
		$content_page="themes/".$admin_theme."/system/zone_list";
		$this->load->view($content_page,$this->data);
	
	}
	
	/**
	* 
	* @function name : add()
	* @description   : load zone Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	
	public function add()	{
				
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
		
				$this->zone->addZone();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/state_name';
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
				redirect('system/zone/');
	     }
		$this->getForm();
	}
	
	/**
	* 
	* @function name : edit()
	* @description   : edit zone records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'state_name', $sort_order = 'ASC', $offset = 0)
	{
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				 	
                    // Generate back url
                    $url = '';

                    if ($this->uri->segment(4)!==NULL) {
                            $url .= '/'.$this->uri->segment(4);
                    }
                    else
                    {
                            $url .= '/state_name';
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
                        $res = $this->validateSoftDelete($this->input->post('state_id'));
                        if($res==0)
                        {
                            $this->session->set_userdata('error',$this->error['warning']);
                            redirect('system/zone/edit'.$url.'/'.$this->commons->encode($this->input->post('state_id')));  
                        }
                    } 
                    $this->zone->editZone();
                    $this->session->set_userdata('success',$this->lang->line('text_success'));
				
                    redirect('system/zone/index'.$url);
				
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
		//echo "delete"; die();
		if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
		{
			foreach ($this->input->post('selected') as $zone_id) 
			{
				//echo $country_id;
				$this->zone->deleteZone($zone_id);
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
	* @function name : softDelete()
	* @description   : soft Delete Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function softDelete()
	{		
		if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
		{
			foreach ($this->input->post('selected') as $state_id) 
			{
				$this->zone->softDeleteZone($state_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success'));
			$this->index();
		}
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
		$this->load->model('system/country_model','country');
		$this->data['country_name']=$this->country->getCountries();
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
			$url .= '/state_name';
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
		   'text' => 'Zones',
		   'href' => base_url('system/zone'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{
			$this->data['form_action'] = base_url('system/zone/add'.$url);
			$this->data['state_id'] = '';
			$this->data['text_form'] 		= $this->lang->line('text_add');
		} 
		else 
		{
			$this->data['form_action'] = base_url('system/zone/edit'.$url.'/'.$this->uri->segment($count));
			
			$this->data['state_id'] = $this->commons->decode($this->uri->segment($count));
			$this->data['text_form'] 		= $this->lang->line('text_edit');
		}
		$this->data['cancel'] 		= base_url('system/zone/index'.$url);
		
		// Set Value Back
		if (1) 
		{
			$zone_info = $this->zone->getZone($this->commons->decode($this->uri->segment($count)));
		}
		//echo '<pre>';print_r($zone_info);
		
		if ($this->input->post('zone_name')!==NULL) {
			$this->data['zone_name'] = $this->input->post('zone_name');
		} elseif (!empty($zone_info)) {
			
			$this->data['zone_name'] = $zone_info['state_name'];
		} else {
			$this->data['zone_name'] = '';
		}
		
		if ($this->input->post('zone_code')!==NULL) {
			$this->data['zone_code'] = $this->input->post('zone_code');
		} elseif (!empty($zone_info)) {
			$this->data['zone_code'] = $zone_info['state_code'];
		} else {
			$this->data['zone_code'] = '';
		}		
		
		if ($this->input->post('country_id')!==NULL) {
			$this->data['country_id'] = $this->input->post('country_id');
		} elseif (!empty($zone_info)) {
			$this->data['country_id'] = $zone_info['country_id'];
		} else {
			$this->data['country_id'] = '';
		}
		
		if ($this->input->post('status')!==NULL)
                {
			$this->data['status'] = $this->input->post('status');
		} elseif (!empty($zone_info)) {
			$this->data['status'] = $zone_info['status'];
		} else {
			$this->data['status'] = 0;
		}
		
                if ($this->input->server('REQUEST_METHOD') == 'POST')
                {
                    if($this->input->post('is_deleted')==1)
                    {
                       $this->data['is_deleted'] = $this->input->post('is_deleted'); 
                    }else {
                         $this->data['is_deleted'] = 0;
                    }
		} elseif (!empty($zone_info)) {
			$this->data['is_deleted'] = $zone_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
		//echo '<pre>'.$count;print_r($this->data);die;
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/system/zone";
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
					        'field' => 'zone_name',
					        'label' => 'Zone Name', 
					        'rules' => 'trim|required|min_length[3]|max_length[128]|xss_clean|callback_check_exists_zone_name', 
					        'errors' => array('required' => '%s must be between 3 and 128 characters!','min_length'=>'%s must be between 3 and 128 characters!','max_length'=>'%s must be between 3 and 128 characters!','check_exists_zone_name'=>'%s already exists!')
					    )			   
					   
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
	* @description   : Check zone relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{
            $this->load->model('customers/customers_model');
            
            foreach ($this->input->post('selected') as $zone_id) 
            {
                if ($this->common->config('config_zone_id') == $zone_id) 
                {
                    $this->error['warning'] = $this->lang->line('error_default');
                }
                
                $address_total = $this->customers_model->getTotalAddressesByZoneId($zone_id);
                if ($address_total)
                {
                   $this->error['warning'] = $this->lang->line('error_address').'('.$address_total.')'; 
                }
            }
            return !$this->error;
	}
        
        /**
	* 
	* @function name : validateSoftDelete()
	* @description   : Check zone relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateSoftDelete($zone_id) 
	{
            $this->load->model('customers/customers_model');
            
            
            if ($this->common->config('config_zone_id') == $zone_id) 
            {
                $this->error['warning'] = $this->lang->line('error_default');
            }

            $address_total = $this->customers_model->getTotalAddressesByZoneId($zone_id);
            if ($address_total)
            {
               $this->error['warning'] = $this->lang->line('error_address').'('.$address_total.')'; 
            }
            
            return !$this->error;
	}
	/**
    * 
    * @function name    : check_exists_zone_name()
    * @description      : Validate for zone name existing or not
    * @access           : public
    * @param            : void
    * @return           : boolean
    *
    */
    function check_exists_zone_name($str)
    {
        $this->db->from('state');
        $this->db->where('LOWER(state_name)',strtolower($str));
        $this->db->where('is_deleted=0');
        if($this->input->post('state_id') !="")
        {
            $this->db->where('state_id !=',$this->input->post('state_id'));
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
