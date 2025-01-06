@extends('layouts.user_type.auth')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<form action="" method="get">
  @csrf
<div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <input type="number" id="datepicker" placeholder="Tahun: {{ date('Y') }}" value="{{ $tahun ?? date('Y') }}" name="tahun" class="date-own form-control">
      </div>
    </div>
    <div class="col-lg-6">
      <div class="form-group">
        <button class="btn btn-success">Filter</button>
      </div>
    </div>
  </div>
</form>

  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h3> @currency($income)</h3>
          <h5>Income</h5>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h3> {{$product_count}}</h3>
          <h5>Total Product</h5>
        </div>
      </div>
    </div>
  </div>


  <div class="row mt-4">
    <div class="col-lg-3">
      <div class="card mb-3">
        <div class="card-body">
          <h3> {{ count($order_incoming) }}</h3>
          <h5>Order Incoming</h5>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="card mb-3">
        <div class="card-body">
          <h3> {{ count($inProcess) }}</h3>
          <h5>Order In Process</h5>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="card mb-3">
        <div class="card-body">
          <h3> {{ count($orderSent) }}</h3>
          <h5>Order Sent</h5>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="card mb-3">
        <div class="card-body">
          <h3> {{ count($orderCompleted) }}</h3>
          <h5>Order Completed</h5>
        </div>
      </div>
    </div>
    
  </div>
  <div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div id="container"></div>
        </div>
      </div>
    </div>
  

@endsection
@push('dashboard')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



  <script>
 
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Statistik income',
        align: 'left'
    },
    subtitle: {
        text: 'Periode: {{ $tahun }}',
        align: 'left'
    },
    xAxis: {
        categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        crosshair: true,
        accessibility: {
            description: 'Months'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Saldo'
        }
    },
    tooltip: {
        valueSuffix: ' Rp.',
        pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y:,.0f}</b><br/>'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:,.0f} Rp.',
                style: {
                    color: '#333'
                }
            }
        }
    },
    series: [
        {
            name: 'Income',
            data: @json($charts_income),
            color: 'green' // Warna hijau
        },
       
    ]
});

$("#datepicker").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
});
  </script>
@endpush

