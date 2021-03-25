@extends('layouts.app_monitoring')

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
  <li class="current"><a href="/auditreporthome" title=""><i class="fa fa-file-text" aria-hidden="true"></i> Monitoring</a></li>
</ul>
<div class="row">
  <div class="col-xs-6 col-md-12">
    <div class="x_panel tile  ">
    <div class="x_title">
      <h4>List of Reports Monitoring </h4>
    </div>
    <div class="x_content">
      <div class="x_panel" style="border-color: transparent;">
        <div class="x_content">
          <table id="datatable" class="table table-striped table-bordered">
            <thead>
              <tr sty>
                <th width="20%">Reports</th>
                <th width="16%">Date of Audit</th>
                <th width="16%">Creation</th>
                <th width="16%">Monitoring Stage</th>
                <th width="16%">Status</th>
                <th width="16%">Action</th>
              </tr>
            </thead>

            <tbody id="form001_row">
              @foreach($reports_monitoring as $rm)
                <tr id="audit_reportrow" style="text-align: center;">
                  <td>{{agency_name($rm->agency_id)}}</td>
                  <td>{{date('F j, Y', strtotime($rm->datefrom))}} - {{date('F j, Y', strtotime($rm->dateto))}}</td>
                  <td>{{date('F j, Y \a\t g:i a', strtotime($rm->created_at))}} <br> {{author($rm->author_id)}}</td>
                  <td>{{check_stage($rm->id)}}</td>
                  <td style="text-align: center">
                    <b class="text-success">{{count_findings_addressed($rm->id, 'i')}}</b> findings addressed out of <b class="text-primary">{{count_item($rm->id, 'i')}}</b><br>
                    <b>OPEN: {{check_total_closed_status($rm->id, 'i')}}  | CLOSED: {{check_total_open_status($rm->id, 'i')}}</b>
                  </td>
                  <td>
                    <a href="/monitoring-reports/{{$rm->id }}">
                      <button class="btn btn-primary"> 
                          Manage Management Action
                      </button>
                    </a>
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
  
</div>
@endsection
