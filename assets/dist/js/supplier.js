      var base_url = $('input[name="base_url"]').val();
      $(document).ready(function(){
        //display suppliers
      // alert('lol');
          $('.company1').on('click', function(e){
            e.preventDefault();

            // alert($(this).data('id'));

         $('.suppliers_tbl').DataTable({
               "destroy"   : true,
               "processing": true, //Feature control the processing indicator.
               "serverSide": true, //Feature control DataTables' server-side processing mode.
               "order": [[0,'desc']], //Initial no order.
               "columns":[
                    {"data":"supplier_logo","render": function(data, type, row,meta){
                        if(row.supplier_logo != 1){

                          return '<img class="supplier_logo" src="'+base_url+'assets/images/supplierLogo/' +data+ '" />';
                        }else{
                          return '<img class="supplier_logo" src="'+base_url+'assets/images/supplierLogo/ImageNotAvailable.png" />';
                        }
                        }
                    },
                    {"data":"supplier_name"},
                    // {"data":"type"},
                    {"data":"action","render": function(data, type, row,meta){
                              var str = '';
                              str += '<div class="actions">';
                              if(row.status == 1){
                                str += '<a href="javascript:;" class="viewSupplier" data-id="'+row.id+'"> <i class="fas fa-clone"></i></a>';
                                str += '<a href="javascript:;" class="editSupplier" data-id="'+row.id+'"><i class="fas fa-pen"></i></a>';
                                str += '<a href="javascript:;" class="disableSupplier" data-id="'+row.id+'"><i class="fa fa-window-close"></i></a>';
                                str += '<a href="javascript:;" class="deleteSupplier" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';
                              }else if(row.status == 2){
                                str += '<a href="javascript:;" class="enableSupplier" data-id="'+row.id+'"><i class="fa fa-check-square"></i></a>';
                                str += '<a href="javascript:;" class="deleteSupplier" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';
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
                    "url":base_url+"supplier/display_suppliers/"+$(this).data('id'),
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
          }) ;


          var supplier_tbl = $('.suppliers_tbl').DataTable({
          "destroy"   : true,
          "processing": true, //Feature control the processing indicator.
          "serverSide": true, //Feature control DataTables' server-side processing mode.
          "order": [[0,'desc']], //Initial no order.
          "columns":[
               {"data":"supplier_logo","render": function(data, type, row,meta){
                   if(row.supplier_logo != 1){

                     return '<img class="supplier_logo" src="'+base_url+'assets/images/supplierLogo/' +data+ '" />';
                   }else{
                     return '<img class="supplier_logo" src="'+base_url+'assets/images/supplierLogo/ImageNotAvailable.png" />';
                   }
                   }
               },
               {"data":"supplier_name"},
               // {"data":"type"},
               {"data":"action","render": function(data, type, row,meta){
                 var str = '';
                 str += '<div class="actions">';
                 if(row.status == 1){
                   str += '<a href="javascript:;" class="viewSupplier" data-id="'+row.id+'"> <i class="fas fa-clone"></i></a>';
                   str += '<a href="javascript:;" class="editSupplier" data-id="'+row.id+'"><i class="fas fa-pen"></i></a>';
                   str += '<a href="javascript:;" class="disableSupplier" data-id="'+row.id+'"><i class="fa fa-window-close"></i></a>';
                   str += '<a href="javascript:;" class="deleteSupplier" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';
                 }else if(row.status == 2){
                   str += '<a href="javascript:;" class="enableSupplier" data-id="'+row.id+'"><i class="fa fa-check-square"></i></a>';
                   str += '<a href="javascript:;" class="deleteSupplier" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';
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
               "url":base_url+"supplier/display_suppliers/1",
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
  //end display suppliers

  // add supplier
  $(document).on('submit','form#addsupplier',function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);
      // formData.append('nob_id',$('a.add').attr('data-id'));
      // formData.append('nob_code',$('a.add').attr('data-code'));
      $.ajax({
          url:base_url+'supplier/addsupplier/',
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
                      $("input[name='"+value+"']").next('.err').text(data.form_error[value]);
                  });
              }else if (data.error) {
                  Swal.fire("Error",data.error, "error");
              }else {
                 blankVal();
                  $('#addSupplier').modal('hide');
                  Swal.fire("Successfully added supplier!",data.success, "success");
                  $(".suppliers_tbl").DataTable().ajax.reload();
              }
          }
      });
  });
  //end add supplier


  //disable supplier
  $(document).on("click",'.disableSupplier', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    console.log(id);

    Swal.fire({
    title: 'Are you sure?',
    text: "You want to disable this supplier!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#068101',
    confirmButtonText: 'Yes, Disable Supplier!'
    }).then((result) => {
      if (result.value) {
        Swal.fire(
          'Disable!',
          'Successfully Disabled Supplier!',
          'success'
        )
          $.ajax({
          type: 'POST',
            url:base_url + 'supplier/disablesupplier',
            data: {id: id},
            success:function(data) {
              $(".suppliers_tbl").DataTable().ajax.reload();
            }
          })
      }
    })
  });

  //Enable supplier
  $(document).on("click",'.enableSupplier', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    console.log(id);

    Swal.fire({
    title: 'Are you sure?',
    text: "You want to enable this supplier!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#068101',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Enable supplier!'
    }).then((result) => {
      if (result.value) {
        Swal.fire(
          'Enable!',
          'Successfully Enabled supplier!',
          'success'
        )
          $.ajax({
          type: 'POST',
            url:base_url + 'supplier/enablesupplier',
            data: {id: id},
            success:function(data) {
              $(".suppliers_tbl").DataTable().ajax.reload();
            }
          })
      }
    })
  });

  //delete suppplier
  $(document).on("click",'.deleteSupplier', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    console.log(id);

    Swal.fire({
    title: 'Are you sure?',
    text: "You want to permanently delete this Supplier!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#068101',
    confirmButtonText: 'Yes, Permanently Delete Supplier!'
    }).then((result) => {
      if (result.value) {
        Swal.fire(
          'Delete!',
          'Successfully Deleted Supplier!',
          'success'
        )
          $.ajax({
          type: 'POST',
            url:base_url + 'supplier/deleteSupplier',
            data: {id: id},
            success:function(data) {
              $(".suppliers_tbl").DataTable().ajax.reload();
            }
          })
      }
    })
  });

  //display Companies for add supplier
   $('.js-example-basic-multiple').select2({
     theme: "classic",
     allowClear: true,
     placeholder: "Select Company",
     dropdownParent: $('#addSupplier'),
     tags: true,
     ajax: {
       url: base_url+'supplier/add_supplier_companies',
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

   //display companies foe edit supplier
   $('.js-example-basic-multiple-edit').select2({
     theme: "classic",
     allowClear: true,
     placeholder: "Select Company",
     dropdownParent: $('#editSupplier'),
     tags: true,
     ajax: {
       url: base_url+'supplier/edit_supplier_companies',
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

   $(document).on("click",".viewSupplier",function(){
     var id = $(this).attr('data-id');
     $.ajax({
       method: 'POST',
       url: base_url + 'supplier/view_supplier_details',
       data: {id:id},
       dataType: "json",
       success: function(data){
         console.log(data);
         $('#viewSupplier').modal('show');
         // $.each(data.supplier, function(key,val){
           console.log(data);
           $('.supplier_name').text(data.supplier.supplier_name);
           $('.supplier_contact_person').text(data.supplier.supplier_contact_person);
           $('.office_number').text(data.supplier.office_number);
           $('.home_number').text(data.supplier.home_number);
           $('.mobile_number').text(data.supplier.mobile_number);
           $('.tin').text(data.supplier.tin_number);
           $('.fax_number').text(data.supplier.fax_number);
           var company_list = [];
           $.each(data.company, function(key,val){
             company_list.push(val.company_name);
             // console.log(val);
           });
           $('.company').text(company_list.join(', '));

       }
     })
   })

   //edit supplier
   $(document).on('click', '.editSupplier', function(){
     var id = $(this).attr('data-id');
     $('.editcompany').attr('data-comp_id', $(this).data('comp'));
     $.ajax({
         url: base_url+'supplier/supplier_details',
         data: {id:id},
         type: 'post',
         dataType: 'json',
         success: function(data){
           $('#editSupplier').modal('show');
           console.log(data);
             $('#editSupplier input[name=supplier_name]').val(data.view_edit.supplier_name);
             $('#editSupplier input[name=supplier_contact_person]').val(data.view_edit.supplier_contact_person);
             // $('#editSupplier select[name=company[]').val(data.view_edit.company);
             $('#editSupplier input[name=office_number]').val(data.view_edit.office_number);
             $('#editSupplier input[name=home_number]').val(data.view_edit.home_number);
             $('#editSupplier input[name=mobile_number]').val(data.view_edit.mobile_number);
             $('#editSupplier input[name=tin_number]').val(data.view_edit.tin_number);
             $('#editSupplier input[name=fax_number]').val(data.view_edit.fax_number);
             // $('#editSupplier select[name=position]').val(data.view_edit.position);
         }
     });

   });
   // end edit supplier

   //successfully edit supplier
   $(document).on('submit','#editSupplier',function(e){
     e.preventDefault();
     let formData =  new FormData($(this)[0]);
     var id = $('.editSupplier').attr('data-id');
      var comp_id = $(this).attr('comp_id');
      alert(comp_id);
     console.log(id);
     formData.append("id",id);
     $.ajax({
         method: 'POST',
         url : base_url + 'supplier/editSupplier',
         data : formData,
         processData: false,
        contentType: false,
        cache: false,
         dataType: 'json',
         success : function(data) {
             console.log(data);
             if(data.status == "ok"){
               $('#editSupplier').modal('hide');
                   Swal.fire("Successfully updated supplier!",data.success, "success");
                  $(".suppliers_tbl").DataTable().ajax.reload();
              }else if(data.status == 'invalid'){
                 Swal.fire("Error",data.status, "invalid");
              }
         }
     })
   });

   //edit Vehicle
   $(document).on('click', '.editVehicle', function(){
     var id = $(this).attr('data-id');
     $.ajax({
         url: base_url+'vehicle/vehicle_details',
         data: {id:id},
         type: 'post',
         dataType: 'json',
         success: function(data){
           $('#editVehicle').modal('show');
           console.log(data);
             $('#editVehicle input[name=plate_number]').val(data.view_edit.plate_number);
             $('#editVehicle input[name=supplier_contact_person]').val(data.view_edit.vehicles_brand);
             // $('#editVehicle input[name=company[]').val(data.view_edit.vehicles_type);
             $('#editVehicle input[name=fuel_type]').val(data.view_edit.fuel_type);
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
             $('#editVehicle input[name=material_desc]').val(data.view_edit.material_desc);
             // $('#editSupplier select[name=position]').val(data.view_edit.position);
         }
     });

   });

   //successfully edit vehicle
   $(document).on('submit','#editVehicle',function(e){
     e.preventDefault();
     let formData =  new FormData($(this)[0]);
     var id = $('.editVehicle').attr('data-id');
      var comp_id = $(this).attr('comp_id');
      alert(comp_id);
     console.log(id);
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
             console.log(data);
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

});


function clearError(){
    $('.err').text('');
}

function blankVal(){
  $('#addSupplier input[name="supplier_name"]').val('');
  $('.err').text('');
  $('#addSupplier input[name="supplier_contact_person"]').val('');
  $('#addSupplier select[name="vendor"]').val('');
  $('#addSupplier input[name="office_number"]').val('');
}
