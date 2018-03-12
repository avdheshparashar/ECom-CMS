<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class Product extends CI_Controller {
class Productimage extends Admin_Controller {


	function __construct() {
        // Construct our parent class
        parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('product_model');
		$this->load->model('productimage_model');
       
    }

    public function edit( $product_id ){

		if( !$this->product_model->check_id_exists($product_id) ){
			$flashdata = array(
                "class" => "alert-error",
                "message" => "Product You are Trying to edit does not exist"
            );
   
            $this->session->set_flashdata('flash_message', $flashdata);
            return redirect('product/index');
		}

		$response = $this->curl_get('productimage/find_all_image?product_id='.$product_id);

		// echo "<pre>";
		// print_r($response);
		// echo "</pre>";
		// die();

		if( !empty( $response ) ){
					
			if( $response[0]['status'] == 'true' ){

				$this->layout->view_render('admin/product/edit/image', $response[0]['data']);

			}
		}else{

			$this->display_error_msg("Something Went Wrong. Please Try Ater Sometime");
			return redirect('/product/index');
		}
	}

	public function delete( $image_id ){

		$response = $this->curl_get('productimage/delete?productimage_id='.$image_id);

		if( !empty( $response ) ){
					
			if( $response[0]['status'] == 'true' ){

				if( !empty( $response[0]['data'] ) ){

					$flashdata = array(
		                "class" => "alert-success",
		                "message" => "Image Deleted Successfully"
		            );
		   
		            $this->session->set_flashdata('flash_message', $flashdata);

		            return redirect('product/edit/'.$response[0]['data']['product_id']);

				}else{

					$flashdata = array(
		                "class" => "alert-error",
		                "message" => "Image You Arr Trying To Delete Does Not Exist"
		            );
		   
		            $this->session->set_flashdata('flash_message', $flashdata);

		            return redirect('product/index');

				}

			}
		}else{

			$this->display_error_msg("Something Went Wrong. Please Try Ater Sometime");
			return redirect('product/index');
		}
	}

	public function save(){

		if( $_FILES['main_image']['size'] !== 0 && !$_FILES['main_image']['error'] ){

			$images = $this->upload_images( $_FILES['main_image'] );

    		if ( $images === FALSE) {
    			$this->display_error_msg("Make Sure You Provide Main Image For the Product with either jpg, png or gif format");

        		return redirect('product/index');

            }else{

            	$this->resize_images( $images );


            	$query = $this->db->query("SELECT main_image FROM tbl_products WHERE product_id=".$this->input->post('product_id'));
				$image = $query->first_row('array');

				if( file_exists('assests/uploads/images/'.$image['main_image']) ){

					unlink( 'assests/uploads/images/'.$image['main_image'] );

				}

				$this->product_model->update_main_image(array('main_image'=> $images[0]), $this->input->post('product_id'));
            }

		}
		if (!empty($_FILES['other_image']['name'][0])) {

        	$images = $this->upload_images($_FILES['other_image']);

        	if ( $images === FALSE) {
    			$this->display_error_msg("Make Sure You Provide Other Images for the Product with either jpg, png or gif format");

        		return redirect('product/index');

            }else{

            	$this->resize_images( $images );

            	$product_images = array();
				
				foreach($images as $key=> $image) {
					$product_images[$key]['product_id'] = $this->input->post('product_id');
					$product_images[$key]['image'] = $image;
				}

				$this->product_model->saveimages($product_images);

            }

        }

        return redirect('product/index');

	}

	private function upload_images($files){

		$config = array(
	        'upload_path'   => 'assests/uploads/images/',
	        'allowed_types' => 'jpg|gif|png',
	        'overwrite'     => 0,
	        'remove_spaces' => TRUE
	    );

	    $this->load->library('upload', $config);

	    if( is_array($files['name']) ){

	    	foreach ($files['name'] as $key => $image) {
		        $_FILES['images[]']['name']= $files['name'][$key];
		        $_FILES['images[]']['type']= $files['type'][$key];
		        $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
		        $_FILES['images[]']['error']= $files['error'][$key];
		        $_FILES['images[]']['size']= $files['size'][$key];



		        // $config['file_name'] = uniqid().'.'.pathinfo($image, PATHINFO_EXTENSION);
		        $config['file_name'] = $_FILES['images[]']['name'];
		        
		        $return_value[] = $config['file_name'];

		        $this->upload->initialize($config);

		        if ($this->upload->do_upload('images[]')) {
		            $this->upload->data();
		        } else {

		            return false;
		        }
		    }
	    }else{

	    	// Get the extension of the file
	    	// $config['file_name'] = uniqid().'.'.pathinfo($files['name'], PATHINFO_EXTENSION);
	    	$config['file_name'] = $files['name'];


	    	// Save name of the file so that it could be used for saving in the DB
	        $return_value[] = $config['file_name'];

	        $this->upload->initialize($config);

	        if ($this->upload->do_upload('main_image')) {
	            $this->upload->data();
	        } else {

	            return false;
	        }

	    }

	    return $return_value;

	}


	private function resize_images($images){

		$folders = array('popup', 'home', 'category', 'product', 'thumb');


		$folders = array();
		$folders[0]['name'] = 'popup';
		$folders[0]['width'] = 900;
		$folders[0]['height'] = 1000;

		$folders[1]['name'] = 'home';
		$folders[1]['width'] = 333;
		$folders[1]['height'] = 375;

		$folders[2]['name'] = 'category';
		$folders[2]['width'] = 250;
		$folders[2]['height'] = 280;

		
		$folders[3]['name'] = 'product';
		$folders[3]['width'] = 400;
		$folders[3]['height'] = 450;

		
		$folders[4]['name'] = 'thumb';
		$folders[4]['width'] = 100;
		$folders[4]['height'] = 112;
		
		$this->load->library("image_lib");


		foreach ($folders as $folder) {
			
			foreach($images as $image){

				$config_thumb = array(
					"image_library" => "gd2",
					"source_image" => "assests/uploads/images/".$image,
					"create_thumb" => FALSE,
					"new_image" => "assests/uploads/images/".$folder['name'],
					"maintain_ratio" => TRUE,
					"thumb_marker" =>  '',
					"width" => $folder['width'],
					"height" => $folder['height']
				);

				// initializing
				$this->image_lib->initialize($config_thumb);
				if (!$this->image_lib->resize()) {
					$error = $this->image_lib->display_errors("<p>", "</p>");
					$this->session->set_flashdata("photo_error",$error);
					print_r($error);
					die();
				}


			}
		}
	}



	private function curl_get( $url ){

		// echo API_URL.$url;
		// die();


		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL.$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response = json_decode(curl_exec($ch),true);
		curl_close($ch);

		return $response;

	}


	private function curl_post($url, $data){

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."product/multidelete");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		$response = curl_exec($ch);

		curl_close($ch);

		return $response;


	}

	public function display_error_msg( $msg ){
		$flashdata = array(
            "class" => "alert-error",
            "message" => $msg
        );

        $this->session->set_flashdata('flash_message', $flashdata);
	}



}