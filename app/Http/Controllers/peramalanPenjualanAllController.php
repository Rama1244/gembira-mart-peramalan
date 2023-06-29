<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\penjualan;
use Alert;
use carbon\carbon;

class peramalanPenjualanAllController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.peramalan-penjualan-all');
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
        $penjualan = penjualan::all();
        $periode = $penjualan->pluck('tanggal_periode')->toArray();
        $data_aktual = $penjualan->pluck('data_aktual')->toArray();
        $bulan = array();
        foreach($periode as $p){
            $bulan[] = Carbon::parse($p)->isoFormat('MMMM Y');
        }
        foreach($periode as $p){
            $bulan_grafik[] = Carbon::parse($p)->isoFormat('MMM YY');
        }
        $jumlah_data = count($penjualan);
        $bulan_terakhir = $penjualan[$jumlah_data-1]->tanggal_periode;

        $tambah_bulan = Carbon::parse($bulan_terakhir)->addMonth()->isoFormat('MMMM Y');
        $tambah_bulan_forecasting = Carbon::parse($bulan_terakhir)->addMonth()->isoFormat('MMM YY');

        $bulan_grafik = array_merge($bulan_grafik, array($tambah_bulan_forecasting));

        //single exponential smoothing
        $alpha = $request->alpha;
        $result = array();
        $result[0] = $penjualan[0]->data_aktual;
        $result[1] = $result[0];
        for ($i = 1; $i < $jumlah_data; $i++) {
            $result[$i+1] = $alpha * $penjualan[$i]->data_aktual + (1 - $alpha) * $result[$i];
        }

        //batas belakang koma
        // $result = array_slice($result, 1, $jumlah_data);
        // $result = array_map(function ($value) {
        //     return round($value, 2);
        // }, $result);

        $hasil_forcasting = end($result);

        //error
        $error = array();
        $error[0] = 0;
        for ($i = 1; $i < $jumlah_data; $i++) {
            $error[$i] = $penjualan[$i]->data_aktual - $result[$i];
        }

        //mad
        $mad = array();
        $mad[0] = 0;
        for ($i = 1; $i < $jumlah_data; $i++) {
            $mad[$i] = abs($error[$i]);
        };
        $rata_mad = array_sum($mad) / count($mad);

        //mse
        $mse = array();
        $mse[0] = 0;
        for ($i = 1; $i < $jumlah_data; $i++) {
            $mse[$i] = pow($error[$i], 2);
        }
        $rata_mse = array_sum($mse) / count($mse);

        //mape
        $mape = array();
        $mape[0] = 0;
        for ($i = 1; $i < $jumlah_data; $i++) {
            $mape[$i] = ($mad[$i] / $penjualan[$i]->data_aktual) * 100;
        }
        $rata_mape = array_sum($mape) / count($mape);

        return view('layouts.peramalan-penjualan-all', compact('penjualan','alpha' , 'bulan', 'tambah_bulan', 'result', 'hasil_forcasting', 'error', 'mad', 'mse', 'mape', 'rata_mad', 'rata_mse', 'rata_mape', 'bulan_grafik', 'data_aktual'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
