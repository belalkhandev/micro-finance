<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FileUpload;
use App\Models\Role;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::whereNotIn('id',[ Auth::guard('sanctum')->user()->id])->get();

        if ($users->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'users' => $users
            ]);
        }

        return response()->json([
            'status' => false,
            'users' => null,
            'message' => "No users found"
        ]);
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
            'role_id' => 'required'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ], 422);
        }

        try {
            $user = new User();
            $user->name = $request->get('name');
            $user->phone = $request->get('phone');
            $user->email = $request->get('email');
            $user->password = app('hash')->make($request->input('password'));
            $user->created_by = app()->user()->id;

            if($user->save()) {
                //attach role with user
                $user->attachRole(Role::find($request->input('role_id'))->first());

                //upload profile
                $profile = new UserProfile();
                $profile->user_id = $user->id;
                // $profile->gender = $request->input('gender');
                // $profile->birthdate = $request->input('birthdate');
                // $profile->address = $request->input('address');
                if ($request->hasFile('photo')) {
                    $path = FileUpload::upload($request, 'photo', 'admins');
                    $profile->photo = $path;
                }

                $profile->save();

                return response()->json([
                    'status' => true,
                    'user' => $user,
                    'message' => 'Congratulations! User registered successfully',
                ]);

            }

            return response()->json([
                'status' => false,
                'user' => null,
                'message' => 'Failed to register user',
            ]);

        }catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong, '. $e->getMessage(),
            ]);
        }
    }

}
