      $(document).ready(function () {

      // var options = {
      //   url: "json/agencies.json",

      //   getValue: "name", 

      //   list: {
      //     match: {
      //       enabled: true
      //     }
      //   }
      // };

      // $("#agencies").easyAutocomplete(options);
      // $("#vu_agencies").easyAutocomplete(options);

    //   $(document).ready(function(){
    //       $('#flashMessage').show().delay(3000).slideUp(350);
    //       $('#flashMessage').delay(3000).slideUp(350);
    // });

    $(document).ready(function() {
      $('#showmenu').click(function() {
          $('.menu').slideToggle("fast");
      });
    });

    $(document).ready(function() {
      $('#subshowmenu').click(function() {
          $('.submenu').slideToggle("fast");
      });
    });

    $(document).ready(function() {
      $('.showupdatefinding').click(function() {
          $('.showupdatefinding').css('display', 'none');
          $('#findingscontainer').css('display', 'none');
          $('.divupdatefinding').css('display', 'inline-block');
      });
    });

    $(document).ready(function() {
      $('.close_updatefinding').click(function() {
          $('.divupdatefinding').css('display', 'none');
          $('#findingscontainer').css('display', 'inline-block');
          $('.showupdatefinding').css('display', 'inline-block');

      });
    });

    $(document).ready(function() {
      $('.absolute').click(function() {
          $("#hr_recommendation").removeClass().addClass('style-one');
          $('.absolute').css('display', 'none');
          $('.absolute_save').css('display', 'inline-block');
          $('.save_auditrecommendation').show();
          $('.updaterecommendation').hide();
          tinymce.get("findings_recommendation").setContent("");

      });
    });

    $(document).ready(function() {
      $("div").on("click", ".subabsolute", function(){
          $("#hr_recommendation").removeClass().addClass('style-one');
          $('.submenu').css('display', 'inline-block');
          $('.subabsolute').css('display', 'none');
          $('.subabsolute_save').css('display', 'inline-block');
          $('.save_subauditrecommendation').show();
          $('.updatesubrecommendation').hide();
          // tinymce.get("subfindings_recommendation").setContent("");
          // alert();
      });
    });

    $(document).ready(function() {
      $('.close_addrecommendation').click(function() {
          $('.absolute_save').css('display', 'none');
          $('.menu').css('display', 'none');
          $('.absolute').css('display', 'inline-block');
      });
    });

    $(document).ready(function() {
      $('.close_addfinding').click(function() {
          $('#traddfinding').hide();
          $('.addanotherfinding').show();
      });
    });
    

    $(document).ready(function(){
      jQuery("time.timeago").timeago();
    });

    $('#datatable').DataTable( {
        order: [[ 0, 'asc' ]],
        "columnDefs" : [{"targets":3, "type":"natural-time-delta"}],
    } );

    $('#datatablenew').DataTable( {
        order: [[ 0, 'asc' ]],
        "columnDefs" : [{"targets":3, "type":"natural-time-delta"}],
    } );

    $('#datatableapproved').DataTable( {
        order: [[ 3, 'asc' ]]
    } );
    $('#datatableme').DataTable( {
        order: [[ 3, 'asc' ]]
    } );
    $('#datatableall').DataTable( {
        order: [[ 3, 'asc' ]],
        "columnDefs" : [{"targets":3, "type":"monthYear"}]
    } );

//========================================================================

      $(".add-more").click(function(){ 
          var html = $(".copy-fields").html();
          $(".after-add-more").after(html);
      });
      
//here it will remove the current value of the remove button which has been pressed
      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });

// ========================QUERY AT HOMECONTROLLER========================
    $(document).ready(function(){
        $('#tleader, #agencies').select2();
    });

    $(document).ready(function(){
        $('#vu_tleader, #vu_agencies').select2();
    });

    $(document).ready(function(){
        $('#audit_mem').select2({
            placeholder : 'Enter Auditor'
        });
    });

    $(document).ready(function(){
        $('#secretariat').select2({
            placeholder : 'Enter Secretariat'
        });
    });

    $(document).ready(function(){
        $('#scopeaudit').select2({
            placeholder : 'Select Audit Area',
            tags: true,
        });
    });

    $(document).ready(function(){
        $('#scope_a').select2({
            placeholder : 'Select Audit Area'
        });
    });

    $(document).ready(function(){
        $('#scope_a_u').select2({
            placeholder : 'Select Audit Area'
        });
    });

    $(document).ready(function(){
        $('#tag_a').select2({
            placeholder : 'Select Audit Area'
        });
    });


    // VIEW UPDATE FORM 001

    $(document).ready(function(){
        $('#vu_audit_mem').select2({
            placeholder : 'Enter Auditor'
        });
    });

    $(document).ready(function(){
        $('#vu_secretariat').select2({
            placeholder : 'Enter Secretariat'
        });
    });

    $(document).ready(function(){
        $('#vu_scopeaudit').select2({
            placeholder : 'Select Audit Area',
            tags: true,
        });
    });

    $(document).ready(function(){
        $('#vu_scope_a').select2({
            placeholder : 'Select Audit Area'
        });
    });

    $(document).on("click", '.enable_ca',function(){
        $(this).css('display', 'none');
        $('.disable_ca').css('display', 'inline-block');
        $('#scope_a').select2('enable', false);
        $('#c_audit').removeAttr('disabled');
    });

    $(document).on("click", '.disable_ca',function(){
        $(this).css('display', 'none');
        $('.enable_ca').css('display', 'inline-block');
        $('#scope_a').select2('enable');
        $('#c_audit').attr('disabled', true)
    });

        $(document).on("click", '.enable_ca_u',function(){
        $(this).css('display', 'none');
        $('.disable_ca_u').css('display', 'inline-block');
        $('#scope_a_u').select2('enable', false);
        $('#c_audit_u').removeAttr('disabled');
    });

    $(document).on("click", '.disable_ca_u',function(){
        $(this).css('display', 'none');
        $('.enable_ca_u').css('display', 'inline-block');
        $('#scope_a_u').select2('enable');
        $('#c_audit_u').attr('disabled', true)
    });

