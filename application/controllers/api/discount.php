<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
if(!class_exists('REST_Controller')) {
	require_once(APPPATH.'/libraries/REST_Controller.php');
}

class Discount extends REST_Controller {


	function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model('discount_model'); 
       
    }
 
    function records_get()  {
		$count = $this->discount_model->discountcount();
    	if($this->get('discount_id')) {
    		$data['discount_id'] = $this->get("discount_id");
    		$records = $this->discount_model->getlist($data);	
    	} else {
    		$records = $this->discount_model->getlist();	
    	}
    	$discounts[0] = array('status'=>'true','message'=>'Your discounts list','data'=>$records,'count'=>$count);
        $this->response($discounts,200);
    }

    function savediscount_post() {

    	if($this->post('name') && $this->post('code') && $this->post('discount_amount')) { 		
    		$data = array(
                'name' => $this->post('name'),
                'code' => $this->post('code'),
                'is_limit' => $this->post('is_limit'),
                'discount_type' => 1,
                'discount_amount' => $this->post('discount_amount'),
                'min_order' => $this->post('min_order'),
                'discount_begin' => date("Y-m-d", strtotime($this->post('discount_begin'))),
            );
			if($this->post('discount_ends')) {
				$data['discount_ends'] = date("Y-m-d", strtotime($this->post('discount_ends')));
                $data['is_expire'] = 1;
    		} else {
                $data['is_expire'] = 0;
    		}    
    		if($this->post('category_ids')) {
    			$data['category_ids'] = explode(",",$this->post('category_ids'));
    			$data['applytoall'] = 0;
    		} else {
    			$data['applytoall'] = 1;
    		}       
            if($this->post('discount_id')) {
                $data['discount_id'] = $this->post('discount_id');
                $data['modified'] = date("Y-m-d H:i:s");
            }
            $this->discount_model->savediscount($data);
            $page[0] = array('status'=>'true','message'=>'Discount has been updated');
        } else {
            $page[0] = array('status'=>'false','message'=>'Please pass all the data');
        }
        $this->response($page,200);
    }  

	function changestatus_post(){
		if($this->post('discountids')) {
			$this->discount_model->changestatus($this->post('discountids'));
			$status[0] = array('status'=> true, 'message'=> "Discount status changed successfully");
		}else{
			$status[0] = array('status'=> false, 'message'=> "Insufficient parameters provided");
		}
		return $this->response($status,200);
	}

	 function validate_post(){

	 }


	// function usagehistory_get(){
				
	// 	if( $this->get('discount_id') ){
	// 		$history = $this->discount_model->gethistory($this->get('discount_id'));
	// 		if( empty( $history ) ){
	// 			$response_ary[0] = array('status'=> false, 'message'=> "No Usage history found for this discount coupon");
	// 		}else{
	// 			$response_ary[0] = array('status'=> true, 'message'=> "Success", 'data'=> $history);
	// 		}
	// 	}else{
	// 		$response_ary[0] = array('status'=> false,  'message'=> "Insufficient parameters provided");
	// 	}
	// 	return $this->response($response_ary, 200);
	// }


}

