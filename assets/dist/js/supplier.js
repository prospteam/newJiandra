var base_url = $('input[name="base_url"]').val();
$(document).ready(function(){
        $('.my-file').on('change',function(){

          var myfile = this.value;
          var str = myfile.split("\\");

          if(str[str.length-1]){
            $('.filechosen').html(str[str.length-1]);
          }else{
            $('.filechosen').html('No file chosen');
          }

         });

        function savesubcat(){
          return null
        }

        $('.f_btn').on('click', function(e){
              e.preventDefault();
              $(this).siblings().removeClass('active-click');
              $(this).addClass('active-click');
              display_suppliers('1');
        }) ;
        $('.s_btn').on('click', function(e){
              e.preventDefault();
              $(this).siblings().removeClass('active-click');
              $(this).addClass('active-click');
              display_suppliers('2');
        }) ;
        $('.t_btn').on('click', function(e){
              e.preventDefault();
              $(this).siblings().removeClass('active-click');
              $(this).addClass('active-click');
              display_suppliers('0');
        }) ;

        $('.t_btn').trigger('click');


  // add supplier
  $(document).on('submit','form#addsupplier',function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);
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
                    console.log(value);
                      $("input[name='"+value+"']").next('.err').text(data.form_error[value]);
                      $("select[name='"+value+"']").next().next().text(data.form_error[value]);
                  });
              }else if (data.error) {
                  Swal.fire("Error",data.error, "error");
              }else {
                 blankVal();
                  $('#addSupplier').modal('hide');
                  Swal.fire("Supplier has been added!", data.success, "success");
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
          'Disabled!',
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

  //end display suppliers

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
          'Deleted!',
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
           // console.log(data);
           $('.supplier_name').text(data.supplier.supplier_name);
           $('.supplier_contact_person').text(data.supplier.supplier_contact_person);
           $('.email').text(data.supplier.email);
           $('.office_number').text(data.supplier.office_number);
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
             $('#editSupplier input[name =supplier_name]').val(data.supplier.supplier_name);
             $('#editSupplier input[name=supplier_contact_person]').val(data.supplier.supplier_contact_person);
             $('#editSupplier input[name=email]').val(data.supplier.email);
             var company_list = [];
             $('#editSupplier .js-example-basic-multiple-edit').html('');

             $.each(data.company, function(key,val){
               company_list.push(val.company_name);
               $('#editSupplier .js-example-basic-multiple-edit').append( '<option value='+val.company_id+' selected>'+val.company_name+'</option>' );
             });

             $('#editSupplier input[name=office_number]').val(data.supplier.office_number);
             $('#editSupplier input[name=tin_number]').val(data.supplier.tin_number);
             $('#editSupplier input[name=fax_number]').val(data.supplier.fax_number);
             $('#editSupplier .filechosen').text(data.supplier.supplier_logo);

         }
     });

   });
   // end edit supplier

   //successfully edit supplier
   $(document).on('submit','#editSupplier',function(e){
     e.preventDefault();

     let formData =  new FormData($(this)[0]);
     var id = $('.editSupplier').attr('data-id');
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



});

function display_suppliers($supplier_id){
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
             {"data":"email"},
             {"data":"action","render": function(data, type, row,meta){
                       var str = '';
                       str += '<div class="actions">';
                       if(row.status == 1){
                         str += '<a href="javascript:;" class="viewSupplier" data-id="'+row.id+'"> <i class="fas fa-eye text-info"></i></a>';
                         str += '<a href="javascript:;" class="editSupplier" data-id="'+row.id+'"><i class="fas fa-pen text-warning"></i></a>';
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
                    str += '<span class="active btn btn-block btn-sm btn-success">active</button>';
                  }else if(row.status == 2){
                    str += '<span class="active btn btn-block btn-sm btn-danger">active</button>';
                  }
                  return str;
             }
           }

        ],
        // Load data for the table's content from an Ajax source
        "ajax": {
             "url":base_url+"supplier/display_suppliers/"+$supplier_id,
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


}

function clearError(){
    $('.err').text('');
}

function blankVal(){
  $('#addSupplier input[name="supplier_name"]').val('');
  $('.err').text('');
  $('#addSupplier input[name="supplier_contact_person"]').val('');
  $('#addSupplier input[name="email"]').val('');
  $('#addSupplier select[name="company[]"]').val('');
  $('#addSupplier input[name="office_number"]').val('');
  $('#addSupplier input[name="tin_number"]').val('');
  $('#addSupplier input[name="fax_number"]').val('');
  $('#addSupplier .filechosen').val();

}
