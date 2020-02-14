<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stockout extends MY_Controller {
	public function index(){
		// $parameters['select'] = 'fullname,username';
		// $parameters['search_like'] = 'da';
		// $parameters['column_order'] = array('fullname','username');
		// $data = getrow('users',$parameters,'array',true);
		// json($data,false);
		$data['products'] = $this->MY_Model->getrows('products');
		$this->load_page('stockout');
	}

   function disp_stockout(){

      $limit = $this->input->post('length');
      $offset = $this->input->post('start');
      $search = $this->input->post('search');
      $order = $this->input->post('order');
      $draw = $this->input->post('draw');


      $column_order = array('stockmovement_date','date_delivered','stockmovement_code','stockmovemenent_note','status');
      $where = array(
			'stock_movement.status !=' => 3,
			'type' => 1
		);
			$group = array('stock_movement.stockmovement_code');
      $join = array(
         // 'company' => 'company.company_id = users.company',
         'products' => 'products.id = stock_movement.product'
      );
      $select = "stock_movement.stockmovement_id,stock_movement.stockmovement_date,stock_movement.date_delivered,stock_movement.product,stock_movement.stockmovement_note,stock_movement.status, products.product_name,stock_movement.stockmovement_code, (SELECT COUNT(stock_movement.stockmovement_code) FROM stock_movement WHERE stock_movement.stockmovement_code = stock_movement.stockmovement_code ) as stockmovement_qty";

      $list = $this->MY_Model->get_datatables('stock_movement',$column_order, $select, $where, $join, $limit, $offset ,$search, $order,$group);


      $output = array(
            "draw" => $draw,
            "recordsTotal" => $list['count_all'],
            "recordsFiltered" => $list['count'],
            "data" => $list['data']
      );
      echo json_encode($output);
   }

	public function deletestockOut(){

		   $stockout = $this->input->post('stockmovement_id');
		   $stockout_status = 3;
		   $data = array(
			   'status' => $stockout_status
		   );
		   $datas['delete'] = $this->MY_Model->update('stock_movement',$data,array('stockmovement_id' => $stockout));
		   echo json_encode($datas);
	}
	public function editstockout(){
		$stockout_id = $this->input->post('stockmovement_id');

		$data_array = array();

		$parameters['where'] = array('stock_movement.stockmovement_id'=>$stockout_id);
		$parameters['select'] = '*';

		$data = $this->MY_Model->getrows('stock_movement',$parameters,'row');

		$data_array['stock_movement'] = $data;
		json($data_array);

	}

	//view list of orders
	public function view_stockouts(){
		$stockmovement_id = $this->input->post('id');
		// echo "<pre>";
		// print_r($this->input->post());
		// exit;
		$parameters['where'] = array('stock_movement.stockmovement_code' => $stockmovement_id, 'type' => 1);
		// $parameters['group'] = array('stock_movement.stockmovement_code');
		$parameters['join'] = array('products' => 'products.id = stock_movement.product');
		$parameters['select'] = 'stock_movement.*, products.id AS product_id, products.*';

		$data = $this->MY_Model->getRows('stock_movement',$parameters);

		$data_array['stockout'] = $data;
		// exit;
		// echo "<pre>";
		// print_r($data_array);
		// exit;

		json($data_array);
	}

}
?>
