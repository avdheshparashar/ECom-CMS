<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		BugleCMS
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Viral Thakkar
 * @link		http://104.236.210.247/buglecms/index.php/api/subscriber/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
if(!class_exists('REST_Controller')) {
	require_once(APPPATH.'/libraries/REST_Controller.php');
}

class Category extends REST_Controller {

	function __construct() {
        // Construct our parent class
        parent::__construct();
        $config = array(
            'field' => 'slug',
            'slug' => 'name',
            'table' => 'tbl_categories',
            'category_id' => 'category_id',
        );
        $this->load->library('slug', $config);
        $this->load->library('session');
        $this->load->model('category_model'); 
    }

//category list by category id or get all category list with number of products in perticular category

    function records_get()  {
        if($this->get('category_id')) {
        	$records = $this->category_model->getlist($this->get('category_id'));
        } else {
        	$records = $this->category_model->getlist();
        }
        $data[0] = array('status'=>'true','data'=>$records);     
        $this->response($data,200); // 200 being the HTTP response code
    }    

    function recordsweb_get()  {
        if($this->get('category_id')) {
            $count = $this->category_model->categorycount(); 
            $data['category_id'] = $this->get('category_id');
            $records = $this->category_model->getlistweb($data);
        } else {
            $count = $this->category_model->categorycount(); 
            $records = $this->category_model->getlistweb();
        }
        $data[0] = array('status'=>'true','data'=>$records,'count'=>$count);     
        $this->response($data,200); // 200 being the HTTP response code
    } 

    function getproducts_get() {
    	if($this->get('category_id')) {
    		$category = array(
    				'category_id' => $this->get('category_id'),
    				'limit' => $this->get('limit'));
    		if($this->get('skip')) {
    			$category['skip'] = $this->get('skip');
    		} else {
    			$category['skip'] = 0;
    		}
    		$data = $this->category_model->getproducts($category);
    		if(empty($data)) {
    			$products[0] =  array('status'=>'false','message'=>'no products found');
    		} else {
    			$products[0] =  array('status'=>'true','message'=>'Your products list','no_of_products'=>$data['count'],
    			 'data'=>$data['list']);
    		}
    	} else {
    		$products[0] =  array('status'=>'false','message'=>'Please pass category id');
    	}
    	$this->response($products,200);
    }

    function relatedproducts_get() {
    	if($this->get('category_id')) {
    		$category = array(
    				'category_id' => $this->get('category_id'),
    				'limit' => $this->get('limit'));
       		$data = $this->category_model->relatedproducts($category);
    		if(empty($data)) {
    			$products[0] =  array('status'=>'false','message'=>'no products found');
    		} else {
    			$products[0] =  array('status'=>'true','message'=>'Your products list','data'=>$data);
    		}
    	} else {
    		$products[0] =  array('status'=>'false','message'=>'Please pass category id');
    	}
    	$this->response($products,200);
    }

    function add_post() {
       	if($this->post('name') && $this->post('page_title') && $this->post('parent_id')) {	
    		$category = array(
    				'parent_id' => $this->post('parent_id'),
    				'name' => $this->post('name'),
                    'description' => $this->post('description'),
                    'image_name' => $this->post('image_name'),
                    'banner_image' => $this->post('banner_image'),
    				'page_title' => $this->post('page_title'),
                    'image_name' => $this->post('image_name'),
                    'meta_description' => $this->post('meta_description'),
                    'meta_keywords' => $this->post('meta_keywords'),
    			);

            $category['slug'] = $this->slug->create_uri($category['name']);
            
    		$this->category_model->create($category);
    		$newcategory[0] =  array('status'=>'true','message'=>'new category has been successfully created');	
    	} else {
    		$newcategory[0] =  array('status'=>'false','message'=>'Please pass all valid id');	
    	}
    	$this->response($newcategory,200);
    }

    function treelist_get() {
    	$records = $this->category_model->treelist();   	
 		$this->response($records,200);
    }

    function deactivate_post() {
    	if($this->post("category_id")) {
    		$this->category_model->deactivate($this->post("category_id"));  
    		$deactivate[0] = array('status'=>'true','message'=>'category has been successfully deactivated');
    	} else {
    		$deactivate[0] = array('status'=>'false','message'=>'please pass category id');
    	}
    	$this->response($deactivate,200);
    }

    function activate_post() {
    	if($this->post("category_id") && $this->post("parent_id")) {
    		$category = array(
    				'category_id' => $this->post("category_id"),
    				'parent_id' => $this->post("parent_id")
    			);
    		$this->category_model->activate($category);  
    		$activate[0] = array('status'=>'true','message'=>'category has been successfully activated');
    	} else {
    		$activate[0] = array('status'=>'false','message'=>'please pass category id');
    	}
    	$this->response($activate,200);
    }

    function remove_post() {
    	if($this->post("category_id")) {
    		$this->category_model->remove($this->post("category_id"));  
    		$remove[0] = array('status'=>'true','message'=>'category has been removed successfully');
    	} else {
    		$remove[0] = array('status'=>'false','message'=>'please pass category id');
    	}
    	$this->response($remove,200);
    }

    function updatea_post() {
        if($this->post("category_id") && $this->post("parent_id")) {
            var_dump($this->post("parent_id"));
            if($this->post('parent_id') == 'null') {
                $parentid = 0;
            } else {
                $parentid = $this->post('parent_id');
            }
    		$category = array(
    				'category_id' => $this->post("category_id"),
    				'parent_id' => $parentid,
                    'name' => $this->post('name'),
                    'description' => $this->post('description'),
                    'page_title' => $this->post('page_title'),
                    'meta_description' => $this->post('meta_description'),
                    'meta_keywords' => $this->post('meta_keywords'),                    
            );
            if($this->post('image_name')) {
                 $category['image_name'] = $this->post('image_name');
            }    
            if($this->post('banner_image')) {
                 $category['banner_image'] = $this->post('banner_image');
            }          
            $this->category_model->update($category);  
    		$update[0] = array('status'=>'true','message'=>'category has been successfully updated');
    	} else {
    		$update[0] = array('status'=>'false','message'=>'please pass category id');
    	}
    	$this->response($update,200);
    }
}

 
