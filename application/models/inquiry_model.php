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


class inquiry_model extends REST_Controller {

	function getlist() {
		$query = $this->db->query("SELECT i.inquiry_id,p.name AS 'Product Name',i.email, i.mobilenumber, i.message,i.name,
										  i.is_reply,DATE_FORMAT(i.created,'%d %b %Y') as created 
								   FROM tbl_inquiries AS i 
			                       LEFT JOIN tbl_customers AS c ON i.customer_id = c.customer_id 
			                       LEFT JOIN tbl_products AS p ON i.product_id = p.product_id
			                       ORDER BY i.inquiry_id DESC");
		return $query->result_array();
	}

	function sendinquiry($data) {
		$this->db->insert('tbl_inquiries', $data); 
		return;
	}	

	function reply($inquiry_id) {
		$data = array('is_reply'=>1);
		$this->db->where('inquiry_id', $inquiry_id);
		$this->db->update('tbl_inquiries', $data); 
		return; 
	}

	function cancelall($ids) {
		$inquiry_ids = implode(",",$ids);
		$this->db->query("DELETE FROM tbl_inquiries WHERE inquiry_id IN (".$inquiry_ids.")");
		return;
	}

	function message($id) {
		$this->db->select('message');
		$query = $this->db->get_where('tbl_inquiries',array('inquiry_id'=>(int) $id));
		return $query->result_array();
	}

	function inquirycount() {
		$query = $this->db->query("SELECT COUNT(inquiry_id) AS num  FROM tbl_inquiries");
		$count = $query->result_array()[0]['num'];
		if(is_float($count/10)) {
			$count = (int) ($count/10) + 1;
		} else {
			$count = (int) $count / 10;
		}
		return $count;
	}	
}
