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

		$columns = array('code','Packing','Brand','Variance','Volume','Units');
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

	 public function addproducts() {

	  $this->validate_fields();
		 $data = array(
		   'code' => $this->input->post('code'),
		   'packing'=> $this->input->post('packing'),
		   'brand' => $this->input->post('brand'),
		   'variant' => $this->input->post('variant'),
		  'volume'=> $this->input->post('volume'),
		  'unit'=> $this->input->post('unit'),
		   'product_name' => $this->input->post('product_name'),
		   'category' => $this->input->post('category'),
		  'supplier' => $this->input->post('supplier'),
		  'description' => $this->input->post('description'),
		  'status' => 1
		 );
		 echo "<pre>";
		  print_r($data);
		  exit;
			  $insert = $this->MY_Model->insert('products',$data);
				if ($insert) {
					   echo json_encode( array('status'=>true));
			  }
	 }

}
