<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class Offer extends CI_Controller {
class Offer extends Admin_Controller {

	public function __construct()
	{
        parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');

	}
	
	
	public function index() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."offer/records");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['offers'] = (array) json_decode(curl_exec($ch),true);
		$response['title'] = "BugleCMS - Offers List";
		curl_close($ch);
		$this->layout->view_render('admin/offer/index', $response);
	}


	public function cancel() {
		$offerids = json_encode($_POST);
		//var_dump($offerids);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."offer/changestatus");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $offerids);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
		$response = (array) json_decode(curl_exec($ch),true);
		if($response[0]['status']=='true') {
			$this->display_success_msg($response[0]['message']);
		} else {
			$this->display_error_msg($response[0]['message']);
		}
		curl_close($ch);
		redirect('/offer/index');
	}	



	public function add()
	{
		$this->layout->view_render('admin/offer/add');
	}

	public function edit($offerid) {
		$response['title'] = "BugleCMS - Update Page";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."offer/edit?offer_id=".$offerid);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response = (array) json_decode(curl_exec($ch),true);
		if($response[0]['status']=='true') {
			$this->display_success_msg($response[0]['message']);
		} else {
			$this->display_error_msg($response[0]['message']);
		}
		curl_close($ch);
		$data['data'] = $response[0]['data'];
		$this->layout->view_render('admin/offer/edit', $data);
	}


	public function save() {
		
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

			$this->form_validation->set_rules('name', 'Offer Name', 'required');
			$this->form_validation->set_rules('offer_start', 'Offer Start', 'required');
			$this->form_validation->set_rules('offer_end', 'Offer End', 'required');
			$this->form_validation->set_rules('discount_amount', 'Discount Amount', 'required');

			if ($this->form_validation->run() == FALSE) {
		        $this->display_error_msg(validation_errors());
                if( array_key_exists('offer_id', $_POST) ){
		        	return redirect('offer/edit/'.$this->input->post('offer_id'));
		        }else{
		        	return redirect('offer/add');
		        }
	        }

	        if( !array_key_exists('product_ids', $_POST) || (array_key_exists('product_ids', $_POST) && empty($_POST['product_ids']))  ){
				$this->display_error_msg(validation_errors());
		        if( array_key_exists('offer_id', $_POST) ){
		        	return redirect('offer/edit/'.$this->input->post('offer_id'));
		        }else{
		        	return redirect('offer/add');
		        }               
	        }


			$offer = $_POST;
			if(array_key_exists('offer_id', $_POST) ){
				$url = API_URL."offer/update";
			}else{
				$url = API_URL."offer/create";
			}
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
			$response = (array) json_decode(curl_exec($ch),true);
			if($response[0]['status']=='true') {
				$this->display_success_msg($response[0]['message']);
			} else {
				$this->display_error_msg($response[0]['message']);
			}		
			$response['title'] = "BugleCMS - Offer Update";
			curl_close($ch);
		}
		redirect('/offer/index');		
	}

	


}

