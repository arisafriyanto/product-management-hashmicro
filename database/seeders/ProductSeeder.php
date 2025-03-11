<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run()
    {
        collect([
            [
                'category_id' => 1,
                'unit_id' => 1,
                'code' => 'PRD-W6ITLOOX',
                'name' => 'Kaos Polos Premium',
                'price' => 120000.00,
                'stock' => 27,
            ],
            [
                'category_id' => 2,
                'unit_id' => 4,
                'code' => 'PRD-AH5O84JH',
                'name' => 'Sepatu Sneakers Casual',
                'price' => 250000.00,
                'stock' => 99,
            ],
            [
                'category_id' => 5,
                'unit_id' => 1,
                'code' => 'PRD-ZAVTCFPI',
                'name' => 'Kemeja Formal Slim',
                'price' => 140000.00,
                'stock' => 148,
            ],
            [
                'category_id' => 6,
                'unit_id' => 3,
                'code' => 'PRD-U969LSVY',
                'name' => 'Celana Jeans Stretch',
                'price' => 125000.00,
                'stock' => 12,
            ],
            [
                'category_id' => 1,
                'unit_id' => 1,
                'code' => 'PRD-N5U4PJ8L',
                'name' => 'Jaket Hoodie Unisex',
                'price' => 230000.00,
                'stock' => 34,
            ],
        ])->each(function ($product) {
            Product::create([
                'category_id' => $product['category_id'],
                'unit_id' => $product['unit_id'],
                'code' => $product['code'],
                'name' => $product['name'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}
