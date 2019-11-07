<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct(){
		parent::__construct();

	}

	public function index(){
    $this->load_login_page('login');
	}

	public function auth(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data = array(
			'username' => $username,
			'password' => $password,
		);
		$parameters['where'] =  $data;
		$parameters['select'] = 'id, fullname, position';
		$result = $this->MY_Model->getRows('users',$parameters,'row');
		if($result){
			$this->setSession($result);
			redirect(base_url());
		} else {
 			$data['msg'] = 'Invalid Username or password';
 			$this->load_login_page('login',$data);

		}
		// echo "<pre>";
		// print_r($result);
		// exit;

	}

	public function setSession($data,$result){
		$data_session = array(
			'logged_in' => true,
			'id' => $data->id,
			'fullname' => $data->fullname,
			'position' => $data->position
		);
		$this->session->set_userdata($data_session);
	}

}
?>
