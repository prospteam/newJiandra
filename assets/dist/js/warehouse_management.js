var base_url = $('input[name="base_url"]').val();
$(document).ready(function(){
  display_whmanagement();
  // add supplier
  $(document).on('submit','#addwarehouse1_management',function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
          url:base_url+'warehouse_management/addwh_management/',
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
                 blankVal();
                  $('#addwarehouse1_management').modal('hide');
                  Swal.fire("Warehouse ---- has been added!", data.success, "success");
                  display_whmanagement();
                  // $(".suppliers_tbl").DataTable().ajax.reload();
              }
          }
      });
  });
  //end add warehouse

  //Edit Warehouse
  $(document).on("click",".editWarehouse", function(){
    var id = $(this).attr('data-id');

    $.ajax({
        method: 'POST',
        url: base_url+'warehouse_management/editWarehouseManagement',
        data: {id:id},
        dataType: "json",
        success: function(data){
          $('#Editwarehouse').modal('show');
          $('#Editwarehouse input[name="editwarehouse_id"]').val(data.warehouse_management.id);
          $('#Editwarehouse select[name="wh_name"]').val(data.warehouse_management.wh_name);
          $('#Editwarehouse input[name="wh_type"]').val(data.warehouse_management.wh_type);
          $('#Editwarehouse input[name="wh_assigned"]').val(data.warehouse_management.wh_assigned);
          }
    });

  });
  // end Edit Warehouse

  // successfully edit suplier
    $(document).on('submit','#editWarehouseM',function(e){
      e.preventDefault();

      let formData = new FormData($(this)[0]);
      var id = $('.editwarehouse_id').val();
      formData.append("id",id);
      $.ajax({
          method: 'POST',
          url: base_url+'warehouse_management/edit_warehouse',
          data: formData,
          processData: false,
          contentType:false,
          cache: false,
          dataType: 'json',
          success: function(data){
              if (data.status == "ok"){
                $('#Editwarehouse').modal('hide');
                Swal.fire("Warehouse ---- has been updated!", data.success, "success");
                $(".warehouse_tbl").DataTable().ajax.reload();
            }else if(data.status == 'invalid'){
                 Swal.fire("Error",data.status, "invalid");
              }
          }
      })
    });
  // end successfully edit suplier
  // DISABLED warehouse
    $(document).on("click",".enableWarehouse",function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        console.log(id);

        Swal.fire({
        title: 'Are you sure?',
        text: "You want to enable this Warehouse!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#068101',
        confirmButtonText: 'Yes, Enable Warehouse!'
        }).then((result) => {
          if (result.value) {
            Swal.fire(
              'Enabled!',
              'Successfully Enabled Warehouse!',
              'success'
            )
              $.ajax({
              type: 'POST',
                url:base_url + 'warehouse_management/enable_warehouse',
                data: {id: id},
                success:function(data) {
                  $(".warehouse_tbl").DataTable().ajax.reload();
                }
              })
          }
        });
    });
  // DISABLED warehouse

  // DISABLED warehouse
    $(document).on("click",".disableWarehouse",function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        console.log(id);

        Swal.fire({
        title: 'Are you sure?',
        text: "You want to disable this Warehouse!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#068101',
        confirmButtonText: 'Yes, Disable Warehouse!'
        }).then((result) => {
          if (result.value) {
            Swal.fire(
              'Disabled!',
              'Successfully Disabled Warehouse!',
              'success'
            )
              $.ajax({
              type: 'POST',
                url:base_url + 'warehouse_management/disable_warehouse',
                data: {id: id},
                success:function(data) {
                  $(".warehouse_tbl").DataTable().ajax.reload();
                }
              })
          }
        });
    });
  // DISABLED warehouse

  // DISABLED warehouse
    $(document).on("click",".deleteWarehouse",function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        console.log(id);

        Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this Warehouse!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#068101',
        confirmButtonText: 'Yes, Delete Warehouse!'
        }).then((result) => {
          if (result.value) {
            Swal.fire(
              'Deleted!',
              'Successfully Delete Warehouse!',
              'success'
            )
              $.ajax({
              type: 'POST',
                url:base_url + 'warehouse_management/delete_warehouse',
                data: {id: id},
                success:function(data) {
                  $(".warehouse_tbl").DataTable().ajax.reload();
                }
              })
          }
        });
    });
  // DISABLED warehouse

  //display Companies for add warehouse
   $('.js-example-basic-multiple-wh_assigned').select2({
     allowClear: true,
     placeholder: "Select Company",
     dropdownParent: $('#Addwarehouse_management'),
     tags: true,
     ajax: {
       url: base_url+'warehouse_management/add_warehouse_users',
       dataType: "json",
       data: function (params) {

      },processResults: function (data) {

            return {
                results: $.map(data.warehouse_users, function (item) {
                    return {
                        text: item.company_name,
                        id: item.company_id
                    }
                })
            };
        }
     }
   });

   $(document).on('change','select[name="company"]', function(){
     $.ajax({
       url: base_url+'warehouse_management/get_warehouse_by_companies',
       data: {company_id:$(this).val()},
       type:'post',
       dataType:"json",
       success: function(data){
         var str = '';
         str += '<label for="wh_assigned">WH Assigned: <span class="required">*</span></label>';
         str += '<select class="form-control" id="wh_assigned" name="wh_assigned" >';

               $.each(data.users,function(index,element){
                     str += '<option value="'+element.id+'">'+element.fullname+'</option>';
               });
         str += '</select>';
         str += '<span class="err"></span>';

           $('#wh_assigned_show').html(str);

       }
     });
   });

   $(document).on('change','select[name="wh_type"]', function(){
      // alert($(this).val());
      var str = '';
         str += '<div class="form-group">';
      if ($(this).val() == 1) {
         str += '<input type="text" name="wh_address" class="form-control" id="wh_address" placeholder="Enter Address">';
      }else {
         str += '<input type="text" name="wh_plate_number" class="form-control" id="wh_plate_number" placeholder="Enter Plate Number">';
      }
      str += '</div>';
      $('.input_add').html(str);

   });

  function display_whmanagement($warehouse_id){
    $('.warehouse_tbl').DataTable({
          "destroy"   : true,
          "processing": true, //Feature control the processing indicator.
          "serverSide": true, //Feature control DataTables' server-side processing mode.
          "order": [[0,'desc']], //Initial no order.
          "columns":[
               {"data":"wh_name"},
               {"data":"wh_type","render": function(data, type, row,meta){
                  return (row.wh_type == 1 )? "Ex Truck" : "Warehouse";
               }},
               {"data":"fullname"},
               {"data":"action","render": function(data, type, row,meta){
                         var str = '';
                         str += '<div class="actions">';
                         if(row.status == 1){
                           str += '<a href="javascript:;" class="viewWarehouse" data-id="'+row.id+'"><i class="fas fa-eye text-info"></i></i></a>';
                           str += '<a href="javascript:;" class="editWarehouse" data-id="'+row.id+'"><i class="fas fa-pen text-warning"></i></a>';
                           str += '<a href="javascript:;" class="disableWarehouse" data-id="'+row.id+'"><i class="fa fa-window-close"></i></a>';
                           str += '<a href="javascript:;" class="deleteWarehouse" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';
                         }else if(row.status == 2){
                           str += '<a href="javascript:;" class="enableWarehouse" data-id="'+row.id+'"><i class="fa fa-check-square"></i></a>';
                           str += '<a href="javascript:;" class="deleteWarehouse" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';
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
               "url" : base_url+"warehouse_management/display_wh_management/"+$warehouse_id,
               "type": "POST"
          },
          //Set column definition initialisation properties.
          "columnDefs": [
               {
                    "targets": [3,4], //first column / numbering column
                    "orderable": false, //set not orderable
                },
           ],
       });
  }

});
