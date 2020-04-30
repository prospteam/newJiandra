var base_url = $('input[name="base_url"]').val();
$(document).ready(function () {


   // ADD PRODUCTS
   $(document).on('submit', 'form#addproduct', function (e) {
      e.preventDefault();
      let formData = $(this).serialize();

      $.ajax({
         method: 'POST',
         url: base_url + 'products/addproducts',
         data: formData,
         dataType:'json',
         success: function (response) {
             console.log(response);
             if (response.status==true) {
              Swal.fire("Successfully added products!", 'Success', "success")
              .then((result) => {
                location.reload();
              });
              blankVal_products();
          }else {
                for (var i = 0; i < response.return.input_name.length; i++) {
                    console.log( response.return.input_name[i], response.return.input_error[i]);
                    $("input[name="+response.return.input_name[i]+"]").css('border-color', 'red');
                }
                Swal.fire("Pleaes fill out all fields", 'Error', "error");
          }
            $(".products_tbl").DataTable().ajax.reload();
         }
      });
   });
   // END ADD PRODUCTS

   $(document).on('submit','#add_costPrice', function (e){
       e.preventDefault();

       var product_id = $('.add_new_cost_btn').attr('data-id');

       var formData =  new FormData($(this)[0]);
        formData.append('product_id', product_id);
       $.ajax({
           url: base_url+'products/add_cost_price',
          type: 'POST',
          data: formData,
          processData:false,
          contentType: false,
          dataType: 'json',
          success: function (response) {
              console.log(response);
              if (response.status == 'ok') {
                  blankVal_products();
                  Swal.fire("Successfully added New Cost Price!",'Success', "success");
                  $('#add_cost_price').modal('hide');
                  $(`.costprice[data-id='${product_id}']`).trigger('click');
              }else {
                  console.log(response);
              }
          }
      });
   });
   // view all products
   $(document).on("click", ".viewproducts", function () {
      var id = $(this).attr('data-id');
      $.ajax({
         method: 'POST',
         url: base_url + 'products/view_all_products',
         data: { id: id },
         dataType: "json",
         success: function (data) {
            console.log(data);
            $('#viewproducts').modal('show');
            $('.code').text(data.products.code);
            $('.volume').text(data.products.volume);
            $('.unit').text(data.products.unit);
            $('.packing').text(data.products.packing);
            $('.brand').text(data.products.brand);
            $('.product_name').text(data.products.product_name);
            $('.category').text(data.products.category);
            $('.variant').text(data.products.variant);
            $('.supplier').text(data.products.supplier_name);
            $('.description').text(data.products.description);
         }
      })

   });
   // end view all products

   // edit Products
   $(document).on("click", ".editproducts", function () {
      var id = $(this).attr('data-id');
      $.ajax({
         method: 'POST',
         url: base_url + 'products/view_all_products',
         data: { id: id },
         dataType: "json",
         success: function (data) {
             console.log(id);
            $('#editProducts').modal('show');
            $('#editProducts input[name="products_id"]').val(data.products.id);
            $('#editProducts #product_name1').append('<option value=' + data.products.product_name + ' selected>' + data.products.product_name + '</option>')
            $('#editProducts #brand1').append('<option value=' + data.products.brand + ' selected>' + data.products.brand + '</option>')
            $('#editProducts .editproducts_id').val(id);
            $('#editProducts input[name="code"]').val(data.products.code);
            // $('#editProducts .supplier]').val(data.products.code);
            $('#editProducts select[name="supplier_edit"]').val(data.products.supplier);
            // $('#editProducts select[name="supplier_edit"]').trigger('change');
            $('#editProducts #category1').append('<option value=' + data.products.category + ' selected>' + data.products.category + '</option>')
            $('#editProducts #variant1').append('<option value=' + data.products.variant + ' selected>' + data.products.variant + '</option>')
            $('#editProducts #volume1').append('<option value=' + data.products.volume + ' selected>' + data.products.volume + '</option>')
            $('#editProducts #packing1').append('<option value=' + data.products.packing + ' selected>' + data.products.packing + '</option>')
            $('#editProducts #unit1').append('<option value=' + data.products.unit + ' selected>' + data.products.unit + '</option>')
            $('#editProducts textarea[name="description"]').val(data.products.description);
         }
      });

   });
   // end edit Products
   $(document).on('click', '.edit_cost', function() {
       var id = $(this).attr("data-id");
       // alert('hih');
       $.ajax({
           method: 'POST',
           url: base_url+'products/cost_sell_edit',
           data: {id:id},
           dataType: 'json',
           success: function(data){
               console.log('asdf');
                console.log(data);
               $('#edit_cost_price').modal('show');
               $('#edit_cost_price .edit_cost_sell_price_id').val(data.cost_price[0].cost_id);
               $('#edit_cost_price input[name="cost_price_edit"]').val(data.cost_price[0].cost_price);
               $('#edit_cost_price input[name="sell_price_edit"]').val(data.cost_price[0].sell_price);
               $('#edit_cost_price input[name="effective_date_edit"]').val(data.cost_price[0].effective_date);
           }
       });
   });
   // Edit Cost Price

   // END Edit Cost Price
      $(document).on("click", ".costprice", function () {
         var id = $(this).attr("data-id");
          $('.add_new_cost_btn').attr('data-id', id);
         // product_id
         $('#view_cost_price').modal('show')
         var str = '';
         $.ajax({
            method: 'POST',
            url: base_url + 'products/cost_sell_tbl',
            data: { id: id },
            dataType: "json",
            success: function (data) {
               console.log(data);

               if (data.cost_price.length === 0) {
                      str += '<tr>';
                      $('.no_products_found').show();
                         $('.prod_cost_name').text('No Price Available');
                      str+= '<td class= "purch_td">';
                      str = " ";
                      str += '</td>';
                      str += '</tr>';
               }else{
                   $.each(data.cost_price,function(index,element){
                       $('.prod_cost_name').text(element.volume +''+ element.unit + '/'+ element.packing +'/'+ element.brand +'/'+element.product_name);
                       $('.no_products_found').hide();
                       str += '<tr>';
                           str+= '<td class= "purch_td">';
                               str+='<span class="peso_sign" style="color:#9f8e8e;">₱</span>'+' '+element.cost_price;
                           str+= '</td>';
                           str+= '<td class="purch_td">';
                               str+= '<span class="peso_sign" style="color:#9f8e8e;">₱</span>'+' '+element.sell_price;
                           str+= '</td>';
                           str+= '<td class="purch td">';
                               str+= element.effective_date;
                           str+= '</td>';
                           str+= '<td class="purch_td">'
                               str += '<a href="javascript:;" class="btn btn-xs btn-primary edit_cost" data-id="'+ element.cost_id +'"><i class="fa fa-edit"></i></a>';
                               str += '<a href="javascript:;" class="btn btn-xs btn-danger delete_cost" data-id="'+element.cost_id +'"><i class="fa fa-trash"></i></a>';
                           str+= '</td>'
                       str+= '</tr>';
                   });
               }
               $('#add_new_cost_price tbody').html(str);
            }

        });
      });

   // add cost price
   $(document).on("click", ".add_new_cost_btn", function () {
      var id = $(this).attr("data-id");
      console.log($(this).data("id"));
      console.log($(this).data());
      $('#add_cost_price').modal('show')
   });

   // end add cost price
   $(document).on('submit', '#edit_costPrice', function(e){
       e.preventDefault();

       let formData = new FormData($(this)[0]);
       var id = $('input[name="cost_sell_price_id_edit"]').val();
       formData.append("id", id);

       $.ajax({
           method: 'POST',
           url: base_url+'products/edit_cost_sell_price',
           data: formData,
           processData: false,
           contentType: false,
           cache: false,
           dataType: 'json',
           success: function(data){
               console.log(id);
               if (data.status == 'ok') {
                   console.log(data.success);
                   Swal.fire("Cost Price has been Updated!", data.success, 'success');
                    location.reload();

               }else {
                   Swal.fire("Error!", data.status, 'invalid');
               }
           }
       })
   });

   // successfully edit user
   $(document).on('submit', '#editproducts_form', function (e) {
      e.preventDefault();

      let formData = new FormData($(this)[0]);
      var id = $('input[name="products_edit_id"]').val();
      formData.append("id", id);
      $.ajax({
         method: 'POST',
         url: base_url + 'products/edit_products',
         data: formData,
         processData: false,
         contentType: false,
         cache: false,
         dataType: 'json',
         success: function (data) {
             console.log(id);
            if (data.status == "ok") {
               $('#editProducts').modal('hide');
               Swal.fire("Product has been updated!", data.success, "success");
               $(".products_tbl").DataTable().ajax.reload();
            } else if (data.status == 'invalid') {
               Swal.fire("Error", data.status, "invalid");
            }
         }
      })
   });

});
// end successfully edit user
    $(document).on("click", '.delete_cost', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to permanently delete this Price!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#068101',
            confirmButtonText: 'Yes, Permanently Delete Price!',
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                   'Deleted!',
                   'Successfully Deleted Product!',
                   'success'
                )
                location.reload();
                $.ajax({
                   type: 'POST',
                   url: base_url + 'products/delete_price',
                   data: { id: id },
                   success:
                   function (data) {
                   }
                })
            }
        });

    });

