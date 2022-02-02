<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/districts.json");
        $districts = json_decode($json);

        foreach ($districts as $key => $district) {
            District::create([
                'division_id'=> $district->division_id,
                'name'=> $district->name,
                'bn_name'=> $district->bn_name,
                'lat'=> $district->lat,
                'lon'=> $district->lon,
            ]);
        }
    }
}
