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

				$company_name = $this->input->post('company');
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
					// $this->form_validation->set_rules('supplier_contact_person', 'Supplier Contact Person', 'required');
					$this->form_validation->set_rules('contact_name','Name');
					$this->form_validation->set_rules('mobile_number','Mobile Number');
					$this->form_validation->set_rules('contact_email','Email');
					$this->form_validation->set_rules('supp_position','Position');
					$this->form_validation->set_rules('company[]', 'Company', 'required');
					$this->form_validation->set_rules('email','Email','required');
					$this->form_validation->set_rules('address','Address','required');
					$this->form_validation->set_rules('office_number', 'Office Number', 'required');
					$this->form_validation->set_rules('fax_number', 'Fax Number', 'required');
					$this->form_validation->set_rules('tin_number', 'TIN', 'required');

					if ($this->form_validation->run() !== FALSE) {

							if(count($company_name) >= 1){

								$array = array();
								for ($i=0; $i < count($this->input->post('contact_name')) ; $i++) {
									$array[] = array(
										"contact_name" => $this->input->post('contact_name')[$i],
										"mobile_number" => $this->input->post('mobile_number')[$i],
										"contact_email" => $this->input->post('contact_email')[$i],
										"supp_position" => $this->input->post('supp_position')[$i],
									);
								}
									foreach ($company_name as $key => $value) {
										$data = array(
											'supplier_logo' 						=> $uploadData['file_name'],
											'supplier_name' 						=> $this->input->post('supplier_name'),
											'company' 									=> $value,
											'email'                     => $this->input->post('email'),
											'address'                   => $this->input->post('address'),
											'office_number' 						=> $this->input->post('office_number'),
											'fax_number' 								=> $this->input->post('fax_number'),
											'tin_number' 								=> $this->input->post('tin_number'),
											'contact_info'							=> json_encode($array),
											'status' 										=> 1
										);

										$insert = $this->MY_Model->insert('supplier', $data);
										if ($insert) {
											$response = array(
												'status' => 'ok'
											);
										}
									}
								}
						}else{
							$array = array();
							for ($i=0; $i < count($this->input->post('contact_name')) ; $i++) {
								$array[] = array(
									"contact_name" => $this->input->post('contact_name')[$i],
									"mobile_number" => $this->input->post('mobile_number')[$i],
									"contact_email" => $this->input->post('contact_email')[$i],
									"supp_position" => $this->input->post('supp_position')[$i],
								);
							}
								$data = array(
									'supplier_logo' 						=> $uploadData['file_name'],
									'supplier_name' 						=> $this->input->post('supplier_name'),
									'company' 									=> $this->input->post('company'),
									'email'                     => $this->input->post('email'),
									'address'                   => $this->input->post('address'),
									'office_number' 						=> $this->input->post('office_number'),
									'fax_number' 								=> $this->input->post('fax_number'),
									'tin_number' 								=> $this->input->post('tin_number'),
									'contact_info'							=> json_encode($array),
									'status' 										=> 1
									// 'vendor' => $this->input->post('vendor'),
									// 'company' => implode(',',$this->input->post('company')),
								);

								$insert = $this->MY_Model->insert('supplier', $data);
								if ($insert) {
									$response = array(
										'status' => 'ok'
									);
								}
							}

				}else{


					$this->load->library("form_validation");
					$this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required');
					$this->form_validation->set_rules('contact_name', 'Name');
					$this->form_validation->set_rules('mobile_number', 'Mobile Number');
					$this->form_validation->set_rules('contact_email', 'Email');
					$this->form_validation->set_rules('supp_position', 'Position');
					$this->form_validation->set_rules('company[]', 'Company', 'required');
					$this->form_validation->set_rules('email','Email','required');
					$this->form_validation->set_rules('address','Address','required');
					$this->form_validation->set_rules('office_number', 'Office Number', 'required');
					$this->form_validation->set_rules('fax_number', 'Fax Number', 'required');
					$this->form_validation->set_rules('tin_number', 'TIN', 'required');

					// $this->form_validation->set_rules('vendor', 'Vendor', 'required');

					if ($this->form_validation->run() !== FALSE) {

									if(count($company_name) >= 1){
										$array = array();
										for ($i=0; $i < count($this->input->post('contact_name')) ; $i++) {
											$array[] = array(
												"contact_name" => $this->input->post('contact_name')[$i],
												"mobile_number" => $this->input->post('mobile_number')[$i],
												"contact_email" => $this->input->post('contact_email')[$i],
												"supp_position" => $this->input->post('supp_position')[$i],
											);
										}
										foreach ($company_name as $key => $value) {

											 $data = array(
 												'supplier_logo' 							=> 1,
 												'supplier_name' 							=> $this->input->post('supplier_name'),
 												'company' 										=> $value,
 												'email' 						        	=> $this->input->post('email'),
 												'address' 										=> $this->input->post('address'),
 												'office_number' 							=> $this->input->post('office_number'),
 												'fax_number' 									=> $this->input->post('fax_number'),
 												'tin_number' 									=> $this->input->post('tin_number'),
												'contact_info'						  	=> json_encode($array),
 												'status' 											=> 1
												// 'vendor' => $this->input->post('vendor'),
 											);

 											$insert = $this->MY_Model->insert('supplier', $data);
 											if ($insert) {
 												$response = array(
 													'status' => 'ok'
 												);
 											}
										}

									}else{
										$array = array();
										for ($i=0; $i < count($this->input->post('contact_name')) ; $i++) {
											$array[] = array(
												"contact_name" => $this->input->post('contact_name')[$i],
												"mobile_number" => $this->input->post('mobile_number')[$i],
												"contact_email" => $this->input->post('contact_email')[$i],
												"supp_position" => $this->input->post('supp_position')[$i],
											);
										}
										 $data = array(
											 'supplier_logo' 								=> 1,
											 'supplier_name' 								=> $this->input->post('supplier_name'),
											 'company' 									  	=> $value,
											 'email' 						          	=> $this->input->post('email'),
											 'address' 									  	=> $this->input->post('address'),
											 'office_number' 						  	=> $this->input->post('office_number'),
											 'fax_number' 									=> $this->input->post('fax_number'),
											 'tin_number' 									=> $this->input->post('tin_number'),
											 'contact_info'						    	=> json_encode($array),
											 'status' 									  	=> 1
											 // 'vendor' => $this->input->post('vendor'),
										 );

										 $insert = $this->MY_Model->insert('supplier', $data);
										 if ($insert) {
											 $response = array(
												 'status' => 'ok'
											 );
										 }
									}


					}else{
						$response = array('form_error' => $this->form_validation->error_array());
					}
				}

					echo json_encode($response);
			}
		}


	//display all suppliers
	public function display_suppliers($id){

		$limit = $this->input->post('length');
		$offset = $this->input->post('start');
		$search = $this->input->post('search');
		$order = $this->input->post('order');
		$draw = $this->input->post('draw');

		$column_order = array('supplier_logo','supplier_name','email');
		if($id == 0){
			$where = array('status !=' => 3);
		}else{
			$where = array('company' => $id, 'status !=' => 3);
		}
		$join = array(
			// 'company' => 'company.company_id = supplier.company'
		);

		$select = "id,supplier_logo,supplier_name,email,status";
		$list = $this->MY_Model->get_datatables('supplier',$column_order, $select,$where, $join, $limit, $offset ,$search, $order);

		$output = array(
				"draw" => $draw,
				"recordsTotal" => $list['count_all'],
				"recordsFiltered" => $list['count'],
				"data" => $list['data']
		);

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
		$data_array['contact_info'] = json_decode($data->contact_info);
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
	//Permanently Delete user
// 	public function deleteSupplier()
// 	{
// 		$supplier_id = $this->input->post('id');
// 		$supplier_status = 3;
// 		$data = array(
// 			'status' => $supplier_status
// 		);
// 		$datas['delete'] = $this->MY_Model->update('supplier',$data,array('id' => $supplier_id));
// 		echo json_encode($datas);
// 	}
// }
	//view details for edit
	public function supplier_details(){
		// $supplier_id = $this->input->post('id');
		// $parameters['where'] = array('id' => $supplier_id);
		// $data['view_edit'] = $this->MY_Model->getRows('supplier',$parameters,'row');
		// // echo $this->db->last_query();
		// echo json_encode($data);
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
		$data_array['contact_info'] = json_decode($data->contact_info);
		$data_array['company'] = $data_company;

		json($data_array);
	}

	// Edit Supplier
	public function editSupplier(){
			if ($_SERVER['REQUEST_METHOD']==='POST') {
				$upload_path = './assets/images/supplierLogo';
				$time = date('ymdhis');
				if (!empty($_FILES['logo']['name'])) {

					$file_name = explode('.',$_FILES['logo']['name'])[0];
					$file_ext = explode('.',$_FILES['logo']['name'])[1];

					$config['upload_path'] = './assets/images/supplierLogo';
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['file_name'] = $file_name.$time;

					$this->upload->initialize($config);

					if ($this->upload->do_upload('logo')) {
						$uploadData = $this->upload->data();
					}
					$this->load->library("form_validation");

				$this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required');
				$this->form_validation->set_rules('contact_name', 'Name');
				$this->form_validation->set_rules('mobile_number', 'Mobile Number');
				$this->form_validation->set_rules('contact_email', 'Email');
				$this->form_validation->set_rules('supp_position', 'Position');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('address', 'Address', 'required');
				$this->form_validation->set_rules('office_number', 'Office Number', 'required');
				$this->form_validation->set_rules('fax_number', 'Fax Number', 'required');
				$this->form_validation->set_rules('tin_number', 'TIN', 'required');

			}else{
				$this->load->library("form_validation");
				}
		}
			// end edit supplier Logo

		$supplier_id = $this->input->post('id');
		$post = $this->input->post();
		$result = false;

		if(!empty($post)) {
			$array = array();
			for ($i=0; $i < count($this->input->post('contact_name')) ; $i++) {
				$array[] = array(
					"contact_name" => $this->input->post('contact_name')[$i],
					"mobile_number" => $this->input->post('mobile_number')[$i],
					"contact_email" => $this->input->post('contact_email')[$i],
					"supp_position" => $this->input->post('supp_position')[$i],
				);
			}
			$data = array(
				// 'supplier_logo' => $uploadData['file_name'],
				'supplier_name' 				  => $post['supplier_name'],
				'email'    						    =>$post['email'],
				'address'     					  =>$post['address'],
				'office_number' 					=>$post['office_number'],
				'fax_number' 							=> $post['fax_number'],
				'tin_number' 							=> $post['tin_number'],
				'contact_info'						=> json_encode($array),
				// 'company' => implode(',',$this->input->post('company')),
				// 'status' => 1
			);

			if(!empty($post['company'])) {
				$data['company'] = implode(',',$post['company']);
			}
			if(!empty($uploadData['file_name'])) {
				$data['supplier_logo'] = $uploadData['file_name'];
			}
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
			$result = json_encode($response);
		}
		die($result);
	}
	//End Edit Supplier
}


	// public function company1(){
	//
	//
	// }
