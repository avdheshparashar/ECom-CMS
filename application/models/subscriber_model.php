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


class subscriber_model extends REST_Controller {

	function getlist() {
		$query = $this->db->query("SELECT subscriber_id,email,DATE_FORMAT(created,'%d %b %Y') as created
								   FROM tbl_subscribers 
								   ORDER BY subscriber_id DESC");
		return $query->result_array();
	}

	function addme($email) {
		$query = $this->db->get_where('tbl_subscribers', array('email' => $email));
		$check = $query->result_array();
		if(empty($check)) {
			$data = array(
			   'email' => $email
			);
			$this->db->insert('tbl_subscribers', $data); 
			return 1;
		} else {
			return 0;
		}
	}

	function unsubscribe($email) {
		$query = $this->db->get_where('tbl_subscribers', array('email' => $email));
		$check = $query->result_array();
		if(empty($check)) {
			return 0;
		} else {
			$this->db->delete('tbl_subscribers', array('email' => $email)); 
			return 1;
		}
	}

	function subscribercount() {
		$query = $this->db->query("SELECT COUNT(subscriber_id) AS num  FROM tbl_subscribers");
		$count = $query->result_array()[0]['num'];
		if(is_float($count/10)) {
			$count = (int) ($count/10) + 1;
		} else {
			$count = (int) $count / 10;
		}
		return $count;
	}

}