//===========================TINYMCE===========================
  $(function() {

    tinymce.init({
        selector: 'textarea',
  height: 275,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help wordcount'
  ],
  toolbar: 'fontselect fontsizeselect | undo redo |  formatselect | table | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'],
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });

    tinyMCE.init({
      //your regular init parameters here...
      setup: function(editor) {
        editor.on('init', function() {
          //load your content here!
          tinymce.activeEditor.setContent(html);
          //or
          tinymce.editors[0].setContent(html);
        });
      }
    });  
  }); 

//=============================STORE FORM 001=============================
    $(document).on("click", '.submit_report',function(e){

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      e.preventDefault(); 

      $am = $('#audit_mem').val();
      $('#audit_m').val($am);

      $sct = $('#secretariat').val();
      $('#sec').val($sct);

      $sat = $('#scopeaudit').val();
      $('#sa').val($sat);

      

      var frow = $('#audit_reportrow');
      var form = document.querySelector('#submitForm001');
      var formdata = new FormData(form)

      $.ajax({
        type : 'POST',
        url : '/store_form001',
        cache: false,
        contentType: false,
        processData: false,
        data : formdata,
        success : function(data){
          $('#myModal').modal('hide')
          window.location = '/form001_content/'+ data;
          toastr.success('Audit Report has been successfully created!');
        },
        error : function(data){

          toastr.error('Please fill up all the required (*) fields!');

          // $('#flashErrorMessage').show().delay(3000).slideUp(350);
          // $('#error_message').show();
            // alert('error');
        }
        });
    });
// ==================****** UPDATE FORM 001 ******========================== //

    $(document).on("click", '.update_auditreport',function(){

      var id = $(this).val();

      $am = $('#vu_audit_mem').val();
      $('#vu_audit_m').val($am);

      $sct = $('#vu_secretariat').val();
      $('#vu_sec').val($sct);

      $sat = $('#vu_scopeaudit').val();
      $('#vu_sa').val($sat);

      
      
      var form = document.querySelector('#updateAuditReportForm');
      var formdata = new FormData(form)

      $.ajax({
        type : 'POST',
        url : '/update_auditreport/' + id ,
        cache: false,
        contentType: false,
        processData: false,
        data : formdata,
        success : function(data){     
          $('#myViewUpdateModal').modal('hide')
          toastr.success('Audit Report has been successfully updated!');

          var rows = $('.treffect_'+id);
          rows.fadeOut(500);
          rows.fadeIn(1000);


        },
        error : function(){
          $("#myViewUpdateModal").modal({"backdrop": "static"});
          toastr.error('Please fill up all the required (*) fields!');
        }
      });
    });


//=====================OPEN FOR ADD AUDIT FINDING ITEM=====================

    $(document).on("click", '#a_name',function(){

        var a_name = $('#agency_name').text()
        var id = $('#f_id').text()

        $('#_id').text(id);

        $("#scope_a").val('').trigger('change')

        $('#myModalLabel').text(a_name);   

        $("#submitFormContent")[0].reset();

        $('#submit').css('display', 'inline-block')

        $('#update_af').css('display', 'none')
        $('#add_subf').css('display', 'none')

        $('#comments').hide();


            $('#scope_a').select2('enable');
            $('#tag_a').select2('enable');
            $('.enable_ca').css('display', 'inline-block');
            $('.disable_ca').css('display', 'none');
            $('#c_audit').attr('disabled', true);
            $('.fa-question-circle').css('display', 'none');

    });

//=====================OPEN FOR ADD ANOTHER AUDIT FINDING ITEM=====================

    $(document).on("click", '.addanotherfinding',function(e){

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      e.preventDefault(); 

      $(this).hide();

      
      var appendtr = $('#traddfinding');
      $('#addsubfindingrecommendationtable').show();
      $('#addsubfindingrecommendationtable tr:last').append(appendtr.show());
    
    });


// ==================****** UPDATE FINDN ******========================== // current

    $(document).on("click", '.updatefindingdetails',function(){

      // var id = $(this).val();
      var id = $('#update_id').val();

      console.log(id);

      var form = document.querySelector('#submitUpdateFormContent');
      var formdata = new FormData(form)

      $.ajax({
        type : 'POST',
        url : '/update_findingdetails/'+id,
        cache: false,
        contentType: false,
        processData: false,
        data : formdata,
        success : function(data){     
          toastr.success('Audit Finding Details has been successfully updated!');


        },
        error : function(){
          $("#myViewUpdateModal").modal({"backdrop": "static"});
          toastr.error('Please fill up all the required (*) fields!');
        }
      });
    });
    
