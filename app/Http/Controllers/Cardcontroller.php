<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class Cardcontroller extends Controller
{
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
    public function show()
{
    $cartItems = session('cart', []);
    return view('website.card.index', compact('cartItems'));
}
public function updateQty(Request $request)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$request->id])) {

        if ($request->action == 'increase') {

            $cart[$request->id]['quantity']++;

        } elseif ($request->action == 'decrease') {

            if ($cart[$request->id]['quantity'] > 1) {
                $cart[$request->id]['quantity']--;
            }
        }

        session()->put('cart', $cart);
    }

    $lineTotal =
        $cart[$request->id]['price'] *
        $cart[$request->id]['quantity'];

    $grandTotal = 0;

    foreach ($cart as $item) {
        $grandTotal += $item['price'] * $item['quantity'];
    }

    return response()->json([
        'quantity'   => $cart[$request->id]['quantity'],
        'lineTotal'  => $lineTotal,
        'grandTotal' => $grandTotal,
    ]);
}

public function remove(Request $request)
{
    $id = $request->id;

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    // recalculate total
    $grandTotal = 0;

    foreach ($cart as $item) {
        $grandTotal += $item['price'] * $item['quantity'];
    }

    return response()->json([
        'status' => 'success',
        'grandTotal' => $grandTotal
    ]);
}
}