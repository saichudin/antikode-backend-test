<?php

namespace Database\Seeders;

use App\Models\Outlet;
use Illuminate\Database\Seeder;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Outlet::create([
            'name' => 'Cabang satu',
            'brand_id' => 1,
            'picture' => 'picture-tanpa-file.png',
            'address' => 'Jl. Indah no 25',
            'longitude' => '106.845054',
            'latitude' => '-6.128028'
        ]);
    }
}