//=================OPEN FOR UPDATE AUDIT FINDING ITEM=====================

    $(document).on("click", '.update_c',function(){

        $('#comments').show();
        $("#comment_container ul").empty();

        $('#submit').css('display', 'none')
        $('#update_af').css('display', 'inline-block')
        $('#add_subf').css('display', 'none')

        var id_c = $(this).attr('id').replace('update_c_', '');
        var a_name = $('#agency_name').text()
        var f_id = $('#f_id').text()



        $('#myModalLabel').text('Update Audit Finding No. ' + id_c);        
        $('#_id').val(f_id);
        $('#_ids').val(f_id);
        $('#update_id').val(id_c);
        
        


        $('.absolute_save').css('display', 'none');
          $('.menu').css('display', 'none');
          $('.absolute').css('display', 'inline-block');

          $('.divupdatefinding').css('display', 'none');
          $('#findingscontainer').css('display', 'inline-block');
          $('.showupdatefinding').css('display', 'inline-block');

          $('#traddfinding').hide();
          $('.addanotherfinding').show();

      
        $.ajax({
          type: 'GET',
          url: '/view_audit_finding',
          cache: false,
          data: {id_c:id_c, f_id:f_id},
          success: function (data) {


            $("#comment_container ul").empty();
            $("#commentf_container ul").empty();
            $("#afrecommendation_container ol").empty();
            $("#findingscontainer").empty();

            var d = data.finding[0];

            // console.log(data.rcomment);

            if (!d.custom_auditarea || d.custom_auditarea == " ") {
              $('.enable_ca').css('display', 'inline-block');
              $('.disable_ca').css('display', 'none');
              $('#c_audit').attr('disabled', true);
              $('#scope_a_u').attr('disabled', false);
              $('#tag_a').attr('disabled', false);
            }else {
              $('.enable_ca').css('display', 'none');
              $('.disable_ca').css('display', 'inline-block');
              $('#c_audit').attr('disabled', false);
              $('#scope_a_u').attr('disabled', true);
              $('#tag_a').attr('disabled', false);
            }

            $('.spanrecommendations').click(function() {
               alert();
            });

            $('.updatefinding').val(d.id);

            tinymce.get("findings_u").setContent(d.auditfinding);
            // tinymce.get("recommendations").setContent(d.auditrecommend);

            $("#findingscontainer").append('<br>'+d.auditfinding);
            // mytbl.ajax.reload;
           
            if (data.subfinding == 0) {
              $('#subfindingrecommendationtable').hide();
            }else{
              $('#subfindingrecommendationtable').empty();
              jQuery.each(data.subfinding, function(i, d) {
                tinymce.init({selector:'textarea'});
                $('#subfindingrecommendationtable').show().append('<tr style="border: 1px solid black"><td valign="top" style="border: 1px solid black; width:710px "><div class="col-xs-12 col-md-12"> <div id="subfindingscontainer" style="min-height: 200px; color: black">'+d.auditfinding+'</div><center><div class="showupdatesubfinding" id="showupdatesubfindingmenu"> <a href="#"><i class="fa fa-pencil"></i> Update Finding</a>  </div></center> </div></td><td valign="top" style="border: 1px solid black; width: 710px"><div class="col-xs-12 col-md-12"><div id="asfrecommendation_container" style="min-height: 200px;"><ol class="tabss" style="list-style: none"></ol><div class="submenu" style="display: none;"><hr id="hr_recommendation" > <textarea name="subfindings_recommendation" id="subfindings_recommendation"></textarea></div><center><div class="subabsolute" id="subshowmenu"> <a href="#"><i class="fa fa-plus"></i> Add a recommendation</a>  </div></center><div class="subabsolute_save pull-right" style="display: none; margin-top: 15px;"><button title="Add recommendation" class="btn btn-success save_subauditrecommendation" style="" value="">Add</button><button title="Add recommendation" class="btn btn-success updatesubrecommendation" style="" value="">Update</button><button title="Add recommendation" class="btn btn-default close_addrecommendation" type="button"><i class="fa fa-times fa-lg close_addrecommendation " ></i></button></div></div> </div></td>   </tr>');
              });
            }



            $('#s_audit_u').val(d.sub_auditarea);
            $('#c_audit_u').val(d.custom_auditarea);
            $( "select#scope_a_u" ).val(d.audit_area).trigger('change');
            $( "select#tag_a_u" ).val(d.main_area).trigger('change');

            jQuery.each(data.rcomment, function(i, d) {
              $("#comment_container ul").append('<hr><li><a><span class="image"><img style="width:25px; height:25px;" src="../images/user.png " alt="Profile Image" /></span><span><span> <b>'+d.comment_by+'</b></span><span class="time pull-right"><i>'+ jQuery.timeago(d.created_at) +'</i></span></span><br><span class="message" style="margin-left:30px;">'+d.comment+'</span></a></li>');
            });

            jQuery.each(data.fcomment, function(i, d) {
              $("#commentf_container ul").append('<hr><li><a><span class="image"><img style="width:25px; height:25px;" src="../images/user.png " alt="Profile Image" /></span><span><span> <b>'+d.comment_by+'</b></span><span class="time pull-right"><i>'+ jQuery.timeago(d.created_at) +'</i></span></span><br><span class="message" style="margin-left:30px;">'+d.comment+'</span></a></li>');
            });

            // jQuery.each(data.recommendations, function(i, d) {
            //   $("#afrecommendation_container ol").append('<br><li><a><span contenteditable="false"  class="spanrecommendations " style="display:block; width:600px; color:black; background-color:#fdfeff"> '+d.afrecommend+'</span></a></li>');
            // });

            jQuery.each(data.recommendations, function(i, d) {
              $("#afrecommendation_container ol").append('<div class="row" id="recommendation_div'+d.id+'"><div class="col col-lg-1"><br><li><a><span contenteditable="false"  class="spanrecommendations " style="display:block; width:595px; color:black; background-color:#fdfeff" id="spanrecommendations_'+d.id+'"> '+d.afrecommend+'</span></a></li></div><div class="col col-lg-11" style="margin-top:20px; "><button type="button" style="width:35px;" class="btn btn-sm update_auditrecommendation btn-info pull-right" value="'+d.id+'"><i class="fa fa-edit"></i></button><br><br><button type="button" style="width:35px;" class="btn btn-sm deleterecommendation btn-danger pull-right" value="'+d.id+'"><i class="fa fa-trash"></i></button></div></div>');
            });

         }

      });
    });

