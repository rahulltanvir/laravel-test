<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = Order::select('name', 'phone', 'email')
            ->distinct()
            ->count();

        $totalOrders = Order::count();
        $products = Product::count();
        $categories = Category::count();


        return view('admin.home.index', compact(
            'totalCustomers',
            'totalOrders','products','categories'
        ));
    }
}