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

    	$this->load_page('stocksmanagement', $data);
	}

  	//display delivered products
	public function display_delivered_products(){
		$limit 	= $this->input->post('length');
		$offset = $this->input->post('start');
		$search = $this->input->post('search');
		$order 	= $this->input->post('order');
		$draw 	= $this->input->post('draw');

		$column_order 	= array('p.code','sup.supplier_name','p.brand','p.product_name','po.delivered', 'po.date_delivered', 's.physical_count', 's.variance', 'po.supplier', 'po.date_delivered', 's.physical_count', 'po.warehouse_id', 'w.wh_name');
		$where			= array('po.delivery_status' => 4);
		$group 			= array('po.product', 'po.warehouse_id');
		$join 			= array(
							'products as p' => 'p.id = po.product:left',
							'supplier as sup' => 'sup.id = po.supplier:left',
							'stocks as s' => 's.product = po.product AND s.warehouse_id = po.warehouse_id:left',
							'warehouse_management as w' => 'w.id = po.warehouse_id:left'
						);
						$select 		= "po.product, (SELECT SUM(delivered) FROM purchase_orders WHERE warehouse_id = po.warehouse_id AND product = p.id) AS system_count, p.code, p.product_name, p.brand, sup.supplier_name, po.supplier, po.date_delivered, s.physical_count, s.variance, po.warehouse_id, w.wh_name";
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

	//display prodducts in dropdown when adding another field for stock movement
	public function get_productsSO(){
		echo "<pre>";
		print_r($this->input->post('from_warehouse_id'));
		exit;
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
		// echo "<pre>";
		// print_r($this->input->post());
		// exit;
		$from_wh_id = $this->input->post('from_warehouse_id');

		$param['where']		= array('s.warehouse_id' => $from_wh_id);
		$param['join']		= array('products as p' => 'p.id = s.product');
		$param['select']	= "p.product_name, p.code, p.id, s.product, s.stock_id";
		$data['wh_product']	= $this->MY_Model->getRows('stocks as s', $param);

		json($data);
	}

	public function addStockMovement(){
		$post = $this->input->post();
		// echo "<pre>";
		// print_r($post);
		// exit;
		$id = $this->input->post('stockmovement_id');
		$stockmovement_id = $id + 1;
		$code = sprintf('%04d',$stockmovement_id);

		$this->load->library('form_validation');

		$this->form_validation->set_rules('sodate', 'Date', 'required');
		$this->form_validation->set_rules('so_type', 'Type', 'required');
		$this->form_validation->set_rules('so_datedelivered', 'Date Delivered', 'required');
		$this->form_validation->set_rules('wh_prod_code[]', 'code', 'required');
		// $this->form_validation->set_rules('prod_name[]', 'Product Name', 'required');
		$this->form_validation->set_rules('quantity[]', 'Quantity', 'required');

		$error = array();

		if(!empty($post['warehouse'])){
			$warehouse 			= $post['warehouse'];
			$transfer_status 	= 1;
		}else{
			$warehouse 			= NULL;
			$transfer_status 	= NULL;
		}

		foreach($post['stock_id'] as $sKey => $sVal){
			$parameters['where'] = array('stock_id' => $sVal);
			$parameters['select'] = 'physical_count, product';
			$data_prod_qty = $this->MY_Model->getRows('stocks',$parameters);
			$errormsg = false;

			foreach($data_prod_qty as $sqKey => $sVal){
				if($post['quantity'][$sKey] > $sVal['physical_count'] ){
					$errormsg = true;
				}
			}
		}
		// echo "<pre>";
		// print_r($errormsg);
		// exit;
		if(!empty($errormsg)){
			$response = $errormsg;
		}else{
			//adds to stock movement
			foreach($post['wh_prod_code'] as $pkey => $pVal){
				$params['select'] = 'product, quantity';
				$data_prod['qty'] = $this->MY_Model->getRows('purchase_orders', $params);
				$qty = $post['quantity'][$pkey];

				if ($this->form_validation->run() !== FALSE) {

					$data = array(
						'stockmovement_code'	=> $code,
						'stockmovement_date' 	=> $post['sodate'],
						'type' 					=> $post['so_type'],
						'from_warehouse' 		=> $post['from_warehouse'],
						'transferred_warehouse' => $warehouse,
						'date_delivered'		=> $post['so_datedelivered'],
						'product' 				=> $pVal,
						'quantity' 				=> $qty,
						'stockmovement_note' 	=> $post['stockmovement_note'],
						'transfer_status'		=> $transfer_status,
						'status' 				=> 1
					);
					$insert = $this->MY_Model->insert('stock_movement', $data);
					if ($insert) {
						$response = array(
							'status' => 'ok'
						);
					}
				}else{
					$response = array('form_error' =>  array_merge($this->form_validation->error_array(), $error) );
				}

			}
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
			$param['join'] = array('products as p' => 'p.id = po.product:left', 'stocks as s' => 's.product = po.product:left', 'warehouse_management as w' => 'w.id = po.warehouse_id:left');
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
			$update = $this->MY_Model->update_1('purchase_orders', $data1,array('product' => $pVal, 'delivered !=' => 0, 'warehouse_id' => $post['from_warehouse']),$parameters );

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
}

?>
