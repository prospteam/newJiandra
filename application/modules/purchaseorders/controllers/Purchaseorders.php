<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchaseorders extends MY_Controller {

	public function __construct(){
		parent::__construct();

	}

	public function index(){
		$parameters['select'] = '*';
		$data['suppliers'] = $this->MY_Model->getRows('supplier',$parameters);

		$parameters['select'] = '*';
		$data['company'] = $this->MY_Model->getRows('company',$parameters);

		$parameters1['select'] = '*';
		$parameters1['limit'] = array(1,0);;
		$parameters1['order'] = 'purchase_code DESC';
		$data['purchase'] = $this->MY_Model->getRows('purchase_orders',$parameters1);

    $this->load_page('purchaseorders', @$data);
	}

	public function get_suppliers_by_companies(){
			$parameters['where'] = array('company' => $this->input->post('company_id'));
			$data['suppliers'] = $this->MY_Model->getRows('supplier',$parameters);
			json($data);
	}

	public function get_suppliers(){
			$data['suppliers'] = $this->MY_Model->getRows('supplier');
			json($data);
	}

	//display purchase orders
	public function display_purchase_orders(){
		$limit = $this->input->post('length');
		$offset = $this->input->post('start');
		$search = $this->input->post('search');
		$order = $this->input->post('order');
		$draw = $this->input->post('draw');


		$column_order = array('date_ordered','purchase_code','company.company_name','supplier.supplier_name');
		$where = array();
		$group = array('purchase_orders.purchase_code');
		$join = array(
			'supplier' => 'supplier.id = purchase_orders.supplier',
			'company' => 'company.company_id = purchase_orders.company'
		);
		$select = "purchase_orders.id AS purchase_id, purchase_orders.date_ordered,purchase_orders.purchase_code,company.company_id, company.company_name, supplier.id,supplier.supplier_name,purchase_orders.status,purchase_orders.delivery_status";
		$list = $this->MY_Model->get_datatables('purchase_orders',$column_order, $select, $where, $join, $limit, $offset ,$search, $order, $group);


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
		// echo "<pre>";
		// print_r($output);
		// exit;

		echo json_encode($output);
	}


	public function addPurchaseOrder(){
		$post = $this->input->post();

		$date_ordered = date("F d, Y");
		$id = $this->input->post('purchase_id');
		$purchase_id = $id + 1;
		$code = sprintf('%04d',$purchase_id);

		$this->load->library("form_validation");

		$this->form_validation->set_rules('prod_name[]', 'Product Name', 'required');
		$this->form_validation->set_rules('quantity[]', 'Quantity', 'required');
		$this->form_validation->set_rules('supplier', 'Supplier', 'required');
		$this->form_validation->set_rules('company', 'Company', 'required');
		$this->form_validation->set_rules('unit_price[]', 'Unit Price', 'required');
		$this->form_validation->set_rules('total[]', 'Total', 'required');
		$error = array();


		// if(empty($this->input->post('company[]'))){
		// 	$error['company'] = 'The Companies field is required.';
		// }

		foreach($post['prod_name'] as $pkey => $pVal){
		if ($this->form_validation->run() !== FALSE) {

				$data = array(
					'date_ordered' => $date_ordered,
					'purchase_code' => $code,
					'product' => $pVal,
					'quantity' => $post['quantity'][$pkey],
					'unit_price' => $post['unit_price'][$pkey],
					'supplier' => $post['supplier'],
					'company' => $post['company'],
					'status' => 1,
					'delivery_status' => 1
				);

				$insert = $this->MY_Model->insert('purchase_orders', $data);
				if ($insert) {
					$response = array(
						'status' => 'ok'
					);
				}
			}else{
				$response = array('form_error' =>  array_merge($this->form_validation->error_array(), $error) );
			}
		}


		echo json_encode($response);
	}

	// edit purchase Orders
	public function edit_purchase_orders(){
		$post = $this->input->post();
		// if(!empty($post)) {
			foreach($post['purchase_id'] as $pkey => $pVal){
				$data = array(
						'product' => $post['prod_name'][$pkey],
						'ordered' => $post['ordered'][$pkey],
						'supplier' => $post['supplier'][$pkey],
					);
					$update = $this->MY_Model->update('purchase_orders', $data, array('id' => $post['purchase_id'][$pkey]));
							if ($update) {
								$response = array(
									'status' => 'ok'
								);
							}


			// }
		}
		//
		// if(!empty($post)) {
		// 	foreach($post['prod_name'] as $pkey => $pVal){
		// 		if ($this->form_validation->run() !== FALSE) {
		// 			$data = array(
		// 				'product' => $pVal,
		// 				'ordered' => $post['ordered'][$pkey],
		// 				'supplier' => $post['supplier'][$pkey],
		// 			);
		// 			$update = $this->MY_Model->update('purchase_orders', $data, array('id' => $post['purchase_id'][$pKey]));
		// 			if ($update) {
		// 				$response = array(
		// 					'status' => 'ok'
		// 				);
		// 			}
		// 		}else{
		// 			$response = array('form_error' =>  array_merge($this->form_validation->error_array(), $error) );
		// 		}
		// 	}
		// }

		echo json_encode($response);

	}

	public function purchase_details(){
		$purchase_id = $this->input->post('id');

		$parameters['where'] = array('purchase_code' => $purchase_id);
		// $parameters['group'] = array('purchase_code');
		$parameters['join'] = array('supplier' => 'supplier.id = purchase_orders.supplier');
		$parameters['select'] = 'purchase_orders.*, purchase_orders.id AS purchase_id, supplier.id AS supplier_id, supplier.*';

		$data['purch_details'] = $this->MY_Model->getRows('purchase_orders', $parameters);
		// echo "<pre>";
		// print_r($data);
		// exit;
			echo json_encode($data);
	}
	//view list of orders
	public function view_purchase_orders(){
		$purchase_id = $this->input->post('id');

		$parameters['where'] = array('purchase_code' => $purchase_id);
		// $parameters['group'] = array('purchase_code');
		$parameters['join'] = array('company' => 'company.company_id = purchase_orders.company','supplier' => 'supplier.id = purchase_orders.supplier' );
		$parameters['select'] = '*';

		$data = $this->MY_Model->getRows('purchase_orders',$parameters);

		$data_array['purchase'] = $data;
		// exit;

		json($data_array);
	}

}
