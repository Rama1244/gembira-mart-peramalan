@extends('main')

@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Data <strong>Penjualan Product</strong></h1>

        <div class="row">
            <div class="col-xl-9 col-xxl-9 d-flex mb-3">
                <a href="{{ route('penjualan-product.create') }}" class="btn btn-primary"><i class="align-middle me-2" data-feather="plus"></i>Tambah Data Penjualan Product</a>
            </div>
            <form class="col-xl-3 col-xxl-3 d-flex mb-3" action="" method="GET">
                <input class="form-control" type="text" name="search" placeholder="Cari Produk..." value="{{ old('search') }}">
                <input type="submit" value="CARI" hidden>
            </form>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tabel Penjualan Product</h5>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Bulan-Tahun</th>
                                <th>Nama Product</th>
                                <th>Data Aktual</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($penjualanProduct as $d => $data)
                            <tr>
                                <td>{{ $d + $penjualanProduct->firstItem() }}</td>
                                <td>{{ $data->periode }}</td>
                                <td>{{ $data->nama_barang }}</td>
                                <td>{{ $data->jumlah_barang }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $penjualanProduct->links("vendor.pagination.bootstrap-5") }}
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

@endsection
