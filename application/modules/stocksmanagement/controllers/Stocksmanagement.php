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


		$column_order = array('products.code','products.product_name','delivered');
		$where = array('purchase_orders.delivery_status' => 4);
		$group = array('purchase_orders.product');
		$join = array(
			'products' => 'products.id = purchase_orders.product'
		);
		$select = "purchase_orders.product, purchase_orders.delivered, products.code, products.product_name";
		$list = $this->MY_Model->get_datatables('purchase_orders',$column_order, $select, $where, $join, $limit, $offset ,$search, $order, $group);

		// foreach($list['data'] as $key => $value){
		// 	echo "<pre>";
		// 	print_r($value);
		//
		// }
		// if(!empty($list)) {
		// 	foreach ($list as $key => $value) {
		// 		$list[$key]['position'] = userType($value['position']);
		// 	}
		// }
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
}

?>
