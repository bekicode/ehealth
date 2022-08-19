@extends('layouts.admin')

@section('title')
  Dashboard User
@endsection

@section('css')
    
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection

@section('content')
  <!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dashboard</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
    
      <div class="col-lg-6 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $dataJumlahBalita[0]->jumlah }}</h3>
            <p>Total Balita Pada Posyandu</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
        </div>
      </div>
    
      <div class="col-lg-6 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $dataJumlahLansia[0]->jumlah }}</h3>
            <p>Total Lansia Pada Posyandu</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
        </div>
      </div>
    
      {{-- <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>65</h3>
            <p>Unique Visitors</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
        </div>
      </div> --}}
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Grafik Balita dan Lansia</h3>
              <a href="{{ route('user.list_balita') }}">Lihat data</a>
            </div>
          </div>
          <div class="card-body">
      
            <div class="position-relative mb-4">
              @if (empty($emptyBalita) && empty($emptyLansia))
              <canvas id="pieChart" height="100"></canvas>
              @else
                <div class="justify-content-center d-flex ">
                  <img src="{{ asset('asset/undraw_to_the_mooni.svg') }}" alt="" srcset="" width="30%">
                </div>
                <h3 class="text-center ">Tidak ada data</h3>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

  const data = {
    labels: ['Balita', 'Lansia'],
    datasets: [
      {
        label: 'Dataset 1',
        data: [{{ $dataJumlahBalita[0]->jumlah }}, {{ $dataJumlahLansia[0]->jumlah }}],
        backgroundColor: ['rgb(40, 167, 69)', 'rgb(255, 193, 7)'],
      }
    ]
  };

  const config = {
    type: 'pie',
    data: data,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Grafik Balita dan Lansia'
        }
      }
    },
  };

  const pieChart = new Chart(
    document.getElementById('pieChart'),
    config
  );
</script>
@endsection
