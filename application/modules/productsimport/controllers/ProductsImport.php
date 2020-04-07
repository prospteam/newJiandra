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

}
