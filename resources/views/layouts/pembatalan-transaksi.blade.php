@extends('main')

@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Data <strong>Pembatalan Transaksi</strong></h1>

        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tabel Riwayat Pembatalan Transaksi</h5>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th class="d-none d-xl-table-cell">Tanggal</th>
                                <th class="d-none d-xl-table-cell">Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($pembatalan as $d => $data)
                            <tr>
                                <td>{{ $d + $pembatalan->firstItem() }}</td>
                                <td class="d-none d-xl-table-cell">{{ $data->tanggal }}</td>
                                <td class="d-none d-xl-table-cell">{{ $data->nama_product }}</td>
                                <td>{{ $data->jumlah }}</td>
                                <td>{{ $data->harga }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $pembatalan->links("vendor.pagination.bootstrap-5") }}
        </div>
    </div>
</main>


@endsection
