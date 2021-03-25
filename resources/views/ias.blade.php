@extends('layouts.app_admin')

@section('content')
<div class="row">
    <div class="col-xs-6 col-md-8">
      <div class="x_panel tile  ">
      <div class="x_title">
        <h2>List of IAS Staffs</h2>
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
                  <th>Title</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Position</th>
                  <th>Email Address</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody id="iasstaff_row">
              @foreach($iasstaffs as $iasstaff)
                <tr>
                  <td width="5%" id="s_title_{{$iasstaff->user_id}}"> {{$iasstaff->title}} </td>
                  <td width="20%" id="s_name_{{$iasstaff->user_id}}"user_id> {{$iasstaff->name}} </td>
                  <td width="15%" id="s_username_{{$iasstaff->user_id}}"> {{$iasstaff->username}} </td>
                  <td width="20%" id="s_position_{{$iasstaff->user_id}}"> {{$iasstaff->position}} </td>
                  <td width="20%" id="s_email_{{$iasstaff->user_id}}"> {{$iasstaff->email}} </td>
                  <td width="31%"> 
                   <center> 
                   <button data-toggle="tooltip" title="Update User Details" class="btn btn-success edit" value="{{ $iasstaff->user_id }}" id="btn_edit_{{ $iasstaff->user_id }}"><i class="fa fa-pencil-square-o"></i></button> 
                    <button data-toggle="tooltip" title="Send User to Archive" class="btn btn-danger archive" value="{{ $iasstaff->user_id }}" id="btn_archive_{{ $iasstaff->user_id }}"><i class="fa fa-archive" ></i></button> 
                   <h4><center> <span id="label_edit_{{ $iasstaff->user_id }}" class="label label-default" style="display:none">Updating
                    <img src="{{ asset('images/ajax-loader.gif') }}" style="height: 10px; width: 10px;" alt="DOST-IAS"> </span></h4>
                    <!-- <button class="btn btn-primary u_details">Update Details</button>  -->
                    <button class="btn btn-warning edit_cancel" style="display: none">Cancel Update</button> </center>
                  </td>
                </tr>
               @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      </div>
    </div>
    <div class="col-xs-6 col-md-4 store_iasstaff">@include('admin_partials.store_iasstaff')</div>
    <div class="col-xs-6 col-md-4 update_iasstaff" style="display: none">@include('admin_partials.update_iasstaff')</div>
  </div>
@endsection
