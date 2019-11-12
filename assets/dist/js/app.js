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
                        str += '<div class="actions">';
                        if(row.status == 1){

                          str += '<a href="javascript:;" class="viewUser" data-id="'+row.id+'"> <i class="fas fa-clone"></i></a>';
                          str += '<a href="javascript:;" class="editUser" data-id="'+row.id+'"><i class="fas fa-pen"></i></a>';
                          str += '<a href="javascript:;" class="disableUser" data-id="'+row.id+'"><i class="fa fa-window-close"></i></a>';
                          str += '<a href="javascript:;" class="deleteUser" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';
                        }else if(row.status == 2){
                          str += '<a href="javascript:;" class="viewUser" data-id="'+row.id+'"> <i class="fas fa-clone"></i></a>';
                          str += '<a href="javascript:;" class="editUser" data-id="'+row.id+'"><i class="fas fa-pen"></i></a>';
                          str += '<a href="javascript:;" class="enableUser" data-id="'+row.id+'"><i class="fa fa-check-square"></i></a>';
                          str += '<a href="javascript:;" class="deleteUser" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';
                        }
                        str += '</div>';
                        return str;
                   }
              },

              {"data":"status","render": function(data, type, row,meta){
                  var str = '';
                   if(row.status == 1){
                     str += '<button type="button" class="active btn btn-block btn-success">active</button>';
                   }else if(row.status == 2){
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


  //display vehicle_tbl
    var vehicle_tbl = $('.vehicle_tbl').DataTable({
         "processing": true, //Feature control the processing indicator.
         "serverSide": true, //Feature control DataTables' server-side processing mode.
         "order": [[0,'desc']], //Initial no order.
         "columns":[
               {"data":"vehicle_type","render": function(data, type, row,meta){
                 var str = '';
                  if(row.vehicle_type == 1){
                     str += 'Warehouse Truck';
                  }else{
                    str += 'Delivery Truck';
                  }
                  return str;
                }
               },
              // {"data":"vehicle_type"},
              {"data":"plate_number"},
              {"data":"vehicle_brand"},
              // {"data":"type"},
              {"data":"action","render": function(data, type, row,meta){
                        var str = '';
                        str += '<div class="actions">';
                        if(row.status == 1){
                          str += '<a href="javascript:;" class="viewVehicle" data-id="'+row.id+'"> <i class="fas fa-clone"></i></a>';
                          str += '<a href="javascript:;" class="editVehicle" data-id="'+row.id+'"><i class="fas fa-pen"></i></a>';
                          str += '<a href="javascript:;" class="disableVehicle" data-id="'+row.id+'"><i class="fa fa-window-close"></i></a>';
                          str += '<a href="javascript:;" class="deleteVehicle" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';
                        }else if(row.status == 2){
                          str += '<a href="javascript:;" class="viewVehicle" data-id="'+row.id+'"> <i class="fas fa-clone"></i></a>';
                          str += '<a href="javascript:;" class="editVehicle" data-id="'+row.id+'"><i class="fas fa-pen"></i></a>';
                          str += '<a href="javascript:;" class="enableVehicle" data-id="'+row.id+'"><i class="fa fa-check-square"></i></a>';
                          str += '<a href="javascript:;" class="deleteVehicle" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';
                        }
                        str += '</div>';
                        return str;
                   }
              },

              {"data":"status","render": function(data, type, row,meta){
                  var str = '';
                   if(row.status == 1){
                     str += '<button type="button" class="active btn btn-block btn-success">active</button>';
                   }else if(row.status == 2){
                     str += '<button type="button" class="inactive btn btn-block btn-danger">inactive</button>';
                   }
                   return str;
              }
            }

         ],
         // Load data for the table's content from an Ajax source
         "ajax": {
              "url":base_url+"vehicle/display_vehicles/",
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
  //end display vehicle_tbl


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
             $('#edituser input[name=fullname]').val(data.users.fullname);
             $('#edituser input[name=username]').val(data.users.username);
             $('#edituser input[name=password]').val(data.users.password);
             $('#edituser select[name=position]').val(data.users.position);
             var company_list = [];
             $.each(data.company, function(key,val){
               // console.log(val);
               company_list.push(val.company_name);
               // console.log(val);
           });
           $('.comp').text(company_list.join(', '));
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

   //disable user
   $(document).on("click",'.disableUser', function(e) {
     e.preventDefault();
     var id = $(this).attr('data-id');
     console.log(id);

     Swal.fire({
     title: 'Are you sure?',
     text: "You want to disable this User!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#068101',
     confirmButtonText: 'Yes, Disable User!'
     }).then((result) => {
       if (result.value) {
         Swal.fire(
           'Disable!',
           'Successfully Disabled User!',
           'success'
         )
           $.ajax({
           type: 'POST',
             url:base_url + 'users/disableuser',
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

   //disable user
   $(document).on("click",'.enableUser', function(e) {
     e.preventDefault();
     var id = $(this).attr('data-id');
     console.log(id);

     Swal.fire({
     title: 'Are you sure?',
     text: "You want to enable this User!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#068101',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Yes, Enable User!'
     }).then((result) => {
       if (result.value) {
         Swal.fire(
           'Enable!',
           'Successfully Enabled User!',
           'success'
         )
           $.ajax({
           type: 'POST',
             url:base_url + 'users/enableuser',
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

   //permanently delete user
   $(document).on("click",'.deleteUser', function(e) {
     e.preventDefault();
     var id = $(this).attr('data-id');
     console.log(id);

     Swal.fire({
     title: 'Are you sure?',
     text: "You want to permanently delete this User!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#068101',
     confirmButtonText: 'Yes, Permanently Delete User!'
     }).then((result) => {
       if (result.value) {
         Swal.fire(
           'Delete!',
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

   //Vehicle

   //successfully added vehicle
   $(document).on('submit','form#addvehicle',function(e){
     e.preventDefault();
     let formData = $(this).serialize();

     $.ajax({
         method: 'POST',
         url : base_url + 'vehicle/addvehicle',
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
                // blankVal();
                 $('#AddVehicle').modal('hide');
                 Swal.fire("Successfully added vehicle!",data.success, "success");
                 setTimeout(function(){
                    location.reload();
                  }, 1000);
             }
         }
     })
   });

   //modal for view vehicle
   $(document).on('click', '.viewVehicle', function(){
      var id = $(this).attr('data-id');
      $.ajax({
        method: 'POST',
        url: base_url + 'vehicle/view_vehicle_details',
        data: {id:id},
        dataType: "json",
        success: function(data){
          console.log(data);
          $('#ViewVehicle').modal('show');
            $('.plate_number').text(data.vehicle.plate_number);
            $('.vehicle_brand').text(data.vehicle.vehicle_brand);
            if(data.vehicle.vehicle_type == 1){
              $('.vehicle_type').text('Warehouse Truck');
            }else{
              $('.vehicle_type').text('Delivery Truck');
            }
            $('.fuel_type').text(data.vehicle.fuel_type);
            $('.num_of_tires').text(data.vehicle.num_of_tires);
            $('.accounting_date_acquired').text(data.vehicle.accounting_date_acquired);
            $('.accounting_acqui_amount').text(data.vehicle.accounting_acqui_amount);
            $('.accounting_full_dep_date').text(data.vehicle.accounting_full_dep_date);
            $('.accounting_monthly_dep').text(data.vehicle.accounting_monthly_dep);
            $('.accounting_accum_dep').text(data.vehicle.accounting_accum_dep);
            $('.accounting_book_val').text(data.vehicle.accounting_book_val);
            $('.approx_length').text(data.vehicle.approx_length);
            $('.approx_width').text(data.vehicle.approx_width);
            $('.approx_height').text(data.vehicle.approx_height);
            $('.approx_volume').text(data.vehicle.approx_volume);
            $('.approx_weight').text(data.vehicle.approx_weight);
            $('.van_reg_date').text(data.vehicle.van_reg_date);
            $('.van_policy_num').text(data.vehicle.van_policy_num);
            $('.van_renewal_date').text(data.vehicle.van_renewal_date);
            $('.van_exp_date').text(data.vehicle.van_exp_date);
            $('.land_reg_date').text(data.vehicle.land_reg_date);
            $('.land_renewal_date').text(data.vehicle.land_renewal_date);
            $('.land_exp_date').text(data.vehicle.land_exp_date);
            $('.material_desc').text(data.vehicle.material_desc);

        }
      })
   });

   //disable vehicle
   $(document).on("click",'.disableVehicle', function(e) {
     e.preventDefault();
     var id = $(this).attr('data-id');
     console.log(id);

     Swal.fire({
     title: 'Are you sure?',
     text: "You want to disable this vehicle!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#068101',
     confirmButtonText: 'Yes, Disable Vehicle!'
     }).then((result) => {
       if (result.value) {
         Swal.fire(
           'Disable!',
           'Successfully Disabled Vehicle!',
           'success'
         )
           $.ajax({
           type: 'POST',
             url:base_url + 'vehicle/disablevehicle',
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

   //Enable vehicle
   $(document).on("click",'.enableVehicle', function(e) {
     e.preventDefault();
     var id = $(this).attr('data-id');
     console.log(id);

     Swal.fire({
     title: 'Are you sure?',
     text: "You want to enable this vehicle!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#068101',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Yes, Enable vehicle!'
     }).then((result) => {
       if (result.value) {
         Swal.fire(
           'Enable!',
           'Successfully Enabled vehicle!',
           'success'
         )
           $.ajax({
           type: 'POST',
             url:base_url + 'vehicle/enablevehicle',
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

   //delete vehicle
   $(document).on("click",'.deleteVehicle', function(e) {
     e.preventDefault();
     var id = $(this).attr('data-id');
     console.log(id);

     Swal.fire({
     title: 'Are you sure?',
     text: "You want to permenently delete this Vehicle!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#068101',
     confirmButtonText: 'Yes, Permanently Delete Vehicle!'
     }).then((result) => {
       if (result.value) {
         Swal.fire(
           'Delete!',
           'Successfully Deleted Vehicle!',
           'success'
         )
           $.ajax({
           type: 'POST',
             url:base_url + 'vehicle/deletevehicle',
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
