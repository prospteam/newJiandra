var base_url = $('input[name="base_url"]').val();
$(document).ready(function(){

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


  $(document).on('click', '.stockout', function(){
    $('#StockOut').modal('show');
  })

});
