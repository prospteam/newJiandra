var base_url = $('input[name="base_url"]').val();

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

                var str = '<table class="table table-bordered table-striped dataTable">';
                if (data.column) {
                    str += '<thead>';
                    for (var count = 0; count < data.column.length; count++) {
                        str += '<th>' + data.column[count] + '</th>';
                    }
                    str += '</thead>';
                }
                // console.log(data.column);


                if (data.row_data) {
                    let row = data.row_data;

                    $.each(row,function(key,value){
                        console.log(value);
                        str += '<tbody>'
                            str += '<tr>';
                                str += '<td class="code" contenteditable>' + value.code + '</td>';
                                str += '<td class="packing" contenteditable>' + value.Packing + '</td>';
                                str += '<td class="brand" contenteditable>' + value.Brand + '</td>';
                                str += '<td class="variance" contenteditable>' + value.Variance + '</td>';
                                str += '<td class="volume" contenteditable>' + value.Volume + '</td>';
                                str += '<td class="units" contenteditable>' + value.Units + '</td>';
                            str+= '</tr>';
                        str+= '</tbody>'
                    }); 
                }
                str += '</table>';
                str += '<div align="center"><button type="button" id="import_data" class="btn btn-success">Import</button></div>';

                $('#csv_data').html(str);
                $('#submit_import')[0].reset();
            }
        })
    });

});
