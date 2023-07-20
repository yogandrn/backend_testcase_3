<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    
    protected $table = 'transactions';

    protected $guarded = ['id'];

    protected $with = ['user', 'items']; // menyertakan relasi dengan transaction_items setiap model di inisialisasi

    // relasi dengan table users
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // relasi dengan table transaction_items
    public function items() {
        return $this->hasMany(TransactionItem::class, 'transaction_id', 'id');
    }

    // format date
    protected function serializeDate($date) {
        return $date->format('Y-m-d H:i:s');
    }
}
