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
 * @link		http://104.236.210.247/buglecms/index.php/api/subscriber/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
if(!class_exists('REST_Controller')) {
	require_once(APPPATH.'/libraries/REST_Controller.php');
}

class Order extends REST_Controller {

	function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model('order_model'); 
    }


    function bycustomer_get() {
    	if($this->get('customer_id')) {
    		$data = $this->order_model->bycustomer($this->get('customer_id'));
    		$orders[0] =  array('status'=>'true','message'=>'Your Orders list','data'=>$data);
    	} else {
    		$orders[0] =  array('status'=>'false','message'=>'Please pass customer id'); 
    	}
        $this->response($orders,200); 
    }

    //by order id and orders 
    
    function records_get() {
        if($this->get('limit')) {
            $data['limit'] = $this->get('limit');
        } else {
            $data['limit'] = 10;
        }
        if($this->get('skip')) {
            $data['skip'] = $this->get('skip');
        } else {
            $data['skip'] = 0;
        }
        $count = $this->order_model->ordercount();        
    	if($this->get('order_id')) {
            $data['order_id'] = $this->get('order_id');
    		$records = $this->order_model->byorder($data);
    	} else {
    		$records = $this->order_model->byorder($data);
    	}
    	$orders[0] =  array('status'=>'false','message'=>'Your Orders list','data'=>$records,'count'=>$count); 
    	$this->response($orders,200); 
    }

    function detail_get() {
        if($this->get('limit')) {
            $data['limit'] = $this->get('limit');
        } else {
            $data['limit'] = 5;
        }
        if($this->get('skip')) {
            $data['skip'] = $this->get('skip');
        } else {
            $data['skip'] = 0;
        }        
        if($this->get('order_id')) {
            $data['order_id'] = $this->get('order_id');
    		$count = $this->order_model->orderdetailcount($this->get('order_id'));
            $records = $this->order_model->orderdetail($data);
    		$orders[0] =  array('status'=>'true','message'=>'Your Orders list','data'=>$records,'count'=>$count);
    	} else {
    		$orders[0] =  array('status'=>'false','message'=>'Please pass order id'); 
    	}
    	$this->response($orders,200); 
    }   

    function changestatus_post() {
    	if($this->post('order_id') && $this->post('status')) {
    		$data = array(
    				'order_id' => $this->post('order_id'),
    				'status' => $this->post('status')
    			);
    		$this->order_model->changestatus($data);
    		$newstatus[0] =  array('status'=>'true','message'=>'your status has been updated'); 
    	} else {
    		$newstatus[0] =  array('status'=>'false','message'=>'Please pass all data'); 
    	}
    	$this->response($newstatus,200); 
    } 

    function invoice_get() {
    	if($this->get('order_id')) {
    		$data = $this->order_model->invoice($this->get('order_id'));
    		$invoice[0] =  array('status'=>'true','message'=>'your invoice','data'=>$data);
    	} else {
    		$invoice[0] =  array('status'=>'false','message'=>'Please pass order id'); 
    	}
    	$this->response($invoice,200); 
    }     

    function placeorder_post() {

    	if($this->post('orderdetail') && $this->post('order') && $this->post('customer_id')) {
         
      // 		if(!array_key_exists("shipping_id",$this->post("address"))) {
    		// 	$shipping['customer_id'] = $this->post("customer_id");
    		// 	$shipping['fname'] = $this->post("address")['ship_fname'];
    		// 	$shipping['lname'] = $this->post("address")['ship_lname'];    			
    		// 	$shipping['address1'] = $this->post("address")['ship_address1'];
    		// 	$shipping['address2'] = $this->post("address")['ship_address2'];    			
    		// 	$shipping['city'] = $this->post("address")['ship_city'];
    		// 	$shipping['state'] = $this->post("address")['ship_state'];
    		// 	$shipping['country'] = $this->post("address")['ship_country'];
    		// 	$shipping['zipcode'] = $this->post("address")['ship_zipcode']; 
    		// 	$shipping['mobilenumber'] = $this->post("address")['ship_mobilenumber'];
    		// 	$shipping_id = $this->order_model->addshipping($shipping);
    		// 	$order['shipping_id'] = $shipping_id;  			
    		// } else {
    		// 	//$order['shipping_id'] = $this->post("address")['shipping_id'];
      //           $order['shipping_id'] = 1;
    		// }
    		// if(!array_key_exists("billing_id",$this->post("address"))) {
    		// 	$billing['customer_id'] = $this->post("customer_id");
    		// 	$billing['fname'] = $this->post("address")['bill_fname'];
    		// 	$billing['lname'] = $this->post("address")['bill_lname'];    			
    		// 	$billing['address1'] = $this->post("address")['bill_address1'];
    		// 	$billing['address2'] = $this->post("address")['bill_address2'];    			
    		// 	$billing['city'] = $this->post("address")['bill_city'];
    		// 	$billing['state'] = $this->post("address")['bill_state'];
    		// 	$billing['country'] = $this->post("address")['bill_country'];
    		// 	$billing['zipcode'] = $this->post("address")['bill_zipcode']; 
    		// 	$billing['mobilenumber'] = $this->post("address")['bill_mobilenumber'];
    		// 	$billing_id = $this->order_model->addbilling($billing); 
    		// 	$order['billing_id'] = $billing_id;
    		// } else {
    		// 	//$order['billing_id'] = $this->post("address")['billing_id'];  
      //           $order['billing_id'] = 1;
    		// }
    		$order['customer_id'] = $this->post("customer_id");  		
    		// $order['sub_total'] = $this->post("order")['sub_total'];  
    		// $order['discount'] = $this->post("order")['discount'];  
    		// $order['giftcard'] = $this->post("order")['giftcard'];  
    		// $order['final_total'] = $this->post("order")['final_total'];  
    		$order['billing_id'] = 1;
            $order['shipping_id'] = 1;
            $order['sub_total'] = 0;  
            $order['discount'] = 0;  
            $order['giftcard'] = 0;  
            $order['final_total'] = $this->post("order")['final_total'];  
            
            $order_id = $this->order_model->addorder($order); 
    		
    		if($this->post('discount')['status'] == 1) {
    			$history['order_id'] = $order_id;
    			$history['giftcard_id'] = $this->post("discount")['giftcard_id'];  
    			$history['discount_id'] = $this->post("discount")['discount_id'];  
		 		$this->order_model->addhistory($history); 
    		}

    		//$orderdetail = $this->post('orderdetail');
			$cartids = $this->post('orderdetail');
            $orderdetail = array();
            foreach($cartids as $key=>$value) {
    			$orderdetail[$key]['order_id'] = $order_id;
                $orderdetail[$key]['cart_id'] = $value;
    		}
    		
    		$this->order_model->addorderdetail($orderdetail); 
    		$placeorder[0] =  array('status'=>'true','message'=>'Order has been placed');
    	} else {
    		$placeorder[0] =  array('status'=>'false','message'=>'Please pass all data');		
    	}	
    	$this->response($placeorder,200); 
    }
}
