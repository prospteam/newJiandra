<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocksmanagement extends MY_Controller {

	public function __construct(){
		parent::__construct();

	}

  public function index(){
		// $parameters['select'] = '*';
		// $data['suppliers'] = $this->MY_Model->getRows('supplier',$parameters);
    //
		// $parameters['group'] = array('stocks.warehouse_id');
		// $parameters['join'] = array('warehouse_management' => 'warehouse_management.id = stocks.warehouse_id');
		$parameters['select'] = '*';
		$data['warehouse'] = $this->MY_Model->getRows('warehouse_management',$parameters);
    //
		$param['select'] = '*';
		$data['products'] = $this->MY_Model->getRows('stocks', $param);
		// $param['select'] = '*';
		// $data['products'] = $this->MY_Model->getRows('products', $parameters);
    //
		// $parameters1['select'] = '*';
		// $parameters1['limit'] = array(1,0);;
		// $parameters1['order'] = 'purchase_code DESC';
		// $data['purchase'] = $this->MY_Model->getRows('purchase_orders',$parameters1);

    $this->load_page('stocksmanagement', $data);
	}

  //display delivered products
	public function display_delivered_products(){
		$limit = $this->input->post('length');
		$offset = $this->input->post('start');
		$search = $this->input->post('search');
		$order = $this->input->post('order');
		$draw = $this->input->post('draw');

		$column_order = array('p.code','sup.supplier_name','p.brand','p.product_name','po.delivered', 'po.date_delivered', 's.physical_count', 's.stock_out', 's.variance', 'po.supplier', 'po.date_delivered', 's.physical_count', 's.warehouse_id', 'w.wh_name');
		$where = array('po.delivery_status' => 4);
		$group = array('po.product', 'po.warehouse_id');
		// $count = array('po.delivered');
		$join = array(
			'products as p' => 'p.id = po.product:left',
			'supplier as sup' => 'sup.id = po.supplier:left',
			'stocks as s' => 's.product = po.product:left',
			'warehouse_management as w' => 'w.id = po.warehouse_id:left'
		);
		$select = "po.product, (SELECT SUM(delivered) FROM purchase_orders WHERE warehouse_id = po.warehouse_id AND product = p.id) AS system_count, p.code, p.product_name, p.brand, sup.supplier_name, po.supplier, po.date_delivered, s.physical_count, s.stock_out,s.variance, s.warehouse_id, w.wh_name";
		$list = $this->MY_Model->get_datatables('purchase_orders as po',$column_order, $select, $where, $join, $limit, $offset ,$search, $order, $group);
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

	//add view reports
	public function view_reports(){
		$param['where'] = array('po.delivery_status' => 4);
		$param['group'] = array('po.product', 'po.warehouse_id');
		$param['join'] = array('products as p' => 'p.id = po.product:left', 'stocks as s' => 's.product = po.product:left', 'warehouse_management as w' => 'w.id = po.warehouse_id:left');
		$param['select'] = "po.product, (SELECT SUM(delivered) FROM purchase_orders WHERE warehouse_id = po.warehouse_id AND product = p.id) AS system_count, p.code, p.product_name, s.stock_id, s.physical_count, s.note_stocks, s.warehouse_id, w.wh_name";
		$data['stocks'] =  $this->MY_Model->getRows('purchase_orders as po', $param);
		// echo "<pre>";
		// print_r($this->db->last_query());
		// exit;
		echo json_encode($data);
	}


	//add reports
	public function add_reports(){
		$post = $this->input->post();
		// echo "<pre>";
		// print_r($post);
		// exit;
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
					// 'code' => $post['code'][$pkey],
					// 'product' => $pVal,
					'physical_count' => $post['physical_count'][$pkey],
					// 'system_count' => $post['system_count'][$pkey],
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

	public function get_productsSO(){
			$data['products'] = $this->MY_Model->getRows('stocks');

			json($data);

	}

	public function get_productName_by_code(){
		$parameters['where'] = array('id' => $this->input->post('prod_id'));
		$data['products'] = $this->MY_Model->getRows('products',$parameters);

		$param['where'] = array('product' => $this->input->post('prod_id'));
		$data['physical_count'] = $this->MY_Model->getRows('stocks',$param);
		json($data);
	}

	public function addStockMovement(){
		$post = $this->input->post();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('sodate', 'Date', 'required');
		$this->form_validation->set_rules('so_type', 'Type', 'required');
		// if(!empty($post['warehouse'])){
		// 	$this->form_validation->set_rules('warehouse', 'Warehouse', 'required');
		// }
		$this->form_validation->set_rules('so_datedelivered', 'Date Delivered', 'required');
		$this->form_validation->set_rules('prod_code[]', 'code', 'required');
		$this->form_validation->set_rules('prod_name[]', 'Product Name', 'required');
		$this->form_validation->set_rules('quantity[]', 'Quantity', 'required');
		$error = array();

		if(!empty($post['warehouse'])){
			$warehouse = $post['warehouse'];
		}else{
			$warehouse = NULL;
		}
		// if(empty($this->input->post('company[]'))){
		// 	$error['company'] = 'The Companies field is required.';
		// }
		$errormsg = false;
		foreach($post['prod_code'] as $pkey => $pVal){
			$params['select'] = 'physical_count';
			$data_prod_qty = $this->MY_Model->getRow($params,'stocks');
				if($post['quantity'][$pkey] > $data_prod_qty['physical_count']){
					// $subra = true;
					$errormsg= true;
					// $response = array($this->form_validation->set_rules($subra, 'Enter quantity less than or equal to current stock', 'required'));
				}
				// exit;
		}
		//
		if(!empty($errormsg)){
			$response = $errormsg;
		}else{

			foreach($post['prod_code'] as $pkey => $pVal){
				$params['select'] = 'product, quantity';
				$data_prod['qty'] = $this->MY_Model->getRows('purchase_orders', $params);

				$qty = $post['quantity'][$pkey];
				if ($this->form_validation->run() !== FALSE) {

					$data = array(
						'stockmovement_date' => $post['sodate'],
						'type' => $post['so_type'],
						'transferred_warehouse' => $warehouse,
						'date_delivered' => $post['so_datedelivered'],
						'product' => $pVal,
						'quantity' => $qty,
						'stockmovement_note' => $post['stockmovement_note'],
						'status' => 1
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
		// echo "<pre>";
		// print_r($post);
		// exit;
		foreach($post['prod_code'] as $pkey => $pVal){
			// $parameters['where'] = array('product' => $pVal);
			// $parameters['select'] = 'product,delivered';
			// $datas = $this->MY_Model->getRows('purchase_orders', $parameters, 'row');

			$param['where'] = array('po.product' => $pVal);
			$param['limit'] = array(1,0);
			$param['order'] = 'po.date_ordered DESC';
			$param['join'] = array('products as p' => 'p.id = po.product:left', 'stocks as s' => 's.product = po.product:left', 'warehouse_management as w' => 'w.id = po.warehouse_id:left');
			$param['select'] = "po.product, po.delivered";
			$datas=  $this->MY_Model->getRows('purchase_orders as po', $param);
			foreach($datas as $key => $val){

				$total_remaining_purch = $val['delivered'] - $post['quantity'][$pkey];
			}
			// echo "<pre>";
			// print_r($total_remaining_purch);
			// exit;

			$total_remaining = $post['remaining_stocks'][$pkey] - $post['quantity'][$pkey];

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
			$update = $this->MY_Model->update_1('purchase_orders', $data1,array('product' => $pVal, 'delivered !=' => 0),$parameters );
			// echo "<pre>";
			// print_r($this->db->last_query());
			// exit;
			$update = $this->MY_Model->update('stocks', $data, array('product' => $pVal), '', '');
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
