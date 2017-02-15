<?php

/**
 * review Model Class
 * Collection of various common function related to review database operation.
 *
 * @author   JinalPatel
 * @license   http://www.vpninfotech.com/
 */
class Reviews_model extends CI_Model 
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
	* @function name 	: getReviewById()
	* @description   	: get review record by review_id
	* @access 		 	: public
	* @param   		 	: int $review_id The review_id  that you want
	* @return       	: array The selected review_id array
	*
	*/
	public function getReviewById($review_id)
    {
		$this->db->from('review');
		$this->db->where('review_id',(int)$review_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	
	/**
	* 
	* @function name 	: addReview()
	* @description   	: add Review record in database
	* @access 		 	: public
	* @return       	: int last inserted Review record id
	*
	*/
	public function addReview()
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
                $this->db->set('product_id',$this->input->post('product_id'));
		$this->db->set('author',$this->input->post('author'));
		$this->db->set('text',$this->input->post('text'));
		$this->db->set('rating',$this->input->post('rating'));
                $this->db->set('status',$this->input->post('status'));
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		
                $this->db->set('is_deleted',$is_deleted);
		$this->db->insert('review');
		return $this->db->insert_id();
		 
	}
	
	/**
	* 
	* @function name 	: editReview()
	* @description   	: edit Review record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editReview()
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
		 
		$this->db->set('product_id',$this->input->post('product_id'));
		$this->db->set('author',$this->input->post('author'));
		$this->db->set('text',$this->input->post('text'));
		$this->db->set('rating',$this->input->post('rating'));
	    $this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
	    $this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('Duser_id'));
		$this->db->where('review_id',(int)$this->input->post('review_id'));
		return $this->db->update('review');	
	}
	
	
	/**
	* 
	* @function name 	: softDeleteReview()
	* @description   	: only status change not actual delete Review from database
	* @access 		 	: public
	* @param   		 	: int $review_id The review_id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteCustomer($review_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('review_id',(int)$review_id);
		return $this->db->update('review');
	}
	
	/**
	* 
	* @function name 	: deleteReview()
	* @description   	: delete Review record from database
	* @access 		 	: public
	* @param   		 	: int $review_id The review_id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteReview($review_id) 
	{	
		$this->db->where('review_id',(int)$review_id);
		return $this->db->delete('review');
	} 
	
	
	/**
	* 
	* @function name 	: getReview()
	* @description   	: get all Review from database
	* @access 		 	: public
	* @param   		 	: string $Review The Review code that you want to get
	* @return       	: array The selected Review array
	*
	*/
	public function getReview($data = array())
	{
		$sql = "SELECT * FROM review";

		$sort_data = array(
                    'author',
                    'rating',
                    'status',
                    'date_added'
		);
		if($this->session->userdata('Drole_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY author";
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

		$query = $this->db->query($sql);
		$query->result_array();
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalReview()
	* @description   	: get total no of Review from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalReview() 
	{
		$sql = "SELECT COUNT(*) AS total FROM review";
		if($this->session->userdata('Drole_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
        
        
        public function getProducts($data = array())
	{
		$sql = "SELECT * FROM product";

		$implode = array();

		if (!empty($data['product_name'])) {
			$implode[] = "product_name LIKE '%" . $data['product_name'] . "%'";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}
                
		$sort_data = array(
			'product_name'
		);
                
		if($this->session->userdata('Drole_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
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

		$query = $this->db->query($sql);
		$query->result_array();
		return $query->result_array();
	}
        
        public function getReviews($review_id) {
            $query = $this->db->query("SELECT *, (SELECT p.product_name FROM product p WHERE p.product_id = r.product_id) AS product FROM review r WHERE r.review_id = '".(int)$review_id."'");
            
            return $query->row_array();
	}

    
}
