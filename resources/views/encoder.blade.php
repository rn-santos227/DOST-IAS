@extends('layouts.app_admin')

@section('content')
<div class="row">
    <div class="col-xs-6 col-md-8">
      <div class="x_panel tile  ">
      <div class="x_title">
        <h2>List of Encoders</h2>
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
                  <th>Username</th>
                  <th>Email Address</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody id="encoder_row">
              @foreach($encoders as $encoder)
                <tr>
                  <td width="30%" id="s_name_{{$encoder->user_id}}"> {{$encoder->name}} </td>
                  <td width="20%" id="s_username_{{$encoder->user_id}}"> {{$encoder->username}} </td>
                  <td width="20%" id="s_email_{{$encoder->user_id}}"> {{$encoder->email}} </td>
                  <td width="11%"> 
                   <center> 
                   <button data-toggle="tooltip" title="Update User Details" class="btn btn-success edit" value="{{ $encoder->user_id }}" id="btn_edit_{{ $encoder->user_id }}"><i class="fa fa-pencil-square-o"></i></button> 
                    <button data-toggle="tooltip" title="Send User to Archive" class="btn btn-danger archive" value="{{ $encoder->user_id }}" id="btn_archive_{{ $encoder->user_id }}"><i class="fa fa-archive" ></i></button> 
                   <h4><center> <span id="label_edit_{{ $encoder->user_id }}" class="label label-default" style="display:none">Updating
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
    <div class="col-xs-6 col-md-4 store_encoder">@include('admin_partials.store_encoder')</div>
    <div class="col-xs-6 col-md-4 update_encoder" style="display: none">@include('admin_partials.update_encoder')</div>
  </div>
@endsection
