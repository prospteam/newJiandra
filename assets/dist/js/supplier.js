$(document).ready(function() {
  $(".company2").click(function() {
    $("#example2").show();
    $("#example1").hide();
  });
  $(".company1").click(function() {
    $("#example1").show();
    $("#example2").hide();
  });
});

$('#addSupplier form').on('submit', function(e) {
  e.preventDefault();
  $.ajax({
    url: $(this).attr('action'),
    method: 'POST',
    data: $(this).serialize(),
    dataType: 'json',
    success: function(result) {
      $('#addSupplier form')[0].reset();
      Swal.fire(result.title, result.msg, result.type);
      setTimeout(function(){
         location.reload();
       }, 1000);
    }
  });
});
