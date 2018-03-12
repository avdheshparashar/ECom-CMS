<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class Inventory extends CI_Controller {
class Inventory extends Admin_Controller {


	public function index() {
		// Need to pass Product_id in cURL
		if($this->input->get('page')) {
			$data['skip'] = ($this->input->get('page') - 1) * 10;
			$response['active'] = $data['skip']/10 + 1;
		} else {
			$data['skip'] = 0;
			$response['active'] = 1;
		}		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."inventory/records?limit=10&skip=".$data['skip']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['inventories'] = (array) json_decode(curl_exec($ch),true);
		$response['title'] = "BugleCMS - Inventories List";
		curl_close($ch);
		$this->layout->view_render('admin/inventory/index', $response);
	}

	public function delete() {

		if( empty( $_POST ) ){
			$flashdata = array(
	            "class" => "alert-error",
	            "message" => "Selected Inventory Could Not Be Deleted"
	        );
		}
		else{

			$inventory = json_encode($_POST);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, API_URL."inventory/remove");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$inventory);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
			$response = (array) json_decode(curl_exec($ch));
			$response['title'] = "BugleCMS - Delete Inventory";
			curl_close($ch);

			if( array_key_exists(0, $response) && $response[0]->status == 'true' ){

				$flashdata = array(
		            "class" => "alert-success",
		            "message" => "Selected Inventory Deleted Successfully"
		        );
			}elseif( array_key_exists(0, $response) && $response[0]->status == 'false'  ){

				$flashdata = array(
		            "class" => "alert-error",
		            "message" => "Selected Inventory Could Not Be Deleted"
		        );

			}else{
				// response from cURL was null

				$flashdata = array(
		            "class" => "alert-error",
		            "message" => "Something Went Wrong. Please Try After Sometime"
		        );
			}
		}


		$this->session->set_flashdata('flash_message', $flashdata);

		redirect('/inventory/index');
	}

	public function add($productid)
	{
		if($productid) {
			$response['productid'] = $productid;
			$this->layout->view_render('admin/inventory/add',$response);
		} else {
			redirect('/inventory/index');
		}
	}

	public function edit($inventoryid) {
		$response['title'] = "BugleCMS - Update Inventory";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,API_URL."inventory/records?inventory_id=".(int)$inventoryid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['inventorydetail'] = (array) json_decode(curl_exec($ch),true);
		curl_close($ch);
		$this->layout->view_render('admin/inventory/edit', $response);
	}


	public function save() {
		$inventory = $_POST;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."inventory/saveinventory");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$inventory);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
		$response = curl_exec($ch);
		$response['title'] = "BugleCMS - Inventory Update";
		curl_close($ch);

		$flashdata = array(
            "class" => "alert-success",
            "message" => "Inventory Details Successfully Updated"
        );

		$this->session->set_flashdata('flash_message', $flashdata);

		redirect('/inventory/index');		
	}

	
}
?>
