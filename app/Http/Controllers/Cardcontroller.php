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
    'product_weight'   => $product->product_weight,
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
    $totalWeight = 0;

    foreach ($cartItems as $item) {
        $cartTotal += $item['price'] * $item['quantity'];
        $totalWeight += $item['product_weight'] * $item['quantity'];
    }

    $tax = ($cartTotal * 10) / 100;

    // Weight অনুযায়ী Shipping Cost
    if ($totalWeight <= 1) {
        $shippingCost = 80;
    } elseif ($totalWeight <= 3) {
        $shippingCost = 150;
    } elseif ($totalWeight <= 5) {
        $shippingCost = 250;
    } else {
        $shippingCost = 400;
    }

    $grandTotal = $cartTotal + $tax + $shippingCost;

    return view('website.card.index', compact(
        'cartItems',
        'cartTotal',
        'tax',
        'totalWeight',
        'shippingCost',
        'grandTotal'
    ));
}

    // ================= UPDATE QTY =================
   public function updateQty(Request $request)
{
    $cart = session()->get('cart', []);

    if (!isset($cart[$request->id])) {
        return response()->json([
            'error' => 'Item not found'
        ], 404);
    }

    // Quantity Update
    if ($request->action == 'increase') {
        $cart[$request->id]['quantity']++;
    } elseif ($request->action == 'decrease') {
        if ($cart[$request->id]['quantity'] > 1) {
            $cart[$request->id]['quantity']--;
        }
    }

    session()->put('cart', $cart);

    // Current Product Line Total
    $lineTotal = $cart[$request->id]['price'] * $cart[$request->id]['quantity'];

    // Cart Total & Weight
    $cartTotal = 0;
    $totalWeight = 0;

    foreach ($cart as $item) {
        $cartTotal += $item['price'] * $item['quantity'];

        if (isset($item['product_weight'])) {
            $totalWeight += $item['product_weight'] * $item['quantity'];
        }
    }

    // Tax
    $tax = ($cartTotal * 10) / 100;

    // Shipping Cost by Weight
    if ($totalWeight <= 1) {
        $shippingCost = 80;
    } elseif ($totalWeight <= 3) {
        $shippingCost = 150;
    } elseif ($totalWeight <= 5) {
        $shippingCost = 250;
    } else {
        $shippingCost = 400;
    }

    // Grand Total
    $grandTotal = $cartTotal + $tax + $shippingCost;

    return response()->json([
        'status'       => 'success',
        'quantity'     => $cart[$request->id]['quantity'],
        'lineTotal'    => $lineTotal,
        'cartTotal'    => $cartTotal,
        'tax'          => $tax,
        'totalWeight'  => $totalWeight,
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

    // Recalculate Cart
    $cartTotal = 0;
    $totalWeight = 0;

    foreach ($cart as $item) {
        $cartTotal += $item['price'] * $item['quantity'];

        if (isset($item['product_weight'])) {
            $totalWeight += $item['product_weight'] * $item['quantity'];
        }
    }

    $tax = ($cartTotal * 10) / 100;

    // Shipping Cost by Weight
    if ($totalWeight <= 4) {
        $shippingCost = 250;
    } elseif ($totalWeight <= 10) {
        $shippingCost = 400;
    } else {
        $shippingCost = 1000;
    }

    $grandTotal = $cartTotal + $tax + $shippingCost;

    // Empty Cart
    if (empty($cart)) {
        $cartTotal = 0;
        $tax = 0;
        $shippingCost = 0;
        $grandTotal = 0;
        $totalWeight = 0;
    }

    return response()->json([
        'status'       => 'success',
        'cartTotal'    => $cartTotal,
        'tax'          => $tax,
        'totalWeight'  => $totalWeight,
        'shippingCost' => $shippingCost,
        'grandTotal'   => $grandTotal
    ]);
}
}