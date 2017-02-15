<?php

/**
 * Category Model Class
 * Collection of various common function related to category database operation.
 *
 * @author    Mitesh
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
		$query = $this->db->query("SELECT *, (SELECT DISTINCT keyword FROM url_alias WHERE query = 'category_id=" . (int)$category_id . "') AS seo_keywords FROM category where category_id =".(int)$category_id);

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
		$is_deleted = $this->input->post('is_deleted');
		if(isset($is_deleted))
		{
   			$is_deleted = 1;
		}
		else
		{
   			$is_deleted = 0;
		}
                
      	$parent_id=$this->input->post('parent_id');
        //------Start Opencart Logic
        $this->db->set('category_name',$this->input->post('category_name'));
        $this->db->set('description',$this->input->post('description'));	
        $this->db->set('meta_title',$this->input->post('meta_title'));
        $this->db->set('meta_description',$this->input->post('meta_description'));				
        $this->db->set('meta_keyword',$this->input->post('meta_keyword'));
        //$this->db->set('seo_keywords',$this->input->post('seo_keywords'));
        $this->db->set('image',$this->input->post('image'));
        $this->db->set('top',(int)$this->input->post('top'));
        $this->db->set('parent_id',$this->input->post('parent_id'));
        $this->db->set('columns',$this->input->post('columns'));
        $this->db->set('sort_order',$this->input->post('sort_order'));
        $this->db->set('status',$this->input->post('status'));	
        $this->db->set('is_deleted',$is_deleted);
        $this->db->set('date_added',date('Y-m-d h:i:sa'));
        $this->db->set('added_by',$this->session->userdata('Duser_id'));
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by',$this->session->userdata('Duser_id'));
        $this->db->insert('category');
        $category_id = $this->db->insert_id();
        //-------------Start 
		// MySQL Hierarchical Data Closure Table Pattern
		$level = 0;
		$query = $this->db->query("SELECT * FROM `category_path` WHERE category_id = '" . (int)$parent_id . "' ORDER BY `level` ASC");
		foreach ($query->result_array() as $result)
		{
			$this->db->query("INSERT INTO `category_path` SET `category_id` = '" . (int)$category_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");
			$level++;
		}
		$this->db->query("INSERT INTO `category_path` SET `category_id` = '" . (int)$category_id . "', `path_id` = '" . (int)$category_id . "', `level` = '" . (int)$level . "'");
        //------End 
		//Filter
        if($this->input->post('product_filter') !== NULL) {
            foreach($this->input->post('product_filter') as $filter_id) {
                $this->db->set('category_id',(int)$category_id);
                $this->db->set('filter_id',(int)$filter_id);
                $this->db->insert('category_filter');
            }
        }

        if ($this->input->post('seo_keywords') !=="" && $category_id !== "") 
        {
			$this->db->query("INSERT INTO url_alias SET query = 'category_id=" . (int)$category_id . "', keyword = '" . $this->input->post('seo_keywords') . "'");
		}

        return $category_id;  
                	
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
        $is_deleted = $this->input->post('is_deleted');
        if(isset($is_deleted))
        {
                $is_deleted = 1;
        }
        else
        {
                $is_deleted = 0;
        }
        
        $this->db->set('category_name',$this->input->post('category_name'));
        $this->db->set('description',$this->input->post('description'));	
        $this->db->set('meta_title',$this->input->post('meta_title'));
        $this->db->set('meta_description',$this->input->post('meta_description'));	
        $this->db->set('meta_keyword',$this->input->post('meta_keyword'));
        //$this->db->set('seo_keywords',$this->input->post('seo_keywords'));
        $this->db->set('image',$this->input->post('image'));
        $this->db->set('top',(int)$this->input->post('top'));
        $this->db->set('parent_id',$this->input->post('parent_id'));
        $this->db->set('columns',$this->input->post('columns'));
        $this->db->set('sort_order',$this->input->post('sort_order'));
        $this->db->set('status',$this->input->post('status'));
        $this->db->set('is_deleted',$is_deleted);
        $this->db->set('date_modified',date('Y-m-d h:i:sa'));
        $this->db->set('modified_by',$this->session->userdata('Duser_id'));
        $this->db->where('category_id',(int)$this->input->post('category_id'));		
        $res=$this->db->update('category');	            
          
		//category_path
       if($this->input->post('category_id')!==NULL)
		{
			$parent_id=$this->input->post('parent_id');
			
			$this->db->from('category_path');
			$this->db->where('path_id=',(int)$this->input->post('category_id'));
			$this->db->order_by('level','ASC');
			$query=$this->db->get();					
			$res_category_path=$query->result_array();

			$category_id = $this->input->post('category_id');
			if (count($res_category_path)>0)
			{
				foreach ($res_category_path as $category_path) 
				{
					// Delete the path below the current one
					$this->db->query("DELETE FROM `category_path` WHERE category_id = '" . (int)$category_path['category_id'] . "' AND level < '" . (int)$category_path['level'] . "'");

					$path = array();

					// Get the nodes new parents
					$query = $this->db->query("SELECT * FROM `category_path` WHERE category_id = '" . (int)$parent_id . "' ORDER BY level ASC");

					foreach ($query->result_array() as $result) {
						$path[] = $result['path_id'];
					}

					// Get whats left of the nodes current path
					$query = $this->db->query("SELECT * FROM `category_path` WHERE category_id = '" . (int)$category_path['category_id'] . "' ORDER BY level ASC");

					foreach ($query->result_array() as $result) {
						$path[] = $result['path_id'];
					}

					// Combine the paths with a new level
					$level = 0;

					foreach ($path as $path_id) {
						$this->db->query("REPLACE INTO `category_path` SET category_id = '" . (int)$category_path['category_id'] . "', `path_id` = '" . (int)$path_id . "', level = '" . (int)$level . "'");

						$level++;
					}
				}
			}
			else
			{
				// Delete the path below the current one
				$this->db->query("DELETE FROM `category_path` WHERE category_id = '" . (int)$category_id . "'");

				// Fix for records with no paths
				$level = 0;

				$query = $this->db->query("SELECT * FROM `category_path` WHERE category_id = '" . (int)$parent_id . "' ORDER BY level ASC");

				foreach ($query->result_array() as $result)
				{
					$this->db->query("INSERT INTO `category_path` SET category_id = '" . (int)$category_id . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

					$level++;
				}

				$this->db->query("REPLACE INTO `category_path` SET category_id = '" . (int)$category_id . "', `path_id` = '" . (int)$category_id . "', level = '" . (int)$level . "'");
			}
		

		
		}
		 //Filter
        $this->db->query("DELETE FROM category_filter WHERE category_id = '".(int)$this->input->post('category_id')."'");
        if($this->input->post('product_filter') !== NULL) 
        {
            foreach($this->input->post('product_filter') as $filter_id) 
            {
                $this->db->set('category_id',(int)$this->input->post('category_id'));
                $this->db->set('filter_id',(int)$filter_id);
                $this->db->insert('category_filter');
            }
        }
         $this->db->query("DELETE FROM url_alias WHERE query = 'category_id=" . (int)$category_id . "'");

        if ($this->input->post('seo_keywords') !=="" && $category_id !== "") 
        {
			$this->db->query("INSERT INTO url_alias SET query = 'category_id=" . (int)$category_id . "', keyword = '" . $this->input->post('seo_keywords') . "'");
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
	public function softDeleteCategories($category_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('category_id',(int)$category_id);
		return $this->db->update('category');
	}
	
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

		//delete record from product_category table		
		$this->db->where('category_id',(int)$category_id);
		return $this->db->delete('product_category');

		//delete record from coupon_category table		
		$this->db->where('category_id',(int)$category_id);
		return $this->db->delete('coupon_category');		
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
		$sql = "SELECT cp.category_id AS category_id, GROUP_CONCAT(c2.category_name ORDER BY cp.level SEPARATOR ' > ') AS category_name, c1.parent_id, c1.sort_order, c1.is_deleted 
			FROM category_path cp 
			LEFT JOIN category c1 ON (cp.category_id = c1.category_id) 
			LEFT JOIN category c2 ON (cp.path_id = c2.category_id) 
			where 1=1"; 
			
		$implode = array();
		$sort_data = array(
			'category_name',			
			'sort_order'			
		);
		if($this->session->userdata('Drole_id')!=1)
		{
			$sql .= " AND c1.is_deleted = 0";
		}
		if (!empty($data['category_name'])) {
			$implode[] = "c1.category_name LIKE '%" . $data['category_name'] . "%'";
		}

		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}
		$sql .= " GROUP BY cp.category_id";
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
                //echo $this->db->last_query();
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
		if($this->session->userdata('Drole_id')!=1)
		{
			$sql .= " WHERE is_deleted = 0";
		}
		$query = $this->db->query($sql);

		return $query->row('total');
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
		if(isset($data['category_name']))
		{
			$category_name=$data['category_name'];
		}
		else
		{
			$category_name = "";
		}
		
		$query=$this->db->query("SELECT cp.category_id AS category_id, GROUP_CONCAT(c2.category_name ORDER BY cp.level SEPARATOR ' > ') AS category_name, c1.parent_id, c1.sort_order, c1.is_deleted FROM category_path cp LEFT JOIN category c1 ON (cp.category_id = c1.category_id) LEFT JOIN category c2 ON (cp.path_id = c2.category_id) where c1.is_deleted = 0 AND c1.category_name like '%".$category_name."%'  GROUP BY c1.category_id ORDER BY c2.category_name ASC LIMIT 0,20");
					
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
        
        public function getProductFilters($filter_id) {
            $product_filter_data = array();

            $query = $this->db->query("SELECT * FROM category_filter WHERE category_id = '" . (int)$filter_id . "'");

            foreach ($query->result_array() as $result) {
                $product_filter_data[] = $result['filter_id'];
            }
            return $product_filter_data;
	}        
    
    
	
	/**
	* 
	* @function name : getTotalCategoryByFilterId()
	* @description   : get product record by category_id
	* @access        : public
	* @param   	     : int $category_id
	* @return        : int total no of records
	*
	*/
	public function getTotalCategoryByFilterId($category_id) 
	{
		$getFilterGroupId = $this->db->query("SELECT filter_id FROM filter WHERE filter_group_id = '".(int)$category_id."'");
		$getFilterGroupData = $getFilterGroupId->result_array();
		foreach ($getFilterGroupData as $filterId) {            
			$sql = "SELECT COUNT(*) AS total FROM category_filter WHERE filter_id = '".(int)$filterId['filter_id']."'";
			$query = $this->db->query($sql);           
		}
		return $query->row('total');     
	}  
	
}