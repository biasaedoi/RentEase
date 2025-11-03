<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('is_admin', true)->first();

        $products = [
            [
                'name' => 'Kamera Canon EOS 90D',
                'description' => 'Kamera DSLR profesional untuk foto dan video.',
                'price' => 150000,
                'image' => null,
                'user_id' => $admin->id,
            ],
            [
                'name' => 'Laptop MacBook Air M2',
                'description' => 'Laptop ringan dan cepat untuk produktivitas harian.',
                'price' => 250000,
                'image' => null,
                'user_id' => $admin->id,
            ],
            [
                'name' => 'Proyektor Epson XGA',
                'description' => 'Cocok untuk presentasi atau nonton bareng.',
                'price' => 120000,
                'image' => null,
                'user_id' => $admin->id,
            ],
            [
                'name' => 'Drone DJI Mini 3 Pro',
                'description' => 'Drone dengan kamera 4K dan stabilisasi tinggi.',
                'price' => 200000,
                'image' => null,
                'user_id' => $admin->id,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}