<?php

namespace App\Http\Controllers;

use App\Models\Keranjang as ModelsKeranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Keranjang extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keranjang = $request->user()->currentAccessToken()->name == 'admin' ? ModelsKeranjang::paginate(10) : $request->user()->keranjang;
        $produk = [];
        $i = 0;
        foreach($keranjang as $a) {
            $produk[$i++] = $a->produk_keranjang;
        }
        return response([
            'data' => $keranjang
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
            'produk_id' => 'required|numeric',
            'jml_beli' => 'nullable|numeric|min:1'
        ]);
        if ($validator->fails()) return response($validator->getMessageBag());
        if (!Produk::find($request->produk_id)) return response(['message' => 'Product not found!'], 404);
        $keranjang = ModelsKeranjang::create([
            'user_id' => $request->user()->id,
            'produk_id' => $request->produk_id,
            'jml_beli' => $request->jml_beli
        ]);
        return response([
            'data' => $keranjang
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $keranjang = $request->user()->currentAccessToken()->name == 'admin' ? $keranjang = ModelsKeranjang::find($id) : $request->user()->keranjang->find($id);
        if ($keranjang == null) return response(['message' => 'Cart not found!'], 404);
        return response([
            'data' => $keranjang
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
            'produk_id' => 'nullable|numeric',
            'jml_beli' => 'nullable|numeric|min:1'
        ]);
        if ($validator->fails()) return response($validator->getMessageBag());
        if ($request->produk_id != null && !Produk::find($request->produk_id ? $request->produk_id : 0)) return response(['message' => 'Product not found!']);
        $keranjang = $request->user()->currentAccessToken()->name == 'admin' ? ModelsKeranjang::find($id) : $request->user()->keranjang->find($id);
        if ($keranjang == null) return response(['message' => 'Cart not found!']);
        $keranjang->produk_id = $request->produk_id ? $request->produk_id : $keranjang->produk_id;
        $keranjang->jml_beli = $request->jml_beli ? $request->jml_beli : $keranjang->jml_beli;
        $keranjang->save();
        return response([
            'data' => $keranjang
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $keranjang = $request->user()->currentAccessToken()->name == 'admin' ? ModelsKeranjang::find($id) : $request->user()->keranjang->find($id);
        if ($keranjang == null) return response(['message' => 'Cart not found!'], 404);
        if ($keranjang->delete()) return response(['message' => 'Success!']);
        return response(['message' => 'Failed!'], 500);
    }
}
