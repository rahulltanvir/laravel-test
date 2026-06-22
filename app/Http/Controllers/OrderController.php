<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return view(
            'admin.order.index',
            compact('orders')
        );
    }

    public function show($id)
    {
        $order = Order::with('items')
            ->findOrFail($id);

        return view(
            'admin.order.show',
            compact('order')
        );
    }

    public function updateStatus($id)
    {
        $order = Order::findOrFail($id);

        $order->status = 'completed';

        $order->save();

        return back()
            ->with('success','Status Updated');
    }
}