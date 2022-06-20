<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class Auth extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) return response($validator->getMessageBag());
        $user = User::where('username', $request->username)->first();
        if ($user == null) return response(['message' => 'Username or Password is wrong!']);
        if (!Hash::check($request->password, $user->password)) return response(['message' => 'Username or Password is wrong']);
        return response(['token' => $user->createToken('user')->plainTextToken]);
    }

    public function loginAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) return response($validator->getMessageBag());
        $admin = Admin::where('username', $request->username)->first();
        if ($admin == null) return response(['message' => 'Username or Password is wrong!']);
        if (!Hash::check($request->password, $admin->password)) return response(['message' => 'Username or Password is wrong']);
        return response(['token' => $admin->createToken('admin')->plainTextToken]);
    }

    public function logout(Request $request)
    {
        if ($request->user()->currentAccessToken()->delete()) return response(['message' => 'Logged Out!']);
    }
}
