<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    penjualanController,
    productController,
    persediaanController,
    transaksiController,
    peramalanPenjualanController,
    penjualanProductController,
    pembatalanTransaksiController,
    peramalanProductController,
    peramalanPenjualanAllController,
    dashboardController,};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#Login
Route::get('login', function () {
    return view('login');
});
#Forgot Password
Route::get('forgot-password', function () {
    return view('forgot-password');
});

// #Dashboard
// Route::get('/', function () {
//     return view('layouts.dashboard');
// });

#Pengguna
Route::get('tambah-pengguna', function () {
    return view('layouts.admin.input-user');
});
Route::get('pengguna', function () {
    return view('layouts.admin.user');
});

#Peramalan Penjualan
Route::get('peramalan-penjualan', function () {
    return view('layouts.peramalan-penjualan');
});
Route::get('tambah-peramalan-penjualan', function () {
    return view('layouts.tambah-peramalan-penjualan');
});

#Data Penjualan
Route::resource('penjualan', penjualanController::class);
Route::get('penjualan/hapus/{id}', [penjualanController::class, 'destroy']);

#Data Product
Route::resource('product', productController::class);
Route::get('product/hapus/{id}', [productController::class, 'destroy']);

#Data Persediaan
Route::resource('persediaan', persediaanController::class);
Route::get('/tambah-persediaan/{id}',[persediaanController::class, 'editTambah'])->name('tambah-persediaan');
Route::post('persediaan-tambah',[persediaanController::class, 'tambah'])->name('persediaan-tambah');
Route::get('/kurang-persediaan/{id}',[persediaanController::class, 'editKurang'])->name('kurang-persediaan');
Route::post('persediaan-kurang',[persediaanController::class, 'kurang'])->name('persediaan-kurang');

#Data Transaksi
Route::resource('transaksi', transaksiController::class);
Route::get('transaksi/hapus/{id}/{nama_barang}', [transaksiController::class, 'destroy']);

#peramalan-penjualan
Route::resource('peramalan-penjualan', peramalanPenjualanController::class);

#Data Penjualan Product
Route::resource('penjualan-product', penjualanProductController::class);

#Pembatalan Transaksi
Route::resource('pembatalan-transaksi', pembatalanTransaksiController::class);

#peramalan product
Route::resource('peramalan-product', peramalanProductController::class);

#peramalan penjualan all
Route::resource('peramalan-penjualan-all', peramalanPenjualanAllController::class);

#dashboard
Route::resource('/', dashboardController::class);
