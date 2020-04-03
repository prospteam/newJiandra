var base_url = $('input[name="base_url"]').val();
$(document).ready(function(){

    $('[data-toggle="tooltip"]').tooltip();

  //remove company field when warehouse personnel
  $('#position').on('change', function(){
    if($(this).val() == "5"){
      $('.company').css('display', 'none');
    }else{
      $('.company').css('display', 'block');
    }
  });

  $('#edit_position').on('change', function(){
    if($(this).val() == "5"){
      $('.company').css('display', 'none');
    }else{
      $('.company').css('display', 'block');
    }
  });

  //display_users

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
       tags: [],
       ajax: {
         url: base_url+'vehicle/listvehiclebrands_add',
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

      //display companies for edit vehicle brand
       $('.js-example-basic-multiple-bodyType-add').select2({
         placeholder: "Enter Value",
         tags: [],
         ajax: {
           url: base_url+'vehicle/bodytype_add',
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
                            text: item.body_type,
                            id: item.vehicle_id
                        }
                    })
                };
            }
         }
       });

       //display companies for edit vehicle brand
        $('.js-example-basic-multiple-bodyType-edit').select2({
          placeholder: "Enter Value",
          dropdownParent: $('#editVehicle'),
          tags: [],
          ajax: {
            url: base_url+'vehicle/bodytype_edit',
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
                             text: item.body_type,
                             id: item.vehicle_id
                         }
                     })
                 };
             }
          }
        });

      //select2 for add company each vehicles
       $('.add-company-vehicle').select2({
         allowClear: true,
         placeholder: "Select Company",
         dropdownParent: $('#AddVehicle'),
         tags: true,
         ajax: {
           url: base_url+'vehicle/add_vehicle_companies',
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

       //select2 for add company each vehicles
        $('.edit-company-vehicle').select2({
          allowClear: true,
          placeholder: "Select Company",
          dropdownParent: $('#editVehicle'),
          tags: true,
          ajax: {
            url: base_url+'vehicle/edit_vehicle_companies',
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
                   console.log(value);
                     $("input[name='"+value+"']").next('.err').text(data.form_error[value]);
                     $("select[name='"+value+"']").next('.err').text(data.form_error[value]);
                     $("select[name='"+value+"']").next().next().text(data.form_error[value]);
                     // $("select[name='"+value+"']").parents('.form-group').next('.err').text(data.form_error[value]);
                 });
             }else if (data.error) {
                 Swal.fire("Error",data.error, "error");
             }else if (data.username_error) {
                 Swal.fire("Error!",data.username_error, "error");
             }
             else {
                blankVal_user();
                 $('#AddUser').modal('hide');
                 Swal.fire("Successfully added user!",data.success, "success");
             }
             $(".users_tbl").DataTable().ajax.reload();
         }
     });
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
             $('.company').css('display', 'none');
             if(data.users.position != 5){
               $('.company').css('display', 'block');
               var company_list = [];
               $('#edituser .js-example-basic-multiple-editU').html('');
               $.each(data.company, function(key,val){
                 // company_list.push(val.company_name);
                 // console.log(val);
                 $('#edituser .js-example-basic-multiple-editU').append( '<option value='+val.company_id+' selected>'+val.company_name+'</option>' );
               });
             }
           // $('.comp').text(company_list.join(', '));
         }
     });

   });

   //successfully edited user
   $(document).on('submit','#edituser',function(e){
     e.preventDefault();
     let formData =  new FormData($(this)[0]);
     var id = $('.userID').val();
     // alert(id);
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
              }else if(data.status == 'invalid'){
                 Swal.fire("Error",data.status, "invalid");
              }

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
   $(document).on('submit','form#AddVehicle',function(e){
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
             }
             $(".vehicle_tbl").DataTable().ajax.reload();
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
            var company_list = [];

            $.each(data.company, function(key,val){
              company_list.push(val.company_name);
            });

            $('.company').text(company_list.join(', '));

            //general information
            if(data.view_vehicles.vehicle_type == 1){
              $('.vehicle_type').text('EX Truck');
            }else{
              $('.vehicle_type').text('Delivery Truck');
            }
            $('.cr_no').text(data.view_vehicles.cr_no);
            $('.owner').text(data.view_vehicles.owner);
            $('.or_no').text(data.view_vehicles.or_no);
            $('.or_date').text(data.view_vehicles.or_date);
            $('.mv_file_no').text(data.view_vehicles.mv_file_no);
            $('.plate_number').text(data.view_vehicles.plate_number);
            $('.engine_no').text(data.view_vehicles.engine_no);
            $('.chassis_no').text(data.view_vehicles.chassis_no);
            $('.denomination').text(data.view_vehicles.denomination);
            $('.piston_displacement').text(data.view_vehicles.piston_displacement);
            $('.num_of_tires').text(data.view_vehicles.num_of_tires);
            $('.fuel_type').text(data.view_vehicles.fuel_type);
            $('.vehicle_brand').text(data.view_vehicles.vehicle_brand);
            $('.series').text(data.view_vehicles.series);
            $('.body_type').text(data.view_vehicles.body_type);
            $('.body_no').text(data.view_vehicles.body_no);
            $('.year_model').text(data.view_vehicles.year_model);
            $('.gross').text(data.view_vehicles.gross);
            $('.net').text(data.view_vehicles.net);
            $('.shipping_wt').text(data.view_vehicles.shipping_wt);
            $('.net_capacity').text(data.view_vehicles.net_capacity);

            //accounting information
            $('.accounting_date_acquired').text(data.view_vehicles.accounting_date_acquired);
            $('.accounting_acqui_amount').text(data.view_vehicles.accounting_acqui_amount);
            $('.accounting_full_dep_date').text(data.view_vehicles.accounting_full_dep_date);
            $('.accounting_monthly_dep').text(data.view_vehicles.accounting_monthly_dep);
            $('.accounting_accum_dep').text(data.view_vehicles.accounting_accum_dep);
            $('.accounting_book_val').text(data.view_vehicles.accounting_book_val);
            $('.approx_length').text(data.view_vehicles.approx_length);
            $('.approx_width').text(data.view_vehicles.approx_width);
            $('.approx_height').text(data.view_vehicles.approx_height);
            $('.approx_volume').text(data.view_vehicles.approx_volume);
            $('.approx_weight').text(data.view_vehicles.approx_weight);

            //van insurance details
            $('.van_reg_date').text(data.view_vehicles.van_reg_date);
            $('.van_policy_num').text(data.view_vehicles.van_policy_num);
            $('.van_renewal_date').text(data.view_vehicles.van_renewal_date);
            $('.van_exp_date').text(data.view_vehicles.van_exp_date);

            //land transportation details
            $('.land_reg_date').text(data.view_vehicles.land_reg_date);
            $('.land_renewal_date').text(data.view_vehicles.land_renewal_date);
            $('.land_exp_date').text(data.view_vehicles.land_exp_date);
            $('.material_desc').text(data.view_vehicles.material_desc);

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
             var company_list = [];
             $('#editVehicle .edit-company-vehicle').html('');

             $.each(data.company, function(key,val){
               company_list.push(val.company_name);
               $('#editVehicle .edit-company-vehicle').append( '<option value='+val.company_id+' selected>'+val.company_name+'</option>' );
             });

             $('#editVehicle input[name=id]').val(data.vehicles.id);
             //general information
             $('#editVehicle input[name=vehicle_type').val(data.vehicles.vehicle_type);
             $('#editVehicle input[name=cr_no]').val(data.vehicles.cr_no);
             $('#editVehicle input[name=owner]').val(data.vehicles.owner);
             $('#editVehicle input[name=or_no]').val(data.vehicles.or_no);
             $('#editVehicle input[name=or_date]').val(data.vehicles.or_date);
             $('#editVehicle input[name=mv_file_no]').val(data.vehicles.mv_file_no);
             $('#editVehicle input[name=plate_number]').val(data.vehicles.plate_number);
             $('#editVehicle input[name=engine_no]').val(data.vehicles.engine_no);
             $('#editVehicle input[name=chassis_no]').val(data.vehicles.chassis_no);
             $('#editVehicle input[name=denomination]').val(data.vehicles.denomination);
             $('#editVehicle input[name=piston_displacement]').val(data.vehicles.piston_displacement);
             $('#editVehicle input[name=num_of_tires]').val(data.vehicles.num_of_tires);
             $('#editVehicle #fuel_type1').append( '<option value='+data.vehicles.fuel_type+' selected>'+data.vehicles.fuel_type+'</option>' )
             $('#editVehicle #vehicle_brand1').append( '<option value='+data.vehicles.vehicle_brand+' selected>'+data.vehicles.vehicle_brand+'</option>' )
             $('#editVehicle input[name=series]').val(data.vehicles.series);
             $('#editVehicle #body_type1').append( '<option value='+data.vehicles.body_type+' selected>'+data.vehicles.body_type+'</option>' )
             $('#editVehicle input[name=body_no]').val(data.vehicles.body_no);
             $('#editVehicle input[name=year_model]').val(data.vehicles.year_model);
             $('#editVehicle input[name=gross]').val(data.vehicles.gross);
             $('#editVehicle input[name=net]').val(data.vehicles.net);
             $('#editVehicle input[name=shipping_wt]').val(data.vehicles.shipping_wt);
             $('#editVehicle input[name=net_capacity]').val(data.vehicles.net_capacity);

             //accounting information
             $('#editVehicle input[name=accounting_date_acquired]').val(data.vehicles.accounting_date_acquired);
             $('#editVehicle input[name=accounting_acqui_amount]').val(data.vehicles.accounting_acqui_amount);
             $('#editVehicle input[name=accounting_full_dep_date]').val(data.vehicles.accounting_full_dep_date);
             $('#editVehicle input[name=accounting_monthly_dep]').val(data.vehicles.accounting_monthly_dep);
             $('#editVehicle input[name=accounting_accum_dep]').val(data.vehicles.accounting_accum_dep);
             $('#editVehicle input[name=accounting_book_val]').val(data.vehicles.accounting_book_val);
             $('#editVehicle input[name=approx_length]').val(data.vehicles.approx_length);
             $('#editVehicle input[name=approx_width]').val(data.vehicles.approx_width);
             $('#editVehicle input[name=approx_height]').val(data.vehicles.approx_height);
             $('#editVehicle input[name=approx_volume]').val(data.vehicles.approx_volume);
             $('#editVehicle input[name=approx_weight]').val(data.vehicles.approx_weight);

             //van insurance details
             $('#editVehicle input[name=van_reg_date]').val(data.vehicles.van_reg_date);
             $('#editVehicle input[name=van_policy_num]').val(data.vehicles.van_policy_num);
             $('#editVehicle input[name=van_renewal_date]').val(data.vehicles.van_renewal_date);
             $('#editVehicle input[name=van_exp_date]').val(data.vehicles.van_exp_date);

             //land insurance details
             $('#editVehicle input[name=land_reg_date]').val(data.vehicles.land_reg_date);
             $('#editVehicle input[name=land_renewal_date]').val(data.vehicles.land_renewal_date);
             $('#editVehicle input[name=land_exp_date]').val(data.vehicles.land_exp_date);
             $('#editVehicle textarea[name=material_desc]').val(data.vehicles.material_desc);


         }
     });



   });
   //successfully edit vehicle
   $(document).on('submit','#editvehicle',function(e){
     e.preventDefault();
     let formData =  new FormData($(this)[0]);
     var id = $('.vehicleID').val();
     // alert(id);
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

   // //view remarks
   $(document).on('click', '.remarks_inactive', function(){
      var id = $(this).attr('data-id');
     $.ajax({
       method: 'POST',
       url: base_url + 'vehicle/view_remarks_inactive',
       data: {id:id},
       dataType: "json",
       success: function(data){
         console.log(data);
         $('#viewRemarks_inactive').modal('show');
         if(data.remarks.remarks !== ''){

           $('.viewremarks').text(data.remarks.remarks);
         }else{
            $('.viewremarks').text("None");
         }
         // $('#change_Stat select[name=status]').val(data.status.status);
         //   $('input[name="purchase_code_status"]').val(data.status.purchase_code);
     }
    });
   });

   //disable vehicle
   $(document).on("click",'.disableVehicle', function(e) {
     e.preventDefault();
     var id = $(this).attr('data-id');
     // console.log(id);

     Swal.fire({
     title: 'Are you sure?',
     text: "This vehicle will be deactivated!",
     html: '<span>This vehicle will be deactivated!</span><br>',
     inputPlaceholder: "Add remarks",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#068101',
     confirmButtonText: 'Yes, Deactivate Vehicle!',
     preConfirm: function () {
    return new Promise((resolve, reject) => {
            resolve({
                Remarks: $('textarea[placeholder="Add Remarks"]').val()
            });
        });
    },
    allowOutsideClick: false
  }).then(function(result){
       if (result.value) {
         Swal.fire(
           'Success!',
           'Vehicle has been deactivated!',
           'success'
         )
         $.ajax({
         type: 'POST',
           url:base_url + 'vehicle/disablevehicle',
           data: {id: id, Remarks:$('textarea[placeholder="Add Remarks"]').val()},
           cache: false,
           success:function(data) {
             // setTimeout(function(){$('#addRemarks').modal('show'); }, 1000);
             //   $('#addRemarks input[name=vehicle_id]').val(data.vehicle.id);
             //   $('#addRemarks').modal('show');
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
var users_tbl = $('.users_tbl').DataTable({
     "responsive": true,
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
                str += row.company_name;
              }else if(row.company == 2){
                str += row.company_name;
              }else if(row.company == 0){
                str += '-';
              }else if(row.company == 1,2 || row.company == 2,1){
                str += 'New Jiandra Enterprises, Mrs.P Marketing';

              }
              return str;
            }
          },

          // {"data":"type"},
          {"data":"action","render": function(data, type, row,meta){
                    var str = '';
                    str += '<div class="actions">';
                    if(row.status == 1){
                      str += '<a href="javascript:;" class="viewUser" data-id="'+row.id+'"><abbr title="View User"><i class="fas fa-eye text-info"></abbr></i></a>';
                      str += '<a href="javascript:;" class="editUser" data-id="'+row.id+'"><abbr title="Edit User"><i class="fas fa-pen text-warning"></i></abbr></a>';
                      str += '<a href="javascript:;" class="disableUser" data-id="'+row.id+'"><abbr title="Disable User"><i class="fa fa-window-close"></i></abbr></a>';
                      str += '<a href="javascript:;" class="deleteUser" data-id="'+row.id+'"><abbr title="Delete User"><i class="fa fa-trash" aria-hidden="true"></abbr></a>';
                    }else if(row.status == 2){
                      str += '<a href="javascript:;" class="viewUser" data-id="'+row.id+'"><abbr title="View User"><i class="fas fa-eye text-info"></i></abbr></a>';
                      str += '<a href="javascript:;" class="enableUser" data-id="'+row.id+'"><abbr title=" Enable User"><i class="fa fa-check-square"></i></abbr></a>';
                      str += '<a href="javascript:;" class="deleteUser" data-id="'+row.id+'"><abbr title="Delete User"><i class="fa fa-trash" aria-hidden="true"></abbr></a>';
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
    "responsive": true,
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
                      str += '<a href="javascript:;" class="viewVehicle" data-id="'+row.id+'"><abbr title="View Vehicle"><i class="fas fa-eye text-info"></i></abbr></a>';
                      str += '<a href="javascript:;" class="editVehicles" data-id="'+row.id+'"><abbr title="Edit Vehicle"><i class="fas fa-pen text-warning"></i></abbr></a>';
                      str += '<a href="javascript:;" class="disableVehicle" data-id="'+row.id+'" value="'+row.id+'"><abbr title="Disable Vehicle"><i class="fa fa-window-close"></i></abbr></a>';
                      str += '<a href="javascript:;" class="deleteVehicle" data-id="'+row.id+'"><abbr title="Delete Vehicle"><i class="fa fa-trash" aria-hidden="true"></i></abbr></a>';
                    }else if(row.status == 2){
                      str += '<a href="javascript:;" class="viewVehicle" data-id="'+row.id+'"><abbr title="View Vehicle"><i class="fas fa-eye text-info"></i></abbr></a>';
                      // str += '<a href="javascript:;" class="remarks_inactive" data-id="'+row.id+'" value="'+row.id+'"><abbr title="Remarks"><i class="fa fa-comment" aria-hidden="true"></i></abbr></a>';
                      str += '<a href="javascript:;" class="enableVehicle" data-id="'+row.id+'"><abbr title="Enable Vehicle"><i class="fa fa-check-square"></i></abbr></a>';
                      str += '<a href="javascript:;" class="deleteVehicle" data-id="'+row.id+'"><abbr title="Delete Vehicle"><i class="fa fa-trash" aria-hidden="true"></i></abbr></a>';
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


function clearError(){
    $('.err').text('');
}

function blank_remarks(){
  $('#addRemarks textarea[name="remarks"]').val('');
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
  //general information
  $('.err').text('');
  $('#AddVehicle select[name="vehicle_type"]').val('');
  $('#AddVehicle input[name="cr_no"]').val('');
  $('#AddVehicle input[name="owner"]').val('');
  $('#AddVehicle input[name="or_no"]').val('');
  $('#AddVehicle input[name="or_date"]').val('');
  $('#AddVehicle input[name="mv_file_no"]').val('');
  $('#AddVehicle input[name="plate_number"]').val('');
  $('#AddVehicle input[name="engine_no"]').val('');
  $('#AddVehicle input[name="chassis_no"]').val('');
  $('#AddVehicle input[name="denomination"]').val('');
  $('#AddVehicle input[name="piston_displacement"]').val('');
  $('#AddVehicle input[name="num_of_tires"]').val('');
  $('#AddVehicle .js-example-basic-multiple-addvehicle').val('').trigger('change');
  $('#AddVehicle input[name="series"]').val('');
  $('#AddVehicle .js-example-basic-multiple-bodyType-add').val('').trigger('change');
  $('#AddVehicle input[name="body_no"]').val('');
  $('#AddVehicle input[name="year_model"]').val('');
  $('#AddVehicle input[name="gross"]').val('');
  $('#AddVehicle input[name="net"]').val('');
  $('#AddVehicle input[name="shipping_wt"]').val('');
  $('#AddVehicle input[name="net_capacity"]').val('');

  //accounting information
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
    format: 'MM d, yyyy',
    })
 });
