<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class Cardcontroller extends Controller
{
    // ================= ADD TO CART =================
    public function index(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            $cart[$id]['quantity'] += $request->product_qty;

        } else {

            $cart[$id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => $product->sale_price,
                'image'    => $product->thumbnail,
                'quantity' => $request->product_qty,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart');
    }

    // ================= SHOW CART =================
    public function show()
    {
        $cartItems = session('cart', []);

        $cartTotal = 0;

        foreach ($cartItems as $item) {
            $cartTotal += $item['price'] * $item['quantity'];
        }

        $tax = ($cartTotal * 10) / 100;

        $shippingCost = 200;

        $grandTotal = $cartTotal + $tax + $shippingCost;

        return view('website.card.index', compact(
            'cartItems',
            'cartTotal',
            'tax',
            'shippingCost',
            'grandTotal'
        ));
    }

    // ================= UPDATE QTY =================
    public function updateQty(Request $request)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$request->id])) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        if ($request->action == 'increase') {
            $cart[$request->id]['quantity']++;
        }

        elseif ($request->action == 'decrease') {
            if ($cart[$request->id]['quantity'] > 1) {
                $cart[$request->id]['quantity']--;
            }
        }

        session()->put('cart', $cart);

        // line total
        $lineTotal = $cart[$request->id]['price'] * $cart[$request->id]['quantity'];

        // cart totals
        $cartTotal = 0;

        foreach ($cart as $item) {
            $cartTotal += $item['price'] * $item['quantity'];
        }

        $tax = ($cartTotal * 10) / 100;
        $shippingCost = 200;
        $grandTotal = $cartTotal + $tax + $shippingCost;

        return response()->json([
            'quantity'     => $cart[$request->id]['quantity'],
            'lineTotal'    => $lineTotal,
            'cartTotal'    => $cartTotal,
            'tax'          => $tax,
            'shippingCost' => $shippingCost,
            'grandTotal'   => $grandTotal,
        ]);
    }

    // ================= REMOVE ITEM =================
    public function remove(Request $request)
    {
        $id = $request->id;

        $cart = session()->get('cart', []);

if (isset($cart[$id])) {
    unset($cart[$id]);
    session()->put('cart', $cart);
}

// recalc
$cartTotal = 0;

foreach ($cart as $item) {
    $cartTotal += $item['price'] * $item['quantity'];
}

$tax = ($cartTotal * 10) / 100;
$shippingCost = 200;
$grandTotal = $cartTotal + $tax + $shippingCost;

// IMPORTANT: empty cart case handle
if (count($cart) == 0) {
    $tax = 0;
    $shippingCost = 0;
    $grandTotal = 0;
}

return response()->json([
    'status'       => 'success',
    'cartTotal'    => $cartTotal,
    'tax'          => $tax,
    'shippingCost' => $shippingCost,
    'grandTotal'   => $grandTotal
]);
    }
}