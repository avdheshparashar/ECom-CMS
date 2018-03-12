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
 * @author		Avdhesh Parashar
 * @Date		4th March 2015
 * @link		http://104.236.210.247/buglecms/index.php/api/product/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
if(!class_exists('REST_Controller')) {
	require_once(APPPATH.'/libraries/REST_Controller.php');
}

class Product extends REST_Controller {

	function __construct() {
        // Construct our parent class
        parent::__construct();
        $config = array(
            'field' => 'slug',
            'slug' => 'name',
            'table' => 'tbl_products',
            'category_id' => 'product_id',
        );
        $this->load->library('slug', $config);
        $this->load->model('product_model'); 
        $this->load->model('product_category_model');
    }


	function records_get(){
		$records = $this->product_model->getlist();
		if(!empty($records)){
			$count = $this->product_model->productcount();
			$products[0] = array('status'=>'true','message'=>'Your products list','data'=>$records, 'count'=> $count);	
		}else{
			$products[0] = array('status'=>'false','message'=>'No Product Found');	
		}
		$this->response($products,200);
	}

	function detail_get() {
		if($this->get("product_id")) {
			$records = $this->product_model->getdetail($this->get("product_id"));	
			if(empty($records)) {
				$details[0] = array('status'=>'false','message'=>'no product detail found');	
			} else {
				$details[0] = array('status'=>'true','message'=>'Your product detail','data'=>$records);
			}
		} else {
			$details[0] = array('status'=>'false','message'=>'Please supply valid product id');
		}	
		$this->response($details,200);	
	}

	function getprice_post() {
		if($this->post("size") && $this->post("color") && $this->post("product_id")) {
			$data = array(
				'size' => $this->post("size"),
				'color' => $this->post("color"),
				'product_id' => $this->post("product_id")
			);
			$getprice = $this->product_model->getprice($data);
			$price[0] = array('status'=>'true','message'=>'Product price','data'=>$getprice);
		} else {
			$price[0] = array('status'=>'false','message'=>'Please supply all data');
		}
		$this->response($price,200);	
	}

	function changestatus_post() {
		if($this->post("product_id")) {
			$this->product_model->changestatus($this->post("product_id"));
			$change[0] = array('status'=>'true','message'=>'product status has been updated');
		} else {
			$change[0] = array('status'=>'false','message'=>'please pass product id');	
		}
		$this->response($change,200);
	}

	function remove_post() {
		if($this->post("product_id")) {
			$check = $this->product_model->remove($this->post("product_id"));
			if($check == 0) {
				$remove[0] = array('status'=>'false','message'=>'product can not be removed');
			} else if($check == 1) {
				$remove[0] = array('status'=>'true','message'=>'product has been removed');
			}
		} else {
			$remove[0] = array('status'=>'false','message'=>'please pass product id');	
		}
		$this->response($remove,200);
	}

	function add_post() {

		// if($this->post("category_ids") && $this->post("brand_id") && $this->post("reference_number") && $this->post("main_image") && 
		// 		$this->post("page_title") && $this->post("name") && $this->post('specs')) {


			$data = array(
					'brand_id' => $this->post("brand_id"),
					'name' => $this->post("name"),
					'description' => $this->post("description"),
					// 'short_description' => trim($this->post("short_description")),
					'short_description' => $this->post("short_description"),
					'reference_number' => $this->post("reference_number"),
					'main_image' => $this->post("main_image"),
					'is_inventory' => $this->post("is_inventory"),
					'is_purchasable'=> $this->post('is_purchasable'),
					'stamp'=> $this->post("stamp"),
					'page_title' => $this->post("page_title"), 
					'meta_keywords' => trim($this->post("meta_keywords")), 
					'meta_description' => trim($this->post("meta_description")),
					'specs'=> $this->post('specs'),
					'video'=> trim($this->post('video')),
					'additional_info'=> trim($this->post('additional_info')),
					'price'=> $this->post('price')

				);

	
            $data['slug'] = $this->slug->create_uri($data['name']);
	    	$product_id = $this->product_model->add($data);

			if($this->post('price') !='' || (int) $this->post('price')!=0) {	 
				$filter[0]['details'] = $this->post('price');
				$filter[0]['is_price'] = 1;
				$filter[0]['product_id'] = $product_id;
				$filter[0]['field_id'] = 0;
				$this->product_model->addfilter($filter);
			}		

			$this->product_category_model->add_multiple($this->post('category_ids'), $product_id);

			if( (int)$this->post('is_inventory') ){
				
				$inventory =$this->post("inventory");
				foreach ($this->post("inventory") as $key => $value) {
					$inventory[$key]['product_id'] = $product_id;
				}

				$this->product_model->addtoinventory($inventory);

			}

			$product_tags = array();
			if( $this->post("tags") && !empty($this->post('tags')) ) {
				foreach($this->post("tags") as $key => $tag) {
					$product_tags[$key]['product_id'] = $product_id;
					$product_tags[$key]['tag'] = $tag;
				}
			}

			$this->product_model->savetags($product_tags);

			$product_images = array();
			if($this->post("images") && !empty( $this->post('images') ) ) {
				foreach($this->post('images') as $key => $image) {
					$product_images[$key]['product_id'] = $product_id;
					$product_images[$key]['image'] = $image;
				}
			}

			$this->product_model->saveimages($product_images);

			foreach ($this->post("details") as $details) {
				$product_detail = array();
				$i = -1;
				foreach ($details['data'] as $value) {
					$product_detail[++$i]['product_id'] = $product_id;
					$product_detail[$i]['field_id'] = $details['field_id'];
					$product_detail[$i]['details'] = $value;					
				}
				$this->product_model->savedetail($product_detail);
				$this->product_model->addfilter($product_detail);
			}

			$add[0] = array('status'=>'true','message'=>'product has been added');
		// } else {
		// 	$add[0] = array('status'=>'false','message'=>'please pass all product data');		
		// }
		return $this->response($add,200);
	}



