<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class Slideshow extends CI_Controller {
class Slideshow extends Admin_Controller {

	
	public function index() {
		$response['title'] = "BugleCMS - Slideshows List";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."slideshow/records");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['slideshows'] = (array) json_decode(curl_exec($ch),true);
		curl_close($ch);

		// Get List Of Albums
		$this->load->model('album_model');
		$response['albums'] = $this->album_model->getlist();

		$this->layout->view_render('admin/slideshow/index', $response);

	}

	public function add()
	{
		$this->layout->view_render('admin/slideshow/add');
	}
	public function edit()
	{
		$this->layout->view_render('admin/slideshow/edit');
	}

	public function delete() {

		if( !empty( $_POST['slides'] ) ){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, API_URL."slideshow/remove");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST) );

			$response = (array)curl_exec($ch);
			$response['title'] = "BugleCMS - Delete Page";
			curl_close($ch);

		}

		redirect('/slideshow');	
	}

	public function save() {
		$slideshow = $_POST;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."slideshow/saveslideshow");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$slideshow);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
		$response = curl_exec($ch);
		$response['title'] = "BugleCMS - Slideshow Update";
		curl_close($ch);
		redirect('/slideshow');		
	}

	public function fetch_image(){

		if ($_SERVER['REQUEST_METHOD'] !== 'POST'  || $_POST['album_id'] === "")   {
		    //
		    exit;
		}

		$this->load->model('album_model');

		$album_id = $this->input->post('album_id');
		
		$data['images'] = $this->album_model->get_album_images( $album_id );

		if( $data['images'] ){

			$this->load->view('admin/slideshow/image', $data);

		}
	}

	public function save_slide(){

		if( !empty( $_POST ) && array_key_exists('image', $_POST) ){

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, API_URL."slideshow/saveslide");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST) );
			$response = curl_exec($ch);
			curl_close($ch);

			if( empty( $response ) ){

				$flashdata = array(
	                "class" => "alert-error",
	                "message" => "Slides could not be added"
	            );

			}else{

				$flashdata = array(
	                "class" => "alert-success",
	                "message" => "Slides added successfully"
	            );

			}
            
		}else{


			$flashdata = array(
                "class" => "alert-error",
                "message" => "Slides could not be added"
            );

		}

		$this->session->set_flashdata('flash_message', $flashdata);
		redirect('/slideshow');

	}




}


