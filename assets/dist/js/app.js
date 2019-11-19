var base_url = $('input[name="base_url"]').val();
$(document).ready(function(){

  //display_users
    var users_tbl = $('.users_tbl').DataTable({
         "processing": true, //Feature control the processing indicator.
         "serverSide": true, //Feature control DataTables' server-side processing mode.
         "order": [[0,'desc']], //Initial no order.
         "columns":[
              {"data":"fullname"},
              {"data":"username"},
              {"data":"position_name"},
              {"data":"company","render": function(data, type, row,meta){
                  var str = '';
                  if(row.company == 1){
                    str += 'New Jiandra Enterprises';
                  }else if(row.company == 2){
                    str += 'Mrs.P Mktg';
                  }else if(row.company == 1,2){
                    str += 'New Jiandra Enterprises, Mrs.P Mktg';
                  }
                  return str;
                }
              },

              // {"data":"type"},
              {"data":"action","render": function(data, type, row,meta){
                        var str = '';
                        str += '<div class="actions">';
                        if(row.status == 1){

                          str += '<a href="javascript:;" class="viewUser" data-id="'+row.id+'"> <i class="fas fa-eye text-info"></i></a>';
                          str += '<a href="javascript:;" class="editUser" data-id="'+row.id+'"><i class="fas fa-pen text-warning"></i></a>';
                          str += '<a href="javascript:;" class="disableUser" data-id="'+row.id+'"><i class="fa fa-window-close"></i></a>';
                          str += '<a href="javascript:;" class="deleteUser" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';
                        }else if(row.status == 2){
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
                     str += '<span class="active btn btn-block btn-sm btn-success">active</button>';
                   }else if(row.status == 2){
                     str += '<span class="inactive btn btn-block btn-sm btn-danger">inactive</button>';
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
                   "targets": [4,5], //first column / numbering column
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
                          str += '<a href="javascript:;" class="viewVehicle" data-id="'+row.id+'"> <i class="fas fa-eye text-info"></i></a>';
                          str += '<a href="javascript:;" class="editVehicles" data-id="'+row.id+'"><i class="fas fa-pen text-warning"></i></a>';
                          str += '<a href="javascript:;" class="disableVehicle" data-id="'+row.id+'"><i class="fa fa-window-close"></i></a>';
                          str += '<a href="javascript:;" class="deleteVehicle" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';
                        }else if(row.status == 2){
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
                     str += '<span class="active btn btn-block btn-sm btn-success">active</button>';
                   }else if(row.status == 2){
                     str += '<span class="inactive btn btn-block btn-sm btn-danger">inactive</button>';
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
   $('.js-example-basic-multiple-addU').select2({
     allowClear: true,
     placeholder: "Select Company",
     dropdownParent: $('#AddUser'),
     tags: false,
     ajax: {
       url: base_url+'users/add_companies',
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
    $('.js-example-basic-multiple-editU').select2({
      allowClear: true,
      placeholder: "Select Company",
      dropdownParent: $('#EditUser'),
      tags: true,
      ajax: {
        url: base_url+'users/edit_companies',
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

    //display companies for add vehicle brand
     $('.js-example-basic-multiple-addvehicle').select2({
       placeholder: "Enter Value",
       dropdownParent: $('#AddVehicle'),
       tags: [],
       ajax: {
         url: base_url+'vehicle/listvehiclebrands',
         dataType: "json",
         type: "POST",
         quietMillis: 50,
         data: function (text) {
           return {
                       searchfor: text,
                       search_type: $(this).attr('data-type')
                   };
        },processResults: function (data) {

              return {
                  results: $.map(data.items, function (item) {
                      return {
                          text: item.vehicle_brand,
                          id: item.vehicle_id
                      }
                  })
              };
          }
       }
     });

     //display companies for edit vehicle brand
      $('.js-example-basic-multiple-editvehicle').select2({
        placeholder: "Enter Value",
        dropdownParent: $('#editVehicle'),
        tags: [],
        ajax: {
          url: base_url+'vehicle/listvehiclebrands_edit',
          dataType: "json",
          type: "POST",
          quietMillis: 50,
          data: function (text) {
            return {
                        searchfor: text,
                        search_type: $(this).attr('data-type')
                    };
         },processResults: function (data) {

               return {
                   results: $.map(data.items, function (item) {
                       return {
                           text: item.vehicle_brand,
                           id: item.vehicle_id
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
                   console.log(value);
                     $("input[name='"+value+"']").next('.err').text(data.form_error[value]);
                     $("select[name='"+value+"']").next('.err').text(data.form_error[value]);
                     $("select[name='"+value+"']").next().next().text(data.form_error[value]);
                     // $("select[name='"+value+"']").parents('.form-group').next('.err').text(data.form_error[value]);
                 });
             }else if (data.error) {
                 Swal.fire("Error",data.error, "error");
             }else {
                blankVal_user();
                 $('#AddUser').modal('hide');
                 Swal.fire("Successfully added user!",data.success, "success");
                 $(".users_tbl").DataTable().ajax.reload();
                 // setTimeout(function(){
                 //    location.reload();
                 //  }, 1000);
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
            $('#edituser input[name=user_id]').val(data.users.id);
             $('#edituser input[name=fullname]').val(data.users.fullname);
             $('#edituser input[name=username]').val(data.users.username);
             // $('#edituser input[name=password]').val(data.users.password);
             $('#edituser select[name=position]').val(data.users.position);
             var company_list = [];
             $('#edituser .js-example-basic-multiple-editU').html('');
             $.each(data.company, function(key,val){
               // company_list.push(val.company_name);
               // console.log(val);
               $('#edituser .js-example-basic-multiple-editU').append( '<option value='+val.company_id+' selected>'+val.company_name+'</option>' );
           });
           // $('.comp').text(company_list.join(', '));
         }
     });

   });

   //successfully edited user
   $(document).on('submit','#edituser',function(e){
     e.preventDefault();
     let formData =  new FormData($(this)[0]);
     var id = $('.userID').val();
     alert(id);
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
                   $(".users_tbl").DataTable().ajax.reload();
                   // setTimeout(function(){
                   //    location.reload();
                   //  }, 1000);
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
     text: "This user will be deactivated!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#068101',
     confirmButtonText: 'Yes, Deactivate User!'
     }).then((result) => {
       if (result.value) {
         Swal.fire(
           'Success!',
           'User has been deactivated!',
           'success'
         )
           $.ajax({
           type: 'POST',
             url:base_url + 'users/disableuser',
             data: {id: id},
             success:function(data) {
               $(".users_tbl").DataTable().ajax.reload();
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
     text: "This user will be activated!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#068101',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Yes, Activate User!'
     }).then((result) => {
       if (result.value) {
         Swal.fire(
           'Success!',
           'User has been activated!',
           'success'
         )
           $.ajax({
           type: 'POST',
             url:base_url + 'users/enableuser',
             data: {id: id},
             success:function(data) {
               $(".users_tbl").DataTable().ajax.reload();
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
     text: "This user will be permanently deleted!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#068101',
     confirmButtonText: 'Yes, Permanently Delete User!'
     }).then((result) => {
       if (result.value) {
         Swal.fire(
           'Success!',
           'User has been permanently deleted!',
           'success'
         )
           $.ajax({
           type: 'POST',
             url:base_url + 'users/deleteuser',
             data: {id: id},
             success:function(data) {
               $(".users_tbl").DataTable().ajax.reload();
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
                      $("select[name='"+value+"']").next('.err').text(data.form_error[value]);
                      $("select[name='"+value+"']").next().next().text(data.form_error[value]);
                 });
             }else if (data.error) {
                 Swal.fire("Error",data.error, "error");
             }else {
                  blankVal_vehicle();
                // blankVal();
                 $('#AddVehicle').modal('hide');
                 Swal.fire("Successfully added vehicle!",data.success, "success");
                 $(".vehicle_tbl").DataTable().ajax.reload();
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


   //edit Vehicle
   $(document).on('click', '.editVehicles', function(){
     var id = $(this).attr('data-id');
     $.ajax({
         url: base_url+'vehicle/vehicle_details',
         data: {id:id},
         type: 'post',
         dataType: 'json',
         success: function(data){
           console.log(data);
             $('#editVehicle').modal('show');
             $('#editVehicle input[name=vehicle_id]').val(data.view_edit.id);
             $('#editVehicle input[name=plate_number]').val(data.view_edit.plate_number);
             $('#editVehicle #vehicle_brand').append( '<option value='+data.view_edit.vehicle_brand+' selected>'+data.view_edit.vehicle_brand+'</option>' )
             // $('#editVehicle .js-example-basic-multiple-editvehicle').append(data.view_edit.vehicle_brand);
             $('#editVehicle input[name=vehicle_type').val(data.view_edit.vehicle_type);
             $('#editVehicle #fuel_type').append( '<option value='+data.view_edit.fuel_type+' selected>'+data.view_edit.fuel_type+'</option>' )
             // $('#editVehicle .js-example-basic-multiple-editvehicle').append(data.view_edit.fuel_type);
             $('#editVehicle input[name=num_of_tires]').val(data.view_edit.num_of_tires);
             $('#editVehicle input[name=accounting_date_acquired]').val(data.view_edit.accounting_date_acquired);
             $('#editVehicle input[name=accounting_acqui_amount]').val(data.view_edit.accounting_acqui_amount);
             $('#editVehicle input[name=accounting_full_dep_date]').val(data.view_edit.accounting_full_dep_date);
             $('#editVehicle input[name=accounting_monthly_dep]').val(data.view_edit.accounting_monthly_dep);
             $('#editVehicle input[name=accounting_accum_dep]').val(data.view_edit.accounting_accum_dep);
             $('#editVehicle input[name=accounting_book_val]').val(data.view_edit.accounting_book_val);
             $('#editVehicle input[name=approx_length]').val(data.view_edit.approx_length);
             $('#editVehicle input[name=approx_width]').val(data.view_edit.approx_width);
             $('#editVehicle input[name=approx_height]').val(data.view_edit.approx_height);
             $('#editVehicle input[name=approx_volume]').val(data.view_edit.approx_volume);
             $('#editVehicle input[name=approx_weight]').val(data.view_edit.approx_weight);
             $('#editVehicle input[name=van_reg_date]').val(data.view_edit.van_reg_date);
             $('#editVehicle input[name=van_policy_num]').val(data.view_edit.van_policy_num);
             $('#editVehicle input[name=van_renewal_date]').val(data.view_edit.van_renewal_date);
             $('#editVehicle input[name=van_exp_date]').val(data.view_edit.van_exp_date);
             $('#editVehicle input[name=land_reg_date]').val(data.view_edit.land_reg_date);
             $('#editVehicle input[name=land_renewal_date]').val(data.view_edit.land_renewal_date);
             $('#editVehicle input[name=land_exp_date]').val(data.view_edit.land_exp_date);
             $('#editVehicle textarea[name=material_desc]').val(data.view_edit.material_desc);
         }
     });



   });
   //successfully edit vehicle
   $(document).on('submit','#editvehicle',function(e){
     e.preventDefault();
     let formData =  new FormData($(this)[0]);
     var id = $('.vehicleID').val();
     alert(id);
     formData.append("id",id);
     $.ajax({
       method: 'POST',
       url : base_url + 'vehicle/editVehicle',
       data : formData,
       processData: false,
       contentType: false,
       cache: false,
       dataType: 'json',
       success : function(data) {
         if(data.status == "ok"){
           $('#editVehicle').modal('hide');
           Swal.fire("Successfully updated Vehicle!",data.success, "success");
           $(".vehicle_tbl").DataTable().ajax.reload();
         }else if(data.status == 'invalid'){
           Swal.fire("Error",data.status, "invalid");
         }
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
     text: "This vehicle will be deactivated!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#068101',
     confirmButtonText: 'Yes, Deactivate Vehicle!'
     }).then((result) => {
       if (result.value) {
         Swal.fire(
           'Success!',
           'Vehicle has been deactivated!',
           'success'
         )
           $.ajax({
           type: 'POST',
             url:base_url + 'vehicle/disablevehicle',
             data: {id: id},
             success:function(data) {
               $(".vehicle_tbl").DataTable().ajax.reload();
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
     text: "This vehicle will be activated!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#068101',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Yes, Activate vehicle!'
     }).then((result) => {
       if (result.value) {
         Swal.fire(
           'Success!',
           'Vehicle has been activated!',
           'success'
         )
           $.ajax({
           type: 'POST',
             url:base_url + 'vehicle/enablevehicle',
             data: {id: id},
             success:function(data) {
               $(".vehicle_tbl").DataTable().ajax.reload();
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
     text: "This vehicle will be permanently deleted!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#068101',
     confirmButtonText: 'Yes, Permanently Delete Vehicle!'
     }).then((result) => {
       if (result.value) {
         Swal.fire(
           'Success!',
           'Vehicle has been permanently deleted!',
           'success'
         )
           $.ajax({
           type: 'POST',
             url:base_url + 'vehicle/deletevehicle',
             data: {id: id},
             success:function(data) {
               $(".vehicle_tbl").DataTable().ajax.reload();
             }
           })
       }
     })
   });

   //auto compute volume in add vehicle
   $('.capacity').change(function(){
      var total = 1;
      $('.capacity').each(function(){
        var cur_cap = $(this).val();
        if(cur_cap != ''){

          total *= cur_cap;
        }
      });

      $('#volume').val(total);

   });

   //auto compute volume in edit vehicle
   $('.capacity_edit').change(function(){
      var total = 1;
      $('.capacity_edit').each(function(){
        var cur_cap = $(this).val();
        if(cur_cap != ''){

          total *= cur_cap;
        }
      });

      $('#volume_edit').val(total);

   });

});


function clearError(){
    $('.err').text('');
}

function blankVal_user(){
  $('#AddUser input[name="fullname"]').val('');
  $('.err').text('');
  $('#AddUser input[name="username"]').val('');
  $('#AddUser input[name="password"]').val('');
  $('#AddUser select[name="position"]').val('');
  $('#AddUser .js-example-basic-multiple-addU').val('').trigger('change');
}


function blankVal_vehicle(){
  $('#AddVehicle input[name="plate_number"]').val('');
  $('.err').text('');
  // $('#AddVehicle input[name="vehicle_brand"]').val('');
  $('#AddVehicle .js-example-basic-multiple-addvehicle').val('').trigger('change');
  $('#AddVehicle select[name="vehicle_type"]').val('');
  // $('#AddVehicle input[name="fuel_type"]').val('');
  $('#AddVehicle input[name="num_of_tires"]').val('');
  $('#AddVehicle input[name="accounting_date_acquired"]').val('');
  $('#AddVehicle input[name="accounting_acqui_amount"]').val('');
  $('#AddVehicle input[name="accounting_full_dep_date"]').val('');
  $('#AddVehicle input[name="accounting_monthly_dep"]').val('');
  $('#AddVehicle input[name="accounting_accum_dep"]').val('');
  $('#AddVehicle input[name="accounting_book_val"]').val('');
  $('#AddVehicle input[name="approx_length"]').val('');
  $('#AddVehicle input[name="approx_width"]').val('');
  $('#AddVehicle input[name="approx_height"]').val('');
  $('#AddVehicle input[name="approx_volume"]').val('');
  $('#AddVehicle input[name="approx_weight"]').val('');
  $('#AddVehicle input[name="van_reg_date"]').val('');
  $('#AddVehicle input[name="van_policy_num"]').val('');
  $('#AddVehicle input[name="van_renewal_date"]').val('');
  $('#AddVehicle input[name="van_exp_date"]').val('');
  $('#AddVehicle input[name="land_reg_date"]').val('');
  $('#AddVehicle input[name="land_renewal_date"]').val('');
  $('#AddVehicle input[name="land_exp_date"]').val('');
  $('#AddVehicle textarea[name="material_desc"]').val('');

}

$( function() {
  $('.datepicker').datepicker({
    autoclose: true,
    format: 'yyyy/mm/dd',
    })
 });
