<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'price',
        'description',
        'button_text',
        'button_link',
        'image',
        'serial',
        'status',
    ];
}
