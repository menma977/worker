@extends('layouts.app')

@section('title')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>
        Home
      </h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
          <a href="#">
            Home
          </a>
        </li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card card-outline card-danger">
        <div class="card-header">
          <h3 class="card-title">Pengeluaran Dalam 1 Tahun</h3>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    $(function () {
      const areaChartData = {
        labels: [
          @foreach($date as $itme)
          '{{ $itme }}',
          @endforeach
        ],
        datasets: [
          {
            label: 'Total Gaji Perbulan',
            backgroundColor: 'rgb(220,53,69)',
            borderColor: 'rgb(220,53,69)',
            pointRadius: true,
            pointColor: '#dc3545',
            pointStrokeColor: 'rgb(220,53,69)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgb(220,53,69)',
            data: [
              @foreach($salary as $item)
              {{ $item }},
              @endforeach
            ]
          },
        ]
      };

      const barChartCanvas = $('#barChart').get(0).getContext('2d');
      const barChartData = jQuery.extend(true, {}, areaChartData)
      barChartData.datasets[0] = areaChartData.datasets[0]

      const barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
      }

      new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      })
    });
  </script>
@endsection