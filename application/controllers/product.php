<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class Product extends CI_Controller {
class Product extends Admin_Controller {


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

		$this->load->library('form_validation');

		$this->load->model('product_model');
		$this->load->model('category_model');
		$this->load->model('field_model');
       
    }

	
	public function index() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,API_URL."product/records");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['products'] = (array) json_decode(curl_exec($ch),true);
		curl_close($ch);
		$this->layout->view_render('admin/product/index',$response);
	}


	public function add(){

		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
			$this->form_validation->set_rules('name', 'Product Name', 'required');
			$this->form_validation->set_rules('description', 'Long Description', 'required');
			//$this->form_validation->set_rules('short_description', 'Short Description', 'required');
			$this->form_validation->set_rules('reference_number', 'Product Code', 'required');
			$this->form_validation->set_rules('page_title', 'Page Title', 'required');
			$this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'required');
			$this->form_validation->set_rules('meta_description', 'Meta Description', 'required');
			$this->form_validation->set_rules('page_title', 'Page Title', 'required');

			$this->form_validation->set_rules('tags', 'Tags', 'required');
			// $this->form_validationion->set_rules('additional_info', 'Additional Information', 'required');
			$this->load->model('brand_model'); 
			$brandname = $this->brand_model->getbyid($_POST['brand_id']);
			$count = count($_POST['details']);
			$_POST['details'][$count]['field_id'] = "19";
			$_POST['details'][$count]['data'][0] = $brandname[0]['name'];
			$this->load->model('category_model'); 
			$categories = $this->category_model->check_second_level($_POST['category_ids']);
			$count = count($_POST['details']);
			$_POST['details'][$count]['field_id'] = "20";
			$_POST['details'][$count]['data'] = $categories;
			// var_dump($_POST['details']);

			// die();

            if ($this->form_validation->run() == FALSE) {
                $this->display_error_msg( validation_errors() );
                return redirect('product/add');
            }else{

            	if(empty($_FILES['main_image'])) {

            		$this->display_error_msg("Make Sure You Provide All Images and specifications");

                	return redirect('product/add');

            	}

            	if( empty($this->input->post('category_ids')) ){

            		$this->display_error_msg("Make Sure You Select At least one category");

                	return redirect('product/add');

            	}

            	if( !empty($_FILES['main_image']) && $_FILES['main_image']['tmp_name'] !== ""){

            		$images = $this->upload_images( $_FILES['main_image'] );

            		if ( $images === FALSE) {
            			$this->display_error_msg("Make Sure You Provide Main Image For the Product with either jpg, png or gif format");

                		return redirect('product/add');

	                }else{
	                	$this->resize_images( $images );

	                	$data_to_send = $_POST;

	                	$data_to_send['main_image'] = $images[0];
	                }

            	}else{
            		// No Image Detected
            		$this->display_error_msg("Make Sure You Provide Main Image For the Product with either jpg, png or gif format");

                	return redirect('product/add');

            	}


            	if (!empty($_FILES['other_image']['name'][0])) {

            		$images = $this->upload_images($_FILES['other_image']);

	                if ($images === FALSE) {


	                    $this->display_error_msg("Make Sure You Provide Other Images For the Product with either jpg, png or gif format");
	                    unlink('assests/uploads/images/'.$main_image);

                		return redirect('product/add');
	                }else{

				$this->resize_images( $images );

	                	$data_to_send['images'] = $images;

	                }
	            }

            	$stock_array = array();

            	if( array_key_exists('is_purchasable', $_POST) ){

            		$data_to_send['is_purchasable'] = 0;

            	}else{

            		$data_to_send['is_purchasable'] = 1;

            	}

            	if( array_key_exists('size_free', $_POST) ){

            		$data_to_send['is_inventory'] = 1;

					$stock_array[0]['size'] = 0;
					$stock_array[0]['color'] = 0;
					$stock_array[0]['stock'] = $_POST['stock'] ?  $_POST['stock'] : 0;

					$data_to_send['inventory'] = $stock_array;

            	}else{

            		$data_to_send['is_inventory'] = 1;

            		$i=0;

					foreach ($_POST['size'] as $key => $size) {
						$stock_array[++$i]['size'] = $size;
						$stock_array[$i]['color'] = 0;
						$stock_array[$i]['stock'] = $_POST['stock'][$key];

					}

					$data_to_send['inventory'] = $stock_array;

            	}
			
            	$specs = array();
            	if(array_key_exists('specification',$data_to_send)) {
	            	foreach ($data_to_send['specification'] as $key => $spec_name) {
	            		$specs[$spec_name] = $data_to_send['specvalue'][$key];
	            	}
	            	$data_to_send['specs'] = json_encode($specs);
				} else {
					$data_to_send['specs'] = '';
				}         	
               	$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, API_URL."product/add");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_to_send) );
				$response = (array) json_decode(curl_exec($ch),true);

				curl_close($ch);



				if( !empty( $response ) ){
					
					if( $response[0]['status'] == 'true' ){
						$flashdata = array(
		                    "class" => "alert-success",
		                    "message" => "Product Details Added Successfully"
		                );
		                $this->session->set_flashdata('flash_message', $flashdata);
					}else{

						$this->display_error_msg("Product Could Not Be Saved. Please Try After Sometime.");
					}
				}else{

					$this->display_error_msg("Something Went Wrong. Please Try Ater Sometime");
				}

	            return redirect('/product/index');

            }

		}

		$response = $this->curl_get("product/get_add_data");

		if( empty( $response ) ){
			$this->display_error_msg("Something went wrong, Please try after sometime");
			return redirect('product/index');
		}
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');

        $this->ckeditor->basePath = base_url().'asset/ckeditor/';
        $this->ckeditor->config['language'] = 'it';
        $this->ckeditor->config['width'] = '500px';
        $this->ckeditor->config['height'] = '200px';

        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../asset/ckfinder/');

		$data = $response[0]['data'];

		$this->load->model('brand_model');
		$brandata = $this->brand_model->getlist();
		// foreach($brandata as $key=>$value) {
		// 	$brands[$value['brand_id']] = $value['name'];
		// }
		//$data['brands'] = $brands;
		$this->layout->view_render('admin/product/add', $data);


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

		        $config['file_name'] = uniqid().'.'.pathinfo($image, PATHINFO_EXTENSION);
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
	    	$config['file_name'] = uniqid().'.'.pathinfo($files['name'], PATHINFO_EXTENSION);


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



	public function edit( $product_id ){
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');

        $this->ckeditor->basePath = base_url().'asset/ckeditor/';
        $this->ckeditor->config['language'] = 'it';
        $this->ckeditor->config['width'] = '500px';
        $this->ckeditor->config['height'] = '200px';

        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../asset/ckfinder/');
		$check = $this->product_model->check_id_exists($product_id);
		if($check ==0){
			
			$this->display_error_msg("Product You are Trying to edit does not exist");
            return redirect('product/index');
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,API_URL."product/get_edit_data?product_id=".$product_id);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response = json_decode(curl_exec($ch),true);
		curl_close($ch);


		if( empty( $response ) ){
			$this->display_error_msg("Something went wrong, Please try after sometime");
			return redirect('product/index');
		}

		$data = $response[0]['data'];

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// die();


		$data['tabdetails'] = $this->load->view('admin/product/edit/basic_detail',$data,true); 
		$data['tabdetails'] .= $this->load->view('admin/product/edit/seo',$data,true); 
		$data['tabdetails'] .= $this->load->view('admin/product/edit/attribute',$data,true); 
		$data['tabdetails'] .= $this->load->view('admin/product/edit/other_detail',$data,true); 

		$this->layout->view_render('admin/product/edit', $data);

	}


	public function update(){
      	if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

			if( !$this->input->post('product_id') || !$this->product_model->check_id_exists($this->input->post('product_id')) ){
				$flashdata = array(
	                "class" => "alert-error",
	                "message" => "Product You are Trying to edit does not exist"
	            );
	   
	            $this->session->set_flashdata('flash_message', $flashdata);
	            return redirect('product/index');
			}

			// $this->form_validation->set_rules('category_id', 'Category', 'required');
			// $this->form_validation->set_rules('brand_id', 'Brand', 'required');
			$this->form_validation->set_rules('name', 'Product Name', 'required');
			$this->form_validation->set_rules('description', 'Long Description', 'required');
			$this->form_validation->set_rules('short_description', 'Short Description', 'required');
			$this->form_validation->set_rules('reference_number', 'Product Code', 'required');
			$this->form_validation->set_rules('page_title', 'Page Title', 'required');
			$this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'required');
			$this->form_validation->set_rules('meta_description', 'Meta Description', 'required');
			$this->form_validation->set_rules('page_title', 'Page Title', 'required');
			//$this->form_validation->set_rules('additional_info', 'Additional Information', 'required');

			$this->load->model('brand_model'); 
			$brandname = $this->brand_model->getbyid($_POST['brand_id']);
			$count = count($_POST['details']);
			$_POST['details'][$count]['field_id'] = "19";
			$_POST['details'][$count]['data'][0] = $brandname[0]['name'];
			$this->load->model('category_model'); 
			$categories = $this->category_model->check_second_level($_POST['category_ids']);
			$count = count($_POST['details']);
			$_POST['details'][$count]['field_id'] = "20";
			$_POST['details'][$count]['data'] = $categories;

			if ($this->form_validation->run() == FALSE) {
                $flashdata = array(
                    "class" => "alert-error",
                    "message" => validation_errors()
                );
                
            $this->session->set_flashdata('flash_message', $flashdata);
            return redirect('product/edit/'.$this->input->post('product_id'));

            }else{
            	$data_to_send = $_POST;
            	if(array_key_exists("specification",$data_to_send)) {
	            	$specs = array();
	            	foreach ($data_to_send['specification'] as $key => $spec_name) {

	            		$specs[$spec_name] = $data_to_send['specvalue'][$key];

	            	}

	            	$data_to_send['specs'] = json_encode($specs);
	            } else {
	            	$data_to_send['specs'] = "";
	            }	

    //         	echo "<pre>";
				// print_r($data_to_send);
				// echo "</pre>";
				// die();

            	$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, API_URL."product/edit");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_to_send));
				$response = (array) json_decode(curl_exec($ch),true);

				curl_close($ch);


				if( empty( $response ) ){
					$flashdata = array(
	                    "class" => "alert-error",
	                    "message" => "Something Went Wrong. Please Try After Sometime"
                	);
				}elseif( $response[0]['status'] == 'false' ){
					$flashdata = array(
	                    "class" => "alert-error",
	                    "message" => "Please Make Sure You Provide All Required Data"
                	);
				}else{
					$flashdata = array(
	                    "class" => "alert-success",
	                    "message" => "Product Details Successfully Updated"
                	);
				}
			
				
                
	            $this->session->set_flashdata('flash_message', $flashdata);
	            return redirect('product/index');

				// echo "<pre>";
				// var_dump($response);
				// echo "</pre>";
				// die();

            }
		}
	}

	public function remove_image(){

		if( $_POST['image_id'] != "" ){
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL,API_URL."album/remove_image?id=".$_POST['image_id']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$response['remove'] = (array) json_decode(curl_exec($ch),true);
			curl_close($ch);

			echo 'true';
		}else{

			echo 'false';
		}
	}

	public function delete(){

		if( empty( $_POST ) ){
			$flashdata = array(
                "class" => "alert-error",
                "message" => "Make Sure You Select At Least One Product To Delete"
        	);
        	$this->session->set_flashdata('flash_message', $flashdata);
        	redirect('product/index');
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."product/multidelete");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
		$response = curl_exec($ch);
		// $response['title'] = "BugleCMS - Change Discount Status";
		curl_close($ch);


		$flashdata = array(
            "class" => "alert-success",
            "message" => "Selected Products Deleted Successfully"
    	);
    	$this->session->set_flashdata('flash_message', $flashdata);
		redirect('product/index');
	}

	public function changeimage() {

		$this->load->helper(array('form', 'url'));
		$ch = curl_init();
		if($this->input->get('image_id') == 2) {
			curl_setopt($ch, CURLOPT_URL, API_URL."productimage/productimages?product_id=".$this->input->get('product_id'));
		} else if($this->input->get('image_id') == 1){
			curl_setopt($ch, CURLOPT_URL, API_URL."product/records?product_id=".$this->input->get('product_id'));
		} else {
			curl_setopt($ch, CURLOPT_URL, API_URL."productimage/productimages?product_id=".$this->input->get('product_id'));			
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['moreimages'] = (array) json_decode(curl_exec($ch),true);
		curl_close($ch);


		$query = $this->db->query("SELECT main_image AS image FROM tbl_products WHERE product_id=".$_GET['product_id']);
		$response['main_image'] = $query->first_row('array');

		$query = $this->db->query("SELECT * FROM tbl_albums");

		$response['albums'] = $query->result('array');
		//var_dump( $result );
		//die();

		$query = $this->db->query("SELECT image, product_image_id AS image_id FROM tbl_product_images WHERE product_id=".$_GET['product_id']);
		$response['images'] = $query->result('array');

		$this->layout->view_render('admin/product/changeimage',$response);		
	}


	public function product_image(){


		if( array_key_exists('product_id', $_POST) && $_POST['product_id'] !== "" && array_key_exists('main', $_POST) ){

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, API_URL."productimage/productimages");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST );
				$response = (array) curl_exec($ch);
				// $response['title'] = "BugleCMS - Change Discount Status";
				curl_close($ch);

			echo "<pre>";
			print_r($response);
			echo "</pre>";

			die();
			
		}

	}



	public function edit_inventory( $product_id ){

		$inventory = true;

		if( !$this->product_model->check_inventory_exist( $product_id ) ){

			$inventory = false;

		}

		$data['product_id'] = $product_id;

		$this->load->model('size_model');


		$data['sizes'] = $this->size_model->getlist();


		if( $inventory ){
			$this->load->model('product_price_model');
			$data['product'] = $this->product_price_model->get_inventory_by_productid( $product_id );
			$data['info'] = $this->product_model->get_fields_by_product_id( 'is_purchasable, is_inventory, price', $product_id );
		}
		$data['inventory'] = $inventory;

		


		$this->layout->view_render('admin/product/edit/inventory', $data);

	}



	public function update_inventory(){

		$data_to_send = array();

		$data_to_send['is_inventory'] = true;
		$data_to_send['product_id'] = $this->input->post('product_id');

		if( array_key_exists('price', $_POST) ){

			$data_to_send['price'] = $this->input->post('price');

		}else{

			$data_to_send['price'] = 0;

		}

		if( array_key_exists('is_purchasable', $_POST) ){

    		$data_to_send['is_purchasable'] = 0;

    	}else{

    		$data_to_send['is_purchasable'] = 1;

    	}



		if( array_key_exists('size_free', $_POST) ){

			$stock_array = array();
			$stock_array[0]['size'] = 0;
			$stock_array[0]['color'] = 0;
			$stock_array[0]['stock'] = $this->input->post('stock');
			$stock_array[0]['modified'] = date('Y:m:d h:i:s');
			$stock_array[0]['product_id'] = $this->input->post('product_id');

			$data_to_send['size'] = 0;
			$data_to_send['inventory'] = $stock_array;

		}else{

			$stock_array = array();

			$i=0;

			foreach ($_POST['size'] as $key => $size) {

				$stock_array[++$i]['size'] = $size;
				$stock_array[$i]['color'] = 0;
				$stock_array[$i]['stock'] = $_POST['stock'][$key];
				$stock_array[$i]['modified'] = date('Y-m-d H:i:s');
				$stock_array[$i]['product_id'] = $this->input->post('product_id');

			}

			$data_to_send['inventory'] = $stock_array;

		}

		/*
		echo "<pre>";
		print_r($data_to_send);
		echo "</pre>";
		die();
		*/

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."inventory/saveinventory");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_to_send));
		$response = json_decode(curl_exec($ch), true);
		curl_close($ch);

		if( !empty( $response ) ){
					
			if( $response[0]['status'] == 'true' ){
				$flashdata = array(
                    "class" => "alert-success",
                    "message" => "Product Stock Details Updated Successfully"
                );
                $this->session->set_flashdata('flash_message', $flashdata);
			}else{

				$this->display_error_msg("Product Stock Details Could Not Be Saved. Please Try After Sometime.");
			}
		}else{

			$this->display_error_msg("Something Went Wrong. Please Try Ater Sometime");
		}

        return redirect('product/index');

	}

	private function curl_get( $url ){
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
		curl_setopt($ch, CURLOPT_URL, API_URL.$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		$response = json_decode(curl_exec($ch), true);
		curl_close($ch);
		return $response;
	}


	public function upload() {
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$config['upload_path'] = './assests/files/';
	        $config['allowed_types'] = 'text/plain|text/csv|csv';
	        $this->load->library('upload', $config);
	        if(!$this->upload->do_upload('uploadcsv')){ 
	        	$error = $this->upload->display_errors('<div style="color:red">','</div>');
	        	$this->session->set_flashdata('slider_error',$error);
	        } else {
	        	$data_upload_files = $this->upload->data();
		    }
            $csvpath = base_url(). 'assests/files/'.$_FILES['uploadcsv']['name'];
			$handle = fopen($csvpath, "r");
			$header = array(0=>'id',1=>'product_name',2=>'product_code',3=>'category_id',4=>'brand_id',5=>'tags',6=>'short_description',
					7=>'long_description',8=>'additional_info',9=>'page_title',10=>'meta_description',11=>'meta_keywords',12=>'main_image',
					13=>'more_image',14=>'attributes',15=>'stamp',16=>'is_stock?',17=>'price',18=>'inventory',19=>'specification',
					20=>'video',21=>'is_purchasable');				
			$return = array(
	            'messages' => array(),
	            'errors' => array(),
	       	);				
			$i = 0;
			$error = array();
	       	while (($row = fgetcsv($handle)) !== FALSE) {
	            $i++;
	            $data = array();
	  			foreach ($header as $k=>$head) {
	                if (strpos($head,'.')!==false) {
	                    $h = explode('.',$head);
	                    $data[$h[0]][$h[1]]=isset($row[$k]) ? $row[$k] : '';
	                } else {
	                    $data['Upload'][$head]=isset($row[$k]) ? $row[$k]: '';
	                }
	            }
	            
				if($data['Upload']['specification']!='0') {
					$lists = explode(",",$data['Upload']['specification']);
					$i = -1;
					$specifications = array();
					foreach($lists as $list) {
						$attrs = explode("-",$list);
						$specifications[$attrs[0]] = $attrs[1];
					}						
				}
				
				$product = array();
				$product['name'] =  $data['Upload']['product_name'];
				$product['brand_id'] =  $data['Upload']['brand_id'];
				$product['reference_number'] =  $data['Upload']['product_code'];
				$product['short_description'] =  $data['Upload']['short_description'];
				$product['description'] =  $data['Upload']['long_description'];
				$product['page_title'] =  $data['Upload']['page_title'];
				$product['meta_description'] =  $data['Upload']['meta_description'];					
				$product['meta_keywords'] =  $data['Upload']['meta_keywords'];
				$product['stamp'] =  $data['Upload']['stamp'];
				$product['is_inventory'] =  1;
				$product['price'] =  $data['Upload']['price'];            
	        	$product['slug'] =  $data['Upload']['is_purchasable'];
	        	$product['video'] =  $data['Upload']['video'];
	        	$product['main_image'] =  $data['Upload']['main_image'];
	        	$product['additional_info'] =  $data['Upload']['additional_info'];
	        	$product['slug'] =  $this->slug->create_uri($data['upload']['product_name']);
	        	$product['specification'] =  json_encode($specifications);

	        	$this->load->model('product_model'); 
				$productid = $this->product_model->add($product);


				if($data['Upload']['price']!='0') {	
					$filter[0]['details'] = $data['Upload']['price'];
					$filter[0]['is_price'] = 1;
					$filter[0]['product_id'] = $productid;
					$filter[0]['field_id'] = 0;
					$this->product_model->addfilter($filter);
				}			

	        	if($data['Upload']['category_id']!='0') {
					$category = array();
					$lists = explode(",",$data['Upload']['category_id']);
					$i = -1;
					foreach($lists as $list) {
						$category[++$i] = $list;
					}						
					$this->load->model('product_category_model'); 
					$this->product_category_model->add_multiple($category,$productid);
				}				
				
				
				if($data['Upload']['tags']!='0') {
					$tags = array();
					$lists = explode(",",$data['Upload']['tags']);
					$i = -1;
					foreach($lists as $list) {
						$tags[++$i]['tag'] = $list;
						$tags[$i]['product_id'] = (int) $productid;
					}
					$this->product_model->savetags($tags);						
				}					
				
				if($data['Upload']['more_image']!='0') {
					$images = array();
					$lists = explode(",",$data['Upload']['more_image']);
					$i = -1;
					foreach($lists as $list) {
						$images[++$i]['image'] = $list;
						$images[$i]['product_id'] = $productid;
					}						
					$this->product_model->saveimages($images);
				}			

				if($data['Upload']['attributes']!='0') {
					$lists = explode(",",$data['Upload']['attributes']);
					$i = -1;
					$attributes = array();
					foreach($lists as $list) {
						$attrs = explode("-",$list);
						$attrsvalues = explode("/",$attrs[1]);
						foreach ($attrsvalues as $key => $attrsvalue) {
							$attributes[++$i]['product_id'] = $productid;
							$attributes[$i]['field_id'] = $attrs[0];
							$attributes[$i]['details'] = $attrsvalue;
						}
					}						
					$this->load->model('brand_model'); 
					$brandname = $this->brand_model->getbyid($data['Upload']['brand_id']);
					$count = count($attributes);
					$attributes[$count]['product_id'] = $productid;
					$attributes[$count]['field_id'] = "19";
					$attributes[$count]['details'] = $brandname[0]['name'];
					$this->load->model('category_model'); 
					$lists = explode(",",$data['Upload']['category_id']);
					$categories = $this->category_model->check_second_level($lists);
					$i = $count;
					foreach ($categories as $key => $value) {
						$attributes[++$i]['product_id'] = $productid;
						$attributes[$i]['field_id'] = "20";
						$attributes[$i]['details'] = $value;					
					}
					$this->product_model->savedetail($attributes);
					$this->product_model->addfilter($attributes);
				}
				
				if($data['Upload']['inventory']!='0') {
					$lists = explode(",",$data['Upload']['inventory']);
					$i = -1;
					$inventories = array();
					foreach($lists as $list) {
						$attrs = explode("-",$list);
						$inventories[++$i]['size'] = $attrs[0];
						$inventories[$i]['stock'] = $attrs[1];
						$inventories[$i]['color'] = 0;
						$inventories[$i]['product_id'] = $productid;				
					}	
					$this->product_model->addtoinventory($inventories);
				}				
	        }
	        redirect("product/index");
	    } else {
			$this->layout->view_render('admin/product/upload');		
	    }
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

		$folders[4]['name'] = 'search';
		$folders[4]['width'] = 250;
		$folders[4]['height'] = 280;
		
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
					// print_r($error);
					// die();
				}


			}
		}
	}






    function makefeatured($productid) {
        $this->product_model->makefeatured($productid);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

}