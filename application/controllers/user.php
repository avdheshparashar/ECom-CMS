<?php
/*
 *
 * BUGLE TECH LICENSE
 *
 *
 * @controller  API
 * @path		/application/controller/user.php
 * @copyright  	Copyright (c) 2014, Nidhi Barhate 
 * @version    	0.1
 * @created     21-02-2015
 * @modified	
 * @author     	Nidhi Barhate <nidhi@bugletech.com>
 * @description This class is User Management
 */

//require_once(APPPATH.'/libraries/REST_Controller.php');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class User extends Admin_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('role_model');
        $this->load->model('user_model');
    }
    
	public function lists() {
        $roleid ='4';
		$response['users'] = $this->user_model->getlist();
		$this->layout->view_render('admin/user/lists', $response);		
	}

    public function cancel() {
        $this->user_model->changestatus($_POST['checked']);
        $message = "User has been successfully deleted";
        $this->display_success_msg($message);
        redirect("user/lists");
    }
    
    public function index()
    {
        //$data['permission'] = $this->permissionData();
        $roleid = "1,3";
        $data['user'] = $this->user_model->getUserData();
        $data['role'] = $this->role_model->getlist();
        $this->layout->add_js('/assets/admin/custom/js/user.js');
        $this->layout->view_render('admin/user/index', $data);
    }


    public function add()
    {
        $data['permission'] = $this->permissionData();
		$data['role'] = $this->role_model->getlist();
        //$data['role'] = $this->role->get_all();
        if ($this->input->server("REQUEST_METHOD") != "POST") {

            $this->layout->view_render('admin/user/add', $data);
        } else {
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('role_id', 'role_id', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                return $this->layout->view_render('admin/user/add', $data);
                exit;
            } else {


                $this->user_model->insert(array(
                    'email' => $this->input->post('email'),
                    'name' => $this->input->post('name'),
                    'password' => sha1($this->input->post('password')),
                    'role_id' => $this->input->post('role_id'),
                    'created' => date('Y-m-d H:i:s'),
                    'status'=> 1
                ));
                $message = "User added successfully.";
                $this->display_success_msg($message);
                return redirect('user');
                exit;
            }
        }
    }
    
    public function edit($id)
    {
        $data['permission'] = $this->permissionData();
        $data['role']      = $this->role_model->getlist();
        $data['edit_data'] = $this->user_model->find_user_by_id($id);

        // echo "<pre>";
        // var_dump($data['edit_data']);
        // echo "</pre>";
        // die();


        if ($this->input->server("REQUEST_METHOD") != "POST") {
            $this->layout->view_render('admin/user/edit', $data);
        } else {
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('name', 'name', 'required');
            //$this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('role_id', 'role_id', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                return $this->layout->view_render('admin/user/edit', $data);
                exit;
            } else {
                $this->user->update($id, array(
                    'email' => $this->input->post('email'),
                    'name' => $this->input->post('name'),
                    //'password' => md5($this->input->post('password')),
                    'role_id' => $this->input->post('role_id'),
                    'modified' => date('Y-m-d H:i:s')
                ));
                $message = "User updated successfully.";
                $this->display_success_msg($message);
                return redirect('user');
                exit;
            }
        }
    }

    public function save_user(){
        
        if (!$this->input->is_ajax_request() || ($this->input->server("REQUEST_METHOD") != "POST") ) {

            exit('No direct script access allowed');

        }

        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('role_id', 'role_id', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('status'=> 'false', 'message'=> 'Insufficient data supplied'));
            exit;
        }else{
            $this->user_model->insert(array(
                'email' => $this->input->post('email'),
                'name' => $this->input->post('name'),
                'password' => sha1($this->input->post('password')),
                'role_id' => $this->input->post('role_id'),
                'created' => date('Y-m-d H:i:s'),
                'status'=> 1
            ));
            $message = "User added successfully.";
            $this->display_success_msg($message);
            echo json_encode(array('status'=> 'true', 'message'=> 'User added successfully'));
            exit;
        }
        
    }

    public function update_user(){

        if (!$this->input->is_ajax_request() || ($this->input->server("REQUEST_METHOD") != "POST") ) {

            exit('No direct script access allowed');

        }else {
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('name', 'name', 'required');
            //$this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('role_id', 'role_id', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('status'=> 'false', 'message'=> 'Insufficient data supplied'));
                exit;
            } else {
                $this->user_model->update_by_id($this->input->post('user_id'), array(
                    'email' => $this->input->post('email'),
                    'name' => $this->input->post('name'),
                    'password' => sha1($this->input->post('password')),
                    'role_id' => $this->input->post('role_id')
                ));
                $message = "User updated successfully.";
                $this->display_success_msg($message);
                echo json_encode(array('status'=> 'true', 'message'=> 'User details modified successfully'));
                exit;
            }
        }
    }


    public function changestatus(){
        if( $this->input->server("REQUEST_METHOD") != "POST") {
            return redirect('index');
        }


        $checked = $this->input->post('checked');
        $user_ids = '';

        foreach ($checked as $user_id) {
            $user_ids = $user_ids . ', \'' . $user_id  . '\'';
        }

        $user_ids = ltrim($user_ids, ',');

        if($user_ids != ""){
            $this->user_model->change_backenduser_status($user_ids);
        }
        

        return redirect('user');
           
    }



}
