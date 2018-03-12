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


class order_model extends CI_Model {

	function byorder($data) {
		if(array_key_exists('order_id',$data)) {
			$query = $this->db->query("SELECT o.order_id AS 'Order_ID',o.sub_total,o.discount,o.giftcard,o.final_total,
											  DATE_FORMAT(o.created,'%d %b %Y') as created,o.status as order_status,
				                              s.fname AS 'ship_fname',s.lname AS 'ship_lname',s.address1 AS 'ship_address1',
				                              		s.address2 AS 'ship_address2',s.city AS 'ship_city',s.state AS 'ship_state',
				                              		s.country AS 'ship_country',s.zipcode AS 'ship_zipcode',
				                              		s.mobilenumber AS 'ship_mobilenumber',
											  b.fname AS 'bill_fname',b.lname AS 'bill_lname',b.address1 AS 'bill_address1',
				                              		b.address2 AS 'bill_address2',b.city AS 'bill_city',b.state AS 'bill_state',
				                              		b.country AS 'bill_country',b.zipcode AS 'bill_zipcode',
				                              		b.mobilenumber AS 'bill_mobilenumber',
				                              CONCAT(c.fname,' ',c.lname) AS customer_name,c.mobilenumber,c.email,c.status
									   FROM tbl_orders o
									   LEFT JOIN tbl_customers AS c ON o.customer_id = c.customer_id
									   LEFT JOIN tbl_shippings AS s ON o.shipping_id = s.shipping_id 
									   LEFT JOIN tbl_billings AS b ON o.billing_id = b.billing_id 
									   WHERE o.order_id=".(int)$data['order_id']. "
									   LIMIT ".$data['limit']. " OFFSET ".$data['skip']);
			return $query->result_array();
		} else {
			$query = $this->db->query("SELECT o.order_id AS 'Order_ID',o.sub_total,o.discount,o.giftcard,o.final_total,
											  DATE_FORMAT(o.created,'%d %b %Y') as created,o.status as order_status,
				                              s.fname AS 'ship_fname',s.lname AS 'ship_lname',s.address1 AS 'ship_address1',
				                              		s.address2 AS 'ship_address2',s.city AS 'ship_city',s.state AS 'ship_state',
				                              		s.country AS 'ship_country',s.zipcode AS 'ship_zipcode',
				                              		s.mobilenumber AS 'ship_mobilenumber',
											  b.fname AS 'bill_fname',b.lname AS 'bill_lname',b.address1 AS 'bill_address1',
				                              		b.address2 AS 'bill_address2',b.city AS 'bill_city',b.state AS 'bill_state',
				                              		b.country AS 'bill_country',b.zipcode AS 'bill_zipcode',
				                              		b.mobilenumber AS 'bill_mobilenumber',
				                              CONCAT(c.fname,' ',c.lname) AS customer_name,c.mobilenumber,c.email,c.status
									   FROM tbl_orders o
									   LEFT JOIN tbl_customers AS c ON o.customer_id = c.customer_id
									   LEFT JOIN tbl_shippings AS s ON o.shipping_id = s.shipping_id 
									   LEFT JOIN tbl_billings AS b ON o.billing_id = b.billing_id
									   ORDER BY o.order_id DESC
									   LIMIT ".$data['limit']. " OFFSET ".$data['skip']);
			return $query->result_array();

		}
	}


	function bycustomer($customerid) {
		$query = $this->db->query("SELECT o.order_id AS 'Order_ID',o.sub_total,o.discount,o.giftcard,o.final_total,DATE_FORMAT(o.created,'%d %b %Y') as created,
										  o.status,
			                              s.fname AS 'ship_fname',s.lname AS 'ship_lname',s.address1 AS 'ship_address1',
			                              		s.address2 AS 'ship_address2',s.city AS 'ship_city',s.state AS 'ship_state',
			                              		s.country AS 'ship_country',s.zipcode AS 'ship_zipcode',
			                              		s.mobilenumber AS 'ship_mobilenumber',
										  b.fname AS 'bill_fname',b.lname AS 'bill_lname',b.address1 AS 'bill_address1',
			                              		b.address2 AS 'bill_address2',b.city AS 'bill_city',b.state AS 'bill_state',
			                              		b.country AS 'bill_country',b.zipcode AS 'bill_zipcode',
			                              		b.mobilenumber AS 'bill_mobilenumber'
								   FROM tbl_orders o
								   LEFT JOIN tbl_shippings AS s ON o.shipping_id = s.shipping_id 
								   LEFT JOIN tbl_billings AS b ON o.billing_id = b.billing_id 
								   WHERE o.customer_id=".(int)$customerid);
		return $query->result_array();
	}

	function orderdetail($data) {
		$query = $this->db->query("SELECT o.orderdetail_id,o.parameter,o.qty,o.price,o.size,o.color,
			                              p.name,p.main_image,p.reference_number
								   FROM tbl_orderdetails o
								   LEFT JOIN tbl_products AS p ON o.product_id = p.product_id  
								   WHERE o.order_id=".(int)$data['order_id'].
								   " LIMIT ".$data['limit']. " OFFSET ".$data['skip']);
		return $query->result_array();		
	}

	function changestatus($status) {
		$this->db->where('order_id', $status['order_id']);
		$this->db->update('tbl_orders', $status); 
		return;
	}

	function invoice($orderid) {
		$query = $this->db->query("SELECT o.order_id AS 'Order_ID',o.sub_total,o.discount,o.giftcard,o.final_total,
										  DATE_FORMAT(pr.created,'%d %b %Y') as created,o.status,
			                              s.fname AS 'ship_fname',s.lname AS 'ship_lname',s.address1 AS 'ship_address1',
		                               		s.address2 AS 'ship_address2',s.city AS 'ship_city',s.state AS 'ship_state',
				                       		s.country AS 'ship_country',s.zipcode AS 'ship_zipcode',
				                       		s.mobilenumber AS 'ship_mobilenumber',
										  b.fname AS 'bill_fname',b.lname AS 'bill_lname',b.address1 AS 'bill_address1',
				                          	b.address2 AS 'bill_address2',b.city AS 'bill_city',b.state AS 'bill_state',
				                            b.country AS 'bill_country',b.zipcode AS 'bill_zipcode',
				                            b.mobilenumber AS 'bill_mobilenumber',
				                          c.fname,c.lname,c.mobilenumber,c.email,c.status
									   FROM tbl_orders o
									   LEFT JOIN tbl_customers AS c ON o.customer_id = c.customer_id
									   LEFT JOIN tbl_shippings AS s ON o.shipping_id = s.shipping_id 
									   LEFT JOIN tbl_billings AS b ON o.billing_id = b.billing_id 
									   WHERE o.order_id=".(int)$orderid);
		$orders['Order'] = $query->result_array()[0];
		$query = $this->db->query("SELECT od.orderdetail_id,od.parameter,od.qty,od.price,
										  p.name,p.main_image,p.reference_number
								   FROM tbl_orders AS o 
								   JOIN tbl_orderdetails AS od ON(o.order_id = od.order_id) 
								   JOIN tbl_products AS p ON(od.product_id = p.product_id)
								   where o.order_id=".$orderid);
		$orders['Detail'] = $query->result_array();
		return $orders;	
	}

	function addshipping($shipping) {
		$this->db->insert('tbl_shippings', $shipping);
		return $this->db->insert_id(); 
	}

	function addbilling($billing) {
		$this->db->insert('tbl_billings', $billing);
		return $this->db->insert_id(); 
	}	

	function addorder($order) {
		$this->db->insert('tbl_orders', $order);
		return $this->db->insert_id(); 
	}

	function addhistory($history) {
		$this->db->insert('tbl_orderhistories', $history);
		return; 
	}

	function addorderdetail($orderdetail) {
		foreach ($orderdetail as $key => $value) {
			$query = $this->db->query("SELECT * FROM tbl_carts WHERE cart_id=".$value['cart_id']);
			$carts = $query->result_array();

			$orderdetail[$key]['product_id'] = $carts[0]['product_id'];
			$orderdetail[$key]['qty'] = $carts[0]['qty'];
			$orderdetail[$key]['price'] = $carts[0]['price'];

			$query = $this->db->query("SELECT * FROM tbl_cartaddons WHERE cart_id=".$value['cart_id']);
			$addons = $query->result_array();

			$orderdetail[$key]['size'] = $addons[0]['addon_value'];
			$orderdetail[$key]['color'] = $addons[1]['addon_value'];
			
			$this->db->query("DELETE c.*,ca.* FROM tbl_carts c
						      INNER JOIN tbl_cartaddons ca ON c.cart_id = ca.cart_id
						      WHERE c.cart_id=".$orderdetail[$key]['cart_id']);
			unset($orderdetail[$key]['cart_id']);

		}
		$this->db->insert_batch('tbl_orderdetails', $orderdetail);
		return; 
	}

	function ordercount() {
		$query = $this->db->query("SELECT COUNT(order_id) AS num  FROM tbl_orders");
		$count = $query->result_array()[0]['num'];
//		if(is_float($count/10)) {
//			$count = (int) ($count/10) + 1;
//		} else {
//			$count = (int) $count / 10;
//		}
		return $count;
	}

	function orderdetailcount($orderid) {
		$query = $this->db->query("SELECT COUNT(orderdetail_id) AS num  FROM tbl_orderdetails WHERE order_id=".$orderid);
		$count = $query->result_array()[0]['num'];
		if(is_float($count/5)) {
			$count = (int) ($count/5) + 1;
		} else {
			$count = (int) $count / 5;
		}
		return $count;
	}		

}


