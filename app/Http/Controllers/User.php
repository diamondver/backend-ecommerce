<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class User extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = ModelsUser::where('nama', 'like', '%' . $request->search . '%')->paginate(10);
        return response($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nama' => 'required|string',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string'
        ]);
        if ($validation->fails()) return response($validation->getMessageBag());
        $user = ModelsUser::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->username,
            'password' => Hash::make($request->password)
        ]);
        return response([
            'data' => $user
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
        $user = ModelsUser::find($id);
        if ($user == null) return response(['message' => 'User not found!'], 404);
        return response([
            'data' => $user
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
            'nama' => 'nullable|string',
            'username' => 'nullable|unique:users,username',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'nullable|string',
            'confirm_password' => 'required|string'
        ]);
        if ($validator->fails()) return response($validator->getMessageBag());
        $user = ModelsUser::find($id);
        if ($user == Null) return response(['message' => 'User not found!'], 404);
        if (!Hash::check($request->confirm_password, $user->password)) return response(['message' => 'Password is wrong!']);
        $user->nama = $request->nama ? $request->nama : $user->nama;
        $user->username = $request->username ? $request->username : $user->username;
        $user->email = $request->email ? $request->email : $user->email;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        return response([
            'data' => $user
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
        $user = ModelsUser::find($id);
        if ($user == Null) return response(['message' => 'User not found!'], 404);
        if ($user->delete()) return response(['message' => 'Success']);
        return response(['message' => 'Failed'], 500);
    }
}
