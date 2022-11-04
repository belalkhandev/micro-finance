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
        $perm = new Permission();
        $perm->name = 'create_admin';
        $perm->description = 'Can create admin';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'edit_admin';
        $perm->description = 'Can edit admin';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'view_admin';
        $perm->description = 'Can view admin';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'delete_admin';
        $perm->description = 'Can delete admin';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'create_member';
        $perm->description = 'Can create member';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'edit_member';
        $perm->description = 'Can edit member';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'view_member';
        $perm->description = 'Can view member';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'delete_member';
        $perm->description = 'Can delete member';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'create_group';
        $perm->description = 'Can create manage settings';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'edit_group';
        $perm->description = 'Can edit group';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'view_group';
        $perm->description = 'Can view group';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'delete_group';
        $perm->description = 'Can delete group';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'create_village';
        $perm->description = 'Can create manage settings';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'edit_village';
        $perm->description = 'Can edit village';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'view_village';
        $perm->description = 'Can view village';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'delete_village';
        $perm->description = 'Can delete village';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'create_post_office';
        $perm->description = 'Can create post office';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'edit_post_office';
        $perm->description = 'Can edit post office';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'view_post_office';
        $perm->description = 'Can view post office';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'delete_post_office';
        $perm->description = 'Can delete post office';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'generate_transaction';
        $perm->description = 'Can generate transaction';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'create_transaction';
        $perm->description = 'Can create transaction';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'edit_transaction';
        $perm->description = 'Can edit transaction';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'view_transaction';
        $perm->description = 'Can view transaction';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'delete_transaction';
        $perm->description = 'Can delete transaction';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'create_application';
        $perm->description = 'Can create application';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'edit_application';
        $perm->description = 'Can edit application';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'view_application';
        $perm->description = 'Can view application';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'delete_application';
        $perm->description = 'Can delete application';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'create_expense';
        $perm->description = 'Can create expense';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'edit_expense';
        $perm->description = 'Can edit expense';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'view_expense';
        $perm->description = 'Can view expense';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'delete_expense';
        $perm->description = 'Can delete expense';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'create_income';
        $perm->description = 'Can create income';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'edit_income';
        $perm->description = 'Can edit income';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'view_income';
        $perm->description = 'Can view income';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'delete_income';
        $perm->description = 'Can delete income';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'create_investment';
        $perm->description = 'Can create investment';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'edit_investment';
        $perm->description = 'Can edit investment';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'view_investment';
        $perm->description = 'Can view investment';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'delete_investment';
        $perm->description = 'Can delete investment';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'create_donation';
        $perm->description = 'Can create donation';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'edit_donation';
        $perm->description = 'Can edit donation';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'view_donation';
        $perm->description = 'Can view donation';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'delete_donation';
        $perm->description = 'Can delete donation';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'view_report';
        $perm->description = 'Can view report';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'download_report';
        $perm->description = 'Can download report';
        $perm->save();

        $perm = new Permission();
        $perm->name = 'manage_settings';
        $perm->description = 'Can manage settings';
        $perm->save();
    }
}
