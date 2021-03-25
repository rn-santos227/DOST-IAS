@extends('layouts.app_admin')

@section('content')
<div class="row">
    <div class="col-xs-6 col-md-8">
      <div class="x_panel tile  ">
      <div class="x_title">
        <h2>List of Agency Staff</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="x_panel" style="border-color: transparent;">
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email Address</th>
                  <th>Password</th>
                </tr>
              </thead>

              <tbody id="staff_row">
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
      </div>
    </div>
    <div class="col-xs-6 col-md-4 store_staff">
      @include('admin_partials.store_user')
    </div>
    <div class="col-xs-6 col-md-4 update_attendance" style="display: none">
  
    </div>
  </div>
@endsection
