var base_url = $('input[name="base_url"]').val();

// import products
$(document).ready(function () {
    $('#submit_import').on('submit', function (event) {
        // alert('hehe');
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: base_url + 'ProductsImport/prod_import',
            method: "POST",
            data: formData,
            dataType: 'json',
            contentType: false,
            enctype: 'multipart/form-data',
            cache: false,
            processData: false,
            success: function (data) {
                var str = '';
                str += '<form id="addproducts" method="post">'
                    str+= '<table class="table table-bordered table-striped dataTable">';
                            if (data.column) {
                                str += '<thead>';
                                for (var count = 0; count < data.column.length; count++) {
                                    str += '<th>' + data.column[count] + '</th>';
                                }
                                str += '</thead>';
                            }
                            if (data.row_data) {
                                let row = data.row_data;

                                $.each(row,function(key,value){
                                    console.log(value);
                                    str += '<tbody>'
                                        str += '<tr>';
                                            str += '<td class="code" contenteditable>' + value.code + '</td>';
                                            str += '<td class="packing" contenteditable>' + value.Packing + '</td>';
                                            str += '<td class="brand" contenteditable>' + value.Brand + '</td>';
                                            str += '<td class="variant" contenteditable>' + value.Variance + '</td>';
                                            str += '<td class="volume" contenteditable>' + value.Volume + '</td>';
                                            str += '<td class="unit" contenteditable>' + value.Units + '</td>';
                                        str+= '</tr>';
                                    str+= '</tbody>'
                            });
                            str += '<div align="center"> <button type="submit" class="btn btn-primary add">Submit</button></div>';
                        }
                        str += '</table>';
                        str+= '</form>'


                $('#csv_file_data').html(str);
                $('#submit_import')[0].reset();
            }
        })
    });

});

// submit products
$(document).on('submit', 'form#addproducts', function (e) {
    // alert("test");
   e.preventDefault();
   let formData = $(this).serialize();

   $.ajax({
      method: 'POST',
      url: base_url + 'productsimport/addproducts',
      data: formData,
      dataType:'json',
      success: function (response) {
          console.log(response);
          if (response.status==true) {
           Swal.fire("Successfully added to products!", 'Success', "success");
           blankVal_products();
       }else {
             for (var i = 0; i < response.return.input_name.length; i++) {
                 console.log( response.return.input_name[i], response.return.input_error[i]);
                 $("input[name="+response.return.input_name[i]+"]").css('border-color', 'red');
             }
       }
         $(".products_tbl").DataTable().ajax.reload();
      }
   });
});
