<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchaseorders extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('csvimport');
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

	public function viewaddpurchaseorder(){
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


		$this->load_page('addpurchaseorder', @$data);
	}

	public function getProductBySupplier(){
		$supplier = $this->input->post('supplier');

		$param['where'] = array('products.status' => 1 , 'supplier' => $supplier);
		$param['join'] = array('products_cost_price' => 'products_cost_price.fk_product_id = products.id');
		$param['select'] = 'products.product_name,products.code,products_cost_price.cost_price, products.unit, products.packing, products.brand, products.volume, products.category';
		$data['products'] = $this->MY_Model->getRows('products', $param);

		echo json_encode($data);
	}

	//get suppliers and warehouse by company
	public function get_suppliers_by_companies(){
		$parameters['where'] = array(
			'company' => $this->input->post('company_id'),
			'status' => 1
		);
		$data['warehouse'] = $this->MY_Model->getRows('warehouse_management',$parameters);

		$parameters['where'] = array(
			'company' => $this->input->post('company_id'),
			'status' => 1
		);
		$data['suppliers'] = $this->MY_Model->getRows('supplier',$parameters);

		json($data);
	}

	public function get_productName_by_code(){
		// $parameters['where'] = array('supplier.id' => $this->input->post('id'));
		$parameters['where'] = array('products.id' => $this->input->post('prod_id'));
		$parameters['join'] = $join = array('products_cost_price' => 'products_cost_price.fk_product_id = products.id');
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
			$supplier = $this->input->post('supplier');

			$params['where'] = array('status' => 1 , 'supplier' => $supplier);
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
			'supplier' => 'supplier.supplier_name = purchase_orders.supplier',
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

		$supplier = explode('|', $post['supplier']);
		$supplier_id = $supplier[0];
		$supplier_name = $supplier[0];

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

		// echo "<pre>";
		//  print_r($post);
		//  exit;
		if(empty($this->input->post('company[]'))){
			$error['company'] = 'The Companies field is required.';
		}

		foreach($post['prod_code'] as $pkey => $pVal){
		if ($this->form_validation->run() !== FALSE) {

				$data = array(
					'date_ordered' => $date_ordered,
					'purchase_code' => $code,
					'product' => $pVal,
					'quantity' => $post['quantity'][$pkey],
					'unit_price' => $post['unit_price'][$pkey],
					'delivered' => '0',
					'supplier' => $supplier_name,
					'warehouse_id' => $warehouse_id,
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

	public function purchase_order_edit(){


		$quantity = $this->input->post('quantity');
		$purchase_code = $this->input->post('edit_purchase_code');

		foreach($_POST['edit_purchase_id'] as $key => $value){
			$datas = array('quantity' => $quantity[$key]);
			$datas = array(
				'quantity' => $quantity[$key]
			);
			$query = $this->MY_Model->update('purchase_orders', $datas, array( 'id' => $value));
		}


		if($query) {
			$response = array(
				'status' => 'ok'
			);
		}

		json($response);
	}

	public function purchase_details(){
		$purchase_id = $this->input->post('id');


		$parameters['where'] = array('purchase_code' => $purchase_id);
		// $parameters['group'] = array('purchase_code');
		$parameters['join'] = array('company' => 'company.company_id = purchase_orders.company',
									'supplier' => 'supplier.supplier_name = purchase_orders.supplier',
									'products' => 'products.code = purchase_orders.product');
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

		$parameters['where'] = array('purchase_orders.purchase_code' => $purchase_id);
		// $parameters['group'] = array('purchase_code');
		$parameters['join'] = array('company' => 'company.company_id = purchase_orders.company',
								'supplier' => 'supplier.supplier_name = purchase_orders.supplier',
								'products' => 'products.code = purchase_orders.product',
								'warehouse_management' => 'warehouse_management.id = purchase_orders.warehouse_id'  );
		$parameters['select'] = 'purchase_orders.*, purchase_orders.id AS purchase_id, supplier.id AS supplier_id, supplier.*, company.*, products.id AS product_id, products.*, warehouse_management.wh_name';
		//
		$data = $this->MY_Model->getRows('purchase_orders', $parameters);

		$data_array['purchase'] = $data;

		json($data_array);
	}


	//view delivery Status
	public function view_deliv_status(){
		$post = $this->input->post();

		$parameters['where'] = array('purchase_code' => $post['id']);
		$parameters['join'] = array('products' => 'products.code = purchase_orders.product');
		$parameters['select'] = 'purchase_orders.*, products.code';

		$data['delivery'] = $this->MY_Model->getRows('purchase_orders',$parameters,'row');


		json($data);
	}

	//change delivery Status
	public function change_deliv_status(){
		$post = $this->input->post();
		// echo "<pre>";
		//  print_r($post);
		//  exit;
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

		$params['where'] = array(
			'product' => $post['product'],
			'warehouse_id' => $post['purchase_code_delivery']
		);
		$params['select'] = '*';
		$params_for_gettings_products_from_order['where']=array('purchase_code' => $post['purchase_code_delivery']);
		// $params_for_gettings_products_from_order['where']=array('purchase_code' => $post['purchase_code_delivery']);
		// $params_for_gettings_products_from_order['join']= array('stocks as s'=>'s.stock_id = purchase_orders.stocks');
		$params_for_gettings_products_from_order['select']='purchase_orders.id,purchase_orders.product, purchase_orders.warehouse_id, purchase_orders.purchase_code, purchase_orders.quantity, purchase_orders.delivery_status';
		$res_products_from_order = $this->MY_Model->getRows('purchase_orders', $params_for_gettings_products_from_order);

		$res = $this->MY_Model->getRows('stocks', $params,'row');
		$last = $this->db->last_query();

		foreach ($res_products_from_order as $key => $value) {
				$delived_stat = $value['delivery_status'];
				if($delived_stat == 4){
					$data_stocks = array(
						'po_id' => $value['id'],
						'code' => $value['purchase_code'],
						'product' => $value['product'],
						'warehouse_id' => $value['warehouse_id'],
						'physical_count' => 0
					);
					 $data_insert = $this->MY_Model->insert('stocks',$data_stocks);

					$data_movement = array(
						'po_id' => $value['id'],
						'stockmovement_code' => $value['purchase_code'],
					);
					$data_insert_movement = $this->MY_Model->insert('stock_movement',$data_movement);
				}
			}
		json($data);
	}

	//change delivered quantity on purchase Orders
	public function change_delivered_qty(){

			// $post = $this->input->post();
			$post = $this->input->post();
			$delivered_date = date("F d, Y");

			$code = $this->input->post('update_arrived_delivered');
			$purchase_id = $this->input->post('view_purchase_id');
			$delivered = $this->input->post('delivered');
			$prod_code = $this->input->post('view_prod_code');

			foreach ($purchase_id as $key => $value) {
			$data = array(
				'delivered' => $delivered[$key],
				'delivered' => $post['delivered'][$key],
				'date_delivered' => $delivered_date
			);
			$query = $this->MY_Model->update('purchase_orders',$data,array( 'id' => $value));

			$data1 = array(
				'physical_count' => $delivered[$key]
			);

			$query1 = $this->MY_Model->update('stocks',$data1,array( 'po_id' => $value));
			}
			if ($query) {
				$response = array(
					'status' => 'ok'
				);
			}elseif ($query1) {
				$response = array(
					'status' => 'ok'
				);
			} else {

			}
			json($response);
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

	public function import_csv(){
		$file_data = $this->csvimport->get_array($_FILES["csv_file_po"]["tmp_name"]);

		$new_array = array();

		foreach ($file_data as $key => $value) {
			foreach ($value as $key2 => $value2) {
			}
			$explode_key = explode(';', $key2);
			$explode_value = explode(';',$value2);

			$data = array(
				'date_ordered' => $explode_value[0],
				'purchase_code'  => '003',
				'product'  => '1',
				'quantity'  => $explode_value[3],
				'unit_price'  => $explode_value[4],
				'delivered'  => $explode_value[5],
				'date_delivered'  => $explode_value[6],
				'supplier'  => $explode_value[7],
				'company'  => $explode_value[8],
				'warehouse_id'  => '18',
				'note'  => '',
				'status'  => '1',
				'delivery_status'  => '1',
				'remarks'  => '',
				'delivery_remarks'  => '',
				'order_status'  => '1',
			);
			// echo "<pre>";
			//  print_r($data);
			//  exit;
			$insert = $this->MY_Model->insert('purchase_orders', $data);
		}

		if($insert){
			$response = "CSV file successfully imported";
		}else{
			$response = "Error!";
		}

		echo json_encode($response);
	}

}
