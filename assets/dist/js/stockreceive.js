
var base_url = $('input[name="base_url"]').val();

$(document).ready(function(){
   var stocksreceive_tbl = $('.stocksreceive_tbl').DataTable({
  "processing"  : true,
  "serverside"  : true,
  "order"       : [[0,'desc']],
  "columns"     :[
         {"data":"stockmovement_code"},
         {"data":"stockmovement_date"},
         {"data":"sm_from_warehouse"},
         {"data":"sm_transferred_warehouse"},
         {"data":"date_delivered"},

           {"data":"status","render": function(data, type, row,meta){
                   var str = '';
                    if(row.transfer_status == 1){
                        str += '<span class="btn btn-block btn-sm btn-primary">pending</button>';
                    }
                    return str;
               }
           },
             {"data":"action","render": function(data, type, row,meta, element){
                 var str = '';
                 str += '<div class="actions">';
                 if(row.status == 1) {
                     str += '<a href="javascript:;" class="btn btn-block btn-sm btn-success viewstockreceieve" data-id="'+row.stockmovement_code+'"><i class="fas fa-check"></i> Approve</a>';
                     str += '<a href="javascript:;" class="btn btn-block btn-sm btn-danger decline_transfer" data-id="'+row.stockmovement_code+'"><i class="fas fa-times"></i> Decline</a>';
                 }
                 str += '</div>';
                 return str;
                }
            }
         ],

         "ajax": {
             "url":base_url+"stockreceive/disp_stockreceive/",
             "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
             {
                  "targets": [5,6], //first column / numbering column
                  "orderable": false, //set not orderable

              },
         ],
     });

     //view list of products to be transferred
     $(document).on('click', '.viewstockreceieve', function(){
        var id = $(this).attr('data-id');
        $.ajax({
          method: 'POST',
          url: base_url + 'stockreceive/view_stockreceive',
          data: {id:id},
          dataType: "json",
          success: function(data){
            console.log(data);
            $('#ViewStockReceive').modal('show');
            var str = '';
            var total_quantity = 0;
             $.each(data.stockout,function(index,element){
               total_quantity = parseFloat(total_quantity) + parseFloat(element.quantity);
               $('.code').text(element.stockmovement_code);
               $('.date_ordered').text(element.stockmovement_date);
               $('.date_delivered').text(element.date_delivered);

               if(element.actual_received == null){
                 var deliv = element.quantity;
               }else{
                  var deliv = element.actual_received;
               }

               str += '<tr>';
                    str += '<td class="purch_td hide">';
                        str +=   '<input type="hidden" class="sm_id" name="sm_id[]" value='+element.stockmovement_id+'>';
                    str += '</td>';
                    str +=     '<td class="purch_td hide">';
                        str +=   '<input type="hidden" class="sm_product" name="sm_product[]" value='+element.product+'>';
                    str += '</td>';
                    str += '<td class="purch_td">';
                        str +=   '<input type="text" class="form-control prod_name" name="prod_name[]" value='+element.code+' readonly>';
                    str += '</td>';
                    str +=  '<td class="purch_td">';
                        str +=   element.product_name;
                    str += '</td>';
                    str += ' <td class="purch_td qty">';
                        str += element.quantity;
                    str += '</td>';
                    str +=  '<td class="purch_td actual_receive_qty">';
                       // str += '<span class="actual_qty">'+deliv+'</span>';
                       str += '<input type="text" class="form-control sm_actual_qty number_only" name="actual_receive_qty[]" value='+deliv+'>';
                    str += '</td>';

                str += '</tr>';

                $('.note').text(element.stockmovement_note);
             });
             $('.qty').val(total_quantity);
             $('#view_stockreceive tbody').html(str);
          }

     });
   });

   //show and input quantity actual received
   $(document).on('click','.actual_receive', function(){
     var pTr = $(this).parents('tr');

     pTr.find('.sm_actual_qty').show().prop('disabled', false).prop('hidden', false);
     pTr.find('.actual_qty').hide();

     pTr.find('.submit_actual_receive_qty').show().prop('hidden', false);
     pTr.find('.actual_receive').hide().prop('hidden', true);


     $('.submit_actual_receive_qty').unbind('click').click(function(e) {
       var id = pTr.find('.sm_id').val();
       var qty = pTr.find('.sm_actual_qty').val();
       // var code = pTr.find('.edit_prod_code').val();
       var product = pTr.find('.sm_product').val();
       $.ajax({
         url: base_url+'stockreceive/change_actual_qty',
         data: {id:id,delivered:qty,product:product},
         type: 'post',
         dataType: 'json',
         success: function(data){
             pTr.find('.actual_qty').text(qty).show();
             pTr.find('.sm_actual_qty').hide().prop('hidden', true);
             pTr.find('.actual_receive').show().prop('hidden', false);
             pTr.find('.submit_actual_receive_qty').hide().prop('hidden', true);
         }
       });
     });

   });

   //submit actual qty received
   $(document).on('submit','form#add_transfer_qty',function(e){
     e.preventDefault();
     let formData =  new FormData($(this)[0]);
     // var id = $('input[name="purchase_code_status"]').val();
     // // alert(id);
     // formData.append("id",id);
     $.ajax({
         method: 'POST',
         url : base_url + 'stockreceive/add_actual_qty',
         data : formData,
         processData: false,
        contentType: false,
        cache: false,
         dataType: 'json',
         success : function(data) {
             console.log(data);
             $('#ViewStockReceive').modal('hide');
             Swal.fire("Successfully Approved Transfer Stocks!",data.success, "success");
             $(".stocksreceive_tbl").DataTable().ajax.reload();

         }
     })
   });

   //decline transfer stock transaction
   $(document).on("click",'.decline_transfer', function(e) {
     e.preventDefault();
     var id = $(this).attr('data-id');
     // console.log(id);

     Swal.fire({
     title: 'Are you sure?',
     text: "This transaction will be cancelled!",
     input: 'textarea',
     inputPlaceholder: "Reasons or Comments",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#068101',
     confirmButtonText: 'Yes, Cancel Transaction!',
     preConfirm: function () {
    return new Promise((resolve, reject) => {
            resolve({
                Remarks: $('textarea[placeholder="Reasons or Comments"]').val()
            });
        });
    },
    allowOutsideClick: false
  }).then(function(result){
       if (result.value) {
         Swal.fire(
           'Success!',
           'Transaction has been cancelled!',
           'success'
         )
         $.ajax({
         type: 'POST',
           url:base_url + 'stockreceive/decline_transfer',
           data: {id: id, Remarks:result.value},
           cache: false,
           success:function(data) {
               console.log(data);
               $(".stocksreceive_tbl").DataTable().ajax.reload();
           }
         })

       }
     })
   });

});
