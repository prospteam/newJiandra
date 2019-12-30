var base_url = $('input[name="base_url"]').val();
$(document).ready(function(){

  //display purchase_tbl
    var purchase_tbl = $('.stocks_tbl').DataTable({
         "processing": true, //Feature control the processing indicator.
         "serverSide": true, //Feature control DataTables' server-side processing mode.
         "order": [[0,'desc']], //Initial no order.
         "columns":[
              {"data":"code"},
              {"data":"product_name"},
              {"data":"system_count"},

              // {"data":"type"},
              {"data":"physical_count","render": function(data, type, row,meta){
                        var str = '';
                        // str += '<div class="actions">';
                        // if(row.status == 1 && row.delivery_status != 4){
                         str += '<div>';
                        str += '<span class="physical_count">0</span>';
                        str +=  '<input type="number" class="add_physcount" name="physical_count[]" value="0" disabled hidden>';
                        str += '<span class="physcount">';
                          str += '<a href="javascript:;" class="btn btn-xs btn-primary add_physicalcount"><i class="fa fa-edit"></i></a>';
                          str += '<a href="javascript:;" class="btn btn-xs btn-success submit_physicalcount" hidden><input name="code" value='+row.code+' hidden><input name="product_name" value='+row.product_name+' hidden><input name="system_count" value='+row.system_count+' hidden><i class="fa fa-check"></i></a>';
                        str += '</span>';
                        str += '</div>';
                        return str;
                   }
              },

              {"data":"variance","render": function(data, type, row,meta){
                  // var str = '';
                  //  if(row.status == 1){
                  //    str += '<a href="javascript:;" class="btn btn-block btn-sm btn-primary status" data-status="'+row.delivery_status+'" data-id="'+row.purchase_code+'">pending</a>';
                  //  }else if(row.status == 2){
                  //    if(row.delivery_status == 4){
                  //      str += '<a href="javascript:;" class="inactive btn btn-block btn-sm btn-success" data-status="'+row.delivery_status+'" data-id="'+row.purchase_code+'" disabled>approved</a>';
                  //    }else{
                  //      str += '<a href="javascript:;" class="inactive btn btn-block btn-sm btn-success status" data-status="'+row.delivery_status+'" data-id="'+row.purchase_code+'">approved</a>';
                  //    }
                  //  }else if(row.status == 3){
                  //    str += '<a href="javascript:;" class="active btn btn-block btn-sm btn-danger status" data-status="'+row.delivery_status+'" data-id="'+row.purchase_code+'">cancelled</a>';
                  //  }
                  //  return str;
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

  //show edit delivered input on view purchase order
  $(document).on('click','.add_physicalcount', function(){
    var pTr = $(this).parents('tr');

    pTr.find('.add_physcount').show().prop('disabled', false).prop('hidden', false);
    pTr.find('.physical_count').hide();

    pTr.find('.submit_physicalcount').show().prop('hidden', false);
    pTr.find('.add_physicalcount').hide().prop('hidden', true);


    $('.submit_physicalcount').unbind('click').click(function(e) {
      var code = $('input[name="code"]').val();
      var product_name = $('input[name="product_name"]').val();
      var system_count = $('input[name="system_count"]').val();
      var physical_count = $('input[name="physical_count[]"]').val();

      $.ajax({
        url: base_url+'stocksmanagement/add_physicalcount',
        data: {code:code,product_name:product_name,system_count:system_count,physical_count:physical_count},
        type: 'post',
        dataType: 'json',
        success: function(data){
            pTr.find('.physical_count').text(qty).show();
            pTr.find('.add_physcount').hide().prop('hidden', true);
            pTr.find('.add_physicalcount').show().prop('hidden', false);
            pTr.find('.submit_physicalcount').hide().prop('hidden', true);
        }
      });
    });

  });

});
