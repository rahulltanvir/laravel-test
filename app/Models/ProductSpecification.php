<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSpecification extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'spec_key',
        'spec_value',
    ];

    // relation
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}