<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    protected $table = 'transaction_items';

    protected $guarded = ['id'];

    protected $with = ['products']; // menyertakan data relasi produk ketika model di initialized

    // relasi ke tabel products
    public function product() {
        return $this->hasMany(Product::class, 'product_id', 'id');
    }

    // format datetime
    protected function serializeDate($date) {
        return $date->format('Y-m-d H:i:s');
    }
}
