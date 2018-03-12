<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		BugleCMS
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Viral Thakkar
 * @link		http://104.236.210.247/buglecms/index.php/api/inquiry/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
if(!class_exists('REST_Controller')) {
	require_once(APPPATH.'/libraries/REST_Controller.php');
}

class Inquiry extends REST_Controller {

	function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model('inquiry_model'); 
       
    }
    
    function records_get()  {
        $count = $this->inquiry_model->inquirycount();        
        $records = $this->inquiry_model->getlist();
		if(empty($records)) {
			$inquiries[0] = array('status'=>'false','message'=>'No Inquiry found');
		} else {
			$inquiries[0] = array('status'=>'true','data'=>$records,'count'=>$count);
		}
		$this->response($inquiries,200); // 200 being the HTTP response code
    }

    function send_post() {
    	if($this->post('name') && $this->post('city') && $this->post('email') && $this->post('mobilenumber') && $this->post('message') && $this->post("product_id")) {
    		$data = array(
    			'name' => $this->post('name'),
    			'city' => $this->post('city'),
    			'email' => $this->post('email'),
    			'mobilenumber' => $this->post('mobilenumber'),
    			'message' => $this->post('message'),
    			'product_id' => (int) $this->post('product_id'),
    			'customer_id' => $this->post('customer_id') ? $this->post('customer_id') : 0,
    		);
    		$this->inquiry_model->sendinquiry($data);
    		$inquiry[0] = array('status'=>'true','message'=>'Inquiry has been send');
    	} else {
    		$inquiry[0] = array('status'=>'false','message'=>'Please pass all the data');
		}
    	$this->response($inquiry,200);
    }    

    function reply_post() {
    	if($this->post("inquiry_id")) {
    		$this->inquiry_model->reply($this->post("inquiry_id"));
    		$replied[0] = array('status'=>'true','message'=>'Reply has been send');
    	} else {
    		$replied[0] = array('status'=>'false','message'=>'Please pass valid inquiry_id data');	
    	}
    	$this->response($replied,200);
    }

    function remove_post() {
    	if($this->post('inquiryids')) {
    		$this->inquiry_model->cancelall($this->post('inquiryids'));
    		$remove[0] = array('status'=>'true','message'=>'Inquiries has been deleted');
    	} else {
    		$remove[0] = array('status'=>'false','message'=>'Please pass valid inquiry_id data');
    	}
    	$this->response($remove,200);
    }

    function message_get() {
		if($this->get("inquiry_id")) {
			$data = $this->inquiry_model->message($this->get("inquiry_id"));
			if(empty($data)) {
				$message[0] = array('status'=>'false','message'=>'Invalid Inquiry ID');	
			} else {
				$message[0] = array('status'=>'true','message'=>$data);	
			}
		} else {
			$message[0] = array('status'=>'false','message'=>'Please supply inquiry_id');	
		} 	
		$this->response($message,200);
    }
}
