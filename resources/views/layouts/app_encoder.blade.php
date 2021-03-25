
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/dost.png') }}">


    <title>Internal Audit Service </title>

    <!-- Bootstrap -->

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- NProgress -->
    <link href="{{ asset('css/nprogress.css') }}" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="{{ asset('css/custom.min.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

    <!-- SELECT2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">

    <link href="{{ asset('css/easy-autocomplete.min.css') }}" rel="stylesheet">

    <!-- DATATABLES -->
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/buttons.bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/breadcrumb.css') }}" rel="stylesheet">

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

    

    <style type="text/css">
  th {
    text-align: center;
  }
  .btn-trans{
    border-color: #cdcece;
    background-color: transparent;
  }
  .name-style {
    background-color:#fff;
    border:1px solid red;    
    height:50px;
    border-radius:50%;
    -moz-border-radius:50%;
    -webkit-border-radius:50%;
    width:50px;
    text-align: center;
  }

  .table-styles {
    border: 1px solid black;
    border-collapse: collapse;
  }

 #comment_container ul{
    list-style-type: none;
  }
 #comment_container ul{height:350px; width:680px;}
 #comment_container ul{overflow:hidden; overflow-y:scroll;}

  #commentf_container ul{
    list-style-type: none;
  }
 #commentf_container ul{height:350px; width:680px;}
 #commentf_container ul{overflow:hidden; overflow-y:scroll;}
  /*#commentf_container ul::hover{overflow:hidden; overflow-y:scroll;}*/

  textarea {
  margin-top: 10px;
  margin-left: 30px;
  width: 530px;
  height: 70px;
  -moz-border-bottom-colors: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  background: #f7f4f4;
  border-color: -moz-use-text-color #FFFFFF #FFFFFF -moz-use-text-color;
  border-image: none;
  border-radius: 6px 6px 6px 6px;
  border-style: none solid solid none;
  border-width: medium 1px 1px medium;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.12) inset;
  color: #555555;
  font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
  font-size: 1em;
  line-height: 1.4em;
  padding: 5px 8px;
  transition: background-color 0.2s ease 0s;
}

.toast-custom {
  background-color: #006600;
}


textarea:focus {
    background: none repeat scroll 0 0 #FFFFFF;
    outline-width: 0;
}
/* width */
::-webkit-scrollbar {
    width: 10px;
    /*display: none*/

}

/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
    background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555; 
}

.toast {
    opacity: 1 !important;
}
.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}


.accordion:after {
    content: '\002B';
    color: #777;
    font-weight: bold;
    float: right;
    margin-left: 5px;
}

.panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
}


span.spancomment {
    border-radius: 6px;
    padding: 10px;
    box-shadow: 1px 1px 1px 1px #888888;
    width: 665px;
}
span.spancomment:empty::before {
    content: 'Write a comment...';
    display: inline-block;
}
span.spancomment:empty:focus::before {
    content: 'Start typing';
}

span.spanrecommendations {
    border-radius: 6px;
    padding: 10px;
    border: 1px solid;
    box-shadow: 1px  ;
    width: 665px;
}

span.spanrecommendation {
    border-radius: 6px;
    padding: 10px;
    box-shadow: 1px 1px 1px 1px #888888;
    width: 665px;
}
span.spanrecommendation:empty::before {
    content: 'Write a recommendation ...';
    display: inline-block;
}
span.spanrecommendation:empty:focus::before {
    content: 'Start typing';
}

/*div.absolute {
    position: absolute;
    width: 50%;
    bottom: 10px;
    border: 3px solid #8AC007;
} */

hr.style-one {
    overflow: visible; /* For IE */
    padding: 0;
    border: none;
    border-top: medium double #333;
    color: #333;
    text-align: center;
}
hr.style-one:after {
    content: "ADD RECOMMENDATION";
    display: inline-block;
    position: relative;
    top: -0.7em;
    font-size: 1.5em;
    padding: 0 0.25em;
    background: white;
}

