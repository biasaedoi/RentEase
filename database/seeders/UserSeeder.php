<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin RentEase',
            'email' => 'admin@rentease.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);

        User::factory()->count(5)->create();
    }
}
