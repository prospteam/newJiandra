<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PoImport extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('csvimport');
	}

	public function index(){
    	 $this->load_page('poimport');
	}

	public function po_import(){
		$file_data = $this->csvimport->get_array($_FILES["csv_file_pos"]["tmp_name"]);

		foreach ($file_data as $value) {
			foreach ($value as $key1 => $value1) {
				$explode_value = explode(';',$value1);

				$data = array(
					'date_ordered' => $explode_value[0],
					'purchase_code'  => '003',
					'product'  => '1',
					'quantity'  => $explode_value[3],
					'unit_price'  => $explode_value[4],
					'delivered'  => $explode_value[5],
					'date_delivered'  => $explode_value[6],
					'supplier'  => $explode_value[7],
					'company'  => $explode_value[8],
					'warehouse_id'  => '18',
					'note'  => '',
					'status'  => '1',
					'delivery_status'  => '1',
					'remarks'  => '',
					'delivery_remarks'  => '',
					'order_status'  => '1',
				);
			}
			$explode_key = explode(';', $key1);

			$output = array(
				'column' => $explode_key,
				'row_data' => $data,
			);

			echo "<pre>";
			print_r($output);
		}
	}

}
