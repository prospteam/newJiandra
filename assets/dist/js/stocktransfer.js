
var base_url = $('input[name="base_url"]').val();
$(document).ready(function(){


    $(document).on('change','.bo_company',function(e){
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
                  str += '<select class="form-control bo_supplier" class="supplier" name="bo_supplier">';
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
                                        str1 += '<option value="'+element.wh_name+'">'+element.wh_name+'</option>';
                                  });
                            str1 += '</select>';
                            str1 += '<span class="err"></span>';

                            $('#show_warehouse').html(str1);
                        }
                    });
                });


      $(document).on('change','.bo_supplier',function(){
           var sup = $('select[name="bo_supplier"]').val();
            var opt = '';
            $.ajax({
                url: base_url+'Stocktransfer/getBOProducts',
                data: {supplier:sup},
                type: 'post',
                dataType: 'json',
                success: function(data){
                    console.log('data');
                    console.log(data);
                    var str = "";
                    var str1 = "";
                    if (data.products.length === 0) {
                        //str += "No product available";
                        Swal.fire("No product available",data.error, "error");
                    }else{
                            str1 += '<label for="product_name">Products: <span class="required">*</span></label>';
                                str1 += '<select class="form-control" class="product_name" name="product_name" >';
                                    str1 += '<option value="" selected hidden>Select Products</option>';
                                        $.each(data.products,function(index,element){
                                            str1 += '<option value="'+element.product_name+'">'+element.product_name +'</option>';
                                        });
                                str1 += '</select>';
                            str1 += '<span class="err"></span>';
                    }
                    console.log('show product');
                    console.log(str1);
                    $('#show_products').html(str1);
                }
            });
      })
        // $(document).on('change','.bo_supplier',function(){
        //     var sup = $('select[name="bo_supplier"]').val();
        //     var opt = '';
        //     $.ajax({
        //         url: base_url+'Stocktransfer/getBOProducts',
        //         data: {supplier:sup},
        //         type: 'post',
        //         dataType: 'json',
        //         success: function(data){
        //             console.log('data');
        //             console.log(data);
        //             var str = "";
        //             var str1 = "";
        //             if (data.products.length === 0) {
        //                 str += "No product available"
        //             }else{
        //                     str1 += '<label for="product_name">Products: <span class="required">*</span></label>';
        //                         str1 += '<select class="form-control" class="product_name" name="product_name" >';
        //                             str1 += '<option value="" selected hidden>Select Warehouse</option>';
        //                                 $.each(data.products,function(index,element){
        //                                     str1 += '<option value="'+element.product_name+'">'+element.product_name +'</option>';

        //                                 });
        //                         str1 += '</select>';
        //                     str1 += '<span class="err"></span>';
        //             }
        //             console.log('show product');
        //             console.log(str1);
        //             $('#show_products').html(str1);
        //         }
        //     });
        // });

        $(document).on("click", ".viewbo", function () {
           var id = $(this).attr('data-id');
           $.ajax({
              method: 'POST',
              url: base_url + 'stocktransfer/view_all_bo',
              data: { id: id },
              dataType: "json",
              success: function (data) {
                 console.log(data);
                 $('#viewbo').modal('show');
                 $('.date_purchased').text(data.badorder.date_purchased);
                 $('.date_returned').text(data.badorder.date_returned);
                 $('.quantity').text(data.badorder.date_purchased);
                 $('.sellprice').text(data.badorder.sellprice);
                 $('.company').text(data.badorder.company);
                 $('.supplier').text(data.badorder.supplier);
                 $('.warehouse').text(data.badorder.warehouse);
                 $('.product_name').text(data.badorder.product_name);
                 $('.reason').text(data.badorder.reason);
              }
           })
        });

        $(document).on('change','select[name="company_edit"]',function(){
          $.ajax({
              url: base_url+'stocktransfer/get_suppliers_by_companies_bo',
              data: {company_id:$(this).val()},
              type: 'post',
              dataType: 'json',
              success: function(data){

                var str = '';
                str += '<label for="supplier">Supplier: <span class="required">*</span></label>';
                str += '<select class="form-control supplier_edit" class="supplier" name="supplier_edit" value="" >';
                      $.each(data.suppliers,function(index,element){
                            str += '<option value="'+element.supplier_name+'">'+element.supplier_name+'</option>';
                      });
                str += '</select>';
                str += '<span class="err"></span>';

                //   $('#edit_show_supplier').html(str);

                  var str1 = '';
                  str1 += '<label for="warehouse">Warehouse: <span class="required">*</span></label>';
                  str1 += '<select class="form-control" class="warehouse" name="warehouse_edit" value="" >';
                        $.each(data.warehouse,function(index,element){
                              str1 += '<option value="'+element.wh_name+'">'+element.wh_name+'</option>';
                        });
                  str1 += '</select>';
                  str1 += '<span class="err"></span>';

                //   $('#edit_show_warehouse').html(str1);

              }
          });
        });

        $(document).on('change','.supplier_edit', function(){
            alert('test');
        })

        // $(document).on('change','select[name="supplier_edit"]',function(){
        //     var sup = $('select[name="supplier_edit"]').val();
        //     alert(sup);
        //     var opt = '';
        //     $.ajax({
        //         url: base_url+'stocktransfer/getBOProducts',
        //         data: {supplier:sup},
        //         type: 'post',
        //         dataType: 'json',
        //         success: function(data){
        //             console.log(data.products);
        //             var str = "";
        //             var str1 = "";
        //             if (data.products.length === 0) {
        //                 str += "No product available"
        //             }else{
        //                     str1 += '<label for="product_name">Products: <span class="required">*</span></label>';
        //                         str1 += '<select class="form-control" class="product_name" name="product_name" >';
        //                             str1 += '<option value="" selected hidden>Select Warehouse</option>';
        //                                 $.each(data.products,function(index,element){
        //                                     str1 += '<option value="'+element.product_name+'">'+element.product_name +'</option>';
        
        //                                 });
        //                         str1 += '</select>';
        //                     str += '<span class="err"></span>';
        //                     $('#edit_show_products').html(str1);
        //             }
        //         }
        //     });
        // });



        $(document).on("click",".editbo", function(){
          var id = $(this).attr('data-id');
          $.ajax({
              method: 'POST',
              url: base_url+'stocktransfer/editview_all_bo',
              data: {id:id},
              dataType: "json",
              success: function(data){
                console.log('data');
                 console.log(data.badorder[0]);
                $('#Editbo').modal('show');
                    $('#Editbo input[name="edit_bo_id"]').val(data.badorder[0].id)
                    $('#Editbo input[name="date_purchased"]').val(data.badorder[0].date_purchased)
                    $('#Editbo input[name="date_returned"]').val(data.badorder[0].date_returned)
                    $('#Editbo input[name="quantity"]').val(data.badorder[0].quantity)
                    $('#Editbo input[name="sellprice"]').val(data.badorder[0].sellprice)
                    $('#Editbo textarea[name="reason"]').val(data.badorder[0].reason)

                    $('#Editbo select[name=company_edit]').val(data.company);
                    $('#Editbo select[name="company_edit"]').trigger('change');

                    setTimeout(function(){
                      $('#Editbo select[name="supplier_edit"]').val(data.supplier);
                      $('#Editbo select[name="warehouse_edit"]').val(data.warehouse);
                      $('#Editbo select[name="warehouse_edit"]').val(data.warehouse);
                    }, 0100);
                    //
                    // $('#Editbo select[name="product_name"]').val(data.badorder.product_name)
                    // $('#Editbo textarea[name="reason"]').val(data.badorder.reason)
                }
          });

        });
        $(document).on("submit","#editbo", function(e){
            e.preventDefault();
            var id = $('input[name="edit_bo_id"]').val();
            var formData = $(this).serialize();
            console.log('datata');
            console.log(formData);
            $.ajax({
                method: 'POST',
                url: base_url+'stocktransfer/update_bo',
                data: formData,
                dataType: "json",
                success: function(data){
                }
            })
        });
        $(document).on("click", ".enablebo", function (e) {
           e.preventDefault();
           var id = $(this).attr('data-id');
           console.log(id);

           Swal.fire({
              title: 'Are you sure?',
              text: "You want to enable this BO!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#068101',
              confirmButtonText: 'Yes, Enable BO!'
           }).then((result) => {
              if (result.value) {
                 Swal.fire(
                    'Disabled!',
                    'Successfully Enable BO!',
                    'success'
                 )
                 $.ajax({
                    type: 'POST',
                    url: base_url + 'stocktransfer/enable_bo',
                    data: { id: id },
                    success: function (data) {
                       $(".badorder_tbl").DataTable().ajax.reload();
                    }
                 })
              }
           });
        });

        $(document).on("click", ".disablebo", function (e) {
           e.preventDefault();
           var id = $(this).attr('data-id');
           console.log(id);

           Swal.fire({
              title: 'Are you sure?',
              text: "You want to disable this BO!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#068101',
              confirmButtonText: 'Yes, Disable BO!'
           }).then((result) => {
              if (result.value) {
                 Swal.fire(
                    'Disabled!',
                    'Successfully Disabled BO!',
                    'success'
                 )
                 $.ajax({
                    type: 'POST',
                    url: base_url + 'stocktransfer/disable_bo',
                    data: { id: id },
                    success: function (data) {
                       $(".badorder_tbl").DataTable().ajax.reload();
                    }
                 })
              }
           });
        });

        $(document).on("click", '.deletebo', function (e) {
           e.preventDefault();
           var id = $(this).attr('data-id');
           console.log(id);

           Swal.fire({
              title: 'Are you sure?',
              text: "You want to permanently delete this BO!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#068101',
              confirmButtonText: 'Yes, Permanently Delete BO!',
           }).then((result) => {
              if (result.value) {
                 Swal.fire(
                    'Deleted!',
                    'Successfully Deleted BO!',
                    'success'
                 )
                 $.ajax({
                    type: 'POST',
                    url: base_url + 'stocktransfer/delete_bo',
                    data: { id: id },
                    success: function (data) {
                       $(".badorder_tbl").DataTable().ajax.reload();
                    }
                 })
              }
           });

        });


    $(document).on('submit','#addbo',function(e){
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


var badorder_tbl = $('.badorder_tbl').DataTable({
    "responsive": true,
   "processing": true,
   "serverside": true,
   "order": [[0, 'desc']],
   "columns": [
      { "data": "date_purchased" },
      { "data": "date_returned" },
      { "data": "product_name" },
      { "data": "reason" },
      { "data": "supplier" },
      {
         "data": "action", "render": function (data, type, row, meta) {
            var str = '';
            str += '<div class="actions">';
            if (row.status == 1) {
               str += '<a href="javascript:;" class="viewbo" data-id="' + row.id + '"><abbr title="View Bad Order"><i class="fas fa-eye text-info"></i></abbr></a>';
               str += '<a href="javascript:;" class="editbo" data-id="' + row.id + '"><abbr title="Edit Bad Order"><i class="fas fa-pen text-warning"></i></abbr></a>';
               str += '<a href="javascript:;" class="disablebo" data-id="' + row.id + '"><abbr title="Disable Bad Order"><i class="fa fa-window-close"></i></abbr></a>';
               str += '<a href="javascript:;" class="deletebo" data-id="' + row.id + '"><abbr title="Delete Bad Order"><i class="fa fa-trash" aria-hidden="true"></abbr></a>';
            } else if (row.status == 2) {
               str += '<a href="javascript:;" class="viewbo" data-id="' + row.id + '"><abbr title="View Bad Order"><i class="fas fa-eye text-info"></i></abbr></a>';
               str += '<a href="javascript:;" class="enablebo" data-id="' + row.id + '"><abbr title="Enable Bad Order"><i class="fa fa-check-square"></i></abbr></a>';
               str += '<a href="javascript:;" class="deletebo" data-id="' + row.id + '"><abbr title="Delete Bad Order"><i class="fa fa-trash" aria-hidden="true"></abbr></a>';
            }
            str += '</div>';
            return str;
         }
      },

      {
         "data": "status", "render": function (data, type, row, meta) {
            var str = '';
            if (row.status == 1) {
               str += '<span class="active btn btn-block btn-sm btn-success">active</button>';
            } else if (row.status == 2) {
               str += '<span class="inactive btn btn-block btn-sm btn-danger">inactive</button>';
            }
            return str;
         }
      }

   ],

   "ajax": {
      "url": base_url + "stocktransfer/display_badorder/",
      "type": "POST"
   },
   //Set column definition initialisation properties.
   "columnDefs": [
      {
         "targets": [5, 6], //first column / numbering column
         "orderable": false, //set not orderable

      },
   ],
});
