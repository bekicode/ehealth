<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'E-Health')</title>

  <!-- Google Font: Source Sans Pro -->
  <link prerender rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  {{-- <link prerender rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}"> --}}
  <link prerender rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

  <!-- Theme style -->
  <link prerender rel="stylesheet" href="{{ asset('dist-adminlte/css/adminlte.min.css')}}">
  @yield('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
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
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('dist-adminlte/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">E-Health</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist-adminlte/img/avatar-icon.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @php
            $role = Auth::user()->role;
          @endphp
          @if ($role == 2)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
                <span class="right badge badge-danger">Tests</span>
              </p>
            </a>
          </li>
          <li class="nav-header">Pemeriksaan</li>
          <li class="nav-item @if (Request::is('kader/balita','kader/balita/*')) menu-open @endif">
            <a href="#" class="nav-link @if (Request::is('kader/balita','kader/balita/*')) active @endif">
              <i class="nav-icon fa-solid fa-hospital-user"></i>
              <p>
                Data Pemeriksaan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('kader.list_balita') }}" class="nav-link @if (Request::is('kader/balita','kader/balita/*')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Balita</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if ($role == 4)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
                <span class="right badge badge-danger">Tests</span>
              </p>
            </a>
          </li>
          <li class="nav-header">Admin Panel</li>
          <li class="nav-item">
            <a href="{{ route('admin.list_akun') }}" class="nav-link @if (Request::is('admin/akun','admin/akun/*')) active @endif ">
              <i class="nav-icon fa-solid fa-user-tie"></i>
              <p>
                Data Akun
              </p>
            </a>
          </li>
          <li class="nav-item @if (Request::is('admin/balita','admin/balita/*', 'admin/ibu-hamil','admin/ibu-hamil/*', 'admin/lansia','admin/lansia/*')) menu-open @endif">
            <a href="#" class="nav-link @if (Request::is('admin/balita','admin/balita/*', 'admin/ibu-hamil','admin/ibu-hamil/*', 'admin/lansia','admin/lansia/*')) active @endif">
              <i class="nav-icon fa-solid fa-hospital-user"></i>
              <p>
                Data anggota
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.list_balita') }}" class="nav-link @if (Request::is('admin/balita','admin/balita/*')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Balita</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.list_ibu_hamil') }}" class="nav-link @if (Request::is('admin/ibu-hamil','admin/ibu-hamil/*')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ibu Hamil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.list_lansia') }}" class="nav-link @if (Request::is('admin/lansia','admin/lansia/*')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lansia</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.list_posyandu') }}" class="nav-link @if (Request::is('admin/posyandu','admin/posyandu/*')) active @endif ">
              <i class="nav-icon fa-solid fa-hospital"></i>
              <p>
                Posyandu
              </p>
            </a>
          </li>
        @endif
          <li class="nav-item">
            <a class="nav-link text-warning" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
              <i class="nav-icon fa fa-arrow-right-from-bracket"></i>
              <p>{{ __('Logout') }}</p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2022 INSTITUT TEKNOLOGI TELKOM PURWORKERTO.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script async src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script async src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script async src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- AdminLTE App -->
<script async src="{{ asset('dist-adminlte/js/adminlte.min.js')}}"></script>
<script async src="{{ asset('js/app.js') }}" defer></script>
@yield('js')

</body>
</html>
