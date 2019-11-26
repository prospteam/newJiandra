<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller {

	public function __construct(){
		parent::__construct();

	}

	public function index(){
		// $parameters['select'] = '*';
		// $data['users'] = $this->MY_Model->getRows('users',$parameters);
		// $parameters['where'] = array('id !=' => 1);
		// $parameters['select'] = '*';
		// $data['position'] = $this->MY_Model->getRows('position',$parameters);
    $this->load_page('products');
	}

  public function addproducts()
  {
    $this->load->library("form_validation");

    $this->form_validation->set_rules('code','Code','required');
    $this->form_validation->set_rules('brand','Brand','required');
    $this->form_validation->set_rules('category','Category','required');
    $this->form_validation->set_rules('variant','Variant','required');
    $this->form_validation->set_rules('description','Description','required');
    $this->form_validation->set_rules('price','Price','required');
    $this->form_validation->set_rules('volume','Volume','required');
		$error = array();

    if ($this->form_validation->run() !== FALSE) {
      $data = array(
        'code' => $this->input->post('code'),
        'brand' => $this->input->post('brand'),
        'category' => $this->input->post('category'),
        'variant' => $this->input->post('variant'),
        'description' => $this->input->post('description'),
        'price' => $this->input->post('price'),
        'volume'=> $this->input->post('volume'),
        'status' => 1
      );

        $insert = $this->MY_Model->insert('products',$data);
          if ($insert) {
              $response = array(
                'status'=>'ok'
              );
            }
        }   else {
          $response = array('form_error'=> array_merge($this->form_validation->error_array(),$error) );
        }
        echo json_encode($response);
  }
	 function display_products(){
			$limit = $this->input->post('length');
			$offset = $this->input->post('start');
			$search = $this->input->post('search');
			$order = $this->input->post('order');
			$draw = $this->input->post('draw');


			$column_order = array('code','brand','category','variant','description','price','volume',);
			$where = array('products.status' => 1);
			$join = array(
				// 'company' => 'company.company_id = users.company',
				// 'position' => 'position.id = users.position'
			);
			$select = "products.id,products.code,products.brand,products.category,products.variant,products.description,products.price,products.volume";
			$list = $this->MY_Model->get_datatables('products',$column_order, $select, $where, $join, $limit, $offset ,$search, $order);


			$output = array(
					"draw" => $draw,
					"recordsTotal" => $list['count_all'],
					"recordsFiltered" => $list['count'],
					"data" => $list['data']
			);


			echo json_encode($output);
		}


}
