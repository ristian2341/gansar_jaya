<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PT Gansar Jaya</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css')}}">

  <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css')}}">

   <!-- DataTables -->
   <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
   <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
   <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- css untuk select2 -->
  <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
  <!-- cdn bootstrap4 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
      integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
@if(Session::get('s_username') != '')
  <body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a class="brand-link">
          <img src="{{ asset('admin/dist/img/fav-icon-front.png') }}" alt="Gansar Jaya" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light"><strong>PT Gansar Jaya</strong></span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image" style="width: 25%;" >
              <img src="{{ asset('admin/dist/img/avatar5.png') }}" style="width: 100%;height: 90%;"  class="img-circle" alt="User Image">
            </div>
            <div class="info">
              <a class="d-block" style="font-size: 10pt;">User Name : {{ @Session::get('s_username') }}</a>
              <a class="d-block" style="font-size: 10pt;">Jabatan : {{ @Session::get('s_jabatan') }}</a>
              @if(Session::get('s_superUser') == 1)
                <a class="d-block" style="font-size: 10pt;">Type User : Administrator </a>
              @else
                <a class="d-block" style="font-size: 10pt;">Type User : Pengguna </a>
              @endif
            </div>
          </div>

          <!-- SidebarSearch Form 
          <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div>-->

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              @if(Session::get('s_superUser') == 1)
                <li class="nav-header">Admnistrator</li>
                <li class="nav-item">
                    <a href="{{ route('users') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p>Pegawai</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-plus-square"></i>
                        <p>
                            Barang
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('kondisi') }}" class="nav-link">
                                <i class="nav-icon fa fa-random"></i>
                                <p>Kondisi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kategori') }}" class="nav-link">
                                <i class="nav-icon fa fa-random"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('barang') }}" class="nav-link">
                                <i class="nav-icon fas fa-cubes"></i>
                                <p>Barang</p>
                            </a>
                        </li>
                    </ul>
                </li>            
              @endif
                <li class="nav-header">Transaksi</li>
                <li class="nav-item">
                    <a href="{{ route('pinjam') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p>Peminjaman Barang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pengembalian') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p>Pengembalian Barang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('lap_barang') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p>Pelaporan Barang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="fas fa-power-off"></i>
                        <p>Log Out</p>
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
        <strong>Copyright &copy; 2022 .</strong>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
   
    <!-- wajib jquery  
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    js untuk bootstrap4  -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script> 

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script> -->
    <!-- js untuk select2  -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    
    <script src="https:////cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

     <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
      
  
    <script>
      $(document).ready(function () {
        //Initialize Select2 Elements
        $(".select2").select2({
            theme: 'bootstrap4',
            placeholder: "Please Select"
        });

        $('#datagrid').DataTable();
      });

     
    </script>
  </body>
@else
  <body class="hold-transition login-page" style="background-image:url('admin/dist/img/boxed-bg.jpg')">
      <div id="login">
          @include('auth.login');
      </div>
	  </body>
@endif
</html>
