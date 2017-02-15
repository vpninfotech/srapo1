<?php

/**
 * Banner Model Class
 * Collection of various common function related to option database operation.
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
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	* 
	* @function name 	: getBanner()
	* @description   	: get banner record by banner_id
	* @access 		 	: public
	* @param   		 	: int $banner_id The option id that you want
	* @return       	: array The selected option array
	*
	*/
	public function getBanner($banner_id)
    {
		$this->db->select('b.*');
		$this->db->from('banner b');
		$this->db->join('banner_image bi','bi.banner_id=b.banner_id','left');
		$this->db->where('b.banner_id',(int)$banner_id);
		$query=$this->db->get();
		$res=$query->row_array();
		//echo $this->db->last_query();exit;
		return  $res;
    }
	/**
	* 
	* @function name 	: getBannerList()
	* @description   	: get banner list record by banner_id
	* @access 		 	: public
	* @param   		 	: int $banner_id The banner id that you want
	* @return       	: array The selected banner array
	*
	*/
	public function getBannerList($banner_id)
    {
		$this->db->from('banner');
		$this->db->where('banner_id',(int)$banner_id);
		$query=$this->db->get();
		return $query->result_array();
    }
    /**
	* 
	* @function name 	: getBannerImageList()
	* @description   	: get banner Image Value list record by banner_id
	* @access 		 	: public
	* @param   		 	: int $banner_id The banner id that you want
	* @return       	: array The selected banner Image array
	*
	*/
	public function getBannerImageList($banner_id)
    {
		$this->db->from('banner_image');
		$this->db->where('banner_id',(int)$banner_id);
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result_array();
    }
    
	/**
	* 
	* @function name 	: addBanner()
	* @description   	: add Banner record in database
	* @access 		 	: public
	* @return       	: int last inserted banner record id
	*
	*/
	public function addBanner()
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
		$this->db->set('select_page',$this->input->post('select_page'));
		$this->db->set('layout',$this->input->post('select_layout'));
		if($this->input->post('select_layout') === 'category')
		{
			$this->db->set('select_category',$this->input->post('select_category'));
			$this->db->set('position',$this->input->post('select_position'));
		}
		$this->db->set('banner_name',$this->input->post('banner_name'));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_added',date('Y-m-d h:i:sa'));
		$this->db->set('added_by',$this->session->userdata('Duser_id'));
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('Duser_id'));
		$this->db->insert('banner');
		$banner_id = $this->db->insert_id();
		$banner_list=$this->input->post('banner_value');
		if(count($banner_list)>0)
		{
			foreach ($banner_list as $key => $value) {
				$this->db->set('banner_id',$banner_id);
				$this->db->set('title',$value['title']);
				$this->db->set('link',$value['link']);
				$this->db->set('image',$value['image']);
				$this->db->set('sort_order',$value['sort_order']);
				$this->db->set('is_deleted',$is_deleted);
				$this->db->set('date_added',date('Y-m-d h:i:sa'));
				$this->db->set('added_by',$this->session->userdata('Duser_id'));
				$this->db->set('date_modified',date('Y-m-d h:i:sa'));
				$this->db->set('modified_by',$this->session->userdata('Duser_id'));
				$this->db->insert('banner_image');
			}
		}
		return $banner_id;
		
	}
	
	/**
	* 
	* @function name 	: editOption()
	* @description   	: edit option record in database
	* @access 		 	: public
	* @return       	: void
	*
	*/
	public function editBanner()
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
		$banner_id = $this->input->post('banner_id');
		$H_select_layout = $this->input->post('H_select_layout');
		if($H_select_layout === 'category')
		{
			$this->db->set('select_category',0);
			$this->db->set('position','');
			$this->db->where('banner_id',(int)$banner_id);
			$this->db->update('banner');
		}
		$this->db->set('select_page',$this->input->post('select_page'));
		$this->db->set('layout',$this->input->post('select_layout'));
		if($this->input->post('select_layout') === 'category')
		{
			$this->db->set('select_category',$this->input->post('select_category'));
			$this->db->set('position',$this->input->post('select_position'));
		}
		$this->db->set('banner_name',$this->input->post('banner_name'));
		$this->db->set('status',$this->input->post('status'));
		$this->db->set('is_deleted',$is_deleted);
		$this->db->set('date_modified',date('Y-m-d h:i:sa'));
		$this->db->set('modified_by',$this->session->userdata('Duser_id'));
		$this->db->where('banner_id',(int)$banner_id);
		$this->db->update('banner');
		
		if ($this->db->affected_rows() > 0)
		{
			// Record deleted in filter table by filter_group_id
				$this->db->where('banner_id',(int)$banner_id);
				$this->db->delete('banner_image');
			$banner_list=$this->input->post('banner_value');
			if(count($banner_list)>0)
			{
				
				foreach ($banner_list as $key => $value) {
				$this->db->set('banner_id',$banner_id);
				$this->db->set('title',$value['title']);
				$this->db->set('link',$value['link']);
				$this->db->set('image',$value['image']);
				if($value['sort_order'] === "")
				{
					$this->db->set('sort_order',0);
				}
				else
				{
					$this->db->set('sort_order',$value['sort_order']);	
				}
				$this->db->set('is_deleted',$is_deleted);
				$this->db->set('date_added',date('Y-m-d h:i:sa'));
				$this->db->set('added_by',$this->session->userdata('Duser_id'));
				$this->db->set('date_modified',date('Y-m-d h:i:sa'));
				$this->db->set('modified_by',$this->session->userdata('Duser_id'));
				$this->db->insert('banner_image');
				
				
			}
				
			}
		}
		return $banner_id;
		
		
	}
	
	
	/**
	* 
	* @function name 	: softDeleteBanner()
	* @description   	: only status change not actual delete banner from database
	* @access 		 	: public
	* @param   		 	: int $banner_id The banner id that you want to delete
	* @return       	: void
	*
	*/
	public function softDeleteBanner($banner_id) 
	{	
		$this->db->set('is_deleted',1);
		$this->db->where('banner_id',(int)$banner_id);
		$this->db->update('banner_image');

		$this->db->set('is_deleted',1);
		$this->db->where('banner_id',(int)$banner_id);
		return $this->db->update('banner');
	}
	
	/**
	* 
	* @function name 	: deletebanner()
	* @description   	: delete banner record from database
	* @access 		 	: public
	* @param   		 	: int $banner_id The option id that you want to delete
	* @return       	: void
	*
	*/
	public function deleteBanner($banner_id) 
	{	
		// Record deleted in option_value table by option_id
		$this->db->where('banner_id',(int)$banner_id);
		$this->db->delete('banner_image');

		// Record deleted in option table by option_id
		$this->db->where('banner_id',(int)$banner_id);
		return $this->db->delete('banner');
	} 
	
	
	/**
	* 
	* @function name 	: getBanners()
	* @description   	: get all banners from database
	* @access 		 	: public
	* @param   		 	: string $data The banner data that you want to get
	* @return       	: array The selected option array
	*
	*/
	public function getBanners($data = array())
	{
		if($data)
		{

			$sql = "SELECT b.* FROM `banner` b";
			$where = " where 1=1 ";
			$sort_data = array(
				'banner_name',
				'status',
				'date_modified'
			);
			if($this->session->userdata('Drole_id')!=1)
			{
				$where .= " and  b.is_deleted = 0";
			}
			if($this->input->post('option_name') != "")
			{

				$where .= " and b.banner_name like '%".$this->input->post('option_name')."%'";
			}
			$sql.=$where;
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY b." . $data['sort'];
			} else {
				$sql .= " ORDER BY 	banner_name";
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
			$sql = "SELECT * FROM `banner` WHERE is_deleted = 0 ORDER BY banner_name ASC";
		}
		$query = $this->db->query($sql);
		$query->result_array();
		//echo $this->db->last_query();exit;
		return $query->result_array();
	}
	
	/**
	* 
	* @function name 	: getTotalBanners()
	* @description   	: get total no of banners from database
	* @access 		 	: public
	* @return       	: int total no of records
	*
	*/
	public function getTotalBanners() 
	{
		$sql = "SELECT COUNT(*) AS total FROM `banner` ";
		$where = " WHERE 1=1 ";
		if($this->session->userdata('Drole_id')!=1)
			{
				$where .= " and is_deleted = 0";
			}
			
			$sql.=$where;
		$query = $this->db->query($sql);

		return $query->row('total');
	}
	/**
        * 
        * @function name : getTotalBannerByCategoryId()
        * @description   : get Total banner by $category_id
        * @access        : public
        * @param   	     : int $category_id
        * @return        : int total no of banner
        *
        */
        public function getTotalBannerByCategoryId($category_id) 
        {
            $query = $this->db->query("SELECT COUNT(*) AS total FROM banner WHERE select_category = '" . (int)$category_id . "'");
            return $query->row('total');
        }
	
	
	
}