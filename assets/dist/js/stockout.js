
var base_url = $('input[name="base_url"]').val();

$(document).ready(function(){

   $(document).on("click",'.deletestockOut', function(e) {
     e.preventDefault();
     var stockmovement_tid = $(this).attr('data-id');
     console.log(stockmovement_tid);

     Swal.fire({
     title: 'Are you sure?',
     text: "You want to permanently delete this Stock Out!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#068101',
     confirmButtonText: 'Yes, Permanently Delete Stock Out!',
     }).then((result) => {
       if (result.value) {
         Swal.fire(
           'Deleted!',
           'Successfully Deleted Stock Out!',
           'success'
         )
           $.ajax({
           type: 'POST',
             url:base_url + 'Stockout/deletestockout',
             data: {stockmovement_tid: stockmovement_tid},
             success:function(data) {
               $(".stockout_tbl").DataTable().ajax.reload();
             }
           })
       }
     });

     });
     var stockout_tbl = $('.stockout_tbl').DataTable({
    "processing"  : true,
    "serverside"  : true,
    "order"       : [[0,'desc']],
    "columns"     :[
           {"data":"stockmovement_date"},
           {"data":"date_delivered"},
           {"data":"product"},
           {"data":"quantity"},
           {"data":"stockmovement_note"},

           {"data":"action","render": function(data, type, row,meta){
                             var str = '';
                             str += '<div class="actions">';
                             if(row.status == 1) {
                               str += '<a href="javascript:;" class="editproducts" data-id="'+row.id+'"><i class="fas fa-pen text-warning"></i></a>';
                               str += '<a href="javascript:;" class="deletestockOut" data-id="'+row.stockmovement_tid+'"><i class="fa fa-trash" aria-hidden="true"></a>';
                             }
                             str += '</div>';
                             return str;
                        }
                   },

             {"data":"status","render": function(data, type, row,meta){
                     var str = '';
                      if(row.status == 1){
                        str += '<span class="active btn btn-block btn-sm btn-success">active</button>';
                      }else if(row.status == 2){
                        str += '<span class="inactive btn btn-block btn-sm btn-danger">inactive</button>';
                      }
                      return str;
                 }
               }
           ],

           "ajax": {
               "url":base_url+"Stockout/disp_stockout/",
               "type": "POST"
          },
          //Set column definition initialisation properties.
          "columnDefs": [
               {
                    "targets": [5,6], //first column / numbering column
                    "orderable": false, //set not orderable

                },
           ],
       });
});
