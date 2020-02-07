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


      $column_order = array('stockmovement_date','date_delivered','product','quantity','stockmovemenent_note','status');
      $where = array(
			'stock_movement.status !=' => 3,
			'type' => 1
		);
      $join = array(
         // 'company' => 'company.company_id = users.company',
         'products' => 'products.id = stock_movement.product'
      );
      $select = "stock_movement.stockmovement_tid,stock_movement.stockmovement_date,stock_movement.date_delivered,stock_movement.product,stock_movement.quantity,stock_movement.stockmovement_note,stock_movement.status, products.product_name";

      $list = $this->MY_Model->get_datatables('stock_movement',$column_order, $select, $where, $join, $limit, $offset ,$search, $order);


      $output = array(
            "draw" => $draw,
            "recordsTotal" => $list['count_all'],
            "recordsFiltered" => $list['count'],
            "data" => $list['data']
      );
      echo json_encode($output);
   }

	public function deletestockOut(){

		   $stockout = $this->input->post('stockmovement_tid');
		   $stockout_status = 3;
		   $data = array(
			   'status' => $stockout_status
		   );
		   $datas['delete'] = $this->MY_Model->update('stock_movement',$data,array('stockmovement_tid' => $stockout));
		   echo json_encode($datas);
	}
}
?>
