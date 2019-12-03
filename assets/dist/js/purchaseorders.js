var base_url = $('input[name="base_url"]').val();
$(document).ready(function(){


  //display purchase_tbl
    var purchase_tbl = $('.purchase_tbl').DataTable({
         "processing": true, //Feature control the processing indicator.
         "serverSide": true, //Feature control DataTables' server-side processing mode.
         "order": [[0,'desc']], //Initial no order.
         "columns":[
              {"data":"date_ordered"},
              {"data":"purchase_code"},
              {"data":"company_name"},
              {"data":"supplier_name"},

              // {"data":"type"},
              {"data":"action","render": function(data, type, row,meta){
                        var str = '';
                        str += '<div class="actions">';
                        if(row.status == 1){

                          str += '<a href="javascript:;" class="viewPurchase" data-id="'+row.purchase_code+'"> <i class="fas fa-eye text-info"></i></a>';
                          str += '<a href="javascript:;" class="editPurchase" data-id="'+row.purchase_code+'"><i class="fas fa-pen text-warning"></i></a>';
                          str += '<a href="javascript:;" class="disableUser" data-id="'+row.id+'"><i class="fa fa-window-close"></i></a>';
                          str += '<a href="javascript:;" class="deletePurchase" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';
                        }else if(row.status == 2){
                          str += '<a href="javascript:;" class="enableUser" data-id="'+row.id+'"><i class="fa fa-check-square"></i></a>';
                          str += '<a href="javascript:;" class="deleteUser" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';
                        }
                        str += '</div>';
                        return str;
                   }
              },

              {"data":"status","render": function(data, type, row,meta){
                  var str = '';
                   if(row.status == 1){
                     str += '<span class="btn btn-block btn-sm btn-primary">pending</button>';
                   }else if(row.status == 2){
                     str += '<span class="inactive btn btn-block btn-sm btn-danger">approved</button>';
                   }else if(row.status == 3){
                     str += '<span class="active btn btn-block btn-sm btn-success">cancelled</button>';
                   }
                   return str;
              }
            },
            {"data":"delivery_status","render": function(data, type, row,meta){
                var str = '';
                 if(row.delivery_status == 1){
                   str += '<span class="btn btn-block btn-sm btn-primary">pending</button>';
                 }else if(row.delivery_status == 2){
                   str += '<span class="inactive btn btn-block btn-sm btn-danger">on hold</button>';
                 }else if(row.delivery_status == 3){
                   str += '<span class="btn btn-block btn-sm btn-warning">on process</button>';
                 }else if(row.delivery_status == 4){
                   str += '<span class="btn btn-block btn-sm btn-success">delivered</button>';
                 }
                 return str;
            }
          }

         ],
         // Load data for the table's content from an Ajax source
         "ajax": {
              "url":base_url+"purchaseorders/display_purchase_orders/",
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

  //successfully added purchas order
  $(document).on('submit','form#addpurchaseorder',function(e){
    e.preventDefault();
    let formData = $(this).serialize();
    // formData.append('purchase_id',$("input[name='purchase_id']").attr('data-id'));
    //
    // console.log(formData);
    $.ajax({
        method: 'POST',
        url : base_url + 'purchaseorders/addPurchaseOrder',
        data : formData,
        success : function(response) {
            let data = JSON.parse(response);
            console.log(data);
            if(data.form_error){
                clearError();
                let keyNames = Object.keys(data.form_error);
                $(keyNames).each(function(index , value) {
                  console.log(value);
                    $("input[name='"+value+"']").next('.err').text(data.form_error[value]);
                    $("select[name='"+value+"']").next('.err').text(data.form_error[value]);
                    $("select[name='"+value+"']").next('.err').text(data.form_error[value]);
                    // $("select[name='"+value+"']").parents('.form-group').next('.err').text(data.form_error[value]);
                });
            }else if (data.error) {
                Swal.fire("Error",data.error, "error");
            }else {
                blankVal_purchase();
                $('#AddPurchaseOrder').modal('hide');
                Swal.fire("Successfully added purchase order!",data.success, "success");
                $(".purchase_tbl").DataTable().ajax.reload();
                // setTimeout(function(){
                //    location.reload();
                //  }, 1000);
            }
        }
    })
  });

  //view list of Orders
  $(document).on('click', '.viewPurchase', function(){
     var id = $(this).attr('data-id');
     $.ajax({
       method: 'POST',
       url: base_url + 'purchaseorders/view_purchase_orders',
       data: {id:id},
       dataType: "json",
       success: function(data){
         // console.log(data);
         $('#ViewPurchaseOrders').modal('show');
         var str = '';
         var total_quantity = 0;
         var total_cost = 0;
         var grand_total = 0;

           $.each(data.purchase,function(index,element){

             total_quantity = parseFloat(total_quantity) + parseFloat(element.quantity);
             total_cost = parseFloat(total_cost) + parseFloat(element.unit_price);
             var total = element.quantity * element.unit_price;
             grand_total = parseFloat(grand_total) + parseFloat(total);

             if(element.delivered == ''){
               var deliv = 0;
             }else{
                var deliv = element.delivered;
             }
             $('.code').text(element.purchase_code);
             $('.date').text(element.date_ordered);
             $('.company').text(element.company_name);
             $('.supplier').text(element.supplier_name);
             str += '<tr>';
               str +=     '<td class="purch_td">';
                   str +=   element.product;
                  str += '</td>';
                 str += ' <td class="purch_td qty">';
                     str += element.quantity;
                 str += '</td>';
               str +=  '<td class="purch_td price">';
                  str += element.unit_price;
                str += '</td>';
                str +=  '<td class="purch_td total">';
                str += total;
                 str += '</td>';
                 str +=  '<td class="purch_td">';
                    str += deliv;
                  str += '</td>';
                 str += '<td class="purch_td">';
                 str += '<button="" class="btn btn-xs btn-primary"><i class="fas fa-edit" aria-hidden="true"></i></button>';
                str += '</td>';
               str += '</tr>';


               $('.note').text(element.note);
         });

         $('.qty').val(total_quantity);
         $('.total_cost').val(total_cost.toFixed(2));

         $('#view_purchase_orders_details tbody').html(str);
         $('.grand_total').val(grand_total.toFixed(2));

   }
  });
});


  //display suppliers according to company
  $(document).on('change','select[name="company"]',function(){
    $.ajax({
        url: base_url+'purchaseorders/get_suppliers_by_companies',
        data: {company_id:$(this).val()},
        type: 'post',
        dataType: 'json',
        success: function(data){
          var str = '';
          str += '<label for="supplier">Supplier: <span class="required">*</span></label>';
          str += '<select class="form-control" class="supplier" id="supplier" name="supplier" >';
              str += '<option value="" selected hidden>Select Supplier</option>';
                $.each(data.suppliers,function(index,element){
                      str += '<option value="'+element.id+'">'+element.supplier_name+'</option>';
                });
          str += '</select>';
          str += '<span class="err"></span>';

            $('#show_supplier').html(str);

        }
    });
  });

  //display suppliers according to company on edit
  $(document).on('change','select[name="company_edit"]',function(){
    $.ajax({
        url: base_url+'purchaseorders/get_suppliers_by_companies',
        data: {company_id:$(this).val()},
        type: 'post',
        dataType: 'json',
        success: function(data){
          var str = '';
          str += '<label for="supplier">Supplier: <span class="required">*</span></label>';
          str += '<select class="form-control" class="supplier" id="supplier" name="supplier" >';
              // str += '<option value="" selected hidden>Select Supplier</option>';
                $.each(data.suppliers,function(index,element){
                      str += '<option value="'+element.id+'">'+element.supplier_name+'</option>';
                });
          str += '</select>';
          str += '<span class="err"></span>';

            $('#edit_show_supplier').html(str);

        }
    });
  });

  //view edit Orders
  $(document).on('click', '.editPurchase', function(){
    var id = $(this).attr('data-id');
    $.ajax({
        url: base_url+'purchaseorders/purchase_details',
        data: {id:id},
        type: 'post',
        dataType: 'json',
        success: function(data){
          $('#EditPurchaseOrder').modal('show');
          var str ='';
          var total = 0;
          var total_quantity = 0;
          var total_cost = 0;
          var grand_total = 0;

          $.each(data.purch_details,function(index,element){
            console.log(element);
            total = parseFloat(element.quantity) + parseFloat(element.unit_price)
            total_quantity = parseFloat(total_quantity) + parseFloat(element.quantity);
            total_cost = parseFloat(total_cost) + parseFloat(element.unit_price);
            var total = element.quantity * element.unit_price;
            grand_total = parseFloat(grand_total) + parseFloat(total);

            $('#editpurchaseorder textarea[name=purchase_note]').val(element.note);
            $('#editpurchaseorder select[name=company_edit]').val(element.company_id);
            $('#editpurchaseorder select[name="company_edit"]').trigger('change');
            $('#editpurchaseorder select[name=supplier]').val(element.supplier_id);
            str += '<input type="hidden" name="purchase_id" value='+element.purchase_id+'>';
            str += '<tr>';
              str += '<td class="purch_td">';
                   str += '<input type="text" class="form-control" name="prod_name[]" value='+element.product+'>';
                   str += '<span class="err"></span>';
              str += '</td>';
              str += '<td class="purch_td">';
                   str += '<input type="number" class="form-control purchase_quantity" name="quantity[]" value='+element.quantity+'>';
                   str += '<span class="err"></span>';
              str += '</td>';
              str += '<td class="purch_td">';
                  str += '<input type="number" class="form-control purchase_price" name="unit_price[]" value='+element.unit_price+'>';
                  str += '<span class="err"></span>';
              str += '</td>';
              str += '<td class="purch_td">';
                  str += '<input type="number" class="form-control purchase_total" name="total[]" value='+total+' readonly>';
                  str += '<span class="err"></span>';
              str += '</td>';
            str += '</tr>';
          });

          $('.total_quantity').val(total_quantity);
          $('.total_cost').val(total_cost.toFixed(2));
          $('#edit_purch tbody').html(str);
          $('.grand_total').val(grand_total.toFixed(2));
        }
    });

  });


  //successfully edited purchase order
  $(document).on('submit','#editpurchaseorder',function(e){
    e.preventDefault();
    let formData =  new FormData($(this)[0]);
    var id = $('input[name="purchase_id"]').val();
    // alert(id);
    formData.append("id",id);
    $.ajax({
        method: 'POST',
        url : base_url + 'purchaseorders/edit_purchase_orders',
        data : formData,
        processData: false,
       contentType: false,
       cache: false,
        dataType: 'json',
        success : function(data) {
            console.log(data);
            // if(data.status == "ok"){
            //   $('#EditUser').modal('hide');
            //       Swal.fire("Successfully updated user!",data.success, "success");
            //       $(".users_tbl").DataTable().ajax.reload();
            //       // setTimeout(function(){
            //       //    location.reload();
            //       //  }, 1000);
            //  }else if(data.status == 'invalid'){
            //     Swal.fire("Error",data.status, "invalid");
            //  }
            // if(data.form_error){
            //     clearError();
            //     let keyNames = Object.keys(data.form_error);
            //     $(keyNames).each(function(index , value) {
            //         $("input[name='"+value+"']").next('.err').text(data.form_error[value]);
            //     });
            // }else if (data.error) {
            //     Swal.fire("Error",data.error, "error");
            // }else {
            //    // blankVal();
            //     $('#EditUser').modal('hide');
            //     Swal.fire("Successfully updated user!",data.success, "success");
            //     setTimeout(function(){
            //        location.reload();
            //      }, 1000);
            // }
        }
    })
  });

  //add multiple product in add purchase order
  $(document).on('click', '#addNewPO', function(){
    var x = 1;
    var str = '';

    str += '<tr>';
      str += '<td class="purch_td">';
           str += '<input type="text" class="form-control" name="prod_name[]" value="">';
           str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
           str += '<input type="number" class="form-control purchase_quantity" name="quantity[]" value="">';
           str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
          str += '<input type="number" class="form-control purchase_price" name="unit_price[]" value="">';
          str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
          str += '<input type="number" class="form-control purchase_total" name="total[]" value="" readonly>';
          str += '<span class="err"></span>';
      str += '</td>';
    str += '</tr>';


    if(x){
      x++;
      $('#add_new_product tbody').append(str);
    }
    // get_supplier();
  });

  $(document).on('click', '#removeNewPO', function(){
    $(this).parent().parent().parent().parent().remove(); x--;
  });

  //add multiple product in add purchase order
  $(document).on('click', '#addNewPO_edit', function(){
    var x = 1;
    var str = '';

    str += '<tr>';
      str += '<td class="purch_td">';
           str += '<input type="text" class="form-control" name="prod_name[]" value="">';
           str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
           str += '<input type="number" class="form-control purchase_quantity" name="quantity[]" value="">';
           str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
          str += '<input type="number" class="form-control purchase_price" name="unit_price[]" value="">';
          str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
          str += '<input type="number" class="form-control purchase_total" name="total[]" value="" readonly>';
          str += '<span class="err"></span>';
      str += '</td>';
    str += '</tr>';

    if(x){
      x++;
      $('#edit_purch').append(str);
    }
    // get_supplier();
  });

  $(document).on('click', '#removeNewPO_edit', function(){
    $(this).parent().parent().parent().parent().remove(); x--;
  });

  //compute total for qunatity * unit Price
    $(document).on('keyup', '.purchase_price, .purchase_quantity', function(){
        var total = 1;
        var grand_total = '';
        var price = $(this).parents('tr').find('.purchase_price').val();
        var quantity = $(this).parents('tr').find('.purchase_quantity').val();

        quantity = quantity === undefined || quantity === null || quantity === '' ? 0 : quantity;
        price = price === undefined || price === null || price === '' ? 0 : price;

        var total = price * quantity;

         $(this).parents('tr').find('.purchase_total').val(total.toFixed(2));

         // grand total
         var grand_total = 0;
         $(".purchase_total").each(function() {
             var gtval = $(this).val();
             grand_total += +gtval.replace(/\,/g, '');
         });

          $('.grand_total').val(grand_total.toFixed(2));

          //  total quantity
          var total_quantity = 0;
          $(".purchase_quantity").each(function() {
              total_quantity += +$(this).val();
          });
          $(".total_quantity").val(total_quantity);

          var total_cost = 0;
          $(".purchase_price").each(function() {
              total_cost += +$(this).val();
          });
          $(".total_cost").val(total_cost.toFixed(2));



      });

});


function get_supplier(){
  var data_return = '';
  $.ajax({
    url: base_url + '/purchaseorders/get_suppliers/',
    type:'post',
    dataType:'json',
    async:false,
    success:function(data){
      var str = '';
      $.each(data.suppliers,function(index,element){
        str += '<option value="'+element.id+'">'+element.supplier_name+'</option>';
      });
      data_return = str;
    }
  });
  return data_return;
}
function blankVal_purchase(){
  $('#AddPurchaseOrder input[name="prod_name"]').val('');
  $('.err').text('');
  $('#AddPurchaseOrder input[name="ordered"]').val('');
  $('#AddPurchaseOrder select[name="supplier"]').val('');
}
