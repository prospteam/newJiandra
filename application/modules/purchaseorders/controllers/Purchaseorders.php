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

		$param['select'] = '*';
		$data['products'] = $this->MY_Model->getRows('products', $parameters);
		
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
		$where = array('purchase_orders.order_status !=' => 2);
		$group = array('purchase_orders.purchase_code');
		$join = array(
			'supplier' => 'supplier.id = purchase_orders.supplier',
			'company' => 'company.company_id = purchase_orders.company'
		);
		$select = "purchase_orders.id AS purchase_id, purchase_orders.date_ordered,purchase_orders.purchase_code,company.company_id, company.company_name, supplier.id,supplier.supplier_name,purchase_orders.status,purchase_orders.delivery_status,purchase_orders.order_status";
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
					'note' => $post['purchase_note'],
					'status' => 1,
					'delivery_status' => 1,
					'order_status' => 1
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
		$date_ordered = date("F d, Y");
		// if(!empty($post)) {
		// echo "<pre>";
		// print_r($post);
		// exit;
			if(!empty($post['edit_prod_name'])){

					foreach($post['edit_prod_name'] as $pkey => $pVal){
						$data = array(
								'date_ordered' => $date_ordered,
								'purchase_code' => $post['edit_purchase_code'],
								'note' => $post['purchase_note'],
								'product' => $pVal,
								'quantity' => $post['edit_quantity'][$pkey],
								'unit_price' => $post['edit_unit_price'][$pkey],
								'company' => $post['company_edit'],
								'supplier' => $post['supplier'],
								'status' => 1,
								'delivery_status' => 1
							);
							$add = $this->MY_Model->insert('purchase_orders', $data,array('purchase_code' => $post['edit_purchase_code']));


					// }
				}
			}

				$data = array(
					'company' => $post['company_edit'],
					'supplier' => $post['supplier'],
					'note' => $post['purchase_note'], 
				);
				$update1 = $this->MY_Model->update('purchase_orders', $data, array('purchase_code' => $post['edit_purchase_code']));


				foreach($post['edit_purchase_id'] as $pkey => $pVal){
					$data = array(
						'product' => $post['prod_name'][$pkey],
						'quantity' => $post['quantity'][$pkey],
						'unit_price' => $post['unit_price'][$pkey],
					);
					$update = $this->MY_Model->update('purchase_orders', $data, array('id' => $post['edit_purchase_id'][$pkey]));
					if ($update) {
						$response = array(
							'status' => 'ok'
						);
					}	else if ($update1) {
						$response = array(
							'status' => 'ok'
						);
					}else if ($add) {
						$response = array(
							'status' => 'ok'
						);
					}


					// }
				}


		echo json_encode($response);

	}

	public function purchase_details(){
		$purchase_id = $this->input->post('id');

		$parameters['where'] = array('purchase_code' => $purchase_id);
		// $parameters['group'] = array('purchase_code');
		$parameters['join'] = array('company' => 'company.company_id = purchase_orders.company','supplier' => 'supplier.id = purchase_orders.supplier');
		$parameters['select'] = 'purchase_orders.*, purchase_orders.id AS purchase_id, supplier.id AS supplier_id, supplier.*, company.*';

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
		$parameters['select'] = 'purchase_orders.*, purchase_orders.id AS purchase_id, supplier.id AS supplier_id, supplier.*, company.*';

		$data = $this->MY_Model->getRows('purchase_orders',$parameters);

		$data_array['purchase'] = $data;
		// exit;

		json($data_array);
	}

	//change delivered quantity on purchase Orders
	public function change_delivered_qty(){
		$post = $this->input->post();


		$data = array('delivered' => $post['delivered']);
		$data['delivered_qty'] = $this->MY_Model->update('purchase_orders', $data, array('id' => $post['id']));
		json($data);

	}

	//view delivery Status
	public function view_deliv_status(){
		$post = $this->input->post();

		$parameters['where'] = array('purchase_code' => $post['id']);
		$parameters['select'] = '*';

		$data['delivery'] = $this->MY_Model->getRows('purchase_orders',$parameters,'row');

		json($data);
	}

	//change delivery Status
	public function change_deliv_status(){
		$post = $this->input->post();

		$data = array('delivery_status' => $post['delivery_status']);
		$data['delivStat'] = $this->MY_Model->update('purchase_orders', $data, array('purchase_code' => $post['purchase_code_delivery']));
		json($data);
	}

	//view Status
	public function view_status(){
		$post = $this->input->post();

		$parameters['where'] = array('purchase_code' => $post['id']);
		$parameters['select'] = '*';

		$data['status'] = $this->MY_Model->getRows('purchase_orders',$parameters,'row');

		json($data);
	}

	//change  Status
	public function change_status(){
		$post = $this->input->post();

		$remarks = empty($post['remarks']) ? "None" : $post['remarks'];

		$data = array('status' => $post['status'], 'remarks' => $remarks);

		$data['change_status'] = $this->MY_Model->update('purchase_orders', $data, array('purchase_code' => $post['purchase_code_status']));
		// echo "<pre>";
		// print_r($data);
		// exit;
		json($data);
	}

	//view remarks
	public function view_remarks(){
		$post = $this->input->post();

		$parameters['where'] = array('purchase_code' => $post['id']);
		$parameters['select'] = '*';

		$data['remarks'] = $this->MY_Model->getRows('purchase_orders',$parameters,'row');

		json($data);
	}

	//delete purchase
	public function deletePurchaseO(){
	  $purchase_code = $this->input->post('id');
	  $purchase_status = 2;
	  $data = array(
	    'order_status' => $purchase_status
	  );
	  $datas['delete'] = $this->MY_Model->update('purchase_orders',$data,array('purchase_code' => $purchase_code));
	  echo json_encode($datas);

	}
}
