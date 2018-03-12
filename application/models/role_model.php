<?php
class Role_Model extends MY_Model {


	function check_name_exists($role_name){
		$query = $this->db->query("SELECT role_id FROM tbl_roles WHERE role_name='".$role_name."'");
		$result = $query->result('array');
		if( empty( $result ) ){
			return false;
		}else{
			return true;
		}
	}

	function insert($data){
		$this->db->query("INSERT INTO tbl_roles (role_name) VALUES ('".$data['role_name']."')");
		return;
	}

	function getlist(){
		return $this->db->query("SELECT role_id, role_name FROM tbl_roles WHERE role_id IN (1,3)")->result('array');
	}

	function update($data){
		$this->db->query("UPDATE tbl_roles SET role_name='".$data['name']."', modified='".$data['modified']."' WHERE role_id=".$data['id']);
		return;
	}


}
