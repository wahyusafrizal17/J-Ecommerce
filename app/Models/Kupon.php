<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kupon extends Model
{
    protected $fillable = [
        'kupon_name',
        'kupon_discount', 
        'kupon_validity'
    ];

    protected $dates = ['kupon_validity'];
}
