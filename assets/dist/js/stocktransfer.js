
var base_url = $('input[name="base_url"]').val();
$(document).ready(function(){

    //end select SKU
    function disp_stocktransfer(){
      $('.badorder_tbl').DataTable({
          "responsive": true,
            "destroy"   : true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [[0,'desc']], //Initial no order.
            "columns":[
                 {"data":"date_purchased"},
                 {"data":"date_returned"},
                 {"data":"product_name"},
                 {"data":"reason"},
                 {"data":"action","render": function(data, type, row,meta){
                           var str = '';
                           str += '<div class="actions">';
                           if(row.status == 1){
                             str += '<a href="javascript:;" class="viewWarehouse" data-id="''"><abbr title="View Warehouse"><i class="fas fa-eye text-info"></i></abbr></a>';
                           }else if(row.status == 2){
                               str += '<a href="javascript:;" class="viewWarehouse" data-id="''"><abbr title="View Warehouse"><i class="fas fa-eye text-info"></i></abbr></a>';
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
                        str += '<span class="active btn btn-block btn-sm btn-danger">inactive</button>';
                      }
                      return str;
                 }
               }
            ],
            // Load data for the table's content from an Ajax source
            "ajax": {
                 "url" : base_url+"stocktransfer/disp_stocktransfer/",
                 "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                 {
                      "targets": [4,5], //first column / numbering column
                      "orderable": false, //set not orderable
                  },
             ],
         });
    }



$(document).on('change','select[name="company"]',function(e){
    e.preventDefault();
    // alert('tttt3456');
    $.ajax({
            url: base_url+'stocktransfer/get_suppliers_by_companies_bo',
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
                        str1 += '<label for="warehouse">From Warehouse: <span class="required">*</span></label>';
                        str1 += '<select class="form-control" class="warehouse" name="warehouse" >';
                            str1 += '<option value="" selected hidden>Select Warehouse</option>';
                              $.each(data.warehouse,function(index,element){
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
            $.ajax({
                url: base_url+'purchaseorders/getProductBySupplier',
                data: {supplier:sup},
                type: 'post',
                dataType: 'json',
                success: function(data){
                    console.log(data.products);
                    var str = "";
                    var str1 = "";
                    if (data.products.length === 0) {
                        str += "No product available"
                    }else{
                            str1 += '<label for="product_name">Products: <span class="required">*</span></label>';
                                str1 += '<select class="form-control" class="product_name" name="product_name" >';
                                    str1 += '<option value="" selected hidden>Select Warehouse</option>';
                                        $.each(data.products,function(index,element){
                                            str1 += '<option value="'+element.product_name+'">'+element.product_name +'</option>';

                                        });
                                str1 += '</select>';
                            str += '<span class="err"></span>';
                            $('#show_products').html(str1);
                    }


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

    $(document).on('submit','#addbo',function(e){
        alert('hiii');
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url:base_url+'stocktransfer/addbadorder/',
            data: formData,
            processData:false,
            contentType: false,
            type: 'post',
            dataType: 'json',
            success : function(data) {
              console.log(data);
                if(data.form_error){
                    clearError();
                    let keyNames = Object.keys(data.form_error);
                    $(keyNames).each(function(index , value) {
                      console.log(value);
                        $("input[name='"+value+"']").next('.err').text(data.form_error[value]);
                        $("select[name='"+value+"']").next().next().text(data.form_error[value]);
                    });
                }else if (data.error) {
                    Swal.fire("Error",data.error, "error");
                }else {
                   // blankVal();
                    $('#Addbo').modal('hide');
                    Swal.fire("Successfully Added Bad Order!", data.success, "success");
                    // display_whmanagement();
                    $(".badorder_tbl").DataTable().ajax.reload();
                }
            }
        });
    });
});
