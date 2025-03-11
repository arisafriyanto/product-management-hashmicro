<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = collect([
            ['name' => 'Aris', 'email' => 'aris@example.com'],
            ['name' => 'Oktavia', 'email' => 'oktavia@example.com'],
            ['name' => 'Salsha', 'email' => 'salsha@example.com'],
            ['name' => 'Putri', 'email' => 'putri@example.com'],
            ['name' => 'Clara', 'email' => 'clara@example.com'],
        ]);

        $users->each(function ($user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}
