<?php

namespace App\Http\Controllers;
use Alert;

use Illuminate\Http\Request;
use App\Models\transaksi;
use App\Models\persediaan;
use App\Models\pembatalanTransaksi;
use Carbon\Carbon;

use DB;

class transaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $transaksi = transaksi::paginate(10);
        $stok = persediaan::all();

        return view('layouts.transaksi',compact('transaksi','stok'));
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
        $product = DB::table('products')->where('id',$request->nama_product)->get();
        $stok = DB::table('persediaans')->where('id',$request->nama_product)->get();

        $persediaan = persediaan::find($request->nama_product);

        if($request->nama_product == null){
            alert()->warning('Nama Produk Tidak Boleh Kosong!','Silahkan Pilih Nama Produk');
            return redirect()->route('transaksi.index');
        }else if($request->jumlah < 0){
            alert()->warning('Jumlah Tidak Boleh Kurang Dari 0!','Silahkan Mengisi Jumlah Produk');
            return redirect()->route('transaksi.index');
        }else if($request->jumlah == null){
            alert()->warning('Jumlah Tidak Boleh Kosong!','Periksa Kembali Jumlah Produk');
            return redirect()->route('transaksi.index');
        }else if($stok[0]->stok == 0){
            alert()->warning('Stok Habis!','Periksa Kembali Stok Produk');
            return redirect()->route('transaksi.index');
        }else if($request->jumlah > $stok[0]->stok){
            alert()->warning('Stok Tidak Mencukupi!','Periksa Kembali Stok Produk');
            return redirect()->route('transaksi.index');
        }
        else{
            toast('Transaksi Berhasil Disimpan!','success');
            $total = $product[0]->harga * $request->jumlah;
            $sisa_stok = $stok[0]->stok - $request->jumlah;
            $bulan = Carbon::now()->format('m');
            $tahun = Carbon::now()->format('Y');
            $tanggal = $tahun.'-'.$bulan.'-01';

            transaksi::create([
                'tanggal'=> $tanggal,
                'nama_barang'=> $product[0]->nama_produk,
                'jumlah_barang'=> $request->jumlah,
                'harga'=> $total,
                'status'=> 'BELUM',
            ]);

            $persediaan->update([
                'stok'=> $sisa_stok
            ]);

            toast('Transaksi Berhasil Disimpan!','success');
            return redirect()->route('transaksi.index');
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
    public function destroy($id, $nama_barang)
    {
        $stok = DB::table('persediaans')->where('nama_product',$nama_barang)->get();
        $data = transaksi::find($id);
        $sisa_stok = $stok[0]->stok + $data->jumlah_barang;
        $tanggal_sekarang = carbon::now();
        pembatalanTransaksi::create([
            'tanggal'=> $tanggal_sekarang,
            'nama_product'=> $data->nama_barang,
            'jumlah'=> $data->jumlah_barang,
            'harga'=> $data->harga,
            'keterangan'=> 'Pembatalan Transaksi'
        ]);
        DB::table('persediaans')->where('nama_product',$nama_barang)->update([
            'stok'=> $sisa_stok
        ]);

        $nama_barang = $data->nama_barang;

        $ucapan = "Transaksi $nama_barang Berhasil Dihapus, Dan Stok Dikembalikan!";

        toast($ucapan,'success');
        $data->delete();

        return redirect()->route('transaksi.index');
    }
}
