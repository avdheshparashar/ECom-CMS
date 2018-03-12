<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends Front_Controller {
    
    function add_to_cart() {

        if( (int)$this->input->post('qty') > (int)$this->input->post('max_qty') ){
            // Redirect with slug of product
            //$this->redirect()

        }

        
        $cart_data = $this->session->userdata('products');

        if( !$cart_data ){

            $set_sess_data = array();
            $set_sess_data['products'][0] = $_POST;
            $this->session->set_userdata($set_sess_data);

        }else{

            
            $old_product = false;
            foreach ($cart_data as $key => $data) {

                if( (int)$data['product_id'] == (int)$_POST['product_id'] ){
                    $cart_data[$key] = $_POST;
                    $old_product = true;
                    break;
                }
            }

            if( !$old_product ){

                array_push($cart_data, $_POST);

            }

            $set_sess_data['products'] = $cart_data;
            $this->session->set_userdata($set_sess_data);

        }

        return redirect(base_url().'index.php/front/order/cart');

        

        // $set_dta = $this->session->userdata('products');
    }

    function inquiry(){


        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('mobilenumber', 'Phone', 'required');
            $this->form_validation->set_rules('email', 'e-mail', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');
            $this->form_validation->set_rules('city', 'City', 'required');


            if ($this->form_validation->run() == FALSE) {

                $flashdata = array(
                    "class" => "alert-error",
                    "message" => validation_errors()
                );

                $this->session->set_flashdata('flash_message', $flashdata);
                return redirect(base_url().'index.php/front/product/view/'.$this->post('product_id'));

            }else{

                $data = $_POST;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, API_URL."inquiry/send");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                $response = (array)json_decode( curl_exec($ch), true );

                curl_close($ch);

                if( empty($response) ){

                    $flashdata = array(
                        "class" => "alert-error",
                        "message" => "Could not send your enquiry. Please try after some time"
                    );

                    $this->session->set_flashdata('flash_message', $flashdata);

                }else{
                    if( $response[0]['status'] == 'true' ){
                        $flashdata = array(
                            "class" => "alert-success",
                            "message" => "Product Inquiry Sent Successfully"
                        );
                        $this->session->set_flashdata('flash_message', $flashdata);
                        $this->load->library('email');
                        $config['charset'] = 'utf-8';
                        $config['protocol'] = 'mail';
                        $config['wordwrap'] = FALSE;
                        $config['mailtype'] = 'html';
                        $this->email->initialize($config);
                        $this->email->from('palak@chhavi.in', 'Viral');
                        $this->email->to($data['email']);
                        $this->email->subject('[AS Creation] Thank your for your Inquiry');
                        $msg['message'] = "Thank your for your Inquiry";
                        $msg = $this->load->view('emails/inquiry_customer', $msg, true);
                        $this->email->message($msg);
                        $this->email->send();
                        $this->email->initialize($config);
                        $this->email->from('palak@chhavi.in', 'Viral');
                        $this->email->to("viral@bugletech.com");
                        $this->email->subject('[AS Creation] Thank your for your Inquiry');
                        $msg = $this->load->view('emails/inquiry_admin', $data, true);
                        $this->email->message($msg);
                        $this->email->send();
                    }else{

                        $flashdata = array(
                            "class" => "alert-error",
                            "message" => "Inquiry Could Not Be Sent. Please Try After Some time."
                        );

                        $this->session->set_flashdata('flash_message', $flashdata);
                    }
                }

                header("Location: " . $_SERVER["HTTP_REFERER"]);


            }

        }

    }


    function update_cart() {
        $newqty = $_POST['qty'];
        $products = $this->session->userdata("products");
        foreach($newqty as $key=>$value) {
            $products[$key]['qty'] = $value;
        }
        $this->session->set_userdata("products",$products);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    function remove_from_cart($cartid) {
        $products = $this->session->userdata("products");
        unset($products[$cartid]);
        $this->session->set_userdata("products",$products);
        $this->session->unset_userdata('discount');
        $this->session->unset_userdata('discount_code');
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

      function cart() {
        $results['products'] = $this->session->userdata("products");
        $this->layout->view_render('front/order/cart',$results);
    }

    function address() {
        echo "Hello"; 
        die();
    }

    function checkout() {
        echo "Hello"; 
        die();
    }

    function apply_coupon($code=null) {
        if($_SERVER['REQUEST_METHOD']=='POST') {
            $code = $_POST['code'];
        }
        $this->load->model('discount_model');
        $valid = $this->discount_model->getbycode($code);
        if(empty($valid)) {
            echo "Not Valid";
        } else {
            echo "valid<br/>";
            if($valid[0]['is_expire'] == 1) {
                echo "Will Expire Soon<br/>";
                $currdate = date('Y-m-d');
                $currdate=date('Y-m-d', strtotime($currdate));;
                //echo $paymentDate; // echos today!
                $begin = date('Y-m-d', strtotime($valid[0]['discount_begin']));
                $end = date('Y-m-d', strtotime($valid[0]['discount_ends']));
                if (($currdate > $begin) && ($currdate < $end)) {
                    echo "is between<br/>";
                } else {
                    echo "NO GO!<br/>";
                }
            } else {
                echo "Will not Expire<br/>";
            }
            if((int) $valid[0]['total_used'] == $valid[0]['is_limit'] && $valid[0]['is_limit']!=0) {
                echo "Coupon Usage Expire<br/>";
            }
            $products = $this->session->userdata("products");
            $total_price = 0;
            if($valid[0]['applytoall']==1) {
                echo "Apply To all<br/>";
                foreach($products as $key=>$product){
                    if($product['discount_price']==0) {
                        $total_price = $total_price + $product['price'];
                    }
                }
                $discount_price = $total_price - ($total_price * $valid[0]['discount_amount'])/100;
            } else if($valid[0]['applytoall']==0) {
                $i = -1;
                foreach($products as $key=>$product){
                    if($product['discount_price']==0) {
                        $product_ids[++$i] = $product['product_id'];
                    }
                }
                $i = -1;
                foreach($valid[0]['product_ids'] as $key=>$value) {
                    $check_ids[++$i] = $value['product_id'];
                }
                echo "<pre>";
                $discount_ids = array_intersect($product_ids,$check_ids);
                foreach($discount_ids as $key1=>$value1) {
                    foreach($products as $key2=>$product){
                        if($product['product_id']==$value1) {
                            $total_price = $total_price  + $product['price'];
                        }
                    }
                    unset($key1);
                }
                $discount_price = $total_price - ($total_price * $valid[0]['discount_amount'])/100;
                print_r($discount_ids);
                echo "Apply to Selected<br/>";
            }
            echo $total_price."<br/>";
            echo $discount_price."<br/>";
            $discount = $this->session->userdata("discount");
            $discount = $discount_price;
            $this->session->set_userdata("discount_code",$code);
            $this->session->set_userdata("discount",$discount);
        }
//        var_dump($this->session->userdata("discount"));
//        die();
        redirect('front/order/cart');
    }
  
}










