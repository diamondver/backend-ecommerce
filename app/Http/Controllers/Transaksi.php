<?php

namespace App\Http\Controllers;

use App\Models\Detail_Transaksi;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Transaksi as ModelsTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Transaksi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transaksi = $request->user()->transaksi;
        if ($request->user()->currentAccessToken()->name == 'admin') $transaksi = ModelsTransaksi::paginate(10);
        return response([
            'data' => $transaksi
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
        // Validasi untuk mencegah request yang tidak diinginkan
        $validator = Validator::make($request->all(), [
            'keranjang_id' => 'required|array',
            'keranjang_id.*' => 'numeric',
            'alamat_id' => 'required|numeric'
        ]);
        if ($validator->fails()) return response($validator->getMessageBag());

        // Mengecek apakah alamat tersedia atau tidak
        if (!$request->user()->alamat->find($request->alamat_id)) return response(['message' => 'Address not found!'], 404);

        // Mengambil semua keranjang yang ada pada request keranjang_id[]
        $keranjang = Keranjang::whereIn('id', $request->keranjang_id)->where('user_id', $request->user()->id)->get();

        // Mengecek apakah ada produk di keranjang atau tidak
        if (!count($keranjang)) return response(['message' => 'Cart can\'t empty!']);

        // Mengecek apakah stok barang tersedia atau tidak.
        // Jika tidak tersedia maka akan mengirim response
        $stokProblem = [];
        $i = 0;
        foreach($keranjang as $k) {
            if ($k->produk->stok < $k->jml_beli) $stokProblem[$i++] = $k->produk->nama_produk;
        }
        if (count($stokProblem)) return response(['message' => "Stock item of " . implode(', ', $stokProblem) . ' are not enough!']);

        // Menghitung total harga
        $total_harga = 0;
        foreach($keranjang as $k) {
            $total_harga += $k->produk->harga * $k->jml_beli;
        }

        // Membuat data transaksi
        $transaksi = ModelsTransaksi::create([
            'total_harga' => $total_harga,
            'alamat_id' => $request->alamat_id,
            'user_id' => $request->user()->id
        ]);
        foreach($keranjang as $k) {
            Detail_Transaksi::create([
                'produk_id' => $k->produk->id,
                'transaksi_id' => $transaksi->id,
                'harga' => $k->produk->harga,
                'jml_beli' => $k->jml_beli
            ]);
            $produk = Produk::find($k->produk->id);
            $produk->decrement('stok', $k->jml_beli);
            $k->delete();
        }
        $transaksi->detail_transaksi;
        $transaksi->alamat;
        return response([
            'data' => $transaksi
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
        $transaksi = $request->user()->transaksi->find($id);
        if ($request->user()->currentAccessToken()->name == 'admin') $transaksi = ModelsTransaksi::find($id);
        if ($transaksi == null) return response(['message' => 'Transaction not found!'], 404);
        return response([
            'data' => $transaksi
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
