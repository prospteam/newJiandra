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
              {"data":"supplier_name"},

              // {"data":"type"},
              {"data":"action","render": function(data, type, row,meta){
                        var str = '';
                        str += '<div class="actions">';
                        if(row.status == 1){

                          str += '<a href="javascript:;" class="viewPurchase" data-id="'+row.purchase_code+'"> <i class="fas fa-eye text-info"></i></a>';
                          str += '<a href="javascript:;" class="editPurchase" data-id="'+row.id+'"><i class="fas fa-pen text-warning"></i></a>';
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
         console.log(data);
         // console.log(data.users);
         $('#ViewPurchaseOrders').modal('show');
         // $.each(data.users, function(key,val){
           // console.log(val);
           $('.code').text(data.purchase.purchase_code);
           $('.date').text(data.purchase.date_ordered);
           $('.product').text(data.purchase.product);
           $('.ordered').text(data.purchase.ordered);
           $('.delivered').text(data.purchase.delivered);

       }
     })
  });

  //add multiple product in add purchase order
  $(document).on('click', '#addNewPO', function(){
    var str = '';
    var i = $('#addNewPO').size() + 1;

    str = '<div class="row">';
      str += '<div class="col-4">';
         str += '<div class="form-group">';
           str += '<label for="prod_name">Product Name: <span class="required">*</span></label>';
           str += '<input type="text" class="form-control" name="prod_name' + i +'" value="">';
           str += '<span class="err"></span>';
         str += '</div>';
       str += '</div>';

       str += '<div class="col-2">';
          str += '<div class="form-group">';
            str += '<label for="ordered">Orders: <span class="required">*</span></label>';
            str += '<input type="number" class="form-control" name="ordered" value="">';
            str += '<span class="err"></span>';
          str += '</div>';
        str += '</div>';

        str += '<div class="col-4">';
           str += '<div class="form-group">';
             str += '<label for="supplier">Supplier: <span class="required">*</span></label>';
             str += '<select class="form-control" class="supplier" name="supplier" >';
                str += '<option value="" selected hidden>Select Supplier</option>';
             str += '</select>';
             str += '<span class="err"></span>';
           str += '</div>';
         str += '</div>';

         str += '<div class="col-2">';
            str += '<div class="form-group">';
              str += '<label for="ordered"></label><br>';
              str += '<p>';
              str += '<span class="btn btn-md btn-danger" id="removeNewPO">Remove</span>';
            str += '</p>';
          str += '</div>';
        str += '</div>';
    str += '</div>';
    $('#addProduct').append(str);

  });

  $(document).on('click', '#removeNewPO', function(){
    alert("ok");
  });
});



function blankVal_purchase(){
  $('#AddPurchaseOrder input[name="prod_name"]').val('');
  $('.err').text('');
  $('#AddPurchaseOrder input[name="ordered"]').val('');
  $('#AddPurchaseOrder select[name="supplier"]').val('');
}
