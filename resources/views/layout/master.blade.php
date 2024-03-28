<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
    $user_type = session()->has('user_type');
    $user_id = session()->has('user_id');
    $sitesetting = \App\Models\Sitesettings::find(1);
    
  ?>
  <title>{{ $sitesetting->sitename }} | Enquiry</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/plugins/summernote/summernote-bs4.min.css">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet"/>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet"/>

  <link rel="icon" type="image/x-icon" href="{{URL::to('/')}}/public/dist/img/favicon.png">

  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <script>
    var baseUrl = "<?php echo URL::to('/'); ?>";
    var avg_fees = "<?php echo $sitesetting->default_fees; ?>";
  </script>
  <script src="{{URL::to('/')}}/public/plugins/jquery/jquery.min.js"></script>
 

  <!-- jQuery UI 1.11.4 -->
  <script src="{{URL::to('/')}}/public/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{URL::to('/')}}/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="{{URL::to('/')}}/public/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="{{URL::to('/')}}/public/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="{{URL::to('/')}}/public/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="{{URL::to('/')}}/public/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{URL::to('/')}}/public/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="{{URL::to('/')}}/public/plugins/moment/moment.min.js"></script>
  <script src="{{URL::to('/')}}/public/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{URL::to('/')}}/public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="{{URL::to('/')}}/public/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="{{URL::to('/')}}/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{URL::to('/')}}/public/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{URL::to('/')}}/public/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{URL::to('/')}}/public/dist/js/pages/dashboard.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
<style>
  .tooltip { 
      pointer-events: none;
  }
  .desc_tt_cont {
    padding: 30px;
  }
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{URL::to('/')}}/public/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
     

      <!-- Messages Dropdown Menu -->
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          <a href="javascript:;" onclick="logout();" class="dropdown-item">
            <i class="fas fa-power-off mr-2"></i> logout
          </a>
          <div class="dropdown-divider"></div>
          
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <?php 
      $home_url = '';
      if (session()->get('user_type') == '1') { 
        $home_url = URL::to('/').'/admin/upcoming_appointment';
      }
      else {
        $home_url = URL::to('/').'/admin';

      }
    ?>

    <a href="<?php echo $home_url; ?>" class="brand-link">
      <!-- <img src="{{URL::to('/')}}/public/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <h3 class="brand-text text-center font-weight-light">{{ $sitesetting->sitename }}</h3>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{URL::to('/')}}/public/dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:;" class="d-block">{{ session()->get('user_name') }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php if (session()->get('user_type') == '1') { ?>
          <li class="nav-item <?php if(Route::is('upcoming_appointment') || Route::is('completed_appointment')) { echo "menu-open"; } ?>">
            <a href="#" class="nav-link <?php if(Route::is('upcoming_appointment') || Route::is('completed_appointment')) { echo "active"; } ?>">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Appointment List
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ URL::to('/') }}/admin/upcoming_appointment" class="nav-link {{ Route::is('upcoming_appointment') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Upcoming</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ URL::to('/') }}/admin/completed_appointment" class="nav-link {{ Route::is('completed_appointment') ? 'active' : '' }}" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <?php if (session()->get('user_type') == '0') { ?>
          
          <li class="nav-item <?php if(Route::is('admin') || Route::is('confirmlist') || Route::is('approvelist')) { echo "menu-open"; } ?>">
            <a href="#" class="nav-link <?php if(Route::is('admin') || Route::is('confirmlist') || Route::is('approvelist')) { echo "active"; } ?>">
              <i class="nav-icon far fa-edit"></i>
              <p>
                Manage Enquiry
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ URL::to('/') }}/admin" class="nav-link {{ Route::is('admin') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ URL::to('/') }}/admin/confirmlist" class="nav-link {{ Route::is('confirmlist') ? 'active' : '' }}" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Confirm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ URL::to('/') }}/admin/approvelist" class="nav-link {{ Route::is('approvelist') ? 'active' : '' }}" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approved</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ URL::to('/') }}/admin/settings" class="nav-link {{ Route::is('settings') ? 'active' : '' }}" >
              <i class="nav-icon fas fa-cog"></i>
              <p>
                General settings
              </p>
            </a>
          </li>
          <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; {{ date('Y') }} <a href="javascript:;">{{ $sitesetting->sitename }}</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Developed by</b> Appkodes
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script>
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
  function logout() {
    $.ajax({
      url: baseUrl+'/logout',
      cache: false,
      type: 'POST',
      data: { logout_type: '' },
      success: function(res){
        window.location = baseUrl+'/adminlogin';
      }
    });
  }
  $(document).ready(function() {
      // show the alert
      setTimeout(function() {
          $(".alert").alert('close');
      }, 4000);
  });
</script>
</body>
</html>
