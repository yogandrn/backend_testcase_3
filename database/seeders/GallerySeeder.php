<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gallery::create([
            'product_id' => 1,
            'image_url' => 'files/images/products/logitech.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Gallery::create([
            'product_id' => 2,
            'image_url' => 'files/images/products/logitech.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Gallery::create([
            'product_id' => 3,
            'image_url' => 'files/images/products/logitech.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Gallery::create([
            'product_id' => 4,
            'image_url' => 'files/images/products/logitech.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Gallery::create([
            'product_id' => 5,
            'image_url' => 'files/images/products/logitech.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
