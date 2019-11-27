// ADD PRODUCTS
$(document).on('submit','form#addproducts',function(e){
  e.preventDefault();
  let formData = $(this).serialize();

  $.ajax({
      method: 'POST',
      url : base_url + 'products/addproducts',
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
                  // $("select[name='"+value+"']").next('.err').text(data.form_error[value]);
                  // $("select[name='"+value+"']").next().next().text(data.form_error[value]);
                  // $("select[name='"+value+"']").parents('.form-group').next('.err').text(data.form_error[value]);
              });
          }else if (data.error) {
              Swal.fire("Error",data.error, "error");
          }else {
             blankVal_products();
              $('#AddProducts').modal('hide');
              Swal.fire("Successfully added products!",data.success, "success");
              $(".products_tbl").DataTable().ajax.reload();
              // setTimeout(function(){
              //    location.reload();
              //  }, 1000);
          }
      }
  });
});
// END ADD PRODUCTS

// DISPLAY Products
  var products_tbl = $('.products_tbl').DataTable({
    "processing"  : true,
    "serverside"  : true,
    "order"       : [[0,'desc']],
    "columns"     :[
          {"data":"code"},
          {"data":"brand"},
          {"data":"category"},
          {"data":"variant"},
          {"data":"description"},
          {"data":"price"},
          {"data":"volume"},
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

          "ajax": {
              "url":base_url+"products/display_products/",
              "type": "POST"
         },
         //Set column definition initialisation properties.
         "columnDefs": [
              {
                   "targets": [0,0], //first column / numbering column
                   "orderable": false, //set not orderable

               },
          ],
      });


      function blankVal_products(){
      $('#AddProducts input[name="code"]').val('');
      $('#AddProducts input[name="brand"]').val('');
      $('#AddProducts input[name="category"]').val('');
      $('#AddProducts input[name="variant"]').val('');
      $('#AddProducts input[name="description"]').val('');
      $('#AddProducts input[name="price"]').val('');
      $('#AddProducts input[name="volume"]').val('');
      }
