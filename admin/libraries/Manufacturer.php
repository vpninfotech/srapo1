<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Manufacturer class
 * Collection of various common function related to Manufacturer.
 *
 * @author    Mitesh
 * @license   http://www.vpninfotech.com/
 */
class Manufacturer 
{
	private $manufacturer_id;
	private $role_id;
	private $firstname;
	private $lastname;
	private $email;
	private $telephone;
	private $fax;
	private $newsletter;
	//private $address_id;

	public function __construct()
	{
		// Get the CodeIgniter reference
        $this->_CI =& get_instance();
		 
		if ($this->_CI->session->userdata('manufacturer_id') != NULL) 
		{
			$manufacturer_query = $this->_CI->db->query("SELECT * FROM manufacturer WHERE manufacturer_id = '" . (int)$this->_CI->session->userdata('manufacturer_id') . "' AND status = '1'");
			//$manufacturer_query = $manufacturer_query->row_array();
			if ($manufacturer_query)
			{
				$this->manufacturer_id = $manufacturer_query->row('manufacturer_id');
				$this->firstname = $manufacturer_query->row('firstname');
				$this->lastname = $manufacturer_query->row('lastname');				
				$this->email = $manufacturer_query->row('email');
				$this->telephone = $manufacturer_query->row('telephone');
				$this->newsletter = $manufacturer_query->row('newsletter');
				//$this->address_id = $manufacturer_query->row('address_id');

				$this->_CI->db->query("UPDATE manufacturer SET ip = '" . $_SERVER['REMOTE_ADDR'] . "' WHERE manufacturer_id = '" . (int)$this->manufacturer_id . "'");

				// $query = $this->_CI->db->query("SELECT * FROM manufacturer_ip WHERE manufacturer_id = '" . (int)$this->_CI->session->userdata('manufacturer_id')  . "' AND ip = '" . $_SERVER['REMOTE_ADDR'] . "'");

				// if (!$query->num_rows()) {
				// 	$this->_CI->db->query("INSERT INTO manufacturer_ip SET manufacturer_id = '" . (int)$this->_CI->session->userdata('manufacturer_id') . "', ip = '" . $_SERVER['REMOTE_ADDR'] . "', date_added = NOW()");
				// }
			} else {
				$this->logout();
			}
		}
	}

	public function login($email, $password, $override = false) {
		if ($override) 
		{
			$manufacturer_query = $this->_CI->db->query("SELECT * FROM manufacturer WHERE LOWER(email) = '" . strtolower($email) . "' AND status = '1'");
		} 
		else
		{
			$manufacturer_query = $this->_CI->db->query("SELECT * FROM manufacturer WHERE LOWER(email) = '" . strtolower($email) . "' AND password = '" .$password. "') AND status = '1' ");
		}

		if ($manufacturer_query->num_rows()) 
		{
			//$manufacturer_query = $manufacturer_query->row_array();
			$this->_CI->session->set_userdata('manufacturer_id', $manufacturer_query->row('manufacturer_id'));

			$this->manufacturer_id = $manufacturer_query->row('manufacturer_id');
			$this->firstname = $manufacturer_query->row('firstname');
			$this->lastname = $manufacturer_query->row('lastname');
			$this->manufacturer_group_id = $manufacturer_query->row('manufacturer_group_id');
			$this->email = $manufacturer_query->row('email');
			$this->telephone = $manufacturer_query->row('telephone');
			$this->newsletter = $manufacturer_query->row('newsletter');
			//$this->address_id = $manufacturer_query->row('address_id');

			$this->_CI->db->query("UPDATE manufacturer SET ip = '" . $_SERVER['REMOTE_ADDR'] . "' WHERE manufacturer_id = '" . (int)$this->manufacturer_id . "'");

			return true;
		} else {
			return false;
		}
	}

	public function logout() {
		$this->_CI->session->unset_userdata('manufacturer_id');
		$this->manufacturer_id = '';
		$this->firstname = '';
		$this->lastname = '';
		$this->manufacturer_group_id = '';
		$this->email = '';
		$this->telephone = '';
		$this->newsletter = '';
		//$this->address_id = '';
	}

	public function isLogged() {
		return $this->manufacturer_id;
	}

	public function getId() {
		return $this->manufacturer_id;
	}

	public function getFirstName() {
		return $this->firstname;
	}

	public function getLastName() {
		return $this->lastname;
	}

	public function getGroupId() {
		return $this->manufacturer_group_id;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getTelephone() {
		return $this->telephone;
	}

	public function getFax() {
		return $this->fax;
	}

	public function getNewsletter() {
		return $this->newsletter;
	}

	/*public function getAddressId() {
		return $this->address_id;
	}*/

}
