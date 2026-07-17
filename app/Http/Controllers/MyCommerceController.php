<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class MyCommerceController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 1)->latest()->get();
        $categories = Category::with('subcategories')->get();
        $products = Product::latest()->take(8)->get();
        $brands= Brand::all();
        return view('website.home.index', compact('categories','products','brands','sliders'));
    }

    public function category($id)
{
    $categories = Category::with('subcategories')->get();

    $category = Category::findOrFail($id);

    $products = Product::where('category_id', $id)->get();

    return view('website.category.index', compact(
        'categories',
        'category',
        'products'
    ));
}
public function subcategory($id)
{
    $subcategory = SubCategory::findOrFail($id);

    $products = Product::where('subcategory_id', $id)->get();

    return view('website.category.index', compact('subcategory', 'products'));
}

    public function detail($id)
    {
        
$product = Product::findOrFail($id);
        return view('website.detail.index', compact('product'));
    }
 public function checkout()
{
    $cartItems = session('cart', []);

    dd($cartItems);
}
    
    
}