<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Stocktransfer extends MY_Controller {
	public function index(){
		$parameters['select'] = '*';
		$data['suppliers'] = $this->MY_Model->getRows('supplier',$parameters);

		$parameters['where'] = array('company_id !=' => 0);
		$parameters['select'] = '*';
		$data['company'] = $this->MY_Model->getRows('company',$parameters);

		$param['where'] = array('status' => 1);
		$param['select'] = '*';
		$data['products'] = $this->MY_Model->getRows('products', $param);

		$data['users'] = $this->MY_Model->getrows('users');
		$data['vehicles'] = $this->MY_Model->getrows('vehicles');

		$parameters1['select'] = '*';
		$parameters1['limit'] = array(1,0);;
		$parameters1['order'] = 'purchase_code DESC';
		$data['purchase'] = $this->MY_Model->getRows('purchase_orders',$parameters1);

		$this->load_page('stocktransfer', @$data);
	}
	// echo "<pre>";
	//  print_r(params);
	//  exit;

	public function get_suppliers_by_companies_bo(){
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

	public function getProductBySupplier(){
		$supplier = $this->input->post('supplier');

		$param['where'] = array('products.status' => 1 , 'supplier' => $supplier);
		$param['join'] = array(
			'products' => 'products.id = products_cost_price.fk_product_id',
		);
		// $param['select'] = '*';
		$param['select'] = 'products.product_name,products.code,products_cost_price.cost_price,products.volume,products.unit,products.brand,products.packing';
		$data['products'] = $this->MY_Model->getRows('products', $param);

		echo json_encode($data);
	}

	 public function disp_stocktransfer($id){
		 $limit = $this->input->post('length');
		 $offset = $this->input->post('start');
		 $search = $this->input->post('search');
		 $order = $this->input->post('order');
		 $draw = $this->input->post('draw');


		 $column_order = array('date_purchased','date_returned','product_name','reason.status');
		 if ($id == 0) {
			 $where = array('warehouse_management.status !=' => 3);

		 }else {
			 $where = array('warehouse_management.status !=' => 3,
			 'warehouse_management.company' => $id);
		 }
		 $join = array(
			 // 'company' => 'company.company_id = users.company',
			 'users' => 'users.id = badorder.supplier'
		 );
		 $select = "badorder.id,badorder.date_purchased,badorder.date_returned,badorder.product_name,badorder.reason,badorder.status";
		 $list = $this->MY_Model->get_datatables('badorder',$column_order, $select, $where, $join, $limit, $offset ,$search, $order);


		 $output = array(
				 "draw" => $draw,
				 "recordsTotal" => $list['count_all'],
				 "recordsFiltered" => $list['count'],
				 "data" => $list['data']
		 );

		 echo json_encode($output);
	 }

	public function addbadorder(){
		// $company_name = $this->input->post('company');
		$post = $this->input->post();
		$this->load->library("form_validation");
		$this->form_validation->set_rules('date_purchased','Date Purchased','required');
		$this->form_validation->set_rules('date_returned','Date Returned', 'required');
		$this->form_validation->set_rules('product_name','Product Name','required');
		$this->form_validation->set_rules('reason','Reason','required');


		$error = array();

		if ($this->form_validation->run() !== FALSE) {
				$data = array(
					'date_purchased' 			=> $this->input->post('date_purchased'),
					'date_returned' 			=> $this->input->post('date_returned'),
					'quantity' 					=> $this->input->post('quantity'),
					'sellprice' 				=> $this->input->post('sellprice'),
					'company'					=> $this->input->post('company'),
					'supplier' 					=> $this->input->post('supplier'),
					'warehouse' 				=> $this->input->post('warehouse'),
					'product_name' 				=> $this->input->post('product_name'),
					'reason' 					=> $this->input->post('reason'),
					'status' 					=> 1
				);

				$insert = $this->MY_Model->insert('badorder',$data);
				if ($insert) {
					$response = array(
						'status'=>'ok'
					);
				}
		}else {
				$response = array('form_error'=> array_merge($this->form_validation->error_array(),$error) );
			}
				echo json_encode($response);
		}

	// edit purchase Orders
	public function edit_stocktransfer(){

		$post = $this->input->post();

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

	public function update_stock_transfer(){
		$post_quant = $this->input->post('quantity');
		$stockmovement_id = $this->input->post('stockmovement_id');

		$parameters['where'] = array('stock_movement.stockmovement_id'=>$stockmovement_id);
		$parameters['select'] = 'stockmovement_id, quantity, physical_count,stock_id';
		$parameters['join'] =  array(
			'stocks' => 'stocks.product = stock_movement.product'
		);
		$datas = $this->MY_Model->getrows('stock_movement',$parameters);

		foreach ($datas as $key => $value) {
			$stocktrans_quant = (int)$value['physical_count'] - $post_quant[0];
		}

		$stock_id = $value['stock_id'];

		$set = array(
			'physical_count' => $stocktrans_quant
		);

		$where = array(
			'stock_id' => $stock_id
		);
		$where_quant = array(
			'stockmovement_id' => $stockmovement_id
		);

		$update = $this->MY_Model->update('stocks',$set,$where);
		$update = $this->MY_Model->update('stock_movement',array('quantity' => $post_quant[0]),$where_quant);

		echo json_encode($update);
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
		 $parameters['select'] = 'stockmovement_date, type, date_delivered, products.id, products.code, product_name, physical_count, SUM(quantity) as quantity, stockmovement_note, stock_movement.stockmovement_id ';
		 $parameters['join'] =  array(
			 'products' => 'products.id = stock_movement.product',
			 'stocks' => 'stocks.product = stock_movement.product'
		 );
		 $data = $this->MY_Model->getrows('stock_movement',$parameters);

		 // echo "<pre>";
		 // print_r($data);
		 //  exit;

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
