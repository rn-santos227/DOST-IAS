$(document).ready(function () {

  $( "#submit_iasstaff" ).click(function(e) {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    e.preventDefault(); 

    var title = $('#title').val();
    var name = $('#name').val();
    var uname = $('#username').val();
    var position = $('#position').val();
    var email = $('#email').val();
    var pwd = $('#password').val();

    if (title == '' || name == '' || uname == '' || position == '' || email == '' || pwd == '') {
      jQuery(".error_create").fadeIn( 100 , function() {
        
      }).fadeOut(10000);
    }else{

    var srow = $('#iasstaff_row');
    var form = document.querySelector('#storeIasStaffForm');
    var formdata = new FormData(form)

    $.ajax({
    type : 'POST',
    url : '/store_iasstaff',
    cache: false,
    contentType: false,
    processData: false,
    data : formdata,
    success : function(data){
      console.log(data.id);
      $('#u_i_name').val(data.name);
      $('#u_i_username').val(data.username);
      $('#u_i_email').val(data.email);
      $('#u_i_id').val(data.id);

      $( '#storeIasStaffForm' ).each(function(){
          this.reset();
      });

      var table = $('#datatable').DataTable();

      jQuery(".success_create").fadeIn( 100 , function() {
            }).fadeOut(5000);
 
       table.row.add([
            data.title,
            data.name,
            data.username,
            data.position,
            data.email,
            '<center><button data-toggle="tooltip" title="Update User Details" class="btn btn-success edit" value="'+data.id+'" id="btn_edit_'+data.id+'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><button data-toggle="tooltip" title="Send User to Archive" class="btn btn-danger archive"  value="'+data.id+'" id="btn_archive_'+data.id+'"><i class="fa fa-archive" aria-hidden="true"></i></button></center><h4><center> <span id="label_edit_'+data.id+'" class="label label-default" style="display:none">Updating <img src="images/ajax-loader.gif" style="height: 10px; width: 10px;" alt="DOST-IAS"> </span></h4>'
        ]).draw();

      },
      error : function(data){
          toastr.warning('Warning! Username already exist!');
        }
    });

    }

    

  });

  $(document.body).on('click', '.edit', function(e) {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });

      e.preventDefault(); 

      //Show Update Form - Hide Create Form
      $('.store_iasstaff').hide();
      $('.update_iasstaff').show();

      var id = $(this).val();

      var title = $('#s_title_' + id).text();
      var name = $('#s_name_' + id).text();
      var uname = $('#s_username_' + id).text();
      var position = $('#s_position_' + id).text();
      var email = $('#s_email_' + id).text();
      var pwd = $('#s_password_' + id).val();

      $('#option').text(title);
      $('#u_name').val(name);
      $('#u_username').val(uname);
      $('#u_position').val(position);
      $('#u_email').val(email);
      $('#u_id').val(id);

      var srow = $('#iasstaff_row');
      var _id = $('#updateIasStaffForm input[name="_id"]').val();

      if (_id != '0') { // another row is currently being edited
        showAvailableActions('edit_cancel', _id);
      }

      $('#updateIasStaffForm input[name="_id"]').val(id);
                  
      // Update actions column                
      showAvailableActions('edit', id);
  });

  $(document.body).on('click', '.update_iasstaffs', function(e) {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });

      e.preventDefault();

      var id = $('#u_id').val();
      
      _url = 'iasstaff';

      var srow = $('#iasstaff_row');
      var form = document.querySelector('#updateIasStaffForm');
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

            jQuery("#s_title_" + id).fadeOut( 100 , function() {
                jQuery(this).html( data);
                 $('#s_title_' + id).text(u.title);
            }).fadeIn( 1000 );

            jQuery("#s_name_" + id).fadeOut( 100 , function() {
                jQuery(this).html( data);
                 $('#s_name_' + id).text(u.name);
            }).fadeIn( 1000 );

            jQuery("#s_username_" + id).fadeOut( 100 , function() {
                jQuery(this).html( data);
                 $('#s_username_' + id ).text(u.username);
            }).fadeIn( 1000 );

            jQuery("#s_position_" + id).fadeOut( 100 , function() {
                jQuery(this).html( data);
                 $('#s_position_' + id ).text(u.position);
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

      var _id = $('#updateIasStaffForm input[name="_id"]').val();

      //Show Update Form - Hide Create Form
      $('.store_iasstaff').show();
      $('.update_iasstaff').hide();

      $('#label_edit_' + _id).hide();
      $('#btn_edit_' + _id).show();
      $('#btn_archive_' + _id).show();

    });

});