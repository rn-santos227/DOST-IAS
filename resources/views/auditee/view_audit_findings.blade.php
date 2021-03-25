@extends('layouts.app_auditee')

@section('content')
    
<center><div id="flashMessage"  class="alert alert-dismissable alert-success" style="width: 500px; display: none">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
    <h6 id="create_message" style="display: none"><strong>Success! </strong> Audit Finding and Recommendation has been created . . . </h6> 
    <h6 id="update_message" style="display: none"><strong>Success! </strong> Audit Finding and Recommendation has been updated . . . </h6> 
</div></center>

<ul class="steps steps-5">
  <li><a href="/home" title=""><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
  <li><a href="/auditreporthome" title=""><i class="fa fa-file-text" aria-hidden="true"></i> Form 001</a></li>
  <li class="current"><a href="#" title=""><i class="fa fa-files-o" aria-hidden="true"></i> 
        @foreach($form001s as $form001)
          {{agency_code($form001['agency_id'])}}
        @endforeach</a></li>
  <span class="pull-right"><i class="fa fa-archive text-danger" aria-hidden="true"><b> Archived Items</b></i></span>
</ul>


<div class="row">
  <div class="col-xs-6 col-md-12">
    <div class="x_panel tile  ">
    <div class="x_title">
        @foreach($form001s as $form001)
        <h3>
          <div id="agency_name">{{agency_name($form001['agency_id'])}} | 
            @if($form001->for_management_action == 'i' && $form001->receiver == 1 )
              <b></b>
            @elseif($form001->for_management_action == 1 && $form001->receiver == 2 )
              <b>FOR AUDITORS' EVALUATION</b>
            @elseif($form001->for_management_action == 1 && $form001->receiver == 1 )
              <b>FIRST FOLLOW-UP</b>
            @elseif($form001->for_management_action == 2 && $form001->receiver == 2 )
              <b>FOR AUDITORS' EVALUATION</b>
            @elseif($form001->for_management_action == 2 && $form001->receiver == 1 )
              <b>SECOND FOLLOW-UP</b>
            @endif
          </div>
          <div style="display: none;" id="f_id">{{$form001['id']}}</div>  
          <button type="button" class="btn btn-success btn-md pull-right send_ias_mgtaction" id="send_ias_mgtaction_{{$form001['id']}}" value="{{$form001['id']}}" 


          @if($form001->for_management_action == 'i' && $form001->receiver == 1 )
            {{check_status_sendreporttoias($form001['id'])}}
          @elseif($form001->for_management_action == 1 && $form001->receiver == 2 )
            {{check_status_sendreporttoias($form001['id'])}}
          @else
             @if(check_fu_mgmtaction($form001->id) != count_allopen($form001->id)+count_allparadd($form001->id))
              disabled
             @else
             @endif
          @endif

          >
           <i class="fa fa-paper-plane" aria-hidden="true"></i> Send Management Actions to DOST Internal Audit Service 
          </button></h4> 
          @if(Auth::user()->role == 5)    
            @if($form001->status == 1)
              <button type="button" id="cancel_approve_report_{{$form001['id']}}" value="{{$form001['id']}}" class="btn btn-danger btn-md pull-right cancel_approve_report">
               Cancel Approval of Audit Report
              </button>
              <button style="display: none" type="button" id="approve_report_{{$form001['id']}}" value="{{$form001['id']}}" class="btn btn-success btn-md pull-right approve_report">
               Approve Audit Report
              </button>
            @else       
              <button type="button" id="approve_report_{{$form001['id']}}" value="{{$form001['id']}}" class="btn btn-success btn-md pull-right approve_report">
               Approve Audit Report
              </button>
              <button style="display: none" type="button" id="cancel_approve_report_{{$form001['id']}}" value="{{$form001['id']}}" class="btn btn-danger btn-md pull-right cancel_approve_report">
               Cancel Approval of Audit Report
              </button>
            @endif
          @else
          @endif
        </h3>
        <h5>
          {{date('F j, Y', strtotime($form001['datefrom']))}} - {{date('F j, Y', strtotime($form001['dateto']))}}
        </h5>
         <h5 class="text-danger">
          <b>Summary of Recommendation status:
            <span style="color: #1E869D;">
              @if($form001->for_management_action == 'i' && $form001->receiver == 1 )
                {{count_allrecommendationanswer($form001->id)}} answers out of {{count_allrecommendation($form001->id)}} recommendations
              @elseif($form001->for_management_action == 1 && $form001->receiver == 2 )
                Waiting for Auditors' Evaluation
              @else
                 {{check_fu_mgmtaction($form001->id)}} answered out of {{count_allopen($form001->id)+count_allparadd($form001->id)}} follow-ups
                 | OPEN: <b style="color:red">{{count_allopen($form001->id)}}</b> | PARTIALLY ADDRESSED: <b style="color:orange">{{count_allparadd($form001->id)}}</b> | CLOSED: <b style="color:green">{{count_allclosed($form001->id)}}</b>
              @endif
            </span>
          </b>
        </h5>
        @endforeach

    </div>
    <div class="x_content">
      <div class="x_panel" style="border-color: transparent;">
        <div class="x_content">
          <table id="datatable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Item</th>
                <th>Area of Audit</th>
                <th>Sub Area of Audit</th>
                <th>Documents</th>
                <th>Creation</th>
                <th>Status</th>
                <th>Options</th>
              </tr>
            </thead>

            <tbody id="formcontent_row">
              @foreach($a_findings as $a_finding)
                <input style="display: none" type="text" name="form001no" id="form001no" value="{{$a_finding->form_001_id}}">
                <tr id="fcontent_row" style="color: {{ $a_finding->archive_status == 0 ? "" : "red" }}">
                  <td width="1%" id=""><center>{{$a_finding->subof == '' ? $a_finding->auditfinding_no : $a_finding->subof}} </center> </td>
                  <td width="15%" id=""><center>{{$a_finding->audit_area}} {{$a_finding->custom_auditarea}}</center></td>
                  <td width="15%" id=""><center>{{$a_finding->sub_auditarea}}</center></td>
                  <td width="1%" id=""><center><button data-toggle="modal" data-target="#viewDocuments" title="Supporting Documents" class="btn btn-sm btn-trans open_upload" value="{{$a_finding->auditfinding_no}}" id="open_upload"><i class="fa fa-lg fa-folder-open" aria-hidden="true"></i> <span class="badge bg-green">{{count_docs($a_finding->form_001_id, $a_finding->auditfinding_no)}}</span></button> 
                  </center>
                  </td>
                  <td width="10%" id=""><center>{{date('F j, Y \a\t g:i a', strtotime($a_finding->created_at))}} <br> {{author($a_finding->author_id)}}</center></td>
                  <td width="13%" id="status_{{$a_finding->id}}" style="text-align: left;">

                  @if(check_stage($a_finding->form_001_id) == 0 || check_stage($a_finding->form_001_id) == 1)
                    Open/Close:
                      <i  style="display: {{check_monitoring_stage($form001['id'], 1, 2, 'i')}};" data-toggle="tooltip" title="{{ check_receiver($form001->id) == 1 ? " " : "Auditors are currently evaluating your management action" }}" class="fa fa-info-circle fa-lg text-info"></i>
                      <span style="display: {{check_ma_status_span_display($form001['id'])}};" >{{check_ma_status($a_finding->form_001_id, $a_finding->auditfinding_no)}}</span>
                      <br>
                    Answered: 
                      <b style="color: green">{{check_answered_recommendation_count($a_finding->form_001_id, $a_finding->auditfinding_no)}}</b> out of  <b style="color: #f26321">{{count_recommendation($a_finding->form_001_id, $a_finding->auditfinding_no)}} </b> recommendation(s)
                  @else

                     Status:                  
                      @if(count_closedstat($a_finding->form_001_id, $a_finding->auditfinding_no) / count_recommendation($a_finding->form_001_id, $a_finding->auditfinding_no) * 100 == 100)
                        <b style="color: green"> CLOSED </b>
                      @elseif(count_openstat($a_finding->form_001_id, $a_finding->auditfinding_no) / count_recommendation($a_finding->form_001_id, $a_finding->auditfinding_no) * 100 == 100)
                        <b style="color: red"> OPEN </b>
                      @elseif(count_paraddstat($a_finding->form_001_id, $a_finding->auditfinding_no) / count_recommendation($a_finding->form_001_id, $a_finding->auditfinding_no) * 100 == 100)
                        <b style="color: orange"> OPEN, partially addressed </b>
                      @elseif(count_closedstat($a_finding->form_001_id, $a_finding->auditfinding_no) != 0 &&  count_closedstat($a_finding->form_001_id, $a_finding->auditfinding_no)/ count_recommendation($a_finding->form_001_id, $a_finding->auditfinding_no) * 100 != 100)
                        <b style="color: orange"> OPEN, partially addressed </b>
                      @elseif(count_closedstat($a_finding->form_001_id, $a_finding->auditfinding_no) == 0 && count_openstat($a_finding->form_001_id, $a_finding->auditfinding_no) != 0 &&  count_paraddstat($a_finding->form_001_id, $a_finding->auditfinding_no) == 0) 
                        <b style="color: red"> OPEN</b>
                      @elseif(count_closedstat($a_finding->form_001_id, $a_finding->auditfinding_no) == 0 && count_openstat($a_finding->form_001_id, $a_finding->auditfinding_no) == 0 &&  count_paraddstat($a_finding->form_001_id, $a_finding->auditfinding_no) != 0) 
                        <b style="color: orange"> OPEN, partially addressed </b>
                      @elseif(count_closedstat($a_finding->form_001_id, $a_finding->auditfinding_no) == 0 && count_openstat($a_finding->form_001_id, $a_finding->auditfinding_no) != 0 &&  count_paraddstat($a_finding->form_001_id, $a_finding->auditfinding_no) != 0) 
                        <b style="color: orange"> OPEN, partially addressed </b>
                      @else
                      <b style="color: #f26321">Not yet evaluated</b>
                      @endif
                     <button class="btn btn-xs pull-right" style="font-size: 9px !important; background-color: #d7eff6"><i class="fa fa-history pull-right" data-toggle="tooltip" title="Status History"></i></button> 
                  
                     <br>
                    Open: <b style="color: red">{{count_openstat($a_finding->form_001_id, $a_finding->auditfinding_no)}}</b> 
                      | partially addressed: <b style="color: orange">{{count_paraddstat($a_finding->form_001_id, $a_finding->auditfinding_no)}}</b> 
                      | Close: <b style="color: green">{{count_closedstat($a_finding->form_001_id, $a_finding->auditfinding_no)}} </b>
                      <br>

                      @if(count_closedstat($a_finding->form_001_id, $a_finding->auditfinding_no) / count_recommendation($a_finding->form_001_id, $a_finding->auditfinding_no) * 100 == 100)
                      
                      @else
                        Answered: <b>{{count_answered_ffu($a_finding->form_001_id, $a_finding->auditfinding_no)}} </b> out of <b>{{count_all_ffu($a_finding->form_001_id, $a_finding->auditfinding_no)}} </b> follow-up(s)
                      @endif
                  @endif




                  </td>
                  <td width="8%"> 
                    <center> 
                      @if(count_closedstat($a_finding->form_001_id, $a_finding->auditfinding_no) / count_recommendation($a_finding->form_001_id, $a_finding->auditfinding_no) * 100 == 100)
                        <button style="width: 198px;" class="btn btn-success vc_ma" value="{{$a_finding->form_001_id}}" id="vc_ma_{{ $a_finding->auditfinding_no }}" data-toggle="modal" data-target="#{{addressManagementActionModal($a_finding->form_001_id, $a_finding->auditfinding_no)}}" {{ check_receiver($form001->id) == 1 ? " " : "disabled" }}>
                          <!-- <i data-toggle="tooltip" data-placement="top" title="My Tooltip text!" class="fa fa-edit"></i> -->
                        <span id="span_{{ $a_finding->auditfinding_no }}">CLOSED</span>
                      </button>
                      @else
                        <button style="width: 198px;" class="btn {{check_ma_status($a_finding->form_001_id, $a_finding->auditfinding_no) == "CLOSED" ? "btn-success" : "btn-info"}} vc_ma" value="{{$a_finding->form_001_id}}" id="vc_ma_{{ $a_finding->auditfinding_no }}" data-toggle="modal" data-target="#{{addressManagementActionModal($a_finding->form_001_id, $a_finding->auditfinding_no)}}" {{ check_receiver($form001->id) == 1 ? " " : "disabled" }}>
                          <!-- <i data-toggle="tooltip" data-placement="top" title="My Tooltip text!" class="fa fa-edit"></i> -->
                        <span id="span_{{ $a_finding->auditfinding_no }}">{{checkifaddressed($a_finding->form_001_id, $a_finding->auditfinding_no)}}</span>
                      </button>
                      @endif
<!-- 
                      <button style="width: 198px;" class="btn vc_ma" value="" id="" data-toggle="modal" data-target="">
                        <span id="">View</span>
                      </button> -->

                    </center>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal -->
      
      @include('auditee.partials.modals_report_content')
      @include('auditee.partials.modal_partials.follow_ups_modal')
    </div>
  </div>
  
</div>
@endsection
