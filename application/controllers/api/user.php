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

class User extends REST_Controller {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model('user_model'); 
        $this->load->library('email');
    }

    function records_get()  {
        if($this->get('customer_id')) {
            $records = $this->user_model->getlist($this->get('customer_id'));
        } else {
            $records = $this->user_model->getlist();
        }
        if(empty($records)) {
            $users[0] = array('status'=>'false','message'=>"Customer Not Found");
        } else {
            $users[0] = array('status' => 'true', 'message' => 'Customer found', 'data' => $records);
        }
        $this->response($users,200); // 200 being the HTTP response code
    }

    function login_post() {
        if($this->post('email') && $this->post('password')) {
            $data = array(
                'email' => $this->post('email'),
                'password' => sha1($this->post('password')),
                'group_id' => (int) $this->post('group_id')
            );
            $getlogin = $this->user_model->login($data);
            if(empty($getlogin)) {
                $login[0] = array('status'=>'false','message'=>'Eamil or Password does not match.');
            } else {
                $login[0] = array('status' => 'true', 'message' => 'You are successfull login', 'data' => $getlogin);
            }
        } else {
            $login[0] = array('status'=>'false','message'=>'Please supply email and password.');
        }
        $this->response($login,200);
    }


    function backendlogin_post() {
        if($this->post('email') && $this->post('password')) { 
            $data = array(
                'email' => $this->post('email'),
                'password' => sha1($this->post('password'))
            );

            $getlogin = $this->user_model->backend_login($data);
            if(empty($getlogin)) {
                $login[0] = array('status'=>'false','message'=>'Eamil or Password does not match.');
            } else {
                $login[0] = array('status'=>'true','message'=>'You are successfull login','data'=>$getlogin);
            }
        } else {
            $login[0] = array('status'=>'false','message'=>'Please supply email and password.');
        }
        $this->response($login,200);
    }


    function edit_post() {
        if($this->post('customer_id') && $this->post('fname') && $this->post('lname') && $this->post('mobilenumber')) {
            $data = array(
                    'customer_id' => $this->post('customer_id'),
                    'fname' => $this->post('fname'),
                    'lname' => $this->post('lname'),
                    'mobilenumber' => $this->post('mobilenumber'),
                    'modified'=> date("Y-m-d H:i:s")
                );
            $getdata = $this->user_model->edit($data);
            $edituser[0] = array('status'=>'true','message'=>'Your details has been updated','data'=>$getdata);
        } else {
            $edituser[0] = array('status'=>'false','message'=>'Please supply all data');   
        }
        $this->response($edituser,200);
    }

    function changepassword_post() {
        if($this->post('customer_id') && $this->post('oldpassword') && $this->post('newpassword')) {
            $data = array(
                    'customer_id' => $this->post('customer_id'),
                    'oldpassword' => sha1($this->post('oldpassword'))
                 );
            $check = $this->user_model->checkpassword($data);
            if(empty($check)) {
                $setpassword[0] = array('status'=>'false','message'=>'Your old password does not match');
            } else {
                $data = array(
                        'customer_id' => $this->post('customer_id'),
                        'newpassword' => sha1($this->post('newpassword'))
                    );
                $this->user_model->changepassword($data);
                $setpassword[0] = array('status'=>'true','message'=>'Your password successfully changed');
            }
        } else {
            $setpassword[0] = array('status'=>'false','message'=>'Please supply all data');
        }
        $this->response($setpassword,200);
    }

    function changestatus_post() {
        if($this->post('ids')) {
            $this->user_model->changestatus($this->post('ids'));
            $change[0] = array('status'=>'true','message'=>'Customer status has been changed');
        } else {
            $change[0] = array('status'=>'false','message'=>'Please pass valid user_id data');
        }
        $this->response($change,200);
    }    

    function register_post() {
        if($this->post('fname') && $this->post('lname') && $this->post('mobilenumber') && $this->post('email') && $this->post('password')) {
            $check = $this->user_model->checkuser($this->post('email'));
            if(empty($check)) {
                $text1 = explode("@",$this->post('email'));
                $text2 = explode(".",$text1[1]);
                $hashstring = $text1[0].$text2[0];
                $data = array(
                        'email' => $this->post('email'),
                        'fname' => $this->post('fname'),
                        'lname' => $this->post('lname'),
                        'mobilenumber' => $this->post('mobilenumber'),
                        'password' => sha1($this->post('password')),
                        'verifylink' => md5($hashstring)
                    );
                $this->user_model->register($data);
                $link = "http://sampleserver.org/ascreation/api/user/verify?email=".$data['email']."&verification=".$data['verifylink'];
                $sendmail = $data['email'];
                $config['charset'] = 'utf-8';
                $config['protocol'] = 'mail';
                $config['wordwrap'] = FALSE;
                $config['mailtype'] = 'html';
                $this->email->initialize($config);
                $this->email->from('viral@bugletech.com', 'Viral');
                $this->email->to($sendmail);
                $this->email->subject('[AS Creation] Confrim your account');
                $mail['link'] = $link;      
                $msg = $this->load->view('emails/verifyaccount', $mail, true);
                $this->email->message($msg);
                $this->email->send();                

                $register[0] = array('status'=>'true','message'=>'You are successfully registered. Please verify link send to email');    
            } else {
                $register[0] = array('status'=>'false','message'=>'You are already register user');    
            }
        } else {
            $register[0] = array('status'=>'false','message'=>'Please pass all valid data');   
        }
        $this->response($register,200);
    }

    function verify_get() {
        if($this->get("verification") && $this->get("email")) {
            $this->user_model->verify($this->get("verification"),$this->get("email"));
            redirect('successful');
            //$verify[0] = array('status'=>'true','message'=>'You are successfully verified. You can now login with your email and password');
        } else {
            $verify[0] = array('status'=>'false','message'=>'Please pass verification id'); 
        }
        $this->response($verify,200);
    }

    function resendlink_post() {
        if($this->post("email")) {
            $check = $this->user_model->userverify($this->post('email'));
           
            if(empty($check)) {
                $text1 = explode("@",$this->post('email'));
                $text2 = explode(".",$text1[1]);
                $hashstring = $text1[0].$text2[0];
                $data = array(
                        'email' => $this->post('email'),
                        'verifylink' => md5($hashstring)
                    );
                $this->user_model->resend($data);

                $link = "http://bugletech.com/clients/marketplace/index.php/api/user/verify?email=".$data['email']."&verification=".$data['verifylink'];

                $config['charset'] = 'utf-8';
                $config['protocol'] = 'mail';
                $config['wordwrap'] = FALSE;
                $config['mailtype'] = 'html';
                $this->email->initialize($config);
                $this->email->from('viral@bugletech.com', 'Viral');
                $this->email->to($data['email']);
                $this->email->subject('[Marketplace] Re-send verification link for your account');
                $mail['link'] = $link;      
                $msg = $this->load->view('emails/verifyaccount', $mail, true);
                $this->email->message($msg);
                $this->email->send(); 

                $sendagain[0] = array('status'=>'true','message'=>'Link has been send successfully to your email again.');  
            } else {
                $sendagain[0] = array('status'=>'false','message'=>'You are already registerd');  
            }
        } else {
            $sendagain[0] = array('status'=>'false','message'=>'Please pass valid email data');   
        }
        $this->response($sendagain,200);
    }

    function forgetpassword_post() {
        if($this->post("email")) {
            $check = $this->user_model->checkuser($this->post('email'));
            if(!empty($check)) {
                $text1 = explode("@",$this->post('email'));
                $text2 = explode(".",$text1[1]);
                $hashstring = $text1[0].$text2[0];
                $data = array(
                        'email' => $this->post('email'),
                        'forgetlink' => md5($hashstring)
                    );
                $this->user_model->forgetpassword($data);
                
                $link = "http://www.sampleserver.org/ascreation/front/customer/reset?email=".$data['email']."&forgetlink=".$data['forgetlink'];
            $sendmail = $data['email'];
                $config['charset'] = 'utf-8';
                $config['protocol'] = 'mail';
                $config['wordwrap'] = FALSE;
                $config['mailtype'] = 'html';
                $this->email->initialize($config);
                $this->email->from('viral@bugletech.com', 'Viral');
                $this->email->to($data['email']);
                $this->email->subject('[AS Creation] Reset password link for your account');
                $mail['link'] = $link;      
                $msg = $this->load->view('emails/resetpassword', $mail, true);
                $this->email->message($msg);
                $this->email->send(); 


                $sendagain[0] = array('status'=>'true','message'=>'Password reset link is sent to your email id');  
            } else {
                $sendagain[0] = array('status'=>'false','message'=>'Email ID not found');  
            }
        } else {
            $sendagain[0] = array('status'=>'false','message'=>'Please pass valid email data');   
        }
        $this->response($sendagain,200);
    }

    function resetpassword_post() {
        if($this->post("password") && $this->post("email") && $this->post("forgetlink")) {
            $reset = array(
                    'forgetlink' => $this->post("forgetlink"),
                    'password' => sha1($this->post("password")),
                    'email' => $this->post("email") 
                );
            $this->user_model->resetpassword($reset);
            $verify[0] = array('status'=>'true','message'=>'Your password has been changed');
        } else {
            $verify[0] = array('status'=>'false','message'=>'Please pass valid forget link and email'); 
        }
        $this->response($verify,200);
    }    

    function remove_post() {
        $remove[0] = array('status'=>'true','message'=>'User has been removed');   
        $this->response($remove,200);
    }

    function sendmail_get() {
        $this->load->library('email');
        $config['charset'] = 'utf-8';
        $config['protocol'] = 'mail';
        $config['wordwrap'] = FALSE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('viral@bugletech.com', 'Viral');
        $this->email->to("viral@bugletech.com");
        $this->email->subject('[Viral] New Abusive words for you');
        $data['message'] = "New Abusive word ";      
        $msg = $this->load->view('emails/abusive', $data, true);
        $this->email->message($msg);
        $this->email->send();
        die();
    }
}
