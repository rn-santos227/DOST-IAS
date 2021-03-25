$(document).ready(function () {

  $( "#submit_user" ).click(function(e) {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault(); 

    var name = $('#name').val();
    var uname = $('#username').val();
    var email = $('#email').val();
    var pwd = $('#password').val();

    if (name == '' || uname == '' || email == '' || pwd == '') {
      jQuery(".error_create").fadeIn( 100 , function() {
        
      }).fadeOut(10000);
    }else if(!isValidEmailAddress( email )){
      jQuery(".error_email_create").fadeIn( 100 , function() {
        }).fadeOut(10000);
    }else{

    var srow = $('#encoder_row');
    var form = document.querySelector('#storeEncoderForm');
    var formdata = new FormData(form)

    $.ajax({
    type : 'POST',
    url : '/store_encoder',
    cache: false,
    contentType: false,
    processData: false,
    data : formdata,
    success : function(data){
      console.log(data.id);
      $('#u_name').val(data.name);
      $('#u_username').val(data.username);
      $('#u_email').val(data.email);
      $('#u_id').val(data.id);

      $( '#storeEncoderForm' ).each(function(){
          this.reset();
      });

      var table = $('#datatable').DataTable();

      jQuery(".success_create").fadeIn( 100 , function() {
            }).fadeOut(5000);
 
       table.row.add([
            data.name,
            data.username,
            data.email,
            '<center><button data-toggle="tooltip" title="Update User Details" class="btn btn-success edit" value="'+data.id+'" id="btn_edit_'+data.id+'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><button data-toggle="tooltip" title="Send User to Archive" class="btn btn-danger archive"  value="'+data.id+'" id="btn_archive_'+data.id+'"><i class="fa fa-archive" aria-hidden="true"></i></button></center><h4><center> <span id="label_edit_'+data.id+'" class="label label-default" style="display:none">Updating <img src="images/ajax-loader.gif" style="height: 10px; width: 10px;" alt="DOST-IAS"> </span></h4>'
        ]).draw();

      }
    });

    }

    function isValidEmailAddress(email) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(email);
    };

    

  });

  $(document.body).on('click', '.edit', function(e) {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });

      e.preventDefault(); 

      //Show Update Form - Hide Create Form
      $('.store_encoder').hide();
      $('.update_encoder').show();

      var id = $(this).val();

      var name = $('#s_name_' + id).text();
      var uname = $('#s_username_' + id).text();
      var email = $('#s_email_' + id).text();
      var pwd = $('#s_password_' + id).val();

      $('#u_name').val(name);
      $('#u_username').val(uname);
      $('#u_email').val(email);
      $('#u_id').val(id);

      var srow = $('#encoder_row');
      var _id = $('#updateEncoderForm input[name="_id"]').val();

      if (_id != '0') { // another row is currently being edited
        showAvailableActions('edit_cancel', _id);
      }

      $('#updateEncoderForm input[name="_id"]').val(id);
                  
      // Update actions column                
      showAvailableActions('edit', id);
  });

  $(document.body).on('click', '.update_encoders', function(e) {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });

      e.preventDefault();

      var id = $('#u_id').val();

      // alert(id);
      
      _url = 'encoder';

      var srow = $('#encoder_row');
      var form = document.querySelector('#updateEncoderForm');
      var formdata = new FormData(form)

      $.ajax({
          type : 'POST',
          url : _url + '/' + id + '/update',
          cache: false,
          contentType: false,
          processData: false,
          data : formdata,
          success : function(data){
            u = eval('data='+data);

            jQuery("#s_name_" + id).fadeOut( 100 , function() {
                jQuery(this).html( data);
                 $('#s_name_' + id).text(u.name);
            }).fadeIn( 1000 );

            jQuery("#s_username_" + id).fadeOut( 100 , function() {
                jQuery(this).html( data);
                 $('#s_username_' + id ).text(u.username);
            }).fadeIn( 1000 );

            jQuery("#s_email_" + id).fadeOut( 100 , function() {
                jQuery(this).html( data);
                  $('#s_email_' + id).text(u.email);
            }).fadeIn( 1000 );

            jQuery(".success_update").fadeIn( 100 , function() {
            }).fadeOut(5000);
            
           
            
           
          

          }
      });

  });

function showAvailableActions($event, $id) {


    var $actions = [
        'btn_archive_', // 0
        'btn_activate_',   // 1
        'label_edit_',     // 2
        'btn_edit_'        // 3
    ];

    var $availableActions = [];
    switch($event) {
        case 'deactivate':
            $availableActions = [1];
            break;
        case 'activate':
            $availableActions = [0, 3];
            break;
        case 'edit':
            $availableActions = [2];
            break;
        case 'edit_cancel':
            $availableActions = [0, 3];
            break;
    }
    for ($i = 0; $i < $actions.length; $i++) {


        var $target = $('#' + $actions[$i] + $id); 

        // alert($actions[$i]);

        if ($.inArray($i, $availableActions) == -1) {

          // alert('Hide: ' + $actions[$i] + $id);

            $target.hide();
        } else {

          // alert('Show: ' + $actions[$i] + $id);

            $target.show();
        }
    }
}

    $(document.body).on('click', '.cancel', function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

      e.preventDefault(); 

      var _id = $('#updateEncoderForm input[name="_id"]').val();

      //Show Update Form - Hide Create Form
      $('.store_encoder').show();
      $('.update_encoder').hide();

      $('#label_edit_' + _id).hide();
      $('#btn_edit_' + _id).show();
      $('#btn_archive_' + _id).show();

    });

});