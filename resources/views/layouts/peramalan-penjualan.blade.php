@extends('main')

@section('content')
<main class="content">
  <div class="container-fluid p-0">

    <h1 class="h3 mb-3">Peramalan Penjualan</h1>

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
      <div class="col-sm-6">
        <div class="card flex-fill w-100">
          <div class="card-header">

            <h5 class="card-title mb-0"><i class="align-middle" data-feather="book-open"></i> Peramalan Penjualan per-Bulan</h5>
          </div>
          <div class="card-body">
            <p class="card-text">
                Untuk Pilihan Peramalan Penjualan ini, Anda dapat melakukan peramalan dari keseluruhan penjualan yang telah didapatkan dari transaksi penjualan. Jadi, data yang digunakan adalah data jumlah penjualan dari semua produk pada periode bulan dan tahun yang telah ditentukan. <br><br>
                Silahkan klik tombol dibawah ini untuk melakukan peramalan penjualan...
            </p>
            <a class="btn btn-primary" href="{{ route('peramalan-penjualan-all.index') }}">Peramalan Penjualan</a>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card flex-fill w-100">
          <div class="card-header">

            <h5 class="card-title mb-0"><i class="align-middle" data-feather="book-open"></i> Peramalan Penjualan Produk</h5>
          </div>
          <div class="card-body">
            <p class="card-text">
                Untuk Pilihan Peramalan Penjualan Produk ini, Anda dapat melakukan peramalan dari data produk yang telah dipilih untuk peramalan. Data dapat dipilih berdasarkan dari nama produk, bulan dan tahun yang telah dipilih, lalu data yang telah didapat akan dijumlah sesuai dengan periode bulan dan tahun yang telah ditentukan, lalu dari data tersebut dapat dilakukan peramalan. <br><br>
                Silahkan klik tombol dibawah ini untuk melakukan peramalan penjualan produk...
            </p>
            <a class="btn btn-primary" href="{{ route('peramalan-product.index') }}">Peramalan Penjualan Produk</a>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>
@endsection
