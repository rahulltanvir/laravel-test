<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

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


    // Order Confirm
    public function confirmOrder($id)
    {
        $order = Order::findOrFail($id);

        $order->status = 'confirmed';
        $order->save();

        return redirect()->back()
                         ->with('success', 'Order Confirmed Successfully');
    }


    // Generate Invoice PDF
    public function invoice($id)
    {
        $order = Order::with('items.product')
                      ->findOrFail($id);


        $pdf = Pdf::loadView(
            'admin.orderlist.invoice-pdf',
            compact('order')
        );


        return $pdf->stream('invoice-'.$order->id.'.pdf');
    }
}