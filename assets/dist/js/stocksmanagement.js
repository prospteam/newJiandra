var base_url = $('input[name="base_url"]').val();
$(document).ready(function(){

  //display purchase_tbl
    var purchase_tbl = $('.stocks_tbl').DataTable({
         "processing": true, //Feature control the processing indicator.
         "serverSide": true, //Feature control DataTables' server-side processing mode.
         "order": [[0,'desc']], //Initial no order.
         "columns":[
              {"data":"code"},
              {"data":"product_name"},
              {"data":"delivered"},

              // {"data":"type"},
              {"data":"physical_count","render": function(data, type, row,meta){
                        // var str = '';
                        // str += '<div class="actions">';
                        // if(row.status == 1 && row.delivery_status != 4){
                        //
                        //   str += '<a href="javascript:;" class="viewPurchase" data-id="'+row.purchase_code+'"> <i class="fas fa-eye text-info"></i></a>';
                        //   str += '<a href="javascript:;" class="editPurchase" data-id="'+row.purchase_code+'"><i class="fas fa-pen text-warning"></i></a>';
                        //   str += '<a href="javascript:;" class="deletePurchase" data-id="'+row.purchase_code+'"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                        // }else if(row.status == 2 && row.delivery_status != 4){
                        //   str += '<a href="javascript:;" class="viewPurchase" data-id="'+row.purchase_code+'"> <i class="fas fa-eye text-info"></i></a>';
                        //   str += '<a href="javascript:;" class="remarks" data-id="'+row.purchase_code+'"><i class="fa fa-comment" aria-hidden="true"></i></a>';
                        //   str += '<a href="javascript:;" class="editPurchase" data-id="'+row.purchase_code+'"><i class="fas fa-pen text-warning"></i></a>';
                        //   str += '<a href="javascript:;" class="deletePurchase" data-id="'+row.purchase_code+'"><i class="fa fa-trash" aria-hidden="true"</i></a>';
                        // }else if(row.status == 3 && row.delivery_status != 4){
                        //   str += '<a href="javascript:;" class="viewPurchase" data-id="'+row.purchase_code+'"> <i class="fas fa-eye text-info"></i></a>';
                        //   str += '<a href="javascript:;" class="remarks" data-id="'+row.purchase_code+'"><i class="fa fa-comment" aria-hidden="true"></i></a>';
                        //   str += '<a href="javascript:;" class="editPurchase" data-id="'+row.purchase_code+'"><i class="fas fa-pen text-warning"></i></a>';
                        //   str += '<a href="javascript:;" class="deletePurchase" data-id="'+row.purchase_code+'"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                        // }else if(row.delivery_status == 4){
                        //   str += '<a href="javascript:;" class="remarks" data-id="'+row.purchase_code+'"><i class="fa fa-comment" aria-hidden="true"></i></a>';
                        //   str += '<a href="javascript:;" class="viewPurchase" data-id="'+row.purchase_code+'"> <i class="fas fa-eye text-info"></i></a>';
                        // }
                        // str += '</div>';
                        // return str;
                   }
              },

              {"data":"variance","render": function(data, type, row,meta){
                  // var str = '';
                  //  if(row.status == 1){
                  //    str += '<a href="javascript:;" class="btn btn-block btn-sm btn-primary status" data-status="'+row.delivery_status+'" data-id="'+row.purchase_code+'">pending</a>';
                  //  }else if(row.status == 2){
                  //    if(row.delivery_status == 4){
                  //      str += '<a href="javascript:;" class="inactive btn btn-block btn-sm btn-success" data-status="'+row.delivery_status+'" data-id="'+row.purchase_code+'" disabled>approved</a>';
                  //    }else{
                  //      str += '<a href="javascript:;" class="inactive btn btn-block btn-sm btn-success status" data-status="'+row.delivery_status+'" data-id="'+row.purchase_code+'">approved</a>';
                  //    }
                  //  }else if(row.status == 3){
                  //    str += '<a href="javascript:;" class="active btn btn-block btn-sm btn-danger status" data-status="'+row.delivery_status+'" data-id="'+row.purchase_code+'">cancelled</a>';
                  //  }
                  //  return str;
              }
            }

         ],
         // Load data for the table's content from an Ajax source
         "ajax": {
              "url":base_url+"stocksmanagement/display_delivered_products/",
              "type": "POST"
         },
         //Set column definition initialisation properties.
         "columnDefs": [
              {
                   "targets": [2,3], //first column / numbering column
                   "orderable": false, //set not orderable

               },
          ],
      });
  //end display purchase_tbl

});
