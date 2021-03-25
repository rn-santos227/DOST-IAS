@extends('layouts.app_auditee')

@section('content')
<style type="text/css">
.entry:not(:first-of-type){
    margin-top: 10px;
}

.glyphicon{
    font-size: 12px;
}

.class1 {
  border-radius: 10%;
  border: 2px solid #efefef;
}

.class2 {
  opacity: 0.5;
}

input {
  border-radius: 1px;
}
</style>
<center><div id="flashMessageReport"  class="alert alert-dismissable alert-success" style="width: 500px; display: none">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
    <strong>Success! </strong> Audit Report has been updated . . . 
</div></center>
<ul class="steps steps-5">
  <li><a href="/home" title=""><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
  <li class="current"><a href="/auditreporthome" title=""><i class="fa fa-file-text" aria-hidden="true"></i> Form 001</a></li>
</ul>
<div class="row">
  <div class="col-xs-6 col-md-12">
    <div class="x_panel tile  ">
    <div class="x_title">
      <h4>List of Audit Reports</h4>
    </div>
    <div class="x_content">
      <div class="x_panel" style="border-color: transparent;">
        <div class="x_content">
          <table id="datatable" class="table table-striped table-bordered">
            <thead>
              <tr sty>
                <th>Agency / Office / Program / Activity</th>
                <th>Date of Audit</th>
                <th>Creation</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody id="form001_row">

              @foreach($form001s as $form001)
                <tr id="audit_reportrow" style="text-align: center;">
                  <td width="30%" id="s_name_{{$form001->user_id}}"> {{agency_name($form001->agency_id)}} </td>
                  <td width="20%" id="s_username_{{$form001->user_id}}">{{date('F j, Y', strtotime($form001->datefrom))}} - 
                                                                                {{date('F j, Y', strtotime($form001->dateto))}} </td>
                  <td width="20%" id="s_email_{{$form001->user_id}}">{{date('F j, Y \a\t g:i a', strtotime($form001->created_at))}} <br> {{author($form001->author_id)}}</td>
                  <td width="20%" id="s_email_{{$form001->user_id}}" style="text-align: left;"> 
                    <h6>Total Findings:   </h6>
                    <h6>Total Recommendations: </h6>
                   
                  @if($form001->status == ' ')
                    <!-- <span class="text-info">For Approval</span> -->
                    <h6>total items:  <b class="text-warning">{{count_item($form001->id)}}</b> | answered: <b class="text-success">{{count_item_approved($form001->id)}}</b>    | pending:    <b class="text-danger">{{count_item_revision($form001->id)}}</b>    </h6>
                   
                  @else

                  @endif
                  </td>
                  <td width="11%"> 
                    <a href="/findings/{{$form001->id }}">
                      <button data-toggle="tooltip" title="Open Audit Report" class="btn btn-success edit" value="{{ $form001->id }}" id="btn_edit_{{ $form001->id }}"><i class="fa fa-folder-open"></i></button>
                      <button data-toggle="tooltip" title="Download Audit Report" class="btn btn-info edit" value="{{ $form001->id }}" id="btn_edit_{{ $form001->id }}"><i class="fa fa-download"></i></button> 
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          @include('encoder.partials.modals_form_001')
        </div>
      </div>
    </div>
    </div>
  </div>
  
</div>
@endsection
