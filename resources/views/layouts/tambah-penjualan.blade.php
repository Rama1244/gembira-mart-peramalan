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
                        <form action="{{ route('penjualan.store') }}" method="post" enctype="multipart/form-data">
							@csrf
                            <label class="form-label">Bulan Periode</label>
                            <input type="month" class="form-control" name="periode">
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
