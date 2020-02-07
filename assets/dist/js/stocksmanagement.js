var base_url = $('input[name="base_url"]').val();
$(document).ready(function(){

  $('#so_type').on('change', function(){
    if($(this).val() == "2"){
      $('.warehouse').css('display', 'block');
    }else{
      $('.warehouse').css('display', 'none');
    }
  });

  //display purchase_tbl
    var purchase_tbl = $('.stocks_tbl').DataTable({
         "processing": true, //Feature control the processing indicator.
         "serverSide": true, //Feature control DataTables' server-side processing mode.
         "order": [[0,'desc']], //Initial no order.
         "columns":[
              {"data":"wh_name"},
              {"data":"code"},
              {"data":"supplier_name"},
              {"data":"brand"},
              {"data":"product_name"},
              {"data":"packing","render": function(data, type, row,meta){
                var str = '';
                  str += '<div>';
                    str += '<span class="variance">0</span>';
                  str += '</div>';
                return str;
              }
            },
            {"data":"date_delivered"},
              {"data":"system_count"},

              // {"data":"type"},
              {"data":"physical_count","render": function(data, type, row,meta){
                        var str = '';
                         str += '<div>';
                         str += '<span class="physical_count">';
                           str += row.physical_count;

                         str += '</span>';
                        str += '</div>';
                        return str;
                   }
              },

              {"data":"variance","render": function(data, type, row,meta){
                var variance = row.system_count - row.physical_count;
                var str = '';
                  str += '<div>';
                  if(row.physical_count == 0){
                    str += '<span class="variance">0</span>';
                  }else{

                    str += '<span class="variance">'+variance+'</span>';
                  }
                  str += '</div>';
                return str;
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


  //view list of Orders
  $(document).on('click', '.generatereport', function(){
      $('#GenerateReport').modal('show');
     $.ajax({
       method: 'POST',
       url: base_url + 'stocksmanagement/view_reports',
       // data: {id:id},
       dataType: "json",
       success: function(data){
         $('#GenerateReport').modal('show');
         var str = '';
           $.each(data.stocks,function(index,element){
             console.log(element);
              str += '<tr>';
                  str +=     '<td class="purch_td hide">';
                    str +=   '<input type="hidden" class="prod_code" name="view_stock_id[]" value='+element.stock_id+'>';
                  str += '</td>';
                str +=     '<td class="purch_td hide">';
                  str +=   '<input type="hidden" class="prod_code" name="view_prod_code[]" value='+element.product+'>';
                str += '</td>';
                str +=     '<td class="purch_td code">';
                    str +=   '<input type="number" class="edit_deliv form-control form-control-sm" value='+element.code+' name="code[]" hidden>';
                    str +=   element.code;
                   str += '</td>';
               str +=     '<td class="purch_td product_name">';
                    str +=   '<input type="text" class="edit_deliv form-control form-control-sm" value='+element.product_name+' name="product_name[]" hidden>';
                   str +=   element.product_name;
                  str += '</td>';
                 str += ' <td class="purch_td system_count">';
                    str +=   '<input type="number" class="edit_deliv form-control form-control-sm" value='+element.system_count+' name="system_count[]" hidden>';
                     str += element.system_count;
                 str += '</td>';
               str +=  '<td class="purch_td physical_count">';
                  str +=   '<input type="number" class="edit_deliv form-control form-control-sm number_only" value='+element.physical_count+' name="physical_count[]">';
                  str += '<span class="err"></span>';
                str += '</td>';
                str +=  '<td class="note">';
                  if(element.note_stocks != null){

                    str +=   '<textarea class="notes_stocks form-control form-control-sm" value='+element.note_stocks+' name="note[]">'+element.note_stocks+'</textarea>';
                  }else{
                    str +=   '<textarea class="notes_stocks form-control form-control-sm" name="note[]"></textarea>';
                  }
                str += '</td>';
               str += '</tr>';
               $('#view_stocks_products tbody').html(str);
         });

   }
  });

  $(document).on('submit','form#generateReport',function(e){
    e.preventDefault();
    let formData = $(this).serialize();
    // formData.append('purchase_id',$("input[name='purchase_id']").attr('data-id'));
    //
    // console.log(formData);
    $.ajax({
        method: 'POST',
        url : base_url + 'stocksmanagement/add_reports',
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
                    // $("select[name='"+value+"']").parents('.form-group').next('.err').text(data.form_error[value]);
                });
            }else if (data.error) {
                Swal.fire("Error",data.error, "error");
            }else {
                blankVal_purchase();
                $('#GenerateReport').modal('hide');
                Swal.fire("Successfully generated a report!",data.success, "success");
                $(".stocks_tbl").DataTable().ajax.reload();
                // setTimeout(function(){
                //    location.reload();
                //  }, 1000);
            }
        }
    })
  });
});


  $(document).on('click', '.stockmovement', function(){
    $('#StockMovement').modal('show');
  })

  //quantity must not exceed to the current qty of the product
  // $(document).on('change','.sm_quantity',function(){
  //   $.ajax({
  //     method: 'POST',
  //     url: base_url + 'stocksmanagement/checkQuantity',
  //     data: formData,
  //   })
  // })

  //successfully added stock movement
  $(document).on('submit','form#stockmovement',function(e){
    e.preventDefault();
    let formData = $(this).serialize();
    // formData.append('purchase_id',$("input[name='purchase_id']").attr('data-id'));
    //
    // console.log(formData);
    $.ajax({
        method: 'POST',
        url : base_url + 'stocksmanagement/addStockMovement',
        data : formData,
        success : function(response) {
            let data = JSON.parse(response);
            console.log(data);
              // $(data.true).each(function(index , value) {
              //   console.log(value);
              // });
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
              }else if (data == true) {
                  Swal.fire("Warning", "Enter quantity less than or equal to current stock","warning");
            }else {
              $.ajax({
                  method: 'POST',
                  url : base_url + 'stocksmanagement/update_qty',
                  data : formData,
                  success : function(response) {
                    blankVal_purchase();
                    $('#StockMovement').modal('hide');
                    Swal.fire("Successfully added stock movement!",data.success, "success");
                    $(".stocks_tbl").DataTable().ajax.reload();
                  }
              });
            }
        }
    })
  });

  //autocomplete product name after choosing sku Code
  $(document).on('change','.stock_prod_code',function(){
    $.ajax({
        url: base_url+'stocksmanagement/get_productName_by_code',
        data: {prod_id:$(this).val()},
        type: 'post',
        dataType: 'json',
        success: function(data){
            console.log(data);
                $.each(data.products,function(index,element){
                      $('.prod_name').val(element.product_name);
                });
                $.each(data.physical_count,function(index,element){
                      $('.remaining_stocks').val(element.physical_count);
                });

        }
    });
  });

  //autocomplete product name after choosing sku Code if add new product
  $(document).on('change','.stock_add_code',function(){
    let that = $(this);
    $.ajax({
        url: base_url+'stocksmanagement/get_productName_by_code',
        data: {prod_id:$(this).val()},
        type: 'post',
        dataType: 'json',
        success: function(data){
                $.each(data.products,function(index,element){
                      $(that).parent().next().find('.add_prod').val(element.product_name);
                });
                $.each(data.physical_count,function(index,element){
                      $(that).parent().next().next().find('.add_stocks_qty').val(element.physical_count);
                });

        }
    });
  });

  //add multiple product in add purchase order
  $(document).on('click', '#addNewSO', function(){
    var x = 1;
    var str = '';

    str += '<tr class="add_purch">';
      str += '<td class="purch_td">';
           str += '<select class="form-control stock_add_code select2_add" style="width: 100%;" name="prod_code[]">';
              str += '<option value="" selected="true" disabled="disabled">Select SKU</option>';
              str += get_productsSO();
           str += '</select>';
           str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
           str += '<input type="text" class="form-control add_prod" name="prod_name[]" value="" readonly>';
           str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
           str += '<input type="text" class="form-control add_stocks_qty" name="remaining_stocks[]" value="" readonly>';
           str += '<span class="err"></span>';
      str += '</td>';
      str += '<td class="purch_td">';
           str += '<input type="text" class="form-control purchase_quantity number_only" name="quantity[]" value="">';
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


});

function get_productsSO(){
  // var id = $('.select2_edit').attr('data-id');
  // alert(id);
  var data_return = '';
  $.ajax({
    url: base_url + 'stocksmanagement/get_productsSO/',
    type:'post',
    dataType:'json',
    async:false,
    success:function(data){
      console.log(data);
      var str = '';
      $.each(data.products,function(index,element){
        str += '<option value="'+element.product+'">'+element.code+'</option>';
      });
      data_return = str;
    }
  });
  return data_return;
}
