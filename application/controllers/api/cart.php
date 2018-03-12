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

class Cart extends REST_Controller {

	function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model('cart_model'); 
    }

    function records_get()  {
    	if($this->get("customer_id")) {
	    	$records = $this->cart_model->getlist($this->get("customer_id"));
			if(empty($records)) {
				$carts[0] = array('status'=>'false','message'=>'No cart found');
			} else {
				$carts[0] = array('status'=>'true','data'=>$records);
			}
		} else {
			$carts[0] = array('status'=>'false','message'=>"Please supply customer id.");
		}
 
		$this->response($carts,200); // 200 being the HTTP response code
    }

    function countlist_get() {
		if($this->get("customer_id")) {
	    	$records = $this->cart_model->countlist($this->get("customer_id"));
			$count[0] = array('status'=>'true','data'=>$records);
		} else {
			$count[0] = array('status'=>'false','message'=>"Please supply customer id.");
		}
		$this->response($count,200); // 200 being the HTTP response code    	
    }

    function addmylist_post() {
    	if($this->post("customer_id") && $this->post("product_id") && $this->post("qty") && $this->post("price")) {
    		$data = array(
    			'customer_id' => $this->post("customer_id"),
    			'product_id' => $this->post("product_id"),
                'qty' => $this->post("qty"),
                'price' => $this->post("price"),
                'created' => date("Y-m-d H:i:s")
    		);
            if($this->post('cart_id')) {
                $data['cart_id'] = $this->post('cart_id');
            }
            // if addon is blank then addon value will be '0' otherwise it will be array of value 
            // ex. addon['color'] = '#9sdf0ds';
            // ex. addon['size'] = '23';
            
            $this->cart_model->addmylist($data,$this->post('addon'));
    		$addlists[0] = array('status'=>'true','message'=>"Product has been added to cart");
    	} else {
    		$addlists[0] = array('status'=>'false','message'=>"Please supply customer id & product id");
    	}
    	$this->response($addlists,200); // 200 being the HTTP response code  
    }

    function deletewish_post() {
    	if($this->post("cart_id")) {
    		$this->cart_model->deletewish($this->post("cart_id"));
    		$remove[0] = array('status'=>'true','message'=>"Product has been deleted from cart");
    	} else {
    		$remove[0] = array('status'=>'false','message'=>"Please supply cart");
    	}
    	$this->response($remove,200); // 200 being the HTTP response code  
    }
}

