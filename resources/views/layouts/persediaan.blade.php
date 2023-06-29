@extends('main')

@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Data <strong>Persediaan</strong></h1>

        <div class="row">
            <form class="col-xl-3 col-xxl-3 d-flex mb-3" action="" method="GET">
                <input class="form-control" type="text" name="search" placeholder="Cari Produk..." value="{{ old('search') }}">
                <input type="submit" value="CARI" hidden>
            </form>
        </div>

        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tabel Product</h5>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Product</th>
                                <th>Stok</th>
                                <th class="d-none d-xl-table-cell">Satuan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($persediaan as $d => $data)
                            <tr>
                                <th>{{ $d + $persediaan->firstItem() }}</th>
                                <th>{{ $data->nama_product }}</th>
                                <th>{{ $data->stok }}</th>
                                <th class="d-none d-xl-table-cell">{{ $data->satuan }}</th>
                                <td>
                                    <a class="text-primary text-" href="/tambah-persediaan/{{ $data->id }}"><i class="align-middle" data-feather="plus-circle"></i></a>
                                    <a class="text-danger" href="/kurang-persediaan/{{ $data->id }}"><i class="align-middle" data-feather="minus-circle"></i></a>
                                </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $persediaan->links("vendor.pagination.bootstrap-5") }}
        </div>

    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

@endsection
