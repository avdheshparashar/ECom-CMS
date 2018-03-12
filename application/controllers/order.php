<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class Order extends CI_Controller {
class Order extends Admin_Controller {

		public function __construct()
	{
        	parent::__construct();
		$this->load->library('session');

	}

	
	public function index()
	{
		if($this->input->get('page')) {
			$data['skip'] = ($this->input->get('page') - 1) * 10;
			$response['active'] = $data['skip']/10 + 1;
		} else {
			$data['skip'] = 0;
			$response['active'] = 1;
		}		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."order/records?limit=10&skip=".$data['skip']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response['title'] = "BugleCMS - Order List";
		$response['orders'] = (array) json_decode(curl_exec($ch),true);
		curl_close($ch);
		$this->layout->view_render('admin/order/index',$response);
	}

	public function changestatus() {
		$order['order_id'] = $this->input->get('order_id');
		$order['status'] = $this->input->get('status');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, API_URL."order/changestatus");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$order);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
		$response = curl_exec($ch);
		$response['title'] = "BugleCMS - Change Order Status";
		curl_close($ch);
		redirect('/order/index');
	}

	public function history($orderid)
	{
		if($orderid) {
			if($this->input->get('page')) {
				$data['skip'] = ($this->input->get('page') - 1) * 5;
				$response['active'] = $data['skip']/5 + 1;
			} else {
				$data['skip'] = 0;
				$response['active'] = 1;
			}			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, API_URL."order/orderdetail?order_id=".(int)$orderid."&limit=5&skip=".$data['skip']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$response['orderdetails'] = (array) json_decode(curl_exec($ch),true);
			$response['orderid'] = $orderid;
			$response['title'] = "BugleCMS - Order Detail";
			curl_close($ch);
			$this->layout->view_render('admin/order/history',$response);
		} 
	}
	public function invoice()
	{
		$this->layout->view_render('admin/order/invoice');
	}
}

