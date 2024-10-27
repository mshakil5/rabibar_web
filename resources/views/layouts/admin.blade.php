<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Twitter meta-->
    <meta property="twitter:card" content="">
    <meta property="twitter:site" content="">
    <meta property="twitter:creator" content="">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--DataTables [ OPTIONAL ]-->
    {{-- <script src="{{ asset('plugins/datatables/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('plugins/datatables/media/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{ asset('plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>

    <!--DataTables Sample [ SAMPLE ]-->
    <script src="{{ asset('js/demo/tables-datatables.js')}}"></script> --}}
    
  <!-- for export -->
  <link href="{{URL::to('assets/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
  <link href="{{URL::to('assets/css/style.css')}}" rel="stylesheet">

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css')}}">
    @yield('css')
    <!-- Datetimepicker CSS-->
    <link rel="stylesheet" href="{{asset('assets/css/jquery.datetimepicker.min.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">Vali</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <li class="app-search">
          <input class="app-search__input" type="search" placeholder="Search">
          <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
        <!--Notification Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i></a>
          <ul class="app-notification dropdown-menu dropdown-menu-right">
            <li class="app-notification__title">You have 4 new notifications.</li>
            <div class="app-notification__content">
              <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                  <div>
                    <p class="app-notification__message">Lisa sent you a mail</p>
                    <p class="app-notification__meta">2 min ago</p>
                  </div></a></li>
              <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                  <div>
                    <p class="app-notification__message">Mail server not working</p>
                    <p class="app-notification__meta">5 min ago</p>
                  </div></a></li>
              <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                  <div>
                    <p class="app-notification__message">Transaction complete</p>
                    <p class="app-notification__meta">2 days ago</p>
                  </div></a></li>
              <div class="app-notification__content">
                <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                    <div>
                      <p class="app-notification__message">Lisa sent you a mail</p>
                      <p class="app-notification__meta">2 min ago</p>
                    </div></a></li>
                <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                    <div>
                      <p class="app-notification__message">Mail server not working</p>
                      <p class="app-notification__meta">5 min ago</p>
                    </div></a></li>
                <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                    <div>
                      <p class="app-notification__message">Transaction complete</p>
                      <p class="app-notification__meta">2 days ago</p>
                    </div></a></li>
              </div>
            </div>
            <li class="app-notification__footer"><a href="#">See all notifications.</a></li>
          </ul>
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            <li><a class="dropdown-item" href="{{url('admin/profile')}}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i>{{ __('Logout') }}</a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ asset('images') }}/{{Auth::User()->photo}}"  height="50px" width="50px" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">{{Auth::User()->name}}</p>
          <p class="app-sidebar__user-designation">Frontend Developer</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item" href="{{url('admin/dashboard')}}" id="dashboard"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

        {{-- <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">UI Elements</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="bootstrap-components.html"><i class="icon fa fa-circle-o"></i> Bootstrap Elements</a></li>
            <li><a class="treeview-item" href="https://fontawesome.com/v4.7.0/icons/" target="_blank" rel="noopener"><i class="icon fa fa-circle-o"></i> Font Icons</a></li>
            <li><a class="treeview-item" href="ui-cards.html"><i class="icon fa fa-circle-o"></i> Cards</a></li>
            <li><a class="treeview-item" href="widgets.html"><i class="icon fa fa-circle-o"></i> Widgets</a></li>
          </ul>
        </li> --}}


        @if(Auth::user()->is_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions)))
        <li><a class="app-menu__item" href="{{url('admin/register')}}" id="admin"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Admin</span></a></li>
        @endif

        @if(Auth::user()->is_type == 'admin' || in_array('3', json_decode(Auth::user()->staff->role->permissions)))
        <li><a class="app-menu__item" href="{{url('admin/role')}}" id="role"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Roles</span></a></li>
        @endif

        @if(Auth::user()->is_type == 'admin' || in_array('3', json_decode(Auth::user()->staff->role->permissions)))
        <li><a class="app-menu__item" href="{{url('admin/company-detail')}}" id="company-detail"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Company Details</span></a></li>
        @endif
        
        <li class="treeview" id="alluser"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">User</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">

            @if(Auth::user()->is_type == 'admin' || in_array('2', json_decode(Auth::user()->staff->role->permissions)))
            <li><a class="treeview-item" href="{{url('admin/staff')}}" id="staff"><i class="icon fa fa-circle-o"></i> Staff</a></li>
            <li><a class="treeview-item" href="{{url('admin/users')}}" id="users"><i class="icon fa fa-circle-o"></i> Users</a></li>
            <li><a class="treeview-item" href="{{url('admin/refferal-users')}}" id="refferalusers"><i class="icon fa fa-circle-o"></i>Referral Count</a></li>
            @endif

          </ul>
        </li>

        {{-- <li><a class="app-menu__item" href="charts.html"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Charts</span></a></li> --}}
        <li class="treeview" id="codemaster"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Code Master</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{url('admin/master')}}" id="master"><i class="icon fa fa-circle-o"></i> Master Code</a></li>
            <li><a class="treeview-item" href="{{url('admin/softcode')}}" id="softcode"><i class="icon fa fa-circle-o"></i> Soft Code</a></li>
          </ul>
        </li>

        <li class="treeview" id="allquiz"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Quiz</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{url('admin/quiz')}}" id="quiz"><i class="icon fa fa-circle-o"></i> Quiz</a></li>
            <li><a class="treeview-item" href="{{url('admin/quiztype')}}" id="quiztype"><i class="icon fa fa-circle-o"></i> Quiz Type</a></li>
            <li><a class="treeview-item" href="{{url('admin/question')}}" id="question"><i class="icon fa fa-circle-o"></i> Question</a></li>
            {{-- <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i> Soft Code</a></li> --}}
          </ul>
        </li>

        
        <li class="treeview" id="quizmaildesc"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Quiz Participation</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{route('quiz.participate')}}" id="participate"><i class="icon fa fa-circle-o"></i> Participate</a></li>
            <li><a class="treeview-item" href="{{route('quiz.notparticipate')}}" id="notparticipate"><i class="icon fa fa-circle-o"></i>  Not Participate</a></li>
          </ul>
        </li>

        

        <li><a class="app-menu__item" href="{{url('admin/advertisement')}}" id="advertisement"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Advertisement</span></a></li>
        <li><a class="app-menu__item" href="{{route('mail.index')}}" id="mail"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Mail</span></a></li>

        <li class="treeview" id="blog"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Blog</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{route('blog.category')}}" id="blogcat"><i class="icon fa fa-circle-o"></i> Category</a></li>
            <li><a class="treeview-item" href="{{url('admin/blog')}}" id="blogpost"><i class="icon fa fa-circle-o"></i>Blog</a></li>
          </ul>
        </li>

        <li class="treeview" id="vdoblog"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Video Blog</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{route('videoblog.category')}}" id="vdoblogcat"><i class="icon fa fa-circle-o"></i> Category</a></li>
            <li><a class="treeview-item" href="{{route('videoblog')}}" id="vdoblogpost"><i class="icon fa fa-circle-o"></i>Blog</a></li>
          </ul>
        </li>

        <li class="treeview" id="notification"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Notification</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{route('notification.comment')}}" id="comment"><i class="icon fa fa-circle-o"></i> Comment</a></li>
            <li><a class="treeview-item" href="{{route('notification.reply')}}" id="reply"><i class="icon fa fa-circle-o"></i> Reply</a></li>
            {{-- <li><a class="treeview-item" href="{{url('admin/blog')}}"><i class="icon fa fa-circle-o"></i>Blog</a></li> --}}
          </ul>
        </li>

        <li class="treeview" id="allsponsor"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Sponsor</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{url('admin/sponsor')}}" id="sponsor"><i class="icon fa fa-circle-o"></i> Manage Sponsor</a></li>
            <li><a class="treeview-item" href="{{route('sponsor.assign')}}" id="assign"><i class="icon fa fa-circle-o"></i> Sponsor Assign</a></li>
            <li><a class="treeview-item" href="{{route('sponsor.report')}}" id="report"><i class="icon fa fa-circle-o"></i> Sponsor Report</a></li>
          </ul>
        </li>

        <li><a class="app-menu__item" href="{{url('admin/winner')}}" id="winner"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Winner</span></a></li>


        <li class="treeview" id="allabout"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">About</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{url('admin/about')}}" id="about"><i class="icon fa fa-circle-o"></i> About</a></li>
            <li><a class="treeview-item" href="{{route('terms')}}" id="terms"><i class="icon fa fa-circle-o"></i> Terms and condition</a></li>
            <li><a class="treeview-item" href="{{route('privacy')}}" id="privacy"><i class="icon fa fa-circle-o"></i> Privacy</a></li>
            {{-- <li><a class="treeview-item" href="{{url('admin/about-title')}}" id="about-title"><i class="icon fa fa-circle-o"></i> About Title</a></li> --}}
          </ul>
        </li>

        <li><a class="app-menu__item" href="{{route('contact.show')}}" id="contactshow"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Contact Message</span></a></li>

        <li><a class="app-menu__item" href="{{url('admin/video')}}" id="video"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Videos</span></a></li>


        {{-- <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Pages</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="blank-page.html"><i class="icon fa fa-circle-o"></i> Blank Page</a></li>
            <li><a class="treeview-item" href="page-login.html"><i class="icon fa fa-circle-o"></i> Login Page</a></li>
            <li><a class="treeview-item" href="page-lockscreen.html"><i class="icon fa fa-circle-o"></i> Lockscreen Page</a></li>
            <li><a class="treeview-item" href="page-user.html"><i class="icon fa fa-circle-o"></i> User Page</a></li>
            <li><a class="treeview-item" href="page-invoice.html"><i class="icon fa fa-circle-o"></i> Invoice Page</a></li>
            <li><a class="treeview-item" href="page-calendar.html"><i class="icon fa fa-circle-o"></i> Calendar Page</a></li>
            <li><a class="treeview-item" href="page-mailbox.html"><i class="icon fa fa-circle-o"></i> Mailbox</a></li>
            <li><a class="treeview-item" href="page-error.html"><i class="icon fa fa-circle-o"></i> Error Page</a></li>
          </ul>
        </li>
        <li><a class="app-menu__item" href="docs.html"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">Docs</span></a></li> --}}
      </ul>
    </aside>
    @yield('content')
     <!-- Essential javascripts for application to work-->
     <script src="{{ asset('assets/frontend/js/jquery-3.3.1.min.js')}}"></script>
     <script src="{{ asset('assets/frontend/js/popper.min.js')}}"></script>
     <script src="{{ asset('assets/frontend/js/bootstrap.min.js')}}"></script>
     <script src="{{ asset('assets/frontend/js/main.js')}}"></script>
     <!-- The javascript plugin to display page loading on top-->
     <script src="{{ asset('assets/frontend/js/plugins/pace.min.js')}}"></script>
     <!-- Page specific javascripts-->
     <script type="text/javascript" src="{{ asset('assets/frontend/js/plugins/chart.js')}}"></script>
     {{-- <script src="{{ asset('js/jquery.js')}}"></script> --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>

     <script src="//cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
     <script>
        CKEDITOR.config.versionCheck = false;
        $('.ckeditor').each(function () {
            CKEDITOR.replace(this);
        });
    </script>
     
    <!-- for export all -->
    <script src="{{URL::to('assets/js/dataTables/datatables.min.js')}}"></script>
    <script src="{{URL::to('assets/js/dataTables/dataTables.bootstrap4.min.js')}}"></script>
     <script>
      // page schroll top
      function pagetop() {
          window.scrollTo({
              top: 130,
              behavior: 'smooth',
          });
      }


      function success(msg){
             $.notify({
                     // title: "Update Complete : ",
                     message: msg,
                     // icon: 'fa fa-check'
                 },{
                     type: "info"
                 });

         }
     function dlt(){
       swal({
         title: "Are you sure?",
         text: "You will not be able to recover this imaginary file!",
         type: "warning",
         showCancelButton: true,
         confirmButtonText: "Yes, delete it!",
         cancelButtonText: "No, cancel plx!",
         closeOnConfirm: false,
         closeOnCancel: false
     }, function(isConfirm) {
         if (isConfirm) {
             swal("Deleted!", "Your imaginary file has been deleted.", "success");
         } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");

         }
 });


     }

  </script>
 <script type="text/javascript" src="{{asset('assets/frontend/js/plugins/bootstrap-notify.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('assets/frontend/js/plugins/sweetalert.min.js')}}"></script>
     @yield('script')

 {{-- script for pdf, xml  start--}}

    <!-- export Scripts -->

    <?php
    if(isset($pdfhead["title"])){
        $title = $pdfhead["title"];
    }else {
        $title = "Generated Report";
    }
    ?>

    <script>
      $(document).ready(function(){
          
          var title = 'Report: '+{!! json_encode($title) !!};
          
          $('#example').DataTable({
              pageLength: 25,
              responsive: true,
              columnDefs: [ { type: 'date', 'targets': [0] } ],
              order: [[ 0, 'desc' ]],
              dom: '<"html5buttons"B>lTfgitp',
              buttons: [
                  {extend: 'copy'},
                  {extend: 'excel', title: title},
                  {extend: 'pdfHtml5',
                  title: 'Report',
                  orientation : 'landscape',
                      header:true,
                      customize: function ( doc ) {
                          doc.content.splice(0, 1, {
                                  text: [
      
                                  ],
                                  margin: [0, 0, 0, 12],
                                  alignment: 'center'
                              });
                          doc.defaultStyle.alignment = 'center'
                      } 
                  },
                  {extend: 'print',
                      customize: function (win){
                      $(win.document.body).addClass('white-bg');
                      $(win.document.body).css('font-size', '10px');
                      $(win.document.body).find('table')
                      .addClass('compact')
                      .css('font-size', 'inherit');
                  }
                  }
              ]
          });
      });
      
      
      
      </script>

  

 {{-- script for pdf, xml  end--}}


    </body>
    </html>
