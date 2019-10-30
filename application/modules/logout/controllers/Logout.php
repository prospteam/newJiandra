<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends MY_Controller {

	public function index(){
		$session_data = array('user_id','name','user_group','logged_in');
		$this->session->unset_userdata($session_data);
		redirect(base_url('login'));
	}
}
