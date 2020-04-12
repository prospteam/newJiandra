<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductsImport extends MY_Controller {

	public function __construct(){
		parent::__construct();

	}

	public function index(){
		// $parameters['where'] = array('id !=' => 0);
		// $parameters['select'] = '*';
		// $data['supplier'] = $this->MY_Model->getRows('supplier',$parameters);
		// $data['products_cost_price'] = $this->MY_Model->getRows('products_cost_price',$parameters);
		// $data['users'] = $this->MY_Model->getRows('users',$parameters);
		// $parameters['where'] = array('id !=' => 1);
		// $parameters['select'] = '*';
		// $data['position'] = $this->MY_Model->getRows('position',$parameters);
    $this->load_page('productsimport');
	}

	public function prod_import(){
		// $product_id = $this->input->post('id');
		// $post = $this->input->post();
		// $result = false;

		if(!empty($_FILES['csv_import']['name'])){
		 $file_data = fopen($_FILES['csv_import']['tmp_name'], 'r');
		 $column = fgetcsv($file_data);
		 while($post = fgetcsv($file_data)){

		  $row_data[] = array(
		   'code'  		=> $post[0],
		   'packing'    => $post[1],
		   'brand'  	=> $post[2],
		   'variance'   => $post[3],
		   'volume'  	=> $post[4],
		   'units' 		=> $post[5],
		  );
		 }

		 $output = array(
		  'column'  => $column,
		  'row_data'  => $row_data
		 );

		 echo json_encode($output);

		}

	}

}
