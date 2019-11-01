<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends MY_Controller
{

	public function index()
	{
		$this->load_page('supplier');
	}

	public function addsupplier()
	{
		$data = array(
			'supplier_name' => $this->input->post('supplier_name'),
			'supplier_contact_person' => $this->input->post('supplier_contact_person'),
			'company_one	' => $this->input->post('company_one'),
			'company_two' => $this->input->post('company_two'),
			'vendor' => $this->input->post('vendor'),
			'office_number' => $this->input->post('office_number'),
			'home_number' => $this->input->post('home_number'),
			'mobile_number' => $this->input->post('mobile_number'),
			'tin_number' => $this->input->post('tin_number'),
			'fax_number' => $this->input->post('fax_number')
		);

		$insert = $this->MY_Model->insert('supplier', $data);

		if ($insert) {
			$response = array(
				'type' => 'success',
				'title' => 'Success!',
				'msg' => 'Supplier added successfully'
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
