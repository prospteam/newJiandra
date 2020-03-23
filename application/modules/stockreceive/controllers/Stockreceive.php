<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stockreceive extends MY_Controller {

	public function __construct(){
		parent::__construct();

	}

    public function index(){

      	$this->load_page('stockreceive');
  	}

    function disp_stockreceive(){

		$limit = $this->input->post('length');
		$offset = $this->input->post('start');
		$search = $this->input->post('search');
		$order = $this->input->post('order');
		$draw = $this->input->post('draw');

		$column_order = array('stockmovement_code','stockmovement_date','from_warehouse','transferred_warehouse','date_delivered','stockmovemenent_note','status');

		$where = array(
			'sm.status !=' => 3,
            'transfer_status' => 1,
			'type' => 2
		);
		$group = array('sm.stockmovement_code');
		$join = array(
			'products' => 'products.id = sm.product'
		);
		$select = "sm.stockmovement_id,sm.stockmovement_date,sm.transferred_warehouse,sm.date_delivered,sm.product,
		sm.stockmovement_note,sm.status, sm.transfer_status, products.product_name, sm.stockmovement_code, (SELECT wh_name FROM warehouse_management WHERE id = sm.from_warehouse ) AS sm_from_warehouse, (SELECT wh_name FROM warehouse_management WHERE id = sm.transferred_warehouse ) AS sm_transferred_warehouse";

		$list = $this->MY_Model->get_datatables('stock_movement as sm',$column_order, $select, $where, $join, $limit, $offset ,$search, $order, $group);

		$output = array(
				"draw" => $draw,
				"recordsTotal" => $list['count_all'],
				"recordsFiltered" => $list['count'],
				"data" => $list['data']
		);
		echo json_encode($output);
	}

    //view list of products to be transferred
	public function view_stockreceive(){
		$stockmovement_id = $this->input->post('id');
		$parameters['where'] = array('stock_movement.stockmovement_code' => $stockmovement_id, 'type' => 2);
		// $parameters['group'] = array('stock_movement.stockmovement_code');
		$parameters['join'] = array('products' => 'products.id = stock_movement.product');
		$parameters['select'] = 'stock_movement.*, products.id AS product_id, products.*';

		$data = $this->MY_Model->getRows('stock_movement',$parameters);
		// echo "<pre>";
		//  print_r($data);
		//  exit;
		$data_array['stockout'] = $data;
		json($data_array);
	}

    //add actual qty received
	public function add_actual_qty(){
		$post = $this->input->post();

		foreach($post['sm_id'] as $key => $value){
			$data = array(
						'actual_received' => $post['actual_receive_qty'][$key],
						'transfer_status' => 2
					);
			$update = $this->MY_Model->update('stock_movement', $data, array('stockmovement_id' => $value));
			if ($update) {
				$response = array(
					'status' => 'ok'
				);
			}
		}

		echo json_encode($response);

	}

	//decline transaction for transfer stocks
	public function decline_transfer(){
		$post = $this->input->post();
		$param['where'] = array('stockmovement_code' => $post['id'], 'purchase_orders.status' => 4);
		$param['group'] = array('purchase_orders.warehouse_id', 'purchase_orders.product');
		$param['join'] = array(
			'purchase_orders' => 'purchase_orders.product = stock_movement.product',
			'stocks'          => 'stocks.physical_count = stock_movement.transfer_status'
		);
		$param['select'] = "stock_movement.quantity, stock_movement.product, from_warehouse, purchase_orders.id";
		$data1['prod_transfer'] = $this->MY_Model->getRows('stock_movement', $param);

		// echo $this->db->last_query();
		// echo "<pre>";
		// print_r($post);
		// exit;

		foreach($post['Remarks'] as $key => $value){
			$data = array(
				'cancel_transfer_note' => $value,
				'transfer_status' => 3
			);
			// foreach ($st as $s_transfer => $value1) {
			// 	$data1 = array(
			// 		'transfer_status' => 3
			// 	);
			// if ($st['transfer_status']) {
			// 	$value1
			// }
			//

			$update = $this->MY_Model->update('stock_movement', $data, array('stockmovement_code' => $post['id']));
			if ($update) {
				$response = array(
					'status' => 'ok'
				);
			// }
			}
		}
		json($data1);
		echo json_encode($response);
	}
}
?>