//=========================VIEW AUDIT FINDING ITEM========================

    $(document).on("click", '.vc',function(){

        $('#submit').css('display', 'none')
        $('#update_af').css('display', 'inline-block')

        var id_c = $(this).attr('id').replace('vc_', '');
        var a_name = $('#agency_name').text()
        var f_id = $('#f_id').text()

        $('#viewContentModalLabel').text(a_name + ' Audit Finding No. ' + id_c);        
      
        $.ajax({
          type: 'GET',
          url: '/view_audit_finding',
          cache: false,
          data: {id_c:id_c, f_id:f_id},
          success: function (data) {
            $("div#af_recommendations").empty();

            var d = data.finding[0];

            var c_area = d.custom_subauditarea;

            var c_areaVal = c_area.replace(/;/g, "<br>")

            $('#auditarea').text(d.audit_area == ' ' ? d.custom_auditarea : d.audit_area);
            $('#subauditarea').text(d.sub_auditarea);
            $('#customarea').html(c_areaVal);
            $('#af_no').text(d.auditfinding_no);
            $('#af_findings').html(d.auditfinding);


            // $('#af_recommendations').html(d.auditrecommend);


            jQuery.each(data.recommendations, function(i, d) {
              $("div#af_recommendations").append(d.afrecommend);
            });


         }
      });
    });

// ========================ADD AUDIT FINDING IETM================================= 
    $(document).on("click", '.submit_auditfinding',function(e){

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      e.preventDefault(); 

      

      var id = $('#f_id').text()

      // alert(id);

      var srow = $('#formcontent_row');
      var frow = $('#fcontent_row');
      var form = document.querySelector('#submitFormContent');
      var formdata = new FormData(form)

      var f = tinymce.get("findings").getContent();
      var fs = f.replace(/&nbsp;/g, "").replace(/(<p[^>]+?>|<p>|<\/p>)/g, "").replace(/(<br>| |\n|\r)/g, "");

      // var r = tinymce.get("recommendations").getContent();
      // var rs = r.replace(/&nbsp;/g, "").replace(/(<p[^>]+?>|<p>|<\/p>)/g, "").replace(/(<br>| |\n|\r)/g, "");

      if ($.trim(fs).length == 0) {
        toastr.error("Please fill up Findings");
          $('#approve_report_'+ id).hide();
          $('#cancel_approve_report_'+ id).show();
      }else{
        $.ajax({
        type : 'POST',
        url : '/store_formcontent/' + id,
        cache: false,
        contentType: false,
        processData: false,
        data : formdata,
        success : function(data){
          d = eval('data='+data);
          $('#myModal').modal('hide')
          $('#flashMessage').show().delay(3000).slideUp(350);
          $('#flashMessage').delay(3000).slideUp(350);

          $('#update_message').hide();
          $('#create_message').show();

          frow.hide();
          $('.row-data:last-child').after(frow);
          frow.fadeIn(1000);

          var table = $('#datatable').DataTable();
     
           table.row.add([
                '<center>'+d.auditfinding_no+'</center>',
                '<center>'+d.audit_area+'</center>',
                '<center>'+d.sub_auditarea+'</center>',
                '<center><button data-toggle="modal" data-target="#viewDocuments" title="Supporting Documents" class="btn btn-trans open_upload" value="'+d.auditfinding_no+'" id="open_upload"><i class="fa fa-folder-open" aria-hidden="true"></i></button></center>',
                '<center>'+d.created_at+'<br>'+d.author_id+'</center>',
                '<center><h5 class="text-info"> for review and approval</h5></center>',
                '<center><button data-toggle="modal" data-target="#viewContentModal" title="View Content" class="btn btn-trans vc" value="" id="vc_'+d.auditfinding_no+'"><i class="fa fa-eye text-info" ></i></button><button data-toggle="modal" data-target="#myModalUpdate" title="Update Content" class="btn btn-trans update_c" value="" id="update_c_'+d.auditfinding_no+'"><i class="fa fa-pencil-square-o text-warning" ></i></button></center>'
            ]).draw();
        },
        error : function(){
          $('#flashErrorMessage').show().delay(3000).slideUp(350);
          $('#error_message').show();
        }
      });
      }

      
    });



