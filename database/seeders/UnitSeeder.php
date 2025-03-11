<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            'Pcs',
            'Paket',
            'Lusin',
            'Pasang',
        ])->each(function ($name) {
            Unit::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}
