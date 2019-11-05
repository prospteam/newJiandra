var base_url = $('.base_url').val();
var user_type = $('.user_type').val();

$(function(){
  $('.user-card').click(function(){
    var link = $(this).find('a').attr('href');
    // alert(link);
    window.location.href = link;
  });
  $(document).on('keyup','.search-emp',function(){
       var search = $(this).val();
       get_layout_data_nob(search,true);
 });


  // function startTimer(duration = 7200, display = $('#time')) {
  //   var timer = duration, minutes, seconds;
  //   var refresh = setInterval(function () {
  //       minutes = parseInt(timer / 60, 10)
  //       seconds = parseInt(timer % 60, 10);
  //
  //       minutes = minutes < 10 ? "0" + minutes : minutes;
  //       seconds = seconds < 10 ? "0" + seconds : seconds;
  //
  //       var output = minutes + " : " + seconds;
  //       display.text(output);
  //       $("title").html(output + " - TimerTimer");
  //
  //       if (--timer < 0) {
  //           display.text("Time's Up!");
  //           clearInterval(refresh);  // exit refresh loop
  //           var music = $("#over_music")[0];
  //           music.play();
  //           alert("Time's Up!");
  //       }
  //   }, 1000);
  //
  // }
  $(document).on('submit','.downloadForm',function(e){
     e.preventDefault();
     var formData = new FormData($(".downloadForm")[0]);
     $.ajax({
       url: base_url+"dashboard/download",
       method:"post",
       data : formData,
       cache: false,
      contentType: false,
          processData: false,
          dataType:'json',
       success:function(data)
       {
            var a = document.createElement('a');
              a.href = base_url+'assets/images/uploads/rawfiles/'+data.file;
              a.download = data.file;
              document.body.appendChild(a);
              a.click();
              document.body.removeChild(a);

              get_layout_data(false);
       }
     });
 });
  get_layout_data();


  $(document).on('submit','.downloadForm1',function(e){
     e.preventDefault();
     var formData = new FormData($(".downloadForm1")[0]);
     $.ajax({
       url: base_url+"download",
       method:"post",
       data : formData,
       cache: false,
      contentType: false,
          processData: false,
          dataType:'json',
       success:function(data)
       {
            // document.location = base_url+'assets/images/uploads/rawfiles/'+data.file;
            // window.location = base_url+'assets/images/uploads/rawfiles/'+data.file;

          var a = document.createElement('a');
            a.href = base_url+'assets/images/uploads/rawfiles/'+data.file;
            a.download = data.file;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            get_layout_data_nob({},false);
       }
     });
 });
  get_layout_data_nob();

  $("#downloadForm").validate({
		rules: {
			nob: "required"
		},
		messages: {
			nob: "required"
		}
	});

  //show login page on click
  $('.login_button').click(function(e){
    e.preventDefault();
    if($('.page_title .login_page').is(":visible")){
      $('.page_title .login_page').fadeOut();
      $(this).css({"border":"1px solid #ffffff ", "background":"#fff"});
      $('.login_button img').attr("src", base_url+"assets/images/lock.png");
    }
    else{
      $('.page_title .login_page').fadeIn();
      $(this).css({"border":"1px solid #1c76ff", "background":"#03152F"});
      $('.login_button img').attr("src",  base_url+"assets/images/lock-active.png");
    }
  });

  //show Logout on click
  $('.logout_button').click(function(e){
    e.preventDefault();
    if($('.account_controls').is(":visible")){
      $('.account_controls').fadeOut();
      $(this).css({"border":"1px solid #ffffff ", "background":"#fff"});
      $('.logout_button i').css("color","#444");
    }
    else{
      $('.account_controls').fadeIn();
      $(this).css({"border":"1px solid #1c76ff", "background":"#03152F"});
      $('.logout_button i').css("color","#fff");
    }
  });

  //Show download modal
  $(document).on('click', '.download', function(){
    var layout_id = $(this).attr('data-layout-id');
    $.ajax({
      url: base_url+"dashboard/get_dl_details",
      method:"post",
      data:{layout_id:layout_id},
      dataType:"json",
      success:function(data)
      {
           if(data.layout[0].cat_id == 1){

                $('#downloadTemplate').modal('show');
                $('#downloadTemplate').modal('show');
           }
        $('#downloadTemplate input[name=layout_id]').val($(this).attr('data-layout-id'));
        document.getElementById('title_test').innerHTML = data.layout[0].layout_name;
        document.getElementById('used-counter').innerHTML = $.strPad(data.layout[0].chosen_counter,4);
        $("#layout_id").val(data.layout[0].layout_id);
         $("#layout_file").val(data.layout[0].layout_file);

      }
    });
})

  // Pops download prompt on download button click
  $(document).on('click', '#downloadUser', function(e){
    e.preventDefault();
    var layout_id = $('#layout_id').val();
    var agent = $('#agent').val();
    var state = $('#state').val();
    var designer = $('#designer').val();
    $.ajax({
      url: base_url+"dashboard/get_dl_details",
      method:"post",
      data:{layout_id:layout_id,agent:agent,state:state,designer:designer},
      dataType:"json",
      success:function(data)
      {

         $('#downloadUserTemplate').modal('show');
        $('#downloadUserTemplate input[name=layout_id]').val($('#layout_id').val());

        document.getElementById('title_test1').innerHTML = data.layout[0].layout_name;

        $("#layout_id").val(data.layout[0].layout_id);
         $("#layout_file1").val(data.layout[0].layout_file);
         $("#agent1").val(agent);
         $("#state1").val(state);
         $("#designer1").val(designer);
      }
    });

  });

  // Pops download prompt on download button click
  $(document).on('click', '.downloadForm3', function(){
       var layout_id = $(this).attr('data-layout-id');
       $.ajax({
            url: base_url+"dashboard/get_dl_details",
           method:"post",
           data:{layout_id:layout_id},
           dataType:"json",
           success:function(data){
                  $('#downloadUserTemplate').modal('show');
                  $('#downloadUserTemplate input[name=layout_id]').val(layout_id);

                   document.getElementById('title_test1').innerHTML = data.layout[0].layout_name;

                  $("#layout_file1").val(data.layout[0].layout_file);
                  $("#agent1").val(0);
                  $("#state1").val(0);
                  $("#designer1").val(0);
           }
       });

  });



  // Edit Status
  $('#view-edit button').on('click', function(){
    $('.status-td').removeClass('disabled');
  });

  // On modal Hide
  $('#viewTemplate').on('hidden.bs.modal', function(){
    $('.status-td').addClass('disabled');
    // location.reload();
  });

  // Add LAYOUT
  $('.clickable').on('click', function(){
    cat = $(this).attr('data-category');
    location.href = base_url+'adminpanel/'+cat;
  });


  $('.clickAlertLogin').on('click', function(e){
      e.preventDefault();
      alertify.set('notifier','position','top-left');
      alertify.error("Please Log In");
      $('.login_button').trigger('click');
  });

  // Go back to where you belong
  $('.back_button').on('click', function(){
    window.history.go(-1);
  });

  $('.click-to-add').click(function(){
    $(this).next('.click-addupdate-layout').trigger('click');
  })

  $('#uploadModal .nob').on("change", function() {
    var nobid = $("#uploadModal .nob option:selected").val();
    var nobname = $("#uploadModal .nob option:selected").text().split(" ")[0].toUpperCase();
    var catid = $("#uploadModal .cat-id").val();
    var layout_id = $("#uploadModal .layout_id").val();
    set_template_name(catid, nobid, nobname, layout_id);
  });

$(document).on('click', '.click-addupdate-layout', function(){
    $('#uploadModal .custom_select').show();
    $('#uploadModal').modal("show");
    var layout_id = '';
    var temp_layout_id = $(this).attr('data-layout-id'); //update layout
    if( typeof temp_layout_id != 'undefined'){
      layout_id = temp_layout_id
    }
    data = {catid:$(this).attr('data-id'), layoutid:layout_id};
      $.ajax({
        url: base_url+"admin/get_update_data",
        data: data,
        type: 'POST',
        success: function(response){
          var parseData = JSON.parse(response);
          var nobStr = '';
          var nob_update = false; //applicable for update layout
          var nob_id = 0;
          if(parseData.request_type == 'upload'){
            if(parseData.nob.length > 0){
              nob_id = parseData.nob[0].nob_id;
            }
            set_template_name(parseData.cat_id, nob_id, parseData.layout_name);
            // else{
            //   console.log('test2');
            //   $('#uploadModal .layout-name').val(parseData.layout_name+parseData.template_id);
            // }

            if(parseData.nob.length > 0){
              for (var i = 0; i < parseData.nob.length; i++) {
                nobStr += '<option value="'+parseData.nob[i].nob_id+'">'+parseData.nob[i].nob_name+'</option>';
              }
              $('#uploadModal select[name=nob]').html(nobStr);
            }else{
              $('#uploadModal .nob').html('<option>Not available.</option>');
              $('#uploadModal .custom_select').hide();
            }

            $('#uploadModal .layout_id').val('');
          }else{
            // update
            nob_update = true;
            $('#uploadModal .layout_id').val(parseData.layout[0].layout_id);
            $('#uploadModal .layout-name').val(parseData.layout[0].layout_name);
            $('#uploadModal .nob').html('<option>Not available.</option>').hide(); //do not allow nob to be edited
            $('#uploadModal .custom_select').hide();
          }
          $('#uploadModal .template-id').val(parseData.template_id);
          $('#uploadModal .cat-id').val(parseData.cat_id);



          if(parseData.cat_name){
            $('#uploadModal .cat-name').text(parseData.cat_name);
          }else{
            $('#uploadModal .cat-name').text('Error!');
          }

        },
        error: function(error) {
            console.log(error);
        }
      })
})
  // $(document).on('click', '.click-addupdate-layout', function(){
  //   $('#uploadModal .custom_select').show();
  //   $('#uploadModal').modal('show');
  //   var temp_layout_id = $(this).attr('data-layout-id');
  //   var layout_id = '';
  //   if( typeof temp_layout_id != 'undefined'){
  //     layout_id = temp_layout_id
  //   }
  //   data = {catid:$(this).attr('data-id'), layoutid:layout_id};
  //   $.ajax({
  //     url: '/admin/layout_info',
  //     data: data,
  //     type: 'POST',
  //     success: function(response){
  //       var parseData = JSON.parse(response);
  //       var nobStr = '';
  //       var nob_update = false; //applicable for update layout
  //       if(parseData.request_type == 'upload'){
  //         if(parseData.nob > 0){
  //           set_template_name(parseData.cat_id, parseData.nob[0].nob_id);
  //         }else{
  //           $('#uploadModal .layout-name').val(parseData.layout_name+parseData.template_id);
  //         }
  //
  //         if(parseData.nob.length > 0){
  //           for (var i = 0; i < parseData.nob.length; i++) {
  //             nobStr += '<option value="'+parseData.nob[i].nob_id+'">'+parseData.nob[i].nob_name+'</option>';
  //           }
  //           $('#uploadModal select[name=nob]').html(nobStr);
  //         }else{
  //           $('#uploadModal .nob').html('<option>Not available.</option>');
  //           $('#uploadModal .custom_select').hide();
  //         }
  //
  //         $('#uploadModal .layout_id').val('');
  //       }else{
  //         // update
  //         nob_update = true;
  //         $('#uploadModal .layout_id').val(parseData.layout[0].layout_id);
  //         $('#uploadModal .layout-name').val(parseData.layout[0].layout_name);
  //         $('#uploadModal .nob').html('<option>Not available.</option>').hide(); //do not allow nob to be edited
  //         $('#uploadModal .custom_select').hide();
  //       }
  //       $('#uploadModal .template-id').val(parseData.template_id);
  //       $('#uploadModal .cat-id').val(parseData.cat_id);
  //
  //
  //
  //       if(parseData.cat_name){
  //         $('#uploadModal .cat-name').text(parseData.cat_name);
  //       }else{
  //         $('#uploadModal .cat-name').text('Error!');
  //       }
  //
  //     },
  //     error: function(error) {
  //         console.log(error);
  //     }
  //   })
  // })

  $('#uploadForm').submit(function(e){
    e.preventDefault();
    var screenshot = $('input[name="screenshot"]').val();
    var rawfile = $('input[name="rawfile"]').val();
    var err = '<span class="error">';
    var layout_id = $('.layout_id').val(); //if not empty, event is for update layout

    if( typeof layout_id == 'undefined' || layout_id == ''){
      //upload layout
      if(rawfile == '' || screenshot == ''){
        if(screenshot == ''){
          $('.file-return').html(err+'required</span>');
        }
        if(rawfile == ''){
          $('.file-return2').html(err+'required</span>');
        }
        return;
      }else{
        $('#uploadForm .error').remove();
        var formData = new FormData($(this)[0]);
        do_upload_layout(formData);
      }
    }else{
      //update layout
      if(rawfile != '' || screenshot != ''){
        $('#uploadForm .error').remove();
        var formData = new FormData($(this)[0]);
        do_upload_layout(formData);
      }else{
        alertify.set('notifier','position','top-left');
        alertify.error("Please select a file to update.");
        return;
      }
    }

  })
  //login in validation
  $('#loginForm').validate({
    rules:{
      username:{required: true},
      password:{required: true}
    },
    messages:{
      username:"Please input username",
      password:"Please input password"
    }
  });
var download_data;
  // $(document).on('submit','#downloadForm',function(e){
  //   e.preventDefault();
  //   if($(this).valid()){
  //     download_data = $(this).serialize();
  //     $('#downloadUserTemplate').modal('show');
  //     $('#downloadFormConfirmation input[name=data]').val(download_data);
  //   }else{
  //     return;
  //   }
  // });
  //
  // $('#downloadUserTemplate .btn-confirm').on('click', function(e){
  //   e.preventDefault();
  //
  //   // do_download_layout($('#downloadFormConfirmation input[name=data]').val());
  // });

  $(document).on('click', '.dl-unavailable', function(e){
   e.preventDefault();
    var layout_id = $(this).attr('data-layout-id');
    $.ajax({
      url: base_url+"dashboard/get_dl_details",
      method: 'POST',
      data : {layout_id:layout_id},
      dataType: "json",
      success: function(data){
          $('#unavailableTemplate').modal('show');
          document.getElementById('timeleft').innerHTML = data.layout[0].time_remaining;
      },
      error: function(){
        alertify.set('notifier','position','top-left');
        alertify.error("Something went wrong. Please try again.");
      }
    });
  })

  // Login
    $('#loginForm').submit(function(e){
        var form = $(this).serialize();
        e.preventDefault();
        if($(this).valid()){
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: form,
                dataType: 'json',
                success:function(res){
                    if(res.response == 'success'){
                        window.location.href = base_url;
                    } else {
                        alertify.set('notifier','position','top-left');
                        alertify.error('Invalid Credentials!');
                    }
                }
            });
        }
    });

  attachfile();
  $(document).on('click','.generatedata',function(e){
       $.ajax({
           url: base_url+'admin/fetch_data',
           data:{},
           type: 'POST',
           dataType: 'json',
           beforeSend: function(){
               show_loader();
           },
           success: function(data){

                if(data.status != "ok"){
                     alertify.set('notifier','position','top-left');
                     alertify.error('Something went wrong!');
                }else{
                     alertify.set('notifier','position','top-left');
                     alertify.success('Data updated!');

                }
             hide_loader();
           }
       });
     });
});


