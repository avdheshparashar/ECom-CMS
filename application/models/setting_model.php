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


class setting_model extends REST_Controller {

	function getlist($data) {
		if(array_key_exists('settings_id',$data)) {
			$query = $this->db->query("SELECT * 
									   FROM tbl_settings 
									   WHERE settings_id IN (".$settings_id.") 
									   ORDER BY settings_id DESC
									   LIMIT ".$data['limit']. " OFFSET ".$data['skip']);
		} else {
			$query = $this->db->query("SELECT * 
								       FROM tbl_settings
								       ORDER BY settings_id DESC
								       LIMIT ".$data['limit']. " OFFSET ".$data['skip']);	
		}
		return $query->result_array();
	}

	function savesetting($data) {
		if (array_key_exists('settings_id',$data)) {
			$this->db->where("settings_id",$data['settings_id']);
			$this->db->update('tbl_settings', $data);
		} else {
			$this->db->insert('tbl_settings', $data); 
		}
		return;
	}	

	function cancelsetting($settingids) {
		$settingids = implode(",",$settingids);
		$this->db->query("DELETE FROM tbl_settings WHERE settings_id IN(".$settingids.")");
		return;
	}
	
	function settingcount() {
		$query = $this->db->query("SELECT COUNT(settings_id) AS num  FROM tbl_settings");
		$count = $query->result_array()[0]['num'];
		if(is_float($count/10)) {
			$count = (int) ($count/10) + 1;
		} else {
			$count = (int) $count / 10;
		}
		return $count;
	}
}