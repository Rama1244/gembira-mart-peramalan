@extends('main')

@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Data <strong>Penjualan</strong></h1>

        <div class="row">
            <div class="col-xl-6 col-xxl-5 d-flex mb-3">
                <a href="{{ route('penjualan.create') }}" class="btn btn-primary"><i class="align-middle me-2" data-feather="plus"></i>Tambah Data Penjualan</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tabel Penjualan</h5>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Bulan-Tahun</th>
                                <th class="d-none d-xl-table-cell">Data Aktual</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($penjualan as $d => $data)
                            <tr>
                                <td>{{ $d + $penjualan->firstItem() }}</td>
                                <td>{{ $data->tanggal_periode }}</td>
                                <td class="d-none d-xl-table-cell">{{ $data->data_aktual }}</td>
                                {{-- <td>
                                    <a class="text-primary" href="{{ route('penjualan.edit', $data->id) }}"><i class="align-middle" data-feather="edit"></i></a>
                                    <a class="text-danger mx-1 " href="penjualan/hapus/" id="delete" data-id="{{ $data->id }}" data-name="{{ $data->tanggal_periode }}">
                                        <i class="align-middle" data-feather="trash-2"></i>
                                    </a>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $penjualan->links("vendor.pagination.bootstrap-5") }}
        </div>
    </div>
</main>


@endsection
