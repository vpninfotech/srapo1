<?php
/**
* 
* @file name   : Address_model
* @Auther      : Vinay
* @Date        : 07-12-2017
* @Description : Collection of various common function related to address database operation.
*
*/
class Address_model extends CI_Model 
{
    /**
    * 
    * @function name 	: __construct()
    * @description   	: initialize variables
    * @param   		: void
    * @return        	: void
    *
    */
    public function __construct() 
    {
        parent::__construct();
    }
    
    /**
    * 
    * @function name : getAddressesById()
    * @description   : get address record by customer_id
    * @access        : public
    * @param   	     : int $customer_id The customer id that you want
    * @return        : array The selected users array
    *
    */
    public function getAddressesById($customer_id) 
    {
        $this->db->from('address');
        $this->db->where('customer_id',(int)$customer_id);
        $query=$this->db->get();
        return $query->result_array();
    }
    
    /**
    * 
    * @function name : getAddressById()
    * @description   : get address record by address_id
    * @access        : public
    * @param   	     : int $address_id The address id that you want
    * @return        : array The selected users array
    *
    */
    public function getAddressById($address_id) 
    {
        $this->db->from('address');
        $this->db->where('address_id',(int)$address_id);
        $query=$this->db->get();
        return $query->row_array();
    }


    public function getAddress($address_id) {
        $address_query = $this->db->query("SELECT DISTINCT * FROM address WHERE address_id = '" . (int)$address_id . "' AND customer_id = '" . (int)$this->session->userdata('customer_id') . "'");

        if ($address_query->num_rows()) {
            $country_query = $this->db->query("SELECT * FROM `country` WHERE country_id = '" . (int)$address_query->row('country_id') . "'");

            if ($country_query->num_rows()) {
                $country = $country_query->row('name');
                $iso_code_2 = $country_query->row('iso_code_2');
                $iso_code = $country_query->row('iso_code');
                
            } else {
                $country = '';
                $iso_code_2 = '';
                $iso_code = '';
                
            }

            $zone_query = $this->db->query("SELECT * FROM `state` WHERE state_id = '" . (int)$address_query->row('state_id') . "'");

            if ($zone_query->num_rows()) {
                $zone = $zone_query->row('state_name');
                $zone_code = $zone_query->row('state_code');
            } else {
                $zone = '';
                $zone_code = '';
            }

            $address_data = array(
                'address_id'     => $address_query->row('address_id'),
                'firstname'      => $address_query->row('firstname'),
                'lastname'       => $address_query->row('lastname'),
                'company'        => $address_query->row('company'),
                'address_1'      => $address_query->row('address_1'),
                'address_2'      => $address_query->row('address_2'),
                'postcode'       => $address_query->row('postcode'),
                'city'           => $address_query->row('city'),
                'zone_id'        => $address_query->row('state_id'),
                'zone'           => $zone,
                'zone_code'      => $zone_code,
                'country_id'     => $address_query->row('country_id'),
                'country'        => $country,
                'iso_code_2'     => $iso_code_2,
                'iso_code'     => $iso_code,
               
            );

            return $address_data;
        } else {
            return false;
        }
    }

