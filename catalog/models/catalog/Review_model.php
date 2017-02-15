<?php
/**
 * Review Model Class
 * Collection of various common function related to Review database operation.
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Review_model extends CI_Model 
{
	/**
	* 
	* @function name 	: __construct()
	* @description   	: initialize variables
	* @param   		 	: void
	* @return        	: void
	*
	*/	
	function __construct()
	{
		parent::__construct();
		
	}
	
	/**
	* 
	* @function name 	: getReviewsByProductId()
	* @description   	: get Review record by Product id
	* @access 		 	: public
	* @param   		 	: int $product_id The product id that you want to review
	* @param   		 	: int $start Start point of review records
	* @param   		 	: int $end End Point of review records
	* @return       	: array The selected review
	*
	*/
	public function getReviewsByProductId($product_id, $start = 0, $limit = 20) 
	{
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 20;
		}

		$query = $this->db->query("SELECT r.review_id, r.author, r.rating, r.text, p.product_id, p.product_name, p.price, p.image, r.date_added FROM review r LEFT JOIN product p ON (r.product_id = p.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND p.date_available <= NOW() AND p.status = '1' AND r.status = '1' ORDER BY r.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalReviewsByProductId()
	* @description   	: get Toal Review record by Product id
	* @access 		 	: public
	* @param   		 	: int $product_id The product id that you want to Total review
	* @return       	: int Total review
	*
	*/
	public function getTotalReviewsByProductId($product_id) 
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM review r LEFT JOIN product p ON (r.product_id = p.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND p.date_available <= NOW() AND p.status = '1' AND r.status = '1'");

		return $query->row()->total;
	}
	
	/**
	* 
	* @function name 	: addReview()
	* @description   	: Add Review Records
	* @access 		 	: public
	* @param   		 	: int $product_id The product id that you want to add review
	* @param   		 	: Array $data Review records data
	* @return       	: void
	*
	*/
	public function addReview($product_id, $data) 
	{
		// Add Data in Review table
		$this->db->set('author',$data['name']);
		$this->db->set('customer_id','');
		$this->db->set('product_id',(int)$product_id);
		$this->db->set('text',$data['text']);
		$this->db->set('rating',(int)$data['rating']);
		$this->db->set('date_added',date('Y-m-d'));
		$this->db->insert('review');
		
		// Send Alert Mail
		if (in_array('review', (array)$this->common->config('config_mail_alert'))) 
		{
			$this->load->model('catalog/product','product');
			
			$product_info = $this->product->getProduct($product_id);

			$subject = sprintf('%s - Product Review', $this->common->config('config_name'));

			$message  = 'You have a new product review waiting.' . "\n";
			$message .= sprintf('Product: %s', $product_info['name']) . "\n";
			$message .= sprintf('Reviewer: %s', $data['name']) . "\n";
			$message .= sprintf('Rating: %s', $data['rating']) . "\n";
			$message .= 'Review Text:' . "\n";
			$message .= $data['text'] . "\n\n";
			
			// Send Email
			 $Template = $this->mailer->Tpl_Email('general_message_format',$this->commons->encode($email));
			$Receipient = $this->common->config('config_email');
			$Filter = array(
                            '{{NAME}}' =>$data['name'],
                            '<< SUBJECT>>' =>$subject,
                            '{{MESSAGE}}' =>$message
                        );
            $this->mailer->Send_Singal_Html_Email($Recipient,$Template,$Filter);
			

			// Send to additional alert emails
			$emails = explode(',', $this->common->config('config_alert_email'));

			foreach ($emails as $email) {
				if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$this->mailer->Send_Singal_Html_Email($email,$Template,$Filter);
				}
			}
		}
	}
}