// ======================== AUDIT RECOMMENDATION================================= 
  // ========================ADD AUDIT RECOMMENDATION================================= 
    $(document).on("click", '.save_auditrecommendation',function(e){

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      e.preventDefault(); 

      var id = $('#update_id').val(); // auditfinding number
      var f_id = $('#_id').val(); // form 001 id
      var form = document.querySelector('#submitUpdateFormContent');
      var formdata = new FormData(form)

      var afr = tinymce.get("findings_recommendation").getContent();
      var fs = afr.replace(/&nbsp;/g, "").replace(/(<p[^>]+?>|<p>|<\/p>)/g, "").replace(/(<br>| |\n|\r)/g, "");

      if ($.trim(fs).length == 0) {
        toastr.error("Please write a recommendation");
      }else{

      $.ajax({
        type : 'POST',
        url : '/add_auditrecommendation/' + id,
        cache: false,
        contentType: false,
        processData: false,
        data : formdata,
        success : function(data){

          toastr.success("Recommendation added!");

          $('.absolute_save').css('display', 'none');
          $('.menu').css('display', 'none');
          $('.absolute').css('display', 'inline-block');
          tinymce.get("findings_recommendation").setContent("");

          var d = data;

          $("#afrecommendation_container ol").append('<div class="row"><div class="col col-lg-1"><br><li><a><span contenteditable="false"  class="spanrecommendations " style="display:block; width:595px; color:black; background-color:#fdfeff" id="spanrecommendations_'+d.id+'"> '+d.afrecommend+'</span></a></li></div><div class="col col-lg-11" style="margin-top:20px; "><button type="button" style="width:35px;" class="btn btn-sm update_auditrecommendation btn-info pull-right" value="'+d.id+'"><i class="fa fa-edit"></i></button><br><br><button type="button" style="width:35px;" class="btn btn-sm btn-danger pull-right"><i class="fa fa-trash"></i></button></div></div>');
          

          // console.log(d.afrecommend);

          }
        });
      }    
    });
  // ========================OPEN UPDATE================================= 
    $(document).on("click", '.update_auditrecommendation',function(e){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });

      e.preventDefault(); 

       var id = $(this).val();
       $('.updaterecommendation').val(id);

      // console.log(id);

      // //Show Update Form - Hide Create Form
      $("#hr_recommendation").removeClass().addClass('style-two');
      $('.menu').show();
      $('.absolute_save').show();
      $('.absolute').hide();

      $('.updaterecommendation').show();
      $('.close_addrecommendation').show();
      $('.save_auditrecommendation').hide();

      var title = $('#spanrecommendations_' + id).html();

      tinymce.get("findings_recommendation").setContent(title);
    });

    // ========================SAVE UPDATE RECOMMENDATION================================= 
    $(document).on("click", '.updaterecommendation',function(e){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });

      e.preventDefault(); 

      var id = $(this).val();

      var form = document.querySelector('#submitUpdateFormContent');
      var formdata = new FormData(form)

      var afr = tinymce.get("findings_recommendation").getContent();
      var fs = afr.replace(/&nbsp;/g, "").replace(/(<p[^>]+?>|<p>|<\/p>)/g, "").replace(/(<br>| |\n|\r)/g, "");

      if ($.trim(fs).length == 0) {
        toastr.error("Please write a recommendation");
      }else{

      $.ajax({
        type : 'POST',
        url : '/update/' + id,
        cache: false,
        contentType: false,
        processData: false,
        data : formdata,
        success : function(data){

          toastr.success("Recommendation updated!");

          var d = data;

          $('#spanrecommendations_'+id).empty().html(d.recommendation);

          }
        });
      }
    });

  // ========================DELETE RECOMMENDATION================================= 
    $(document).on("click", '.deleterecommendation',function(e){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });

      e.preventDefault(); 

      var id = $(this).val();

      var form = document.querySelector('#submitUpdateFormContent');
      var formdata = new FormData(form)

      $.ajax({
        type : 'POST',
        url : '/delete/' + id,
        cache: false,
        contentType: false,
        processData: false,
        data : formdata,
        success : function(data){

          toastr.success("Recommendation deleted!");

          $('#recommendation_div'+id).hide();

          }
        });
      
    });

// ========================****** UPDATE AUDIT FINDING IETM ******================================= 

    $(document).on("click", '.submit_updateauditfinding',function(e){

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      e.preventDefault(); 

      // $('#myModal').modal('hide')

      var id = $('#update_id').val();

      var srow = $('#formcontent_row');
      var frow = $('#fcontent_row');
      var form = document.querySelector('#submitFormContent');
      var formdata = new FormData(form)



      var f = tinymce.get("findings").getContent();
      var fs = f.replace(/&nbsp;/g, "").replace(/(<p[^>]+?>|<p>|<\/p>)/g, "").replace(/(<br>| |\n|\r)/g, "");

      var r = tinymce.get("recommendations").getContent();
      var rs = r.replace(/&nbsp;/g, "").replace(/(<p[^>]+?>|<p>|<\/p>)/g, "").replace(/(<br>| |\n|\r)/g, "");

      if ($.trim(rs).length == 0 && $.trim(fs).length == 0) {
        toastr.error("Please fill up Findings and Recommendations");
          $('#approve_report_'+ id).hide();
          $('#cancel_approve_report_'+ id).show();
      }else if ($.trim(rs).length == 0) {
        toastr.error("Please fill up Recommendations");
          $('#approve_report_'+ id).hide();
          $('#cancel_approve_report_'+ id).show();
      }else if ($.trim(fs).length == 0) {
        toastr.error("Please fill up Findings");
          $('#approve_report_'+ id).hide();
          $('#cancel_approve_report_'+ id).show();
      }else{
        $.ajax({
        type : 'POST',
        url : '/update_auditfinding/' + id ,
        cache: false,
        contentType: false,
        processData: false,
        data : formdata,
        success : function(data){
          var d = eval('data='+data);

          $('#myModal').modal('hide')
          // $('#flashMessage').show().delay(3000).slideUp(350);
          // $('#flashMessage').delay(3000).slideUp(350);
          // $('#create_message').hide();
          // $('#update_message').show();

          toastr.success('Audit Finding and Recommendation has been successfully updated!');
          $("#fauditarea_"+id).html('<center>'+d.custom_auditarea+'</center>');
          $("#fsubauditarea_"+id).html('<center>'+d.sub_auditarea+'</center>');

          var rows = $('.treffect_'+id);
          rows.css('background', '#00cc66');
          rows.fadeOut(1000);
          rows.css('background', '').fadeIn(1000);

        }
      });
      }

    });

