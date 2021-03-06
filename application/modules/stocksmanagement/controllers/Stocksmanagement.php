<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocksmanagement extends MY_Controller {

	public function __construct(){
		parent::__construct();

	}

  public function index(){
	  	//select from warehouse
		$parameters['group'] 	= array('stocks.warehouse_id');
		$parameters['join'] 	= array('warehouse_management' => 'warehouse_management.id = stocks.warehouse_id');
		$parameters['select'] 	= 'stocks.warehouse_id, warehouse_management.wh_name';
		$data['from_warehouse'] = $this->MY_Model->getRows('stocks',$parameters);

		//select to warehouse
		$param1['where']			= array('status' => 1);
		$data['to_warehouse'] 	= $this->MY_Model->getRows('warehouse_management',$param1);
		//get delivery Personnel
		$param2['where'] = array('position' => 6);
		$data['deliv_users'] = $this->MY_Model->getrows('users',$param2);

		// get all products
		$parameters['group']	= array('stocks.warehouse_id');
		$param['select'] 		= 'product,stock_id,physical_count,warehouse_id,code';
		$data['products'] 		= $this->MY_Model->getRows('stocks', $param);
		// $param['select'] = '*';
		// $data['products'] = $this->MY_Model->getRows('products', $parameters);
    //
		// $parameters1['select'] = '*';
		// $parameters1['limit'] = array(1,0);;
		// $parameters1['order'] = 'purchase_code DESC';
		// $data['purchase'] = $this->MY_Model->getRows('purchase_orders',$parameters1);
		$parameters1['select'] 	= '*';
		$parameters1['limit'] 	= array(1,0);
		$parameters1['order'] 	= 'stockmovement_code DESC';
		$data['stockmovement'] 	= $this->MY_Model->getRows('stock_movement',$parameters1);

		//Select Purchase Code
		$parameters2['select'] 	= 'purchase_code';
		$parameters2['where'] 	= array('delivery_status' => '4');
		$parameters2['group'] 	= 'purchase_code';
		$data['purchase_orders'] 	= $this->MY_Model->getRows('purchase_orders',$parameters2);

    	$this->load_page('stocksmanagement', $data);
	}

	public function stock_movement_code(){

		$code = $this->input->post('code');

		$parameters2['join']	= array(
			'products' => 'products.code = purchase_orders.product',
			'stocks' => 'stocks.po_id = purchase_orders.id',
			'stock_movement' => 'stocks.po_id = stock_movement.po_id'
		 );

		$parameters2['select'] 	= 'purchase_orders.id,purchase_orders.product,stocks.physical_count,products.product_name,stock_movement.quantity';
		$parameters2['where'] 	= array(
										'purchase_orders.purchase_code' => $code,
									);
		$data['stock_by_code'] 	= $this->MY_Model->getRows('purchase_orders',$parameters2);

		echo json_encode($data);
	}

  	//display delivered products
	public function display_delivered_products(){
		$limit 	= $this->input->post('length');
		$offset = $this->input->post('start');
		$search = $this->input->post('search');
		$order 	= $this->input->post('order');
		$draw 	= $this->input->post('draw');

		$column_order 	= array('p.code','sup.supplier_name','p.brand','p.product_name','p.packing','po.delivered', 'po.date_delivered', 's.physical_count', 's.variance', 'po.supplier', 'po.purchase_code','po.date_delivered', 's.physical_count', 'po.warehouse_id', 'w.wh_name');
		$where			= array('po.delivery_status' => 4);
		$group 			= array('po.product', 'po.warehouse_id');
		$join 			= array(
			'products as p' => 'p.id = po.product:left',
			'supplier as sup' => 'sup.id = po.supplier:left',
			'stocks as s' => 's.product = po.product AND s.warehouse_id = po.warehouse_id:left',
			'warehouse_management as w' => 'w.id = po.warehouse_id:left'
		);
		$select 		= "po.product, (SELECT SUM(delivered) FROM purchase_orders WHERE warehouse_id = po.warehouse_id AND product = p.id) AS system_count, p.code, p.product_name, p.brand, p.packing,sup.supplier_name, po.supplier, po.purchase_code, po.date_delivered, s.physical_count, s.variance, po.warehouse_id, w.wh_name";
			$list 		= $this->MY_Model->get_datatables('purchase_orders as po',$column_order, $select, $where, $join, $limit, $offset ,$search, $order, $group);
			$output 	= array(
				"draw" => $draw,
				"recordsTotal" => $list['count_all'],
				"recordsFiltered" => $list['count'],
				"data" => $list['data']
			);

			foreach ($output['data'] as $key => $value) {
				if ($output['data'][$key]->system_count == 0) {
					unset($output['data'][$key]);
				}
			}

		echo json_encode($output);
	}

	public function display_stock_managment(){
		// echo "<pre>";
		//  print_r($_POST);
		//  exit;
		$limit = $this->input->post('length');
		$offset = $this->input->post('start');
		$search = $this->input->post('search');
		$order = $this->input->post('order');
		$draw = $this->input->post('draw');


		$column_order = array('date_ordered','purchase_code','company.company_name','supplier.supplier_name');
		$where = array('purchase_orders.delivery_status' => 4,
						'purchase_orders.status' => 2);

		$group = array('purchase_orders.purchase_code');
		$join = array(
			'supplier' => 'supplier.supplier_name = purchase_orders.supplier',
			'company' => 'company.company_id = purchase_orders.company'

			// 'stocks as s' => 's.product = product.product AND stocks.warehouse_id = purchase_orders.warehouse_id:left',
			// 'stocks' => 'stocks.physical_count = purchase_orders.quantity'
		);
		$select = "purchase_orders.id AS purchase_id, purchase_orders.date_ordered,purchase_orders.purchase_code,company.company_id, company.company_name, supplier.id,supplier.supplier_name,purchase_orders.status,purchase_orders.delivery_status,purchase_orders.order_status";
		$select = "purchase_orders.id AS purchase_id, purchase_orders.date_ordered, purchase_orders.date_delivered, purchase_orders.delivered, purchase_orders.purchase_code,company.company_id, company.company_name, supplier.id,supplier.supplier_name,purchase_orders.status,purchase_orders.delivery_status,purchase_orders.order_status";
		$list = $this->MY_Model->get_datatables('purchase_orders',$column_order, $select, $where, $join, $limit, $offset ,$search, $order, $group);

		$output = array(
				"draw" => $draw,
				"recordsTotal" => $list['count_all'],
				"recordsFiltered" => $list['count'],
				"data" => $list['data']
		);


		echo json_encode($output);
	}

	//add view reports
	public function view_reports(){
		$param['where'] 	= array('po.delivery_status' => 4);
		$param['group'] 	= array('po.product', 'po.warehouse_id',);
		$param['join'] 		= array('products as p' => 'p.id = po.product:left',
		 							'stocks as s' => 's.product = po.product AND s.warehouse_id = po.warehouse_id:left',
									 'warehouse_management as w' => 'w.id = po.warehouse_id:left');
		$param['select'] 	= "po.product, (SELECT SUM(delivered) FROM purchase_orders WHERE warehouse_id = po.warehouse_id AND product = p.id) AS system_count, p.code, p.product_name, s.stock_id, s.physical_count, s.note_stocks, po.warehouse_id, w.wh_name";
		$data['stocks'] 	=  $this->MY_Model->getRows('purchase_orders as po', $param);

		echo json_encode($data);
	}


	//add reports
	public function add_reports(){
		$post = $this->input->post();
		$date_report_generated = date("F d, Y");
		$this->load->library("form_validation");
		$this->form_validation->set_rules('physical_count[]', 'Physical Count', 'required');
		$error = array();
		foreach($post['view_prod_code'] as $pkey => $pVal){
			$variance = $post['system_count'][$pkey] - $post['physical_count'][$pkey];
				if ($this->form_validation->run() !== FALSE) {
					if(!empty($post['note'][$pkey])){
						$note = $post['note'][$pkey];
						$note = $post['note'][$pkey];
					}else{
						$note = NULL;
					}
					$data = array(
						'physical_count' => $post['physical_count'][$pkey],
						'date_report_generated' => $date_report_generated,
						'note_stocks' => $note,
						'variance' => $variance
					);

					$insert = $this->MY_Model->update('stocks', $data, array('stock_id' => $post['view_stock_id'][$pkey]));
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

	//display warehouse excluding from warehouse
	public function get_warehouse(){
		$warehouse = $this->input->post('from_warehouse_id');

		$param['where'] 	= array('id !=' => $warehouse, 'status' => 1);
		$data['warehouse']	= $this->MY_Model->getRows('warehouse_management', $param);

		json($data);
	}
	//
	// public function get_deliv_personnel(){
	// 	$user = $this->input->post('from_warehouse_id');
	//
	// 	$param['where'] 	= array('id !=' => $warehouse, 'status' => 1);
	// 	$data['warehouse']	= $this->MY_Model->getRows('warehouse_management', $param);
	//
	// 	json($data);
	// }

	//display prodducts in dropdown when adding another field for stock movement
	public function get_productsSO(){
			$data['products'] = $this->MY_Model->getRows('stocks');
			json($data);
	}

	public function get_productName_by_code(){
		$param['where'] 		= array('s.stock_id' => $this->input->post('stock_id'));
		$param['join']			= array('products as p' => 'p.id = s.product');
		$param['select']		= "p.product_name, p.code, s.stock_id, s.product, s.physical_count, s.warehouse_id";
		$data['physical_count'] = $this->MY_Model->getRows('stocks as s',$param);

		json($data);
	}

	//get products by warehouse
	public function get_products_by_warehouse(){

		$from_wh_id = $this->input->post('from_warehouse_id');

		$param['where']		= array('s.warehouse_id' => $from_wh_id);
		$param['join']		= array('products as p' => 'p.id = s.product');
		$param['select']	= "p.product_name, p.code, p.id, s.product, s.stock_id";
		$data['wh_product']	= $this->MY_Model->getRows('stocks as s', $param);

		json($data);
	}

	// public function addStockMovement(){
	// 	$post = $this->input->post();
	//
	// 	$id = $this->input->post('stockmovement_id');
	// 	$stockmovement_id = $id + 1;
	// 	$code = sprintf('%04d',$stockmovement_id);
	//
	// 	$this->load->library('form_validation');
	//
	// 	$this->form_validation->set_rules('sodate', 'Date', 'required');
	// 	$this->form_validation->set_rules('so_type', 'Type', 'required');
	// 	$this->form_validation->set_rules('so_datedelivered', 'Date Delivered', 'required');
	// 	$this->form_validation->set_rules('wh_prod_code[]', 'code', 'required');
	// 	// $this->form_validation->set_rules('prod_name[]', 'Product Name', 'required');
	// 	$this->form_validation->set_rules('quantity[]', 'Quantity', 'required');
	//
	// 	$error = array();
	//
	// 	if(!empty($post['warehouse'])){
	// 		$warehouse 			= $post['warehouse'];
	// 		$transfer_status 	= 1;
	// 	}else{
	// 		$warehouse 			= NULL;
	// 		$transfer_status 	= NULL;
	// 	}
	// 	foreach($post['stock_id'] as $sKey => $sVal){
	// 		$parameters['where'] = array('stock_id' => $sVal);
	// 		$parameters['select'] = 'physical_count, product';
	// 		$data_prod_qty = $this->MY_Model->getRows('stocks',$parameters);
	// 		$errormsg = false;
	//
	// 		foreach($data_prod_qty as $sqKey => $sVal){
	// 			if($post['quantity'][$sKey] > $sVal['physical_count'] ){
	// 				$errormsg = true;
	// 			}
	// 		}
	// 	}
	//
	// 	if(!empty($errormsg)){
	// 		$response = $errormsg;
	// 	}else{
	// 		//adds to stock movement
	// 		foreach($post['wh_prod_code'] as $pkey => $pVal){
	// 			$params['select'] = 'product, quantity';
	// 			$data_prod['qty'] = $this->MY_Model->getRows('purchase_orders', $params);
	// 			$qty = $post['quantity'][$pkey];
	//
	// 			if ($this->form_validation->run() !== FALSE) {
	//
	// 				$data = array(
	// 					'stockmovement_code'	=> $code,
	// 					'stockmovement_date' 	=> $post['sodate'],
	// 					'type' 					=> $post['so_type'],
	// 					'from_warehouse' 		=> $post['from_warehouse'],
	// 					'transferred_warehouse' => $warehouse,
	// 					'date_delivered'		=> $post['so_datedelivered'],
	// 					'product' 				=> $pVal,
	// 					'quantity' 				=> $qty,
	// 					'stockmovement_note' 	=> $post['stockmovement_note'],
	// 					'transfer_status'		=> $transfer_status,
	// 					'status' 				=> 1
	// 				);
	// 				$insert = $this->MY_Model->insert('stock_movement', $data);
	// 				if ($insert) {
	// 					$response = array(
	// 						'status' => 'ok'
	// 					);
	// 				}
	// 			}else{
	// 				$response = array('form_error' =>  array_merge($this->form_validation->error_array(), $error) );
	// 			}
	//
	// 		}
	// 	}
	//
	// 	echo json_encode($response);
	// }

	public function to_extrack(){
		$purchase_code = $this->input->post('purchase_code');
		$so_type = $this->input->post('so_type');
		$sodate = $this->input->post('sodate');
		// $so_datedelivered = $this->input->post('so_datedelivered');
		// $from_warehouse = $this->input->post('from_warehouse');
		$transfer_code = $this->input->post('transfer_code');
		$transfer_product = $this->input->post('transfer_product');
		$transfer_quant = $this->input->post('transfer_quant');
		$stockmovement_note = $this->input->post('stockmovement_note');
		$stock_id = $this->input->post('stock_id');


		foreach ($transfer_code as $key => $value) {
			$param['where'] 		= array('stock_movement.po_id' => $stock_id[$key]);
			$param['select']		= "quantity";
			$movement_quant = $this->MY_Model->getRows('stock_movement',$param);
			$reamining_stock = $movement_quant[0]['quantity'];

			$datas = array(
				'stockmovement_code' => $purchase_code,
				'stockmovement_date' => $sodate,
				'type' => $so_type,
				// 'from_warehouse' => $from_warehouse,
				// 'date_delivered' => $so_datedelivered,
				'product' => $transfer_product[$key],
				'quantity' => $transfer_quant[$key] + $reamining_stock,
				'stockmovement_note' => $stockmovement_note,
			);
			 $update = $this->MY_Model->update('stock_movement', $datas, array('po_id' => $stock_id[$key]), '', '');
		}

		if ($update) {
			$response = 'ok';
		}

		echo json_encode($response);

	}
	//deduct system count and physical after submitting stock out and stock transfer
	public function update_qty(){
		$post = $this->input->post();

		foreach($post['wh_prod_code'] as $pKey => $pVal){
			$param['where'] = array('po.product' => $pVal, 'po.delivered !=' => 0, 'po.warehouse_id' => $post['from_warehouse']);
			$param['limit'] = array(1,0);
			$param['order'] = 'po.date_ordered DESC';
			$param['join'] = array('products as p' => 'p.id = po.product:left',
			 						'stocks as s' => 's.product = po.product:left',
									'warehouse_management as w' => 'w.id = po.warehouse_id:left');
			$param['select'] = "po.product, po.delivered";
			$datas=  $this->MY_Model->getRows('purchase_orders as po', $param);

			foreach($datas as $key => $val){

				$total_remaining_purch = $val['delivered'] - $post['quantity'][$pKey];

			}

			$total_remaining = $post['remaining_stocks'][$pKey] - $post['quantity'][$pKey];
			//minus physical count
			$data = array(
				'physical_count' => $total_remaining
			);

			//minus system count
			$data1 = array(
				'delivered' => $total_remaining_purch
			);
			$parameters['order'] = 'date_delivered DESC';
			$parameters['limit'] = array(1,0);
			// $update = $this->MY_Model->update_1('purchase_orders', $data1,array('product' => $pVal, 'delivered !=' => 0, 'warehouse_id' => $post['from_warehouse']),$parameters );

			$update = $this->MY_Model->update('stocks', $data, array('stock_id' => $post['stock_id'][$pKey]), '', '');
			if ($update) {
				$response = array(
					'status' => 'ok'
				);
			}	else {
				$response = array('form_error' =>  array_merge($this->form_validation->error_array(), $error) );
			}
		}
	}

	public function view_stock_management(){
		$purchase_code = $this->input->post('purchase_code');

		$parameters['where'] = array('purchase_orders.purchase_code' => $purchase_code);
		// $parameters['group'] = array('purchase_code');
		$parameters['join'] = array('products' => 'products.code = purchase_orders.product',
									'stocks' => 'purchase_orders.id = stocks.po_id',
									'stock_movement' => 'stock_movement.po_id = stocks.po_id');
		$parameters['select'] = 'products.code, , purchase_orders.quantity, purchase_orders.unit_price, products.volume,
								products.unit,products.packing,products.brand, products.product_name, purchase_orders.delivered,stocks.physical_count,stock_movement.quantity as stock_movement_quant' ;

		$data = $this->MY_Model->getRows('purchase_orders',$parameters);

		$data_array['view_stock'] = $data;

		json($data_array);
	}


}

?>
