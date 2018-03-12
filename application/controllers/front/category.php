<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Front_Controller {

    function __contruct() {
        parent::__contruct();
    }


    function index($slug) {
        $this->load->model('category_model');
        $ids = $this->category_model->checkroot($slug); 
        if((int) $ids['parent_id'] == 0) {
            $results['rootcategories'] = $this->category_model->getrootcategory((int) $ids['category_id']);             
            $results['breadcrumps'] = $this->category_model->getbreadcrumps((int) $ids['category_id']);
            $category['category_id'] = $ids['category_id'];
            $results['category'] = $this->category_model->getlistweb($category);
            $this->layout->set_title($results['category'][0]['page_title']);
            $this->layout->set_meta_description($results['category'][0]['meta_description']);
            $this->layout->set_meta_keywords($results['category'][0]['meta_keywords']);           
            $results['banner'] = $ids['banner_image'];
            $this->layout->view_render("front/category/main",$results);
        } else {
            $category['slug'] =$slug;
            $results['products'] = $this->category_model->getproducts($category);
            $category['category_id'] = $results['products']['category_id'];
            $results['category'] = $this->category_model->getlistweb($category);
            $this->layout->set_title($results['category'][0]['page_title']);
            $this->layout->set_meta_description($results['category'][0]['meta_description']);
            $this->layout->set_meta_keywords($results['category'][0]['meta_keywords']);
            $results['trees'] = $this->category_model->treelist($results['category'][0]['lft'],$results['category'][0]['ryt']);
            $results['breadcrumps'] = $this->category_model->getbreadcrumps($results['category'][0]['parent_id']);
            $results['filters'] = $this->category_model->get_filter_content($category['category_id']);
            $this->layout->view_render("front/category/index",$results);
        }
    }



    function search() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->load->model('product_model');
            $results['products'] = $this->product_model->searchbytag($_POST['tag']);
            $results['searchtag'] = $_POST['tag'];
            $this->layout->view_render("front/category/search", $results);
        } else {
            $this->load->model('product_model');
            $results = $this->product_model->searchtag($_GET['q']);
            foreach ($results as $result) {
                echo $result['tag'] . "\n";
            }
        }
    }

    function nodata($slug) {
        $this->load->model('category_model');
        $category['slug'] =$slug;
        $results['products'] = $this->category_model->getproducts($category);
        $category['category_id'] = $results['products']['category_id'];
        $results['category'] = $this->category_model->getlistweb($category);
        $results['trees'] = $this->category_model->treelist($results['category'][0]['lft'],$results['category'][0]['ryt']);
        $results['breadcrumps'] = $this->category_model->getbreadcrumps($results['category'][0]['parent_id']);
        $results['filters'] = $this->category_model->get_filter_content($category['category_id']);
        return $results;
    }

    public function filter() {
        $this->load->model('category_model');
        // if(array_key_exists('filter',$_POST) && array_key_exists('price',$_POST)) {
        //     $results = $this->nodata($_POST['slug']);
        //     $this->load->view("front/category/content",$results);
        // }
        foreach($_POST['filter'] as $key=>$value) {
            if(str_word_count($value) == 0) {
                unset($_POST['filter'][$key]);
            }
        }
        $is_price = 0;
        $k = count($filter);
        $productids = $this->category_model->get_productids((int) $_POST['catid']);
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
            $results = array();
            return $this->load->view("front/category/content",$results);
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
            $results = array();
            return $this->load->view("front/category/content",$results);
        } else { 
            $products = $this->category_model->filter_products($productid);
            $results['products'] = $products;
            $this->load->view("front/category/content",$results);
        }
    }
}