@extends('main')

@section('content')
<main class="content">
	<div class="container-fluid p-0">
		<div class="mb-3">
			<h1 class="h3 d-inline align-middle">Tambah Stok</h1>
		</div>
		<div class="row">
			<div class="col-12 col-lg-12">
                    <form action="{{ route('persediaan-tambah', $data->id) }}" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Tambah Stok</h5>
                                    </div>
                                    <div class="card-body">
                                        {{ csrf_field() }}
                                        <input type="text" value="{{ $data->id }}" name="id" hidden>
                                        <label class="form-label">Nama Produk</label>
                                        <p><b>{{ $data->nama_product }}</b></p>
                                        <label class="form-label mt-2">Sisa Stok</label>
                                        <p><b>{{ $data->stok }}</b></p>
                                        <label class="form-label mt-2">Satuan</label>
                                        <p><b>{{ $data->satuan }}</b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <label class="form-label mt-2">Stok tambahan</label>
                                        <input type="number" class="form-control mb-3" placeholder="Masukkan Jumlah Penambahan Stok..." name="stok">
                                        <button class="btn btn-success" type="submit">Proses</button>
                                        <button class="btn btn-danger" type="reset">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
			</div>
		</div>
	</div>
</main>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
