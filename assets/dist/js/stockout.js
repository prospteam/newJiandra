
var base_url = $('input[name="base_url"]').val();

$(document).ready(function(){

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
                               str += '<a href="javascript:;" class="deleteproducts" data-id="'+row.id+'"><i class="fa fa-trash" aria-hidden="true"></a>';
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
