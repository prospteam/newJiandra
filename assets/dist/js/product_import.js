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
                                            str += '<td class="code" contenteditable>' + value.Code + '</td>';
                                            str += '<td class="packing" contenteditable>' + value.Packing + '</td>';
                                            str += '<td class="brand" contenteditable>' + value.Brand + '</td>';
                                            str += '<td class="variant" contenteditable>' + value.Variance + '</td>';
                                            str += '<td class="volume" contenteditable>' + value.Volume + '</td>';
                                            str += '<td class="unit" contenteditable>' + value.Unit + '</td>';
                                            str += '<td class="prod_name" contenteditable>' + value.Product_Name + '</td>';
                                            str += '<td class="category" contenteditable>' + value.Category + '</td>';
                                            str += '<td class="supplier" contenteditable>' + value.Supplier + '</td>';
                                            str += '<td class="description" contenteditable>' + value.Description + '</td>';
                                            str += '<td class="status" contenteditable>' + value.Status + '</td>';
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
// $(document).on('submit', 'form#addproducts', function (e) {
//     alert("test");
//    e.preventDefault();
//    let formData = $(this).serialize();
//
//    $.ajax({
//       method: 'POST',
//       url: base_url + 'productsimport/addproducts',
//       data: formData,
//       dataType:'json',
//       success: function (response) {
//           console.log(response);
//           if (response.status==true) {
//            Swal.fire("Successfully added to products!", 'Success', "success");
//            blankVal_products();
//        }else {
//              for (var i = 0; i < response.return.input_name.length; i++) {
//                  console.log( response.return.input_name[i], response.return.input_error[i]);
//                  $("input[name="+response.return.input_name[i]+"]").css('border-color', 'red');
//              }
//        }
//          $(".products_tbl").DataTable().ajax.reload();
//       }
//    });
// });
$(document).on('click', 'form#addproducts', function(){
    var code = [];
    var packing = [];
    var brand = [];
    var variant = [];
    var volume = [];
    var unit = [];
    var prod_name = [];
    var category = [];
    var supplier = [];
    var description = [];
    var status = [];

    $('.code').each(function(){
        code.push($(this).text());
    });

    $('.packing').each(function(){
        packing.push($(this).text());
    });

    $('.brand').each(function(){
        brand.push($(this).text());
    });

    $('.variant').each(function(){
        variant.push($(this).text());
    });

    $('.volume').each(function(){
        volume.push($(this).text());
    });
    $('.unit').each(function(){
        unit.push($(this).text());
    });
    $('.prod_name').each(function(){
        prod_name.push($(this).text());
    });
    $('.category').each(function(){
        category.push($(this).text());
    });
    $('.supplier').each(function(){
        supplier.push($(this).text());
    });
    $('.description').each(function(){
        description.push($(this).text());
    });
    $('.status').each(function(){
        status.push($(this).text());
    });

    $.ajax({
        url: base_url + 'ProductsImport/addproducts',
        method: "POST",
        data: { code:code,
                packing:packing,
                brand: brand,
                variant: variant,
                volume: volume,
                unit: unit,
                product_name: prod_name,
                category: category,
                supplier: supplier,
                description: description,
                status: status,
            },
        // success: function(data){
        //     if($("[name='csv_import']").get(0).files.length === 0){
        //          Swal.fire("Please select CSV file",'', "error");
        //     }else{
        //         Swal.fire("Products Successfully Imported!",'', "success");
        //     }
        // }
    });

});
