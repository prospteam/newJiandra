<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct(){
		parent::__construct();

	}

	public function index(){
		// $parameters['select'] = '*';
		// $data['users'] = $this->MY_Model->getRows('users',$parameters);
		$parameters['where'] = array('id !=' => 1);
		$parameters['select'] = '*';
		$data['position'] = $this->MY_Model->getRows('position',$parameters);
    $this->load_page('users', @$data);
	}

	public function display_users(){
		$limit = $this->input->post('length');
		$offset = $this->input->post('start');
		$search = $this->input->post('search');
		$order = $this->input->post('order');
		$draw = $this->input->post('draw');


		$column_order = array('fullname','company.company_name','position.position_name');
		$where = array('users.status !=' => 3);
		$join = array(
			'company' => 'company.company_id = users.company',
			'position' => 'position.id = users.position'
		);
		$select = "users.id,users.fullname,company.company_name,position.position_name,users.status";
		$list = $this->MY_Model->get_datatables('users',$column_order, $select, $where, $join, $limit, $offset ,$search, $order);

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

		$company_id = explode(',',$data->company);
		$company_parameters['where_in'] = array('col' => 'company_id', 'value' => $company_id);
		$data_company = $this->MY_Model->getRows('company',$company_parameters);

		$data_array['users'] = $data;
		$data_array['company'] = $data_company;
		json($data_array);
	}

	//display companies
	public function add_companies(){
		$parameters['select'] = '*';
		$data['companies'] = $this->MY_Model->getRows('company',$parameters);
		echo json_encode($data);
		// print_r($data);
	}

	//display companies for edit
	public function edit_companies(){
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
		$this->load->library("form_validation");

		$this->form_validation->set_rules('fullname', 'Fullname', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('position', 'Position', 'required');
		// $this->form_validation->set_rules('company', 'Company', 'required');

		if ($this->form_validation->run() !== FALSE) {
			$data = array(
				'fullname' => $this->input->post('fullname'),
				'username' => $this->input->post('username'),
				'password	' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
				'position' => $this->input->post('position'),
				'company' => implode(',',$this->input->post('company')),
				'status' => 1
			);

			$insert = $this->MY_Model->insert('users', $data);
			if ($insert) {
				$response = array(
					'status' => 'ok'
				);
			}
		}else{
			  $response = array('form_error' => $this->form_validation->error_array());
		}

		echo json_encode($response);
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
