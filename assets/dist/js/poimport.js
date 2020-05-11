var base_url = $('input[name="base_url"]').val();

$(document).ready(function () {
    $('#submit_po_import').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: base_url + 'poimport/po_import',
            method: 'POST',
            data:new FormData(this),
            dataType:'json',
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){

                let html = '<table class="table table-striped table-bordered">';

                if(data.column){
                    html += '<tr>';
                    for (var i = 0; i < data.column.length; i++) {
                        html += '<th>'+data.column[i]+'</th>';
                    }
                    html += '</tr>';
                }

                if (data.row_data) {
                    let row = data.row_data;

                    $.each(row,function(key,value){
                        console.log(value);
                        html += '<tbody>'
                            html += '<tr>';
                                html += '<td class="date_order" contenteditable>' + value['Date Order'] + '</td>';
                                html += '<td class="puchase_order" contenteditable>' + value['Purchase Code'] + '</td>';
                                html += '<td class="product" contenteditable>' + value['Product'] + '</td>';
                                html += '<td class="quantity" contenteditable>' + value['Quantity'] + '</td>';
                                html += '<td class="price" contenteditable>' + value['Price'] + '</td>';
                            html+= '</tr>';
                        html+= '</tbody>'
                    });
                }

                html += '</table>';
                html += '<div align="center"><button type="button" id="import_data" class="btn btn-success">Import</button></div>';

                $('#csv_file_data').html(html);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                Swal.fire("Please upload correct CSV format",'', "error")
                .then((result) => {
                  location.reload();
                });
            }
        })
    });

    $(document).on('click', '#import_data', function(){
        var date_order = [];
        var puchase_order = [];
        var product = [];
        var quantity = [];
        var price = [];

        $('.date_order').each(function(){
            date_order.push($(this).text());
        });

        $('.puchase_order').each(function(){
            puchase_order.push($(this).text());
        });

        $('.product').each(function(){
            product.push($(this).text());
        });

        $('.quantity').each(function(){
            quantity.push($(this).text());
        });

        $('.price').each(function(){
            price.push($(this).text());
        });

        $.ajax({
            url: base_url + 'poimport/submit_import',
            method: "POST",
            data: {date_ordered:date_order,
                    purchase_code:puchase_order,
                    product: product,
                    quantity: quantity,
                    unit_price: price
                },
            success: function(data){
                if($("[name='csv_file_pos']").get(0).files.length === 0){
                     Swal.fire("Please select CSV file",'', "error");
                }else{
                    Swal.fire("CSV File Successfully imported!",'', "success")
                    .then((result) => {
                      location.reload();
                    });
                }
            }
        });

    });
});
