<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ];

        $validation = Validator::make($request->all(), $rules);
        
        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ], 422);
        }

        // login credentials
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Email or Password'
            ], 400);
        }

        $token = $request->user()->createToken($request->email);

        return response()->json([
            'status' => true,
            'token' => $token->plainTextToken,
            'message' => 'Logged in successfully'
        ]);
    }

    public function me(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        if ($user) {
            return response()->json([
                'status' => true,
                'user' => $user,
                'role' => $user->role,
                'permissions' => $user->role->permissions
            ]); 
        }

        return response()->json([
            'status' => false,
            'user' => null,
        ]);
    }

    public function logout()
    {
        Auth::guard('sanctum')->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout successfully'
        ]); 
    }
}
