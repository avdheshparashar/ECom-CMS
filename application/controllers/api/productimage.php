<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller- productimage
 * @author		Avdhesh Parashar
 * @date		4th March 2015
 * @link		http://104.236.210.247/buglecms/index.php/api/productimage/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
if(!class_exists('REST_Controller')) {
	require_once(APPPATH.'/libraries/REST_Controller.php');
}

class Productimage extends REST_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('productimage_model'); 
       
    }

    function records_get()  {
        $records = $this->giftcard_model->getlist();
		$this->response(array('status'=> true, 'message'=> 'Yey', 'data'=> $records), 200);
    }

	function productimages_get(){
		$product_id = $this->get('product_id');
		if( $product_id ){
			$images = $this->productimage_model->getimages_by_productid($product_id);
			if( empty($images) ){
				return $this->response(array('status'=> 'false', 'message'=> "No image found"));
			}
			return $this->response(array('status'=> 'true', 'data'=> $images));
		}
	}

	function productimages_post(){
		$product_id = $this->post('product_id');

		if( $this->post('main') ){

			// Fetch Main Image
			$image = $this->productimage_model->get_main_image($product_id);
			if( $image ){

				return $this->response(array('status'=> 'true', 'data'=> $image));			

			}else{

				return $this->response(array('status'=> 'false', 'data'=> 'no data'));			
			}

		}else{

			$images = $this->productimage_model->getimages_by_productid($product_id);

			if( empty($images) ){
				return $this->response(array('status'=> 'false', 'message'=> "No image found"));
			}
			return $this->response(array('status'=> 'true', 'data'=> $images));
		
		}
	}


	function find_all_image_get(){

		$image = $this->productimage_model->get_product_main_image( $this->get('product_id') );
		$other_image =  $this->productimage_model->get_other_images_by_productid( $this->get('product_id') );

		$response_ary = array();
		$response_ary[0] = array('status'=> 'true', 'data'=> array('main_image'=> $image, 'other_image'=> $other_image));

		return $this->response($response_ary, 200);

	}


	function delete_get(){
		if($this->get('productimage_id')){

			$image = $this->productimage_model->getbyid( $this->get('productimage_id') );

			if( !empty($image) ){

				$folders[0]['name'] = 'popup';
				$folders[1]['name'] = 'home';
				$folders[2]['name'] = 'category';
				$folders[3]['name'] = 'product';
				$folders[4]['name'] = 'thumb';

				if( file_exists( 'assests/uploads/images/'.$image['image'] ) ){

					unlink( 'assests/uploads/images/'.$image['image'] );

				}

				foreach ($folders as $folder) {
					
					if( file_exists( 'assests/uploads/images/'.$folder['name']."/".$image['image'] ) ){

						unlink( 'assests/uploads/images/'.$folder['name']."/".$image['image'] );

					}
				}
		

				

				$this->productimage_model->deletebyid( $image['product_image_id'] );

			}

			$remove[0] = array('status'=> 'true', 'message'=> "Image has been deleted", 'data'=> $image);
		} else {
			$remove[0] = array('status'=> 'false', 'message'=> "Insufficient data provided");
		}
		$this->response($remove,200);
	}

	function addimages_post(){
		if(!empty($this->get('images')) && $this->get('product_id')){
			foreach($this->get('images') as $single_image){
				$data = array(
						'name' => $this->get('product_id'),
						'image' => $single_image
					);
				$this->productimage_model->add($data);
			}
			$image[0] = array('status'=> 'true', 'message'=> "Images added successfully");
		} else {
			$image[0] = array('status'=> 'false', 'message'=> "Images not selected");
		}
		$this->response($image,200);


	}


}

