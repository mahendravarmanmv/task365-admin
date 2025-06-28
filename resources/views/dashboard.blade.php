@extends('layouts.app')

@section('content')
<div class="app-title">
  <div>
    <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
    <p>Admin dashboard for managing leads, vendors, payments, and user enquiries</p>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Dashboard</li>
  </ul>
</div>

<div class="row">
  <!-- Users -->
  <div class="col-md-6 col-lg-3">
    <a href="{{ route('vendors.index') }}" class="text-decoration-none">
    <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
      <div class="info">
        <h4>Vendors</h4>
        <p><b>{{ $usersCount }}</b></p>
      </div>
    </div>
    </a>
  </div>

  <!-- Leads -->
  <div class="col-md-6 col-lg-3">
    <a href="{{ route('leads.index') }}" class="text-decoration-none">
    <div class="widget-small info coloured-icon"><i class="icon fa fa-paper-plane fa-3x"></i>
      <div class="info">
        <h4>Leads</h4>
        <p><b>{{ $leadsCount }}</b></p>
      </div>
    </div>
    </a>
  </div>

  <!-- Payments -->
  <div class="col-md-6 col-lg-3">
    <a href="{{ route('payments.index') }}" class="text-decoration-none">
    <div class="widget-small warning coloured-icon"><i class="icon fa fa-money fa-3x"></i>
      <div class="info">
        <h4>Payments</h4>
        <p><b>{{ $paymentsCount }}</b></p>
      </div>
    </div>
    </a>
  </div>

  <!-- Categories -->
  <div class="col-md-6 col-lg-3">
    <a href="{{ route('categories.index') }}" class="text-decoration-none">
    <div class="widget-small danger coloured-icon"><i class="icon fa fa-tags fa-3x"></i>
      <div class="info">
        <h4>Categories</h4>
        <p><b>{{ $categoriesCount }}</b></p>
      </div>
    </div>
    </a>
  </div>
</div>

<div class="row">
  <!-- Monthly Sales -->
  <div class="col-md-6">
    <div class="tile">
      <h3 class="tile-title">Monthly Sales</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
      </div>
    </div>
  </div>

  <!-- User Enquiries -->
  <div class="col-md-6">
    <div class="tile">
      <h3 class="tile-title">User Enquiries</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
      </div>
    </div>
  </div>
</div>
@endsection

@section('page-specific-javascripts')
<script type="text/javascript" src="{{ asset('assets/js/plugins/chart.js') }}"></script>
<script type="text/javascript">
  // Monthly Sales Chart
  var data = {
    labels: [
      "January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"
    ],
    datasets: [{
      label: "Sales",
      fillColor: "rgba(151,187,205,0.2)",
      strokeColor: "rgba(151,187,205,1)",
      pointColor: "rgba(151,187,205,1)",
      pointStrokeColor: "#fff",
      pointHighlightFill: "#fff",
      pointHighlightStroke: "rgba(151,187,205,1)",
      data: {!! json_encode(array_values(array_replace(array_fill(0, 12, 0), $monthlySales))) !!}

    }]
  };

  // User Enquiries Pie Chart
  var pdata = [{
      value: {{ $supportRequests['in_progress'] }},
      color: "#46BFBD",
      highlight: "#5AD3D1",
      label: "Total Enquiries"
    },
    {
      value: {{ $supportRequests['complete'] }},
      color: "#F7464A",
      highlight: "#FF5A5E",
      label: "Resolved"
    }
  ];

  var ctxl = document.getElementById("lineChartDemo").getContext("2d");
  new Chart(ctxl).Line(data);

  var ctxp = document.getElementById("pieChartDemo").getContext("2d");
  new Chart(ctxp).Pie(pdata);
</script>
@endsection