	function edit_post() {

		//return $this->response($_POST,200);
		// if($this->post("category_id") && $this->post("brand_id") && $this->post("reference_number") &&  
		// 		$this->post("page_title") && $this->post("product_id") && $this->post("name")) {

		// return $this->response( $_POST );

			$data = array(
					'product_id' => $this->post("product_id"),
					'brand_id' => $this->post("brand_id"),
					'name' => $this->post("name"),
					'description' => $this->post("description"),
					'short_description' => trim($this->post("short_description")),
					'reference_number' => $this->post("reference_number"),
					'is_purchasable'=> $this->post('is_purchasable'),
					'is_inventory' => $this->post("is_inventory"),
					'stamp'=> $this->post("stamp"),
					'page_title' => $this->post("page_title"), 
					'meta_keywords' => trim($this->post("meta_keywords")), 
					'meta_description' => trim($this->post("meta_description")),
					'specs'=> $this->post('specs'),
					'video'=> trim($this->post('video')),
					'additional_info'=> trim($this->post('additional_info'))
			);

			$this->product_model->update($data);


			foreach ($this->post("details") as $details) {
				$product_detail = array();
				$i = -1;
				if( isset($details['data']) ){

					foreach ($details['data'] as $value) {
						$product_detail[++$i]['product_id'] = $this->post("product_id");
						$product_detail[$i]['field_id'] = $details['field_id'];
						$product_detail[$i]['details'] = $value;
					}
					$this->product_model->updatedetail($product_detail);

				}else{
					$this->product_model->deletedetail($this->post("product_id"), $details['field_id']);
				}
			}
			$product_detail['product_id'] = $this->post("product_id");
			$this->product_model->updatefilter($product_detail);


			$product_tags = array();
			if( $this->post("tags") && !empty($this->post('tags')) ) {
				foreach($this->post("tags") as $key => $tag) {
					$product_tags[$key]['product_id'] = $this->post("product_id");
					$product_tags[$key]['tag'] = $tag;
				}
			}

			
			$this->product_model->updatetags($product_tags);

			$this->load->model("product_category_model");
			$this->product_category_model->update_categories_by_product_id( $this->post('category_ids'), $this->post("product_id"));

			$update[0] = array('status'=>'true','message'=>'product has been updated');
		// } else {
		// 	$update[0] = array('status'=>'false','message'=>'please pass all product data');		
		// }
		$this->response($update,200);
	}	

	function deleteimage_post() {
		if($this->post("image_id")) {
			$this->product_model->deleteimage($this->post("image_id"));
			$remove[0] = array('status'=>'true','message'=>'Image has been deleted successfully');
		} else {
			$remove[0] = array('status'=>'false','message'=>'please pass image id');
		}
		$this->response($remove,200);
	}
    

	function multidelete_post(){
		$product_ids = "";
		foreach ($_POST['products'] as $product_id) {
			$product_ids = $product_ids . ", " . $product_id;
		}

		$product_ids = ltrim($product_ids, ", ");
		$this->product_model->multidelete($product_ids);

		$change[0] = array('status'=>'true','message'=>'Products Deleted');

		return $this->response($change, 200);
	}


	function get_add_data_get(){

		$data = $this->_get_common_data();

		// $this->load->model('color_model');
		$this->load->model('size_model');

		//$data['colors'] = $this->color_model->getlist();
		$data['sizes'] = $this->size_model->getlist();


		$response_ary[0] =array( 'status'=> 'true', 'data'=> $data );
		$this->response($response_ary, 200);


	}


	function get_edit_data_get(){

		if( $this->get('product_id') ){

			$data = $this->_get_common_data();

			$data['product'] = $this->product_model->product_basic_details( $this->get('product_id') );
			$data['old_details'] = $this->product_model->details_by_product_id( $this->get('product_id') );

			$response_ary[0] = array('status'=>'true','message'=>'Success', 'data'=> $data);

			return $this->response( $response_ary, 200 );

		}
	}

	function _get_common_data(){

		$this->load->model('category_model');
		$this->load->model('field_model');

		$data['categories'] = $this->category_model->fetch_categories();
		$data['brands'] = $this->category_model->fetch_brands();
		$data['fields'] = $this->field_model->fetch_fields();

		return $data;

	}

    function view_get(){

        if( $this->get('slug') ){
            $data = $this->product_model->get_view_data_by_product_id( $this->get('slug') );
            $response_ary[0] = array('status'=>'true','message'=>'Success', 'data'=> $data);
            return $this->response( $response_ary, 200 );           
        }
        
    }



}