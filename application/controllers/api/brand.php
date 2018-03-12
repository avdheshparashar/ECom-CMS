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

class Brand extends REST_Controller {

	function __construct() {
        // Construct our parent class
        parent::__construct();
        $config = array(
            'field' => 'slug',
            'slug' => 'name',
            'table' => 'tbl_brands',
            'brand_id' => 'brand_id',
        );
        $this->load->library('slug', $config);
        $this->load->model('brand_model'); 
       
    }
    
    function records_get()  {
        $count = $this->brand_model->brandcount();  
        $records = $this->brand_model->getlist($data);
        if(!empty($records)) {
            $brands[0] = array('status'=>'false','message'=>'Your brands list','data'=>$records,'count'=>$count); 
        } else {
            $brands[0] = array('status'=>'false','message'=>'no brands found'); 
        }
		$this->response($brands, 200);
    }

    function savebrand_post() {
        if($this->post('name')) {           
            $data = array(
                'name' => $this->post('name'),
                'description' => $this->post('description'),
            );
            if($this->post('banner_image')) {
                $data['banner_image'] = $this->post('banner_image');
            }
            if($this->post('brand_id')) {
                $data['brand_id'] = $this->post('brand_id');
                $data['modified'] = date("Y-m-d H:i:s");
            } else {
                $data['slug'] = $this->slug->create_uri($this->post('name'));
            }
            $this->brand_model->savebrand($data);
            $page[0] = array('status'=>'true','message'=>'Brand has been updated');
        } else {
            $page[0] = array('status'=>'false','message'=>'Please pass all the data');
        }
        $this->response($page,200);
    }       

    function remove_post() {
        if($this->post('brandids')) {
            $this->brand_model->cancelall($this->post('brandids'));
            $remove[0] = array('status'=>'true','message'=>'Brands has been deleted');
        } else {
            $remove[0] = array('status'=>'false','message'=>'Please pass valid brand_id data');
        }
        $this->response($remove,200);
    }        

}

