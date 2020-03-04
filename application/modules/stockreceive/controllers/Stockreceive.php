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

		$data_array['stockout'] = $data;
		json($data_array);
	}

    //change delivered actual qty on stock receive
	public function change_actual_qty(){
		$post = $this->input->post();

		$data = array('actual_received' => $post['delivered']);
		$data['actual_qty'] = $this->MY_Model->update('stock_movement', $data, array('stockmovement_id' => $post['id']));

		json($data);

	}
}
?>
