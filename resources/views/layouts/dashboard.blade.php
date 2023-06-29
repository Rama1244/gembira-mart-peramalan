@extends('main')

@section('content')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Menu <strong>Dashboard</strong></h1>

    <div class="row">
        <div class="col">
            <div class="card flex-fill w-100">
            {{-- <div class="card-header">
            </div> --}}
            <div class="card-body py-3 text-center">
                <h1>Selamat Datang</h1><br>
                <h1>Gembira Mart Swalayan</h1><br>
                <h3>Sistem Informasi Peramalan Penjualan Produk</h3>
            </div>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col d-flex">
        <div class="w-100">
          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                    <div class="row">
                      <div class="col mt-0">
                        <h5 class="card-title">Data Penjualan Keseluruan</h5>
                      </div>
                      <div class="col-auto">
                        <div class="stat text-primary">
                          <i class="align-middle" data-feather="archive"></i>
                        </div>
                      </div>
                    </div>
                  <h1 class="mt-1 mb-3">{{ $jumlah_penjualan }}</h1>
                  <div class="mb-0">
                    <span class="text-primary"> <i class="mdi mdi-arrow-bottom-right"></i> {{ $total_penjualan }} </span>
                    <span class="text-muted">Total Penjualan keseluruan</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col mt-0">
                        <h5 class="card-title">Data Penjualan Produk</h5>
                      </div>

                      <div class="col-auto">
                        <div class="stat text-primary">
                          <i class="align-middle" data-feather="shopping-cart"></i>
                        </div>
                      </div>
                    </div>
                    <h1 class="mt-1 mb-3">{{ $jumlah_penjualan_produk }}</h1>
                    <div class="mb-0">
                      <span class="text-primary"> <i class="mdi mdi-arrow-bottom-right"></i> {{ $total_penjualan_produk }} </span>
                      <span class="text-muted">Total Penjualan Produk</span>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="card flex-fill w-100">
          <div class="card-header">

            <h5 class="card-title mb-0">Data Penjualan Setiap Bulan</h5>
          </div>
          <div class="card-body py-3">
            <div class="chart chart-sm">
              <canvas id="grafik"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("grafik").getContext("2d");
        var gradient = ctx.createLinearGradient(0, 0, 0, 225);
        gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
        gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
        // Line chart
        new Chart(document.getElementById("grafik"), {
            type: "line",
            data: {
                labels: <?php echo json_encode($bulan_grafik) ?>,
                datasets: [{
                    label: "Penjualan",
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: window.theme.primary,
                    data: <?php echo json_encode($data_aktual) ?>
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    intersect: false
                },
                hover: {
                    intersect: true
                },
                plugins: {
                    filler: {
                        propagate: true
                    }
                },
                scales: {
                    xAxes: [{
                        reverse: true,
                        gridLines: {
                            color: "rgba(0,0,0,0.0)"
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 50
                        },
                        display: true,
                        borderDash: [5, 5],
                        gridLines: {
                            color: "rgba(0,0,0,0.0)"
                        }
                    }]
                }
            }
        });
    });
</script>
@endsection
