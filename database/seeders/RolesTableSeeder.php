<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perm_superadmin = Permission::get();
        $perm_admin = Permission::whereNotIn('name', ['manage_admin', 'manage_settings'])->get();
        $perm_staff = Permission::whereNotIn('name', ['manage_admin', 'manage_settings'])->get();

        $super_admin = new Role();
        $super_admin->name = 'superadmin';
        $super_admin->description = "Superadmin";
        $super_admin->save();
        $super_admin->attachPermissions($perm_superadmin);

        $admin = new Role();
        $admin->name = 'admin';
        $admin->description = "Admin";
        $admin->save();
        $admin->attachPermissions($perm_admin);

        $staff = new Role();
        $staff->name = 'staff';
        $staff->description = "Staff";
        $staff->save();
        $staff->attachPermissions($perm_staff);
    }
}
