<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DivisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/divisions.json");
        $divisons = json_decode($json);

        foreach ($divisons as $key => $divison) {
            Division::create([
                'name'=> $divison->name,
                'bn_name'=> $divison->bn_name,
            ]);
        }
    }
}
