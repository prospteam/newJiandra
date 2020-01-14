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
		$parameters['group'] = array('stocks.warehouse_id');
		$parameters['join'] = array('warehouse_management' => 'warehouse_management.id = stocks.warehouse_id');
		$parameters['select'] = '*';
		$data['warehouse'] = $this->MY_Model->getRows('stocks',$parameters);
    //
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

		$column_order = array('p.code','sup.supplier_name','p.brand','p.product_name','po.delivered', 'po.date_delivered', 's.physical_count', 's.variance', 'po.supplier', 'po.date_delivered', 's.physical_count', 's.warehouse_id', 'w.wh_name');
		$where = array('po.delivery_status' => 4);
		$group = array('po.product', 'po.warehouse_id');
		// $count = array('po.delivered');
		$join = array(
			'products as p' => 'p.id = po.product:left',
			'supplier as sup' => 'sup.id = po.supplier:left',
			'stocks as s' => 's.product = po.product:left',
			'warehouse_management as w' => 'w.id = po.warehouse_id:left'
		);
		$select = "po.product, (SELECT SUM(delivered) FROM purchase_orders WHERE warehouse_id = po.warehouse_id AND product = p.id) AS system_count, p.code, p.product_name, p.brand, sup.supplier_name, po.supplier, po.date_delivered, s.physical_count, s.variance, s.warehouse_id, w.wh_name";
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
		$param['select'] = "po.product, (SELECT SUM(delivered) FROM purchase_orders WHERE warehouse_id = po.warehouse_id AND product = p.id) AS system_count, p.code, p.product_name, s.warehouse_id, w.wh_name";
		$data['stocks'] =  $this->MY_Model->getRows('purchase_orders as po', $param);
		// echo "<pre>";
		// print_r($this->db->last_query());
		// exit;
		echo json_encode($data);
	}

	// SELECT
	//   po.product,
	//   p.product_name,
	//   p.code,
	//   s.warehouse_id,
	//   (SELECT SUM(delivered) FROM purchase_orders WHERE warehouse_id = po.warehouse_id AND product = p.id) AS system_count
	// FROM purchase_orders AS po
	//   LEFT JOIN products AS p ON p.id = po.product
	//   LEFT JOIN stocks AS s ON s.product = po.product
	//   LEFT JOIN warehouse_management AS w ON w.id = po.warehouse_id
	// WHERE po.delivery_status = 4
	// GROUP BY po.product, po.warehouse_id

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

}

?>
