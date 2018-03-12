<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class Welcome extends CI_Controller {
class Export extends Admin_Controller {

	public function index() {
		$this->layout->view_render('admin/export/index');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */