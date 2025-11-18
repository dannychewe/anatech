<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $fillable = [
        'email','name','status','confirm_token','confirm_token_expires_at',
        'subscribed_at','unsubscribed_at'
    ];

    protected $casts = [
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
        'confirm_token_expires_at' => 'datetime',
    ];

    public function scopeSubscribed($q) {
        return $q->where('status', 'subscribed');
    }
}