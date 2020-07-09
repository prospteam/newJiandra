
var base_url = $('input[name="base_url"]').val();
$(document).ready(function(){

     //end select SKU
   var stocksmov_tbl = $('.stocksmov_tbl').DataTable({
  "responsive": true,
  "processing"  : true,
  "serverside"  : true,
  "order"       : [[0,'desc']],
  "columns"     :[
         {"data":"stockmovement_date"},
         {"data":"wh_name"},
         {"data":"date_delivered"},
         {"data":"stockmovement_code"},
         // {"data":"quantity"},
         {"data":"stockmovement_note","render": function(data, type, row,meta, element){
              var str = '';
              if(row.stockmovement_note == '') {
                str += 'None';
              }else{
                str += row.stockmovement_note;
              }
              return str;
            }
          },
         {"data":"action","render": function(data, type, row,meta, element){
                           var str = '';
                           str += '<div class="actions">';
                           if(row.status == 1) {
                            str += '<a href="javascript:;" class="viewstocktransfer" data-id="'+row.stockmovement_id+'"><abbr title="View Stock Transfer"><i class="fas fa-eye text-info"></i></abbr></a>';
                             str += '<a href="javascript:;" class="editstocktransfer" data-id="'+row.stockmovement_id+'"><abbr title="Edit Stock Transfer"><i class="fas fa-pen text-warning"></i></abbr></a>';
                             str += '<a href="javascript:;" class="deletestockTransfer" data-id="'+row.stockmovement_id+'"><abbr title="Delete Stock Transfer"><i class="fa fa-trash" aria-hidden="true"></abbr></a>';
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
                      str += '<span class="inactive btn btn-block btn-sm btn-danger">inactive</button>';
                    }
                    return str;
               }
             }
         ],

         "ajax": {
             "url":base_url+"stocktransfer/disp_stocktransfer/",
             "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
             {
                  "targets": [4,5,6], //first column / numbering column
                  "orderable": false, //set not orderable

              },
         ],
     });


});

$(document).on('change','select[name="company_bo"]',function(){
    alert('tttt3456');
  // $.ajax({
  //     url: base_url+'stocktransfer/get_suppliers_by_companies_bo',
  //     data: {company_id:$(this).val()},
  //     type: 'post',
  //     dataType: 'json',
  //     success: function(data){
  //       console.log(data);
  //       var str = '';
  //       str += '<label for="supplier">Supplier: <span class="required">*</span></label>';
  //       str += '<select class="form-control" class="supplier" name="supplier" >';
  //           str += '<option value="" selected hidden>Select Supplier</option>';
  //             $.each(data.suppliers,function(index,element){
  //                   str += '<option value="'+element.supplier_name+'">'+element.supplier_name+'</option>';
  //             });
  //       str += '</select>';
  //       str += '<span class="err"></span>';
  //       $('#show_supplier').html(str);
  //         var str1 = '';
  //         str1 += '<label for="warehouse">Warehouse: <span class="required">*</span></label>';
  //         str1 += '<select class="form-control" class="warehouse" name="warehouse" >';
  //             str1 += '<option value="" selected hidden>Select Warehouse</option>';
  //               $.each(data.warehouse,function(index,element){
  //                     str1 += '<option value="'+element.id+'|'+element.wh_name+'">'+element.wh_name+'</option>';
  //               });
  //         str1 += '</select>';
  //         str1 += '<span class="err"></span>';
  //
  //         $('#show_warehouse').html(str1);
  //     }
  // });
});
