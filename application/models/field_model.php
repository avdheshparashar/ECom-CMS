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


class field_model extends CI_Model {

	function getlist($fieldid = null) {
		if($fieldid!=null) {
			$query = $this->db->query("SELECT * FROM tbl_fields WHERE field_id = ".$fieldid);
		} else {
			$query = $this->db->query("SELECT * FROM tbl_fields WHERE name NOT IN ('Brand','Category')");	
		}
		return $query->result_array();
	}

	function addfield($data) {
		if (array_key_exists('field_id',$data)) {
			$this->db->where("field_id",$data['field_id']);
			$this->db->update('tbl_fields', $data);
		} else {
			$this->db->insert('tbl_fields', $data); 
		}
		return;
	}

	function cancelall($ids) {
		$fields_ids = implode(",",$ids);
		$this->db->query("DELETE FROM tbl_fields WHERE field_id IN (".$fields_ids.")");
		return;
	}

	function fetch_fields(){
		$query = $this->db->query("SELECT name, field_id, is_require, content FROM tbl_fields WHERE name NOT IN ('Brand','Category')");
		$result = $query->result('array');
		return $result;

	}

} 

?>