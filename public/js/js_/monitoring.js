$(document).ready(function() {

//===========================FROALA HTML EDITOR===========================
  $(function() {
    tinymce.init({
      selector: 'textarea',
      height: 120,
      menubar: false,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor textcolor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code help wordcount'
      ],
      toolbar: 'fontselect fontsizeselect | undo redo |  formatselect | table | bold italic forecolor backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ',
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


  



//********************************************************* VIEW CONTENT FOR MGT ACTION *********************************************************//
	$(document).on("click", '.vc_ma',function(){

        $('#submit').css('display', 'none')
        $('#update_af').css('display', 'inline-block')

		// id_c = auditfinding_no
		// id = form001 id
        var id_c = $(this).attr('id').replace('vc_ma_', ''); 
        var id = $(this).val();

        $('#f001_id').val(id);
        $('#af_id').val(id_c);
        $('#f001_id1').val(id);
        $('#af_id1').val(id_c);

        var a_name = $('#agency_name').text()
        var f_id = $('#f_id').text()
        $('div#af_recommendations1').empty();

        $('#viewContentModalLabel').text(a_name + ' Audit Finding No. ' + id_c); 
        $('#viewFirstFollowUPModalLabel').text(a_name + ' Audit Finding No. ' + id_c);       
        $.ajax({
          type: 'GET',
          url: '/answer_finding',  
          cache: false,
          data: {id_c:id_c, f_id:f_id},
          success: function (data) {
            var d = data.finding[0];
            var m = data.mgt_action[0];
            var f1 = data.f1;
            var mgtdate = data.mgtdate;
            var mcadate = data.mcadate;
             $('#recommendation_div ol').empty();

            if (!m) {
            	// var c = tinymce.get("m_action").setContent('');
            	$('#submit_mgtaction').show();
            	$('#submit_mgtaction_edit').hide();
            }else{
            	$('#submit_mgtaction_edit').show();
            	$('#submit_mgtaction').hide();
	            // var c = tinymce.get("m_action").setContent(m.imanagement_action);

            }

            var c_area = d.custom_auditarea;

            var c_areaVal = c_area.replace(/;/g, "<br>")

            if (f1.for_management_action == 'i') {
              $('#auditarea').text(d.audit_area);
              $('#subauditarea').text(d.sub_auditarea);
              $('#customarea').html(c_areaVal);
              $('#af_no').text(d.auditfinding_no);
              $('#af_findings').html(d.auditfinding);
              $('#af_recommendations').html('');
              jQuery.each(data.recommendations, function(i, d) {
                $('#recommendation_div ol').append('<div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-5">'+d.afrecommend+'</div><div class="col-xs-6 col-md-7"><center><textarea name="mgtaction" id="mgtaction_'+d.id+'" placeholder="Write your management action here . . . " style="min-height:150px; min-width:470px; max-width:470px;">'+d.management_action+'</textarea><br><button class="btn btn-info btn-sm submit_mgtaction" type="button" style="margin-top:10px; margin-left:30px;" value="'+d.id+'">Submit</button></center></div></div><hr>');

                // $('#recommendation_mgtaction_div').html('<button>Answer</button>');
              });
            }else if(f1.for_management_action == 1){
              $('#auditarea1').text(d.audit_area);
              $('#subauditarea1').text(d.sub_auditarea);
              $('#af_no1').text(d.auditfinding_no);
              $('#af_findings1').html(d.auditfinding);
              jQuery.each(data.recommendations, function(i, d) {
                if (d.status == 'CLOSED') {
                  $('div#af_recommendations1').append('<div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px">'+d.afrecommend+'</div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.updated_at+'</b><br>'+d.management_action+'</span></div><div class="col-xs-6 col-md-4" style="width:312px; margin-left:5px"><span><b>'+d.ffu_updated_at+'</b><br>'+d.first_fu+'</span></div><div class="col-xs-1 col-md-1" style="width:120px"><b class="pull-right" style="font-size:20px">'+d.status+'</b></div></div><div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px"></div></div><hr>');
                }else{
                  $('div#af_recommendations1').append('<div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px">'+d.afrecommend+'</div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.updated_at+'</b><br>'+d.management_action+'</span></div><div class="col-xs-6 col-md-4" style="width:312px; margin-left:5px"><span><b>'+d.ffu_updated_at+'</b><br>'+d.first_fu+'</span></div><div class="col-xs-1 col-md-1" style="width:120px"><b class="pull-right" style="font-size:20px">'+d.status+'</b></div></div><div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px"></div><div class="col-xs-6 col-md-2"><textarea name="mgtaction" id="fumgtaction_'+d.id+'" placeholder="Write your management action here . . . " style="min-height:150px; min-width:300px; max-width:300px; margin-left:0px !important">'+d.ffu_mgmtaction+'</textarea><br><button class="btn btn-info btn-sm submit_fumgmtaction" type="button" style="margin-top:10px; width:300px;" value="'+d.id+'">Submit</button></div></div><hr>');
                }
                
              });    
            }else if(f1.for_management_action == 2){
              $('#auditarea1').text(d.audit_area);
              $('#subauditarea1').text(d.sub_auditarea);
              $('#af_no1').text(d.auditfinding_no);
              $('#af_findings1').html(d.auditfinding);
              $('#af_recommendations1').html(d.auditrecommend);
              jQuery.each(data.recommendations, function(i, d) {
                if (d.status == 'CLOSED') {
                  $('div#af_recommendations1').append('<div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px">'+d.afrecommend+'</div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.updated_at+'</b><br>'+d.management_action+'</span></div><div class="col-xs-6 col-md-4" style="width:312px; margin-left:5px"><span><b>'+d.ffu_updated_at+'</b><br>'+d.first_fu+'</span></div><div class="col-xs-1 col-md-1" style="width:120px"><b class="pull-right" style="font-size:20px">'+d.status+'</b></div></div><div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px"></div></div><hr>');
                }else if(d.ffu_status == 'CLOSED'){
                  $('div#af_recommendations1').append('<div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px">'+d.afrecommend+'</div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.updated_at+'</b><br>'+d.management_action+'</span></div><div class="col-xs-6 col-md-4" style="width:312px; margin-left:5px"><span><b>'+d.ffu_updated_at+'</b><br>'+d.first_fu+'</span></div><div class="col-xs-1 col-md-1" style="width:120px"><b class="pull-right" style="font-size:20px">'+d.ffu_status+'</b></div></div><div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px"></div><div class="col-xs-6 col-md-4" style="width:312px; margin-left:5px"><span><b>'+d.ffumgmt_updated_at+'</b><br>'+d.ffu_mgmtaction+'</span></div><div class="col-xs-1 col-md-1" style="width:312px; margin-left:5px"><span><b>'+d.sfu_updated_at+'</b><br>'+d.second_fu+'</span></div></div></div><hr>');
                }else{
                  $('div#af_recommendations1').append('<div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px">'+d.afrecommend+'</div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.updated_at+'</b><br>'+d.management_action+'</span></div><div class="col-xs-6 col-md-4" style="width:312px; margin-left:5px"><span><b>'+d.ffu_updated_at+'</b><br>'+d.first_fu+'</span></div><div class="col-xs-1 col-md-1" style="width:120px"><b class="pull-right" style="font-size:20px">'+d.ffu_status+'</b></div></div><div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px"></div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.ffumgmt_updated_at+'</b><br>'+d.ffu_mgmtaction+'</span></div><div class="col-xs-6 col-md-4" style="width:312px; margin-left:5px"><span><b>'+d.sfu_updated_at+'</b><br>'+d.second_fu+'</span></div></div><div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px"></div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><textarea name="mgtaction" id="fumgtaction_'+d.id+'" placeholder="Write your management action here . . . " style="min-height:150px; min-width:300px; max-width:300px; margin-left:0px !important">'+d.sfu_mgmtaction+'</textarea><br><button class="btn btn-info btn-sm submit_fumgmtaction" type="button" style="margin-top:10px; width:300px;" value="'+d.id+'">Submit</button></div></div><hr>');
                }
                
              });  
              

            }else if(f1.for_management_action == 3){
              $('#auditarea1').text(d.audit_area);
              $('#subauditarea1').text(d.sub_auditarea);
              $('#af_no1').text(d.auditfinding_no);
              $('#af_findings1').html(d.auditfinding);
              $('#af_recommendations1').html(d.auditrecommend);
              $('#mgt_actions1').html(m.imanagement_action);
              $('#mca1').html(m.imonitoring_mgtaction);
              $('#status1').html(m.final_status);
              $('#mgt_actions1_f1').show().html(m.fdate == ' ' ? ' ' : '<br><b>' + $.datepicker.formatDate('MM dd, yy ', new Date(m.fdate)) + '</b><br><br>'+ m.fmanagement_action);
              $('#mgt_actions1_f2').show().html(m.sdate == ' ' ? ' ' : '<br><b>' + $.datepicker.formatDate('MM dd, yy ', new Date(m.sdate)) + '</b><br><br>'+ m.smanagement_action);
              $('#mca1_f1').show().html(m.fmmgtaction_date == '' ? ' ' : '<br><b>' + $.datepicker.formatDate('MM dd, yy ', new Date(m.fmmgtaction_date)) + '</b><br><br>'+ m.fmonitoring_mgtaction);
              $('#mca1_f2').show().html(m.smmgtaction_date == '' ? ' ' : '<br><b>' + $.datepicker.formatDate('MM dd, yy ', new Date(m.smmgtaction_date)) + '</b><br><br>'+ m.smonitoring_mgtaction);

              $('#answer_followup1_div').hide();
              tinymce.get("mgt_actions_answer2").setContent(m.smanagement_action);
              tinymce.get("mgt_actions_answer3").setContent(m.tmanagement_action);
              $('#answer_followup2_div').hide();
              if (m.final_status == 'CLOSED') {
                $('#answer_followup2_div').hide();
                $('#answer_followup3_div').hide();
              }else{
                $('#answer_followup3_div').show();
              }

            }

         }
      });
    });

//********************************************************* SUBMIT MANAGEMENT ACTION *********************************************************//
	$(document).on("click", '.submit_mgtaction',function(e){
		e.preventDefault();
		$.ajaxSetup({
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

    var id = $(this).val();
    var m = $('#mgtaction_'+id).val();
    var ms = $('#mgtactions').empty().val(m);

    var form = document.querySelector('#FormSubmitMgtAction');
    var formdata = new FormData(form)

		$.ajax({
      type : 'POST',
      url : '/submit_mgtaction/' + id,
      cache: false,
      contentType: false,
      processData: false,
      data : formdata,
      success : function(data){
      	toastr.success("Recommendation has been successfully answered!"); 
        }
    });
	});
//********************************************************* SUBMIT FIRST FOLLOW-UP MANAGEMENT ACTION *********************************************************//
  $(document).on("click", '.submit_fumgmtaction',function(e){
    e.preventDefault();
    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

    var id = $(this).val();
    var m = $('#fumgtaction_'+id).val();
    var ms = $('#mgtactions').empty().val(m);

    var form = document.querySelector('#FormSubmitMgtAction');
    var formdata = new FormData(form)

    $.ajax({
      type : 'POST',
      url : '/submit_mgtaction/' + id,
      cache: false,
      contentType: false,
      processData: false,
      data : formdata,
      success : function(data){
        toastr.success("Recommendation has been successfully answered!"); 
      },
      error : function(data){
        toastr.error("Please write your management action!"); 
      }
    });
  });

//********************************************************* SUBMIT MANAGEMENT ACTION *********************************************************//
  $(document).on("click", '.submit_firstfu',function(e){
    e.preventDefault();
    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var id = $(this).val();
      var f = $('#ffu_'+id).val();
      var fs = $('#ffus').empty().val(f);
      var fstatus = $('#fstatus_'+id).val();
      var fs = $('#fstatuss').empty().val(fstatus);

      var form = document.querySelector('#FormSubmitMonitoring');
      var formdata = new FormData(form)

      // alert(fstatus);

      $.ajax({
        type : 'POST',
        url : '/submit_ffu/' + id,
        cache: false,
        contentType: false,
        processData: false,
        data : formdata,
        success : function(data){
          toastr.success("First follow-up added!"); 
        },
        error : function(data){
          toastr.error("Please fill up follow-up action field and select status!"); 
        }
      });
  });

//********************************************************* SUBMIT MANAGEMENT ACTION *********************************************************//
  $(document).on("click", '.submit_secondfu',function(e){
    e.preventDefault();
    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var id = $(this).val();
      var f = $('#ffu_'+id).val();
      var fs = $('#ffus').empty().val(f);
      var fstatus = $('#fstatus_'+id).val();
      var fs = $('#fstatuss').empty().val(fstatus);

      var form = document.querySelector('#FormSubmitMonitoring');
      var formdata = new FormData(form)

      // alert(fstatus);

      $.ajax({
        type : 'POST',
        url : '/submit_sfu/' + id,
        cache: false,
        contentType: false,
        processData: false,
        data : formdata,
        success : function(data){
          toastr.success("Second follow-up added!"); 
        },
        error : function(data){
          toastr.error("Please fill up follow-up action field and select status!"); 
        }
      });
  });

//********************************************************* SUBMIT MANAGEMENT ACTION *********************************************************//
  $(document).on("click", '.submit_thirdfu',function(e){
    e.preventDefault();
    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var id = $(this).val();
      var f = $('#ffu_'+id).val();
      var fs = $('#ffus').empty().val(f);
      var fstatus = $('#fstatus_'+id).val();
      var fs = $('#fstatuss').empty().val(fstatus);

      var form = document.querySelector('#FormSubmitMonitoring');
      var formdata = new FormData(form)

      // alert(fstatus);

      $.ajax({
        type : 'POST',
        url : '/submit_tfu/' + id,
        cache: false,
        contentType: false,
        processData: false,
        data : formdata,
        success : function(data){
          toastr.success("Third follow-up added!"); 
        },
        error : function(data){
          toastr.error("Please fill up follow-up action field and select status!"); 
        }
      });
  });

//********************************************************* SUBMIT FOLLOW-UP MANAGEMENT ACTION *********************************************************//
  $(document).on("click", '.submit_mgtaction1',function(e){
    e.preventDefault();
    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      
      var id = $('#af_id1').val();
      var form = document.querySelector('#FormSubmitMonitoringFollowUp');
      var formdata = new FormData(form)

    $.ajax({
        type : 'POST',
        url : '/submit_mgtaction1/' + id,
        cache: false,
        contentType: false,
        processData: false,
        data : formdata,
        success : function(data){
          toastr.success("Follow-up has been successfully addressed!");
          $('#submit_mgtaction_edit').show();
              $('#submit_mgtaction').hide();
                $('#span_' + id).empty().text('update answer');
        }
        });
  });

//********************************************************* UPDATE MANAGEMENT ACTION *********************************************************//
	$(document).on("click", '.submit_mgtaction_edit',function(e){
		e.preventDefault();
		$.ajaxSetup({
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    var id = $('#af_id').val();
	    var form = document.querySelector('#FormSubmitMgtAction');
      	var formdata = new FormData(form)

		$.ajax({
        type : 'POST',
        url : '/submit_mgtaction_edit/' + id,
        cache: false,
        contentType: false,
        processData: false,
        data : formdata,
        success : function(data){
        	toastr.success("Management Action has been successfully updated!");

          }
        });
	});
//**************************************************** SEND TO IAS MANAGEMENT ACTION *********************************************************//
    $(document).on("click", '.send_ias_mgtaction',function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var id = $(this).val();

        $.ajax({
        type : 'POST',
        url : '/send_ias_mgtaction/' + id,
        cache: false,
        contentType: false,
        processData: false,
        success : function(data){
            toastr.success("Management Action has been successfully sent to DOST-IAS!");
            $('#send_ias_mgtaction_'+id).attr('disabled',true);
            $('button').val(id).attr('disabled',true);
          }
        });
    });
//*******************************************IAS VIEW CONTENT FOR AUDITEE'S MGT ACTION ******************************************************//

    $(document).on("click", '.ias_vc_ma',function(){

        $('#submit').css('display', 'none');
        $('#update_af').css('display', 'inline-block');

        var id_c = $(this).attr('id').replace('ias_vc_ma_', ''); 
        var id = $(this).val();

        $('#f001_id').val(id);
        $('#af_id').val(id_c);

        var a_name = $('#agency_name').text()
        var f_id = $('#f_id').text()

        $('#viewContentModalLabel').text(a_name + ' Audit Finding No. ' + id_c);   
        $('#viewMonitorFollowUpModalLabel').text(a_name + ' Audit Finding No. ' + id_c);       
        $("div#mgt_actions").empty();
        $("div#af_recommendations").empty();
        $.ajax({
          type: 'GET',
          url: '/answer_finding',  
          cache: false,
          data: {id_c:id_c, f_id:f_id},
          success: function (data) {
            var d = data.finding[0];
            var m = data.mgt_action[0];
            var f1 = data.f1;
            var date = data.mgt_action_date;
            var action = data.action;
            var status = data.status;

            $('#auditarea').text(d.audit_area);
            $('#subauditarea').text(d.sub_auditarea);
            $('#af_no').text(d.auditfinding_no);
            $('#af_findings').html(d.auditfinding);


            if (f1.for_management_action == 1) {
              jQuery.each(data.recommendations, function(i, d) {
                $('div#af_recommendations').append('<div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px">'+d.afrecommend+'</div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span>'+d.management_action+'</span></div><div class="col-xs-6 col-md-2"><textarea name="mgtaction" id="ffu_'+d.id+'" placeholder="Write your follow-up action here . . . " style="min-height:150px; min-width:300px; max-width:300px; margin-left:0px !important">'+d.first_fu+'</textarea><br><br>Select Status:  <select class="form-control" name="afr_status" id="fstatus_'+d.id+'" style="margin-top:10px; width:300px"><option selected hidden value="'+d.status+'">'+d.status+'</option><option value="OPEN">OPEN</option><option value="OPEN but partially addressed">OPEN but partially addressed</option><option value="CLOSED">CLOSED</option></select><button class="btn btn-info btn-sm submit_firstfu" type="button" style="margin-top:10px; width:300px;" value="'+d.id+'">Submit</button></div></div><hr>');
              });              
            }else if(f1.for_management_action == 2){
              jQuery.each(data.recommendations, function(i, d) {
                if (d.status == 'CLOSED') {
                  $('div#af_recommendations').append('<div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px">'+d.afrecommend+'</div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.created_at+'</b><br>'+d.management_action+'</span></div><div class="col-xs-6 col-md-4" style="width:312px; margin-left:5px"><span><b>'+d.ffu_updated_at+'</b><br>'+d.first_fu+'</span></div><div class="col-xs-1 col-md-1" style="width:120px"><b class="pull-right" style="font-size:20px">'+d.status+'</b></div></div><div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px"></div></div><hr>');
                }else{
                  $('div#af_recommendations').append('<div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px">'+d.afrecommend+'</div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.created_at+'</b><br>'+d.management_action+'</span></div><div class="col-xs-6 col-md-4" style="width:312px; margin-left:5px"><span><b>'+d.ffu_updated_at+'</b><br>'+d.first_fu+'</span></div><div class="col-xs-1 col-md-1" style="width:120px"><b class="pull-right" style="font-size:20px">'+d.status+'</b></div></div><div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px"></div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.ffumgmt_updated_at+'</b><br>'+d.ffu_mgmtaction+'</span></div><div class="col-xs-6 col-md-2"><textarea name="mgtaction" id="ffu_'+d.id+'" placeholder="Write your follow-up action here . . . " style="min-height:150px; min-width:300px; max-width:300px; margin-left:0px !important">'+d.second_fu+'</textarea><br><br>Select Status:  <select class="form-control" name="afr_status" id="fstatus_'+d.id+'" style="margin-top:10px; width:300px"><option selected hidden value="'+d.ffu_status+'">'+d.ffu_status+'</option><option value="OPEN">OPEN</option><option value="OPEN but partially addressed">OPEN but partially addressed</option><option value="CLOSED">CLOSED</option></select><button class="btn btn-info btn-sm submit_secondfu" type="button" style="margin-top:10px; width:300px;" value="'+d.id+'">Submit</button></div></div><hr>');
                }
                
              });   

            }else if(f1.for_management_action == 3){
              if (d.status == 'CLOSED') {
                stat = 'CLOSED'
              }else if (d.ffu_status == 'CLOSED') {}{
                stat = 'CLOSED'
              }

              jQuery.each(data.recommendations, function(i, d) {
                if (d.status == 'CLOSED' || d.ffu_status == 'CLOSED') {
                  $('div#af_recommendations').append('<div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px">'+d.afrecommend+'</div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.created_at+'</b><br>'+d.management_action+'</span></div><div class="col-xs-6 col-md-4" style="width:312px; margin-left:5px"><span><b>'+d.ffu_updated_at+'</b><br>'+d.first_fu+'</span></div><div class="col-xs-1 col-md-1" style="width:120px"><b class="pull-right" style="font-size:20px">'+stat+'</b></div></div><div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px"></div></div><hr>');
                }else{
                  $('div#af_recommendations').append('<div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px">'+d.afrecommend+'</div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.created_at+'</b><br>'+d.management_action+'</span></div><div class="col-xs-6 col-md-4" style="width:312px; margin-left:5px"><span><b>'+d.ffu_updated_at+'</b><br>'+d.first_fu+'</span></div><div class="col-xs-1 col-md-1" style="width:120px"><b class="pull-right" style="font-size:20px">'+d.ffu_status+'</b></div></div><div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px"></div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.ffumgmt_updated_at+'</b><br>'+d.ffu_mgmtaction+'</span></div><div class="col-xs-6 col-md-4" style="width:312px; margin-left:5px"><span><b>'+d.sfumgmt_updated_at+'</b><br>'+d.second_fu+'</span></div></div><div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px"></div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.sfumgmt_updated_at+'</b><br>'+d.sfu_mgmtaction+'</span></div><div class="col-xs-6 col-md-2"><textarea name="mgtaction" id="ffu_'+d.id+'" placeholder="Write your follow-up action here . . . " style="min-height:150px; min-width:300px; max-width:300px; margin-left:0px !important">'+d.third_fu+'</textarea><br><br>Select Status:  <select class="form-control" name="afr_status" id="fstatus_'+d.id+'" style="margin-top:10px; width:300px"><option selected hidden value="'+d.sfu_status+'">'+d.sfu_status+'</option><option value="OPEN">OPEN</option><option value="OPEN but partially addressed">OPEN but partially addressed</option><option value="CLOSED">CLOSED</option></select><button class="btn btn-info btn-sm submit_thirdfu" type="button" style="margin-top:10px; width:300px;" value="'+d.id+'">Submit</button></div></div><hr>');
                }
                
              });   
            }else if(f1.for_management_action == 'f'){
              $('.1stms').val(m.fstatus);
              $('#mgt_actions').html(m.imanagement_action);
              $('#followupdiv').hide();
              $('#monitor_ca').show().html(m.imonitoring_mgtaction);
              $('#monitoring_status').hide();
              $('#1stmonitoring_status').hide();
              $('#followupdiv2').show();
              $('#initialstatus').show().html('<center><b>'+m.final_status+'</b></center>');
              tinymce.get("monitor_1st_followup").setContent(m.fmonitoring_mgtaction);
              $('#1stfollowupdiv').hide();
              $('#2ndfollowupdiv').hide();
              $('#third_followup_div').show();
              $('.1stms').hide();
              $('.btn2ndffp').hide();
              $('.btn3rdffp').hide();

              if (m.istatus == 'CLOSED') {
                $('#first_followup_div').hide();
                $('#second_followup_div').hide();
                $('#third_followup_div').hide();
                 $('.btn1stffp').hide();

              }else if (m.fstatus == 'CLOSED') {
                $('#first_followup_div').show();
                $('#second_followup_div').hide();
                $('#third_followup_div').hide();
                 $('.btn1stffp').hide();
              }else if (m.sstatus == 'CLOSED') {
                $('#first_followup_div').show();
                $('#second_followup_div').show();
                $('#third_followup_div').hide();
                $('.btn1stffp').hide();
              }else{
                $('#first_followup_div').show();
                
                $('#second_followup_div').show();
                $('.btn1stffp').hide();
                $('#third_followup_div').show();
              }


              if (m.istatus == 'CLOSED') {
                $('#2ndfollowupfinding').hide();
                $('#mgt_actions_2ndfup').hide();
                $('#mgt_actions_1stfup').hide();
                $('.1stms').hide();
              }else{
                $('#2ndfollowupfinding').show().empty().html(date.fdate == '' ? ' ' : '<br><b>' + $.datepicker.formatDate('MM dd, yy ', new Date(date.fdate)) + '</b><br><br>'+ m.fmonitoring_mgtaction);
                $('#3rdfollowupfinding').show().empty().html(date.fdate == '' ? ' ' : '<br><b>' + $.datepicker.formatDate('MM dd, yy ', new Date(date.fdate)) + '</b><br><br>'+ m.smonitoring_mgtaction);
                $('#mgt_actions_2ndfup').show().empty().html(date.sdate == '' ? ' ' : '<br><b>' + $.datepicker.formatDate('MM dd, yy ', new Date(date.sdate)) + '</b><br><br>'+ m.smanagement_action);
                $('#mgt_actions_3rdfup').show().empty().html(date.tdate == '' ? ' ' : '<br><b>' + $.datepicker.formatDate('MM dd, yy ', new Date(date.tdate)) + '</b><br><br>'+ m.tmanagement_action);
                $('#mgt_actions_1stfup').show().html(date.fdate == '' ? ' ' : '<br><b>' + $.datepicker.formatDate('MM dd, yy, h:MM:ss TT', new Date(date.fdate)) + '</b><br><br>'+ m.fmanagement_action);

                tinymce.get("monitor_3rd_followup").setContent(m.tmonitoring_mgtaction);
                $('#3rdmonitoring_status').val(m.final_status);
              }
            }
         }
      });
    });
////////////////////////////////////////////////////////////////////////////////////////////////
    $('.open_div_message').click(function(e){
        e.preventDefault();
        alert();
    });
/////////////////////////////////////////SUBMIT FIRST FOLLOW-UP////////////////////////////////
    // $('#monitoring_status').keyup(function(){

    //   if($(this).val().length !=0){
    //     $('.submit_monitoring').attr('disabled', false); 
    //     $('#follow-up').froalaEditor('edit.on');       

    //   }else{
    //     $('#follow-up').froalaEditor('edit.off');  
    //     $('.submit_monitoring').attr('disabled',true);
    //   }
        
    // });
    // --------------------------------SUBMIT ---------------------------------- //

    $(document).on("click", '.submit_monitoring',function(e){
      e.preventDefault();
      $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $('#af_id').val();
        var form = document.querySelector('#FormSubmitMonitoring');
          var formdata = new FormData(form)

      $.ajax({
          type : 'POST',
          url : '/submit_monitrong_status/' + id,
          cache: false,
          contentType: false,
          processData: false,
          data : formdata,
          success : function(data){
            toastr.success("Monitoring status has been successfully sent!");

            $('#span_' + id).empty().text('update monitoring status');
            $('#status_'+id).empty().text(data);
            $('#ias_vc_ma_'+id).removeClass("btn-info").addClass("btn-warning");

            }
          });
    });
//*******************************************SEND IAS ******************************************************//
    $(document).on("click", '.send_auditee_monitoring',function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var id = $(this).val();

        $.ajax({
        type : 'POST',
        url : '/send_auditee_monitoring/' + id,
        cache: false,
        contentType: false,
        processData: false,
        success : function(data){
            toastr.success("Management Action has been successfully sent to Auditee!");
            $('#send_auditee_monitoring'+id).attr('disabled',true);
            // $('button').val(id).attr('disabled',true);
            $('button.ias_vc_ma').val(id).hide();
            $('button.followup_ias_vc_ma').val(id).css('display', 'inline-block');
            $('button.followup_ias_vc_ma').css('display', 'inline-block');
          }
        });
    });


//******************************************* CHECK MONITORING FOLLOW-UPS ******************************************************//
    $(document).on("click", '.followup_ias_vc_ma',function(e){
        e.preventDefault();
        $('#submit').css('display', 'none');
        $('#update_af').css('display', 'inline-block');
        // $('#follow-up').froalaEditor('edit.off');


        var id_c = $(this).attr('id').replace('followup_ias_vc_ma_', ''); 
        var id = $(this).val();

        $('#f001_id').val(id);
        $('#af_id').val(id_c);

        var a_name = $('#agency_name').text()
        var f_id = $('#f_id').text()
        $("div#af_recommendations_monitoring").empty();

        $('#viewMonitoringFollowUpModalLabel').text(a_name + ' Audit Finding No. ' + id_c);       
        $.ajax({
          type: 'GET',
          url: '/answer_finding',  
          cache: false,
          data: {id_c:id_c, f_id:f_id},
          success: function (data) {
            var d = data.finding[0];
            var r = data.recommendations[0];
            var m = data.mgt_action[0];
            var f1 = data.f1;
            var mgtdate = data.mgtdate;
            var mcadate = data.mcadate;

            if (f1.for_management_action == 'i') {
              $('#auditarea_monitoring').text(d.audit_area);
              $('#subauditarea_monitoring').text(d.sub_auditarea);
              $('#af_no_monitoring').text(d.auditfinding_no);
              $('#af_findings_monitoring').html(d.auditfinding);
              // $('#af_recommendations_monitoring').html(d.auditrecommend);
              jQuery.each(data.recommendations, function(i, d) {
                $("div#af_recommendations_monitoring").append(d.afrecommend);
              });
            }else if(f1.for_management_action == 1){
              $('#auditarea_monitoring').text(d.audit_area);
              $('#subauditarea_monitoring').text(d.sub_auditarea);
              $('#af_no_monitoring').text(d.auditfinding_no);
              $('#af_findings_monitoring').html(d.auditfinding);

              jQuery.each(data.recommendations, function(i, d) {
                  $('div#af_recommendations_monitoring').append('<div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px">'+d.afrecommend+'</div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.updated_at+'</b><br>'+d.management_action+'</span></div><div class="col-xs-6 col-md-4" style="width:312px; margin-left:5px"><span><b>'+d.ffu_updated_at+'</b><br>'+d.first_fu+'</span></div><div class="col-xs-1 col-md-1" style="width:120px"><b class="pull-right" style="font-size:20px">'+d.status+'</b></div></div><div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px"></div></div><hr>');             
              });    
            }else if(f1.for_management_action == 2){
              $('#auditarea_monitoring').text(d.audit_area);
              $('#subauditarea_monitoring').text(d.sub_auditarea);
              $('#af_no_monitoring').text(d.auditfinding_no);
              $('#af_findings_monitoring').html(d.auditfinding);

             
                jQuery.each(data.recommendations, function(i, d) {
                  if (d.status == 'CLOSED') {
                    $('div#af_recommendations_monitoring').append('<div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px">'+d.afrecommend+'</div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.updated_at+'</b><br>'+d.management_action+'</span></div><div class="col-xs-6 col-md-4" style="width:312px; margin-left:5px"><span><b>'+d.ffu_updated_at+'</b><br>'+d.first_fu+'</span></div><div class="col-xs-1 col-md-1" style="width:120px"><b class="pull-right" style="font-size:20px">'+d.status+'</b></div></div><div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px"></div></div><hr>');     
                  }else{
                    $('div#af_recommendations_monitoring').append('<div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px">'+d.afrecommend+'</div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.updated_at+'</b><br>'+d.management_action+'</span></div><div class="col-xs-6 col-md-4" style="width:312px; margin-left:5px"><span><b>'+d.ffu_updated_at+'</b><br>'+d.first_fu+'</span></div><div class="col-xs-1 col-md-1" style="width:120px"><b class="pull-right" style="font-size:20px">'+d.ffu_status+'</b></div></div><div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px"></div></div><div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px"></div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.updated_at+'</b><br>'+d.ffu_mgmtaction+'</span></div><div class="col-xs-1 col-md-1" style="width:312px; margin-left:5px"><span><b>'+d.sfu_updated_at+'</b><br>'+d.second_fu+'</span></div></div><hr>'); 
                  }
                              
                }); 
              

              
            }else if(f1.for_management_action == 3){
              $('#auditarea_monitoring').text(d.audit_area);
              $('#subauditarea_monitoring').text(d.sub_auditarea);
              $('#af_no_monitoring').text(d.auditfinding_no);
              $('#af_findings_monitoring').html(d.auditfinding);

             
                jQuery.each(data.recommendations, function(i, d) {
                  if (d.status == 'CLOSED') {
                    $('div#af_recommendations_monitoring').append('<div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px">'+d.afrecommend+'</div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.updated_at+'</b><br>'+d.management_action+'</span></div><div class="col-xs-6 col-md-4" style="width:312px; margin-left:5px"><span><b>'+d.ffu_updated_at+'</b><br>'+d.first_fu+'</span></div><div class="col-xs-1 col-md-1" style="width:120px"><b class="pull-right" style="font-size:20px">'+d.status+'</b></div></div><div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px"></div></div><hr>');     
                  }else{
                    $('div#af_recommendations_monitoring').append('<div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px">'+d.afrecommend+'</div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.updated_at+'</b><br>'+d.management_action+'</span></div><div class="col-xs-6 col-md-4" style="width:312px; margin-left:5px"><span><b>'+d.ffu_updated_at+'</b><br>'+d.first_fu+'</span></div><div class="col-xs-1 col-md-1" style="width:120px"><b class="pull-right" style="font-size:20px">'+d.ffu_status+'</b></div></div><div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px"></div></div><div class="row" style="margin-top: 30px;"><div class="col-xs-6 col-md-4" style="width:300px"></div><div class="col-xs-6 col-md-4" style="width:305px; margin-left:5px"><span><b>'+d.updated_at+'</b><br>'+d.ffu_mgmtaction+'</span></div><div class="col-xs-1 col-md-1" style="width:312px; margin-left:5px"><span><b>'+d.sfu_updated_at+'</b><br>'+d.second_fu+'</span></div></div><hr>'); 
                  }
                              
                }); 
            }
         }
      });
    });


});  