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


			$column_order = array('code','brand','category','price','volume','status');
		 	$where = array('status !=' => 3);
			$join = array(
				// 'company' => 'company.company_id = users.company',
				// 'position' => 'position.id = users.position'
			);
			$select = "products.id,products.code,products.brand,products.category,products.price,products.volume,products.status";
			$list = $this->MY_Model->get_datatables('products',$column_order, $select, $where, $join, $limit, $offset ,$search, $order);


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

		$parameters['where'] = array('products.id'=>$product_id);
		$parameters['select'] = '*';

		$data = $this->MY_Model->getrows('products',$parameters,'row');

		$data_array['products'] = $data;
		json($data_array);

		}

		public function edit_products(){

				$products_id = $this->input->post('id');
				$post = $this->input->post();

				$result = false;

				if (!empty($post)) {
					$data = array(
						'code'  	    => $post['code'],
						'brand'  	    => $post['brand'],
						'category'    => $post['category'],
						'variant'     => $post['variant'],
						'description' => $post['description'],
						'price'       => $post['price'],
						'volume'      => $post['volume']
					);

				$update = $this->MY_Model->update('products',$data, array('id' => $products_id));
				if ($update) {
					$response = array(
						'status' => 'ok'
					);
				}else {
						$response = array(
							'status' => 'invalid'
					);
				}

					$result = json_encode($response);

				}

				die($result);

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





	// public function listofproducts_add()
	// {
	// 		$post = $this->input->post();
	// 		$result = false;
	//
	// 		if (!empty($post)) {
	// 				$postLike = !empty($post['searchfor']['term']) ? $post['searchfor']['term'] : '';
	// 				$where = $post['search_type'] == 'brand' ? "brand LIKE '%" . $postLike . "%'" : "category LIKE '%" . $postLike . "%'" : "variant LIKE '%" . $postLike . "%'" ;
	// 				$select = $post['search_type'] == 'brand' ? "brand AS product_id, brand" : "category AS product_id, category AS brand";
	// 				$group = "GROUP BY " . $post['search_type'] . " ORDER BY " . $post['search_type'] . " ASC";
	//
	// 				$list = $this->MY_Model->getRowByQuery("SELECT $select FROM " . $this->tables->products . " WHERE $where AND status = 1 $group");
	// 				$result['items'] = $list;
	// 		}
	//
	// 		die(json_encode($result));
	// }
}
