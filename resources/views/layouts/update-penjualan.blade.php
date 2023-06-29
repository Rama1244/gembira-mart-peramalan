@extends('main')
@section('content')
<main class="content">
	<div class="container-fluid p-0">
		<div class="mb-3">
			<h1 class="h3 d-inline align-middle">Edit Penjualan</h1>
		</div>
		<div class="row">
			<div class="col-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">Edit Penjualan</h5>
					</div>
					<div class="card-body">
                        <form action="{{ route('penjualan.update', $data->id) }}" method="post" enctype="multipart/form-data">
							@csrf
                            @method('PUT')
                            <label class="form-label">Tanggal Periode</label>
                            <input type="date" class="form-control" name="tanggal_periode" value="{{ date('Y-m-d',strtotime($data->tanggal_periode)) }}" >
                            <label class="form-label mt-2">Data Aktual</label>
                            <input type="number" class="form-control" placeholder="Masukkan Data Aktual" name="data_aktual" value="{{ $data->data_aktual }}">
                            <div class="mt-3">
                                <button class="btn btn-success" type="submit">Update</button>
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
