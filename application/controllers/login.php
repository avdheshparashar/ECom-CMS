<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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

	public function __construct()
    {
        parent::__construct();
		$this->load->library('session');
        $this->load->model('user_model', 'user');
    }




	public function index()
	{
		if($this->session->userdata('admindata')) {
			redirect('welcome');
		} else {
			$this->load->view('admin/login');
		}
	}


	public function loginme(){
		if( $this->input->server('REQUEST_METHOD') != "POST" ){
			return $this->layout->view_render('admin/login');
		}
		
		if( $this->input->post('email') !== null && $this->input->post('password') !== null ){

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, API_URL."user/backendlogin");
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$response['user'] = (array) json_decode(curl_exec($ch),true);

			if( $response['user'][0]['status'] == 'false' )
			{
				return redirect('login');
			}
			else{
				// Save Data in session
				$set_sess_data = array(
		            'role_id' => $response['user'][0]['data']['role_id'],
		            'group_id' => $response['user'][0]['data']['group_id'],
		            'email' => $response['user'][0]['data']['email'],
		        );

				$this->session->set_userdata('admindata',$set_sess_data);
				
				return redirect('welcome');
			}


		}
		//return $this->layout->view_render('admin/login');
	}

	public function logout(){

		$this->session->sess_destroy('admindata');
        redirect('login');
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
