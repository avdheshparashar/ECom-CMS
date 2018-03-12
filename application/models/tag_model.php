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


class tag_model extends REST_Controller {

	function getlist() {
		$query = $this->db->get('tbl_product_tags');
		return $query->result_array();
	}


}

