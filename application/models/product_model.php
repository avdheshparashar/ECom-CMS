<?php 
/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package     CodeIgniter
 * @subpackage  Rest Server
 * @category    Product Model
 * @author      Avdhesh Parashar
 * @date        4th March 2015
 * @contact     avdhesh@Bugletech.com
*/


// class product_model extends REST_Controller {
class product_model extends CI_Model
{

    function getlist($data)
    {
        $query = $this->db->query("SELECT p.product_id,p.name AS product_name,p.reference_number,p.main_image,p.short_description,

								   		  p.price,DATE_FORMAT(p.created,'%d %b %Y') as created,GROUP_CONCAT(c.name) as category_name,
								   		  p.is_featured
								   FROM tbl_products p
								   LEFT JOIN tbl_product_categories pc ON pc.product_id = p.product_id
								   LEFT JOIN tbl_categories c ON pc.category_id = c.category_id
								   WHERE p.status=1
								   GROUP BY p.product_id
								   ORDER BY product_id DESC");
        return $query->result_array();
    }

    function getdetail($productid)
    {
        $query = $this->db->query("SELECT p.product_id,p.name AS product_name,p.reference_number,p.main_image,p.short_description,
                                          c.name AS category_name,b.name AS brand_name,p.created,avg(pr.rate) AS rating,min(pp.original_price) AS price
                                   FROM tbl_products p 
                                   LEFT JOIN tbl_categories c ON p.category_id=c.category_id 
                                   LEFT JOIN tbl_brands b ON p.brand_id=b.brand_id
                                   LEFT JOIN tbl_product_prices pp ON p.product_id=pp.product_id
                                   LEFT JOIN tbl_product_reviews pr ON p.product_id=pr.product_id
                                   WHERE p.product_id =" . $productid);

        $details = $query->result_array();
        foreach ($details as $key => $value) {
            $query = $this->db->query("SELECT name,email,review,rate,created from tbl_product_reviews WHERE status = 1 AND
                        product_id =" . $productid);
            $details[$key]['reviews'] = $query->result_array();
            $query = $this->db->query("SELECT * from tbl_product_images WHERE product_id =" . $productid);
            $details[0]['images'][0] = $details[0]['main_image'];
            $i = 0;
            foreach ($query->result_array() as $key2 => $value2) {
                $details[0]['images'][++$i] = $value2['image'];
            }
            $query = $this->db->query("SELECT size,color from tbl_product_prices WHERE product_id =" . $productid);
            $i = -1;
            foreach ($query->result_array() as $key1 => $value1) {
                $details[0]['size'][++$i] = $value1['size'];
                $details[0]['color'][$i] = $value1['color'];
            }
        }

        return $details[0];
    }

    function getprice($data)
    {
        $query = $this->db->query("SELECT distinct original_price,stock from tbl_product_prices WHERE product_id =" . $data['product_id'] . " AND
                    size ='" . $data['size'] . "' AND color = '" . $data['color'] . "'");
        return $query->result_array()[0];
    }

    function changestatus($productid)
    {
        $this->db->query("UPDATE tbl_products
                          SET status = CASE WHEN status = 1 THEN 0 ELSE 1 END 
                          WHERE product_id = " . $productid);
        return;
    }

    function makefeatured($productid) {
        $this->db->query("UPDATE tbl_products
                          SET is_featured = CASE WHEN is_featured = 1 THEN 0 ELSE 1 END
                          WHERE product_id = " . $productid);
        return;
    }



    function multidelete($product_ids)
    {
        $this->db->query("UPDATE tbl_products
                          SET status = 0 
                          WHERE product_id IN (" . $product_ids . ")");
        return;
    }


    function remove($productid)
    {
        $query = $this->db->query("SELECT product_id from tbl_orderdetails WHERE product_id= " . $productid);
        $check = $query->result_array();

        if (empty($check)) {
            $this->db->query(" DELETE p,pd,pf,pi,pp,pr,pt
                               FROM tbl_products p 
                               LEFT JOIN tbl_product_details pd ON p.product_id = pd.product_id
                               LEFT JOIN tbl_product_filters pf ON p.product_id = pf.product_id
                               LEFT JOIN tbl_product_images pi ON p.product_id = pi.product_id
                               LEFT JOIN tbl_product_prices pp ON p.product_id = pp.product_id
                               LEFT JOIN tbl_product_reviews pr ON p.product_id = pr.product_id
                               LEFT JOIN tbl_product_tags pt ON p.product_id = pt.product_id 
                               WHERE p.product_id = " . $productid);
            return 1;
        } else {
            return 0;
        }
    }

    function add($product)
    {

        $this->db->insert('tbl_products', $product);
        return $this->db->insert_id();
    }

    function update($product)
    {
        $this->db->where('product_id', $product['product_id']);
        $this->db->update('tbl_products', $product);
        return;
    }

    function addtoinventory($inventory)
    {
        $this->db->insert_batch('tbl_product_prices', $inventory);
        return;
    }


    function savedetail($details)
    {
        $this->db->insert_batch('tbl_product_details', $details);
        return;
    }

    function updatedetail($details)
    {

        $query = $this->db->query("SELECT product_id,details,field_id from tbl_product_details WHERE field_id = " . $details[0]['field_id'] .
            " AND product_id= " . $details[0]['product_id']);
        $details_old = $query->result_array();

        $remove = $this->diff_details($details_old, $details);
        if (!empty($remove)) {
            foreach ($remove as $key => $val) {
                $this->db->query("DELETE FROM tbl_product_details WHERE product_id = " . $val['product_id'] . "
                        AND details = '" . $val['details'] . "'");
            }
        }
        $insert = $this->diff_details($details, $details_old);

        if (!empty($insert)) {
            $this->db->insert_batch('tbl_product_details', $insert);
        }
        return;
    }

    function deletedetail($product_id, $field_id){
 
        $this->db->query("DELETE FROM tbl_product_details WHERE field_id=". $field_id." AND product_id=".$product_id);
        return;
 
    }

    function savetags($tags)
    {
        $this->db->insert_batch('tbl_product_tags', $tags);
        return;
    }

    function updatetags($tags)
    {
        $query = $this->db->query("SELECT product_id,tag from tbl_product_tags WHERE product_id= " . $tags[0]['product_id']);
        $tags_old = $query->result_array();
        $remove = $this->diff_tags($tags_old, $tags);
        if (!empty($remove)) {
            foreach ($remove as $key => $val) {
                $this->db->query("DELETE FROM tbl_product_tags WHERE product_id = " . $val['product_id'] . " AND tag = '" . $val['tag'] . "'");
            }
        }
        $insert = $this->diff_tags($tags, $tags_old);
        if (!empty($insert)) {
            $this->db->insert_batch('tbl_product_tags', $insert);
        }
        return;
    }

    function saveimages($images)
    {
        $this->db->insert_batch('tbl_product_images', $images);
        return;
    }

    function deleteimage($imageid)
    {
        $this->db->query("DELETE FROM tbl_product_images WHERE product_image_id = " . $imageid);
        return;
    }

    function diff_tags($array1, $array2)
    {
        $i = -1;
        $result = $array1;
        foreach ($array1 as $key1 => $val1) {
            foreach ($array2 as $key2 => $val2) {
                if ($val1['tag'] == $val2['tag']) {
                    unset($result[$key1]);
                }
            }
        }
        return $result;
    }

    function diff_details($array1, $array2)
    {
        $i = -1;
        $result = $array1;
        foreach ($array1 as $key1 => $val1) {
            foreach ($array2 as $key2 => $val2) {
                if ($val1['details'] == $val2['details']) {
                    unset($result[$key1]);
                }
            }
        }
        return $result;
    }

    function check_id_exists($id)
    {

        $query = $this->db->query("SELECT product_id from tbl_products WHERE product_id=" . $id . " AND status=1");
        if (empty($query->result_array())) {
            return 0;
        } else {
            return 1;
        }
    }

    function check_inventory_exist($product_id)
    {

        $query = $this->db->query("SELECT is_inventory FROM tbl_products WHERE product_id=" . $product_id . " AND status=1 AND is_inventory=1");
        return count($query->first_row('array')) ? true : false;

    }


    function product_by_id($product_id)
    {
        $query = $this->db->query("SELECT * from tbl_products WHERE product_id=" . $product_id . " AND status=1");
        $result = $query->first_row('array');
        return $result;
    }


    function product_basic_details($product_id)
    {

        $query = $this->db->query("SELECT p.product_id, p.brand_id, p.name, p.description, p.short_description, p.is_inventory, p.page_title, p.price,
                                            p.reference_number, p.main_image, p.meta_description, p.meta_keywords, p.video, p.stamp, p.additional_info, p.specs,
                                            group_concat(DISTINCT t.tag) as tag,group_concat( DISTINCT c.category_id) as category, group_concat(DISTINCT i.image) as other_image 
                                    FROM tbl_products AS p 
                                        LEFT JOIN tbl_product_tags AS t 
                                            ON p.product_id = t.product_id 
                                        LEFT JOIN tbl_product_categories AS c
                                            ON p.product_id = c.product_id  
                                        LEFT JOIN tbl_product_images AS i
                                            ON p.product_id = i.product_id  
                                    WHERE p.status=1 AND p.product_id =" . $product_id . " GROUP BY p.product_id");


        $result = $query->first_row('array');

        return $result;

    }

    function productcount()
    {
        // $query = $this->db->query("SELECT COUNT(product_id) AS num  FROM tbl_products");
        $query = $this->db->query("SELECT COUNT(product_id) AS num  FROM tbl_products WHERE status=1");
        $count = $query->result_array()[0]['num'];
       // if (is_float($count / 10)) {
       //     $count = (int)($count / 10) + 1;
       // } else {
       //     $count = (int)$count / 10;
       // }
        return $count;
    }

    function update_main_image($data, $product_id)
    {
        $this->db->where('product_id', $product_id);
        $this->db->update('tbl_products', $data);
        return;
    }

    function details_by_product_id($product_id)
    {
        $query = $this->db->query("SELECT details FROM tbl_product_details WHERE product_id=" . $product_id);
        $result = $query->result('array');
        $old_details = array();
        foreach ($result as $value) {
            $old_details[] = $value['details'];
        }
        return $old_details;
    }

    function addfilter($data) {
        $this->db->insert_batch('tbl_product_filters', $data);
        return;
    }

    function updatefilter($data) {
        $this->db->query("DELETE FROM tbl_product_filters WHERE is_price =0 AND product_id=".$data['product_id']);
        unset($data['product_id']);
        $this->db->insert_batch('tbl_product_filters', $data);
        return;
    }

    function update_price_filter($data) {
        
        $check = $this->db->query("SELECT details FROM tbl_product_filters WHERE is_price = 1 AND product_id=" . (int)$data[0]['product_id']);
        $result = $query->result('array');
        if (empty($result)) {
            $this->db->insert_batch('tbl_product_filters', $data);
        } else {
            $this->db->query("UPDATE tbl_product_filters SET details = '" .$data[0]['details']. "' WHERE is_price = 1 AND product_id=" .(int)$data[0]['product_id']);
        }
        
        return;
    }

    function get_fields_by_product_id($fields, $product_id)
    {

        $query = $this->db->query("SELECT " . $fields . " FROM tbl_products WHERE product_id=" . $product_id);
        $result = $query->first_row('array');
        return $result;

    }

    function  searchbytag($q)
    {
        $query = $this->db->query("SELECT p.product_id,p.name product_name,p.main_image,p.reference_number,p.slug,p.is_featured,
                                         p.price,p.discount_price,p.stamp
                                   FROM tbl_products p
                                   WHERE p.product_id IN (
                                            SELECT product_id
                                            FROM  tbl_product_tags
                                            WHERE  tag LIKE '%" . $q . "%' )
                                   ORDER  BY p.product_id DESC");

        return $query->result_array();
    }

    function  searchtag($q)
    {
        $query = $this->db->query("SELECT DISTINCT tag FROM tbl_product_tags WHERE  tag LIKE '%" . $q . "%'");
        return $query->result_array();
    }

    function get_view_data_by_product_id($slug)
    {

       $query = $this->db->query("SELECT p.product_id, p.main_image, p.brand_id, p.name, p.description, p.short_description, p.is_inventory, p.price, p.discount_price, 
                                        p.is_purchasable, p.reference_number, p.main_image, p.video, p.stamp, p.additional_info, p.specs, p.slug,
                                        p.page_title,p.meta_keywords,p.meta_description, 
                                            group_concat(DISTINCT t.tag) AS tag,group_concat( DISTINCT c.category_id ) AS category, 
                                            group_concat(DISTINCT i.image) AS other_image, group_concat( DISTINCT pd.details ) AS detail, 
                                            group_concat( DISTINCT pd.product_details_id ) AS product_details_id,
                                            group_concat( DISTINCT pd.field_id ) AS field_id, b.name AS brand 
                                    FROM tbl_products AS p 
                                        LEFT JOIN tbl_product_tags AS t 
                                            ON p.product_id = t.product_id 
                                        LEFT JOIN tbl_product_categories AS c
                                            ON p.product_id = c.product_id  
                                        LEFT JOIN tbl_product_images AS i
                                            ON p.product_id = i.product_id  
                                        LEFT JOIN tbl_product_details AS pd 
                                            ON p.product_id = pd.product_id 
                                        LEFT JOIN tbl_brands AS b 
                                            ON p.brand_id = p.brand_id 
                                    WHERE p.status=1 AND p.slug ='". $slug ."' GROUP BY p.product_id");

        $result = $query->first_row('array');

        if (!empty($result)) {

        $product_id = $result['product_id'];


            if ($result['is_inventory'] == 1) {

                $query = $this->db->query("SELECT product_prices_id, size, color, stock FROM tbl_product_prices WHERE product_id=" . $product_id);

                $result['inventory'] = $query->result('array');


            }

            $query = $this->db->query("SELECT DISTINCT
-- <<<<<<< HEAD
                                    p.product_id, 
                                    p.name, 
                                    p.price, 
                                    p.discount_price, 
                                    p.main_image, 
                                    p.slug 
                                FROM 
                                    tbl_products AS p 
                                LEFT JOIN tbl_product_categories AS pc 
                                    ON pc.category_id IN (" . $result['category'] . ")
                                WHERE 
                                    p.status = 1 
                                    AND p.product_id NOT IN (" . $product_id . ")
                                ORDER BY rand() 
                                LIMIT 4
                            ");

            $result['similar'] = $query->result('array');


            $result['fields'] = array();
            if ($result['field_id'] != "") {

                $query = $this->db->query("SELECT * FROM tbl_fields WHERE field_id IN(" . $result['field_id'] . ")");
                $result['fields'] = $query->result('array');
            }

            $category = array();
 
            $category_id = strripos($result['category'], ',');
 
            if( $category_id == FALSE){
 
                $category_id = $result['category'];
 
            }else{
 
                $category_id = substr($result['category'], $category_id+1, strlen($result['category'])-1 );
            }
 
            do{
                $query = $this->db->query("SELECT category_id, 
                                                    name, 
                                                    parent_id 
                                                FROM tbl_categories 
                                                WHERE category_id=". $category_id);
 
 
                $cat = $query->first_row('array');
 
                $category_id = $cat['parent_id'];
 
                array_push($category, $cat);
 
            }while( $cat['parent_id'] != "0" );
 
            $result['bredcrum'] = $category;


        }
        return $result;
    }
}