// delete Products
$(document).on("click", '.deleteproducts', function (e) {
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
      confirmButtonText: 'Yes, Permanently Delete Product!',
   }).then((result) => {
      if (result.value) {
         Swal.fire(
            'Deleted!',
            'Successfully Deleted Product!',
            'success'
         )
         $.ajax({
            type: 'POST',
            url: base_url + 'products/deleteProducts',
            data: { id: id },
            success: function (data) {
               $(".products_tbl").DataTable().ajax.reload();
            }
         })
      }
   });

});
// DISABLED PRODUCTS
$(document).on("click", ".disableproducts", function (e) {
   e.preventDefault();
   var id = $(this).attr('data-id');
   console.log(id);

   Swal.fire({
      title: 'Are you sure?',
      text: "You want to disable this Product!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#068101',
      confirmButtonText: 'Yes, Disable Product!'
   }).then((result) => {
      if (result.value) {
         Swal.fire(
            'Disabled!',
            'Successfully Disabled Product!',
            'success'
         )
         $.ajax({
            type: 'POST',
            url: base_url + 'products/disable_products',
            data: { id: id },
            success: function (data) {
               $(".products_tbl").DataTable().ajax.reload();
            }
         })
      }
   });
});
// DISABLED PRODUCTS

// enabled products
$(document).on("click", ".enableproducts", function (e) {
   e.preventDefault();
   var id = $(this).attr('data-id');
   console.log(id);

   Swal.fire({
      title: 'Are you sure?',
      text: "You want to enable this Product!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#068101',
      confirmButtonText: 'Yes, Enable Product!'
   }).then((result) => {
      if (result.value) {
         Swal.fire(
            'Disabled!',
            'Successfully Enable Product!',
            'success'
         )
         $.ajax({
            type: 'POST',
            url: base_url + 'products/enable_products',
            data: { id: id },
            success: function (data) {
               $(".products_tbl").DataTable().ajax.reload();
            }
         })
      }
   });
});

