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

class Subscriber extends REST_Controller {

	function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model('subscriber_model'); 
       
    }
    
    function records_get()  {
        $count = $this->subscriber_model->subscribercount();
        $records = $this->subscriber_model->getlist();
        
		if(empty($records)) {
			$subscribers[0] = array('status'=>'false','message'=>'No Subscriber list found');
		} else {
			$subscribers[0] = array('status'=>'true','data'=>$records,'count'=>$count);
		}
		$this->response($subscribers,200); // 200 being the HTTP response code
    }

    function addme_post() {
    	if($this->post('email')) {
    		$myemail = $this->subscriber_model->addme($this->post('email'));
    		if((int) $myemail == 1) {
    			$subscriber[0] = array('status'=>'true','message'=>'You are Successfull subscribed to our newsletter.');
    		} else if((int) $myemail == 0) {
    			$subscriber[0] = array('status'=>'false','message'=>'You have already subscribed.');
    		}
    	} else {
    		$subscriber[0] = array('status'=>'false','message'=>'Please pass valid email id');
		}
    	$this->response($subscriber,200);
    }

    function unsubscribe_post() {
    	if($this->post('email')) {
    		$myemail = $this->subscriber_model->unsubscribe($this->post('email'));
    		if((int) $myemail == 1) {
    			$unsubscriber[0] = array('status'=>'true','message'=>'You are Successfull unsubscribed from our newsletter.');
    		} else if((int) $myemail == 0) {
    			$unsubscriber[0] = array('status'=>'false','message'=>'Your email id is not valid');
    		}
    	} else {
    		$unsubscriber[0] = array('status'=>'false','message'=>'Please pass valid email id');
		}
    	$this->response($unsubscriber,200);
    }
}

