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
         $sliders = Slider::where('status', 1)
        ->orderBy('serial', 'asc')
        ->get();
        $categories = Category::where('status', 1)
            ->with(['subcategories' => function ($query) {
                $query->where('status', 1);
            }])
            ->get();
        $products = Product::where('status', 1)
            ->latest()
            ->take(8)
            ->get();
        $brands = Brand::all();
        return view('website.home.index', compact('categories', 'products', 'brands', 'sliders'));
    }

    public function category($id)
    {
        $categories = Category::where('status', 1)
            ->with(['subcategories' => function ($query) {
                $query->where('status', 1);
            }])
            ->get();

        $category = Category::where('id', $id)
            ->where('status', 1)
            ->firstOrFail();

        $products = Product::where('category_id', $id)
            ->where('status', 1)
            ->get();

        return view('website.category.index', compact(
            'categories',
            'category',
            'products'
        ));
    }
    public function subcategory($id)
    {
        $subcategory = SubCategory::where('id', $id)
            ->where('status', 1)
            ->firstOrFail();

        $products = Product::where('subcategory_id', $id)
            ->where('status', 1)
            ->get();

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
