<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'embed_url',
        'thumbnail',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}
