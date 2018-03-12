<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class Discount extends CI_Controller {
class Discount extends Admin_Controller {
	

	public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

	public function index() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."discount/records");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['discounts'] = (array) json_decode(curl_exec($ch),true);
		$response['title'] = "BugleCMS - Discounts List";
		curl_close($ch);
        $this->layout->view_render('admin/discount/index', $response);
	}

	public function cancel() {
		$discount = json_encode($_POST);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."discount/changestatus");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$discount);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
		$response = (array) json_decode(curl_exec($ch),true);
		if($response[0]['status']=='true') {
			$this->display_success_msg($response[0]['message']);
		} else {
			$this->display_error_msg($response[0]['message']);
		}
		$response['title'] = "BugleCMS - Change Discount Status";
		curl_close($ch);
		redirect('/discount/index');
	}

	public function add() {

		$this->load->model('category_model'); 
		$categories = $this->category_model->fetch_categories();
		foreach ($categories as $key => $value) {
			$list[$value['category_id']] = $value['name'];
		}
		$categories['list'] = $list;
		$this->layout->view_render('admin/discount/add',$categories);
	}

	public function save() {

		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

			$this->form_validation->set_rules('name', 'Discount Name', 'required');
			$this->form_validation->set_rules('code', 'Discount Code', 'required');
			$this->form_validation->set_rules('is_limit', 'Is Limited', 'required|numeric');
			$this->form_validation->set_rules('discount_amount', 'Discount Amount', 'required|numeric|greater_than[0]');
			$this->form_validation->set_rules('min_order', 'Minimum Order', 'required|numeric');
			$this->form_validation->set_rules('discount_begin', 'Discount Begin', 'required');

			if ($this->form_validation->run() == FALSE) {
		        $this->display_error_msg(validation_errors());
                return redirect('discount/add');
	        }

	        if( !(array_key_exists('applytoall', $_POST) || array_key_exists('category_ids', $_POST))  ){
	        	$message = "Please Provide Category to Apply Discount to";
			    $this->display_error_msg($message);
	            return redirect('discount/add');
	        }

			$discount = $_POST;
			$discount['category_ids'] = implode(",",$_POST['category_ids']);	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, API_URL."discount/savediscount");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$discount);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
			$response = (array) json_decode(curl_exec($ch),true);
			$response['title'] = "BugleCMS - Discount Update";
			if($response[0]['status']=='true') {
				$this->display_success_msg($response[0]['message']);
			} else {
				$this->display_error_msg($response[0]['message']);
			}
			curl_close($ch);
		}
		redirect('/discount/index');		
	}

	public function history()
	{
		$this->layout->view_render('admin/discount/history');
	}
}


