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

    public function category()
    {
        // $categories = Category::with('subcategories')->get();

        // return view('website.category.index', compact('categories'));
    }

    public function detail()
    {
        // $categories = Category::with('subcategories')->get();

        // return view('website.detail.index', compact('categories'));
    }
}