@extends('layouts.app_encoder')

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
          <div id="agency_name">{{agency_name($form001['agency_id'])}}</div>
          <div style="display: none;" id="f_id">{{$form001['id']}}</div>   
          @if(Auth::user()->role == 5)    
            @if($form001->status == 1 && $form001->for_management_action == ' ')
              <button type="button" id="cancel_approve_report_{{$form001['id']}}" value="{{$form001['id']}}" class="btn btn-danger btn-md pull-right cancel_approve_report">
               Cancel Approval of Audit Report
              </button>
              <button style="display: none" type="button" id="approve_report_{{$form001['id']}}" value="{{$form001['id']}}" class="btn btn-success btn-md pull-right approve_report">
               Approve Audit Report
              </button>
            @elseif($form001->status == ' ' || $form001->status == 0 )       
              <button type="button" id="approve_report_{{$form001['id']}}" value="{{$form001['id']}}" class="btn btn-success btn-md pull-right approve_report" {{count_item_revision($form001['id']) > 0 ? "disabled" : "" }}>
               Approve Audit Report
              </button>
              <button style="display: none" type="button" id="cancel_approve_report_{{$form001['id']}}" value="{{$form001['id']}}" class="btn btn-danger btn-md pull-right cancel_approve_report">
               Cancel Approval of Audit Report
              </button>
            @endif




          @else
          @endif
            <a target="_blank" href="{{action('WordController@createWord', $form001['id'])}}">
            <button type="button" class="btn btn-info btn-md pull-right" >
              Review Report
            </button>
            </a>
              <button type="button" id="a_name" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#myModal" 
              {{ check_status_if_fma($form001['id']) }}>
                Add Finding
              </button>

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
                <th>Status</th>
                <th>Options</th>
              </tr>
            </thead>

            <tbody id="formcontent_row">
              @foreach($a_findings as $a_finding)
                <input style="display: none" type="text" name="form001no" id="form001no" value="{{$a_finding->form_001_id}}">
                <tr id="fcontent_row" class="treffect_{{$a_finding->auditfinding_no}} " style="color: {{ $a_finding->archive_status == 0 ? "" : "red" }}">
    
                  <td width="2%" id=""><center>{{$a_finding->subof == '' ? $a_finding->auditfinding_no : $a_finding->subof}} </center> </td>
                  <td width="17%" id="fauditarea_{{$a_finding->auditfinding_no}}"><center>{{$a_finding->audit_area}} {{$a_finding->custom_auditarea }}</center></td>
                  <td width="17%" id="fsubauditarea_{{$a_finding->auditfinding_no}}"><center>{{$a_finding->sub_auditarea}}</center></td>
                  <td width="1%" id=""><center><button data-toggle="modal" data-target="#viewDocuments" title="Supporting Documents" class="btn btn-trans open_upload" value="{{$a_finding->auditfinding_no}}" id="open_upload" {{ check_status_if_fma($a_finding->form_001_id) }}><i class="fa fa-folder-open" aria-hidden="true"></i></button> 
                  </center>
                  </td>
                  <td width="13%" id=""><center>{{date('F j, Y \a\t g:i a', strtotime($a_finding->created_at))}} <br> {{author($a_finding->author_id)}}</center></td>
                  <td width="10%" id="status_{{$a_finding->id}}" style="text-align: center">
                    
                      @if($a_finding->status == 1)
                        <h5 class="text-danger"> for revision</h5>
                      @elseif($a_finding->status == 2)
                        <h5 class="text-success"> <i class="fa fa-check" aria-hidden="true"></i> approved </h5>
                      @else
                        <h5 style="color: orange"> for review and approval</h5>
                      @endif  

                  </td>
                  <td width="11%"> 
                   <center> 

                        <button data-toggle="modal" data-target="#viewContentModal" title="View Content" class="btn btn-trans vc" value="" id="vc_{{ $a_finding->auditfinding_no }}">
                          <i class="fa fa-eye text-info" ></i>
                        </button> 
                        

                        @if($a_finding->archive_status == 0)
                          <button data-toggle="modal" data-target="#myModalUpdate" title="Update Content" class="btn btn-trans update_c " value="" id="update_c_{{ $a_finding->auditfinding_no }}" {{ check_status_if_fma($a_finding->form_001_id) }}>
                          <i class="fa fa-pencil-square-o text-warning" > </i>
                        </button> 
                        @else
                          <button disabled="" data-toggle="modal" data-target="#myModal" title="Item Archived: Update Restricted" class="btn btn-trans update_c" value="" id="update_c_{{ $a_finding->auditfinding_no }}"  {{ check_status_if_fma($a_finding->form_001_id) }}>
                          <i class="fa fa-pencil-square-o text-warning" ></i>
                        </button> 
                        @endif

                   <!--      @if($a_finding->archive_status == 0)
                          <button data-toggle="tooltip" title="Archive Finding" class="btn btn-trans archive" value="" id="btn_archive_{{ $a_finding->id }}" {{ check_status_if_fma($a_finding->form_001_id) }}>
                            <i class="fa fa-trash-o text-danger"  ></i>
                          </button> 
                        @else
                          <button data-toggle="tooltip" title="Unarchive Finding" class="btn btn-trans unarchive" value="" id="btn_unarchive_{{ $a_finding->id }}"   {{ check_status_if_fma($a_finding->form_001_id) }}>
                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                          </button> 
                        @endif -->

                        <!-- @if($a_finding->subof != '')
                          <button data-toggle="modal" data-target="#myModal" title="Update Content" class="btn btn-sm btn-trans addsubfinding" value="" id="addsubfinding_{{ $a_finding->auditfinding_no }}">
                            <i class="fa fa-minus-circle text-danger"> </i>
                          </button>
                        @else
                           <button data-toggle="modal" data-target="#myModal" title="Update Content" class="btn btn-trans addsubfinding" value="" id="addsubfinding_{{ $a_finding->auditfinding_no }}">
                            <i class="fa fa-plus text-success"> </i>
                          </button>
                        @endif -->

                        
                         
                        @if(Auth::user()->role == 5)
                          
                          @if($a_finding->status == 2)
                            | <button data-toggle="tooltip" title="Approve Audit Finding Item" class="btn btn-success approve" id="btn_approve" value="{{ $a_finding->id }}" disabled=""  {{ check_status_if_fma($a_finding->form_001_id) }}>
                            <i class="fa fa-check" aria-hidden="true"></i>
                          </button> <input type="hidden" name="" id="user_role" value="">
                          @else
                            | <button data-toggle="tooltip" title="Approve Audit Finding Item" class="btn btn-success approve" id="btn_approve_{{ $a_finding->id }}" value="{{ $a_finding->id }}"  {{ check_status_if_fma($a_finding->form_001_id) }}>
                            <i class="fa fa-check" aria-hidden="true"></i>
                            <input type="hidden" name="" id="user_role" value="5">
                          @endif  

                        @else

                        @endif
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
      
      <!-- adakopdaopskasassasasa -->
      @include('encoder.partials.modals_form_001_content')
    </div>
  </div>
  
</div>
@endsection
