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



	//display companies for adding vehicle
	public function add_vehicle_companies(){
		$parameters['where'] = array('company_id !=' => 0);
		$parameters['select'] = '*';
		$data['companies'] = $this->MY_Model->getRows('company',$parameters);
		echo json_encode($data);
		// print_r($data);
	}

	//display companies for editing  vehicle
	public function edit_vehicle_companies(){
		$parameters['where'] = array('company_id !=' => 0);
		$parameters['select'] = '*';
		$data['companies'] = $this->MY_Model->getRows('company',$parameters);
		echo json_encode($data);
		// print_r($data);
	}


	//view vehicle Details
	public function view_vehicle_details(){
		$vehicle_id = $this->input->post('id');
		$data_array = array();
		//
		$parameters['join'] = array(
			'company' => 'company.company_id = vehicles.company'
		);
		$parameters['where'] = array('id' => $vehicle_id);
		$parameters['select'] = '*';

		$data = $this->MY_Model->getRows('vehicles',$parameters,'row');
		$company_id = explode(',',$data->company);

		$company_parameters['where_in'] = array('col' => 'company_id', 'value' => $company_id);
		$data_company = $this->MY_Model->getRows('company',$company_parameters);

		$data_array['view_vehicles'] = $data;
		$data_array['company'] = $data_company;
		json($data_array);
	}


	//Add User
	public function addvehicle()
	{

		$this->load->library("form_validation");
		// $vehicleType = $this->input->post('vehicle_type');

		$this->form_validation->set_rules('plate_number', 'Plate Number', 'required');
		$this->form_validation->set_rules('vehicle_brand', 'Make', 'required');
		$this->form_validation->set_rules('series', 'Series', 'required');
		$this->form_validation->set_rules('body_type', 'Body Type', 'required');
		$this->form_validation->set_rules('vehicle_type', 'Vehicle Type', 'required');
		$this->form_validation->set_rules('or_no', 'OR No.', 'required');
		$this->form_validation->set_rules('cr_no', 'CR No.', 'required');
		$this->form_validation->set_rules('owner', 'Complete Owners Name', 'required');
		$this->form_validation->set_rules('company[]', 'Company', 'required');

		if ($this->form_validation->run() !== FALSE) {
			$company = implode(',',$this->input->post('company'));
			$data_array = array();
			foreach($this->input->post() as $key => $value){

					$data_array[$key] = $value;
			}
			$data_array['company'] = $company;
			$data_array['status'] = 1;
			// $data = array(
			// 	'plate_number' => $this->input->post('plate_number'),
			// 	'vehicle_brand' => $this->input->post('vehicle_brand'),
			// 	'vehicle_type' => $this->input->post('vehicle_type'),
			// 	'fuel_type' => $this->input->post('fuel_type'),
			// 	'num_of_tires' => $this->input->post('num_of_tires'),
			// 	'accounting_date_acquired' => $this->input->post('accounting_date_acquired'),
			// 	'accounting_acqui_amount' => $this->input->post('accounting_acqui_amount'),
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
		$remarks = '';
		$vehicle_status = 1;
		$data = array(
			'remarks' => $remarks,
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
		$remarks = $this->input->post('Remarks');
		$data = array(
			'remarks' => $remarks,
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
			$company = implode(',',$this->input->post('company'));
			$data_array = array();
			foreach($this->input->post() as $key => $value){
					$data_array[$key] = $value;
			}
			$data_array['company'] = $company;
			// $data = array(
			// 	'plate_number' => $this->input->post('plate_number'),
			// 	'vehicle_brand' => $this->input->post('vehicle_brand'),
			// 	'vehicle_type' => $this->input->post('vehicle_type'),
			// 	'fuel_type' => $this->input->post('fuel_type'),
			// 	'num_of_tires' => $this->input->post('num_of_tires'),
			// 	'accounting_date_acquired'=> $this->input->post('accounting_date_acquired'),
			// 	'accounting_acqui_amount'=> $this->input->post('accounting_acqui_amount'),
			// 	'accounting_full_dep_date'=> $this->input->post('accounting_full_dep_date'),
			// 	'accounting_monthly_dep'=> $this->input->post('accounting_monthly_dep'),
			// 	'accounting_accum_dep' => $this->input->post('accounting_accum_dep'),
			// 	'accounting_book_val' => $this->input->post('accounting_book_val'),
			// 	'approx_length' => $this->input->post('approx_length'),
			// 	'approx_width'=>$this->input->post('approx_width'),
			// 	'approx_height' => $this->input->post('approx_height'),
			// 	'approx_volume'=> $this->input->post('approx_volume'),
			// 	'approx_weight'=> $this->input->post('approx_weight'),
			// 	'van_reg_date' => $this->input->post('van_reg_date'),
			// 	'van_policy_num' => $this->input->post('van_policy_num'),
			// 	'van_renewal_date' => $this->input->post('van_renewal_date'),
			// 	'van_exp_date' => $this->input->post('van_exp_date'),
			// 	'land_reg_date' => $this->input->post('land_reg_date'),
			// 	'land_renewal_date' => $this->input->post('land_renewal_date'),
			// 	'land_exp_date' => $this->input->post('land_exp_date'),
			// 	'material_desc' => $this->input->post('material_desc'),
			// );

			$update = $this->MY_Model->update('vehicles', $data_array,array('id' => $vehicle_id));
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
		// $vehicle_id = $this->input->post('id');
		$vehicle_id = $this->input->post('id');
		// echo "<pre>";
		// print_r($vehicle_id);
		// exit;
		$data_array = array();
		//
		$parameters['join'] = array(
			'company' => 'company.company_id = vehicles.company'
		);
		$parameters['where'] = array('id' => $vehicle_id);
		$parameters['select'] = '*';

		$data = $this->MY_Model->getRows('vehicles',$parameters,'row');
		$company_id = explode(',',$data->company);

		$company_parameters['where_in'] = array('col' => 'company_id', 'value' => $company_id);
		$data_company = $this->MY_Model->getRows('company',$company_parameters);

		$data_array['vehicles'] = $data;
		$data_array['company'] = $data_company;
		json($data_array);

		// $parameters['where'] = array('id' => $vehicle_id);
		// $data['view_edit'] = $this->MY_Model->getRows('vehicles',$parameters,'row');
		// // echo $this->db->last_query();
		// echo json_encode($data);
	}

	public function listvehiclebrands_add()
	{
			$post = $this->input->post();
			$result = false;

			if (!empty($post)) {
					$postLike = !empty($post['searchfor']['term']) ? $post['searchfor']['term'] : '';

					$where = $post['search_type'] == 'vehicle_brand' ? "vehicle_brand LIKE '%" . $postLike . "%'" : "fuel_type LIKE '%" . $postLike . "%'";
					$select = $post['search_type'] == 'vehicle_brand' ? "vehicle_brand AS vehicle_id, vehicle_brand" : "fuel_type AS vehicle_id, fuel_type AS vehicle_brand";
					$group = "GROUP BY " . $post['search_type'] . " ORDER BY " . $post['search_type'] . " ASC";

					$list = $this->MY_Model->getRowByQuery("SELECT $select FROM " . $this->tables->vehicles . " WHERE $where AND status = 1 $group");
					$result['items'] = $list;
			}

			die(json_encode($result));
	}

	public function listvehiclebrands_edit()
	{
			$post = $this->input->post();
			$result = false;

			if (!empty($post)) {
					$postLike = !empty($post['searchfor']['term']) ? $post['searchfor']['term'] : '';
					$where = $post['search_type'] == 'vehicle_brand' ? "vehicle_brand LIKE '%" . $postLike . "%'" : "fuel_type LIKE '%" . $postLike . "%'";
					$select = $post['search_type'] == 'vehicle_brand' ? "vehicle_brand AS vehicle_id, vehicle_brand" : "fuel_type AS vehicle_id, fuel_type AS vehicle_brand";
					$group = "GROUP BY " . $post['search_type'] . " ORDER BY " . $post['search_type'] . " ASC";

					$list = $this->MY_Model->getRowByQuery("SELECT $select FROM " . $this->tables->vehicles . " WHERE $where AND status = 1 $group");
					$result['items'] = $list;
			}

			die(json_encode($result));
	}

	public function bodytype_add()
	{
			$post = $this->input->post();
			$result = false;

			if (!empty($post)) {
					$postLike = !empty($post['searchfor']['term']) ? $post['searchfor']['term'] : '';

					$where = $post['search_type'] == 'body_type' ? "body_type LIKE '%" . $postLike . "%'" : "none";
					$select = $post['search_type'] == 'body_type' ? "body_type AS vehicle_id, body_type" : "none";
					$group = "GROUP BY " . $post['search_type'] . " ORDER BY " . $post['search_type'] . " ASC";

					$list = $this->MY_Model->getRowByQuery("SELECT $select FROM " . $this->tables->vehicles . " WHERE $where AND status = 1 $group");
					$result['items'] = $list;
			}

			die(json_encode($result));
	}

	public function bodytype_edit()
	{
			$post = $this->input->post();
			$result = false;

			if (!empty($post)) {
					$postLike = !empty($post['searchfor']['term']) ? $post['searchfor']['term'] : '';

					$where = $post['search_type'] == 'body_type' ? "body_type LIKE '%" . $postLike . "%'" : "none";
					$select = $post['search_type'] == 'body_type' ? "body_type AS vehicle_id, body_type" : "none";
					$group = "GROUP BY " . $post['search_type'] . " ORDER BY " . $post['search_type'] . " ASC";

					$list = $this->MY_Model->getRowByQuery("SELECT $select FROM " . $this->tables->vehicles . " WHERE $where AND status = 1 $group");
					$result['items'] = $list;
			}

			die(json_encode($result));
	}

	//add remarks when vehicle is inactive
	public function addremarks_inactive(){
		$post = $this->input->post();
		$remarks = empty($post['remarks']) ? "None" : $post['remarks'];

		$data = array('remarks' => $remarks);

		$data['add_remarks'] = $this->MY_Model->update('vehicles', $data, array('id' => $post['id']));

		// echo "<pre>";
		// print_r($data);
		// exit;
		json($data);
	}

	//view remarks
	public function view_remarks_inactive(){
		$post = $this->input->post();

		$parameters['where'] = array('id' => $post['id']);
		$parameters['select'] = 'id,remarks,status';

		$data['remarks'] = $this->MY_Model->getRows('vehicles',$parameters,'row');

		json($data);
	}

}
?>
