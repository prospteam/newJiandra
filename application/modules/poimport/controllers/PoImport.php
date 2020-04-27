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

		$fileName = $_FILES["csv_file_pos"]["tmp_name"];
		$file = fopen($fileName, "r");
		$data_product = array();
		while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
			$data_product[] = $column;
		}

		$columns = array('Date Order','Purchase Code','Product','Quantity','Price');
		$finish_product = array();
		foreach($data_product as $key => $value){
			if($key == 0) continue;
			foreach($value as $k => $val){
				$finish_product[$key][$columns[$k]] = $val;
			}
		}

		 $output = array(
		  'column'  => $columns,
		  'row_data'  => $finish_product
		 );
		 // echo "<pre>";
		 //  print_r($output);
		 //  exit;

		//
		echo json_encode($output);

	}

	public function submit_import(){

		//echo $_POST['date_ordered'][0];

		// $data = array(
		// 	'date_ordered' => $_POST['date_ordered'][0]
		// );
		//
		// echo "<pre>";
		// print_r($data);
		//  exit;

		$ctr = 0;
		$data = array();
		foreach ($_POST as $key => $value) {
				foreach ($value as $key1 => $value1) {

				}
				$data[$key] = $value[$key1];

		}
		$data['delivery_status'] = 1;
		$data['status'] = 1;
		$data['supplier'] = 45;
		$data['company'] = 1;
		echo "<pre>";
		 print_r($data);
		 exit;

		$insert = $this->MY_Model->insert('purchase_orders', $data);

		if($insert){
			$response = "CSV file successfully imported";
		}else{
			$response = "Error!";
		}

		echo json_encode($response);
	}

}
