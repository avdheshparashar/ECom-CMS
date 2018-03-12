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


class slideshow_model extends REST_Controller {

	function getlist($slideshowid = null) {
		if($slideshowid!=null) {
			$query = $this->db->query("SELECT * FROM tbl_slideshows WHERE slideshow_id = ".$slideshowid);
		} else {
			$query = $this->db->query("SELECT * FROM tbl_slideshows");	
		}
		return $query->result_array();
	}

	function saveslideshow($data) {
		if (array_key_exists('slideshow_id',$data)) {
			$this->db->where("slideshow_id",$data['slideshow_id']);
			$this->db->update('tbl_slideshows', $data);
		} else {
			$this->db->insert('tbl_slideshows', $data); 
		}
		return;
	}


}

