<?php
class Permission_Model extends CI_Model
{
	/*
    public $_table = 'tbl_permissions';
    public $primary_key = 'permission_id';
    */
    
    public function getPermission($role_id, $controller, $method)
    {
        $query   = "SELECT * FROM `tbl_permissions` as p, tbl_controller_methods as c, tbl_roles as r
                WHERE 
                c.controller = '" . $controller . "' AND c.method = '" . $method . "'
                AND p.controller_method_id = c.controller_method_id
                AND r.role_id = p.role_id
                AND r.role_id = " . $role_id . " LIMIT 1";
        $resData = $this->db->query($query)->result();
        if (!empty($resData))
            return $resData[0]->permission;
        else
            return 0;
        
        /*$query = "SELECT * FROM `permission_matrix` as p ,cm_list as c, role_table as r
        WHERE p.cm_id = c.cm_id
        AND r.role_id = p.role_id
        AND r.role_id = 2"; */
    }
    

	function get_permission_by_roleid($role_id){
        /*
		$query = $this->db->query("SELECT p.permission_id, p.role_id, p.permission, 
											cm.controller, cm.method 
										FROM tbl_permissions AS p
										LEFT JOIN tbl_controller_methods AS cm
											ON cm.controller_method_id = p.controller_method_id 
									WHERE p.role_id=". $role_id);
        $result = $query->result('array');
		return $result;
        */

        $query = $this->db->query("SELECT * FROM tbl_permissions WHERE role_id=".$role_id);
        $result = $query->result();
        return $result;


	}

	function get_active_controller_method(){

        $query = $this->db->query("
								SELECT * FROM tbl_controller_methods AS cm
									LEFT JOIN tbl_permissions AS p 
										ON p.controller_method_id = cm.controller_method_id 
								WHERE is_deleted = 0;
			");

        $result = $query->result();
        return $result;

	}



    public function autoSet()
    {
        $query   = "SELECT (MAX(permission_id) + 1) as permission_id FROM tbl_permissions";
        $resData = $this->db->query($query)->result();

        if(is_null($resData[0]->permission_id)){
            return false;
        }else{

            $query   = "ALTER TABLE tbl_permissions AUTO_INCREMENT =" . $resData[0]->permission_id;
            $resData = $this->db->query($query);
            return $resData;
        }
    }
    
    /*public function getPermissionData($rode_id) {
    $query = "SELECT p.id,cm.controller,cm.method,p.permission FROM permission_matrix as p, cm_list as cm, role_table as r
    WHERE cm.cm_id = p.cm_id AND r.role_id = p.role_id AND p.role_id = ".$rode_id;
    
    $totalCol = $this->input->post('iColumns');
    $search = $this->input->post('sSearch');
    $col = $this->input->post('columns');
    if (!empty($col)) {
    $columns = explode(',', $this->input->post('columns'));
    } else {
    $columns = '';
    }
    $start = $this->input->post('iDisplayStart');
    $page_length = $this->input->post('iDisplayLength');
    
    /* if ($search != "") {
    $query .= " AND (cm.controller like '%$search%' OR cm.method like '%$search%'";
    }*/
    /*
    //$totalRecords = $this->db->count_all_results($this->_table);
    $totalRecords = count($this->db->query($query)->result());
    if (count($columns) > 1) {
    for ($i = 0; $i < $this->input->post('iSortingCols'); $i++) {
    $sortcol = $this->input->post('iSortCol_' . $i);
    if ($this->input->post('bSortable_' . $sortcol)) {
    $query .= " ORDER BY $columns[$sortcol] " . $this->input->post('sSortDir_' . $i);
    }
    }
    }
    $this->db->limit($page_length, $start);
    
    $query .= " LIMIT $start,$page_length";
    
    $result = $this->db->query($query);
    $data = $result->result();
    
    echo json_encode(array(
    "aaData" => $data,
    "iTotalDisplayRecords" => $totalRecords, //count($course),
    "iTotalRecords" => $totalRecords,
    "sColumns" => $this->input->post('sColumns'),
    "sEcho" => $this->input->post('sEcho')
    ));
    }*/


    public function insert( $data ){
        $this->db->insert('tbl_permissions', $data);
        return;
    }
    
    public function update( $permission_id, $data ){
        $this->db->where('permission_id', $permission_id);
        $this->db->update('tbl_permissions', $data);
        return;
    }

}
