<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\penjualanProduct;
use Alert;
use carbon\carbon;

class peramalanProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = product::all();

        return view('layouts.peramalan-produk', compact('product'));
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
        if(empty($request->nama_barang)){
            alert::error('Gagal', 'Nama Barang Tidak Boleh Kosong');
            return redirect()->back();
        }elseif(empty($request->alpha)){
            alert::error('Gagal', 'Alpha Tidak Boleh Kosong');
            return redirect()->back();
        }elseif($request->alpha >= 1){
            alert::error('Gagal', 'Alpha Tidak Boleh Lebih Dari 0.9');
            return redirect()->back();
        }elseif($request->alpha <= 0){
            alert::error('Gagal', 'Alpha Tidak Boleh Kurang Dari 0.1');
            return redirect()->back();
        }else{
            $product = product::all();
            $nama_barang = $request->nama_barang;
            $penjualan_barang = penjualanProduct::where('nama_barang', $nama_barang)->get();
            $bulan_periode = $penjualan_barang->pluck('periode')->toArray();
            $data_aktual = $penjualan_barang->pluck('jumlah_barang')->toArray();
            $hari = Carbon::now()->isoFormat('dddd');
            dd($hari);
            $bulan = array();
            for ($i = 0; $i < count($bulan_periode); $i++) {
                $bulan[$i] = Carbon::parse($bulan_periode[$i])->isoFormat('MMMM Y');
            };
            foreach($bulan_periode as $p){
                $bulan_grafik[] = Carbon::parse($p)->isoFormat('MMM YY');
            }
            $jumlah_data = count($penjualan_barang);
            $bulan_terakhir = $penjualan_barang[$jumlah_data-1]->periode;

            $tambah_bulan = date('Y-m-d', strtotime('+1 month', strtotime($bulan_terakhir)));

            $bulan_forcasting = Carbon::parse($tambah_bulan);

            $hasil_bulan_forcasting = $bulan_forcasting->isoFormat('MMMM Y');
            $tambah_bulan_forecasting = Carbon::parse($bulan_terakhir)->addMonth()->isoFormat('MMM YY');

            $bulan_grafik = array_merge($bulan_grafik, array($tambah_bulan_forecasting));


            //single exponential smoothing
            $alpha = $request->alpha;
            $result = array();
            $result[0] = $penjualan_barang[0]->jumlah_barang;
            $result[1] = $result[0];
            for ($i = 2; $i < count($penjualan_barang)+1; $i++) {
                $result[$i] = $result[$i - 1] + $alpha * ($penjualan_barang[$i-1]->jumlah_barang - $result[$i - 1]);
            };

            $hasil_forcasting = end($result);

            //error
            $aktual = $penjualan_barang->pluck('jumlah_barang')->toArray();
            $error = array();
            $error[0] = 0;
            for ($i = 1; $i < count($aktual); $i++) {
                $error[$i] = $aktual[$i] - $result[$i];
            };

            // dd($result);

            //mad
            $aktual = $penjualan_barang->pluck('jumlah_barang')->toArray();
            $mad = array();
            $mad[0] = 0;
            for ($i = 1; $i < count($aktual); $i++) {
                $mad[$i] = abs($aktual[$i] - $result[$i]);
            };

            $rata_mad = array_sum($mad) / count($mad);

            //mse
            $aktual = $penjualan_barang->pluck('jumlah_barang')->toArray();
            $mse = array();
            $mse[0] = 0;
            for ($i = 1; $i < count($aktual); $i++) {
                $mse[$i] = pow($mad[$i], 2);
            };
            $rata_mse = array_sum($mse) / count($mse);

            //mape
            $aktual = $penjualan_barang->pluck('jumlah_barang')->toArray();
            $mape = array();
            $mape[0] = 0;
            for ($i = 1; $i < count($aktual); $i++) {
                $mape[$i] = ($mad[$i] / $aktual[$i]) * 100;
            };

            $rata_mape = array_sum($mape) / count($mape);


            return view('layouts.peramalan-produk', compact('result', 'bulan', 'error', 'mad', 'mse','mape','hasil_forcasting', 'rata_mad', 'rata_mse', 'rata_mape', 'nama_barang', 'penjualan_barang', 'alpha','product','hasil_bulan_forcasting', 'bulan_grafik', 'data_aktual'));
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
