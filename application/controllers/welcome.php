<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class Welcome extends CI_Controller {
class Welcome extends Admin_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

    function index() {
        $this->load->model('category_model');
        $count['categories'] =$this->category_model->categorycount();
        $count['brands'] =$this->category_model->brandcount();
        $this->load->model('product_model');
        $count['products'] =$this->product_model->productcount();
        $this->load->model('order_model');
        $count['orders'] =$this->order_model->ordercount();
        $this->load->model('user_model');
        $count['users'] =$this->user_model->usercount();
        $this->layout->view_render('admin/dashboard',$count);
    }
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */