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
            'seller_id' => 2,
            'category_id' => 1,
            'name' => 'Logitech H111 Headset Stereo Single Jack 3.5mm',
            'price' => 80000,
            'stock' => 109,
            'description' => 'Lorem ipsum dolor sit amet.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Product::create([
            'seller_id' => 1,
            'category_id' => 1,
            'name' => 'Philips Rice Cooker - Inner Pot 2L Bakuhanseki - HD3110/33',
            'price' => 325000,
            'stock' => 12,
            'description' => 'Lorem ipsum dolor sit amet.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Product::create([
            'seller_id' => 2,
            'category_id' => 4,
            'name' => 'Iphone 12 64Gb/128Gb/256Gb Garansi Resmi IBOX/TAM - Hitam, 64Gb',
            'price' => 11340000,
            'stock' => 22,
            'description' => 'Lorem ipsum dolor sit amet.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Product::create([
            'seller_id' => 1,
            'category_id' => 5,
            'name' => 'Papan alat bantu Push Up Rack Board Fitness Workout Gym',
            'price' => 90000,
            'stock' => 99,
            'description' => 'Lorem ipsum dolor sit amet.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Product::create([
            'seller_id' => 1,
            'category_id' => 2,
            'name' => 'Jim Joker - Sandal Slide Kulit Pria Bold 2S Hitam - Hitam',
            'price' => 129000,
            'stock' => 56,
            'description' => 'Lorem ipsum dolor sit amet.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
