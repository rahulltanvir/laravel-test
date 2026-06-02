<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;

class MyCommerceController extends Controller
{
    public function index()
    {
        $categories = Category::with('subcategories')->get();
        $products = Product::latest()->take(8)->get();
        return view('website.home.index', compact('categories','products'));
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

    public function detail($id)
    {
        // $categories = Category::with('subcategories')->get();
$product = Product::findOrFail($id);
        return view('website.detail.index', compact('product'));
    }
}