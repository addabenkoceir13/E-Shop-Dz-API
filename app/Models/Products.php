<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'selling_price',
        'original_price',
        'qty',
        'brand',
        'image',
        'featured',
        'popular',
        'status',
    ];
}
