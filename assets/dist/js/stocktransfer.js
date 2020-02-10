
var base_url = $('input[name="base_url"]').val();

$(document).ready(function(){
// DELETE STOCK TRANSFER
   $(document).on("click",'.deletestockTransfer', function(e) {
     e.preventDefault();
     var stockmovement_tid = $(this).attr('data-id');
     console.log(stockmovement_tid);

     Swal.fire({
     title: 'Are you sure?',
     text: "You want to permanently delete this Stock Transfer!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#068101',
     confirmButtonText: 'Yes, Permanently Delete Stock Transfer!',
     }).then((result) => {
       if (result.value) {
         Swal.fire(
           'Deleted!',
           'Successfully Deleted Stock Transfer!',
           'success'
         )
           $.ajax({
           type: 'POST',
             url:base_url + 'Stocktransfer/deleteTransfer',
             data: {stockmovement_tid: stockmovement_tid},
             success:function(data) {
               $(".stocksmov_tbl").DataTable().ajax.reload();
             }
           })
       }
     });

     });
     // END DELETE STOCK TRANSFER

     // EDIT STOCK TRANSFER

     $(document).on("click",".editstocktransfer", function(){
      var stockmovement_tid = $(this).attr('data-id');

      $.ajax({
          method: 'POST',
          url: base_url+'stocktransfer/editStockTransfer',
          data: {stockmovement_tid:stockmovement_tid},
          dataType: "json",
          success: function(data){
             console.log(data);
               $('#editStockTransfer').modal('show');
               $('#editstocktransfer .stocktransfer_id').val(data.stock_movement.stockmovement_tid);
               $('#editstocktransfer input[name="sodate"]').val(data.stock_movement.stockmovement_date);
               $('#editstocktransfer select[name="so_type"]').val(data.stock_movement.type);
               $('#editstocktransfer select[name="so_datedelivered"]').val(data.stock_movement.transferred_warehouse);
               $('#editstocktransfer input[name="prod_code[]"]').val(data.stock_movement.date_delivered);
               $('#editstocktransfer input[name="prod_name[]"]').val(data.stock_movement.product);
               $('#editstocktransfer input[name="remaining_stocks[]"]').val(data.stocks.physical_count);
               $('#editstocktransfer input[name="quantity[]"]').val(data.stock_movement.quantity);
               $('#editstocktransfer input[name="stockmovement_note"]').val(data.stock_movement.stockmovement_note);
               $('#editstocktransfer input[name="total_quantity"]').val(data.products.code);
             }
      });

     });

     // EDIT STOCK TRANSFER
   var stocksmov_tbl = $('.stocksmov_tbl').DataTable({
  "processing"  : true,
  "serverside"  : true,
  "order"       : [[0,'desc']],
  "columns"     :[
         {"data":"stockmovement_date"},
         {"data":"wh_name"},
         {"data":"date_delivered"},
         {"data":"product_name"},
         {"data":"quantity"},
         {"data":"stockmovement_note"},
         // {"data":"variant"},
         // // {"data":"description"},
         // {"data":{'volume'}},

         // {"data":"unit"},
         {"data":"action","render": function(data, type, row,meta){
                           var str = '';
                           str += '<div class="actions">';
                           if(row.status == 1) {
                             str += '<a href="javascript:;" class="editstocktransfer" data-id="'+row.stockmovement_tid+'"><i class="fas fa-pen text-warning"></i></a>';
                             str += '<a href="javascript:;" class="deletestockTransfer" data-id="'+row.stockmovement_tid+'"><i class="fa fa-trash" aria-hidden="true"></a>';
                           }
                           str += '</div>';
                           return str;
                      }
                 },

           {"data":"status","render": function(data, type, row,meta){
                   var str = '';
                    if(row.status == 1){
                      str += '<span class="active btn btn-block btn-sm btn-success">active</button>';
                    }else if(row.status == 2){
                      str += '<span class="inactive btn btn-block btn-sm btn-danger">inactive</button>';
                    }
                    return str;
               }
             }
         ],

         "ajax": {
             "url":base_url+"Stocktransfer/disp_stocktransfer/",
             "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
             {
                  "targets": [6,7], //first column / numbering column
                  "orderable": false, //set not orderable

              },
         ],
     });


});
