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

class Publication extends REST_Controller {

	function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model('publication_model'); 
    }
 
    function records_get()  {
        $count = $this->publication_model->publicationcount();
        if($this->get('publication_id')) {
            $data['publication_id'] = $this->get("publication_id");
            $records = $this->publication_model->getlist($data);   
        } else {
            $records = $this->publication_model->getlist($data);   
        }
        $publications[0] = array('status'=>'true','message'=>'Your publications list','data'=>$records,'count'=>$count);
        $this->response($publications,200);
    }


    function add_post() {
    	if($this->post('title') && $this->post('description')) {
    		$data = array(
    			'title' => $this->post('title'),
                'description' => $this->post('description'),
                'link' => $this->post('link'),
    		);
            if($this->post('main_image')) {
                $data['main_image'] = $this->post('main_image');
            }
            if($this->post('more_image')) {
                $data['more_image'] = $this->post('more_image');
            }
            if($this->post('publication_id')) { 
                $data['publication_id'] = $this->post('publication_id');
            }         
            $this->publication_model->addpublication($data);
    		$publication[0] = array('status'=>'true','message'=>'publication has been created');
    	} else {
    		$publication[0] = array('status'=>'false','message'=>'Please pass all the data');
		}
    	$this->response($publication,200);
    }     

    function remove_post() {
    	if($this->post('publicationids')) {
            $this->publication_model->cancelall($this->post('publicationids'));
    		$remove[0] = array('status'=>'true','message'=>'publications has been deleted');
    	} else {
    		$remove[0] = array('status'=>'false','message'=>'Please pass valid publication_id data');
    	}
    	$this->response($remove,200);
    }        
}