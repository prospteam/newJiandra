
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

     $(document).on('submit','#editstocktransfer',function(e){
      e.preventDefault();
      let formData =  new FormData($(this)[0]);
      var stockmovement_tid = $('input[name="edit_stocktransfer_id"]').val();
      // alert(id);
      formData.append("stockmovement_tid",stockmovement_tid);
      $.ajax({
          method: 'POST',
          url : base_url + 'stocktransfer/edit_stocktransfer',
          data : formData,
          processData: false,
          contentType: false,
          cache: false,
          dataType: 'json',
          success : function(data) {
               console.log(data);
               // if(data.status == "ok"){
               //   $('#EditPurchaseOrder').modal('hide');
               //       Swal.fire("Successfully updated purchase order!",data.success, "success");
               //       $(".purchase_tbl").DataTable().ajax.reload();
               //       // setTimeout(function(){
               //       //    location.reload();
               //       //  }, 1000);
               //  }else if(data.status == 'invalid'){
               //     Swal.fire("Error",data.status, "invalid");
               //  }
               if(data.form_error){
                   clearError();
                   let keyNames = Object.keys(data.form_error);
                   $(keyNames).each(function(index , value) {
                       $("input[name='"+value+"']").next('.err').text(data.form_error[value]);
                       $("select[name='"+value+"']").next().next().text(data.form_error[value]);
                   });
               }else if (data.error) {
                   Swal.fire("Error",data.error, "error");
               }else {
                  // blankVal();
                   $('#editStockTransfer').modal('hide');
                   Swal.fire("Successfully updated Stock Transfer!",data.success, "success");
                   $(".stocksmov_tbl").DataTable().ajax.reload();
               }
          }
      })
     });


     $(document).on('click', '#addNewSTransfer_edit', function(){
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
         $('#view_stock_transfer').append(str);
         $('.select2_edit').select2();
      }
      // get_supplier();
     });

// EDIT SELECT SKU
$(document).on('change','.edit_new_code',function(){
  var el = $(this);
  var id = $(this).attr('data-id');
  // alert(id);
  $.ajax({
      url: base_url+'stocktransfer/get_product_Name_by_code_edit',
      data: {prod_id:$(this).val(),purchase_id:id},
      type: 'post',
      dataType: 'json',
      success: function(data){
              $.each(data.products,function(index,element){
                el.parents('tr').find('input[name="prod_name[]"]').val(element.product_name);
              });
      }
  });
});

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
               // console.log("data");
               $('#editStockTransfer').modal('show');
                     var str = '';
                     $.each(data.stock_movement,function(index,element){
                       console.log(element.stockmovement_date);
               // var datax = {
               //    id: "hujhjhjh",
               //    text: "hjhjhj"
               // };
               //
               // var newOption = new Option(datax.text, datax.id, false, false);
               // $('#editstocktransfer .stocktransfer_id').val(data.stock_movement.stockmovement_tid);
               // $('.js-example-basic-multiple-editStockTransfer').append(newOption).trigger('change');
               $('#editstocktransfer input[name="sodate"]').val(element.stockmovement_date);
               $('#editstocktransfer select[name="so_type"]').val(element.type);
               $('#editstocktransfer input[name="so_datedelivered"]').val(element.date_delivered);
               //
               // $('#editstocktransfer select[name="prod_code"]').val(data.stocks.code);
               //
               // $('#editstocktransfer input[name="prod_name"]').val(data.stock_movement.product_name);
               // $('#editstocktransfer input[name="remaining_stocks"]').val(data.stocks.physical_count);
               // $('#editstocktransfer input[name="quantity"]').val(data.stock_movement.quantity);
               // $('#editstocktransfer textarea[name="stockmovement_note"]').val(data.stock_movement.stockmovement_note);
               // $('#editstocktransfer select[name="prod_code"]').val(data.stocks.code);
               str+= '<tr>';
               str += '<td class="purch_td hide">';
               str += '<input type="hidden" class="form-control edit_stocktransfer_id" name="edit_purchase_id[]" value='+element.id+'>';
               str += '</td>';
                str+= ' <td class="purch_td">';
                str += '<select class="form-control js-example-basic-multiple-editStockTransfer select2_edit edit_new_code" style="width: 100%;" name="prod_code[]" data-id="'+element.id+'" value="'+element.code+'">';
                  // str+= ' <select class="form-control js-example-basic-multiple-editStockTransfer select2" style="width: 100%;" name="prod_code[]">';
                  // str+= '  <option value="">Select SKU</option>';
                  // str+= '   <option value="'.$value['product'].'">'.$value['code'].'</option>';
                   str += get_edit_products(element.id);
                  str+= ' </select>';

                  str+= ' <span class="err"></span>';
                 str+= '</td>';
                str+= ' <td class="purch_td">';
                   str+= '<input type="text" class="form-control prod_name" name="prod_name[]" value="'+element.product_name+'" readonly>';
                   str+= ' <span class="err"></span>';
                 str+= '</td>';
                 str+= '<td class="purch_td">';
                    str+= '<input type="text" class="form-control remaining_stocks" name="remaining_stocks[]" value="'+element.physical_count+'" readonly>';
                  str+= ' <span class="err"></span>';
                str+= ' </td>';
                str+= ' <td class="purch_td">';
               str+= '    <input type="text" class="form-control purchase_quantity sm_quantity number_only" name="quantity[]" value="'+element.quantity+'">';
               str+= '    <span class="err"></span>';
                str+= ' </td>';
               str+= '</tr>';

               });
               $('#view_stock_transfer tbody').html(str);
               $('.select2_edit').select2({
                 hideSelected: true
               });
             }
      });

     });
     // EDIT STOCK TRANSFER

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
