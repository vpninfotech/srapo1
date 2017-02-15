<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Data_Operator Tickets
* @Auther       : Mitesh
* @Date         : 30-1-2017
* @Description  : Admin Tickets Operation
*
*/

class Tickets extends CI_Controller {

	private $data=array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();	

		$this->_init();
		
		$this->load->model('support/ticket_model', 'ticket');
		
		$this->lang->load('support/tickets_lang', 'english');
		
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
		$this->output->set_template('dataoperator_template');
		$admin_theme = $this->common->config('admin_theme');
		$this->output->set_common_meta('Data Operator Tickets','sarpo','This is srapo Data Operator Tickets page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load zone view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'ticket_id', $sort_order = 'ASC', $offset = 0)	
	{
		// action link
		$this->data['add'] 			= base_url('support/tickets/add');
		if($this->session->userdata('role_id')== 1)
		{
			$this->data['delete'] 	= base_url('support/tickets/delete');
		}
		else
		{
			$this->data['delete']	= base_url('support/tickets/softDelete');
		}
		
		// breadcrumbs
		$this->data['breadcrumbs']   	= array();
		$this->data['breadcrumbs'][] 	= array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		  
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Data Operator Tickets',
		   'href' => base_url('support/data_operator_tickets'),
		 
		  );
		  
		//	pagination
		$limit = $this->common->config('config_limit_admin');
		$data = array(
		'sort' => $sort_by,
		'order'=> $sort_order,
		'start'=> $offset,
		'limit'=> $limit
		);
		
		$url = base_url("support/data_operator_tickets/index/$sort_by/$sort_order");
		$total_records = $this->ticket->getTotalTickets();
		$config =$this->commons->pagination($url,$total_records,$limit);
		$this->pagination->initialize($config);
		$config['uri_segment'] = 6;
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['sort_by'] = $sort_by;
		$this->data['sort_order'] = $sort_order;
		$results = $this->ticket->getDataOperatorTickets($data);		
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
			$url .= '/ticket_id';
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
				'ticket_id'                 => $result['ticket_id'],
				'department_id'   			=> $result['department_id'],
				'customer_id'   			=> $result['customer_id'],
				'title'               		=> $result['title'],	
				'ticket_code'               => $result['ticket_code'],
				'priority'                	=> $result['priority'],
				'description'               => $result['description'],
                'is_deleted'                => $result['is_deleted'],
				'date_modified' 		    => date($this->common->config('config_date_format'), strtotime($result['date_modified'])),
				'edit'          		    => base_url('support/tickets/edit'.$url.'/'.$this->commons->encode($result['ticket_id']))
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
		$content_page="themes/".$admin_theme."/support/tickets_list";
		$this->load->view($content_page,$this->data);
	
	}
	
	/**
	* 
	* @function name : add()
	* @description   : load Ticket Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	
	public function add()
	{
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				$this->ticket->addTicket();
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
				redirect('support/tickets');
	     }
		$this->getForm();
	}
	
	/**
	* 
	* @function name : edit()
	* @description   : load ticket Edit view
	* @param   		 : void
	* @return        : void
	*
	*/
	
