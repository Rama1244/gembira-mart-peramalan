<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penjualanProduct;
use App\Models\product;
use App\Models\transaksi;

class penjualanProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjualanProduct = penjualanProduct::paginate(10);
        //searching
        if(request()->has('search')){
            $penjualanProduct = penjualanProduct::where('nama_barang','LIKE','%'.request('search').'%')->paginate(10)->withQueryString();
        }

        return view('layouts.penjualanProduct',compact('penjualanProduct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = product::all();
        return view('layouts.tambah-penjualan-product',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $jumlah = 0;
        $jumlah_baru = 0;
        $tanggal = "01-".$request->bulan."-".$request->tahun;
        $tanggal = date('Y-m-d', strtotime($tanggal));
        $transaksi = transaksi::where('tanggal','=',$tanggal)->where('nama_barang','=',$request->nama_barang)->where('status','=','BELUM')->get();
        $tanggalPenjualan = penjualanProduct::where('periode','=',$tanggal)->where('nama_barang','=',$request->nama_barang)->get();
        // dd($tanggalPenjualan);
        $status = transaksi::where('status','=','BELUM')->where('nama_barang','=',$request->nama_barang)->get();
        if($tanggalPenjualan->count() > 0 && $transaksi->count() > 0){

            foreach($tanggalPenjualan as $t){
                $jumlah_lama = $t->jumlah_barang;

                foreach($status as $s){
                    $jumlah_baru = $jumlah + $s->jumlah_barang;
                }

                $cari_transaksi = penjualanProduct::find($t->id);
                $cari_transaksi->update([
                    'jumlah_barang' => $jumlah_lama + $jumlah_baru,
                ]);
            }

            foreach($status as $s){
                $update_status = transaksi::find($s->id);
                $update_status->status = "SUDAH";
                $update_status->save();
            }

            alert()->success('Jumlah Data telah ditambah!','Data ditambahkan ke data lama');
            return redirect()->route('penjualan-product.index');

        }else if($tanggalPenjualan->count() > 0){
            alert()->warning('Penjualan Produk Pada Bulan Ini Sudah Ada!','Silahkan Pilih Bulan Dan Tahun Lain');
            return redirect()->route('penjualan-product.index');
        } else if($transaksi->count() == 0){
            alert()->warning('Tidak ada Produk pada Periode yang anda pilih!','Silahkan Pilih Produk pada Bulan Dan Tahun Lain');
            return redirect()->route('penjualan-product.index');
        } else{
            foreach($transaksi as $t){
                $jumlah = $jumlah + $t->jumlah_barang;
            }
            penjualanProduct::create([
                'periode' => $tanggal,
                'nama_barang' => $request->nama_barang,
                'jumlah_barang' => $jumlah,
            ]);
            alert()->success('Penjualan Produk Berhasil!','Data Penjualan Produk Berhasil Ditambahkan');
            return redirect()->route('penjualan-product.index');
        }
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
