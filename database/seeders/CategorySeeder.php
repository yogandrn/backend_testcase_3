<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Elektronik',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Category::create([
            'name' => 'Fashion Pria',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Category::create([
            'name' => 'Fashion Wanita',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Category::create([
            'name' => 'Handphone dan Tablet',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Category::create([
            'name' => 'Olahraga',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
