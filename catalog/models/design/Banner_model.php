<?php
/**
 * Category Model Class
 * Collection of various common function related to category database operation.
 *
 * @author    Indrajit Kaplatiya
 * @license   http://www.vpninfotech.com/
 */
class Banner_model extends CI_Model 
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
	
	public function getBanner($page_name,$layout,$category_id = '',$position = '') 
	{
		$sql = "SELECT * FROM banner b where 1=1 AND b.select_page ='".strtolower($page_name)."' AND b.layout='".strtolower($layout)."' AND b.status = 1 AND b.is_deleted = 0";
		if($category_id !== "")
		{
			$sql.=" And b.select_category=".(int)$category_id;	
		}

		if($position !== "")
		{
			$sql.=" And b.position='".strtolower($position)."'";	
		}

		$sql.= " LIMIT 1";

		$query = $this->db->query($sql);
		$image_data =array();
		if($query->num_rows() > 0)
		{
			$result = $this->db->query("SELECT * FROM banner_image bi  WHERE bi.banner_id = '" . (int)$query->row('banner_id') . "' ORDER BY bi.sort_order ASC");

			return $result ->result_array();
		}
		
		return $image_data;
	}
}