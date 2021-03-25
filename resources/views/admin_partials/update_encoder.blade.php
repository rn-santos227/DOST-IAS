<div class="x_panel tile  ">
  <div class="x_title">
    <h2>Update Encoder</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
  <center>
    <div style="height: 45px; display: none" class="alert alert-success success_update" role="alert">
       <h4><i class="fa fa-check-circle" aria-hidden="true"></i> Success! Encoder's data has been updated!</h4>
    </div>
  </center><br>
    <form id="updateEncoderForm" data-parsley-validate class="form-horizontal form-label-left">
    {{ csrf_field() }}
    <input type="hidden" name="_id" value="0">
      <input type="hidden" id="u_id" name="u_id">
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
          <button class="btn btn-success update_encoders" id="submit_encoder" >Update</button>
        </div>
      </div>
    </form>
  </div>
</div>