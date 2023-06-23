<?php

namespace Database\Seeders;

use App\Models\Price;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Product::factory()->count(50)->create() as $product) {
            $product->prices()->saveMany(Price::factory()->count(rand(1, 3))->make());
        }
    }
}
