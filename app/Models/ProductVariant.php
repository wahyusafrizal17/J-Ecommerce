<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/ProductVariant.php
class ProductVariant extends Model
{
    protected $fillable = [
        'product_id', 'color', 'size', 'number_variant', 'stock'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}

