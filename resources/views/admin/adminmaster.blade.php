<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Blank Page</title>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div id="app">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

            </li>
          </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
          <!-- Brand Logo -->
          <a href="../../index3.html" class="brand-link">
            <img src="{{ URL::to('/') }}/assets/logo/logo.jpg" alt="logo.jpg" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
          </a>

          <!-- Sidebar -->
          <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item  ">
                  <router-link to="/home" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/category-list" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Category
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/post-list" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Post
                      <span class="right badge badge-danger">New</span>
                    </p>
                  </router-link>
                </li>

              </ul>
            </nav>
            <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">

          <admin-home></admin-home>

        </div>
        <footer class="main-footer">
          <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.1.0-rc
          </div>
          <strong>Copyright &copy; {{ Auth::user() -> created_at->diffForHumans() }} <a href="https://adminlte.io">Three Sixty Degree</a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
      </div>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>

