<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FileUpload;
use App\Models\Role;
use App\Models\User;
use App\Models\UserProfile;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        $except_ids = Auth::guard('sanctum')->user()->id;
        $users = $this->user->all([$except_ids]);

        if ($users) {
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

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|string|unique:users,email',
            'phone' => 'nullable|unique:users,phone',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
            'role_id' => 'required',
            'photo' => 'nullable|mimes:jpg,png,jpeg,gif|max:350'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }

        //store user
        $user = $this->user->store($request);

        if ($user->save()) {
            $this->user->createProfile($request, $user->id);
            $profile = $user->profile;

            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'Congratulations! Admin user saved successfully',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to store user'
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->input('user_id');
        $rules = [
            'user_id' => 'required',
            'name' => 'required',
            'email' => 'required|string|unique:users,email,'.$id,
            'phone' => 'nullable|unique:users,phone,'.$id,
            'role_id' => 'required',
        ];

        if ($request->input('photo') && $request->input('photo') != 'null') {
            $rules['photo'] = 'nullable|mimes:jpg,jpeg,png,gif';
        }

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }

        //store user
        $user = $this->user->update($request, $id);

        if ($user->save()) {
            if ($user->profile) {
                $this->user->updateProfile($request, $user->profile->id);
            } else {
                $this->user->createProfile($request, $id);
            }
            $profile = $user->profile;

            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'Congratulations! Admin user updated successfully',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to update user'
        ]);
    }

    public function destroy($id)
    {
        if ($this->user->delete($id)) {
            return response()->json([
                'status' => true,
                'message' => 'Deleted successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to delete user'
        ]);
    }

    public function roles()
    {
        $roles = Role::with('permissions')->orderBy('name', 'ASC')->get();

        if ($roles->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'roles' => $roles
            ]);
        }

        return response()->json([
            'status' => false,
            'roles' => $roles,
            'message' => "No roles list found"
        ]);
    }

}
