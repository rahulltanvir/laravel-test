<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    // ================= SHIPPING CALCULATION =================
    private function getShippingCost($totalWeight)
    {
        if ($totalWeight <= 1) {
            return 80;
        } elseif ($totalWeight <= 3) {
            return 150;
        } elseif ($totalWeight <= 5) {
            return 250;
        }

        return 400;
    }

    // ================= CHECKOUT PAGE =================
    public function index()
    {
        $cartItems = session('cart', []);

        $cartTotal = 0;
        $totalWeight = 0;

        foreach ($cartItems as $item) {
            $cartTotal += $item['price'] * $item['quantity'];

            $totalWeight += ($item['product_weight'] ?? 0) * $item['quantity'];
        }

        $tax = ($cartTotal * 10) / 100;

        $shippingCost = $this->getShippingCost($totalWeight);

        $grandTotal = $cartTotal + $tax + $shippingCost;

        return view('website.checkout.index', compact(
            'cartItems',
            'cartTotal',
            'tax',
            'shippingCost',
            'grandTotal'
        ));
    }

    // ================= STORE ORDER =================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'division' => 'required',
            'district' => 'required',
            'upazila' => 'required',
            'address' => 'required',
            'payment_method' => 'required',
        ]);

        $cartItems = session('cart', []);

        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        $cartTotal = 0;
        $totalWeight = 0;

        foreach ($cartItems as $item) {
            $cartTotal += $item['price'] * $item['quantity'];

            $totalWeight += ($item['product_weight'] ?? 0) * $item['quantity'];
        }

        $tax = ($cartTotal * 10) / 100;

        $shippingCost = $this->getShippingCost($totalWeight);

        $grandTotal = $cartTotal + $tax + $shippingCost;

        // ================= ORDER CREATE =================
        $order = Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,

            'division' => $request->division,
            'district' => $request->district,
            'upazila' => $request->upazila,
            'address' => $request->address,

            'note' => $request->note,

            'payment_method' => $request->payment_method,

            'subtotal' => $cartTotal,
            'tax' => $tax,
            'shipping_cost' => $shippingCost,
            'grand_total' => $grandTotal,
        ]);

        // ================= ORDER ITEMS =================
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);

            // stock decrease (safe)
            $product = Product::find($item['id']);

            if ($product) {
                $product->decrement('stock', $item['quantity']);
            }
        }

        // ================= CLEAR CART =================
        session()->forget('cart');

        // ================= REDIRECT SUCCESS =================
        return redirect()
            ->route('success')
            ->with('success', 'Order placed successfully!');
    }
}