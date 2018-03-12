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

class Field extends REST_Controller {

	function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model('field_model'); 
    }

    function records_get()  {
        if($this->get('field_id')) {
            $records = $this->field_model->getlist($this->get('field_id'));
        } else {
            $records = $this->field_model->getlist();
        }
        $fields[0] = array('status'=>'true','data'=>$records);
        $this->response($fields,200); // 200 being the HTTP response code
    }

    function add_post() {
    	if($this->post('name') && $this->post('content')) {
    		$data = array(
    			'name' => $this->post('name'),
                'field_type' => 1,
                'is_require' => 1,
                'is_filter' => 1,
                'content' => $this->post('content'),
    		);
            if($this->post('field_id')) { 
                $data['field_id'] = $this->post('field_id');
            }
    		$this->field_model->addfield($data);
    		$field[0] = array('status'=>'true','message'=>'Field has been created');
    	} else {
    		$field[0] = array('status'=>'false','message'=>'Please pass all the data');
		}
    	$this->response($field,200);
    }     

    function remove_post() {
    	if($this->post('fieldids')) {
    		$this->field_model->cancelall($this->post('fieldids'));
    		$remove[0] = array('status'=>'true','message'=>'Fields has been deleted');
    	} else {
    		$remove[0] = array('status'=>'false','message'=>'Please pass valid field_id data');
    	}
    	$this->response($remove,200);
    }        
}