	public function edit()
	{
		if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				$this->ticket->editTicket();
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
				redirect('support/tickets');
	     }
		$this->getForm();
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
			$url .= '/ticket_id';
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
		   'text' => 'Tickets',
		   'href' => base_url('support/tickets'),
		 
		  );
		 
		$count = $this->uri->total_segments();
		$method = $this->uri->segment(3);
		if ($method=='edit') 
		{
			$this->data['form_action'] = base_url('support/tickets/edit'.$url.'/'.$this->uri->segment($count));
			
			$this->data['ticket_id'] = $this->commons->decode($this->uri->segment($count));
			$this->data['text_form'] 		= $this->lang->line('text_edit');
		}
		else
		{
			$this->data['form_action'] = base_url('support/tickets/add'.$url);
			$this->data['ticket_id'] = '';
			$this->data['text_form'] 		= $this->lang->line('text_add');
		}
		$this->data['cancel'] 		= base_url('support/tickets');
		
		// Set Value Back
		if (1) 
		{
			$ticket_info = $this->ticket->getTicketDetails($this->commons->decode($this->uri->segment($count)));
		}
		/*echo '<pre>';print_r($ticket_info);
		exit;*/
		if ($this->input->post('user_type')!==NULL) {
			$this->data['user_type'] = $this->input->post('user_type');
		} elseif (!empty($ticket_info)) {
			
			$this->data['user_type'] = $ticket_info['department_id'];
		} else {
			$this->data['user_type'] = '';
		}
		
		/*if ($this->input->post('customer_id')!==NULL) {
			$this->data['customer_id'] = $this->input->post('customer_id');
		} else*/if (!empty($ticket_info)) {
			
			$this->data['customer_id'] = $ticket_info['customer_id'];
		} else {
			$this->data['customer_id'] = '';
		}
		
		if ($this->input->post('user_list')!==NULL) {
			$this->data['user_list'] = $this->input->post('user_list');
		} elseif (!empty($ticket_info)) {
			$this->data['user_list'] = $ticket_info['customer_id'];
		} else {
			$this->data['user_list'] = '';
		}		
		
		if ($this->input->post('Title')!==NULL) {
			$this->data['Title'] = $this->input->post('Title');
		} elseif (!empty($ticket_info)) {
			$this->data['Title'] = $ticket_info['title'];
		} else {
			$this->data['Title'] = '';
		}
		
		if ($this->input->post('Priority')!==NULL)
        {
			$this->data['Priority'] = $this->input->post('Priority');
		} elseif (!empty($ticket_info)) {
			$this->data['Priority'] = $ticket_info['priority'];
		} else {
			$this->data['Priority'] = '';
		}
		
		if ($this->input->post('Description')!==NULL)
        {
			$this->data['Description'] = $this->input->post('Description');
		} elseif (!empty($ticket_info)) {
			$this->data['Description'] = $ticket_info['description'];
		} else {
			$this->data['Description'] = '';
		}
		
		if ($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$this->data['is_deleted'] = $this->input->post('is_deleted');
			/*if($this->input->post('is_deleted')==1)
			{
			   $this->data['is_deleted'] = $this->input->post('is_deleted'); 
			}else {
				 $this->data['is_deleted'] = 0;
			}*/
		} elseif (!empty($ticket_info)) {
			$this->data['is_deleted'] = $ticket_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
		
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/support/add_ticket";
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
					        'field' => 'Title',
					        'label' => 'Title', 
					        'rules' => 'trim|required|xss_clean', 
					        'errors' => array('required' => 'Please Provide %s!')
					    ),
						 array(
					        'field' => 'Priority',
					        'label' => 'Priority', 
					        'rules' => 'trim|required|xss_clean', 
					        'errors' => array('required' => 'Please Provide %s!')
					    ),
						array(
					        'field' => 'Attachments',
					        'label' => 'Attachments', 
					        'rules' => 'trim|xss_clean|callback_check_file_size', 
					        'errors' => array('check_file_size' => 'File size is too large!')
					    )	
									
						
					);
					
			$this->form_validation->set_rules($validation);
			if ($this->form_validation->run() == FALSE) {
				//echo "false";
				return FALSE;
			}else{
				//echo "true";
				return TRUE;
			}
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
		if (($this->input->post('selected')!==NULL)) 
		{
			foreach ($this->input->post('selected') as $ticket_id) 
			{
				$this->ticket->deleteTicket($ticket_id);
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
		if (($this->input->post('selected')!==NULL)) 
		{
			foreach ($this->input->post('selected') as $ticket_id) 
			{
				$this->ticket->softDeleteTicket($ticket_id);
			}
			
			$this->session->set_userdata('success',$this->lang->line('text_success'));
			$this->index();
		}
	}
	
	/**
	* 
	* @function name 	: check_file_size()
	* @description   	: Validate form data
	* @access 			: public
	* @param   			: void
	* @return        	: boolean
	*
	*/
    function check_file_size()
	{
	   if($_FILES['Attachments']['size']>1242880)
	   {
		   //echo "file size is too large";		 
		   return FALSE;
	   }
	   else
	   {
		   //echo "file size is ok";
		   return TRUE;
	   }
	   
	}
	
	/**
	* 
	* @function name : ticketdetail()
	* @description   : get Ticket records by ticket Id
	* @param   		 : $ticketid for data want
	* @return        : void
	*
	*/
	function ticketdetail($ticketid='')
	{
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Data Operator Tickets',
		   'href' => base_url('support/tickets'),
		 
		  );
		if ($this->session->userdata('success')!==NULL) {
                    $this->data['success'] = $this->session->userdata('success');

                    $this->session->set_userdata('success','');
            } else {
                    $this->data['success'] = '';
            }
            if ($this->session->userdata('error')!==NULL) {
                    $this->data['error'] = $this->session->userdata('error');

                    $this->session->set_userdata('error','');
            } else {
                    $this->data['error'] = '';
            }
		$this->data['Ticket_info']=$this->ticket->ticketinfo_byid($this->commons->decode($ticketid));
		$this->data['ticket_list'] = $this->ticket->getAll();
		$this->data['user_groups'] = $this->ticket->getUserGroups();
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/support/ticket_reply";
		$this->load->view($content_page,$this->data);
	} 
	
	/**
	* 
	* @function name : changeticketstatus()
	* @description   : change ticket status
	* @param   		 : $status which you chnage
	* @param   		 : $ticketid for status change
	* @return        : void
	*
	*/
	function changeticketstatus($status,$ticketid)
	{
		$ticket_id=$this->commons->decode($ticketid);
		$res=$this->ticket->ChangeStatus($status,$ticket_id);
		if($res)
		{
			$this->session->set_flashdata('success','Ticket Status Changed Successfully.');
		}
		else
		{
			$this->session->set_flashdata('error','Error Into Changed Ticket Status.');
		}
		redirect('support/tickets/ticketdetail/'.$ticketid);	
	}
	
	/**
	* 
	* @function name : reply()
	* @description   : reply ticket
	* @return        : void
	*
	*/
	function reply()
	{
		
		$supportticketid=$this->commons->encode($this->input->post('ticket_id'));
		if($this->input->post('ticket_reply_id'))
		{
			// ========For Edit Ticket Note ========
			$res_edit=$this->ticket->edit_ticket_reply();
		}
		else
		{
			// ========For Insert Ticket Note ========
			$res=$this->ticket->reply();
			$status=explode('-',$res);
		}
		
		if(isset($status) && $status)
		{
			$this->session->set_flashdata('success', 'Ticket reply successfully submitted.<br/>'.$status[0].' Documents Uploaded Successfully<br/>'.$status[1].' Documents Not Uploaded');	
		}
		elseif(isset($res_edit) && $res_edit)
		{
			$this->session->set_flashdata('success','Ticket Note Updated Successfully.');	
		}
		else
		{
			$this->session->set_flashdata('error','Error Into Ticket Reply.');	
		}
		//redirect('support/tickets/ticketdetail/'.$supportticketid);
		redirect('support/'.$this->uri->segment(2).'/ticketdetail/'.$supportticketid);		
		
	}	
	
	/**
	* 
	* @function name : fetch_ticket_reply()
	* @description   : get reply ticket records
	* @return        : json
	*
	*/
	function fetch_ticket_reply()
	{
		$this->output->unset_template();
		$res=$this->ticket->fetch_ticket_reply();
		echo json_encode($res);	
	}
	
	/**
	* 
	* @function name : delete_ticket_note()
	* @description   : delete tickets reply
	* @return        : Void
	*
	*/
	function delete_ticket_note()
	{
		$this->output->unset_template();
		$this->ticket->delete_ticket_note();
	}
}