    public function getAddresses() {
        $address_data = array();

        $query = $this->db->query("SELECT * FROM address WHERE customer_id = '" . (int)$this->session->userdata('customer_id') . "'");
        foreach ($query->result_array() as $result) 
        {
            $country_query = $this->db->query("SELECT * FROM `country` WHERE country_id = '" . (int)$result['country_id'] . "'");

            if ($country_query->num_rows()) {
                $country = $country_query->row('country_name');
                $iso_code_2 = $country_query->row('iso_code_2');
                $iso_code = $country_query->row('iso_code');
                
            } else {
                $country = '';
                $iso_code_2 = '';
                $iso_code = '';
                
            }

            $zone_query = $this->db->query("SELECT * FROM `state` WHERE state_id = '" . (int)$result['state_id'] . "'");

            if ($zone_query->num_rows()) {
                $zone = $zone_query->row('state_name');
                $zone_code = $zone_query->row('state_code');
            } else {
                $zone = '';
                $zone_code = '';
            }

            $address_data[$result['address_id']] = array(
                'address_id'     => $result['address_id'],
                'firstname'      => $result['firstname'],
                'lastname'       => $result['lastname'],
                'company'        => $result['company'],
                'address_1'      => $result['address_1'],
                'address_2'      => $result['address_2'],
                'postcode'       => $result['postcode'],
                'city'           => $result['city'],
                'zone_id'        => $result['state_id'],
                'zone'           => $zone,
                'zone_code'      => $zone_code,
                'country_id'     => $result['country_id'],
                'country'        => $country,
                'iso_code_2'     => $iso_code_2,
                'iso_code'     => $iso_code,
               

            );
        }

        return $address_data;
    }

    
    /**
    * 
    * @function name : addAddress()
    * @description   : add address record in database
    * @access        : public
    * @return        : void
    *
    */
    public function addAddress($data) 
    {
        $this->db->set('customer_id',(int)$this->session->userdata('customer_id'));
        $this->db->set('firstname',$data['firstname']);
        $this->db->set('lastname',$data['lastname']);
        if(isset($data['company']))
        {
            $this->db->set('company',$data['company']);    
        }
        $this->db->set('address_1',$data['address_1']);
        if(isset($data['address_2']))
        {
           $this->db->set('address_2',$data['address_2']);  
        }
        
        $this->db->set('city',$data['city']);
        $this->db->set('postcode',$data['postcode']);
        $this->db->set('state_id',$data['state_id']);
        $this->db->set('country_id',$data['country_id']);
        $this->db->set('date_added',date('Y-m-d h:i:sa'));
        $this->db->set('added_by',(int)$this->session->userdata('customer_id'));
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by',(int)$this->session->userdata('customer_id'));
        $this->db->insert('address');     
        
        $address_id = $this->db->insert_id();
        
        if (!empty($data['default_address'])) {
            $this->db->query("UPDATE customer SET address_id = '".(int)$address_id."' WHERE customer_id = '".(int)$this->session->userdata('customer_id')."'");
        }
        
        return $address_id;
    }
    
    /**
    * 
    * @function name : editAddress()
    * @description   : edit address record in database
    * @access        : public
    * @return        : void
    *
    */
    public function editAddress($data) 
    {
        $this->db->set('customer_id',(int)$this->input->post('customer_id'));
        $this->db->set('firstname',$data['firstname']);
        $this->db->set('lastname',$data['lastname']);
        if(isset($data['company']))
        {
            $this->db->set('company',$data['company']);    
        }
        
        $this->db->set('address_1',$data['address_1']);
        $this->db->set('address_2',$data['address_2']);
        $this->db->set('city',$data['city']);
        $this->db->set('postcode',$data['postcode']);
        $this->db->set('state_id',$data['state_id']);
        $this->db->set('country_id',$data['country_id']);
        $this->db->set('date_added',date('Y-m-d h:i:sa'));
        $this->db->set('added_by',(int)$this->input->post('customer_id'));
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by',(int)$this->input->post('customer_id'));
        $this->db->where('address_id',(int)$this->input->post('address_id'));
        $query = $this->db->update('address');
        
        if (!empty($data['default_address'])) {
            $this->db->query("UPDATE customer SET address_id = '".(int)$this->input->post('address_id')."' WHERE customer_id = '".(int)$this->input->post('customer_id')."'");
        }
        
        return $query;
    }   
    
    public function deleteAddress($address_id) {
            $this->db->query("DELETE FROM address WHERE address_id = '" . (int)$address_id . "' AND customer_id = '" . (int)$this->customer->getId() . "'");
    }
   public function getTotalAddresses() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM address WHERE customer_id = '".$this->session->userdata('customer_id')."'");
        
        return $query->row_array('total');
    }
    
}