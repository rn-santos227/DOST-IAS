<!-- ***************************************** FIRST FOLLOW-UP MONITOR MANAGEMENT ACTION MODAL ***************************************** -->
<div class="modal fade" id="viewMonitorFollowUpModal" role="dialog" aria-labelledby="viewMonitorFollowUpModalLabel">
        <div class="modal-dialog modal-lg" style="width: 1600px" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <center><h3 class="modal-title" id="viewMonitorFollowUpModalLabel"></h3></center> 

            </div>
            <div class="modal-body">
              <div class="panel-body">
                <form id="FormSubmitMonitoringFollowUp" class="form-horizontal" method="">
                      {{ csrf_field() }}        
                  <input type="text" style="display: none;" name="f001_id1" id="f001_id1">
                  <input type="text" style="display: none;" name="af_id1" id="af_id1">       

                  <div class="row">
                    <div class="col-xs-6 col-md-8">
                      <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label style="margin-left: 200px;" for="audit_mem" class="col-md-3 control-label">AUDIT AREA:</label>
                        <div style="text-align: center; margin-top: 15px;" id="auditarea_monitor" class="col-md-12">
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-5 col-md-4">
                      <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="audit_mem" class="col-md-4 control-label">SUB-AUDIT AREA:</label>
                        <div id="subauditarea_monitor" class="col-md-9" style="margin-top: 15px; margin-left: 10px;">

                        </div>
                      </div>
                    </div>
                  </div>

                  <hr>
                  <table border="1" style="height: 50px; margin-bottom: 10px;">
                    <tr>
                      <th style="width: 120px">No.</th>
                      <th style="width: 320px">Internal Audit Findings/Observations</th>
                      <th style="width: 305px">Internal Audit Recommendations</th>
                      <th style="width: 310px">Management Actions</th>
                      <th style="width: 313px">Monitoring of Corrective Action (CA) Follow-up Action & other Requirements</th>
                      <th style="width: 175px">STATUS</th>
                    </tr>
                  </table>
                   <div class="row">
                    <div class="col-xs-3 col-md-1">
                      <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <div style="text-align: center; margin-top: 15px;" id="af_no_monitoring" class="col-md-12">

                        </div>
                      </div>
                    </div>

                    <div style="width: 20%" class="col-xs-6 col-md-4">
                      <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <div id="af_findings_monitor" class="col-md-12" style="margin-top: 15px;  color: black; text-align:justify;">

                        </div>
                      </div>
                    </div>

                    <div style="width:20%" class="col-xs-5 col-md-4">
                      <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <div id="af_recommendations_monitor" class="col-md-12" style="margin-top: 15px; text-align: justify;  color: black; text-align:justify;">

                        </div>
                      </div>
                    </div>

                    <div style="width:20%" class="col-xs-5 col-md-4">
                      <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <div id="mgt_action_monitor" class="col-md-12" style="margin-top: 15px; text-align: justify;  color: black; text-align:justify;"></div>
                        <div id="mgt_action_monitor1" class="col-md-12" style="margin-top: 15px; text-align: justify;  color: black; text-align:justify;"></div>
                      </div>
                    </div>

                    <div style="width:20%" class="col-xs-5 col-md-4">
                      <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <div id="mca_monitor" class="col-md-12" style="margin-top: 15px;  text-align: justify;  color: black; text-align:justify;"></div>
                      </div>
                      <div id="monitoring_1st_followup_div">
                          <textarea name="monitor_1st_followup" id="monitor_1st_followup"></textarea><br>
                          <button class="btn btn-primary pull-right">Submit 2nd follow-up monitoring</button>
                      </div>
                    </div>

                    <div style="width:11%; text-align: center" class="col-xs-5 col-md-4">
                      <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        <b><div id="status_monitor" class="col-md-12" style="margin-top: 100px;  text-align: center;  color: black;"></div></b>
                      </div>
                    </div>

                  </div>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>