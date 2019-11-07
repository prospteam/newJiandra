var base_url = $('input[name="base_url"]').val();
$(document).ready(function(){

  //display_users
    var users_tbl = $('.users_tbl').DataTable({
         "processing": true, //Feature control the processing indicator.
         "serverSide": true, //Feature control DataTables' server-side processing mode.
         "order": [[0,'desc']], //Initial no order.
         "columns":[
              {"data":"fullname"},
              {"data":"company_name"},
              {"data":"position_name"},
              // {"data":"type"},
              {"data":"action","render": function(data, type, row,meta){
                        var str = '';
                        str += '<a href="javascript:;" class="viewUser" data-id="'+row.id+'"> <i class="fas fa-clone"></i></a>';
                        str += '<a href="javascript:;" class="editUser" data-id="'+row.id+'"><i class="fas fa-pen"></i></a>';
                        str += '<a href="javascript:;" class="deleteUser" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';

                        return str;
                   }
              },

              {"data":"status","render": function(data, type, row,meta){
                  var str = '';
                   if(row.status == 1){
                     str += '<button type="button" class="active btn btn-block btn-success">active</button>';
                   }else{
                     str += '<button type="button" class="inactive btn btn-block btn-danger">inactive</button>';
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
                   "targets": [3,4], //first column / numbering column
                   "orderable": false, //set not orderable

               },
          ],
      });
  //end display users_tbl

  //display companies for add user
   $('.js-example-basic-multiple-add').select2({
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

   //display companies for edit user
    $('.js-example-basic-multiple-edit').select2({
      theme: "classic",
      allowClear: true,
      placeholder: "Select Company",
      dropdownParent: $('#EditUser'),
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

   //display position
    $('.position').change(function(){
      $.ajax({
        method: 'POST',
        url: base_url+'users/position',
        dataType: "json",
        success: function (data) {
          console.log(data);
       }
     })
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

   //modal for view user
   $(document).on('click', '.viewUser', function(){
      var id = $(this).attr('data-id');
      $.ajax({
        method: 'POST',
        url: base_url + 'users/view_user_details',
        data: {id:id},
        dataType: "json",
        success: function(data){
          console.log(data);
          // console.log(data.users);
          $('#ViewUser').modal('show');
          // $.each(data.users, function(key,val){
            // console.log(val);
            $('.name').text(data.users.fullname);
            $('.username').text(data.users.username);
            $('.position').text(data.users.position_name);
            var company_list = [];
            $.each(data.company, function(key,val){
              company_list.push(val.company_name);
              // console.log(val);
          });
          $('.company').text(company_list.join(', '));

        }
      })
   });

   //edit user
   $(document).on('click', '.editUser', function(){
     var id = $(this).attr('data-id');
     $.ajax({
         url: base_url+'users/user_details',
         data: {id:id},
         type: 'post',
         dataType: 'json',
         success: function(data){
           $('#EditUser').modal('show');
           console.log(data);
             $('#edituser input[name=fullname]').val(data.view_edit.fullname);
             $('#edituser input[name=username]').val(data.view_edit.username);
             $('#edituser input[name=password]').val(data.view_edit.password);
             $('#edituser select[name=position]').val(data.view_edit.position);
         }
     });

   });

   //successfully added user
   $(document).on('submit','#edituser',function(e){
     e.preventDefault();
     let formData =  new FormData($(this)[0]);
     var id = $('.editUser').attr('data-id');
     console.log(id);
     formData.append("id",id);
     $.ajax({
         method: 'POST',
         url : base_url + 'users/edituser',
         data : formData,
         processData: false,
        contentType: false,
        cache: false,
         dataType: 'json',
         success : function(data) {
             console.log(data);
             if(data.status == "ok"){
               $('#EditUser').modal('hide');
                   Swal.fire("Successfully updated user!",data.success, "success");
                   setTimeout(function(){
                      location.reload();
                    }, 1000);
              }else if(data.status == 'invalid'){
                 Swal.fire("Error",data.status, "invalid");
              }
             // if(data.form_error){
             //     clearError();
             //     let keyNames = Object.keys(data.form_error);
             //     $(keyNames).each(function(index , value) {
             //         $("input[name='"+value+"']").next('.err').text(data.form_error[value]);
             //     });
             // }else if (data.error) {
             //     Swal.fire("Error",data.error, "error");
             // }else {
             //    // blankVal();
             //     $('#EditUser').modal('hide');
             //     Swal.fire("Successfully updated user!",data.success, "success");
             //     setTimeout(function(){
             //        location.reload();
             //      }, 1000);
             // }
         }
     })
   });

   //delete user
   $(document).on("click",'.deleteUser', function(e) {
     e.preventDefault();
     var id = $(this).attr('data-id');
     console.log(id);

     Swal.fire({
     title: 'Are you sure?',
     text: "You want to delete this User!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#068101',
     confirmButtonText: 'Yes, Delete User!'
     }).then((result) => {
       if (result.value) {
         Swal.fire(
           'Deactivate!',
           'Successfully Deleted User!',
           'success'
         )
           $.ajax({
           type: 'POST',
             url:base_url + 'users/deleteuser',
             data: {id: id},
             success:function(data) {
               setTimeout(function(){
                      location.reload();
                    }, 1000);
             }
           })
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
