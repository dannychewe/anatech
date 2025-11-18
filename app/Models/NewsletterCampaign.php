<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterCampaign extends Model
{
    protected $fillable = ['subject','html','text','sent_at'];
    protected $casts = ['sent_at' => 'datetime'];
}