<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
       'category_name_en',
        'category_name_ind',
        'category_slug_en',
        'category_slug_ind',
        'category_item',
    ];

    public function products()
    {
        return $this->hasMany(Products::class, 'category_id'); // Sesuaikan dengan nama model produk Anda (Products.php)
    }
}
