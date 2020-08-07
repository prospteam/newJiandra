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

		$param_sup['where'] = array('status' => 1);
		$param_sup['select'] = 'supplier_name';
		$data['supplier'] = $this->MY_Model->getRows('supplier', $param);

		$param_warehouse['where'] = array('status' => 1);
		$param_warehouse['select'] = 'wh_name';
		$data['warehouse'] = $this->MY_Model->getRows('warehouse_management', $param);

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

	public function get_suppliers_by_companies_bo_edit(){
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

		$parameters['where'] = array(
			'company' => $this->input->post('company_id'),
			'status' => 1
		);
		$data['productlist'] = $this->MY_Model->getRows('products',$parameters);

		json($data);
	}

	// public function getBOProducts(){
	// 	$supplier = $this->input->post('supplier');
	// 	echo "<pre>";
	// 	 print_r($supplier);
	// 	 exit;
	// 	$param['where'] = array('products.status' => 1 , 'products.supplier' => $supplier);
	// 	$param['join'] = array(
	// 		'badorder' => 'products.product_name = badorder.product_name',
	// 	);
	// 	$param['select'] = 'products.product_name,products.code,products.volume,products.unit,products.brand,products.packing';
	// 	//$param['select'] = '*';
	// 	$data['products'] = $this->MY_Model->getRows('products', $param);
	// 	// echo "<pre>";
	// 	//  print_r($data);
	// 	//  exit;
	// 	echo json_encode($data);
	// }
	public function getBOProducts(){
		$supplier = $this->input->post('supplier');

		$param['where'] = array('products.status' => 1 , 'products.supplier' => $supplier);
		// $param['join'] = array(
		// 	'badorder' => 'products.product_name = badorder.product_name',
		// );
		$param['select'] = 'products.product_name,products.code,products.volume,products.unit,products.brand,products.packing';
		//$param['select'] = '*';
		$data['products'] = $this->MY_Model->getRows('products', $param);

		echo json_encode($data);
	}

	public function addbadorder(){
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
					'supplier' 					=> $this->input->post('bo_supplier'),
					'warehouse' 				=> $this->input->post('warehouse'),
					'product_name' 				=> $this->input->post('product_name'),
					'reason' 					=> $this->input->post('reason'),
					'status' 					=> '1'
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


		public function display_badorder(){
			$limit = $this->input->post('length');
			$offset = $this->input->post('start');
			$search = $this->input->post('search');
			$order = $this->input->post('order');
			$draw = $this->input->post('draw');

			$column_order = array('date_purchased','date_returned','product_name', 'reason', 'supplier');
			$where = array('status !=' => 3);
			$join = array();

			$select = "id,date_purchased, date_returned, product_name, reason, supplier, status";
			$list = $this->MY_Model->get_datatables('badorder',$column_order, $select, $where, $join, $limit, $offset ,$search, $order);

			$output = array(
					"draw" => $draw,
					"recordsTotal" => $list['count_all'],
					"recordsFiltered" => $list['count'],
					"data" => $list['data']
			);

			echo json_encode($output);
		}

		public function view_all_bo(){
				$parameters['select'] = '*';

				$data = $this->MY_Model->getrows('badorder',$parameters,'row');
				$data_array['badorder'] = $data;
				json($data_array);
		}
		public function editview_all_bo(){
				$bo_id = $this->input->post('id');
				$parameters['where'] = array('id' => $bo_id);
				$parameters['select'] = '*';

				$data = $this->MY_Model->getrows('badorder',$parameters);
				$data_array['badorder'] = $data;

				json($data_array);
		}

		public function update_bo(){
				$bo_id = $this->input->post('edit_bo_id');

				$data = array(
					'date_purchased' => $this->input->post('date_purchased'),
					'date_returned' => $this->input->post('date_returned'),
					'quantity' => $this->input->post('quantity'),
					'sellprice' => $this->input->post('sellprice'),
					'company' => $this->input->post('company_edit'),
					'supplier' => $this->input->post('edit_supplier'),
					'warehouse' => $this->input->post('edit_warehouse'),
					'reason' => $this->input->post('reason'),
				);
				$datas['update_bo'] = $this->MY_Model->update('badorder',$data,array('id' => $bo_id));
				echo json_encode($datas);
		}

		public function purchase_details(){
			$purchase_id = $this->input->post('id');

			$parameters['where'] = array('id' => $purchase_id);
			// $parameters['group'] = array('purchase_code');
			$parameters['join'] = array('company' => 'company.company_id = badorder.company',
										'supplier' => 'supplier.supplier_name = badorder.supplier',
										'products' => 'products.id = badorder.product');
			$parameters['select'] = 'badorder.*, badorder.id AS purchase_id, supplier.id AS supplier_id, supplier.*, company.*,products.id AS product_id, products.*';

			$data['purch_details'] = $this->MY_Model->getRows('badorder', $parameters);
				echo json_encode($data);
		}

		public function enable_bo(){

				$bo_id = $this->input->post('id');
				$bo_status = 1;
				$data = array(
					'status' => $bo_status
				);
				$datas['delete'] = $this->MY_Model->update('badorder',$data,array('id' => $bo_id));
				echo json_encode($datas);
		}
		public function disable_bo(){

				$bo_id = $this->input->post('id');
				$bo_status = 2;
				$data = array(
					'status' => $bo_status
				);
				$datas['delete'] = $this->MY_Model->update('badorder',$data,array('id' => $bo_id));
				echo json_encode($datas);
		}
		public function delete_bo(){

				$bo_id = $this->input->post('id');
				$bo_status = 3;
				$data = array(
					'status' => $bo_status
				);
				$datas['delete'] = $this->MY_Model->update('badorder',$data,array('id' => $bo_id));
				echo json_encode($datas);
		}

}

?>
