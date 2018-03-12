<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller- area
 * @author		Avdhesh Parashar
 * @date		4th March 2015
 * @link		http://104.236.210.247/buglecms/index.php/api/area/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
if(!class_exists('REST_Controller')) {
	require_once(APPPATH.'/libraries/REST_Controller.php');
}

class Area extends REST_Controller {

	function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model('area_model'); 
       
    }

    function country_get(){
		$records = $this->area_model->country();
		if(!empty($records)){
			$products[0] = array('status'=>'true','message'=>'Your countries list','data'=>$records);	
		}else{
			$products[0] = array('status'=>'false','message'=>'No Country Found');	
		}
		$this->response($products,200);
	}

    function state_get(){
    	if($this->get("country_id")) {
			$records = $this->area_model->state($this->get("country_id"));
			if(!empty($records)){
				$products[0] = array('status'=>'true','message'=>'Your states list','data'=>$records);	
			}else{
				$products[0] = array('status'=>'false','message'=>'No states Found');	
			}
		} else {
			$products[0] = array('status'=>'false','message'=>'Please supply country id');	
		}
		$this->response($products,200);
	}

    function city_get(){
    	if($this->get("state_id")) {
			$records = $this->area_model->city($this->get("state_id"));
			if(!empty($records)){
				$products[0] = array('status'=>'true','message'=>'Your cities list','data'=>$records);	
			}else{
				$products[0] = array('status'=>'false','message'=>'No cities Found');	
			}
		} else {
			$products[0] = array('status'=>'false','message'=>'Please supply state id');	
		}
		$this->response($products,200);
	}
}