//=================OPEN FOR UPDATE AUDIT FINDING ITEM=====================

    $(document).on("click", '.addsubfinding',function(){
        $('#comments').hide();

        $('#submit').css('display', 'none')
        $('#update_af').css('display', 'none')
        $('#add_subf').css('display', 'inline-block')

        var id_c = $(this).attr('id').replace('addsubfinding_', '');
        var a_name = $('#agency_name').text()
        var f_id = $('#f_id').text()

        $('#myModalLabel').text('Add Sub-Audit Finding to Item No. ' + id_c);        
        $('#_id').val(f_id);
        $('#update_id').val(id_c);

      
        $.ajax({
          type: 'GET',
          url: '/view_audit_finding',
          cache: false,
          data: {id_c:id_c, f_id:f_id},
          success: function (data) {

            var d = data.finding[0];

            // console.log(data.rcomment);

            tinymce.get("findings").setContent("");
            tinymce.get("recommendations").setContent("");
            $('#s_audit').val("");
            $('#c_audit').val(d.custom_auditarea);
            $( "select#scope_a" ).val(d.audit_area).trigger('change');

            $('#scope_a').select2('enable', true);
            $('#tag_a').select2('enable', true);
            $('.enable_ca').css('display', 'none');
            $('.disable_ca').css('display', 'none');
            $('#c_audit').attr('disabled', true);
            $('.fa-question-circle').css('display', 'none');

            

         }

      });
    });

// ========================ADD AUDIT FINDING IETM================================= 
    $(document).on("click", '.submit_addsubfinding',function(e){

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      e.preventDefault(); 

      

      var id = $('#f_id').text()
      var idafno = $('#update_id').val();
      var form = document.querySelector('#submitUpdateFormContent');
      var formdata = new FormData(form)

      // var f = tinymce.get("findings").getContent();
      // var fs = f.replace(/&nbsp;/g, "").replace(/(<p[^>]+?>|<p>|<\/p>)/g, "").replace(/(<br>| |\n|\r)/g, "");

      // var r = tinymce.get("recommendations").getContent();
      // var rs = r.replace(/&nbsp;/g, "").replace(/(<p[^>]+?>|<p>|<\/p>)/g, "").replace(/(<br>| |\n|\r)/g, "");

        $.ajax({
        type : 'POST',
        url : '/store_formsubcontent/' + id + '/' + idafno,
        cache: false,
        contentType: false,
        processData: false,
        data : formdata,
        success : function(data){
          // var d = data.f_content[0];
          // console.log(data.f_content.auditfinding);
          toastr.success("Sub Audit Finding has been added successfully!");
          $('#subfindingrecommendationtable').show().append('<tr style="border: 1px solid black"><td valign="top" style="border: 1px solid black; width:710px "><div class="col-xs-12 col-md-12"> <div id="findingscontainer" style="min-height: 200px; color: black">'+data.f_content.auditfinding+'</div></div></td><td valign="top" style="border: 1px solid black; width: 710px"><div class="col-xs-12 col-md-12"> </div></td>   </tr>');
        },
        error : function(){
        }
      });
      

      
});

    // ========================SAVE UPDATE FINDINGS================================= 
    $(document).on("click", '.updatefinding',function(e){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });

      e.preventDefault(); 

      var id = $(this).val();

      var form = document.querySelector('#submitUpdateFormContent');
      var formdata = new FormData(form)

      var afr = tinymce.get("findings_u").getContent();
      var fs = afr.replace(/&nbsp;/g, "").replace(/(<p[^>]+?>|<p>|<\/p>)/g, "").replace(/(<br>| |\n|\r)/g, "");

      if ($.trim(fs).length == 0) {
        toastr.error("Please write a recommendation");
      }else{

      $.ajax({
        type : 'POST',
        url : '/updatefinding/' + id,
        cache: false,
        contentType: false,
        processData: false,
        data : formdata,
        success : function(data){

          toastr.success("Recommendation updated!");

          var d = data;

          $("#findingscontainer").empty().append('<br>'+d.auditfinding);

          }
        });
      }
    });





// ========================****** ARCHIVE ITEM ******================================= //

    $(document).on("click", '.archive',function(){

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

        var id_c = $(this).attr('id').replace('btn_archive_', '');
        var f_id = $('#f_id').text()

        $.ajax({
          type: 'POST',
          url: '/archive_audit_finding/' + id_c,
          cache: false,
          success: function (data) {
            alert(data);
         }
      });
    });
