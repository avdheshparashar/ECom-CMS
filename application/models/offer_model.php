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


class offer_model extends REST_Controller {

	function getlist($data) {
		if(array_key_exists('offer_id',$data)) {
			$query = $this->db->query("SELECT o.offer_id,o.name AS offer_name,o.discount_type,o.discount_amount,o.discount_on,
											  o.item_id,o.status,DATE_FORMAT(o.created,'%d %b %Y') as created,c.name AS category_name,
											  p.name AS product_name,DATE_FORMAT(o.start,'%d %b %Y') as start,
											  DATE_FORMAT(o.end,'%d %b %Y') as end 
									   FROM tbl_offers o 
									   LEFT JOIN tbl_categories AS c ON(o.discount_on=1 AND o.item_id = c.category_id) 
									   LEFT JOIN tbl_products AS p ON(o.discount_on != 1 AND o.item_id=p.product_id)
									   WHERE o.status =1 AND offer_id = ".$data['offer_id'].
									   " ORDER BY o.offer_id DESC"); 
									  
		} else {
			$query = $this->db->query("SELECT o.offer_id,o.name AS offer_name,o.discount_type,o.discount_amount,o.discount_on,
											  o.item_id,o.status,DATE_FORMAT(o.created,'%d %b %Y') as created,c.name AS category_name,
											  p.name AS product_name,DATE_FORMAT(o.start,'%d %b %Y') as start,
											  DATE_FORMAT(o.end,'%d %b %Y') as end
									   FROM tbl_offers o 
									   LEFT JOIN tbl_categories AS c ON(o.discount_on=1 AND o.item_id = c.category_id) 
									   LEFT JOIN tbl_products AS p ON(o.discount_on != 1 AND o.item_id=p.product_id)
									   WHERE o.status = 1
									   ORDER BY o.offer_id DESC");
		}
		return $query->result_array();
	}

	function createoffer($data, $product_ids) {

		$this->db->insert('tbl_offers', $data);
		$offer_id =  $this->db->insert_id();

		// --Batch Insertion Begin

		$mysql_str = "";

		foreach ($product_ids as $product_id) {
			$mysql_str =  $mysql_str . ", "  . "(" . $product_id .", " . $offer_id .")";
		}

		$mysql_str = ltrim($mysql_str, ", ");

		$this->db->query("INSERT INTO tbl_product_offers (product_id, offer_id) VALUES ".$mysql_str);

		// -- Batch Insertion End

		$productsids = implode(",", $product_ids);

		$this->db->query("UPDATE tbl_products SET discount_price = price - (price * 
				".$data['discount_amount']. ")/100 WHERE product_id  IN(".$productsids.")");

		return;
	}


	function editoffer($data) {
		$this->db->where('offer_id', $data['data']['offer_id']);
		$this->db->update('tbl_offers', $data['data']);
		if( !empty( $data['offer_update'] ) ){
			foreach ($data['offer_update'] as $product) {
				if((int)$product['discount_price']!=0){
					$this->db->query("UPDATE tbl_products SET discount_price= price - (price * ".$product['discount_price']. ")/100 
								WHERE product_id=".$product['product_id']);
				}else{
					$this->db->query("UPDATE tbl_products SET discount_price=0 WHERE product_id=".$product['product_id']);
				}
			}
		}	
		if( !empty( $data['offer_remove'] ) ){
			$product_ids = implode(', ', $data['offer_remove']);
			$this->db->query("DELETE FROM tbl_product_offers WHERE product_id IN (". $product_ids .")");
		}

		if( !empty( $data['product_update'] ) ){
			$this->db->insert_batch('tbl_product_offers', $data['product_update']);
		}
		return;
	}

	function changestatus($offerids) {
		var_dump($offerids);
		foreach ($offerids as $key => $offerid) {
			$this->db->query("UPDATE tbl_offers SET status = 0 WHERE offer_id = ".$offerid);
			$query = $this->db->query("SELECT product_id FROM tbl_product_offers WHERE offer_id =  ".(int) $offerid);
			$results = $query->result_array();
			if(!empty($results)) {
				$i = -1;
				foreach ($results as $key => $group) {
					$productsids[++$i] = $group['product_id'];
				}
				$productsids = implode(",",$productsids);
				$this->db->query("UPDATE tbl_products SET discount_price = 0 WHERE product_id IN(".$productsids.")");
			}
			$this->db->query("DELETE FROM tbl_product_offers WHERE offer_id=".(int)$offerid);
		} 	
		return;
	}

	function offercount() {
		$query = $this->db->query("SELECT COUNT(offer_id) AS num  FROM tbl_offers");
		$count = $query->result_array()[0]['num'];
		if(is_float($count/10)) {
			$count = (int) ($count/10) + 1;
		} else {
			$count = (int) $count / 10;
		}
		return $count;
	}

	function product_by_category( $category_id, $product_ids ){

		$query = $this->db->query("SELECT p.product_id, p.name FROM tbl_products AS p 
																LEFT JOIN tbl_product_categories AS pc 
																	ON p.product_id = pc.product_id
														WHERE p.status = 1 AND pc.category_id=".$category_id ." 
																AND p.product_id NOT IN (". $this->array_to_string($product_ids) .")");

		$result = $query->result('array');
		return $result ;
	}

	function get_product(){

		$query = $this->db->query("SELECT product_id, name FROM tbl_products WHERE status=1 AND product_id NOT IN (". $this->array_to_string($product_ids) .")");

		$result = $query->result('array');
		return $result;

	}

	function array_to_string( $ary ){
		
		if( empty( $ary ) ){
			return 0;
		}
		$str = "";

		foreach( $ary as $value ){
			$str = $str . ", " . $value;
		}

		return ltrim($str, ", ");
	}


	function formatting_my_ary( $ary ){

		$str = "";

		foreach ($ary as $value) {
			$str = $str . ", " . $value['offer_id'];
		}

		return ltrim($str, ", ");

	}

	function products_having_offer(){


		$date = Date("Y-m-d");

		$query = $this->db->query("SELECT offer_id FROM tbl_offers WHERE status=1 AND start <= '". $date ."' AND end > '".$date."'");

		$valid_offers = $query->result('array');

		$qury = "SELECT product_id FROM tbl_product_offers WHERE offer_id IN (".$this->formatting_my_ary($offers) .")";
		return $qury;

		$query = $this->db->query("SELECT product_id FROM tbl_product_offers WHERE offer_id IN (".$this->formatting_my_ary($offers) .")");

		$products = $query->result('array');

		return $products;

		$query = $this->db->query("SELECT p.product_id FROM tbl_products AS p 
													LEFT JOIN tbl_offers AS o 
														ON o.item_id = p.product_id 
													WHERE o.discount_on = 1 AND o.status = 1 AND p.status = 1");
		$result = $query->result('array');

		
		if( empty( $result ) ){

			$query = $this->db->query("SELECT p.product_id FROM tbl_products AS p 
														LEFT JOIN tbl_offers AS o 
															ON o.item_id = p.product_id
														WHERE o.discount_on = 2 
															AND o.status = 1 
															AND p.status = 1");
			
		}else{

			$query = $this->db->query("SELECT p.product_id FROM tbl_products AS p 
														LEFT JOIN tbl_offers AS o 
															ON o.item_id = p.product_id
														WHERE o.discount_on = 2 
															AND o.status = 1 
															AND p.status = 1
															AND p.product_id NOT IN (". $this->array_to_string($result) .")");


		}

		$result = $query->result('array');
		return empty($result) ? false : $result ;

	}

	function all_categories(){
		$query = $this->db->query("SELECT category_id, name FROM tbl_categories");
		$result = $query->result('array');

		return $result;

	}


}
