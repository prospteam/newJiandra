<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Stocktransfer extends MY_Controller {
	public function index(){
		// $parameters['select'] = 'fullname,username';
		// $parameters['search_like'] = 'da';
		// $parameters['column_order'] = array('fullname','username');
		// $data = getrow('users',$parameters,'array',true);
		// json($data,false);
		$data['warehouse_management'] = $this->MY_Model->getrows('warehouse_management');
		$data['stocks'] = $this->MY_Model->getrows('stocks');
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

		$column_order = array('stockmovement_date','transferred_warehouse','date_delivered','stockmovement_code','stockmovemenent_note','status');


		$where = array(
			'stock_movement.status !=' => 3,
			'type' => 2
		);
		$group = array('stock_movement.stockmovement_code');
		$join = array(
			'warehouse_management' => 'warehouse_management.id = stock_movement.transferred_warehouse',
			'products' => 'products.id = stock_movement.product'
		);
		$select = "stock_movement.stockmovement_id,stock_movement.stockmovement_date,stock_movement.transferred_warehouse,stock_movement.date_delivered,stock_movement.product,
		stock_movement.stockmovement_note,stock_movement.status, warehouse_management.wh_name, products.product_name, stock_movement.stockmovement_code";

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
		 $stockmov = $this->input->post('stockmovement_id');
		 $stockmov_status = 3;
		 $data = array(
			 'status' => $stockmov_status
		 );
		 $datas['delete'] = $this->MY_Model->update('stock_movement',$data,array('stockmovement_id' => $stockmov));
		 echo json_encode($datas);
	 }

	 public function editstocktransfer(){
		 $stocktrans_id = $this->input->post('stockmovement_id');

		 $data_array = array();

		 $parameters['where'] = array('stock_movement.stockmovement_id'=>$stocktrans_id);
		 $parameters['select'] = 'stockmovement_date, type, date_delivered, products.id, products.code, product_name, physical_count, quantity, stockmovement_note,  ';
		 // $parameters['select'] = 'products.code, stocks.physical_count, stockmovement_date, transferred_warehouse, date_delivered, products.status';
		 $parameters['join'] =  array(
			 'products' => 'products.id = stock_movement.product',
			 'stocks' => 'stocks.code = products.code'
		 );
		 $data = $this->MY_Model->getrows('stock_movement',$parameters);
		 // echo "<pre>";
		 //  print_r($data);
		 //  exit;
		 // echo $this->db->last_query();

		 $data_array['stock_movement'] = $data;
		 json($data_array);

	 }
	 // public function get_stock_transfer(){
		//  $params['where'] = array('status' => 1);
		//  $data['products'] = $this->MY_Model->getRows('products', $params);
		//  json($data);
	 // }

	 public function get_product_Name_by_code_edit(){
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




}

?>
