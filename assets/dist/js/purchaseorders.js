var base_url = $('input[name="base_url"]').val();
$(document).ready(function(){

  // for numbers only
    $(document).on('keypress', '.number_only', function (event) {
        if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) ||
            $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    })

  //display purchase_tbl
    var purchase_tbl = $('.purchase_tbl').DataTable({
         "responsive": true,
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
                        if(row.status == 1 && row.delivery_status != 4){
                          str += '<a href="javascript:;" class="viewPurchase" data-id="'+row.purchase_code+'"><abbr title="View Purchase Order"><i class="fas fa-eye text-info"></i></a>';
                          str += '<a href="javascript:;" class="editPurchase" data-id="'+row.purchase_code+'" data-sup="'+row.supplier_name+'"><abbr title="Edit Purchase Order"><i class="fas fa-pen text-warning"></i></a>';
                          str += '<a href="javascript:;" class="deletePurchase" data-id="'+row.purchase_code+'"><abbr title="Delete Purchase Order"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                        }else if(row.status == 2 && row.delivery_status != 4){
                          str += '<a href="javascript:;" class="viewPurchase" data-id="'+row.purchase_code+'"><abbr title="View Purchase Order"><i class="fas fa-eye text-info"></i></abbr></a>';
                          str += '<a href="javascript:;" class="remarks" data-id="'+row.purchase_code+'"<abbr title="Remarks"><i class="fa fa-comment" aria-hidden="true"></i></abbr></a>';
                          str += '<a href="javascript:;" class="editPurchase" data-id="'+row.purchase_code+'" data-sup="'+row.supplier_name+'"><abbr title="Edit Purchase Order"><i class="fas fa-pen text-warning"></i></abbr></a>';
                          str += '<a href="javascript:;" class="deletePurchase" data-id="'+row.purchase_code+'"><abbr title="Delete Purchase Order"><i class="fa fa-trash" aria-hidden="true"</i></abbr></a>';
                        }else if(row.status == 3 && row.delivery_status != 4){
                            str += '<a href="javascript:;" class="viewPurchase" data-id="'+row.purchase_code+'"><abbr title="View Purchase Order"><i class="fas fa-eye text-info"></i></abbr></a>';
                            str += '<a href="javascript:;" class="remarks" data-id="'+row.purchase_code+'"<abbr title="Remarks"><i class="fa fa-comment" aria-hidden="true"></i></abbr></a>';
                            str += '<a href="javascript:;" class="editPurchase" data-id="'+row.purchase_code+'" data-sup="'+row.supplier_name+'"><abbr title="Edit Purchase Order"><i class="fas fa-pen text-warning"></i></abbr></a>';
                            str += '<a href="javascript:;" class="editPurchase" data-id="'+row.purchase_code+'" ><abbr title="Edit Purchase Order"><i class="fas fa-pen text-warning"></i></abbr></a>';
                            str += '<a href="javascript:;" class="deletePurchase" data-id="'+row.purchase_code+'"><abbr title="Delete Purchase Order"><i class="fa fa-trash" aria-hidden="true"</i></abbr></a>';
                            // str+= '<div class="form-group">';
                            // str+='<label for="remarks">Remarks:</label>';
                            // str+= '<textarea rows="4" cols="50" class="form-control" name="remarks" required>';
                            // str+='value=""></textarea>';
                            // str+='</div>';
                        }else if(row.delivery_status == 4){
                          str += '<a href="javascript:;" class="remarks" data-id="'+row.purchase_code+'"><abbr title="Remarks"><i class="fa fa-comment" aria-hidden="true"></i></abbr></a>';
                          str += '<a href="javascript:;" class="viewPurchase" data-id="'+row.purchase_code+'"><abbr title="View Purchase Order"><i class="fas fa-eye text-info"></i></abbr></a>';
                        }
                        str += '</div>';
                        return str;
                   }
              },

              {"data":"status","render": function(data, type, row,meta){
                  var str = '';
                   if(row.status == 1){
                     str += '<a href="javascript:;" class="btn btn-block btn-sm btn-primary status" data-status="'+row.delivery_status+'" data-id="'+row.purchase_code+'">pending</a>';
                   }else if(row.status == 2){
                     if(row.delivery_status == 4){
                       str += '<a href="javascript:;" class="inactive btn btn-block btn-sm btn-success" data-status="'+row.delivery_status+'" data-id="'+row.purchase_code+'" disabled>approved</a>';
                     }else{
                       str += '<a href="javascript:;" class="inactive btn btn-block btn-sm btn-success status" data-status="'+row.delivery_status+'" data-id="'+row.purchase_code+'">approved</a>';
                     }
                   }else if(row.status == 3){
                     str += '<a href="javascript:;" class="active btn btn-block btn-sm btn-danger status" data-status="'+row.delivery_status+'" data-id="'+row.purchase_code+'">cancelled</a>';
                   }
                   return str;
              }
            },
            {"data":"delivery_status","render": function(data, type, row,meta){
                var str = '';

                 if(row.delivery_status == 1){
                    if(row.status != 2){
                      str += '<a href="javascript:;" class="btn btn-block btn-sm btn-primary" data-status="'+row.delivery_status+'" data-id="'+row.purchase_code+'" disabled>waiting for approval</a>';
                    }else{
                      str += '<a href="javascript:;" class="btn btn-block btn-sm btn-primary deliveryStat" data-status="'+row.delivery_status+'" data-id="'+row.purchase_code+'">waiting for approval</a>';
                    }
                 }else if(row.delivery_status == 2){
                   str += '<a href="javascript:;" class="inactive btn btn-block btn-sm btn-danger deliveryStat" data-status="'+row.delivery_status+'" data-id="'+row.purchase_code+'">on hold</a>';
                 }else if(row.delivery_status == 3){
                   str += '<a href="javascript:;" class="btn btn-block btn-sm btn-warning deliveryStat" data-status="'+row.delivery_status+'" data-id="'+row.purchase_code+'">on process</a>';
                 }else if(row.delivery_status == 4){
                   str += '<a href="javascript:;" class="btn btn-block btn-sm btn-success deliveryStat" data-status="'+row.delivery_status+'" data-id="'+row.purchase_code+'">delivered</a>';
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

  //add remarks on delivery status if on process, on hold and delivered Status
  $('#delivery_status').on('change', function(){
    if( $(this).val()!=="1"){
      $("#remarks_delivery").show();
    }else{
      $("#remarks_delivery").hide();
    }
  });

  //add remarkd if cancelled and approved Status
  $('#status').on('change', function(){
    if( $(this).val()!=="1"){
      $("#remarks").show();
    }else{
      $("#remarks").hide();
    }
  });
// IF APPROVED STATUS
  $('#status').on('change', function(){
    if( $(this).val()==="2"){
      $("#approved").show();
    }else{
      $("#approved").hide();
    }
  });
  // END IF APPROVED STATUS

  //view remarks
  $(document).on('click', '.remarks', function(){
    var id = $(this).attr('data-id');
    var status = $(this).attr('data-status');
    $.ajax({
      method: 'POST',
      url: base_url + 'purchaseorders/view_remarks',
      data: {id:id,status:status},
      dataType: "json",
      success: function(data){
        console.log(data);
        $('#viewRemarks').modal('show');
         $('.viewremarks').text(data.remarks.remarks);
         $('.view_deliv_remarks').text(data.remarks.delivery_remarks);
        // $('#change_Stat select[name=status]').val(data.status.status);
        //   $('input[name="purchase_code_status"]').val(data.status.purchase_code);
    }
   });
  });

  //Update  status
  $(document).on('click', '.status', function(){
     var id = $(this).attr('data-id');
     var status = $(this).attr('data-status');
     $.ajax({
       method: 'POST',
       url: base_url + 'purchaseorders/view_status',
       data: {id:id,status:status},
       dataType: "json",
       success: function(data){
         console.log(data);
         $('#Status').modal('show');
         $('#change_Stat select[name=status]').val(data.status.status);
           $('input[name="purchase_code_status"]').val(data.status.purchase_code);
     }
    });
  });

  $(document).on('submit','form#change_Stat',function(e){
    e.preventDefault();
    let formData =  new FormData($(this)[0]);
    var id = $('input[name="purchase_code_status"]').val();
    // alert(id);
    formData.append("id",id);
    $.ajax({
        method: 'POST',
        url : base_url + 'purchaseorders/change_status',
        data : formData,
        processData: false,
       contentType: false,
       cache: false,
        dataType: 'json',
        success : function(data) {
            console.log(data);
            $('#Status').modal('hide');
            Swal.fire("Successfully updated status!",data.success, "success");
            $(".purchase_tbl").DataTable().ajax.reload();
        }
    })
  });
  //End of Update status


  //Update delivery status
  $(document).on('click', '.deliveryStat', function(){

     var id = $(this).attr('data-id');
     var deliv_status = $(this).attr('data-status');
     $.ajax({
       method: 'POST',
       url: base_url + 'purchaseorders/view_deliv_status',
       data: {id:id,deliv_status:deliv_status},
       dataType: "json",
       success: function(data){
         console.log(data);
         $('#DeliveryStatus').modal('show');
         $('#change_deliveryStat select[name=delivery_status]').val(data.delivery.delivery_status);
            $('input[name="warehouse_id"]').val(data.delivery.warehouse_id);
           $('input[name="purchase_code_delivery"]').val(data.delivery.purchase_code);
           $('input[name="product"]').val(data.delivery.product);
           $('input[name="code"]').val(data.delivery.code);
           $('input[name="quantity"]').val(data.delivery.quantity);
     }
    });
  });

  $(document).on('submit','form#change_deliveryStat',function(e){

    e.preventDefault();
    let formData =  new FormData($(this)[0]);
    var id = $('input[name="product"]').val();
    var code = $('input[name="code"]').val();
    var warehouse_id = $('input[name="warehouse_id"]').val();
    alert(id);
    formData.append("warehouse_id",warehouse_id);
    formData.append("id",id);
    formData.append("code",code);
    $.ajax({
        method: 'POST',
        url : base_url + 'purchaseorders/change_deliv_status',
        data : formData,
        processData: false,
       contentType: false,
       cache: false,
        dataType: 'json',
        success : function(data) {
            console.log(data);
            $('#DeliveryStatus').modal('hide');
            Swal.fire("Successfully updated delivery status!",data.success, "success");
            $(".purchase_tbl").DataTable().ajax.reload();

        }
    })
  });
  //End of Update delivery status

  //choose from product name
    $('select[name="prod_code[]"]').select2({
      placeholder: "Select SKU"
    });

  //autocomplete product name after choosing sku Codef
  $(document).on('change','.code',function(){
    $.ajax({
        url: base_url+'purchaseorders/get_productName_by_code',
        data: {prod_id:$(this).val()},
        type: 'post',
        dataType: 'json',
        success: function(data){
                $.each(data.products,function(index,element){
                      $('.prod_name').val(element.code);
                      $('.purchase_price').val(element.cost_price);
                });

        },
    });
  });

  //autocomplete product name after choosing sku Code if add new product
  $(document).on('change','.add_code',function(){
    let that = $(this);
    $.ajax({
        url: base_url+'purchaseorders/get_productName_by_code',
        data: {prod_id:$(this).val()},
        type: 'post',
        dataType: 'json',
        success: function(data){
            console.log('test');
            console.log($(that).parent().next().next().next().find('.purchase_price '));
                $.each(data.products,function(index,element){
                      $(that).parent().next().find('.add_prod').val(element.code);
                      $(that).parent().next().next().next().find('.purchase_price').val(element.cost_price);
                });
        }
    });
  });

  //autocomplete product name after choosing sku Code
  $(document).on('change','.edit_new_code',function(){
    var el = $(this);
    var id = $(this).attr('data-prod');
    // alert(id);
    $.ajax({
        url: base_url+'purchaseorders/get_productName_by_code_edit',
        data: {prod_id:$(this).val(),purchase_id:id},
        type: 'post',
        dataType: 'json',
        success: function(data){
                $.each(data.products,function(index,element){
                  // $(this).closest('tr').find('.edit_new_name').val($('option:selected', this).data('price'))
                  // console.log($(this).closest('tr').find('.edit_new_name').val($('option:selected', this).data('price')));
                  // $('.edit_new_code').next().closest('td').find('.edit_new_name').val($('option:selected', this).data('price'));
                  // $('input[name="prod_name[]"]').val(element.product_name);
                  el.parents('tr').find('input[name="prod_name[]"]').val(element.code);
                });
        }
    });
  });

  //autocomplete product name after choosing sku Code if edit new product
  $(document).on('change','.edit_code',function(){
    let that = $(this);
    $.ajax({
        url: base_url+'purchaseorders/get_productName_by_code',
        data: {prod_id:$(this).val()},
        type: 'post',
        dataType: 'json',
        success: function(data){
            console.log('data');
            console.log(data);
                $.each(data.products,function(index,element){
                      // $('.edit_name').val(element.product_name);
                      $(that).parent().next().find('.edit_name').val(element.code);
                      $(that).parent().next().next().next().find('.purchase_price ').val(element.cost_price);
                });

        }
    });
  });

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
                    $("select[name='"+value+"']").next().next().text(data.form_error[value]);
                    // $("select[name='"+value+"']").parents('.form-group').next('.err').text(data.form_error[value]);
                });
            }else if (data.error) {
                Swal.fire("Error",data.error, "error");
            }else {
                blankVal_purchase();
                $('#AddPurchaseOrder').modal('hide');
                Swal.fire("Successfully added purchase order!",data.success, "success")
                .then((result) => {
                  window.location = base_url + 'purchaseorders';
                });
            }
        }
    })
  });


  $(document).on('submit', 'form#po_arrived_up', function(e){
      e.preventDefault();
      // alert('yayay');

      let formData = new FormData($(this)[0]);
      var id = $('input[name="update_arrived_delivered"]').val();

      console.log(formData);
      formData.append("id", id);

      $.ajax({
          method: 'POST',
          url: base_url+'purchaseorders/change_delivered_qty',
          data: formData,
          processData: false,
          contentType: false,
          cache: false,
          dataType: 'json',
          success: function(data){
              console.log(data);
              if (data.status == 'ok') {
                  console.log(data.success);
                  Swal.fire("Added Delivered items!", data.success, 'success');
                    // $('#po_arived_edit').modal('toggle');
                     location.reload();
              }else {
                  Swal.fire("Error!", data.status, 'invalid');
              }
          }
      })
  });

  //view list of Orders
  $(document).on('click', '.viewPurchase', function(){
     var id = $(this).attr('data-id');
     $('.po_arrived_btn').attr('data-id', id);
     // alert('hi');
     $.ajax({
       method: 'POST',
       url: base_url + 'purchaseorders/view_purchase_orders',
       data: {id:id},
       dataType: "json",
       success: function(data){
         console.log(data);
         $('#ViewPurchaseOrders').modal('show');
         var str = '';
         var total_quantity = 0;
         var total_cost = 0;
         var grand_total = 0;

           $.each(data.purchase,function(index,element){
             console.log(element);
             total_quantity = parseFloat(total_quantity) + parseFloat(element.quantity);
             total_cost = parseFloat(total_cost) + parseFloat(element.unit_price);
             var total = parseFloat(element.quantity) * parseFloat(element.unit_price);
             var prod_total = total.toFixed(2);
             grand_total = parseFloat(grand_total) + parseFloat(total);

             if(element.delivered == ''){
               var deliv = 0;
             }else{
                var deliv = element.delivered;
             }
             console.log('elemt');
             console.log(element);
             $('.code').text(element.purchase_code);
             $('.date').text(element.date_ordered);
             $('.company').text(element.company_name);
             $('.supplier').text(element.supplier_name);
             $('.warehouse').text(element.wh_name);
             str += '<tr>';
             str +=     '<td class="purch_td hide">';
                 str +=   '<input type="hidden" class="edit_purchID" name="view_purchase_id[]" value='+element.purchase_id+'>';
                str += '</td>';
                str +=     '<td class="purch_td hide">';
                    str +=   '<input type="hidden" class="edit_product" name="view_prod[]" value='+element.product+'>';
                   str += '</td>';
                   str +=     '<td class="purch_td hide">';
                       str +=   '<input type="hidden" class="edit_prod_code" name="view_prod_code[]" value='+element.code+'>';
                      str += '</td>';
                      str +=     '<td class="purch_td hide">';
                          str +=   '<input type="hidden" class="edit_delivery_status" name="view_delivery_status[]" value='+element.delivery_status+'>';
                         str += '</td>';

                str +=     '<td class="purch_td">';
                    str +=   element.code;
                   str += '</td>';
               str +=     '<td class="purch_td">';
                   str +=   element.product_name;
                  str += '</td>';
                 str += ' <td class="purch_td td_qty">';
                     str += element.quantity;
                 str += '</td>';
               str +=  '<td class="purch_td price">';
                  str += element.unit_price;
                str += '</td>';
                str +=  '<td class="purch_td total">';
                str += prod_total;
                 str += '</td>';
                 str +=  '<td class="purch_td delivered">';
                    str += '<span class="deliv">'+deliv+'</span>';
                    str +=   '<input type="text" class="edit_deliv number_only" name="delivered[]" value='+deliv+' disabled hidden>';
                  str += '</td>';
                  str +=  '<td class="purch_td edit_variance">';
                    var variance = element.quantity - element.delivered;
                        // if (variance>=0) {
                        //     $('.edit_variance').css({'color':'green'});
                        // } else {
                        //     $('.edit_variance').css({'color':'red'});
                        // }
                        str += variance;
                   str += '</td>';
                  // if(element.delivery_status == 4){
                  //   str += '<td class="purch_td submit_delivered">';
                  //   str += '<a href="javascript:;" class="btn btn-xs btn-primary edit_delivered" data-id="'+element.id+'"><i class="fa fa-edit"></i></a>';
                  //   // str += '<a href="javascript:;" class="btn btn-xs btn-success submit_delivered_qty" data-id="'+element.id+'"hidden><i class="fa fa-check"></i></a>';
                  //   str += '</td>';
                  // }else{
                  //   str += '<td class="purch_td submit_delivered">';
                  //   str += '<a href="javascript:;" class="btn btn-xs btn-primary edit_delivered disabled" data-id="'+element.id+'"><i class="fa fa-edit"></i></a>';
                  //   str += '<a href="javascript:;" class="btn btn-xs btn-success submit_delivered_qty" data-id="'+element.id+'" hidden><i class="fa fa-check"></i></a>';
                  //   str += '</td>';
                  // }
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

  //show edit delivered input on view purchase order
  // $(document).on('click','.edit_delivered', function(e){
  //
  //     e.preventDefault();
  //     // alert('rerer');
  //   var pTr = $(this).parents('tr');
  //
  //   // console.log('ptr');
  //   // console.log(pTr.find('td:eq(6)').text());
  //
  //   pTr.find('.edit_deliv').show().prop('disabled', false).prop('hidden', false);
  //   pTr.find('.deliv').hide();
  //
  //   pTr.find('.submit_delivered_qty').show().prop('hidden', false);
  //   pTr.find('.edit_delivered').hide().prop('hidden', true);
  //
  //
  //   $('.submit_delivered_qty').unbind('click').click(function(e) {
  //     var str='';
  //     var id = pTr.find('.edit_purchID').val();
  //     var qty = pTr.find('.edit_deliv').val();
  //     var edit_qty = pTr.find('.td_qty').text();
  //     var code = pTr.find('.edit_prod_code').val();
  //     var product = pTr.find('.edit_product').val();
  //     var delivery_status = pTr.find('.edit_delivery_status').val();
  //     // var variance= pTr.find('.edit_variance').val();
  //     var delivered= pTr.find('.edit_deliv ').val();
  //     // var get_variance =
  //
  //     $.ajax({
  //       url: base_url+'purchaseorders/change_delivered_qty',
  //       data: {id:id,delivered:qty,code:code,product:product,delivery_status:delivery_status},
  //       type: 'post',
  //       dataType: 'json',
  //       success: function(data){
  //           var variance = edit_qty - data.delivered;
  //           pTr.find('.deliv').text(qty).show();
  //           pTr.find('.edit_deliv').hide().prop('hidden', true);
  //           pTr.find('.edit_delivered').show().prop('hidden', false);
  //           pTr.find('.submit_delivered_qty').hide().prop('hidden', true);
  //           // $(`.submit_delivered[data-id='${id}']`).trigger('click');
  //            // $("#view_purchase_orders_details").DataTable().ajax.reload();
  //            pTr.find('.edit_variance').text(variance);
  //       }
  //     });
  //   });
  //
  // });

  //display suppliers according to company
  $(document).on('change','select[name="company"]',function(){
      alert('nevin gwapo');
    $.ajax({
        url: base_url+'purchaseorders/get_suppliers_by_companies',
        data: {company_id:$(this).val()},
        type: 'post',
        dataType: 'json',
        success: function(data){
          console.log(data);
          var str = '';
          str += '<label for="supplier">Supplier: <span class="required">*</span></label>';
          str += '<select class="form-control" class="supplier" name="supplier" >';
              str += '<option value="" selected hidden>Select Supplier</option>';
                $.each(data.suppliers,function(index,element){
                      str += '<option value="'+element.supplier_name+'">'+element.supplier_name+'</option>';
                });
          str += '</select>';
          str += '<span class="err"></span>';
          $('#show_supplier').html(str);
            var str1 = '';
            str1 += '<label for="warehouse">Warehouse: <span class="required">*</span></label>';
            str1 += '<select class="form-control" class="warehouse" name="warehouse" >';
                str1 += '<option value="" selected hidden>Select Warehouse</option>';
                  $.each(data.warehouse,function(index,element){
                        // str1 += '<input type="hidden" name="wh_name" value="'+element.wh_name+'">';
                        str1 += '<option value="'+element.id+'|'+element.wh_name+'">'+element.wh_name+'</option>';
                  });
            str1 += '</select>';
            str1 += '<span class="err"></span>';

            $('#show_warehouse').html(str1);
        }
    });
  });

    $(document).on('change','select[name="supplier"]',function(){
        var sup = $('select[name="supplier"]').val();

        var opt = '';

        $('#addNewPO').show();

        $.ajax({
            url: base_url+'purchaseorders/getProductBySupplier',
            data: {supplier:sup},
            type: 'post',
            dataType: 'json',
            success: function(data){
                console.log('PO data');
                console.log(data.products);
                var str = "";
                if (data.products.length === 0) {
                    str += "No product available"
                }else{
                    $.each(data.products,function(index,key){
                        str += '<tr>';
                            str += '<td class="purch_td">';
                                str += '<input type="text" class="form-control prod_name" name="prod_name[]" value="'+key.product_name+'">';
                                str += '<span class="err"></span>';
                            str += '</td>'
                            str += '<td class="purch_td">';
                                str += '<input type="text" class="form-control prod_name" name="prod_code[]" value="'+key.code+'" readonly>';
                                str += ' <span class="err">';
                            str += '</td>'
                            str += '<td class="purch_td">';
                                str += '<input type="text" class="form-control purchase_quantity number_only" name="quantity[]" value="">';
                                str += ' <span class="err">';
                            str += '</td>'
                            str += '<td class="purch_td">';
                                str += '<input type="text" class="form-control purchase_price number_only" name="unit_price[]" value="'+key.cost_price+'" readonly>';
                                str += ' <span class="err">';
                            str += '</td>'

                            str += '<td class="purch_td">';
                                str += '<input type="text" class="form-control purchase_total" name="total[]" value="" readonly>';
                                str += ' <span class="err">';
                            str += '</td>'
                         str+= '</tr>';
                    });
                }

                 $('#add_new_product tbody').html(str);

                // opt += '<select class="form-control code select2" style="width: 100%;" name="prod_code[]">';
                //     opt += '<option value="">Select Product</option>';
                //     $.each(data.products,function(index,key){
                //         opt += '<option value='+key.id+'>'+key.product_name+'</option>';
                //     });
                // opt += '</select>';
                // $('#prodOption').html(opt);
            }
        });


    });

  // $(document).on('change', 'select[name="prod_code[]"]', function(){
  //    $.ajax({
  //        url: base_url+'purchaseorders/get_code_by_supplier',
  //        data: {id:$(thid.val())},
  //        type: 'post',
  //        dataType: 'json',
  //        success: function(data){
  //           console.log(data);
  //               var str='';
  //               str += '<select class="form-control code select2" style="width: 100%;" name="prod_code[]">'
  //                   str += '<option value="" selected hidden>Select SKU</option>';
  //                   $.each(data.supplier, function(index, element
  //                   )){
  //
  //                   }
  //
  //        }
  //
  //
  //

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
          str += '<select class="form-control" class="supplier" name="supplier_edit" value="" >';
              // str += '<option value="" selected hidden>Select Supplier</option>';
                $.each(data.suppliers,function(index,element){
                      str += '<option value="'+element.id+'">'+element.supplier_name+'</option>';
                });
          str += '</select>';
          str += '<span class="err"></span>';

            $('#edit_show_supplier').html(str);

            var str1 = '';
            str1 += '<label for="warehouse">Warehouse: <span class="required">*</span></label>';
            str1 += '<select class="form-control" class="warehouse" name="warehouse_edit" value="" >';
                // str1 += '<option value="" selected>Select Warehouse</option>';

                  $.each(data.warehouse,function(index,element){
                        str1 += '<option value="'+element.id+'">'+element.wh_name+'</option>';
                  });
            str1 += '</select>';
            str1 += '<span class="err"></span>';

            $('#edit_show_warehouse').html(str1);

        }
    });
  });

  //view edit Orders
  $(document).on('click', '.editPurchase', function(){
    var id = $(this).attr('data-id');
    var datasup = $(this).attr('data-sup');

    $('#sup').html(datasup);

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

          var sup = data.purch_details[0].supplier;

          $.each(data.purch_details,function(index,element){
            total = parseFloat(element.quantity) + parseFloat(element.unit_price)
            total_quantity = parseFloat(total_quantity) + parseFloat(element.quantity);
            total_cost = parseFloat(total_cost) + parseFloat(element.unit_price);
            var total = parseFloat(element.quantity) * parseFloat(element.unit_price);
             var prod_total = total.toFixed(2);
            grand_total = parseFloat(grand_total) + parseFloat(total);

            $('#editpurchaseorder input[name=edit_purchase_code]').val(element.purchase_code);
            $('#editpurchaseorder textarea[name=purchase_note]').val(element.note);
            $('#editpurchaseorder select[name=company_edit]').val(element.company_id);
            $('#editpurchaseorder select[name="company_edit"]').trigger('change');

            setTimeout(function(){
              $('#editpurchaseorder select[name="supplier_edit"]').val(element.supplier_id);
              $('#editpurchaseorder select[name="warehouse_edit"]').val(element.warehouse_id);
            }, 0100);



            // str += '<input type="hidden" name="purchase_id" value='+element.purchase_id+'>';
            str += '<tr>';
            str += '<td class="purch_td hide">';
            str += '<input type="hidden" class="form-control edit_purchase_id" name="edit_purchase_id[]" value='+element.purchase_id+'>';
            str += '</td>';
              str += '<td class="purch_td">';
              str += '<input type="hidden" class="form-control" name="edit_purchase_id_select[]" value='+element.purchase_id+'>';
              str += '<select class="form-control edit_new_code select2_edit" data-prod="'+element.purchase_id+'" style="width: 100%;" name="prod_code[]" data-id="'+element.product_id+'" value="'+element.code+'">';
                  // str += '<option value="'+element.id+'" selected hidden>'+element.code+'</option>';
                   str += get_edit_products(element.id);
                str += '</select>';
                   // str += '<input type="text" class="form-control" name="prod_name[]" value='+element.product+'>';
                   str += '<span class="err"></span>';
              str += '</td>';
              str += '<td class="purch_td">';
                   str += '<input type="text" data-price="'+element.product_name+'" class="form-control edit_new_name" name="prod_name[]" value="'+element.product_name+'" readonly>';
                   str += '<span class="err"></span>';
              str += '</td>';
              str += '<td class="purch_td">';
                   str += '<input type="text" class="form-control purchase_quantity number_only" name="quantity[]" value='+element.quantity+'>';
                   str += '<span class="err"></span>';
              str += '</td>';
              str += '<td class="purch_td">';
                  str += '<input type="text" class="form-control purchase_price number_only" name="unit_price[]" value='+element.unit_price+'>';
                  str += '<span class="err"></span>';
              str += '</td>';
              str += '<td class="purch_td">';
                  str += '<input type="text" class="form-control purchase_total" name="total[]" value='+prod_total+' readonly>';
                  str += '<span class="err"></span>';
              str += '</td>';
            str += '</tr>';

          });

          $('.total_quantity').val(total_quantity);
          $('.total_cost').val(total_cost.toFixed(2));
          $('#edit_purch tbody').html(str);
          $('.select2_edit').select2({
            hideSelected: true
          });
          $('.grand_total').val(grand_total.toFixed(2));
          // $('#editpurchaseorder select[name="prod_name[]"]').trigger('change');
        }
    });

  });

  // $(document).on('change','select[name="prod_name[]"]',function(){
  //   var id = $(this).attr('data-id');
  //   $.ajax({
  //       url: base_url+'purchaseorders/get_edit_products',
  //       data: {id:id},
  //       type: 'post',
  //       dataType: 'json',
  //       success: function(data){
  //         var str = '';
  //             // str += '<option value="" selected hidden>Select Supplier</option>';
  //               $.each(data.products,function(index,element){
  //                 str += '<select class="form-control select2_edit" style="width: 100%;" name="prod_name[]" data-id="'+element.product_id+'" value="'+element.product_name+'">';
  //                     str += '<option value="'+element.id+'" selected>'+element.product_name+'</option>';
  //                    str += get_products();
  //                 str += '</select>';
  //               });
  //
  //           $('#edit_purch tbody').html(str);
  //
  //       }
  //   });
  // });

  //successfully edited purchase order
  $(document).on('submit','#editpurchaseorder',function(e){
    e.preventDefault();
    let formData =  new FormData($(this)[0]);
    var id = $('input[name="edit_purchase_id"]').val();
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
                $('#EditPurchaseOrder').modal('hide');
                Swal.fire("Successfully updated purchase order!",data.success, "success");
                $(".purchase_tbl").DataTable().ajax.reload();
            }
        }
    })
  });

  //add multiple product in add purchase order
  $(document).on('click', '#addNewPO', function(){
    var x = 1;
    var str = '';

    var sup = $('select[name="supplier"]').val();

    str += '<tr class="add_purch">';
      str += '<td class="purch_td">';
           str += '<select class="form-control add_code select2_add" style="width: 100%;" name="prod_code[]">';
              str += '<option value="" selected="true" disabled="disabled">Select Product</option>';
              str += get_products(sup);
           str += '</select>';
           str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
           str += '<input type="text" class="form-control add_prod" name="prod_name[]" value="" readonly>';
           str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
           str += '<input type="text" class="form-control purchase_quantity number_only" name="quantity[]" value="">';
           str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
          str += '<input type="text" class="form-control purchase_price number_only" readonly name="unit_price[]" value="">';
          str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
          str += '<input type="text" class="form-control discount number_only" name="discount[]" value="">';
          str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
          str += '<input type="text" class="form-control purchase_total" name="total[]" value="" readonly>';
          str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
          str += '<button id="removeNewPO" class="btn btn-md btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>';
      str += '</td>';
    str += '</tr>';


    if(x){
      x++;
      $('#add_new_product tbody').append(str);
      $('.select2_add').select2();
    }
    // get_supplier();
    });


  $(document).on('click', '#removeNewPO', function(){
    $(this).parent().parent().remove(); x--;
  });

  //add multiple product in add purchase order
  $(document).on('click', '#addNewPO_edit', function(e){
      e.preventDefault();
    var x = 1;
    var sup = $('#sup').text();

    var str = '';

    str += '<tr>';
      str += '<td class="purch_td">';
        str += '<select class="form-control edit_code select2_edit" style="width: 100%;" name="edit_prod_code[]">';
         str += '<option value="" selected="true" disabled="disabled">Select Products</option>';
         str += get_products(sup);
        str += '</select>';
           str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
           str += '<input type="text" class="form-control edit_name" name="edit_prod_name[]" value="" readonly>';
           str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
           str += '<input type="text" class="form-control purchase_quantity number_only" name="edit_quantity[]" value="">';
           str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
          str += '<input type="text" class="form-control purchase_price number_only" name="edit_unit_price[]" value="">';
          str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
          str += '<input type="text" class="form-control purchase_total" name="edit_total[]" value="" readonly>';
          str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
          str += '<button id="removeNewPO_edit" class="btn btn-md btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>';
      str += '</td>';
    str += '</tr>';

    if(x){
      x++;
      $('#edit_purch').append(str);
      $('.edit_code').select2();
    }
    // get_supplier();
  });

  $(document).on('click', '#removeNewPO_edit', function(){
    $(this).parent().parent().remove(); x--;
  });

  //compute total for qunatity * unit Price
    $(document).on('keyup', '.purchase_price, .purchase_quantity, .discount', function(){
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

         var discount_amount = 0;
         var discount_total = 0;
         var discount = $('.discount').val();

         discount_amount = (grand_total/100)*discount;
         discount_total = grand_total - discount_amount;

          $('.grand_total').val(discount_total.toFixed(2));

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
          $(".total_cost").val(grand_total.toFixed(2));
      });

      $(document).on('keyup keydown', '.discount', function(e) {
            var $myInput = $(this);

            if ($myInput.val() > 100) {
                $myInput.val(100);
            }
        });


      // DELETE PURCHASE ORDER
      $(document).on('click', '.deletePurchase', function(e){
          e.preventDefault();
          // alert("hi");
          var id = $(this).attr('data-id');
          console.log(id);

          Swal.fire({
          title: 'Are you sure?',
          text: "You want to permanently delete this Purchase Order!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#068101',
          confirmButtonText: 'Yes, Permanently Purchase Order!'
          }).then((result) => {
            if (result.value) {
              Swal.fire(
                'Deleted!',
                'Successfully Deleted Purchase Order!',
                'success'
              )
                $.ajax({
                type: 'POST',
                  url:base_url + 'purchaseorders/deletePurchaseO',
                  data: {id: id},
                  success:function(data) {
                    $(".purchase_tbl").DataTable().ajax.reload();
                  }
                })
            }
          });
      });

      $(document).on('click', '.purchase-order-btn', function(){
          $.ajax({
             type   : 'POST',
             url    : base_url + 'purchaseorders/get_sku',
          });
      });

      $.ajaxSetup({ cache: false });
         $('#sku').keyup(function(){
          $('#result').html('');
          var searchField = $('#sku').val();

          var url = base_url + 'purchaseorders/get_sku';
          var expression = new RegExp(searchField, "i");

          $.getJSON(url, function(data) {
           $.each(data, function(key, value){
            if (value.code.search(expression) != -1)
            {
                 $('#result').append('<li class="list-group-item link-class">'+value.code+'</span></li>');
            }
           });
          });
         });

         $('#result').on('click', 'li', function() {
          var click_text = $(this).text().split('|');
           console.log(click_text);
           $('#sku').val($.trim(click_text[0]));
           $("#result").html('');
         });

         $('#import_cs_po').on('submit',function(e){
             e.preventDefault();
             $.ajax({
                url: base_url + 'purchaseorders/import_csv',
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                    $('#import_csv_btn').html('Importing...');
                },
                success:function(data){
                    if($("[name='csv_file_po']").get(0).files.length === 0){
                         Swal.fire("Please select CSV file",'', "error");
                    }else{
                        Swal.fire("CSV File Successfully imported!",'', "success");
                    }
                }
             });
         })
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

