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


// class brand_model extends REST_Controller {
class brand_model extends CI_Model {

	function getlist($data) {
		$query = $this->db->query("SELECT *
								   FROM tbl_brands 
								   ORDER BY brand_id DESC");
		return $query->result_array();
	}

	function getbyid($brandid) {
		$query = $this->db->query("SELECT *
								   FROM tbl_brands 
								   WHERE brand_id =".$brandid);
		return $query->result_array();	
	}

	function brandcount() {
		$query = $this->db->query("SELECT COUNT(brand_id) AS num  FROM tbl_brands");
		$count = $query->result_array()[0]['num'];
		if(is_float($count/10)) {
			$count = (int) ($count/10) + 1;
		} else {
			$count = (int) $count / 10;
		}
		return $count;
	}	

	function get_name_id() {
		$query = $this->db->query("SELECT brand_id, name
								   FROM tbl_brands 
								   ORDER BY brand_id DESC");
		return $query->result_array();
	}


	function savebrand($data) {
		if (array_key_exists('brand_id',$data)) {
			$this->db->where("brand_id",$data['brand_id']);
			$this->db->update('tbl_brands', $data);
		} else {
			$this->db->insert('tbl_brands', $data); 
		}
		return;
	}	

	function cancelall($ids) {
		$brands_ids = implode(",",$ids);
		$this->db->query("DELETE FROM tbl_brands WHERE brand_id IN (".$brands_ids.")");
		return;
	}

	function fetch_brands(){
		$query = $this->db->query("SELECT brand_id, name FROM tbl_brands");
		$result = $query->result('array');
		return empty($result) ? false : $result ;
	}

	function getproducts($slug) {
        $query = $this->db->query("SELECT p.product_id,p.name product_name,p.main_image,p.reference_number,p.slug,p.is_featured,
								         p.price,p.discount_price,p.stamp
                                   FROM tbl_products p
                                   WHERE p.status = 1 AND p.brand_id = (
                                            SELECT brand_id
                                            FROM  tbl_brands
                                            WHERE  slug ='".$slug."')");
        $data['products'] = $query->result_array();

        $query = $this->db->query("SELECT * FROM tbl_brands WHERE slug = '".$slug."'");
        $data['brand'] = $query->result_array()[0];
        return $data;
	}

	function get_filter_content($slug) {

		$query = $this->db->query("SELECT brand_id FROM tbl_brands WHERE slug = '".$slug."'");
        $brandid = $query->result_array()[0]['brand_id'];

		$query = $this->db->query(" SELECT group_concat(distinct pf.details) AS details,pf.field_id,f.name,pf.is_price
				                    FROM tbl_product_filters pf 
				                    LEFT JOIN tbl_fields f ON f.field_id=pf.field_id  
				                    WHERE pf.field_id!=19 AND product_id IN (
				                   		SELECT product_id 
				                   		FROM tbl_products 
				                   		WHERE status = 1 AND brand_id= ".$brandid. "
				                   	) 
									GROUP BY field_id");
		return $query->result_array();
	}

	function get_productids($brandid) {
		$productids = $this->db->query("SELECT product_id FROM tbl_products WHERE status = 1 AND brand_id =".$brandid);
        return $productids->result_array();
	}

}

