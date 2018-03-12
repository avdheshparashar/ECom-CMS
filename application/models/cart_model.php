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


class cart_model extends REST_Controller {

	function getlist($customer_id) {
		$this->db->order_by("cart_id", "desc"); 
		$query = $this->db->query("SELECT ca.cart_id,ca.product_id,ca.customer_id,ca.qty,ca.created,c.fname,c.lname,c.mobilenumber,c.email,
										  p.name,p.reference_number,p.description,p.main_image
								   FROM tbl_carts AS ca 
			                       LEFT JOIN tbl_customers AS c ON ca.customer_id = c.customer_id 
			                       LEFT JOIN tbl_products AS p ON ca.product_id = p.product_id
			                       WHERE ca.customer_id = ".$customer_id);
		$carts = $query->result_array();
		foreach ($carts as $key => $value) {
			$query = $this->db->query("SELECT addon_name,addon_value FROM tbl_cartaddons WHERE cart_id = ".$value['cart_id']);
			$carts[$key]['addon'] = $query->result_array();
		}
		return $carts;
	}

	function countlist($customer_id) {
		$query = $this->db->query("SELECT ca.cart_id
								   FROM tbl_carts AS ca
			                       LEFT JOIN tbl_customers AS c ON ca.customer_id = c.customer_id 
			                       LEFT JOIN tbl_products AS p ON ca.product_id = p.product_id
			                       WHERE ca.customer_id = ".$customer_id);
		$wishcount = count($query->result_array());
		return $wishcount;	
	}

	function addmylist($data,$addon) {
		if (array_key_exists('cart_id',$data)) {
			$this->db->where("cart_id",$data['cart_id']);
			$this->db->update('tbl_carts', $data);
			$cartid = $data['cart_id'];
		} else {
			$this->db->insert('tbl_carts', $data); 
			$cartid = $this->db->insert_id();
		}
		
		if((int) $addon!=0) {
			$productinfo[0]['cart_id'] = $cartid;
			$productinfo[0]['addon_name'] = 'size';
			$productinfo[0]['addon_value'] = $addon['size'];
			$productinfo[1]['cart_id'] = $cartid;
			$productinfo[1]['addon_name'] = 'color';
			$productinfo[1]['addon_value'] = $addon['color'];
		}

		if (array_key_exists('cart_id',$data)) {
			$this->db->where('cart_id', $cartid);
			$this->db->update_batch('tbl_cartaddons', $productinfo, 'addon_name');
		} else {
			$this->db->insert_batch('tbl_cartaddons',$productinfo);
		}		
		
		return;
	}	

	function deletewish($cart_id) {
		$this->db->query("DELETE c.*,ca.* 
						  FROM tbl_carts c
						  INNER JOIN tbl_cartaddons ca ON c.cart_id = ca.cart_id
						  WHERE c.cart_id=".$cart_id);
		return;
	}	
}

?>