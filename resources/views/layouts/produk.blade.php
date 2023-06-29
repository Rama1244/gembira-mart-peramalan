@extends('main')

@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Data <strong>Product</strong></h1>

        <div class="row">
            <div class="col-xl-9 col-xxl-9 d-flex mb-3">
                <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="align-middle me-2" data-feather="plus"></i>Tambah Product</a>
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
                        <h5 class="card-title mb-0">Tabel Product</h5>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Product</th>
                                <th class="d-none d-xl-table-cell">Satuan</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($product as $d => $data)
                            <tr>
                                <td>{{ $d + $product->firstItem() }}</td>
                                <td>{{ $data->nama_produk }}</td>
                                <td class="d-none d-xl-table-cell">{{ $data->satuan }}</td>
                                <td>{{ $data->harga }}</td>
                                <td>
                                    <a class="text-primary" href="{{ route('product.edit', $data->id) }}"><i class="align-middle" data-feather="edit"></i></a>
                                    <a class="text-danger mx-1" href="product/hapus/" id="delete" data-name="{{ $data->nama_produk }}" data-id="{{ $data->id }}"><i class="align-middle" data-feather="trash-2"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $product->links("vendor.pagination.bootstrap-5") }}
        </div>

    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

@endsection
