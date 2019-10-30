<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

	public function __construct(){
		$route = $this->router->fetch_class();
		// if($route == 'login'){
		// 	if($this->session->has_userdata('logged_in')){
		// 		redirect(base_url());
		// 	}
		// } else {
		// 	if(!$this->session->has_userdata('logged_in')){
		// 		redirect(base_url('login'));
		// 	}
		// }
	}

	public function load_page($page, $data = array()){
      	$this->load->view('includes/head',$data);
      	$this->load->view($page,$data);
      	$this->load->view('includes/footer',$data);
     }

}
