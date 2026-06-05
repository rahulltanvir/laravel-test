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
}