function get_warehouse(){
  var data_return = '';
  $.ajax({
    url: base_url + '/purchaseorders/get_warehouse/',
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

function get_products(event){

    var supplier = event;
  // var id = $('.select2_edit').attr('data-id');
  // alert(id);
  var data_return = '';
  $.ajax({
    url: base_url + '/purchaseorders/get_products/',
    type:'post',
    data: {supplier: supplier},
    dataType:'json',
    async:false,
    success:function(data){
      var str = '';
      $.each(data.products,function(index,element){
        str += '<option value="'+element.id+'">'+element.product_name+'</option>';
      });
      data_return = str;
    }
  });
  return data_return;
}

function get_edit_products(selected_product = ''){
  //   var id = $('.editPurchase').attr('data-id');
  // var data_return = '';
  $.ajax({
    url: base_url + '/purchaseorders/get_edit_products/',
    type:'post',
    dataType:'json',
    async:false,
    success:function(data){
      var str = '';
      $.each(data.products,function(index,element){
        str += '<option value="'+element.id+'" '+(selected_product == element.id ? 'selected' : '')+'>'+element.code+'</option>';
      });
      data_return = str;
    }
  });
  return data_return;
}

// P_O Arrived
// $(document).on("click", ".po_arrived_btn", function () {
//    var id = $(this).attr("data-id");
//    console.log($(this).data("id"));
//    console.log($(this).data());
//    $('#po_arived_edit').modal('show')
// });
// P_O Arrived
// P_O Arrive modal table
$(document).on('click', '.po_arrived_btn', function(){

   var id = $(this).attr('data-id');

   $.ajax({
     method: 'POST',
     url: base_url + 'purchaseorders/view_purchase_orders',
     data: {id:id},
     dataType: "json",
     success: function(data){
       console.log('asas');
       console.log(data);
       $('#po_arived_edit').modal('show');
        var str = '';

         $.each(data.purchase,function(index,element){
        $('#po_arived_edit .update_arrived_delivered_id').val(element.purchase_id);
          console.log(data.purchase_id);

          console.log('elemt');
          console.log(element);

          str += '<tr>';
          str +=     '<td class="purch_td hide">';
              str +=   '<input type="hidden" class="edit_purchID" name="view_purchase_id[]" value='+element.purchase_id+'>';
             str += '</td>';
             str +=     '<td class="purch_td hide">';
                 str +=   '<input type="hidden" class="edit_product" name="view_prod[]" value='+element.product+'>';
                str += '</td>';
                str +=     '<td class="purch_td hide">';
                    str +=   '<input type="hidden" class="edit_prod_code" name="view_prod_code[]" value='+element.code+'>';
                   str += '</td>';
                   str +=     '<td class="purch_td hide">';
                       str +=   '<input type="hidden" class="edit_delivery_status" name="view_delivery_status[]" value='+element.delivery_status+'>';
                      str += '</td>';

             str +=     '<td class="purch_td">';
                 str +=   element.code;
                str += '</td>';
                str += '<td class="purch_td">';
                str +=   element.product_name;
               str += '</td>';
               str += ' <td class="purch_td td_qty">';
                   str += element.quantity;
               str += '</td>';
              str +=  '<td class="purch_td delivered">';
                 str += '<span class="deliv"></span>';
                 str +=   '<input type="text" class="edit_deliv number_only" name="delivered[]" value="">';
               str += '</td>';
            str += '</tr>';
      });

      $('#view_po_arrived tbody').html(str);
 }
});
});


// P_O Arrive modal table



function blankVal_purchase(){
  $('#AddPurchaseOrder select[name="company"]').val('');
  $('#AddPurchaseOrder select[name="supplier"]').val('');
  $('#AddPurchaseOrder select[name="warehouse"]').val('');
  $('#AddPurchaseOrder input[name="prod_name[]"]').val('');
  $('#AddPurchaseOrder select[name="prod_code[]"]').val('');
  $('#AddPurchaseOrder .code ').val('').trigger('change');
  $('#AddPurchaseOrder .add_code ').val('').trigger('change');
  $('#AddPurchaseOrder .add_purch ').remove();
  $('.err').text('');
  $('#AddPurchaseOrder input[name="quantity[]"]').val('');
  $('#AddPurchaseOrder input[name="unit_price[]"]').val('');
  $('#AddPurchaseOrder input[name="total[]"]').val('');
  $('#AddPurchaseOrder textarea[name="purchase_note"]').val('');
  $('#AddPurchaseOrder input[name="total_quantity"]').val('');
  $('#AddPurchaseOrder input[name="total_cost"]').val('');
  $('#AddPurchaseOrder input[name="grand_total"]').val('');
}
