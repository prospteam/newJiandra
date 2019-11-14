<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends MY_Controller {
	public function index(){
		// $parameters['select'] = 'fullname,username';
		// $parameters['search_like'] = 'da';
		// $parameters['column_order'] = array('fullname','username');
		// $data = getrow('users',$parameters,'array',true);
		// json($data,false);
		$this->load_page('vehicle');
	}

	//display vehicles
	public function display_vehicles(){
		$limit = $this->input->post('length');
		$offset = $this->input->post('start');
		$search = $this->input->post('search');
		$order = $this->input->post('order');
		$draw = $this->input->post('draw');


		$column_order = array('vehicle_type','plate_number','vehicle_brand');
		$where = array('status !=' => 3);
		$join = array();

		$select = "id,vehicle_type, plate_number, vehicle_brand, status";
		$list = $this->MY_Model->get_datatables('vehicles',$column_order, $select, $where, $join, $limit, $offset ,$search, $order);



		$output = array(
				"draw" => $draw,
				"recordsTotal" => $list['count_all'],
				"recordsFiltered" => $list['count'],
				"data" => $list['data']
		);
		// $this->load_page('users',$output);
		echo json_encode($output);
	}


	//view vehicle Details
	public function view_vehicle_details(){
		$vehicle_id = $this->input->post('id');
		// $data_array = array();
		//
		// $parameters['join'] = array(
		// 	'company' => 'company.company_id = users.company',
		// 	'position' => 'position.id = users.position'
		// );
		$parameters['where'] = array('id' => $vehicle_id);
		$parameters['select'] = '*';

		$data['vehicle'] = $this->MY_Model->getRows('vehicles',$parameters,'row');

		json($data);
	}

	//Add User
	public function addvehicle()
	{

		$this->load->library("form_validation");
		// $vehicleType = $this->input->post('vehicle_type');

		$this->form_validation->set_rules('plate_number', 'Plate Number', 'required');
		$this->form_validation->set_rules('vehicle_brand', 'Vehicle Brand', 'required');
		$this->form_validation->set_rules('vehicle_type', 'Vehicle Type', 'required');
		$this->form_validation->set_rules('fuel_type', 'Fuel Type', 'required');
			$this->form_validation->set_rules('num_of_tires', 'Number of Tires', 'required');

		if ($this->form_validation->run() !== FALSE) {
			$data_array = array();
			foreach($this->input->post() as $key => $value){
					$data_array[$key] = $value;
			}
			$data_array['status'] = 1;
			// $data = array(
			// 	'plate_number' => $this->input->post('plate_number'),
			// 	'vehicle_brand' => $this->input->post('vehicle_brand'),
			// 	'vehicle_type' => $this->input->post('vehicle_type'),
			// 	'fuel_type' => $this->input->post('fuel_type'),
			// 	'num_of_tires' => $this->input->post('num_of_tires'),
			// 	'accounting_date_acquired' => $this->input->post('accounting_date_acquired'),
			// 	'accounting_acqui_amount' => $this->input->post('accounting_date_acquired'),
			// 	'accounting_full_dep_date' => $this->input->post('accounting_full_dep_date'),
			// 	'accounting_monthly_dep' => $this->input->post('accounting_monthly_dep'),
			// 	'accounting_accum_dep' => $this->input->post('accounting_accum_dep'),
			// 	'accounting_book_val' => $this->input->post('accounting_book_val'),
			// 	'approx_length' => $this->input->post('approx_length'),
			// 	'approx_width' => $this->input->post('approx_width'),
			// 	'approx_height' => $this->input->post('approx_height'),
			// 	'approx_volume' => $this->input->post('approx_volume'),
			// 	'approx_weight' => $this->input->post('approx_weight'),
			// 	'van_reg_date' => $this->input->post('van_reg_date'),
			// 	'van_policy_num' => $this->input->post('van_policy_num'),
			// 	'van_renewal_date' => $this->input->post('van_renewal_date'),
			// 	'van_exp_date' => $this->input->post('van_exp_date'),
			// 	'land_reg_date' => $this->input->post('land_reg_date'),
			// 	'land_renewal_date' => $this->input->post('land_renewal_date'),
			// 	'land_exp_date' => $this->input->post('land_exp_date'),
			// 	'material_desc' => $this->input->post('material_desc'),
			// 	'status' => 1
			// );

			// json($data_array,false);
			// json($data,false);

			$insert = $this->MY_Model->insert('vehicles', $data_array);
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



	//Enable vehicle
	public function enablevehicle()
	{
		$vehicle_id = $this->input->post('id');
		$vehicle_status = 1;
		$data = array(
			'status' => $vehicle_status
		);
		$datas['delete'] = $this->MY_Model->update('vehicles',$data,array('id' => $vehicle_id));
		echo json_encode($datas);
	}

	//Disable vehicle
	public function disablevehicle()
	{
		$vehicle_id = $this->input->post('id');
		$vehicle_status = 2;
		$data = array(
			'status' => $vehicle_status
		);
		$datas['delete'] = $this->MY_Model->update('vehicles',$data,array('id' => $vehicle_id));
		echo json_encode($datas);
	}


	//Delete vehicle
	public function deletevehicle()
	{
		$vehicle_id = $this->input->post('id');
		$vehicle_status = 3;
		$data = array(
			'status' => $vehicle_status
		);
		$datas['delete'] = $this->MY_Model->update('vehicles',$data,array('id' => $vehicle_id));
		echo json_encode($datas);
	}

	//view details for edit
	public function supplier_details(){
		$supplier_id = $this->input->post('id');
		$parameters['where'] = array('id' => $supplier_id);
		$data['view_edit'] = $this->MY_Model->getRows('supplier',$parameters,'row');
		// echo $this->db->last_query();
		echo json_encode($data);
	}



	// Edit Vehicle
	public function editVehicle()
	{
		$vehicle_id = $this->input->post('id');
			$result = false;
		if(!empty($this->input->post())){

			$data = array(
				'plate_number' => $this->input->post('plate_number'),
				'vehicle_brand' => $this->input->post('vehicle_brand'),
				'vehicle_type' => $this->input->post('vehicle_type'),
				'fuel_type' => $this->input->post('fuel_type'),
				'num_of_tires' => $this->input->post('num_of_tires'),
				'accounting_date_acquired'=> $this->input->post('accounting_date_acquired'),
				'accounting_acqui_amount'=> $this->input->post('accounting_acqui_amount'),
				'accounting_full_dep_date'=> $this->input->post('accounting_full_dep_date'),
				'accounting_monthly_dep'=> $this->input->post('accounting_monthly_dep'),
				'accounting_accum_dep' => $this->input->post('accounting_accum_dep'),
				'accounting_book_val' => $this->input->post('accounting_book_val'),
				'approx_length' => $this->input->post('approx_length'),
				'approx_width'=>$this->input->post('approx_width'),
				'approx_height' => $this->input->post('approx_height'),
				'approx_volume'=> $this->input->post('approx_volume'),
				'approx_weight'=> $this->input->post('approx_weight'),
				'van_reg_date' => $this->input->post('van_reg_date'),
				'van_policy_num' => $this->input->post('van_policy_num'),
				'van_renewal_date' => $this->input->post('van_renewal_date'),
				'van_exp_date' => $this->input->post('van_exp_date'),
				'land_reg_date' => $this->input->post('land_reg_date'),
				'land_renewal_date' => $this->input->post('land_renewal_date'),
				'land_exp_date' => $this->input->post('land_exp_date'),
				'material_desc' => $this->input->post('material_desc'),
			);

			$update = $this->MY_Model->update('vehicles', $data,array('id' => $vehicle_id));
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
	//End Edit Vehiclle

	//view details for edit(Vehicle)
	public function vehicle_details(){
		$vehicle_id = $this->input->post('id');
		$parameters['where'] = array('id' => $vehicle_id);
		$data['view_edit'] = $this->MY_Model->getRows('vehicles',$parameters,'row');
		// echo $this->db->last_query();
		echo json_encode($data);
	}


}
?>
