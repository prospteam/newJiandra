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
	// edit purchase Orders
	public function edit_stocktransfer(){

		$post = $this->input->post();
		echo "<pre>";
		 print_r($post);
		 exit;
		// foreach($post['isEdit'] as $key => $value){
		// 	print_r($post['prod_code'][$key]);
		// 	if($value == 1){
		// 		echo $post['prod_code'][$key].' = '.$post['prod_name'][$key].' is for Edit<br>';
		// 	} else {
		// 		echo $post['prod_code'][$key].' = '.$post['prod_name'][$key].' is for Add<br>';
		// 	}
		// }
		// exit;
		$this->load->library("form_validation");

		$this->form_validation->set_rules('edit_prod_code[]', 'SKU', 'required');
		$this->form_validation->set_rules('edit_prod_name[]', 'Product Name', 'required');
		$this->form_validation->set_rules('edit_remaining_stocks[]', 'Remaining Stocks', 'required');
		$this->form_validation->set_rules('edit_quantity[]', 'Quantity', 'required');
		$error = array();

			if(!empty($post['prod_code'])){
					foreach($post['prod_code'] as $pkey => $pVal){
						// if($value['isEdit'] == 1){
						//
						// } else {
						//
						// }
						if ($this->form_validation->run() !== FALSE) {
								$data = array(
										'stockmovement_date' => $post['sodate'],
										'type' => $post['so_type'],
										'date_delivered' => $post['so_datedelivered'],
										'product' => $pVal,
										'stockmovement_code' => $post['edit_prod_code'][$pkey],
										'physical_count' => $post['edit_remaining_stocks'][$pkey],
										'quanity' => $post['edit_quantity'],
										'status' => 1,
										'delivery_status' => 1
									);
									$add = $this->MY_Model->insert('stock_movement', $data,array('stockmovement_id' => $post['stocktransfer_id'][$pkey]));
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
					'stockmovement_date' => $post['sodate'],
					'type' => $post['so_type'],
					'date_delivered' => $post['so_datedelivered'],

				);
				$update1 = $this->MY_Model->update('stock_movement', $data, array('stockmovement_id' => $post['stocktransfer_id']));

				foreach($post['stocktransfer_id'] as $pkey => $pVal){
					$data = array(
						// 'stockmovement_id' => $post['stockmovement_id'],
						'product' => $post['prod_code'][$pkey],
						'remaining_stocks' => $post['remaining_stocks'][$pkey],
						'quantity' => $post['quantity'][$pkey],
					);
					$update = $this->MY_Model->update('stock_movement', $data, array('id' => $post['stocktransfer_id'][$pkey]));
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
		 $parameters['join'] =  array(
			 'products' => 'products.id = stock_movement.product',
			 'stocks' => 'stocks.code = products.code'
		 );
		 $data = $this->MY_Model->getrows('stock_movement',$parameters);

		 $data_array['stock_movement'] = $data;
		 json($data_array);

	 }


	 public function get_product_Name_by_code_edit(){

		 $parameters['where'] = array('id' => $this->input->post('prod_id'));
		 $data['products'] = $this->MY_Model->getRows('products',$parameters, 'rows');

		 $param['where'] = array('product' => $this->input->post('prod_id'));
		 $data['physical_count'] = $this->MY_Model->getRows('stocks',$param);

		 json($data);
	 }

	 public function view_stocktransfer(){
		 $stockmovement_id = $this->input->post('stockmovement_id');
		 $parameters['where'] = array('stock_movement.stockmovement_id' => $stockmovement_id, 'type' => 2);
		 $parameters['join'] = array(
			 'warehouse_management' => 'warehouse_management.id = stock_movement.transferred_warehouse',
			 'products' => 'products.id = stock_movement.product',
	 		);
		 $parameters['select'] = 'stock_movement.*, products.id AS product_id, products.*, warehouse_management.id AS warehouse_id, warehouse_management.*';

		 $data = $this->MY_Model->getRows('stock_movement',$parameters);


		 $data_array['stock_movement'] = $data;

		 json($data_array);
	 }




}

?>