// ==================****** UNARCHIVE FUNCTION ******========================== //

    $(document).on("click", '.unarchive',function(){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        var id_c = $(this).attr('id').replace('btn_unarchive_', '');
        var f_id = $('#f_id').text()

        $.ajax({
          type: 'POST',
          url: '/unarchive_audit_finding/' + id_c,
          cache: false,
          success: function (data) {
            alert(data);
         }
      });
    }); 
// ==================****** VIEW - UPDATE FORM 001 ******========================== //
    $(document).on("click", '.vu_form001',function(){

        var id = $(this).val();
      
        $.ajax({
          type: 'GET',
          url: '/getview_update_form001/' + id,
          cache: false,
          success: function (data) {

            var arr_amem = data.amember_id.split(',');
            var arr_sec = data.secretariat_id.split(',');
            var arr_scope = data.scope_audit.split(',');

            $('.update_auditreport').val(id);
            $('#vu_agencies').val(data.agency_id).trigger('change');
            $('#vu_pap').val(data.pap);
            $('#vu_isupervisor').val(data.supervisor);
            $( "select#vu_tleader" ).val(data.tleader_id).trigger('change');
            $('#vu_overseer').val(data.overseer);
            $('#vu_datefrom').val(data.datefrom);
            $('#vu_dateto').val(data.dateto);

            tinymce.get("vu_background").setContent(data.background);
            tinymce.get("vu_goodpoint").setContent(data.goodpoint);
            tinymce.get("vu_auditees").setContent(data.auditees);

            for(var i = 0; i<arr_amem.length; i++){
              $("select#vu_audit_mem").val(arr_amem).trigger('change');
            }
            for(var i = 0; i<arr_sec.length; i++){
              $("select#vu_secretariat").val(arr_sec).trigger('change');
            } 
            for(var i = 0; i<arr_scope.length; i++){
              $("select#vu_scopeaudit").val(arr_scope).trigger('change');
            }
         }
      });

    });
//=============================STORE FORM 001=============================
    $(document).on("click", '.open_upload',function(e){

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      e.preventDefault(); 
      var id = $(this).val();
      var no = $('#afno').text();
      var fno = $('#form001no').val();

      $('#afnoc').val(id);
      $('#form001noc').val(fno);
      $('.uploadfile').val(id);

        $.ajax({
          type: 'GET',
          url: '/get_support_doc/' + id,
          cache: false,
          data: {id:id, fno:fno},
          success: function (data) {
            $('#file_row').remove()
            var d = data[0];
            var table = $('#datatablefile').DataTable({
              destroy: true,
              searching: false,
              order: [[ 0, 'asc' ]]
            });
            var sam = ('<a href="../files/scan.pdf" target="_blank" download>sasa</a>');
     
            jQuery.each(data, function(i, d) {
             table.row.add([
                  '<center>'+d.filename+'</center>',
                  '<center>'+d.description+'</center>',
                  '<center><a href="../files/'+d.file+'" target="_blank" download>'+d.file+'</a></center>',
                  '<center>'+d.uploaded_by+'</center>',
                  '<center>'+d.filetype+'</center>',
              ]).draw();
            });
            table.clear();
         }
      });
    });

//=============================UPLOAD SUPPORTING FILES=============================

    $(document).on("click", '.uploadfile',function(e){

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      e.preventDefault(); 

      $('.uploadfile').hide();
      $('.loading').show()

      var frow = $('#audit_reportrow');
      var form = document.querySelector('#uploadFileForm');
      var formdata = new FormData(form)

      $.ajax({
        type : 'POST',
        url : '/upload',
        cache: false,
        contentType: false,
        processData: false,
        data : formdata,
        success : function(data){

          if (data == 'Invalid') {
              $("#uploadFileForm")[0].reset();
              $('.uploadfile').show();
              $('.loading').hide()
              alert('Invalid File .. Please try again!');
          }else{
             var table = $('#datatablefile').DataTable({
                destroy: true,
                searching: false,
                order: [[ 0, 'asc' ]]
              });

              jQuery.each(data, function(i, d) {
               table.row.add([
                    '<center>'+d.filename+'</center>',
                    '<center>'+d.description+'</center>',
                    '<center><a href="../files/'+d.file+'" target="_blank" download>'+d.file+'</a></center>',
                    '<center>'+d.uploaded_by+'</center>',
                    '<center>'+d.filetype+'</center>',
                ]).draw();
              });
              table.clear();

              $('#flashUploadMessage').removeClass('alert-danger').addClass('alert-success').show().delay(3000).slideUp(350);
              $('#upload_success').show();
              $('#upload_failed').hide();
              $("#uploadFileForm")[0].reset();
              $('.uploadfile').show();
              $('.loading').hide()
            }
          },
        error : function(data){
            $('#flashUploadMessage').removeClass('alert-success').addClass('alert-danger').show().delay(3000).slideUp(350);
            $('#upload_success').hide();
            $('#upload_failed').show();
            $('.uploadfile').show();
            $('.loading').hide();
        }
        });
    });

//=============================ADD AUDIT FINDING COMMENT=============================

$('#recommendation_comment').keyup(function(){
    if($(this).text().length !=0){
      $('.add_rcomment').attr('disabled', false);  
      $('#recommendation_comment1').val($(this).text());
    }else{
      $('.add_rcomment').attr('disabled',true);
    }  
});

