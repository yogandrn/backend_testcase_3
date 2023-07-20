<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // relasi dengan tabel shopping_carts
    public function shopping_carts() {
        return $this->hasMany(ShoppingCart::class, 'user_id', 'id');
    }

    // relasi dengan tabel transactions
    public function transactions() {
        return $this->hasMany(Transaction::class, 'user_id', 'id');
    }

    // format datetime
    protected function serializeDate($date) {
        return $date->format('Y-m-d H:i:s');
    }
}
