<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class Size extends CI_Controller {
class Publication extends Admin_Controller {

	public function __construct()
	{
        	parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');

	}

	
	public function index() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."publication/records");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['publications'] = (array) json_decode(curl_exec($ch),true);
		$response['title'] = "BugleCMS - publications List";
		$this->layout->view_render('admin/publication/index', $response);
	}

	public function add() {
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');

        $this->ckeditor->basePath = base_url().'asset/ckeditor/';
        $this->ckeditor->config['language'] = 'it';
        $this->ckeditor->config['width'] = '750px';
        $this->ckeditor->config['height'] = '200px';

        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../asset/ckfinder/');		
		$this->layout->view_render('admin/publication/add');
	}

	public function edit($publicationid) {
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');

        $this->ckeditor->basePath = base_url().'asset/ckeditor/';
        $this->ckeditor->config['language'] = 'it';
        $this->ckeditor->config['width'] = '750px';
        $this->ckeditor->config['height'] = '200px';

        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../asset/ckfinder/');		

		$page['publication_id'] = $publicationid;
		$response['title'] = "BugleCMS - Update publication";
		$this->load->model('publication_model'); 
		$response['more_images'] = $this->publication_model->getmoreimages($publicationid);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."publication/records?publication_id=".$publicationid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['publicationdetail'] = (array) json_decode(curl_exec($ch),true);
		curl_close($ch);
		$this->layout->view_render('admin/publication/edit', $response);
	}


	public function save() {
		
		
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
			$publication = $_POST;
			$this->form_validation->set_rules('title', 'Publication Name', 'required');
			$this->form_validation->set_rules('description', 'Publication Date', 'required');

			if ($this->form_validation->run() == FALSE) {
			    $this->display_error_msg(validation_errors());
	            return redirect('publication/add');
	        }

	        if( !array_key_exists('publication_id', $_POST) ){
	        	if((int) $_FILES['main_image']['size'] == 0 ){
	        		$message = "Main Image Is Required";
			        $this->display_error_msg($message);
	                return redirect('publication/add');
	        	} 
	        }        

			$config['upload_path'] = './assests/images/publications/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
	        $this->load->library('upload', $config);
       		$this->load->library("image_lib");

	        if((int) $_FILES['main_image']['size'] != 0) {
	            if(!$this->upload->do_upload('main_image')){ 
		        	$error = $this->upload->display_errors();
		        	$this->display_error_msg($error);
		        	return redirect('publication/add');
		        } else {
		        	$data_upload_files = $this->upload->data();
					$config_thumb = array(
						"image_library" => "gd2",
						"source_image" => "assests/images/publications/".$_FILES['main_image']['name'],
						"create_thumb" => FALSE,
						"new_image" => "assests/images/publications/".$_FILES['main_image']['name'],
						"maintain_ratio" => TRUE,
						"thumb_marker" =>  '',
						"width" => 349,
						"height" => 228
					);

					// initializing
					$this->image_lib->initialize($config_thumb);
					if (!$this->image_lib->resize()) {
						$error = $this->image_lib->display_errors("<p>", "</p>");
						$this->session->set_flashdata("photo_error",$error);
					}	
		        	$publication['main_image'] = $_FILES['main_image']['name'];
		        }
	    	}
	        $files = $_FILES['more_image'];
	        if($files['size'][0]!=0) {
		        $number_of_files = sizeof($_FILES['more_image']['tmp_name']);
		        for ($i = 0; $i < $number_of_files; $i++) {
					$_FILES['more_image']['name'] = $files['name'][$i];
	        		$_FILES['more_image']['type'] = $files['type'][$i];
	        		$_FILES['more_image']['tmp_name'] = $files['tmp_name'][$i];
	        		$_FILES['more_image']['error'] = $files['error'][$i];
	        		$_FILES['more_image']['size'] = $files['size'][$i];
	        		$this->upload->initialize($config);
	        		if ($this->upload->do_upload('more_image')) {
	          			$publication['more_image'][$i] = $files['name'][$i];
	        		} else {
	          			$error[$i] = $this->upload->display_errors();
	       			}	        	
		        }
		        $publication['more_image'] = implode(",",$publication['more_image']);
		    }
		   	$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, API_URL."publication/add");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$publication);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
			$response = (array) json_decode(curl_exec($ch),true);
			if($response[0]['status']=='true') {
				$this->display_success_msg($response[0]['message']);
			} else {
				$this->display_error_msg($response[0]['message']);
			}			
			$response['title'] = "BugleCMS - publication Update";
			curl_close($ch);
		}
		redirect('/publication/index');		
	}

	public function cancel() {
		$publication = json_encode($_POST);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."publication/remove");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$publication);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
		$response = (array) json_decode(curl_exec($ch),true);
		if($response[0]['status']=='true') {
			$this->display_success_msg($response[0]['message']);
		} else {
			$this->display_error_msg($response[0]['message']);
		}
		$response['title'] = "BugleCMS - Delete publication";
		curl_close($ch);
		redirect('/publication/index');
	}	

	public function imagedelete($imageid) {
		$this->load->model('publication_model'); 
		$this->publication_model->imagedelete($imageid);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function changeposition($imageid,$publicationid) {
		$this->load->model('publication_model'); 
		$this->publication_model->changeposition($imageid,$publicationid);
		redirect($_SERVER['HTTP_REFERER']);
	}

}