var base_url = $('input[name="base_url"]').val();
$(document).ready(function(){

  //show warehouse when type is stock transfer
  $('#so_type').on('change', function(){
      blankVal_onchange_stockType();

    if($(this).val() == "2"){
      $('.to_warehouse').css('display', 'block');
      $('.from_warehouse').css('display', 'block');
      $("#wh_stock_code").prop("disabled", true);
    }else{
    $("#wh_stock_code").prop("disabled", true);
      $('.from_warehouse').css('display', 'block');
      $('.to_warehouse').css('display', 'none');
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


//view list of stocks
$(document).on('click', '.generatereport', function(){
    $('#GenerateReport').modal('show');
     $.ajax({
       method: 'POST',
       url: base_url + 'stocksmanagement/view_reports',
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
                    str +=   '<input type="hidden" class="warehouse_id" name="view_warehouse_id[]" value='+element.warehouse_id+'>';
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
                });
            }else if (data.error) {
                Swal.fire("Error",data.error, "error");
            }else {
                blankVal_purchase();
                $('#GenerateReport').modal('hide');
                Swal.fire("Successfully generated a report!",data.success, "success");
                $(".stocks_tbl").DataTable().ajax.reload();
            }
        }
    })
  });
});

  //show modal for stock movement
  $(document).on('click', '.stockmovement', function(){
    $('#StockMovement').modal('show');
  })

  //successfully added stock movement
  $(document).on('submit','form#stockmovement',function(e){
    e.preventDefault();
    let formData = $(this).serialize();
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
                    blankVal_stock();
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
  $(document).on('select2:select','.stock_prod_code',function(e){
      const self = $(this);
      var data = e.params.data;
      if ($('table.stocks').find('tr[data-selected="'+(data["data-value"])+'"]').length) {
          Swal.fire("Warning", "Item already selected","warning");
          $('#StockMovement .add_prod_stocks:last-child ').remove();
      }
    $(self).parents('tr').attr('data-selected', data["data-value"]);

    $(this).children('[value="'+data['id']+'"]').attr(
        {
         'data-value':data["data-value"], //dynamic value from data array
         'key':'val', // fixed value
        }
    );
    var stock_id = $(this).find(':selected').attr('data-value');

    $.ajax({
        url: base_url+'stocksmanagement/get_productName_by_code',
        data: {prod_id:$(this).val(), stock_id:stock_id},
        type: 'post',
        dataType: 'json',
        success: function(data){
            $.each(data.physical_count,function(index,element){
                $(self).parents('tr').find('.stock_id').val(element.stock_id);
                $(self).parents('tr').find('.prod_name').val(element.product_name);
                $(self).parents('tr').find('.remaining_stocks').val(element.physical_count);
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


  //show products on the specific warehouse chosen
  $('#from_warehouse').on('change', function(){
      // alert($('select[name="wh_prod_code[]"]').find('option').length);
    var from_warehouse_id = $(this).val();
    // get_productsSO(from_warehouse_id);
    $("#wh_stock_code").prop("disabled", false);
    $('#to_warehouse').empty();
    $('#StockMovement .add_prod_stocks ').remove();
    $('#StockMovement .multiple_prod_stock ').val('').trigger('change');
    $('#StockMovement .stock_prod_code ').val('').trigger('change');
    $('#StockMovement input[name="prod_name[]"]').val('');
    $('#StockMovement input[name="remaining_stocks[]"]').val('');
    $('#StockMovement input[name="quantity[]"]').val('');
    $('#StockMovement input[name="total_quantity"]').val('');

    //display all warehouse excluding the chosen from warehouse
    $.ajax({
      url: base_url + 'stocksmanagement/get_warehouse',
      type:'post',
      data: {from_warehouse_id:from_warehouse_id},
      dataType:'json',
      async:false,
      success:function(data){
        // console.log(data);
        $('#to_warehouse').append('<option value="" name="from_warehouse" selected hidden>Select To Warehouse</option>');
        $.each(data.warehouse,function(index,element){
          $('#to_warehouse').append('<option value="'+element.id+'" name="from_warehouse">'+element.wh_name+'</option>');
        });
      }
    });

    //select2 for choose products based on warehouse chosen
    $('select[name="wh_prod_code[]').select2({
        maximumSelectionSize: 1,
        placeholder: "Select SKU",
        ajax: {
            url: base_url+'stocksmanagement/get_products_by_warehouse',
            type: 'post',
            dataType: "json",
            data:{from_warehouse_id:from_warehouse_id},
            processResults: function (data) {
                // console.log(data.wh_product);
                return {
                    results: $.map(data.wh_product, function (item) {
                        return {
                            text: item.code,
                            id: item.product,
                            'data-value': item.stock_id
                        }
                    })
                };
            }
        }
    });
  });


  //add multiple product in add stock movement
    $(document).on('click', '#addNewSO', function(e){
        let proceed = 0;

        $(document).find('.stock_prod_code').each(function(){
            if ($(this).val() == '' || $(this).val() == null) {
                proceed = 1;
            }
        })
        if (proceed) {
            Swal.fire("Warning", "Please select an item first","warning");
            return false;
        }


        var x = 1;
        var str = '';

        str += '<tr class="add_prod_stocks">';
          str += '<td class="purch_td">';
               str += '<select class="form-control stock_prod_code select2_add" style="width: 100%;" name="wh_prod_code['+($('.stock_prod_code').length)+']">';
                  str += '<option value="" selected="true" disabled="disabled">Select SKU</option>';

               str += '</select>';
               str += '<span class="err"></span>';
          str += '</td>';
          str += '<td class="purch_td" style="display:none">';
               str += '<input type="text" class="form-control stock_id" name="stock_id[]" value="" readonly>';
               str += '<span class="err"></span>';
          str += '</td>';
          str += '<td class="purch_td">';
               str += '<input type="text" class="form-control prod_name" name="prod_name[]" value="" readonly>';
               str += '<span class="err"></span>';
          str += '</td>';
          str += '<td class="purch_td">';
               str += '<input type="text" class="form-control remaining_stocks" name="remaining_stocks[]" value="" readonly>';
               str += '<span class="err"></span>';
          str += '</td>';
          str += '<td class="purch_td">';
               str += '<input type="text" class="form-control purchase_quantity sm_quantity  number_only" name="quantity[]" value="">';
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
        get_productsSO();
    });

});


function get_productsSO(){
    // var id = $('.select2_edit').attr('data-id');
    var from_warehouse_id = $('#from_warehouse').val();
    // alert(from_warehouse_id);
    $('.stock_prod_code').each(function(){
        if ($(this).val() == '' || $(this).val() == null) {
            $(this).select2({
                maximumSelectionSize: 1,
                placeholder: "Select SKU",
                ajax: {
                    url: base_url+'stocksmanagement/get_products_by_warehouse',
                    type: 'post',
                    dataType: "json",
                    data:{from_warehouse_id:from_warehouse_id},
                    processResults: function (data) {
                        return {
                            results: $.map(data.wh_product, function (item) {
                                return {
                                    text: item.code,
                                    id: item.product,
                                    'data-value': item.stock_id
                                }
                            })
                        };
                    }
                }
            });
        }
    })

}

//empty fields after changing stock movement type
function blankVal_onchange_stockType(){
    $('#StockMovement select[name="from_warehouse"]').val('');
    $('#StockMovement select[name="to_warehouse"]').val('');
    $('#StockMovement .stock_prod_code ').val('').trigger('change');
    $('.err').text('');
    $('#StockMovement .add_prod_stocks ').remove();
    $('#StockMovement input[name="prod_name[]"]').val('');
    $('#StockMovement input[name="remaining_stocks[]"]').val('');
    $('#StockMovement input[name="quantity[]"]').val('');
    $('#StockMovement input[name="total_quantity"]').val('');
}

//empty fields after submit in stock movement
function blankVal_stock(){
  // $('#StockMovement input[name="sodate"]').val('');
  $('#StockMovement select[name="so_type"]').val('');
  $('#StockMovement select[name="from_warehouse"]').val('');
  $('#StockMovement select[name="to_warehouse"]').val('');
  $('#StockMovement .stock_prod_code ').val('').trigger('change');
  $('.err').text('');
  $('#StockMovement .from_warehouse ').remove();
  $('#StockMovement .to_warehouse ').remove();
  $('#StockMovement .add_prod_stocks ').remove();
  $('#StockMovement input[name="prod_name[]"]').val('');
  $('#StockMovement input[name="remaining_stocks[]"]').val('');
  $('#StockMovement input[name="quantity[]"]').val('');
  $('#StockMovement input[name="total_quantity"]').val('');
  $('#StockMovement textarea[name="stockmovement_note"]').val('');
}
