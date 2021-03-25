<!-- ***************************************** ADD AND UPDATE AUDIT FINDING ITEM ***************************************** -->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" style="width: 1450px" role="document">
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
                <form id="submitFormContent" class="form-horizontal" method="POST">
                      {{ csrf_field() }}        
                  <input type="text" style="display: none;" name="_id" id="_id">
                  <input type="text" style="display: none;" name="update_id" id="update_id">          
                 <div class="form-group">
                    <label for="audit_mem" class="col-md-3 control-label">Audit Area</label>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-xs-10 col-sm-6">
                            <select name="scope_a" id="scope_a" style="width:800px !important;" class="form-control">
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
                          <div class="col-xs-10 col-sm-6">
                            <input type="text" style="display: inline-block; width:800px !important;" class="form-control" id="c_audit" name="c_audit" value="">                   
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="audit_mem" class="col-md-3 control-label">Sub-Audit Area</label>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-xs-10 col-sm-6">
                            <input type="text" style="display: inline-block; width:800px !important;" class="form-control" id="s_audit" name="s_audit" value="">                           
                          </div>
                        </div>
                    </div>
                  </div>

                  <hr>

                  <div class="row">
                    <div class="col-xs-6 col-md-6"> 
                      <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-5 control-label" style="margin-left: 53px">FINDINGS</label>
                        <div class="col-md-12" style="margin-top: 15px;">
                            <textarea name="findings" id="findings">
                              
                            </textarea>
                        </div>
                      </div>
                    </div>

                    <div class="col-xs-5 col-md-6">
                      <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-5 control-label" style="margin-left: 53px">RECOMMENDATIONS</label>
                        <div class="col-md-12" style="margin-top: 15px;">
                          <textarea name="recommendations" id="recommendations"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row" id="comments">
                    <div class="col-xs-6 col-md-6"> 
                      <hr>
                      <h4>Comments for audit finding: </h4>
                      <textarea id="findings_comment" name="findings_comment" placeholder="Write a comment . . . "></textarea>
                      <button style="margin-top: 20px;" type="button" id="add_fcomment" class="btn btn-success btn-sm pull-right add_fcomment " disabled="">
                        @if(Auth::user()->role == 5)
                          Add comment <br> for revision
                        @else
                          Add comment
                        @endif</button>
                      <br>
                      <div id="commentf_container" style="margin-top: 20px;">
                        <ul class="tabs">
                          
                        </ul>
                      </div>
                    </div>

                    <div class="col-xs-5 col-md-6">
                      <hr>
                      <h4>Comments for audit recommendation: </h4>
                      <textarea id="recommendation_comment" name="recommendation_comment" placeholder="Write a comment . . . "></textarea>
                      
                      
                      <button style="margin-top: 20px;" type="button" id="add_rcomment" class="btn btn-success btn-sm pull-right add_rcomment" disabled="">
                        @if(Auth::user()->role == 5)
                          Add comment <br> for revision
                        @else
                          Add comment
                        @endif
                      </button>
                      <br>
                      <div id="comment_container" style="margin-top: 20px;">
                        <ul class="tabs">
                          
                        </ul>
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
        </div>
      </div>
    </div>
  </div>


<!-- ***************************************** VIEW AUDIT FINDING ITEM ***************************************** -->


<div class="modal fade" id="viewContentModal" role="dialog" aria-labelledby="viewContentModalLabel">
        <div class="modal-dialog modal-lg" style="width: 1600px" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <center><h3 class="modal-title" id="viewContentModalLabel"></h3></center> 

            </div>
            <div class="modal-body">
              <div class="panel-body">
                <form id="FormSubmitMonitoring" class="form-horizontal" method="">
                      {{ csrf_field() }}        
                  <input type="text" style="display: none;" name="f001_id" id="f001_id">
                  <input type="text" style="display: none;" name="af_id" id="af_id">       

                  <table style="border: 1px solid; background: #36404f; color:white; min-width: 1535px;">
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
                          <label for="audit_mem" class="col-md-5 control-label">CUSTOM AUDIT AREA:</label>
                          <div id="customarea" class="col-md-12" style="margin-top: 15px; margin-left: 20px;"></div>
                        </div>
                      </th>
                    </tr>
                  </table>   

                  <hr>
                  <table border="1" style="height: 50px; margin-bottom: 10px;">
                    <tr style="border: 1px solid; background: #36404f; color:white">
                      <th style="width: 120px">No.</th>
                      <th style="width: 320px">Internal Audit Findings/Observations</th>
                      <th style="width: 305px">Internal Audit Recommendations</th>
                      <th style="width: 310px">Management Actions</th>
                      <th style="width: 313px">Monitoring of Corrective Action (CA) Follow-up Action & other Requirements</th>
                      <th style="width: 175px">STATUS</th>
                    </tr>
                  </table>

                  <table border="1" style="height: 50px; margin-bottom: 10px;">
                    <tr>
                      <td style="width: 120px; vertical-align: top">
                        <div style="text-align: center; margin-top: 15px;" id="af_no" class="col-md-12">  
                      </td>
                      <td style="width: 320px; vertical-align: top">
                        <div id="af_findings" class="col-md-12" style="margin-top: 15px;  color: black; text-align:justify;"></div>
                      </td>
                      <td style="width: 1100px; vertical-align: top">
                        <input type="text" name="ffus" id="ffus" style="display: none">
                        <input type="text" name="fstatuss" id="fstatuss" style="display: none;">
                        <div id="af_recommendations" class="col-md-12" style="margin-top: 15px; text-align: justify;  color: black; text-align:justify;"></div>
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
                <th style="width: 200px;">File</th>
                <th>Uploaded By</th>
                <!-- <th>Options</th> -->
              </tr>
            </thead>

            <tbody id="">
                <tr id="file_row" style="">
                  <td id=""><center></center></td>
                  <td id=""><center></center></td>
                  <td id=""><center></center></td>
                  <td id=""><center></center></td>
                  <!-- <td width="12%">       </td> -->
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
