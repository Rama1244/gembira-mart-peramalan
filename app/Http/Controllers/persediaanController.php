<?php

namespace App\Http\Controllers;
use Alert;

use Illuminate\Http\Request;
use App\Models\persediaan;
use DB;

class persediaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persediaan = persediaan::paginate(10);
        //searching
        if(request()->has('search')){
            $persediaan = persediaan::where('nama_product','LIKE','%'.request('search').'%')->paginate(10)->withQueryString();
        }
        return view('layouts.persediaan',compact('persediaan'));

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
    public function editTambah($id)
    {
        $data = persediaan::find($id);
        return view('layouts.tambah-stok', compact('data'));
    }

    public function editKurang($id)
    {
        $data = persediaan::find($id);
        if($data->stok == 0){
            Alert::error('Stok Kosong', 'Tidak Dapat Melakukan Pengurangan Stok');
            return redirect()->route('persediaan.index');
        }else{
            return view('layouts.kurang-stok', compact('data'));
        }
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

    public function kurang(Request $request){
        $stok_lama = DB::table('persediaans')->where('id', $request->id)->value('stok');
        $stok_baru = $request->stok;
        $stok = $stok_lama - $stok_baru;
        DB::table('persediaans')->where('id', $request->id)->update([
            'stok'=> $stok,
        ]);
        return redirect()->route('persediaan.index');
    }

    public function tambah(Request $request){
        $stok_lama = DB::table('persediaans')->where('id', $request->id)->value('stok');
        $stok_baru = $request->stok;
        $stok = $stok_lama + $stok_baru;
        DB::table('persediaans')->where('id', $request->id)->update([
            'stok'=> $stok,
        ]);
        return redirect()->route('persediaan.index');
    }
}
