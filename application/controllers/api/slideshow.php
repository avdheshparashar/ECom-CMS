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

class Slideshow extends REST_Controller {

	function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model('slideshow_model'); 
       
    }
    
    function records_get()  {
        if($this->get('slideshow_id')) {
            $records = $this->slideshow_model->getlist($this->get('slideshow_id'));
        } else {
            $records = $this->slideshow_model->getlist();
        }
        $slideshows[0] = array('status'=>'true','data'=>$records);
        $this->response($slideshows,200); // 200 being the HTTP response code
    }

/*
*	Method to add review for a particular product
*	By default, it will be inactive
*
*
*/

    function save_post() {
        if($this->post('slideshow_id')) {
            $data = array(
                'slideshow_id' => $this->post('slideshow_id'),
                'link' => $this->post('link'),
            );
            if($this->post('image_name')) {
                $data['image_name'] = $this->post('image_name');
            }
            $this->slideshow_model->saveslideshow($data);
            $slideshow[0] = array('status'=>'true','message'=>'Slideshow has been updated');
        } else {
            $slideshow[0] = array('status'=>'false','message'=>'Please pass all the data');
        }
        $this->response($slideshow,200);
    } 

}

