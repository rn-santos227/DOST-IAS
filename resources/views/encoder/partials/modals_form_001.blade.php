<!-- ***************************************** ADD AUDIT FINDING REPORT ***************************************** -->
          <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" style="width: 1450px" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel" style="text-align: center;">ADD NEW FORM 001</h4>
                  <h6 class="modal-title" id="myModalLabel" style="text-align: center;">note: each field that has (<b style="color: red">*</b>) is required to be filled up</h6>

                  <center><div id="flashErrorMessage"  class="alert alert-dismissable alert-danger" style="width: 500px; display: none">
                      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                      <h6 id="error_message" style="display: none"><strong>Error! </strong> Please fill up all fields . . . </h6> 
                  </div></center>
                </div>
                <div class="modal-body">

                <div class="panel-body">
                  <form id="submitForm001" class="form-horizontal" method="POST">
                        {{ csrf_field() }}

                        <div class="row">
                          <div class="col-xs-6 col-md-6">

                          <!-- ___________ -->

                            <div class="form-group{{ $errors->has('agencies') ? ' has-error' : '' }}">
                              <label for="agencies" class="col-md-3 control-label">Agency/Office <b style="color: red">*</b></label>
                              <div class="col-md-9">
                                  <!-- <input id="agencies" type="text" class="form-control col-md-9 agencies" style="width:510px !important" name="agencies" placeholder="Enter Agency/Office (auto suggest)" value="{{ old('agencies') }}" required autofocus> -->

                                  <select name="agencies" id="agencies" style="width:510px !important;" class="form-control">
                                    <option>Select an agency</option>
                                    @foreach($agencies as $key => $agency)
                                    <option value="{{ $key }}">{{ $agency }}</option>
                                    @endforeach
                                  </select>

                                  @if ($errors->has('agencies'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('agencies') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </div>

                          <!-- ___________ -->

                            <div class="form-group{{ $errors->has('pap') ? ' has-error' : '' }}">
                              <label for="pap" class="col-md-3 control-label">Projects/Activity/Program</label>
                              <div class="col-md-9">
                                  <input id="pap" type="text" class="form-control col-md-9 pap" style="width:510px !important" name="pap" placeholder="Enter Projects/Activity/Program" value="{{ old('pap') }}" required autofocus>

                                  @if ($errors->has('pap'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('pap') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </div>

                          <!-- ___________ -->

                            <div class="form-group{{ $errors->has('isupervisor') ? ' has-error' : '' }}">
                              <label for="isupervisor" class="col-md-3 control-label">Immediate Supervisor <b style="color: red">*</b></label>
                              <div class="col-md-9">
                                  <input id="isupervisor" type="text" class="form-control col-md-9 isupervisor" style="width:510px !important" name="isupervisor" placeholder="Enter Immediate Supervisor" value="{{ old('isupervisor') }}" required autofocus>

                                  @if ($errors->has('isupervisor'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('isupervisor') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </div>

                          <!-- ___________ -->

                            <div class="form-group{{ $errors->has('tleader') ? ' has-error' : '' }}">
                              <label for="audit_mem" class="col-md-3 control-label">Audit Team Leader <b style="color: red">*</b></label>
                                <div class="col-md-9">
                                  <div class="row">
                                    <div class="col-xs-10 col-sm-6">
                                      <select name="tleader" id="tleader" style="width:510px !important;" class="form-control">
                                        @foreach($auditors as $key => $auditor)
                                        <option value="{{ $key }}">{{ $auditor }}</option>
                                        @endforeach
                                      </select>
                                      </div>
                                  </div>
                              </div>
                            </div>

                          <!-- ___________ -->

                            <div class="form-group">
                              <label for="audit_mem" class="col-md-3 control-label">Audit Member <b style="color: red">*</b></label>
                                <div class="col-md-9">
                                  <div class="row">
                                    <div class="col-xs-10 col-sm-6">
                                      <input type="text" style="display: none" id="audit_m" name="audit_m" value="">
                                      <select name="audit_mem" id="audit_mem" style="width:510px !important;" class="form-control" multiple="multiple">
                                        @foreach($auditors as $key => $auditor)
                                        <option value="{{ $key }}">{{ $auditor }}</option>
                                        @endforeach
                                      </select>
                                      </div>
                                  </div>
                              </div>
                            </div>

                          <!-- ___________ -->

                            <div class="form-group{{ $errors->has('overseer') ? ' has-error' : '' }}">
                              <label for="overseer" class="col-md-3 control-label">Overseer <b style="color: red">*</b></label>
                              <div class="col-md-9">
                                  <input id="overseer" type="text" class="form-control col-md-9 overseer" style="width:510px !important" name="overseer" placeholder="Enter Overseer" value="{{ old('overseer') }}" required autofocus>

                                  @if ($errors->has('overseer'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('overseer') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </div>

                          <!-- ___________ -->

                            <div class="form-group">
                              <label for="secretariat" class="col-md-3 control-label">Secretariat <b style="color: red">*</b></label>
                                <div class="col-md-9">
                                  <div class="row">
                                    <div class="col-xs-10 col-sm-6">
                                      <input type="text" style="display: none" id="sec" name="sec" value="">
                                      <select name="secretariat" id="secretariat" style="width:510px !important;" class="form-control" multiple="multiple">
                                        @foreach($secretariats as $key => $secretariat)
                                        <option value="{{ $key }}">{{ $secretariat }}</option>
                                        @endforeach
                                      </select>
                                      </div>
                                  </div>
                              </div>
                            </div>

                          </div>
                          
                          <div class="col-xs-5 col-md-6">
                          <!-- ___________ -->

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                              <label for="dateaudit" class="col-md-3 control-label">Date of Audit <b style="color: red">*</b></label>
                              <div class="col-md-9">
                                  <div class="row">
                                    <div class="col-xs-10 col-sm-6">
                                      <input id="datefrom" type="date" class="form-control datefrom" name="datefrom" value="{{ old('datefrom') }}" required autofocus>
                                    </div>
                                    <div class="col-xs-4 col-sm-6">
                                      <input id="dateto" type="date" class="form-control dateto" name="dateto" value="{{ old('dateto') }}" required autofocus>
                                    </div>
                                  </div>
                              </div>
                            </div>

                          <!-- ___________ -->
                          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="scopeaudit" class="col-md-3 control-label">Areas Audited <b style="color: red">*</b></label>
                                <div class="col-md-9">
                                  <div class="row">
                                    <div class="col-xs-10 col-sm-6">
                                      <input type="text" style="display: none" id="sa" name="sa" value="">
                                      <select name="scopeaudit" id="scopeaudit" style="width:495px !important;" class="form-control" multiple="multiple">
                                      </select>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <!-- ___________ -->

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-3 control-label">Auditees <b style="color: red">*</b></label>
                              <div class="col-md-9"> 
                                  <textarea class="form-control auditees" name="auditees" rows="5" id="auditees" placeholder="Enter Auditees" style="height: 220px; width: 490px;"></textarea>

                                  @if ($errors->has('title'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('title') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </div>
                          </div>
                        </div>


                        <!-- BACKGROUND AND METHODOLOGY -->

                        <div class="form-group">
                            <label for="title" class="col-md-1 control-label" style="margin-left: 53px">Background</label>

                            <div class="col-md-10">
                                <textarea name="background" id="background"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-1 control-label" style="margin-left: 53px">Good Point/<br>Methodology</label>

                            <div class="col-md-10">
                                <textarea name="goodpoint" id="goodpoint"></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button id="submit" type="button" class="btn btn-primary submit_report">Save Form 001</button>
                </div>
              </div>
            </div>
          </div>


          <!-- ***************************************** VIEW AND UPDATE AUDIT FINDING REPORT ***************************************** -->
          <div class="modal fade" id="myViewUpdateModal" role="dialog" aria-labelledby="myViewUpdateModalLabel">
            <div class="modal-dialog modal-lg" style="width: 1450px" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 style="text-align: center;" class="modal-title" id="myViewUpdateModalLabel">FORM 001: UPDATE AUDIT REPORT</h4>
                  <h6 class="modal-title" id="myModalLabel" style="text-align: center;">note: each field that has (<b style="color: red">*</b>) is required to be filled up</h6>
                </div>
                <div class="modal-body">

                <div class="panel-body">
                  <form id="updateAuditReportForm" class="form-horizontal" method="POST">
                        {{ csrf_field() }}

                        <div class="row">
                          <div class="col-xs-6 col-md-6">

                          <!-- ___________ -->

                            <div class="form-group{{ $errors->has('agencies') ? ' has-error' : '' }}">
                              <label for="agencies" class="col-md-3 control-label">Agency/Office <b style="color: red">*</b></label>
                              <div class="col-md-9">
                                  <select name="vu_agencies" id="vu_agencies" style="width:510px !important;" class="form-control">
                                    <option>Select an agency</option>
                                    @foreach($agencies as $key => $agency)
                                    <option value="{{ $key }}">{{ $agency }}</option>
                                    @endforeach
                                  </select>
                              </div>
                            </div>

                          <!-- ___________ -->

                            <div class="form-group{{ $errors->has('pap') ? ' has-error' : '' }}">
                              <label for="pap" class="col-md-3 control-label">Projects/Activity/Program</label>
                              <div class="col-md-9">
                                  <input id="vu_pap" type="text" class="form-control col-md-9 vu_pap" style="width:510px !important" name="vu_pap" placeholder="Enter Projects/Activity/Program" value="{{ old('pap') }}" required autofocus>

                                  @if ($errors->has('pap'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('pap') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </div>

                          <!-- ___________ -->

                            <div class="form-group{{ $errors->has('isupervisor') ? ' has-error' : '' }}">
                              <label for="isupervisor" class="col-md-3 control-label">Immediate Supervisor <b style="color: red">*</b></label>
                              <div class="col-md-9">
                                  <input id="vu_isupervisor" type="text" class="form-control col-md-9 vu_isupervisor" style="width:510px !important" name="vu_isupervisor" placeholder="Enter Immediate Supervisor" value="{{ old('isupervisor') }}" required autofocus>

                                  @if ($errors->has('isupervisor'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('isupervisor') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </div>

                          <!-- ___________ -->

                            <div class="form-group{{ $errors->has('tleader') ? ' has-error' : '' }}">
                              <label for="audit_mem" class="col-md-3 control-label">Audit Team Leader <b style="color: red">*</b></label>
                                <div class="col-md-9">
                                  <div class="row">
                                    <div class="col-xs-10 col-sm-6">
                                      <select name="vu_tleader" id="vu_tleader" style="width:510px !important;" class="form-control">
                                        @foreach($auditors as $key => $auditor)
                                        <option value="{{ $key }}">{{ $auditor }}</option>
                                        @endforeach
                                      </select>
                                      </div>
                                  </div>
                              </div>
                            </div>

                          <!-- ___________ -->

                            <div class="form-group">
                              <label for="audit_mem" class="col-md-3 control-label">Audit Member <b style="color: red">*</b></label>
                                <div class="col-md-9">
                                  <div class="row">
                                    <div class="col-xs-10 col-sm-6">
                                      <input type="text" style="display: none" id="vu_audit_m" name="vu_audit_m" value="">
                                      <select name="vu_audit_mem" id="vu_audit_mem" style="width:510px !important;" class="form-control" multiple="multiple">
                                        @foreach($auditors as $key => $auditor)
                                        <option value="{{ $key }}">{{ $auditor }}</option>
                                        @endforeach
                                      </select>
                                      </div>
                                  </div>
                              </div>
                            </div>

                          <!-- ___________ -->

                            <div class="form-group{{ $errors->has('overseer') ? ' has-error' : '' }}">
                              <label for="overseer" class="col-md-3 control-label">Overseer <b style="color: red">*</b></label>
                              <div class="col-md-9">
                                  <input id="vu_overseer" type="text" class="form-control col-md-9 vu_overseer" style="width:510px !important" name="vu_overseer" placeholder="Enter Overseer" value="{{ old('overseer') }}" required autofocus>

                                  @if ($errors->has('overseer'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('overseer') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </div>

                          <!-- ___________ -->

                            <div class="form-group">
                              <label for="secretariat" class="col-md-3 control-label">Secretariat <b style="color: red">*</b></label>
                                <div class="col-md-9">
                                  <div class="row">
                                    <div class="col-xs-10 col-sm-6">
                                      <input type="text" style="display: none" id="vu_sec" name="vu_sec" value="">
                                      <select name="vu_secretariat" id="vu_secretariat" style="width:510px !important;" class="form-control" multiple="multiple">
                                        @foreach($secretariats as $key => $secretariat)
                                        <option value="{{ $key }}">{{ $secretariat }}</option>
                                        @endforeach
                                      </select>
                                      </div>
                                  </div>
                              </div>
                            </div>

                          </div>
                          
                          <div class="col-xs-5 col-md-6">
                          <!-- ___________ -->

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                              <label for="dateaudit" class="col-md-3 control-label">Date of Audit <b style="color: red">*</b></label>
                              <div class="col-md-9">
                                  <div class="row">
                                    <div class="col-xs-10 col-sm-6">
                                      <input id="vu_datefrom" type="date" class="form-control vu_datefrom" name="vu_datefrom" value="{{ old('datefrom') }}" required autofocus>
                                    </div>
                                    <div class="col-xs-4 col-sm-6">
                                      <input id="vu_dateto" type="date" class="form-control vu_dateto" name="vu_dateto" value="{{ old('dateto') }}" required autofocus>
                                    </div>
                                  </div>
                              </div>
                            </div>

                          <!-- ___________ -->
                          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="scopeaudit" class="col-md-3 control-label">Areas Audited <b style="color: red">*</b></label>
                                <div class="col-md-9">
                                  <div class="row">
                                    <div class="col-xs-10 col-sm-6">
                                      <input type="text" style="display: none" id="vu_sa" name="vu_sa" value="">
                                      <select name="vu_scopeaudit" id="vu_scopeaudit" style="width:495px !important;" class="form-control" multiple="multiple">
                                        @foreach(explode(',', $scopesf) as $scope)
                                          <option>{{ clean($scope) }}</option>
                                        @endforeach
                                      </select>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <!-- ___________ -->

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-3 control-label">Auditees <b style="color: red">*</b></label>
                              <div class="col-md-9"> 
                                  <textarea class="form-control vu_auditees" name="vu_auditees" rows="5" id="vu_auditees" placeholder="Enter Auditees" style="height: 220px"></textarea>

                                  @if ($errors->has('title'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('title') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </div>
                          </div>
                        </div>


                        <!-- BACKGROUND AND METHODOLOGY -->

                        <div class="form-group">
                            <label for="title" class="col-md-1 control-label" style="margin-left: 53px">Background</label>

                            <div class="col-md-10">
                                <textarea name="vu_background" id="vu_background"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-1 control-label" style="margin-left: 53px">Good Point</label>

                            <div class="col-md-10">
                                <textarea name="vu_goodpoint" id="vu_goodpoint"></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button value="" id="update_auditreport" type="button" class="btn btn-primary update_auditreport">Update Audit Report</button>
                </div>
              </div>
            </div>
          </div>