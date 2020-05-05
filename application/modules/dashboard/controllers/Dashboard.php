<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	public function index(){
		// $parameters['select'] = 'fullname,username';
		// $parameters['search_like'] = 'da';
		// $parameters['column_order'] = array('fullname','username');
		// $data = getrow('users',$parameters,'array',true);
		// json($data,false);
	 	// echo "<pre>";
	 	// print_r($this->session->userdata());
	 	//  exit;
		$data['dbpresent'] = 1;
		$this->load_page('dashboard', $data);
	}
}
?>
