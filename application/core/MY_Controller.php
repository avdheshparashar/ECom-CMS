<?php

/*
 *
 * BUGLE TECH LICENSE
 *
 *
 * @core file  MY_Controller
 * @path		/application/core/MY_Controller.php
 * @copyright  	Copyright (c) 2014, Tejas Shah
 * @version    	1.0
 * @created     27-09-2014
 * @modified	
 * @author     	Tejas Shah <tejas@bugletech.com>
 * @description This is the base controller.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->library('layout');   
    }
}

/*
 *
 * BUGLE TECH LICENSE
 *
 *
 * @core file   MY_Controller
 * @class       Admin_Controller
 * @path		/application/core/MY_Controller.php
 * @copyright  	Copyright (c) 2013, Tejas Shah
 * @version    	1.0
 * @created     27-09-2014
 * @modified	
 * @author     	Tejas Shah <tejas@bugletech.com>
 * @Description This class extends to the classes which needs authentication.
  It is extended by MY_Controller. So you can use its methods also.
 */

class Admin_Controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');

        if( !$this->session->userdata('admindata')['role_id']   ){

            redirect("/login");

        }else{

            $delete_methods = array('changestatus', 'delete', 'remove_image');


            if( (int)$this->session->userdata('admindata')['role_id'] != 1 && in_array($this->router->fetch_method(), $delete_methods)){

                $flashdata = array(
                    "class" => "alert-error",
                    "message" => "You don't have enough access rights to perform this action."
                );
                $this->session->set_flashdata("flash_message", $flashdata);
                


                return redirect($_SERVER['HTTP_REFERER']);
                
            }
        }

    }

    public function display_error_msg( $msg ){
        $flashdata = array(
            "class" => "alert-error",
            "message" => $msg
        );

        $this->session->set_flashdata('feedback', $flashdata);
    }

    public function display_success_msg( $msg ){
        $flashdata = array(
            "class" => "alert-success",
            "message" => $msg
        );

        $this->session->set_flashdata('feedback', $flashdata);
    }

    public function securelogin(){
        if(!$this->session->userdata('role_id')) redirect('/login');
    }  

}

class Front_Controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('menu');
        $this->load->model('category_model');
        $this->load->model('brand_model');
        $this->results = $this->category_model->getlist();
        $this->brands = $this->brand_model->getlist();
        $this->layout->switch_layout('layout/Front');
     }

    public function display_error_msg( $msg ){
        $flashdata = array(
            "class" => "failure",
            "message" => $msg
        );

        $this->session->set_flashdata('feedback', $flashdata);
    }

    public function display_success_msg( $msg ){
        $flashdata = array(
            "class" => "success",
            "message" => $msg
        );
        $this->session->set_flashdata('feedback', $flashdata);
    }
}