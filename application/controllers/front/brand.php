<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends Front_Controller {    

    function index($slug) {
        $this->load->model('brand_model');
        $results['details'] = $this->brand_model->getproducts($slug);
        $results['filters'] = $this->brand_model->get_filter_content($slug);
        $this->layout->view_render("front/brand/index",$results);
    }

    function nodata($slug) {
        $this->load->model('brand_model');
        $results['details'] = $this->brand_model->getproducts($slug);
        $results['filters'] = $this->brand_model->get_filter_content($slug);
        return $results;
    }

    public function filter() {
        $this->load->model('category_model');
        // if(array_key_exists('filter',$_POST) && array_key_exists('price',$_POST)) {
        //     $results = $this->nodata($_POST['slug']);
        //     $this->load->view("front/brand/content",$results);
        // }
        foreach($_POST['filter'] as $key=>$value) {
            if(str_word_count($value) == 0) {
                unset($_POST['filter'][$key]);
            }
        }
        $filter = $_POST['filter'];
        $is_price = 0;
        $k = count($filter);
        $this->load->model('brand_model');
        $productids = $this->brand_model->get_productids((int) $_POST['catid']);
        $productid = array();
        foreach ($productids as $key => $value) {
            array_push($productid,$value['product_id']);
        }
        $productid = implode(",",$productid);
        if(array_key_exists('filter',$_POST)) {
            $filter = $_POST['filter'];
            $productid = $this->category_model->get_filter_products($filter,$productid);
        }
        if($productid == "") {
            $results['details']['products'] = array();
            return $this->load->view("front/brand/content",$results);
        } 
        if(array_key_exists('price',$_POST)) {
            foreach ($_POST['price'] as $key => $value) {
                $min[$key] = (int) $value['min'];
                $max[$key] = (int) $value['max'];
            }
            $price = array('min'=>min($min),'max'=>max($max));
            $productid = $this->category_model->price_filter_products($productid,$price);
        }  

        if($productid == "") {
            $results['details']['products'] = array();
            return $this->load->view("front/brand/content",$results);
        } else {
            // var_dump($productid);
            $products = $this->category_model->filter_products($productid);
            // var_dump($products);
            // die();
            $results['details']['products'] = $products['list'];
            $this->load->view("front/brand/content",$results);

        }
    }
} 

?>