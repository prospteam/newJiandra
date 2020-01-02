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
		// $parameters['select'] = '*';
		// $data['company'] = $this->MY_Model->getRows('company',$parameters);
    //
		// $param['select'] = '*';
		// $data['products'] = $this->MY_Model->getRows('products', $parameters);
    //
		// $parameters1['select'] = '*';
		// $parameters1['limit'] = array(1,0);;
		// $parameters1['order'] = 'purchase_code DESC';
		// $data['purchase'] = $this->MY_Model->getRows('purchase_orders',$parameters1);

    $this->load_page('stocksmanagement');
	}

  //display delivered products
	public function display_delivered_products(){
		$limit = $this->input->post('length');
		$offset = $this->input->post('start');
		$search = $this->input->post('search');
		$order = $this->input->post('order');
		$draw = $this->input->post('draw');

		$column_order = array('products.code','supplier.supplier_name','products.brand','products.product_name','purchase_orders.delivered', 'purchase_orders.date_delivered');
		$where = array('purchase_orders.delivery_status' => 4);
		$group = array('purchase_orders.product');
		// $count = array('purchase_orders.delivered');
		$join = array(
			'products' => 'products.id = purchase_orders.product',
			'supplier' => 'supplier.id = purchase_orders.supplier'
		);
		$select = "purchase_orders.product, SUM(purchase_orders.delivered) as system_count, products.code, products.product_name, products.brand, supplier.supplier_name, purchase_orders.supplier, purchase_orders.date_delivered";
		$list = $this->MY_Model->get_datatables('purchase_orders',$column_order, $select, $where, $join, $limit, $offset ,$search, $order, $group);

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
		$param['where'] = array('purchase_orders.delivery_status' => 4);
		$param['group'] = array('purchase_orders.product');
		$param['join'] = array('products' => 'products.id = purchase_orders.product');
		$param['select'] = "purchase_orders.product, SUM(purchase_orders.delivered) as system_count, products.code, products.product_name";
		$data['stocks'] =  $this->MY_Model->getRows('purchase_orders', $param);
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
		if ($this->form_validation->run() !== FALSE) {

				$data = array(
					'product' => $pVal,
					'physical_count' => $post['physical_count'][$pkey],
					'system_count' => $post['system_count'][$pkey],
					'date_report_generated' => $date_report_generated,
					'note' => $post['note'][$pkey],
					'variance' => 0
				);

				$insert = $this->MY_Model->insert('stocks', $data);
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

}

?>
