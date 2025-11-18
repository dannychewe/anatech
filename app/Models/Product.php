<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'image',
        'is_featured',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];


    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

}