// function do_download_layout(formData){
//     $.ajax({
//       url: '/user/download',
//       method: 'POST',
//       data : formData,
//       dataType: "json",
//       success: function(data){
//         if(data.result){
//           alertify.set('notifier','position','top-left');
//           alertify.success(data.message);
//           window.location.href = base_url+"user/do_download/"+data.file+"";
//         }else{
//           alertify.set('notifier','position','top-left');
//           alertify.error(data.message);
//         }
//         //reload page
//         var cur_nob_id = $('#downloadForm input[name=nob_id]').val();
//         var cur_searchVal = $('.search-emp').val();
//         var cur_page = $('input[name=cur_page]').val();
//         if(cur_nob_id == 0 || typeof cur_nob_id == 'undefined'){
//           var cur_cat_id = $('#downloadForm input[name=cat_id]').val();
//           layouts_user(cur_cat_id,cur_page);
//         }else{
//           nob_user(cur_nob_id,cur_searchVal,cur_page);
//         }
//         $("#downloadForm")[0].reset();
//         $('#downloadUserTemplate,#downloadTemplate').modal('hide');
//
//
//       },
//       error: function(){
//         alertify.set('notifier','position','top-left');
//         alertify.error("Something went wrong. Please try again.");
//       }
//     });
// }

function do_upload_layout(formData){
  formData.append('screenshot', $('input[name="screenshot"]').val());
  formData.append('rawfile', $('input[name="rawfile"]').val());
  $.ajax({
    url: base_url+'admin/upload_layout',
    method: 'POST',
    data : formData,
    processData: false,
    contentType: false,
    success: function(data){
      var parseData = JSON.parse(data);
      if(parseData.status != "ok"){
        alertify.set('notifier','position','top-left');
        alertify.error("Something went wrong. Please try again.");
      }else{
        alertify.set('notifier','position','top-left');
        alertify.success("Layout has been uploaded successfully");
        setTimeout(function(){
           location.reload();
         }, 1000);
      }
      //clear form values
      $('#uploadModal').find('#uploadForm')[0].reset();
      $('#uploadModal').find('#uploadForm .file-return, #uploadForm .file-return2').text('');

      $('#uploadModal').modal('hide');
      // setTimeout(function(){
         // location.reload();
         //reload page
         var cur_nob_id = $('input[name=cur_nob_id]').val();
         var cur_searchVal = $('.search-emp').val();
         var cur_page = $('input[name=cur_page]').val();
         if(cur_nob_id == 0 || typeof cur_nob_id == 'undefined'){
           var cur_cat_id = $('input[name=cat_id]').val();
           layouts_admin(cur_cat_id,cur_page);
         }else{
           nob_admin(cur_nob_id,cur_searchVal,cur_page);
         }
       // }, 2000)
    },
    error: function(){
      alertify.set('notifier','position','top-left');
      alertify.error("Something went wrong. Please try again.");
    }
  });
}

