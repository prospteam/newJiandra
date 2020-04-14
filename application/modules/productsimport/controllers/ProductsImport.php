<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductsImport extends MY_Controller {

	public function __construct(){
		parent::__construct();
		// header('Access-Control-Allow-Origin: *');
		// header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		// header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		//
		// $this->load->library('CSVReader');
		// $this->load->library('form_validation');
		// $this->load->helper('file');
		// $this->load->helper('security');
	}

	public function index(){
    	$this->load_page('productsimport');
	}

	public function prod_import(){
		// $product_id = $this->input->post('id');
		// $row = $this->input->post();
		// $result = false;
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

}
