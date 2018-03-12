<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		BugleCMS
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Viral Thakkar
 * @link		http://104.236.210.247/buglecms/index.php/api/subscriber/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
if(!class_exists('REST_Controller')) {
	require_once(APPPATH.'/libraries/REST_Controller.php');
}

class Setting extends REST_Controller {

	function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model('setting_model'); 
    }

    function records_get()  {
        if($this->get('limit')) {
            $data['limit'] = $this->get('limit');
        } else {
            $data['limit'] = 10;
        }
        if($this->get('skip')) {
            $data['skip'] = $this->get('skip');
        } else {
            $data['skip'] = 0;
        }
        $count = $this->setting_model->settingcount();
        if($this->get('setting_ids')) {
            $data['setting_ids'] = $this->get("setting_ids");
            $records = $this->setting_model->getlist($data); 
        } else {
            $records = $this->setting_model->getlist($data); 
        }
        $settings[0] = array('status'=>'true','message'=>'Your settings list','data'=>$records,'count'=>$count); 
        $this->response($settings,200);
    }


    function remove_post() {
        if($this->post('settingids')) {
            $this->setting_model->cancelsetting($this->post('settingids'));
            $remove[0] = array('status'=>'true','message'=>'Setting has been deleted');
        } else {
            $remove[0] = array('status'=>'false','message'=>'Please pass valid settings_id');
        }
        $this->response($remove,200);
    }  

    function savesetting_post() {
        if($this->post('setting_name') && $this->post('setting_value')) {
            $data = array(
                    'setting_name' => $this->post('setting_name'),
                    'setting_type' => $this->post('setting_type'),
                    'setting_value' => $this->post('setting_value')
                );
            if($this->post('settings_id')) {
                $data['settings_id'] = $this->post('settings_id');
            }

            $this->setting_model->savesetting($data);
            $setting[0] = array('status'=>'true','message'=>'Setting has been updated');
        } else {
            $setting[0] = array('status'=>'false','message'=>'Please pass all the data');
        }
        $this->response($setting,200);
    }

}
