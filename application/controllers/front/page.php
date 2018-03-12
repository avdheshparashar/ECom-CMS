<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Page extends Front_Controller {

    function dashboard() {
        $this->layout->view_render("front/page/dashboard");
    }

    function aboutus() {
        $this->layout->view_render("front/page/aboutus");
    }

 	function policy() {
        $this->layout->view_render("front/page/policy");
    }

 	function contact() {
        $this->layout->view_render("front/page/contact");
    }

    function inquiry() {
        $this->layout->view_render("front/page/inquiry");
    }

    function askexpert() {
        $this->layout->view_render("front/page/askexpert");
    }
    function disclaimer() {
        $this->layout->view_render("front/page/disclaimer");
    }
    function terms_conditions() {
        $this->layout->view_render("front/page/terms_conditions");
    }

    function news() {
        $this->load->model('publication_model');
        $results['news'] = $this->publication_model->getlist();
        $this->layout->view_render("front/page/news",$results);
    }  

     
}