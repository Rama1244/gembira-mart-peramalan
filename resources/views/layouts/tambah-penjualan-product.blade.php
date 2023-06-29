@extends('main')
@section('content')
<main class="content">
	<div class="container-fluid p-0">
		<div class="mb-3">
			<h1 class="h3 d-inline align-middle">Tambah Penjualan</h1>
		</div>
		<div class="row">
			<div class="col-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">Tambah Penjualan</h5>
					</div>
					<div class="card-body">
                        <form action="{{ route('penjualan-product.store') }}" method="post" enctype="multipart/form-data">
							@csrf
                            <label class="form-label">Bulan & Tahun</label>
                            <div class="row">
                                <div class="col-6 col-lg-6">
                                    <select name="bulan" class="form-control">
                                        <option value="">Pilih Bulan</option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-6 col-lg-6">
                                    <input type="number" class="form-control col-6 col-lg-6" name="tahun">
                                </div>
                            </div>
                            <label class="form-label mt-2">Nama Barang</label>
                            <select name="nama_barang" class="form-control">
                                <option value="">Pilih Barang</option>
                                @foreach ($product as $item)
                                    <option value="{{ $item->nama_produk }}">{{ $item->nama_produk }}</option>
                                @endforeach
                            </select>
                            <div class="mt-3">
                                <button class="btn btn-success" type="submit">Proses</button>
                                <button class="btn btn-danger" type="reset">Hapus</button>
                            </div>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection
