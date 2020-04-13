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
                console.log(data)
                let html = '<table class="table table-striped table-bordered">';

                if(data.column){
                    html += '<tr>';
                    for (var i = 0; i < data.column.length; i++) {
                        html += '<th>'+data.column[i]+'</th>';
                    }
                    html += '</tr>';
                }

                if(data.row_data){
                        const object = data.row_data;
                        html += '<tr>';
                            for (const property in object){
                                html += '<td contenteditable>'+object[property]+'</td>';
                            }
                        html += '</tr>';
                }


                html += '<h1>'+data.row_data.date_ordered+'</h1>';

                html += '</table>';
                html += '<div align="center"><button type="button" id="import_data" class="btn btn-success">Import</button></div>';

                $('#csv_file_data').html(html);
            }
        })
    });
});
