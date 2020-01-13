<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse_management extends MY_Controller {
	public function index(){
		// $parameters['select'] = 'fullname,username';
		// $parameters['search_like'] = 'da';
		// $parameters['column_order'] = array('fullname','username');
		// $data = getrow('users',$parameters,'array',true);
		// json($data,false);

		$data['company'] = $this->MY_Model->getrows('company');
		$data['vehicles'] = $this->MY_Model->getrows('vehicles');
		$this->load_page('warehouse_management',$data);
	}

public function addwh_management(){
	$this->load->library("form_validation");
	$this->form_validation->set_rules('wh_name','WH Name','required');
	$this->form_validation->set_rules('wh_type','WH Type', 'required');
	$this->form_validation->set_rules('company[]','Company','required');
	$this->form_validation->set_rules('wh_assigned','WH Assigned','required');

	if ($this->input->post('wh_type') == 1) {
		$this->form_validation->set_rules('wh_address','WH Address','required');
	}else {
		$this->form_validation->set_rules('wh_plate_number','WH Plate Number', 'required');
	}

	$error = array();

	if ($this->form_validation->run() !== FALSE) {
		$data = array(
			'wh_name' => $this->input->post('wh_name'),
			'wh_type' => $this->input->post('wh_type'),
			'company' => $this->input->post('company'),
			'wh_plate_number' => ($this->input->post('wh_plate_number')!= null)?$this->input->post('wh_plate_number'):" ",
			'wh_address' =>($this->input->post('wh_address')!= null)?$this->input->post('wh_address'):" ",
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

	//display companies for adding supplier
	public function add_warehouse_users(){
		$parameters['select'] = '*';
		$data['warehouse_users'] = $this->MY_Model->getRows('company',$parameters);
		echo json_encode($data);
		// print_r($data);
	}

	//display WAREHOUSE TYPE
	public function add_warehouse_type(){
		$parameters['select'] = '*';
		$data['warehouse_type'] = $this->MY_Model->getRows('vehicles',$parameters);
		echo json_encode($data);
		// print_r($data);
	}

	//display all warehouse
	function display_wh_management($id){
		 $limit = $this->input->post('length');
		 $offset = $this->input->post('start');
		 $search = $this->input->post('search');
		 $order = $this->input->post('order');
		 $draw = $this->input->post('draw');


		 $column_order = array('wh_name','wh_type','wh_assigned','warehouse_management.status');
		 $where = array('warehouse_management.status !=' => 3);
		 $join = array(
			 // 'company' => 'company.company_id = users.company',
			 'users' => 'users.id = warehouse_management.wh_assigned'
		 );
		 $select = "warehouse_management.id,warehouse_management.wh_name,warehouse_management.wh_type,warehouse_management.wh_assigned,warehouse_management.status,users.fullname";
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

	 $data_array['warehouse_management'] = $data;
	  echo json_encode($data_array);

	 }

	 public function get_warehouse_by_companies(){
			 $parameters['where'] = array('company' => $this->input->post('company_id'));
			 $data['users'] = $this->MY_Model->getRows('users',$parameters);
			 echo json_encode($data);
	 }
	 public function get_warehouse_by_vehicles(){
			 $parameters['where'] = array('vehicles' => $this->input->post('vehicle_type'));
			 $data['vehicles'] = $this->MY_Model->getRows('vehicles',$parameters);
			 echo json_encode($data);
	 }
	 public function edit_warehouse(){

			 $warehouse_id = $this->input->post('id');
			 $post = $this->input->post();
			 $result = false;

			 if (!empty($post)) {
				 $data = array(
					 'wh_name'  	   				  => $post['wh_name'],
					 'wh_type'  	   			    => $post['wh_type'],
					 'wh_assigned'  	   			=> $post['wh_assigned'],
				 );

			 $update = $this->MY_Model->update('warehouse_management',$data, array('id' => $warehouse_id));
			 if ($update) {
				 $response = array(
					 'status' => 'ok'
				 );
			 }else {
					 $response = array(
						 'status' => 'invalid'
				 );
			 }
				 $result = json_encode($response);
			 }
			 die($result);
		 }

		 public function enable_warehouse(){

				$warehouse_id = $this->input->post('id');
				$warehouse_status = 1;
				$data = array(
					'status' => $warehouse_status
				);
				$datas['delete'] = $this->MY_Model->update('warehouse_management',$data,array('id' => $warehouse_id));
				echo json_encode($datas);
		}

		 public function disable_warehouse(){

				 $warehouse_id = $this->input->post('id');
				 $warehouse_status = 2;
				 $data = array(
					 'status' => $warehouse_status
				 );
				 $datas['delete'] = $this->MY_Model->update('warehouse_management',$data,array('id' => $warehouse_id));
				 echo json_encode($datas);
		 }

		 public function delete_warehouse(){

				 $warehouse_id = $this->input->post('id');
				 $warehouse_status = 3;
				 $data = array(
					 'status' => $warehouse_status
				 );
				 $datas['delete'] = $this->MY_Model->update('warehouse_management',$data,array('id' => $warehouse_id));
				 echo json_encode($datas);
		 }
}
?>
