<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package     BugleCMS
 * @subpackage  Rest Server
 * @category    Controller
 * @author      Viral Thakkar
 * @link        http://104.236.210.247/buglecms/index.php/api/subscriber/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
if(!class_exists('REST_Controller')) {
    require_once(APPPATH.'/libraries/REST_Controller.php');
}

class Offer extends REST_Controller {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model('offer_model'); 
    }

    function records_get()  {
        $count = $this->offer_model->offercount();
        if($this->get('offer_id')) {
            $data['offer_id'] = $this->get('offer_id');
            $records = $this->offer_model->getlist($data);
        } else {
            $records = $this->offer_model->getlist();
        }
        $offers[0] = array('status'=>'true','data'=>$records,'count'=>$count);
        $this->response($offers,200); // 200 being the HTTP response code
    }    

    function create_post() {
        if($this->post('name') && $this->post('discount_type') && $this->post('discount_amount') && $this->post('discount_on')
                    && $this->post('product_ids')) {
            $data = array(
                    'name'=> $this->post('name'),
                    'discount_type'=> $this->post('discount_type'),
                    'discount_amount'=> $this->post('discount_amount'),
                    'discount_on'=> $this->post('discount_on'),
                    'start'=> $this->post('offer_start'),
                    'end'=> $this->post('offer_end')
             );
            $this->offer_model->createoffer($data, $this->post('product_ids'));
            $create[0] = array('status'=>'true','message'=>'Offer has been created ');
        } else {
            $create[0] =  array('status'=>'false','message'=>'Please pass all valid data');
        }
        $this->response($create,200);    
    } 


     function edit_get(){

        $query = $this->db->query("SELECT DISTINCT o.offer_id, o.name, o.discount_type, o.discount_amount, o.discount_on, o.start, o.end, 
                                    group_concat(DISTINCT op.product_id) as product_id
                                        FROM tbl_offers AS o 
                                            LEFT JOIN tbl_product_offers AS op 
                                                ON o.offer_id = op.offer_id 
                                        WHERE o.offer_id=".$this->get('offer_id'));
        $result = $query->result('array');

        if( !empty( $result ) ){

            $query = $this->db->query("SELECT product_id, name FROM tbl_products WHERE product_id IN (". $result[0]['product_id'] .")");
            $result1 = $query->result('array');

            $result['products'] = $result1;

        }

        $response_ary = array('status'=> 'true', 'data'=> $result);

        $this->response(array($response_ary), 200);

    }
 

    function changestatus_post() {
        if($this->post('offerids')) {
            $check = $this->offer_model->changestatus($this->post("offerids"));
            if($check == 0) {
                $newstatus[0] = array('status'=>'false','message'=>'Offer id is not valid');
            } else if($check == 1) {
                $newstatus[0] = array('status'=>'true','message'=>'Offer status has been updated');
            }
        } else {
            $newstatus[0] =  array('status'=>'false','message'=>'Please pass valid data');   
        }
        $this->response($newstatus,200);
    }

    function offerproduct_post(){
        if( $this->post('type') == 'category'){

            $products = $this->offer_model->product_by_category( $this->post('category_id'), $this->post('product'));

            // $this->response( $products );

            foreach( $products as $product ){

                    echo '<option value='. $product['product_id'] .'>'. $product['name'] . '</option>';
                
            }

            return;
            
            //$response[0] = array('status'=> 'true', 'message'=> "Products Found", 'data'=> $products);


        }elseif( $this->post('type') == 'product' ){
            
        
            $products = $this->offer_model->get_product($this->post('product'));

            foreach( $products as $product ){
                echo '<option value='. $product['product_id'] .'>'. $product['name'] . '</option>';
            }
            return;

            //$response[0] = array('status'=> 'true', 'message'=> "Products Found", 'data'=> $products);

        }else{

            $response[0] = array('status'=> 'false', 'message'=> "Provide sufficient data", 'data'=> false);
            
        }
        return $this->response($response, 200);
    }


    function offercategory_post(){

        if( $this->post('type') == 'category' ){
            $categories = $this->offer_model->all_categories();

            $options = '<option> -- Select Category --</option>';

            foreach( $categories as $category ){
                $options = $options . '<option value='. $category['category_id'] .'>'. $category['name'] . '</option>';
                //echo '<option value='. $category['category_id'] .'>'. $category['name'] . '</option>';
            }

            echo '<div id="category-select-div">
                    <div class="control-group">
                        <label class="control-label">Select Category</label>
                        <div class="controls">
                            <select id="select-category" onchange="getCategoryProducts()">
                                '. $options .'
                            </select>
                        </div>
                    </div>
                </div>
                    ';

            return;
        }
        
    }


    function update_post(){
        $query = $this->db->get_where('tbl_product_offers', array('offer_id' => $_POST['offer_id']));
        $results = $query->result_array();  
        
        foreach ($results as $key => $value) {
            $oldproducts[$key] = $value['product_id'];
        }
        $newproducts = $_POST['product_ids'];

        $removediff = array_diff($oldproducts, $newproducts);
        $addiff = array_diff($newproducts, $oldproducts);

        $update = array();

        $i = -1;
        foreach ($addiff as $key => $value) {
            $update[++$i]['product_id'] = $value;
            $update[$i]['discount_price'] = $this->post('discount_amount');
            $offerupdate[$i]['product_id'] = $value;
            $offerupdate[$i]['offer_id'] = $_POST['offer_id'];


        }
        foreach ($removediff as $key => $value) {
            $update[++$i]['product_id'] = $value;
            $update[$i]['discount_price'] = 0;
            $offerremove[$i] = $value;
        }

        $offer=array(
                'name' => $this->post('name'),
                'discount_type' => $this->post('discount_type'),
                'discount_amount' => $this->post('discount_amount'),
                'start'=> $this->post('offer_start'),
                'end'=> $this->post('offer_end'),
                'modified'=> date("Y-m-d h:i:s"),
                'offer_id' => $this->post('offer_id'),
            );

        $data = array(
                'data' => $offer,
                'offer_update' => $update,
                'product_update' => $offerupdate,
                'offer_remove' => $offerremove
            );
        $this->offer_model->editoffer($data);
        $edit[0] = array('status'=>'true','message'=>'Offer has been updated ');
        $this->response($edit, 200);
    }
}
