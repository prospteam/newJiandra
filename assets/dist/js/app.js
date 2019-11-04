var base_url = $('input[name="base_url"]').val();
$(document).ready(function(){

  //display_users
    var users_tbl = $('.users_tbl').DataTable({
         "processing": true, //Feature control the processing indicator.
         "serverSide": true, //Feature control DataTables' server-side processing mode.
         "order": [[0,'desc']], //Initial no order.
         "columns":[
              {"data":"fullname"},
              {"data":"company"},
              {"data":"position"},
              // {"data":"type"},
              {"data":"action","render": function(data, type, row,meta){
                        var str = '';
                        str += '<i class="fas fa-clone"></i>';
                        str += '<i class="fas fa-pen"></i>';
                        str += '<i class="fa fa-trash" aria-hidden="true">';

                        return str;
                   }
              },

              {"data":"status","render": function(data, type, row,meta){
                  var str = '';
                   if(row.status == 1){
                     str += '<button type="button" class="active btn btn-block btn-success">active</button>';
                   }else{
                     str += '<button type="button" class="inactive btn btn-block btn-success">inactive</button>';
                   }
                   return str;
              }
            }

         ],
         // Load data for the table's content from an Ajax source
         "ajax": {
              "url":base_url+"users/display_users/",
              "type": "POST"
         },
         //Set column definition initialisation properties.
         "columnDefs": [
              {
                   "targets": [1], //first column / numbering column
                   "orderable": true, //set not orderable

               },
          ],
      });
  //end display users_tbl
   $('.js-example-basic-multiple').select2({

     width: '80%',
     theme: "classic",
     allowClear: true,
     placeholder: "Select Company",
     dropdownParent: $('#AddUser'),
     tags: true,
     ajax: {
       url: base_url+'users/companies',
       dataType: "json",
       data: function (params) {

      },processResults: function (data) {

            return {
                results: $.map(data.companies, function (item) {
                    return {
                        text: item.company_name,
                        id: item.company_id
                    }
                })
            };
        }
     }
   });

});
