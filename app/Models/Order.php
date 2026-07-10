<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [

        'customer_id',

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


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}