// End Enabled Products

// DISPLAY Products

var products_tbl = $('.products_tbl').DataTable({
    "responsive": true,
   "processing": true,
   "serverside": true,
   "order": [[0, 'desc']],
   "columns": [
      { "data": "code" },
      { "data": "supplier_name" },
      // { "data": "brand" },
      // { "data": "category" },
      // {"data":"variant"},
      // // {"data":"description"},
      // {"data":{'volume'}},
      {
         "data": "description", "render": function (data, type, row, meta) {
            var str = '';
            str = row.volume +''+ row.unit + '/'+ row.packing +'/'+ row.brand +'/'+row.product_name;
            return str;
         }
      },
      // {"data":"unit"},;
      // console.log(row);
      {
         "data": "action", "render": function (data, type, row, meta) {
            var str = '';
            str += '<div class="actions">';
            if (row.status == 1) {
               str += '<a href="javascript:;" class="costprice" data-id="' + row.id + '"><abbr title="Add Cost Price"><i class="fas fa-coins"></abbr></i></a>';
               str += '<a href="javascript:;" class="viewproducts" data-id="' + row.id + '"><abbr title="View Products"><i class="fas fa-eye text-info"></i></abbr></a>';
               str += '<a href="javascript:;" class="editproducts" data-id="' + row.id + '"><abbr title="Edit Products Supplier"><i class="fas fa-pen text-warning"></i></abbr></a>';
               str += '<a href="javascript:;" class="disableproducts" data-id="' + row.id + '"><abbr title="Disable Products"><i class="fa fa-window-close"></i></abbr></a>';
               str += '<a href="javascript:;" class="deleteproducts" data-id="' + row.id + '"><abbr title="Delete Products"><i class="fa fa-trash" aria-hidden="true"></abbr></a>';
            } else if (row.status == 2) {
               str += '<a href="javascript:;" class="viewproducts" data-id="' + row.id + '"><abbr title="View Products"><i class="fas fa-eye text-info"></i></abbr></a>';
               str += '<a href="javascript:;" class="enableproducts" data-id="' + row.id + '"><abbr title="Enable Products"><i class="fa fa-check-square"></i></abbr></a>';
               str += '<a href="javascript:;" class="deleteproducts" data-id="' + row.id + '"><abbr title="Delete Products"><i class="fa fa-trash" aria-hidden="true"></abbr></a>';
            }
            str += '</div>';
            return str;
         }
      },

      {
         "data": "status", "render": function (data, type, row, meta) {
            var str = '';
            if (row.status == 1) {
               str += '<span class="active btn btn-block btn-sm btn-success">active</button>';
            } else if (row.status == 2) {
               str += '<span class="inactive btn btn-block btn-sm btn-danger">inactive</button>';
            }
            return str;
         }
      }
   ],

   "ajax": {
      "url": base_url + "products/display_products/",
      "type": "POST"
   },
   //Set column definition initialisation properties.
   "columnDefs": [
      {
         "targets": [3, 4], //first column / numbering column
         "orderable": false, //set not orderable

      },
   ],
});
// END DISPLAY PRODUCTS
// End delete Products

    $('.js-example-basic-multiple-addproducts').select2({
       placeholder: "Enter Value",
       tags: [],
       ajax: {
          url: base_url + 'products/listofproducts_add',
          dataType: "json",
          type: "POST",
          quietMillis: 50,
          data: function (text) {
             return {
                searchfor: text,
                search_type: $(this).attr('data-type')
             };
          }, processResults: function (data) {

             return {
                results: $.map(data.items, function (item) {
                   return {
                      text: item.product_name,
                      id: item.product_id
                   }
                })
             };
          }
       }
    });

    $('.js-example-basic-multiple-editproducts').select2({
       placeholder: "Enter Value",
       tags: [],
       ajax: {
          url: base_url + 'products/listofproducts_edit',
          dataType: "json",
          type: "POST",
          quietMillis: 50,
          data: function (text) {
             return {
                searchfor: text,
                search_type: $(this).attr('data-type')
             };
          }, processResults: function (data) {

             return {
                results: $.map(data.items, function (item) {
                   return {
                      text: item.product_name,
                      id: item.product_id
                   }
                })
             };
          }
       }
    });

function clearError() {
   $('.err').text('');
}
function blankVal_products() {
   $('#AddProducts input[name="code"]').val('');
   $('.err').text('');
   $('#AddProducts .js-example-basic-multiple-addproducts').val('').trigger('change');
   // $('#AddProducts input[name="brand"]').val('');
   // $('#AddProducts input[name="category"]').val('');
   $('#AddProducts input[name="variant"]').val('');
   $('#AddProducts input[name="packing"]').val('');
   $('#AddProducts select[name="supplier"]').val('');
   $('#AddProducts input[name="volume"]').val('');
   // $('#AddProducts input[name="unit"]').val('');
   $('#AddProducts textarea[name="description"]').val('');
   $('#add_cost_price input[name="cost_price"]').val('');
   $('#add_cost_price input[name="sell_price"]').val('');
   $('#add_cost_price input[name="effective_date"]').val('');
}
