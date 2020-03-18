<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller {

	public function __construct(){
		parent::__construct();

	}

	public function index(){
		$parameters['where'] = array('id !=' => 0);
		$parameters['select'] = '*';
		$data['supplier'] = $this->MY_Model->getRows('supplier',$parameters);
		$data['products_cost_price'] = $this->MY_Model->getRows('products_cost_price',$parameters);
		// $data['users'] = $this->MY_Model->getRows('users',$parameters);
		// $parameters['where'] = array('id !=' => 1);
		// $parameters['select'] = '*';
		// $data['position'] = $this->MY_Model->getRows('position',$parameters);
    $this->load_page('products',$data);
	}

  public function addproducts() {

	$this->validate_fields();
      $data = array(
        'code' => $this->input->post('code'),
		'volume'=> $this->input->post('volume'),
		'unit'=> $this->input->post('unit'),
		'packing'=> $this->input->post('packing'),
		'brand' => $this->input->post('brand'),
        'product_name' => $this->input->post('product_name'),
        'category' => $this->input->post('category'),
        'variant' => $this->input->post('variant'),
		'supplier' => $this->input->post('supplier'),
		'description' => $this->input->post('description'),
        'status' => 1
      );
	        $insert = $this->MY_Model->insert('products',$data);
	          if ($insert) {
	                 echo json_encode( array('status'=>true));
			}
  }

	  public function add_cost_price(){

		  $this->load->library("form_validation");
		  $this->form_validation->set_rules('cost_price','Cost Price','required');
		  $this->form_validation->set_rules('sell_price','Selling Price', 'required');
		  $this->form_validation->set_rules('effective_date','Effective Date', 'required');

		  	if ($this->form_validation->run() !== FALSE) {
		  		$data = array(
					'cost_price'  					=> $this->input->post('cost_price', 'Cost Price', 'required'),
					'sell_price' 					=> $this->input->post('sell_price','Selling Price', 'required'),
					'effective_date'				=> $this->input->post('effective_date','Effective Date', 'required'),
					'fk_product_id'					=> $this->input->post('product_id'),
					'added_by'						=> $this->session->userdata('id')
				);

				$insert = $this->MY_Model->insert('products_cost_price', $data);
				if ($insert) {
					$response = array(
						'status'  => 'ok',
						'id' => $insert,
					);
				}
		  	}else {
		  		$response = array('form_error' => array_merge($this->form_validation->error_array(), $error) );
		  	}
			echo json_encode($response);
	}

    function display_products(){
			$limit = $this->input->post('length');
			$offset = $this->input->post('start');
			$search = $this->input->post('search');
			$order = $this->input->post('order');
			$draw = $this->input->post('draw');


			$column_order = array('p.code','p.product_name','s.supplier_name','p.brand','p.category','p.packing','p.volume','p.unit','p.status');
		 	$where = array('p.status !=' => 3);
			$join = array(
				'supplier as s' => 's.id = p.supplier'
				// 'position' => 'position.id = users.position'
			);
			$select = "p.id,p.code,p.packing,p.product_name,p.brand,p.category,p.volume,p.unit,p.status, s.supplier_name";
			$list = $this->MY_Model->get_datatables('products as p',$column_order, $select, $where, $join, $limit, $offset ,$search, $order);


			$output = array(
					"draw" => $draw,
					"recordsTotal" => $list['count_all'],
					"recordsFiltered" => $list['count'],
					"data" => $list['data']
			);

			echo json_encode($output);
		}

		public function view_all_products(){
			$product_id = $this->input->post('id');

			$data_array = array();
			$parameters['select'] = '*';
			$parameters['where'] = array('products.id'=>$product_id);
			$parameters['join'] = array('supplier as s' => 's.id = products.supplier');
			$data = $this->MY_Model->getrows('products',$parameters,'row');

			$data_array['products'] = $data;
			json($data_array);

		}
		public function cost_sell_edit(){
			$product_id = $this->input->post('id');
			$data_array = array();
			// $parameters['select'] = '*';
			$parameters['select'] = 'products_cost_price.id as cost_id, , products_cost_price.cost_price, products_cost_price.sell_price, products_cost_price.added_by,
			 products_cost_price.effective_date,products_cost_price.date_updated, products_cost_price.status, products_cost_price.fk_product_id, products.volume, products.packing, products.unit, products.brand, products.product_name';

			$parameters['where'] = array('fk_product_id'=>$product_id);
			$parameters['join']   = array('products' => 'products.id = products_cost_price.fk_product_id');

			$data = $this->MY_Model->getrows('products_cost_price',$parameters);
			// echo $this->db->last_query();
			// echo "<pre>";
			//  print_r($data);
			//  exit;
			$data_array['cost_price'] = $data;
			json($data_array);

		}
		public function edit_cost_sell_price(){
			$cost_id = $this->input->post('id');
			$post = $this->input->post();
			$result = false;

			if (!empty($post)) {
				$data = array(
						// 'id'
						'cost_price'     => $post['cost_price'],
						'sell_price'	 => $post['sell_price'],
						'effective_date' => $post['effective_date'],

				);

				$update = $this->MY_Model->update('products_cost_price', $data, array('id' => $cost_id) );

				if ($update) {
					$response = array('status'  => 'ok');
				}else {
					$response = array('status'  => 'invalid');
				}
					$result = json_encode($response);
				}
				die($result);
			}

		public function edit_products(){

				$products_id = $this->input->post('id');
				$post = $this->input->post();
				$result = false;

				if (!empty($post)) {
					$data = array(
						'code'  	   				  => $post['code'],
						'product_name'  	   		  => $post['product_name'],
						'brand'  	   				  => $post['brand'],
						'packing'					  => $post['packing'],
						'category'    				  => $post['category'],
						'variant'    				  => $post['variant'],
						'volume'    				  => $post['volume'],
						'unit'       				  => $post['unit'],
						'supplier'					  => $post['supplier_edit'],
						'description'				  => $post['description']
					);
				$update = $this->MY_Model->update('products', $data, array('id' => $products_id));

				if ($update) {
					$response = array('status' => 'ok');
				}else {
						$response = array('status' => 'invalid');
				}
					$result = json_encode($response);
				}
				die($result);
			}

		public function edit_cost_price(){

			$cost_id = $this->input->post('id');
			$data_array = array();

			$parameters['select'] = '*';
			$parameters['where'] = array('id'=>$cost_id);

			$data = $this->MY_Model->getrows('products_cost_price',$parameters);

			$data_array['products_cost_price'] = $data;

			json($data_array);
		}

		public function enable_products(){

				$product_id = $this->input->post('id');
				$products_status = 1;
				$data = array(
					'status' => $products_status
				);
				$datas['delete'] = $this->MY_Model->update('products',$data,array('id' => $product_id));
				echo json_encode($datas);
		}
		public function disable_products(){

				$product_id = $this->input->post('id');
				$products_status = 2;
				$data = array(
					'status' => $products_status
				);
				$datas['delete'] = $this->MY_Model->update('products',$data,array('id' => $product_id));
				echo json_encode($datas);
		}

	//delete Supplier
		public function deleteProducts(){
				$products_id = $this->input->post('id');
				$products_status = 3;
				$data = array(
					'status' => $products_status
				);
				$datas['delete'] = $this->MY_Model->update('products',$data,array('id' => $products_id));
				// echo $this->db->last_query();
				echo json_encode($datas);
		}

		public function delete_price(){
				$cost_id = $this->input->post('id');
				$cost_status = 3;
				$data = array(
					'status' => $cost_status
				);
				$datas['delete'] = $this->MY_Model->update('products_cost_price',$data,array('id' => $cost_id));
				// echo $this->db->last_query();
				echo json_encode($datas);
		}
		// }
		public function listofproducts_add(){

				$post = $this->input->post();
				$result = false;

				$where = "";
				$select = "";

				if (!empty($post)) {
						$postLike = !empty($post['searchfor']['term']) ? $post['searchfor']['term'] : '';
						// $where = $post['search_type'] == 'brand' ? "brand LIKE '%" . $postLike . "%'" : "category LIKE '%" . $postLike . "%'";
						if ($post['search_type'] == 'product_name') {
							$where = "product_name LIKE '%" . $postLike . "%'";
							$select = "product_name AS product_id, product_name";
						}else if ($post['search_type']== 'brand') {
							$where = "brand LIKE '%" . $postLike . "%'";
							$select = "brand AS product_id, brand AS product_name";
						}else if($post['search_type']== 'volume') {
							$where = "volume LIKE '%" . $postLike . "%'";
							$select = "volume AS product_id, volume AS product_name";
						} else if ($post['search_type']== 'packing') {
							$where = "packing LIKE '%" . $postLike . "%'";
							$select = "packing AS product_id, packing AS product_name";
						} else if ($post['search_type'] == 'category') {
						 	$where = "category LIKE '%" . $postLike . "%'";
						 	$select = "category AS product_id, category AS product_name";
				 	  } else if ($post['search_type'] == 'variant') {
							$where = "variant LIKE '%" . $postLike . "%'";
						 	$select = "variant AS product_id, variant AS product_name";
				 	  }	else {
					 		$where = "unit LIKE '%" . $postLike . "%'";
					 		$select = "unit AS product_id, unit AS product_name";
					  }

						$group = "GROUP BY " . $post['search_type'] . " ORDER BY " . $post['search_type'] . " ASC";
						$list = $this->MY_Model->getRowByQuery("SELECT $select FROM " . $this->tables->products . " WHERE $where AND status = 1 $group");

						$result['items'] = $list;
				}
				die(json_encode($result));
		}


	public function listofproducts_edit()
	{

			$post = $this->input->post();
			$result = false;

			$where = "";
			$select = "";

			if (!empty($post)) {
					$postLike = !empty($post['searchfor']['term']) ? $post['searchfor']['term'] : '';
					// $where = $post['search_type'] == 'brand' ? "brand LIKE '%" . $postLike . "%'" : "category LIKE '%" . $postLike . "%'";
					if ($post['search_type'] == 'product_name') {
						$where = "product_name LIKE '%" . $postLike . "%'";
						$select = "product_name AS product_id, product_name";
					} else if ($post['search_type'] == 'volume') {
						$where = "volume LIKE '%" . $postLike . "%'";
						$select = "volume AS product_id, volume AS product_name";
					} else if ($post['search_type'] == 'unit') {
						$where = "unit LIKE '%" . $postLike . "%'";
						$select = "unit AS product_id, unit AS product_name";
					} else if ($post['search_type'] == 'packing') {
						$where = "packing LIKE '%" . $postLike . "%'";
						$select = "packing AS product_id, packing AS product_name";
					} else if ($post['search_type'] == 'brand') {
						$where = "brand LIKE '%" . $postLike . "%'";
						$select = "brand AS product_id, brand AS product_name";
					} else if ($post['search_type'] == 'category') {
						$where = "category LIKE '%" . $postLike . "%'";
						$select = "category AS product_id, category AS product_name";
					} else {
						$where = "variant LIKE '%" . $postLike . "%'";
						$select = "variant AS product_id, variant AS product_name";
					}
					//  else {
					// 	$where = "unit LIKE '%" . $postLike . "%'";
					// 	$select = "unit AS product_id, variant AS product_name";
					// }
					// $select = $post['search_type'] == 'brand' ? "brand AS product_id, brand" : "category AS product_id, category AS brand";

					$group = "GROUP BY " . $post['search_type'] . " ORDER BY " . $post['search_type'] . " ASC";
					$list = $this->MY_Model->getRowByQuery("SELECT $select FROM " . $this->tables->products . " WHERE $where AND status = 1 $group");

					$result['items'] = $list;
			}
			die(json_encode($result));
	}


}
