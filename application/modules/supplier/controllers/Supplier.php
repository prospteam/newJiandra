<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends MY_Controller
{

	public function index() {

		$parameters['where'] = array('position =' => 4);
		$parameters['select'] = 'id,fullname,position';
		$data['vendor'] = $this->MY_Model->getRows('users',$parameters);
		// print_r($data);
		$this->load_page('supplier', @$data);
	}

	public function addsupplier() {
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$upload_path = 'assets/images/supplierLogo/';
				$time = date('ymdhis');
				if(!empty($_FILES['logo']['name'])){

					$file_name = explode('.',$_FILES['logo']['name'])[0];
					$file_ext = explode('.',$_FILES['logo']['name'])[1];


				$config['upload_path'] = './assets/images/supplierLogo';
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['file_name'] = $file_name.$time;

				$this->upload->initialize($config);
				// File upload
				  if($this->upload->do_upload('logo')){
						$uploadData = $this->upload->data();
					}
					$this->load->library("form_validation");

					$this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required');
					$this->form_validation->set_rules('supplier_contact_person', 'Supplier Contact Person', 'required');
					// $this->form_validation->set_rules('vendor', 'Vendor', 'required');
					$this->form_validation->set_rules('office_number', 'Office Number', 'required');

					if ($this->form_validation->run() !== FALSE) {
						$data = array(
							'supplier_logo' => $uploadData['file_name'],
							'supplier_name' => $this->input->post('supplier_name'),
							'supplier_contact_person' => $this->input->post('supplier_contact_person'),
							'company' => implode(',',$this->input->post('company')),
							// 'vendor' => $this->input->post('vendor'),
							'office_number' => $this->input->post('office_number'),
							'home_number' => $this->input->post('home_number'),
							'mobile_number' => $this->input->post('mobile_number'),
							'tin_number' => $this->input->post('tin_number'),
							'fax_number' => $this->input->post('fax_number'),
							'status' => 1
						);

						$insert = $this->MY_Model->insert('supplier', $data);
						if ($insert) {
							$response = array(
								'status' => 'ok'
							);
						}
					}else{
						$response = array('form_error' => $this->form_validation->error_array());
					}
				}else{
					$this->load->library("form_validation");

					$this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required');
					$this->form_validation->set_rules('supplier_contact_person', 'Supplier Contact Person', 'required');
					// $this->form_validation->set_rules('vendor', 'Vendor', 'required');
					$this->form_validation->set_rules('office_number', 'Office Number', 'required');

					if ($this->form_validation->run() !== FALSE) {
						$data = array(
							'supplier_logo' => 1,
							'supplier_name' => $this->input->post('supplier_name'),
							'supplier_contact_person' => $this->input->post('supplier_contact_person'),
							'company' => implode(',',$this->input->post('company')),
							// 'vendor' => $this->input->post('vendor'),
							'office_number' => $this->input->post('office_number'),
							'home_number' => $this->input->post('home_number'),
							'mobile_number' => $this->input->post('mobile_number'),
							'tin_number' => $this->input->post('tin_number'),
							'fax_number' => $this->input->post('fax_number'),
							'status' => 1
						);

						$insert = $this->MY_Model->insert('supplier', $data);
						if ($insert) {
							$response = array(
								'status' => 'ok'
							);
						}
					}else{
						$response = array('form_error' => $this->form_validation->error_array());
					}
				}
					echo json_encode($response);
			}

	}


	//display suppliers
	public function display_suppliers($id){
	// 	$parameters['select'] = '*';
	// 	$data['supplier'] = $this->MY_Model->getRows('supplier',$parameters);
	// 	echo '<pre>';
	// 	print_r($data);
	// }
		$limit = $this->input->post('length');
		$offset = $this->input->post('start');
		$search = $this->input->post('search');
		$order = $this->input->post('order');
		$draw = $this->input->post('draw');


		$column_order = array('supplier_logo','supplier_name');
		$where = array("company" => $id, 'status !=' => 3);
		$join = array(
			// 'company' => 'company.company_id = supplier.company'
		);

		$select = "id,supplier_logo,supplier_name,status";
		$list = $this->MY_Model->get_datatables('supplier',$column_order, $select, $where, $join, $limit, $offset ,$search, $order);

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

	//view supplier Details
	public function view_supplier_details(){
		$supplier_id = $this->input->post('id');

		$data_array = array();

		$parameters['join'] = array(
			'company' => 'company.company_id = supplier.company'
		);
		$parameters['where'] = array('supplier.id' => $supplier_id);
		$parameters['select'] = '*';

		$data = $this->MY_Model->getRows('supplier',$parameters,'row');
		$company_id = explode(',',$data->company);

		$company_parameters['where_in'] = array('col' => 'company_id', 'value' => $company_id);
		$data_company = $this->MY_Model->getRows('company',$company_parameters);

		$data_array['supplier'] = $data;
		$data_array['company'] = $data_company;
		json($data_array);
	}

	//display companies for adding supplier
	public function add_supplier_companies(){
		$parameters['select'] = '*';
		$data['companies'] = $this->MY_Model->getRows('company',$parameters);
		echo json_encode($data);
		// print_r($data);
	}

	//display companies
	public function edit_supplier_companies(){
		$parameters['select'] = '*';
		$data['companies'] = $this->MY_Model->getRows('company',$parameters);
		echo json_encode($data);
		// print_r($data);
	}


	//Enable supplier for editing supplier
	public function enablesupplier()
	{
		$supplier_id = $this->input->post('id');
		$supplier_status = 1;
		$data = array(
			'status' => $supplier_status
		);
		$datas['delete'] = $this->MY_Model->update('supplier',$data,array('id' => $supplier_id));
		echo json_encode($datas);
	}

	//Disable user
	public function disablesupplier()
	{
		$supplier_id = $this->input->post('id');
		$supplier_status = 2;
		$data = array(
			'status' => $supplier_status
		);
		$datas['delete'] = $this->MY_Model->update('supplier',$data,array('id' => $supplier_id));
		echo json_encode($datas);
	}

	//delete Supplier
	public function deleteSupplier(){
		$supplier_id = $this->input->post('id');
		$supplier_status = 3;
		$data = array(
			'status' => $supplier_status
		);
		$datas['delete'] = $this->MY_Model->update('supplier',$data,array('id' => $supplier_id));
		// echo $this->db->last_query();
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

	// Edit Supplier
	public function editSupplier()
	{
		$supplier_id = $this->input->post('id');
			$data = array(
				'supplier_name' => $this->input->post('supplier_name'),
				'supplier_contact_person' => $this->input->post('supplier_contact_person'),
				'company'=>$this->input->post('çompany'),
				'office_number' => $this->input->post('office_number'),
				'home_number' => $this->input->post('home_number'),
				'mobile_number' => $this->input->post('mobile_number'),
				'tin_number' => $this->input->post('tin_number'),
				'fax_number' => $this->input->post('fax_number'),
				// 'company' => implode(',',$this->input->post('company')),
				// 'status' => 1
			);

			$update = $this->MY_Model->update('supplier', $data,array('id' => $supplier_id));
			if ($update) {
				$response = array(
					'status' => 'ok'
				);
			}else{
				$response = array(
					'status' => 'invalid'
				);
			}
		echo json_encode($response);
	}
	//End Edit Supplier
}

	// public function company1(){
	//
	//
	// }
