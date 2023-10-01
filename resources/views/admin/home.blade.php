@extends('../layouts/app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>{{ trans('global.dashboard') }}</h1>
    </div><!-- End Page Title -->

    @if (Session::has('msg'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get("msg") }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 col-12 col-xl-12">
                <div class="row">
                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <!-- <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('admin.home', ['interval' => 'Today']) }}">Today</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.home', ['interval' => 'This Month']) }}">This Month</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.home', ['interval' => 'This Year']) }}">This Year</a></li>
                                </ul>
                            </div> -->

                            <div class="card-body">
                                <h5 class="card-title">Reports</h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>
                                
                                <!-- Your ApexCharts script here -->

                            </div>

                        </div>
                    </div><!-- End Reports -->

                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>

</main><!-- End #main -->

@endsection

@section('scripts')
<script>
    var salesCountData = @json($salesCountData);
    var customersCountData = @json($customersCountData);
    var booksCountData = @json($booksCountData);

    document.addEventListener("DOMContentLoaded", () => {
      new ApexCharts(document.querySelector("#reportsChart"), {
        series: [{
          name: 'Sales',
          data: salesCountData.map(item => item.count),
        }, {
          name: 'Customers',
          data: customersCountData.map(item => item.count),
        }, {
          name: 'Books',
          data: booksCountData.map(item => item.count),
        }],
        chart: {
          height: 350,
          type: 'area',
          toolbar: {
            show: false
          },
        },
        markers: {
          size: 4
        },
        colors: ['#4154f1', '#2eca6a', '#ff771d'],
        fill: {
          type: "gradient",
          gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.3,
            opacityTo: 0.4,
            stops: [0, 90, 100]
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth',
          width: 2
        },
        xaxis: {
          type: 'dateTime',
          categories: salesCountData.map(item => item.date), // Convert dates to timestamps
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy'
          },
        }
      }).render();
    });
  </script>
@endsection
