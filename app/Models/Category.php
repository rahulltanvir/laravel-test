<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\SubCategory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'status',

    ];
 public function subcategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id')
                    ->where('status', 1);
    }
}