function set_template_name(catid = '', nobid = '', nobname = '', layoutid = ''){
  $.ajax({
    url: base_url+"admin/get_template_name",
    data: {nobid:nobid, catid:catid, layoutid:layoutid},
    type: 'POST',
    async: false,
    success: function(response){
      var parseData = JSON.parse(response);
      $('#uploadModal .layout-name').val(nobname+parseData.template_id);
    }
  })
}

function attachfile(){
  document.querySelector("html").classList.add('js');

  var fileInput  = document.querySelector( ".input-file" ),
      fileInput2  = document.querySelector( ".input-file2" ),
      button     = document.querySelector( ".input-file-trigger" ),
      button2     = document.querySelector( ".input-file-trigger2" ),
      the_return = document.querySelector(".file-return"),
      the_return2 = document.querySelector(".file-return2");

  button.addEventListener( "keydown", function( event ) {
      if ( event.keyCode == 13 || event.keyCode == 32 ) {
          fileInput.focus();
      }
  });

  button2.addEventListener( "keydown", function( event ) {
      if ( event.keyCode == 13 || event.keyCode == 32 ) {
          fileInput2.focus();
      }
  });

  button.addEventListener( "click", function( event ) {
     fileInput.focus();
     return false;
  });

  button2.addEventListener( "click", function( event ) {
     fileInput2.focus();
     return false;
  });

  fileInput.addEventListener( "change", function( event ) {
      the_return.innerHTML = this.value;
  });

  fileInput2.addEventListener( "change", function( event ) {
      the_return2.innerHTML = this.value;
  });

}

