<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct(){
		parent::__construct();


	}

	public function index(){
		// $parameters['select'] = '*';
		// $data['users'] = $this->MY_Model->getRows('users',$parameters);
		$data['upresent'] = 1;
		$parameters['where'] = array('id !=' => 1);
		$parameters['select'] = '*';
		$data['position'] = $this->MY_Model->getRows('position',$parameters);
    $this->load_page('users', @$data );
	}

	public function display_users(){
		$limit = $this->input->post('length');
		$offset = $this->input->post('start');
		$search = $this->input->post('search');
		$order = $this->input->post('order');
		$draw = $this->input->post('draw');


		$column_order = array('fullname','username','position.position_name','company.company_name');
		$where = array('users.status !=' => 3);
		$join = array(
			'company' => 'company.company_id = users.company',
			'position' => 'position.id = users.position'
		);
		$select = "users.id,users.fullname,users.username,users.company,company.company_name,position.position_name,users.status";
		$list = $this->MY_Model->get_datatables('users',$column_order, $select, $where, $join, $limit, $offset ,$search, $order);
		// foreach($list['data'] as $key => $value){
		// 	echo "<pre>";
		// 	print_r($value);
		//
		// }
		// if(!empty($list)) {
		// 	foreach ($list as $key => $value) {
		// 		$list[$key]['position'] = userType($value['position']);
		// 	}
		// }

		$output = array(
				"draw" => $draw,
				"recordsTotal" => $list['count_all'],
				"recordsFiltered" => $list['count'],
				"data" => $list['data']
		);
		// $this->load_page('users',$output);

		echo json_encode($output);
	}

	//view user Details
	public function view_user_details(){
		$user_id = $this->input->post('id');
		$data_array = array();

		$parameters['join'] = array(
			'company' => 'company.company_id = users.company',
			'position' => 'position.id = users.position'
		);
		$parameters['where'] = array('users.id' => $user_id);
		$parameters['select'] = '*';

		$data = $this->MY_Model->getRows('users',$parameters,'row');
		$password = $data->password;

		$company_id = explode(',',$data->company);
		$company_parameters['where_in'] = array('col' => 'company_id', 'value' => $company_id);
		$data_company = $this->MY_Model->getRows('company',$company_parameters);

		$data_array['users'] = $data;
		$data_array['company'] = $data_company;
		json($data_array);
	}

	//display companies
	public function add_companies(){
		$parameters['where'] = array('company_id !=' => 0);
		$parameters['select'] = '*';
		$data['companies'] = $this->MY_Model->getRows('company',$parameters);
		echo json_encode($data);
		// print_r($data);
	}

	//display companies for edit
	public function edit_companies(){
		$parameters['where'] = array('company_id !=' => 0);
		$parameters['select'] = '*';
		$data['companies'] = $this->MY_Model->getRows('company',$parameters);
		echo json_encode($data);
		// print_r($data);
	}

	//test for where_in
	public function test_company(){
			$parameters['where'] = array('id' => 5);
			$data = $this->MY_Model->getRows('users',$parameters,'row');
			$company_id = $data->company;
			$parameters2['where_in']['col'] = 'company_id';
			$parameters2['where_in']['value'] = explode(',',$company_id);
			$data_result = $this->MY_Model->getRows('company',$parameters2);
			json($data_result,false);
	}

	//Add User
	public function adduser()
	{
		// echo "<pre>";
		// print_r($this->input->post());
		// exit;
		$this->load->library("form_validation");

		$this->form_validation->set_rules('fullname', 'Fullname', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('position', 'Position', 'required');
		if($this->input->post('position') != 5){

			$this->form_validation->set_rules('company[]', 'Company', 'required');
		}
		$error = array();


		// if(empty($this->input->post('company[]'))){
		// 	$error['company'] = 'The Companies field is required.';
		// }
		if($this->input->post('position') != 5){

			$company = implode(',',$this->input->post('company'));
		}else{
			$company = 0;
		}

		$username = $this->input->post('username');
		$parameters['where'] = array('username' => $username);
		$parameters['select'] = 'username';
		$username_exitst = $this->MY_Model->getRows('users',$parameters);

		$count_username = count($username_exitst);
		if($count_username){
			$response = array('username_error' =>  'Username already exists!' );
			echo json_encode($response);
		}else{

		if ($this->form_validation->run() !== FALSE) {
			$data = array(
				'fullname' => $this->input->post('fullname'),
				'username' => $this->input->post('username'),
				'password	' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
				'position' => $this->input->post('position'),
				'company' => $company,
				'status' => 1
			);

			$insert = $this->MY_Model->insert('users', $data);
			if ($insert) {
				$response = array(
					'status' => 'ok'
				);
				echo json_encode($response);
			}
		}else{
			  $response = array('form_error' =>  array_merge($this->form_validation->error_array(), $error) );
			  echo json_encode($response);
		}

	}
}


	//view details for edit
	public function user_details(){
		$user_id = $this->input->post('id');

		$parameters['join'] = array(
			'company' => 'company.company_id = users.company',
		);
		$parameters['where'] = array('users.id' => $user_id);
		$parameters['select'] = '*';

		$data = $this->MY_Model->getRows('users',$parameters,'row');

		$company_id = explode(',',$data->company);
		$company_parameters['where_in'] = array('col' => 'company_id', 'value' => $company_id);
		$data_company = $this->MY_Model->getRows('company',$company_parameters);

		$data_array['users'] = $data;
		$data_array['company'] = $data_company;

		// $parameters['where'] = array('id' => $user_id);
		// $data['view_edit'] = $this->MY_Model->getRows('users',$parameters,'row');
		// echo $this->db->last_query();
		echo json_encode($data_array);
	}

	//Edit user
	public function edituser()
	{

		$user_id = $this->input->post('id');
			$post = $this->input->post();
			$result = false;

			if(!empty($post)) {
			$data = array(
				'fullname' => $post['fullname'],
				'username' => $post['username'],
				'position' => $post['position']
			);

			if(!empty($post['password'])) {
				$data['password'] = password_hash($post['password'],PASSWORD_DEFAULT);
			}

			if(!empty($post['company'])) {
				$data['company'] = implode(',',$post['company']);
			}

			$update = $this->MY_Model->update('users', $data,array('id' => $user_id));
			if ($update) {
				$response = array(
					'status' => 'ok'
				);
			}else{
				$response = array(
					'status' => 'invalid'
				);
			}

			$result = json_encode($response);

			}

		die($result);
	}

	//Enable user
	public function enableuser()
	{
		$user_id = $this->input->post('id');
		$user_status = 1;
		$data = array(
			'status' => $user_status
		);
		$datas['delete'] = $this->MY_Model->update('users',$data,array('id' => $user_id));
		echo json_encode($datas);
	}

	//Disable user
	public function disableuser()
	{
		$user_id = $this->input->post('id');
		$user_status = 2;
		$data = array(
			'status' => $user_status
		);
		$datas['delete'] = $this->MY_Model->update('users',$data,array('id' => $user_id));
		echo json_encode($datas);
	}

	//Permanently Delete user
	public function deleteuser()
	{
		$user_id = $this->input->post('id');
		$user_status = 3;
		$data = array(
			'status' => $user_status
		);
		$datas['delete'] = $this->MY_Model->update('users',$data,array('id' => $user_id));
		echo json_encode($datas);
	}
}
