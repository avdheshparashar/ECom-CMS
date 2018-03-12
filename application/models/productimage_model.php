<?php 
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


class productimage_model extends CI_Model {

	function getlist() {
		$query = $this->db->get('tbl_giftcards');
		return $query->result_array();
	}

	function add($data){
		$this->db->insert('tbl_product_images', $data);
		return;
	}


	function getimages_by_productid($product_id){
		$images = $this->db->query("SELECT product_image_id, image FROM tbl_product_images WHERE product_id=".$product_id);
		return $images->result();
	}


	function deletebyid($product_image_id){
		$query = $this->db->delete('tbl_product_images', array('product_image_id'=> $product_image_id));
		return;
	}

	function getbyid($product_image_id){
		$query = $this->db->query("SELECT * FROM tbl_product_images WHERE product_image_id=".$product_image_id);
		return $query->first_row('array');
	}

	function get_main_image( $product_id ){
		$query = $this->db->query("SELECT main_image AS image FROM tbl_products WHERE product_id=".$product_id);
		$result = $query->result('array');
		return empty( $result ) ? false : $result ;
	}


	function get_other_images_by_productid( $product_id ){

		$query = $this->db->query("SELECT * FROM tbl_product_images WHERE product_id=". $product_id);
		$result = $query->result('array');
		return $result;

	}

	function get_product_main_image( $product_id ){

		$query = $this->db->query("SELECT product_id, main_image FROM tbl_products WHERE product_id=".$product_id);
		$result = $query->first_row('array');
		return $result;

	}


}

