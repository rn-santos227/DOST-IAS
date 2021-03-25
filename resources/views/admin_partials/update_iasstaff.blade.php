<div class="x_panel tile  ">
  <div class="x_title">
    <h2>Update IAS Staff</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
  <center>
    <div style="height: 45px; display: none" class="alert alert-success success_update" role="alert">
       <h4><i class="fa fa-check-circle" aria-hidden="true"></i> Success! IAS Staff's data has been updated!</h4>
    </div>
  </center><br>
    <form id="updateIasStaffForm" data-parsley-validate class="form-horizontal form-label-left">
    {{ csrf_field() }}
    <input type="hidden" name="_id" value="0">
      <input type="hidden" id="u_id" name="u_id">
      <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title <span class="required">*</span></label>
      <div class="col-md-8 col-sm-6 col-xs-12 ">
          <select class="form-control" name="u_title" id="u_title">
              <option id="option" value="Atty.">Atty.</option>
              <option id="option" value="Dir.">Dir.</option>
              <option id="option" value="Dr.">Dr.</option>
              <option id="option" value="Engr.">Engr.</option>
              <option id="option" value="Hon.">Hon.</option>
              <option id="option" value="Mr.">Mr.</option>
              <option id="option" value="Ms.">Ms.</option>
          </select>
      </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
          <input type="text" id="u_name" name="u_name" required="required" class="form-control col-md-7 col-xs-12">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Username <span class="required">*</span>
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
          <input type="text" id="u_username" name="u_username" required="required" class="form-control col-md-7 col-xs-12">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="position">Position <span class="required">*</span>
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
          <input type="text" id="u_position" name="u_position" required="required" class="form-control col-md-7 col-xs-12">
        </div>
      </div>
      <div class="form-group">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email Address <span class="required">*</span></label>
        <div class="col-md-8 col-sm-6 col-xs-12">
          <input id="u_email" class="form-control col-md-7 col-xs-12" required="required" type="email" name="u_email">
        </div>
      </div>
      <div class="form-group" style="display: none">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Role <span class="required">*</span></label>
        <div class="col-md-8 col-sm-6 col-xs-12">
          <input id="middle-name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="role" value="3" placeholder="IAS Staff" readonly="">
        </div>
      </div>
      <div class="ln_solid"></div>
      <div class="form-group pull">
        <div class="col-md-7 col-sm-7 col-xs-12 col-md-offset-3 pull-right">
		      <button class="btn btn-primary" type="reset">Reset</button>
          <button class="btn btn-warning cancel" >Back</button>
          <button class="btn btn-success update_iasstaffs" id="submit_iastaff" >Update</button>
        </div>
      </div>
    </form>
  </div>
</div>