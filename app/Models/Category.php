<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $guarded = ['id'];

    public function products() {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    // format datetime
    protected function serializeDate($date) {
        return $date->format('Y-m-d H:i:s');
    }

}
