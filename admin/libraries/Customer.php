<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Customer class
 * Collection of various common function related to Customer.
 *
 * @author    Indrajit
 * @license   http://www.vpninfotech.com/
 */
class Customer 
{
	private $customer_id;
	private $firstname;
	private $lastname;
	private $customer_group_id;
	private $email;
	private $telephone;
	private $fax;
	private $newsletter;
	private $address_id;

	public function __construct()
	{
		 // Get the CodeIgniter reference
         $this->_CI =& get_instance();
            
		if ($this->_CI->session->userdata('customer_id') != NULL) 
		{
			$customer_query = $this->_CI->db->query("SELECT * FROM customer WHERE customer_id = '" . (int)$this->_CI->session->userdata('customer_id') . "' AND status = '1'");
			//$customer_query = $customer_query->row_array();
			if ($customer_query)
			{
				$this->customer_id = $customer_query->row('customer_id');
				$this->firstname = $customer_query->row('firstname');
				$this->lastname = $customer_query->row('lastname');
				$this->customer_group_id = $customer_query->row('customer_group_id');
				$this->email = $customer_query->row('email');
				$this->telephone = $customer_query->row('telephone');
				$this->newsletter = $customer_query->row('newsletter');
				$this->address_id = $customer_query->row('address_id');

				$this->_CI->db->query("UPDATE customer SET ip = '" . $_SERVER['REMOTE_ADDR'] . "' WHERE customer_id = '" . (int)$this->customer_id . "'");

				// $query = $this->_CI->db->query("SELECT * FROM customer_ip WHERE customer_id = '" . (int)$this->_CI->session->userdata('customer_id')  . "' AND ip = '" . $_SERVER['REMOTE_ADDR'] . "'");

				// if (!$query->num_rows()) {
				// 	$this->_CI->db->query("INSERT INTO customer_ip SET customer_id = '" . (int)$this->_CI->session->userdata('customer_id') . "', ip = '" . $_SERVER['REMOTE_ADDR'] . "', date_added = NOW()");
				// }
			} else {
				$this->logout();
			}
		}
	}

	public function login($email, $password, $override = false) {
		if ($override) 
		{
			$customer_query = $this->_CI->db->query("SELECT * FROM customer WHERE LOWER(email) = '" . strtolower($email) . "' AND status = '1'");
		} 
		else
		{
			$customer_query = $this->_CI->db->query("SELECT * FROM customer WHERE LOWER(email) = '" . strtolower($email) . "' AND password = '" .$password. "') AND status = '1' ");
		}

		if ($customer_query->num_rows()) 
		{
			//$customer_query = $customer_query->row_array();
			$this->_CI->session->set_userdata('customer_id', $customer_query->row('customer_id'));

			$this->customer_id = $customer_query->row('customer_id');
			$this->firstname = $customer_query->row('firstname');
			$this->lastname = $customer_query->row('lastname');
			$this->customer_group_id = $customer_query->row('customer_group_id');
			$this->email = $customer_query->row('email');
			$this->telephone = $customer_query->row('telephone');
			$this->newsletter = $customer_query->row('newsletter');
			$this->address_id = $customer_query->row('address_id');

			$this->_CI->db->query("UPDATE customer SET ip = '" . $_SERVER['REMOTE_ADDR'] . "' WHERE customer_id = '" . (int)$this->customer_id . "'");

			return true;
		} else {
			return false;
		}
	}

	public function logout() {
		$this->_CI->session->unset_userdata('customer_id');
		$this->customer_id = '';
		$this->firstname = '';
		$this->lastname = '';
		$this->customer_group_id = '';
		$this->email = '';
		$this->telephone = '';
		$this->newsletter = '';
		$this->address_id = '';
	}

	public function isLogged() {
		return $this->customer_id;
	}

	public function getId() {
		return $this->customer_id;
	}

	public function getFirstName() {
		return $this->firstname;
	}

	public function getLastName() {
		return $this->lastname;
	}

	public function getGroupId() {
		return $this->customer_group_id;
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

	public function getAddressId() {
		return $this->address_id;
	}

}
