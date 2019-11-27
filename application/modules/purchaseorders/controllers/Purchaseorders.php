<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchaseorders extends MY_Controller {

	public function __construct(){
		parent::__construct();

	}

	public function index(){
		$parameters['select'] = '*';
		$data['suppliers'] = $this->MY_Model->getRows('supplier',$parameters);

		$parameters1['select'] = '*';
		$parameters1['limit'] = array(1,0);;
		$parameters1['order'] = 'purchase_code DESC';
		$data['purchase'] = $this->MY_Model->getRows('purchase_orders',$parameters1);

    $this->load_page('purchaseorders', @$data);
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


		$column_order = array('date_ordered','purchase_code','supplier.supplier_name');
		$where = array();
		$group = array('purchase_orders.purchase_code');
		$join = array(
			'supplier' => 'supplier.id = purchase_orders.supplier',
		);
		$select = "purchase_orders.id AS purchase_id ,purchase_orders.date_ordered,purchase_orders.purchase_code,supplier.id,supplier.supplier_name,purchase_orders.status,purchase_orders.delivery_status";
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
		// echo "<pre>";
		// print_r($post);
		// exit;
		$date_ordered = date("F d, Y");
		$id = $this->input->post('purchase_id');
		$purchase_id = $id + 1;
		$code = sprintf('%04d',$purchase_id);

		$this->load->library("form_validation");

		$this->form_validation->set_rules('prod_name[]', 'Product Name', 'required');
		$this->form_validation->set_rules('ordered[]', 'Ordered', 'required');
		$this->form_validation->set_rules('supplier[]', 'Supplier', 'required');
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
					'ordered' => $post['ordered'][$pkey],
					'supplier' => $post['supplier'][$pkey],
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

	public function purchase_details(){
		$purchase_id = $this->input->post('id');

		$parameters['where'] = array('id' => $purchase_id);
		$parameters['select'] = '*';

		$data['purch_details'] = $this->MY_Model->getRows('purchase_orders', $parameters);

			echo json_encode($data);
	}
	//view list of orders
	public function view_purchase_orders(){
		$purchase_id = $this->input->post('id');

		$parameters['where'] = array('purchase_code' => $purchase_id);
		// $parameters['group'] = array('purchase_code');
		$parameters['select'] = '*';

		$data = $this->MY_Model->getRows('purchase_orders',$parameters);

		$data_array['purchase'] = $data;
		// exit;
		json($data_array);
	}
}
