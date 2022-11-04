<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Psr\Http\Message\RequestInterface;
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
            ],);
        }

        // login credentials
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Email or Password'
            ]);
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
        $user->profile;

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

    public function changePassword(Request $request)
    {
        $rules = [
            'current_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ],);
        }

        //check current password
        if(!Hash::check($request->get('current_password'), Auth::guard('sanctum')->user()->password)){
            return response()->json([
                'status' => false,
                'errors' => [
                    'current_password' => ["Current password does not match"]
                ]
            ]);
        }

        try {
            $user = Auth::guard('sanctum')->user();
            $user->password = Hash::make($request->input('password'));

            if ($user->save()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Password changed successfully'
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Failed to change password.'
            ]);

        }catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while changed password.'
            ]);
        }
    }

    public function resetPassword(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ],);
        }

        try {
            $user = User::find($request->input('user_id'));
            $user->password = Hash::make($request->input('password'));

            if ($user->save()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Password changed successfully'
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Failed to change password.'
            ]);

        }catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while changed password.'
            ]);
        }
    }
}
