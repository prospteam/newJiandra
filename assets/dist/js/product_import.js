var base_url = $('input[name="base_url"]').val();

$(document).ready(function () {
    $('#submit_import').on('submit', function (event) {
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
                    str += '<tr>';
                    for (var count = 0; count < data.column.length; count++) {
                        str += '<th>' + data.column[count] + '</th>';
                    }
                    str += '</tr>';
                }
                console.log(data.row_data);
                if (data.row_data) {
                    for (var count = 0; count < data.row_data.length; count++) {
                        str += '<tr>';
                        str += '<td class="code" contenteditable>' + data.row_data[count].code + '</td>';
                        str += '<td class="packing" contenteditable>' + data.row_data[count].packing + '</td></tr>';
                        str += '<td class="brand" contenteditable>' + data.row_data[count].brand + '</td></tr>';
                        str += '<td class="variance" contenteditable>' + data.row_data[count].variance + '</td></tr>';
                        str += '<td class="volume" contenteditable>' + data.row_data[count].volume + '</td></tr>';
                        str += '<td class="units" contenteditable>' + data.row_data[count].units + '</td></tr>';
                    }
                }
                str += '</table>';
                str += '<div align="center"><button type="button" id="import_data" class="btn btn-success">Import</button></div>';

                $('#csv_file_data').html(str);
                $('#submit_import')[0].reset();
            }
        })
    });

    // $(document).on('click', '#import_data', function () {
    //     var student_name = [];
    //     var student_phone = [];
    //     $('.student_name').each(function () {
    //         student_name.push($(this).text());
    //     });
    //     $('.student_phone').each(function () {
    //         student_phone.push($(this).text());
    //     });
    //     $.ajax({
    //         url: "import.php",
    //         method: "post",
    //         data: { student_name: student_name, student_phone: student_phone },
    //         success: function (data) {
    //             $('#csv_file_data').html('<div class="alert alert-success">Data Imported Successfully</div>');
    //         }
    //     })
    // });
});
