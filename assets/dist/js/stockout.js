
var base_url = $('input[name="base_url"]').val();

$(document).ready(function(){

   $(document).on("click",'.deletestockOut', function(e) {
     e.preventDefault();
     var stockmovement_tid = $(this).attr('data-id');
     console.log(stockmovement_tid);

     Swal.fire({
     title: 'Are you sure?',
     text: "You want to permanently delete this Stock Out!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#068101',
     confirmButtonText: 'Yes, Permanently Delete Stock Out!',
     }).then((result) => {
       if (result.value) {
         Swal.fire(
           'Deleted!',
           'Successfully Deleted Stock Out!',
           'success'
         )
           $.ajax({
           type: 'POST',
             url:base_url + 'Stockout/deletestockout',
             data: {stockmovement_tid: stockmovement_tid},
             success:function(data) {
               $(".stockout_tbl").DataTable().ajax.reload();
             }
           })
       }
     });

     });

          $(document).on("click",".editstockout", function(){
           var stockmovement_tid = $(this).attr('data-id');

           $.ajax({
               method: 'POST',
               url: base_url+'stockout/editstockout',
               data: {stockmovement_tid:stockmovement_tid},
               dataType: "json",
               success: function(data){
                  console.log(data);
                    $('#editStockOut').modal('show');
                    $('#editstockout .stockout_id').val(data.stock_movement.stockmovement_tid);
                    $('#editstockout input[name="sodate"]').val(data.stock_movement.stockmovement_date);
                    $('#editstockout select[name="so_type"]').val(data.stock_movement.type);
                    $('#editstockout select[name="so_datedelivered"]').val(data.stock_movement.transferred_warehouse);
                    $('#editstockout input[name="prod_code[]"]').val(data.stock_movement.date_delivered);
                    $('#editstockout input[name="prod_name[]"]').val(data.stock_movement.product);
                    $('#editstockout input[name="remaining_stocks[]"]').val(data.stocks.physical_count);
                    $('#editstockout input[name="quantity[]"]').val(data.stock_movement.quantity);
                    $('#editstockout input[name="stockmovement_note"]').val(data.stock_movement.stockmovement_note);
                    $('#editstockout input[name="total_quantity"]').val(data.products.code);
                  }
           });

          });
     var stockout_tbl = $('.stockout_tbl').DataTable({
    "processing"  : true,
    "serverside"  : true,
    "order"       : [[0,'desc']],
    "columns"     :[
           {"data":"stockmovement_date"},
           {"data":"date_delivered"},
           {"data":"stockmovement_code"},
           // {"data":"stockmovement_qty"},
           // {"data":"stockmovement_note"},
           {"data":"stockmovement_note","render": function(data, type, row,meta){
                var str = '';
                if(row.stockmovement_note == '') {
                  str += 'None';
                }else{
                  str += row.stockmovement_note;
                }
                return str;
              }
            },
           {"data":"action","render": function(data, type, row,meta){
                             var str = '';
                             str += '<div class="actions">';
                             if(row.status == 1) {
                               str += '<a href="javascript:;" class="viewstockout" data-id="'+row.stockmovement_code+'"> <i class="fas fa-eye text-info"></i></a>';
                               str += '<a href="javascript:;" class="editstockout" data-id="'+row.stockmovement_code+'"><i class="fas fa-pen text-warning"></i></a>';
                               str += '<a href="javascript:;" class="deletestockOut" data-id="'+row.stockmovement_code+'"><i class="fa fa-trash" aria-hidden="true"></a>';
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
               "url":base_url+"Stockout/disp_stockout/",
               "type": "POST"
          },
          //Set column definition initialisation properties.
          "columnDefs": [
               {
                    "targets": [3,4,5], //first column / numbering column
                    "orderable": false, //set not orderable

                },
           ],
       });


       //view list of Orders
       $(document).on('click', '.viewstockout', function(){
          var id = $(this).attr('data-id');
          $.ajax({
            method: 'POST',
            url: base_url + 'stockout/view_stockouts',
            data: {id:id},
            dataType: "json",
            success: function(data){
              console.log(data);
              $('#ViewStockout').modal('show');
              var str = '';
              var total_quantity = 0;
               $.each(data.stockout,function(index,element){
                 total_quantity = parseFloat(total_quantity) + parseFloat(element.quantity);
                 $('.code').text(element.stockmovement_code);
                 $('.date_ordered').text(element.stockmovement_date);
                 $('.date_delivered').text(element.date_delivered);

                 str += '<tr>';
                    str +=     '<td class="purch_td">';
                      str +=   element.code;
                    str += '</td>';
                    str +=  '<td class="purch_td">';
                      str +=   element.product_name;
                    str += '</td>';
                    str += ' <td class="purch_td qty">';
                      str += element.quantity;
                      str += '</td>';
                  str += '</tr>';

                  $('.note').text(element.stockmovement_note);
               });
               $('.qty').val(total_quantity);
               $('#view_stockouts tbody').html(str);
            }

       });
     });

});