function show_loader(){
  $('.loader-cont').show();
}

function hide_loader(){
  $('.loader-cont').hide();
}

function get_layout_data(isLoaded = true){
     var base_url = $('.base_url').val();
     var cat_id = $('.cat_id_category').val();
     $.ajax({
          url:base_url+'dashboard/get_layout_data',
          method:'post',
          data:{
               cat_id:cat_id
          },
          dataType:'json',
          success:function(response){
               var str = '';
               if(response.layout.length != 0){
                    $.each(response.layout,function(index,element){

                         if(element.layout_status == 1){

                              str += '<div class="col-sm card">';
                              str += '<div class="img-container">';
                              str += '<img src="'+base_url+'assets/images/uploads/screenshots/'+element.layout_screenshot+'">';
                              str += '</div>';
                              str += '<div class="catname">';
                              str += element.layout_name;
                              str += '</div>';
                              str += '<div class="download-div">';
                              str += '<span class="counter">';
                              str += '<img src="'+base_url+'assets/images/download-counter.png">';
                              str += $.strPad(element.download_counter,4);
                              str += '</span>';
                              str += '</div>';
                              if (element.status === false) {
                                   str += '<div class="download-promo">';
                                   str += '<button class="btn dl-unavailable" data-layout-id="'+element.layout_id+'">UNAVAILABLE</button>';
                                   str += '</div>';
                              }else{
                                   str += '<div class="download-promo">';
                                   if(element.cat_id != 1){
                                        str += '<button class="btn downloadForm3" data-layout-id="'+element.layout_id+'">DOWNLOAD</button>';
                                   }else{

                                        str += '<button class="btn download" data-layout-id="'+element.layout_id+'">DOWNLOAD</button>';
                                   }
                                   str += '</div>';
                              }
                              str += '</div>';
                         }
                    });

          }else{
               str += '<h1 class="no-data">No Data Found</h1>';
          }
               $('#layout_container').html(str);

               $('#downloadUserTemplate').modal('hide');
               $('#downloadUserTemplate').on('hidden.bs.modal', function (e) {
                    $('#downloadTemplate').modal('hide');
               });
               if(!isLoaded){
                    alertify.set('notifier','position','top-left');
                    alertify.success('Success');
               }
          }
     });
}

