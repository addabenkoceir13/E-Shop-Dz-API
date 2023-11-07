<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $fillable = [
        'slug',
        'name',
        'desription',
        'status',
        'meta_title',
        'meta_ceywords',
        'meta_description',
        'created_at',
        'updated_at',
    ];
}
