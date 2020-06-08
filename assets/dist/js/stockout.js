
var base_url = $('input[name="base_url"]').val();

$(document).ready(function(){

   $(document).on("click",'.deletestockOut', function(e) {
     e.preventDefault();
     var stockmovement_id = $(this).attr('data-id');
     console.log(stockmovement_id);

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
             data: {stockmovement_id: stockmovement_id},
             success:function(data) {
               $(".stockout_tbl").DataTable().ajax.reload();
             }
           })
       }
     });

     });
     // $('.addNewStockOut_edit')
   $(document).on('click', '#addNewStockOut_edit', function(){
      var x = 1;
      var str = '';

      str+= '<tr>';
         str+= ' <td class="purch_td">';
            str += '<select class="form-control js-example-basic-multiple-editStockTransfer select2_edit edit_new_code" style="width: 100%;" name="prod_code[]" data-id="" value="">';
               str += '<option value="" selected="true" disabled="disabled">Select SKU</option>';
                  str += get_edit_products();
            str+= ' </select>';
            str+= ' <span class="err"></span>';
         str+= '</td>';
         str+= ' <td class="purch_td">';
            str+= '<input type="text" class="form-control prod_name" name="prod_name[]" value="" readonly>';
            str+= ' <span class="err"></span>';
         str+= '</td>';
         str+= '<td class="purch_td">';
            str+= '<input type="text" class="form-control remaining_stocks" name="remaining_stocks[]" value="" readonly>';
            str+= ' <span class="err"></span>';
         str+= ' </td>';
         str+= ' <td class="purch_td">';
            str+= '    <input type="text" class="form-control purchase_quantity sm_quantity number_only" name="quantity[]" value="">';
            str+= '    <span class="err"></span>';
         str+= ' </td>';
         str += '<td class="purch_td">';
            str += '<button id="removeNewPO_edit" class="btn btn-md btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>';
            str += '</td>';
      str+= '</tr>';

      if(x){
         x++;
         $('#view_stock_out').append(str);
         $('.select2_edit').select2();
      }
      // get_supplier();
     });
     // EDIT STOCK out
     $(document).on("click",".editstockout", function(){
     var stockmovement_code = $(this).attr('data-id');
     var product = $(this).attr('data-product');

     $.ajax({
          method: 'POST',
          url: base_url+'stockout/stockout_edit',
          data: {stockmovement_code:stockmovement_code,product:product},
          dataType: "json",
          success: function(data){
               console.log("data");
               console.log(data);
               $('#editStockOut').modal('show');
                    var str = '';
                    var total_quantity = 0;
                    $.each(data.stock_movement,function(index,element){
                    // var total_quantity  =  parseInt(element.quantity) + parseInt(element.physical_count);
                     var quantity =  parseInt(element.stock_out) - parseInt(element.physical_count);

                     var remaining_stocks = parseInt(element.stock_out) - quantity;

                       str+= '<tr>';
                       str += '<td class="purch_td hide">';
                       str += '<input type="hidden" class="form-control" name="edit_purchase_id[]" value='+element.id+'>';
                       str += '<input type="hidden" class="form-control" name="stockmovement_id" value=>';
                       str += '</td>';
                        str+= ' <td class="purch_td">';
                        str += '<select class="form-control js-example-basic-multiple-editStockTransfer select2_edit edit_new_code" style="width: 100%;" name="prod_code[]" data-id="'+element.id+'" value="'+element.code+'">';
                           str += get_edit_products(element.id);
                          str+= ' </select>';
                          str+= ' <span class="err"></span>';
                         str+= '</td>';
                        str+= ' <td class="purch_td">';
                           str+= '<input type="text" class="form-control prod_name" name="prod_name[]" value="'+element.product_name+'" readonly>';
                           str+= ' <span class="err"></span>';
                         str+= '</td>';
                         str+= '<td class="purch_td">';
                            str+= '<input type="text" class="form-control remaining_stocks" name="remaining_stocks[]" value="'+remaining_stocks+'" readonly>';
                          str+= ' <span class="err"></span>';
                        str+= ' </td>';
                        str+= ' <td class="purch_td">';
                       str+= '    <input type="text" class="form-control purchase_quantity sm_quantity number_only" name="quantity[]" value="'+quantity+'">';
                       str+= '    <span class="err"></span>';
                        str+= ' </td>';
                        $('#editstockout textarea[name="stockmovement_note"]').val(element.stockmovement_note);

                       str+= '</tr>';

                        total_quantity += +quantity;

               });

               $('#view_stock_out tbody').html(str);
               $('.select2_edit').select2({hideSelected: true});
               $(".total_quantity").val(total_quantity);
               // console.log('asdfsadf');
               // console.log(stockmovement_id);
             }
     });

     });

     $("#editStockOut").on("submit", function(e){
         e.preventDefault();
         var stockmovement_id = $('input[name="stockmovement_id"]').val();
         var quantity = $('input[name="quantity[]"]').val();

         console.log('buang');

         console.log(stockmovement_id);
         console.log(quantity);

         $.ajax({
             method: 'POST',
             url: base_url+'stockout/stockout_submit_edit',
             data: {quantity:quantity,stockmovement_id:stockmovement_id},
             dataType: "json",
             success: function(update){
                 Swal.fire({
                     title: 'Successfully Updated',
                     text: "",
                     type: 'success',
                     confirmButtonText: 'Ok',
                }).then(function(){
                     location.reload();
                    })
             }
         });
     });

     var stockout_tbl = $('.stockout_tbl').DataTable({
    "responsive": true,
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
                               str += '<a href="javascript:;" class="viewstockout" data-id="'+row.stockmovement_code+'"><abbr title="View Stock Out"><i class="fas fa-eye text-info"></i></abbr></a>';
                               str += '<a href="javascript:;" class="editstockout" data-id="'+row.stockmovement_code+'" data-product="'+row.product+'"><abbr title="Edit Stock Out"><i class="fas fa-pen text-warning"></i></abbr></a>';
                               str += '<a href="javascript:;" class="deletestockOut" data-id="'+row.stockmovement_id+'"><abbr title="Delete Stock Out"><i class="fa fa-trash" aria-hidden="true"></abbr></a>';
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
