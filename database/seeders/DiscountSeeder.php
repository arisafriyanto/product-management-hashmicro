<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discount;
use Carbon\Carbon;

class DiscountSeeder extends Seeder
{
    public function run()
    {
        collect([
            [
                'code' => 'BX0019SD',
                'name' => 'blackfriday',
                'type' => 'percentage',
                'value' => 10.00,
                'min_purchase' => 100000.00,
                'valid_from' => '2025-03-11',
                'valid_until' => '2025-03-15',
            ],
            [
                'code' => 'PM879SO',
                'name' => 'newyear',
                'type' => 'fixed',
                'value' => 23000.00,
                'min_purchase' => 50000.00,
                'valid_from' => '2025-03-13',
                'valid_until' => '2025-03-16',
            ],
            [
                'code' => 'V14PSO87D',
                'name' => 'valentine',
                'type' => 'percentage',
                'value' => 8.00,
                'min_purchase' => null,
                'valid_from' => '2025-02-14',
                'valid_until' => '2025-03-31',
            ],
            [
                'code' => '4LLDAY5',
                'name' => 'alldays',
                'type' => 'fixed',
                'value' => 15000.00,
                'min_purchase' => 10000.00,
                'valid_from' => null,
                'valid_until' => null,
            ],
        ])->each(function ($discount) {
            Discount::create([
                'code' => $discount['code'],
                'name' => $discount['name'],
                'type' => $discount['type'],
                'value' => $discount['value'],
                'min_purchase' => $discount['min_purchase'],
                'valid_from' => $discount['valid_from'] ? Carbon::parse($discount['valid_from']) : null,
                'valid_until' => $discount['valid_until'] ? Carbon::parse($discount['valid_until']) : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}
