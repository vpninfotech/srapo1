<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @file name    : Reviews
* @Auther       : Indrajit
* @Date         : 07-10-2016
* @Description  : Admin Product Operation
*
*/

class Reviews extends CI_Controller {

    private $data=array();
	private $error = array();

	function __construct()
	{
            parent::__construct();

            $this->_init();

            $this->rbac->CheckAuthentication();

            $this->load->model('catalog/Reviews_model','reviews');
            
	        $this->lang->load('catalog/reviews_lang', 'english');

            $this->load->model('common');

            $this->load->library('commons');

            $this->load->library('pagination');
			
	}
        
	/**
	* 
	* @function name : _init()
	* @description   : initialize required resources in this view
	* @param   		 : void
	* @return        : void
	*
	*/
	private function _init() {
		
            //--Set Template
            $this->output->set_template('dataoperator_template');
            $admin_theme = $this->common->config('admin_theme');
            $this->output->set_common_meta('reviews','sarpo','This is srapo reviews page');

	}
	
	/**
	* 
	* @function name : index()
	* @description   : load reviews view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function index($sort_by = 'author', $sort_order = 'ASC', $offset = 0)
	{
            // breadcrumbs
            $this->data['add']             = base_url('catalog/reviews/add');
            if($this->session->userdata('Drole_id')== 1)
            {
                    $this->data['delete']  = base_url('catalog/reviews/delete');
            }
            else
            {
                    $this->data['delete']  = base_url('catalog/reviews/softDelete');
            }
            $this->data['breadcrumbs']   = array();
            $this->data['breadcrumbs'][] = array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),

            );
            $this->data['breadcrumbs'][] = array(
               'text' => 'reviews',  
               'href' => base_url('catalog/reviews'),

            );
		  
            // pagination
            $limit = $this->common->config('config_limit_admin');
            $data = array(
                'sort' => $sort_by,
                'order'=> $sort_order,
                'start'=> $offset,
                'limit'=> $limit
            );
		
            $url = base_url("catalog/reviews/index/$sort_by/$sort_order");
            $total_records = $this->reviews->getTotalReview();
            $config =$this->commons->pagination($url,$total_records,$limit);
            $this->pagination->initialize($config);
            $config['uri_segment'] = 6;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['sort_by'] = $sort_by;
            $this->data['sort_order'] = $sort_order;
            $results = $this->reviews->getReview($data);
            $this->data['pages'] = ceil($total_records/$limit);
            $this->data['totals'] = ceil($total_records);
            $this->data['range'] = ceil($offset+1);
		
            // URL creation
            $url='';
            if ($this->uri->segment(4)!==NULL) {
                    $url .= '/'.$this->uri->segment(4);
            }
            else
            {
                    $url .= '/author';
            }

            if ($this->uri->segment(5)!==NULL) {
                    $url .= '/'.$this->uri->segment(5);
            }
            else
            {
                    $url .= '/ASC';
            }
            if ($this->uri->segment(6)!==NULL) {
                    $url .= '/'.$this->uri->segment(6);
            }
            else
            {
                    $url .= '/0';
            }
		
            foreach ($results as $result) { 
                    $this->data['records'][] = array(
                            'review_id'          => $result['review_id'],
                            'author' 		     => $result['author'],
                            'rating' 		     => $result['rating'],
                            'status'             => ($result['status'] ? $this->lang->line('text_enabled') : $this->lang->line('text_disabled')),
                            'date_added'         => date($this->common->config('config_date_format'), strtotime($result['date_added'])),
                            'edit'               =>base_url('catalog/reviews/edit'.$url.'/'.$this->commons->encode($result['review_id']))
                    );
            }
		
            if (isset($this->error['warning'])) {
                    $this->data['error_warning'] = $this->error['warning'];
            } else {
                    $this->data['error_warning'] = '';
            }

            if ($this->session->userdata('success')!==NULL) {
                    $this->data['success'] = $this->session->userdata('success');

                    $this->session->set_userdata('success','');
            } else {
                    $this->data['success'] = '';
            }
		
            if ($this->input->post('selected') !==NULL) {
                    $this->data['selected'] = (array)$this->input->post('selected');
            } else {
                    $this->data['selected'] = array();
            }
            //print_r($this->data);
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/catalog/reviews_list";
            $this->load->view($content_page,$this->data);
		
	}
	
	/**
	* 
	* @function name : add()
	* @description   : load reviews Add view
	* @param   		 : void
	* @return        : void
	*
	*/
	public function add()	
        {	
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
                
                $this->reviews->addReview();
                $this->session->set_userdata('success',$this->lang->line('text_success'));

                // Generate back url
                $url = '';

                if ($this->uri->segment(4)!==NULL) {
                    $url .= '/'.$this->uri->segment(4);
                }
                else
                {
                    $url .= '/author';
                }
				
                if ($this->uri->segment(5)!==NULL) {
                    $url .= '/'.$this->uri->segment(5);
                }
                else
                {
                    $url .= '/ASC';
                }
                if ($this->uri->segment(6)!==NULL) {
                    $url .= '/'.$this->uri->segment(6);
                }
                else
                {
                    $url .= '/0';
                }
                if ($this->uri->segment(7)!==NULL) {
                    $url .= '/'.$this->uri->segment(7);
                }
                redirect('catalog/reviews/index'.$url);
	    }
            $this->getForm();
	}
	
		/**
	* 
	* @function name : edit()
	* @description   : edit reviews records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function edit($sort_by = 'author', $sort_order = 'ASC', $offset = 0)
	{	
            if(($this->input->server('REQUEST_METHOD') == 'POST') && $this->validateForm()) {
				 
                $this->reviews->editReview();
                $this->session->set_userdata('success',$this->lang->line('text_success'));

                // Generate back url
                $url = '';
		
                if ($this->uri->segment(4)!==NULL) {
                    $url .= '/'.$this->uri->segment(4);
                }
                else
                {
                    $url .= '/author';
                }
				
                if ($this->uri->segment(5)!==NULL) {
                    $url .= '/'.$this->uri->segment(5);
                }
                else
                {
                    $url .= '/ASC';
                }
                if ($this->uri->segment(6)!==NULL) {
                    $url .= '/'.$this->uri->segment(6);
                }
                else
                {
                    $url .= '/0';
                }		
                redirect('catalog/reviews/index'.$url);
	    }
            $this->getForm();
	}
	
	/**
	* 
	* @function name : delete()
	* @description   : perminant delete records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function delete()
	{
            //if (($this->input->post('selected')!==NULL) && $this->validateDelete()) 
            if (($this->input->post('selected')!==NULL)) 
            {
                foreach ($this->input->post('selected') as $review_id) 
                {
                    //echo $review_id;exit;
                    $this->reviews->deleteReview($review_id);
                }

                $this->session->set_userdata('success',$this->lang->line('text_success'));
                // Generate back url
                $url = '';

                if ($this->uri->segment(4)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(4);
                } 
                else 
                {
                    $url .= '/author';
                }

                if ($this->uri->segment(5)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(5);
                } 
                else 
                {
                    $url .= '/ASC';
                }
                if ($this->uri->segment(6)!==NULL) 
                {
                    $url .= '/'.$this->uri->segment(6);
                } 
                else 
                {
                    $url .= '/0';
                }
                redirect('catalog/reviews/index'.$url);
            }
            $this->index();
	}
	
	/**
	* 
	* @function name : softDelete()
	* @description   : soft Delete Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function softDelete()
	{
            //if (($this->input->post('selected')!==NULL) && $this->validateDelete())
            if (($this->input->post('selected')!==NULL))
            {
                foreach ($this->input->post('selected') as $review_id) 
                {
                    $this->reviews->softDeleteCustomer($review_id);
                }

                $this->session->set_userdata('success',$this->lang->line('text_success'));
                //redirect('catalog/reviews/index');
            }
            $this->index();
	}

		/**
	* 
	* @function name : getForm()
	* @description   : Generate Form for Add and Edit Records
	* @param   		 : void
	* @return        : void
	*
	*/
	public function getForm()
	{
            // Transaction Status
            if (isset($this->error['warning'])) {
                $this->data['error_warning'] = $this->error['warning'];
            } else {
                $this->data['error_warning'] = '';
            }

            if ($this->session->userdata('success')!==NULL) {
                $this->data['success'] = $this->session->userdata('success');

                $this->session->set_userdata('success','');
            } else {
                $this->data['success'] = '';
            }
		
            // Generate back url
            $url = '';

            if ($this->uri->segment(4)!==NULL) {
                $url .= '/'.$this->uri->segment(4);
            }
            else
            {
                $url .= '/author';
            }
		
            if ($this->uri->segment(5)!==NULL) {
                $url .= '/'.$this->uri->segment(5);
            }
            else
            {
                $url .= '/ASC';
            }
            if ($this->uri->segment(6)!==NULL) {
                $url .= '/'.$this->uri->segment(6);
            }
            else
            {
                $url .= '/0';
            }
            
            // breadcrumbs
            $this->data['breadcrumbs']   	= array();
            $this->data['breadcrumbs'][] 	= array(
               'text' => '<i class="fa fa-dashboard"></i> Home',
               'href' => base_url('dashboard/dashboard'),

            );
            $this->data['breadcrumbs'][] = array(
              'text' => 'Reviews',
              'href' => base_url('catalog/reviews'),

            );
		 
            // Add or Edit Transaction
            $count = $this->uri->total_segments();
            $method = $this->uri->segment(3);
            if ($method=='add') 
            {
                $this->data['form_action'] = base_url('catalog/reviews/add'.$url);
                $this->data['review_id'] = '';
                $this->data['text_form'] = $this->lang->line('text_add');
                //echo "1";
            } 
            else 
            {
                $this->data['form_action'] = base_url('catalog/reviews/edit'.$url.'/'.$this->uri->segment($count));

                $this->data['review_id'] = $this->commons->decode($this->uri->segment($count));
                $this->data['text_form'] = $this->lang->line('text_edit');
            }
           
            $this->data['cancel'] 		= base_url('catalog/reviews/index'.$url);
		
            // Set Value Back
            if (1) 
            {
                $reviews_info = $this->reviews->getReviewById($this->commons->decode($this->uri->segment($count)));
            }
            //echo '<pre>';print_r($reviews_info);
		
            if ($this->input->post('author')!==NULL) {
                $this->data['author'] = $this->input->post('author');
            } elseif (!empty($reviews_info)) {

                $this->data['author'] = $reviews_info['author'];
            } else {
                $this->data['author'] = '';
            }
            
            if ($this->input->post('review_id')!==NULL && ($this->input->server['REQUEST_METHOD'] != 'POST')) {
			$review_info = $this->reviews->getReviews($this->input->post('review_id'));
            } elseif (!empty($reviews_info)) {                        
                        $review_info = $this->reviews->getReviews($reviews_info['review_id']);
            }
            if ($this->input->post('product_id')!==NULL) {
                $this->data['product_id'] = $review_info['product_id'];
            } elseif (!empty($review_info)) {
                $this->data['product_id'] = $review_info['product_id'];
            } else {
                $this->data['product_id'] = '';
            }
            
            if ($this->input->post('product')!==NULL) {
                $this->data['product'] = $this->input->post('product');
            } elseif (!empty($review_info)) {
                $this->data['product'] = $review_info['product'];
            } else {
                $this->data['product'] = '';
            }

            if ($this->input->post('text')!==NULL) {
                $this->data['text'] = $this->input->post('text');
            } elseif (!empty($reviews_info)) {

                $this->data['text'] = $reviews_info['text'];
            } else {
                $this->data['text'] = '';
            }
		
            if ($this->input->post('rating')!==NULL) {
                $this->data['rating'] = $this->input->post('rating');
            } elseif (!empty($reviews_info)) {

                $this->data['rating'] = $reviews_info['rating'];
            } else {
                $this->data['rating'] = '';
            }

           if ($this->input->post('status')!==NULL)
            {
                    $this->data['status'] = $this->input->post('status');
            } elseif (!empty($reviews_info)) {
                    $this->data['status'] = $reviews_info['status'];
            } else {
                    $this->data['status'] = 0;
            }
            
            if ($this->input->server('REQUEST_METHOD') == 'POST')
                {
                    if($this->input->post('is_deleted')==1)
                    {
                       $this->data['is_deleted'] = $this->input->post('is_deleted'); 
                    }else {
                         $this->data['is_deleted'] = 0;
                    }
		} elseif (!empty($reviews_info)) {
			$this->data['is_deleted'] = $reviews_info['is_deleted'];
		} else {
			$this->data['is_deleted'] = 0;
		}
            //echo '<pre>'.$count;print_r($this->data);die;
            $admin_theme = $this->common->config('admin_theme');
            $content_page="themes/".$admin_theme."/catalog/reviews";
            //echo "<pre>"; print_r($this->data);exit;
            $this->load->view($content_page,$this->data);
	}
	
    /**
	* 
	* @function name : validateForm()
	* @description   : Validate Entered Form data
	* @param   		 : void
	* @return        : void
	*
	*/
	public function validateForm()
	{
           
         
            $validation = array(

                           array(
                                'field' => 'author',
                                'label' => 'Author Name', 
                                'rules' => 'trim|required|min_length[3]|max_length[255]|xss_clean', 
                                'errors' => array('required' => '%s must be between 3 and 255 characters!','min_length'=>'%s must be between 3 and 255 characters!','max_length'=>'%s must be between 3 and 20 characters!')
                            ),
                
                            array(
                                'field' => 'product',
                                'label' => 'Product', 
                                'rules' => 'trim|required|xss_clean', 
                                'errors' => array('required' => '%s required!')
                            ),
					   
                            array(
                                 'field' => 'text',
                                 'label' => 'Text', 
                                 'rules' => 'trim|required|min_length[1]|max_length[255]|xss_clean', 
                                 'errors' => array('required' => '%s must be between 1 and 255 characters!','min_length'=>'%s must be between 1 and 255 characters!','max_length'=>'%s must be between 1 and 255 characters!')
                            ),
                            array(
                                'field' => 'rating',
                                'label' => 'rating', 
                                'rules' => 'trim|required|xss_clean', 
                                'errors' => array('required' => 'Please select %s !','valid_rating'=>'Please select %s !')
                            ),
					);
					$this->form_validation->set_rules($validation);
			if ($this->form_validation->run() == FALSE) {
				
				return FALSE;
			}else{
							
				return TRUE;
			}
	}
	/**
	* 
	* @function name : validateDelete()
	* @description   : Check Reviews relation for delete
	* @param   		 : void
	* @return        : void
	*
	*/
	/*public function validateDelete() 
	{
		foreach ($this->input->post('selected') as $review_id) 
		{
			$reviews_info = $this->reviews->getReview($review_id);
			
		    if ($reviews_info) 
			{
				if (0) 
				{
					$this->error['warning'] = $this->lang->line('error_default');
				}
			}
		}
		return !$this->error;
	}*/
        
        public function autocomplete() {
		$this->output->unset_template();
		$json = array();
			
			if ($this->input->post('product')!==NULL) {
				$filter_name = $this->input->post('product');
			} else {
				$filter_name = '';
			}
						
			$filter_data = array(
				'product_name'  => $filter_name,
				'start'        => 0,
				'limit'        => 5
			);

			$results = $this->reviews->getProducts($filter_data);

			foreach ($results as $result) {
				$json[] = array(
                                    'product_id'        => $result['product_id'],
                                    'firstname'         => $result['product_name'],
				);
			}
		
		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['firstname'];
		}

		array_multisort($sort_order, SORT_ASC, $json);
                
        echo json_encode($json);
	}
}