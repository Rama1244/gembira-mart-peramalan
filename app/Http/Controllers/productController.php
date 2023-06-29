<?php

namespace App\Http\Controllers;
use Alert;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\persediaan;

class productController extends Controller
{
    public function index()
    {
        $product = product::paginate(10);
        //searching
        if(request()->has('search')){
            $product = product::where('nama_produk','LIKE','%'.request('search').'%')->paginate(10)->withQueryString();
        }
        return view('layouts.produk',compact('product'));
    }

    public function create()
    {
        return view('layouts.tambah-produk');
    }

    public function store(Request $request)
    {
        product::create($request->all());
        persediaan::create([
            'nama_product'=> $request->nama_produk,
            'satuan'=> $request->satuan,
            'stok'=>0
        ]);
        toast('Data Produk berhasil ditambahkan!','success');
        return redirect()->route('product.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = product::find($id);
        // dd($data);
        return view('layouts.update-product', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = product::find($id);

        $persediaan = persediaan::find($id);
        // dd($persediaan);
        $data->update($request->all());

        $persediaan->update([
            'nama_product'=> $request->nama_produk,
            'satuan'=> $request->satuan
        ]);
        toast('Data Product berhasil diubah!','success');
        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        $data = product::find($id);
        $data->delete();
        $persediaan = persediaan::find($id);
        $persediaan->delete();

        toast('Data Product berhasil dihapus!','success');

        return redirect()->route('product.index');
    }
}
