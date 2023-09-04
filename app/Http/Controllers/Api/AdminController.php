<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function login(AdminLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $token = Auth::guard('admin')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $admin = Auth::guard('admin')->user();
        return response()->json([
                'status' => 'success',
                'admin' => $admin,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

    }

    public function register(AdminRequest $request){

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($admin);
        return response()->json([
            'status' => 'success',
            'message' => 'Admin created successfully',
            'admin' => $admin,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully admin logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'admin' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function adminList(){
        $admin = Admin::query()->get();

        return response()->json([
            'status' => 'success',
            'admin' => $admin,
     
        ]);
    }
}
