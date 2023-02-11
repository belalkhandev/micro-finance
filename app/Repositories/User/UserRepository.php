<?php

namespace App\Repositories\User;

use App\Models\FileUpload;
use App\Models\Role;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface {

    public function all($excepts_ids)
    {
        $users = User::with('profile')->whereNotIn('id', $excepts_ids)->get();
        if ($users->isNotEmpty()) {
            return $users;
        }

        return false;
    }

    public function store($request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->password = app('hash')->make($request->input('password'));
        $user->created_by = Auth::guard('sanctum')->user()->id;
        if ($user->save()) {
            $user->attachRole(Role::find($request->input('role_id'))->first());

            return $user;
        }

        return false;
    }

    public function update($request, $user_id)
    {
        $user = User::find($user_id);
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');

        if ($request->input('password')) {
            $user->password = app('hash')->make($request->input('password'));
        }

        $user->updated_by = Auth::guard('sanctum')->user()->id;
        if ($user->save()) {
            if ($user->roles()->first()->id != $request->input('role_id')) {
                $user->detachRole(Role::find($request->input('role_id'))->first());
            }
            $user->attachRole(Role::find($request->input('role_id'))->first());

            return $user;
        }

        return false;
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user->profile) {
            if ($user->profile->photo) {
                unlink($user->profile->photo);
            }
        }

        if ($user->delete()) {
            return true;
        }

        return false;
    }

    public function find($id)
    {
        $user = User::find($id);

        if ($user) {
            return $user;
        }

        return false;
    }

    public function createProfile($request, $user_id)
    {
        $profile = new UserProfile();
        $profile->user_id = $user_id;

        //store user photo
        if ($request->hasFile('photo')) {
            $path = FileUpload::uploadWithResize($request, 'photo', 'users', 200, 200);
            $profile->photo = $path;
        }

        if ($profile->save()) {
            return $profile;
        }

        return false;
    }

    public function updateProfile($request, $profile_id)
    {
        $profile = UserProfile::find($profile_id);

        $profile->gender = $request->input('gender');
        $profile->address = $request->input('address');
        $profile->birthdate = $request->input('birthdate');
        //store user photo
        if ($request->hasFile('photo')) {
            //delete previous profile photo
            if ($profile->photo) {
                unlink($profile->photo);
            }

            $path = FileUpload::uploadWithResize($request, 'photo', 'users', 200, 200);
            $profile->photo = $path;
        }

        if ($profile->save()) {
            return $profile;
        }

        return false;
    }
}
