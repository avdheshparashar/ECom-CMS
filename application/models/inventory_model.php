<?php 
/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Product Model
 * @author		Avdhesh Parashar
 * @date		4th March 2015
 * @contact		avdhesh@Bugletech.com
*/


class inventory_model extends REST_Controller {

	//GET INVENTORY LIST BY PRODUCT IT

	function getlist($data) {
		if(array_key_exists('product_id',$data)) {
			$query = $this->db->query("SELECT pp.product_id,pp.product_prices_id,pp.original_price,pp.discount_price,pp.size,pp.color,pp.stock,
											  p.name AS product_name,DATE_FORMAT(pp.created,'%d %b %Y') as created
									   FROM tbl_product_prices pp 
									   LEFT JOIN tbl_products p ON p.product_id = pp.product_id
									   WHERE product_id = ".$data['product_id'].
									   " LIMIT ".$data['limit']. " OFFSET ".$data['skip']);
		} else if(array_key_exists('inventory_id',$data)) {
			$query = $this->db->query("SELECT pp.product_id,pp.product_prices_id,pp.original_price,pp.discount_price,pp.size,pp.color,pp.stock,
											  p.name AS product_name,DATE_FORMAT(pp.created,'%d %b %Y') as created
									   FROM tbl_product_prices pp 
									   LEFT JOIN tbl_products p ON p.product_id = pp.product_id
									   WHERE product_prices_id = ".$data['inventory_id'].
									   " LIMIT ".$data['limit']. " OFFSET ".$data['skip']);
		} else {
			$query = $this->db->query("SELECT pp.product_id,pp.product_prices_id,pp.original_price,pp.discount_price,pp.size,pp.color,pp.stock,
											  p.name AS product_name,DATE_FORMAT(pp.created,'%d %b %Y') as created
									   FROM tbl_product_prices pp 
									   LEFT JOIN tbl_products p ON p.product_id = pp.product_id
									   LIMIT ".$data['limit']. " OFFSET ".$data['skip']);
		}
		return $query->result_array();
	}

	// REMOVE INVENTORY ID

	function remove($inventoryids) {
		$inventoryids = implode(",",$inventoryids);
		$this->db->query("DELETE FROM tbl_product_prices WHERE product_prices_id IN(".$inventoryids.")");
		return;
	}

	function saveinventory($inventory) {
		// $inventory = $this->discountupdate($inventory);
		if (array_key_exists('product_prices_id',$inventory)) {
			$this->db->where("product_prices_id",$inventory['product_prices_id']);
			$this->db->update('tbl_product_prices', $inventory);
		} else {
			$this->db->insert('tbl_product_prices', $inventory); 
		}
		return;
	}

	//UPDATE DISCOUNT PRICE FOR PERTICULAR INVENTORY

	function discountupdate($inventory) {
		$query = $this->db->query("SELECT * FROM tbl_offers WHERE discount_on = 2 AND item_id = ".$inventory['product_id']);
		$check = $query->result_array();
		if(!empty($check)) {
			if((int) $check[0]['discount_type']  == 1) {
				$inventory['discount_price'] = $inventory['original_price'] - $check[0]['discount_amount'];
			} else {
				$inventory['discount_price'] = $inventory['original_price'] - 
										($inventory['original_price'] * $check[0]['discount_amount'])/100;
			}	
		} else if(empty($check)){
			$query = $this->db->query("SELECT category_id FROM tbl_products WHERE product_id = ".$inventory['product_id']);
			$categoryid = $query->result_array()[0]['category_id'];
			$query = $this->db->query("SELECT * FROM tbl_offers WHERE discount_on = 1 AND item_id = ".$categoryid);
			$check = $query->result_array();
			if(!empty($check)) {
				if((int) $check[0]['discount_type']  == 1) {
					$inventory['discount_price'] = $inventory['original_price'] - $check[0]['discount_amount'];
				} else {
					$inventory['discount_price'] = $inventory['original_price'] - 
											($inventory['original_price'] * $check[0]['discount_amount'])/100;
				}				
			} else {
				$inventory['discount_price'] = 0;
			}
		}
		return $inventory;
	}

	function inventorycount($productid=null) {
		if($productid) {
			$query = $this->db->query("SELECT COUNT(product_prices_id) AS num  FROM tbl_product_prices WHERE product_id=".$productid);
		} else {
			$query = $this->db->query("SELECT COUNT(product_prices_id) AS num  FROM tbl_product_prices");
		}
		$count = $query->result_array()[0]['num'];
		if(is_float($count/10)) {
			$count = (int) ($count/10) + 1;
		} else {
			$count = (int) $count / 10;
		}
		return $count;
	}

	function delete_by_product_id($product_id){

		$this->db->query("DELETE FROM tbl_product_prices WHERE product_id=".$product_id);
		return;

	}

	function find_size_by_product_id( $product_id ){

		$query = $this->db->query("SELECT size FROM tbl_product_prices WHERE product_id=".$product_id);

		$result = $query->result('array');

		foreach ($result as $size) {
			$ary[] = $size['size'];
		}

		return $ary;

	}

	function delete_by_productid_size( $data, $product_id ){


		foreach ($data as $size) {
			$this->db->query("DELETE FROM tbl_product_prices WHERE size='".$size."' AND product_id=".$product_id);
		}
		return;


	}

	function save_inventory_batch( $data ){

		$this->db->insert_batch('tbl_product_prices', $data); 
	}

	function update_product_inventory( $data, $product_id ){

		$this->db->where('product_id', $product_id);

		$this->db->update('tbl_products', $data );
		return;


	}


}