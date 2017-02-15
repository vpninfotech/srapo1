<?php

/**
 * Currency Model Class
 * Collection of various common function related to currency database operation.
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Currency_model extends CI_Model 
{
	/**
	* 
	* @function name 	: __construct()
	* @description   	: initialize variables
	* @param   		 	: void
	* @return        	: void
	*
	*/
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	* 
	* @function name 	: getCurrency()
	* @description   	: get currency record by currency_id
	* @access 		 	: public
	* @param   		 	: int $currency_id The currency id that you want
	* @return       	: array The selected currency array
	*
	*/
	public function getCurrency($currency_id)
    {
		$this->db->from('currency');
		$this->db->where('currency_id',(int)$currency_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	/**
	* 
	* @function name 	: getCurrencyByKey()
	* @description   	: get currency record by key and value
	* @access 		 	: public
	* @param   		 	: string $k The currency key that you want
	* @param   		 	: string $v The currency value that you want
	* @return       	: array The selected currency key and value array
	*
	*/
	public function getCurrencyByKey($k,$v)
    {
		$this->db->from('currency');
		$this->db->where($k,$v);
		$query=$this->db->get();
		return $query->result_array();
    }
    /**
	* 
	* @function name 	: getCurrencyField()
	* @description   	: get currency selected field record by key and value
	* @access 		 	: public
	* @param   		 	: string $Field The currency field that you want
	* @param   		 	: string $k The currency key that you want
	* @param   		 	: string $v The currency value that you want
	* @return       	: string selected field value
	*
	*/
	public function getCurrencyField($Field,$k,$v)
    {
		$this->db->from('currency');
		$this->db->where($k,$v);
		$query=$this->db->get();
		$row = $query->row_array();
		return $row[$Field];
    }
    
	/**
	* 
	* @function name 	: addCurrency()
	* @description   	: add currency record in database
	* @access 		 	: public
	* @return       	: int last inserted currency record id
	*
	*/
	public function addCurrency()
	{
		$is_deleted = $this->input->post('is_deleted');
		if(isset($is_deleted))
		{
   			$is_deleted = 1;
		}
		else
		{
   			$is_deleted = 0;
		}
		$this->db->set('title',$this->input->post('title'));
		$this->db->set('code',strtoupper($this->input->post('code')));
		$this->db->set('symbol_left',$this->input->post('symbol_left'));
		$this->db->set('symbol_right',$this->input->post('symbol_right'));
		$this->db->set('decimal_place',(float)$this->input->post('decimal_place'));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('Muser_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by', $this->session->userdata('Muser_id'));
		$this->db->insert('currency');
		
		
		// Run currency update
		if ($this->common->config('config_currency_auto')) {
			$this->refresh(true);
		}
		return $this->db->insert_id();
	}
	
	/**
	* 
	* @function name 	: editCurrency()
	* @description   	: edit currency record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editCurrency()
	{
		$is_deleted = $this->input->post('is_deleted');
		if(isset($is_deleted))
		{
   			$is_deleted = 1;
		}
		else
		{
   			$is_deleted = 0;
		}
		$this->db->set('title',$this->input->post('title'));
		$this->db->set('code',strtoupper($this->input->post('code')));
		$this->db->set('symbol_left',$this->input->post('symbol_left'));
		$this->db->set('symbol_right',$this->input->post('symbol_right'));
		$this->db->set('decimal_place',$this->input->post('decimal_place'));
		$this->db->set('value',$this->input->post('value'));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('Muser_id'));
		$this->db->where('currency_id',(int)$this->input->post('currency_id'));
		return $this->db->update('currency');	
	}
	
	
	/**
	* 
	* @function name 	: softDeleteCurrency()
	* @description   	: only status change not actual delete currency from database
	* @access 		 	: public
	* @param   		 	: int $currency_id The currency id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteCurrency($currency_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('currency_id',(int)$currency_id);
		return $this->db->update('currency');
	}
	
	/**
	* 
	* @function name 	: deleteCurrency()
	* @description   	: delete currency record from database
	* @access 		 	: public
	* @param   		 	: int $currency_id The currency id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteCurrency($currency_id) 
	{	
		$this->db->where('currency_id',(int)$currency_id);
		return $this->db->delete('currency');
	} 
	
	/**
	* 
	* @function name 	: getCurrencyByCode()
	* @description   	: get currency record by currencycode
	* @access 		 	: public
	* @param   		 	: string $currency The currency code that you want to get
	* @return       	: array The selected currency array
	*
	*/
	public function getCurrencyByCode($currency) 
	{
		$this->db->from('currency');
		$this->db->where('code',$currency);
		$query=$this->db->get();
		return $query->row_array();
	}
	
	/**
	* 
	* @function name 	: getCurrencies()
	* @description   	: get all currencies from database
	* @access 		 	: public
	* @param   		 	: string $currency The currency code that you want to get
	* @return       	: array The selected currency array
	*
	*/
	public function getCurrencies($data = array())
	{
		if($data)
		{

			$sql = "SELECT * FROM currency";

			$sort_data = array(
				'title',
				'code',
				'value',
				'date_modified'
			);
			if($this->session->userdata('Mrole_id')!=1)
			{
				$sql .= " WHERE is_deleted = 0";
			}
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY title";
			}

			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}

			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}

				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}
		}
		else
		{
			$sql = "SELECT * FROM currency WHERE is_deleted = 0 ORDER BY title ASC";
		}
		$query = $this->db->query($sql);
		$query->result_array();
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalCurrencies()
	* @description   	: get total no of currencies from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalCurrencies() 
	{
		$sql = "SELECT COUNT(*) AS total FROM currency";
		if($this->session->userdata('Mrole_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	
	/**
	* 
	* @function name 	: refresh()
	* @description   	: refresh all currency rate
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function refresh($force = false)
	{
		if (extension_loaded('curl'))
		{
			$data = array();
			
			if ($force)
			{
				$this->db->where('code !=', $this->common->config('config_currency'));
				$this->db->from('currency');
				$query=$this->db->get();
			}
			else
			{
				
				$this->db->where('code !=', $this->common->config('config_currency'));
				$this->db->where('date_modified < ', date('Y-m-d H:i:s', strtotime('-1 day')));
				$this->db->from('currency');
				$query=$this->db->get();
			}
			
			foreach ($query->result_array() as $result)
			{
				$data[] = $this->common->config('config_currency') . $result['code'] . '=X';
			}
			
			$curl = curl_init();

			curl_setopt($curl, CURLOPT_URL, 'http://download.finance.yahoo.com/d/quotes.csv?s=' . implode(',', $data) . '&f=sl1&e=.csv');

			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($curl, CURLOPT_TIMEOUT, 30);

			$content = curl_exec($curl);

			curl_close($curl);

			$lines = explode("\n", trim($content));
			
			foreach ($lines as $line) 
			{
				$currency = substr($line, 4, 3);
				$value = substr($line, 11, 6);

				if ((float)$value) 
				{
					$this->db->set('value',(float)$value);
					$this->db->set('date_modified',date('Y-m-d H:i:s'));
					$this->db->where('code',$currency);
					$this->db->update('currency');
				}
			}
			
			$this->db->set('value','1.00000');
			$this->db->set('date_modified',date('Y-m-d H:i:s'));
			$this->db->where('code',$this->common->config('config_currency'));
			$this->db->update('currency');
			
		}
	}
	
	
}