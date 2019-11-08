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
		// $data = array(
		// 	'username' => $username,
		// 	'password' => $password,
		// );
		$parameters['where'] =  array('username' => $username);
		// $parameters['select'] = 'id, fullname, position';
		$result = $this->MY_Model->getRows('users',$parameters,'row');
		if($result){
			if(password_verify($password,$result->password)){
				$this->setSession($result);
				redirect(base_url());
			}else{
				$data['msg'] = 'Password is incorrect';
	 			$this->load_login_page('login',$data);
			}
		} else {
 			$data['msg'] = 'Username is incorrect';
 			$this->load_login_page('login',$data);

		}

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
