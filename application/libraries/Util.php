<?php 
/**
 * BUGLE TECH LICENSE
 *
 * Inspired By http://www.jenssegers.be codeigniter template library
 *
 * @library    	Util
 * @copyright  	Copyright (c) 2014, 	Nidhi Barhate
 * @version    	0.1
 * @created     24-02-2015
 * @modified	
 * @author     	Nidhi Barhate <nidhi@bugletech.com>
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Util {
	

	/*
	* //Want to disable controller names
	*/
	public function controllerArray(){
		// return array('permission','role','controllermethod','login','user','home');
		return array('login','home');
	}
	//Want to disable methods names
	public function methodArray(){
		return array('securelogin','permissionData');
	}
}
