<div class="x_panel tile  ">
  <div class="x_title">
    <h2>Create Ias Staff</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
  <center>
    <div style="height: 45px; display: none" class="alert alert-danger error_create" role="alert">
       <h4><i class="fa fa-times-circle-o" aria-hidden="true"></i> Error! Please fill up required fields! (*)</h4>
    </div>
    <div style="height: 45px; display: none" class="alert alert-success success_create" role="alert">
       <h4><i class="fa fa-check-circle" aria-hidden="true"></i> Success! IAS Staff's data has been created!</h4>
    </div>
  </center><br>
    <form id="storeIasStaffForm" data-parsley-validate class="form-horizontal form-label-left">
    {{ csrf_field() }}
      <input type="hidden" name="_id" value="0">
      <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title <span class="required">*</span></label>
      <div class="col-md-8 col-sm-6 col-xs-12 ">
          <select id="languages" class="form-control" name="title" id="title">
              <option value="Atty.">Atty.</option>
              <option value="Dir.">Dir.</option>
              <option value="Dr.">Dr.</option>
              <option value="Engr.">Engr.</option>
              <option value="Hon.">Hon.</option>
              <option value="Mr.">Mr.</option>
              <option value="Ms.">Ms.</option>
          </select>
      </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
          <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Username <span class="required">*</span>
        </label>
        <div class="col-md-8 col-sm-6 col-xs-12">
          <input type="text" id="username" name="username" required="required" class="form-control col-md-7 col-xs-12">
        </div>
      </div>
      <div class="form-group">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12" for="position" >Position <span class="required">*</span></label>
        <div class="col-md-8 col-sm-6 col-xs-12">
          <input id="position" class="form-control col-md-7 col-xs-12" required="required" type="text" name="position">
        </div>
      </div>
      <div class="form-group">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email Address <span class="required">*</span></label>
        <div class="col-md-8 col-sm-6 col-xs-12">
          <input id="email" class="form-control col-md-7 col-xs-12" required="required" type="email" name="email">
        </div>
      </div>
      <div class="form-group">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span></label>
        <div class="col-md-8 col-sm-6 col-xs-12">
          <input id="password" class="form-control col-md-7 col-xs-12" required="required" type="Password" name="password" value="dost">
        </div>
      </div>
      <div class="form-group" style="display: none">
        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Role <span class="required">*</span></label>
        <div class="col-md-8 col-sm-6 col-xs-12">
          <input id="middle-name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="role" value="2" placeholder="IAS Staff" readonly="">
        </div>
      </div>
      <div class="ln_solid"></div>
      <div class="form-group pull">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 pull-right">
		      <button class="btn btn-primary" type="reset">Reset</button>
          <button class="create_user btn btn-success" id="submit_iasstaff" >Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>