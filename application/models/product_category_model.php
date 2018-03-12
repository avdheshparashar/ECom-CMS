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


class product_category_model extends CI_Model {

	function add_multiple($categories, $product_id){

		$mysql_str = "";

		foreach ($categories as $category) {
			$mysql_str =  $mysql_str . ", "  . "(" . $category .", " . $product_id .")";
		}

		$mysql_str = ltrim($mysql_str, ", ");

		$this->db->query("INSERT INTO tbl_product_categories (category_id, product_id) VALUES ".$mysql_str);

		return;
	}

	function update_categories_by_product_id( $new_categories, $product_id ){

		$query = $this->db->query("SELECT product_id,category_id from tbl_product_categories WHERE product_id= ".$product_id);
		$categories_old = $query->result_array();

		$new_categories =  $this->ary_formatting($new_categories, $product_id);

		$remove = $this->category_diff($categories_old, $new_categories);

		if(!empty($remove)) {
			foreach($remove as $key=>$val) {
				$this->db->query("DELETE FROM tbl_product_categories WHERE product_id = ".$val['product_id']. " AND category_id = ".$val['category_id']);
			}
		}

		$insert = $this->category_diff($new_categories, $categories_old);

		if(!empty($insert)) {
			$this->db->insert_batch('tbl_product_categories', $insert);
		}
		return;

	}


	function category_diff( $ary1, $ary2 ){

		foreach ($ary1 as $k1 => $v1) {
			foreach ($ary2 as $v2) {
				if( $v1['category_id'] == $v2['category_id'] ){
					unset( $ary1[$k1] );
				}
			}
		}

		return $ary1;

	}

	function ary_formatting( $new_categories, $product_id ){

		foreach ($new_categories as $key => $value) {
			unset($new_categories[$key]);
			$new_categories[$key] = array();
			$new_categories[$key]['product_id'] = $product_id;
			$new_categories[$key]['category_id'] = $value;
		}

		return $new_categories;

	}


}

