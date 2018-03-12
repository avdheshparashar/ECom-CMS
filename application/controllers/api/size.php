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

class Size extends REST_Controller {

	function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model('size_model'); 
    }

    function records_get()  {
        $records = $this->size_model->getlist();
		if(empty($records)) {
			$sizes[0] = array('status'=>'false','message'=>'No size found');
		} else {
			$sizes[0] = array('status'=>'true','data'=>$records);
		}
		$this->response($sizes,200); // 200 being the HTTP response code
    }

    function add_post() {
    	if($this->post('value')) {
    		$data = array(
    			'value' => $this->post('value'),
    		);
    		$this->size_model->addsize($data);
    		$size[0] = array('status'=>'true','message'=>'Size has been created');
    	} else {
    		$size[0] = array('status'=>'false','message'=>'Please pass all the data');
		}
    	$this->response($size,200);
    }     

    function remove_post() {
    	if($this->post('sizeids')) {
    		$this->size_model->cancelall($this->post('sizeids'));
    		$remove[0] = array('status'=>'true','message'=>'Sizes has been deleted');
    	} else {
    		$remove[0] = array('status'=>'false','message'=>'Please pass valid size_id data');
    	}
    	$this->response($remove,200);
    }        
}