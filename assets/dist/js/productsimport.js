var base_url = $('input[name="base_url"]').val();

// import products
$(document).ready(function () {
    $('#submit_import').on('submit', function (event) {
        // alert('hehe');
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: base_url + 'productsimport/prod_import',
            method: "POST",
            data: formData,
            dataType: 'json',
            contentType: false,
            enctype: 'multipart/form-data',
            cache: false,
            processData: false,
            success: function (data) {
                var str = '';
                str += '<form id="addproducts_csv" method="post">'
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
                                            str += '<td class="volume" contenteditable>' + value.Volume + '</td>';
                                            str += '<td class="unit" contenteditable>' + value.Unit + '</td>';
                                            str += '<td class="packing" contenteditable>' + value.Packing + '</td>';
                                            str += '<td class="brand" contenteditable>' + value.Brand + '</td>';
                                            str += '<td class="variant" contenteditable>' + value.Variant + 's</td>';
                                            str += '<td class="subvariant" contenteditable>' + value.Sub_Variant + '</td>';
                                            str += '<td class="prod_name" contenteditable>' + value.Product_Name + '</td>';
                                            str += '<td class="category" contenteditable>' + value.Category + '</td>';
                                            str += '<td class="supplier" contenteditable>' + value.Supplier + '</td>';
                                            str += '<td class="description" contenteditable>' + value.Description + '</td>';
                                            str += '<td class="weight" contenteditable>' + value.Weight + '</td>';
                                            str += '<td class="weightunit" contenteditable>' + value.Weight_Unit + '</td>';
                                            str += '<td class="cbm_length" contenteditable>' + value.CBM_Length + '</td>';
                                            str += '<td class="cbm_width" contenteditable>' + value.CBM_Width + '</td>';
                                            str += '<td class="cbm_height" contenteditable>' + value.CBM_Height + '</td>';
                                            str += '<td class="cbm_volume" contenteditable>' + value.CBM_Volume + '</td>';
                                            str += '<td class="status" contenteditable>' + value.Status + '</td>';
                                        str+= '</tr>';
                                    str+= '</tbody>'
                            });
                        }
                        str += '</table>';
                        str += '<div align="center"><button type="button" id="import_product" class="btn btn-success">Import</button></div>';
                        str+= '</form>'


                $('#csv_file_data').html(str);
                $('#submit_import')[0].reset();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                Swal.fire("Please upload correct CSV formatssss",'', "error")
                .then((result) => {
                  location.reload();
                });
            }
        })
    });


    $(document).on('click', '#import_product', function(){
        var code = [];
        var volume = [];
        var unit = [];
        var packing = [];
        var brand = [];
        var variant = [];
        var subvariant = [];
        var prod_name = [];
        var category = [];
        var supplier = [];
        var description = [];
        var weight = [];
        var weightunit = [];
        var cbm_length = [];
        var cbm_width = [];
        var cbm_height = [];
        var cbm_volume = [];
        var status = [];

        $('.code').each(function(){
            code.push($(this).text());
        });

        $('.volume').each(function(){
            volume.push($(this).text());
        });
        $('.unit').each(function(){
            unit.push($(this).text());
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
        $('.subvariant').each(function(){
            subvariant.push($(this).text());
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

        $('.weight').each(function(){
            weight.push($(this).text());
        });

        $('.weightunit').each(function(){
            weightunit.push($(this).text());
        });

        $('.cbm_length').each(function(){
            cbm_length.push($(this).text());
        });
        $('.cbm_width').each(function(){
            cbm_width.push($(this).text());
        });
        $('.cbm_height').each(function(){
            cbm_height.push($(this).text());
        });
        $('.cbm_volume').each(function(){
            cbm_volume.push($(this).text());
        });
        $('.status').each(function(){
            status.push($(this).text());
        });
        $.ajax({
            url: base_url + 'Productsimport/addproducts_csv',
            method: "POST",
            data: { code:code,
                    volume: volume,
                    unit: unit,
                    packing:packing,
                    brand: brand,
                    variant: variant,
                    subvariant: subvariant,
                    product_name: prod_name,
                    category: category,
                    supplier: supplier,
                    description: description,
                    weight: weight,
                    weightunit: weightunit,
                    cbm_length: cbm_length,
                    cbm_width: cbm_width,
                    cbm_height: cbm_height,
                    cbm_volume: cbm_volume,
                    status: status,
                },
            success: function(data){
                if($("[name='csv_import']").get(0).files.length === 0){
                    Swal.fire("Products Successfully Imported!",'', "success")
                    .then((result) => {
                      location.reload();
                    });
                }
            }
        });

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
