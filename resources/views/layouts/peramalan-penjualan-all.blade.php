@extends('main')

@section('content')
<main class="content">
	<div class="container-fluid p-0">
		<div class="mb-3">
			<h1 class="h3 d-inline align-middle">Peramalan Penjualan per-Bulan</h1>
		</div>
		<div class="row">
			<div class="col-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">Hitung Peramalan per-Bulan</h5>
					</div>
					<div class="card-body">
						<form action="{{ route('peramalan-penjualan-all.store') }}" method="post" enctype="multipart/form-data">
							@csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label mt-2">Nilai Alpha</label>
                                    <input type="text" class="form-control" name="alpha" placeholder="Nilai Alpha -> 0.1 - 0.9">
                                </div>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-success" type="submit">Hitung</button>
                            </div>
                        </form>
					</div>
				</div>
			</div>
		</div>
        @if ($_SERVER['REQUEST_METHOD'] === 'POST')
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="alert alert-primary" role="alert">
                        Nilai Alpha <strong>{{ $alpha }}</strong>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Hasil Peramalan per-Bulan</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover my-0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Bulan-Tahun</th>
                                        <th>Data Aktual</th>
                                        <th>Forcasting</th>
                                        <th>MAD</th>
                                        <th>MSE</th>
                                        <th>MAPE %</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                        $id = 0;
                                        @endphp
                                    @foreach ($penjualan as $d => $data)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $bulan[$id] }}</td>
                                        <td>{{ $data->data_aktual }}</td>
                                        <td>{{ $result[$id] }}</td>
                                        <td>{{ $mad[$id] }}</td>
                                        <td>{{ $mse[$id] }}</td>
                                        <td>{{ (int)$mape[$id] }}%</td>
                                    </tr>
                                    @php
                                        $no++;
                                        $id++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="alert alert-success" role="alert">
                        Hasil Peramalan pada bulan <strong>{{ $tambah_bulan }}</strong> adalah <strong>{{ $hasil_forcasting }}</strong>, dengan hasil MAPE <strong>{{ (int)$rata_mape }}%</strong>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3 col-lg-3">
                    <div class="alert alert-warning" role="alert">
                        <strong>**Informasi Interpretasi Mape</strong><br><br>
                        1. &nbsp; Hasil Peramalan sangat akurat = <strong>< 10</strong><br>
                        2. &nbsp; Hasil Peramalan baik = <strong>10 - 20</strong><br>
                        3. &nbsp; Hasil Peramalan layak (cukup baik) = <strong>20 - 50</strong><br>
                        4. &nbsp; Hasil Peramalan tidak akurat = <strong>> 50</strong>
                    </div>
                </div>
                <div class="col-9 col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Hasil Peramalan Produk</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover my-0">
                                <thead>
                                    <tr>
                                        <th>Bulan-Tahun</th>
                                        <th>Forcasting</th>
                                        <th>MAPE %</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $tambah_bulan }}</td>
                                        <td>{{ $hasil_forcasting }}</td>
                                        <td>{{ (int)$rata_mape }}%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="card flex-fill w-100">
                  <div class="card-header">

                    <h5 class="card-title mb-0">Grafik Forecasting</h5>
                  </div>
                  <div class="card-body py-3">
                    <div class="chart">
                      <canvas id="grafik"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var ctx = document.getElementById("grafik").getContext("2d");
                    var gradient = ctx.createLinearGradient(0, 0, 0, 225);
                    // Line chart
                    new Chart(document.getElementById("grafik"), {
                        type: "line",
                        data: {
                            labels: <?php echo json_encode($bulan_grafik) ?>,
                            datasets: [{
                                label: "Data Aktual",
                                fill: true,
                                backgroundColor: "transparent",
                                borderColor: "#2D4356",
                                data: <?php echo json_encode($data_aktual) ?>
                            }, {
                                label: "Forcasting",
                                fill: true,
                                backgroundColor: "transparent",
                                borderColor: "#A76F6F",
                                borderDash: [4, 4],
                                data: <?php echo json_encode($result) ?>
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            legend: {
                                display: true
                            },
                            tooltips: {
                                intersect: false
                            },
                            hover: {
                                intersect: true
                            },
                            plugins: {
                                filler: {
                                    propagate: false
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
            @endif
        </div>
    </main>

@endsection
