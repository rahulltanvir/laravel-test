<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class CustomerDashboardController extends Controller
{
    public function index()
    {
        $customer = auth('customer')->user();

        $orders = Order::where('email', $customer->email)
                        ->latest()
                        ->get();

        $totalOrders = $orders->count();
        $pendingOrders = $orders->where('status', 'pending')->count();
        $completedOrders = $orders->where('status', 'confirmed')->count();

        return view('website.customer.dashboard', compact(
            'orders',
            'totalOrders',
            'pendingOrders',
            'completedOrders'
        ));
    }


    public function orders()
{
    $orders = Order::where('email', auth('customer')->user()->email)
                    ->latest()
                    ->get();

    return view('website.customer.orders', compact('orders'));
}
public function orderDetails($id)
{
    $order = Order::with('items.product')
                ->where('id', $id)
                ->where('email', auth('customer')->user()->email)
                ->firstOrFail();

    return view('website.customer.orders-details', compact('order'));
}
public function profile()
{
    $customer = auth('customer')->user();

    return view('website.customer.profile', compact('customer'));
}
public function profileUpdate(Request $request)
{
    $request->validate([
        'name'  => 'required|max:255',
        'phone' => 'nullable|max:20',
        'address' => 'nullable|max:255',
    ]);

    $customer = auth('customer')->user();

    $customer->update([
        'name'    => $request->name,
        'phone'   => $request->phone,
        'address' => $request->address,
    ]);

    return back()->with('success', 'Profile updated successfully.');
}
public function invoice($id)
{
    $order = Order::with('items.product')
        ->where('id', $id)
        ->where('customer_id', auth('customer')->id())
        ->firstOrFail();

    $pdf = Pdf::loadView(
        'admin.orderlist.invoice-pdf',
        compact('order'));

    return $pdf->stream('Invoice-'.$order->id.'.pdf');
}
}