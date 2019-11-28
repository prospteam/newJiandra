// PRODUCTS---------------------PRODUCTS---------------------PRODUCTS---------------------PRODUCTS---------------------PRODUCTS---------------------PRODUCTS---------------------PRODUCTS

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
          // {"data":"variant"},
          // {"data":"description"},
          {"data":"price"},
          {"data":"volume"},
          {"data":"action","render": function(data, type, row,meta){
                            var str = '';
                            str += '<div class="actions">';
                            // if(row.status == 1){

                              str += '<a href="javascript:;" class="viewproducts" data-id="'+row.id+'"> <i class="fas fa-eye text-info"></i></a>';
                              str += '<a href="javascript:;" class="editproducts" data-id="'+row.id+'"><i class="fas fa-pen text-warning"></i></a>';
                              str += '<a href="javascript:;" class="deleteproducts" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';
                            // }
                            // }else if(row.status == 2){
                            //   str += '<a href="javascript:;" class="enableUser" data-id="'+row.id+'"><i class="fa fa-check-square"></i></a>';
                            //   str += '<a href="javascript:;" class="deleteUser" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';
                            // }
                            str += '</div>';
                            return str;
                       }
                  },

            {"data":"status","render": function(data, type, row,meta){
                    var str = '';
                     // if(row.status == 1){
                       str += '<span class="active btn btn-block btn-sm btn-success">active</button>';
                     // }else if(row.status == 2){
                     //   str += '<span class="inactive btn btn-block btn-sm btn-danger">inactive</button>';
                     // }
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
                   "targets": [5,6], //first column / numbering column
                   "orderable": false, //set not orderable

               },
          ],
      });
// END DISPLAY PRODUCTS
// view all products
    $(document).on("click",".viewproducts",function(){
      var id =  $(this).attr('data-id');
      $.ajax({
          method: 'POST',
          url: base_url+'products/view_all_products',
          data: {id:id},
          dataType:"json",
          success: function(data){
            console.log(data);
            $('#viewproducts').modal('show');

            $('.code').text(data.products.code);
            $('.brand').text(data.products.brand);
            $('.category').text(data.products.category);
            $('.variant').text(data.products.variant);
            $('.description').text(data.products.description);
            $('.price').text(data.products.price);
            $('.volume').text(data.products.volume);
          }
      })

    });
// end view all products

// edit Products
$(document).on("click",".editproducts", function(){
  var id = $(this).attr('data-id');

  $.ajax({
      method: 'POST',
      url: base_url+'products/view_all_products',
      data: {id:id},
      dataType: "json",
      success: function(data){
        $('#editProducts').modal('show');
        $('#editProducts input[name="products_id"]').val(data.products.id);
        $('#editProducts input[name="code"]').val(data.products.code);
        $('#editProducts input[name="brand"]').val(data.products.brand);
        $('#editProducts input[name="category"]').val(data.products.category);
        $('#editProducts input[name="variant"]').val(data.products.variant);
        $('#editProducts input[name="description"]').val(data.products.description);
        $('#editProducts input[name="price"]').val(data.products.price);
        $('#editProducts input[name="volume"]').val(data.products.volume);

        }
  });

});
// end edit Products

// delete Products

$(document).on("click",'.deleteproducts', function(e) {
  e.preventDefault();
  var id = $(this).attr('data-id');
  console.log(id);

  Swal.fire({
  title: 'Are you sure?',
  text: "You want to permanently delete this Product!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#d33',
  cancelButtonColor: '#068101',
  confirmButtonText: 'Yes, Permanently Delete Product!'
  }).then((result) => {
    if (result.value) {
      Swal.fire(
        'Deleted!',
        'Successfully Deleted Product!',
        'success'
      )
        $.ajax({
        type: 'POST',
          url:base_url + 'products/deleteProducts',
          data: {id: id},
          success:function(data) {
            $(".suppliers_tbl").DataTable().ajax.reload();
          }
        })
    }
  })
});
// End delete Products


function blankVal_products(){
$('#AddProducts input[name="code"]').val('');
$('#AddProducts input[name="brand"]').val('');
$('#AddProducts input[name="category"]').val('');
// $('#AddProducts input[name="variant"]').val('');
// $('#AddProducts input[name="description"]').val('');
$('#AddProducts input[name="price"]').val('');
$('#AddProducts input[name="volume"]').val('');
}
