@extends('main')

@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Menu <strong>Pengguna</strong></h1>

        <div class="row">
            <div class="col-xl-6 col-xxl-5 d-flex mb-5">
                <a href="tambah-pengguna" class="btn btn-primary"><i class="align-middle me-2" data-feather="user-plus"></i>Tambah Pengguna</a>
            </div>
            <div class="col-xl-6 col-xxl-5 d-flex">

            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tabel Pengguna</h5>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th class="d-none d-xl-table-cell">Username</th>
                                <th class="d-none d-xl-table-cell">Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Project Apollo</td>
                                <td class="d-none d-xl-table-cell">01/01/2021</td>
                                <td class="d-none d-xl-table-cell">31/06/2021</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <a class="text-primary" href="#"><i class="align-middle" data-feather="edit"></i></a>
                                    <a class="text-danger mx-1" href="#"><i class="align-middle" data-feather="trash-2"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection