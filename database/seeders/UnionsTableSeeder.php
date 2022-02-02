<?php

namespace Database\Seeders;

use App\Models\Union;
use App\Models\Upazilla;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UnionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/unions.json");
        $unions = json_decode($json);

        foreach ($unions as $key => $union) {
            Union::create([
                'upazilla_id'=> $union->upazilla_id,
                'name'=> $union->name,
                'bn_name'=> $union->bn_name,
            ]);
        }
    }
}
