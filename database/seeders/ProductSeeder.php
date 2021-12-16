<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Kemeja',
            'brand_id' => 1,
            'picture' => 'picture-tanpa-file.jpg',
            'price' => 120000,
        ]);
    }
}
