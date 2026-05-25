<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'category_id',
        'subcategory_id',
        'brand_id',
        'unit_id',

        'name',
        'slug',

        'sku',
        'product_code',

        'stock',

        'regular_price',
        'sale_price',
        'discount',

        'short_description',
        'long_description',

        'thumbnail',

        'featured',
        'status',
    ];

    // Multiple Images
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Specifications
    public function specifications()
    {
        return $this->hasMany(ProductSpecification::class);
    }

    // Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // SubCategory
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    // Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Unit
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}