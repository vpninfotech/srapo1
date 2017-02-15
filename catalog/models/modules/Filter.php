<?php
/**
 * Filter Class
 * Filter Class Provide a Product list of Filter data
 *
 * @author    Nitin Sabhadiya
 * @license   http://www.vpninfotech.com/
 */
class Filter extends CI_Model 
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
	* @function name 	: getFilter()
	* @description   	: get Filter Products
	* @access 		 	: public
	* @param   		 	: void
	* @return       	: array The Filter
	*
	*/
	public function getFilter($category_id,$filterdata,$data=array()) 
	{
		$this->load->model('catalog/category','category');
		$category_info = $this->category->getCategory($category_id);
		if ($category_info) 
		{
			if ($this->input->get('filter')!==NULL) {
				$data['filter_category'] = explode(',', $filterdata);
			} else {
				$data['filter_category'] = array();
			}
			
			$this->load->model('catalog/product','product');
			$data['filter_groups'] = array();

			$filter_groups = $this->category->getCategoryFilters($category_id);
			$data['categorie'] = $this->category->getCategories($category_id);
		if ($filter_groups) {
				foreach ($filter_groups as $filter_group) {
					$childen_data = array();

					foreach ($filter_group['filter'] as $filter) {
						$filter_data = array(
							'filter_category_id' => $category_id,
							'filter_filter'      => $filter['filter_id']
						);

						$childen_data[] = array(
							'filter_id' => $filter['filter_id'],
							'name'      => $filter['name']
						);
					}

					$data['filter_groups'][] = array(
						'filter_group_id' => $filter_group['filter_group_id'],
						'name'            => $filter_group['name'],
						'filter'          => $childen_data
					);
				}
//echo '<pre>';print_r($data);die;
				return $data;
			}
		}
	}
}