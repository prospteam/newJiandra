<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocktransfer extends MY_Controller {
	public function index(){
		// $parameters['select'] = 'fullname,username';
		// $parameters['search_like'] = 'da';
		// $parameters['column_order'] = array('fullname','username');
		// $data = getrow('users',$parameters,'array',true);
		// json($data,false);
		$data['warehouse_management'] = $this->MY_Model->getrows('warehouse_management');
		$data['products'] = $this->MY_Model->getrows('products');
		$this->load_page('stocktransfer');
	}
	// echo "<pre>";
	//  print_r(params);
	//  exit;
	function disp_stocktransfer(){

		$limit = $this->input->post('length');
		$offset = $this->input->post('start');
		$search = $this->input->post('search');
		$order = $this->input->post('order');
		$draw = $this->input->post('draw');


		$column_order = array('stockmovement_date','transferred_warehouse','date_delivered','product','quantity','stockmovemenent_note','status');



		$where = array(
			'stock_movement.status !=' => 3,
			'type' => 2
		);
		$join = array(
			'warehouse_management' => 'warehouse_management.id = stock_movement.transferred_warehouse',
			'products' => 'products.id = stock_movement.product'
		);
		$select = "stock_movement.stockmovement_tid,stock_movement.stockmovement_date,stock_movement.transferred_warehouse,stock_movement.date_delivered,stock_movement.product,stock_movement.quantity,
		stock_movement.stockmovement_note,stock_movement.status, warehouse_management.wh_name, products.product_name";

		$list = $this->MY_Model->get_datatables('stock_movement',$column_order, $select, $where, $join, $limit, $offset ,$search, $order);


		$output = array(
				"draw" => $draw,
				"recordsTotal" => $list['count_all'],
				"recordsFiltered" => $list['count'],
				"data" => $list['data']
		);
		echo json_encode($output);
	}


	 public function deleteTransfer(){

			 $stockmov = $this->input->post('stockmovement_tid');
			 $stockmov_status = 3;
			 $data = array(
				 'status' => $stockmov_status
			 );
			 $datas['delete'] = $this->MY_Model->update('stock_movement',$data,array('stockmovement_tid' => $stockmov));
			 echo json_encode($datas);
	 }
}

?>
