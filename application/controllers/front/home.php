<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends Front_Controller {
    
    function index() {
        $this->load->model('home_model');
        $results['data'] = $this->home_model->getalldata();
        $this->load->model('category_model');
        $results['data']['categories'] = $this->category_model->getlist();
        $results['data']['rootcategories'] = $this->category_model->getrootcategory(0);
        $this->load->model('publication_model');
        $results['data']['news'] = $this->publication_model->getlatestnews();
        $this->layout->view_render("front/page/home",$results);
    }

    function subscribeme() {
        $subscribe = $_POST;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, API_URL."subscriber/addme");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $subscribe);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
        $response = (array) json_decode(curl_exec($ch),true);
        if($response[0]['status'] == "true") {
            $this->display_success_msg($response[0]['message']);
        } else {
            $this->display_error_msg($response[0]['message']);
        }
        curl_close($ch);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }


    function featured() {

    }
}