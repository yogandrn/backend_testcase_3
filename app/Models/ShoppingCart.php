<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;
    
    protected $table = 'shopping_carts';

    protected $guarded = ['id'];

    protected $with = ['product']; // menyertakan data relasi product setiap model diinisialisasi

    // relasi ke tabel products
    public function product() {
        return $this->hasOne(Product::class, 'product_id', 'id');
    }

    // format datetime
    protected function serializeDate($date) {
        return $date->format('Y-m-d H:i:s');
    }
}
