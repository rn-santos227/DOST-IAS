<!-- ***************************************** ADD AUDIT FINDING ITEM ***************************************** -->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="width: 950px" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <center><h3 class="modal-title" id="">Add Audit Finding 
                <!--   @foreach($form001s as $form001)
                    {{count_audit_finding_no($form001['agency_id'])}}
                  @endforeach -->
               </h3></center> 
               <center><div id="flashErrorMessage"  class="alert alert-dismissable alert-danger" style="width: 500px; display: none">
                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                      <h6 id="error_message" style="display: none"><strong>Error! </strong> Please fill up all fields . . . </h6> 
                  </div></center>
            </div>
            <div class="modal-body">
              <div class="panel-body">
                <form id="submitFormContent" class="form-horizontal" method="POST">
                      {{ csrf_field() }}        
                  <input type="text" style="display: none;" name="_id" id="_id">
                  <input type="text" style="display: none;" name="update_id" id="update_id">        
                  <div class="form-group">
                    <label for="audit_mem" class="col-md-3 control-label">Tag Area</label>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-xs-10 col-sm-8">
                            <select name="tag_a" id="tag_a" style="width: 482px;" class="form-control">
                              <option value="1">Technical Operations</option>
                              <option value="2">Administrative Services</option>
                              <option value="3">Financial Management</option>
                            </select>
                          </div>
                        </div>
                    </div>
                  </div>  
                  <div class="form-group">
                    <label for="audit_mem" class="col-md-3 control-label">Audit Area</label>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-xs-10 col-sm-8">
                            <select name="scope_a" id="scope_a" style="width: 482px;" class="form-control">
                              @foreach(explode(',', $scopes) as $scope)
                              <option>{{ clean($scope) }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="audit_mem" class="col-md-3 control-label">Custom Audit Area</label>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-xs-10 col-sm-9">
                            <input type="text" style="display: inline-block; " class="form-control" id="c_audit" name="c_audit" value="" disabled="">      
                            <button type="button" class="btn btn-success btn-xs enable_ca" >Enable Custom Area</button>   
                            <button type="button" style="display: none" class="btn btn-danger btn-xs disable_ca" >Disable Custom Area</button>   
                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Once custom area is enabled, Audit Area will be disabled and its input will be disregard"></i>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="audit_mem" class="col-md-3 control-label">Sub-Audit Area</label>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-xs-10 col-sm-9">
                            <input type="text" style="display: inline-block; " class="form-control" id="s_audit" name="s_audit" value="">                           
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="audit_mem" class="col-md-3 control-label">Custom Sub-Audit Area</label>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-xs-10 col-sm-9">
                            <input type="text" style="display: inline-block; " class="form-control" id="c_audit" name="c_subaudit" value="">                   
                          </div>
                        </div>
                    </div>
                  </div>

                  <hr>

                  <div class="col-xs-12 col-md-12"> 
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                      <label for="title" class="col-md-12 control-label" style="text-align: center;">FINDING(S)</label>
                      <div class="col-md-12" style="margin-top: 15px;">
                          <textarea name="findings" id="findings">
                          </textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row" id="comments">
                    <h3 class="accordion" style="background: #36404f; color:white">Comment Section (Click here to write a comment . . . )</h3>
                    <div class="panel">
                      <div class="row" id="comments">
                        <div class="col-xs-6 col-md-6"> 
                          <h4>Comments for audit finding: </h4>
                            <span contenteditable="" id="findings_comment" name="findings_comment" class="spancomment" style="display:block; width:665px;"></span> <br>
                            <input type="hidden" name="findings_comment1" id="findings_comment1">
                            <button style="margin-top: 20px;" type="button" id="add_fcomment" class="btn btn-success btn-sm pull-right add_fcomment " disabled="">
                              @if(Auth::user()->role == 5)
                                Add comment <br> for revision
                              @else
                                Add comment
                              @endif
                            </button>
                            <br>
                            <div id="commentf_container" style="margin-top: 20px;">
                              <ul class="tabs"></ul>
                            </div>
                        </div>

                        <div class="col-xs-5 col-md-6">
                          <h4>Comments for audit recommendation: </h4>
                          <span contenteditable="" id="recommendation_comment" name="recommendation_comment" class="spancomment " style="display:block; width:665px;"></span> 
                          <input type="hidden" name="recommendation_comment1" id="recommendation_comment1">
                          <button style="margin-top: 20px;" type="button" id="add_rcomment" class="btn btn-success btn-sm pull-right add_rcomment" disabled="">
                            @if(Auth::user()->role == 5)
                              Add comment <br> for revision
                            @else
                              Add comment
                            @endif
                          </button>
                          <br>
                          <div id="comment_container" style="margin-top: 20px;">
                            <ul class="tabs"></ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button id="submit" type="button" class="btn btn-primary submit_auditfinding">Add Audit Finding Item</button>
          <button style="display: none" id="update_af" type="button" class="btn btn-primary submit_updateauditfinding">Update Audit Finding Item</button>
          <!-- <button style="display: none" id="add_subf" type="button" class="btn btn-primary submit_addsubfinding">Submit Sub-Audit Finding Item</button> -->
        </div>
      </div>
    </div>
  </div>


<!-- ***************************************** UPDATE AUDIT FINDING ITEM ***************************************** -->
<div class="modal fade" id="myModalUpdate" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="width: 1450px" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <center><h3 class="modal-title" id="myModalLabel"></h3></center> 
               <center><div id="flashErrorMessage"  class="alert alert-dismissable alert-danger" style="width: 500px; display: none">
                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                      <h6 id="error_message" style="display: none"><strong>Error! </strong> Please fill up all fields . . . </h6> 
                  </div></center>
            </div>
            <div class="modal-body">
              <div class="panel-body">
                <form id="submitUpdateFormContent" class="form-horizontal" method="POST">
                      {{ csrf_field() }}        
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="text" style="display: none;" name="_ids" id="_ids">
                  <input type="text" style="display: none;" name="update_id" id="update_id">        
                  <div class="form-group">
                    <label for="audit_mem" class="col-md-3 control-label">Tag Area</label>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-xs-10 col-sm-8">
                            <select name="tag_a_u" id="tag_a_u" style="width: 675px;" class="form-control">
                              <option value="1">Technical Operations</option>
                              <option value="2">Administrative Services</option>
                              <option value="3">Financial Management</option>
                            </select>
                          </div>
                        </div>
                    </div>
                  </div>  
                  <div class="form-group">
                    <label for="audit_mem" class="col-md-3 control-label">Audit Area</label>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-xs-10 col-sm-8">
                            <select name="scope_a_u" id="scope_a_u" style="width: 675px;" class="form-control">
                              @foreach(explode(',', $scopes) as $scope)
                              <option>{{ clean($scope) }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="audit_mem" class="col-md-3 control-label">Custom Audit Area</label>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-xs-10 col-sm-8">
                            <input type="text" style="display: inline-block; " class="form-control" id="c_audit_u" name="c_audit_u" value="" disabled="">      
                            <button type="button" class="btn btn-success btn-xs enable_ca_u" >Enable Custom Area</button>   
                            <button type="button" style="display: none" class="btn btn-danger btn-xs disable_ca_u" >Disable Custom Area</button>   
                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Once custom area is enabled, Audit Area will be disabled and its input will be disregard"></i>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="audit_mem" class="col-md-3 control-label">Sub-Audit Area</label>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-xs-10 col-sm-8">
                            <input type="text" style="display: inline-block; " class="form-control" id="s_audit_u" name="s_audit_u" value="">                           
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="audit_mem" class="col-md-3 control-label">Custom Sub-Audit Area</label>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-xs-10 col-sm-8">
                            <input type="text" style="display: inline-block; " class="form-control" id="c_subaudit_u" name="c_subaudit_u" value="">                   
                          </div>
                        </div>
                    </div>
                  </div>
                  <center><button type="button" class="btn btn-success updatefindingdetails" value="">Update</button></center>
                  

                  <hr>
                  <div class="row">
                    <table class="table-styles" id="findingrecommendationtable">
                      <tr style="border: 1px solid; background: #36404f; color:white">
                        <th style="border: 1px solid black; width: 2500px">
                            <label for="title" class="col-md-5 control-label" style="margin-left: 90px">FINDINGS</label>
                        </th>
                        <th style="border: 1px solid black;">
                            <label for="title" class="col-md-5 control-label" style="margin-left: 120px">RECOMMENDATION(S)</label>
                        </th>
                      </tr>
                      <tr style="border: 1px solid black">
                        <td valign="top" style="border: 1px solid black; width: 48%">
                          <div class="col-xs-12 col-md-12"> 
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                              <div id="findingscontainer" style="min-height: 200px; color: black"></div>
                              <center><div class="showupdatefinding" id="showupdatefindingmenu"> <a href="#"><i class="fa fa-pencil"></i> Update Finding</a>  </div></center> 
                              <div class="divupdatefinding" style="display: none">
                                <hr class="style-three">
                                <div style="display: inline-block;">
                                  <textarea name="findings_u" id="findings_u"></textarea>
                                  <button title="" class="btn btn-default close_updatefinding pull-right" style="margin-top: 15px;" type="button">
                                    <i class="fa fa-times fa-lg closeupdatefinding " ></i>
                                  </button>
                                  <button title="Add recommendation" class="btn btn-success updatefinding pull-right" style="margin-top: 15px" value="">
                                    Update
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>




                        <td valign="top" style="border: 1px solid black; width: 48%">
                          <div class="col-xs-12 col-md-12"> 
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                              <div id="afrecommendation_container" style="min-height: 200px;">
                                <ol class="tabs" style="list-style: none"></ol>
                                <div class="menu" style="display: none;">
                                  <hr id="hr_recommendation" > 
                                  <textarea name="findings_recommendation" id="findings_recommendation"></textarea>
                                </div>
                                <center><div class="absolute" id="showmenu"> <a href="#"><i class="fa fa-plus"></i> Add a recommendation</a>  </div></center>  
                                <div class="absolute_save pull-right" style="display: none; margin-top: 15px;">
                                  <button title="Add recommendation" class="btn btn-success save_auditrecommendation" style="" value="">
                                    Add
                                  </button>
                                  <button title="Add recommendation" class="btn btn-success updaterecommendation" style="" value="">
                                    Update
                                  </button>
                                  <button title="Add recommendation" class="btn btn-default close_addrecommendation" type="button">
                                    <i class="fa fa-times fa-lg close_addrecommendation " ></i>
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>

          <!-- ////////////////////////////////ADD ANOTHER FINDING FOR SAME AUDIT FIDNING NO////////////////////////////////////////// -->

                  </table> 

                  <table class="table-styles" id="subfindingrecommendationtable" style="display: "></table>

                  <table class="table-styles" id="addsubfindingrecommendationtable" style="display: none">
                    <tr id="traddfinding" style="display: ">
                      <td valign="top" style="border: 1px solid black; width: 48%">
                        <div class="col-xs-12 col-md-12"> 
                          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <div style="margin-top: 15px;">
                            <hr class="style-four">
                              <textarea name="anotherfinding" id="anotherfinding"></textarea>
                              <div class="pull-right">
                                <button title="" class="btn btn-success submit_addsubfinding" style="margin-top: 15px;" type="button">
                                  Add
                                </button>
                                <button title="Add recommendation" class="btn btn-default close_addfinding" style="margin-top: 15px;" type="button">
                                  <i class="fa fa-times fa-lg close_addfinding " ></i>
                                </button>
                              </div>
                            </div>
                          </div>        
                        </div>
                      </td>
                      <td valign="top" style="border: 1px solid black; width: 48%">
                        <div class="col-xs-12 col-md-12"> 
                          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <center><h4 style="margin-top: 30%">Note: You can add recommendation(s) after adding the finding</h4></center>
                          </div>
                        </div>
                      </td>
                    </tr>
                </table>
                <!-- <center><button title="" class="btn btn-success addanotherfinding" style="margin-top: 15px;" value="">Add Finding</button></center> -->

                  <!-- ////////////////////////////////////////////////////////////////////////// -->
                </div>  
<!-- 
                  <div class="row" id="comments">

                    <h3 class="accordion" style="background: #36404f; color:white">Comment Section (Click here to write a comment . . . )</h3>
                  <div class="panel">
                    <div class="row" id="comments">
                      <div class="col-xs-6 col-md-6"> 
                        <h4>Comments for audit finding: </h4>

 
                          <span contenteditable="" id="findings_comment" name="findings_comment" class="spancomment" style="display:block; width:665px;"></span> <br>
                          <input type="hidden" name="findings_comment1" id="findings_comment1">


                        <button style="margin-top: 20px;" type="button" id="add_fcomment" class="btn btn-success btn-sm pull-right add_fcomment " disabled="">
                          @if(Auth::user()->role == 5)
                            Add comment <br> for revision
                          @else
                            Add comment
                          @endif</button>
                        <br>
                        <div id="commentf_container" style="margin-top: 20px;">
                          <ul class="tabs"></ul>
                        </div>
                      </div>

                      <div class="col-xs-5 col-md-6">
                        <h4>Comments for audit recommendation: </h4>
                        <span contenteditable="" id="recommendation_comment" name="recommendation_comment" class="spancomment " style="display:block; width:665px;"></span> 
                        <input type="hidden" name="recommendation_comment1" id="recommendation_comment1">
                        <button style="margin-top: 20px;" type="button" id="add_rcomment" class="btn btn-success btn-sm pull-right add_rcomment" disabled="">
                          @if(Auth::user()->role == 5)
                            Add comment <br> for revision
                          @else
                            Add comment
                          @endif
                        </button>
                        <br>
                        <div id="comment_container" style="margin-top: 20px;">
                          <ul class="tabs"></ul>
                        </div>
                      </div>
                    </div>
                  </div>

                  </div> -->
                </form>
              </div>
            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <!-- <button id="submit" type="button" class="btn btn-primary submit_auditfinding">Add Audit Finding Item</button> -->
          <button style="display: none" id="update_af" type="button" class="btn btn-primary submit_updateauditfinding">Update Audit Finding Item</button>
          <button style="display: none" id="add_subf" type="button" class="btn btn-primary submit_addsubfinding">Submit Sub-Audit Finding Item</button>
        </div>
      </div>
    </div>
  </div>


<!-- ***************************************** VIEW AUDIT FINDING ITEM ***************************************** -->


<div class="modal fade" id="viewContentModal" role="dialog" aria-labelledby="viewContentModalLabel">
        <div class="modal-dialog modal-lg" style="width: 1450px" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <center><h3 class="modal-title" id="viewContentModalLabel"></h3></center> 

            </div>
            <div class="modal-body">
              <div class="panel-body">
                <form id="submitUpdateFormContent" class="form-horizontal" method="POST">
                      {{ csrf_field() }}        
                  <input type="text" style="display: none;" name="af_id" id="af_id">    

                  <table style="border: 1px solid; background: #36404f; color:white; width:1385px;">
                    <tr>
                      <th style="border: 1px solid black; width: 35%;">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                          <label  for="audit_mem" class="col-md-3 control-label">AUDIT AREA:</label>
                          <div style="margin-left: 7px; margin-top: 15px;" id="auditarea" class="col-md-12"></div>
                        </div>
                      </th>
                      <th style="border: 1px solid black; width: 35%">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                          <label for="audit_mem" class="col-md-4 control-label">SUB-AUDIT AREA:</label>
                          <div id="subauditarea" class="col-md-12" style="margin-top: 15px; margin-left: 15px;"></div>
                        </div>
                      </th>
                      <th style="border: 1px solid black; width: 30%">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                          <label for="audit_mem" class="col-md-6 control-label">CUSTOM SUB-AUDIT AREA:</label>
                          <div id="customarea" class="col-md-12" style="margin-top: 15px; margin-left: 20px;"></div>
                        </div>
                      </th>
                    </tr>
                  </table>   

                  <hr>

                  <table class="table-styles">
                    <tr style="border: 1px solid; background: #36404f; color:white">
                      <th style="border: 1px solid black; width: 4%;">
                          <label for="title" class="col-md-4 control-label" style="margin-left: 55px; margin-left: 50px">No.</label>
                      </th>
                      <th style="border: 1px solid black; width: 48%">
                          <label for="title" class="col-md-5 control-label" style="margin-left: 90px">FINDINGS</label>
                      </th>
                      <th style="border: 1px solid black; width: 48%">
                          <label for="title" class="col-md-5 control-label" style="margin-left: 120px">RECOMMENDATIONS</label>
                      </th>
                    </tr>
                    <tr style="border: 1px solid black">
                      <td valign="top" style="border: 1px solid black; width: 4%;">
                          <div style="text-align: center; color: black" id="af_no" class="col-md-12" ></div>
                      </td>
                      <td valign="top" style="border: 1px solid black; width: 48%">
                          <div id="af_findings" class="col-md-12" style=" color: black"></div>
                      </td>
                      <td valign="top" style="border: 1px solid black; width: 48%">
                          <div id="af_recommendations" class="col-md-12" style=" color: black"></div>
                      </td>
                    </tr>
                  </table> 
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- ***************************************** ARCHIVE AUDIT FINDING ITEM ***************************************** -->

<div class="modal fade" id="viewDocuments" role="dialog" aria-labelledby="viewDocumentsLabel">
  <div class="modal-dialog modal-lg" style="width: 1400px" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <center><h3 class="modal-title" id="viewDocumentsLabel">Supporting Documents</h3></center> <br>

         <center><div id="flashUploadMessage"  class="alert alert-dismissable " style="width: 350px; display: none; height: 50px;">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h5 id="upload_success" style="display: none"><strong>Success! </strong> File Uploaded . . . </h5> 
            <h5 id="upload_failed" style="display: none"><strong>Upload Failed! </strong> Please fill up all fields . . . </h5> 
        </div></center>

      </div>
      <div class="modal-body">
        <div class="panel-body">
      <form id="uploadFileForm" class="form-horizontal" method="POST">
        <div class="row">
          <div class="col-xs-6 col-md-5">
            <div class="form-group" style="display: none">
              <label for="audit_mem" class="col-md-3 control-label">Audit Finding NO.</label>
              <div class="col-md-9">
                <div class="row">
                  <div class="col-xs-10 col-sm-12">
                    <input type="text"  class="form-control" id="afnoc" name="afnoc" value=""><br>      
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group" style="display: none">
              <label for="audit_mem" class="col-md-3 control-label">Form 001 Number</label>
              <div class="col-md-9">
                <div class="row">
                  <div class="col-xs-10 col-sm-12">
                    <input type="text"  class="form-control" id="form001noc" name="form001noc" value=""><br>      
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="audit_mem" class="col-md-3 control-label">File Name</label>
              <div class="col-md-9">
                <div class="row">
                  <div class="col-xs-10 col-sm-12">
                    <input type="text"  class="form-control" id="file_name" name="file_name" value=""><br>      
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="audit_mem" class="col-md-3 control-label">File Description</label>
              <div class="col-md-9">
                <div class="row">
                  <div class="col-xs-10 col-sm-12">
                    <input type="text"  class="form-control" id="file_desc" name="file_desc" value=""><br>              
                  </div>
                </div>
              </div>
            </div>
          <div class="form-group">
            <label for="audit_mem" class="col-md-3 control-label">Upload File</label>
              <div class="col-md-9">
                <div class="row">
                  <div class="col-xs-10 col-sm-12">
                    <input type="file" class="form-control" name="c_file"><br>                   
                  </div>
                </div>
            </div>
          </div>
          <button type="button" class="btn btn-primary pull-right uploadfile" value="">Upload File</button>
          <div class="pull-right loading" style="text-align: center; display: none">
            <i class="fa fa-spinner  fa-spin fa-2x fa-fw text-info"></i><br>
            Uploading.... 
          </div>
          </div>
          <div class="col-xs-6 col-md-7">
            <table id="datatablefile" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>File</th>
                <th>Uploaded By</th>
                <th>Options</th>
              </tr>
            </thead>

            <tbody id="">
                <tr id="file_row" style="">
                  <td width="5%" id=""><center></center></td>
                  <td width="25%" id=""><center></center></td>
                  <td width="25%" id=""><center></center></td>
                  <td width="20%" id=""><center></center></td>
                  <td width="12%">       </td>
                </tr>
            </tbody>
          </table>
          </div>
        </div>
        </form>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div></div>
