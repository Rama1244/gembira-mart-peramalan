<?php

namespace App\Http\Controllers;
use Alert;

use App\Models\penjualan;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class penjualanController extends Controller
{
    public function index()
    {
        $penjualan = penjualan::paginate(10);

        return view('layouts.penjualan',compact('penjualan'));
    }

    public function create()
    {
        return view('layouts.tambah-penjualan');
    }

    public function store(Request $request)
    {
        $bulan = Carbon::parse($request->periode)->isoFormat('MM');
        $tahun = Carbon::parse($request->periode)->isoFormat('YYYY');
        $tanggal_periode = $tahun.'-'.$bulan.'-01';

        $cek_penjualan = transaksi::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->where('status_penjualan', 'BELUM')->get();
        if($request->periode == null){
            toast('Mohon Isi Periode!','error');
            return redirect()->route('penjualan.index');
        }
        if($cek_penjualan->isEmpty()){
            toast('Data Penjualan pada periode tersebut Kosong!','error');
            return redirect()->route('penjualan.index');
        } else if($cek_penjualan == null){
            $jumlah_penjualan = $cek_penjualan->pluck('jumlah_barang')->sum();

            transaksi::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->where('status_penjualan', 'BELUM')->update([
                'status_penjualan' => 'SUDAH',
            ]);

            penjualan::create([
                'tanggal_periode' => $tanggal_periode,
                'data_aktual' => $jumlah_penjualan,
            ]);

            toast('Berhasil Menambahkan Data Baru!','success');
            return redirect()->route('penjualan.index');

        } else if($cek_penjualan->isNotEmpty() && $cek_penjualan->count() >= 1){
            $jumlah_penjualan = $cek_penjualan->pluck('jumlah_barang')->sum();

            $cek_penjualan_sebelumnya = penjualan::where('tanggal_periode', $tanggal_periode)->orderBy('tanggal_periode', 'desc')->get();
            $jumlah_sebelumnya = $cek_penjualan_sebelumnya->pluck('data_aktual')->sum();
            $jumlah_baru = $jumlah_sebelumnya + $jumlah_penjualan;

            transaksi::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->where('status_penjualan', 'BELUM')->update([
                'status_penjualan' => 'SUDAH',
            ]);

            penjualan::whereMonth('tanggal_periode', $bulan)->whereYear('tanggal_periode', $tahun)->update([
                'data_aktual' => $jumlah_baru,
            ]);

            toast('Berhasil Menambahkan ke Data Lama!','success');
            return redirect()->route('penjualan.index');

        }else{
            toast('Data Sudah Ada, Tidak ada data baru yang bisa ditambahkan!','error');
            return redirect()->route('penjualan.index');
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $data = penjualan::find($id);
        return view('layouts.update-penjualan', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = penjualan::find($id);
        $data->update($request->all());
        toast('Data Penjualan berhasil diubah!','success');
        return redirect()->route('penjualan.index');
    }

    public function destroy($id)
    {
        $data = penjualan::find($id);
        $data->delete();

        toast('Data Penjualan berhasil dihapus!','success');

        return redirect()->route('penjualan.index');
    }


}
