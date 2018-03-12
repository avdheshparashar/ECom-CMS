<?php 
/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Product Model
 * @author		Avdhesh Parashar
 * @date		4th March 2015
 * @contact		avdhesh@Bugletech.com
*/


class area_model extends REST_Controller {

	function country() {
		$query = $this->db->query("SELECT * from tbl_countries");
		return $query->result_array();
	}

	function state($countryid) {
		$query = $this->db->query("SELECT state_id,state_name from tbl_states WHERE country_id= ".$countryid);
		return $query->result_array();
	}

	function city($stateid) {
		$query = $this->db->query("SELECT city_id,city_name from tbl_cities WHERE state_id= ".$stateid);
		return $query->result_array();
	}


}
