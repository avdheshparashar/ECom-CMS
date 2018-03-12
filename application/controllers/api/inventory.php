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
 * @author		Avdhesh Parashar
 * @Date		4th March 2015
 * @link		http://104.236.210.247/buglecms/index.php/api/product/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
if(!class_exists('REST_Controller')) {
	require_once(APPPATH.'/libraries/REST_Controller.php');
}

class Inventory extends REST_Controller {

	function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model('inventory_model'); 
       
    }

	function records_get(){
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
		if($this->get("product_id")) {
			$data['product_id'] = $this->get("product_id");
			$count = $this->inventory_model->inventorycount($this->get("product_id"));		
			$records = $this->inventory_model->getlist($data);	
		} else if($this->get("inventory_id")) {
			$data['inventory_id'] =  $this->get("inventory_id");
			$count = 0;		
			$records = $this->inventory_model->getlist($data);	
		} else {
			$count = $this->inventory_model->inventorycount();
			$records = $this->inventory_model->getlist($data);
		}
		$inventory[0] = array('status'=>'true','message'=>'Your inventory list','data'=>$records,'count'=>$count);
		$this->response($inventory,200);
	}


	function remove_post() {
		if($this->post("inventoryids")) {
			$this->inventory_model->remove($this->post("inventoryids"));
			$remove[0] = array('status'=>'true','message'=>'inventory has been removed');
		} else {
			$remove[0] = array('status'=>'false','message'=>'please pass product id');	
		}
		$this->response($remove,200);
	}

	function saveinventory_post() {

		if($this->post("product_id")) {

			$data_to_update = array('is_purchasable'=> $this->post('is_purchasable'), 
									'price'=> $this->post('price'), 
									'is_inventory'=> $this->post('is_inventory'));

			$this->inventory_model->update_product_inventory( $data_to_update, $this->post('product_id') );			
			
			$this->inventory_model->delete_by_product_id($this->post('product_id'));

			if( (int)$this->post('is_inventory') == 1 && !empty($this->post('inventory'))) {

				$this->inventory_model->save_inventory_batch( $this->post('inventory') );
			}

			if($this->post('price') !='' || (int) $this->post('price')!=0) {	 
				$filter[0]['details'] = $this->post('price');
				$filter[0]['is_price'] = 1;
				$filter[0]['product_id'] = $this->post("product_id");
				$filter[0]['field_id'] = 0;
				$this->product_model->update_price_filter($filter);
			}	

			$addinventory[0] = array('status'=>'true','message'=>'new inventory has been added to product');
		} else {
			$addinventory[0] = array('status'=>'false','message'=>'please pass all data');
		}
		$this->response($addinventory,200);
	}
}
