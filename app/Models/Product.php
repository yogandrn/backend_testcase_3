<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $guarded = ['id'];

    protected $with = ['category', 'seller', 'galleries']; // menyertakan data relasi dengan category dan gallery setiap model diinisialisasi

    // relasi dengan table categories
    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // relasi dengan table sellers
    public function seller() {
        return $this->belongsTo(Seller::class, 'seller_id', 'id');
    }

    // relasi dengan table galleries
    public function galleries() {
        return $this->hasMany(Gallery::class, 'product_id', 'id');
    }

    // format datetime
    protected function serializeDate($date) {
        return $date->format('Y-m-d H:i:s');
    }

}
