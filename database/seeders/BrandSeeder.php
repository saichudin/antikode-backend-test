<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'name' => 'Antikode',
            'logo' => 'logo-tanpa-file.png',
            'banner' => 'banner-tanpa-file.png'
        ]);

        Brand::create([
            'name' => 'Kilo',
            'logo' => 'logo-kilo-file.png',
            'banner' => 'banner-kilo-file.png'
        ]);
    }
}
