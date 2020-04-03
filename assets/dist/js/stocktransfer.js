
var base_url = $('input[name="base_url"]').val();

$(document).ready(function(){
// DELETE STOCK TRANSFER
   $(document).on("click",'.deletestockTransfer', function(e) {
     e.preventDefault();
     var stockmovement_id = $(this).attr('data-id');
     console.log(stockmovement_id);

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
             data: {stockmovement_id: stockmovement_id},
             success:function(data) {
               $(".stocksmov_tbl").DataTable().ajax.reload();
             }
           })
       }
     });

     });
     // END DELETE STOCK TRANSFER

     $(document).on('submit','#editstocktransfer',function(e){
      e.preventDefault();

      let formData =  new FormData($(this)[0]);
      var stockmovement_id = $('input[name="stockmovement_id[]"]').val();
      var remaining_stocks = $('input[name="remaining_stocks[]"]').val();

      formData.append("stockmovement_id",stockmovement_id);
      $.ajax({
          method: 'POST',
          url : base_url + 'stocktransfer/update_stock_transfer',
          data : formData,
          processData: false,
          contentType: false,
          cache: false,
          dataType: 'json',
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
      })
     });


     $(document).on('click', '#addNewSTransfer_edit', function(){
        // alert('hi');
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
           str+= '<input type="hidden" class="form-control remaining_stocks" name="isEdit[]" value="0">';
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
         $('#view_stock_transfer').append(str);
         $('.select2_edit').select2();
      }
      // get_supplier();
     });

   // EDIT SELECT SKU
   $(document).on('change','.edit_new_code',function(){
     var el = $(this);
     var id = $(this).val;
     $.ajax({
         url: base_url+'stocktransfer/get_product_Name_by_code_edit',
         data: {prod_id:$(this).val()},
         type: 'post',
         dataType: 'json',
         success: function(data){
                 $.each(data.products,function(index,element){
                   el.parents('tr').find('input[name="prod_name[]"]').val(element.product_name);
                   el.parents('tr').find('input[name="remaining_stocks[]"]').val(data.physical_count.length != 0?data.physical_count[index].physical_count:0);
                 });
         }
     });
   });

     // EDIT STOCK TRANSFER
     $(document).on("click",".editstocktransfer", function(){
      var stockmovement_id = $(this).attr('data-id');

      $.ajax({
          method: 'POST',
          url: base_url+'stocktransfer/editStockTransfer',
          data: {stockmovement_id:stockmovement_id},
          dataType: "json",
          success: function(data){
               // console.log("data
               $('#editStockTransfer').modal('show');
               // var total_quantity = 0;
               var str = '';
               var total_quantity = 0;
               $.each(data.stock_movement,function(index,element){
                 console.log(element);

                 var remaining_stocks = parseInt(element.physical_count) + parseInt(element.quantity);

               str+= '<tr>';
               str += '<td class="purch_td hide">';
               str += '<input type="hidden" class="form-control stocktransfer_id" name="stocktransfer_id[]" value='+element.id+'>';
               str += '</td>';
                str+= ' <td class="purch_td">';
                str += '<input type="hidden" class="form-control" name="edit_stocktransfer_id_select[]" value='+element.id+'>';
                str += '<select class="form-control js-example-basic-multiple-editStockTransfer select2_edit edit_new_code" style="width: 100%;" name="prod_code[]" data-id="'+element.id+'" value="'+element.code+'">';
                   str += get_edit_products(element.id);
                  str+= ' </select>';
                  str+= ' <span class="err"></span>';
                 str+= '</td>';
                str+= ' <td class="purch_td">';
                   str+= '<input type="text" class="form-control prod_name" name="prod_name[]" value="'+element.product_name+'" readonly>';
                     str += '<input type="hidden" class="form-control stockmovement_id" name="stockmovement_id[]" value='+element.stockmovement_id+'>';
                   str+= '<input type="hidden" class="form-control prod_name" name="isEdit[]" value="1">';
                   str+= ' <span class="err"></span>';
                 str+= '</td>';
                 str+= '<td class="purch_td">';
                    str+= '<input type="text" class="form-control remaining_stocks" name="remaining_stocks[]" value="'+remaining_stocks+'" readonly>';
                  str+= ' <span class="err"></span>';
                str+= ' </td>';
                str+= ' <td class="purch_td">';
               str+= '    <input type="text" class="form-control purchase_quantity sm_quantity number_only" name="quantity[]" value="'+element.quantity+'">';
               str+= '    <span class="err"></span>';
                str+= ' </td>';
                $('#editstocktransfer textarea[name="stockmovement_note"]').val(element.stockmovement_note);
               str+= '</tr>';

               total_quantity += +element.quantity;

               });
               $('#view_stock_transfer tbody').html(str);
               $('.select2_edit').select2({ hideSelected: true });

               //  total quantity
               $(".total_quantity").val(total_quantity);

             }
      });


     });
     // EDIT STOCK TRANSFER
     // VIEW Stocktransfer
     $(document).on('click', '.viewstocktransfer', function(){
        var stockmovement_id = $(this).attr('data-id');
        // alert('hi');
        $.ajax({
          method: 'POST',
          url: base_url + 'stocktransfer/view_stocktransfer',
          data: {stockmovement_id:stockmovement_id},
          dataType: "json",
          success: function(data){
            console.log(data);
            $('#ViewStocktransfer').modal('show');
            var str = '';
            var total_quantity = 0;
             console.log('how');

             $.each(data.stock_movement,function(index,element){
                console.log('hakhak');
               total_quantity = parseFloat(total_quantity) + parseFloat(element.quantity);
               $('.code').text(element.stockmovement_id);
               $('.date_ordered').text(element.stockmovement_date);
               $('.transferred_warehouse').text(element.wh_name);
               $('.date_delivered').text(element.date_delivered);

               str += '<tr>';
                  str +=     '<td class="purch_td">';
                    str +=   element.stockmovement_id;
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
             $('#view_stocktransfer tbody').html(str);
          }
     });
   });
     // END VIEW Stocktransfer

     //select SKU
     $('.js-example-basic-multiple-editStockTransfer').select2({
      placeholder: "Select SKU",
      tags: [],
      ajax: {
         url: base_url+'Stocktransfer/skuList_edit',
         dataType: "json",
         type: "POST",
         quietMillis: 50,
         data: function (text) {
          return {
                       searchfor: text,
                       search_type: $(this).attr('data-type')
                   };
        },processResults: function (data) {

             return {
                  results: $.map(data.items, function (item) {
                      return {
                          text: item.code,
                          id: item.product_id
                      }
                  })
             };
          }
      }
     });

     //end select SKU
   var stocksmov_tbl = $('.stocksmov_tbl').DataTable({
  "responsive": true,
  "processing"  : true,
  "serverside"  : true,
  "order"       : [[0,'desc']],
  "columns"     :[
         {"data":"stockmovement_date"},
         {"data":"wh_name"},
         {"data":"date_delivered"},
         {"data":"stockmovement_code"},
         // {"data":"quantity"},
         {"data":"stockmovement_note","render": function(data, type, row,meta, element){
              var str = '';
              if(row.stockmovement_note == '') {
                str += 'None';
              }else{
                str += row.stockmovement_note;
              }
              return str;
            }
          },
         {"data":"action","render": function(data, type, row,meta, element){
                           var str = '';
                           str += '<div class="actions">';
                           if(row.status == 1) {
                            str += '<a href="javascript:;" class="viewstocktransfer" data-id="'+row.stockmovement_id+'"><abbr title="View Stock Transfer"><i class="fas fa-eye text-info"></i></abbr></a>';
                             str += '<a href="javascript:;" class="editstocktransfer" data-id="'+row.stockmovement_id+'"><abbr title="Edit Stock Transfer"><i class="fas fa-pen text-warning"></i></abbr></a>';
                             str += '<a href="javascript:;" class="deletestockTransfer" data-id="'+row.stockmovement_id+'"><abbr title="Delete Stock Transfer"><i class="fa fa-trash" aria-hidden="true"></abbr></a>';
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
             "url":base_url+"stocktransfer/disp_stocktransfer/",
             "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
             {
                  "targets": [4,5,6], //first column / numbering column
                  "orderable": false, //set not orderable

              },
         ],
     });


});
