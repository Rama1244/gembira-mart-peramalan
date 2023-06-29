@extends('main')

@section('content')
<main class="content">
	<div class="container-fluid p-0">
		<div class="mb-3">
			<h1 class="h3 d-inline align-middle">Tambah Pengguna</h1>
		</div>
		<div class="row">
			<div class="col-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">Tambah Pengguna</h5>
					</div>
					<div class="card-body">
						<label class="form-label">Nama</label>
						<input type="text" class="form-control" placeholder="Masukkan nama lengkap" name="nama">
						<label class="form-label mt-2">E-mail</label>
						<input type="text" class="form-control" placeholder="Masukkan E-mail" name="email">
						<label class="form-label mt-2">Password</label>
						<input type="text" class="form-control" placeholder="Masukkan Password" name="password">
						<label class="form-label mt-2">Role</label>
						<select class="form-select mb-3">
							<option selected>Pilih Role</option>
							<option>Staff</option>
							<option>Admin</option>
						</select>
						<button class="btn btn-success" type="submit">Proses</button>
						<button class="btn btn-danger" type="submit">Hapus</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection