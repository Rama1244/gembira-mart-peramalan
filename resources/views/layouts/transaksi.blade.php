@extends('main')

@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Data <strong>Transaksi</strong></h1>

        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <a class="btn btn-secondary" href="{{ route('pembatalan-transaksi.index') }}">Riwayat Pembatalan <i class="align-middle" data-feather="file-text"></i></a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-lg-4 col-xxl-4">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tambah Transaksi</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('transaksi.store') }}" method="post" enctype="multipart/form-data">
							@csrf
                            <label class="form-label">Pilih Barang</label>
                            <select class="form-select" name="nama_product" id="">
                                <option class="form-control" value="">Pilih Barang</option>
                                @foreach ($stok as $barang)
                                @if ($barang->stok > 0)
                                    <option class="form-control" value="{{ $barang->id }}">{{ $barang->nama_product }} -> {{ $barang->stok }} {{ $barang->satuan }}</option>
                                @else
                                    <option class="form-control" value="{{ $barang->id }}">{{ $barang->nama_product }} -> Kosong</option>
                                @endif
                                @endforeach
                            </select>
                            <label class="form-label mt-2">Jumlah</label>
                            <input type="number" class="form-control" placeholder="Masukkan jumlah" name="jumlah">
                            <div class="mt-3">
                                <button class="btn btn-success" type="submit">Proses</button>
                                <button class="btn btn-danger" type="reset">Hapus</button>
                            </div>
                        </form>
					</div>
                </div>
            </div>
            <div class="col-12 col-lg-8 col-xxl-8 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tabel Transaksi</h5>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama barang</th>
                                <th class="d-none d-xl-table-cell">jumlah</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($transaksi as $d => $data)
                            <tr>
                                <td>{{ $d + $transaksi->firstItem() }}</td>
                                <td>{{ $data->nama_barang }}</td>
                                <td class="d-none d-xl-table-cell">{{ $data->jumlah_barang }}</td>
                                <td>{{ $data->harga }}</td>
                                <td>
                                    <a class="text-danger mx-1" href="transaksi/hapus/" id="deleteTransaksi" data-id="{{ $data->id }}" data-name="{{ $data->nama_barang }}"><i class="align-middle" data-feather="trash-2"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $transaksi->links("vendor.pagination.bootstrap-5") }}
        </div>

    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

@endsection
