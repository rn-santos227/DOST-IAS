@extends('layouts.app_encoder')

@section('content')

<style type="text/css">
  table, th, td {
    border: 5px solid #bab8b8;
}
</style>

<div class="row top_tiles">
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
      <div class="count">179</div>
      <h3>Active/On-Going Audits</h3>
      <p>Lorem ipsum psdea itgum rixt.</p>
    </div>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-comments-o"></i></div>
      <div class="count">179</div>
      <h3>For Director's Approval</h3>
      <p>Lorem ipsum psdea itgum rixt.</p>
    </div>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
      <div class="count">179</div>
      <h3>Due Audits</h3>
      <p>Lorem ipsum psdea itgum rixt.</p>
    </div>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-check-square-o"></i></div>
      <div class="count">179</div>
      <h3>Closed Audits</h3>
      <p>Lorem ipsum psdea itgum rixt.</p>
    </div>
  </div>
</div>


<div class="row">
<!-- Start Graph  -->
  <div class="col-md-8 col-sm-12 col-xs-12">
  <!-- CENTRAL OFFICE -->
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
              <h2><a href="#">Central Office</a> | <a href="#">Sectoral Planning Councils</a> | <a href="#">R&D Institutes</a> | <a href="#">S&T Service Institutes</a> | <a href="#">Advisory Bodies</a> | <a href="#">Regional Offices</a></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <div class="row">
              <div class="col-xs-6 col-md-4">
                <center> <h3>Summary of Audit Activities</h3></center>
                <canvas id="centralCHART" width="360px"></canvas>
                  <div>===============================================</div>
                <center> <h4>Central Office Audit Reports</h4></center>
                  <table style="width:100%">
                    <tr>
                      <th>CO Audits Directory<br><center><button class="btn">  <i class="fa fa-4x fa-list"></i></button></center></th>
                      <th>WIP (Work in Progress)<br><button class="btn">  <i class="fa fa-4x fa-edit"></i></button></th> 
                      <th>Audit Sched Calendar<br><button class="btn">  <i class="fa fa-4x fa-calendar"></i></button></th> 
                    </tr>
                  </table>
              </div>
              <div class="col-xs-6 col-md-8">
                <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
              </div>
            </div>
            <br />
          </div>
        </div>
      </div>
    </div>
  <!-- END CENTRAL OFFICE -->

  </div>
<!-- End Graphs -->

<!-- Start Recent Activities  -->
  <div class="col-md-4 col-sm-12 col-xs-12">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
                  <div class="x_title">
                    <h2>Pool of Auditors <small>Users</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Agency</th>
                          <th>Position</th>
                          <th>Contacts</th>
                        </tr>
                      </thead>

                      <tbody>
                        @foreach($auditors as $auditor)
                          <tr>
                            <td>{{$auditor->name}}</td>
                            <td>{{agency_codebyname($auditor->agency)}}</td>
                            <td>{{$auditor->position}}</td>
                            <td><h6><i class="fa fa-envelope"></i> {{$auditor->email}}<br> <i class="fa fa-phone"></i> {{auditor_contact_no($auditor->user_id)}}</h6></td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
      </div>
    </div>
  </div>
<!-- End Recent Activities -->

</div>




@endsection