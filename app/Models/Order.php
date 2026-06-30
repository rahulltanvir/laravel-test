<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [

        'name',
        'phone',
        'email',

        'division',
        'district',
        'upazila',
        'address',

        'note',

        'payment_method',
        'payment_status',
        'sender_number',
        'transaction_id',

        'subtotal',
        'tax',
        'shipping_cost',
        'grand_total',

        'status',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}