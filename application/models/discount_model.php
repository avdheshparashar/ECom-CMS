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


class discount_model extends CI_Model {

	function savediscount($data) {
		if (array_key_exists('discount_id',$data)) {
			$this->db->where("discount_id",$data['discount_id']);
			$this->db->update('tbl_discounts', $data);
		} else {
			if(array_key_exists('category_ids',$data)) {
				$categoryids = $data['category_ids'];
				unset($data['category_ids']);
			}
			$this->db->insert('tbl_discounts', $data); 
			$discountid = $this->db->insert_id();
			if(!empty($categoryids)) {
				$discounts = array();
				foreach ($categoryids as $key => $value) {
					$discounts[$key]['category_id'] = $value;
					$discounts[$key]['discount_id'] = $discountid;
				}
				$this->db->insert_batch('tbl_discount_categories',$discounts); 
			}
		}
		return;
	}

	function changestatus($discountids){
		$discountids = implode(",",$discountids);
		$this->db->query("UPDATE tbl_discounts 
						  SET status = CASE WHEN status = 0 THEN 1 ELSE 0 END 
						  WHERE discount_id IN (".$discountids.")");
		return;
	}


	function getlist($data) {
		if(array_key_exists('discount_id',$data)) {
			$query = $this->db->query("SELECT discount_id,name,code,is_limit,discount_type,discount_amount,min_order,DATE_FORMAT(discount_begin,'%d %b %Y') as discount_begin,
											  DATE_FORMAT(discount_ends,'%d %b %Y') as discount_ends,is_expire,status,DATE_FORMAT(created,'%d %b %Y') as created 
									   FROM tbl_discounts 
									   WHERE discount_id=".$data['discount_id'].
									   " ORDER BY discount_id DESC");
		} else {
			$query = $this->db->query("SELECT d.discount_id,d.name,d.code,d.is_limit,d.discount_type,d.discount_amount,d.min_order,DATE_FORMAT(d.discount_begin,'%d %b %Y') as discount_begin,
											  DATE_FORMAT(d.discount_ends,'%d %b %Y') as discount_ends,d.is_expire,d.status,DATE_FORMAT(d.created,'%d %b %Y') as created,
											  GROUP_CONCAT(c.name) as category_name
									   FROM tbl_discounts d
									   LEFT JOIN tbl_discount_categories dc ON d.discount_id = dc.discount_id
									   LEFT JOIN tbl_categories c ON dc.category_id = c.category_id
									   GROUP BY d.discount_id
									   ORDER BY discount_id DESC");
		}
		return $query->result_array();
	}




	function getbycode($code){
		$query = $this->db->query("SELECT d.discount_id,d.code,d.name,d.is_expire,d.applytoall,d.is_limit,d.discount_amount,d.min_order,
                                          d.discount_begin,d.discount_ends,count(dh.discounthistory_id) as total_used,
                                          GROUP_CONCAT(dc.category_id) as category_ids
                                   FROM tbl_discounts d
                                   LEFT  JOIN  tbl_discounthistories dh ON dh.discount_id = d.discount_id
                                   LEFT  JOIN  tbl_discount_categories dc ON dc.discount_id = d.discount_id
                                   WHERE d.code='".$code."' AND d.status=1
                                   GROUP BY d.discount_id");
        $results = $query->result_array();
        if($results[0]['category_ids']) {
            $query = $this->db->query("SELECT DISTINCT product_id FROM tbl_product_categories WHERE  category_id IN (".$results[0]['category_ids'].")");
            $results[0]['product_ids'] = $query->result_array();
        }
        return $results;
	}


	function gethistory($discount_id){
		$query = $this->db->query("SELECT 
										o.order_id, o.discount, o.final_total, o.created, 
										c.fname, c.lname, c.customer_id, 
										d.discount_id
									FROM tbl_discounthistories AS h 
									LEFT JOIN tbl_orders AS o 
										ON h.order_id = o.order_id 
									LEFT JOIN tbl_customers AS c 
										ON h.customer_id = c.customer_id
									LEFT JOIN tbl_discounts AS d 
										ON h.discount_id = d.discount_id 
									WHERE h.discount_id=".$discount_id);

		return $query->result();
	}

	function discountcount() {
		$query = $this->db->query("SELECT COUNT(discount_id) AS num  FROM tbl_discounts");
		$count = $query->result_array()[0]['num'];
		if(is_float($count/10)) {
			$count = (int) ($count/10) + 1;
		} else {
			$count = (int) $count / 10;
		}
		return $count;
	}	

}

