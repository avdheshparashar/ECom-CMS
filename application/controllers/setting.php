<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class Setting extends CI_Controller {
class Setting extends Admin_Controller {

	public function index() {
		if($this->input->get('page')) {
			$data['skip'] = ($this->input->get('page') - 1) * 10;
			$response['active'] = $data['skip']/10 + 1;
		} else {
			$data['skip'] = 0;
			$response['active'] = 1;
		}		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."setting/records?limit=10&skip=".$data['skip']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['settings'] = (array) json_decode(curl_exec($ch),true);
		$response['title'] = "BugleCMS - Settings List";
		curl_close($ch);
		$this->layout->view_render('admin/setting/index', $response);
	}

	public function edit($settingid) {
		$setting['setting_id'] = $settingid;
		$response['title'] = "BugleCMS - Update Setting";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."setting/records?setting_id=".$settingid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['settingdetails'] = (array) json_decode(curl_exec($ch),true);
		curl_close($ch);
		$this->layout->view_render('admin/setting/edit', $response);
	}	

	public function delete() {
		$setting = json_encode($_POST);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."setting/remove");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$setting);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
		$response = curl_exec($ch);
		$response['title'] = "BugleCMS - Delete Setting";
		curl_close($ch);
		redirect('/setting/index');
	}

	public function save() {
		$setting = $_POST;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."setting/savesetting");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$setting);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
		$response = curl_exec($ch);
		$response['title'] = "BugleCMS - Setting Update";
		curl_close($ch);
		redirect('/setting/index');		
	}

	
}


