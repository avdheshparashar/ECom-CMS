<?php
/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
 */


class home_model extends CI_Model {

    /**
     * @return mixed
     */
    function getalldata() {
        $query = $this->db->query("SELECT p.product_id,p.slug,p.name,p.brand_id,p.price,p.main_image,p.discount_price,c.name as category_name
                                   FROM tbl_products p
                                   LEFT JOIN  tbl_categories c
                                   ON c.category_id = p.brand_id
                                   WHERE p.is_featured = 1 AND p.status =1
                                   ORDER BY p.product_id
                                   LIMIT 6");
        $results['products'] = $query->result_array();
        $query = $this->db->query("SELECT * FROM tbl_slideshows LIMIT 3");
        $results['slideshows'] = $query->result_array();
        return $results;
    }

}