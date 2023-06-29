<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penjualan;
use App\Models\penjualanProduct;

class peramalanPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_penjualan = penjualan::all();
        $jumlah_penjualan = $data_penjualan->pluck('data_aktual')->count();
        $total_penjualan = $data_penjualan->pluck('data_aktual')->sum();

        $data_penjualan_produk = penjualanProduct::all();
        $jumlah_penjualan_produk = $data_penjualan_produk->pluck('jumlah_barang')->count();
        $total_penjualan_produk = $data_penjualan_produk->pluck('jumlah_barang')->sum();
        return view('layouts.peramalan-penjualan', compact('jumlah_penjualan', 'jumlah_penjualan_produk', 'total_penjualan', 'total_penjualan_produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
