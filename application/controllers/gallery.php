<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class Gallery extends CI_Controller {
class Gallery extends Admin_Controller {

	
	public function index() {

		$this->load->helper(array('form', 'url'));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."slideshow/records");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['slideshows'] = (array) json_decode(curl_exec($ch),true);
		curl_close($ch);
		$this->layout->view_render('admin/gallery/index', $response);
	}

	public function edit($slideshowid) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."slideshow/records?slideshow_id=".$slideshowid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['slideshowdetail'] = (array) json_decode(curl_exec($ch),true);
		curl_close($ch);
		$this->layout->view_render('admin/gallery/edit', $response);
	}

	public function save() {
		$slideshow = $_POST;
		if((int) $_FILES['image_name']['size']!=0) {
			$config['upload_path'] = './assests/images/slideshows/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
	        $this->load->library('upload', $config);
	        if(!$this->upload->do_upload('image_name')){ 
				$this->display_error_msg(validation_errors());
	        } else {
	        	$data_upload_files = $this->upload->data();
	        	$slideshow['image_name'] = $_FILES['image_name']['name'];
	        }
	    }
	    $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."slideshow/save");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$slideshow);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
		$response = (array) json_decode(curl_exec($ch),true);
		if($response[0]['status']=='true') {
			$this->display_success_msg($response[0]['message']);
		} else {
			$this->display_error_msg($response[0]['message']);
		}		
		$response['title'] = "BugleCMS - slideshow Update";
		curl_close($ch);
		redirect('/gallery/index');		
	}


	
}


