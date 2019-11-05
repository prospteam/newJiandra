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

  //display companies
   $('.js-example-basic-multiple').select2({
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

   //successfully added user
   $(document).on('submit','form#adduser',function(e){
     e.preventDefault();
     let formData = $(this).serialize();

     $.ajax({
         method: 'POST',
         url : base_url + 'users/adduser',
         data : formData,
         success : function(response) {
             let data = JSON.parse(response);
             console.log(data);
             if(data.form_error){
                 clearError();
                 let keyNames = Object.keys(data.form_error);
                 $(keyNames).each(function(index , value) {
                     $("input[name='"+value+"']").next('.err').text(data.form_error[value]);
                 });
             }else if (data.error) {
                 Swal.fire("Error",data.error, "error");
             }else {
                blankVal();
                 $('#AddUser').modal('hide');
                 Swal.fire("Successfully added user!",data.success, "success");
                 setTimeout(function(){
                    location.reload();
                  }, 1000);
             }
         }
     })
   });

});

function show_loader(){
    $('.loader-cont').show();
}

function hide_loader(){
    $('.loader-cont').hide();
}

function clearError(){
    $('.err').text('');
}

function blankVal(){
  $('#AddUser input[name="fullname"]').val('');
  $('.err').text('');
  $('#AddUser input[name="username"]').val('');
  $('#AddUser input[name="password"]').val('');
  $('#AddUser input[name="position"]').val('');
  $('#AddUser select[name="company"]').val('');
}
