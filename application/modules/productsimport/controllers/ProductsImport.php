<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductsImport extends MY_Controller {

	public function __construct(){
		parent::__construct();

	}

	public function index(){
    	$this->load_page('productsimport');
	}

	public function prod_import(){

		$fileName = $_FILES["csv_import"]["tmp_name"];
		$file = fopen($fileName, "r");
		$data_product = array();
		while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
			$data_product[] = $column;
		}

		$columns = array('Code','Packing','Brand','Variance','Volume','Unit', 'Product_Name', 'Category', 'Supplier', 'Description', 'Status');
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

		echo json_encode($output);

	 }

	 	public function addproducts(){

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
			// echo "<pre>";
			//  print_r($data);
			//  exit;

	 		$insert = $this->MY_Model->insert('products', $data, 'row');

	 		if($insert){
	 			$response = "Products Successfully Imported";
	 		}else{
	 			$response = "Error!";
	 		}

	 		echo json_encode($response);
	 	}

}
