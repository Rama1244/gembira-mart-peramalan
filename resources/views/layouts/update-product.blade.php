@extends('main')

@section('content')
<main class="content">
	<div class="container-fluid p-0">
		<div class="mb-3">
			<h1 class="h3 d-inline align-middle">Edit Product</h1>
		</div>
		<div class="row">
			<div class="col-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">Edit Product</h5>
					</div>
					<div class="card-body">
                        <form action="{{ route('product.update', $data->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="text" class="form-control" placeholder="Masukkan nama produk" name="id" value="{{ $data->id }}" hidden>
                            <label class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama produk" name="nama_produk" value="{{ $data->nama_produk }}">
                            <label class="form-label mt-2">Satuan</label>
                            <input type="text" class="form-control" placeholder="Masukkan Satuan" name="satuan" value="{{ $data->satuan }}">
                            <label class="form-label mt-2">Harga</label>
                            <input type="number" class="form-control mb-3" placeholder="Masukkan Harga" name="harga" value="{{ $data->harga }}">
                            <button class="btn btn-success" type="submit">Proses</button>
                            <button class="btn btn-danger" type="reset">Hapus</button>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
