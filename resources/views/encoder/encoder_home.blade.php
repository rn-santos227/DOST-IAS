@extends('layouts.app_encoder')

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

<div class="col-md-12 col-sm-6 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2><i class="fa fa-bars"></i> List of Audit Reports</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Settings 1</a>
            </li>
            <li><a href="#">Settings 2</a>
            </li>
          </ul>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">


      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Audits For Approval <span class="badge bg-green">{{count($form001approval)}}</span></a>
          </li>
          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Approved <span class="badge bg-green">{{count($form001approved)}}</span></a>
          </li>
          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">For Monitoring and Evaluation <span class="badge bg-green">{{count($form001me)}}</span></a>
          </li>
          <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab4" data-toggle="tab" aria-expanded="false">All Audit Reports <span class="badge bg-green">{{count($form001s)}}</span></a>
          </li>
        </ul>
        <div id="myTabContent" class="tab-content">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
            <table id="datatablenew" class="table table-striped table-bordered">
              @if(Auth::user()->role == 4)
                <button type="button" style="display: none" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#myModal">
                 Add new Form 001
                </button>
              @else
                <button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#myModal">
                 Add new Form 001
                </button>
              @endif
              <thead>
                <tr sty>
                  <th>Agency / Office / Program / Activity</th>
                  <th>Date of Audit</th>
                  <th>Creation</th>
                  <th>Updates</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>

              <tbody id="form001_row">
                 @if(Auth::user()->role == 4)

                   @foreach($form001approval as $form001)
                    <tr id="audit_reportrow" class="treffect_{{$form001->id}}" style="text-align: center;">
                      <td width="25%" id="s_name_{{$form001->user_id}}"> {{agency_name($form001->agency_id)}} </td>
                      <td width="15%" id="s_username_{{$form001->user_id}}">{{date('F j, Y', strtotime($form001->datefrom))}} - {{date('F j, Y', strtotime($form001->dateto))}} </td>
                      <td width="15%" id="s_email_{{$form001->user_id}}">{{date('F j, Y \a\t g:i a', strtotime($form001->created_at))}} <br>{{author($form001->author_id)}}</td>
                      <td width="15%" id="s_email_{{$form001->user_id}}">{{date('F j, Y \a\t g:i a', strtotime($form001->updated_at))}} <a href="#"> <i class="fa fa-list-alt" title="Updates log" style="margin-left: 10px; font-size: 20px;"></i></a></td>
                      <td width="17%" id="s_email_{{$form001->user_id}}"> 
                          @if($form001->status == ' ' || $form001->status == 0 )
                            <span class="text-info"><b>For Approval</b></span>
                          @else
                            <span class="text-info"><b>Approved</b></span><br><span class="text-success">(please see in monitoring report of findings tab)</span>
                          @endif

                          <h6>total items:  <b class="text-warning">{{count_item($form001->id, 'd')}}</b> |approved: <b class="text-success">{{count_item_approved($form001->id)}}</b>    |     for revision: <b class="text-danger">{{count_item_revision($form001->id)}}</b></h6>
                      </td>
                      <td width="13%"> 
                          <a href="/form001_content/{{$form001->id }}">
                            <button data-toggle="tooltip" title="Open Form 001" class="btn btn-success edit" value="{{ $form001->id }}" id="btn_edit_{{ $form001->id }}"><i class="fa fa-folder-open" aria-hidden="true"></i></button> 
                          </a>
                            <button id="vu_form001" data-toggle="modal" data-target="#myViewUpdateModal" title="Update Form 001" class="btn btn-info vu_form001" value="{{ $form001->id }}" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> 
                      </td>
                    </tr>
                  @endforeach

                @else

                  @foreach($form001approval as $form001)
                    <tr id="audit_reportrow"  class="treffect_{{$form001->id}}" style="text-align: center;">
                      <td width="25%" id="s_name_{{$form001->user_id}}"> {{agency_name($form001->agency_id)}} </td>
                      <td width="15%" id="s_username_{{$form001->user_id}}">{{date('F j, Y', strtotime($form001->datefrom))}} - {{date('F j, Y', strtotime($form001->dateto))}} </td>
                      <td width="15%" id="s_email_{{$form001->user_id}}">{{date('F j, Y \a\t g:i a', strtotime($form001->created_at))}} <br>{{author($form001->author_id)}}</td>
                      <td width="15%" id="s_email_{{$form001->user_id}}">{{date('F j, Y \a\t g:i a', strtotime($form001->updated_at))}} <a href="#"> <i class="fa fa-list-alt" title="Updates log" style="margin-left: 10px; font-size: 20px;"></i></a></td>
                      <td width="17%" id="s_email_{{$form001->user_id}}"> 
                          @if($form001->status == ' ' || $form001->status == 0 )
                            <span class="text-info"><b>For Approval</b></span>
                          @elseif($form001->status == 1 && $form001->for_management_action == ' ')
                            <span style="color: orange"><b>Send to Auditee for Management Action</b></span><br><span class="text-success">(please see in monitoring report of findings tab)</span>
                          @else
                            <span class="text-info"><b>Approved</b></span><br><span class="text-success">(please see in monitoring report of findings tab)</span>
                          @endif
                          <h6>total items:  <b class="text-warning">{{count_item($form001->id, 'd')}}</b> |approved: <b class="text-success">{{count_item_approved($form001->id)}}</b>    |     for revision: <b class="text-danger">{{count_item_revision($form001->id)}}</b></h6>
                      </td>

                      <td width="13%"> 
                        <a href="/form001_content/{{$form001->id }}">
                          <button data-toggle="tooltip" title="Open Form 001" class="btn btn-primary edit" value="{{ $form001->id }}" id="btn_edit_{{ $form001->id }}"><i class="fa fa-folder-open" aria-hidden="true"></i></button> 
                        </a>

                        @if($form001->status == 1 && $form001->for_management_action == ' ')
                            <a target="_blank" href="{{action('WordController@createWord', $form001['id'])}}">
                              <button  style="width: 70px;"  type="button" class="btn btn-info btn-md" ><i class="fa fa-file-word-o" aria-hidden="true"></i></button>
                            </a>
                            <button id="vu_form001" data-toggle="modal" data-target="#myViewUpdateModal" title="Update Form 001" class="btn btn-warning vu_form001" value="{{ $form001->id }}" {{check_status_if_fma($form001->id)}}><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> 
                            
                        @elseif($form001->status == 1 && $form001->for_management_action != ' ')
                            <a target="_blank" href="{{action('WordController@createWord', $form001['id'])}}">
                              <button   style="width: 70px;" type="button" class="btn btn-info btn-md" ><i class="fa fa-file-word-o" aria-hidden="true"></i></button>
                            </a>
                             <button id="vu_form001" data-toggle="modal" data-target="#myViewUpdateModal" title="Update Form 001" class="btn btn-warning vu_form001" value="{{ $form001->id }}" disabled=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> 
                        @else
                            <a target="_blank" href="{{action('WordController@createWord', $form001['id'])}}">
                              <button  style="width: 70px;"  type="button" class="btn btn-info btn-md" ><i class="fa fa-file-word-o" aria-hidden="true"></i></button>
                            </a>
                              <button id="vu_form001" data-toggle="modal" data-target="#myViewUpdateModal" title="Update Form 001" class="btn btn-warning vu_form001" value="{{ $form001->id }}" {{check_status_if_fma($form001->id)}}><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> 
                        @endif

                           @if($form001->status == 1 && $form001->for_management_action == ' ')
                              <button style="width: 170px;" data-toggle="tooltip" class="btn btn-success send_to_auditee" id="send_to_auditee" title="Send Audit Report to Auditee" value="{{ $form001->id }}" {{check_status_if_fma($form001->id)}}><i class="fa fa-paper-plane" aria-hidden="true"></i></button> 
                          @elseif($form001->status == 1 && $form001->for_management_action != ' ')
                          @endif 
                      </td>
                    </tr>
                  @endforeach

                  @endif

           
              </tbody>
            </table>
           </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
           <table id="datatableapproved" class="table table-striped table-bordered">
            <thead>
              <tr sty>
                <th>Agency / Office / Program / Activity</th>
                <th>Date of Audit</th>
                <th>Creation</th>
                <th>Updates</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody id="form001_row">
           @if(Auth::user()->role == 4)

               @foreach($form001approved as $form001)
                <tr id="audit_reportrow"  class="treffect_{{$form001->id}}" style="text-align: center;">
                  <td width="25%" id="s_name_{{$form001->user_id}}"> {{agency_name($form001->agency_id)}} </td>
                  <td width="15%" id="s_username_{{$form001->user_id}}">{{date('F j, Y', strtotime($form001->datefrom))}} - {{date('F j, Y', strtotime($form001->dateto))}} </td>
                  <td width="15%" id="s_email_{{$form001->user_id}}">{{date('F j, Y \a\t g:i a', strtotime($form001->created_at))}}  <br>{{author($form001->author_id)}}</td>
                  <td width="15%" id="s_email_{{$form001->user_id}}">{{date('F j, Y \a\t g:i a', strtotime($form001->updated_at))}} <a hr#ef=""> <i class="fa fa-list-alt" title="Updates log" style="margin-left: 10px; font-size: 20px;"></i></a></td>
                  <td width="17%" id="s_email_{{$form001->user_id}}"> 
                      @if($form001->status == ' ' || $form001->status == 0 )
                        <span class="text-info"><b>For Approval</b></span>
                      @else
                        <span class="text-info"><b>Approved</b></span><br><span class="text-success">(IAS staff will send the report to auditee)</span>
                      @endif

                      <h6>total items:  <b class="text-warning">{{count_item($form001->id, 'd')}}</b> |approved: <b class="text-success">{{count_item_approved($form001->id)}}</b>    |    for revision: <b class="text-danger">{{count_item_revision($form001->id)}}</b></h6>
                  </td>
                  <td width="13%"> 
                      <a href="/form001_content/{{$form001->id }}">
                        <button data-toggle="tooltip" title="Open Form 001" class="btn btn-success edit" value="{{ $form001->id }}" id="btn_edit_{{ $form001->id }}"><i class="fa fa-folder-open" aria-hidden="true"></i></button> 
                      </a>
                        <button id="vu_form001" data-toggle="modal" data-target="#myViewUpdateModal" title="Update Form 001" class="btn btn-info vu_form001" value="{{ $form001->id }}" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> 
                  </td>
                </tr>
              @endforeach

            @else

              @foreach($form001approved as $form001)
                <tr id="audit_reportrow"  class="treffect_{{$form001->id}}" style="text-align: center;">
                  <td width="25%" id="s_name_{{$form001->user_id}}"> {{agency_name($form001->agency_id)}} </td>
                  <td width="15%" id="s_username_{{$form001->user_id}}">{{date('F j, Y', strtotime($form001->datefrom))}} - {{date('F j, Y', strtotime($form001->dateto))}} </td>
                  <td width="15%" id="s_email_{{$form001->user_id}}">{{date('F j, Y \a\t g:i a', strtotime($form001->created_at))}}  <br>{{author($form001->author_id)}}</td>
                  <td width="15%" id="s_email_{{$form001->user_id}}">{{date('F j, Y \a\t g:i a', strtotime($form001->updated_at))}} <a hr#ef=""> <i class="fa fa-list-alt" title="Updates log" style="margin-left: 10px; font-size: 20px;"></i></a></td>
                  <td width="17%" id="s_email_{{$form001->user_id}}"> 
                      @if($form001->status == ' ' || $form001->status == 0 )
                        <span class="text-info"><b>For Approval</b></span>
                      @elseif($form001->status == 1 && $form001->for_management_action == ' ')
                        <span style="color: orange"><b>Send to Auditee for Management Action</b></span>
                      @else
                        <span class="text-info"><b>Approved</b></span><br><span class="text-success">(please see in monitoring report of findings tab)</span>
                      @endif
                      <h6>total items:  <b class="text-warning">{{count_item($form001->id, 'd')}}</b> |approved: <b class="text-success">{{count_item_approved($form001->id)}}</b>    |     for revision: <b class="text-danger">{{count_item_revision($form001->id)}}</b></h6>
                  </td>

                  <td width="13%"> 
                    <a href="/form001_content/{{$form001->id }}">
                      <button data-toggle="tooltip" title="Open Form 001" class="btn btn-primary edit" value="{{ $form001->id }}" id="btn_edit_{{ $form001->id }}"><i class="fa fa-folder-open" aria-hidden="true"></i></button> 
                    </a>

                    @if($form001->status == 1 && $form001->for_management_action == ' ')
                        <a target="_blank" href="{{action('WordController@createWord', $form001['id'])}}">
                          <button  style="width: 70px;"  type="button" class="btn btn-info btn-md" ><i class="fa fa-file-word-o" aria-hidden="true"></i></button>
                        </a>
                        <button id="vu_form001" data-toggle="modal" data-target="#myViewUpdateModal" title="Update Form 001" class="btn btn-warning vu_form001" value="{{ $form001->id }}" {{check_status_if_fma($form001->id)}}><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> 
                        
                    @elseif($form001->status == 1 && $form001->for_management_action != ' ')
                        <a target="_blank" href="{{action('WordController@createWord', $form001['id'])}}">
                          <button   style="width: 70px;" type="button" class="btn btn-info btn-md" ><i class="fa fa-file-word-o" aria-hidden="true"></i></button>
                        </a>
                         <button id="vu_form001" data-toggle="modal" data-target="#myViewUpdateModal" title="Update Form 001" class="btn btn-warning vu_form001" value="{{ $form001->id }}" disabled=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> 
                    @else
                        <a target="_blank" href="{{action('WordController@createWord', $form001['id'])}}">
                          <button  style="width: 70px;"  type="button" class="btn btn-info btn-md" ><i class="fa fa-file-word-o" aria-hidden="true"></i></button>
                        </a>
                          <button id="vu_form001" data-toggle="modal" data-target="#myViewUpdateModal" title="Update Form 001" class="btn btn-warning vu_form001" value="{{ $form001->id }}" {{check_status_if_fma($form001->id)}}><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> 
                    @endif

                       @if($form001->status == 1 && $form001->for_management_action == ' ')
                          <button style="width: 170px;" data-toggle="tooltip" class="btn btn-success send_to_auditee" id="send_to_auditee" title="Send Audit Report to Auditee" value="{{ $form001->id }}" {{check_status_if_fma($form001->id)}}><i class="fa fa-paper-plane" aria-hidden="true"></i></button> 
                      @elseif($form001->status == 1 && $form001->for_management_action != ' ')
                      @endif 
                  </td>
                </tr>
              @endforeach

              @endif

             </tbody>
            </table>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
            <table id="datatableme" class="table table-striped table-bordered">
            <thead>
              <tr sty>
                <th>Agency / Office / Program / Activity</th>
                <th>Date of Audit</th>
                <th>Creation</th>
                <th>Updates</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody id="form001_row">
           @if(Auth::user()->role == 4)

               @foreach($form001me as $form001)
                <tr id="audit_reportrow"  class="treffect_{{$form001->id}}" style="text-align: center;">
                  <td width="25%" id="s_name_{{$form001->user_id}}"> {{agency_name($form001->agency_id)}} </td>
                  <td width="15%" id="s_username_{{$form001->user_id}}">{{date('F j, Y', strtotime($form001->datefrom))}} - {{date('F j, Y', strtotime($form001->dateto))}} </td>
                  <td width="15%" id="s_email_{{$form001->user_id}}">{{date('F j, Y \a\t g:i a', strtotime($form001->created_at))}}  <br>{{author($form001->author_id)}}</td>
                  <td width="15%" id="s_email_{{$form001->user_id}}">{{date('F j, Y \a\t g:i a', strtotime($form001->updated_at))}} <a hr#ef=""> <i class="fa fa-list-alt" title="Updates log" style="margin-left: 10px; font-size: 20px;"></i></a></td>
                  <td width="17%" id="s_email_{{$form001->user_id}}"> 
                      @if($form001->status == ' ' || $form001->status == 0 )
                        <span class="text-info"><b>For Approval</b></span>
                      @else
                        <span class="text-info"><b>Approved</b></span><br><span class="text-success">(please see in monitoring report of findings tab)</span>
                      @endif

                      <h6>total items:  <b class="text-warning">{{count_item($form001->id, 'd')}}</b> |approved: <b class="text-success">{{count_item_approved($form001->id)}}</b>    |     for revision: <b class="text-danger">{{count_item_revision($form001->id)}}</b></h6>
                  </td>
                  <td width="13%"> 
                       <a target="_blank" href="{{action('WordController@createWord', $form001['id'])}}">
                          <button  style="width: 180px;"  type="button" class="btn btn-info btn-md" ><i class="fa fa-file-word-o" aria-hidden="true"></i> Download Audit Report</button>
                        </a>
                  </td>
                </tr>
              @endforeach

            @else

              @foreach($form001me as $form001)
                <tr id="audit_reportrow"  class="treffect_{{$form001->id}}" style="text-align: center;">
                  <td width="25%" id="s_name_{{$form001->user_id}}"> {{agency_name($form001->agency_id)}} </td>
                  <td width="15%" id="s_username_{{$form001->user_id}}">{{date('F j, Y', strtotime($form001->datefrom))}} - {{date('F j, Y', strtotime($form001->dateto))}} </td>
                  <td width="15%" id="s_email_{{$form001->user_id}}">{{date('F j, Y \a\t g:i a', strtotime($form001->created_at))}}  <br>{{author($form001->author_id)}}</td>
                  <td width="15%" id="s_email_{{$form001->user_id}}">{{date('F j, Y \a\t g:i a', strtotime($form001->updated_at))}} <a hr#ef=""> <i class="fa fa-list-alt" title="Updates log" style="margin-left: 10px; font-size: 20px;"></i></a></td>
                  <td width="17%" id="s_email_{{$form001->user_id}}"> 
                      @if($form001->status == ' ' || $form001->status == 0 )
                        <span class="text-info"><b>For Approval</b></span>
                      @elseif($form001->status == 1 && $form001->for_management_action == ' ')
                        <span style="color: orange"><b>Send to Auditee for Management Action</b></span>
                      @else
                        <span class="text-info"><b>Approved</b></span><br><span class="text-success">(please see in monitoring report of findings tab)</span>
                      @endif
                      <h6>total items:  <b class="text-warning">{{count_item($form001->id, 'd')}}</b> |approved: <b class="text-success">{{count_item_approved($form001->id)}}</b>    |     for revision: <b class="text-danger">{{count_item_revision($form001->id)}}</b></h6>
                  </td>

                  <td width="13%"> 
                   <a target="_blank" href="{{action('WordController@createWord', $form001['id'])}}">
                          <button  style="width: 180px;"  type="button" class="btn btn-info btn-md" ><i class="fa fa-file-word-o" aria-hidden="true"></i> Download Audit Report</button>
                        </a>
                  </td>
                </tr>
              @endforeach

              @endif

             </tbody>
            </table>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
              <table id="datatableall" class="table table-striped table-bordered">
            <thead>
              <tr sty>
                <th>Agency / Office / Program / Activity</th>
                <th>Date of Audit</th>
                <th>Creation</th>
                <th>Updates</th>
                <th>Status</th>
              </tr>
            </thead>

            <tbody id="form001_row">
           @if(Auth::user()->role == 4)

               @foreach($form001s as $form001)
                <tr id="audit_reportrow"  class="treffect_{{$form001->id}}" style="text-align: center;">
                  <td width="30%" id="s_name_{{$form001->user_id}}"> {{agency_name($form001->agency_id)}} </td>
                  <td width="15%" id="s_username_{{$form001->user_id}}">{{date('F j, Y', strtotime($form001->datefrom))}} - {{date('F j, Y', strtotime($form001->dateto))}} </td>
                  <td width="10%" id="s_email_{{$form001->user_id}}">{{date('F j, Y \a\t g:i a', strtotime($form001->created_at))}}  <br>{{author($form001->author_id)}}</td>
                  <td width="10%" id="s_email_{{$form001->user_id}}">{{date('F j, Y \a\t g:i a', strtotime($form001->updated_at))}} <a hr#ef=""> <i class="fa fa-list-alt" title="Updates log" style="margin-left: 10px; font-size: 20px;"></i></a></td>
                  <td width="20%" id="s_email_{{$form001->user_id}}"> 
                      @if($form001->status == ' ' || $form001->status == 0 )
                        <span class="text-info"><b>For Approval</b></span>
                      @else
                        <span class="text-info"><b>Approved</b></span><br><span class="text-success">(please see in monitoring report of findings tab)</span>
                      @endif

                      <h6>total items:  <b class="text-warning">{{count_item($form001->id, 'd')}}</b> |approved: <b class="text-success">{{count_item_approved($form001->id)}}</b>    |     for revision: <b class="text-danger">{{count_item_revision($form001->id)}}</b></h6>
                  </td>
                </tr>
              @endforeach

            @else

              @foreach($form001s as $form001)
                <tr id="audit_reportrow"  class="treffect_{{$form001->id}}" style="text-align: center;">
                  <td width="25%" id="s_name_{{$form001->user_id}}"> {{agency_name($form001->agency_id)}} </td>
                  <td width="15%" id="s_username_{{$form001->user_id}}">{{date('F j, Y', strtotime($form001->datefrom))}} - {{date('F j, Y', strtotime($form001->dateto))}} </td>
                  <td width="15%" id="s_email_{{$form001->user_id}}">{{date('F j, Y \a\t g:i a', strtotime($form001->created_at))}}  <br>{{author($form001->author_id)}}</td>
                  <td width="15%" id="s_email_{{$form001->user_id}}">{{date('F j, Y \a\t g:i a', strtotime($form001->updated_at))}} <a hr#ef=""> <i class="fa fa-list-alt" title="Updates log" style="margin-left: 10px; font-size: 20px;"></i></a></td>
                  <td width="30%" id="s_email_{{$form001->user_id}}"> 
                      @if($form001->status == ' ' || $form001->status == 0 )
                        <span class="text-info"><b>For Approval</b></span>
                      @elseif($form001->status == 1 && $form001->for_management_action == ' ')
                        <span style="color: orange"><b>Send to Auditee for Management Action</b></span>
                      @else
                        <span class="text-info"><b>Approved</b></span><br><span class="text-success">(please see in monitoring report of findings tab)</span>
                      @endif
                      <h6>total items:  <b class="text-warning">{{count_item($form001->id, 'd')}}</b> |approved: <b class="text-success">{{count_item_approved($form001->id)}}</b>    |     for revision: <b class="text-danger">{{count_item_revision($form001->id)}}</b></h6>
                  </td>
                </tr>
              @endforeach

              @endif

             </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>







<div class="row">
  <div class="col-xs-6 col-md-12">
  </div>
  
</div>
@include('encoder.partials.modals_form_001')
@endsection
