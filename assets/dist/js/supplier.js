var base_url = $('input[name="base_url"]').val();
$(document).ready(function(){
  //display suppliers
    var suppliers_tbl = $('.suppliers_tbl').DataTable({
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
                        str += '<a href="javascript:;" class="viewSupplier" data-id="'+row.id+'"> <i class="fas fa-clone"></i></a>';
                        str += '<a href="javascript:;" class="editSupplier" data-id="'+row.id+'"><i class="fas fa-pen"></i></a>';
                        str += '<a href="javascript:;" class="deleteSupplier" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';
                        str += '</div>';
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
              "url":base_url+"supplier/display_suppliers/",
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
                  setTimeout(function(){
                     location.reload();
                   }, 1000);
              }
          }
      });
  });
  //end add supplier

  //delete suppplier
  $(document).on("click",'.deleteSupplier', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    console.log(id);

    Swal.fire({
    title: 'Are you sure?',
    text: "You want to delete this Suplier!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#068101',
    confirmButtonText: 'Yes, Delete Supplier!'
    }).then((result) => {
      if (result.value) {
        Swal.fire(
          'Deactivate!',
          'Successfully Deleted Supplier!',
          'success'
        )
          $.ajax({
          type: 'POST',
            url:base_url + 'supplier/deleteSupplier',
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

  //display Companies for add supplier
   $('.js-example-basic-multiple').select2({
     theme: "classic",
     allowClear: true,
     placeholder: "Select Company",
     dropdownParent: $('#addSupplier'),
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

   //display companies foe edit supplier
   // $('.js-example-basic-multiple').select2({
   //   theme: "classic",
   //   allowClear: true,
   //   placeholder: "Select Company",
   //   dropdownParent: $('#editSupplier'),
   //   tags: true,
   //   ajax: {
   //     url: base_url+'users/companies',
   //     dataType: "json",
   //     data: function (params) {
   //
   //    },processResults: function (data) {
   //
   //          return {
   //              results: $.map(data.companies, function (item) {
   //                  return {
   //                      text: item.company_name,
   //                      id: item.company_id
   //                  }
   //              })
   //          };
   //      }
   //   }
   // });

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

   //successfully added user
   $(document).on('submit','#editSupplier',function(e){
     e.preventDefault();
     let formData =  new FormData($(this)[0]);
     var id = $('.editSupplier').attr('data-id');
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
                   setTimeout(function(){
                      location.reload();
                    }, 1000);
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
