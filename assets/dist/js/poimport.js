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
        })
    });
});
