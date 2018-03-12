<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Front_Controller {
    
    function index() {
        echo "Hello"; 
        die();
    }   



    function view($slug){

        
        //$product_id = 1;


// <<<<<<< HEAD
//     	$ch = curl_init();
// 		curl_setopt($ch, CURLOPT_URL, API_URL."product/view?slug=".$slug);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
// 		curl_setopt($ch, CURLOPT_HEADER,0);
// 		$response = (array) json_decode(curl_exec($ch),true);
// =======
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, API_URL."product/view?slug=".$slug);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HEADER,0);
        $response = (array) json_decode(curl_exec($ch),true);
// >>>>>>> 1984ba723fdd35bc063efee62b35a7c62f0ed06c
        curl_close($ch);


        if( empty( $response ) ){
            $flashdata = array(
                "class" => "alert-error",
                "message" => "Something Went Wrong. Please Try After Sometime"
            );
        }elseif( $response[0]['status'] == 'false' ){
            $flashdata = array(
                "class" => "alert-error",
                "message" => "Please Make Sure You Provide All Required Data"
            );
        }else{
            $flashdata = array(
                "class" => "alert-success",
                "message" => "Product Details Successfully Updated"
            );
        }

         /*echo "<pre>";
         print_r( $response );
         echo "</pre>";
         die();
<<<<<<< HEAD
	*/

        $data['product']['similar'] = array();
        $data['product'] = $response[0]['data'];

        $this->layout->set_title($data['product']['page_title']);
        $this->layout->set_meta_description($results['product']['meta_description']);
        $this->layout->set_meta_keywords($results['product']['meta_keywords']);  

        $this->session->set_userdata("product_id",$data['product']['product_id']);
        return $this->layout->view_render('front/product/view', $data);

        if( $data['product']['is_purchasable'] ){

            $this->layout->view_render('front/product/view', $data);

        }else{

            $this->layout->view_render('front/product/inquiry-product', $data);

        }


        

    }
     
}