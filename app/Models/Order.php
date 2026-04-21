<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'address',
        'postal_code',
        'items_json',
        'subtotal',
        'shipping_cost',
        'tax',
        'total',
        'status',
        'payment_method'
    ];

    protected $casts = [
        'items_json' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
