<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stockout extends MY_Controller {
	public function index(){
		// $parameters['select'] = 'fullname,username';
		// $parameters['search_like'] = 'da';
		// $parameters['column_order'] = array('fullname','username');
		// $data = getrow('users',$parameters,'array',true);
		// json($data,false);

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
			'status !=' => 3,
			'type' => 1
		);
      $join = array(
         // 'company' => 'company.company_id = users.company',
         // 'position' => 'position.id = users.position'
      );
      $select = "stock_movement.stockmovement_tid,stock_movement.stockmovement_date,stock_movement.date_delivered,stock_movement.product,stock_movement.quantity,stock_movement.stockmovement_note,stock_movement.status";

      $list = $this->MY_Model->get_datatables('stock_movement',$column_order, $select, $where, $join, $limit, $offset ,$search, $order);


      $output = array(
            "draw" => $draw,
            "recordsTotal" => $list['count_all'],
            "recordsFiltered" => $list['count'],
            "data" => $list['data']
      );
      echo json_encode($output);

   }
}
?>
