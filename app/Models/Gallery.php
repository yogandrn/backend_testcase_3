<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    
    protected $table = 'galleries';

    protected $guarded = ['id'];

    // tambahkan prefix ke image_url
    protected function getImageUrlAttribute($value) {
        return env('APP_URL') .'/' . $value;
    }

    // format datetime
    protected function serializeDate($date) {
        return $date->format('Y-m-d H:i:s');
    }
}
