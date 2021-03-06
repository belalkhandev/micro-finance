<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_superadmin = Role::where('name', 'superadmin')->first();
        $role_admin = Role::where('name', 'admin')->first();
        $role_staff = Role::where('name', 'staff')->first();

        $superAdmin = new User();
        $superAdmin->name = 'Super Admin';
        $superAdmin->email = 'superadmin@pdscdcsl.dev';
        $superAdmin->password = bcrypt('!@#Dp796@#!');
        $superAdmin->save();
        $superAdmin->attachRole($role_superadmin);

        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@becodezen.com';
        $admin->password = bcrypt('!@#Dp796@#!');
        $admin->save();
        $admin->attachRole($role_admin);

        $staff = new User();
        $staff->name = 'Staff';
        $staff->email = 'staff@becodezen.com';
        $staff->password = bcrypt('!@#Dp796@#!');
        $staff->save();
        $staff->attachRole($role_staff);
    }
}
