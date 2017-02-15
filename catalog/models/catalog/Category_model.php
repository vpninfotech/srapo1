<?php
/**
 * Category Model Class
 * Collection of various common function related to category database operation.
 *
 * @author    Nitin Sabhadiya
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
	function __construct()
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
		//$query = $this->db->query("SELECT DISTINCT * FROM category WHERE category_id = '" . (int)$category_id . "' AND c.status = '1'");
		$query = $this->db->query("SELECT *, (SELECT DISTINCT keyword FROM url_alias WHERE query = 'category_id=" . (int)$category_id . "') AS seo_keywords FROM category where category_id =".(int)$category_id. " AND status = '1'");
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getCategories()
	* @description   	: get category group record by parent Id
	* @access 		 	: public
	* @param   		 	: int $parent_id The parent id that you want
	* @return       	: array The selected category array
	*
	*/
	public function getCategories($parent_id = 0)
	{
		$query = $this->db->query("SELECT * FROM category c WHERE c.parent_id = '" . (int)$parent_id . "' AND c.status = '1' ORDER BY c.sort_order, LCASE(c.category_name)");

		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getCategoryFilters()
	* @description   	: get category group record by category_id
	* @access 		 	: public
	* @param   		 	: int $category_id The category id that you want
	* @return       	: array The selected category array
	*
	*/
	public function getCategoryFilters($category_id)
	{
		$implode = array();

		$query = $this->db->query("SELECT filter_id FROM category_filter WHERE category_id = '" . (int)$category_id . "'");

		foreach ($query->result_array() as $result) {
			$implode[] = (int)$result['filter_id'];
		}

		$filter_group_data = array();

		if ($implode) {
			$filter_group_query = $this->db->query("SELECT DISTINCT f.filter_group_id, fg.filter_group_name, fg.sort_order FROM filter f LEFT JOIN filter_group fg ON (f.filter_group_id = fg.filter_group_id) WHERE f.filter_id IN (" . implode(',', $implode) . ") GROUP BY f.filter_group_id ORDER BY fg.sort_order, LCASE(fg.filter_group_name)");

			foreach ($filter_group_query->result_array() as $filter_group) {
				$filter_data = array();

				$filter_query = $this->db->query("SELECT DISTINCT f.filter_id, f.filter_name FROM filter f WHERE f.filter_id IN (" . implode(',', $implode) . ") AND f.filter_group_id = '" . (int)$filter_group['filter_group_id'] . "' ORDER BY f.sort_order, LCASE(f.filter_name)");

				foreach ($filter_query->result_array() as $filter) {
					$filter_data[] = array(
						'filter_id' => $filter['filter_id'],
						'name'      => $filter['filter_name']
					);
				}

				if ($filter_data) {
					$filter_group_data[] = array(
						'filter_group_id' => $filter_group['filter_group_id'],
						'name'            => $filter_group['filter_group_name'],
						'filter'          => $filter_data
					);
				}
			}
		}

		return $filter_group_data;
	}
	
	/**
	* 
	* @function name 	: getTotalCategoriesByCategoryId()
	* @description   	: get Total Categories by category_id
	* @access 		 	: public
	* @param   		 	: int $parent_id The parent id that you want
	* @return       	: int Total numver of category
	*
	*/
	public function getTotalCategoriesByCategoryId($parent_id = 0) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM category c WHERE c.parent_id = '" . (int)$parent_id . "' AND c.status = '1'");

		return $query->row()->total;
	}
}