public function edit_stocktransfer(){

   $post = $this->input->post();
   echo "<pre>";
    print_r($post);
    exit;
   // foreach($post['isEdit'] as $key => $value){
   // 	print_r($post['prod_code'][$key]);
   // 	if($value == 1){
   // 		echo $post['prod_code'][$key].' = '.$post['prod_name'][$key].' is for Edit<br>';
   // 	} else {
   // 		echo $post['prod_code'][$key].' = '.$post['prod_name'][$key].' is for Add<br>';
   // 	}
   // }
   // exit;
   $this->load->library("form_validation");

   $this->form_validation->set_rules('edit_prod_code[]', 'SKU', 'required');
   $this->form_validation->set_rules('edit_prod_name[]', 'Product Name', 'required');
   $this->form_validation->set_rules('edit_remaining_stocks[]', 'Remaining Stocks', 'required');
   $this->form_validation->set_rules('edit_quantity[]', 'Quantity', 'required');
   $error = array();

      if(!empty($post['prod_code'])){
            foreach($post['prod_code'] as $pkey => $pVal){
               // if($value['isEdit'] == 1){
               //
               // } else {
               //
               // }
               if ($this->form_validation->run() !== FALSE) {
                     $data = array(
                           'stockmovement_date' => $post['sodate'],
                           'type' => $post['so_type'],
                           'date_delivered' => $post['so_datedelivered'],
                           'product' => $pVal,
                           'stockmovement_code' => $post['edit_prod_code'][$pkey],
                           'physical_count' => $post['edit_remaining_stocks'][$pkey],
                           'quanity' => $post['edit_quantity'],
                           'status' => 1,
                           'delivery_status' => 1
                        );
                        $add = $this->MY_Model->insert('stock_movement', $data,array('stockmovement_id' => $post['stocktransfer_id'][$pkey]));
                        if ($add) {
                           $response = array(
                              'status' => 'ok'
                           );
                        }
               }else{
                  $response = array('form_error' =>  array_merge($this->form_validation->error_array(), $error) );
               }
         }
      }
         $data = array(
            'stockmovement_date' => $post['sodate'],
            'type' => $post['so_type'],
            'date_delivered' => $post['so_datedelivered'],

         );
         $update1 = $this->MY_Model->update('stock_movement', $data, array('stockmovement_id' => $post['stocktransfer_id']));

         foreach($post['stocktransfer_id'] as $pkey => $pVal){
            $data = array(
               // 'stockmovement_id' => $post['stockmovement_id'],
               'product' => $post['prod_code'][$pkey],
               'remaining_stocks' => $post['remaining_stocks'][$pkey],
               'quantity' => $post['quantity'][$pkey],
            );
            $update = $this->MY_Model->update('stock_movement', $data, array('id' => $post['stocktransfer_id'][$pkey]));
            if ($update) {
               $response = array(
                  'status' => 'ok'
               );
            }	else if ($update1) {
               $response = array(
                  'status' => 'ok'
               );
            }

      }
   echo json_encode($response);
