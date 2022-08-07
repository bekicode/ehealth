@extends('layouts.admin')

@section('title')
    Posyandu
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
@endsection

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Daftar Posyandu</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item active">Daftar Posyamdu</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
    {{-- <div class="card card-default color-palette-box"> --}}
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar posyandu yang ada di desa Grujugan</h3>
        </div>
      
        <div class="card-body">
          <a href="{{ route('admin.tambah_posyandu') }}" class="btn btn-primary mb-3"><i class="fa-solid fa-pen-to-square"></i> Tambah data</a>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Jenis Posyandu</th>
                <th>Alamat</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @if (!empty($empty))
                @foreach ($data as $d)
                  <td>{{ $d->nama }}</td>
                  <td >{{ $d->jenis_posyandu }}</td>
                  <td>{{ $d->alamat }}</td>
                  <td class="text-center"> 
                    <a href="#" class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i> </a> 
                    <a href="#" class="mt-2 btn btn-danger"> <i class="fa-solid fa-trash-can"></i> </a> 
                  </td>
                @endforeach
              @else
                <td colspan="5" class="text-center">Tidak ada data</td>
              @endif
            </tbody>
            {{-- <tfoot>
              <tr>
                <th>Rendering engine</th>
                <th>Browser</th>
                <th>Platform(s)</th>
              </tr>
            </tfoot> --}}
          </table>
        </div>
      </div>
  </div>
</section>
@endsection

@section('js')
  <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>

  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('plugins/jszip/jszip.min.js')}}"></script>
  <script src="{{ asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
  <script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
  <script src="{{ asset('plugins/toastr/toastr.min.js')}}"></script>

  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        // "buttons": ["excel", "pdf", "print"]
        "buttons": [
          {
            extend: "excel",
            exportOptions: {
                columns: [0, 1, 2]
            }}, 
          {
            extend: "pdf",
            exportOptions: {
                columns: [0, 1, 2]
            }
          }, 
          {extend: "print"}
        ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });

    @if (session('sukses'))
      $('.toastrDefaultSuccess').ready(function() {
        toastr.success('{{ session("sukses") }}')
      });
    @endif
  </script>
@endsection