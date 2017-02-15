<?php
/**
* 
* @file name   : Voucher_model
* @Auther      : Indrajit
* @Date        : 23-01-2016
* @Description : Collection of various common function related to Cart voucher total.
*
*/
class Voucher_model extends CI_Model 
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
        
        $this->load->library('mycart');
        
        $this->load->library('customer');

        $this->load->library('tax');

        $this->lang->load('api/total_voucher_model_lang', 'english');
    }
	public function addVoucher($order_id,$data = array()) 
	{
		if(count($data) > 0)
		{
			$this->db->query("INSERT INTO voucher SET order_id = '" . (int)$order_id . "', code = '" . $data['code'] . "', from_name = '" . $data['from_name'] . "', from_email = '" . $data['from_email'] . "', to_name = '" . $data['to_name'] . "', to_email = '" . $data['to_email'] . "', voucher_theme_id = '" . (int)$data['voucher_theme_id'] . "', message = '" . $data['message'] . "', amount = '" . (float)$data['amount'] . "', status = '1', date_added = NOW()");
		}
		else
		{
			$this->db->query("INSERT INTO voucher SET order_id = '" . (int)$order_id . "', code = '" . $this->input->post('code') . "', from_name = '" . $this->input->post('from_name') . "', from_email = '" . $this->input->post('from_email') . "', to_name = '" . $this->input->post('to_name') . "', to_email = '" . $this->input->post('to_email') . "', voucher_theme_id = '" . (int)$this->input->post('voucher_theme_id') . "', message = '" . $this->input->post('message') . "', amount = '" . (float)$this->input->post('amount') . "', status = '1', date_added = NOW()");	
		}
		

		return $this->db->insert_id();
	}

	public function disableVoucher($order_id) 
	{
		$this->db->query("UPDATE voucher SET status = '0' WHERE order_id = '" . (int)$order_id . "'");
	}

	public function getVoucher($code) 
	{
		$status = true;

		$voucher_query = $this->db->query("SELECT *, vt.name AS theme,vt.image as image FROM voucher v 
			LEFT JOIN voucher_theme vt ON (v.voucher_theme_id = vt.voucher_theme_id) 
			WHERE v.code = '" . $code . "' AND v.status = '1'");

		if ($voucher_query->num_rows()) 
		{
			if ($voucher_query->row('order_id')) 
			{
				$implode = array();

				$complete_status = json_decode($this->common->config('config_complete_status'),true);
		
				foreach ($complete_status as $order_status_id) 
				{
							$implode[] = "'" . (int)$order_status_id . "'";
				}

				$order_query = $this->db->query("SELECT * FROM `order` WHERE order_id = '" . (int)$voucher_query->row['order_id'] . "' AND order_status_id IN(" . implode(",", $implode) . ")");

				if (!$order_query->num_rows()) {
					$status = false;
				}

				$order_voucher_query = $this->db->query("SELECT * FROM `order_voucher` WHERE order_id = '" . (int)$voucher_query->row('order_id') . "' AND voucher_id = '" . (int)$voucher_query->row('voucher_id') . "'");

				if (!$order_voucher_query->num_rows())
				{
					$status = false;
				}
			}

			$voucher_history_query = $this->db->query("SELECT SUM(amount) AS total FROM `voucher_history` vh WHERE vh.voucher_id = '" . (int)$voucher_query->row('voucher_id') . "' GROUP BY vh.voucher_id");

			if ($voucher_history_query->num_rows())
			{
				$amount = $voucher_query->row('amount') + $voucher_history_query->row('total');
			} 
			else 
			{
				$amount = $voucher_query->row('amount');
			}

			if ($amount <= 0) 
			{
				$status = false;
			}
		} 
		else 
		{
			$status = false;
		}

		if ($status) {
			return array(
				'voucher_id'       => $voucher_query->row('voucher_id'),
				'code'             => $voucher_query->row('code'),
				'from_name'        => $voucher_query->row('from_name'),
				'from_email'       => $voucher_query->row('from_email'),
				'to_name'          => $voucher_query->row('to_name'),
				'to_email'         => $voucher_query->row('to_email'),
				'voucher_theme_id' => $voucher_query->row('voucher_theme_id'),
				'theme'            => $voucher_query->row('theme'),
				'message'          => $voucher_query->row('message'),
				'image'            => $voucher_query->row('image'),
				'amount'           => $amount,
				'status'           => $voucher_query->row('status'),
				'date_added'       => $voucher_query->row('date_added')
			);
		}
	}

	public function getTotal(&$total_data, &$total, &$taxes) 
	{
		if ($this->session->userdata('voucher') !== NULL) 
		{
			$voucher_info = $this->getVoucher($this->session->userdata('voucher'));

			if ($voucher_info) 
			{
				if ($voucher_info['amount'] > $total) {
					$amount = $total;
				} else {
					$amount = $voucher_info['amount'];
				}

				if ($amount > 0) {
					$total_data[] = array(
						'code'       => 'voucher',
						'title'      => sprintf(' Voucher (%s)', $this->session->userdata('voucher')),
						'value'      => -$amount,
						'sort_order' => 1
					);

					$total -= $amount;
				} else {
					$this->session->unset_userdata('voucher');
				}
			} else {
				$this->session->unset_userdata('voucher');
			}
		}
	}

	public function confirm($order_info, $order_total) 
	{
		$code = '';

		$start = strpos($order_total['title'], '(') + 1;
		$end = strrpos($order_total['title'], ')');

		if ($start && $end) {
			$code = substr($order_total['title'], $start, $end - $start);
		}

		if ($code) {
			$voucher_info = $this->getVoucher($code);

			if ($voucher_info) {
				$this->db->query("INSERT INTO `voucher_history` SET voucher_id = '" . (int)$voucher_info['voucher_id'] . "', order_id = '" . (int)$order_info['order_id'] . "', amount = '" . (float)$order_total['value'] . "', date_added = NOW()");
			} else {
	            return $this->common->config('config_fraud_status_id');
	        }
		}
	}

	public function unconfirm($order_id) {
		$this->db->query("DELETE FROM `voucher_history` WHERE order_id = '" . (int)$order_id . "'");
	}
}
