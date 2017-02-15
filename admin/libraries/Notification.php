<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Notification Library
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Academic Free License version 3.0
 *
 *
 * @package     CodeIgniter
 * @author      Nitin Sabhadiya
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Notification Library
 *
 * Nothing but legless, boneless creatures who are responsible for creating
 * magic "friendly Notification" in your CodeIgniter application.
 * feeders, hiding during daylight hours.
 *
 * @subpackage Libraries
 */
class Notification
{

	/**
	 * Store Notification in database
	 *
	 * This function is take all notification database table parameter
	 * and store in database
	 *
	 * Param1 : ToId Array(Optional)
     * Param2 : Notification Type(Payment ,Notification ,Message ,Friends ,Event)
     * Param3 : Notification Title
     * Param4 : Notification Message
     * Param5 : Resource URL
     * Param6 : RoleId Array(Optional)
	 */
	public function push_notification($notify_to, $notify_by, $module ,$description , $action_type, $url)
	{
		
			$this->db->set('notify_to','');
			$this->db->set('notify_by','');
			$this->db->set('module','');
			$this->db->set('description','');
			$this->db->set('action_type','');
			$this->db->set('url','');
			$this->db->set('isread',0);
			$this->db->set('read_date',date('Y-m-d H:i:s'));
			$this->db->insert('notification');
	}
	
	/**
	 * Show Notification in user account
	 *
	 * This function is take all notification parameter from database table 
	 * and display in user account
	 *
	 * Param1 : ToId
     * Return : DataArray
	 */
	public function pull_notification($toid)
	{
		$this->db->where('notify_to',$toid);
		$this->db->order_by('notification_id','desc');
		$query = $this->db->get('notification');
		$records = array();
		
		if ($query->num_rows() > 0) 
		{
			$records = $query->result_array();
		}
		
		return $records;
	}

	
}