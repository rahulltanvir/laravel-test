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
    'subtotal',
    'tax',
    'shipping_cost',
    'grand_total',
    'status'
];
}
