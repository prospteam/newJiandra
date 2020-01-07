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
  // edit Products
  $(document).on("click",".editWarehouse", function(){
    var id = $(this).attr('data-id');

    $.ajax({
        method: 'POST',
        url: base_url+'warehouse_management/editWarehouseManagement',
        data: {id:id},
        dataType: "json",
        success: function(data){
          $('#Editwarehouse').modal('show');
          $('#Editwarehouse input[name="warehouse_id"]').val(data.warehouse_management.id);
          $('#Editwarehouse input[name="wh_name"]').val(data.warehouse_management.wh_name);
          $('#Editwarehouse input[name="wh_type"]').val(data.warehouse_management.wh_type);
          $('#Editwarehouse input[name="wh_assigned"]').val(data.warehouse_management.wh_assigned);
          }
    });

  });
  // end Edit Warehouse


  function display_whmanagement($warehouse_id){
    $('.warehouse_tbl').DataTable({
          "destroy"   : true,
          "processing": true, //Feature control the processing indicator.
          "serverSide": true, //Feature control DataTables' server-side processing mode.
          "order": [[0,'desc']], //Initial no order.
          "columns":[
               {"data":"wh_name"},
               {"data":"wh_type"},
               {"data":"wh_assigned"},
               {"data":"action","render": function(data, type, row,meta){
                         var str = '';
                         str += '<div class="actions">';
                         if(row.status == 1){
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
