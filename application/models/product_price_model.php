<?php 
/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Product Price Model
 * @author		Avdhesh Parashar
 * @date		4th March 2015
 * @contact		avdhesh@Bugletech.com
*/


class product_price_model extends CI_Model {

	function getlist() {
		$query = $this->db->get('tbl_product_prices');
		return $query->result_array();
	}


	function get_inventory_by_productid( $product_id ){



		$query = $this->db->query("SELECT p.product_id, p.size, p.stock, pr.price FROM tbl_product_prices AS p 
												LEFT JOIN tbl_products AS pr 
														ON p.product_id = pr.product_id 
												WHERE p.product_id=". $product_id);

		$result = $query->result('array');

		return $result;

	}

}

