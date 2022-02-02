<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perm1 = new Permission();
        $perm1->name = 'manage_admin';
        $perm1->description = 'Can create, edit or delete an admin';
        $perm1->save();

        $perm2 = new Permission();
        $perm2->name = 'manage_settings';
        $perm2->description = 'Can manage settings';
        $perm2->save();

        $perm3 = new Permission();
        $perm3->name = 'manage_machine';
        $perm3->description = 'Can manage machine';
        $perm3->save();
    }
}
