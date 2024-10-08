<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'products_id',
    ];

    public function product(){
        return $this->hasOne(Products::class, 'id', 'products_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
