<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Landing';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


require_once( BASEPATH .'database/DB.php');

$db =& DB();

$total = $this->uri->total_segments();

$uri='';
$id_array = array();
$id_array['controller'] =array();
$param = '';
$seo_param='';
$category =  explode('_',$this->uri->segment(1));
$category_length = count($category);

if($total>1 || $category_length>1)
{
			//for category segment
			$category =  explode('_',$this->uri->segment(1));
			$category_length = count($category);
			
			if($category_length>=1)
			{
				foreach($category as $key=>$row)
				{
					$db->where('keyword',$row);
					$query = $db->get('url_alias');
					$result = $query->row();
					
					if(count($result)>0)
					{
						$directory  = explode('_',$result->query);
						$controller = explode('=',$directory[1]);
						if($controller[1]!==NULL)
						{
							$id_array['controller'][] = $directory[0];
							$id_array['id'][] = $controller[1];
							$id_array['keyword'][] = $result->keyword;
							$param .='_'.$controller[1];
							$seo_param .='_'.$result->keyword;
						}
					}
				}
			}
			$param = ltrim($param, '_');
			$seo_param = ltrim($seo_param, '_');
			
			//for producs
			if($total>=2)
			{
				$db->where('keyword',$this->uri->segment(2));
				$query = $db->get('url_alias');
				$result_product = $query->row();
				
				if(count($result_product)>0)
				{
					$directory  = explode('_',$result_product->query);
					$controller = explode('=',$directory[1]);
					if($controller[1]!==NULL)
					{
						$id_array['controller'][] = $directory[0];
						$id_array['id'][] = $controller[1];
						$id_array['keyword'][] = $result_product->keyword;
						$param .='_'.$controller[1];
						$seo_param .='/'.$result_product->keyword;
					}
				}
			}
			
			$length = count($id_array['controller']);
			if($length>0)
			{
				if($id_array['controller'][$length-1] ==='category' 
					|| $id_array['controller'][$length-1] === 'product')
				{
					$main_url = 'product/'.$id_array['controller'][$length-1].'/index/'.$seo_param.'/'.$id_array['id'][$length-1];   
				}
				else
				{
					$main_url = 'information/'.$id_array['controller'][$length-1].'/index/'.$id_array['id'][$length-1];
				}
				
				$route[$seo_param] = $main_url;
			}	
}

if($total==1 && $category_length==1)
{
	$db->where('keyword',$this->uri->segment(1));
	$query = $db->get('url_alias');
	$result_product = $query->row();
	
	if(count($result_product)>0)
	{
		$directory  = explode('_',$result_product->query);
		$controller = explode('=',$directory[1]);
		
		if($controller[1]!==NULL)
		{
			$id_array['controller'][] = $directory[0];
			$id_array['id'][] = $controller[1];
			$id_array['keyword'][] = $result_product->keyword;
			$param .='_'.$controller[1];
			$seo_param .=$result_product->keyword;
		}
	}
	
	$length = count($id_array['controller']);
			if($length>0)
			{
				if($id_array['controller'][$length-1] ==='category' 
					|| $id_array['controller'][$length-1] === 'product')
				{
					$main_url = 'product/'.$id_array['controller'][$length-1].'/index/'.$seo_param;   
				}
				else
				{
					$main_url = 'information/'.$id_array['controller'][$length-1].'/index/'.$id_array['id'][$length-1];
				}

				$route[$seo_param] = $main_url;
			}	
}	
	
$catalog =  explode('_',$this->uri->segment(1));

if(strtolower($catalog[0])=='catalogs')
{
$route['Catalogs_(:any)/(:any)'] = 'product/catalogs/index/Catalogs_$1/$2';
$route['catalogs_(:any)/(:any)'] = 'product/catalogs/index/catalogs_$1/$2';
$route['Catalogs/(:any)'] = 'product/catalogs/index/catalogs/$1';
$route['catalogs/(:any)'] = 'product/catalogs/index/catalogs/$1';

}
