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
		if(!empty($_FILES['csv_import']['name'])){
		 $file_data = fopen($_FILES['csv_import']['tmp_name'], 'r');
		 $column = fgetcsv($file_data);
         while($row = fgetcsv($file_data)){
		  $row_data[] = array(
		   'code'  		=> $row[0],
		   'packing'    => $row[1],
		   'brand'  	=> $row[2],
		   'volume'  	=> $row[4],
		   'units' 		=> $row[5],
		  );
		 }
		 echo "<pre>";
		  print_r($file_data);
		  exit();

		 $output = array(
		  'column'  => $column,
		  'row_data'  => $row_data
		 );

		 echo json_encode($output);

		}

	}

}
