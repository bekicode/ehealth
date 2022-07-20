<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-Health</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist-adminlte/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
			<!-- Preloader -->
			<div class="preloader flex-column justify-content-center align-items-center">
				<img class="animation__shake" src="dist-adminlte/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
			</div>
			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<!-- Left navbar links -->
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" data-widget="pushmenu" href="#" role="button">
							<i class="fas fa-bars"></i>
						</a>
					</li>
					<li class="nav-item d-none d-sm-inline-block">
						<a href="../index.php" class="nav-link">Home</a>
					</li>
					<li class="nav-item d-none d-sm-inline-block">
						<a href="logout.php" class="nav-link">Logout</a>
					</li>
				</ul>
			</nav>
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<!-- Brand Logo -->
				<a href="../" class="brand-link">
					<img src="../images\/dinamis\/tut-wuri-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
					<span class="brand-text font-weight-light">E-Health </span>
				</a>
				<!-- Sidebar -->
				<div class="sidebar">
					<!-- Sidebar user panel (optional) -->
					<div class="user-panel mt-3 pb-3 mb-3 d-flex">
						<div class="image">
							<img src="{{ asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" style="width: 34px; height: 34px;" alt="User Image">
						</div>
						<div class="info">
							<a href="#" class="d-block">Nama user</a>
						</div>
					</div>
					<!-- Sidebar Menu -->
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
							<li class="nav-item">
								<a href="?url=dashboard" class="nav-link 
                                                                    ">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p> Dashboard</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="?url=settings" class="nav-link 
                                    active                                ">
									<i class="nav-icon fas fa-cog"></i>
									<p> Ubah Data</p>
								</a>
							</li>
														<li class="nav-item 
															">
								<a href="#" class="nav-link 
                                    								">
									<i class="nav-icon fas fa-user"></i>
									<p> Admin <i class="fas fa-angle-left right"></i></p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="?url=user" class="nav-link 
																					">
											<i class="far fa-angle-right nav-icon"></i>
											<p>Data Admin</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="?url=user&action=add" class="nav-link 
																					">
											<i class="far fa-angle-right nav-icon"></i>
											<p>Tambah Admin</p>
										</a>
									</li>
								</ul>
							</li>
														<li class="nav-item 
															">
								<a href="#" class="nav-link 
                                    								">
									<i class="nav-icon far fa-image"></i>
									<p> Galeri <i class="fas fa-angle-left right"></i></p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="?url=gallery" class="nav-link 
																					">
											<i class="far fa-angle-right nav-icon"></i>
											<p>Data Gambar</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="?url=gallery&action=add" class="nav-link 
																					">
											<i class="far fa-angle-right nav-icon"></i>
											<p>Tambah Gambar</p>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item 
															">
								<a href="#" class="nav-link 
                                    								">
									<i class="nav-icon fas fa-graduation-cap"></i>
									<p> Prestasi <i class="fas fa-angle-left right"></i></p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="?url=achievement" class="nav-link 
																					">
											<i class="far fa-angle-right nav-icon"></i>
											<p>Data Prestasi</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="?url=achievement&action=add" class="nav-link 
																					">
											<i class="far fa-angle-right nav-icon"></i>
											<p>Tambah Prestasi</p>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item 
															">
								<a href="#" class="nav-link 
                                    								">
									<i class="nav-icon fas fa-newspaper"></i>
									<p> Berita <i class="fas fa-angle-left right"></i></p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="?url=blog" class="nav-link 
																					">
											<i class="far fa-angle-right nav-icon"></i>
											<p>Data Berita</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="?url=blog&action=add" class="nav-link 
																					">
											<i class="far fa-angle-right nav-icon"></i>
											<p>Tambah Berita</p>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item d-block d-md-none">
								<a href="logout.php" class="nav-link">
									<i class="nav-icon fas fa-sign-out-alt"></i>
									<p> Logout</p>
								</a>
							</li>
						</ul>
					</nav>
					<!-- /.sidebar-menu -->
				</div>
				<!-- /.sidebar -->
			</aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>General Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist-adminlte/js/adminlte.min.js')}}"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
