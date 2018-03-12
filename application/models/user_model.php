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


//require_once(APPPATH.'/libraries/REST_Controller.php');

class user_model extends CI_Model {

	function getlist($id = null) {
		// if($id!=null) {
		// 	$query = $this->db->query("SELECT * FROM tbl_customers
		// 							   WHERE customer_id =  ".$id);
		// } else {
			$query = $this->db->query("SELECT c.customer_id,c.user_id,c.fname,c.lname,c.email,c.status,c.created,c.mobilenumber
				                       FROM tbl_users AS u 
				                       LEFT JOIN tbl_customers AS c
								   	   ON u.user_id = c.user_id
								   	   WHERE u.status=1 AND u.role_id = 4");
		//}
		return $query->result_array();
	}

	function login($userdata) {
        $query = $this->db->query("SELECT c.customer_id,c.user_id,c.fname,c.lname,c.email,c.status,c.created,c.mobilenumber
								   FROM tbl_users AS u
								   LEFT JOIN tbl_customers AS c
								   ON u.user_id = c.user_id 	
								   WHERE u.status = 1 AND u.email = '".$userdata['email']. "' AND u.password = '".$userdata['password']."'");
		return $query->result_array();	
	}

	function edit($data) {
		$this->db->where("customer_id",$data['customer_id']);
		$this->db->update('tbl_customers', $data);
		$query = $this->db->query("SELECT c.customer_id,c.user_id,c.fname,c.lname,c.email,c.status,c.created,c.mobilenumber
								   FROM tbl_users AS u
								   INNER JOIN tbl_customers AS c
								   ON u.user_id = c.user_id 	
								   WHERE c.customer_id = ".$data['customer_id']);
		return $query->result_array();	
	}


	function checkpassword($oldpassword) {
		$query = $this->db->query("SELECT *
								   FROM tbl_users AS u
								   WHERE u.password = '".$oldpassword['oldpassword']."' AND u.user_id = ( 
								   		SELECT user_id FROM tbl_customers WHERE customer_id = ".(int)$oldpassword['customer_id'].")");
		return $query->result_array();	
	}

	function changepassword($password) {

		$this->db->query("UPDATE  tbl_users SET password = '".$password['newpassword']."' WHERE user_id = (
							SELECT user_id FROM tbl_customers WHERE customer_id = ".$password['customer_id'].")");
		$this->db->query("UPDATE  tbl_customers SET password = '".$password['newpassword']."' WHERE customer_id = ".$password['customer_id']);
		return;
	}

	function changestatus($ids) {
		$user_ids = implode(",",$ids);

		$this->db->query("UPDATE tbl_users 
						  SET status = CASE WHEN status = 1 THEN 0 ELSE 1 END 
						  WHERE user_id IN (".$user_ids.")");
		$this->db->query("UPDATE tbl_customers 
						  SET status = CASE WHEN status = 1 THEN 0 ELSE 1 END 
						  WHERE user_id IN (".$user_ids.")");
		return;
	}	

	function register($register) {
		$this->db->insert('tbl_customers', $register);
		return;
	}

	function checkuser($email) {
		$query = $this->db->query("SELECT email FROM tbl_customers WHERE email = '".$email."'");
		return $query->result_array();
	}

	function userverify($email) {
		$query = $this->db->query("SELECT email FROM tbl_customers WHERE verifylink = '0' AND email = '".$email."'");
		return $query->result_array();	
	}

	function verify($verification,$email) {
		$this->db->query("UPDATE  tbl_customers SET status = 1,verifylink = 0 WHERE email = '" .$email. "' and verifylink = '".$verification."'");
		$query = $this->db->query("SELECT *
								   FROM tbl_customers 
								   WHERE email = '".$email."'");
		$customer = $query->result_array();
		$user = array(
				'email' => $customer[0]['email'],
				'password' => $customer[0]['password'],
				'status' => 1,
				'group_id' => 4
			);
		$this->db->insert('tbl_users', $user);
		$userid = $this->db->insert_id();
		$this->db->query("UPDATE tbl_customers SET user_id = ".$userid." WHERE email = '".$email."'"); 
		return;
	}

	function resend($resend) {
		$this->db->where("email",$resend['email']);
		$this->db->update('tbl_customers', $resend);
		return;
	}

	function forgetpassword($forgetpwd) {
		$this->db->where("email",$forgetpwd['email']);
		$this->db->update('tbl_users', $forgetpwd);
		return;
	}

	function resetpassword($resetpwd) {
		$this->db->query("UPDATE  tbl_users SET forgetlink = 0, password = '".$resetpwd['password']."' WHERE email = '".$resetpwd['email']. "' and forgetlink = '" .$resetpwd['forgetlink']."'");
		$this->db->query("UPDATE  tbl_customers SET password = '".$resetpwd['password']."' WHERE email = '".$resetpwd['email']."'");
		return;
	}

	//------------------------- For user accesss level---------------------------------------//

    function getUserData()
    {
        $query   = "SELECT u.user_id,u.email,u.name,r.role_name,r.role_id FROM tbl_roles as r, tbl_users as u WHERE r.role_id = u.role_id AND r.role_id IN(1,3)";
        $resData = $this->db->query($query)->result();
        return $resData;
    }

	public function backend_login($data){
		$query = $this->db->query("SELECT * FROM tbl_users 
											WHERE 
											email='".$data['email']."' 
											AND password='".$data['password']."' 
										AND status=1 
									LIMIT 1");

		$result = $query->first_row('array');

		if( empty( $result ) ){
			return false;
		}else{
			return $result;
		}
	}

	function insert($data){
		$this->db->insert('tbl_users', $data );
		return;
	}

	function change_backenduser_status($user_ids){
		/*
		$this->db->query("UPDATE tbl_users 
						  SET status = 
						  				CASE WHEN status = 1 THEN 0 
					  						ELSE 1 
					  					END 
						  WHERE user_id IN (".$user_ids.")");
		*/

		$this->db->query("DELETE FROM tbl_users WHERE user_id IN (".$user_ids.")");

		return;
	}

	function find_user_by_id( $user_id ){

		$query = $this->db->query("SELECT * FROM tbl_users WHERE user_id=".$user_id);
		$result = $query->result('array');
		return $result;
	}

    function usercount() {
        $query = $this->db->query("SELECT COUNT(user_id) AS num  FROM tbl_users WHERE role_id=4 AND status=1");
        $count = $query->result_array()[0]['num'];
        return $count;
    }

	function update_by_id($user_id, $data){
		$this->db->where('user_id', $user_id);
		$this->db->update('tbl_users', $data);
		return;
	}

    function saveaddress($data) {
        if (array_key_exists('shipping_id',$data)) {
            $this->db->where("shipping_id",$data['shipping_id']);
            $this->db->update('tbl_shippings', $data);
        } else {
            $this->db->insert('tbl_shippings', $data);
        }
        return;
    }

    function getaddress($customerid){
        $query = $this->db->query("SELECT * FROM tbl_shippings WHERE customer_id=".$customerid);
        return $query->result_array();
    }

    function get_address_by_id($custoemrid,$addressid){
        $query = $this->db->query("SELECT * FROM tbl_shippings WHERE shipping_id=".$addressid." AND customer_id=".$custoemrid);
        return $query->result_array();
    }


	

}