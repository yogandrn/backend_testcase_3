<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $table = 'sellers';

    protected $guarded = ['id'];
    
    // relasi ke tabel products
    public function products() {
        return $this->hasMany(Product::class, 'seller_id', 'id');
    }

    protected function serializeDate($date) {
        return $date->format('Y-m-d H:i:s');
    }
}
