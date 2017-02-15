<?php

/**
 * Category Model Class
 * Collection of various common function related to category database operation.
 *
 * @author    RITESH
 * @license   http://www.vpninfotech.com/
 */
class Category_model extends CI_Model 
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
	* @function name 	: getCategory()
	* @description   	: get category group record by category_id
	* @access 		 	: public
	* @param   		 	: int $category_id The category id that you want
	* @return       	: array The selected category array
	*
	*/
	public function getCategory($category_id)
    {
		$this->db->from('category');
		$this->db->where('category_id',(int)$category_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	
	/**
	* 
	* @function name 	: getCategoryFilter()
	* @description   	: get category id record by category_id from category_filter table
	* @access 		 	: public
	* @param   		 	: int $category_id The category id that you want
	* @return       	: array The selected category array
	*
	*/
	public function getCategoryFilter($category_id)
    {
		$this->db->from('category_filter');
		$this->db->where('category_id',(int)$category_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	
	/**
	* 
	* @function name 	: getCategoryProduct()
	* @description   	: get category id record by category_id from product_category table
	* @access 		 	: public
	* @param   		 	: int $category_id The category id that you want
	* @return       	: array The selected category array
	*
	*/
	public function getCategoryProduct($category_id)
    {
		$this->db->from('product_category');
		$this->db->where('category_id',(int)$category_id);
		$query=$this->db->get();
		return $query->row_array();
    }
	
	/**
	* 
	* @function name 	: getCategoryFilters()
	* @description   	: get Category Filters record by category_id
	* @access 		 	: public
	* @param   		 	: int $category_id The category id that you want
	* @return       	: array The selected category array
	*
	*/
	public function getCategoryFilters($category_id)
    {
		$this->db->from('category_filter');
		$this->db->where('category_id',(int)$category_id);
		$query=$this->db->get();
		//return $query->row_array();
		return $query->result_array();
    }
	
	/**
	* 
	* @function name 	: addcategory()
	* @description   	: add Attributes record in database
	* @access 		 	: public
	* @return       	: int last inserted Attributes record id
	*
	*/
	public function addcategory()
	{		
		
		$get_category_name=$this->input->post('category_name');
		if(isset($get_category_name) || !empty($get_category_name))
		{
			$where="category_name='$get_category_name'";
			$this->db->select('*');
			$this->db->from('category');
			$this->db->where($where);
			$exists=$this->db->get();
						
			if($exists->num_rows() < 1)
			{
				$this->db->set('category_name',$this->input->post('category_name'));
				$this->db->set('description',$this->input->post('description'));	
				$this->db->set('meta_title',$this->input->post('meta_title'));
				$this->db->set('meta_description',$this->input->post('meta_description'));				
				$this->db->set('meta_keyword',$this->input->post('meta_keyword'));
				$this->db->set('seo_keywords',$this->input->post('seo_keywords'));
				$this->db->set('image',$this->input->post('image'));
				$this->db->set('parent_id',$this->input->post('parent_id'));
				$this->db->set('columns',$this->input->post('columns'));
				$this->db->set('sort_order',$this->input->post('sort_order'));
				$this->db->set('status',$this->input->post('status'));			
				$this->db->set('date_added',date('Y-m-d h:i:sa'));
				$this->db->set('added_by',$this->session->userdata('Muser_id'));
				$this->db->set('date_modified',date('Y-m-d h:i:sa'));
				$this->db->set('modified_by',$this->session->userdata('Muser_id'));
				$this->db->insert('category');
				
				$last_record_id=$this->db->insert_id();				
				if($last_record_id)
				{
					$filter_id=$this->input->post('filter_id');
					$category_array=$this->input->post('category_filter');
					if(count($category_array) > 0)
					{				
						for($i=0;$i<count($category_array);$i++)
						{	
							$this->db->set('category_id',$last_record_id);
							$this->db->set('filter_id',$category_array[$i]);
							$this->db->insert('category_filter');
						}
					}
				}
				
				//category_path
				if($last_record_id)
				{
					$parent_id=$this->input->post('parent_id');
					
					$this->db->from('category_path');
					$this->db->where('category_id=',$parent_id);
					$this->db->order_by('level','ASC');
					$query=$this->db->get();					
				
					$res=$query->result_array();
					
					$level=0;
					foreach($res as $result)
					{						
						$this->db->set('category_id',$last_record_id);
						$this->db->set('path_id',$result['path_id']);
						$this->db->set('level',$level);
						$this->db->insert('category_path');
						$level++;
					}
					$this->db->set('category_id',$last_record_id);
					$this->db->set('path_id',$last_record_id);
					$this->db->set('level',$level);
					$this->db->insert('category_path');
				
				}
				
				return $last_record_id;
			}
			
		}		
	}
	
		
	/**
	* 
	* @function name 	: editCategories()
	* @description   	: edit categories record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editCategories()
	{			
		$this->db->set('category_name',$this->input->post('category_name'));
		$this->db->set('description',$this->input->post('description'));	
		$this->db->set('meta_title',$this->input->post('meta_title'));
		$this->db->set('meta_description',$this->input->post('meta_description'));	
		$this->db->set('meta_keyword',$this->input->post('meta_keyword'));
		$this->db->set('seo_keywords',$this->input->post('seo_keywords'));
		$this->db->set('image',$this->input->post('image'));
		$this->db->set('parent_id',$this->input->post('parent_id'));
		$this->db->set('columns',$this->input->post('columns'));
		$this->db->set('sort_order',$this->input->post('sort_order'));
		$this->db->set('status',$this->input->post('status'));	
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('Muser_id'));
		$this->db->where('category_id',(int)$this->input->post('category_id'));		
		$res=$this->db->update('category');	
		
		$category_id=$this->input->post('category_id');
		$this->db->where('category_id',(int)$this->input->post('category_id'));
		$this->db->delete('category_filter');
							
		if($category_id)
		{
			$filter_id=$this->input->post('filter_id');
			$category_array=$this->input->post('category_filter');
			if(count($category_array) > 0)
			{				
				for($i=0;$i<count($category_array);$i++)
				{	
					$this->db->set('category_id',$category_id);
					$this->db->set('filter_id',$category_array[$i]);
					$this->db->insert('category_filter');
				}
			}
		}	
		
		$this->db->where('category_id',(int)$this->input->post('category_id'));
		$this->db->delete('category_path');
		//category_path
		if($category_id)
		{
			$parent_id=$this->input->post('parent_id');
			
			$this->db->from('category_path');
			$this->db->where('category_id=',$parent_id);
			$this->db->order_by('level','ASC');
			$query=$this->db->get();					
		
			$res_category_path=$query->result_array();
			
			$level=0;
			foreach($res_category_path as $result)
			{						
				$this->db->set('category_id',$category_id);
				$this->db->set('path_id',$result['path_id']);
				$this->db->set('level',$level);
				$this->db->insert('category_path');
				$level++;
			}
			$this->db->set('category_id',$category_id);
			$this->db->set('path_id',$category_id);
			$this->db->set('level',$level);
			$this->db->insert('category_path');
		
		}
		
		return $res;	
		
	}
	
	
	/**
	* 
	* @function name 	: softDeleteCategories()
	* @description   	: only status change not actual delete attributes from database
	* @access 		 	: public
	* @param   		 	: int $attribute_id The attribute id that you want to delete
	* @return       	: void
	*
	*/
	/*public function softDeleteCategories($category_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('category_id',(int)$category_id);
		return $this->db->update('category');
	}*/
	
	/**
	* 
	* @function name 	: deletecategories()
	* @description   	: delete attribute record from database
	* @access 		 	: public
	* @param   		 	: int $attribute_id The attribute id that you want to delete
	* @return       	: void
	*
	*/
	public function deletecategories($category_id) 
	{
		//delete record from category_filter table
		$this->db->where('category_id',(int)$category_id);
		$this->db->delete('category_filter');
		
		//delete record from category_path table		
		$this->db->where('category_id',(int)$category_id);
		$this->db->delete('category_path');
				
		//delete record from category table		
		$this->db->where('category_id',(int)$category_id);
		return $this->db->delete('category');		
	} 
	
	/**
	* 
	* @function name 	: getAttributesByCode()
	* @description   	: get attribute record by attribute code
	* @access 		 	: public
	* @param   		 	: string $attribute_id The attribute group code that you want to get
	* @return       	: array The selected attribute array
	*
	*/
	public function getAttributesByCode($attribute_id) 
	{
		$this->db->where('code',$attribute_id);
		$query=$this->db->get();
		return $query->row_array();
	}
	
	/**
	* 
	* @function name 	: getCategories()
	* @description   	: get all categories from database
	* @access 		 	: public
	* @param   		 	: string $categories The categories that you want to get
	* @return       	: array The selected categories array
	*
	*/
	public function getCategories($data = array())
	{
		$sql = "SELECT * FROM category";

		$sort_data = array(
			'category_name',			
			'sort_order'			
		);
		if($this->session->userdata('Mrole_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY category_name";
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
	* @function name 	: getTotalCategories()
	* @description   	: get total no of categories from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalCategories() 
	{
		$sql = "SELECT COUNT(*) AS total FROM category";
		if($this->session->userdata('Mrole_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	
	/**
	* 
	* @function name 	: getAllProducts()
	* @description   	: get total no of product id and product name for categories from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getAllProducts()
	{
		$this->db->select('product_id,product_name');
		$this->db->from('product');		
		$query=$this->db->get();
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTermProducts()
	* @description   	: get autocomplete terms related product id and product name for categories from database
	* @access 		 	: public
	* @return       	: related product id and product namein array format
	*
	*/
	public function getTermProducts($term)
	{
		$this->db->select('category_id,category_name');
		$this->db->from('category');
		$this->db->where('parent_id=', 0);		
		$this->db->like('category_name', $term);		
		$query=$this->db->get();
		//return $query->result_array();
		return $query->result_array();
	}
	
	
	/**
	* 
	* @function name 	: getCategoryByName()
	* @description   	: get category by name record by category_name
	* @access 		 	: public
	* @param   		 	: int $category_name The category name that you want
	* @return       	: array The selected category name array
	*
	*/
	public function getCategoryByName($data = array())
	{
		//SELECT * FROM `category` WHERE `category_name` LIKE '%c%';
		
		/*$this->db->select('*');
		$this->db->from('category');
		$this->db->like('category_name',$data['category_name'],'both');
		$query=$this->db->get();
		
		return $query->result_array();	*/
		
		$query=$this->db->query("SELECT cp.category_id AS category_id, GROUP_CONCAT(c2.category_name ORDER BY cp.level SEPARATOR ' > ') AS category_name, c1.parent_id, c1.sort_order FROM category_path cp LEFT JOIN category c1 ON (cp.category_id = c1.category_id) LEFT JOIN category c2 ON (cp.path_id = c2.category_id) where c1.category_name like '%".$data['category_name']."%' GROUP BY c1.category_id ORDER BY c2.category_name ASC LIMIT 0,20");
					
		return $query->result_array();	
		
	}
	
	/**
	* 
	* @function name 	: getParent()
	* @description   	: get parent category by name record by category_name
	* @access 		 	: public
	* @param   		 	: int $category_name The parent category name that you want
	* @return       	: array The selected parent category name array
	*
	*/
	public function getParent($category_id)
	{		
		$this->db->select('c1.category_id,c1.parent_id,c2.category_name');
		$this->db->from('category c1');
		$this->db->join('category c2','c1.category_id = c2.parent_id');
		$this->db->where('c1.category_id=',$category_id);
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		return $query->row_array();	
	}	
	
	
	/**
	* 
	* @function name 	: getPath()
	* @description   	: get path by category id record by category_id
	* @access 		 	: public
	* @param   		 	: int $category_id The parent category id that you want
	* @return       	: array The selected category id array
	*
	*/
	public function getPath($parent_id)
	{		
		/*$this->db->select('cp.category_id,c.category_name');
		$this->db->from('category_path cp');
		$this->db->join('category c','c.category_id=cp.category_id');
		$this->db->where('cp.category_id=',$category_id);
		$this->db->group_by('cp.category_id');*/	
		
		$query=$this->db->query("SELECT cp.category_id AS category_id, GROUP_CONCAT(c2.category_name ORDER BY cp.level SEPARATOR '  >  ') AS category_name, c1.parent_id, c1.sort_order FROM category_path cp LEFT JOIN category c1 ON (cp.category_id = c1.category_id) LEFT JOIN category c2 ON (cp.path_id = c2.category_id) where c1.category_id= '".$parent_id."' GROUP BY c1.category_id ORDER BY c2.category_name ASC LIMIT 0,20");
					
		return $query->result_array();	
	}	
	
	/**
	* 
	* @function name 	: getPath()
	* @description   	: get path by category id record by category_id
	* @access 		 	: public
	* @param   		 	: int $category_id The parent category id that you want
	* @return       	: array The selected category id array
	*
	*/
	public function parent_category_exists($category_id)
	{
		//check the parent id is used by child record		
		$this->db->from('category');
		$this->db->where('parent_id=',$category_id);
		$query=$this->db->get();
		$record_exists=$query->num_rows();
		return	$record_exists;
	}
       
	
}