$('#findings_comment').keyup(function(){
    if($(this).text().length !=0){
        $('.add_fcomment').attr('disabled', false);    
          $('#findings_comment1').val($(this).text());
    }else{
        $('.add_fcomment').attr('disabled',true);
    }
});

$('#findings_recommendation').keyup(function(){
    if($(this).text().length !=0){
        $('.save_auditrecommendation').attr('disabled', false);    
          $('#findings_recommendation1').val($(this).text());
    }else{
        $('.save_auditrecommendation').attr('disabled',true);
    }
});

$(document).on("click", '.add_rcomment',function(e){

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      e.preventDefault(); 

      var id = $('#update_id').val();
      var f_id = $('#f_id').text()
      var form = document.querySelector('#submitFormContent');
      var formdata = new FormData(form)

      $.ajax({
        type : 'POST',
        url : '/add_rcomment/' + id,
        cache: false,
        contentType: false,
        processData: false,
        data : formdata,
        success : function(data){
          $('#recommendation_comment').text('');
          $('.add_rcomment').attr('disabled',true);
          
            setInterval(function(){

              $.ajax({
                type : 'GET',
                url : '/getr_comment',
                cache: false,
                data: {id:id, f_id:f_id},
                success : function(data){
                  $("#comment_container ul").empty();
                  var d = data[0];

                    jQuery.each(data, function(i, d) {
                      $("#comment_container ul").append('<hr><li><a><span class="image"><img style="width:25px; height:25px;" src="../images/user.png " alt="Profile Image" /></span><span><span> <b>'+d.comment_by+'</b></span><span class="time pull-right"><i>'+ jQuery.timeago(d.created_at) +'</i></span></span><br><span class="message" style="margin-left:30px;">'+d.comment+'</span></a></li>');
                    });

                  }
                });

              }, 1000);

          }
        });

});   

$(document).on("click", '.add_fcomment',function(e){

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      e.preventDefault(); 

      var id = $('#update_id').val();

      var role  = $('#user_role').val();
      var f_id = $('#f_id').text()
      var form = document.querySelector('#submitFormContent');
      var formdata = new FormData(form)

      // alert($('#_id').val());

      $('#findings_comment').text('');
      $('.add_fcomment').attr('disabled',true);

      $.ajax({
        type : 'POST',
        url : '/add_fcomment/' + id,
        cache: false,
        contentType: false,
        processData: false,
        data : formdata,
        success : function(data){          

            setInterval(function(){

              $.ajax({
                type : 'GET',
                url : '/getf_comment',
                data: {id:id, f_id:f_id},
                success : function(data){
                  $("#commentf_container ul").empty();
                   var d = data[0];

                    jQuery.each(data, function(i, d) {
                      $("#commentf_container ul").append('<hr><li><a><span class="image"><img style="width:25px; height:25px;" src="../images/user.png " alt="Profile Image" /></span><span><span> <b>'+d.comment_by+'</b></span><span class="time pull-right"><i>'+ jQuery.timeago(d.created_at) +'</i></span></span><br><span class="message" style="margin-left:30px;">'+d.comment+'</span></a></li>');
                    }); 

                  }
                });

              }, 1000);

          }
        });

});      

//=============================Approve AUDIT FINDING COMMENT=============================

$(document).on("click", '.approve',function(e){

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      e.preventDefault(); 

      var id = $(this).val();

      // alert(id);

      $.ajax({
        type : 'POST',
        url : '/approve_item/' + id,
        cache: false,
        contentType: false,
        processData: false,
        success : function(data){

          toastr.success("Audit Finding Item has been approved!");
          $('#status_' + id).text('');
          $('#status_' + id).append('<h5 class="text-success"> <i class="fa fa-check" aria-hidden="true"></i> approved </h5>');
          $('#btn_approve_'+id).attr("disabled", "disabled");


        }



      });

});

//=============================Approve AUDIT FINDING COMMENT=============================

$(document).on("click", '.approve_report',function(e){

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      e.preventDefault(); 

      var id = $(this).val();

      // alert(id);

      $.ajax({
        type : 'POST',
        url : '/approve_report/' + id,
        cache: false,
        contentType: false,
        processData: false,
        success : function(data){

          toastr.success("Audit Report has been approved!");
          $('#approve_report_'+ id).hide();
          $('#cancel_approve_report_'+ id).show();
          // $('#status_' + id).text('');
          // $('#status_' + id).append('<h5 class="text-success"> <i class="fa fa-check" aria-hidden="true"></i> approved </h5>');
          // $('#btn_approve_'+id).attr("disabled", "disabled");


        }



      });

});

$(document).on("click", '.cancel_approve_report',function(e){

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      e.preventDefault(); 

      var id = $(this).val();

      // alert(id);

      $.ajax({
        type : 'POST',
        url : '/cancel_approve_report/' + id,
        cache: false,
        contentType: false,
        processData: false,
        success : function(data){

          toastr.success("Audit Report Approval has been cancelled!");

          $('#cancel_approve_report_'+ id).hide();
          $('#approve_report_'+ id).show();
        }
    });
});


//=============================Send to Auditee=============================

$(document).on("click", '.send_to_auditee',function(e){

  // alert();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      e.preventDefault(); 

      var id = $(this).val();

      $.ajax({
        type : 'POST',
        url : '/send_to_auditee/' + id,
        cache: false,
        contentType: false,
        processData: false,
        success : function(data){

          toastr.success("Audit Report has been successfully sent to Auditee!");

          window.location = '/monitoring-reports';

        }
    });
});


});    