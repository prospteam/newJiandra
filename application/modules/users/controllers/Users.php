<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct(){
		parent::__construct();

	}

	public function index(){
		// $parameters['select'] = '*';
		// $data['users'] = $this->MY_Model->getRows('users',$parameters);
    $this->load_page('users');
	}

	public function display_users(){
		$limit = $this->input->post('length');
		$offset = $this->input->post('start');
		$search = $this->input->post('search');
		$order = $this->input->post('order');
		$draw = $this->input->post('draw');
		$column_order = array('fullname','company','position');
		// $where = array("status" => 1);
		$join = array();
		$select = "fullname,company,position,status";
		$list = $this->MY_Model->get_datatables1('users',$column_order, $select, $join, $limit, $offset ,$search, $order);
		$output = array(
				"draw" => $draw,
				"recordsTotal" => $list['count_all'],
				"recordsFiltered" => $list['count'],
				"data" => $list['data']
		);
		// $this->load_page('users',$output);
		echo json_encode($output);
	}

	//display companies
	public function companies(){
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
	
	public function adduser()
	{
		$this->load->library("form_validation");

		$data = array(
			'fullname' => $this->input->post('fullname'),
			'username' => $this->input->post('username'),
			'password	' => md5($this->input->post('password')),
			'position' => $this->input->post('position'),
			'company' => implode(',',$this->input->post('company')),
			'status' => 1
		);

		$insert = $this->MY_Model->insert('users', $data);

		if ($insert) {
			$response = array(
				'type' => 'success',
				'title' => 'Success!',
				'msg' => 'User added successfully'
			);
		} else {
			$response = array(
				'type' => 'error',
				'title' => 'Error!',
				'msg' => 'Something Went Wrong!'
			);
		}

		echo json_encode($response);
	}
}
