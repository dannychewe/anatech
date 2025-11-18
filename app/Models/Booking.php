<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'service_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'location',
        'quantity',
        'price_per_unit',   // <-- Added
        'total_price',      // <-- Added
        'start_date',
        'end_date',
        'notes',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
