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


class size_model extends CI_Model {

	function getlist() {
		$query = $this->db->query("SELECT *
								   FROM tbl_sizes");
		return $query->result_array();
	}

	function addsize($data) {
		$this->db->insert('tbl_sizes', $data); 
		return;
	}

	function cancelall($ids) {
		$sizes_ids = implode(",",$ids);
		$this->db->query("DELETE FROM tbl_sizes WHERE size_id IN (".$sizes_ids.")");
		return;
	}

} 

?>
