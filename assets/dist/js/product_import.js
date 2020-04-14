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
                    str += '<tbody>'
                    var length = Object.keys(data.row_data).length;
                    for (var count = 0; count < data.row_data; count++) {
                            str += '<tr>';
                                str += '<td class="code" contenteditable>' + data.row_data[count].code + '</td>';
                                str += '<td class="packing" contenteditable>' + data.row_data[count].Packing + '</td>';
                                str += '<td class="brand" contenteditable>' + data.row_data[count].Brand + '</td>';
                                str += '<td class="variance" contenteditable>' + data.row_data[count].Variance + '</td>';
                                str += '<td class="volume" contenteditable>' + data.row_data[count].Volume + '</td>';
                                str += '<td class="units" contenteditable>' + data.row_data[count].Units + '</td>';
                            str+= '</tr>';
                    }
                    str+= '</tbody>'
                    console.log(Object.keys(data.row_data).length);
                }
                str += '</table>';
                str += '<div align="center"><button type="button" id="import_data" class="btn btn-success">Import</button></div>';

                $('#csv_file_data').html(str);
                $('#submit_import')[0].reset();
            }
        })
    });

});
