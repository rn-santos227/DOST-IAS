@extends('layouts.app_monitoring')

@section('content')
<ul class="steps steps-5">
  <li><a href="/home" title=""><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
  <li><a href="/monitoring-reports" title=""><i class="fa fa-file-text" aria-hidden="true"></i> Monitoring </a></li>
  <li class="current"><a href="#" title=""><i class="fa fa-files-o" aria-hidden="true"></i> 
        1st Follow-up</a></li>
  <span class="pull-right"><i class="fa fa-archive text-danger" aria-hidden="true"><b> Archived Items</b></i></span>
</ul>

<div class="row">
  <div class="col-xs-6 col-md-12">
    <div class="x_panel tile  ">
    <div class="x_title">
        @foreach($form001s as $form001)
        <h3>
          <div id="agency_name">{{agency_name($form001['agency_id'])}}</div>
          <div style="display: none;" id="f_id">{{$form001['id']}}</div>  
          <button type="button" style="display: " class="btn btn-success btn-md pull-right send_auditee_monitoring" id="send_auditee_monitoring_{{$form001['id']}}" value="{{$form001['id']}}" 
          {{ check_total_open_status($form001->id, 1) == check_status_sendreporttoauditee($form001->id, '1') ? " " : "disabled" }}
          {{ check_receiver($form001->id) == 2 ? " " : "disabled" }}>
           <i class="fa fa-paper-plane" aria-hidden="true"></i> Send monitoring to auditee for second follow-up 
          </button></h4> 
          @if(Auth::user()->role == 5)    
            @if($form001->status == 1)
              <button type="button" id="cancel_approve_report_{{$form001['id']}}" value="{{$form001['id']}}" class="btn btn-danger btn-md pull-right cancel_approve_report">
               <!-- Cancel Approval of Audit Report -->
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
                  <td width="2%" id="">{{$a_finding->auditfinding_no}}</td>
                  <td width="17%" id="">{{$a_finding->audit_area}}</td>
                  <td width="17%" id="">{{$a_finding->sub_auditarea}}</td>
                  <td width="1%" id=""><button data-toggle="modal" data-target="#viewDocuments" title="Supporting Documents" class="btn btn-trans open_upload" value="{{$a_finding->auditfinding_no}}" id="open_upload" {{ check_receiver($a_finding->form_001_id) == 2 ? " " : "disabled" }}><i class="fa fa-folder-open" aria-hidden="true"></i></button> 
                  
                  </td>
                  <td width="13%" id="">{{date('F j, Y \a\t g:i a', strtotime($a_finding->created_at))}} <br> {{author($a_finding->author_id)}}</td>
                  <td width="10%" id="status_{{$a_finding->auditfinding_no}}" style="text-align: center">
                     {{check_open_close_statusupdate($a_finding->form_001_id,$a_finding->auditfinding_no,1)}}
                  </td>
                  <td width="11%"> 



<!-- ************************** Initial Monitoring of Auditee's Management Action for Audit Findings **************************** -->

                    <button  style="display: {{check_monitoring_stage($form001['id'], 2, 2, 1)}}; width: 200px;"  data-toggle="modal" data-target="#viewContentModal" title="View Content" class="btn btn-trans ias_vc_ma" value="{{ $a_finding->form_001_id }}" id="ias_vc_ma_{{ $a_finding->auditfinding_no }}" {{ check_receiver($a_finding->form_001_id) == 2 ? " " : "disabled" }}>
                      <span id="span_{{ $a_finding->auditfinding_no }}">{{checkifmonitored($a_finding->form_001_id,$a_finding->auditfinding_no)}}</span>
                    </button> 
                    <button  style="display: {{view_done_monitoring_stage($form001['id'], 'done1')}};"  data-toggle="modal" data-target="#viewMonitoringFollowUpModal" title="View Content" class="btn btn-trans followup_ias_vc_ma" value="{{ $a_finding->form_001_id }}" id="followup_ias_vc_ma_{{ $a_finding->auditfinding_no }}">
                      <span id="span_{{ $a_finding->auditfinding_no }}">view monitoring</span>
                    </button> 

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
      
      <!-- adakopdaopskasassasasa -->
      @include('monitoring.partials.modals_report_content')
      @include('monitoring.partials.modals_partials.monitoring_followups_modal')
    </div>
  </div>
  
</div>
@endsection
