<?php
class controller_method_model extends CI_Model
{
    
	function autoSet()
    {
        $query   = "SELECT (MAX(controller_method_id) + 1) as controller_method_id FROM tbl_controller_methods";
        $resData = $this->db->query($query)->result();
        if(!is_null($resData[0]->controller_method_id)){
          $query   = "ALTER TABLE tbl_controller_methods AUTO_INCREMENT =" . $resData[0]->controller_method_id;
          $resData = $this->db->query($query);  
        } 
        return $resData;
    }

	function get_saved_methods($controller){
		$query = $this->db->query("SELECT * FROM tbl_controller_methods WHERE controller='".$controller."'");
		$result = $query->result('array');
		if( empty( $result ) ){
			return false;
		}else{
			return $result;
		}
	}

	function savedata($data){
		$this->db->query("INSERT INTO tbl_controller_methods 
														(controller, method) VALUES 
														('".$data['controller']."', '".$data['method']."')");
		return;
	}


	function changestatus($controller_method_id){
		$this->db->query("UPDATE tbl_controller_methods SET is_deleted = 
																		CASE 
																			WHEN is_deleted = 0 THEN 1
																			ELSE 0
																		END
														WHERE controller_method_id=".$controller_method_id."");
		return;
	}


	function getlist(){
		return $this->db->query("SELECT controller_method_id AS id, controller, method 
									FROM tbl_controller_methods WHERE is_deleted=0")->result('array');

	}

	function multi_soft_delete($controller_method_ids){
		$this->db->query("UPDATE tbl_controller_methods SET is_deleted = 1 WHERE controller_method_id IN (".$controller_method_ids.")");

		return;
	}

	function delete( $controller_method_id ){

		$this->db->query( "UPDATE tbl_controller_methods SET is_deleted = 1 WHERE controller_method_id=".(int)$controller_method_id );
		return;
	}

	function get_accessible_cm( $forbidden_ctrl ){

		$query = $this->db->query("SELECT * FROM tbl_controller_methods WHERE controller NOT IN (".$forbidden_ctrl. ") AND is_deleted=0");
		$result = $query->result();
		return $result;
	}


}
