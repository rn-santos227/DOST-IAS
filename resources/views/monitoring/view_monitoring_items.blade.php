@extends('layouts.app_monitoring')

@section('content')
<ul class="steps steps-5">
  <li><a href="/home" title=""><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
  <li><a href="/monitoring-reports" title=""><i class="fa fa-file-text" aria-hidden="true"></i> Monitoring </a></li>
  <li class="current"><a href="#" title=""><i class="fa fa-files-o" aria-hidden="true"></i> Management Action</a></li>
</ul>

<div class="row">
  <div class="col-xs-6 col-md-12">
    <div class="x_panel tile  ">
    <div class="x_title">
        @foreach($form001s as $form001)
        <h3>
          <div id="agency_name">{{agency_name($form001['agency_id'])}} | 
            @if($form001->for_management_action == 'i' && $form001->receiver == 1 )
              <b>FOR AUDITEE'S MANAGEMENT ACTION</b>
            @elseif($form001->for_management_action == 1 && $form001->receiver == 2 )
              <b>FIRST FOLLOW-UP</b>
            @elseif($form001->for_management_action == 1 && $form001->receiver == 1 )
              <b>FIRST FOLLOW-UP</b>
            @elseif($form001->for_management_action == 2 && $form001->receiver == 2 )
              <b>SECOND FOLLOW-UP</b>
            @elseif($form001->for_management_action == 2 && $form001->receiver == 1 )
              <b>SECOND FOLLOW-UP</b> <small style="color: red">(For Auditee's Management Action)</small> 
            @elseif($form001->for_management_action == 3 && $form001->receiver == 2 )
              <b>THIRD FOLLOW-UP</b>
            @endif
          </div>
          <div style="display: none;" id="f_id">{{$form001['id']}}</div>  
          <div class="dropdown" style="float:right;">
            <button class="dropbtn"><i class="fa fa-print" aria-hidden="true"></i> Print {{agency_code($form001['agency_id'])}} Audit Reports</button>
            <div class="dropdown-content">
             <div class="panel panel-default">
                <div class="panel-body">
                  <table class="table-drpdwn">
                  <tr class="">
                    <th class="">Matrix</th>
                    <th class="">Summary of open/unaddressed item(s)</th>
                  </tr>
                  <tr class="">
                    <td class="table-drpdwntd"><a target="_blank" href="{{ url('/download_followupaudit_report/'.$form001['id'].'/'.'1') }}" style="pointer-events: {{check_status_print($form001['id'], 1)}}; cursor:{{check_cusrsor_print($form001['id'], 1)}};">1st Follow-up</a></td>
                    <td class="table-drpdwntd"><a target="_blank" href="{{ url('/download_summary_report/'.$form001['id'].'/'.'1') }}" style="pointer-events: {{check_status_print($form001['id'], 1)}}; cursor:{{check_cusrsor_print($form001['id'], 1)}};">1st Summary of unaddressed</a></td>
                  </tr>
                  <tr class="">
                    <td class="table-drpdwntd"><a target="_blank" href="{{ url('/download_followupaudit_report/'.$form001['id'].'/'.'2') }}" style="pointer-events: {{check_status_print($form001['id'], 2)}}; cursor:{{check_cusrsor_print($form001['id'], 2)}};">2nd Follow-up</a></td>
                    <td class="table-drpdwntd"><a target="_blank" href="{{ url('/download_summary_report/'.$form001['id'].'/'.'2') }}" style="pointer-events: {{check_status_print($form001['id'], 2)}}; cursor:{{check_cusrsor_print($form001['id'], 2)}};">2nd Summary of unaddressed</a></td>
                  </tr>
                  <tr class="">
                    <td class="table-drpdwntd"><a target="_blank" href="{{ url('/download_followupaudit_report/'.$form001['id'].'/'.'3') }}" style="pointer-events: {{check_status_print($form001['id'], 3)}}; cursor:{{check_cusrsor_print($form001['id'], 3)}};">3rd Follow-up</a></td>
                    <td class="table-drpdwntd"><a target="_blank" href="{{ url('/download_summary_report/'.$form001['id'].'/'.'3') }}" style="pointer-events: {{check_status_print($form001['id'], 3)}}; cursor:{{check_cusrsor_print($form001['id'], 3)}};">3rd Summary of unaddressed</a></td>
                  </tr>
                  <tr class="">
                    <td class="table-drpdwntd"><a target="_blank" href="{{ url('/download_followupaudit_report/'.$form001['id'].'/'.'f') }}" style="pointer-events: {{check_status_print($form001['id'], 'f')}}; cursor:{{check_cusrsor_print($form001['id'], 'f')}};">Closing of audit cycle</a></td>
                    <td class="table-drpdwntd"><a target="_blank" href="{{ url('/download_summary_report/'.$form001['id'].'/'.'f') }}" style="pointer-events: {{check_status_print($form001['id'], 'f')}}; cursor:{{check_cusrsor_print($form001['id'], 'f')}};">Closing Summary of unaddressed</a></td>
                  </tr>
                </table>
              </div>
            </div>
            </div>
          </div>
          <button type="button" style="display: {{check_if_closing($form001['id'])}} " class="btn btn-success btn-md pull-right send_auditee_monitoring" id="send_auditee_monitoring_{{$form001['id']}}" value="{{$form001['id']}}" 
          {{check_status_sendreporttoauditee($form001['id'])}}> <!-- ok -->
           <i class="fa fa-paper-plane" aria-hidden="true"></i> Send follow-up to auditee 
          </button>
          </h4> 
          @if(Auth::user()->role == 5)    
            @if($form001->status == 1)
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
          <b>Report's current status: 
            <span style="color: #1E869D;">
              @if($form001->for_management_action == 'i' && $form001->receiver == 1 )
                <u>waiting for auditee's management action</u> 
              @elseif($form001->for_management_action == 1 && $form001->receiver == 2 )
                 {{check_answered_ffu_count($form001->id)}} evaluated out of {{count_allrecommendation($form001->id)}} management actions
                 | OPEN: <b style="color:red">{{count_allopen($form001->id)}}</b> | PARTIALLY ADDRESSED: <b style="color:orange">{{count_allparadd($form001->id)}}</b> | CLOSED: <b style="color:green">{{count_allclosed($form001->id)}}</b>
              @elseif($form001->for_management_action == 1 && $form001->receiver == 1 )
                 <u>waiting for auditee's management action for first follow-up</u> 
                 | OPEN: <b style="color:red">{{count_allopen($form001->id)}}</b> | PARTIALLY ADDRESSED: <b style="color:orange">{{count_allparadd($form001->id)}}</b> | CLOSED: <b style="color:green">{{count_allclosed($form001->id)}}</b>
              @elseif($form001->for_management_action == 2 && $form001->receiver == 2 )
                 {{check_answered_ffu_count($form001->id)}} evaluated out of {{count_all_openprevious($form001->id)}} management actions
                 | OPEN: <b style="color:red">{{count_allopen($form001->id)}}</b> | PARTIALLY ADDRESSED: <b style="color:orange">{{count_allparadd($form001->id)}}</b> | CLOSED: <b style="color:green">{{count_allclosed($form001->id)}}</b>
              @elseif($form001->for_management_action == 2 && $form001->receiver == 1 )
                 {{check_fu_mgmtaction($form001->id)}} answered out of {{count_allopen($form001->id)+count_allparadd($form001->id)}} follow-ups
                 | OPEN: <b style="color:red">{{count_allopen($form001->id)}}</b> | PARTIALLY ADDRESSED: <b style="color:orange">{{count_allparadd($form001->id)}}</b> | CLOSED: <b style="color:green">{{count_allclosed($form001->id)}}</b>
              @elseif($form001->for_management_action == 3 && $form001->receiver == 2 )
                 {{check_answered_ffu_count($form001->id)}} evaluated out of {{count_all_openprevious($form001->id)}} management actions
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
                <th>Status (Open/Close)</th>
                <th>Options</th>
              </tr>
            </thead>

            <tbody id="formcontent_row">
              @foreach($a_findings as $a_finding)
                <input style="display: none" type="text" name="form001no" id="form001no" value="{{$a_finding->form_001_id}}">
                <tr id="fcontent_row" style="text-align: center; color: {{ $a_finding->archive_status == 0 ? "" : "red" }}">
                  <td width="1%" id=""><center>{{$a_finding->subof == '' ? $a_finding->auditfinding_no : $a_finding->subof}} </center> </td>
                  <td width="15%" id="">{{$a_finding->audit_area}}{{$a_finding->custom_auditarea}}</td>
                  <td width="15%" id="">{{$a_finding->sub_auditarea}}</td>
                  <td width="1%" id=""><center><button data-toggle="modal" data-target="#viewDocuments" title="Supporting Documents" class="btn btn-sm btn-trans open_upload" value="{{$a_finding->auditfinding_no}}" id="open_upload" ><i class="fa fa-lg fa-folder-open" aria-hidden="true"></i> <span class="badge bg-green">{{count_docs($a_finding->form_001_id, $a_finding->auditfinding_no)}}</span></button> 
                  </center>
                  </td>
                  <td width="10%" id="">{{date('F j, Y \a\t g:i a', strtotime($a_finding->created_at))}} <br> {{author($a_finding->author_id)}}</td>
                  <td width="14%" id="status_{{$a_finding->auditfinding_no}}" style="text-align: left">
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
                  @if(count_closedstat($a_finding->form_001_id, $a_finding->auditfinding_no) / count_recommendation($a_finding->form_001_id, $a_finding->auditfinding_no) * 100 == 100)
                 
                  @else
                    Open: <b style="color: red">{{count_openstat($a_finding->form_001_id, $a_finding->auditfinding_no)}}</b> 
                  | partially addressed: <b style="color: orange">{{count_paraddstat($a_finding->form_001_id, $a_finding->auditfinding_no)}}</b> 
                  | Close: <b style="color: green">{{count_closedstat($a_finding->form_001_id, $a_finding->auditfinding_no)}} </b>
                    Monitored: <b>{{count_monitored_mgmtaction($a_finding->form_001_id, $a_finding->auditfinding_no)}} </b> out of <b>{{count_recommendations($a_finding->form_001_id, $a_finding->auditfinding_no)}} </b> mgmt action(s)
                  @endif
                  </td> 
                  <td width="8%"> 

<!-- ************************** INITIAL Monitoring of Auditee's Management Action for Audit Findings **************************** -->
                    @if(check_receiver($a_finding->form_001_id) == 2)
                      <button  style="width: 208px; margin-top: 3px"  data-toggle="modal" data-target="#viewContentModal" title="View Content" class="btn btn-info ias_vc_ma" value="{{ $a_finding->form_001_id }}" id="ias_vc_ma_{{ $a_finding->auditfinding_no }}" {{ check_receiver($a_finding->form_001_id) == 2 ? " " : "disabled" }}>
                        <span id="span_{{ $a_finding->auditfinding_no }}">{{checkifmonitored($a_finding->form_001_id, $a_finding->auditfinding_no)}}</span>
                        Evaluate Management Action
                      </button>
                    @else
                      <button  style="display: ;"  data-toggle="modal" data-target="#viewMonitoringFollowUpModal" title="View Content" class="btn btn-trans followup_ias_vc_ma" value="{{ $a_finding->form_001_id }}" id="followup_ias_vc_ma_{{ $a_finding->auditfinding_no }}">
                        <span id="span_{{ $a_finding->auditfinding_no }}">view monitoring</span>
                      </button> 
                    @endif

<!-- ********************************************************* -END- *********************************************************** -->

                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal -->
      
      @include('monitoring.partials.modals_report_content')
      @include('monitoring.partials.modals_partials.monitoring_followups_modal')
    </div>
  </div>
  
</div>
@endsection
