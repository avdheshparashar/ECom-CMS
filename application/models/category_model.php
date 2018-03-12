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


// class category_model extends REST_Controller {
class category_model extends CI_Model {

//category list by category id or get all category list with number of products in perticular category
//for app
	
	function getlist($id = null) {
		if($id!=null) {
			$query = $this->db->query("SELECT c1.category_id as category_id,c2.category_id as parent_id,c1.name category_name,c2.name as parent_name,
											  c1.meta_description,c1.description,c1.meta_keywords,c1.page_title,c1.slug
											  count(p.product_id) AS no_of_products,c1.image_name,DATE_FORMAT(c1.created,'%d %b %Y') as created
									   FROM tbl_categories c1 
									   LEFT JOIN tbl_categories c2 ON c1.parent_id = c2.category_id 
									   LEFT JOIN tbl_products p ON c1.category_id = p.category_id 
									   WHERE c1.category_id = ".$id);
		} else {
			$query = $this->db->query("SELECT c1.category_id as category_id,c2.category_id as parent_id,c1.name category_name,c2.name as parent_name,
											  count(p.product_id) AS no_of_products,c1.image_name,DATE_FORMAT(c1.created,'%d %b %Y') as created,c1.slug
									   FROM tbl_categories c1 
									   LEFT JOIN tbl_categories c2 ON c1.parent_id = c2.category_id 
									   LEFT JOIN tbl_products p ON c1.category_id = p.category_id 
									   GROUP BY c1.category_id");	
		}	
		$records = $this->buildTree($query->result_array());
		return $records;
	}
	
// get list for web

	function getlistweb($data) {
		if(array_key_exists('category_id',$data)) {
			$query = $this->db->query("SELECT c1.category_id as category_id,c2.category_id as parent_id,c1.name category_name,c2.name as parent_name,
											  c1.page_title,c1.page_title,c1.meta_description,c1.meta_keywords,c1.description,c1.lft,c1.ryt,
											  c1.image_name,c1.banner_image,DATE_FORMAT(c1.created,'%d %b %Y') as created,c1.slug
									   FROM tbl_categories c1 
									   LEFT JOIN tbl_categories c2 ON c1.parent_id = c2.category_id 
									   WHERE c1.category_id = ".$data['category_id']." 
									   ORDER BY category_id DESC");
		} else {
			$query = $this->db->query("SELECT c1.category_id as category_id,c2.category_id as parent_id,c1.name category_name,c2.name as parent_name,
											  c1.page_title,c1.page_title,c1.meta_description,c1.meta_keywords,c1.description,c1.lft,c1.ryt,
											  c1.image_name,c1.banner_image,DATE_FORMAT(c1.created,'%d %b %Y') as created,c1.slug
									   FROM tbl_categories c1 
									   LEFT JOIN tbl_categories c2 ON c1.parent_id = c2.category_id 
									   ORDER BY category_id DESC");	
		}	
		return $query->result_array();
	}

	// function getbrand() {
	// 	$query = $this->db->query("SELECT category_id,name as category_name
	// 							   FROM tbl_categories WHERE parent_id in (
	// 							   			SELECT category_id FROM tbl_categories WHERE parent_id=0)");
	// 	return $query->result_array();	
	// }

	function getbrand() {
		$query = $this->db->query("SELECT brand_id,name as brand_name
								   FROM tbl_brands");
		return $query->result_array();		
	}

	function getcategory() {
		$query = $this->db->query("SELECT c1.category_id as category_id,c2.category_id as parent_id,c1.name category_name,c2.name as parent_name,
											  c1.page_title,c1.page_title,c1.meta_description,c1.meta_keywords,c1.description,
											  count(p.product_id) AS no_of_products,c1.image_name,DATE_FORMAT(c1.created,'%d %b %Y') as created
									   FROM tbl_categories c1 
									   LEFT JOIN tbl_categories c2 ON c1.parent_id = c2.category_id 
									   LEFT JOIN tbl_products p ON c1.category_id = p.category_id 
									   GROUP BY c1.category_id");
		return $query->result_array();	
	}

	function buildTree($categories, $parentId = null) {
	    $branch = array();
	    // print_r($parentId);
	    // echo "<br/>";
	    foreach ($categories as $category) {
	    	// echo $category['parent_id']. " : " .$parentId;
	    	// echo "<br/>";
	        if ($category['parent_id'] == $parentId) {
	            $children = $this->buildTree($categories, $category['category_id']);
	            if ($children) {
	                $category['children'] = $children;
	            }
	            $branch[$category['category_id']] = $category;
	            unset($categories[$category['category_id']]);
	        }
	    }
	    return $branch;
	}

	function getrootcategory($parentid) {
        $categories = $this->db->query("SELECT category_id,name,slug,description,image_name FROM tbl_categories WHERE parent_id = ".$parentid." AND status =1");
        return $categories->result_array();		
	}

    function  getcategoryid($slug) {
        $categoryid = $this->db->query("SELECT category_id FROM tbl_categories WHERE slug = '".$slug."'");
        return $categoryid->result_array()[0]['category_id'];
    }

    function checkroot($slug) {
    	$parentid = $this->db->query("SELECT parent_id,category_id,banner_image FROM tbl_categories WHERE slug = '".$slug."'");
        return $parentid->result_array()[0];	
    }

	// get products list by category id 

	function getproducts($category) {
//		$count = $this->db->query("SELECT COUNT(product_id) as num
//								   FROM tbl_products
//								   WHERE category_id = ".$category['category_id']);
//
//		$no_of_products = $count->result_array()[0];

        $categoryid = $this->getcategoryid($category['slug']);

        $query = $this->db->query("SELECT p.product_id,p.name product_name,p.main_image,p.reference_number,p.slug,p.is_featured,
								         p.price,p.discount_price,p.stamp
                                   FROM tbl_products p
                                   WHERE p.status = 1 AND p.product_id IN (
                                            SELECT product_id
                                            FROM  tbl_product_categories
                                            WHERE  category_id =".(int) $categoryid.")
                                   ORDER  BY p.product_id DESC");
		//$products['count'] = $no_of_products['num'];
		$products['list'] = $query->result_array();
        $products['category_id'] = (int) $categoryid;
        return $products;
	}


	function filter_products($productids) {
		
        $query = $this->db->query("SELECT p.product_id,p.name product_name,p.main_image,p.reference_number,p.slug,p.is_featured,
								         p.price,p.discount_price,p.stamp
                                   FROM tbl_products p
                                   WHERE p.status = 1 AND p.product_id IN (".$productids.") AND status = 1
                                   ORDER  BY p.product_id DESC");
        $products['list'] = $query->result_array();
        return $products;
	}

	function relatedproducts($category) {
		$query = $this->db->query("SELECT p.product_id,p.name product_name,p.main_image,p.reference_number,p.slug,
								          min(pr.original_price) AS original_price,pr.discount_price,b.name brand_name,
								          c.name as category_name
								   FROM tbl_products p 
								   LEFT JOIN tbl_product_prices AS pr ON p.product_id = pr.product_id
								   LEFT JOIN tbl_brands AS b ON p.brand_id = b.brand_id
								   LEFT JOIN tbl_categories AS c ON p.category_id = c.category_id  
								   WHERE p.status =1 AND p.category_id = ".$category['category_id']. "
								   GROUP BY p.product_id
								   ORDER BY p.product_id DESC
								   LIMIT " .$category['limit']);
		return $query->result_array();
	}	

	function create($category) {
		if($category['parent_id'] == 'null')  {
			$query = $this->db->query("SELECT max(ryt) as max_value FROM tbl_categories");
			$max = $query->result_array();
			if(empty($max[0]['max_value'])) {
				$category['parent_id'] = 0;
				$category['lft'] = 1;
				$category['ryt'] = 2;
			} else {
				$category['parent_id'] = 0;
				$category['lft'] = $max[0]['max_value'] + 1;
				$category['ryt'] = $max[0]['max_value'] + 2;
			}
			$this->db->insert('tbl_categories',$category); 
		} else {
			$query = $this->db->query("SELECT max(lft) as max_value FROM tbl_categories WHERE category_id = ".(int) $category['parent_id']);
			$max = $query->result_array();
			$category['lft'] = $max[0]['max_value'] + 1;
			$category['ryt'] = $max[0]['max_value'] + 2;
			unset($category['page_title']);
			$this->db->query("UPDATE tbl_categories SET lft = lft + 2 WHERE lft > ".$max[0]['max_value']);
			$this->db->query("UPDATE tbl_categories SET ryt = ryt + 2 WHERE ryt  > ".$max[0]['max_value']);
			$this->db->insert('tbl_categories',$category); 
		}
		return;
	}

//	function treelist() {
//		$query = $this->db->query("SELECT CONCAT(REPEAT(' ',COUNT(c2.name) - 1),c1.name) AS name
//			 					   FROM tbl_tests AS c1, tbl_tests c2
//			 					   WHERE c1.lft BETWEEN c2.lft AND c2.ryt
//			 					   GROUP BY c1.name
//			 					   ORDER BY c1.lft");
//		return $query->result_array();
//	}

    function  treelist($lft,$ryt) {
        $query = $this->db->query("SELECT category_id,name,slug FROM tbl_categories WHERE lft BETWEEN ".$lft." AND ".$ryt);
        return $query->result_array();
    }

    function  getbreadcrumps($parentid) {
        $i=-1;
        while($parentid!=0) {
            $query = $this->db->query("SELECT category_id,name,slug,parent_id FROM tbl_categories WHERE category_id=".$parentid);
            $results = $query->result_array();
            $categories[++$i] =$results[0];
            $parentid = $results[0]['parent_id'];
        }
        return array_reverse($categories);
    }

	function deactivate($categoryid) {
		$query = $this->db->query("SELECT id,lft,ryt FROM tbl_teststatus WHERE id = ".$categoryid);
		$category = $query->result_array();
		$num_minus = ($category[0]['ryt'] - $category[0]['lft']) + 1;
		
		
		$this->db->query("UPDATE tbl_teststatus 
				          SET lft = 0,ryt = 0,parent_id = 0
				          WHERE lft BETWEEN " .$category[0]['lft']. " AND ".$category[0]['ryt']." 
				          OR ryt BETWEEN ".$category[0]['lft']." AND ".$category[0]['ryt']);

		$this->db->query("UPDATE tbl_teststatus 
						  SET lft = lft - ".$num_minus. "   
						  WHERE lft > ".$category[0]['ryt']);
		$this->db->query("UPDATE tbl_teststatus 
						  SET ryt = ryt - ".$num_minus. "  
						  WHERE ryt > ".$category[0]['ryt']);
	}

	function activate($data) {
		if($data['parent_id'] == 'null')  {
			$query = $this->db->query("SELECT max(ryt) as max_value FROM tbl_teststatus");
			$max = $query->result_array();
			$category['id'] = $data['category_id'];
			$category['parent_id'] = 0;
			$category['lft'] = $max[0]['max_value'] + 1;
			$category['ryt'] = $max[0]['max_value'] + 2;
			$this->db->where('id', $data['category_id']);
			$this->db->update('tbl_teststatus',$category); 
		} else {
			$query = $this->db->query("SELECT max(lft) as max_value FROM tbl_teststatus WHERE id = ".$data['parent_id']);
			$max = $query->result_array();
			$category['id'] = $data['category_id'];
			$category['parent_id'] = $data['parent_id'];
			$category['lft'] = $max[0]['max_value'] + 1;
			$category['ryt'] = $max[0]['max_value'] + 2;
			$this->db->query("UPDATE tbl_teststatus SET lft = lft + 2 WHERE lft > ".$max[0]['max_value']);
			$this->db->query("UPDATE tbl_teststatus SET ryt = ryt + 2 WHERE ryt  > ".$max[0]['max_value']);
			$this->db->where('id', $data['category_id']);
			$this->db->update('tbl_teststatus',$category); 
		}
		return;		
	}

	function remove($categoryid) {
		$query = $this->db->query("SELECT category_id,lft,ryt FROM tbl_categories WHERE category_id = ".$categoryid);
		$category = $query->result_array();
		$num_minus = ($category[0]['ryt'] - $category[0]['lft']) + 1;

		$this->db->query("DELETE FROM tbl_categories WHERE lft BETWEEN ".$category[0]['lft']." AND ".$category[0]['ryt']);

		$this->db->query("UPDATE tbl_categories
						  SET lft = lft - ".$num_minus. "   
						  WHERE lft > ".$category[0]['ryt']);
		$this->db->query("UPDATE tbl_categories
						  SET ryt = ryt - ".$num_minus. "  
						  WHERE ryt > ".$category[0]['ryt']);
        $this->db->query("DELETE FROM tbl_product_categories WHERE category_id = ".$categoryid);
        $this->db->query("DELETE FROM tbl_discount_categories WHERE category_id = ".$categoryid);
        return;
	}

	function update($data) {
		if($data['parent_id'] == 'null' || $data['parent_id']==0) {
			$query = $this->db->query("SELECT category_id,lft,ryt,parent_id FROM tbl_categories WHERE category_id = ".$data['category_id']);
			$lft_ryt = $query->result_array();
			if($lft_ryt[0]['parent_id']!=$data['parent_id']) {
				$num_minus = ($lft_ryt[0]['ryt'] - $lft_ryt[0]['lft']) + 1;

				$query = $this->db->query("SELECT * FROM tbl_categories WHERE lft BETWEEN ".$lft_ryt[0]['lft']." AND ".$lft_ryt[0]['ryt']);
				$category = $query->result_array();
			
				$this->db->query("UPDATE tbl_categories 
								  SET lft = lft - ".$num_minus. "   
								  WHERE lft > ".$lft_ryt[0]['ryt']);
				$this->db->query("UPDATE tbl_categories 
								  SET ryt = ryt - ".$num_minus. "  
								  WHERE ryt > ".$lft_ryt[0]['ryt']);

				$query = $this->db->query("SELECT max(ryt) as max_value FROM tbl_categories");
				$max = $query->result_array();
				$max = $max[0]['max_value'];

				for($i = $lft_ryt[0]['lft'];$i < $lft_ryt[0]['ryt']+1;$i++) {
					foreach ($category as $key => $value) {
						if($value['lft'] == $i) {
							$category[$key]['lft'] = ++$max;
						} else if($value['ryt'] == $i) {
							$category[$key]['ryt'] = ++$max;
						}
					}
				}
			}
			$category[0]['description'] = $data['description'];
			$category[0]['category_id'] = $data['category_id'];
			$category[0]['name'] = $data['name'];
			$category[0]['page_title'] = $data['page_title'];
			$category[0]['meta_keywords'] = $data['meta_keywords'];
			$category[0]['meta_description'] = $data['meta_description'];
			if(array_key_exists('image_name',$data)) {
				$category[0]['image_name'] = $data['image_name'];
			}
			if(array_key_exists('banner_image',$data)) {
				$category[0]['banner_image'] = $data['banner_image'];
			}
			$category[0]['parent_id'] = 0;
			$this->db->update_batch('tbl_categories',$category,'category_id'); 
		} else {
			$query = $this->db->query("SELECT category_id,lft,ryt,parent_id FROM tbl_categories WHERE category_id = ".$data['category_id']);
			$lft_ryt = $query->result_array();
			if($lft_ryt[0]['parent_id']!=$data['parent_id']) {
				$num_minus = ($lft_ryt[0]['ryt'] - $lft_ryt[0]['lft']) + 1;
				$query = $this->db->query("SELECT * FROM tbl_categories WHERE lft BETWEEN ".$lft_ryt[0]['lft']." AND ".$lft_ryt[0]['ryt']);
				$category = $query->result_array();

				$this->db->query("UPDATE tbl_categories 
								  SET lft = lft - ".$num_minus. "   
								  WHERE lft > ".$lft_ryt[0]['ryt']);
				$this->db->query("UPDATE tbl_categories 
								  SET ryt = ryt - ".$num_minus. "  
								  WHERE ryt > ".$lft_ryt[0]['ryt']);

				$query = $this->db->query("SELECT category_id,lft,ryt FROM tbl_categories WHERE category_id = ".$data['parent_id']);
				$parent = $query->result_array();

				$parent_lft = $parent[0];
			
				$newcategory = array();

				for($i = $lft_ryt[0]['lft'];$i < $lft_ryt[0]['ryt']+1;$i++) {
					foreach ($category as $key => $value) {
						if($value['lft'] == $i) {
							$newcategory[$key]['category_id'] = $value['category_id'];
							$newcategory[$key]['lft'] = ++$parent_lft['lft'];
						} else if($value['ryt'] == $i) {
							$newcategory[$key]['category_id'] = $value['category_id'];
							$newcategory[$key]['ryt'] = ++$parent_lft['lft'];
						}
					}
				}
				
				$this->db->query("UPDATE tbl_categories 
								  SET lft = lft + ".$num_minus. "   
								  WHERE lft > ".$parent[0]['ryt']);
				$this->db->query("UPDATE tbl_categories 
								  SET ryt = ryt + ".$num_minus. "  
								  WHERE ryt > ".$parent[0]['ryt']);
			}
			$newcategory[0]['description'] = $data['description'];
			$newcategory[0]['name'] = $data['name'];
			$newcategory[0]['category_id'] = $data['category_id'];
			$newcategory[0]['page_title'] = $data['page_title'];
			$newcategory[0]['meta_keywords'] = $data['meta_keywords'];
			$newcategory[0]['meta_description'] = $data['meta_description'];
			$newcategory[0]['parent_id'] = $data['parent_id'];
			if(array_key_exists('image_name',$data)) {
				$newcategory[0]['image_name'] = $data['image_name'];
			}
			if(array_key_exists('banner_image',$data)) {
				$newcategory[0]['banner_image'] = $data['banner_image'];
			}
			$parent[0]['ryt'] = ++$parent_lft['lft'];

			$this->db->where('category_id', $parent[0]['category_id']);
			$this->db->update('tbl_categories',$parent[0]);
			$this->db->update_batch('tbl_categories',$newcategory,'category_id'); 
		}
		return;
	}


	function fetch_categories(){

		//$query = $this->db->query("SELECT category_id, name FROM tbl_categories");
		$query = $this->db->query("SELECT CONCAT( REPEAT('---', COUNT(parent.name) - 1), node.name) AS name,node.category_id FROM tbl_categories 
								   AS node,tbl_categories AS parent WHERE node.lft BETWEEN parent.lft AND parent.ryt 
								   GROUP BY node.name ORDER BY node.lft;");
		$result = $query->result('array');
		if( empty($result) ){
			return false;
		}else{
			return $result;
		}
	}


	function categorycount() {
		$query = $this->db->query("SELECT COUNT(category_id) AS num  FROM tbl_categories");
		$count = $query->result_array()[0]['num'];
//		if(is_float($count/10)) {
//			$count = (int) ($count/10) + 1;
//		} else {
//			$count = (int) $count / 10;
//		}
		return $count;
	}

    function brandcount(){

        $query = $this->db->query("SELECT count(category_id) AS num FROM tbl_categories
											WHERE parent_id IN
															(SELECT category_id FROM tbl_categories WHERE parent_id=0);");

        $count = $query->result_array()[0]['num'];
        return $count;
    }
	function fetch_brands(){

		$query = $this->db->query("SELECT brand_id,name,slug FROM tbl_brands");

		$result = $query->result('array');
		return $result;
	}

	function get_filter_content($categoryid) {
		$query = $this->db->query(" SELECT group_concat(distinct pf.details) AS details,pf.field_id,f.name,pf.is_price
				                    FROM tbl_product_filters pf 
				                    LEFT JOIN tbl_fields f ON f.field_id=pf.field_id  
				                    WHERE pf.field_id!=20 AND product_id IN (
				                   		SELECT product_id 
				                   		FROM tbl_product_categories 
				                   		WHERE category_id=".$categoryid. "
				                   	) 
									GROUP BY field_id");
		// var_dump($query->result_array());
		// die();	
		return $query->result_array();
	}

	function get_productids($categoryid) {
		$productids = $this->db->query("SELECT product_id FROM tbl_product_categories WHERE status = 1 AND category_id =".$categoryid);
        return $productids->result_array();
	}

	function get_filter_products($filter,$productid) {
		$i = -1;
		$filterdata = array();
		foreach($filter as $key=>$value) {
			$filterdata[++$i] = $value;
		}
		$filter = $filterdata;
		$k = count($filter);
		for($i =0; $i<$k; $i++) {
			if($filter[$i]!='') {
	            $data = $this->db->query("SELECT product_id FROM tbl_product_filters AS Filter WHERE details = '".$filter[$i]."' AND product_id IN (".$productid.")");
	            $data = $data->result_array();
	            $productid = array();
	            foreach ($data as $key => $value) {
	                array_push($productid,$value['product_id']);
	            }
	            $productid = implode(",",$productid);
	            if($productid=='') {
	                break;
	            }
        	}
        }
        return $productid;
	}

	function price_filter_products($productid,$price) {
		$data = $this->db->query("SELECT product_id FROM tbl_product_filters WHERE (details BETWEEN ".(int) $price['min']." AND ".(int) $price['max'].") AND product_id IN (".$productid.") AND is_price = 1");
        $data = $data->result_array();
        $productid = array();
        foreach ($data as $key => $value) {
            array_push($productid,$value['product_id']);
        }

        $productid = implode(",",$productid);
        return $productid;
	}

	function check_second_level($categoryids) {
		$categoryids = implode(",",$categoryids);
		$query = $this->db->query("SELECT name FROM tbl_categories WHERE parent_id IN (SELECT category_id FROM tbl_categories WHERE parent_id = 0) AND category_id IN (".$categoryids.")");
		$query = $query->result_array();
		$categories = array();
		foreach($query as $key=>$value) {
			$categories[$key] = $value['name'];
		}
		return $categories;
	}
}