hr.style-two {
    overflow: visible; /* For IE */
    padding: 0;
    border: none;
    border-top: medium double #333;
    color: #333;
    text-align: center;
}
hr.style-two:after {
    content: "UPDATE RECOMMENDATION";
    display: inline-block;
    position: relative;
    top: -0.7em;
    font-size: 1.5em;
    padding: 0 0.25em;
    background: white;
}

hr.style-three {
    overflow: visible; /* For IE */
    padding: 0;
    border: none;
    border-top: medium double #333;
    color: #333;
    text-align: center;
}
hr.style-three:after {
    content: "UPDATE FINDING";
    display: inline-block;
    position: relative;
    top: -0.7em;
    font-size: 1.5em;
    padding: 0 0.25em;
    background: white;
}

hr.style-four {
    overflow: visible; /* For IE */
    padding: 0;
    border: none;
    border-top: medium double #333;
    color: #333;
    text-align: center;
}
hr.style-four:after {
    content: "ADD SUB FINDING";
    display: inline-block;
    position: relative;
    top: -0.7em;
    font-size: 1.5em;
    padding: 0 0.25em;
    background: white;
}

.badge-notify{
   background:#00cccc;
   position:relative;
   top: -15px;
   left: -25px;
}

</style>



  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><img src="{{ asset('images/logo.png') }}" width="40"  alt="IAS" > <span><b>&nbsp;&nbsp;DOST - IAS</b></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset('images/user.png') }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ url('/home') }}"><i class="fa fa-home"></i>Home</a></li>
                  <li><a href="{{ url('/auditreporthome') }}"><i class="fa fa-folder-open-o"></i>Audit Reports</a></li>
                  <li><a href="{{ url('/monitoring-reports') }}"><i class="fa fa-pencil-square-o"></i>Monitoring Report of Findings</a></li>
                  <!-- <li><a href="{{ url('/ias') }}"><i class="fa fa-users"></i>IAS Staff</a></li>
                  <li><a href="{{ url('/auditor') }}"><i class="fa fa-search"></i>Auditors</a></li>
                  <li><a href="{{ url('/agency') }}"><i class="fa fa-building"></i>Agency Staff</a></li>
                  <li><a href="{{ url('/director') }}"><i class="fa fa-user-circle-o"></i>Director</a></li>
                </ul> -->
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a  data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                   <span class="glyphicon glyphicon-off" aria-hidden="true"></span></a> 
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('images/user.png') }}" alt="">{{ Auth::user()->name }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                           <i class="fa fa-sign-out pull-right"></i> Log Out</a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                    </li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="{{ asset('images/user.png') }}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="{{ asset('images/user.png') }}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="{{ asset('images/user.png') }}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="{{ asset('images/user.png') }}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3></h3>
              </div>

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Go!</button>
                          </span>
                  </div>
                </div>
              </div> -->
            </div>
            <div class="clearfix"></div>

            <div  role="main">
             @yield('content')
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=460aebqfd3gyi5yffvoorpz0vmf4bt4cx3trcrexpjuo7iai"></script>

    <script src="https://code.highcharts.com/highcharts.src.js"></script>

     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>

    <script src="{{ asset('js/js_/encode.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('js/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('js/nprogress.js') }}"></script>
    
    <script src="{{ asset('js/custom.min.js') }}"></script>

    <script src="{{ asset('js/js_/graphsreport.js') }}"></script>

    <script src="{{ asset('js/jquery.tagsinput.js') }}"></script>

    <script src="{{ asset('js/js_/jquery.timeago.js') }}" type="text/javascript"></script>

    <!-- SELECT2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js"></script>
    <!-- dataTables -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script> 
    <script src="{{ asset('js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/buttons.print.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

    <script type="text/javascript">
      toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "300",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
    </script>

    <script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight){
          panel.style.maxHeight = null;
        } else {
          panel.style.maxHeight = panel.scrollHeight + "px";
        } 
      });
    }
    </script>
 

  </body>
</html>
