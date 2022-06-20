<?php

namespace App\Http\Controllers;

use App\Models\Alamat as ModelsAlamat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Alamat extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->currentAccessToken()->name == 'admin') return response(ModelsAlamat::paginate(10));
        return response([
            'data' => $request->user()->alamat
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
            'atas_nama' => 'required|string',
            'alamat' => 'required|string'
        ]);
        if ($validator->fails()) return response($validator->getMessageBag());
        $alamat = ModelsAlamat::create([
            'user_id' => $request->user()->id,
            'atas_nama' => $request->atas_nama,
            'alamat' => $request->alamat
        ]);
        return response([
            'data' => $alamat
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
        $alamat = $request->user()->currentAccessToken()->name == 'admin' ? ModelsAlamat::find($id) : $request->user()->alamat->find($id);
        if ($alamat == null) return response(['message' => 'Address not found!'], 404);
        return response([
            'data' => $alamat
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
            'atas_nama' => 'string',
            'alamat' => 'string'
        ]);
        if ($validator->fails()) return response($validator->getMessageBag());
        $alamat = $request->user()->currentAccessToken()->name == 'admin' ?  ModelsAlamat::find($id) : $request->user()->alamat->find($id);
        if ($alamat == null) return response(['message' => 'Address not found!'], 404);
        $alamat->atas_nama = $request->atas_nama ? $request->atas_nama : $alamat->atas_nama;
        $alamat->alamat = $request->alamat ? $request->alamat : $alamat->alamat;
        $alamat->save();
        return response([
            'data' => $alamat
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
        $alamat = $request->user()->currentAccessToken()->name == 'admin' ? $alamat = ModelsAlamat::find($id) : $request->user()->alamat->find($id);
        if ($alamat->delete()) return response(['message' => 'Success!']);
        return response(['message' => 'Failed!'], 500);
    }
}
