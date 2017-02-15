<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Country
* @Auther       : Mitesh
* @Date         : 07-11-2016
* @Description  : country Related Collection of functions
*
*/

class Country extends CI_Controller {

	private $data=array();
	private $error = array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->_init();

		$this->load->model('system/country_model','country');
		
		$this->lang->load('system/country_lang', 'english');
		
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
		$this->output->set_common_meta('Countries','sarpo','This is srapo Countries page');
		

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load country view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'country_name', $sort_order = 'ASC', $offset = 0)	
	{
		// breadcrumbs
		$this->data['add'] 			 = base_url('system/country/add');
		if($this->session->userdata('role_id')== 1)
		{
			$this->data['delete'] 		= base_url('system/country/delete');
		}
		else
		{
			$this->data['delete'] 		= base_url('system/country/softDelete');
		}
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		  
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Countries',
		   'href' => base_url('system/country'),
		 
		  );
		  
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("system/country/index/$sort_by/$sort_order");
		$total_records = $this->country->getTotalCountries();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->country->getCountries($data);
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
			$url .= '/title';
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
				'country_id'   			=> $result['country_id'],
				'country_name'          => $result['country_name'] . (($result['country_id'] == $this->common->config('config_country_id')) ? $this->lang->line('text_default_b') : null),
                                'iso_code_2'          	=> $result['iso_code_2'],	
				'iso_code'          	=> $result['iso_code'],	
                                'is_deleted'    => $result['is_deleted'],
				'date_modified' 		=> date($this->common->config('config_date_format'), strtotime($result['date_modified'])),
				'edit'          		=> base_url('system/country/edit'.$url.'/'.$this->commons->encode($result['country_id']))
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
		$content_page="themes/".$admin_theme."/system/country_list";
		$this->load->view($content_page,$this->data);

	}
	
	/**
	* 
	* @function name : add()
	* @description   : load country Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	
	public function add()	{
		
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
		
				$this->country->addCountry();
				$this->session->set_userdata('success',$this->lang->line('text_success'));
				
				// Generate back url
				$url = '';
		
				if ($this->uri->segment(4)!==NULL) {
					$url .= '/'.$this->uri->segment(4);
				}
				else
				{
					$url .= '/title';
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
				redirect('system/country/');
	     }
		$this->getForm();
	}
	
	/**
	* 
	* @function name : edit()
	* @description   : edit country records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'title', $sort_order = 'ASC', $offset = 0)
	{
		//echo "Hello";die();
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				 	
                    // Generate back url
                    $url = '';

                    if ($this->uri->segment(4)!==NULL) {
                            $url .= '/'.$this->uri->segment(4);
                    }
                    else
                    {
                            $url .= '/title';
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
                        $res = $this->validateSoftDelete($this->input->post('country_id'));
                        if($res==0)
                        {
                            $this->session->set_userdata('error',$this->error['warning']);
                            redirect('system/country/edit'.$url.'/'.$this->commons->encode($this->input->post('country_id')));  
                        }
                    }   
                    $this->country->editCountry();
                    $this->session->set_userdata('success',$this->lang->line('text_success'));
                    redirect('system/country/index'.$url);
				
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
			foreach ($this->input->post('selected') as $country_id) 
			{
				//echo $country_id;
				$this->country->deleteCountry($country_id);
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
			foreach ($this->input->post('selected') as $country_id) 
			{
				$this->country->softDeleteCountry($country_id);
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
			$url .= '/title';
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
		   'text' => 'Countries',
		   'href' => base_url('system/country'),
		 
		  );
		 
		// Add or Edit Transaction
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='add') 
		{
			$this->data['form_action'] = base_url('system/country/add'.$url);
			$this->data['country_id'] = '';
			$this->data['text_form'] 		= $this->lang->line('text_add');
		} 
		else 
		{
			$this->data['form_action'] = base_url('system/country/edit'.$url.'/'.$this->uri->segment($count));
			
			$this->data['country_id'] = $this->commons->decode($this->uri->segment($count));
			$this->data['text_form'] 		= $this->lang->line('text_edit');
		}
		$this->data['cancel'] 		= base_url('system/country/index'.$url);
		
		// Set Value Back
		if (1) 
		{
			$country_info = $this->country->getCountry($this->commons->decode($this->uri->segment($count)));
		}
		//echo '<pre>';print_r($country_info);
		
		if ($this->input->post('country_name')!==NULL) {
			$this->data['country_name'] = $this->input->post('country_name');
		} elseif (!empty($country_info)) {
			
			$this->data['country_name'] = $country_info['country_name'];
		} else {
			$this->data['country_name'] = '';
		}
		
                if ($this->input->post('iso_code_2')!==NULL) {
			$this->data['iso_code_2'] = $this->input->post('iso_code_2');
		} elseif (!empty($country_info)) {
			$this->data['iso_code_2'] = $country_info['iso_code_2'];
		} else {
			$this->data['iso_code_2'] = '';
		}	

		if ($this->input->post('iso_code')!==NULL) {
			$this->data['iso_code'] = $this->input->post('iso_code');
		} elseif (!empty($country_info)) {
			$this->data['iso_code'] = $country_info['iso_code'];
		} else {
			$this->data['iso_code'] = '';
		}		
		
		if ($this->input->post('status')!==NULL)
                {
			$this->data['status'] = $this->input->post('status');
		} elseif (!empty($country_info)) {
			$this->data['status'] = $country_info['status'];
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
		} elseif (!empty($country_info)) {
			$this->data['is_deleted'] = $country_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
		//echo '<pre>'.$count;print_r($this->data);die;
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/system/country";
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
					        'field' => 'country_name',
					        'label' => 'Country Name', 
					        'rules' => 'trim|required|min_length[3]|max_length[128]|xss_clean|callback_check_exists_country_name', 
					        'errors' => array('required' => '%s must be between 3 and 128 characters!','min_length'=>'%s must be between 3 and 128 characters!','max_length'=>'%s must be between 3 and 128 characters!','check_exists_country_name'=>'%s already exists!')
					    ),
                                            array(
					        'field' => 'iso_code_2',
					        'label' => 'ISO Code 2', 
					        'rules' => 'trim|required|exact_length[2]|xss_clean|callback_check_exists_country_iso_code_2', 
					        'errors' => array('required' => '%s must contain 2 characters!!','exact_length'=>'%s must contain 2 characters!!','check_exists_country_iso_code_2'=>'%s already exists!')
					    ),
					    array(
					        'field' => 'iso_code',
					        'label' => 'ISO Code', 
					        'rules' => 'trim|required|exact_length[3]|xss_clean|callback_check_exists_country_iso_code', 
					        'errors' => array('required' => '%s must contain 3 characters!!','exact_length'=>'%s must contain 3 characters!!','check_exists_country_iso_code'=>'%s already exists!')
					    )
					   
					);
					$this->form_validation->set_rules($validation);
			if ($this->form_validation->run() == FALSE) {
				//echo '1';die;
				return FALSE;
			}else{
				//echo '2';die;
				return TRUE;
			}
	}
	
	/**
	* 
	* @function name : validateDelete()
	* @description   : Check country relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateDelete() 
	{
            $this->load->model('customers/customers_model');
            $this->load->model('system/zone_model');
            
            foreach ($this->input->post('selected') as $country_id) 
            {			
                if ($this->common->config('config_country_id') == $country_id) 
                {      
                    $this->error['warning'] = $this->lang->line('error_default');
                }
                
                $address_total = $this->customers_model->getTotalAddressesByCountryId($country_id);
                if ($address_total)
                {
                    $this->error['warning'] = $this->lang->line('error_address').'('.$address_total.')';
                }
                
                $zone_total = $this->zone_model->getTotalZonesByCountryId($country_id);
                if ($zone_total)
                {
                    $this->error['warning'] = $this->lang->line('error_zone').'('.$zone_total.')';
                }
            }
            return !$this->error;
	}
        
        /**
	* 
	* @function name : validateSoftDelete()
	* @description   : Check country relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateSoftDelete($country_id) 
	{
            $this->load->model('customers/customers_model');
            $this->load->model('system/zone_model');
            
            			
            if ($this->common->config('config_country_id') == $country_id) 
            {      
                $this->error['warning'] = $this->lang->line('error_default');
            }

            $address_total = $this->customers_model->getTotalAddressesByCountryId($country_id);
            if ($address_total)
            {
                $this->error['warning'] = $this->lang->line('error_address').'('.$address_total.')';
            }

            $zone_total = $this->zone_model->getTotalZonesByCountryId($country_id);
            if ($zone_total)
            {
                $this->error['warning'] = $this->lang->line('error_zone').'('.$zone_total.')';
            }
            
            return !$this->error;
	}
	 /**
    * 
    * @function name    : check_exists_country_name()
    * @description      : Validate for country name existing or not
    * @access           : public
    * @param            : void
    * @return           : boolean
    *
    */
    function check_exists_country_name($str)
    {
        $this->db->from('country');
        $this->db->where('LOWER(country_name)',strtolower($str));
        $this->db->where('is_deleted=0');
        if($this->input->post('country_id') !="")
        {
            $this->db->where('country_id !=',$this->input->post('country_id'));
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
    /**
    * 
    * @function name    : check_exists_country_iso_code()
    * @description      : Validate for country ISO code existing or not
    * @access           : public
    * @param            : void
    * @return           : boolean
    *
    */
    function check_exists_country_iso_code($str)
    {
        $this->db->from('country');
        $this->db->where('LOWER(iso_code)',strtolower($str));
        $this->db->where('is_deleted=0');
        if($this->input->post('country_id') !="")
        {
            $this->db->where('country_id !=',$this->input->post('country_id'));
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
    /**
    * 
    * @function name    : check_exists_country_iso_code_2()
    * @description      : Validate for country ISO code 2 existing or not
    * @access           : public
    * @param            : void
    * @return           : boolean
    *
    */
    function check_exists_country_iso_code_2($str)
    {
        $this->db->from('country');
        $this->db->where('iso_code_2',strtoupper($str));
        $this->db->where('is_deleted=0');
        if($this->input->post('country_id') !="")
        {
            $this->db->where('country_id !=',$this->input->post('country_id'));
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
                'zone'              => $this->zone_model->getZoneByCountryId($this->input->post('country_id')),
                'status'            => $country_info['status']  
            );
        }
        
        $sort_order = array();

        echo json_encode($json);
    }
    public function country() 
	{
		$this->output->unset_template();
		$json = array();

		$country_info = $this->country->getCountry($this->input->post('country_id'));

		if ($country_info) {
			 $this->load->model('system/zone_model');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['country_name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code'          => $country_info['iso_code'],
				'postcode_required' => 1,
				'zone'              => $this->zone_model->getZoneByCountryId($this->input->post('country_id')),
				'status'            => $country_info['status']
			);
		}

		echo json_encode($json);
	}	
	
}
