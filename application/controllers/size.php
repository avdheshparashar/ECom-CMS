<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class Size extends CI_Controller {
class Size extends Admin_Controller {

	public function __construct()
	{
        	parent::__construct();
		$this->load->library('session');

	}
	
	function index() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."size/records");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['sizes'] = (array) json_decode(curl_exec($ch),true);
		$response['title'] = "BugleCMS - Sizes List";
		$this->layout->view_render('admin/size/index', $response);
	}

	public function add()
	{
		$this->layout->view_render('admin/size/add');
	}


	public function save() {
		$size = $_POST;
		$this->load->library('form_validation');
		$this->form_validation->set_rules('value', 'value', 'required');
		if ($this->form_validation->run() == FALSE) {
        	$this->display_error_msg(validation_errors());
            redirect('size/index');
        }
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."size/add");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$size);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
		$response = (array) json_decode(curl_exec($ch),true);
		if($response[0]['status']=='true') {
			$this->display_success_msg($response[0]['message']);
		} else {
			$this->display_error_msg($response[0]['message']);
		}
		$response['title'] = "BugleCMS - Size Update";
		curl_close($ch);
		redirect('/size/index');		
	}

	public function delete() {
		$size = json_encode($_POST);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."size/remove");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$size);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
		$response = (array) json_decode(curl_exec($ch),true);
		if($response[0]['status']=='true') {
			$this->display_success_msg($response[0]['message']);
		} else {
			$this->display_error_msg($response[0]['message']);
		}
		$response['title'] = "BugleCMS - Delete Size";
		curl_close($ch);
		redirect('/size/index');
	}	

}