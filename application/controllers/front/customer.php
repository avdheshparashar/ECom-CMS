<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends Front_Controller {
       
    public function dashboard() {
        $data['customer'] = $this->session->userdata("customer");
        $this->layout->view_render("front/customer/dashboard",$data);
    }

    public function myaccount() {
        if($this->session->userdata("customer")) {
            $this->layout->view_render('front/customer/dashboard');
        } else {
            $this->layout->view_render('front/customer/myaccount');
        }
    }

    public function edit() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $_POST;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, API_URL."user/edit");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $user);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
            $response = (array) json_decode(curl_exec($ch),true);
            curl_close($ch);
            if($response[0]['status'] == "true") {
                $this->display_success_msg($response[0]['message']);
                redirect("myaccount/edit");
            } else {
                $this->display_error_msg($response[0]['message']);
                redirect("myaccount/edit");
            }
        } else {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, API_URL."user/records?customer_id=".(int)$this->session->userdata("customer")['customer_id']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $response['customer'] = (array) json_decode(curl_exec($ch),true);
            $response['title'] = "BugleCMS - Discounts List";
            curl_close($ch);
            $this->layout->view_render('front/customer/edit', $response);
        }
    }

    public function register() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $_POST;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, API_URL."user/register");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $user);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
            $response = (array) json_decode(curl_exec($ch),true);
            curl_close($ch);
            if($response[0]['status'] == "true") {
                $this->display_success_msg($response[0]['message']);
                redirect("/");
            } else {
                $this->display_error_msg($response[0]['message']);
                redirect("myaccount");
            }
        } else {
            $this->layout->view_render("front/customer/myaccount");
        }
    }

    public function verified() {
        $this->layout->view_render("front/customer/verified");
    }

    public function forget_password() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $_POST;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, API_URL."user/forgetpassword");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $user);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
            $response = (array) json_decode(curl_exec($ch),true);
            curl_close($ch);
            if($response[0]['status'] == "true") {
                $this->display_success_msg($response[0]['message']);
                redirect("/");
            } else {
                $this->display_error_msg($response[0]['message']);
                redirect("forget-password");
            }
        } else {
            $this->layout->view_render("front/customer/forget-password");
        }
    }

    public function resend_activation_link() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $_POST;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, API_URL."user/resendlink");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $user);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
            $response = (array) json_decode(curl_exec($ch),true);
            curl_close($ch);
            if($response[0]['status'] == "true") {
                $this->display_success_msg($response[0]['message']);
                redirect("front/customer/login");
            } else {
                $this->display_error_msg($response[0]['message']);
                redirect("front/customer/resendlink");
            }
        } else {
            $this->layout->view_render("front/customer/resendlink");
        }
    }

    public function change_password() {
        echo "Hello"; 
        die();
    }    

    public function reset() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $_POST;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, API_URL."user/resetpassword");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $user);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
            $response = (array) json_decode(curl_exec($ch),true);
            curl_close($ch);
            if($response[0]['status'] == "true") {
                $this->display_success_msg($response[0]['message']);
                redirect("myaccount");
            } else {
                $this->display_error_msg($response[0]['message']);
                redirect("reset");
            }
        } else {
            $data = $_GET;
            $this->layout->view_render("front/customer/reset",$data);
        }
    }

    public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $_POST;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, API_URL."user/login");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $user);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
            $response = (array) json_decode(curl_exec($ch),true);
            $this->session->set_userdata("customer",$response[0]['data'][0]);
            curl_close($ch);
            if($response[0]['status'] == "true") {
                $this->display_success_msg($response[0]['message']);
                redirect("myaccount/dashboard");
            } else {
                $this->display_error_msg($response[0]['message']);
                redirect("myaccount");
            }
        } else {
            $this->layout->view_render("front/customer/myaccount");
        }
    }

    public function logout() {
        $this->session->unset_userdata('customer');
        $message = "You are successfully logout";
        $this->display_success_msg($message);
        redirect("myaccount");
    }

    public  function address($addressid=null) {
        $this->load->model('user_model');
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->user_model->saveaddress($_POST);
            $message = "Address has been updated";
            $this->display_success_msg($message);
            redirect('myaccount/myaddress');
        } else {
            if($addressid!=null) {
                $data['editaddress'] = $this->user_model->get_address_by_id((int) $this->session->userdata("customer")['customer_id'],(int) $addressid);
                //var_dump($data['editaddress']);
            }
            $data['addresses'] = $this->user_model->getaddress((int) $this->session->userdata("customer")['customer_id']);
            $this->layout->view_render('front/customer/address',$data);
        }
    }

    public function orderhistory() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, API_URL."order/records?order_id=2");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $response['orderdetail'] = (array) json_decode(curl_exec($ch),true);
        $response['title'] = "BugleCMS - Order Details List";
        curl_close($ch);
        $this->layout->view_render('front/customer/orderdetail', $response);
    }

    public function myorder() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, API_URL."order/bycustomer?customer_id=2");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $response['order'] = (array) json_decode(curl_exec($ch),true);
        $response['title'] = "BugleCMS - Discounts List";
        curl_close($ch);
        $this->layout->view_render('front/customer/myorder', $response);
    } 
    
}