function get_layout_data_nob(search_data = {},isLoaded = true){
     var base_url = $('.base_url').val();
     var cat_id = $('.cat_id_category_nob').val();
     var nob_id = $('.nob_id_category_nob').val();

     $.ajax({
          url:base_url+'dashboard/get_layout_data_nob',
          method:'post',
          data:{
               cat_id:cat_id,
               nob_id:nob_id,
               search_data:search_data
          },
          dataType:'json',
          success:function(response){
               var str = '';
               var str2 = '';

               if (user_type != 1) {
                   if(response.layout.length != 0 && user_type != 1){
                             $.each(response.layout,function(index,element){
                                if(element.layout_status == 1){
                                  str += '<div class=" card nature-card">';
                                     str += '<div class="card-main">';
                                        str += '<div class="card-top">';
                                             str += '<div class="dcounter">';
                                                 str += '<img src="'+base_url+'assets/images/download-counter.png">';
                                                 str += $.strPad(element.download_counter,4);
                                            str += '</div>';
                                            str += ' <div class="cchosen">';
                                                 str += '<img src="'+base_url+'assets/images/chosen.png">';
                                                 str += $.strPad(element.chosen_counter,2);
                                            str += '</div>';
                                       str += '</div>';
                                       str += '<div class="img-container">';
                                          str += '<img src="'+base_url+'assets/images/uploads/screenshots/'+element.layout_screenshot+'">';
                                       str += '</div>';
                                  str += '</div>';
                                  str += '<div class="catname">';
                                         str += element.layout_name;
                                      str += '</div>';
                                      if (element.status === false) {
                                          str += '<div class="download-promo">';
                                                str += '<button class="btn dl-unavailable" data-layout-id="'+element.layout_id+'">UNAVAILABLE</button>';
                                          str += '</div>';
                                      }else{
                                          str += '<div class="download-promo">';
                                                str += '<button class="btn download" data-layout-id="'+element.layout_id+'">DOWNLOAD</button>';
                                          str += '</div>';
                                      }
                                  str += '</div>';
                              }
                             });
                   } else {
                        str += '<h1 class="no-data">No Data Found</h1>';
                   }
                   $('#layout_container1').html(str);
               }else{
                   if(response.layout.length){
                        $.each(response.layout,function(index,element){
                            if(element.status == 2){
                                const status = 'disabled';
                            }
                             if(element.layout_status == 1){
                                 str2 += '<div class=" card nature-card">';
                                 str2 += '  <div class="card-main">';
                                     str2 += '<div class="card-top ">';
                                       str2 += '<div class="dcounter">';
                                         str2 += '<img src="'+base_url+'assets/images/download-counter.png"> <span>'+$.strPad(element.download_counter,4)+'</span>';
                                       str2 += '</div>';
                                       str2 += '<div class="cchosen">';
                                         str2 += '<img src="'+base_url+'assets/images/chosen.png"><span>'+$.strPad(element.chosen_counter,2)+'</span>';
                                       str2 += '</div>';
                                       str2 += '<div class="cview">';
                                         str2 += '<a href="javascript:;" class="view_download_history" data-id="'+element.layout_id+'"><img src='+base_url+'assets/images/view.png></a>';
                                       str2 += '</div>';
                                     str2 += '</div>';
                                     str2 += '<div class="img-container">';
                                       str2 += '<div class="disable-label"> disabled </div>';
                                       str2 += '<a href="#deleteTemplate" class="delete_layout" data-toggle="modal" data-id="'+element.layout_id+'"><i class="fa fa-times"></i></a>';
                                       str2 += '<div class="layout-img">';
                                           str2 += '<img src="'+base_url+'assets/images/uploads/screenshots/'+element.layout_screenshot+'" class="'+status+'">';
                                       str2 += '</div>';
                                     str2 += '</div>';
                                   str2 += '</div>';
                                   str2 += '<div class="nature-buttons">';
                                     str2 += '<button class="btn btn-update click-addupdate-layout" data-id="'+element.cat_id+'" data-layout-id="'+element.layout_id+'">UPDATE</button>&nbsp';
                                     str2 += '<button class="btn layout_status waves-effect waves-light btn-status" data-toggle="modal" data-target="#disableTemplate" data-id="'+element.layout_id+'" data-status="'+element.layout_status+'">DISABLE</button>';
                                     str2 += '</div>';
                                     str2 += '<div class="catname">';
                                         str2 += element.layout_name;
                                     str2 += '</div>';
                                 str2 += '</div>';
                              }
                        });

                   } else {
                        str2 += '<h1 class="no-data">No Data Found</h1>';
                   }
                   $('#layout_container_nob').html(str2);
               }
               $('#downloadUserTemplate').modal('hide');
               $('#downloadUserTemplate').on('hidden.bs.modal', function (e) {
                    $('#downloadTemplate').modal('hide');
               });
               if(!isLoaded){
                    alertify.set('notifier','position','top-left');
                    alertify.success('Success');
               }
          }
     });
}


$.strPad = function(i,l,s = '0') {
	var o = i.toString();
	if (!s) { s = '0'; }
	while (o.length < l) {
		o = s + o;
	}
	return o;
};
