<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seller::create([
            'name' => 'Toko Barokah',
            'email' => 'barokahshop@gmail.com',
            'phone_number' => '085303299801',
            'location' => 'Kota Surabaya',
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Seller::create([
            'name' => 'A-Cell',
            'email' => 'a.cell@gmail.com',
            'phone_number' => '085234045612',
            'location' => 'Kota Malang',
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
