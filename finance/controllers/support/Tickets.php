<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Tickets
* @Auther       : Indrajit
* @Date         : 13-12-2016
* @Description  : Admin Tickets Operation
*
*/

class Tickets extends CI_Controller {

private $data=array();

	function __construct()
	{
		parent::__construct();
		
		$this->rbac->CheckAuthentication();
		
		$this->load->model('support/ticket_model', 'ticket');

		$this->_init();
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
		$this->output->set_common_meta('Tickets','sarpo','This is srapo Tickets page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load Orders view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index()	{
		$this->data['add'] 			 = base_url('sales/orders/add');
		$this->data['breadcrumbs']   = array();
		$this->data['breadcrumbs'][] = array(
		   'text' => '<i class="fa fa-dashboard"></i> Home',
		   'href' => base_url('dashboard/dashboard'),
		 
		  );
		$this->data['breadcrumbs'][] = array(
		   'text' => 'Tickets',
		   'href' => base_url('support/tickets'),
		 
		  );
		$this->data['ticket_list'] = $this->ticket->getAll();
		$this->data['user_groups'] = $this->ticket->getUserGroups();
		$admin_theme = $this->common->config('admin_theme');
		$content_page="themes/".$admin_theme."/support/ticket";
		$this->load->view($content_page,$this->data);
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
		   'text' => 'Tickets',
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
		$content_page="themes/".$admin_theme."/support/ticket";
		$this->load->view($content_page,$this->data);
		
	}
	/**
	* 
	* @function name : add_ticket()
	* @description   : Add new Ticket records
	* @param   		 : void
	* @return        : void
	*
	*/
	function add_ticket()
	{
		$res=$this->ticket->add_ticket();	
		if($res)
		{
			$this->session->set_flashdata('success','Ticket Created Successfully.');
		}
		else
		{
			$this->session->set_flashdata('error','Error Into Create Ticket.');
		}
		redirect('support/tickets/ticketdetail/'.$this->commons->encode($res));	
	}
	/**
	* 
	* @function name : edit_ticket()
	* @description   : edit Ticket records
	* @param   		 : void
	* @return        : void
	*
	*/
	function edit_ticket()
	{
		$supportticketid=$this->commons->encode($this->input->post('ticket_id'));
		$res=$this->ticket->edit_ticket();	
		if($res)
		{
			$this->session->set_flashdata('success','Ticket Detail Updated Successfully.');
		}
		else
		{
			$this->session->set_flashdata('error','Error Into Update Ticket Detail.');
		}
		redirect('support/tickets/ticketdetail/'.$supportticketid);
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
		redirect('support/tickets/ticketdetail/'.$supportticketid);	
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
	* @function name : delete()
	* @description   : delete ticket
	* @param   		 : $ticketid for deleted ticket
	* @return        : void
	*
	*/
	function delete($TicketId)
	{
		$res=$this->ticket->delete_ticket($this->commons->decode($TicketId));	
		if($res)
		{
			$this->session->set_flashdata('success','Ticket Deleted Successfully.');
		}
		else
		{
			$this->session->set_flashdata('error','Error Into Delete Ticket.');
		}
		redirect('support/tickets');	
	}
	/**
	* 
	* @function name : getUserListByRoleId()
	* @description   : get User records by roleId
	* @param   		 : void
	* @return        : json
	*
	*/
	public function getUserListByRoleId()
	{
		$this->output->unset_template();
		$role_id = $this->input->post('role_id');
		$data = array();
		if($role_id)
		{
			if($role_id == 6)
			{
				$manufacture_list = $this->ticket->getManufacturer();
				foreach ($manufacture_list as $key => $value) {
					$data[$key]['user_id'] = $value['manufacturer_id'];
					$data[$key]['user_name'] = $value['name'];
				}
			}
			if($role_id == 8)
			{
				$customer_list = $this->ticket->getCustomer();
				foreach ($customer_list as $key => $value) {
					$data[$key]['user_id'] = $value['customer_id'];
					$data[$key]['user_name'] = $value['name'];
				}
			}
			if($role_id != 6 &&  $role_id != 8)
			{
				$user_list = $this->ticket->getUserByRoleId($role_id);
				foreach ($user_list as $key => $value) {
					$data[$key]['user_id'] = $value['admin_id'];
					$data[$key]['user_name'] = $value['firstname'].' '.$value['lastname'];
				}
			}
		}
		
		echo json_encode($data);

	}

	/**
	* 
	* @function name : getTicketListByRoleId()
	* @description   : get Ticket records by roleId
	* @param   		 : void
	* @return        : json
	*
	*/
	public function getTicketListByRoleId()
	{
		$this->output->unset_template();
		$role_id = $this->input->post('role_id');
		if($role_id)
		{
			$tickets_details = $this->ticket->GetByRoleId($role_id);
			$data = array();
			foreach ($tickets_details as $key => $Ticket) 
			{
				 if($Ticket['status']=='1')    
                {
                    $status = '<label class="btn btn-xs pull-right custom-label btn-info">OPEN</label>';
                } 
                else if($Ticket['status']=='2') 
                { 
                    $status = '<label class="btn btn-xs pull-right custom-label btn-danger">PENDING</label>';    
                }
                else if($Ticket['status']=='3') 
                { 
                    $status = '<label class="btn btn-xs pull-right custom-label btn-success">CLOSED</label>';        
                }
                else
                {
                	$status = "";	
                }
				$data[$key]['href'] = base_url('support/tickets/ticketdetail/'.$this->commons->encode($Ticket['ticket_id']));
				$data[$key]['status'] = $status;
				$data[$key]['ticket_code'] = $Ticket['ticket_code'];
				$data[$key]['title'] = $this->commons->neat_trim($Ticket['title'],10,'..');
				$data[$key]['ticket_id'] = $Ticket['ticket_id'];
				$data[$key]['role_name'] = $Ticket['RoleName'];
				$data[$key]['date_added'] = $this->commons->time_ago($Ticket['date_added']);
			}

			
		}
		else
		{
			$tickets_details = $this->ticket->GetAll();
			$data = array();
			foreach ($tickets_details as $key => $Ticket) 
			{
				 if($Ticket['status']=='1')    
                {
                    $status = '<label class="btn btn-xs pull-right custom-label btn-info">OPEN</label>';
                } 
                else if($Ticket['status']=='2') 
                { 
                    $status = '<label class="btn btn-xs pull-right custom-label btn-danger">PENDING</label>';    
                }
                else if($Ticket['status']=='3') 
                { 
                    $status = '<label class="btn btn-xs pull-right custom-label btn-success">CLOSED</label>';        
                }
                else
                {
                	$status = "";	
                }
				$data[$key]['href'] = base_url('support/tickets/ticketdetail/'.$this->commons->encode($Ticket['ticket_id']));
				$data[$key]['status'] = $status;
				$data[$key]['ticket_code'] = $Ticket['ticket_code'];
				$data[$key]['title'] = $Ticket['title'];
				$data[$key]['ticket_id'] = $Ticket['ticket_id'];
				$data[$key]['role_name'] = $Ticket['RoleName'];
				$data[$key]['date_added'] = $this->commons->time_ago($Ticket['date_added']);
			}

			
		}
		echo json_encode($data);
	}

	
}
