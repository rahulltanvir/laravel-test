<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')
                        ->latest()
                        ->get();

        return view('admin.orderlist.index', compact('orders'));
    }


    public function show($id)
    {
        $order = Order::with('items.product')
                      ->findOrFail($id);

        return view('admin.orderlist.details', compact('order'));
    }
}