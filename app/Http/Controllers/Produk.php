<?php

namespace App\Http\Controllers;

use App\Models\Produk as ModelsProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Produk extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produk = ModelsProduk::where('nama_produk', 'like', '%' . $request->search . '%')->paginate(10);
        foreach($produk as $p) {
            $p->gambar;
        }
        return response([
            'data' => $produk
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string',
            'stok' => 'numeric|required|min:0',
            'harga' => 'required|numeric'
        ]);
        if ($validator->fails()) return response($validator->getMessageBag());
        $produk = ModelsProduk::create($request->all());
        return response([
            'data' => $produk
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = ModelsProduk::find($id);
        if ($produk == null) return response(['message' => 'Data not found!'], 404);
        $produk->gambar = count($produk->gambar) > 0 ? $produk->gambar : asset(Storage::url('default.jpg'));
        return response([
            'data' => $produk
        ]);
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
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string',
            'stok' => 'numeric|nullable|min:0',
            'harga' => 'nullable|numeric'
        ]);
        $produk = ModelsProduk::find($id);
        if ($produk == null) return response(['message' => 'Data not found!'], 404);
        $produk->nama_produk = $request->nama_produk ? $request->nama_produk : $produk->nama_produk;
        $produk->stok = $request->stok ? $request->stok : $produk->stok;
        $produk->harga = $request->harga ? $request->harga : $produk->harga;
        $produk->save();
        return response([
            'data' => $produk
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = ModelsProduk::find($id);
        if ($produk == null) return response(['message' => 'Data not found!'], 404);
        $gambar = $produk->gambar;
        foreach($gambar as $g) {
            $g->delete();
        }
        $produk->delete();
        return response(['message' => 'Success']);
    }
}
