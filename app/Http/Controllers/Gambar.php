<?php

namespace App\Http\Controllers;

use App\Models\Gambar as ModelsGambar;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Gambar extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gambar = ModelsGambar::paginate(10);
        return response([
            'data' => $gambar
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
            'nama_file' => 'required|file|mimes:png,jpg',
            'isCover' => 'nullable|string|boolean',
            'produk_id' => 'required|numeric'
        ]);
        if ($validator->fails()) return response($validator->getMessageBag());
        if (!Produk::find($request->produk_id)) return response(['message' => 'Product not found!'], 404);
        $gambar = $request->file('nama_file')->store('public');
        $data = ModelsGambar::create([
            'nama_file' => url(Storage::url($gambar)),
            'isCover' => $request->isCover,
            'produk_id' => $request->produk_id
        ]);
        return response([
            'data' => $data
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
        $gambar = ModelsGambar::find($id);
        if (!$gambar) return response(['message' => 'Picture not found!'], 404);
        $gambar->nama_file = url(Storage::url($gambar->nama_file));
        return response([
            'data' => $gambar
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
            'nama_file' => 'nullable|mimes:png,jpg',
            'isCover' => 'nullable|boolean',
            'produk_id' => 'nullable|numeric'
        ]);
        if ($validator->fails()) return response($validator->getMessageBag());
        if ($request->produk_id && !Produk::find($request->produk_id)) return response(['message' => 'Product not found!']);
        $gambar = ModelsGambar::find($id);
        if ($request->nama_file) {
            $file = $request->file('nama_file')->store('public');
            Storage::delete($gambar->nama_file);
        }
        $gambar->nama_file = isset($file) ? $file : $gambar->nama_file;
        $gambar->isCover = $request->isCover == null ? $gambar->isCover : $request->isCover;
        $gambar->produk_id = $request->produk_id ? $request->produk_id : $gambar->produk_id;
        $gambar->save();
        $gambar->nama_file = url(Storage::url($gambar->nama_file));
        return response([
            'data' => $gambar
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
        $gambar = ModelsGambar::find($id);
        if (!$gambar) return response(['message' => 'Picture not found!']);
        Storage::delete($gambar->nama_file);
        if ($gambar->delete()) return response(['message' => 'Success!']);
        return response(['message' => 'Failed!'], 500);
    }
}
