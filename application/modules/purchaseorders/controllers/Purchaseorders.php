<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchaseorders extends MY_Controller {

	public function __construct(){
		parent::__construct();

	}

	public function index(){
		$parameters['select'] = '*';
		$data['suppliers'] = $this->MY_Model->getRows('supplier',$parameters);

		$parameters['where'] = array('company_id !=' => 0);
		$parameters['select'] = '*';
		$data['company'] = $this->MY_Model->getRows('company',$parameters);

		$param['where'] = array('status' => 1);
		$param['select'] = '*';
		$data['products'] = $this->MY_Model->getRows('products', $param);

		$parameters1['select'] = '*';
		$parameters1['limit'] = array(1,0);;
		$parameters1['order'] = 'purchase_code DESC';
		$data['purchase'] = $this->MY_Model->getRows('purchase_orders',$parameters1);

    $this->load_page('purchaseorders', @$data);
	}

	//get suppliers and warehouse by company
	public function get_suppliers_by_companies(){
		$parameters['where'] = array('company' => $this->input->post('company_id'), 'status' => 1);
		$data['warehouse'] = $this->MY_Model->getRows('warehouse_management',$parameters);

			$parameters['where'] = array('company' => $this->input->post('company_id'), 'status' => 1);
			$data['suppliers'] = $this->MY_Model->getRows('supplier',$parameters);
			json($data);
	}

	public function get_productName_by_code(){
		$parameters['where'] = array('id' => $this->input->post('prod_id'));
		$data['products'] = $this->MY_Model->getRows('products',$parameters);

		json($data);
	}


	public function get_productName_by_code_edit(){
		$parameters['where'] = array('id' => $this->input->post('prod_id'));
		$data['products'] = $this->MY_Model->getRows('products',$parameters, 'rows');
		// echo "<pre>";
		// print_r($this->input->post());
		// exit;
		// $prod_id = $this->input->post('prod_id');
		// $parameters['select'] = 'id,(SELECT * FROM products WHERE id = '.$prod_id.' ) as product';
		// $parameters['where'] = array('id' => $this->input->post('purchase_id'));
		// $data['products'] = $this->MY_Model->getRows('purchase_orders',$parameters);
		// echo "<pre>";
		// print_r($datas);
		// exit;
		// $data['edit_purch_prod'] = $this->MY_Model->getRows('purchase_orders',$parameters);

		json($data);
	}

	public function get_suppliers(){
		$params['where'] = array('status' => 1);
			$data['suppliers'] = $this->MY_Model->getRows('supplier', $params);
			json($data);
	}

	public function get_warehouse(){
			$params['where'] = array('status' => 1);
			$data['warehouse'] = $this->MY_Model->getRows('warehouse_management', $params);
			json($data);
	}

	public function get_products(){
			$params['where'] = array('status' => 1);
			$data['products'] = $this->MY_Model->getRows('products', $params);
			json($data);
	}

	public function get_edit_products(){
		$params['where'] = array('status' => 1);
		$data['products'] = $this->MY_Model->getRows('products', $params);
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

		$output = array(
				"draw" => $draw,
				"recordsTotal" => $list['count_all'],
				"recordsFiltered" => $list['count'],
				"data" => $list['data']
		);

		echo json_encode($output);
	}



	public function addPurchaseOrder(){
		$post = $this->input->post();

		$warehouse = explode('|', $post['warehouse']);
		$warehouse_id = $warehouse[0];
		$warehouse_name = isset($warehouse[1]);

		$date_ordered = date("F d, Y");
		$id = $this->input->post('purchase_id');
		$purchase_id = $id + 1;
		$code = sprintf('%04d',$purchase_id);
		$this->load->library("form_validation");

		$this->form_validation->set_rules('prod_code[]', 'SKU', 'required');
		$this->form_validation->set_rules('prod_name[]', 'Product Name', 'required');
		$this->form_validation->set_rules('quantity[]', 'Quantity', 'required');
		$this->form_validation->set_rules('supplier', 'Supplier', 'required');
		$this->form_validation->set_rules('warehouse', 'Warehouse', 'required');
		$this->form_validation->set_rules('company', 'Company', 'required');
		$this->form_validation->set_rules('unit_price[]', 'Unit Price', 'required');
		$this->form_validation->set_rules('total[]', 'Total', 'required');
		$error = array();

		foreach($post['prod_code'] as $pkey => $pVal){
		if ($this->form_validation->run() !== FALSE) {

				$data = array(
					'date_ordered' => $date_ordered,
					'purchase_code' => $code,
					'product' => $pVal,
					'quantity' => $post['quantity'][$pkey],
					'unit_price' => $post['unit_price'][$pkey],
					'supplier' => $post['supplier'],
					'warehouse_id' => $warehouse[0],
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

		$warehouse = explode('|', $post['warehouse_edit']);
		$warehouse_id = $warehouse[0];
		$warehouse_name = isset($warehouse[1]);

		$this->load->library("form_validation");

		$this->form_validation->set_rules('edit_prod_code[]', 'SKU', 'required');
		$this->form_validation->set_rules('edit_prod_name[]', 'Product Name', 'required');
		$this->form_validation->set_rules('edit_quantity[]', 'Quantity', 'required');
		$this->form_validation->set_rules('edit_unit_price[]', 'Unit Price', 'required');
		$this->form_validation->set_rules('edit_total[]', 'Total', 'required');
		$error = array();


			if(!empty($post['edit_prod_code'])){
					foreach($post['edit_prod_code'] as $pkey => $pVal){
						if ($this->form_validation->run() !== FALSE) {
								$data = array(
								'date_ordered' => $date_ordered,
								'purchase_code' => $post['edit_purchase_code'],
								'note' => $post['purchase_note'],
								'product' => $pVal,
								'quantity' => $post['edit_quantity'][$pkey],
								'unit_price' => $post['edit_unit_price'][$pkey],
								'company' => $post['company_edit'],
								'supplier' => $post['supplier_edit'],
								'warehouse_id' => $warehouse[0],
								'status' => 1,
								'delivery_status' => 1
							);
							$add = $this->MY_Model->insert('purchase_orders', $data,array('purchase_code' => $post['edit_purchase_code']));
							if ($add) {
								$response = array(
									'status' => 'ok'
								);
							}
				}else{
					$response = array('form_error' =>  array_merge($this->form_validation->error_array(), $error) );
				}
				}
			}
				$data = array(
					'company' => $post['company_edit'],
					'supplier' => $post['supplier_edit'],
					'warehouse_id' => $warehouse[0],
					'note' => $post['purchase_note'],
				);
				$update1 = $this->MY_Model->update('purchase_orders', $data, array('purchase_code' => $post['edit_purchase_code']));


				foreach($post['edit_purchase_id_select'] as $pkey => $pVal){
					$data = array(
						'product' => $post['prod_code'][$pkey],
						'quantity' => $post['quantity'][$pkey],
						'unit_price' => $post['unit_price'][$pkey],
					);
					$update = $this->MY_Model->update('purchase_orders', $data, array('id' => $post['edit_purchase_id_select'][$pkey]));
					if ($update) {
						$response = array(
							'status' => 'ok'
						);
					}	else if ($update1) {
						$response = array(
							'status' => 'ok'
						);
					}

			}
		echo json_encode($response);

	}

	public function purchase_details(){
		$purchase_id = $this->input->post('id');

		$parameters['where'] = array('purchase_code' => $purchase_id);
		// $parameters['group'] = array('purchase_code');
		$parameters['join'] = array('company' => 'company.company_id = purchase_orders.company','supplier' => 'supplier.id = purchase_orders.supplier', 'products' => 'products.id = purchase_orders.product');
		$parameters['select'] = 'purchase_orders.*, purchase_orders.id AS purchase_id, supplier.id AS supplier_id, supplier.*, company.*,products.id AS product_id, products.*';

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
		$parameters['join'] = array('company' => 'company.company_id = purchase_orders.company',
								'supplier' => 'supplier.id = purchase_orders.supplier',
								'products' => 'products.id = purchase_orders.product',
								'warehouse_management' => 'warehouse_management.id = purchase_orders.warehouse_id'  );
		$parameters['select'] = 'purchase_orders.*, purchase_orders.id AS purchase_id, supplier.id AS supplier_id, supplier.*, company.*, products.id AS product_id, products.*, warehouse_management.wh_name';

		$data = $this->MY_Model->getRows('purchase_orders',$parameters);

		$data_array['purchase'] = $data;
		// exit;

		json($data_array);
	}

	//change delivered quantity on purchase Orders
	public function change_delivered_qty(){
		$post = $this->input->post();
		$delivered_date = date("F d, Y");

		// if($post['delivery_status'] == 4){
		// 	$data = array('code' => $post['code'], 'product' => $post['product']);
		// 	$data['addStocks'] = $this->MY_Model->insert('stocks',$data);
		// }
		$data = array('delivered' => $post['delivered'], 'date_delivered' => $delivered_date);
		$data['delivered_qty'] = $this->MY_Model->update('purchase_orders', $data, array('id' => $post['id']));
		json($data);

	}

	//view delivery Status
	public function view_deliv_status(){
		$post = $this->input->post();

		$parameters['where'] = array('purchase_code' => $post['id']);
		$parameters['join'] = array('products' => 'products.id = purchase_orders.product');
		$parameters['select'] = 'purchase_orders.*, products.code';

		$data['delivery'] = $this->MY_Model->getRows('purchase_orders',$parameters,'row');

		json($data);
	}

	//change delivery Status
	public function change_deliv_status(){
		$post = $this->input->post();

		if($post['delivery_status'] == 2){
			$remarks = empty($post['remarks_deliv']) ? "None" : $post['remarks_deliv'];
		}else if($post['delivery_status'] == 3){
			$remarks = empty($post['remarks_deliv']) ? "None" : $post['remarks_deliv'];
		}else if($post['delivery_status'] == 4){
			$remarks = empty($post['remarks_deliv']) ? "None" : $post['remarks_deliv'];
		}else{
			$remarks = empty($post['remarks_deliv']) ? "None" : $post['remarks_deliv'];
		}

		$data = array('delivery_status' => $post['delivery_status'], 'delivery_remarks' => $remarks);

		$data['delivStat'] = $this->MY_Model->update('purchase_orders', $data, array('purchase_code' => $post['purchase_code_delivery']));

		$params['where'] = array('product' => $post['product'], 'warehouse_id' => $post['warehouse_id']);
		$params['select'] = '*';
		$res = $this->MY_Model->getRows('stocks', $params,'row');
		$last = $this->db->last_query();
// echo "<pre>";
// print_r($last);
// exit;
		if ($res == '') {
			$data_stocks = array('product' => $post['product'], 'code' => $post['code'], 'warehouse_id' => $post['warehouse_id'], 'stock_out' => $post['quantity']);
				$data['prodToStocks'] = $this->MY_Model->insert('stocks',$data_stocks);
		}


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
		if($post['status'] == 2){

			$remarks = empty($post['remarks']) ? "None" : $post['remarks'];
		}else if($post['status'] == 3){
			$remarks = empty($post['remarks']) ? "None" : $post['remarks'];
		}else{
			$remarks = empty($post['remarks']) ? "None" : $post['remarks'];
		}

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

	public function get_sku(){
		$data = $this->MY_Model->getRows('products');

		echo json_encode($data);
	}
}
