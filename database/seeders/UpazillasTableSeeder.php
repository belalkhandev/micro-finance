<?php

namespace Database\Seeders;

use App\Models\Upazilla;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UpazillasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/upazillas.json");
        $upazillas = json_decode($json);

        foreach ($upazillas as $key => $upazilla) {
            Upazilla::create([
                'district_id'=> $upazilla->district_id,
                'name'=> $upazilla->name,
                'bn_name'=> $upazilla->bn_name,
            ]);
        }
    }
}
