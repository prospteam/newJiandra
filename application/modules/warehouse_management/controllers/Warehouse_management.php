<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse_management extends MY_Controller {
	public function index(){
		// $parameters['select'] = 'fullname,username';
		// $parameters['search_like'] = 'da';
		// $parameters['column_order'] = array('fullname','username');
		// $data = getrow('users',$parameters,'array',true);
		// json($data,false);
		$this->load_page('warehouse_management');
	}

public function addwh_management(){
	$this->load->library("form_validation");
	$this->form_validation->set_rules('wh_name','WH Name','required');
	$this->form_validation->set_rules('wh_type','WH Type', 'required');
	$this->form_validation->set_rules('wh_assigned','WH Assigned','required');
	$error = array();

	if ($this->form_validation->run() !== FALSE) {
		$data = array(
			'wh_name' => $this->input->post('wh_name'),
			'wh_type' => $this->input->post('wh_type'),
			'wh_assigned' => $this->input->post('wh_assigned'),
			'status' => 1
		);

		$insert = $this->MY_Model->insert('warehouse_management',$data);
		if ($insert) {
			$response = array(
				'status'=>'ok'
			);
		}
	}	else {
			$response = array('form_error'=> array_merge($this->form_validation->error_array(),$error) );
		}
			echo json_encode($response);
	}

	//display all warehouse
	function display_wh_management($id){
		 $limit = $this->input->post('length');
		 $offset = $this->input->post('start');
		 $search = $this->input->post('search');
		 $order = $this->input->post('order');
		 $draw = $this->input->post('draw');


		 $column_order = array('wh_name','wh_type','wh_assigned','status');
		 $where = array('status !=' => 2);
		 $join = array(
			 // 'company' => 'company.company_id = users.company',
			 // 'position' => 'position.id = users.position'
		 );
		 $select = "warehouse_management.id,warehouse_management.wh_name,warehouse_management.wh_type,warehouse_management.wh_assigned,warehouse_management.status";
		 $list = $this->MY_Model->get_datatables('warehouse_management',$column_order, $select, $where, $join, $limit, $offset ,$search, $order);


		 $output = array(
				 "draw" => $draw,
				 "recordsTotal" => $list['count_all'],
				 "recordsFiltered" => $list['count'],
				 "data" => $list['data']
		 );
		 echo json_encode($output);
	 }

	 public function editWarehouseManagement(){
		 $warehouse_id = $this->input->post('id');

	 $data_array = array();

	 $parameters['where'] = array('warehouse_management.id'=>$warehouse_id);
	 $parameters['select'] = '*';

	 $data = $this->MY_Model->getrows('warehouse_management',$parameters,'row');

	 $data_array['warehouse-management'] = $data;
	 json($data_array);
	 }

}
?>
