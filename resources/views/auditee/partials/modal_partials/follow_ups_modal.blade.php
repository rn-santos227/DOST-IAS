<!-- ***************************************** FIRST FOLLOW-UP MONITORING MODAL ***************************************** -->
<div class="modal fade" id="viewFirstFollowUPModal" role="dialog" aria-labelledby="viewFirstFollowUPModalLabel">
        <div class="modal-dialog modal-lg" style="width: 1600px" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <center><h3 class="modal-title" id="viewFirstFollowUPModalLabel"></h3></center> 

            </div>
            <div class="modal-body">
              <div class="panel-body">
                <form id="FormSubmitMonitoringFollowUp" class="form-horizontal" method="">
                      {{ csrf_field() }}        
                  <input type="text" style="display: none;" name="f001_id1" id="f001_id1">
                  <input type="text" style="display: none;" name="af_id1" id="af_id1">       

                  <table style="border: 1px solid; background: #36404f; color:white; min-width: 1535px;">
                    <tr>
                      <th style="border: 1px solid black; width: 35%;">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                          <label  for="audit_mem" class="col-md-3 control-label">AUDIT AREA:</label>
                          <div style="margin-left: 7px; margin-top: 15px;" id="auditarea1" class="col-md-12"></div>
                        </div>
                      </th>
                      <th style="border: 1px solid black; width: 35%">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                          <label for="audit_mem" class="col-md-4 control-label">SUB-AUDIT AREA:</label>
                          <div id="subauditarea1" class="col-md-12" style="margin-top: 15px; margin-left: 15px;"></div>
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
                        <div style="text-align: center; margin-top: 15px;" id="af_no1" class="col-md-12"></div>
                      </td>
                      <td style="width: 320px; vertical-align: top">
                        <div id="af_findings1" class="col-md-12" style="margin-top: 15px;  color: black; text-align:justify;"></div>
                      </td>
                      <td style="width: 1100px; vertical-align: top">
                        <div id="af_recommendations1" class="col-md-12" style="margin-top: 15px; text-align: justify;  color: black; text-align:justify;"></div>
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