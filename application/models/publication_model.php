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


class publication_model extends CI_Model {

	function getlist($data) {
		if (array_key_exists('publication_id',$data)) {
			$query = $this->db->query("SELECT p.publication_id,p.publish_date,p.publication_name,p.main_image,GROUP_CONCAT(pi.image_name) more_image,p.link,p.created,p.title,p.description 
									   FROM tbl_publications p 
									   LEFT JOIN tbl_publicationiamges pi ON p.publication_id=pi.publication_id  
									   WHERE p.publication_id = ".$data['publication_id']." 
									    GROUP BY p.publication_id");
		} else {
			$query = $this->db->query("SELECT publication_id,DATE_FORMAT(publish_date,'%d %b %Y') as publish_date,publication_name,main_image,link,created,title,description
									   FROM tbl_publications
									   ORDER BY publication_id DESC");	
		}
		return $query->result_array();
	}

	function getmoreimages($publicationid) {
		$query = $this->db->query("SELECT * FROM tbl_publicationiamges WHERE publication_id = ".$publicationid);
		return $query->result_array();	
	}

	function addpublication($data) {

		if (array_key_exists('publication_id',$data)) {
			$moreimages = explode(",",$data['more_image']);
			unset($data['more_image']);
			$this->db->where("publication_id",$data['publication_id']);
			$this->db->update('tbl_publications', $data);
			if ($moreimages[0]!='') {
				foreach ($moreimages as $key => $value) {
					$moreimage[$key]['publication_id'] = $data['publication_id'];
					$moreimage[$key]['image_name'] = $value;
				}
				$this->db->insert_batch('tbl_publicationiamges',$moreimage);
			} 			
		} else {
			$moreimages = explode(",",$data['more_image']);
			unset($data['more_image']);
			$this->db->insert('tbl_publications', $data); 
			$publicationid = $this->db->insert_id();
			if ($moreimages[0]!='') {
				foreach ($moreimages as $key => $value) {
					$moreimage[$key]['publication_id'] = $publicationid;
					$moreimage[$key]['image_name'] = $value;
				}
				$this->db->insert_batch('tbl_publicationiamges',$moreimage); 
			}	
		}
		return;
	}

	function cancelall($ids) {
		$publications_ids = implode(",",$ids);
		$this->db->query("DELETE FROM tbl_publications WHERE publication_id IN (".$publications_ids.")");
		return;
	}

	function imagedelete($imageid) {
		$this->db->query("DELETE FROM tbl_publicationiamges WHERE publicationimage_id =".$imageid);
		return;
	}	

	function getlatestnews() {
		$query = $this->db->query("SELECT * FROM tbl_publications ORDER BY publication_id DESC LIMIT 2");
		return $query->result_array();	
	}

	function publicationcount() {
		$query = $this->db->query("SELECT COUNT(publication_id) AS num  FROM tbl_publications");
		$count = $query->result_array()[0]['num'];
		if(is_float($count/10)) {
			$count = (int) ($count/10) + 1;
		} else {
			$count = (int) $count / 10;
		}
		return $count;
	}
} 

?>