<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class MyCommerceController extends Controller
{
    public function index()
    {
        $categories = Category::with('subcategories')->get();
        $products = Product::latest()->take(8)->get();
        $brands= Brand::all();
        return view('website.home.index', compact('categories','products','brands'));
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
        // $categories = Category::with('subcategories')->get();
$product = Product::findOrFail($id);
        return view('website.detail.index', compact('product'));
    }
 public function checkout()
{
    $cartItems = session('cart', []);

    dd($cartItems);
}
    
    
}